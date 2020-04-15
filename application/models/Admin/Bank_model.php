<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bank_model extends CI_Model
{

    public $table = 'banks';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // mengambil semua data bank
    function getAll()
    {
        $this->db->select('b.*, COUNT(p.destination_bank) as jumlah')
                 ->from('banks b')
                 ->join('payments p','p.destination_bank = b.id')
                 ->group_by('b.id');
        return $this->db->get()->result_array();
    }

    // mengambil data bank berdasarkan id
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

    // mengecek data bank yang sudah dipakai oleh publisher
    function checkUsedBank($id)
    {
        $this->db->where('destination_bank',$id);
        return $this->db->get('payments')->num_rows();
    }

}