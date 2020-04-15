<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inbox extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Admin/Inbox_model','mInbox');
        $this->load->library('form_validation');
    }

    function index()
    {
        $inbox = $this->mInbox->getAll();

        $data = array(
            'title'      => 'Kotak Masuk',
            'inbox_data' => $inbox,
        );
        $this->load->view('_admin/inbox/v_inbox',$data);
    }

    function read($id, $error = null) 
    {
        $row = $this->mInbox->getById($id);
        if ($row->is_read == 0) {
            $data['is_read'] = 1;
            $this->mInbox->update($id,$data);
        }

        if ($row) {
            $data = array(
                'title' => 'Kotak Masuk',
                'inbox' => $row,
                'error' => $error,
            );
            $this->load->view('_admin/inbox/v_inboxDetail',$data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function inboxReply($inbox_id)
    {
        $emailTo  = $this->input->post('email', TRUE);
        $pesan    = $this->input->post('message', TRUE);

        $data = array(
            'reply_message' => $pesan, 
            'reply_by'      => $this->session->userdata('_id'), 
            'replied_at'    => date('Y-m-d H:i:s')
        );

        $this->emailReply($inbox_id,$emailTo,$pesan,$data);
        
    }
    
    public function delete($id) 
    {
        $row = $this->mInbox->getById($id);

        if ($row) {
            $this->mInbox->delete($id);
            $this->session->set_flashdata("email_send","<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Pesan berhasil dihapus</div>"); 
            redirect('admin/pesan-masuk');
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function emailReply($id,$to,$pesan,$data)
    {
        $email_data = [
            'email'   => $to,
            'subject' => 'Balasan email dari cariven',
            'content' => $pesan
        ];
        $this->send_email($email_data);
        $this->mInbox->update($id,$data);

        redirect('admin/pesan-masuk');
    }
}