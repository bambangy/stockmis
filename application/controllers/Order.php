<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('mod_order', 'mod_order', TRUE);

        $this->model["view"] = "order/addorder";
        $this->model["data"] = array(
            "title" => "Add Order",
            "form_action" => "",
            "form_data" => "",
            "edit" => false,
            "view" => false,
        );
    }

    public function index(){
        $this->model["title"] = "Order List";
        $this->model["view"] = "order/orderlist";
        $this->model["data"]["orderlist"] = $this->mod_order->getorderlist();
        $this->load->view('_layout', $this->model);
    }

    public function add(){

    }

    public function view(){
        
    }

    public function delete(){
        
    }
}