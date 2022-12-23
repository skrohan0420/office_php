<?php 
defined('BASEPATH') or exit('nothing found');

class User_model extends CI_Model {

    public function getUserById($id){

        $result = $this->db->where('id' , $id)->get('user_data');

        $result = $result->result_array();

        return $result;
        
    }


}


?>