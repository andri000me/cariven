<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManageEvent extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $models = array(
            'Publisher/ManageEvent_model' => 'mEvent',
            'Publisher/Ticket_model' => 'mTiket',
            'Publisher/Publishers_model' => 'mPub',
            'Booking_model' => 'mBooking',
            'Users_model' => 'mUser',
        );
        $this->load->model($models);
        $this->load->library('form_validation');
        error_reporting(0);
    }

    public function bePublisher($image_error = null, $tdup_error = null)
    {
        $publisher = $this->db->get_where('publishers',['id' => $this->session->userdata('_id')])->row_array();
        $publisher_reject = $this->db->get_where('publishers',['id' => $this->session->userdata('_id'),'status' => 'rejected'])->row_array();

        if (count($publisher) > 0) {
            if ($publisher_reject) {
                unlink('./assets/images/images-publisher/' . $publisher_reject->image);
                unlink('./assets/images/images-tdup/' . $publisher_reject->tdup);
                $this->db->where('id',$publisher_reject['id'])->delete('publishers');
            } else {
                echo "<script>history.go(-1)</script>";
            }
        }

        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('business_number', 'business number', 'trim|required|is_unique[publishers.business_number]|max_length[13]', 
            array('is_unique'  => '%s sudah digunakan <br>', 
                  'max_length' => 'Maksimal 13 digit <br>'));
        $this->form_validation->set_rules('business_email','business_email','trim|required|is_unique[publishers.business_email]|min_length[10]',
            array('is_unique'  => '%s sudah digunakan <br>',
                  'min_length' => '%s minimal 10 karakter <br>'));
        $this->form_validation->set_rules('short_bio','short bio','trim|required|max_length[160]',
                  array('max_length' => '%s maksimal 160 karakter <br>'));
        $this->form_validation->set_rules('location','short bio','trim|required|max_length[160]',
                  array('max_length' => '%s maksimal 160 karakter <br>'));
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'name' => set_value('name'),
                'business_number' => set_value('business_number'),
                'business_email' => set_value('business_email'),
                'short_bio' => set_value('short_bio'),
                'location' => set_value('location'),
                'image' => $image_error,
                'tdup' => $tdup_error
            ];
            $this->load->view('_publisher/publishers/upgrade', $data);
        } else {
            $this->_bePublisher();
        }
    }

    private function _bePublisher()
    {
        $ext_image = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = time() . '.' . $ext_image;

        $ext_tdup = pathinfo($_FILES['tdup']['name'], PATHINFO_EXTENSION);
        $tdup_name = time() . '.' . $ext_tdup;

        // image upload
        $config = array();
        $config['upload_path']   = './assets/images/images-publisher/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['overwrite']     = true;
        $config['max_size']      = 500;
        $config['file_name']     = $image_name;
        $this->load->library('upload', $config, 'imageupload');
        $this->imageupload->initialize($config);
        $upload_image = $this->imageupload->do_upload('image');

        // tdup upload
        $config = array();
        $config['upload_path']   = './assets/images/images-tdup/';
        $config['allowed_types'] = 'jpeg|jpg|png|pdf';
        $config['overwrite']     = true;
        $config['max_size']      = 500;
        $config['file_name']     = $tdup_name;
        $this->load->library('upload', $config, 'tdupupload');
        $this->tdupupload->initialize($config);
        $upload_tdup = $this->tdupupload->do_upload('tdup');

        if ($upload_image && $upload_tdup) {            
            $data = [
                'id' => $this->session->userdata('_id'),
                'name' => trim($this->input->post('name',TRUE)),
                'business_number' => trim($this->input->post('business_number',TRUE)),
                'business_email' => trim($this->input->post('business_email',TRUE)),
                'short_bio' => trim($this->input->post('short_bio',TRUE)),
                'location' => trim($this->input->post('location',TRUE)),
                'image' => $image_name,
                'tdup' => $tdup_name,
                'status' => 'submitted'
            ];
            
            $this->db->insert('publishers', $data);
            redirect('manage');
          } else {
              $image_error = $this->imageupload->display_errors();
              $tdup_error  = $this->tdupupload->display_errors();
              echo 'Image event: ' . $image_error . '<br>' . 'TDUP: ' . $tdup_error;
              redirect('manage/jadi-publisher', 'refresh');
          }
    }

    function index()
    {
        $event = $this->mEvent->get_all_event($this->session->userdata('_id'));
        $publisher = $this->db->get_where('publishers',['id' => $this->session->userdata('_id')])->row_array();

        $is_publisher = (!empty($publisher)) ? true : false;

        $data = array(
            'event_data' => $event,
            'isPublisher' => $is_publisher,
            'publisher_status' => $publisher['status'],
            'publisher_status_description' => $publisher['status_description']
        );
        $this->load->view('_publisher/manageEvent/event_list', $data);
    }

    function read($id)
    {
        $event = $this->mEvent->get_by_id($id);
        $tiket = $this->mTiket->getTiketByEventId($event->id);

        if ($event) {
            $data = array(
                'id'    => $event->id,
                'certificate' => $event->certificate,
                'event' => $event,
                'tiket' => $tiket,
                'navbar_manage' => 'description'
            );
            $this->load->view('_publisher/manageEvent/event_read', $data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function create()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required|is_unique[events.title]', array(
            'is_unique' => '%s sudah digunakan'
        ));
        $this->form_validation->set_rules('category', 'category', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        $this->form_validation->set_rules('start_time', 'start time', 'trim|required');
        $this->form_validation->set_rules('end_time', 'end time', 'trim|required');
        $this->form_validation->set_rules('location', 'event type', 'trim|required|max_length[160]', array(
            'max_length' => 'Maksimal 160 karakter'
        ));
        $this->form_validation->set_rules('city', 'event city', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'id' => set_value('id'),
                'title' => set_value('title'),
                'category' => set_value('category'),
                'category_list' => $this->db->get('event_category')->result_array(),
                'type' => set_value('type'),
                'certificate' => set_value('certificate'),
                'start_date' => set_value('start_date'),
                'start_time' => set_value('start_time'),
                'end_date' => set_value('end_date'),
                'end_time' => set_value('end_time'),
                'city' => set_value('city'),
                'city_list' => $this->db->get('cities')->result_array(),
                'location' => set_value('location'),
                'event_description' => set_value('event_description')
            );
            $this->load->view('_publisher/manageEvent/event_form', $data);
        } else {
            $this->_create_event();
        }
    }

    private function _create_event()
    {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = time() . '.' . $ext;

        // image upload
        $config = array();
        $config['upload_path']   = './assets/images/images-event/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['overwrite']     = true;
        $config['max_size']      = 10000;
        $config['file_name']     = $image_name;
        $this->load->library('upload', $config, 'imageupload');
        $this->imageupload->initialize($config);
        $upload_image = $this->imageupload->do_upload('image');

        if ($upload_image) {
            $filter_1 = str_replace("?","", trim($this->input->post('title', true)));
            $filter_2 = str_replace("$","", $filter_1);
            $slug = strtolower(str_replace(" ","-",$filter_2));
            
            $start_date = $this->input->post('start_date', true);
            $start_time = $this->input->post('start_time', true);
            $time_start = $start_date . ' ' . $start_time;
            
            $end_date = $this->input->post('end_date', true);
            $end_time = $this->input->post('end_time', true);
            $time_end = $end_date . ' ' . $end_time;

            $data = [
                'publisher' => $this->session->userdata('_id'),
                'category' => $this->input->post('category', true),
                'title' => trim($this->input->post('title', true)),
                'description' => trim($this->input->post('description', true)),
                'start_time' => $time_start,
                'end_time' => $time_end,
                'location' => trim($this->input->post('location', true)),
                'city' => trim($this->input->post('city', true)),
                'type' => trim($this->input->post('type', true)),
                'certificate' => trim($this->input->post('certificate', true)),
                'slug' => $slug,
                'image' => $image_name
            ];
            // print_r($data); die;
            $this->db->insert('events', $data);
            redirect('manage');
          } else {
              echo $this->imageupload->display_errors();
              redirect('manage/buat-event', 'refresh');
          }
    }

    function update($id)
    {
        $row = $this->mEvent->get_by_id($id);

        if ($row) {
            if ($this->input->post('id', true) == $id) {
                $this->form_validation->set_rules('title', 'title', 'trim|required');
            } else {
                $this->form_validation->set_rules('title', 'title', 'trim|required|is_unique[events.title]',
                    array('is_unique' => '%s sudah digunakan', ));
            }
            $this->form_validation->set_rules('category', 'category', 'trim|required');
            $this->form_validation->set_rules('description', 'description', 'trim|required');
            $this->form_validation->set_rules('start_time', 'start time', 'trim|required');
            $this->form_validation->set_rules('end_time', 'end time', 'trim|required');
            $this->form_validation->set_rules('location', 'event type', 'trim|required|max_length[160]', array(
                'max_length' => 'Maksimal 160 karakter'
            ));
            $this->form_validation->set_rules('city', 'event city', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $data = array(
                    'id'          => set_value('id', $row->id),
                    'publisher'   => set_value('publisher', $row->publisher),
                    'title'       => set_value('title', $row->title),
                    'category'    => set_value('category', $row->category),
                    'category_list' => $this->db->get('event_category')->result_array(),
                    'type'        => set_value('type', $row->type),
                    'certificate' => set_value('certificate', $row->certificate),
                    'image'       => set_value('image', $row->image),
                    'image_new'   => set_value('image_new'),
                    'start_time'  => set_value('start_time', $row->start_time),
                    'end_time'    => set_value('end_time', $row->end_time),
                    'city'        => set_value('city', $row->city),
                    'city_list'   => $this->db->get('cities')->result_array(),
                    'location'    => set_value('location', $row->location),
                    'description' => set_value('description', $row->description),
                    'status'      => set_value('status', $row->status),
                    'error'       => $error,
                );
                $this->load->view('_publisher/manageEvent/event_form_edit', $data);
            } else {
                $this->_update_event($row->id);
            }

        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    private function _update_event($id)
    {
        if ($_FILES['image_new']) {
            $ext = pathinfo($_FILES['image_new']['name'], PATHINFO_EXTENSION);
            $image_name = time() . '.' . $ext;
        }

        $filter_1 = str_replace("?","", trim($this->input->post('title', true)));
        $filter_2 = str_replace("$","", $filter_1);
        $slug = strtolower(str_replace(" ","-",$filter_2));
        
        $start_date = $this->input->post('start_date', true);
        $start_time = $this->input->post('start_time', true);
        $time_start = $start_date . ' ' . $start_time;
        
        $end_date = $this->input->post('end_date', true);
        $end_time = $this->input->post('end_time', true);
        $time_end = $end_date . ' ' . $end_time;

        $data = [
            'publisher' => $this->session->userdata('_id'),
            'category' => $this->input->post('category', true),
            'title' => trim($this->input->post('title', true)),
            'description' => trim($this->input->post('description', true)),
            'start_time' => $time_start,
            'end_time' => $time_end,
            'location' => trim($this->input->post('location', true)),
            'city' => trim($this->input->post('city', true)),
            'type' => trim($this->input->post('type', true)),
            'certificate' => trim($this->input->post('certificate', true)),
            'slug' => $slug,
        ];

        $image_old = $this->input->post('image',true);

        // image upload
        $config = array();
        $config['upload_path']   = './assets/images/images-event/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['overwrite']     = true;
        $config['max_size']      = 10000;
        $config['file_name']     = $image_name;
        $this->load->library('upload', $config, 'imageupload');
        $this->imageupload->initialize($config);
        $upload_image = $this->imageupload->do_upload('image_new');

        if ($upload_image) {
            $data['image'] = $image_name;
            unlink('./assets/images/images-event/' . $image_old);
            $this->db->where('id',$id)->update('events', $data);
            redirect('manage/'.$id);
        } elseif(empty($_FILES['image_new']['name'])) {
            $data['image'] = $image_old;
            $this->db->where('id',$id)->update('events', $data);
            redirect('manage/'.$id);
        } else {
            echo $this->imageupload->display_errors();
            redirect('manage/buat-event', 'refresh');
        }
    }

    function delete($id)
    {
        $row = $this->db->get_where('events',['id' => $id])->row();
        if ($row) {
            $this->mEvent->delete($id);
            unlink('./assets/images/images-event/' . $row->image);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect('manage');
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    // mengajukan event
    function mengajukan_event($id)
    {
        $row = $this->mEvent->get_by_id($id);

        if ($row) {
            $data['status'] = 'submitted';
            $data['submitted_time'] = date('Y-m-d h:i:s');
            $this->db->where('id',$row->id)->update('events',$data);
            $this->session->set_flashdata('diajukan','<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">Event Berhasil diajukan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('manage/'.$id);
        } else {
            echo "<script>history.go(-1)</script>";
        }

    }

    function kelola_tiket($event_id)
    {
        $row = $this->mEvent->get_by_id($event_id);
        
        $tiket = $this->mTiket->getTiketByEventId($row->id);
        if ($row) {
            $data = array(
                'id'          => $row->id,
                'status'      => $row->status,
                'type'        => $row->type,
                'title'       => $row->title,
                'certificate' => $row->certificate,
                'tiket'       => $tiket,
                'navbar_manage' => 'ticket'
            );
            $this->load->view('_publisher/manageEvent/v_tiket', $data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function kelola_penjualantiket($event_id)
    {
        $row = $this->mEvent->get_by_id($event_id);

        if ($row) {
            $sellPerTiket = $this->mEvent->penjualanPerTiket($row->id);
            
            $withdrawHist = $this->db->order_by('created_at','desc')->get_where('withdraws',['event' => $row->id])->result_array();
            $lastWithdraw = $this->db->get_where('withdraws',['event' => $row->id])->last_row();
            $countWithdraw= count($withdrawHist);
            $dataCashOut  = $this->mEvent->getDataCashOut($row->id);
            
            $data = array(
                'id' => $row->id,
                'title' => $row->title,
                'certificate' => $row->certificate,
                'type' => $row->type,
                'penjualanPerTiket' => $sellPerTiket,
                'penjualanAllTiket' => $sellAllTiket,
                'withdrawHistory' => $withdrawHist,
                'lastWithdraw' => $lastWithdraw,
                'countWithdraw' => $countWithdraw,
                'cashOut' => $dataCashOut,
                'navbar_manage' => 'ticket-sales'
            );
            $this->load->view('_publisher/manageEvent/v_penjualan_tiket', $data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function withdraw($id)
    {
        $data = [
            'event' => $id,
            'link' => $this->input->post('drive_link'),
            'message' => $this->input->post('message')
        ];

        $this->mEvent->insertWithdraw($data);
        $this->session->set_flashdata('message','<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">Pengajuan berhasil, silahkan tunggu verifikasi dari kami maksimal 2x24 di jam kerja. Terimakasih :)<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('manage/'.$id.'/penjualan-tiket');
    }

    function kelola_peserta($event_id)
    {
        $row = $this->mEvent->get_by_id($event_id);
        if ($row) {
            $totalPendaftar   = $this->mEvent->countTotalPendaftar($row->id);
            $totalDipesan     = $this->mEvent->countByStatus($row->id,'booking');
            $totalDibayar     = $this->mEvent->countByStatus($row->id,'paid');
            $totalDisetujui   = $this->mEvent->countByStatus($row->id,'approved');
            $totalDitolak     = $this->mEvent->countByStatus($row->id,'rejected');
            $totalKadaluarsa  = $this->mEvent->countByStatus($row->id,'expired');
            $konfirmasi_bayar = $this->mEvent->getConfirmPayment($row->id);
            $pendaftar        = $this->mEvent->getRegistrant($row->id);
            $peserta          = $this->mEvent->getPesertaByEvent($row->id);
            $pembayaran       = $this->mEvent->getPaymentBooking($row->id);

            $data = array(
                'id' => $row->id,
                'title' => $row->title,
                'certificate' => $row->certificate,
                'type' => $row->type,
                'totalPendaftar'    => $totalPendaftar,
                'totalDipesan'      => $totalDipesan,
                'totalDibayar'      => $totalDibayar,
                'totalDisetujui'    => $totalDisetujui,
                'totalDitolak'      => $totalDitolak,
                'totalKadaluarsa'   => $totalKadaluarsa,
                'konfirmasi_bayar'  => $konfirmasi_bayar,
                'jumlah_konfirmasi' => count($konfirmasi_bayar),
                'pendaftar'         => $pendaftar,
                'jumlah_pendaftar'  => count($pendaftar),
                'peserta'           => $peserta,
                'pembayaran'        => $pembayaran,
                'navbar_manage' => 'audience'
            );
            $this->load->view('_publisher/manageEvent/v_peserta', $data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    // kedatangan
    function kedatangan($event_id)
    {
        $row = $this->mEvent->get_by_id($event_id);

        if ($row) {
            $data = array(
                'id' => $row->id,
                'title' => $row->title,
                'type' => $row->type,
                'certificate' => $row->certificate,
                'navbar_manage' => 'attendance'
            );
            $this->load->view('_publisher/manageEvent/v_kedatangan',$data);
        } else {
            echo "<script>history.go(-1)</script>";
        }

    }

    function scan_kedatangan($event_id)
    {
        $row     = $this->mEvent->get_by_id($event_id);

        $kedatangan = $this->mBooking->data_kedatangan($event_id);
        $data = array(
            'event_id'   => $event_id,
            'start_date' => $row->start_date,
            'kedatangan_data' => $kedatangan,
        );
        $this->load->view('_publisher/manageEvent/v_scan_kedatangan',$data);
    }

    function scan_kedatangan_action($event_id)
    {
        $booking_id = trim($this->input->post('qrcode',TRUE));

        $row = $this->mBooking->get_by_id($booking_id);
        
        if ($row->event_id == $event_id) {

            if ($row->booking_status == 'approved') {

                if ($row->attend == 0) {
                    $data = array(
                        'booking_id' => $booking_id,
                        'attend' => 1, 
                        'attend_time' => date('Y-m-d H:i:s'),
                    );
                        $this->session->unset_userdata('kedatangan-msg');
                        $this->mBooking->insert_attendance($data);
                    } else {
                    $this->session->set_flashdata('kedatangan-msg', 'kode tiket 
                    <strong>'. $booking_id . '</strong> sudah dipakai');
                    }
                } else {
                $this->session->set_flashdata('kedatangan-msg', 'kode tiket 
                <strong>'. $booking_id . '</strong> tidak valid');
                }
            } else {
            $this->session->set_flashdata('kedatangan-msg', 'kode tiket 
            <strong>'. $booking_id . '</strong> tidak terdaftar di event ini');
        }
        redirect(site_url('manage/'.$event_id.'/scan-kedatangan'));
    }

    // sertifikat
    function sertifikat($event_id,$error = null)
    {
        $row = $this->mEvent->get_by_id($event_id);

        $peserta = $this->mEvent->getPesertaByEvent($event_id);
        
        if ($row) {
            $data = array(
                'id' => $row->id,
                'title' => $row->title,
                'certificate' => $row->certificate,
                'bgcertificate' => $row->background_certificate,
                'peserta' => $peserta,
                'error' => $error,
                'navbar_manage' => 'certificate'
            );
            
            if ($error != NULL) {
                $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" id="message" role="alert">'.$error.'</div>');
            }
    
            $this->load->view('_publisher/manageEvent/v_sertifikat',$data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function addCertificate($event_id)
    {
        $image        = $_FILES["bgcertificate"]['name'];
        $changeFname  = str_replace($image,'certificate',$image);
        $fileName     = $event_id . '-' . $changeFname;

        // File Gambar
        $config['upload_path']      = './assets/images/images-certificate/';
        $config['allowed_types']    = 'jpg|png';
        $config['overwrite']        = true;
        $config['max_size']         = 500; // 500KB
        $config['file_name']        = $fileName;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('bgcertificate')) {
            $uploadData    = array('upload_data' => $this->upload->data());
            $bgCertificate = $uploadData['upload_data']['file_name'];
            $data          = array('background_certificate' => $bgCertificate);
            $this->mEvent->update($event_id,$data);
            $this->session->set_flashdata('message', ' <div class="alert alert-success alert-dismissible fade show" id="message" role="alert"> Upload background <strong>berhasil</strong></div>');
            redirect('manage/'.$event_id.'/sertifikat');
        } else {
            $error = $this->upload->display_errors();
            $this->sertifikat($event_id,$error);
            $bgCertificate = null;
        }
    }

    function ambil_sertifikat($event_id)
    {
        $row     = $this->mEvent->get_by_id($event_id);

        $ambil_sertifikat = $this->mBooking->data_sertifikat($event_id);

        $data = array(
            'event_id'        => $event_id,
            'start_date'      => $row->start_date,
            'sertifikat_data' => $ambil_sertifikat,
        );
        $this->load->view('_publisher/manageEvent/v_ambil_sertifikat',$data);
    }

    function scan_ambil_sertifikat($event_id)
    {
        $booking_id = trim($this->input->post('qrcode',TRUE));

        $row = $this->mBooking->get_by_id($booking_id);
        
        if ($row->event_id == $event_id) {

            if ($row->booking_status == 'approved') {

                if ($row->attend == 1) {

                    if ($row->takeOf_certificate == 0) {
                        $data = array(
                            'takeOf_certificate' => 1, 
                            'certificate_time' => date('Y-m-d H:i:s'),
                        );
                            $this->session->unset_userdata('sertifikat-msg');
                            $this->mBooking->update_attendance($row->id,$data);

                        } else {
                            $this->session->set_flashdata('sertifikat-msg', 'kode tiket 
                            <strong>'. $booking_id . '</strong> sudah ambil');
                        }
                    } else {
                        $this->session->set_flashdata('sertifikat-msg', 'kode tiket <strong>'. $booking_id . '</strong> tidak datang');
                    }
                } else {
                    $this->session->set_flashdata('sertifikat-msg', 'kode tiket 
                    <strong>'. $booking_id . '</strong> tidak valid');
                }
            } else {
                $this->session->set_flashdata('sertifikat-msg', 'kode tiket 
                <strong>'. $booking_id . '</strong> tidak terdaftar di event ini');
            }
        redirect('manage/'.$event_id.'/ambil-sertifikat');
    }

    function download_sertifikat()
    {
        $this->load->helper('download');
        force_download(FCPATH.'/assets/images/images-certificate/templates.png',null);
    }

    function kelola_report($event_id)
    {
        $row = $this->mEvent->get_by_id($event_id);

        if ($row) {
            $data = array(
                'id' => $row->id,
                'title' => $row->title,
                'certificate' => $row->certificate,
                'navbar_manage' => 'report'
            );
            $this->load->view('_publisher/manageEvent/v_report', $data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function generateQRcode($booking_id)
    {
        $this->load->library('ciqrcode');
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './ev-admin/assets/'; //string, the default is application/cache/
        $config['errorlog']     = './ev-admin/assets/'; //string, the default is application/logs/
        $config['imagedir']     = './ev-admin/assets/images/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $booking_id . '.png';

        $params['data'] = $booking_id;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name;
        $this->ciqrcode->generate($params);
    }

    function _rules()
    {
        $this->form_validation->set_rules('event_pub', 'event pub', 'trim');
        $this->form_validation->set_rules('event_category', 'event category', 'trim');
        $this->form_validation->set_rules('start_date', 'start date', 'trim');
        $this->form_validation->set_rules('end_date', 'end date', 'trim');
        $this->form_validation->set_rules('start_time', 'start time', 'trim');
        $this->form_validation->set_rules('end_time', 'end time', 'trim');
        $this->form_validation->set_rules('event_address', 'event address', 'trim');
        $this->form_validation->set_rules('event_city', 'event city', 'trim');
        $this->form_validation->set_rules('event_video', 'event video', 'trim');
        $this->form_validation->set_rules('event_type', 'event type', 'trim');
        $this->form_validation->set_rules(
            'event_description',
            'event description',
            'trim|required',
            array('required' => 'deskripsi harus diisi')
        );
        $this->form_validation->set_rules('event_status', 'event status', 'trim');
        $this->form_validation->set_rules('event_created', 'event created', 'trim');

        $this->form_validation->set_rules('event_id', 'event_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function generateReport($event_id)
    {
        $event = $this->mEvent->get_by_id($event_id);

        $this->load->library('pdf');

        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
        // header
        $pdf->SetFont('Arial','I',10);
        $pdf->cell(90,10,'Generate Laporan Event ('. date("d-m-Y H:i:s").')',0,0);
        $pdf->cell(10,10,'',0,0);
        $pdf->cell(90,10,'Powered by Cariven.id' ,0,1,'R');
        $pdf->SetFont('Arial','B',16);
        $pdf->cell(10,20,$event->title,0,1);

        
        $totalPendaftar  = $this->mEvent->countTotalPendaftar($event_id);
        $totalDipesan    = $this->mEvent->countByStatus($event->id,'booking');
        $totalDibayar    = $this->mEvent->countByStatus($event->id,'paid');
        $totalDisetujui  = $this->mEvent->countByStatus($event->id,'approved');
        $totalDitolak    = $this->mEvent->countByStatus($event->id,'rejected');
        $totalKadaluarsa = $this->mEvent->countByStatus($event->id,'expired');
        $totalHadir      = $this->mEvent->countKehadiran($event_id);

        // peserta pendaftar
        $pdf->SetFont('Arial','',12);
        $pdf->cell(30,10,'Pendaftar',1,0);
        $pdf->cell(30,10,$totalPendaftar .' orang',1,1,'R');
        $pdf->cell(30,10,'Peserta',1,0);
        $pdf->cell(30,10,$totalDisetujui .' orang',1,1,'R');
        $pdf->cell(30,10,'Hadir',1,0);
        $pdf->cell(30,10,$totalHadir .' orang',1,1,'R');
        $pdf->Image(base_url('assets/images/images-event/'.$event->image),80,40,120,60,'');
        $pdf->cell(90,40,'',0,1);

        // detail pemesanan
        $pdf->SetFont('Arial','B',14);
        $pdf->cell(30,10,'Detail Pemesanan Tiket',0,1,'L');
        $pdf->cell(90,0,'',0,1);

        $pdf->SetFont('Arial','B',12);
        $pdf->cell(38,10,'Dipesan',1,0);
        $pdf->cell(38,10,'Dibayar',1,0,'C');
        $pdf->cell(38,10,'Disetujui',1,0,'C');
        $pdf->cell(38,10,'Ditolak',1,0,'C');
        $pdf->cell(38,10,'Kadaluarsa',1,1,'C');
        $pdf->cell(38,10,$totalDipesan,1,0,'C');
        $pdf->cell(38,10,$totalDibayar,1,0,'C');
        $pdf->cell(38,10,$totalDisetujui,1,0,'C');
        $pdf->cell(38,10,$totalDitolak,1,0,'C');
        $pdf->cell(38,10,$totalKadaluarsa,1,1,'C');
        $pdf->SetFont('Arial','',12);
        $pdf->cell(38,10,'Total Pendaftar : ' . $totalPendaftar .' orang',0,1,'L');
        $pdf->cell(90,0,'',0,1);
        
        // tiket event
        $pdf->SetFont('Arial','B',14);
        $pdf->cell(30,10,'Tiket Event',0,1,'L');
        $pdf->cell(90,0,'',0,1);

        $pdf->SetFont('Arial','B',12);
        $pdf->cell(100,10,'Nama Tiket',1,0);
        $pdf->cell(30,10,'Stok Awal',1,0,'C');
        $pdf->cell(30,10,'Terjual',1,0,'C');
        $pdf->cell(30,10,'Sisa',1,1,'C');
        
        $tiket_event = $this->mEvent->penjualanPerTiket($event_id);
        foreach ($tiket_event as $tiket) {
            $stok = $tiket->Terjual + $tiket->quota;
            $sisa = $stok - $tiket->Terjual;

            $pdf->SetFont('Arial','',12);
            $pdf->cell(100,10,$tiket->ticket_name,1,0);
            $pdf->cell(30,10,$stok,1,0,'C');
            $pdf->cell(30,10,$tiket->Terjual,1,0,'C');
            $pdf->cell(30,10,$sisa,1,1,'C');
        }

        // pendapatan
        $total_pendapatan = $this->mEvent->penjualanSemuaTiket($event_id);
        $pdf->SetFont('Arial','B',14);
        $pdf->cell(90,10,'',0,1);
        $pdf->cell(30,10,'Total Pendapatan',0,1,'L');
        $total = 0;
        foreach ($total_pendapatan as $row) { 
            $subTotal = $row->Terjual * $row->ticket_price;
            $total += $subTotal;
        }
        $pdf->SetFont('Arial','BI',36);
        $pdf->cell(30,10,'Rp ' . number_format($total,'0','','.') . ',-',0,1,'L');

        $pdf->output('D','report-'.$event->title.'.pdf');
    }

    function printoutPeserta($event_id)
    {
        $peserta = $this->mEvent->getPesertaByEvent($event_id);
        $event   = $this->mEvent->get_by_id($event_id);

        $this->load->library('pdf');

        $pdf = new FPDF('P','mm','A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();

        // header
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(80);
        $pdf->Cell(30,10,'Presensi Manual',0,1,'C');
        $pdf->SetFont('Times','I',12);
        $pdf->Cell(0,5,'('.$event->title.')',0,1,'C');
        $pdf->Ln(10);

        // content
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(10,10,'No',1,0,'C');
        $pdf->Cell(100,10,'Nama Peserta',1,0,'C');
        $pdf->Cell(40,10,'No HP',1,0,'C');
        $pdf->Cell(40,10,'Tanda Tangan',1,1,'C');
        $pdf->SetFont('Times','',12);
        $start = 0;
        foreach ($peserta as $row) {
            $pdf->Cell(10,10,++$start,1,0,'C');
            $pdf->Cell(100,10,$row->name,1,0);
            $pdf->Cell(40,10,$row->phone_number,1,0,'C');
            $pdf->Cell(40,10,'',1,1);
        }
        $pdf->SetFont('Times','I',12);
        $pdf->Cell(0,10,'Generate at ' . date('d M Y H:i:s'). ' | by Cariven.id',0,0);

        // output 
        $pdf->Output('D','absensi-manual.pdf');

    }

    function tesPrint($event_id)
    {
        $row = $this->mEvent->get_by_id($event_id);
        
        date_default_timezone_set("Asia/Jakarta");
        $startDate = date_indo(date('Y-m-d',strtotime($row->start_time)));
        $endDate   = date_indo(date('Y-m-d',strtotime($row->end_time)));

        $tanggal = ($startDate == $endDate) ? $startDate : $startDate .' - '. $endDate;

        $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', 'A4'); 
        $pdf->AddPage(); 
        $pdf->Image('assets/images/images-certificate/'.$row->background_certificate,0,0,297,210);

        $pdf->SetFont('Arial', 'B', 36);
        $pdf->Cell(0,20,'',0,1);
        $pdf->Cell(0, 10,'SERTIFIKAT',0,1,'C');

        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(0, 20,'Diberikan kepada',0,1,'C');

        $pdf->SetFont('Arial', 'B', 24);
        $pdf->Cell(0, 10,'Dani Kristianto',0,1,'C');
        $pdf->Line(60, 73, 297-60, 73);

        $pdf->Cell(0,10,'',0,1);
        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(0,5,'Sebagai',0,1,'C');

        $pdf->SetFont('Arial','B', 24);
        $pdf->Cell(0, 20,'PESERTA',0,1,'C');

        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(0, 10,'Dalam serangkaian acara ' . $row->title,0,1,'C');
        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(0, 10,'yang diselenggarakan oleh '. $row->pub_name .' dan di kota ' . $row->city_name,0,1,'C');
        $pdf->Cell(0, 10,'pada tanggal '.$tanggal,0,1,'C');

        $pdf->Output('D','test-print.pdf');
    }

    function printCertificate($booking_id)
    {
        $row    = $this->mBooking->get_by_id($booking_id);
        $event  = $this->mEvent->get_by_id($row->event_id);

        date_default_timezone_set("Asia/Jakarta");
        $startDate = date_indo(date('Y-m-d',strtotime($row->start_time)));
        $endDate   = date_indo(date('Y-m-d',strtotime($row->end_time)));

        $tanggal = ($startDate == $endDate) ? $startDate : $startDate .' - '. $endDate;

        $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', 'A4'); 
        $pdf->AddPage(); 
        $pdf->Image('assets/images/images-certificate/'.$event->background_certificate,0,0,297,210);

        $pdf->SetFont('Arial', 'B', 36);
        $pdf->Cell(0,20,'',0,1);
        $pdf->Cell(0, 10,'SERTIFIKAT',0,1,'C');

        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(0, 20,'Diberikan kepada',0,1,'C');

        $pdf->SetFont('Arial', 'B', 24);
        $pdf->Cell(0, 10,$row->name,0,1,'C');
        $pdf->Line(60, 73, 297-60, 73);

        $pdf->Cell(0,10,'',0,1);
        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(0,5,'Sebagai',0,1,'C');

        $pdf->SetFont('Arial','B', 24);
        $pdf->Cell(0, 20,'PESERTA',0,1,'C');

        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(0, 10,'Dalam serangkaian acara ' . $event->title,0,1,'C');
        $pdf->SetFont('Arial', '', 16);
        $pdf->Cell(0, 10,'yang diselenggarakan oleh '. $event->pub_name .' dan di kota ' . $event->city_name,0,1,'C');
        $pdf->Cell(0, 10,'pada tanggal '.$tanggal,0,1,'C');

        $pdf->Output('D', $row->name.'.pdf');  
    }
}