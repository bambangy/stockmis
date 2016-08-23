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

    }

    public function edit($id){
        
    }

    public function view($id){
        
    }

    public function delete(){
        
    }
}