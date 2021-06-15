<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Dashboard extends CI_Controller {

	private $sessionData;
	private $attribPage;
	private $attribThisPage;
	private $accessName = 'Dashboard';
	private $activityName = 'Visit';

	function __construct() {

		parent::__construct();
		// backButtonHandle();

		$this->load->library(array(
								'throttle_lib'
							));

		$this->load->model(array(
								'franchise_model',
								'article_model',
								'log_activity_model',
								'log_visitor_model'
							));

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

	}
	// End of function __construct

	function index() {

		$this->log_activity_lib->log($this->accessName, $this->activityName);

		$addAttribPage = array(
								'sublinkMenu' => '',
								'subtitleMenu' => '',
								'countFranchise' => $this->franchise_model->count_all_data(),
								'countArticle' => $this->article_model->count_all_data(),
								'countVisitor' => $this->log_visitor_model->count_visitor()
							);

		$viewData = array_merge($this->attribPage, $this->attribThisPage, $addAttribPage);

		$this->template_lib->webadmin_default_template('webadmin/dashboard/index', $viewData);

	}
	// End of function index

	function destroy_session() {

		$userId = $this->sessionData['userId'];

		$userFullName = $this->sessionData['userFullName'];

		$activityName = 'Sign Out';

		$this->log_activity_lib->log($this->accessName, $this->activityName);

		$this->session_lib->destroy_session();

		redirect('signin', 'refresh');
	}
	// End of function destroy_session

}

/*
	End of class Dashboard
	End of file Dashboard.php
	Location: ./application/controllers/Dashboard.php
*/