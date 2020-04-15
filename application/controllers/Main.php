<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $models = array(
            'Visitor_model' => 'mVisitor',
            'Event_model'   => 'mEvent',
            'Booking_model' => 'mBooking',
            'Users_model'   => 'mUser',
            'Master_model'   => 'mMaster',
            'Publisher/Ticket_model'     => 'mTiket',
            'Publisher/Publishers_model' => 'mPub',
        );
        $this->load->model($models);
        $this->mVisitor->increaseVisitor();
    }

    function index()
    {
        $data = array(
            'event_data'    => $this->mEvent->getAll(),
            'kategori_data' => $this->mMaster->getCategory(),
            'kota_data'     => $this->mMaster->getCity(),
            'listkota'      => $this->mMaster->getAllCity(),
            'listkategori'  => $this->mMaster->getAllCategory(),
            'publisher'     => $this->mPub->getTopPublisher(),
            'berita'        => $this->db->order_by('created_at','desc')->limit(2)->get('news')->result_array()
        );

        $this->load->view('v_home',$data);
    }

    function search_event()
    {
        $keyword  = $this->input->get('keyword');
        $category = $this->input->get('kategori');
        $city     = $this->input->get('kota');

        $event    = $this->mEvent->cariEvent($keyword,$category,$city);
        $kategori = $this->mMaster->getCategory();
        $kota     = $this->mMaster->getCity();

        $data = array(
            'event_data'    => $event,
            'kategori_data' => $kategori,
            'kota_data'     => $kota,
        );
        $this->load->view('event/v_search_event',$data);
    }

    function eventDetail($slug)
    {
        $event      = $this->mEvent->get_by_slug($slug);
        $tiket      = $this->mEvent->getTicketByEvent($event->id);
        $registered = $this->mEvent->checkUserRegistered($event->id);
        $is_publisher = $this->mEvent->checkIsPublisher($this->session->userdata('_id'),$event->id);
        $publisher  = $this->db->get_where('publishers', ['id'=>$event->publisher])->row();

        if ($event) {
            $data = array(
                'event' => $event,
                'tikets' => $tiket,
                'isRegister' => $registered,
                'isPublisher' => $is_publisher,
                'publisher' => $publisher,
            );
            $this->load->view('event/event_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('event'));
        }
    }

    function aboutPage()
    {
        $this->load->view('v_about');
    }

    function profilePage()
    {
        $this->checkLogin();
        $publisher = $this->db->get_where('publishers',['id' => $this->session->userdata('_id')])->row();

        $is_publisher = (!empty($publisher)) ? true : false;

        $data = array(
            'user'  => $this->db->get_where('users', ['id' => $this->session->userdata('_id')])->row(),
            'user_events' => $this->mUser->userRegisterEvent($this->session->userdata('_id')),
            'publisher_events' => $this->db->get_where('events', ['publisher' => $this->session->userdata('_id')])->result(),
            'is_publisher'  => $is_publisher,
            'publisher'  => $publisher
        );
        $this->load->view('v_profile',$data);
    }

    function checkLogin()
    {
        if ($this->session->userdata('email') == NULL) {
            $this->session->set_flashdata('login_notify','<div class="alert alert-warning" role="alert">Maaf, anda belum login</div>'); 
            redirect('login');
        }
    }

}
