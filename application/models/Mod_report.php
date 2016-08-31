<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_report extends CI_Model{
    public function userlist(){
        $query = $this->db->query("select * from mst_profile");
        $list = array(
            "" => "Select User"
        );
        foreach($query->result() as $row){
            $list[$row->id] = $row->name;
        }
        return $list;
    }

    public function orderreport(){
        $userid = $this->input->get("userid");
        $sdate = $this->input->get("sdate");
        $edate = $this->input->get("edate");
        $userq = "";
        if($userid == null || $userid == "" || $userid == "all"){
            $userq .= ";";
        }else{
            $userq .= " and o.userid = '".$userid."';";
        }

        $query = $this->db->query("");
    }
}