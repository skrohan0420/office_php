<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends CI_Model{

    public function login($userName,$password){
        $this->db->where(feild_name,$userName);  
        $this->db->where(feild_password,$password);  
        $query = $this->db->get('user_data');  
        if ($query->num_rows() > 0){  
            return true;
        }else{  
            return false;  
        }  
    }
    
}


?>