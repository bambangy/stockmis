<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_category extends CI_Model{
    public function getcatlist(){
        $query = $this->db->query("select c.*,p.name 'parentname', p.id 'parentid' from mst_category c left join mst_category p on c.parent = p.id ;");
        return $query->result();
    }

    public function form_unit_rule(){
        $rule = array(
            array(
                "field" => "id",
                "label" => "id",
                "rules" => ""
            ),
            array(
                "field" => "parent",
                "label" => "parent",
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
        $form = $this->form_unit_rule();
        $this->form_validation->set_rules($form);
        if($this->form_validation->run()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function isnameexists(){
        $check = $this->db->query("select * from mst_category where name = '".$this->input->post('name')."'");
        if($check->num_rows() == 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function isnameexistsbefore(){
        $check = $this->db->query("select * from mst_category where name = '".$this->input->post('name')."' 
        and id <> '".$this->input->post('id')."'");
        if($check->num_rows() == 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function savecat(){
        $id = "";
        if($this->input->post("id") != ""){
            $id = $this->input->post("id");
        }else{
            $id = $this->guid->newid();
        }
        $parent = null;
        if($this->input->post("parent") != ""){
            $parent = $this->input->post("parent");
        }
        $check = $this->db->query("select * from mst_category where id = '".$id."'");
        if($check->num_rows() == 0){
            $this->db->query("insert into mst_category(id, parent, name) 
            values('".$id."', ".($parent==null?"null":"'".$parent."'").", '".$this->input->post('name')."')");
        }else{
            $this->db->query("update mst_category set  
                parent = ".($parent==null?"null":"'".$parent."'").", 
                name =  '".$this->input->post('name')."'
                where id = '".$id."'");
        }
    }

    public function getcat($id){
        $query = $this->db->query("select * from mst_category where id = '".$id."' limit 1;");
        if($query->num_rows() == 1){
            return $query->row(0);
        }else{
            return null;
        }
    }

    public function deletecat(){
        $this->db->query("delete from mst_category where id = '".$this->input->post("id")."'");
    }

    public function catoptionlist($id = null){
        $query;
        if($id == null){
            $query = $this->db->query("
                select * from mst_category
            ");
        }else{
            $query = $this->db->query("
                select * from mst_category where id <> '".$id."'
            ");
        }

        $list = array(
            "" => "Select Parent"
        );
        foreach($query->result() as $row){
            $list[$row->id] = $row->name;
        }
        return $list;
    }
}