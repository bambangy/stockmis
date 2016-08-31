<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller{
    public $role = "";
    public function __construct(){
        parent::__construct();
        $this->load->model('mod_order', 'mod_order', TRUE);

        $this->model["view"] = "report/replist";
        $this->model["data"] = array(
            "title" => "Report Index",
            "form_action" => "",
            "form_data" => array(
                "details" => array()
            ),
            "edit" => false,
            "view" => false,
        );
        $this->role = $this->session->userdata("role");
    }

    public function order()
    {
        $userid = $this->input->get("userid");
        $sdate = $this->input->get("sdate");
        $edate = $this->input->get("edate");
        
    }
}