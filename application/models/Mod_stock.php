<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_stock extends CI_Model{

    public function getstocklist(){
        $query = $this->db->query("select i.*, 
        coalesce((select s.currentstock from tsc_stock s where s.itemid = i.id order by s.stockdate desc limit 1),0) 'currentstock',
        coalesce((select s.stockdate from tsc_stock s where s.itemid = i.id order by s.stockdate desc limit 1),current_timestamp()) 'stockdate'
        from mst_item  i where i.isused = 1");
        return $query->result();
    }

    public function form_stock_rule(){
        $rule = array(
            array(
                "field" => "id",
                "label" => "id",
                "rules" => ""
            ),
            array(
                "field" => "itemid",
                "label" => "Item",
                "rules" => "required"
            ),
            array(
                "field" => "itemname",
                "label" => "Item",
                "rules" => ""
            ),
            array(
                "field" => "currentstock",
                "label" => "Current Stock",
                "rules" => "required"
            ),
            array(
                "field" => "note",
                "label" => "Note",
                "rules" => "required"
            )
        );
        return $rule;
    }

    // Validation for add form
    public function validate(){
        $form = $this->form_stock_rule();
        $this->form_validation->set_rules($form);
        if($this->form_validation->run()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function savestock(){
        $id = "";
        if($this->input->post("id") != ""){
            $id = $this->input->post("id");
        }else{
            $id = $this->guid->newid();
        }
        $this->db->query("insert into tsc_stock(id, itemid, currentstock, note) 
            values('".$id."', '".$this->input->post('itemid')."', ".$this->input->post('currentstock').",
            '".$this->input->post('note')."')");
    }

    public function getstock($id){
        $query = $this->db->query("select s.*, i.itemname from tsc_stock s
        join mst_item i on s.itemid = i.id 
        where i.id = '".$id."' order by s.stockdate desc limit 1");
        if($query->num_rows() == 1){
            return $query->row(0);
        }else{
            return null;
        }
    }
}