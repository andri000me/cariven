<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function isExistId($id) {
        $this->db->where($this->id, $id);
        $query = $this->db->get($this->table);

        if($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

}