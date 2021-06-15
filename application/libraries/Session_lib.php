<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Session_lib {
	
	protected $CI;

	function __construct() {

		$this->CI =& get_instance();

		$this->CI->load->model(array(
								'users_model'
								));

	}
	// End of function __construct

	function check_session() {

		$this->CI->load->library('web_config_lib');

		$userId = $this->CI->session->userdata('userId');

		if( ! $userId) {

			$msg = 'Error: Your session has expired';

			/*$startStyle = '<p><label class="label label-danger"><i class="fa fa-ban"></i> ';

			$endStyle = '</label></p>';
			
			$this->CI->session->set_flashdata('message', $startStyle . $msg . $endStyle);*/

			$this->CI->web_config_lib->alert_error($msg);

			redirect(site_url('signin'), 'location');

		} else {

			$checkThrottleByUserIdAndIpAddress = $this->CI->throttle_lib->check_throttle_by_user_id_and_ip_address($userId);

			if ($checkThrottleByUserIdAndIpAddress == 1) {

				$getDatetimeDiff = $this->CI->throttle_lib->get_datetime_diff($userId);
				/*
				if ($getDatetimeDiff > 60 * 60) {

					redirect('lockscreen/user_id/' . $userId, 'location');

				}
				*/

			}

		}

	}
	// End of function check_session

	function check_permission($accessName = '') {

		$sessionName = $this->get_session_name($accessName);

		$permission = $this->CI->session->userdata($sessionName);

		return $permission;

	}
	// End of function check_permission

	function check_permission_with_redirect_page($accessName = '') {

		$sessionName = $this->get_session_name($accessName);

		$permission = $this->CI->session->userdata($sessionName);

		if ($permission != 1) {

			redirect('error/access_denied', 'location');

		}

	}
	// End of function check_permission_with_redirect_page

	function session_set_userdata($id = 0, $helpMode = 0) {

		$field = 'users.name AS user_fullname, 
				users.username AS username, 
				users.images AS images,
				role.id AS role_id,
				role.name AS role_name,
				permission.p_user_report,
				permission.p_user_add,
				permission.p_user_view,
				permission.p_user_edit,
				permission.p_user_delete,
				permission.p_role_report,
				permission.p_role_add,
				permission.p_role_view,
				permission.p_role_edit,
				permission.p_role_delete,
				permission.p_log_activity,
				permission.p_web_config,
				permission.p_franchise_report,
				permission.p_franchise_view,
				permission.p_franchise_add,
				permission.p_franchise_edit,
				permission.p_franchise_delete,
				permission.p_article_report,
				permission.p_article_view,
				permission.p_article_add,
				permission.p_article_edit,
				permission.p_article_delete,
				permission.p_about_us_view,
				permission.p_about_us_edit,
				permission.p_banner_view,
				permission.p_banner_edit';

		$getUsersAndRoleAndPermissionByUserId = $this->CI->users_model->get_users_and_role_and_permission_by_user_id($id, $field);

		$userFullName = $getUsersAndRoleAndPermissionByUserId['user_fullname'];

		$username = $getUsersAndRoleAndPermissionByUserId['username'];

		$userImages = $getUsersAndRoleAndPermissionByUserId['images'];

		$roleId = $getUsersAndRoleAndPermissionByUserId['role_id'];

		$roleName = $getUsersAndRoleAndPermissionByUserId['role_name'];

		$pUserReport = $getUsersAndRoleAndPermissionByUserId['p_user_report'];

		$pUserAdd = $getUsersAndRoleAndPermissionByUserId['p_user_add'];

		$pUserView = $getUsersAndRoleAndPermissionByUserId['p_user_view'];

		$pUserEdit = $getUsersAndRoleAndPermissionByUserId['p_user_edit'];

		$pUserDelete = $getUsersAndRoleAndPermissionByUserId['p_user_delete'];

		$pRoleReport = $getUsersAndRoleAndPermissionByUserId['p_role_report'];

		$pRoleAdd = $getUsersAndRoleAndPermissionByUserId['p_role_add'];

		$pRoleView = $getUsersAndRoleAndPermissionByUserId['p_role_view'];

		$pRoleEdit = $getUsersAndRoleAndPermissionByUserId['p_role_edit'];

		$pRoleDelete = $getUsersAndRoleAndPermissionByUserId['p_role_delete'];

		$pLogActivity = $getUsersAndRoleAndPermissionByUserId['p_log_activity'];

		$pWebConfig = $getUsersAndRoleAndPermissionByUserId['p_web_config'];

		$pFranchiseReport = $getUsersAndRoleAndPermissionByUserId['p_franchise_report'];

		$pFranchiseAdd = $getUsersAndRoleAndPermissionByUserId['p_franchise_add'];

		$pFranchiseView = $getUsersAndRoleAndPermissionByUserId['p_franchise_view'];

		$pFranchiseEdit = $getUsersAndRoleAndPermissionByUserId['p_franchise_edit'];

		$pFranchiseDelete = $getUsersAndRoleAndPermissionByUserId['p_franchise_delete'];
		
		$pArticleReport = $getUsersAndRoleAndPermissionByUserId['p_article_report'];

		$pArticleAdd = $getUsersAndRoleAndPermissionByUserId['p_article_add'];

		$pArticleView = $getUsersAndRoleAndPermissionByUserId['p_article_view'];

		$pArticleEdit = $getUsersAndRoleAndPermissionByUserId['p_article_edit'];

		$pArticleDelete = $getUsersAndRoleAndPermissionByUserId['p_article_delete'];

		$pAboutUsView = $getUsersAndRoleAndPermissionByUserId['p_about_us_view'];

		$pAboutUsEdit = $getUsersAndRoleAndPermissionByUserId['p_about_us_edit'];

		$pBannerView = $getUsersAndRoleAndPermissionByUserId['p_banner_view'];

		$pBannerEdit = $getUsersAndRoleAndPermissionByUserId['p_banner_edit'];

		$sessionData = array(
							'userId' => $id,
							'userFullName' => $userFullName,
							'username' => $username,
							'userImages' => $userImages,
							'roleId' => $roleId,
							'roleName' => $roleName,
							'pUserReport' => $pUserReport,
							'pUserAdd' => $pUserAdd,
							'pUserView' => $pUserView,
							'pUserEdit' => $pUserEdit,
							'pUserDelete' => $pUserDelete,
							'pRoleReport' => $pRoleReport,
							'pRoleAdd' => $pRoleAdd,
							'pRoleView' => $pRoleView,
							'pRoleEdit' => $pRoleEdit,
							'pRoleDelete' => $pRoleDelete,
							'pLogActivity' => $pLogActivity,
							'pWebConfig' => $pWebConfig,
							'pFranchiseReport' => $pFranchiseReport,
							'pFranchiseAdd' => $pFranchiseAdd,
							'pFranchiseView' => $pFranchiseView,
							'pFranchiseEdit' => $pFranchiseEdit,
							'pFranchiseDelete' => $pFranchiseDelete,
							'pArticleReport' => $pArticleReport,
							'pArticleAdd' => $pArticleAdd,
							'pArticleView' => $pArticleView,
							'pArticleEdit' => $pArticleEdit,
							'pArticleDelete' => $pArticleDelete,
							'pAboutUsView' => $pAboutUsView,
							'pAboutUsEdit' => $pAboutUsEdit,
							'pBannerView' => $pBannerView,
							'pBannerEdit' => $pBannerEdit,
							'helpModeValue' => $helpMode
						);						

		$this->CI->session->set_userdata($sessionData);

	}
	// End of function session_set_userdata

	function get_session() {

		$this->check_session();

		$sessionData = array(
							'userId' => $this->CI->session->userdata('userId'),
							'userFullName' => $this->CI->session->userdata('userFullName'),
							'username' => $this->CI->session->userdata('username'),
							'userImages' => $this->CI->session->userdata('userImages'),
							'roleId' => $this->CI->session->userdata('roleId'),
							'roleName' => $this->CI->session->userdata('roleName'),
							'pUserReport' => $this->CI->session->userdata('pUserReport'),
							'pUserAdd' => $this->CI->session->userdata('pUserAdd'),
							'pUserView' => $this->CI->session->userdata('pUserView'),
							'pUserEdit' => $this->CI->session->userdata('pUserEdit'),
							'pUserDelete' => $this->CI->session->userdata('pUserDelete'),
							'pRoleReport' => $this->CI->session->userdata('pRoleReport'),
							'pRoleAdd' => $this->CI->session->userdata('pRoleAdd'),
							'pRoleview' => $this->CI->session->userdata('pRoleView'),
							'pRoleEdit' => $this->CI->session->userdata('pRoleEdit'),
							'pRoleDelete' => $this->CI->session->userdata('pRoleDelete'),
							'pLogActivity' => $this->CI->session->userdata('pLogActivity'),
							'pWebConfig' => $this->CI->session->userdata('pWebConfig'),
							'pFranchiseReport' => $this->CI->session->userdata('pFranchiseReport'),
							'pFranchiseAdd' => $this->CI->session->userdata('pFranchiseAdd'),
							'pFranchiseview' => $this->CI->session->userdata('pFranchiseView'),
							'pFranchiseEdit' => $this->CI->session->userdata('pFranchiseEdit'),
							'pFranchiseDelete' => $this->CI->session->userdata('pFranchiseDelete'),
							'pArticleReport' => $this->CI->session->userdata('pArticleReport'),
							'pArticleAdd' => $this->CI->session->userdata('pArticleAdd'),
							'pArticleview' => $this->CI->session->userdata('pArticleView'),
							'pArticleEdit' => $this->CI->session->userdata('pArticleEdit'),
							'pArticleDelete' => $this->CI->session->userdata('pArticleDelete'),
							'pAboutUsView' => $this->CI->session->userdata('pAboutUsView'),
							'pAboutUsEdit' => $this->CI->session->userdata('pAboutUsEdit'),
							'pBannerView' => $this->CI->session->userdata('pBannerView'),
							'pBannerEdit' => $this->CI->session->userdata('pBannerEdit'),
							'helpModeValue' => $this->CI->session->userdata('helpModeValue')
						);

		return $sessionData;
	}	
	// End of function get_session

	function get_session_name($accessName = '') {

		switch ($accessName) :

			case 'Users' :

				$sessionName = 'pUserReport';

				break;

			case 'New User' :

				$sessionName = 'pUserAdd';

				break;

			case 'Edit User' :

				$sessionName = 'pUserEdit';

				break;

			case 'Delete User' :

				$sessionName = 'pUserDelete';

			break;

			case 'View User' :

				$sessionName = 'pUserView';

				break;

			case 'Role' :

				$sessionName = 'pRoleReport';

				break;

			case 'New Role'	:

				$sessionName = 'pRoleAdd';
				
				break;

			case 'Edit Role' :

				$sessionName = 'pRoleEdit';

				break;

			case 'View Role':

				$sessionName = 'pRoleView';

				break;

			case 'Delete Role':

				$sessionName = 'pRoleDelete';

				break;

			case 'Franchise' :

				$sessionName = 'pFranchiseReport';

				break;

			case 'New Franchise'	:

				$sessionName = 'pFranchiseAdd';
				
				break;

			case 'Edit Franchise' :

				$sessionName = 'pFranchiseEdit';

				break;

			case 'View Franchise':

				$sessionName = 'pFranchiseView';

				break;

			case 'Delete Franchise':

				$sessionName = 'pFranchiseDelete';

				break;

			case 'Article' :

				$sessionName = 'pArticleReport';

				break;

			case 'New Article'	:

				$sessionName = 'pArticleAdd';
				
				break;

			case 'Edit Article' :

				$sessionName = 'pArticleEdit';

				break;

			case 'View Article':

				$sessionName = 'pArticleView';

				break;

			case 'Delete Article':

				$sessionName = 'pArticleDelete';

				break;

			case 'Edit About Us':

				$sessionName = 'pAboutUsEdit';

				break;

			case 'View About Us':

				$sessionName = 'pAboutUsView';

				break;

			case 'Edit Banner':

				$sessionName = 'pBannerEdit';

				break;

			case 'View Banner':

				$sessionName = 'pBannerView';

				break;

			case 'Logs Report':

				$sessionName = 'pLogActivity';

				break;

			default:

				$sessionName = '';

				break;
			
		endswitch;

		return $sessionName;

	}
	// End of functio get_session_name

	function destroy_session() {

		$this->CI->session->sess_destroy();

	}
	// End of function destroy_session

}

/*
	End of class Session_lib
	End of file Session_lib.php
	Location: ./application/libraries/Session_lib.php
*/