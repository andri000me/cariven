<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Users_model','mUser');
    }

    public function index()
	{       
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',
		 		array('required' => '%s tidak boleh kosong'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required',
                 array('required' => '%s tidak boleh kosong' ));
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/v_login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email    = strtolower($this->input->post('email', TRUE));
        $password = $this->input->post('password', TRUE);
        
        $user = $this->db->get_where('users',['email' => $email])->row_array();

        // jika usernya ada
        if ($user['email']) {
			// jika usernya aktif
			if ($user['status'] == 1) {
				// cek password
				if (sha1($password) == $user['password']) {
					$data = [
                        'login_id' => uniqid(rand()),
                        '_id'      => $user['id'],
                        'name'     => $user['name'],
                        'email'    => $user['email'],
                        'role'     => $user['role'],
						'status'   => $user['status'],
                        'joindate' => $user['created_at']
					];
                    $this->session->set_userdata($data);

                    if($user['role'] == 'usr'){
                        redirect();
                    } else {
                        redirect('admin/dashboard');
                    }
                    
				} else {
					$this->session->set_flashdata('login_notify','<div class="alert alert-danger" role="alert">Email atau Password salah</div>'); 
					redirect('login');
				}
			} else {
				$this->session->set_flashdata('login_notify','<div class="alert alert-danger" role="alert">Email belum diaktivasi</div>'); 
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('login_notify','<div class="alert alert-danger" role="alert">Email atau Password salah</div>'); 
			redirect('login');
		}
    }

    function logout()
	{
        $this->session->sess_destroy();
		redirect();
    }


    function register_user()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('email','email','trim|required|is_unique[users.email]|min_length[10]',
            array('is_unique'  => '%s sudah digunakan <br>',
                  'min_length' => '%s minimal 10 karakter <br>'));
        $this->form_validation->set_rules('phone_number', 'phone number', 'trim|required|is_unique[users.phone_number]|max_length[13]', 
            array('is_unique'  => '%s sudah digunakan <br>', 
                  'max_length' => 'Maksimal 13 digit <br>'));
        $this->form_validation->set_rules('password','password','trim|required|min_length[6]|max_length[16]',
            array('max_length' => '%s Minimal 6 karakter dan Maksimal 16 Karakter <br>',
                  'min_length' => '%s Minimal 6 karakter dan Maksimal 16 Karakter <br>'));
        $this->form_validation->set_rules('passconf','passconf','trim|required|matches[password]',
            array('matches' => 'Password Konfirmasi harus sama dengan password <br>'));
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'name' => set_value('name'),
                'email' => set_value('email'),
                'phone_number' => set_value('phone_number')
            ];
            $this->load->view('auth/register_form', $data);
        } else {
            $this->_register();
        }
    }

    private function _register()
    {
        $data = [
            'name' => ucwords($this->input->post('name', true)),
            'email' => strtolower($this->input->post('email', true)),
            'password' => sha1($this->input->post('password', true)),
            'phone_number' => $this->input->post('phone_number', true),
            'status' => 0
        ];

        $this->db->insert('users',$data);
        $id_user = $this->db->insert_id();

        // send email
        $content = "Akun anda berhasil didaftarkan, silahkan klik <strong><a href='".site_url('aktivasi/'.$id_user)."'>disini</a></strong> untuk mengaktifkannya.";
        $data = [
            'email'   => $this->input->post('email', true),
            'subject' => 'Aktivasi akun Cariven Indonesia',
            'content' => $content
        ];
        $this->send_email($data);
        // end of send email
        
        $this->session->set_flashdata('login_notify', '<div class="alert alert-success alert-dismissible" style="margin:20px 0px 0px 0px">Register berhasil. Silahkan aktivasi akun di email</div>');
        
        $this->session->set_flashdata('login_notify', '<div class="alert alert-success alert-dismissible" style="margin:20px 0px 0px 0px">Register berhasil.</div>');

        redirect('login');
    }

    function activateAccount($id_user)
    {
        $this->db->set('status',1)->where('id',$id_user)->update('users');
        
        $this->session->set_flashdata('login_notify', '<div class="alert alert-success alert-dismissible" style="margin:20px 0px 0px 0px">Akun anda berhasil di aktifkan, siahkan login</div>');
        
        redirect('login');
    }
}