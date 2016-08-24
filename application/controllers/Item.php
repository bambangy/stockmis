<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('mod_item', 'mod_item', TRUE);

        $this->model["view"] = "item/additem";
        $this->model["data"] = array(
            "title" => "Add Item",
            "form_action" => "",
            "form_data" => "",
            "edit" => false,
            "view" => false,
            "pieceoptions" => $this->mod_item->getitempiece()
        );
    }

    public function index(){
        $this->model["title"] = "Item List";
        $this->model["view"] = "item/itemlist";
        $this->model["data"]["itemlist"] = $this->mod_item->getitemlist();
        $this->load->view('_layout', $this->model);
    }

    public function add(){
        $this->model["title"] = "Add Item";
        $this->model["data"]["form_action"] = "item/add";
        if($this->input->method() == 'post'){
            if($this->mod_item->validate()){
                if($this->mod_item->isnameexists()){
                    $this->model["message"] = "Item name is exists";
                    $this->model["messageType"] = "danger";
                    $this->load->view("_layout", $this->model);
                }else{
                    $this->mod_item->saveitem();
                    $this->session->set_flashdata('message', 'Item successfully saved');
                    $this->session->set_flashdata('messageType', 'success');
                    redirect('item');
                }
            }else{
                $this->load->view("_layout", $this->model);
            }
        }else{
            $this->load->view("_layout", $this->model);
        }
    }

    public function edit($id = ""){
        $this->model["title"] = "Edit Item";
        $this->model["data"]["title"] = "Edit Item";
        $this->model["data"]["edit"] = true;
        $this->model["data"]["form_action"] = "item/edit";
        if($this->input->method() == 'post'){
            if($this->mod_item->validate()){
                if($this->mod_item->isnameexistsbefore()){
                    $this->model["message"] = "Item name is exists";
                    $this->model["messageType"] = "danger";
                    $this->load->view("_layout", $this->model);
                }else{
                    $this->mod_item->saveitem();
                    $this->session->set_flashdata('message', 'Item successfully saved');
                    $this->session->set_flashdata('messageType', 'success');
                    redirect('item');
                }
            }else{
                $this->load->view("_layout", $this->model);
            }
        }else{
            if($id == ""){
                $this->session->set_flashdata('message', 'Invalid id');
                $this->session->set_flashdata('messageType', 'warning');
                redirect('item');
            }else{
                $userdata = $this->mod_item->getitem($id);
                if($userdata != null){
                    $this->model["data"]["form_data"] = $userdata;
                    $this->load->view("_layout", $this->model);
                }else{
                    $this->session->set_flashdata('message', 'Item not found');
                    $this->session->set_flashdata('messageType', 'warning');
                    redirect('item');
                }
            }
        }
    }

    public function view($id = ""){
        $this->model["title"] = "View Item";
        $this->model["data"]["title"] = "View Item";
        $this->model["data"]["view"] = true;
        if($id == ""){
            $this->session->set_flashdata('message', 'Invalid id');
            $this->session->set_flashdata('messageType', 'warning');
            redirect('item');
        }else{
            $userdata = $this->mod_item->getitem($id);
            if($userdata != null){
                $this->model["data"]["form_data"] = $userdata;
                $this->load->view("_layout", $this->model);
            }else{
                $this->session->set_flashdata('message', 'Item not found');
                $this->session->set_flashdata('messageType', 'warning');
                redirect('item');
            }
        }
    }

    public function delete(){
        if($this->input->method() == 'post'){
            if($this->input->post("id") == ""){
                $this->session->set_flashdata('message', 'Invalid data');
                $this->session->set_flashdata('messageType', 'danger');
                redirect('item');
            }else{
                try{
                    $this->mod_item->deleteitem();
                    $this->session->set_flashdata('message', 'Data deleted');
                    $this->session->set_flashdata('messageType', 'success');
                }catch(Exception $ex){
                    $this->session->set_flashdata('message', $ex->getMessage());
                    $this->session->set_flashdata('messageType', 'danger');
                }
                redirect('item');
            }
        }else{
            $this->session->set_flashdata('message', 'Invalid url');
            $this->session->set_flashdata('messageType', 'danger');
            redirect('item');
        }
    }
}