<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ticket_model extends CI_Model
{

    public $table = 'tickets';
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

    // get data by id
    function get_by_id($event_id,$id)
    {
        $this->db->select('t.id as ticket_id, t.*, b.*')
                 ->from('tickets t')
                 ->join('bookings b','t.id = b.ticket','left')
                 ->where('t.id', $id)
                 ->where('t.event',$event_id);
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
    
    // get data by id
    function getTiketByEventId($id)
    {
        $this->db->where('event', $id);
        $this->db->order_by('created_at','desc');
        return $this->db->get($this->table)->result();
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

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // (Controller - Home)
    function addedOne($id)
    {
        $this->db->where($this->id,$id)
                 ->set('quota','`quota`+1',FALSE)
                 ->update($this->table);
    }

}