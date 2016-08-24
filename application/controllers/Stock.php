<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('mod_stock', 'mod_stock', TRUE);

        $this->model["view"] = "stock/addstock";
        $this->model["data"] = array(
            "title" => "Add Stock",
            "form_action" => "",
            "form_data" => "",
            "edit" => false,
            "view" => false,
        );
    }

    public function index(){
        $this->model["title"] = "Stock List";
        $this->model["view"] = "stock/stocklist";
        $this->model["data"]["stocklist"] = $this->mod_stock->getstocklist();
        $this->load->view('_layout', $this->model);
    }

    public function add(){
        $this->model["title"] = "Add Stock";
        $this->model["data"]["form_action"] = "stock/add";
        if($this->input->method() == 'post'){
            if($this->mod_stock->validate()){
                $this->mod_stock->savestock();
                $this->session->set_flashdata('message', 'Stock successfully added');
                $this->session->set_flashdata('messageType', 'success');
                redirect('stock');
            }else{
                $this->load->view("_layout", $this->model);
            }
        }else{
            $this->load->view("_layout", $this->model);
        }
    }

    public function track($id){
        
    }
}