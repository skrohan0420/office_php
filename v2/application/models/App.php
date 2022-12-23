<?php
    class App extends CI_Model {
        public function __construct(){
            parent::__construct();
        }

        public function app_version(){
            $query = $this->db->get('ih_preferences')->result();  
            return $query; 
        }
    }
?>