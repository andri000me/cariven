<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_model extends CI_Model
{

    public $table = 'payments';
    public $id    = 'id';
    public $order = 'DESC';

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