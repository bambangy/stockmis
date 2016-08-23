<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    public $model = array(
        "title" => "",
        "view" => array(),
        "message" => "",
        "messageType" => "",
        "data" => array(
            "title" => "",
            "form_action" => "",
            "form_data" => ""
        )
    );
    public function __construct(){
        parent::__construct();

        // Checking login session_status
        if($this->session->userdata('login') == FALSE){
            redirect('account/login');
        }
    }
}