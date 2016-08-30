<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_order extends CI_Model{
    public $message = "";
    public $data = array(
        "tagcode" => "",
        "id" => "",
        "userid" => "",
        "orderdate" => "",
        "itemcount" => "",
        "grandtotal" => "",
        "status" => "",
        "username" => "",
        "statusname" => "",
        "details" => array()
    );
    public $dataDetails = array(
        "id" => "",
        "orderid" => "",
        "itemid" => "",
        "total" => "",
        "status" => "",
        "itemname" => "",
        "statusname" => ""
    );
    public function __conctruct(){
        parent::__construct();
    }

    public function getorderlist(){
        $query = $this->db->query("select o.`*`, u.name 'username', os.name 'statusname' from tsc_order o 
        join mst_profile u on o.userid = u.id 
        join mst_order_status os on o.`status` = os.code".($this->session->userdata("role") == "Admin" ? ";" : " where userid='".$this->session->userdata("userid")."' and isdeleted = 0;" ));
        return $query->result();
    }

    public function getorder($id){
        $query = $this->db->query("select o.`*`, u.name 'username', os.name 'statusname' from tsc_order o 
        join mst_profile u on o.userid = u.id 
        join mst_order_status os on o.`status` = os.code where o.id ='".$id."' limit 1;");
        if($query->num_rows() == 1){
            $data = $query->row(0);
            $query2 = $this->db->query("select od.`*`, i.stockunit 'piece', i.name 'itemname', ods.name 'statusname' 
            from tsc_order_detail od
            join mst_item i on od.itemid = i.id
            join mst_order_detail_status ods on od.`status` = ods.code where od.orderid = '".$data->id."';");
            if($query2->num_rows() > 0){
                $data->details = $query2->result();
            }
            return $data;
        }else{
            return null;
        }
    }

    public function isstockenough($itemid, $stockrequested){
        $query = $this->db->query("select s.*, i.name from tsc_stock s
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
            /*array(
                "field" => "id",
                "label" => "id",
                "rules" => ""
            ),
            array(
                "field" => "tagcode",
                "label" => "tagcode",
                "rules" => ""
            ),
            array(
                "field" => "itemcount",
                "label" => "itemcount",
                "rules" => ""
            ),
            array(
                "field" => "grandtotal",
                "label" => "grandtotal",
                "rules" => ""
            ),
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
            )*/
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
        $details = $this->populatedetails();
        if($query->num_rows() == 0){
            $saveorder = $this->db->query("insert into tsc_order(id,tagcode,userid,itemcount,status,isdeleted) 
                values('".$id."','".$this->tagid->newid(8)."','".$this->session->userdata("userid")."',
                ".count($details).",'PROC',0)");
            foreach($details as $row){
                $stockData = $this->getstock($row["itemid"]);

                $savedetail = $this->db->query("insert into tsc_order_detail(id,orderid,itemid,total,status)
                values('".$row["id"]."','".$id."','".$row["itemid"]."',".$row["total"].",'".$row["status"]."')");

                $this->db->query("insert into tsc_stock(id, itemid, currentstock, orderdetailid, note) 
                values('".$this->guid->newid()."', '".$row["itemid"]."', ".($stockData->currentstock - $row["total"]).",
                '".$row["id"]."','order detail')");
            }
        }
    }

    public function cancelorder($id){
        $query = $this->db->query("update tsc_order set
        status = 'CANCE'
        where id = '".$id."';");
        $query2 = $this->db->query("select od.`*`, i.stockunit 'piece', i.name 'itemname', ods.name 'statusname' 
        from tsc_order_detail od
        join mst_item i on od.itemid = i.id
        join mst_order_detail_status ods on od.`status` = ods.code where od.orderid = '".$id."';");
        if($query2->num_rows() > 0){
            foreach($query2->result() as $row){
                $stockData = $this->getstock($row->itemid);
                $this->db->query("insert into tsc_stock(id, itemid, currentstock, orderdetailid, note) 
                values('".$this->guid->newid()."', '".$row->itemid."', ".($stockData->currentstock + $row->total).",
                '".$row->id."','order detail')");
            }
        }
    }

    public function deleteorder($id){
        $query = $this->db->query("update tsc_order set
        isdeleted = 1
        where id = '".$id."';");
        $query2 = $this->db->query("select od.`*`, i.stockunit 'piece', i.name 'itemname', ods.name 'statusname' 
        from tsc_order_detail od
        join mst_item i on od.itemid = i.id
        join mst_order_detail_status ods on od.`status` = ods.code
        join tsc_order o on o.id = od.orderid where od.orderid = '".$id."' and (o.status <> 'CANCE' and o.status <> 'DONE');");
        if($query2->num_rows() > 0){
            foreach($query2->result() as $row){
                $stockData = $this->getstock($row->itemid);
                $this->db->query("insert into tsc_stock(id, itemid, currentstock, orderdetailid, note) 
                values('".$this->guid->newid()."', '".$row->itemid."', ".($stockData->currentstock + $row->total).",
                '".$row->id."','order detail')");
            }
        }
    }

    public function takeorder($id){
        $this->db->query("update tsc_order_detail set
        status = 'ST'
        where id='".$id."';");
        $query = $this->db->query("select * from tsc_order_detail where id = '".$id."' limit 1;");
        if($query->num_rows() == 1){
            $data = $query->row(0);
            $query1 = $this->db->query("select * from tsc_order_detail where orderid = '".$data->orderid."';");
            $query2 = $this->db->query("select * from tsc_order_detail where orderid = '".$data->orderid."' and status = 'ST';");
            if($query1->num_rows() == $query2->num_rows()){
                $this->db->query("update tsc_order set
                status = 'DONE'
                where id = '".$data->orderid."';");
            }
        }
    }

    public function populatedetails(){
        $datas = array();
        $i = 0;
        foreach($this->input->post("detailitemid[]") as $row){
            $datas[$i] = array(
                "id" => $this->guid->newid(),
                "orderid" => "",
                "itemid" => $this->input->post("detailitemid[]")[$i],
                "total" => $this->input->post("detailtotal[]")[$i],
                "status" => "WT",
                "itemname" => $this->input->post("detailitemname[]")[$i],
                "limit" => $this->input->post("detailitemlimit[]")[$i],
                "unit" => $this->input->post("detailitemunit[]")[$i]
            );
            $i++;
        }
        return $datas;
    }

    public function populatetoform(){
        $data = $this->populatedetails();
        $i = 0;
        foreach($data as $row){
            $stockData = $this->getstock($row["itemid"]);
            $this->data["details"][$i] = array(
                "id" => "",
                "orderid" => "",
                "itemid" => $row["itemid"],
                "total" => $row["total"],
                "status" => $row["status"],
                "itemname" => $row["itemname"],
                "statusname" => "",
                "limit" => $stockData->currentstock,
                "unit" => $row["unit"]
            );
            $i++;
        }
        return $this->data;
    }

    public function validate_stock(){
        $data = $this->populatedetails();
        foreach($data as $row){
            $stockData = $this->getstock($row["itemid"]);
            if($row["total"] > 0){
                $stockenough = $this->isstockenough($row["itemid"],$row["total"]);
                if($stockenough == false){
                    $this->message = "Stock of ".$stockData->name." not enough.";
                    return false;
                }
            }else{
                $this->message = "Order of item ".$stockData->name." must filled, at least 1.";
                return false;
            }
        }
        return true;
    }

    public function getstock($id){
        $query = $this->db->query("select s.*, i.name from tsc_stock s
        join mst_item i on s.itemid = i.id 
        where i.id = '".$id."' order by s.stockdate desc limit 1");
        if($query->num_rows() == 1){
            return $query->row(0);
        }else{
            return null;
        }
    }
}