<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("mod_dashboard","mod_dashboard",true);
    }

    public function index(){
        $this->model["title"] = "Dashboard";
        $this->model["view"] = "dashboard";
        $this->model["data"] = (object)[];
        $this->model["data"]->dashdata = (object)[];
        $this->model["data"]->dashdata->totalorder = $this->mod_dashboard->gettotalorder();
        $this->model["data"]->dashdata->totalstock = $this->mod_dashboard->getorderwait();
        $this->model["data"]->dashdata->totalordertaken = $this->mod_dashboard->getordertaken();
        $this->model["data"]->dashdata->totalordercanceled = $this->mod_dashboard->getordercanceled();
        $this->model["data"]->dashdata->orderlist = $this->mod_dashboard->getorderlist();
        $this->load->view('_layout', $this->model);
    }

    public function graphdata(){
        header('Content-Type: application/json');
        echo json_encode($this->mod_dashboard->getstocklist());
    }
}