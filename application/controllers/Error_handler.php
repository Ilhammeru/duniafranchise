<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Error_handler extends CI_Controller {

	private $sessionData;
	private $attribPage;
	private $attribThisPage;
	private $accessName = 'Error';
	private $activityName = 'Visit';

	function __construct() {

		parent::__construct();

	}
	// End of function __construct

	function error_access_denied() {

		$this->sessionData = $this->session_lib->get_session();

		$this->attribPage = $this->web_config_lib->attrib_page();

		$this->attribThisPage = array(
									'sessionData' => $this->sessionData,
									'accessName' => $this->accessName,
									'titlePageRight' => $this->accessName,
									'titleMenu' => $this->accessName,
									'linkMenu' => '',
									'helpMode' => $this->sessionData['helpModeValue']
									);

		$addAttribPage = array(
							'sublinkMenu' => '',
							'subtitleMenu' => '',
							'corporation' => $this->web_config_lib->get_corporation()
							);

		$viewData = array_merge($addAttribPage, $this->attribThisPage, $this->attribPage);

		$this->template_lib->webadmin_header_error($viewData);

		$this->load->view('webadmin/error/access-denied', $viewData);

	}
	// End of function error_access_denied

	function error_404() {

		$this->attribPage = $this->web_config_lib->attrib_page();

		$this->attribThisPage = array(
									'titlePageRight' => 'Error 404',
								);

		$data = array_merge($this->attribPage, $this->attribThisPage);
		
        if ($this->agent->is_mobile()) {
			
			$this->template_lib->webpublic_mobile_error_404($data);

		} else {

			$this->template_lib->webpublic_website_error_404($data);

		}
		
	}
	// End of function error_404

}

/*
	End of class Error_handler
	End of file Error_handler.php
	Location: ./application/controllers/Error_handler.php
*/