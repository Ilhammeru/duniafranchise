<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Web_config_lib {

	protected $CI;
	private $userSession;
	private $userID;

	private $messageSuccessfullySaved = 'The data has been successfully saved';
	private $messageSuccessfullyUpdated = 'The data has been successfully updated';
	private $messageSuccessfullyDeleted = 'The data has been successfully deleted';
	private $spinnerPath = 'assets/img/spinner/spinner.gif';

	function __construct() {

		$this->CI =& get_instance();

		$this->CI->load->model(array(
								'web_config_model'
							));

		$this->CI->load->library('session_lib');

		$this->userSession = $this->CI->session->userdata('name');

		$this->userID = $this->CI->session->userdata('id');

	}
	// End of function __counstruct
	
	function get_web_application() {

		$version = $this->CI->web_config_model->get_version();

		$applicationName = $this->CI->web_config_model->get_application_name();

		$result = array(
					'version' => $version,
					'name' => $applicationName
				);

		return $result;
	}
	// End of function get_web_application

	function get_application_name() {

		$getWebApplication = $this->get_web_application();

		$name = $getWebApplication['name'];

		return $name;
	}
	// End of function application_name

	function get_application_version() {

		$getWebApplication = $this->get_web_application();

		$version = $getWebApplication['version'];

		return $version;

	}
	// End of function get_application_version

	function get_logo_dir() {

		$logoDir = $this->CI->web_config_model->get_logo_dir();

		return $logoDir;
	}
	// End of function get_logo_dir

	function get_logo2_dir() {

		$logoDir = $this->CI->web_config_model->get_logo2_dir();

		return $logoDir;
	}
	// End of function get_logo2_dir

	function get_logomini_dir() {

		$logominiDir = $this->CI->web_config_model->get_logomini_dir();

		return $logominiDir;
	}
	// End of function get_logomini_dir

	function get_corporation() {

		$corporationName = $this->CI->web_config_model->get_corporation_name();

		$corporationNickname = $this->CI->web_config_model->get_corporation_nickname();

		$corporationAddress = $this->CI->web_config_model->get_corporation_address();

		$result = array(
					'name' => $corporationName,
					'nickname' => $corporationNickname,
					'address' => $corporationAddress
				);

		return $result;
	}
	// End of function get_corporation

	function get_creator($table = '', $secondaryKey = '') {

		$user = $this->CI->web_config_model->get_creator_in_table($table, $secondaryKey);

		if ($user !== false) :

			$html = '<select class="form-control select2" multiple><option disabled>Search User</option>';

			foreach ($user as $row) :

				$html .= '<option value="' . $row->id . '">' . $row->name . '</option>';

			endforeach;

			$html .= '</select>';

			return $html;

		endif;

	}
	// End of function get_creator

	function get_updated_by($table = '', $secondaryKey = '') {

		$user = $this->CI->web_config_model->get_updated_by_in_table($table, $secondaryKey);

		if ($user !== false) :

			$html = '<select class="form-control select2" multiple><option disabled>Search User</option>';

			foreach ($user as $row) :

				$html .= '<option value="' . $row->id . '">' . $row->name . '</option>';

			endforeach;

			$html .= '</select>';

			return $html;

		endif;

	}
	// End of function get_updated_by

	function get_filter_status() {

		$html = '<select class="form-control input-sm select2 tb-search">';

		$html .= '<option disabled selected>Select Status</option>';

		$html .= '<option value="">All</option>';

		$html .= '<option value="1">Active</option>';

		$html .= '<option value="0">Not Active</option>';

		$html .= '</select>';

		return $html;

	}
	// End of function get_filter_status

	function attrib_page() {

		$attribPage = array(
						'spinner' => base_url() . $this->spinnerPath,
						'titlePageLeft' => $this->get_application_name(),
						'webApplication' => $this->get_web_application(),
						'logoDir' => $this->get_logo_dir(),
						'logo2Dir' => $this->get_logo2_dir(),
						'logominiDir' => $this->get_logomini_dir(),
						'homeLink' => '<li>
											<a href="' . base_url('dashboard') . '" data-toggle="tooltip" data-placement="top" title="Visit to Dashboard">
												<i class="fa fa-dashboard"></i>	Dashboard
											</a>
										</li>'
					);

		return $attribPage;
	}
	// End of function attrib_page

	function form_validation_set($config = '') {

		$this->CI->form_validation->set_rules($config);

		$this->CI->form_validation->set_error_delimiters('
														<label class="label label-danger"><i class="fa fa-ban"></i>',
														'</label>');

	}
	// End of function form_validation_set

	function alert_successfully($alert = 'saved', $message = '', $mode = 'flash') {

		$startStyle = '<p><label class="label label-success"><i class="fa fa-check"></i> ';

		$endStyle= '</label></p>';

		if (empty($message)) :

			switch ($alert) :

				case 'saved' :

					$message = $this->messageSuccessfullySaved;

					break;

				case 'updated' :

					$message = $this->messageSuccessfullyUpdated;

					break;

				case 'deleted' :

					$message = $this->messageSuccessfullyDeleted;

					break;

			endswitch;

		endif;

		switch ($mode) :

			case 'flash' :

				$result = $this->CI->session->set_flashdata('messageSuccess', $startStyle . $message . $endStyle);

				break;

			case 'text' :

				$result = $startStyle . $message . $endStyle;

				break;

			default :

				$result = $this->CI->session->set_flashdata('messageSuccess', $startStyle . $message . $endStyle);

				break;

		endswitch;

		return $result;

	}
	// End of function alert_successfully

	function alert_error($message = 'Error', $mode = 'flash') {

		$startStyle = '<p><label class="label label-danger"><i class="fa fa-ban"></i> ';

		$endStyle = '</label></p>';

		switch ($mode) :

			case 'flash' :

				$result = $this->CI->session->set_flashdata('message', $startStyle . $message . $endStyle);

				break;

			case 'text' :

				$result = $startStyle . $message . $endStyle;

				break;

			default :

				$result = $this->CI->session->set_flashdata('message', $startStyle . $message . $endStyle);

				break;

		endswitch;

		return $result;

	}
	// End of function alert_error

	function alert_info($message = '') {

		$startStyle = '<p><label class="label label-info"><i class="fa fa-info"></i> ';

		$endStyle= '</label></p>';

		switch ($mode) :

			case 'flash' :

				$result = $this->CI->session->set_flashdata('messageInfo', $startStyle . $message . $endStyle);

				break;

			case 'text' :

				$result = $startStyle . $message . $endStyle;

				break;

			default :

				$result = $this->CI->session->set_flashdata('messageInfo', $startStyle . $message . $endStyle);

				break;

		endswitch;

		return $result;
		
	}
	// End of function alert_info

	function alert_successfully_modal($alert = 'saved') {

		switch ($alert) :

			case 'saved' :

				$message = $this->messageSuccessfullySaved;

				break;

			case 'updated' :

				$message = $this->messageSuccessfullyUpdated;

				break;

			case 'deleted' :

				$message = $this->messageSuccessfullyDeleted;

				break;

			default :

				$message = 'Something wrong';

				break;

		endswitch;

		return $message;

	}
	// End of function alert_successfully_modal

	function button_edit($accessName = '', $key = '', $mode = 'link', $className = '') {

		switch ($mode) :

			case 'link' :

				$string = '<a href="' . site_url($key) . '" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-edit"></i></a>';

			break;

			case 'ajax' :

				$string = '<a href="javascript:void(0)" class="btn btn-default btn-xs ' . $className . '" code="' . $key . '" data-toggle="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-edit"></i></a>';

				break;

		endswitch;

		if (! empty($accessName)) :

			if ($this->CI->session_lib->check_permission($accessName) == 1) {

				$result = $string;

			} else {

				$result= '';

			}

		else :

			$result = $string;

		endif;

		return $result;

	}
	// End of function button_edit

	function button_delete($accessName = '', $key = '', $className = '') {

		$string = '<a href="javascript:void(0)" class="btn btn-default btn-xs ' . $className . '" code="' . $key . '" data-toggle="tooltip" data-placement="top" title="Delete Data"><i class="fa fa-trash-o"></i></a>';

		if (! empty($accessName)) :

			if ($this->CI->session_lib->check_permission($accessName) == 1) {

				$result = $string;

			} else {

				$result = '';

			}

		else :

			$result = $string;

		endif;

		return $result;

	}
	// End of function button_delete

	function button_detail($accessName = '', $key = '', $mode = 'link', $className = '') {

		switch ($mode) :

			case 'link' :

				$string = '<a href="' . site_url($key) . '" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="View Data"><i class="fa fa-eye"></i></a>';

			break;

			case 'ajax' :

				$string = '<a href="javascript:void(0)" class="btn btn-default btn-xs ' . $className . '" code="' . $key . '" data-toggle="tooltip" data-placement="top" title="View Detail"><i class="fa fa-eye"></i></a>';

				break;

		endswitch;

		if (! empty($accessName)) :

			if ($this->CI->session_lib->check_permission($accessName) == 1) {

				$result = $string;

			} else {

				$result = '';

			}

		else :

			$result = $string;

		endif;

		return $result;

	}
	// End of function button_detail

}

/* 
	End of class Web_config_lib
	End of file Web_config_lib.php
	Location: ./application/libraries/Web_config_lib.php 
*/