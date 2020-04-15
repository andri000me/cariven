<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inbox_model extends CI_Model
{

    public $table = 'inboxes';

    function __construct()
    {
        parent::__construct();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

}