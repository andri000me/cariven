<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $models = array(
            'Users_model' => 'mUser',
            'Booking_model' => 'mBooking',
            'Publisher/Ticket_model' => 'mTiket',
        );
        $this->load->model($models);
        $this->load->library('form_validation');
    }

    function myTicket()
    {
        $this->isBookingExpired($this->session->userdata('_id'));

        $data['myEvent'] = $this->mUser->getEventByUser($this->session->userdata('_id'));
        $this->load->view('users/myTicket', $data);
    }

    function ticketDetail($booking_id)
    {
        $this->isBookingTicketExpired($booking_id);

        $myTicket  = $this->mUser->getBookingById($booking_id);
        $myPayment = $this->mUser->getPaymentByBookingId($booking_id);

        $data['myTicket']  = $myTicket;
        $data['myPayment'] = $myPayment;
        
        $this->load->view('users/ticketDetail', $data);
    }

    function profile($error = null)
    {
        $row = $this->mUser->get_by_id($this->session->userdata('_id'));

        if ($row) {
            $data = array(
                'user_id'       => set_value('user_id', $row->id),
                'user_name'     => set_value('user_name', $row->name),
                'user_tel'      => set_value('user_tel', $row->phone_number),
                'user_bio'      => set_value('user_bio', $row->short_bio),
                'user_address'  => set_value('user_address', $row->address),
                'user_image'    => set_value('user_image', $row->profile_picture),
                'user_image_new'=> set_value('user_image_new'),
                'email'         => set_value('email',$row->email),
                'password'      => set_value('password',$row->password),
                'error'         => $error,
            );
            $this->load->view('users/users_form',$data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function profile_action()
    {
        $row = $this->mUser->get_by_id($this->input->post('user_id',TRUE));

        if (trim($this->input->post('email',TRUE)) == $row->email) {
            $this->form_validation->set_rules('email', 'Email', 'trim');   
        } else {
            $this->form_validation->set_rules('email', 'Email', 'is_unique[users.email]',
                    array('is_unique' => '%s sudah digunakan'));   
        }

        if (trim($this->input->post('user_tel',TRUE)) == $row->phone_number) {
            $this->form_validation->set_rules('user_tel', 'Nomor Hp', 'trim|max_length[13]',
            array('max_length' => '%s maksimal 13 digit'));
        } else {
            $this->form_validation->set_rules('user_tel', 'Nomor Hp', 'is_unique[users.phone_number]|max_length[13]',
                    array('is_unique' => '%s sudah digunakan',
                          'max_length' => '%s maksimal 13 digit'
                    ));
        }

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->profile($this->input->post('user_id', TRUE));
        } else {
            $id      = $this->input->post('user_id',TRUE);
            $idLogin = $this->input->post('user_login',TRUE);
            $name    = trim($this->input->post('user_name',TRUE));
            $tel     = trim($this->input->post('user_tel',TRUE));
            $bio     = trim($this->input->post('user_bio',TRUE));
            $alamat  = trim($this->input->post('user_address',TRUE));
            $email   = trim($this->input->post('email',TRUE));
            $image_user = $this->input->post('user_image',TRUE);
            $nameFileBaru = $id.'_'.time();

            // File Gambar
            $config['upload_path']      = './assets/images/images-user/';
            $config['allowed_types']    = 'jpg|png';
            $config['overwrite']		= true;
            $config['max_size']         = 500;
            $config['file_name']        = $nameFileBaru;
            
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('user_image_new')) {
                $dataImage = array('upload_data' => $this->upload->data());
                $userImageNew = $dataImage['upload_data']['file_name'];
                $dataUser = array(
                    'id' => $id,
                    'name' => $name,
                    'email' => $email,
                    'phone_number' => $tel,
                    'short_bio' => $bio,
                    'address' => $alamat,
                    'profile_picture' => $userImageNew,
                );
                $this->mUser->update($id, $dataUser);
                unlink('./assets/images/images-user/'.$image_user);
                $this->session->set_flashdata('success_update', 'Profil berhasil diganti');
                redirect(site_url('profil-saya'));
            } elseif (empty($_FILES['user_image_new']['name'])) {
                $dataUser = array(
                    'id' => $id,
                    'name' => $name,
                    'email' => $email,
                    'phone_number' => $tel,
                    'short_bio' => $bio,
                    'address' => $alamat,
                    'profile_picture' => $image_user,
                );
                $this->mUser->update($id, $dataUser);
                $this->session->set_flashdata('success_update', 'Profil berhasil diganti');
                redirect(site_url('profil-saya'));
            } else {
                $this->profile($this->upload->display_errors());
                $userImageNew = null;
            }
        }
    }

    function ubah_password()
    {
        $row     = $this->mUser->get_by_id($this->session->userdata('_id'));

        if ($row) {
            $data = array(
                'user_id' => set_value('user_id', $row->id),
                'user_image' => $row->profile_picture,
                'user_bio' => $row->short_bio,
                'old_password' => set_value('old_password'),
                'password_baru' => set_value('password_baru'),
                'passconf' => set_value('passconf'),
            );
            $this->load->view('users/v_ubah_password',$data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function ubah_password_action()
    {
        $this->form_validation->set_rules('password_baru', 'Password', 'required|min_length[6]|max_length[16]',
                    array(
                        'max_length' => '%s minimal 6 karakter dan maksimal 16 karakter',
                        'min_length' => '%s minimal 6 karakter dan maksimal 16 karakter'
                    ));
        $this->form_validation->set_rules('passconf', 'Password Konfirmasi', 'matches[password_baru]',
                    array('matches' => '%s harus sama dengan password baru', ));
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        $id_user = $this->input->post('user_id', TRUE);
        $old_password = trim($this->input->post('old_password',TRUE));

        $row = $this->mUser->get_by_id($id_user);
        if ($row->password == sha1($old_password)) {
            if ($this->form_validation->run() == FALSE) {
                $this->ubah_password();
            } else {
                $data = array(
                    'password' => sha1(trim($this->input->post('password_baru',TRUE))),
                );
                $this->session->set_flashdata('success_update', 'Password berhasil diganti');
                $this->mUser->update($id_user,$data);
                redirect(site_url('profil-saya'));
                }
            } else {
            $this->session->set_flashdata('old_password', 'Password lama salah');
            redirect(site_url('ubah-password'));
        }
    }
}
