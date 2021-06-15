<?php

class Role_model extends CI_Model {

	var $table = 'role';
    var $primaryKey = 'role.id';

    var $columnOrder = array('role.updated_time', 'role.name', 'users.name', '');

    var $columnSearch = array(
                            array(
                                'format' => 'timestamp',
                                'field' => 'role.updated_time',
                                'type' => 'daterange'
                            ),
                            array(
                                'format' => 'string',
                                'field' => 'role.name',
                                'type' => 'search'
                            ), 
                            array(
                                'format' =>  'integer',
                                'field' => 'users.id',
                                'type' => 'select-multipe'
                            )
                        );
    
    var $order = array('role.updated_time' => 'desc');

    function count_role_by_name($roleName = '') {

        $sintax = "SELECT id FROM " . $this->table . " WHERE name = '$roleName'";

        $query = $this->db->query($sintax);

        $result = $query->num_rows();

        return $result;

    }
    // End of function count_role_by_name

    function count_filtered() {

        $sintax = $this->get_role_using_server_side_query_search_and_order();

        return $this->db->query($sintax)->num_rows();

    }
    // End of function count_filtered
 
    function count_all_data(){

        $this->db->from($this->table);
        $this->db->join('permission', 'permission.role_id = ' . $this->primaryKey);
        $this->db->join('users', 'users.id = role.updated_by');

        return $this->db->count_all_results();

    }
    // End of function count_all_data

   	function get_role_using_server_side_query_search_and_order() {

   		$sintax = "SELECT 
                " . $this->primaryKey . " AS role_id, 
                " . $this->table . ".name AS role_name, 
                users.id,
                users.name AS user_fullname, 
                role.updated_time
                FROM " . $this->table . "
                JOIN permission ON permission.role_id = " . $this->primaryKey . "
                JOIN users ON users.id = role.updated_by ";

        $sintax .= $this->server_side_lib->individual_column_filtering($this->columnSearch);

        $sintax .= $this->server_side_lib->ordering($this->columnOrder, $this->order);

        return $sintax;

    }
    // End of function get_users_using_server_side_query_search_and_order
 
    function get_role_using_server_side() {

        $sintax = $this->get_role_using_server_side_query_search_and_order();

        $sintax .= $this->server_side_lib->limit();

        return $this->db->query($sintax)->result();

    }
    // End of function get_role_using_server_side
	
	function get_all_data_asc($field = '') {

		$sintax = "SELECT " . $field . " FROM " . $this->table;

		$query = $this->db->query($sintax);

		$result = $query->result();

		return $result;

	}
	// End of function get_all_data_asc

    function get_role_by_id($id = 0) {

        $sintax = "SELECT id, name FROM " . $this->table . " WHERE " . $this->primaryKey . " = '$id'";

        $query = $this->db->query($sintax);

        $result = $query->row_array();

        return $result;

    }
    // End of function get_role_by_id

    function get_role_and_permission_by_role_id($roleId = 0) {

        $sintax = "SELECT " . $this->primaryKey . " AS role_id,
                    " . $this->table . ".name AS role_name,
                    p_user_report,
                    p_user_add,
                    p_user_view,
                    p_user_edit,
                    p_user_delete,
                    p_role_report,
                    p_role_add,
                    p_role_view,
                    p_role_edit,
                    p_role_delete,
                    p_franchise_report,
                    p_franchise_add,
                    p_franchise_view,
                    p_franchise_edit,
                    p_franchise_delete,
                    p_article_report,
                    p_article_view,
                    p_article_edit,
                    p_article_add,
                    p_article_delete,
                    p_about_us_view,
                    p_about_us_edit,
                    p_banner_view,
                    p_banner_edit,
                    p_log_activity,
                    p_web_config,
                    role.updated_time,
                    CONCAT(users.name, ' [', users.username, ']') AS username
                    FROM " . $this->table . "
                    JOIN permission ON permission.role_id = " . $this->primaryKey . "
                    JOIN users ON users.id = role.updated_by
                    WHERE " . $this->primaryKey . " = '$roleId'";

        $query = $this->db->query($sintax);

        $result = $query->row_array();

        return $result;

    }
    // End of function get_role_and_permission_by_role_id

    function get_role_and_permission_by_role_id_to_display($roleId = 0) {

        $sintax = "SELECT " . $this->primaryKey . " AS role_id,
                    " . $this->table . ".name AS role_name,
                    CASE p_user_report
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_user_report,
                    CASE p_user_add
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_user_add,
                    CASE p_user_view
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_user_view,
                    CASE p_user_edit
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_user_edit,
                    CASE p_user_delete
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_user_delete,
                    CASE p_role_report
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_role_report,
                    CASE p_role_add
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_role_add,
                    CASE p_role_view
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_role_view,
                    CASE p_role_edit
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_role_edit,
                    CASE p_role_delete
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_role_delete,
                    CASE p_franchise_report
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_franchise_report,
                    CASE p_franchise_add
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_franchise_add,
                    CASE p_franchise_view
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_franchise_view,
                    CASE p_franchise_edit
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_franchise_edit,
                    CASE p_franchise_delete
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_franchise_delete,
                    CASE p_article_report
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_article_report,
                    CASE p_article_add
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_article_add,
                    CASE p_article_view
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_article_view,
                    CASE p_article_edit
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_article_edit,
                    CASE p_article_delete
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_article_delete,
                    CASE p_about_us_edit
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_about_us_edit,
                    CASE p_about_us_view
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_about_us_view,  
                    CASE p_banner_edit
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_banner_edit,
                    CASE p_banner_view
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_banner_view,
                    CASE p_log_activity
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_log_activity,
                    CASE p_web_config
                    WHEN 1 THEN '<i class=\"fa fa-check-square-o\"></i>'
                    ELSE '<i class=\"fa fa-ban\"></i>'
                    END AS p_web_config,
                    role.updated_time,
                    CONCAT(users.name, ' [', users.username, ']') AS username
                    FROM " . $this->table . "
                    JOIN permission ON permission.role_id = " . $this->table . ".id
                    JOIN users ON users.id = role.updated_by
                    WHERE " . $this->primaryKey . " = '$roleId'";

        $query = $this->db->query($sintax);

        $result = $query->row_array();

        return $result;

    }
    // End of function get_role_and_permission_by_role_id_to_display

    function get_creator_in_role() {

        $sintax = "SELECT DISTINCT users.id, users.name
                FROM " . $this->table . "
                JOIN users ON users.id = " . $this->table . ".creator
                ORDER BY users.name ASC";

        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }
    // End of function get_creator_in_role

    function get_updated_by_in_role() {

        $sintax = "SELECT DISTINCT users.id, users.name
                FROM " . $this->table . "
                JOIN users ON users.id = " . $this->table . ".updated_by
                ORDER BY users.name ASC";

        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }
    // End of function get_updated_by_in_role

    function insert_data($roleData = '', $permissionData = '') {

        $this->db->trans_start();

        $this->db->insert($this->table, $roleData);

        $roleName = $roleData['name'];

        $role = $this->db->query("SELECT id FROM role WHERE name = '$roleName'")->row_array();

        $roleDataAdd['role_id'] = $role['id'];

        $data = array_merge($permissionData, $roleDataAdd);

        $this->db->insert('permission', $data);

        if ($this->db->trans_status() === false) {

            $this->db->trans_rollback();

            return false;

        } else {

            $this->db->trans_commit();

            return true;

        }

    }
    // End of function insert_data

    function delete_data($roleId = 0) {

        $this->db->trans_start();

        $this->db->query("DELETE FROM permission WHERE role_id = '$roleId'");
       
        $this->db->query("DELETE FROM role WHERE id = '$roleId'");

        if ($this->db->trans_status() === false) {

            $this->db->trans_rollback();

            return false;

        } else {

            $this->db->trans_commit();

            return true;

        }

    }
    // End of function delete_data

}

/*
	End of class Role_model
	End of file Role_model.php
	Location: ./application/models/Role_model.php
*/