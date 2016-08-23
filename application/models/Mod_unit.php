<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_unit extends CI_Model{

    public function getunitlist(){
        $query = $this->db->query("select * from mst_unit;");
        return $query->result();
    }

    public function form_user_rule(){
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
            )
        );
        return $rule;
    }

    // Validation for add form
    public function validate(){
        $form = $this->form_user_rule();
        $this->form_validation->set_rules($form);
        if($this->form_validation->run()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function isnameexists(){
        $check = $this->db->query("select * from mst_unit where name = '".$this->input->post('name')."'");
        if($check->num_rows() == 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function isnameexistsbefore(){
        $check = $this->db->query("select * from mst_unit where name = '".$this->input->post('name')."' 
        and id <> '".$this->input->post('id')."'");
        if($check->num_rows() == 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function saveunit(){
        $id = "";
        if($this->input->post("id") != ""){
            $id = $this->input->post("id");
        }else{
            $id = $this->guid->newid();
        }
        $check = $this->db->query("select * from mst_unit where id = '".$id."'");
        if($check->num_rows() == 0){
            $this->db->query("insert into mst_unit(id, code, name) 
            values('".$id."', '".$this->input->post('code')."', '".$this->input->post('name')."')");
        }else{
            $this->db->query("update mst_unit set  
                code = '".$this->input->post('code')."', 
                name =  '".$this->input->post('name')."'
                where id = '".$id."'");
        }
    }

    public function getunit($id){
        $query = $this->db->query("select * from mst_unit where id = '".$id."' limit 1;");
        if($query->num_rows() == 1){
            return $query->row(0);
        }else{
            return null;
        }
    }

    public function deleteunit(){
        $this->db->query("delete from mst_unit where id = '".$this->input->post("id")."'");
    }
}