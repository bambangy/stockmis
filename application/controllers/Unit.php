<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('mod_unit', 'mod_unit', TRUE);

        $this->model["view"] = "unit/add";
        $this->model["data"] = array(
            "title" => "Add Unit",
            "form_action" => "",
            "form_data" => "",
            "edit" => false,
            "view" => false
        );
    }

    public function index(){
        $this->model["title"] = "Unit List";
        $this->model["view"] = "unit/unitlist";
        $this->model["data"]["unitlist"] = $this->mod_unit->getunitlist();
        $this->load->view('_layout', $this->model);
    }

    public function add(){
        $this->model["title"] = "Add Unit";
        $this->model["data"]["form_action"] = "unit/add";
        if($this->input->method() == 'post'){
            if($this->mod_unit->validate()){
                if($this->mod_unit->isnameexists()){
                    $this->model["message"] = "Unit name is exists";
                    $this->model["messageType"] = "danger";
                    $this->load->view("_layout", $this->model);
                }else{
                    $this->mod_unit->saveunit();
                    $this->session->set_flashdata('message', 'Unit successfully saved');
                    $this->session->set_flashdata('messageType', 'success');
                    redirect('unit');
                }
            }else{
                $this->load->view("_layout", $this->model);
            }
        }else{
            $this->load->view("_layout", $this->model);
        }
    }

    public function edit($id = ""){
        $this->model["title"] = "Edit Unit";
        $this->model["data"]["title"] = "Edit Unit";
        $this->model["data"]["edit"] = true;
        $this->model["data"]["form_action"] = "unit/edit";
        if($this->input->method() == 'post'){
            if($this->mod_unit->validate()){
                if($this->mod_unit->isnameexistsbefore()){
                    $this->model["message"] = "Unit name is exists";
                    $this->model["messageType"] = "danger";
                    $this->load->view("_layout", $this->model);
                }else{
                    $this->mod_unit->saveunit();
                    $this->session->set_flashdata('message', 'Unit successfully saved');
                    $this->session->set_flashdata('messageType', 'success');
                    redirect('unit');
                }
            }else{
                $this->load->view("_layout", $this->model);
            }
        }else{
            if($id == ""){
                $this->session->set_flashdata('message', 'Invalid id');
                $this->session->set_flashdata('messageType', 'warning');
                redirect('unit');
            }else{
                $userdata = $this->mod_unit->getunit($id);
                if($userdata != null){
                    $this->model["data"]["form_data"] = $userdata;
                    $this->load->view("_layout", $this->model);
                }else{
                    $this->session->set_flashdata('message', 'Unit not found');
                    $this->session->set_flashdata('messageType', 'warning');
                    redirect('unit');
                }
            }
        }
    }

    public function view($id){
        $this->model["title"] = "View Unit";
        $this->model["data"]["title"] = "View Unit";
        $this->model["data"]["view"] = true;
        if($id == ""){
            $this->session->set_flashdata('message', 'Invalid id');
            $this->session->set_flashdata('messageType', 'warning');
            redirect('unit');
        }else{
            $userdata = $this->mod_unit->getunit($id);
            if($userdata != null){
                $this->model["data"]["form_data"] = $userdata;
                $this->load->view("_layout", $this->model);
            }else{
                $this->session->set_flashdata('message', 'User not found');
                $this->session->set_flashdata('messageType', 'warning');
                redirect('unit');
            }
        }
    }

    public function delete(){
        if($this->input->method() == 'post'){
            if($this->input->post("id") == ""){
                $this->session->set_flashdata('message', 'Invalid data');
                $this->session->set_flashdata('messageType', 'danger');
                redirect('unit');
            }else{
                try{
                    $this->mod_unit->deleteunit();
                    $this->session->set_flashdata('message', 'Data deleted');
                    $this->session->set_flashdata('messageType', 'success');
                }catch(Exception $ex){
                    $this->session->set_flashdata('message', $ex->getMessage());
                    $this->session->set_flashdata('messageType', 'danger');
                }
                redirect('unit');
            }
        }else{
            $this->session->set_flashdata('message', 'Invalid url');
            $this->session->set_flashdata('messageType', 'danger');
            redirect('unit');
        }
    }
}