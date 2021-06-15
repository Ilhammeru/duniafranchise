<?php

class Users_model extends CI_Model {
	
	var $table = 'users';
	var $primaryKey = 'users.id';
	var $foreignKey = 'users.role_id';

    var $columnOrder = array('users.updated_time', 'users.name', 'users.username', 'role.name', '');

    var $columnSearch = array(
    						array(
    							'format' => 'timestamp',
    							'field' => 'users.updated_time',
    							'type' => 'daterange'
    						),
    						array(
    							'format' => 'string',
    							'field' => 'users.name',
    							'type' => 'search'
    						), 
    						array(
    							'format' =>  'string',
    							'field' => 'users.username',
    							'type' => 'search'
    						),
    						array(
    							'format' =>  'integer',
    							'field' => 'role.id',
    							'type' => 'select-multiple'
    						)
    					);
    
    var $order = array('users.updated_time' => 'desc');
 
    function count_filtered() {

        $sintax = $this->get_users_using_server_side_query_search_and_order();

        return $this->db->query($sintax)->num_rows();
        
    }
    // End of function count_filtered
 
    function count_all_data(){

        $this->db->from($this->table);
        $this->db->join('role', 'role.id = ' . $this->foreignKey);

        return $this->db->count_all_results();

    }
    // End of function count_all_data

	function count_users_by_id_and_password($id = 0, $userPassword = '') {

		$sintax = "SELECT " . $this->primaryKey . "
				FROM " . $this->table . "
				WHERE " . $this->primaryKey . " = '$id'
				AND password = '$userPassword'";

		$query = $this->db->query($sintax);

		$result = $query->num_rows();

		return $result;

	}
	// End of function count_users_by_id_and_password
	
	function count_users_by_username_and_password($username = '', $userPassword = '') {

		$sintax = "SELECT " . $this->primaryKey . "
				FROM " . $this->table . "
				WHERE username = lower('$username')
				AND password = '$userPassword'";

		$query = $this->db->query($sintax);

		$result = $query->num_rows();

		return $result;
	}
	// End of function count_users_by_email_and_password

	function count_users_by_username($username = '') {

		$sintax = "SELECT " . $this->primaryKey . "
				FROM " . $this->table . "
				WHERE username = lower('$username')";

		$query = $this->db->query($sintax);

		$result = $query->num_rows();

		return $result;
	}
	// End of function count_users_by_username

	function get_all_users_asc() {

		$sintax = "SELECT id,
			name
			FROM " . $this->table . "
			ORDER BY name ASC";

		$query = $this->db->query($sintax);

		$result = $query->result();

		return $result;

	}
	// End of function get_all_users_asc

   	function get_users_using_server_side_query_search_and_order() {

   		$sintax = "SELECT 
   				" . $this->primaryKey . " AS user_id, 
   				" . $this->table . ".name AS user_fullname, 
   				" . $this->table . ".username AS username, 
   				" . $this->table . ".updated_time, 
   				role.name AS role_name
	   			FROM " . $this->table . "
	   			JOIN role ON role.id = " . $this->foreignKey . " ";

   		$sintax .= $this->server_side_lib->individual_column_filtering($this->columnSearch);

   		$sintax .= $this->server_side_lib->ordering($this->columnOrder, $this->order);

        return $sintax;

    }
    // End of function get_users_using_server_side_query_search_and_order
 
    function get_users_using_server_side() {

        $sintax = $this->get_users_using_server_side_query_search_and_order();

	    $sintax .= $this->server_side_lib->limit();

        return $this->db->query($sintax)->result();

    }
    // End of function get_users_using_server_side

	function get_users_by_id($id = 0, $field = '') {

		$sintax = "SELECT " . $field . "
				FROM " . $this->table . "
				WHERE " . $this->primaryKey . " = '$id'";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		return $result;
	}
	// End of function get_users_by_id

	function get_users_by_username($username = '', $field = '') {

		$sintax = "SELECT " . $field . "
				FROM " . $this->table . "
				WHERE username = lower('$username')";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		return $result;
	}
	// End of function get_users_by_email

	function get_users_and_role($field = '') {

		$sintax = "SELECT " . $field . "
				FROM " . $this->table . "
				JOIN role ON role.id = " . $this->foreignKey;

		$query = $this->db->query($sintax);

		$result = $query->result();

		return $result;

	}
	// End of function get_users_and_role

	function get_users_and_role_by_user_id($userId = 0, $field = '') {

		$sintax = "SELECT " . $field . "
				FROM " . $this->table . "
				JOIN role ON role.id = " . $this->foreignKey . "
				WHERE " . $this->primaryKey . " = '$userId'";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		return $result;

	}
	// End of fucntion get_users_and_role_by_user_id

	function get_users_and_role_and_permission_by_user_id($userId = 0, $field = '') {

		$sintax = "SELECT " . $field . "
				FROM " . $this->table . "
				JOIN role ON role.id = " . $this->foreignKey . "
				JOIN permission ON permission.role_id = role.id
				WHERE " . $this->primaryKey . " = '$userId'";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		return $result;

	}
	// End of function get_users_and_role_and_permission_by_user_id

	function get_role_in_users() {

		$sintax = "SELECT DISTINCT role.id, role.name
				FROM " . $this->table . "
				JOIN role ON role.id = " . $this->foreignKey . "
				ORDER BY role.name ASC";

		$query = $this->db->query($sintax);

		$result = $query->result();

		return $result;

	}
	// End of function get_role_in_users

	function insert_data($data = '') {

		$this->db->insert($this->table, $data);

	}
	// End of function insert_data

	function update_data($data = '', $id = 0) {

		$this->db->where($this->primaryKey, $id);
		$this->db->update($this->table, $data);

	}
	// End of function update_data

	function update_data_by_email($data = '', $username = '') {

		$this->db->where('username', $username);
		$this->db->update($this->table, $data);

	}
	// End of function update_data_by_email

	function delete_data($id = 0) {

		$this->db->trans_start();

		$this->db->query("DELETE FROM log_activity WHERE user_id = '$id'");

		$this->db->query("DELETE FROM throttle WHERE user_id = '$id'");

		$this->db->query("DELETE FROM users WHERE id = '$id'");

		if ($this->db->trans_status() === false) {

			$this->db->trans_rollback();

			return false;

		} else {

			$this->db->trans_commit();

			return true;

		}
	}
	// End of functin delete_data
	
}

/*
	End of class Users_model
	End of file Users_model.php
	Location: ./application/models/users_model.php
*/