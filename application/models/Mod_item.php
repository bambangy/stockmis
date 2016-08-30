<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_item extends CI_Model{
    
    public function getitempiece(){
        return array(
            "" => "Choose Piece",
            "kg" => "kg",
            "gr" => "gr",
            "Pack" => "Pack",
            "PCS" => "PCS",
            "Liter" => "Liter"
        );
    }

    public function getitemlist(){
        $query = $this->db->query("select * from mst_item");
        return $query->result();
    }

    public function getitemlist2(){
        $query = $this->db->query("select * from mst_item where isused = 1");
        return $query->result();
    }

    public function form_item_rule(){
        $rule = array(
            array(
                "field" => "id",
                "label" => "id",
                "rules" => ""
            ),
            array(
                "field" => "code",
                "label" => "Code",
                "rules" => ""
            ),
            array(
                "field" => "name",
                "label" => "Name",
                "rules" => "required"
            ),
            array(
                "field" => "stockunit",
                "label" => "stockunit",
                "rules" => "required"
            ),
            array(
                "field" => "isused",
                "label" => "Status",
                "rules" => "required"
            )
        );
        return $rule;
    }

    // Validation for add form
    public function validate(){
        $form = $this->form_item_rule();
        $this->form_validation->set_rules($form);
        if($this->form_validation->run()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function isnameexists(){
        $check = $this->db->query("select * from mst_item where name = '".$this->input->post('name')."'");
        if($check->num_rows() == 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function isnameexistsbefore(){
        $check = $this->db->query("select * from mst_item where name = '".$this->input->post('name')."' 
        and id <> '".$this->input->post('id')."'");
        if($check->num_rows() == 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function saveitem(){
        $id = "";
        if($this->input->post("id") != ""){
            $id = $this->input->post("id");
        }else{
            $id = $this->guid->newid();
        }
        $check = $this->db->query("select * from mst_item where id = '".$id."'");
        if($check->num_rows() == 0){
            $this->db->query("insert into mst_item(id, code, name, stockunit, isused) 
            values('".$id."', '".$this->input->post('code')."', '".$this->input->post('name')."'
            , '".$this->input->post('stockunit')."', ".$this->input->post('isused').")");
        }else{
            $this->db->query("update mst_item set  
                code = '".$this->input->post('code')."', 
                name =  '".$this->input->post('name')."',
                stockunit = '".$this->input->post('stockunit')."',
                isused = ".$this->input->post('isused')."
                where id = '".$id."'");
        }
    }

    public function getitem($id){
        $query = $this->db->query("select * from mst_item where id = '".$id."' limit 1;");
        if($query->num_rows() == 1){
            return $query->row(0);
        }else{
            return null;
        }
    }

    public function deleteitem(){
        $this->db->query("delete from mst_item where id = '".$this->input->post("id")."'");
    }
}