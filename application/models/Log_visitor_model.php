<?php

class Log_visitor_model extends CI_Model {
	
	private $table = "log_visitor";
    
	var $columnOrder = array('time', 'ip_address', 'log', 'access_name', 'location');

    var $columnSearch = array(
                            array(
                                'format' => 'timestamp',
                                'field' => 'time',
                                'type' => 'daterange'
                            ),
                            array(
                                'format' => 'string',
                                'field' => 'ip_address',
                                'type' => 'search'
                            ),
                            array(
                                'format' => 'string',
                                'field' => 'log',
                                'type' => 'search'
                            ),
                            array(
                                'format' => 'string',
                                'field' => 'access_name',
                                'type' => 'select-multiple'
                            ),
                            array(
                                'format' => 'string',
                                'field' => 'location',
                                'type' => 'search'
                            ),
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

    function get_log_using_server_side_query_search_and_order() {

        $sintax = "SELECT * FROM " . $this->table . " ";

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

    function insert_log_visitor($data = '') {

        $this->db->insert($this->table, $data);

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
	End of class Log_visitor_model
	End of file Log_visitor_model.php
	Location: ./application/models/Log_visitor_model.php
*/