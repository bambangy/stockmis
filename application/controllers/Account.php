<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller{
    public $model = array(
        "message" => "",
        "messageType" => ""
    );

    public function __construct(){
        parent::__construct();
        $this->load->model('mod_account', 'mod_account', TRUE);
    }

    public function login(){
        // If user already login
        if($this->session->userdata('login') == TRUE){
            redirect('dashboard');
        }else{ // If user not yet login
            
            // Check validation 
            // If REQUEST POST
            if($this->input->method() == 'post'){
                if($this->mod_account->login_validate()){
                    switch($this->mod_account->login_pwd()){
                        case 0:
                            $this->model["message"] = "User not found";
                            $this->model["messageType"] = "danger";
                            $this->load->view('login', $this->model);
                            break;
                        case 1:
                            redirect('dashboard');
                            break;
                        case 2:
                            $this->model["message"] = "Password not match";
                            $this->model["messageType"] = "danger";
                            $this->load->view('login', $this->model);
                            break;
                        default:
                            $this->model["message"] = "Wrong parameter";
                            $this->model["messageType"] = "warning";
                            $this->load->view('login', $this->model);
                            break;
                    }
                }else{
                    $this->load->view('login');
                }
            }else{ // If REQUEST GET
                $this->load->view('login');
            }
        }
    }

    public function logout(){
        $this->mod_account->logout();
        redirect('account/login');
    }
}