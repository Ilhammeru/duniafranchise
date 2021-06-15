<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Article extends CI_Controller {

	private $attribThisPage;

    private $accessName = 'Article';

	private $topBannerImgPath = './images/top_banner/';
	private $articleThumbnailImgPath = './images/article/thumbnail/';
    private $franchiseThumbnailImgPath = './images/franchise/thumbnail/';
    private $franchiseBannerImgPath = './images/franchise/banner/';

	function __construct() {

		parent::__construct();

		$this->load->model(array(
								'top_banner_model',
								'article_model',
                                'franchise_model'
							));
		
        $this->attribPage = $this->web_config_lib->attrib_page();

        $this->attribThisPage = array(
                                    'titlePageRight' => $this->accessName,
                                );

       $this->load->helper('url');
       $this->load->library('pagination');
       $this->load->database();

	}
	// End of function __construct

	function index() {

        if ($this->agent->is_mobile()) {

            $addAttribPage = array(
                            'topBannerImgPath' => $this->topBannerImgPath,
                            'topBanner' => $this->top_banner_model->get_top_banner_rand(),
                            'articleThumbnailImgPath' => base_url() . substr($this->articleThumbnailImgPath, 2),
                            'log' => $this->accessName,
                            'franchiseBannerImgPath' => base_url() . substr($this->franchiseBannerImgPath, 2)
                        );

        } else {

            $addAttribPage = array(
							'topBannerImgPath' => $this->topBannerImgPath,
							'topBanner' => $this->top_banner_model->get_all_top_banner_active(),
							'articleThumbnailImgPath' => base_url() . substr($this->articleThumbnailImgPath, 2),
                            'log' => $this->accessName,
                            'franchiseBannerImgPath' => base_url() . substr($this->franchiseBannerImgPath, 2)
						);

        }

		$data = array_merge($this->attribPage, $this->attribThisPage, $addAttribPage);

        if ($this->agent->is_mobile()) {

            $this->template_lib->webpublic_header_mobile_app($data);
            $this->load->view('webpublic/template-mobile/article-list-mobile-app', $data);
            $this->template_lib->webpublic_footer_mobile_app($data);

        } else {

    		$this->template_lib->webpublic_header_app($data);
    		$this->template_lib->webpublic_top_banner_app($data);
    		$this->load->view('webpublic/article/article-list', $data);
    		$this->template_lib->webpublic_footer_app($data);

        }

	}
	// End of function index

	public function loadRecord($rowno = 0){

        $sort = $this->input->post('sort');
 
        $rowperpage = $this->input->post('rowperpage');
 
        if($rowno != 0){
          $rowno = ($rowno - 1) * $rowperpage;
        }
  
        $allcount = $this->article_model->count_all_data_active();

        $this->db->where('status', 1);

        switch ($sort) :

            case 'alfabet-asc';

                $this->db->order_by('title', 'asc');

                break;

            case 'alfabet-desc':

                $this->db->order_by('title', 'desc');

                break;

            default :

                $this->db->order_by('id', 'desc');

                break;

        endswitch;
         
        $this->db->limit($rowperpage, $rowno);

        $users_record = $this->db->get('article')->result_array();
  
        $config['base_url'] = site_url('webpublic/article/loadRecord');
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;
 
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';

        $config['num_tag_open'] = '<span class="page-link">';
        $config['num_tag_close'] = '</span>';

        $config['cur_tag_open'] = '<span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span>';

        $config['next_tag_open'] = '<span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span>';

        $config['prev_tag_open'] = '<span class="page-link">';
        $config['prev_tag_close'] = '</span>';

        $config['first_tag_open'] = '<span class="page-link">';
        $config['first_tag_close'] = '</span>';

        $config['last_tag_open'] = '<span class="page-link">';
        $config['last_tag_close'] = '</span>';
 
        $this->pagination->initialize($config);
 
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $users_record;
        $data['row'] = $rowno;
 
        echo json_encode($data);
  	}

    function detail($slug = "") {

        $query = $this->db->query("SELECT id FROM article WHERE slug = '$slug'")->num_rows();

        if ($query > 0) {

            if ($this->agent->is_mobile()) {

                $addAttribPage = array(
                                    'article' => $this->article_model->get_article_by_slug($slug, 'title, content, thumbnail'),
                                    'articleThumbnailImgPath' => base_url() . substr($this->articleThumbnailImgPath, 2),
                                    'franchiseRand' => $this->franchise_model->get_franchise_rand('*', 6),
                                    'franchiseThumbnailImgPath' => base_url() . substr($this->franchiseThumbnailImgPath, 2),
                                    'franchiseBannerImgPath' => base_url() . substr($this->franchiseBannerImgPath, 2),
                                    'slug' => $slug,
                                    'log' => $slug
                                );

            } else {

                $addAttribPage = array(
                                    'topBannerImgPath' => $this->topBannerImgPath,
                                    'topBanner' => $this->top_banner_model->get_all_top_banner_active(),
                                    'article' => $this->article_model->get_article_by_slug($slug, 'title, content'),
                                    'articleThumbnailImgPath' => base_url() . substr($this->articleThumbnailImgPath, 2),
                                    'slug' => $slug,
                                    'log' => $slug,
                                    'franchiseRand' => $this->franchise_model->get_franchise_rand('*', 6),
                                    'franchiseThumbnailImgPath' => base_url() . substr($this->franchiseThumbnailImgPath, 2),
                                    'franchiseBannerImgPath' => base_url() . substr($this->franchiseBannerImgPath, 2)
                                );

            }

            $data = array_merge($this->attribPage, $this->attribThisPage, $addAttribPage);

            if ($this->agent->is_mobile()) {

                $this->template_lib->webpublic_header_mobile_app($data);
                $this->load->view('webpublic/template-mobile/article-detail-mobile-app', $data);
                $this->template_lib->webpublic_footer_mobile_app($data);

            } else {

                $this->template_lib->webpublic_header_app($data);
                $this->template_lib->webpublic_top_banner_app($data);
                $this->load->view('webpublic/article/article-detail', $data);
                $this->template_lib->webpublic_footer_app($data);

            }

        } else {
            redirect('404_override');
        }

    }
    // End of function detail

}

/*
	End of class Article
	End of file Article.php
	Location: ./application/controllers/webpublic/Article.php
*/