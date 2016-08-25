<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_order extends CI_Model{

    public function getorderlist(){
        $query = $this->db->query("select o.`*`, u.name 'username', os.name 'statusname' from tsc_order o 
        join mst_profile u on o.userid = u.id 
        join mst_order_status os on o.`status` = os.code");
        return $query->result();
    }

    public function getorder($id){
        $query = $this->db->query("select o.`*`, u.name 'username', os.name 'statusname' from tsc_order o 
        join mst_profile u on o.userid = u.id 
        join mst_order_status os on o.`status` = os.code where tsc.id ='".$id."' limit 1;");
        if($query->num_rows() == 1){
            $data = $query->row(0);
            $data["details"] = array();
            $query2 = $this->db->query("select od.`*`, i.name 'itemname', ods.name 'statusname' from tsc_order_detail od
            join mst_item i on od.itemid = i.id
            join mst_order_detail_status ods on od.`status` = ods.code where od.orderid = '".$data->id."'");
            if($query2->num_rows() > 0){
                $data["details"] = $query2->result();
            }
            return $data;
        }else{
            return null;
        }
    }

    public function isstockenough($itemid, $stockrequested){
        $query = $this->db->query("select s.*, i.itemname from tsc_stock s
        join mst_item i on s.itemid = i.id 
        where i.id = '".$itemid."' order by s.stockdate desc limit 1");
        if($query->num_rows() == 1){
            $data = $query->row(0);
            if($stockrequested > $data->currentstock){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }

    public function form_order_rule(){
        $rule = array(
            array(
                "field" => "id",
                "label" => "id",
                "rules" => ""
            ),
            array(
                "field" => "tagcode",
                "label" => "tagcode",
                "rules" => ""
            ),
            /*array(
                "field" => "itemcount",
                "label" => "itemcount",
                "rules" => ""
            ),
            array(
                "field" => "grandtotal",
                "label" => "grandtotal",
                "rules" => ""
            ),*/
            array(
                "field" => "detail.id[]",
                "label" => "detail.id",
                "rules" => ""
            ),
            array(
                "field" => "detail.itemid[]",
                "label" => "Item",
                "rules" => "required"
            ),
            array(
                "field" => "detail.itemname[]",
                "label" => "Item",
                "rules" => ""
            ),
            array(
                "field" => "detail.total[]",
                "label" => "Total",
                "rules" => "required"
            )
        );
        return $rule;
    }

    // Validation for add form
    public function validate(){
        $form = $this->form_order_rule();
        $this->form_validation->set_rules($form);
        if($this->form_validation->run()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function saveorder(){
        $id = "";
        if($this->input->post("id") != ""){
            $id = $this->input->post("id");
        }else{
            $id = $this->guid->newid();
        }
        $query = $this->db->query("select * from tsc_order where id = '".$id."' limit 1;");
        $details =$this->populatedetails();
        if($query->num_rows() == 0){
            $saveorder = $this->db->query("insert into tsc_order(id,tagcode,userid,itemcount,status,isdelete) 
                values('".$id."','".$this->tagid->newid()."','".$this->input->post("userid")."',
                ".count($details).",'PROC',0)");
            foreach($details as $row){
                $savedetail = $this->db->query("insert into tsc_order_detail(id,orderid,itemid,total,status)
                values('".$row->id."','".$id."','".$row->itemid."',".$row->total.",'".$row->status."')");
            }
        }
    }

    public function populatedetails(){
        $iterasi = count($this->input->post("detail.id[]"));
        $datas = array();
        for($i = 0; $i < $iterasi; $i++){
            $datas[$i] = array(
                "id" => $this->guid->newid(),
                "orderid" => "",
                "itemid" => $this->input->post("detail.itemid[]")[$i],
                "total" => $this->input->post("detail.total[]")[$i],
                "status" => "WT"
            );
        }
        return $datas;
    }

    public function validate_stock(){
        $data = $this->populatedetails();
        foreach($details as $row){
            $stockenough = $this->isstockenough($row->itemid,$row->total);
            if($stockenough == false){
                return false;
            }
        }
        return true;
    }
}