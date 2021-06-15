<?php

class Article_model extends CI_Model {

	var $table = 'article';
    var $primaryKey = 'article.id';

    var $columnOrder = array('article.updated_time', 'article.title', 'article.status', 'users.name', '');

    var $columnSearch = array(
                            array(
                                'format' => 'timestamp',
                                'field' => 'article.updated_time',
                                'type' => 'daterange'
                            ),
                            array(
                                'format' => 'string',
                                'field' => 'article.title',
                                'type' => 'search'
                            ), 
                            array(
                                'format' => 'integer',
                                'field' => 'article.status',
                                'type' => 'select'
                            ), 
                            array(
                                'format' =>  'integer',
                                'field' => 'users.id',
                                'type' => 'select-multipe'
                            )
                        );
    
    var $order = array('article.updated_time' => 'desc');

    function count_filtered() {

        $sintax = $this->get_article_using_server_side_query_search_and_order();

        return $this->db->query($sintax)->num_rows();

    }
    // End of function count_filtered
 
    function count_all_data(){

        $this->db->from($this->table);
        $this->db->join('users', 'users.id = article.updated_by');

        return $this->db->count_all_results();

    }
    // End of function count_all_data

    function count_all_data_active() {

        $this->db->where('status', 1);
        $this->db->from($this->table);

        return $this->db->count_all_results();
    }
    // End of function count_all_data_active

    function count_article_by_title($title = '') {

        $sintax = "SELECT id FROM " . $this->table . " WHERE title = '$title'";

        $query = $this->db->query($sintax);

        $result = $query->num_rows();

        return $result;

    }
    // End of function count_article_by_title

    function get_article_by_id($articleId = 0, $field = '') {

        $sintax = "SELECT " . $field . "
                FROM " . $this->table . "
                WHERE id = '$articleId'";

        $query = $this->db->query($sintax);

        $result = $query->row_array();

        return $result;

    }
    // End of function get_article_by_id

    function get_article_by_slug($slug = 0, $field = '') {

        $sintax = "SELECT " . $field . "
                FROM " . $this->table . "
                WHERE slug = '$slug'";

        $query = $this->db->query($sintax);

        $result = $query->row_array();

        return $result;

    }
    // End of function get_article_by_slug

    function get_article_using_server_side_query_search_and_order() {

        $sintax = "SELECT 
                " . $this->primaryKey . " AS article_id, 
                " . $this->table . ".title, 
                " . $this->table . ".content,
                " . $this->table . ".status,
                users.id,
                users.name AS user_fullname, 
                article.updated_time
                FROM " . $this->table . "
                JOIN users ON users.id = article.updated_by ";

        $sintax .= $this->server_side_lib->individual_column_filtering($this->columnSearch);

        $sintax .= $this->server_side_lib->ordering($this->columnOrder, $this->order);

        return $sintax;

    }
    // End of function get_article_using_server_side_query_search_and_order
 
    function get_article_using_server_side() {

        $sintax = $this->get_article_using_server_side_query_search_and_order();

        $sintax .= $this->server_side_lib->limit();

        return $this->db->query($sintax)->result();

    }
    // End of function get_article_using_server_side

    function get_article_recently_added($field = '') {

        $sintax = "SELECT " . $field . "
                FROM article
                WHERE status = 1
                ORDER BY id DESC
                LIMIT 5";

        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }
    // End of function get_article_recently_added

    function get_article_rand($field = '', $limit = '4') {

        $sintax = "SELECT " . $field . "
                FROM article
                WHERE status = 1
                ORDER BY RAND()
                LIMIT " . $limit;

        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }
    // End of function get_article_rand

    function insert_data($data = '') {

        $this->db->insert($this->table, $data);
        return $this->db->insert_id();

    }
    // End of function insert_data

    function save_content($data = '', $imageUpload = '', $id = 0) {

        // 

        $this->db->where($this->primaryKey, $id);
        $this->db->update($this->table, $data);

    }
    // End of function save_content

    function update_data($data = '', $id = 0) {

        $this->db->where($this->primaryKey, $id);
        $this->db->update($this->table, $data);

    }
    // End of function update_data

    function delete_data($id = 0) {

        $this->db->trans_start();

        $this->db->query("DELETE FROM article WHERE id = '$id'");

        if ($this->db->trans_status() === false) {

            $this->db->trans_rollback();

            return false;

        } else {

            $this->db->trans_commit();

            return true;

        }
    }
    // End of functin delete_data

    function get_article_by_search($search = '', $field = '') {

        $sintax = "SELECT " . $field . " FROM " . $this->table . "
                WHERE status = 1 AND title LIKE '%" . $search . "%' ESCAPE '!'
                ORDER BY title ASC";

        $query = $this->db->query($sintax);

        $result = $query->result();

        return $result;

    }
    // End of function get_article_by_search

}

/*
    End of class Article_model
    End of file Article_model.php
    Location: ./application/models/Article_model.php
*/