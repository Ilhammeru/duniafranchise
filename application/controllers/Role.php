<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Role extends CI_Controller {

	private $sessionData;
	private $accessName = 'Role';
	private $activityName = 'Visit';
	private $attribPage;
	private $attribThisPage;

	function __construct() {

		parent::__construct();

		$this->load->model(array(
							'role_model',
							'permission_model'
							));

		$this->load->library(array(
							'form_validation'
							));

		$this->sessionData = $this->session_lib->get_session();

		$this->attribPage = $this->web_config_lib->attrib_page();

		$this->attribThisPage = array(
									'sessionData' => $this->sessionData,
									'accessName' => $this->accessName,
									'titlePageRight' => $this->accessName,
									'titleMenu' => '<i class="fa fa-key"></i> ' . $this->accessName,
									'linkMenu' => '<li>
													<a href="' . site_url('role') . '" data-toggle="tooltip" data-placement="top" title="Visit to ' . $this->accessName . ' Menu">
														<i class="fa fa-key"></i> ' . $this->accessName . '
													</a>
												</li>',
									'helpMode' => $this->sessionData['helpModeValue']
									);

	}
	// End of function __construct

	function role_report() {

		$this->session_lib->check_permission_with_redirect_page($this->accessName);

		$this->log_activity_lib->log($this->accessName, $this->activityName);

		$addAttribPage = array(
								'subtitleMenu' => '<i class="fa fa-list-alt"></i> Report',
								'sublinkMenu' => '<li class="active">
													<i class="fa fa-list-alt"></i> Report
												</li>',
								'filterUser' => $this->web_config_lib->get_updated_by('role')
							);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_default_template('webadmin/user_mg/role/index', $viewData);

	}
	// End of function role_report

	function role_add_form() {

		$accessName = 'New Role';

		$activityName = 'Add';

		$this->session_lib->check_permission_with_redirect_page($accessName);

		$this->log_activity_lib->log($accessName, $this->activityName);

		$addAttribPage = array(
							'subtitleMenu' => '<i class="fa fa-plus"></i> New Role',
							'sublinkMenu' => '<li class="active">
												<i class="fa fa-plus"></i> New Role
											</li>',
							'role' => array(
											'role_id' => 0
										),
							'mode' => 'add'
						);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_header_app($viewData);
		$this->template_lib->webadmin_sidebar_app($viewData);
		$this->load->view('webadmin/user_mg/role/pass-var', $viewData);
		$this->load->view('webadmin/user_mg/role/submit', $viewData);
		$this->template_lib->webadmin_footer_app($viewData);

	}
	// End of function role_add_form

	function role_edit_form($roleId = 0) {

		$accessName = 'Edit Role';

		$this->session_lib->check_permission_with_redirect_page($accessName);

		$this->log_activity_lib->log($accessName, $this->activityName);

		$addAttribPage = array(
							'subtitleMenu' => '<i class="fa fa-edit"></i> Edit Role',
							'sublinkMenu' => '<li class="active">
												<i class="fa fa-edit"></i> Edit Role
											</li>',
							'role' => $this->role_model->get_role_and_permission_by_role_id($roleId),
							'mode' => 'update'
						);

		$viewData = array_merge($addAttribPage, $this->attribPage, $this->attribThisPage);

		$this->template_lib->webadmin_header_app($viewData);
		$this->template_lib->webadmin_sidebar_app($viewData);
		$this->load->view('webadmin/user_mg/role/pass-var', $viewData);
		$this->load->view('webadmin/user_mg/role/submit', $viewData);
		$this->template_lib->webadmin_footer_app($viewData);

	}
	// End of function role_edit_form

	function button_edit($roleId = 0) {

		$accessName = 'Edit Role';

		$url = 'role/edit/role_id/' . $roleId;

		$string = $this->web_config_lib->button_edit($accessName, $url);

		return $string;

	}
	// End of function button_edit

	function button_delete($roleId = 0) {

		$accessName = 'Delete Role';

		$className = 'role-delete';

		$string = $this->web_config_lib->button_delete($accessName, $roleId, $className);

		return $string;

	}
	// End of function button_delete

	function button_detail($roleId = 0) {

		$accessName = 'View Role';

		$className = 'role-detail';

		$string = $this->web_config_lib->button_detail($accessName, $roleId, 'ajax', $className);

		return $string;

	}
	// End of function button_detail

	function button_field($roleId = 0) {

		$buttonEdit = $this->button_edit($roleId);

		$buttonDelete = $this->button_delete($roleId);

		$buttonDetail = $this->button_detail($roleId);

		return $buttonDetail . ' ' . $buttonEdit . ' ' . $buttonDelete;

	}
	// End of function button_field

	function display_detail_role_by_role_id() {

		$roleId = $this->input->post('roleId');

		$data['permission'] = $this->role_model->get_role_and_permission_by_role_id_to_display($roleId);

		$this->load->view('webadmin/user_mg/role/display-detail-role', $data);

	}
	// End of function display_detail_permission_by_role_id

	function get_data_role() {

		$getDataRole = $this->role_model->get_role_using_server_side();

		$data = array();

		foreach ($getDataRole as $field):

			$row = array();

			$row[] = date_format(date_create($field->updated_time), 'd M Y H:i:s');

			$row[] = $field->role_name;

			$row[] = $field->user_fullname;

			$row[] = $this->button_field($field->role_id);

			$data[] = $row;

		endforeach;

		$output = array(
						"draw" => $_POST['draw'],
            			"recordsTotal" => $this->role_model->count_all_data(),
            			"recordsFiltered" => $this->role_model->count_filtered(),
						"data" => $data
					);

		echo json_encode($output);

	}
	// End of function get_data_role

	function save_role($mode = '', $roleId = 0) {

		switch($mode) :

			case 'add':

				$accessName = 'New Role';

				$activityName = 'Add';

				$redirectTo = 'role/new_role';

			break;

			case 'update':

				$accessName = 'Edit Role';

				$activityName = 'Edit';

				$redirectTo = 'role/update/role_id/' . $roleId;

			break;

		endswitch;

		if ($this->session_lib->check_permission($accessName) == 1) {

			$roleName = $this->input->post('inputRole');

			if (empty($roleName)) {
				
				$this->web_config_lib->alert_error('The Role Name is required.');

				redirect($redirectTo, 'location');

			} else {

				$countRoleByName = $this->role_model->count_role_by_name($roleName);

				if ($mode == 'add' AND $countRoleByName != 0) {

					$this->web_config_lib->alert_error('The Role Name already exists.');

					redirect($redirectTo, 'location');

				}

				$pUserReport = $this->input->post('inputPUserReport');
				$pUserAdd = $this->input->post('inputPUserAdd');
				$pUserView = $this->input->post('inputPUserView');
				$pUserEdit = $this->input->post('inputPUserEdit');
				$pUserDelete = $this->input->post('inputPUserDelete');

				$pRoleReport = $this->input->post('inputPRoleReport');
				$pRoleAdd = $this->input->post('inputPRoleAdd');
				$pRoleView = $this->input->post('inputPRoleView');
				$pRoleEdit = $this->input->post('inputPRoleEdit');
				$pRoleDelete = $this->input->post('inputPRoleDelete');

				$pFranchiseReport = $this->input->post('inputPFranchiseReport');
				$pFranchiseAdd = $this->input->post('inputPFranchiseAdd');
				$pFranchiseView = $this->input->post('inputPFranchiseView');
				$pFranchiseEdit = $this->input->post('inputPFranchiseEdit');
				$pFranchiseDelete = $this->input->post('inputPFranchiseDelete');

				$pArticleReport = $this->input->post('inputPArticleReport');
				$pArticleAdd = $this->input->post('inputPArticleAdd');
				$pArticleView = $this->input->post('inputPArticleView');
				$pArticleEdit = $this->input->post('inputPArticleEdit');
				$pArticleDelete = $this->input->post('inputPArticleDelete');

				$pAboutUsEdit = $this->input->post('inputPAboutUsEdit');
				$pAboutUsView = $this->input->post('inputPAboutUsView');

				$pBannerEdit = $this->input->post('inputPBannerEdit');
				$pBannerView = $this->input->post('inputPBannerView');

				$pLogActivity = $this->input->post('inputPLogActivity');

				if (empty($pUserReport)) {

					$pUserReport = 0;

				}

				if (empty($pUserAdd)) {

					$pUserAdd = 0;

				}

				if (empty($pUserView)) {

					$pUserView = 0;

				}

				if (empty($pUserEdit)) {

					$pUserEdit = 0;

				}

				if (empty($pUserDelete)) {

					$pUserDelete = 0;

				}

				if (empty($pRoleReport)) {

					$pRoleReport = 0;

				}

				if (empty($pRoleAdd)) {

					$pRoleAdd = 0;

				}

				if (empty($pRoleView)) {

					$pRoleView = 0;

				}

				if (empty($pRoleEdit)) {

					$pRoleEdit = 0;

				}

				if (empty($pRoleDelete)) {

					$pRoleDelete = 0;

				}

				if (empty($pFranchiseReport)) {

					$pFranchiseReport = 0;

				}

				if (empty($pFranchiseAdd)) {

					$pFranchiseAdd = 0;

				}

				if (empty($pFranchiseView)) {

					$pFranchiseView = 0;

				}

				if (empty($pFranchiseEdit)) {

					$pFranchiseEdit = 0;

				}

				if (empty($pFranchiseDelete)) {

					$pFranchiseDelete = 0;

				}

				if (empty($pArticleReport)) {

					$pArticleReport = 0;

				}

				if (empty($pArticleAdd)) {

					$pArticleAdd = 0;

				}

				if (empty($pArticleView)) {

					$pArticleView = 0;

				}

				if (empty($pArticleEdit)) {

					$pArticleEdit = 0;

				}

				if (empty($pArticleDelete)) {

					$pArticleDelete = 0;

				}

				if (empty($pAboutUsView)) {

					$pAboutUsView = 0;

				}

				if (empty($pAboutUsEdit)) {

					$pAboutUsEdit = 0;

				}

				if (empty($pBannerView)) {

					$pBannerView = 0;

				}

				if (empty($pBannerEdit)) {

					$pBannerEdit = 0;

				}

				if (empty($pLogActivity)) {

					$pLogActivity = 0;

				}

				$roleData = array(
								'name' => $roleName,
								'created_time' => date('Y-m-d H:i:s'),
								'updated_time' => date('Y-m-d H:i:s'),
								'creator' => $this->sessionData['userId'],
								'updated_by' => $this->sessionData['userId']
							);

				$permissionData = array(
								'p_user_report' => $pUserReport,
								'p_user_add' => $pUserAdd,										
								'p_user_view' => $pUserView,
								'p_user_edit' => $pUserEdit,
								'p_user_delete' => $pUserDelete,
								'p_role_report' => $pRoleReport,
								'p_role_add' => $pRoleAdd,
								'p_role_view' => $pRoleView,
								'p_role_edit' => $pRoleEdit,
								'p_role_delete' => $pRoleDelete,
								'p_franchise_report' => $pFranchiseReport,
								'p_franchise_add' => $pFranchiseAdd,
								'p_franchise_view' => $pFranchiseView,
								'p_franchise_edit' => $pFranchiseEdit,
								'p_franchise_delete' => $pFranchiseDelete,
								'p_article_report' => $pArticleReport,
								'p_article_add' => $pArticleAdd,
								'p_article_view' => $pArticleView,
								'p_article_edit' => $pArticleEdit,
								'p_article_delete' => $pArticleDelete,
								'p_about_us_edit' => $pAboutUsEdit,
								'p_about_us_view' => $pAboutUsView,
								'p_banner_edit' => $pBannerEdit,
								'p_banner_view' => $pBannerView,
								'p_log_activity' => $pLogActivity
							);

				switch ($mode):

					case 'add':
						
						$this->role_model->insert_data($roleData, $permissionData);

					break;

					case 'update':

						$roleData = array(
								'updated_time' => date('Y-m-d H:i:s'),
								'updated_by' => $this->sessionData['userId']
							);

						$this->permission_model->update_data_by_role_id($permissionData, $roleId, $roleData);

					break;

				endswitch;

				$this->log_activity_lib->log($accessName, $activityName, $roleName);

				$this->web_config_lib->alert_successfully('saved');

				redirect('role');

			}

		} else {

			$this->web_config_lib->alert_error('Can not update data.
											Your account does not have access to update role data.');

			redirect('role', 'location');

		}

	}
	// End of function save_role

	function delete_role($roleId = 0) {

		$accessName = 'Delete Role';

		$activityName = 'Delete';

		$getRoleById = $this->role_model->get_role_by_id($roleId);

		$roleName = $getRoleById['name'];

		if ($this->session_lib->check_permission($accessName) == 1) {

			if ($this->role_model->delete_data($roleId) === true) {

				$this->log_activity_lib->log($accessName, $activityName, $roleName);

				$this->web_config_lib->alert_successfully('deleted');

				redirect('role', 'refresh');

			} else {

				$this->web_config_lib->alert_error('Can not delete data.
												There is something wrong, this role has been used by the user.');

				redirect('role', 'location');

			}

		} else {

			$this->web_config_lib->alert_error('Can not delete data.
											Your account does not have access to delete role data.');

			redirect('role', 'location');

		}

	}// End of function delete_role

}

/*
	End of class Role
	End of file Role.php
	Location: ./application/controllers/Role.php
*/