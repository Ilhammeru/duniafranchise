<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Throttle_lib {
	
	protected $CI;
	private $ipAddress;

	function __construct() {

		$this->CI =& get_instance();

		$this->CI->load->model(array(
								'throttle_model'
							));

		$this->ipAddress = $this->CI->input->ip_address();

	}
	// End of function __construct

	function check_throttle_by_user_id($userId = 0) {

		$result = $this->CI->throttle_model->count_throttle_by_user_id($userId);

		return $result;

	}
	// End of function check_throttle_by_user_id

	function check_throttle_by_user_id_and_ip_address($userId = 0) {

		$result = $this->CI->throttle_model->count_throttle_by_user_id_and_ip_address($userId, $this->ipAddress);

		return $result;

	}
	// End of function check_throttle_by_user_id_and_ip_address

	function get_throttle_by_user_id($userId = 0, $field = '') {

		$result = $this->CI->throttle_model->get_throttle_by_user_id($userId, $field);

		return $result;

	}
	// End of function get_throttle_by_user_id	

	function get_redirect_to($accessName = '') {

		switch ($accessName) :

			case 'Sign In' :

				$redirectTo = 'signin';

				break;

			case 'Dashboard' :

				$redirectTo = 'dashboard';

				break;

			case 'Users' :

				$redirectTo = 'users';

				break;

			case 'New User':

				$redirectTo = 'users/new_user';

				break;

			case 'Edit User':

				$redirectTo = 'users';

				break;

			case 'Reset Password':

				$redirectTo = 'users';

				break;

			case 'User Profile':

				$redirectTo = 'dashboard';

				break;

			case 'Role':

				$redirectTo = 'role';

				break;

			case 'New Role':

				$redirectTo = 'role/new_role';

				break;

			case 'Edit Role':

				$redirectTo = 'role';

				break;

			case 'Delete Role':

				$redirectTo = 'role';

				break;

			case 'Franchise':

				$redirectTo = 'franchise';

				break;

			case 'New Franchise':

				$redirectTo = 'franchise/new_franchise';

				break;

			case 'Edit Franchise':

				$redirectTo = 'franchise';

				break;

			case 'Delete Franchise':

				$redirectTo = 'Franchise';

				break;

			case 'Article':

				$redirectTo = 'article';

				break;

			case 'New Article':

				$redirectTo = 'article/new_article';

				break;

			case 'Edit Article':

				$redirectTo = 'article';

				break;

			case 'Delete Article':

				$redirectTo = 'Article';

				break;

			case 'Logs Report':

				$redirectTo = 'logs';

				break;

			case 'Help':

				$redirectTo = 'help';

				break;

			default:

				$redirectTo = 'dashboard';

				break;

		endswitch;

		return $redirectTo;

	}	
	// End of function get_redirect_to

	function get_datetime_diff($userId = 0) {

		$getDatetimeDiff = $this->CI->throttle_model->get_datetime_diff($userId, $this->ipAddress);

		return $getDatetimeDiff;

	}
	// End of function get_datetime_diff

	function throttle_record($userId = 0, $accessName = '') {

		$throttleData = array(
							'user_id' => $userId,
							'ip_address' => $this->ipAddress,
							'login_time' => date('Y-m-d H:i:s'),
							'activity' => date('Y-m-d H:i:s'),
							'access' => $accessName,
							'location' => ''
						);

		$this->CI->throttle_model->insert_throttle($throttleData);

	}
	// End of function throttle_record

	function throttle_update($userId = 0, $accessName = '') {

		$field = 'id';

		$getThrottleByUserId = $this->CI->throttle_model->get_throttle_by_user_id($userId, $field);

		$throttleId = $getThrottleByUserId['id'];

		switch ($accessName) :

			case 'Sign In' :
				
				$throttleData = array(
									'ip_address' => $this->ipAddress,
									'login_time' => date('Y-m-d H:i:s'),
									'activity' => date('Y-m-d H:i:s'),
									'access' => $accessName,
									'location' => ''
								);
							
			break;

			default :

				$throttleData = array(
									'ip_address' => $this->ipAddress,
									'activity' => date('Y-m-d H:i:s'),
									'access' => $accessName,
									'location' => ''
								);

			break;

		endswitch;

		$this->CI->throttle_model->update_throttle($throttleData, $throttleId);

	}
	// End of function throttle_update

	function throttle_delete($userId = 0) {

		$this->CI->throttle_model->delete_throttle_by_user_id($userId);

	}
	// End of function throttle_delete

}

/* 
	End of class Throttle_lib
	End of file Throttle_lib.php
	Location: ./application/libraries/Throttle_lib.php
*/