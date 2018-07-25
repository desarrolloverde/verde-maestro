<?php

class Modulos_model extends CI_Model {

        
        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function getModulos()
        {
                $query = $this->db->query('select * from app_navmenu');                
                return $query->result();//result_array();
        }


}
?>