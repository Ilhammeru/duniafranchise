<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Home extends CI_Controller {

	private $attribThisPage;

	private $accessName = 'Home';

	private $topBannerImgPath = './images/top_banner/';
	private $franchiseTopBannerImgPath = './images/franchise/top-banner/';
	private $franchiseThumbnailImgPath = './images/franchise/thumbnail/';
    private $franchiseBannerImgPath = './images/franchise/banner/';

	public function __construct() {

		parent::__construct();

		$this->load->model(array(
								'top_banner_model',
								'about_us_model',
								'franchise_model',
								'article_model'
							));

		$this->attribPage = $this->web_config_lib->attrib_page();

		$this->attribThisPage = array(
									'titlePageRight' => $this->accessName,
								);

	}
	// End of function __construct

	function index() {

		if ($this->agent->is_mobile()) {

			$addAttribPage = array(
							'topBannerImgPath' => $this->topBannerImgPath,
							'topBanner' => $this->top_banner_model->get_all_top_banner_active(),
							'aboutUs' => $this->about_us_model->get_about_us(),
							'franchiseRand' => $this->franchise_model->get_franchise_rand('franchise_name, thumbnail, text, slug', 8),
							'franchiseThumbnailImgPath' => base_url() . substr($this->franchiseThumbnailImgPath, 2),
							'franchiseTopBannerImgPath' => base_url() . substr($this->franchiseTopBannerImgPath, 2),
							'article' => $this->article_model->get_article_recently_added('title, slug'),
							'log' => $this->accessName,
                            'franchiseBannerImgPath' => base_url() . substr($this->franchiseBannerImgPath, 2)
						);

		} else {

			$addAttribPage = array(
							'topBannerImgPath' => $this->topBannerImgPath,
							'topBanner' => $this->top_banner_model->get_all_top_banner_active(),
							'aboutUs' => $this->about_us_model->get_about_us(),
							'franchiseRand' => $this->franchise_model->get_franchise_rand('franchise_name, thumbnail, text, slug', 12),
							'franchiseThumbnailImgPath' => base_url() . substr($this->franchiseThumbnailImgPath, 2),
							'article' => $this->article_model->get_article_recently_added('title, slug'),
							'log' => $this->accessName,
                            'franchiseBannerImgPath' => base_url() . substr($this->franchiseBannerImgPath, 2)
						);

		}

		$data = array_merge($this->attribPage, $this->attribThisPage, $addAttribPage);

		if ($this->agent->is_mobile()) {

			$this->template_lib->webpublic_header_mobile_app($data);
			$this->template_lib->webpublic_home_mobile_app($data);
			$this->template_lib->webpublic_footer_mobile_app($data);

		} else {

			$this->template_lib->webpublic_header_app($data);
			$this->template_lib->webpublic_top_banner_app($data);
			$this->template_lib->webpublic_home_app($data);
			$this->template_lib->webpublic_footer_app($data);

		}

	}
	// End of function index

	function search() {

		$key = $this->input->get('key');

		$getFranchiseData = $this->franchise_model->get_franchise_by_search($key, '*');

		$getArticleData = $this->article_model->get_article_by_search($key, '*');

		if ($this->agent->is_mobile()) {

			$addAttribPage = array(
								'franchises' => $getFranchiseData,
								'news' => $getArticleData,
                                'article' => $this->article_model->get_article_recently_added('title, slug'),
								'log' => $key
							);
			
		} else {

			$addAttribPage = array(
								'franchises' => $getFranchiseData,
								'news' => $getArticleData,
                                'article' => $this->article_model->get_article_recently_added('title, slug'),
								'log' => $key
							);

		}

		$data = array_merge($this->attribPage, $this->attribThisPage, $addAttribPage);

		if ($this->agent->is_mobile()) {

			$this->template_lib->webpublic_header_mobile_app($data);
			$this->load->view('webpublic/template-mobile/search-mobile-app', $data);
			$this->template_lib->webpublic_footer_mobile_app($data);

		} else {

			$this->template_lib->webpublic_header_app($data);
			$this->load->view('webpublic/template/search', $data);
			$this->template_lib->webpublic_footer_app($data);

		}

	}
	// End of function serach

	function get_location() {

		$accessName = $this->input->post('accessName');

		$location = $this->input->post('location');

		$log = $this->input->post('log');

		$this->log_activity_lib->log_visitor($location, $accessName, $log);
	}
	// End of function get_location

}

/*
	End of class Home
	End of file Home.php
	Location: ./application/controllers/webpublic/Home.php
*/