<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $models = array(
            'Payment_model' => 'mPayment',
            'Booking_model' => 'mBooking',
            'Bank_model' => 'mBank',
            'Publisher/Ticket_model' => 'mTiket',
            'Event_model' => 'mEvent',
        );
        $this->load->model($models);
        $this->load->library('form_validation');
    }

    function create($booking_id, $error = null)
    {
        $booking   = $this->mBooking->get_by_id($booking_id);

        if ($booking) {
            $this->isBookingTicketExpired($booking_id);
            
            $tiket     = $this->mTiket->get_by_id($booking->event_id,$booking->ticket);
            $event     = $this->mEvent->get_by_id($booking->event_id);
            $bank      = $this->mBank->get_all();
            
            $data  = array(
                'booking_id'     => $booking_id,
                'event_data'     => $event,
                'tiket_data'     => $tiket,
                'bank_data'      => $bank,
                'payment_booking'=> set_value('payment_booking'),
                'payment_nameacc'=> set_value('payment_nameacc'),
                'payment_destination'=> set_value('payment_destination'),
                'payment_message'=> set_value('payment_message'),
                'payment_image'  => set_value('payment_image'),
                'payment_created'=> set_value('payment_created'),
                'error' => $error,
            );
            $this->load->view('payment/payment_form', $data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create($this->input->post('payment_booking', true));
        } else {
            $ext = pathinfo($_FILES['payment_image']['name'], PATHINFO_EXTENSION);

            // File Gambar
            $config['upload_path']      = './assets/images/images-buktitf/';
            $config['allowed_types']    = 'jpeg|jpg|png';
            $config['overwrite']        = true;
            $config['max_size']         = 1000; // 1MB
            $config['file_name']        = time(). '.'.$ext;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('payment_image')) {
                $dataImgPayment = array('upload_data' => $this->upload->data());
                $paymentImage = $dataImgPayment['upload_data']['file_name'];
                $data = array(
                    'booking_id' => $this->input->post('payment_booking', true),
                    'destination_bank' => $this->input->post('payment_destination'),
                    'account_name' => trim(ucwords($this->input->post('payment_nameacc', true))),
                    'message' => trim($this->input->post('payment_message', true)),
                    'image' => $paymentImage,
                );
                $dataBooking = array(
                    'status' => "paid",
                );

                $this->mPayment->insert($data);
                $this->mBooking->update($this->input->post('payment_booking', true), $dataBooking);
                $this->session->set_flashdata('payment-success', 'Pembayaran berhasil. Kami akan segera memverifikasi pembayaran anda');
                redirect('tiket-saya/' . $this->input->post('payment_booking', true));
            } else {
                $error = $this->upload->display_errors();
                $this->create($this->input->post('payment_booking', true), $error);
                $paymentImage = null;
            }
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('payment_booking', 'payment booking', 'trim');
        $this->form_validation->set_rules('payment_nameacc', 'payment nameacc', 'trim');
        $this->form_validation->set_rules('payment_message', 'payment message', 'trim');
        $this->form_validation->set_rules('payment_image', 'payment image', 'trim');
        $this->form_validation->set_rules('payment_created', 'payment created', 'trim');

        $this->form_validation->set_rules('payment_id', 'payment_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}