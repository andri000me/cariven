<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        $models = array(
            'Admin/Event_model' => 'mEvent',
            'Admin/Ticket_model' => 'mTiket',
            'Admin/Booking_model' => 'mBooking',
        );
        $this->load->model($models);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $event = $this->mEvent->getAll();
        $data = array(
            'title' => 'Event',
            'event_data' => $event,
        );
        $this->load->view('_admin/event/v_event', $data);
    }

    public function read($id)
    {
        $event = $this->mEvent->getById($id);

        if ($event) {
            $ticket        = $this->mTiket->getTicketByEvent($id);
            $totalTicket   = count($ticket);
            $totalQuota    = $this->mTiket->totalQuota($id);
            $peserta       = $this->mBooking->getPesertaByEvent($id);
            $jumlahPeserta = count($peserta);
            $payment       = $this->mBooking->getPaymentBooking($id);
            $sellPerTiket  = $this->mEvent->sellPerTiket($id);
            $data = array(
                'title'       => 'Event',
                'event'       => $event,
                'tiket'       => $ticket,
                'totalTiket'  => $totalTicket,
                'totalQuota'  => $totalQuota->totalTiket,
                'peserta'     => $peserta,
                'totalPeserta' => $jumlahPeserta,
                'payment'     => $payment,
                'sellPerTiket' => $sellPerTiket
            );
            $this->load->view('_admin/event/v_eventDetail', $data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    public function delete($id)
    {
        $eventID = decrypt($id);

        $row = $this->mEvent->getById($eventID);

        if ($row) {
            $this->mEvent->delete($eventID);
            unlink('./assets/images/images-event/' . $row->event_image);
            $this->session->set_flashdata('flash', 'Dihapus');
            redirect(site_url('event'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('event'));
        }
    }

    public function approved($event_id)
    {
        $row = $this->mEvent->getById($event_id);
        if ($row) {
            $data['status']  = "approved";
            $data['status_description'] = 'OK';
            $data['validated_by'] = $this->session->userdata('_id');
            $data['validated_time'] = date('Y-m-d H:i:s');
            $this->mEvent->approval($event_id, $data);
            $this->session->set_flashdata('message', 'Persetujuan event berhasil :)');
            redirect('admin/event/'.$event_id);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    public function declined($event_id)
    {
        $row = $this->mEvent->getById($event_id);
        if ($row) {
            $data['status'] = "rejected";
            $data['status_description'] = $this->input->post('status_description');
            $data['validated_by'] = $this->session->userdata('_id');
            $data['validated_time'] = date('Y-m-d H:i:s');

            $this->mEvent->approval($event_id, $data);
            $this->session->set_flashdata('message', 'Penolakan event berhasil :)');
            redirect('admin/event/'.$event_id);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    public function withdraw()
    {
        $withdraw = $this->mEvent->getAllWithdraw();
        $data = array(
            'title' => 'Pencairan',
            'withdraw' => $withdraw,
        );
        $this->load->view('_admin/pencairan/pencairan_list', $data);
    }

    public function withdrawDetail($withdraw_id)
    {
        $wd  = $this->mEvent->getWithdrawById($withdraw_id);

        if ($wd) {
            // data event, history payment
            $event = $this->mEvent->getById($wd['event']);
            $historyPayment = $this->mEvent->getHistoryPaymentByEvent($wd['event']);
            $payoutTicket  = $this->mEvent->sellPerTiket($wd['event']);

            $data = [
                'title' => 'Pencairan',
                'event' => $event,
                'history_payment' => $historyPayment,
                'payout_ticket' => $payoutTicket,
                'wd' => $wd
            ];

            $this->load->view('_admin/pencairan/pencairan_detail', $data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    public function withdrawApprove($withdraw_id)
    {
        $wd = $this->mEvent->getWithdrawByEvent($withdraw_id);

        if ($wd) {
            $data = [
                'status' => 'approved',
                'status_description' => 'OK',
                'validated_at' => date('Y-m-d H:i:s')
            ];
    
            $this->mEvent->updateWithdrawStatus($withdraw_id, $data);
            $this->session->set_flashdata('message', 'Approval berhasil!');
            redirect('admin/pencairan-dana');   
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }
    
    public function withdrawReject($withdraw_id)
    {
        $message = $this->input->post('message',true);
        $wd = $this->mEvent->getWithdrawByEvent($withdraw_id);

        if ($wd) {
            $data = [
                'status' => 'rejected',
                'status_description' => $message,
                'validated_at' => date('Y-m-d H:i:s')
            ];
    
            $this->mEvent->updateWithdrawStatus($withdraw_id, $data);
            $this->session->set_flashdata('message', 'Reject Pengajuan berhasil!');
            redirect('admin/pencairan-dana');
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }
}