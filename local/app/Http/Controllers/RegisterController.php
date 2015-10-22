<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use CRUD\Http\Controllers\Controller;
use Laracasts\Validations\RegistrationValidations as registrationValidations;
use Laracasts\Queries\RegistrationQueries as registrationQueries;
use DB;
use Log;

class RegisterController extends Controller
{
    private $registrationValidations;
    private $registrationQueries;

    public function __construct() {
        $this->registrationValidations = new registrationValidations;
        $this->registrationQueries = new registrationQueries;
    }

    public function register_member() {
        return view('pages.register.member');
    }

    public function register_stockist() {
        return view('pages.register.stockist');
    }

    public function store_member(Request $request) {

        $errorMessage = $this->registrationValidations->validateRegistrationPost($request->all());

        if ($errorMessage->fails()) {
            return Redirect::to('register/member')->withInput()->withErrors($errorMessage);
        } else {
            // DB::enableQueryLog();
            $this->insertMember($request);
            // Log::error(DB::getQueryLog());
            return Redirect::to('/');
        }
    }

    public function store_stockist(Request $request) {
        $errorMessage = $this->registrationValidations->validateStockistPost($request->all());

        if ($errorMessage->fails()) {
            return Redirect::to('register/stockist')->withInput()->withErrors($errorMessage);
        } else {
            // DB::enableQueryLog();
            $this->insertStockist($request);
            // Log::error(DB::getQueryLog());
            return Redirect::to('/');
        }
    }

    public function insertStockist($post) {
        $update_log_id = array();
        $money_log_insert = array();
        array_push($update_log_id, 10000);

        $post['type'] = "stockist";
        $post['sponsor_id'] = 10000;
        $post['stockist_id'] = NULL;
        $post['upline_id'] = NULL;

        // Insert Main Account
        $this->registrationQueries->insertMainAccount($post->all());
        
        // Get Last Member Id
        $member_id = $this->registrationQueries->getLastMemberId();

        // Update Account Numbers
        $this->registrationQueries->updateAccountNumbers($post['accountno'], 10000, $member_id);

        // Update Stockist ID
        $this->registrationQueries->updateNewStockistId($member_id);

        // Insert P500 to Admin
        $money_log_insert = $this->pushMoneyLog(10000, 500, 'registration-credit', 'New stockist [' . $post['username'] . ']', $money_log_insert);
        
        // Bulk Money Log Insert
        $this->registrationQueries->bulkInsertMoneyLog($money_log_insert);

        // Update Member Money
        $this->registrationQueries->bulkUpdateMemberMoney($update_log_id);

        // Reward Program
        $this->rewardUnityOneProgram();
    }
    public function pushMoneyLog($member_id, $amount, $type, $log, $money_log_insert) {
        $var = "(" . $member_id . ", " . $amount . ", '" . $type . "', '" . $log . "')";
        array_push($money_log_insert, $var);
        return $money_log_insert;
    }

    public function insertMember($post) {
        $update_log_id = array();
        $money_log_insert = array();
        array_push($update_log_id, 10000);

        // Get Stockist Id
        $stockist_id = $this->registrationQueries->getStockistId($post['accountno']);
        $upline_id = NULL;
        $unilevel_id = NULL;

        if($post['placement_id'] == NULL && $post['sponsor_id'] == NULL) {
            $upline_id = $this->registrationQueries->getStockistInactive($stockist_id);
            $unilevel_id = $upline_id;
        } elseif ($post['placement_id'] == NULL && $post['sponsor_id'] != NULL) {
            $unilevel_id = $this->registrationQueries->getMemberId($post['sponsor_id']);
            $valid = $this->registrationQueries->validUplineId($unilevel_id);
            if ($valid == true) {
                $upline_id = $unilevel_id;
            } else {
                $upline_id = $this->registrationQueries->getStockistInactive($stockist_id);
            }
        } elseif ($post['placement_id'] != NULL && $post['sponsor_id'] == NULL) {
            $upline_id = $this->registrationQueries->getMemberId($post['placement_id']);
            $unilevel_id = $upline_id;
        } elseif ($post['placement_id'] != NULL && $post['sponsor_id'] != NULL) {
            $upline_id = $this->registrationQueries->getMemberId($post['placement_id']);
            $unilevel_id = $this->registrationQueries->getMemberId($post['sponsor_id']);
        }   

        $post['sponsor_id'] = $unilevel_id;
        $post['upline_id'] = $upline_id;
        $post['stockist_id'] = $stockist_id;

        // Insert Main Account
        $this->registrationQueries->insertMainAccount($post->all());
        
        // Get Last Member Id
        $member_id = $this->registrationQueries->getLastMemberId();
        
        // Update Upline Id
        $binaries = $this->registrationQueries->getMemberBinaries($upline_id);
        if ($binaries[0]->binary_left == NULL) {
            $this->registrationQueries->updateMemberBinaryLeft($upline_id, $member_id);
        } else {
            $this->registrationQueries->updateMemberBinaryRight($upline_id, $member_id);
        }

        // Update Account Numbers
        $this->registrationQueries->updateAccountNumbers($post['accountno'], $stockist_id, $member_id);

        // Insert P500 to Admin
        $money_log_insert = $this->pushMoneyLog(10000, 500, 'registration-credit', 'New member [' . $post['username'] . ']', $money_log_insert);

        // Give P50 to Sponsor Id
        if ($unilevel_id != 10000) {
            $money_log_insert = $this->pushMoneyLog($unilevel_id, 50, 'referral-credit', 'Direct Referral Bonus FROM [' . $post['username'] . ']', $money_log_insert);
            $money_log_insert = $this->pushMoneyLog(10000, -50, 'referral-debit', 'Direct Referral Bonus TO [' . $post['username'] . ']', $money_log_insert);
        }

        $uplineList = $this->registrationQueries->getUplineList($member_id);

        // Distribution of unilevel bonus
        if ($uplineList != NULL) {
            foreach ($uplineList as $key) {
                if ($key != 10000 && $key != 0) {
                    $money_log_insert = $this->pushMoneyLog($key, 10, 'unilevel-credit', 'Unilevel Registration Bonus FROM [' . $post['username'] . ']', $money_log_insert);
                    $money_log_insert = $this->pushMoneyLog(10000, -10, 'unilevel-debit', 'Unilevel Registration Bonus TO [' . $post['username'] . ']', $money_log_insert);
                    if (!in_array($key, $update_log_id)) {
                        array_push($update_log_id, $key);
                    }
                }
            }
        }

        // // Count Unilevel
        // $count_unilevel = intval($this->registrationQueries->countUnilevel($unilevel_id));

        // // Set Status to ACTIVE if more than 1 or == 2 Unilevel Count
        // if ($count_unilevel > 1 || $count_unilevel == 2) {
        //     $this->registrationQueries->updateMemberStatus($unilevel_id);
        // }

        if (intval($post['entry_package']) > 1) {
            array_push($update_log_id, $member_id);

            // For Money Log Purpose
            $firstname = $post['firstname'];
            $username = $post['username'];

            // Set POST Values to NULL
            $this->registrationValidations->setPostNull($post);

            $entry_package = (int) $post['entry_package'];

            for ($i=1; $i < $entry_package; $i++) { 
                // Get Inactive Sub Account ID
                $inactive_id = $this->registrationQueries->getInactiveSubAccount($member_id);
                
                $upline_id = $inactive_id;

                $post['type'] = 'sub';
                $post['main_id'] = $member_id;
                $post['sponsor_id'] = $member_id;
                $post['stockist_id'] = $stockist_id;
                $post['upline_id'] = $inactive_id;


                $post['firstname'] = $firstname . '-' . $this->registrationValidations->setSubId($i);

                $this->registrationQueries->insertMainAccount($post->all());

                // Get Last Sub Member Id
                $new_member_id = $this->registrationQueries->getLastMemberId();

                // Update Upline Id
                $binaries = $this->registrationQueries->getMemberBinaries($upline_id);
                if ($binaries[0]->binary_left == NULL) {
                    $this->registrationQueries->updateMemberBinaryLeft($upline_id, $new_member_id);
                } else {
                    $this->registrationQueries->updateMemberBinaryRight($upline_id, $new_member_id);
                }
                
                // Get Unilevel List. Up to 7 Level.
                $uplineList = $this->registrationQueries->getUplineList($new_member_id);
                
                // Insert P500 to Admin
                $money_log_insert = $this->pushMoneyLog(10000, 500, 'registration-credit', 'New member [sub_account] [' . $username . ']-[' . $post['firstname'] . ']', $money_log_insert);

                // Give P50 to Sponsor Id
                if ($inactive_id != 10000) {
                    $money_log_insert = $this->pushMoneyLog($member_id, 50, 'referral-credit', 'Direct Referral Bonus FROM [' . $username . ']-[' . $post['firstname'] . ']', $money_log_insert);
                    $money_log_insert = $this->pushMoneyLog(10000, -50, 'referral-debit', 'Direct Referral Bonus TO [' . $username . ']-[' . $post['firstname'] . ']', $money_log_insert);
                }

                // Distribution of unilevel bonus
                foreach ($uplineList as $key) {
                    if ($key != 10000 && $key != 0) {
                        $money_log_insert = $this->pushMoneyLog($key, 10, 'unilevel-credit', 'Unilevel Registration Bonus FROM [' . $username . ']-[' . $post['firstname'] . ']', $money_log_insert);
                        $money_log_insert = $this->pushMoneyLog(10000, -10, 'unilevel-debit', 'Unilevel Registration Bonus TO [' . $username . ']-[' . $post['firstname'] . ']', $money_log_insert);
                        
                        if (!in_array($key, $update_log_id)) {
                            array_push($update_log_id, $key);
                        }
                    }
                }

                // Count UNILEVEL
                $count_unilevel = intval($this->registrationQueries->countUnilevel($inactive_id));

                // Set Status to ACTIVE if more than 1 or == 2 Unilevel Count
                if ($count_unilevel > 1 || $count_unilevel == 2) {
                    $this->registrationQueries->updateMemberStatus($inactive_id);
                }
            }
        }
        
        // Bulk Money Log Insert
        $this->registrationQueries->bulkInsertMoneyLog($money_log_insert);

        // Update Member Money
        $this->registrationQueries->bulkUpdateMemberMoney($update_log_id);

        // Reward Program
        $this->rewardUnityOneProgram();
    }

    public function rewardUnityOneProgram() {
        $update_log_id = array();
        $money_log_insert = array();

        start:

        $active_unity_id = $this->registrationQueries->getUnityAdvance(1); // Level 1
        
        if ($active_unity_id != NULL) {
            $member_id = $this->registrationQueries->getUnityOneMember($active_unity_id); // Level 1
            while ($member_id != NULL) {
                $this->registrationQueries->updateUnityMember(1, $active_unity_id, $member_id);
                $count_unity_downline = $this->registrationQueries->countUnityDownline(1, $active_unity_id);
                
                if ($count_unity_downline == 6) {
                    $this->registrationQueries->updateUnityStatus(1, $active_unity_id, 2);

                    // Insert Reward Bonus
                    $money_log_insert = $this->pushMoneyLog($active_unity_id, 500, 'reward-credit', 'Completed Reward Program Level 1.', $money_log_insert);
                    $name = $this->registrationQueries->getMemberName($active_unity_id);
                    $money_log_insert = $this->pushMoneyLog(10000, -500, 'reward-debit', '[' . $name . '] Completed Reward Program Level 1.', $money_log_insert);

                    // Update Log Id
                    if (!in_array($active_unity_id, $update_log_id)) array_push($update_log_id, $active_unity_id);
                    if (!in_array(10000, $update_log_id)) array_push($update_log_id, 10000);

                    goto start;
                }
                $member_id = $this->registrationQueries->getUnityOneMember($active_unity_id); // Level 2
            }
        } else {
            $inactive_unity_id = $this->registrationQueries->getInactiveUnityAdvance(1); // Level 2
            if($inactive_unity_id != NULL) {
                // Update Unity TWO Status = 1
                $this->registrationQueries->updateUnityStatus(1, $inactive_unity_id, 1);
                goto start;
            }
        }

        end:

        // Bulk Money Log Insert
        if (count($money_log_insert) > 0) $this->registrationQueries->bulkInsertMoneyLog($money_log_insert);

        // Update Member Money
        if (count($update_log_id) > 0) $this->registrationQueries->bulkUpdateMemberMoney($update_log_id);
        
        // Proceed to Unity THREE Program
        $this->rewardUnityTwoProgram();
    }

    public function rewardUnityTwoProgram() {
        $update_log_id = array();
        $money_log_insert = array();

        start:

        $active_unity_id = $this->registrationQueries->checkUnityAdvance(2); // Level 2
        if ($active_unity_id != NULL) {
            $member_id = $this->registrationQueries->getUnityAdvance(2); // Level 2
            while ($member_id != NULL) {
                $this->registrationQueries->updateUnityMember(2, $active_unity_id, $member_id);
                $count_unity_downline = $this->registrationQueries->countUnityDownline(2, $active_unity_id);
                if ($count_unity_downline == 6) {
                    $this->registrationQueries->updateUnityStatus(2, $active_unity_id, 2);

                    // Insert Reward Bonus
                    $this->registrationQueries->insertMoneyLog($active_unity_id, 2500, 'reward-credit', 'Completed Reward Program Level 2.', $money_log_insert);
                    $name = $this->registrationQueries->getMemberName($active_unity_id);
                    $this->registrationQueries->insertMoneyLog(10000, -2500, 'reward-debit', '[' . $name . '] Completed Reward Program Level 2.', $money_log_insert);

                    $this->registrationQueries->insertMoneyLog($active_unity_id, -1000, 'reward-registration-debit', 'Reward Program Level 2. Created (2) new sub-account.', $money_log_insert);
                    $this->registrationQueries->insertMoneyLog(10000, 1000, 'reward-registration-credit', '[' . $name . '] Reward Program Level 2. Created (2) new sub-account.', $money_log_insert);

                    // Update Log Id
                    if (!in_array($active_unity_id, $update_log_id)) array_push($update_log_id, $active_unity_id);
                    if (!in_array(10000, $update_log_id)) array_push($update_log_id, 10000);

                    for ($i=0; $i < 2; $i++) { 
                        $this->createSubAccountRewardProgram($active_unity_id, 2);
                    }

                    // Reward Program
                    goto start;
                }
                $member_id = $this->registrationQueries->getUnityAdvance(2); // Level 2
            }
        } else {
            $inactive_unity_id = $this->registrationQueries->getInactiveUnityAdvance(2); // Level 2
            if($inactive_unity_id != NULL) {
                // Update Unity TWO Status = 1
                $this->registrationQueries->updateUnityStatus(2, $inactive_unity_id, 1);
                goto start;
            }
        }

        end:

        // Bulk Money Log Insert
        // if (count($money_log_insert) > 0) $this->registrationQueries->bulkInsertMoneyLog($money_log_insert);

        // Update Member Money
        if (count($update_log_id) > 0) $this->registrationQueries->bulkUpdateMemberMoney($update_log_id);
        
        // Proceed to Unity THREE Program
        $this->rewardUnityThreeProgram();
    }

    public function rewardUnityThreeProgram() {
        $update_log_id = array();
        $money_log_insert = array();

        start:

        $active_unity_id = $this->registrationQueries->checkUnityAdvance(3); // Level 3
        if ($active_unity_id != NULL) {
            $member_id = $this->registrationQueries->getUnityAdvance(3); // Level 3
            while ($member_id != NULL) {
                $this->registrationQueries->updateUnityMember(3, $active_unity_id, $member_id);
                $count_unity_downline = $this->registrationQueries->countUnityDownline(3, $active_unity_id);
                if ($count_unity_downline == 6) {
                    $this->registrationQueries->updateUnityStatus(3, $active_unity_id, 2);

                    // Insert Reward Bonus
                    $this->registrationQueries->insertMoneyLog($active_unity_id, 7000, 'reward-credit', 'Completed Reward Program Level 3.', $money_log_insert);
                    $name = $this->registrationQueries->getMemberName($active_unity_id);
                    $this->registrationQueries->insertMoneyLog(10000, -7000, 'reward-debit', '[' . $name . '] Completed Reward Program Level 3.', $money_log_insert);

                    $this->registrationQueries->insertMoneyLog($active_unity_id, -2000, 'reward-registration-debit', 'Reward Program Level 3. Created (4) new sub-account.', $money_log_insert);
                    $this->registrationQueries->insertMoneyLog(10000, 2000, 'reward-registration-credit', '[' . $name . '] Reward Program Level 3. Created (4) new sub-account.', $money_log_insert);

                    // Update Log Id
                    if (!in_array($active_unity_id, $update_log_id)) array_push($update_log_id, $active_unity_id);
                    if (!in_array(10000, $update_log_id)) array_push($update_log_id, 10000);

                    for ($i=0; $i < 4; $i++) { 
                        $this->createSubAccountRewardProgram($active_unity_id, 3);
                    }

                    // Reward Program
                    goto start;
                }
                $member_id = $this->registrationQueries->getUnityAdvance(3); // Level 3
            }
        } else {
            $inactive_unity_id = $this->registrationQueries->getInactiveUnityAdvance(3); // Level 3
            if($inactive_unity_id != NULL) {
                // Update Unity TWO Status = 1
                $this->registrationQueries->updateUnityStatus(3, $inactive_unity_id, 1);
                goto start;
            }
        }

        end:

        // Bulk Money Log Insert
        // if (count($money_log_insert) > 0) $this->registrationQueries->bulkInsertMoneyLog($money_log_insert);

        // Update Member Money
        if (count($update_log_id) > 0) $this->registrationQueries->bulkUpdateMemberMoney($update_log_id);
        
        // Proceed to Unity FOUR Program
        $this->rewardUnityFourProgram();
    }

    public function rewardUnityFourProgram() {
        $update_log_id = array();
        $money_log_insert = array();

        start:

        $active_unity_id = $this->registrationQueries->checkUnityAdvance(4); // Level 4
        if ($active_unity_id != NULL) {
            $member_id = $this->registrationQueries->getUnityAdvance(4); // Level 4
            while ($member_id != NULL) {
                $this->registrationQueries->updateUnityMember(4, $active_unity_id, $member_id);
                $count_unity_downline = $this->registrationQueries->countUnityDownline(4, $active_unity_id);
                if ($count_unity_downline == 6) {
                    $this->registrationQueries->updateUnityStatus(4, $active_unity_id, 2);

                    // Insert Reward Bonus
                    $this->registrationQueries->insertMoneyLog($active_unity_id, 30000, 'reward-credit', 'Completed Reward Program Level 4.', $money_log_insert);
                    $name = $this->registrationQueries->getMemberName($active_unity_id);
                    $this->registrationQueries->insertMoneyLog(10000, -30000, 'reward-debit', '[' . $name . '] Completed Reward Program Level 4.', $money_log_insert);

                    $this->registrationQueries->insertMoneyLog($active_unity_id, -4000, 'reward-registration-debit', 'Reward Program Level 4. Created (8) new sub-account.', $money_log_insert);
                    $this->registrationQueries->insertMoneyLog(10000, 4000, 'reward-registration-credit', '[' . $name . '] Reward Program Level 4. Created (8) new sub-account.', $money_log_insert);

                    // Update Log Id
                    if (!in_array($active_unity_id, $update_log_id)) array_push($update_log_id, $active_unity_id);
                    if (!in_array(10000, $update_log_id)) array_push($update_log_id, 10000);

                    for ($i=0; $i < 8; $i++) { 
                        $this->createSubAccountRewardProgram($active_unity_id, 4);
                    }

                    // Reward Program
                    goto start;
                }
                $member_id = $this->registrationQueries->getUnityAdvance(4); // Level 4
            }
        } else {
            $inactive_unity_id = $this->registrationQueries->getInactiveUnityAdvance(4); // Level 4
            if($inactive_unity_id != NULL) {
                // Update Unity TWO Status = 1
                $this->registrationQueries->updateUnityStatus(4, $inactive_unity_id, 1);
                goto start;
            }
        }

        end:

        // Bulk Money Log Insert
        // if (count($money_log_insert) > 0) $this->registrationQueries->bulkInsertMoneyLog($money_log_insert);

        // Update Member Money
        if (count($update_log_id) > 0) $this->registrationQueries->bulkUpdateMemberMoney($update_log_id);
        
        // Proceed to Unity FIVE Program
        $this->rewardUnityFiveProgram();
    }

    public function rewardUnityFiveProgram() {
        $update_log_id = array();
        $money_log_insert = array();

        start:

        $active_unity_id = $this->registrationQueries->checkUnityAdvance(5); // Level 5
        if ($active_unity_id != NULL) {
            $member_id = $this->registrationQueries->getUnityAdvance(5); // Level 5
            while ($member_id != NULL) {
                $this->registrationQueries->updateUnityMember(5, $active_unity_id, $member_id);
                $count_unity_downline = $this->registrationQueries->countUnityDownline(5, $active_unity_id);
                if ($count_unity_downline == 6) {
                    $this->registrationQueries->updateUnityStatus(5, $active_unity_id, 2);

                    // Insert Reward Bonus
                    $this->registrationQueries->insertMoneyLog($active_unity_id, 70000, 'reward-credit', 'Completed Reward Program Level 5.', $money_log_insert);
                    $name = $this->registrationQueries->getMemberName($active_unity_id);
                    $this->registrationQueries->insertMoneyLog(10000, -70000, 'reward-debit', '[' . $name . '] Completed Reward Program Level 5.', $money_log_insert);

                    $this->registrationQueries->insertMoneyLog($active_unity_id, -8000, 'reward-registration-debit', 'Reward Program Level 5. Created (16) new sub-account.', $money_log_insert);
                    $this->registrationQueries->insertMoneyLog(10000, 8000, 'reward-registration-credit', '[' . $name . '] Reward Program Level 5. Created (16) new sub-account.', $money_log_insert);

                    // Update Log Id
                    if (!in_array($active_unity_id, $update_log_id)) array_push($update_log_id, $active_unity_id);
                    if (!in_array(10000, $update_log_id)) array_push($update_log_id, 10000);

                    for ($i=0; $i < 16; $i++) { 
                        $this->createSubAccountRewardProgram($active_unity_id, 5);
                    }

                    // Reward Program
                    goto start;
                }
                $member_id = $this->registrationQueries->getUnityAdvance(5); // Level 5
            }
        } else {
            $inactive_unity_id = $this->registrationQueries->getInactiveUnityAdvance(5); // Level 5
            if($inactive_unity_id != NULL) {
                $this->registrationQueries->updateUnityStatus(5, $inactive_unity_id, 1);
                goto start;
            }
        }

        end:

        // Bulk Money Log Insert
        // if (count($money_log_insert) > 0) $this->registrationQueries->bulkInsertMoneyLog($money_log_insert);

        // Update Member Money
        if (count($update_log_id) > 0) $this->registrationQueries->bulkUpdateMemberMoney($update_log_id);
    }

    public function createSubAccountRewardProgram($member_id, $reward_level) {
        $post = array();

        $update_log_id = array();
        $money_log_insert = array();
        array_push($update_log_id, 10000);

        $last_sub_account = $this->registrationQueries->getLastSubAccount($member_id);

        if($last_sub_account[0]->main_id != NULL) {
            $member_id = $last_sub_account[0]->main_id;
            $last_sub_account = $this->registrationQueries->getLastSubAccount($member_id);
        }

        $last_num = 1;
        $last_sub_account[0]->last_sub_id = ltrim($last_sub_account[0]->last_sub_id, '0');
       
        if(is_int(intval($last_sub_account[0]->last_sub_id))) {
            $last_num = intval($last_sub_account[0]->last_sub_id);
            $last_num += 1;
        }
        $username = $this->registrationQueries->getMemberUsername($member_id);
        $inactive_id = $this->registrationQueries->getInactiveSubAccount($member_id);

        $post['firstname'] = $last_sub_account[0]->firstname . '-' . $this->registrationValidations->setSubId($last_num);
        
        $post['middlename'] = $last_sub_account[0]->middlename;
        $post['lastname'] = $last_sub_account[0]->lastname;
        $post['suffix'] = $last_sub_account[0]->suffix; //'-R' . $reward_level;

        $post['mobileno'] = NULL;
        $post['phoneno'] = NULL;
        $post['birthdate'] = NULL;
        $post['email'] = NULL;
        $post['street_address'] = NULL;
        $post['city'] = NULL;
        $post['province'] = NULL;
        $post['gender'] = NULL;
        $post['username'] = NULL;
        $post['password'] = NULL;
        $post['accountno'] = NULL;

        $post['type'] = 'sub';
        $post['main_id'] = $member_id;
        $post['sponsor_id'] = $inactive_id;

        $this->registrationQueries->insertMainAccount($post);
        // Get Unilevel List. Up to 7 Level.
        $unilevelList = $this->registrationQueries->getUnlivelList($inactive_id);
        // Distribution of unilevel bonus
        foreach ($unilevelList as $key) {
            if ($key != 10000 && $key != 0) {
                $money_log_insert = $this->pushMoneyLog($key, 10, 'unilevel-credit', 'Unilevel Registration Bonus FROM [' . $username . ']-[' . $post['firstname'] . ']', $money_log_insert);
                $money_log_insert = $this->pushMoneyLog(10000, -10, 'unilevel-debit', 'Unilevel Registration Bonus TO [' . $username . ']-[' . $post['firstname'] . ']', $money_log_insert);
                
                if (!in_array($key, $update_log_id)) {
                    array_push($update_log_id, $key);
                }
            }
        }
        
        // Count UNILEVEL
        $count_unilevel = intval($this->registrationQueries->countUnilevel($inactive_id));

        // Set Status to ACTIVE if more than 1 or == 2 Unilevel Count
        if ($count_unilevel > 1 || $count_unilevel == 2) {
            $this->registrationQueries->updateMemberStatus($inactive_id);
        }

        // Bulk Money Log Insert
        $this->registrationQueries->bulkInsertMoneyLog($money_log_insert);

        // Update Member Money
        $this->registrationQueries->bulkUpdateMemberMoney($update_log_id);
    }
}
