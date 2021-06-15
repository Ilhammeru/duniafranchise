<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Template_lib
{

	protected $CI;

	function __construct()
	{

		$this->CI = &get_instance();
	}
	// End of function __counstruct

	function webadmin_header_login($data = '')
	{

		$this->CI->load->view('webadmin/template/header-login', $data);
	}
	// End of function webadmin_header_login

	function webadmin_header_app($data = '')
	{

		$this->CI->load->view('webadmin/template/header-app', $data);
	}
	// End of function webadmin_header

	function webadmin_sidebar_app($data = '')
	{

		$this->CI->load->view('webadmin/template/sidebar-app', $data);
	}
	// End of function webadmin_sidebar_app

	function webadmin_footer_app($data = '')
	{

		$this->CI->load->view('webadmin/template/footer-app', $data);
	}
	// End of function webadmin_footer_app

	function webadmin_sidebar_profile($data = '')
	{

		$this->CI->load->view('webadmin/template/sidebar-user-profile', $data);
	}
	// End of function webadmin_sidebar_profile

	function webadmin_default_template($contentSource = '', $data = '')
	{

		$this->webadmin_header_app($data);

		$this->webadmin_sidebar_app($data);

		$this->CI->load->view($contentSource, $data);

		$this->webadmin_footer_app($data);
	}
	// End of function webadmin_default_template

	function webpublic_header_app($data = '')
	{

		$this->CI->load->view('webpublic/template/header-app', $data);
	}
	// End of function webpublic_header_app

	function webpublic_footer_app($data = '')
	{

		$this->CI->load->view('webpublic/template/footer-app', $data);
	}
	// End of function webpublic_footer_app

	function webpublic_home_app($data = '')
	{

		$this->CI->load->view('webpublic/template/home-app', $data);
	}
	// End of function webpublic_home_app

	function webpublic_top_banner_app($data = '')
	{

		$this->CI->load->view('webpublic/template/top-banner-app', $data);
	}
	// End of function webpublic_top_banner_app

	function webadmin_header_error($data = '')
	{

		$this->CI->load->view('webadmin/template/header-error', $data);
	}
	// End of function webadmin_header_error

	function webpublic_header_mobile_app($data = '')
	{

		$this->CI->load->view('webpublic/template-mobile/header-mobile-app', $data);
	}
	// End of function webpublic_header_mobile_app

	function webpublic_home_mobile_app($data = '')
	{

		$this->CI->load->view('webpublic/template-mobile/home-mobile-app', $data);
	}
	// End of function webpublic_home_mobile_app

	function webpublic_footer_mobile_app($data = '')
	{

		$this->CI->load->view('webpublic/template-mobile/footer-mobile-app', $data);
	}
	// End of function webpublic_footer_mobile_app

	function webpublic_mobile_error_404($data)
	{

		$this->webpublic_header_mobile_app($data);
		$this->CI->load->view('errors/404-mobile');
	}
	// End of function webpublic_mobile_error_404

	function webpublic_website_error_404($data)
	{

		$this->webpublic_header_app($data);
		$this->CI->load->view('errors/404');
	}
	// End of function webpublic_website_error_404

	function webadmin_box_template($view, $data)
	{

		$this->webadmin_header_app($data);
		$this->webadmin_sidebar_app($data);
		$this->CI->load->view($view, $data);
		$this->webadmin_footer_app($data);
	}
	// End of function webadmin_box_template

	// ################################# template for ayowaralaba ######################################
	function ayo_header($data)
	{
		$this->CI->load->view('ayowaral/template/header', $data);
	}

	function ayo_top_banner($data = '', $view)
	{
		$base = 'https://duniafranchise.com/ayowaral-images/';

		// top banner 
		$topBanner = $this->CI->db->query("SELECT image_banner, franchise_id
                                            FROM wm_topbanner
                                            WHERE is_active = 1");

		if ($topBanner->num_rows() > 0) {
			foreach ($topBanner->result() as $tp) {
				$topImg[] = $base . 'topbanner/' . $tp->image_banner;
				$topId[] = $tp->franchise_id;
			}
		} else {
			$topImg[] = '';
			$topId[] = '';
		}

		$firstTopImg = $topImg[0];
		// end top banner
		$data['topImg'] 		= $topImg;
		$data['topId']			= $topId;
		$data['firstTopImg']	= $firstTopImg;

		$this->CI->load->view($view, $data);
	}

	function ayo_main_content($data, $view)
	{
		$base = 'https://duniafranchise.com/ayowaral-images/';
		// premium banner 
		$premBanner = $this->CI->db->query("SELECT image_banner, franchise_id
                                                FROM wm_premiumbanner
                                                WHERE is_active = 1
                                                ORDER BY RAND()");

		if ($premBanner->num_rows() > 0) {
			foreach ($premBanner->result() as $pr) {
				$premImg[]  = $base . 'premiumbanner/' . $pr->image_banner;
				$premId[]   = $pr->franchise_id;
			}
		} else {
			$premImg[] = '';
			$premId[] = 0;
		}
		// end premium banner

		//left banner 
		$leftBanner = $this->CI->db->query("SELECT image_banner, franchise_id
                                                FROM wm_leftbanner
                                                WHERE is_active = 1
                                                ORDER BY RAND()");

		if ($leftBanner->num_rows() > 0) {
			foreach ($leftBanner->result() as $lf) {
				$leftImg[]  = $base . 'leftbanner/' . $lf->image_banner;
				$leftId[]   = $lf->franchise_id;
			}
		} else {
			$leftImg[] = '';
			$leftId[] = 0;
		}
		// end left banner

		// article
		$art = $this->CI->db->query("SELECT id, title 
                                        FROM article
                                        WHERE status = 1
                                        LIMIT 4");

		if ($art->num_rows() > 0) {
			foreach ($art->result() as $ar) {
				$artTitle[]     = $ar->title;
				$artId[]        = $ar->id;
			}
		} else {
			$artTitle[] = '';
			$artId[] = 0;
		}
		// end article

		//right banner 
		$rightBanner = $this->CI->db->query("SELECT image_banner, franchise_id
                                                FROM wm_rightbanner
                                                WHERE is_active = 1
                                                ORDER BY RAND()");

		if ($rightBanner->num_rows() > 0) {
			foreach ($rightBanner->result() as $rb) {
				$rightImg[] = $base . 'rightbanner/' . $rb->image_banner;
				$rightId[]  = $rb->franchise_id;
			}
		} else {
			$rightImg[] = '';
			$rightId[] = 0;
		}
		// end right banner

		$data['premImg']        = $premImg;
		$data['premId']         = $premId;
		$data['leftImg']        = $leftImg;
		$data['leftId']			= $leftId;
		$data['artTitle']       = $artTitle;
		$data['artId']          = $artId;
		$data['rightImg']       = $rightImg;
		$data['rightId']        = $rightId;

		$this->CI->load->view($view, $data);
	}

	function ayo_footer($data)
	{
		$this->CI->load->view('ayowaral/template/footer', $data);
	}
	// end of function ayo_header
	// ################################# end template for ayowaralaba ######################################

}

/*
	End of class Template_lib
	End of file Template_lib.php
	Location: ./application/libraries/Template_lib.php
*/