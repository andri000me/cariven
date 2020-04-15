<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('News_model','mNews');
        $this->load->library('form_validation');
    }

    function index()
    {
        // load librari
        $this->load->library('pagination');
                    
        // Pagination
        $config['base_url']   = base_url('news/index');
        $config['total_rows'] = $this->mNews->countAllnews();
        $config['per_page']   = 3;

        // styling
        $config['full_tag_open'] = '<nav class="blog-pagination justify-content-center d-flex"><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        // initialise
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        $data['news_data'] = $this->mNews->get_news($config['per_page'],$data['start']);
        $data['latest']    = $this->mNews->getLatestNews();
        $data['category']  = $this->mNews->getCategory();
        $data['popular']   = $this->mNews->getPopularNews();
        
        $this->load->view('news/news_list', $data);
    }

    function read($slug)
    {
        $row = $this->mNews->getBySlug($slug);

        // update count
        $this->mNews->increaseReader($row->id);

        $popular_news  = $this->mNews->getPopularNews();
        $category_news = $this->mNews->getCategory();

        if ($row) {
            $data = array(
                'news_id'       => $row->id,
                'news_title'    => $row->title,
                'news_content'  => $row->content,
                'news_category' => $row->category_name,
                'slug'          => $row->slug,
                'news_image'    => $row->image,
                'news_count'    => $row->views_count,
                'news_admin'    => $row->user_name,
                'news_created'  => $row->created_at,
                'popular'       => $popular_news,
                'category'      => $category_news,
            );
            $this->load->view('news/news_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('artikel'));
        }
    }

    function categoryNews($category)
    {
        $news = $this->mNews->getByCategory($category);

        $popular_news  = $this->mNews->getPopularNews();
        $category_news = $this->mNews->getCategory();

        $data = array(
            'news_data'    => $news,
            'popular'      => $popular_news,
            'category'     => $category_news,
            'category_name'=> $category,
        );
        $this->load->view('news/news_category', $data);
    }

    function search_news()
    {
        $v = $this->input->get('v');

        $news          = $this->mNews->search_news($v);
        $popular_news  = $this->mNews->getPopularNews();
        $category_news = $this->mNews->getCategory();

        $data = array(
            'news_data' => $news,
            'popular'   => $popular_news,
            'category'  => $category_news,
        );
        $this->load->view('news/v_search_news', $data);

    }

}