<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class City_model extends CI_Model
{

    public $table = 'cities';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // mengambil semua data kota
    function getAll()
    {
        $this->db->select('c.*, COUNT(e.city) AS JumlahEvent')
                 ->from('cities c')
                 ->join('events e','e.city = c.id','left')
                 ->group_by('c.id')
                 ->order_by('c.name','ASC');
        return $this->db->get()->result();
    }

    // mengambil semua data kota berdasarkan id
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

    // mengecek kota yang sudah dipakai oleh event
    function checkusedCity($id)
    {
        $this->db->where('city',$id);
        return $this->db->get('events')->num_rows();
    }
    
    // menghitung jumlah kota yang digunakan (Controller - Statistik)
    function countCity()
    {
        $this->db->select('c.id as city_id,c.name,COUNT(e.city) AS jumlah_event,e.created_at')
                 ->from('cities c')
                 ->join('events e','e.city = c.id')
                 ->group_by('c.id')
                 ->order_by('jumlah_event','DESC')
                 ->limit(10);
        return $this->db->get()->result();
    }

}