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

    // mengambil artikel paling banyak dilihat
    function getPopularNews()
    {
        $this->db->order_by('views_count',$this->order)
                 ->limit(5);
        return $this->db->get($this->table)->result();
    }
    
    // mengambil artikel paling banyak dilihat
    function getLatestNews()
    {
        $this->db->select('n.*,nc.name as category_name,u.name as user_name')
                 ->from('news n')
                 ->join('news_category nc','nc.id = n.category')
                 ->join('users u','n.created_by = u.id')
                 ->order_by('n.created_at',$this->order)
                 ->limit(1);
        return $this->db->get($this->table)->row();
    }

    // mengambil kategori artikel
    function getCategory()
    {
        $this->db->select('nc.id, nc.name, COUNT(n.created_by) AS jumlah_artikel')
                 ->from('news_category nc')
                 ->join('news n','nc.id = n.category','left')
                 ->group_by('nc.id')
                 ->order_by('nc.name', $this->order);
        return $this->db->get()->result();
    }

    // mengambil artikel berdasarkan artikel
    function getByCategory($category_name)
    {
        $this->db->select('n.*,nc.name as category_name,u.name as user_name')
                 ->from('news n')
                 ->join('news_category nc','nc.id = n.category')
                 ->join('users u','n.created_by = u.id')
                 ->where('nc.name', $category_name);
        return $this->db->get()->result();
    }

    // get data by id
    function getBySlug($slug)
    {
        $this->db->select('n.*,nc.name as category_name,u.name as user_name')
                 ->from('news n')
                 ->join('news_category nc','nc.id = n.category')
                 ->join('users u','n.created_by = u.id')
                 ->where('n.slug', $slug);
        return $this->db->get()->row();
    }

    // get data with limit and search
    function get_news($limit,$start)
    {
        $this->db->select('n.*,nc.name as category_name,u.name as user_name')
                 ->from('news n')
                 ->join('news_category nc','nc.id = n.category')
                 ->join('users u','n.created_by = u.id')
                 ->order_by('n.created_at', $this->order)
                 ->limit($limit,$start);
        return $this->db->get()->result();
    }

    // count data
    function countAllNews()
    {
        return $this->db->get('news')->num_rows();
    }


    function search_news($v)
    {
        $this->db->select('n.*,nc.name as category_name,u.name as user_name')
                 ->from('news n')
                 ->join('news_category nc','nc.id = n.category')
                 ->join('users u','n.created_by = u.id')
                 ->order_by('n.id', $this->order)
                 ->like('n.title',$v);
        return $this->db->get()->result();
    }

    // update data
    function increaseReader($id)
    {
        $this->db->where($this->id, $id)
                 ->set('views_count','`views_count`+1',FALSE)
                 ->update($this->table);
    }
}
