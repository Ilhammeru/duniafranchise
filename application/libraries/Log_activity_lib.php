<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Log_activity_lib {

	protected $CI;
	private $ipAddress;
	private $server;
	private $sessionData;
	
	function __construct() {

		$this->CI =& get_instance();

		$this->CI->load->model(array(
								'log_activity_model',
								'log_visitor_model'
							));

		$this->ipAddress = $this->CI->input->ip_address();

		$this->server = gethostname();

	}
	// End of function __construct


	function activity_record($userId = 0, $userFullName = '', $username = '', $accessName = '', $activityName = '', $description = '') {

		$logRemarks = $this->log_remarks($userFullName, $username, $accessName, $activityName, $description);

		$logData = array(
						'user_id' => $userId,
						'time' => date('Y-m-d H:i:s'),
						'log' => $logRemarks,
						'access_name' => $accessName,
						'activity_name' => $activityName,
						'ip_address' => $this->ipAddress,
						'location' => ''
						);

		$this->CI->log_activity_model->insert_log_activity($logData);

	}
	// End of function activity_record

	function log_remarks($userFullName = '', $username = '', $accessName = '', $activityName = '', $description = '') {

		switch ($accessName) :

			case 'Users':

				$item = 'the user';

				break;

			case 'New User' :

				$item = 'the user';

				break;

			case 'Edit User' :

				$item = 'the user';

				break;

			case 'Delete User':

				$item = 'the user';

				break;

			case 'Reset Password':

				$item = 'the user password';

				break;

			case 'User Profile':

				$item = 'the user';

				break;

			case 'Role':

				$item = 'the role';

				break;

			case 'New Role' :

				$item = 'the role';

				break;

			case 'Edit Role':

				$item = 'the role';

				break;

			case 'Delete Role':

				$item = 'the role';

				break;

			case 'Logs Report':

				$item = 'the data';

				break;

			case 'Franchise':

				$item = 'the franchise';

				break;

			case 'New Franchise':

				$item = 'the franchise';

				break;

			case 'Edit Franchise':

				$item = 'the franchise';

				break;

			case 'Delete Franchise';

				$item = 'the franchise';

				break;

			case 'Article':

				$item = 'the article';

				break;

			case 'New Article':

				$item = 'the article';

				break;

			case 'Edit Article':

				$item = 'the article';

				break;

			case 'Delete Article';

				$item = 'the article';

				break;

			case 'Banner':

				$item = 'the banner';

				break;

			case 'Edit Banner':

				$item = 'the banner';

				break;

			case 'Edit About Us':

				$item = 'the about us data';

				break;
			
			default:

				$item = 'the data';

				break;

		endswitch;

		switch ($activityName) :

			case 'Sign In' :

				$remarks = 'has been signed in';

				break;

			case 'Sign Out':

				$remarks = 'has been signed out';

				break;

			case 'Visit' :

				$remarks = 'has visited the ' . $accessName . ' page';

				break;

			case 'View' :

				$remarks = 'has viewed the ' . $accessName . ' data';

				break;

			case 'Add' :

				$remarks = 'has successfully saved ' . $item . ' ' . '[' . $description . ']';

				break;

			case 'Edit':

				$remarks = 'has successfully updated ' . $item . ' ' . '[' . $description . ']';

				break;

			case 'Delete' :

				$remarks = 'has successfully deleted ' . $item . ' ' . '[' . $description . ']';

				break;

		endswitch;

		$logRemarks = $userFullName . ' [' .  $username . '] ' . $remarks . ' ' . $this->ip_address_remarks() . ' ' . $this->location_remarks();

		return $logRemarks;

	}
	// End of function log_remarks

	function ip_address_remarks() {

		$remarks = 'at the address ' . $this->ipAddress . ' (' . $this->server . ')';

		return $remarks;

	}
	// End of function ip_address_remarks

	function location_remarks() {

		$remarks = '';

		return $remarks;

	}
	// End of function location_remarks

	function log($accessName = '', $activityName = '', $description = '') {

		$sessionData = $this->CI->session_lib->get_session();

		$this->CI->log_activity_lib->activity_record($sessionData['userId'], $sessionData['userFullName'], $sessionData['username'], $accessName, $activityName, $description);

		$this->CI->throttle_lib->throttle_update($sessionData['userId'], $accessName);

	}
	// End of function log

	function log_visitor($location = '', $accessName = '', $log = '') {

		$data = array(
					'time' => date('Y-m-d H:i:s'),
					'log' => $log,
					'ip_address' => $this->ipAddress,
					'location' => $location,
					'access_name' => $accessName
				);

		$this->CI->log_visitor_model->insert_log_visitor($data);

	}
	// End of function log_visitor

}

/*
	End of class Log_activity_lib
	End of file Log_activity_lib.php
	Location: ./application/libraries/Log_activity_lib.php
*/