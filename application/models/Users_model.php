<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends MY_Model
{

    public $table = 'users';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id (Controller - manageEvent, Booking, Users)
    function get_by_id($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    // get data by id  (Controller - Auth)
    function getByLoginId($id_akun)
    {
        $this->db->select('*')
                 ->from('users u')
                 ->join('login l', 'l.login_id = u.user_login')
                 ->where('u.user_login', $id_akun);
        return $this->db->get()->row();
    }


    // get list event user registered (Controller - Home)
    function userRegisterEvent($user_id)
    {
        $this->db->select('e.*, b.*')
                 ->from('bookings b')
                 ->join('events e','e.id = b.event')
                 ->where('b.user',$user_id)
                 ->where('b.status','approved')
                 ->order_by('b.created_at', $this->order);
        return $this->db->get()->result();
    }

    // semua data event yang diikuti user (Controller - Users)
    function getEventByUser($user_id)
    {
        $this->db->select('e.id as event_id, e.title, e.start_time, e.end_time, e.image, e.type,
                           b.id as booking_id, b.status,
                           t.name as ticket_name, 
                           ec.name as category_name, 
                           c.name as city_name')
                 ->from('bookings b')
                 ->join('events e','e.id = b.event')
                 ->join('tickets t','t.id = b.ticket')
                 ->join('event_category ec','ec.id = e.category')
                 ->join('cities c','c.id = e.city')
                 ->where('b.user',$user_id)
                 ->order_by('b.created_at', $this->order);
        return $this->db->get()->result();
    }

    // detail payment ticket in event (Controller - Users)
    function getPaymentByBookingId($booking_id)
    {
        $this->db->select('p.*')
                 ->from('bookings b')
                 ->join('payments p','p.booking_id = b.id')
                 ->where('b.id',$booking_id);
        return $this->db->get()->row();
    }


    // detail booking ticket in event (Controller - Users)
    function getBookingById($booking_id)
    {
        $this->db->select('e.title, e.type, e.start_time, e.end_time, e.image, e.location, b.*, c.name as city_name, u.name as user_name')
                 ->from('bookings b')
                 ->join('events e','e.id = b.event')
                 ->join('cities c','e.city = c.id')
                 ->join('users u','u.id = b.user')
                 ->where('b.id',$booking_id);
        return $this->db->get()->row();
    }

    function insert($data)
    {
        $this->db->insert($this->table,$data);
    }
    
    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
}