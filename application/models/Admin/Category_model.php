<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_model extends CI_Model
{

    public $table = 'event_category';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // mengambil semua data kategori
    function getAll()
    {
        $this->db->select('c.*, COUNT(e.category) AS JumlahEvent')
                 ->from('event_category c')
                 ->join('events e','e.category = c.id','left')
                 ->group_by('c.id')
                 ->order_by('c.name', 'ASC');
        return $this->db->get()->result();
    }

    // mengambil data kategori berdasarkan id
    function getById($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
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

    // mengecek kategori yang sudah dipakai event
    function checkUsedCategory($id)
    {
        $this->db->where('category', $id);
        return $this->db->get('events')->num_rows();
    }

    // menghitung jumlah kategori yang digunakan (Controller - Statistik)
    function countCategory()
    {
        $this->db->select('c.id as category_id,c.name, COUNT(e.category) AS jumlah_event,
                           e.created_at')
                 ->from('event_category c')
                 ->join('events e','e.category = c.id')
                 ->group_by('c.id')
                 ->order_by('jumlah_event','DESC')
                 ->limit(10);
        return $this->db->get()->result();
    }
}