<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inbox_model extends CI_Model
{

    public $table = 'inboxes';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // mengambil semua data inbox
    function getAll()
    {
        $this->db->order_by('created_at', $this->order);
        return $this->db->get($this->table)->result();
    }

    // mengambil inbox berdasarkan id
    function getById($id)
    {
        $this->db->select('i.*,u.id as user_id,u.name as admin_name')
                 ->from('inboxes i')
                 ->join('users u','u.id = i.reply_by','left')
                 ->where('i.id', $id);
        return $this->db->get()->row();
    }

    // mengambil pesan terbaru (Controller - Dashboard)
    function getLatestInbox()
    {
        $this->db->where('is_read',0)
                 ->order_by('created_at', $this->order)
                 ->limit(5);
        return $this->db->get($this->table)->result();
    }


    // edit data
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

}