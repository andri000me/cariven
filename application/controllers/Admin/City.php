<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class City extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Admin/City_model','mCity');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $city = $this->mCity->getAll();

        $data = array(
            'title'     => 'Kota',
            'city_data' => $city,
        );
        $this->load->view('_admin/dataMaster/v_city',$data);
    }

    public function create() 
    {
        $data = array(
            'name' => ucwords(trim($this->input->post('city_name',TRUE))),
        );

        $this->mCity->insert($data);
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('admin/kota');
    }
    
    public function update($id) 
    {
        $data = array(
		    'name' => ucwords(trim($this->input->post('city_name',TRUE))),
        );

        $this->mCity->update($id, $data);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('admin/kota');
    }
    
    public function delete($id) 
    {
        $row = $this->mCity->getById($id);
        if ($row) {
            $isUsed = $this->mCity->checkusedCity($id);
            if ($isUsed > 0) {
                $this->session->set_flashdata('message', 'Data kota ini tidak dapat di hapus, karena ada event yang menggunakannya');
                redirect('admin/kota');
            } else {
                $this->mCity->delete($id);
                $this->session->set_flashdata('flash', 'Dihapus');
                redirect('admin/kota');
            }
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

}