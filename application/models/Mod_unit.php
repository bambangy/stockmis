<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_unit extends CI_Model{
    
    public function getunitlist(){
        $query = $this->db->query("select * from mst_unit;");
        return $query->result();
    }
}