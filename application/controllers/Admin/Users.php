<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $models = array(
            'Admin/Users_model' => 'mUser',
            'Admin/Ticket_model' => 'mTiket',
            'Admin/Event_model' => 'mEvent',
        );
        $this->load->model(array($models));
        $this->load->library('form_validation');
    }

    function index()
    {
        $users = $this->mUser->getAll();

        $data = array(
            'title' => 'Users',
            'users_data' => $users,
        );
        $this->load->view('_admin/users/v_user',$data);
    }
    
    function publisher()
    {
        $publishers = $this->db->order_by('created_at','desc')->get('publishers')->result();

        $data = array(
            'title' => 'Users',
            'publishers' => $publishers,
        );

        $this->load->view('_admin/publishers/v_publisher',$data);
    }

    function read($id)
    {
        $row = $this->mUser->getById($id);

        if ($row) {
            $data = array(
                'title'        => 'Users',
                'user_id'      => $row->id,
                'user_name'    => $row->name,
                'user_tel'     => $row->phone_number,
                'user_bio'     => $row->short_bio,
                'user_address' => $row->address,
                'user_image'   => $row->profile_picture,
                'user_email'   => $row->email,
                'joindate'     => $row->created_at,
                'tiket_data'   => $this->mTiket->ticketByUser($id),
                'publisher'  => $this->db->get_where('publishers',['id' => $id])->row(),
                'events_data'  => $this->mEvent->event_publisher($id),
            );
            $this->load->view('_admin/users/v_userDetail',$data);
        } else {
            echo '<script>hostory.go(-1)</script>';
        }
    }

    // blokir dan buka blokir
    function block($id)
    {
        $data['status'] = 0;
        $this->mUser->update($id,$data);
        redirect('admin/peserta');
    }

    function unBlock($id)
    {
        $data['status'] = 1;
        $this->mUser->update($id,$data);
        redirect('admin/peserta');
    }

    // approve and reject as publisher
    function approve($id)
    {
        $data['status'] = 'approved';
        $data['status_description'] = 'OK';
        $this->db->where('id',$id)->update('publishers',$data);
        redirect('admin/peserta/'.$id);
    }
    function reject($id)
    {
        $data['status'] = 'rejected';
        $data['status_description'] = $this->input->post('status_description');
        $this->db->where('id',$id)->update('publishers',$data);
        redirect('admin/peserta/'.$id);
    }
}