<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $models = array(
            'Admin/News_model' => 'mNews', 
            'Admin/News_category_model' => 'mNewsCategory'
        );
        $this->load->model($models);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $news = $this->mNews->getAll();

        $data = array(
            'title'     => 'Berita',
            'news_data' => $news,
        );
        $this->load->view('_admin/news/v_news',$data);
    }

    public function create($error = null) 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('admin/artikel/aksi-tambah'),
            'title' => 'Tambah Berita',
            'news_id' => set_value('news_id'),
            'news_title' => set_value('news_title'),
            'news_content' => set_value('news_content'),
            'news_category' => set_value('news_category'),
            'news_image' => set_value('news_image'),
            'news_admin' => set_value('news_admin'),
            'kategori_berita' => $this->mNewsCategory->getAll(),
            'error' => $error,
        );
        $this->load->view('_admin/news/v_newsForm',$data);
    }
    
    public function create_action() 
    {
        $this->form_validation->set_rules('news_title', 'news title', 'trim|is_unique[news.title]',
                    array('is_unique' => 'Judul artikel sudah digunakan, coba yang lain') );
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $title    = $this->input->post('news_title',TRUE);
            $content  = $this->input->post('news_content',TRUE);
            $category = $this->input->post('news_category',TRUE);
            $slug_fl1 = str_replace("?","", $title);
            $slug_fl2 = str_replace("$","", $slug_fl1);
            $slug     = strtolower(str_replace(" ","-",$slug_fl2));

            $ext = pathinfo($_FILES['news_image']['name'], PATHINFO_EXTENSION);

            // File Gambar
            $config['upload_path']      = './assets/images/images-berita/';
            $config['allowed_types']    = 'jpg|png';
            $config['overwrite']		= true;
            $config['max_size']         = 1000; // 1MB
            $config['file_name']        = time(). '.' . $ext;
            
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('news_image')) {
                $dataCover = array('upload_data' => $this->upload->data());
                $beritaCover = $dataCover['upload_data']['file_name'];
                $data = array(
                    'title' => $title,
                    'slug' => $slug,
                    'content' => $content,
                    'category' => $category,
                    'image' => $beritaCover,
                    'created_by' => $this->session->userdata('_id'),
                );
                $this->mNews->insert($data);
                $this->session->set_flashdata('flash', 'Ditambahkan');
                redirect('admin/artikel');
            } else {
                $error = $this->upload->display_errors();
                $this->create($error);
                $beritaCover = null;
            }
        }
    }
    
    public function update($id, $error = null) 
    {
        $row = $this->mNews->getById($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('admin/artikel/'.$id.'/aksi-edit'),
                'title' => 'Berita',
                'news_id' => set_value('news_id', $row->id),
                'news_title' => set_value('news_title', $row->title),
                'news_content' => set_value('news_content', $row->content),
                'news_category' => set_value('news_category', $row->category),
                'slug' => set_value('slug', $row->slug),
                'news_image' => set_value('news_image', $row->image),
                'news_image_new' => set_value('news_image_new'),
                'kategori_berita' => $this->mNewsCategory->getAll(),
                'error' => $error,
            );
            $this->load->view('_admin/news/v_newsForm',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('news'));
        }
    }
    
    public function update_action($id) 
    {
        if ($this->input->post('news_id', TRUE) == $id) {
            $this->form_validation->set_rules('news_title', 'news title', 'trim');
        } else {
            $this->form_validation->set_rules('news_title', 'news title', 'trim|is_unique[news.title]',
                    array('is_unique' => 'Judul artikel sudah digunakan, coba yang lain') );
        }        
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('news_id', TRUE));
        } else {
            $newsId   = $this->input->post('news_id',TRUE);
            $title    = $this->input->post('news_title',TRUE);
            $content  = $this->input->post('news_content',TRUE);
            $category = $this->input->post('news_category',TRUE);
            $slug_fl1 = str_replace("?","", $title);
            $slug_fl2 = str_replace("$","", $slug_fl1);
            $slug     = strtolower(str_replace(" ","-",$slug_fl2));
            $old_image= $this->input->post('news_image',TRUE);

            $ext = pathinfo($_FILES['news_image_new']['name'], PATHINFO_EXTENSION);

            // File Gambar
            $config['upload_path']      = './assets/images/images-berita/';
            $config['allowed_types']    = 'jpg|png';
            $config['overwrite']		= true;
            $config['max_size']         = 1000; // 1MB
            $config['file_name']        = time(). '.' . $ext;
            
            $this->load->library('upload', $config);
            
            if ($this->upload->do_upload('news_image_new')) {
                $dataCover = array('upload_data' => $this->upload->data());
                $beritaCover = $dataCover['upload_data']['file_name'];
                $data = array(
                    'id'       => $newsId,
                    'title'    => $title,
                    'slug'     => $slug,
                    'content'  => $content,
                    'category' => $category,
                    'image'    => $beritaCover,
                );
                $this->mNews->update($newsId, $data);
                unlink('./assets/images/images-berita/'.$old_image);
                $this->session->set_flashdata('flash', 'Diubah');
                redirect('admin/artikel');
            } elseif (empty($_FILES['news_image_new']['name'])) {
                $data = array(
                    'id'       => $newsId,
                    'slug'     => $slug,
                    'title'    => $title,
                    'content'  => $content,
                    'category' => $category,
                    'image'    => $old_image,
                );
                $this->mNews->update($newsId, $data);
                $this->session->set_flashdata('flash', 'Diubah');
                redirect('admin/artikel');
            } else {
                $error = $this->upload->display_errors();
                $this->update($newsId,$error);
                $beritaCover = null;
            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->mNews->getById($id);

        if ($row) {            
            $this->mNews->delete($id);
            unlink('./assets/images/images-berita/'.$row->image);
            $this->session->set_flashdata('flash', 'Dihapus');
            redirect('admin/artikel');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect('admin/artikel');
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('news_content', 'news content', 'trim|required');
        $this->form_validation->set_rules('news_category', 'news category', 'trim');
        $this->form_validation->set_rules('news_image', 'news image', 'trim');
        $this->form_validation->set_rules('news_admin', 'news admin', 'trim');

        $this->form_validation->set_rules('news_id', 'news_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}