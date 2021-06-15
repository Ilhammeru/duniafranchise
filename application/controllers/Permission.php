<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Permission extends CI_Controller {

	function __construct() {

		parent::__construct();

		$this->load->model(array(
							'permission_model'
							));

	}
	// End of function __construct

	function display_permission_by_role_id() {

		$roleId = $this->input->post('roleId');

		$field = "role_id,
					CASE p_user_report
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_user_report,
					CASE p_user_add
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_user_add,
					CASE p_user_view
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_user_view,
					CASE p_user_edit
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_user_edit,
					CASE p_user_delete
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_user_delete,
					CASE p_role_report
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_role_report,
					CASE p_role_add
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_role_add,
					CASE p_role_view
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_role_view,
					CASE p_role_edit
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_role_edit,
					CASE p_role_delete
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_role_delete,
					CASE p_franchise_report
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_franchise_report,
					CASE p_franchise_add
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_franchise_add,
					CASE p_franchise_view
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_franchise_view,
					CASE p_franchise_edit
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_franchise_edit,
					CASE p_franchise_delete
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_franchise_delete,
					CASE p_article_report
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_article_report,
					CASE p_article_add
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_article_add,
					CASE p_article_view
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_article_view,
					CASE p_article_edit
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_article_edit,
					CASE p_article_delete
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_article_delete,
					CASE p_about_us_edit
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_about_us_edit,
					CASE p_about_us_view
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_about_us_view,
					CASE p_banner_edit
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_banner_edit,
					CASE p_banner_view
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_banner_view,
					CASE p_log_activity
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_log_activity,
					CASE p_web_config
					WHEN 1 THEN '<i class=\"fa fa-check\"></i> Allowed'
					ELSE '<i class=\"fa fa-ban\"></i> Deny'
					END AS p_web_config";

		$data['permission'] = $this->permission_model->get_permission_by_role_id($roleId, $field);

		$this->load->view('webadmin/user_mg/role/display-role', $data);

	}
	// End of function display_permission_by_id

}

/*
	End of class Permission
	End of file Permission.php
	Location: ./application/controllers/Permission.php
*/