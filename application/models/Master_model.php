<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // mengambil semua data kota (Controller Home)
    function getAllCity()
    {
        $this->db->select('c.id, c.name, COUNT(e.city) AS events')
                 ->from('cities c')
                 ->join('events e','e.city = c.id')
                  ->where('e.status','approved')
                 ->group_by('c.id')
                 ->order_by('events','DESC');
        return $this->db->get()->result();
    }

    // mengambil semua data kategori event (Controller Home)
    function getAllCategory()
    {
        $this->db->select('c.id,c.name,COUNT(e.category) AS events')
                 ->from('event_category c')
                 ->join('events e','e.category = c.id')
                  ->where('e.status','Disetujui')
                 ->group_by('c.id')
                 ->order_by('events', 'DESC');
        return $this->db->get()->result();
    }

    // get all category (Controller Home)
    function getCategory()
    {
        $this->db->order_by('name','ASC');
        return $this->db->get('event_category')->result();
    }

    // get all category (Controller Home)
    function getCity()
    {
        $this->db->order_by('name','ASC');
        return $this->db->get('cities')->result();
    }

    function getAllLocation()
    {
        $this->db->select('c.city_id, c.city_name, COUNT(e.event_city) AS JumlahEvent')
                 ->from('event e')
                 ->join('city c','e.event_city = c.city_id','right')
                //  ->where('e.event_status','Disetujui')
                 ->group_by('c.city_id')
                 ->order_by('JumlahEvent','DESC');
        return $this->db->get()->result();
    }
    
    function getAllTags()
    {
        $this->db->select('c.category_id,c.category_name,COUNT(e.event_category) AS JumlahEvent')
                 ->from('category c')
                 ->join('event e','e.event_category = c.category_id','left')
                //   ->where('e.event_status','Disetujui')
                 ->group_by('c.category_id')
                 ->order_by('JumlahEvent', 'DESC');
        return $this->db->get()->result();
    }

}
?>