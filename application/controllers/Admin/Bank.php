<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Admin/Bank_model','mBank');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $bank = $this->mBank->getAll();
        $data = [
            'title'     => 'Bank',
            'bank_data' => $bank,
        ];
        $this->load->view('_admin/dataMaster/v_bank', $data);
    }

    public function create()
    {
        $this->load->helper('random');

        $data = [
            'bank_name'    => strtoupper(trim($this->input->post('bank_name', TRUE))),
            'account_name' => trim($this->input->post('bank_accname', TRUE)),
            'account_number'   => trim($this->input->post('bank_accno', TRUE)),
        ];
        $this->mBank->insert($data);
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('admin/bank');
    }

    public function update($id)
    {
        $data = array(
            'bank_name'    => strtoupper(trim($this->input->post('bank_name', TRUE))),
            'account_name' => trim($this->input->post('bank_accname', TRUE)),
            'account_number'   => trim($this->input->post('bank_accno', TRUE))
        );
        $this->mBank->update($id, $data);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect(site_url('bank'));
    }

    public function delete($id)
    {
        $row = $this->mBank->getById($id);

        if ($row) {
            $isUsed = $this->mBank->checkUsedBank($id);
            if ($isUsed > 0) {
                $this->session->set_flashdata('message', 'Data bank ini tidak dapat dihapus, karena telah digunakan');
                redirect('admin/bank');
            } else {
                $this->mBank->delete($id);
                $this->session->set_flashdata('flash', 'Dihapus');
                redirect('admin/bank');
            }
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }
}