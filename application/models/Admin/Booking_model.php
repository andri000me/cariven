<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Booking_model extends CI_Model
{

    public $table = 'booking';
    public $id = 'booking_id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->select('*')
                 ->from('booking b')
                 ->join('event e','b.booking_event = e.event_id')
                 ->join('publishers p','p.pub_id = e.event_pub')
                 ->join('users u','u.user_id = b.booking_user')
                 ->order_by('b.booking_id', $this->order);
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('e.id as event_id,e.title,e.start_time,e.end_time,e.address,
                           c.name as city_name,
                           b.ticket,b.id,b.status as booking_status,b.qrcode,
                           u.id as user_id,u.name,
                           a.attend,a.takeOf_certificate')
                 ->from('bookings b')
                 ->join('events e','e.id = b.event')
                 ->join('cities c','e.city = c.id')
                 ->join('users u','u.id = b.user')
                 ->join('attendance a','a.booking_id = b.id','left')
                 ->where('b.id', $id);
        return $this->db->get()->row();
    }

     // get all peserta by event
     function getPesertaByEvent($id)
     {
         $this->db->select('b.*,u.name as user_name,t.name as ticket_name')
                  ->from('bookings b')
                  ->join('users u','u.id = b.user')
                  ->join('tickets t','t.id = b.ticket')
                  ->where('b.event',$id)
                  ->where('b.status','approved')
                  ->order_by('b.created_at', 'ASC');
         return $this->db->get()->result();
     }

    //  ambil detail pembayaran
    function getPaymentBooking($event_id)
    {
        $this->db->select('*')
                 ->from('payments p')
                 ->join('banks ba','ba.id = p.destination_bank')
                 ->join('bookings b','p.booking_id = b.id')
                 ->where('b.event',$event_id);
        return $this->db->get()->result();
    }

    public function get_all_payment()
    {
        $this->db->select('p.id, p.booking_id, p.created_at, b.bank_name, 
                           bo.status, u.name as user_name, e.title')
                 ->from('payments p')
                 ->join('banks b','b.id = p.destination_bank')
                 ->join('bookings bo','bo.id = p.booking_id')
                 ->join('users u','u.id = bo.user')
                 ->join('events e','e.id = bo.event')
                 ->order_by('p.created_at','DESC');
        return $this->db->get()->result_array();
    }

    public function get_payment_by_id($payment_id)
    {
        $this->db->select('p.id,p.booking_id,p.account_name,p.image,p.created_at,
                           b.bank_name,b.account_name,b.account_number,p.message,
                           bo.status,u.name as user_name,u.phone_number,e.title,
                           t.name as ticket_name, t.price, t.id')
                 ->from('payments p')
                 ->join('banks b','b.id = p.destination_bank')
                 ->join('bookings bo','bo.id = p.booking_id')
                 ->join('users u','u.id = bo.user')
                 ->join('events e','e.id = bo.event')
                 ->join('tickets t','bo.ticket = t.id')
                 ->where('p.id',$payment_id)
                 ->order_by('created_at','DESC');
        return $this->db->get()->row_array();
    }

    // (Controller Payment)
    function update($table,$booking_id,$data)
    {
        $this->db->where('id',$booking_id);
        $this->db->update($table,$data);
    }
}