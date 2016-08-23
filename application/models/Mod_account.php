<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_account extends CI_Model{
    public $tbl_user = "mst_user";
    public $tbl_profile = "mst_profile";

    public function form_login_rules(){
        $form_rules = array(
            array(
                "field" => "username",
                "label" => "Username",
                "rules" => "required"
            ),
            array(
                "field" => "password",
                "label" => "Password",
                "rules" => "required"
            )
        );
        return $form_rules;
    }

    // Validation for login form
    public function login_validate(){
        $form = $this->form_login_rules();
        $this->form_validation->set_rules($form);
        if($this->form_validation->run()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    // Login with password
    public function login_pwd(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $query = $this->db->query("select u.id, u.username, u.hashpassword, u.isactive,
        (select r.name from mst_role r where r.id = u.roleid) 'role', p.name, p.position  
        from mst_user u join mst_profile p on u.id = p.id 
        where u.username = '".$username."' limit 1;");
        if($query->num_rows() == 1){
            $firstOrDefault = $query->row(0);
            if (password_verify($password, $firstOrDefault->hashpassword)) {
                $data = array(
                    "username" => $firstOrDefault->username,
                    "role" => $firstOrDefault->role,
                    "name"=> $firstOrDefault->name,
                    "position" => $firstOrDefault->position,
                    "login" => TRUE
                );
                $this->session->set_userdata($data);
                return 1;
            } else {
                return 2;
            }
        }else{
            return 0;
        }
    }

    public function logout(){
        $this->session->unset_userdata(array(
            "username" => "",
            "role" => "",
            "name"=> "",
            "position" => "",
            "login" => FALSE
        ));
        $this->session->sess_destroy();
    }
}