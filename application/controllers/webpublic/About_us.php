<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class About_us extends CI_Controller {

	private $attribThisPage;
	private $accessName = 'About Us';

	private $topBannerImgPath = './images/top_banner/';
	private $franchiseThumbnailImgPath = './images/franchise/thumbnail/';
	private $articleThumbnailImgPath = './images/article/thumbnail/';
    private $franchiseBannerImgPath = './images/franchise/banner/';

	private $aboutUsImgPath = './assets/img/about-us.jpg';

	function __construct() {

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
								'topBanner' => $this->top_banner_model->get_top_banner_rand(),
								'aboutUs' => $this->about_us_model->get_about_us(),
								'franchiseRand' => $this->franchise_model->get_franchise_rand('franchise_name, thumbnail, text, slug', 4),
								'franchiseThumbnailImgPath' => base_url() . substr($this->franchiseThumbnailImgPath, 2),
								'articleThumbnailImgPath' => base_url() . substr($this->articleThumbnailImgPath, 2),
								'aboutUsBanner' => base_url() . substr($this->aboutUsImgPath, 2),
								'articleRand' => $this->article_model->get_article_rand('*', 2),
								'log' => $this->accessName,
                            	'franchiseBannerImgPath' => base_url() . substr($this->franchiseBannerImgPath, 2)
							);

		} else {

			$addAttribPage = array(
								'topBannerImgPath' => $this->topBannerImgPath,
								'topBanner' => $this->top_banner_model->get_all_top_banner_active(),
								'aboutUs' => $this->about_us_model->get_about_us(),
								'log' => $this->accessName,
                            	'franchiseBannerImgPath' => base_url() . substr($this->franchiseBannerImgPath, 2)
							);

		}

		$data = array_merge($this->attribPage, $this->attribThisPage, $addAttribPage);

		if ($this->agent->is_mobile()) {

			$this->template_lib->webpublic_header_mobile_app($data);
			$this->load->view('webpublic/template-mobile/about-us-mobile-app', $data);
			$this->template_lib->webpublic_footer_mobile_app($data);

		} else {

			$this->template_lib->webpublic_header_app($data);
			$this->template_lib->webpublic_top_banner_app($data);
			$this->load->view('webpublic/template/about-us', $data);
			$this->template_lib->webpublic_footer_app($data);

		}

	}
	// End of function index

}

/*
	End of class About_us
	End of file About_us.php
	Location: ./application/controllers/webpublic/About_us.php
*/