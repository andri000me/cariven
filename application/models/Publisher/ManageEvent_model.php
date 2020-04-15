<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ManageEvent_model extends CI_Model
{

    public $table = 'events';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all (Controller ManageEvent)
    function get_all_event($publisher)
    {
        $this->db->select('e.id, e.title, e.image, e.start_time, e.end_time, e.type, e.status, 
                           p.name, ec.name as category_name')
                 ->from('events e')
                 ->join('publishers p','e.publisher = p.id')
                 ->join('event_category ec','e.category = ec.id')
                 ->where('e.publisher', $publisher)
                 ->order_by('e.created_at', $this->order);
        return $this->db->get()->result();
    }

     // get all category (Controller ManageEvent)
     function getCategory()
     {
         $this->db->order_by('category_name','ASC');
         return $this->db->get('category')->result();
     }

     // get all city (Controller ManageEvent)
     function getCity()
     {
         $this->db->order_by('city_name','ASC');
         return $this->db->get('city')->result();
     }

    // get all peserta in table booking (Controller ManageEvent)
    function getConfirmPayment($event_id)
    {
        $this->db->select('b.id')
                 ->from('bookings b')
                 ->join('users u','u.id = b.user')
                 ->where('b.event',$event_id)
                 ->where('b.status','approved')
                 ->order_by('b.created_at', $this->order);
        return $this->db->get()->result();
    }
    
    function getRegistrant($event_id)
    {
        $this->db->select('b.id,u.name,b.created_at,b.status,e.type')
                 ->from('bookings b')
                 ->join('users u','u.id = b.user')
                 ->join('events e','e.id = b.event')
                 ->where('b.event',$event_id)
                 ->order_by('b.created_at', $this->order);
        return $this->db->get()->result();
    }

    // (Controller ManageEvent)
    function getPesertaByEvent($event_id)
    {
        $this->db->select('b.id,b.created_at,b.status,u.name,u.phone_number,e.type,a.attend,a.attend_time')
                 ->from('bookings b')
                 ->join('users u','u.id = b.user')
                 ->join('events e','e.id = b.event')
                 ->join('attendance a','a.booking_id = b.id','left')
                 ->where('b.event',$event_id)
                 ->where('b.status','approved')
                 ->order_by('b.created_at', $this->order);
        return $this->db->get()->result();
    }

    // (Controller ManageEvent)
    function getPaymentBooking($event_id)
    {
        $this->db->select('p.booking_id,p.account_name as payment_nameacc,p.message,p.image,
                           ba.bank_name,ba.account_name,ba.account_number')
                 ->from('payments p')
                 ->join('bookings b','p.booking_id = b.id')
                 ->join('banks ba','p.destination_bank = ba.id')
                 ->where('b.event',$event_id);
        return $this->db->get()->result();
    }

    // get data by id (Controller ManageEvent)
    function get_by_id($id)
    {
        $this->db->select('e.*, p.name as pub_name, c.name as city_name, ec.name')
                 ->from('events e')
                 ->join('publishers p','e.publisher = p.id')
                 ->join('event_category ec','e.category = ec.id')
                 ->join('cities c','e.city = c.id')
                 ->where('e.id', $id)
                 ->where('e.publisher', $this->session->userdata('_id'));
        return $this->db->get()->row();
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

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // (Controller ManageEvent)
    function updateBooking($booking_id,$data)
    {
        $this->db->where('booking_id',$booking_id);
        $this->db->update('booking',$data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // total booking start (Controller ManageEvent)
    function countTotalPendaftar($event_id)
    {
        $this->db->select('b.id')
                 ->from('bookings b')
                 ->join('events e','b.event = e.id')
                 ->where('e.id', $event_id);
        return $this->db->count_all_results();
    }

    // (Controller ManageEvent)
    function countByStatus($event_id, $status)
    {
        $this->db->select('b.id')
                 ->from('bookings b')
                 ->join('events e','b.event = e.id')
                 ->where('b.status', $status)
                 ->where('e.id', $event_id);
        return $this->db->count_all_results();
    }

    //(Controller ManageEvent)
    function countKehadiran($event_id)
    {
        $this->db->select('b.id')
                 ->from('bookings b')
                 ->join('events e','b.event = e.id')
                 ->join('attendance a','a.booking_id = b.id')
                 ->where('a.attend', 1)
                 ->where('e.id', $event_id);
        return $this->db->count_all_results();
    }
    // total booking end

    // count penjualan tiket start (Controller ManageEvent)
    function penjualanPerTiket($event_id)
    {
        $include = array('booking','paid','approved');
        $this->db->select('t.id, t.name as ticket_name,t.price,t.quota,
                           b.id,b.event,COUNT(b.ticket) AS Terjual,
                           e.id')
                 ->from('bookings b')
                 ->join('events e','b.event = e.id','right')
                 ->join('tickets t','b.ticket = t.id','right')
                 ->group_by('t.id')
                 ->where_in('b.status',$include)
                 ->where('e.id',$event_id);
        return $this->db->get()->result();
    }

    // (Controller ManageEvent)
    function penjualanSemuaTiket($event_id)
    {
        $include = array('booking','paid','approved');
        $this->db->select('t.name as ticket_name,t.price,t.quota,
                           b.event,COUNT(b.ticket) AS Terjual')
                 ->from('bookings b')
                 ->join('events e','b.event = e.id')
                 ->join('tickets t','b.ticket = t.id')
                 ->group_by('t.id')
                 ->where_in('b.status',$include)
                 ->where('e.id',$event_id);
        return $this->db->get()->result();
    }
    // count penjualan tiket end

    // Withdraw
    public function insertWithdraw($data)
    {
        $this->db->insert('withdraws',$data);
    }

    public function getDataCashOut($event_id)
    {
        $this->db->select('SUM(fee_admin) as fee, SUM(ticket_price) as total');
        $this->db->from('payment_history');
        $this->db->where('event', $event_id);
        return $this->db->get()->row_array();
    }

}