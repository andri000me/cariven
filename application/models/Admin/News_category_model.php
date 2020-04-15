<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News_category_model extends CI_Model
{

    public $table = 'news_category';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // mengambil semua data kategori berita (Controller - News Category, News)
    function getAll()
    {
        $this->db->select('nc.*, COUNT(n.category) AS JumlahArtikel')
                 ->from('news_category nc')
                 ->join('news n','n.category = nc.id','left')
                 ->group_by('nc.id')
                 ->order_by('nc.name', 'ASC');
        return $this->db->get()->result();
    }

    // mengambil data kategori berita berdasarkan id
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

    // mengecek kategori artikel yang sudah dipakai news
    function checkUsedNewsCategory($id)
    {
        $this->db->where('category', $id);
        return $this->db->get('news')->num_rows();
    }

}