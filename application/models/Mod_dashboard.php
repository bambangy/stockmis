<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_dashboard extends CI_Model{
    public function gettotalorder(){
        $query = $this->db->query("
        select count(*) 'res' from tsc_order
        where isdeleted = 0
        ".($this->session->userdata("role") != "Admin"?" and userid='".$this->session->userdata("userid")."';":";"));
        return $query->row(0)->res;
    }

    public function getiteminstock()
    {
        $query = $this->db->query("select count(*) 'res'
        from mst_item i where i.isused = 1 and
        (select s.currentstock from tsc_stock s where s.itemid = i.id order by s.stockdate desc limit 1) > 0");
        return $query->row(0)->res;
    }

    public function getordertaken()
    {
        $query = $this->db->query("
        select count(*) 'res' from tsc_order o
        where (select count(*) from tsc_order_detail where orderid = o.id and status = 'ST') > 0 and o.isdeleted = 0 and o.status <> 'CANCE'
        ".($this->session->userdata("role") != "Admin"?" and userid='".$this->session->userdata("userid")."';":";"));
        return $query->row(0)->res;
    }

    public function getorderwait()
    {
        $query = $this->db->query("
        select count(*) 'res' from tsc_order o
        where (select count(*) from tsc_order_detail where orderid = o.id and status = 'WT') > 0 and o.isdeleted = 0 and o.status <> 'CANCE'
        ".($this->session->userdata("role") != "Admin"?" and userid='".$this->session->userdata("userid")."';":";"));
        return $query->row(0)->res;
    }

    public function getordercanceled()
    {
        $query = $this->db->query("
        select count(*) 'res' from tsc_order o
        where o.isdeleted = 0 and o.status = 'CANCE'
        ".($this->session->userdata("role") != "Admin"?" and userid='".$this->session->userdata("userid")."';":";"));
        return $query->row(0)->res;
    }

    public function getorderlist()
    {
        $query = $this->db->query("
        select o.*, s.name 'statusname', u.name 'username' from tsc_order o
        join mst_order_status s on s.code = o.status
        join mst_profile u on u.id = o.userid
        where o.isdeleted = 0 and month(o.orderdate) = month(curdate()) and year(o.orderdate) = year(curdate())
        ".($this->session->userdata("role") != "Admin"?" and userid='".$this->session->userdata("userid")."'":"")
        ." order by o.orderdate desc limit 10");
        return $query->result();
    }

    public function getstocklist()
    {
        $data = array();
        for($i=1; $i<13; $i++){
            $ordertaken = $this->db->query("
            select count(*) 'res' from tsc_order o
            where (select count(*) from tsc_order_detail where orderid = o.id and status = 'ST') > 0 and o.isdeleted = 0 and o.status <> 'CANCE'
            and (month(o.orderdate) = ".$i." and year(o.orderdate) = year(curdate()))
            ".($this->session->userdata("role") != "Admin"?" and userid='".$this->session->userdata("userid")."';":";"));
            
            $orderwait = $this->db->query("
            select count(*) 'res' from tsc_order o
            where (select count(*) from tsc_order_detail where orderid = o.id and status = 'WT') > 0 and o.isdeleted = 0 and o.status <> 'CANCE'
            and (month(o.orderdate) = ".$i." and year(o.orderdate) = year(curdate()))
            ".($this->session->userdata("role") != "Admin"?" and userid='".$this->session->userdata("userid")."';":";"));

            $ordercanceled = $this->db->query("
            select count(*) 'res' from tsc_order o
            where o.isdeleted = 0 and o.status = 'CANCE'
            and (month(o.orderdate) = ".$i." and year(o.orderdate) = year(curdate()))
            ".($this->session->userdata("role") != "Admin"?" and userid='".$this->session->userdata("userid")."';":";"));

            $ordertotal= $this->db->query("
            select count(*) 'res' from tsc_order o
            where isdeleted = 0
            and (month(o.orderdate) = ".$i." and year(o.orderdate) = year(curdate()))
            ".($this->session->userdata("role") != "Admin"?" and userid='".$this->session->userdata("userid")."';":";"));
            $data[$i-0] = array(
                "y" => date('F', mktime(0, 0, 0, $i, 10)),
                "total" => (int)$ordertotal->row(0)->res,
                "wait" => (int)$orderwait->row(0)->res,
                "taken" => (int)$ordertaken->row(0)->res,
                "canceled" => (int)$ordercanceled->row(0)->res,
            );
        }
        return $data;
    }
}