<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_user extends CI_Model{
    public $options = [
        'cost' => 11
    ];
    public $tbl_user = "mst_user";
    public $tbl_profile = "mst_profile";

    public function getuserlist(){
        $query = $this->db->query("select
            u.id, u.username, u.roleid, (select r.name from mst_role r where r.id = u.roleid) 'rolename',
            p.name, p.position, p.nip, p.title, coalesce(p.unitid,'') 'unitid', (select un.name from mst_unit un where un.id = coalesce(p.unitid,'')) 'unitname', u.isactive
            from mst_user u join mst_profile p on u.id = p.id;");
        return $query->result();
    }

    public function rolelist(){
        $query = $this->db->query("select * from mst_role");
        $list = array(
            "" => "Select Role"
        );
        foreach($query->result() as $row){
            $list[$row->id] = $row->name;
        }
        return $list;
    }

    public function unitlist(){
        $query = $this->db->query("select * from mst_unit");
        $list = array(
            "" => "Select Unit"
        );
        foreach($query->result() as $row){
            $list[$row->id] = $row->name;
        }
        return $list;
    }

    public function form_user_rule(){
        $rule = array(
            array(
                "field" => "id",
                "label" => "id",
                "rules" => ""
            ),
            array(
                "field" => "status",
                "label" => "Status",
                "rules" => ""
            ),
            array(
                "field" => "username",
                "label" => "Username",
                "rules" => "required"
            ),
            array(
                "field" => "password",
                "label" => "Password",
                "rules" => "required"
            ),
            array(
                "field" => "confirmpassword",
                "label" => "Confirm Password",
                "rules" => "matches[password]"
            ),
            array(
                "field" => "name",
                "label" => "Name",
                "rules" => "required"
            ),
            array(
                "field" => "roleid",
                "label" => "Role",
                "rules" => "required"
            ),
        );
        return $rule;
    }

    public function form_user_rule2(){
        $rule = array(
            array(
                "field" => "id",
                "label" => "id",
                "rules" => ""
            ),
            array(
                "field" => "status",
                "label" => "Status",
                "rules" => ""
            ),
            array(
                "field" => "username",
                "label" => "Username",
                "rules" => "required"
            ),
            array(
                "field" => "name",
                "label" => "Name",
                "rules" => "required"
            ),
            array(
                "field" => "roleid",
                "label" => "Role",
                "rules" => "required"
            ),
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

    // Validation for edit
    public function validate2(){
        $form = $this->form_user_rule2();
        $this->form_validation->set_rules($form);
        if($this->form_validation->run()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function matchespassmanual(){
        if($this->input->post("password") != ""){
            return $this->input->post("password") == $this->input->post("confirmpassword");
        }else{
            return true;
        }
    }

    public function save_user(){
        $id = "";
        if($this->input->post("id") != ""){
            $id = $this->input->post("id");
        }else{
            $id = $this->guid->newid();
        }
        $unitid = ($this->input->post('unitid') == "") ? "null" : "'".$this->input->post('unitid')."'";
        $hashed = password_hash($this->input->post("password"), PASSWORD_BCRYPT, $this->options);
        $check = $this->db->query("select * from mst_profile where id = '".$id."'");
        if($check->num_rows() == 0){
            $this->db->query("insert into mst_profile(id, unitid, name, position, title, nip) 
            values('".$id."', ".$unitid.", '".$this->input->post('name')."', '', '', '')");
            $this->db->query("insert into mst_user(id, roleid, username, hashpassword, isactive) 
            values('".$id."', '".$this->input->post('roleid')."', '".$this->input->post('username')."', '".$hashed."', 
            ".$this->input->post('status').")");
        }else{
            $this->db->query("update mst_profile set  
                unitid = ".$unitid.", 
                name =  '".$this->input->post('name')."'
                where id = '".$id."'");
            if($this->input->post("password") == ""){
                $this->db->query("update mst_user set
                    roleid = '".$this->input->post('roleid')."',
                    isactive = ".$this->input->post('status')."
                    where id = '".$id."'");
            }else{
                $this->db->query("update mst_user set
                    roleid = '".$this->input->post('roleid')."',
                    isactive = ".$this->input->post('status').",
                    hashpassword = '".$hashed."'
                    where id = '".$id."'");
            }
        }
    }

    public function isusernameexists(){
        $check = $this->db->query("select * from mst_user where username = '".$this->input->post('username')."'");
        if($check->num_rows() == 0){
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function getuser($id){
        $query = $this->db->query("select
            u.id, u.username, u.roleid,
            p.name, coalesce(p.unitid,'') 'unitid', u.isactive
            from mst_user u join mst_profile p on u.id = p.id where p.id = '".$id."' limit 1;");
        if($query->num_rows() == 1){
            return $query->row(0);
        }else{
            return null;
        }
    }

    public function userstatus(){
        return array(
            1 => "Active",
            0 => "Inactive"
        );
    }

    public function deleteuser(){
        $this->db->query("delete from mst_user where id = '".$this->input->post("id")."'");
        $this->db->query("delete from mst_profile where id = '".$this->input->post("id")."'");
    }
}