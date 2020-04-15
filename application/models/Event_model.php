<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event_model extends CI_Model
{

    public $table = 'event';
    public $id    = 'event_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }    

    // get all (Controller Home)
    function getAll()
    {
        $this->db->select('e.id, e.title, e.image, e.slug, e.start_time, e.type, 
                           e.end_time, e.status, e.location, p.name as publisher_name,p.image as publisher_image, 
                           ec.name as category_name, c.name as city_name')
                 ->from('events e')
                 ->join('publishers p','e.publisher = p.id')
                 ->join('event_category ec','e.category = ec.id')
                 ->join('cities c','e.city = c.id')
                 ->where('e.status','approved')
                 ->where('e.start_time >', date('Y-m-d'))
                 ->limit(5)
                 ->order_by('e.start_time', 'ASC');
        return $this->db->get()->result();
    }

    function cariEvent($keyword = null, $kategori = null, $kota = null)
    {
        $this->db->select('e.id, e.title, e.image as event_image, e.slug, e.start_time, e.end_time, 
                           e.type, e.city, e.status, e.location, p.name as publisher_name, p.image,
                           ec.name as category_name, c.name as city_name')
                 ->from('events e')
                 ->join('publishers p','e.publisher = p.id')
                 ->join('event_category ec','e.category = ec.id')
                 ->join('cities c','e.city = c.id')
                 ->like('e.title',$keyword)
                 ->like('e.category',$kategori)
                 ->like('e.city',$kota)
                 ->where('e.status','approved')
                 ->where('e.start_time >', date('Y-m-d'))
                 ->order_by('e.start_time', 'ASC');
        return $this->db->get()->result();
    }

    // get tiket by event (Controller Home)
    function getTicketByEvent($id)
    {
        $this->db->where('event', $id);
        $this->db->order_by('created_at','desc');
        return $this->db->get('tickets')->result();
    }
    // USER

    // get data by id (Controller - Booking)
    function get_by_id($id)
    {
        $this->db->select('e.id, e.title, e.start_time, e.end_time, e.image, e.type, e.slug,
                           ec.name as event_category, 
                           p.name as publisher_name, 
                           c.name as city_name')
                 ->from('events e')
                 ->join('publishers p','e.publisher = p.id')
                 ->join('event_category ec','e.category = ec.id')
                 ->join('cities c','e.city = c.id')
                 ->where('e.id', $id);
        return $this->db->get()->row();
    }

    // get data by id (Controller - Slug)
    function get_by_slug($slug)
    {
        $this->db->select('e.*, p.name as publisher_name, ec.name as category_name, c.name as city_name')
                 ->from('events e')
                 ->join('publishers p','e.publisher = p.id')
                 ->join('event_category ec','e.category = ec.id')
                 ->join('cities c','e.city = c.id')
                 ->where('e.slug', $slug);
        return $this->db->get()->row();
    }

    // mengambil semua data event berdasarkan kota
    function getEventByLocation($location)
    {
        $this->db->select('*')
                 ->from('event e')
                 ->join('city c','e.event_city = c.city_id')
                 ->where('c.city_name',$location)
                //  ->where('e.event_status','Disetujui')
                 ->order_by('e.start_date','DESC');
        return $this->db->get()->result();
    }
    
    function getEventByCategory($category)
    {
        $this->db->select('*')
                 ->from('event e')
                 ->join('category c','e.event_category = c.category_id')
                 ->join('city ci','e.event_city = ci.city_id')
                 ->where('c.category_name',$category)
                 //  ->where('e.event_status','Disetujui')
                 ->order_by('e.start_date','DESC');
        return $this->db->get()->result();
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

    // cek user sudah teregistrasi / belum (Controller Home)
    function checkUserRegistered($event_id)
    {
        $ignore = array('rejected','expired');

        $this->db->where('event',$event_id)
                 ->where('user',$this->session->userdata('_id'))
                 ->where_not_in('status',$ignore);
        $query = $this->db->get('bookings');

        if($query->num_rows() > 0) {
            return true;
        }
        return false;
    }
    
    // cek user adalah pemilik event / tidak (Controller Home)
    function checkIsPublisher($publisher_id,$event_id)
    {
        $query = $this->db->select('p.*,e.*')
                          ->from('publishers p')
                          ->join('events e','p.id = e.publisher')
                          ->where('p.id',$publisher_id)
                          ->where('e.id',$event_id)
                          ->get();

        if($query->num_rows() > 0) {
            return true;
        }
        return false;
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('event_id', $q);
        $this->db->or_like('event_category', $q);
        $this->db->or_like('event_name', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('event_id', $q);
        $this->db->or_like('event_category', $q);
        $this->db->or_like('event_name', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

}