<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public $table = 'users';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // mengambil semua data admin
    function getAll()
    {
        $this->db->select('*')
                 ->from('users')
                 ->where('role','adm')
                 ->order_by('created_at', $this->order);
        return $this->db->get()->result();
    }

    // mengambil data admin berdasarkan id admin
    function getById($id)
    {
        $this->db->select('*')
                 ->from('users')
                 ->where('id', $id);
        return $this->db->get()->row();
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
}