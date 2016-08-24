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
            "view" => false
        );
    }
}