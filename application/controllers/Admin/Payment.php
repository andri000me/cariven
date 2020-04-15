<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $models = array(
            'Admin/Booking_model' => 'mBooking',
            'Admin/Users_model' => 'mUser',
            'Admin/Event_model' => 'event',
            'Publisher/Ticket_model' => 'mTiket',
        );
        $this->load->model($models);
        $this->load->library('form_validation');
    }

    function index()
    {
        $data['payment'] = $this->mBooking->get_all_payment();
        $data['title'] = 'Pembayaran';
        $this->load->view('_admin/payment/payment_list',$data);
    }

    function detail($payment_id)
    {
        $row = $this->mBooking->get_payment_by_id($payment_id);

        if ($row) {
            $data['detail'] = $row;
            $data['title'] = 'Pembayaran';
            $this->load->view('_admin/payment/payment_detail',$data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    // validasi peserta Start
    function approveBooking($booking_id)
    {
        $user_data = $this->mBooking->get_by_id($booking_id);

        // ambil keuntungan
        $event = $this->db->get_where('events',['id' => $user_data->event_id])->row_array();
        $tiket = $this->db->get_where('tickets',['id' => $user_data->ticket])->row_array();
        $payment = $this->db->get_where('payments',['booking_id' => $booking_id])->row_array();
        
        if ($tiket['price'] > 100000) {
            $potongan = (3/100)*$tiket['price'];
        } else {
            $potongan = 3000;
        }
        
        $pemasukantemp = $tiket['price'] - $potongan;
        
        $pemasukan = $event['total_income'] + $pemasukantemp;

        // insert history payment
        $data_history = [
            'event' => $user_data->event_id,
            'booking_id' => $user_data->id,
            'ticket_price' => $tiket['price'],
            'fee_admin' => $potongan,
            'final_price' => $pemasukantemp,
        ];
        $this->db->insert('payment_history',$data_history);
        
        // update pemasukan event
        $dataevent['total_income'] = $pemasukan;
        $this->event->update($user_data->event_id, $dataevent);
        
        // update table booking
        $data['status'] = 'approved';
        $data['qrcode'] = $booking_id . '.png';
        $this->mBooking->update('bookings',$booking_id, $data);

        // update table payment
        $payment_data['status'] = 'approved';
        $payment_data['status_description'] = 'OK';
        $payment_data['validated_at'] = date('Y-m-d H:i:s');
        $this->mBooking->update('payments',$payment['id'], $payment_data);

        $this->generate_qrcode($booking_id);
        $this->sendEmailTicket($user_data->user_id,$booking_id);
        redirect('admin/pembayaran/'.$payment['id']);
    }

    function rejectBooking($booking_id)
    {
        $payment = $this->db->get_where('payments',['booking_id' => $booking_id])->row_array();
        $booking = $this->db->get_where('bookings',['id' => $booking_id])->row_array();
        
        // update table tiket
        $this->mTiket->addedone($booking['ticket']);

        // update table booking
        $data['status'] = 'rejected';
        $this->mBooking->update('bookings',$booking_id, $data);

        // update table payment
        $payment_data['status'] = 'rejected';
        $payment_data['status_description'] = $this->input->post('status_description',true);
        $payment_data['validated_at'] = date('Y-m-d H:i:s');
        $this->mBooking->update('payments',$payment['id'], $payment_data);

        redirect('admin/pembayaran/'.$payment['id']);
    }

    public function sendEmailTicket($user_id, $booking_id)
    {
        $userEmail = $this->db->get_where('users',['id' => $id])->row();
        $email     = $userEmail->email;

        $event     = $this->mBooking->get_by_id($booking_id);

        $emailData = array(
            'event_name' => $event->title, 
            'start_date' => date("d M Y",strtotime($event->start_time)),
            'start_time' => date("H:i",strtotime($event->start_time)),
            'end_time'   => date("H:i",strtotime($event->end_time)),
            'address'    => $event->address,
            'city'       => $event->city_name,
            'booking_id' => $booking_id,
            'qrcode'     => $event->qrcode,
        );

        // send email
        $content = $this->load->view('users/tiketEmail',$emailData,TRUE);
        $data = [
            'email'   => $email,
            'subject' => 'Tiket Event',
            'content' => $content
        ];
        $this->send_email($data);
        // end of send email
    }

}