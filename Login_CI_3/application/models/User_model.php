<?php

class User_model extends CI_Model{

    public function login($userName,$password){
        $this->db->where('user_name',$userName);  
        $this->db->where('password',$password);  
        $query = $this->db->get('user_data');  
        if ($query->num_rows() > 0){  
            return true;
        }else{  
            return false;  
        }  
    }

    public function getData($userName){
        $this->db->where('userName',$userName);  
        $query = $this->db->get('user_data');  
  
        if ($query->num_rows() > 0){  
            return $query->result_array();  
        }else{  
            return false;  
        }  
    }

    public function putData($userName,$email,$phoneNumber,$city,$password){

        $data = [
            'userName'      => $userName, 
            'uid'           => rand(1111,9999),
            'email'         => $email,  
            'phoneNumber'   => $phoneNumber,  
            'city'          => $city,
            'password'      => $password  
        ];  

        $this->db->insert('user_data', $data);

    }

    public function emailExist($email){

        $this->db->where('email',$email);
        $query = $this->db->get('user_data');
        if ($query->num_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    } 
}


?>