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
            "form_data" => array(
                "details" => array()
            ),
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
        $this->model["title"] = "Add Order";
        $this->model["data"]["form_action"] = "order/add";
        if($this->input->method() == 'post'){
            if($this->mod_order->validate_stock()){
                $this->mod_order->saveorder();
                $this->session->set_flashdata('message', 'Order successfully added');
                $this->session->set_flashdata('messageType', 'success');
                redirect('order');
            }else{
                $this->model["data"]["form_data"] = $this->mod_order->populatetoform();
                $this->session->set_flashdata('message', $this->mod_order->message);
                $this->session->set_flashdata('messageType', 'danger');
                $this->load->view("_layout", $this->model);
            }
        }else{
            $this->load->view("_layout", $this->model);
        }
    }

    public function view(){
        
    }

    public function delete(){
        
    }
}