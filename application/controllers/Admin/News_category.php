<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News_category extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        
        $this->load->model('Admin/News_category_model','mNewsCategory');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $news_category = $this->mNewsCategory->getAll();

        $data = array(
            'title'              => 'Kategori Artikel',
            'news_category_data' => $news_category,
        );
        $this->load->view('_admin/dataMaster/v_newsCategory',$data);
    }

    public function create() 
    {
        $data = array(
            'name' => ucwords(trim($this->input->post('ncategory_name',TRUE))),
        );

        $this->mNewsCategory->insert($data);
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('admin/kategori-artikel');
    }
    
    public function update($id) 
    {
        $data = array(
            'name' => ucwords(trim($this->input->post('ncategory_name',TRUE))),
        );
    
        $this->mNewsCategory->update($id, $data);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('admin/kategori-artikel');
    }
    
    public function delete($id) 
    {
        $row = $this->mNewsCategory->getById($id);

        if ($row) {
            $isUsed = $this->mNewsCategory->checkUsedNewsCategory($id);
            if ($isUsed > 0) {
                $this->session->set_flashdata('message', 'Kategori ini tidak dapat di hapus, karena ada event yang menggunakannya');
                redirect('admin/kategori-artikel');    
            } else {
                $this->mNewsCategory->delete($id);
                $this->session->set_flashdata('flash', 'Dihapus');
                redirect('admin/kategori-artikel');
            }
        } else {
            echo "<script>history.go(-1)</script>";
        }
    }
}