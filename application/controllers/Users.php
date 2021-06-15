<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Users extends CI_Controller {
	
	private $sessionData;
	private $attribPage;
	private $attribThisPage;

	private $accessName = 'Users';
	private $activityName = 'Visit';

	private $urlApp;

	private $resetPassword = '12345678';

	private $avatarList = array(
							'no-image.jpg',
							'avatar.png',
							'avatar2.png',
							'avatar3.png',
							'avatar4.png',
							'avatar5.png'
							);

	private $avatarDir = 'assets/img/users/';

	function __construct() {

		parent::__construct();

		$this->load->model(array(
								'role_model'
								));

		$this->load->library(array(
								'form_validation',
								));

		$this->sessionData = $this->session_lib->get_session();

		$this->attribPage = $this->web_config_lib->attrib_page();

		$this->attribThisPage = array(
									'sessionData' => $this->sessionData,
									'accessName' => $this->accessName,
									'titlePageRight' => $this->accessName,
									'titleMenu' => '<i class="fa fa-users"></i> ' . $this->accessName,
									'linkMenu' => '<li>
													<a href="' . site_url('users') . '" data-toggle="tooltip" data-placement="top" title="Visit to ' . $this->accessName . ' Menu">
														<i class="fa fa-users"></i> ' . $this->accessName . '
													</a>
												</li>',
									'helpMode' => $this->sessionData['helpModeValue']
									);

		$this->urlApp = "http://" . $_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);

	}
	// End of function __construct

	function users_report() {

		$this->session_lib->check_permission_with_redirect_page($this->accessName);

		$this->log_activity_lib->log($this->accessName, $this->activityName);

		$addAttribPage = array(
								'subtitleMenu' => '<i class="fa fa-list-alt"></i> Report',
								'sublinkMenu' => '<li class="active">
													<i class="fa fa-list-alt"></i> Report
												</li>',
								'filterRole' => $this->filter_role()
							);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_default_template('webadmin/user_mg/users/index', $viewData);

	}
	// End od function users_report

	function users_add_form() {

		$accessName = 'New User';

		$activityName = 'Add';

		$this->session_lib->check_permission_with_redirect_page($accessName);

		$this->log_activity_lib->log($accessName, $this->activityName);

		$this->set_rules_validation($activityName);

		if ($this->form_validation->run() == TRUE) {
		
			$userFullName = trim($this->input->post('inputFullName'));
			$username = strtolower(trim($this->input->post('inputUsername')));
			$roleId = $this->input->post('inputRole');

			if ($this->check_users_by_username($username) == 0) {

				//$randomString = random_string('alnum', 8);

				$userPassword = md5(md5($this->resetPassword));

				$userData = array(
								'name' => $userFullName,
								'password' => $userPassword,
								'username' => $username,
								'role_id' => $roleId,
								'updated_time' => date('Y-m-d H:i:s'),
								'creator' => $this->sessionData['userId']
	 							);

				$this->users_model->insert_data($userData);

				$this->log_activity_lib->log($accessName, $activityName, $username);

				//$this->send_to_email($username, $randomString, $activityName);

				$this->web_config_lib->alert_successfully('saved');

				redirect('users');

			} else {

				$this->web_config_lib->alert_error('The username already exists');

				redirect('users/new_user', 'location');

			}

		} else {

			$roleField = 'id, name';

			$addAttribPage = array(
								'subtitleMenu' => '<i class="fa fa-user-plus"></i> New User',
								'sublinkMenu' => '<li class="active">
													<i class="fa fa-user-plus"></i> New User
												</li>',
								'role' => $this->role_model->get_all_data_asc($roleField),
								'users' => $this->users_model->get_all_users_asc()
							);

			$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

			$this->template_lib->webadmin_default_template('webadmin/user_mg/users/add', $viewData);

		}

	}
	// End of function users_add_form

	function users_edit_form($id = 0) {

		$accessName = 'Edit User';

		$activityName = 'Edit';

		$this->session_lib->check_permission_with_redirect_page($accessName);

		$this->log_activity_lib->log($accessName, $this->activityName);

		$this->set_rules_validation($activityName);

		if ($this->form_validation->run() == TRUE) {

			$userFullName = trim($this->input->post('inputFullName'));
			$roleId = $this->input->post('inputRole');
			$username = strtolower(trim($this->input->post('inputUsername')));

			$userData = array(
							'name' => $userFullName,
							'role_id' => $roleId,
							'updated_time' => date('Y-m-d H:i:s'),
							'creator' => $this->sessionData['userId']
							);

			$this->users_model->update_data($userData, $id);

			$this->log_activity_lib->log($accessName, $activityName, $username);

			$this->web_config_lib->alert_successfully('updated');

			redirect('users');

		} else {

			$roleField = 'id, name';

			$addAttribPage = array(
								'subtitleMenu' => '<i class="fa fa-edit"></i> Edit User',
								'sublinkMenu' => '<li class="active">
													<i class="fa fa-edit"></i> Edit User
												</li>',
								'role' => $this->role_model->get_all_data_asc($roleField),
								'users' => $this->get_users_and_role_by_user_id($id),
								'usersList' => $this->users_model->get_all_users_asc()
							);

			$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

			$this->template_lib->webadmin_default_template('webadmin/user_mg/users/edit', $viewData);

		}

	}
	// End of function users_edit_form

	function profile_form($id = 0, $notif = '') {

		$accessName = 'User Profile';

		$this->log_activity_lib->log($accessName, $this->activityName);

		$addAttribPage = array(
							'subtitleMenu' => '<i class="fa fa-user"></i> User Profile',
							'sublinkMenu' => '<li class="active">
													<i class="fa fa-user"></i> User Profile
												</li>',
							'users' => $this->get_users_and_role_by_user_id($id),
							'usersList' => $this->users_model->get_all_users_asc(),
							'avatarList' => $this->avatarList,
							'avatarDir' => $this->avatarDir,
							'notif' => $notif
						);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_header_app($viewData);
		$this->template_lib->webadmin_sidebar_profile($viewData);
		$this->load->view('webadmin/user_mg/users/user-profile', $viewData);
		$this->template_lib->webadmin_footer_app($viewData);

	}
	// End of function profile_form

	function filter_role() {

		$role = $this->users_model->get_role_in_users();

		$html = '<select class="form-control select2" multiple><option disabled>Search Role</option>';

		foreach ($role as $row) :

			$html .= '<option value="' . $row->id . '">' . $row->name . '</option>';

		endforeach;

		return $html;

	}
	// End of function filter_role

	function button_edit($id = 0) {

		$accessName = 'Edit User';

		$url = 'users/edit/user_id/' . $id;

		$string = $this->web_config_lib->button_edit($accessName, $url);

		return $string;

	}
	// End of function button_edit

	function button_delete($id = 0) {

		if ($id != $this->sessionData['userId']) {

			$accessName = 'Delete User';

			$className = 'user-delete';

			$string = $this->web_config_lib->button_delete($accessName, $id, $className);

		} else {

			$string = '';

		}

		return $string;

	}
	// End of function button_delete

	function button_detail($id = 0) {

		$accessName = 'View User';

		$className = 'user-detail';

		$string = $this->web_config_lib->button_detail($accessName, $id, 'ajax', $className);

		return $string;

	}
	// End of function button_detail

	function button_field($id = 0) {

		$buttonEdit = $this->button_edit($id);

		$buttonDelete = $this->button_delete($id);

		$buttonDetail = $this->button_detail($id);

		return $buttonDetail . ' ' . $buttonEdit . ' ' . $buttonDelete;

	}
	// End of function button_field

	function display_detail_user_by_id() {

		$id = $this->input->post('userId');

		$userField = "users.name AS user_fullname, users.username, users.images, role_id, role.name AS role_name, users.updated_time AS updated_time";

		$userData = $this->users_model->get_users_and_role_by_user_id($id, $userField);

		$data['users'] = $userData;

		$data['permission'] = $this->role_model->get_role_and_permission_by_role_id_to_display($userData['role_id']);

		$this->load->view('webadmin/user_mg/users/display-detail-user', $data);

	}
	// End of function display_detail_user_by_id

	function check_users_by_username($username = '') {

		$result = $this->users_model->count_users_by_username($username);

		return $result;

	}
	// End of function check_users_by_username

	function check_users_by_email($emailName = '') {

		$result = $this->users_model->count_users_by_email($emailName);

		return $result;

	}
	// End of function check_users_by_email

	function get_users_and_role_by_user_id($id = 0) {

		$usersField = "users.id AS user_id, users.name AS user_fullname, users.username, CONCAT(users.name, ' [', users.username, ']') AS username2,users.role_id, role.name AS role_name, users.images";

		$result = $this->users_model->get_users_and_role_by_user_id($id, $usersField);

		return $result;

	}
	// End of function get_users_and_role_by_user_id

	function get_data_users_and_role() {

		$getDataUsersAndRole = $this->users_model->get_users_using_server_side();

		$data = array();

		foreach ($getDataUsersAndRole as $field):

			$row = array();

			$row[] = date_format(date_create($field->updated_time), 'd M Y H:i:s');

			$row[] = $field->user_fullname;

			$row[] = $field->username;

			$row[] = $field->role_name;

			$row[] = $this->button_field($field->user_id);

			$data[] = $row;

		endforeach;

		$output = array(
						"draw" => $_POST['draw'],
            			"recordsTotal" => $this->users_model->count_all_data(),
            			"recordsFiltered" => $this->users_model->count_filtered(),
						"data" => $data
					);

		echo json_encode($output);

	}
	// End of function get_data_users_and_role

	function update_profile() {

		$accessName = 'User Profile';

		$activityName = 'Edit';

		$userId = $this->input->post('inputId');
		$username = strtolower(trim($this->input->post('inputUsername')));
		$userFullName = trim($this->input->post('inputFullName'));
		$checkPassword = $this->input->post('checkPassword');
		$userPassword = trim($this->input->post('inputPassword'));
		$avatarDir = $this->input->post('inputAvatarDir');

		if ( ! empty($username)) {

			if ($checkPassword == 'yes' AND empty($userPassword)) {

				$this->web_config_lib->alert_error('The user password is required');

				redirect('users/profile/user_id/' . $userId);

			} elseif ($checkPassword == 'yes' AND  ( ! empty($userPassword))) {

				$userData = array(
								'name' => $userFullName,
								'images' => $avatarDir,
								'password' => md5(md5($userPassword)),
								'updated_time' => date('Y-m-d H:i:s')
								// 'creator' => $this->sessionData['userId']
							);

				$this->users_model->update_data($userData, $userId);

				//$this->send_to_email($emailName, $userPassword, $activityName);
				
				$this->log_activity_lib->log($accessName, $activityName, $userame);

				$this->web_config_lib->alert_successfully('updated');

				$this->web_config_lib->alert_info('Please sign out to updated your session data');

				redirect('users/profile/user_id/' . $userId . '/restart');

			} else {

				$userData = array(
								'name' => $userFullName,
								'images' => $avatarDir,
								'updated_time' => date('Y-m-d H:i:s')
								//'creator' => $this->sessionData['userId']
							);

				$this->users_model->update_data($userData, $userId);

				$this->log_activity_lib->log($accessName, $activityName, $username);

				$this->web_config_lib->alert_successfully('updated');

				redirect('users/profile/user_id/' . $userId . '/restart');

			}

		} else {

			$this->web_config_lib->alert_error('The user name is required');

			redirect('users/profile/user_id/' . $userId);

		}

	}
	// End of function update_profile

	function send_to_email($emailName = '', $userPassword = '', $activityName = '') {

		$applicationName = $this->web_config_lib->get_application_name();

		$subject = $applicationName . ' - Credential';

		$message = 'Your password is ' . $userPassword . '. Please sign in ' . $this->urlApp;

		if ( ! $this->email_lib->send($emailName, $subject, $message)) {

			$usersData = array(
							'password' => md5(md5($this->resetPassword))
							);

			$this->users_model->update_data_by_email($usersData, $emailName);

			$this->web_config_lib->alert_error('Can not send email.
												There is something wrong, please check your connection.');

			$this->web_config_lib->alert_info('The default password is 12345678');

			redirect('users');

		} else {

			return true;
		}

	}
	// End of functin send_to_email

	function delete_user($id = 0) {

		$accessName = 'Delete User';

		$activityName = 'Delete';

		$usersField = 'username';

		$get_users_by_id = $this->users_model->get_users_by_id($id, $usersField);

		$username = $get_users_by_id['username'];

		if ($this->session_lib->check_permission($accessName) == 1) {

			if ($this->users_model->delete_data($id) === true) {

				$this->log_activity_lib->log($accessName, $activityName, $username);

				$this->web_config_lib->alert_successfully('deleted');

				redirect('users');

			} else {

				$this->web_config_lib->alert_error('Can not delete data.
													There is something wrong, please check whether the user has done the activity of creating or updating the data.');

				redirect('users');

			}

		} else {

			$this->web_config_lib->alert_error('Can not delete data.
												Your account does not have access to delete user data.');

			redirect('users');

		}

	}// End of function delete_user

	function reset_password($id = 0) {

		$usersField = 'users.username';

		$accessName = 'Reset Password';

		$activityName = 'Reset Password';

		$getUsersAndRoleByUserId = $this->users_model->get_users_and_role_by_user_id($id, $usersField);

		$username = $getUsersAndRoleByUserId['username'];

		$userData = array(
						'password' => md5(md5($this->resetPassword)),
						'updated_time' => date('Y-m-d H:i:s'),
						//'creator' => $this->sessionData['userId']
						);

		$this->users_model->update_data($userData, $id);

		$this->send_to_email($emailName, $this->resetPassword, $activityName);

		$this->log_activity_lib->log($accessName, $activityName, $username);

		$this->web_config_lib->alert_successfully('updated');

		redirect('users');

	}
	// End of function reset_password

	function set_rules_validation($activityName = '') {

		$userFullNameValidation = array(
								'field' => 'inputFullName',
								'label' => 'Full Name',
								'rules' => 'required'
							);

		$usernameValidation = array(
								'field' => 'inputUsername',
								'label' => 'Username',
								'rules' => 'required|min_length[8]'
							);

		$roleNameValidation = array(
								'field' => 'inputRole',
								'label' => 'Role',
								'rules' => 'required',
							);

		switch($activityName):

			case 'Add':

				$config = array(
							$userFullNameValidation,
							$usernameValidation,
							$roleNameValidation
						);

				break;

			case 'Edit':

				$config = array(
							$userFullNameValidation,
							$roleNameValidation
						);

				break;

		endswitch;

		$this->web_config_lib->form_validation_set($config);

	}
	// End of function set_rules_validation()

}

/*
	End of class Users
	End of file Users.php
	Location: ./application/controllers/Users.php
*/