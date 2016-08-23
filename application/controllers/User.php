<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('mod_user', 'mod_user', TRUE);

        $this->model["view"] = "user/add";
        $this->model["data"] = array(
            "title" => "Add User",
            "form_action" => "",
            "form_data" => "",
            "edit" => false,
            "roleoptions" => $this->mod_user->rolelist(),
            "unitoptions" => $this->mod_user->unitlist(),
            "statusoptions" => $this->mod_user->userstatus(),
            "view" => false
        );
    }

    public function index(){
        $this->model["title"] = "User management";
        $this->model["view"] = "user/userlist";
        $this->model["data"] = array(
            "userslist" => $this->mod_user->getuserlist()
        );
        $this->load->view('_layout', $this->model);
    }

    public function add(){
        $this->model["title"] = "Add User";
        $this->model["data"]["form_action"] = "user/edit";
        if($this->input->method() == 'post'){
            if($this->mod_user->validate()){
                if($this->mod_user->isusernameexists()){
                    $this->model["message"] = "Username is exists";
                    $this->model["messageType"] = "danger";
                    $this->load->view("_layout", $this->model);
                }else{
                    $this->mod_user->save_user();
                    $this->model["view"] = "user/userlist";
                    $this->session->set_flashdata('message', 'User successfully saved');
                    $this->session->set_flashdata('messageType', 'success');
                    redirect('user');
                }
            }else{
                $this->load->view("_layout", $this->model);
            }
        }else{
            $this->load->view("_layout", $this->model);
        }
    }

    public function edit($id){
        $this->model["title"] = "Edit User";
        $this->model["data"]["title"] = "Edit User";
        $this->model["data"]["edit"] = true;
        $this->model["data"]["form_action"] = "user/edit";
        if($id == ""){
            $this->session->set_flashdata('message', 'Invalid id');
            $this->session->set_flashdata('messageType', 'warning');
            redirect('user');
        }else{
            if($this->input->method() == 'post'){
                if($this->mod_user->validate2()){
                    if($this->mod_user->matchespassmanual()){
                        $this->mod_user->save_user();
                        $this->model["view"] = "user/userlist";
                        $this->session->set_flashdata('message', 'User successfully saved');
                        $this->session->set_flashdata('messageType', 'success');
                        redirect('user');
                    }else{
                        $this->model["message"] = "Password confirmation missmatch";
                        $this->model["messageType"] = "danger";
                        $this->load->view("_layout", $this->model);
                    }
                }else{
                    $this->load->view("_layout", $this->model);
                }
            }else{
                $userdata = $this->mod_user->getuser($id);
                if($userdata != null){
                    $this->model["data"]["form_data"] = $userdata;
                    $this->load->view("_layout", $this->model);
                }else{
                    $this->session->set_flashdata('message', 'User not found');
                    $this->session->set_flashdata('messageType', 'warning');
                    redirect('user');
                }
            }
        }
    }

    public function view($id){
        $this->model["title"] = "View User";
        $this->model["data"]["title"] = "View User";
        $this->model["data"]["view"] = true;
        if($id == ""){
            $this->session->set_flashdata('message', 'Invalid id');
            $this->session->set_flashdata('messageType', 'warning');
            redirect('user');
        }else{
            $userdata = $this->mod_user->getuser($id);
            if($userdata != null){
                $this->model["data"]["form_data"] = $userdata;
                $this->load->view("_layout", $this->model);
            }else{
                $this->session->set_flashdata('message', 'User not found');
                $this->session->set_flashdata('messageType', 'warning');
                redirect('user');
            }
        }
    }

    public function delete(){
        if($this->input->method() == 'post'){
            if($this->input->post("id") == ""){
                $this->session->set_flashdata('message', 'Invalid data');
                $this->session->set_flashdata('messageType', 'danger');
                redirect('user');
            }else{
                try{
                    $this->mod_user->deleteuser();
                    $this->session->set_flashdata('message', 'Data deleted');
                    $this->session->set_flashdata('messageType', 'success');
                }catch(Exception $ex){
                    $this->session->set_flashdata('message', $ex->getMessage());
                    $this->session->set_flashdata('messageType', 'danger');
                }
                redirect('user');
            }
        }else{
            $this->session->set_flashdata('message', 'Invalid url');
            $this->session->set_flashdata('messageType', 'danger');
            redirect('user');
        }
    }
}