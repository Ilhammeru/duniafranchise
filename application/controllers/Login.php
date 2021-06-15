<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Login extends CI_Controller {

	private $attribPage;
	private $accessName = 'Sign In';
	private $activityName = 'Sign In';
	private $accessTo = 'Dashboard';
	private $ipAddress;

	function __construct() {

		parent::__construct();
		// backButtonHandle();

		$this->load->library(array(
								'form_validation'
							));

		$this->load->model(array(
								'users_model'
							));

		$this->ipAddress = $this->input->ip_address();

		$this->login_process_with_previous_sessions();

		$this->attribPage = $this->web_config_lib->attrib_page();

		$this->attribThisPage = array(
									'titlePageRight' => $this->accessName
									);

	}
	// End of function __construct
	
	function login_form() {	

		$this->set_rules_validation('Login');

		if ($this->form_validation->run() == TRUE) {
			
			$username = trim($this->input->post('inputUsername'));
			$userPassword = md5(md5(
								trim($this->input->post('inputPassword'))
							));

			if ($this->check_users_by_username_and_password($username, $userPassword) == 1){

				$id = $this->get_user_id_by_username($username);

				if ($this->throttle_lib->check_throttle_by_user_id($id) == 1) {

					$check_ip_address = $this->check_ip_address($id);

					if ($check_ip_address == 'match') {

						$param = 'update_record';

						$accessTo = $this->get_last_access_from_throttle_by_user_id($id);

						$this->login_process($id, $param, $this->accessName, $accessTo);

					} elseif ($check_ip_address == 'not-match') {

						$ipAddressSessionData = $this->get_ip_address_from_throttle_by_user_id($id);

						$this->session->set_flashdata('message', '<label class="label label-warning"><i class="fa fa-warning"></i> Warning:</label>
																<br>
																<label class="label label-warning">Your account already logged on at the address</label>
																<label class="label label-warning">' . $ipAddressSessionData . '</label>');

						redirect('signin/attention/user_id/' . $id, 'location');

					}
					// End of match ipAddress

				} else {

					$param = 'insert_record';

					$this->login_process($id, $param, $this->accessName, $this->accessTo);

				}
				// End of check_throttle_by_user_id

			} else {

				if ($this->check_users_by_username($username) == 1){

					$id = $this->get_user_id_by_username($username);

					$this->web_config_lib->alert_error('Error: Login failed, your password was incorrect');

					redirect('signin/user_id/' . $id, 'location');

				} else {

					$this->web_config_lib->alert_error('Error: Login failed, User not registered');

					redirect('signin', 'location');

				}
				// End of check_users_by_email

			}
			// End of $check_users_by_email_and_password

		} else {

			$addAttribPage = array(
								'corporation' => $this->web_config_lib->get_corporation()
							);
			
			$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

			$this->template_lib->webadmin_header_login($viewData);
			$this->load->view('webadmin/login/index', $viewData);
			//$this->template_lib->footer_front($viewData);

		}
		// End of form_validation

	}
	// End of function login_form

	function login_form_with_name_lock($id = 0) {

		$this->set_rules_validation('Lock');

		if ($this->form_validation->run() == TRUE) {

			$userPassword = md5(md5(
								trim($this->input->post('inputPassword'))
							));

			if ($this->check_users_by_id_and_password($id, $userPassword) == 1) {

				if ($this->throttle_lib->check_throttle_by_user_id($id) == 1) {

					$check_ip_address = $this->check_ip_address($id);

					if ($check_ip_address == 'match') {

						$param = 'update_record';

						$accessTo = $this->get_last_access_from_throttle_by_user_id($id);

						$this->login_process($id, $param, $this->accessName, $accessTo);

					} elseif ($check_ip_address == 'not-match') {

						$ipAddressSessionData = $this->get_ip_address_from_throttle_by_user_id($id);

						$this->session->set_flashdata('message', '<label class="label label-warning"><i class="fa fa-warning"></i> Warning:</label>
																<br>
																<label class="label label-warning">Your account already logged on at the address</label>
																<label class="label label-warning">' . $ipAddressSessionData . '</label>');

						redirect('signin/attention/user_id/' . $id, 'location');

					}
					// End of match ipAddress

				} else {

					$param = 'insert_record';

					$this->login_process($id, $param, $this->accessName, $this->accessTo);

				}
				// End of check_throttle_by_user_id

			} else {

				$this->web_config_lib->alert_error('Error: Login failed, your password was incorrect');

				redirect('signin/user_id/' . $id, 'location');

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
			$this->load->view('webadmin/login/login-wrong-password', $viewData);
			//$this->template_lib->footer_front($viewData);

		}
		// End of form_validation

	}
	// End of function login_form_with_name_lock

	function login_attention($id = 0) {

		$this->set_rules_validation('Attention');

		if ($this->form_validation->run() == TRUE) {

			$agreement = $this->input->post('inputAgree');

			if ($agreement == 'agree') {

				$param = 'update_record';

				$this->login_process($id, $param, $this->accessName, $this->accessTo);

			}

		} else {

			$addAttribPage = array(
								'corporation' => $this->web_config_lib->get_corporation()
							);


			$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

			$this->template_lib->webadmin_header_login($viewData);
			$this->load->view('webadmin/login/login-attention', $viewData);
			//$this->template_lib->webadmin_footer_front($viewData);

		}
		// End of form_validation

	}
	// End of function login_attention

	function check_users_by_username($username = '') {

		$result = $this->users_model->count_users_by_username($username);

		return $result;

	}
	// End of function check_users_by_email

	function check_users_by_id_and_password($id = 0, $userPassword = '') {

		$result = $this->users_model->count_users_by_id_and_password($id, $userPassword);

		return $result;
	}
	// End of function check_users_by_id_and_password

	function check_users_by_username_and_password($username = '', $userPassword = '') {

		$result = $this->users_model->count_users_by_username_and_password($username, $userPassword);

		return $result;

	}
	// End of function check_users_by_email_and_password

	function check_ip_address($id = 0) {

		$ipAddressSessionData = $this->get_ip_address_from_throttle_by_user_id($id);

		if ($ipAddressSessionData == $this->ipAddress) {

			$result = 'match';

		} else {

			$result = 'not-match';

		}

		return $result;

	}
	// End of function check_ip_address

	function get_user_id_by_username($username = '') {

		$field = 'id';

		$users = $this->users_model->get_users_by_username($username, $field);

		$result = $users['id'];

		return $result;

	}	
	// End of function get_user_id_by_email
	
	function get_user_name_by_id($id = 0) {

		$field = 'name';

		$users = $this->users_model->get_users_by_id($id, $field);

		$result = $users['name'];

		return $result;

	}
	// End of function get_user_name_by_id

	function get_ip_address_from_throttle_by_user_id($userId = 0) {

		$field = 'ip_address';

		$throttle = $this->throttle_lib->get_throttle_by_user_id($userId, $field);

		$result = $throttle['ip_address'];

		return $result;

	}
	// End of function get_ip_address_from_throttle_by_user_id

	function get_last_access_from_throttle_by_user_id($userId = 0) {

		$field = 'access';

		$throttle = $this->throttle_lib->get_throttle_by_user_id($userId, $field);

		$result = $throttle['access'];

		return $result;

	}
	// End of function get_last_access_from_throttle_by_user_id

	function get_login_mode($id = 0) {

		$check_throttle_by_user_id_and_ip_address = $this->throttle_lib->check_throttle_by_user_id_and_ip_address($id);

		if ($check_throttle_by_user_id_and_ip_address == 1) {

			$getDatetimeDiff = $this->throttle_lib->get_datetime_diff($id);

			if ($getDatetimeDiff <= 600) {

				$mode = 'auto-login';

			} elseif ($getDatetimeDiff > 600 AND $getDatetimeDiff <= 7200) {

				$mode = 'lockscreen';

			} else {

				$mode = 'sign-in';

			}

		} else {

			$mode = 'sign-in';

		}

		return $mode;

	}
	// End of function get_login_mode

	function login_process_with_previous_sessions() {

		$userId = $this->session->userdata('userId');

		if ( ! empty($userId)) {

			switch ($this->get_login_mode($userId)) :

				case 'auto-login' :

					$param = "update_record";

					$this->login_process($userId, $param, $this->accessName, $this->accessTo);

				break;

				case 'lockscreen' :

					redirect('lockscreen/user_id/' . $userId, 'location');

				break;

			endswitch;

		}

		/* 
			Note: There is no process if no previous sessions or sign-in mode
		*/

	}
	// End of function login_process_with_previous_sessions

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

	function set_rules_validation($accessName = '') {

		$usernameValidation = array(
								'field' => 'inputUsername',
								'label' => 'Username',
								'rules' => 'required|min_length[8]'
							);

		$passwordValidation = array(
								'field' => 'inputPassword',
								'label' => 'Password',
								'rules' => 'required|min_length[8]'
							);



		$agreementValidation = array(
								'field' => 'inputAgree',
								'label' => 'Agreement',
								'rules' => 'required'
							);

		switch ($accessName):

			case 'Login':

				$config = array(
							$usernameValidation,
							$passwordValidation							
						);

			break;

			case 'Lock':

				$config = array(
							$passwordValidation							
						);

			break;

			case 'Attention':

				$config = array(
							$agreementValidation							
						);

			break;

		endswitch;

		$this->web_config_lib->form_validation_set($config);

	}
	// End of function set_rules_validation

}

/* 
	End of class Login 
	End of file Login.php
	Location: ./application/views/login/index.php 
*/
