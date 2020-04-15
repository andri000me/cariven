<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Publishers_model extends CI_Model
{

    public $table = 'publishers';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // mengambil semua data publisher
    function getAll()
    {
        $this->db->select('*')
                 ->from('publishers')
                 ->order_by('created_at', $this->order);
        return $this->db->get()->result();
    }

    // mengambil data publisher berdasarkan id
    function getById($id)
    {
        $this->db->select('*')
                 ->from('publishers p')
                 ->join('login l','l.login_id = p.pub_login','left')
                 ->where('p.pub_id', $id);
        return $this->db->get()->row();
    }

    // mengecek ketersediaan id
    function isExistId($id) {
        $this->db->where($this->id, $id);
        $query = $this->db->get($this->table);

        if($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    // mengambil data publisher yang paling banyak mengelola event (Controller - Statistik)
    function getTopStatistik()
    {
        $this->db->select('p.id as pub_id, p.name, p.business_number, COUNT(e.publisher) AS jumlah_event, e.title, e.status,e.created_at,e.type')
                 ->from('publishers p')
                 ->join('events e','p.id = e.publisher')
                 ->where('e.status','approved')
                 ->group_by('p.id')
                 ->order_by('jumlah_event','DESC')
                 ->order_by('e.created_at','ASC')
                 ->limit(6);
        return $this->db->get()->result();
    }

    function countPubThisDay()
    {
        $this->db->select('id')
                 ->from($this->table)
                 ->where('date_format(created_at,"%Y-%m-%d")','CURDATE()',FALSE);
        return $this->db->count_all_results();
    }
}