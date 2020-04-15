<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $models = array(
            'Admin/Event_model' => 'mEvent',
            'Admin/Booking_model' => 'mBooking',
            'Admin/Publishers_model' => 'mPublisher',
            'Admin/Users_model' => 'mUser',
            'Admin/Category_model' => 'mKategori',
            'Admin/City_model' => 'mKota',
            'Admin/Bank_model' => 'mBank',
            'Admin/News_category_model' => 'mKategoriArtikel',
            'Admin/Admin_model' => 'mAdmin',
        );  
        $this->load->model($models);
    }

    function index()
    {
        // user dan publisher
        $userGraph = $this->db->select('*')->from('users')->where_not_in('role',['adm','man'])->count_all_results();
        $userActive    = count($this->db->get_where('users', ['role' => 'usr','status' => '1'])->result());
        $userNonActive = count($this->db->get_where('users', ['role' => 'usr','status' => '0'])->result());
        $pubGraph      = $this->db->select('*')->from('publishers')->count_all_results();
        $pubApproved     = count($this->db->get_where('publishers', ['status' => 'approved'])->result());
        $pubRejected  = count($this->db->get_where('publishers', ['status' => 'rejected'])->result());
        $pubSubmitted  = count($this->db->get_where('publishers', ['status' => 'submitted'])->result());

        // count event
        $draf       = count($this->db->get_where('events', ['status' => 'draft'])->result());
        $diajukan   = count($this->db->get_where('events', ['status' => 'submitted'])->result());
        $disetujui  = count($this->db->get_where('events', ['status' => 'approved'])->result());
        $ditolak    = count($this->db->get_where('events', ['status' => 'rejected'])->result());
        $semuaEvent = $this->mEvent->countAllEvent();
        $eventPeserta    = $this->mEvent->getTopPeserta();
        $eventPendapatan = $this->mEvent->getTopPendapatan();

        // count kategori dan kota
        $kategori   = $this->mKategori->countCategory();
        $kota       = $this->mKota->countCity();

        // top data publisher, user, pendapatan
        $topPublisher     = $this->mPublisher->getTopStatistik();
        $topUser          = $this->mUser->getTopStatistik();
        $total_pendapatan = $this->db->select('SUM(total_income) as totalPendapatan')->get('events')->row_array();

        $data = array(
            'title'          => 'Report',
            'publisher_data' => $topPublisher,
            'user_data'      => $topUser,
            'pendapatan_data'=> $total_pendapatan,
            'countDraf'      => $draf,
            'countDiajukan'  => $diajukan,
            'countDisetujui' => $disetujui,
            'countDitolak'   => $ditolak,
            'countAllEvent'  => $semuaEvent,
            'kategori_data'  => $kategori,
            'kota_data'      => $kota,
            'userGraph'      => $userGraph,
            'userActive'     => $userActive,
            'userNonActive'  => $userNonActive,
            'pubGraph'       => $pubGraph,
            'pubApproved'    => $pubApproved,
            'pubRejected'    => $pubRejected,
            'pubSubmitted'   => $pubSubmitted,
            'topPeserta'     => $eventPeserta,
            'topPendapatan'  => $eventPendapatan,
        );
        $this->load->view('_admin/report/v_statistik',$data);
    }

}