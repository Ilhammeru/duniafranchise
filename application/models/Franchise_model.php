<?php

class Franchise_model extends CI_Model {

	var $table = 'franchise';
    var $primaryKey = 'franchise.id';

    var $columnOrder = array('franchise.updated_time', 'franchise.franchise_name', 'franchise.hits', 'franchise.status', 'users.name', '');

    var $columnSearch = array(
                            array(
                                'format' => 'timestamp',
                                'field' => 'franchise.updated_time',
                                'type' => 'daterange'
                            ),
                            array(
                                'format' => 'string',
                                'field' => 'franchise.franchise_name',
                                'type' => 'search'
                            ), 
                            array(
                                'format' => 'integer',
                                'field' => 'franchise.hits',
                                'type' => 'search'
                            ), 
                            array(
                                'format' => 'integer',
                                'field' => 'franchise.status',
                                'type' => 'select'
                            ), 
                            array(
                                'format' =>  'integer',
                                'field' => 'users.id',
                                'type' => 'select-multipe'
                            )
                        );
    
    var $order = array('franchise.updated_time' => 'desc');

    function count_filtered() {

        $sintax = $this->get_franchise_using_server_side_query_search_and_order();

        return $this->db->query($sintax)->num_rows();

    }
    // End of function count_filtered
 
    function count_all_data(){

        $this->db->from($this->table);
        $this->db->join('users', 'users.id = franchise.updated_by');

        return $this->db->count_all_results();

    }
    // End of function count_all_data

    function count_by_name($franchiseName = ''){

        $sintax = "SELECT id FROM " . $this->table . " WHERE franchise_name = '$franchiseName'";

        $query = $this->db->query($sintax);

        $result = $query->num_rows();

        return $result;

    }
    // End of function count_by_name

    function count_all_data_active() {

        $this->db->where('status', 1);
        $this->db->from($this->table);

        return $this->db->count_all_results();

    }
    // End of function count_all_data_active

    function get_all_franchise($field = '') {

        $sintax = "SELECT " . $field . "
                FROM " . $this->table . "
                ORDER BY franchise_name ASC";

        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }   
    // End of function get_all_franchise

    function get_franchise_using_server_side_query_search_and_order() {

        $sintax = "SELECT 
                " . $this->primaryKey . " AS franchise_id, 
                " . $this->table . ".franchise_name, 
                " . $this->table . ".hits,  
                " . $this->table . ".status,
                users.id,
                users.name AS user_fullname, 
                franchise.updated_time
                FROM " . $this->table . "
                JOIN users ON users.id = franchise.updated_by ";

        $sintax .= $this->server_side_lib->individual_column_filtering($this->columnSearch);

        $sintax .= $this->server_side_lib->ordering($this->columnOrder, $this->order);

        return $sintax;

    }
    // End of function get_franchise_using_server_side_query_search_and_order
 
    function get_franchise_using_server_side() {

        $sintax = $this->get_franchise_using_server_side_query_search_and_order();

        $sintax .= $this->server_side_lib->limit();

        return $this->db->query($sintax)->result();

    }
    // End of function get_franchise_using_server_side

    function get_franchise_by_id($franchiseId = 0, $field = '') {

        $sintax = "SELECT " . $field . "
                FROM " . $this->table . "
                WHERE id = '$franchiseId'";

        $query = $this->db->query($sintax);

        $result = $query->row_array();

        return $result;

    }
    // End of function get_franchise_by_id

    function get_franchise_by_name($franchiseName = '', $field = '') {

        $sintax = "SELECT " . $field . "
                FROM " . $this->table . "
                WHERE franchise_name = '$franchiseName'";

        $query = $this->db->query($sintax);

        $result = $query->row_array();

        return $result;

    }
    // End of function get_franchise_by_name 

    function get_franchise_by_slug($slug = '', $field = '') {

        $sintax = "SELECT " . $field . "
                FROM " . $this->table . "
                WHERE slug = '$slug'";

        $query = $this->db->query($sintax);

        $result = $query->row_array();

        return $result;

    }
    // End of function get_franchise_by_slug

    function get_last_banner_number() {

        $sintax = "SELECT banner_number
                FROM franchise_banner
                ORDER BY banner_number DESC
                LIMIT 1";

        $query = $this->db->query($sintax);

        $result = $query->row_array();

        return $result;

    }
    // End of function get_last_banner_number

    function get_banner($position = 'left') {

        // $sintax = "SELECT image_source, slug FROM franchise_banner
        //         JOIN franchise ON franchise.id = franchise_banner.franchise_id
        //         WHERE banner_showing = 1 AND banner_position = '$position'
        //         ORDER BY banner_number ASC";

        $sintax = "SELECT image_source, slug FROM franchise_banner
                JOIN franchise ON franchise.id = franchise_banner.franchise_id
                WHERE banner_showing = 1 AND banner_position = '$position'
                ORDER BY RAND()";

        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }
    // End of function get_banner

    function insert_data($data = '') {

        $this->db->insert($this->table, $data);

        return $this->db->insert_id();

    }
    // End of function insert_data
    
    function save_content($data = '', $imageUpload = '', $id = 0) {

        // prepare to image upload

        $this->db->where($this->primaryKey, $id);
        $this->db->update($this->table, $data);

    }
    // End of function save_content

    function update_data($data = '', $id = 0) {

        $this->db->where($this->primaryKey, $id);
        $this->db->update($this->table, $data);

    }
    // End of function update_data

    function update_data_franchise_banner($data = '', $id = 0) {

        $this->db->where('franchise_id', $id);
        $this->db->update('franchise_banner', $data);

    }
    // End of function update_data_franchise_banner

    function update_data_franchise_banner_by_name($dataLeft = '', $dataRight = '') {

        $this->db->trans_start();

        $j = 1;

        if (! empty($dataLeft)) {

            foreach ($dataLeft as $name) {

                $sintax = "UPDATE franchise_banner 
                        JOIN franchise ON franchise.id = franchise_banner.franchise_id 
                        SET banner_number = '$j' 
                        WHERE franchise.franchise_name = '$name'";

                $this->db->query($sintax);

                $j++;

            }

        }

        $k = 1;

        if (! empty($dataRight)) {

            foreach ($dataRight as $name) {

                $sintax = "UPDATE franchise_banner 
                        JOIN franchise ON franchise.id = franchise_banner.franchise_id 
                        SET banner_number = '$k' 
                        WHERE franchise.franchise_name = '$name'";

                $this->db->query($sintax);

                $j++;

            }

        }

        if ($this->db->trans_status() === false) {

            $this->db->trans_rollback();

            return false;

        } else {

            $this->db->trans_commit();

            return true;

        }

    }
    // End of function update_data_franchise_banner_by_name

    function delete_data($id = 0) {

        $this->db->trans_start();

        $this->db->query("DELETE FROM franchise WHERE id = '$id'");

        $this->db->query("DELETE FROM franchise_banner WHERE franchise_id = '$id'");

        if ($this->db->trans_status() === false) {

            $this->db->trans_rollback();

            return false;

        } else {

            $this->db->trans_commit();

            return true;

        }
    }
    // End of functin delete_data

    function count_banner_by_franchise_id($franchiseId = 0) {

        $sintax = "SELECT id FROM franchise_banner WHERE franchise_id = '$franchiseId'";

        $query = $this->db->query($sintax);

        $result = $query->num_rows();

        return $result;

    }
    // End of function count_banner_by_franchise_id

    function get_banner_by_franchise_id($franchiseId = 0) {

        $sintax = "SELECT *
                FROM franchise_banner
                WHERE franchise_id = '$franchiseId'";

        $query = $this->db->query($sintax);

        $result = $query->row_array();

        return $result;

    }
    // End of function get_banner_by_franchise_id

    function insert_data_banner($data = '') {

        $this->db->insert('franchise_banner', $data);

    }
    // End of function insert_data_banner

    function delete_banner($franchiseId = 0) {

        $this->db->where('franchise_id', $franchiseId);
        $this->db->delete('franchise_banner');

    }
    // End of function delete_banner

    function get_franchise_banner_sort_by_banner_number($field = '') {

        $sintax = "SELECT " . $field . "
                FROM franchise_banner
                JOIN franchise ON franchise.id = franchise_banner.franchise_id
                ORDER BY banner_number ASC";

        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }
    // End of function get_franchise_banner_sort_by_banner_number

    function get_franchise_banner_by_position_and_sort_by_banner_number($field = '', $position = 'left') {

        $sintax = "SELECT " . $field . "
                FROM franchise_banner
                JOIN franchise ON franchise.id = franchise_banner.franchise_id
                WHERE banner_position = '$position'
                ORDER BY banner_number ASC";

        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }
    // End of function get_franchise_banner_by_position_and_sort_by_banner_number

    function get_franchise_rand($field = '', $limit = 9) {

        $sintax = "SELECT " . $field . "
                FROM franchise
                WHERE status = 1
                ORDER BY RAND()
                LIMIT " . $limit;

        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }
    // End of function get_franchise_rand

    function update_data_by_slug($data = '', $slug = '') {

        $this->db->where('slug', $slug);
        $this->db->update($this->table, $data);

    }
    // End of function update_data_by_slug

    function get_franchise_by_search($search = '', $field = '') {

        $sintax = "SELECT " . $field . " FROM " . $this->table . "
                WHERE status = 1 AND franchise_name LIKE '%" . $search . "%' ESCAPE '!'
                ORDER BY franchise_name ASC";


        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }
    // End of function get_franchise_by_search

    function get_franchise_hits($field = '*', $limit = 9) {

        $sintax = "SELECT " . $field . "
                FROM franchise
                WHERE status = 1
                ORDER BY hits DESC
                LIMIT " . $limit;

        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }
    // End of function get_franchise_hits


}

/*
    End of class Franchise_model
    End of file Franchise_model.php
    Location: ./application/models/Franchise_model.php
*/