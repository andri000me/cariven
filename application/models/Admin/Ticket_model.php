<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ticket_model extends CI_Model
{

    public $table = 'tickets';
    public $id = 'id';
    public $order = 'ASC';

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
    
    function getTicketByEvent($id)
    {
        $this->db->where('event', $id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function totalQuota($id)
    {
        $this->db->select('SUM(quota) as totalTiket');
        $this->db->where('event', $id);
        return $this->db->get($this->table)->row();
    }

    function ticketByUser($id)
    {
        $this->db->select('u.id,b.event,b.status,b.created_at,e.title,e.type')
                 ->from('users u')
                 ->join('bookings b','u.id = b.user')
                 ->join('events e','b.event = e.id')
                 ->where('b.status','approved')
                 ->where('u.id',$id)
                 ->order_by('b.created_at','DESC');
        return $this->db->get()->result();
    }

}