<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Lockscreen extends CI_Controller {

	private $attribPage;
	private $accessName = 'Lockscreen';
	private $activityName = 'Sign In';
	private $accessTo = 'Dashboard';
	private $ipAddress;
	private $attribThisPage;

	function __construct() {

		parent::__construct();

		$this->load->library(array(
								'form_validation',
								));

		$this->load->model(array(
								'users_model'
								));

		$this->attribPage = $this->web_config_lib->attrib_page();

		$this->ipAddress = $this->input->ip_address();

		$this->attribThisPage = array(
									'titlePageRight' => $this->accessName
									);

	}
	// End of function __construct	

	function lockscreen_form($id = 0) {

		$config = array(
					array(
						'field' => 'inputPassword',
						'label' => 'Password',
						'rules' => 'required|min_length[8]'
					)
				);

		$this->web_config_lib->form_validation_set($config);

		if ($this->form_validation->run() == TRUE) {
			
			$userPassword = md5(md5(
								trim($this->input->post('inputPassword'))
							));

			if ($this->check_users_by_id_and_password($id, $userPassword) == 1) {

				$getLastAccess = $this->throttle_model->get_last_access($id);

				$param = 'update_record';

				$this->login_process($id, $param, $this->accessName, $getLastAccess);

			} else {

				$this->web_config_lib->alert_error('Error: Login failed, your password was incorrect');

				redirect('lockscreen/user_id/' . $id, 'location');

			}
			// End of check_users_by_id_and_password

		} else {

			$usersField = 'name, images';

			$addAttribPage = array(
							'corporation' => $this->web_config_lib->get_corporation(),
							'users' => $this->users_model->get_users_by_id($id, $usersField)
							);
			
			$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

			$this->template_lib->webadmin_header_login($viewData);
			$this->load->view('webadmin/login/lockscreen', $viewData);
			//$this->template_lib->footer_front($viewData);

		}

	}
	// End of function lockscreen_form

	function check_users_by_id_and_password($id = 0, $userPassword = '') {

		$result = $this->users_model->count_users_by_id_and_password($id, $userPassword);

		return $result;
	}
	// End of function check_users_by_id_and_password
	
	function get_user_name_by_id($id = 0) {

		$field = 'name';

		$users = $this->users_model->get_users_by_id($id, $field);

		$result = $users['name'];

		return $result;

	}
	// End of function get_user_name_by_id

	function login_process($id = 0, $param = '', $accessName = '', $accessTo = '') {

		$usersField = 'name, username';

		$users = $this->users_model->get_users_by_id($id, $usersField);

		$userFullName = $users['name'];

		$username = $users['username'];

		// Log Activity Sign in
		$this->log_activity_lib->activity_record($id, $userFullName, $username, $this->accessName, $this->activityName);

		if ($param == 'insert_record') {

			// Throrrle Record Sign In
			$this->throttle_lib->throttle_record($id, $this->accessName);

		} elseif ($param == 'update_record') {

			// Throttle Update
			$this->throttle_lib->throttle_update($id, $this->accessName);

		}
		// End if $param

		// Set Session
		$this->session_lib->session_set_userdata($id);

		// Get url
		$redirectTo = $this->throttle_lib->get_redirect_to($accessTo);

		redirect($redirectTo, 'refresh');

	}
	// End of function login_process

	function destroy_session() {

		$this->session_lib->destroy_session();

		redirect(base_url(), 'refresh');
	}
	// End of function session_destroy

}

/*
	End of class Lockscreen
	End of file Lockscreen.php
	Location: ./application/controllers/Lockscreen.php
*/