<?php

class Log_activity_model extends CI_Model {
	
	private $table = "log_activity";
    
	var $columnOrder = array('time', 'log', 'users.name', 'access_name', 'activity_name');

    var $columnSearch = array(
                            array(
                                'format' => 'timestamp',
                                'field' => 'time',
                                'type' => 'daterange'
                            ),
                            array(
                                'format' => '',
                                'field' => '',
                                'type' => ''
                            ),
                            array(
                                'format' => 'integer',
                                'field' => 'users.id',
                                'type' => 'select-multiple'
                            ),
                            array(
                                'format' => 'string',
                                'field' => 'access_name',
                                'type' => 'select-multiple'
                            )
                        );

    var $order = array('time' => 'desc');
    
    function count_filtered() {

        $sintax = $this->get_log_using_server_side_query_search_and_order();

        return $this->db->query($sintax)->num_rows();

    }
    // End of function count_filtered
 
    function count_all_data(){

        $this->db->from($this->table);

        return $this->db->count_all_results();

    }
    // End of function count_all_data
 
    function count_by_user_id_filtered($userId = 0) {

        $this->get_log_by_user_id_using_server_side_query_search_and_order($userId);
        
        $query = $this->db->get();

        return $query->num_rows();
    }
    // End of function count_filtered
 
    function count_by_user_id($userId = 0){

        $this->db->from($this->table);

        $this->db->where("user_id", $userId);

        return $this->db->count_all_results();

    }
    // End of function count_all_data

	function get_log_using_server_side_query_search_and_order() {

        $sintax = "SELECT time, log, access_name, user_id, users.name AS user_fullname
                FROM " . $this->table . "
                JOIN users ON users.id = log_activity.user_id ";

        $sintax .= $this->server_side_lib->individual_column_filtering($this->columnSearch);

        $sintax .= $this->server_side_lib->ordering($this->columnOrder, $this->order);

        return $sintax;

    }
    // End of function get_log_using_server_side_query_search_and_order
 
    function get_log_using_server_side() {

        $sintax = $this->get_log_using_server_side_query_search_and_order();

        $sintax .= $this->server_side_lib->limit();

        return $this->db->query($sintax)->result();

    }
    // End of function get_log_using_server_side

    function get_log_by_user_id_using_server_side_query_search_and_order($userId = 0) {

        $this->db->select("time, log");
        $this->db->from($this->table);
        $this->db->where("user_id", $userId);
 
        $i = 0;
     
        foreach ($this->columnSearch as $item) {

            if ($_POST['search']['value']) {
                 
                if ($i === 0) {

                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);

                } else {

                    $this->db->or_like($item, $_POST['search']['value']);

                }
 
                if (count($this->columnSearch) - 1 == $i) {

                    $this->db->group_end();

                }
            
            }

            $i++;

        }
        // End loop
         
        if (isset($_POST['order'])) {

            $this->db->order_by($this->columnOrder[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

        } elseif (isset($this->order)) {

            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);

        }

    }
    // End of function get_log_using_server_side_query_search_and_order
 
    function get_log_by_user_id_using_server_side($userId = 0) {

        $this->get_log_by_user_id_using_server_side_query_search_and_order($userId);

        if($_POST['length'] != -1) {

        	$this->db->limit($_POST['length'], $_POST['start']);

        }

        $query = $this->db->get();

        return $query->result();

    }
    // End of function get_log_using_server_side

    function get_user_in_log() {

        $sintax = "SELECT DISTINCT users.id, users.name
                FROM " . $this->table . "
                JOIN users ON users.id = log_activity.user_id
                ORDER BY users.name ASC";

        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }
    // End of function get_user_in_log

    function get_access_in_log() {

        $sintax = "SELECT DISTINCT access_name
                FROM " . $this->table . "
                ORDER BY access_name ASC";

        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }
    // End of function get_access_in_log

	function insert_log_activity($data = '') {

		$this->db->insert($this->table, $data);
		return $this->db->insert_id();

	}
	// End of function insert_log_activity

    function insert_log_visitor($data = '') {

        $this->db->insert('log_visitor', $data);

    }
    // End of function insert_log_visitor

    function count_visitor() {

        $sintax = "SELECT DISTINCT(ip_address) FROM log_visitor";

        $query = $this->db->query($sintax);

        $result = $query->num_rows();

        return $result;

    }
    // End of function count_visitor
	
}

/*
	End of class Log_activity_model
	End of file Log_activity_model.php
	Location: ./application/models/Log_activity_model.php
*/