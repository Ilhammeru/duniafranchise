<?php

class Throttle_model extends CI_Model {

	private $table = 'throttle';
	private $primaryKey = 'throttle.id';
	private $foreignKey = 'throttle.user_id';
	
	function count_throttle_by_user_id($userId = 0) {

		$sintax = "SELECT " . $this->primaryKey . "
				FROM " . $this->table . "
				WHERE " . $this->foreignKey . " = '$userId'";

		$query = $this->db->query($sintax);

		$result = $query->num_rows();

		return $result;
	}
	// End of function count_throttle_by_user_id

	function count_throttle_by_user_id_and_ip_address($userId = 0, $ipAddress = '') {

		$sintax = "SELECT " . $this->primaryKey . "
				FROM " . $this->table . "
				WHERE " . $this->foreignKey . " = '$userId'
				AND ip_address = '$ipAddress'";

		$query = $this->db->query($sintax);

		$result = $query->num_rows();

		return $result;

	}
	// End of function count_throttle_by_user_id_and_ip_address

	function get_throttle_by_user_id($userId = 0, $field = '') {

		$sintax = "SELECT " . $field . "
				FROM " . $this->table . "
				WHERE " . $this->foreignKey . " = '$userId'";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		return $result;
	}
	// End of function get_throttle_by_user_id

	function get_last_access($userId = 0) {

		$sintax = "SELECT access
				FROM " . $this->table . "
				WHERE " . $this->foreignKey . " = '$userId'
				ORDER BY activity DESC
				LIMIT 1";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		$lastAccess = $result['access'];

		return $lastAccess;

	}
	// End of function get_last_access

	function get_datetime_diff($userId = 0) {

		$sintax = "SELECT (
					(DATE_FORMAT(NOW(), '%d') *24 * 3600) +
					(DATE_FORMAT(NOW(), '%h')  * 3600) +
					(DATE_FORMAT(NOW(), '%i') * 60) +
					DATE_FORMAT(activity, '%s')
				) - 
				(
					(DATE_FORMAT(activity, '%d') *24 * 3600) +
					(DATE_FORMAT(activity, '%h')  * 3600) +
					(DATE_FORMAT(activity, '%i') * 60) +
					DATE_FORMAT(activity, '%s')
				) AS datetime_diff
				FROM " . $this->table . "
				WHERE " . $this->foreignKey . " = '$userId'";

		$query = $this->db->query($sintax)->row_array();

		$result = $query['datetime_diff'];

		return $result;

	}
	// End of function get_datetime_diff

	function insert_throttle($data = '') {

		$this->db->insert($this->table, $data);

	}
	// End of function insert_throttle

	function update_throttle($data = '', $id = 0) {

		$this->db->where($this->primaryKey, $id);
		$this->db->update($this->table, $data);

	}
	// End of function update_throttle

	function delete_throttle_by_user_id($userId = 0) {

		$this->db->where($this->foreignKey, $userId);
		$this->db->delete($this->table);

	}
	// End of function delete_throttle_by_user_id

}

/* 
	End of class Throttle_model
	End of file Throttle_model.php
	Location: ./application/models/Throttle_model.php
*/
