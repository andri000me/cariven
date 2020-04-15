<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event_model extends CI_Model
{

    public $table = 'events';
    public $id    = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // mengambil semua data event
    function getAll()
    {
        $this->db->select('e.id as event_id,e.title,e.start_time,
                           e.status,e.created_at,e.type,p.name')
                 ->from('events e')
                 ->join('publishers p','e.publisher = p.id')
                 ->where_not_in('e.status','draft')
                 ->order_by('e.submitted_time', $this->order);
        return $this->db->get()->result();
    }

    // mengambil data event berdasarkan id
    function getById($id)
    {
        $this->db->select('e.*,p.name as publisher_name,ec.name as category_name,c.name as city_name,u.name as validated_by')
                 ->from('events e')
                 ->join('publishers p','e.publisher = p.id')
                 ->join('event_category ec','e.category = ec.id')
                 ->join('cities c','e.city = c.id')
                 ->join('users u','e.validated_by = u.id','left')
                 ->where('e.id', $id);
        return $this->db->get()->row();
    }

    function event_publisher($publisher)
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

    // persetujuan / penolakan event
    function approval($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
    
    // update data
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

    // mengambil event terbaru (Controller - dashboard)
    function getLatestEvent()
    {
        $this->db->select('e.id as event_id, e.title, e.start_time, e.created_at, p.name')
                 ->from('events e')
                 ->join('publishers p','p.id = e.publisher')
                 ->where('e.status','approved')
                 ->limit(5)
                 ->order_by('e.created_at', $this->order);
        return $this->db->get()->result();
    }

    // menghitung semua event yang sudah disetujui
    function getApproved()
    {
        $this->db->where('status','approved');
        return $this->db->get($this->table)->result();
    }

    // menghitung event yang dibuat hari ini
    function countEventThisDay()
    {
        $status = array('submitted','approved');
        $this->db->select('id')
                 ->from($this->table)
                 ->where('date_format(created_at,"%Y-%m-%d")','CURDATE()',FALSE)
                 ->where_in('status',$status);
        return $this->db->count_all_results();
    }

    // count penjualan tiket start
    function sellPerTiket($event_id)
    {
        $include = array('booking','paid','approved');
        $this->db->select('t.id as ticket_id,t.name as ticket_name,t.price,t.quota,
                           COUNT(b.ticket) AS Terjual')
                 ->from('bookings b')
                 ->join('events e','b.event = e.id')
                 ->join('tickets t','b.ticket = t.id')
                 ->group_by('t.id')
                 ->where_in('b.status',$include)
                 ->where('e.id',$event_id);
        return $this->db->get()->result();
    }

    // count event (Controller - Statistik, Dashboard)
    function countAllEvent()
    {
        $this->db->select('id')
                 ->from($this->table);
        return $this->db->count_all_results();
    }

    // event dengan peserta terbanyak (Controller - Statistik)
    function getTopPeserta()
    {
        $this->db->select('e.id as event_id, e.title, e.start_time,COUNT(b.id) AS jumlah_peserta')
                 ->from('events e')
                 ->join('bookings b','e.id = b.event')
                 ->where('e.status','approved')
                 ->where('b.status','approved')
                 ->group_by('e.id')
                 ->order_by('jumlah_peserta','DESC');
        return $this->db->get()->result();
    }

    // event dengan pendapatan terbanyak (Controller - Statistik)
    function getTopPendapatan()
    {
        $this->db->select('e.id as event_id, e.title, e.start_time,
                           SUM(t.price) AS jumlah_pendapatan')
                 ->from('events e')
                 ->join('bookings b','e.id = b.event')
                 ->join('tickets t','b.ticket  = t.id')
                 ->where('e.status','approved')
                 ->where('b.status','approved')
                 ->group_by('e.id')
                 ->order_by('jumlah_pendapatan','DESC');
        return $this->db->get()->result();
    }

    // mengambil semua event berdasarkan publisher (Controller - Publishers)
    function eventByPub($id)
    {
        $this->db->select('p.pub_id, e.event_name,e.event_status,e.event_created,e.event_type')
                 ->from('publishers p')
                 ->join('event e','p.pub_id = e.event_pub')
                 ->where('e.event_pub',$id)
                 ->order_by('e.event_created','ASC');
        return $this->db->get()->result();
    }

    // withdraw
    public function getAllWithdraw()
    {
        $this->db->select('w.id, p.name, e.title, e.total_income, e.start_time, w.status, w.status_description')
                 ->from('events e')
                 ->join('publishers p', 'p.id = e.publisher')
                 ->join('withdraws w', 'w.event = e.id')
                 ->order_by('w.created_at','DESC');
        return $this->db->get()->result_array();
    }

    public function getWithdrawById($withdraw_id)
    {
        $this->db->where('id',$withdraw_id);
        return $this->db->get('withdraws')->row_array();
    }
    
    public function getWithdrawByEvent($withdraw_id)
    {
        $this->db->where('id',$withdraw_id);
        return $this->db->get('withdraws')->row_array();
    }

    public function getHistoryPaymentByEvent($event_id)
    {
        $this->db->select('b.id, u.name as user_name, ph.ticket_price, ph.fee_admin, ph.final_price');
        $this->db->from('payment_history ph');
        $this->db->join('bookings b','b.id = ph.booking_id');
        $this->db->join('users u','u.id = b.user');
        $this->db->where('ph.event',$event_id);
        return $this->db->get()->result_array();
    }

    function updateWithdrawStatus($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('withdraws', $data);
    }

}