<?php

class About_us_model extends CI_Model {

	var $table = 'about_us';
	var $primaryKey = 'about_us.id';

	function get_about_us() {

		$sintax = "SELECT *
				FROM about_us
				LIMIT 1";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		return $result;

	}
	// End of function get_about_us
	
	function update_data($data = '') {

		$this->db->where($this->primaryKey, '1');
		$this->db->update($this->table, $data);

	}
	// End of function update_data

}

/*
	End of class About_us_model
	End of file About_us_model.php
	Location: ./application/models/About_us_model.php
*/	