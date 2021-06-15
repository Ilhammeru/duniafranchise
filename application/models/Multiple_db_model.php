<?php

/*
 * class Multiple_db_model
 */

class Multiple_db_model extends CI_Model {

    private $selectedDB;

    public function custom_query($query, $database) {
        
        $this->selectedDB = $this->load->database($database, TRUE);

        $connected = $this->selectedDB->initialize();

        if (!$connected) {
            return false;
        } else {

            $result = $this->selectedDB->query($query);
            $this->selectedDB->close();

            return $result;
        
        }

    }
    // End of function custom_query

    public function connected_multiple($query, $database) {

        for ($i = 0;  $i < count($database); $i++) {
            $this->load->database($database[$i], TRUE);
        }

        $result = $this->db->query($query);

        for ($i = 0;  $i < count($database); $i++) {
            $this->$database[$i]->close();
        }

    }
    // End of function connected_multiple

}
/* End of file Multiple_db_model.php */
/* Location: ./application/models/Multiple_db_model.php/ */