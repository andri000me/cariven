<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News_model extends CI_Model
{

    public $table = 'news';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // mengambil semua data artikel
    function getAll()
    {
        $this->db->select('n.*,nc.name as category_name,u.name as created_by')
                 ->from('news n')
                 ->join('news_category nc','n.category = nc.id')
                 ->join('users u','u.id = n.created_by')
                 ->order_by('n.created_at', $this->order);
        return $this->db->get()->result();
    }

    // mengambil data artikel berdasarkan id
    function getById($id)
    {
        $this->db->select('n.*,c.id as category_id, c.name')
                 ->from('news n')
                 ->join('news_category c','n.category = c.id')
                 ->where('n.id', $id);
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

    // tambah data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // edit data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // hapus data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // mengambil data artikel dengan total lihat paling banyak (Controller - dashboard)
    function getPopularNews()
    {
        $this->db->order_by('views_count', $this->order)
                 ->limit(5);
        return $this->db->get($this->table)->result();
    }

}