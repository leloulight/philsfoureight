<?php

namespace CRUD\Http\Controllers;

use Illuminate\Http\Request;
use CRUD\Http\Requests;
use CRUD\Http\Controllers\Controller;

use Input;
use Redirect;

use Laracasts\Queries\GenealogyQueries as genealogyQueries;
use Laracasts\Validations\GenealogyValidations as genealogyValidations;

class GenealogyController extends Controller
{
	private $genealogyQueries;
    private $genealogyValidations;

    public function __construct() {
        $this->genealogyQueries = new genealogyQueries;
        $this->genealogyValidations = new genealogyValidations;
    }

    public function index($id) {
    	if ((int)$id == 0){ return view('pages.404'); }
        $data_one = $this->genealogyQueries->getBinaryInfo($id);
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
	        	$data_two = $this->genealogyQueries->getBinaryInfo($data_one[0]->binary_left);
	        }
	        if ($data_one[0]->binary_right != NULL) {
	        	$data_three = $this->genealogyQueries->getBinaryInfo($data_one[0]->binary_right);
	        }
        }
        
        if (count($data_two) == 1) {
        	if ($data_two[0]->binary_left != NULL) {
	        	$data_four = $this->genealogyQueries->getBinaryInfo($data_two[0]->binary_left);
	        }

	        if ($data_two[0]->binary_right != NULL) {
	        	$data_five = $this->genealogyQueries->getBinaryInfo($data_two[0]->binary_right);
	        }
        }
        
        if (count($data_three) == 1) {
			if ($data_three[0]->binary_left != NULL) {
	        	$data_six = $this->genealogyQueries->getBinaryInfo($data_three[0]->binary_left);
	        }

	        if ($data_three[0]->binary_right != NULL) {
	        	$data_seven = $this->genealogyQueries->getBinaryInfo($data_three[0]->binary_right);
	        }
        }

        // Validations
        if (count($data_one) > 0) {

        }
        foreach ($data_one as $row) {
            $row->name = $this->genealogyValidations->formatName($row->name);
            $row->created_at = $this->genealogyValidations->formatDate($row->created_at);
            $row->type = $this->genealogyValidations->formatTypeCase($row->type);
            $row->span = $this->genealogyValidations->setBadgeType($row->type);

            $row->binary_right_created = $this->genealogyValidations->formatDate($row->binary_right_created);
            $row->binary_left_created = $this->genealogyValidations->formatDate($row->binary_left_created);
            
            $row->binary_left_name = $this->genealogyValidations->formatName($row->binary_left_name);
            $row->binary_right_name = $this->genealogyValidations->formatName($row->binary_right_name);

            $row->binary_left_type = $this->genealogyValidations->formatTypeCase($row->binary_left_type);
            $row->binary_right_type = $this->genealogyValidations->formatTypeCase($row->binary_right_type);

            $row->binary_left_span = $this->genealogyValidations->setBadgeType($row->binary_left_type);
            $row->binary_right_span = $this->genealogyValidations->setBadgeType($row->binary_right_type);
        }

        if (count($data_two) > 0) {
            foreach ($data_two as $row) {
                $row->binary_right_created = $this->genealogyValidations->formatDate($row->binary_right_created);
                $row->binary_left_created = $this->genealogyValidations->formatDate($row->binary_left_created);
                
                $row->binary_left_name = $this->genealogyValidations->formatName($row->binary_left_name);
                $row->binary_right_name = $this->genealogyValidations->formatName($row->binary_right_name);

                $row->binary_left_type = $this->genealogyValidations->formatTypeCase($row->binary_left_type);
                $row->binary_right_type = $this->genealogyValidations->formatTypeCase($row->binary_right_type);

                $row->binary_left_span = $this->genealogyValidations->setBadgeType($row->binary_left_type);
                $row->binary_right_span = $this->genealogyValidations->setBadgeType($row->binary_right_type);
            }
        }

        if (count($data_three) > 0) {
            foreach ($data_three as $row) {
                $row->binary_right_created = $this->genealogyValidations->formatDate($row->binary_right_created);
                $row->binary_left_created = $this->genealogyValidations->formatDate($row->binary_left_created);
            
                $row->binary_left_name = $this->genealogyValidations->formatName($row->binary_left_name);
                $row->binary_right_name = $this->genealogyValidations->formatName($row->binary_right_name);

                $row->binary_left_type = $this->genealogyValidations->formatTypeCase($row->binary_left_type);
                $row->binary_right_type = $this->genealogyValidations->formatTypeCase($row->binary_right_type);

                $row->binary_left_span = $this->genealogyValidations->setBadgeType($row->binary_left_type);
                $row->binary_right_span = $this->genealogyValidations->setBadgeType($row->binary_right_type);
            }
        }

        if (count($data_four) > 0) {
            foreach ($data_four as $row) {
                $row->binary_right_created = $this->genealogyValidations->formatDate($row->binary_right_created);
                $row->binary_left_created = $this->genealogyValidations->formatDate($row->binary_left_created);
                
                $row->binary_left_name = $this->genealogyValidations->formatName($row->binary_left_name);
                $row->binary_right_name = $this->genealogyValidations->formatName($row->binary_right_name);

                $row->binary_left_type = $this->genealogyValidations->formatTypeCase($row->binary_left_type);
                $row->binary_right_type = $this->genealogyValidations->formatTypeCase($row->binary_right_type);

                $row->binary_left_span = $this->genealogyValidations->setBadgeType($row->binary_left_type);
                $row->binary_right_span = $this->genealogyValidations->setBadgeType($row->binary_right_type);
            }
        }

        if (count($data_five) > 0) {
            foreach ($data_five as $row) {
                $row->binary_right_created = $this->genealogyValidations->formatDate($row->binary_right_created);
                $row->binary_left_created = $this->genealogyValidations->formatDate($row->binary_left_created);
                
                $row->binary_left_name = $this->genealogyValidations->formatName($row->binary_left_name);
                $row->binary_right_name = $this->genealogyValidations->formatName($row->binary_right_name);

                $row->binary_left_type = $this->genealogyValidations->formatTypeCase($row->binary_left_type);
                $row->binary_right_type = $this->genealogyValidations->formatTypeCase($row->binary_right_type);

                $row->binary_left_span = $this->genealogyValidations->setBadgeType($row->binary_left_type);
                $row->binary_right_span = $this->genealogyValidations->setBadgeType($row->binary_right_type);
            }
        }

        if (count($data_six) > 0) {
            foreach ($data_six as $row) {
                $row->binary_right_created = $this->genealogyValidations->formatDate($row->binary_right_created);
                $row->binary_left_created = $this->genealogyValidations->formatDate($row->binary_left_created);
                
                $row->binary_left_name = $this->genealogyValidations->formatName($row->binary_left_name);
                $row->binary_right_name = $this->genealogyValidations->formatName($row->binary_right_name);

                $row->binary_left_type = $this->genealogyValidations->formatTypeCase($row->binary_left_type);
                $row->binary_right_type = $this->genealogyValidations->formatTypeCase($row->binary_right_type);

                $row->binary_left_span = $this->genealogyValidations->setBadgeType($row->binary_left_type);
                $row->binary_right_span = $this->genealogyValidations->setBadgeType($row->binary_right_type);
            }
        }

        if (count($data_seven) > 0) {
            foreach ($data_seven as $row) {
                $row->binary_right_created = $this->genealogyValidations->formatDate($row->binary_right_created);
                $row->binary_left_created = $this->genealogyValidations->formatDate($row->binary_left_created);
                
                $row->binary_left_name = $this->genealogyValidations->formatName($row->binary_left_name);
                $row->binary_right_name = $this->genealogyValidations->formatName($row->binary_right_name);

                $row->binary_left_type = $this->genealogyValidations->formatTypeCase($row->binary_left_type);
                $row->binary_right_type = $this->genealogyValidations->formatTypeCase($row->binary_right_type);

                $row->binary_left_span = $this->genealogyValidations->setBadgeType($row->binary_left_type);
                $row->binary_right_span = $this->genealogyValidations->setBadgeType($row->binary_right_type);
            }
        }

        return view('pages.genealogy', compact('data_one', 'data_two', 'data_three', 'data_four', 'data_five', 'data_six', 'data_seven', 'name'));
    }

    
}