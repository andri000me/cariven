<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bank_model extends CI_Model
{

    public $table = 'bank';
    public $id    = 'bank_id';

    function __construct()
    {
        parent::__construct();
    } 

    public function get_all()
    {
        $this->db->order_by('bank_name');
        return $this->db->get('banks')->result();
    }
}
?>