<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inbox extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Inbox_model','mInbox');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('v_contact');
    }

    public function sendInbox()
    {
        $data = array(
            'name'    => trim($this->input->post('name', true)),
            'email'   => trim($this->input->post('email', true)),
            'content' => trim($this->input->post('message', true)),
        );

        $this->mInbox->insert($data);
        $this->session->set_flashdata('msg-success', 'Pesan berhasil dikirim, Terimakasih');
        redirect('hubungi-kami');
    }
}
