<?php

class Permission_model extends CI_Model {

	private $table = "permission";
	private $primaryKey = "permission.id";
	private $foreignKey = "permission.role_id";

	function get_permission_by_id($id = 0, $field = '') {

		$sintax = "SELECT " .  $field . "
				FROM " . $this->table . "
				WHERE " . $this->primaryKey . " = '$id'";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		return $result;

	}
	// End of function get_permission_by_id

	function get_permission_by_role_id($roleId = 0, $field = '') {

		$sintax = "SELECT " .  $field . "
				FROM " . $this->table . "
				WHERE " . $this->foreignKey . " = '$roleId'";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		return $result;

	}
	// End of function get_permission_by_role_id

	function update_data_by_role_id($data = '', $roleId = 0, $roleData = '') {

        $this->db->trans_start();

        $this->db->where('id', $roleId);

        $this->db->update('role', $roleData);

		$this->db->where($this->foreignKey, $roleId);

		$this->db->update($this->table, $data);

        if ($this->db->trans_status() === false) {

            $this->db->trans_rollback();

            return false;

        } else {

            $this->db->trans_commit();

            return true;

        }


	}
	// End of function update_data_by_role_id

}

/*
	End of class Permission_model
	End of file Permisison_model.php
	Location: ./application/models/Permisison_model.php
*/