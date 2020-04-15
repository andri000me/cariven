<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Booking extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $models = array(
            'Booking_model'          => 'mBooking',
            'Event_model'            => 'mEvent',
            'Users_model'            => 'mUser',
            'Publisher/Ticket_model' => 'mTiket',
        );
        $this->load->model($models);
        $this->load->library('form_validation');
    }

    function bookingEventConfirmation($event_id,$ticket_id)
    {        
        $tiket   = $this->mTiket->get_by_id($event_id,$ticket_id);
        $event   = $this->mEvent->get_by_id($event_id); 

        $isRegister = $this->mEvent->checkUserRegistered($event_id);

        if ($isRegister == FALSE) {
            $user    = $this->mUser->get_by_id($this->session->userdata('_id'));

            $data = array(
                'event' => $event,
                'tiket' => $tiket,
                'user'  => $user,
                'title' => 'event',
            );

            $this->load->view('booking/booking_confirmation', $data);
        }
    }

    public function bookingEvent($event_id, $ticket_id)
    {
        $event      = $this->mEvent->get_by_id($event_id);                
        $isRegister = $this->mEvent->checkUserRegistered($event_id);
        $tiket      = $this->mTiket->get_by_id($event_id, $ticket_id);

        if ($tiket->quota > 0) { 

            if ($isRegister == FALSE) {

                $this->load->helper('random');
                do {
                    $booking_id = randStringBooking(5);
                } while ($this->mBooking->isExistId($booking_id));
    
                $data = array(
                    'id'     => $booking_id,
                    'event'  => $event_id,
                    'ticket' => $ticket_id,
                    'user'   => $this->session->userdata('_id')
                );
                
                $data['status'] = ($event->type == 0) ? 'approved' : 'booking';
                $data['qrcode'] = ($event->type == 0) ? $booking_id.'.png' : NULL;
                
                $this->mBooking->insert($data);
                
                $tiketsold = $this->db->get_where('tickets', ['id' => $ticket_id])->row();
                $stokAwal  = $tiketsold->quota;
                $stokAkhir['quota'] = $stokAwal - 1;
                
                $this->mBooking->updateTiket($ticket_id, $stokAkhir);
                
                if ($event->type == 0) {
                    $this->generate_qrcode($booking_id);
                    $this->sendEmailTicket($this->session->userdata('_id'),$booking_id);
                    redirect('tiket-saya');
                }
                
                redirect('pembayaran/' . $booking_id);

            } else {
                echo '<script language="javascript" type="text/javascript"> 
                        alert("Anda sudah terdaftar di event ini");
                        window.location = "'.site_url('event/v/'.$event->event_slug).'";
                    </script>';
            }
        } else {
            echo '<script language="javascript" type="text/javascript"> 
                alert("Tiket sudah habis");
                window.location = "'.site_url('event/v/'.$event->event_slug).'";
            </script>';   
        }
    }

    public function sendEmailTicket($user_id, $booking_id)
    {
        $userEmail = $this->mUser->get_by_id($user_id);
        $email     = $userEmail->email;

        $event     = $this->mBooking->get_by_id($booking_id);

        $emailData = array(
            'event_name' => $event->title, 
            'start_date' => date("d M Y",strtotime($event->start_time)),
            'start_time' => date("H:i",strtotime($event->start_time)),
            'end_time'   => date("H:i",strtotime($event->end_time)),
            'address'    => $event->address,
            'city'        => $event->city,
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