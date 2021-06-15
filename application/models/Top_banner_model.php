<?php

class Top_banner_model extends CI_Model {

	function count_all_data() {

        $this->db->from('top_banner');
        $this->db->join('users', 'users.id = top_banner.updated_by');

        return $this->db->count_all_results();

	}
	// End of function count_all_data

	function get_top_banner_by_id($id = 0, $field = '') {

		$sintax = "SELECT " . $field . "
				FROM top_banner
				WHERE id = '" . $id . "'";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		return $result;

	}
	// End of function get_top_banner_by_name

	function get_top_banner_by_name($name = '', $field = '') {

		$sintax = "SELECT " . $field . "
				FROM top_banner
				WHERE name = '" . $name . "'";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		return $result;

	}
	// End of function get_top_banner_by_name
	
	function get_top_banner_by_name_join_franchise($name = '', $field = '') {

		$sintax = "SELECT " . $field . "
				FROM top_banner
				LEFT JOIN franchise ON franchise.id = top_banner.franchise_id
				WHERE name = '" . $name . "'";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		return $result;

	}
	// End of function get_top_banner_by_name_join_franchise

	function get_all_top_banner($field = '') {

		$sintax = "SELECT " . $field . "
				FROM top_banner
				ORDER BY id ASC";

		$query = $this->db->query($sintax);

		$result = $query->result();

		return $result;

	}
	// End of function get_all_top_banner

	function get_all_top_banner_active() {

		$sintax = "SELECT top_banner.id, top_banner.name, top_banner.image_source, franchise_id, top_banner.status, franchise.slug
				FROM top_banner
				LEFT JOIN franchise ON franchise.id = top_banner.franchise_id
				WHERE top_banner.status = 1
				ORDER BY name ASC";

		$query = $this->db->query($sintax);

		$result = $query->result();

		return $result; 

	}
	// End of function get_all_top_banner_active

	function get_last_id() {

		$sintax = "SELECT id
				FROM top_banner
				ORDER BY id DESC
				LIMIT 1";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		return $result;

	}
	// End of function get_last_id

	function get_top_banner_rand($field = 'top_banner.id, top_banner.name, top_banner.image_source, franchise_id, top_banner.status') {

		$sintax = "SELECT " . $field . ", franchise.slug
				FROM top_banner
				LEFT JOIN franchise ON franchise.id = top_banner.franchise_id
				WHERE top_banner.status = 1
				AND top_banner.image_source IS NOT NULL
				ORDER BY RAND()
				LIMIT 1";

		$query = $this->db->query($sintax);

		$result = $query->row_array();

		return $result;

	}
	// End of function get_top_banner_rand

	function insert_data($data = '') {

		$this->db->insert('top_banner', $data);

	}
	// End of function insert_data

	function update_data($data = '', $id = 0) {

		$this->db->where('id', $id);
		$this->db->update('top_banner', $data);

	}
	// End of function update_data

}

/* 
	End of class Top_banner_model
	End of file Top_banner_model.php
	Location: ./application/models/Top_banner_model.php
*/