<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Publishers extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $models = array(
            'Publisher/Publishers_model' => 'mPub',
            'Login_model' => 'mLogin', 
        );
        $this->load->model($models);
        $this->load->library('form_validation');
    }

    function detail($id)
    {
        $row = $this->mPub->get_by_id($id);

        if ($row) {
            $data = array(
                'publisher' => $this->mPub->get_by_id($this->session->userdata('id')),
                'event'     => $this->mPub->get_all_event($this->session->userdata('id')),
            );
            $this->load->view('v_profile',$data);
        } else {
            redirect(base_url());
        }

    }

    function update_profile($error = null) 
    {
        $row   = $this->mPub->get_by_id($this->session->userdata('_id'));

        if ($row) {
            $data = array(
                'pub_id' => set_value('pub_id', $row->id),
                'pub_name' => set_value('pub_name', $row->name),
                'pub_tel' => set_value('pub_tel', $row->business_number),
                'pub_address' => set_value('pub_address', $row->location),
                'pub_desciption' => set_value('pub_desciption', $row->short_bio),
                'pub_image' => set_value('pub_image', $row->image),
                'pub_image_new' => set_value('pub_image_new'),
                'email' => set_value('email', $row->business_email),
                'error' => $error,
            );
            $this->load->view('_publisher/publishers/publishers_form',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profil-saya'));
        }
    }

    function update_profile_action()
    {
        $row = $this->mPub->get_by_id($this->input->post('pub_id',TRUE));

        if (trim($this->input->post('pub_name',TRUE)) == $row->name) {
            $this->form_validation->set_rules('pub_name', 'pub_name', 'trim');
        } else {
            $this->form_validation->set_rules('pub_name', 'Nama publisher', 'trim|is_unique[publishers.name]',
                array(
                    'is_unique'  => '%s sudah digunakan',
                )
            );
        }
        
        if (trim($this->input->post('email',TRUE)) == $row->business_email) {
            $this->form_validation->set_rules('email', 'email', 'trim');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'trim|is_unique[publishers.business_email]',
                array(
                    'is_unique'  => '%s sudah digunakan',
                )
            );
        }
        
        if (trim($this->input->post('pub_tel',TRUE)) == $row->business_number) {
            $this->form_validation->set_rules('pub_tel', 'pub_tel', 'trim|max_length[13]');
        } else {
            $this->form_validation->set_rules('pub_tel', 'No Telepon', 'trim|is_unique[publishers.business_number]|max_length[13]',
                array(
                    'max_length' => '%s maksimal 13 digit',
                    'is_unique'  => '%s sudah digunakan',
                )
            );
        }

        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $this->update_profile($this->input->post('pub_id', TRUE));
        } else {
            $id     = $this->input->post('pub_id',TRUE);
            $name   = trim($this->input->post('pub_name',TRUE));
            $tel    = trim($this->input->post('pub_tel',TRUE));
            $alamat = trim($this->input->post('pub_address',TRUE));
            $desc   = trim($this->input->post('pub_desciption',TRUE));
            $web    = trim($this->input->post('pub_website',TRUE));
            $email  = trim($this->input->post('email',TRUE));
            $pubImage = $this->input->post('pub_image',TRUE);
            $nameFileBaru = $id.'_'.time();

            // File Gambar
            $config['upload_path']      = './assets/images/images-publisher/';
            $config['allowed_types']    = 'png|jpg';
            $config['overwrite']		= true;
            $config['max_size']         = 500; // 500kb
            $config['file_name']        = $nameFileBaru;
            
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('pub_image_new')) {
                $dataImage = array('upload_data' => $this->upload->data());
                $pubImageNew = $dataImage['upload_data']['file_name'];
                $dataPub = array(
                    'id' => $id,
                    'name' => $name,
                    'business_email' => $email,
                    'business_number' => $tel,
                    'location' => $alamat,
                    'short_bio' => $desc,
                    'image' => $pubImageNew, 
                );
                $this->mPub->update($id, $dataPub);
                unlink('./assets/images/images-publisher/'.$pubImage);
                $this->session->set_flashdata('success_update', 'Profil berhasil diupdate');
                redirect(site_url('profil-saya'));
            } elseif (empty($_FILES['pub_image_new']['name'])) {
                $dataPub = array(
                    'id' => $id,
                    'name' => $name,
                    'business_email' => $email,
                    'business_number' => $tel,
                    'location' => $alamat,
                    'short_bio'=> $desc,
                    'image' => $pubImage, 
                );

                $this->mPub->update($id, $dataPub);
                $this->session->set_flashdata('success_update', 'Profil berhasil diupdate');
                redirect(site_url('profil-saya'));

            } else {
                $this->update_profile($this->upload->display_errors());
                $pubImageNew = null;
            }
        }
    }
}