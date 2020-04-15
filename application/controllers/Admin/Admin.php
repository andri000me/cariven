<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('Admin/Admin_model','mAdmin');
        $this->load->library('form_validation');
    }

    function index()
    {
        $admin = $this->mAdmin->getAll();

        $data = array(
            'title'      => 'Admin',
            'admin_data' => $admin,
        );
        $this->load->view('_admin/admin/v_admin',$data);
    }

    function create($error = null) 
    {
        $data = array(
            'button'      => 'Tambah',
            'action'      => site_url('admin/admin/aksi-tambah'),
            'title'       => 'Admin',
            'admin_id'    => set_value('admin_id'),
            'admin_name'  => set_value('admin_name'),
            'admin_tel'   => set_value('admin_tel'),
            'admin_image' => set_value('admin_image'),
            'email'       => set_value('email'),
            'password'    => set_value('password'),
            'error'       => $error,
        );
        $this->load->view('_admin/admin/v_adminForm',$data);
    }
    
    function create_action() 
    {
        $this->form_validation->set_rules('email','email','trim|required|is_unique[users.email]|min_length[10]',
        array(
            'is_unique'  => 'Email sudah digunakan',
            'min_length' => 'Email minimal 10 karakter'
            )
        );
        $this->form_validation->set_rules('admin_tel','No Hp','trim|required|is_unique[users.phone_number]|min_length[10]|max_length[13]',
        array(
            'is_unique'  => '%s sudah digunakan',
            'min_length' => '%s minimal 10 karakter',
            'max_length' => '%s minimal 13 karakter'
            )
        );
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $name   = ucwords($this->input->post('admin_name',TRUE));
            $tel    = $this->input->post('admin_tel',TRUE);
            $email  = strtolower($this->input->post('email',TRUE));
            $password = 123456;
            $ext = pathinfo($_FILES['admin_image']['name'], PATHINFO_EXTENSION);

            // File Gambar
            $config['upload_path']      = './assets/images/images-user/';
            $config['allowed_types']    = 'jpg|png';
            $config['overwrite']		= true;
            $config['max_size']         = 1000; // 1MB
            $config['file_name']        = time().'.'.$ext;
            
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('admin_image')) {
                $dataImage = array('upload_data' => $this->upload->data());
                $adminImage = $dataImage['upload_data']['file_name'];
                $dataAdmin = array(
                    'id' => $createId,
                    'name' => $name,
                    'phone_number' => $tel,
                    'profile_picture' => $adminImage,
                    'email' => $email,
                    'password' => sha1($password),
                    'role' => 'adm',
                    'status' => 1
                );
                
                $this->db->insert('users',$dataAdmin);

                $this->session->set_flashdata('message', 'Create Record Success');
                redirect('admin/admin');
                
            } else {
                $error = $this->upload->display_errors();
                $this->create($error);
                $adminImage = null;
            }
        }
    }
    
    function update($id,$error = null) 
    {
        $row = $this->mAdmin->getById($id);

        if ($row) {
            $data = array(
                'button'          => 'Edit',
                'action'          => site_url('admin/admin/aksi-edit'),
                'title'           => 'Admin',
                'admin_id'        => set_value('admin_id', $row->id),
                'admin_name'      => set_value('admin_name', $row->name),
                'admin_tel'       => set_value('admin_tel', $row->phone_number),
                'admin_image'     => set_value('admin_image', $row->profile_picture),
                'admin_image_new' => set_value('admin_image_new'),
                'email'           => set_value('email', $row->email),
                'password'        => set_value('password', $row->password),
                'error'           => $error,
            );
            $this->load->view('_admin/admin/v_adminForm',$data);
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }
    
    function update_action() 
    {
        $row = $this->mAdmin->getById($this->input->post('admin_id', TRUE));
        if (trim($this->input->post('email',TRUE)) == $row->email) {
            $this->form_validation->set_rules('email','email','trim|required|min_length[10]',
                    array('min_length' => 'Email minimal 10 karakter'));  
        } else {
            $this->form_validation->set_rules('email','email','trim|required|is_unique[users.email]|min_length[10]',
            array(
                'is_unique'  => 'Email sudah digunakan',
                'min_length' => 'Email minimal 10 karakter'
                )
            );
        }
        
        if (trim($this->input->post('admin_tel',TRUE)) == $row->phone_number) {
            $this->form_validation->set_rules('admin_tel','No Hp','trim|required|min_length[10]',
                    array('min_length' => '%s minimal 10 karakter'));  
        } else {
            $this->form_validation->set_rules('admin_tel','No Hp','trim|required|is_unique[users.phone_number]|min_length[10]',
            array(
                'is_unique'  => '%s sudah digunakan',
                'min_length' => '%s minimal 10 karakter'
                )
            );
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('admin_id', TRUE));
        } else {
            $id          = $this->input->post('admin_id',TRUE);
            $name        = ucwords($this->input->post('admin_name',TRUE));
            $tel         = $this->input->post('admin_tel',TRUE);
            $email       = $this->input->post('email',TRUE);
            $password    = $this->input->post('password',TRUE);
            $adminImage  = $this->input->post('admin_image',TRUE);
            $ext = pathinfo($_FILES['admin_image_new']['name'], PATHINFO_EXTENSION);

            // File Gambar
            $config['upload_path']      = './assets/images/images-user/';
            $config['allowed_types']    = 'jpg|png';
            $config['overwrite']		= true;
            $config['max_size']         = 1000; // 1MB
            $config['file_name']        = time().'.'.$ext;
            
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('admin_image_new')) {
                $dataImage = array('upload_data' => $this->upload->data());
                $adminImageNew = $dataImage['upload_data']['file_name'];
                $dataAdmin = array(
                    'id' => $id,
                    'name' => $name,
                    'phone_number'  => $tel,
                    'email'=> $email,
                    'profile_picture'=> $adminImageNew
                );
                
                unlink('./assets/images/images-user/'.$adminImage);
                $this->mAdmin->update($id, $dataAdmin);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect('admin/admin');
            } elseif (empty($_FILES['admin_image_new']['name'])) {
                $dataAdmin = array(
                    'id' => $id,
                    'name' => $name,
                    'phone_number'  => $tel,
                    'email'=> $email,
                    'profile_picture'=> $adminImage
                );
                $this->mAdmin->update($id, $dataAdmin);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect('admin/admin');
            } else {
                $error = $this->upload->display_errors();
                $this->update($id, $error);
                $adminImageNew = null;
            }
        }
    }
    
    function delete($id) 
    {
        $row = $this->mAdmin->getById($id);

        if ($row) {
            $this->mAdmin->delete($id);
            unlink('./assets/images/images-user/'.$row->profile_picture);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect('admin/admin');
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    // blokir dan buka blokir
    function block($id)
    {
        $row = $this->mAdmin->getById($id);
        if ($row) {
            $data['status'] = 0;
            $this->mAdmin->update($id,$data);
            
            redirect('admin/admin');
        } else {
            echo "<script>history.go(-1)</script>";
        }
        
    }

    function unBlock($id)
    {
        $row = $this->mAdmin->getById($id);
        if ($row) {
            $data['status'] = 1;
            $this->mAdmin->update($id,$data);
            
            redirect('admin/admin');
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

    function _rules() 
    {
        $this->form_validation->set_rules('admin_name', 'admin name', 'trim');
        $this->form_validation->set_rules('admin_tel', 'admin tel', 'trim');
        $this->form_validation->set_rules('admin_image', 'admin image', 'trim');

        $this->form_validation->set_rules('admin_id', 'admin_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}