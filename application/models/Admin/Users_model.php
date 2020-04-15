<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public $table = 'users';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function get_by_id($id)
    {
        return $this->db->get_where($this->table,['id' => $id])->row();
    }

    // mengambil semua data user
    function getAll()
    {
        $this->db->select('*')
                 ->from('users')
                 ->where_not_in('role',['adm','man'])
                 ->order_by('created_at', $this->order);
        return $this->db->get()->result();
    }

    // mengmabil data user berdasarkan id
    function getById($id)
    {
        return $this->db->get_where('users', [ 'id' => $id])->row();
    }

    // check id 
    function isExistId($id) {
        $this->db->where($this->id, $id);
        $query = $this->db->get($this->table);

        if($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    // mengambil semua user yang paling banyak mengikuti event
    function getTopStatistik()
    {
        $this->db->select('u.id as user_id,u.name, u.phone_number, COUNT(b.user) as jumlah_tiket,
                           b.event,b.status,b.created_at')
                 ->from('users u')
                 ->join('bookings b','u.id = b.user')
                 ->where('b.status','approved')
                 ->group_by('u.id')
                 ->order_by('jumlah_tiket','DESC')
                 ->order_by('b.created_at','ASC')
                 ->limit(6);
        return $this->db->get()->result();
    }

    function countUserThisDay()
    {
        $this->db->select('id')
                 ->from($this->table)
                 ->where('date_format(created_at,"%Y-%m-%d")','CURDATE()',FALSE);
        return $this->db->count_all_results();
    }
}