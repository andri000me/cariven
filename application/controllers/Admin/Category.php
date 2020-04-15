<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Admin/Category_model','mCategory');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $category = $this->mCategory->getAll();

        $data = [
            'title'         => 'Kategori Event',
            'category_data' => $category,
        ];
        $this->load->view('_admin/dataMaster/v_category', $data);
    }
    
    public function create() 
    {
        $data = [
            'name' => ucwords(trim($this->input->post('category_name',TRUE)))
        ];
        $this->mCategory->insert($data);
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('admin/kategori-event');
    }
    
    public function update($id) 
    {
        $data = array(
            'name' => ucwords(trim($this->input->post('category_name',TRUE))),
        );

        $this->mCategory->update($id, $data);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('admin/kategori-event');
    }
    
    public function delete($id) 
    {
        $row = $this->mCategory->getById($id);

        if ($row) {
            $isUsed = $this->mCategory->checkUsedCategory($id);
            if ($isUsed > 0) {
                $this->session->set_flashdata('message', 'Kategori ini tidak dapat di hapus, karena ada event yang menggunakannya');
                redirect('admin/kategori-event');    
            } else {
                $this->mCategory->delete($id);
                $this->session->set_flashdata('flash', 'Dihapus');
                redirect('admin/kategori-event');
            }
            
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }

}