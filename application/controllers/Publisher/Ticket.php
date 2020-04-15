<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ticket extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Publisher/Ticket_model', 'mTiket');
        $this->load->library('form_validation');
    }

    function create()
    {
        $data = [
            'event' => trim($this->input->post('event', true)),
            'name' => trim($this->input->post('name', true)),
            'description' => trim($this->input->post('description', true)),
            'quota' => trim($this->input->post('quota', true)),
            'price' => trim($this->input->post('price', true)),
        ];
        $this->mTiket->insert($data);
        redirect(site_url('manage/' .$this->input->post('event', true).'/tiket'));
    }

    public function update($event_id, $id)
    {
        $row = $this->mTiket->get_by_id($event_id, $id);

        if ($row) {
            $data = array(
                'event' => trim($this->input->post('event', true)),
                'name' => trim($this->input->post('name', true)),
                'description' => trim($this->input->post('description', true)),
                'quota' => trim($this->input->post('quota', true)),
                'price' => trim($this->input->post('price', true)),
            );
    
            $this->db->where('id',$id)->update('tickets',$data);
            redirect('manage/' .$this->input->post('event', true).'/tiket');
        } else {
            echo "<script>history.go(-1)</script>";
        }        
    }

    public function delete($event_id,$id)
    {
        $row = $this->mTiket->get_by_id($event_id,$id);

        if ($row) {
            $this->db->where('id',$id)->delete('tickets');
            redirect('manage/' . $event_id.'/tiket');
        } else {
            echo "<script>history.go(-1)</script>";
        }

    }
}