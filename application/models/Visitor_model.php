<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Visitor_model extends CI_Model
{

    public $table = 'visitors';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function increaseVisitor()
    {
        $visitor_ip = $_SERVER['REMOTE_ADDR'];

        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot(); 
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent='Other';
        }

        $data = array(
            'ip_address' => $visitor_ip,
            'web_browser' => $agent,
        );

        $this->db->select('*')
                 ->from($this->table)
                 ->where('ip_address',$visitor_ip)
                 ->where('DATE(created_at)','CURDATE()',FALSE);
        $cek_ip = $this->db->get()->result();

        if(count($cek_ip) <= 0){
            $this->db->insert($this->table,$data);
        }
        
    }
}