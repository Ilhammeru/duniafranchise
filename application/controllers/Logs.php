<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Controller {

	private $sessionData;	
	private $accessName = 'Logs Report';
	private $activityName = 'Visit';
	
	function __construct() {

		parent::__construct();

		$this->load->model(array(
								'log_activity_model',
								'log_visitor_model'
								));

		$this->sessionData = $this->session_lib->get_session();

		$this->attribPage = $this->web_config_lib->attrib_page();

		$this->attribThisPage = array(
									'sessionData' => $this->sessionData,
									'accessName' => $this->accessName,
									'titlePageRight' => 'Log Visitor',
									'titleMenu' => '<i class="fa fa-list-alt"></i> Log Visitor',
									'linkMenu' => '<li>
													<a href="' . site_url('logs') . '" data-toggle="tooltip" data-placement="top" title="Visit to Log Visitor">
														<i class="fa fa-list-alt"></i> Logs
													</a>
												</li>',
									'helpMode' => $this->sessionData['helpModeValue']
									);

	}
	// End of function __construct

	function logs_report() {

		$this->session_lib->check_permission_with_redirect_page($this->accessName);

		$this->log_activity_lib->log($this->accessName, $this->activityName);

		$addAttribPage = array(
								'subtitleMenu' => '<i class="fa fa-list-alt"></i> Report',
								'sublinkMenu' => '<li class="active">
													<i class="fa fa-list-alt"></i> Report
												</li>',
								'filterUser' => $this->filter_user(),
								'filterAccess' => $this->filter_access()
							);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_default_template('webadmin/user_mg/logs/index', $viewData);

	}
	// End of function logs_report

	function filter_user() {

		return $this->web_config_lib->get_creator('log_activity', 'log_activity.user_id');

	}
	// End of function filter_user

	function filter_access() {

		$access = $this->log_activity_model->get_access_in_log();

		$html = '<select class="form-control select2" multiple><option disabled>Search Access</option>';

		foreach ($access as $row) :

			$html .= '<option>' . $row->access_name . '</option>';

		endforeach;

		return $html;

	}
	// End of function filter_access

	function get_data_log_activity() {

		$getDataLogActivity = $this->log_activity_model->get_log_using_server_side();

		$data = array();

		foreach ($getDataLogActivity as $field):

			$row = array();

			$row[] = date_format(date_create($field->time), 'd M Y H:i:s');

			$row[] = $field->log;

			$row[] = $field->user_fullname;

			$row[] = $field->access_name;

			$data[] = $row;

		endforeach;

		$output = array(
						"draw" => $_POST['draw'],
            			"recordsTotal" => $this->log_activity_model->count_all_data(),
            			"recordsFiltered" => $this->log_activity_model->count_filtered(),
						"data" => $data
					);

		echo json_encode($output);

	}
	// End of function get_data_log_activity

	function get_data_log_activity_by_user_id($userId = 0) {

		$getDataLogActivity = $this->log_activity_model->get_log_by_user_id_using_server_side($userId);

		$data = array();

		foreach ($getDataLogActivity as $field):

			$row = array();

			$row[] = date_format(date_create($field->time), 'd M Y H:i:s');

			$row[] = $field->log;

			$data[] = $row;

		endforeach;

		$output = array(
						"draw" => $_POST['draw'],
            			"recordsTotal" => $this->log_activity_model->count_by_user_id($userId),
            			"recordsFiltered" => $this->log_activity_model->count_by_user_id_filtered($userId),
						"data" => $data
					);

		echo json_encode($output);

	}
	// End of function get_data_log_activity_by_user_id

	function logs_visitor_report() {

		$this->session_lib->check_permission_with_redirect_page($this->accessName);

		$this->log_activity_lib->log($this->accessName, $this->activityName);

		$addAttribPage = array(
								'subtitleMenu' => '<i class="fa fa-list-alt"></i> Report',
								'sublinkMenu' => '<li class="active">
													<i class="fa fa-list-alt"></i> Report
												</li>',
								'filterUser' => $this->filter_user(),
								'filterAccess' => $this->filter_access()
							);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_default_template('webadmin/user_mg/logs/visitor', $viewData);

	}
	// End of function logs_visitor_report

	function get_data_log_visitor() {

		$getDataLogVisitor = $this->log_visitor_model->get_log_using_server_side();

		$data = array();

		foreach ($getDataLogVisitor as $field):

			$row = array();

			$row[] = date_format(date_create($field->time), 'd M Y H:i:s');

			$row[] = $field->ip_address;

			$row[] = $field->log;

			$row[] = $field->access_name;

			$row[] = $field->location;

			$data[] = $row;

		endforeach;

		$output = array(
						"draw" => $_POST['draw'],
            			"recordsTotal" => $this->log_visitor_model->count_all_data(),
            			"recordsFiltered" => $this->log_visitor_model->count_filtered(),
						"data" => $data
					);

		echo json_encode($output);

	}
	// End of function get_data_log_visitor

}

/*
	End of class Logs
	End of file Logs.php
	Location: ./application/controllers/Logs.php
*/