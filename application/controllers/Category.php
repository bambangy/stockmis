<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("mod_category","mod_category",true);

        $this->model["view"] = "category/catadd";
        $this->model["data"] = array(
            "title" => "Add Category",
            "form_action" => "",
            "form_data" => "",
            "edit" => false,
            "view" => false
        );
        $this->model["catoptions"] = $this->mod_category->catoptionlist(null);
    }

    public function index(){
        $this->model["title"] = "Category List";
        $this->model["view"] = "category/catlist";
        $this->model["data"]["catlist"] = $this->mod_category->getcatlist();
        $this->load->view('_layout', $this->model);
    }

    public function add(){
        $this->model["title"] = "Add Category";
        $this->model["data"]["form_action"] = "category/add";
        if($this->input->method() == 'post'){
            if($this->mod_category->validate()){
                if($this->mod_category->isnameexists()){
                    $this->model["message"] = "Category name is exists";
                    $this->model["messageType"] = "danger";
                    $this->load->view("_layout", $this->model);
                }else{
                    $this->mod_category->savecat();
                    $this->session->set_flashdata('message', 'Category successfully saved');
                    $this->session->set_flashdata('messageType', 'success');
                    redirect('category');
                }
            }else{
                $this->load->view("_layout", $this->model);
            }
        }else{
            $this->load->view("_layout", $this->model);
        }
    }

    public function edit($id = ""){
        $this->model["title"] = "Edit Category";
        $this->model["data"]["title"] = "Edit Category";
        $this->model["data"]["edit"] = true;
        $this->model["data"]["form_action"] = "category/edit";
        if($this->input->method() == 'post'){
            if($this->mod_category->validate()){
                if($this->mod_category->isnameexistsbefore()){
                    $this->model["message"] = "Category name is exists";
                    $this->model["messageType"] = "danger";
                    $this->load->view("_layout", $this->model);
                }else{
                    $this->mod_category->savecat();
                    $this->session->set_flashdata('message', 'Category successfully saved');
                    $this->session->set_flashdata('messageType', 'success');
                    redirect('category');
                }
            }else{
                $this->load->view("_layout", $this->model);
            }
        }else{
            if($id == ""){
                $this->session->set_flashdata('message', 'Invalid id');
                $this->session->set_flashdata('messageType', 'warning');
                redirect('category');
            }else{
                $userdata = $this->mod_category->getcat($id);
                $this->model["catoptions"] = $this->mod_category->catoptionlist($id);
                if($userdata != null){
                    $this->model["data"]["form_data"] = $userdata;
                    $this->load->view("_layout", $this->model);
                }else{
                    $this->session->set_flashdata('message', 'category not found');
                    $this->session->set_flashdata('messageType', 'warning');
                    redirect('category');
                }
            }
        }
    }

    public function view($id){
        $this->model["title"] = "View Category";
        $this->model["data"]["title"] = "View Category";
        $this->model["data"]["view"] = true;
        if($id == ""){
            $this->session->set_flashdata('message', 'Invalid id');
            $this->session->set_flashdata('messageType', 'warning');
            redirect('category');
        }else{
            $userdata = $this->mod_category->getcat($id);
            $this->model["catoptions"] = $this->mod_category->catoptionlist($id);
            if($userdata != null){
                $this->model["data"]["form_data"] = $userdata;
                $this->load->view("_layout", $this->model);
            }else{
                $this->session->set_flashdata('message', 'Category not found');
                $this->session->set_flashdata('messageType', 'warning');
                redirect('category');
            }
        }
    }

    public function delete(){
        if($this->input->method() == 'post'){
            if($this->input->post("id") == ""){
                $this->session->set_flashdata('message', 'Invalid data');
                $this->session->set_flashdata('messageType', 'danger');
                redirect('category');
            }else{
                try{
                    $this->mod_category->deletecat();
                    $this->session->set_flashdata('message', 'Data deleted');
                    $this->session->set_flashdata('messageType', 'success');
                }catch(Exception $ex){
                    $this->session->set_flashdata('message', $ex->getMessage());
                    $this->session->set_flashdata('messageType', 'danger');
                }
                redirect('category');
            }
        }else{
            $this->session->set_flashdata('message', 'Invalid url');
            $this->session->set_flashdata('messageType', 'danger');
            redirect('category');
        }
    }
}