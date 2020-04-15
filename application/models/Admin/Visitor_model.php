<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Visitor_model extends CI_Model
{

    public $table = 'visitors';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function visitorGraph()
    {
        $query = $this->db->query("SELECT DATE_FORMAT(created_at,'%d') AS tanggal,
                    COUNT(ip_address) AS jumlah FROM visitors 
                    WHERE MONTH(created_at)=MONTH(CURDATE()) 
                    GROUP BY DATE(created_at)");
        $hasil = [];
        foreach($query->result() as $data){
            $hasil[] = $data;
        }
        return $hasil;
    }

    function countAll()
    {
        return $this->db->count_all($this->table);
    }

    function getChrome()
    {
        $this->db->where('web_browser','Chrome');
        return $this->db->get($this->table)->result();
    }
    function getOpera()
    {
        $this->db->where('web_browser','Opera');
        return $this->db->get($this->table)->result();
    }
    function getFirefox()
    {
        $this->db->where('web_browser','Firefox');
        return $this->db->get($this->table)->result();
    }
    function getOther()
    {
        $ignore = array('Chrome','Opera','Firefox');
        $this->db->where_not_in('web_browser',$ignore);
        return $this->db->get($this->table)->result();
    }

}