<?php

class Web_config_model extends CI_Model {
	
	function get_version() {

		$sintax = "SELECT web_version FROM web_config LIMIT 1";

		$query = $this->db->query($sintax)->row_array();

		$result = $query['web_version'];

		return $result;
	}
	// End of function get_version

	function get_application_name() {

		$sintax = "SELECT web_application FROM web_config LIMIT 1";

		$query = $this->db->query($sintax)->row_array();

		$result = $query['web_application'];

		return $result;
	}
	// End of function get_application_name

	function get_logo_dir() {

		$sintax = "SELECT logo FROM web_config LIMIT 1";

		$query = $this->db->query($sintax)->row_array();

		$result = $query['logo'];

		return $result;
	}
	// End of function get_logo_dir

	function get_logo2_dir() {

		$sintax = "SELECT logo2 FROM web_config LIMIT 1";

		$query = $this->db->query($sintax)->row_array();

		$result = $query['logo2'];

		return $result;
	}
	// End of function get_logo2_dir

	function get_logomini_dir() {

		$sintax = "SELECT logomini FROM web_config LIMIT 1";

		$query = $this->db->query($sintax)->row_array();

		$result = $query['logomini'];

		return $result;
	}
	// End of function get_logomini_dir

	function get_corporation_name() {

		$sintax = "SELECT corporation_name FROM web_config LIMIT 1";

		$query = $this->db->query($sintax)->row_array();

		$result = $query['corporation_name'];

		return $result;
	}
	// End of function get_corporation_name

	function get_corporation_nickname() {

		$sintax = "SELECT corporation_nickname FROM web_config LIMIT 1";

		$query = $this->db->query($sintax)->row_array();

		$result = $query['corporation_nickname'];

		return $result;
	}
	// End of function get_corporation_nickname

	function get_corporation_address() {

		$sintax = "SELECT corporation_address FROM web_config LIMIT 1";

		$query = $this->db->query($sintax)->row_array();

		$result = $query['corporation_address'];

		return $result;
	}
	// End of function get_corporation_address

    function get_creator_in_table($table = '', $secondaryKey = '') {

    	if (empty($secondaryKey)) :

    		$secondaryKey = $table . ".creator";

    	endif;

    	if (! empty($table)) :

	        $sintax = "SELECT DISTINCT users.id, users.name
	                FROM " . $table . "
	                JOIN users ON users.id = " . $secondaryKey . "
	                ORDER BY users.name ASC";

	        $query = $this->db->query($sintax);

	        $result = $query->result();

	        return $result;

	    else :

	    	return false;

	    endif;

    }
    // End of function get_creator_in_table

    function get_updated_by_in_table($table = '', $secondaryKey = '') {

    	if (empty($secondaryKey)) :

    		$secondaryKey = $table . ".updated_by";

    	endif;

    	if (! empty($table)) :

	        $sintax = "SELECT DISTINCT users.id, users.name
	                FROM " . $table . "
	                JOIN users ON users.id = " . $secondaryKey . "
	                ORDER BY users.name ASC";

	        $query = $this->db->query($sintax);

	        $result = $query->result();

	        return $result;

	    else :

	    	return false;

	    endif;

    }
    // End of function get_updated_by_in_table

}

/*
	End of class Web_config_model
	End of file Web_config_model.php
	Location: ./application/models/Web_config_model.php

*/