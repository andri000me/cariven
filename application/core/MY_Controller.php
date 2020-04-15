<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if ($this->uri->segment('1') !== 'login' && $this->uri->segment('1') !== 'register') {
            $this->checkLogin();
        }
    }

    function checkLogin()
    {
        if ($this->session->userdata('email') == NULL) {
            $this->session->set_flashdata('login_notify','<div class="alert alert-warning" role="alert">Maaf, anda belum login</div>'); 
            redirect('login');
            // echo "<script>history.go(-1)</script>";
        }
    }

    function isBookingExpired($user)
    {
        $kadaluarsa = $this->db->get_where('bookings', ['user' => $user,'status' => 'booking'])->result();
        foreach ($kadaluarsa as $row) {
            $datetime = new DateTime($row->created_at);
            $datetime->add(new DateInterval('PT1H')); // interval bayar 1 jam
            $expired = $datetime->format('Y-m-d H:i:s');
            if (date('Y-m-d H:i:S') > $expired) {
                $this->mTiket->addedOne($row->ticket);
                $this->mBooking->setExpired($row->id);
            }
        }
    }

    public function isBookingTicketExpired($booking_id)
    {
        $booking_data = $this->db->get_where('bookings', ['id' => $booking_id,'status' => 'booking'])->row_array();
        if ($booking_data) {
            $datetime = new DateTime($booking_data['created_at']);
            $datetime->add(new DateInterval('PT1H')); // interval bayar 1 jam
            $expired = $datetime->format('Y-m-d H:i:s');
            if (date('Y-m-d H:i:S') > $expired) {
                $this->mTiket->addedOne($booking_data['ticket']);
                $this->db->where('id',$booking_id)->set('status','expired')->update('bookings');
            }
        }
    }

    public function send_email($data)
    {
        // mengaktifkan less secure apps di google
        // matikan verifikasi 2 arah
        // kunjungi https://myaccount.google.com/lesssecureapps.

        $this->load->library('email');
        $config['protocol']  = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "your email";
        $config['smtp_pass'] = "your password";
        $config['charset']   = "utf-8";
        $config['mailtype']  = "html";
        $config['newline']   = "\r\n";

        $this->email->initialize($config);
            
        $this->email->from('no-reply@cariven.co.id', 'Cariven Indonesia');
        $this->email->to($data['email']);
        $this->email->subject($data['subject']);
        $this->email->message($data['content']);
        $this->email->send();
    }

    public function generate_qrcode($booking_id)
    {
        $this->load->library('ciqrcode');
        $config['cacheable'] = true;
        $config['cachedir']  = 'assets/';
        $config['errorlog']  = 'assets/';
        $config['imagedir']  = 'assets/images/qrcode/';
        $config['quality']   = true;
        $config['size']      = 1024;
        $config['black']     = array(224, 255, 255);
        $config['white']     = array(70, 130, 180);
        
        $this->ciqrcode->initialize($config);

        $params['data']     = $booking_id;
        $params['level']    = 'H';
        $params['size']     = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $booking_id . '.png';
        $this->ciqrcode->generate($params);
    }

}