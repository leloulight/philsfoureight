<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Laracasts\Queries\NetworkQueries as networkQueries;
use Laracasts\Validations\NetworkValidations as networkValidations;

use Auth;
use Redirect;
use Session;
use Input;
use Cookie;

class NetworkController extends Controller
{
	private $networkQueries;
    private $networkValidations;

    public function __construct() {
        $this->middleware('auth');
        $this->networkQueries = new networkQueries;
        $this->networkValidations = new networkValidations;
    }

    public function genealogy($id) {
        if (strlen($id) != 8){ return view('pages.404'); }
        $data_one = $this->networkQueries->getBinaryInfo($id);
        $name = $data_one[0]->name;
        if (count($data_one) == 0){ return view('pages.404'); }
        $data_two = NULL;
        $data_three = NULL;
        $data_four = NULL;
        $data_five = NULL;
        $data_six = NULL;
        $data_seven = NULL;

        if (count($data_one) == 1) {
            if ($data_one[0]->binary_left != NULL) {
                $data_two = $this->networkQueries->getBinaryInfo($data_one[0]->binary_left_guid);
            }
            if ($data_one[0]->binary_right != NULL) {
                $data_three = $this->networkQueries->getBinaryInfo($data_one[0]->binary_right_guid);
            }
        }
        
        if (count($data_two) == 1) {
            if ($data_two[0]->binary_left != NULL) {
                $data_four = $this->networkQueries->getBinaryInfo($data_two[0]->binary_left_guid);
            }

            if ($data_two[0]->binary_right != NULL) {
                $data_five = $this->networkQueries->getBinaryInfo($data_two[0]->binary_right_guid);
            }
        }
        
        if (count($data_three) == 1) {
            if ($data_three[0]->binary_left != NULL) {
                $data_six = $this->networkQueries->getBinaryInfo($data_three[0]->binary_left_guid);
            }

            if ($data_three[0]->binary_right != NULL) {
                $data_seven = $this->networkQueries->getBinaryInfo($data_three[0]->binary_right_guid);
            }
        }

        // Validations
        if (count($data_one) > 0) {

        }
        foreach ($data_one as $row) {
            $row->name = $this->networkValidations->formatName($row->name);
            $row->created_at = $this->networkValidations->formatDate($row->created_at);
            $row->type = $this->networkValidations->formatTypeCase($row->type);
            $row->span = $this->networkValidations->setBadgeType($row->type);

            $row->binary_right_created = $this->networkValidations->formatDate($row->binary_right_created);
            $row->binary_left_created = $this->networkValidations->formatDate($row->binary_left_created);
            
            $row->binary_left_name = $this->networkValidations->formatName($row->binary_left_name);
            $row->binary_right_name = $this->networkValidations->formatName($row->binary_right_name);

            $row->binary_left_type = $this->networkValidations->formatTypeCase($row->binary_left_type);
            $row->binary_right_type = $this->networkValidations->formatTypeCase($row->binary_right_type);

            $row->binary_left_span = $this->networkValidations->setBadgeType($row->binary_left_type);
            $row->binary_right_span = $this->networkValidations->setBadgeType($row->binary_right_type);
        }

        if (count($data_two) > 0) {
            foreach ($data_two as $row) {
                $row->binary_right_created = $this->networkValidations->formatDate($row->binary_right_created);
                $row->binary_left_created = $this->networkValidations->formatDate($row->binary_left_created);
                
                $row->binary_left_name = $this->networkValidations->formatName($row->binary_left_name);
                $row->binary_right_name = $this->networkValidations->formatName($row->binary_right_name);

                $row->binary_left_type = $this->networkValidations->formatTypeCase($row->binary_left_type);
                $row->binary_right_type = $this->networkValidations->formatTypeCase($row->binary_right_type);

                $row->binary_left_span = $this->networkValidations->setBadgeType($row->binary_left_type);
                $row->binary_right_span = $this->networkValidations->setBadgeType($row->binary_right_type);
            }
        }

        if (count($data_three) > 0) {
            foreach ($data_three as $row) {
                $row->binary_right_created = $this->networkValidations->formatDate($row->binary_right_created);
                $row->binary_left_created = $this->networkValidations->formatDate($row->binary_left_created);
            
                $row->binary_left_name = $this->networkValidations->formatName($row->binary_left_name);
                $row->binary_right_name = $this->networkValidations->formatName($row->binary_right_name);

                $row->binary_left_type = $this->networkValidations->formatTypeCase($row->binary_left_type);
                $row->binary_right_type = $this->networkValidations->formatTypeCase($row->binary_right_type);

                $row->binary_left_span = $this->networkValidations->setBadgeType($row->binary_left_type);
                $row->binary_right_span = $this->networkValidations->setBadgeType($row->binary_right_type);
            }
        }

        if (count($data_four) > 0) {
            foreach ($data_four as $row) {
                $row->binary_right_created = $this->networkValidations->formatDate($row->binary_right_created);
                $row->binary_left_created = $this->networkValidations->formatDate($row->binary_left_created);
                
                $row->binary_left_name = $this->networkValidations->formatName($row->binary_left_name);
                $row->binary_right_name = $this->networkValidations->formatName($row->binary_right_name);

                $row->binary_left_type = $this->networkValidations->formatTypeCase($row->binary_left_type);
                $row->binary_right_type = $this->networkValidations->formatTypeCase($row->binary_right_type);

                $row->binary_left_span = $this->networkValidations->setBadgeType($row->binary_left_type);
                $row->binary_right_span = $this->networkValidations->setBadgeType($row->binary_right_type);
            }
        }

        if (count($data_five) > 0) {
            foreach ($data_five as $row) {
                $row->binary_right_created = $this->networkValidations->formatDate($row->binary_right_created);
                $row->binary_left_created = $this->networkValidations->formatDate($row->binary_left_created);
                
                $row->binary_left_name = $this->networkValidations->formatName($row->binary_left_name);
                $row->binary_right_name = $this->networkValidations->formatName($row->binary_right_name);

                $row->binary_left_type = $this->networkValidations->formatTypeCase($row->binary_left_type);
                $row->binary_right_type = $this->networkValidations->formatTypeCase($row->binary_right_type);

                $row->binary_left_span = $this->networkValidations->setBadgeType($row->binary_left_type);
                $row->binary_right_span = $this->networkValidations->setBadgeType($row->binary_right_type);
            }
        }

        if (count($data_six) > 0) {
            foreach ($data_six as $row) {
                $row->binary_right_created = $this->networkValidations->formatDate($row->binary_right_created);
                $row->binary_left_created = $this->networkValidations->formatDate($row->binary_left_created);
                
                $row->binary_left_name = $this->networkValidations->formatName($row->binary_left_name);
                $row->binary_right_name = $this->networkValidations->formatName($row->binary_right_name);

                $row->binary_left_type = $this->networkValidations->formatTypeCase($row->binary_left_type);
                $row->binary_right_type = $this->networkValidations->formatTypeCase($row->binary_right_type);

                $row->binary_left_span = $this->networkValidations->setBadgeType($row->binary_left_type);
                $row->binary_right_span = $this->networkValidations->setBadgeType($row->binary_right_type);
            }
        }

        if (count($data_seven) > 0) {
            foreach ($data_seven as $row) {
                $row->binary_right_created = $this->networkValidations->formatDate($row->binary_right_created);
                $row->binary_left_created = $this->networkValidations->formatDate($row->binary_left_created);
                
                $row->binary_left_name = $this->networkValidations->formatName($row->binary_left_name);
                $row->binary_right_name = $this->networkValidations->formatName($row->binary_right_name);

                $row->binary_left_type = $this->networkValidations->formatTypeCase($row->binary_left_type);
                $row->binary_right_type = $this->networkValidations->formatTypeCase($row->binary_right_type);

                $row->binary_left_span = $this->networkValidations->setBadgeType($row->binary_left_type);
                $row->binary_right_span = $this->networkValidations->setBadgeType($row->binary_right_type);
            }
        }

        return view('pages.mynetwork.genealogy', compact('data_one', 'data_two', 'data_three', 'data_four', 'data_five', 'data_six', 'data_seven', 'name'));
    }

    public function networkList() {
        $network = $this->networkQueries->getUnilevelList(Auth::user()->id);
        return view('pages.mynetwork.network', compact('network'));
    }

    public function unilevelList($level) {
        if ((int)$level == 0){ return view('pages.404'); }
        if ((int)$level > 7){ return view('pages.404'); }

        $members = $this->networkQueries->getUnilevelListPerLevel(Auth::user()->id, $level);
        $row_num = Input::get('page', 1);
        $row_num = ($row_num - 1) * 15;

        foreach($members as &$row) {
            $row->row_num = $row_num += 1;
            $row->created_at = $this->networkValidations->formatDate($row->created_at);
            $row->badgeStatus = $this->networkValidations->getStatusClass($row->status);
            $row->badgeStatusLabel = $this->networkValidations->validateStatus($row->status);
        }

        return view('pages.mynetwork.unilevel', compact('members'));
    }
}