<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Booking_model extends CI_Model
{

    public $table = 'bookings';
    public $id    = 'id';
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

    // get all
    function get_all_peserta_by_event($id)
    {
        $this->db->select('*')
                 ->from('booking b')
                 ->join('users u','u.user_id = b.booking_user')
                 ->join('event e','e.event_id = b.booking_event')
                 ->where('b.booking_event',$id)
                 ->order_by('b.booking_created', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // get data by id (Controller - ManageEvent, Booking)
    function get_by_id($id)
    {
        $this->db->select('e.id as event_id,b.ticket,b.id,b.status as booking_status,u.name,a.attend,a.takeOf_certificate')
                 ->from('bookings b')
                 ->join('events e','e.id = b.event')
                 ->join('users u','u.id = b.user')
                 ->join('attendance a','a.booking_id = b.id','left')
                 ->where('b.id', $id);
        return $this->db->get()->row();
    }
 
    // Ambil data tiket yang dipesan (Controller - Booking)
    function getTiket($ticket_id)
    {
        $this->db->where('ticket_id', $ticket_id);
        return $this->db->get('tickets')->row();
    }

    // Update tiket kuota (Controller - Booking)
    function updateTiket($ticket_id, $data)
    {
        $this->db->where('id', $ticket_id);
        $this->db->update('tickets', $data);
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

    // (Controller - ManageEvent)
    function data_kedatangan($event_id)
    {
        $this->db->select('b.id, b.event, b.user, a.attend,
                           a.attend_time, u.id, u.name')
                 ->from('bookings b')
                 ->join('users u','u.id = b.user')
                 ->join('attendance a','a.booking_id = b.id')
                 ->where('a.attend',1)
                 ->where('b.event',$event_id);
        return $this->db->get()->result();
    }

    // (Controller - ManageEvent)
    function data_sertifikat($event_id)
    {
        $this->db->select('b.id as booking_id, b.event, b.user, a.takeOf_certificate,
                           a.certificate_time, u.name')
                 ->from('bookings b')
                 ->join('users u','u.id = b.user')
                 ->join('attendance a','a.booking_id = b.id','left')
                 ->where('a.takeOf_certificate',1)
                 ->where('b.event',$event_id);
        return $this->db->get()->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
    
    function insert_attendance($data)
    {
        $this->db->insert('attendance', $data);
    }
    
    function update_attendance($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('attendance', $data);
    }

    // update data (Controller - ManageEvent, Payment)
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    
    function data_kadaluarsa_by_user($id_user)
    {
        $this->db->where('booking_status','Dipesan')
                 ->where('booking_user',$id_user);
        return $this->db->get($this->table)->result();
    }
    
    // (Controller - Home)
    function setExpired($id)
    {
        $this->db->where($this->id,$id)
                 ->set('status','expired')
                 ->update($this->table);
    }

}