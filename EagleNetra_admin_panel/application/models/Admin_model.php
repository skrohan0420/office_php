<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Admin_model extends CI_Model{

    public function adminExists($admin_name,$admin_password){

        $query = $this->db
                    ->where(feild_name,$admin_name)
                    ->where(feild_password,$admin_password)
                    ->get(table_admin);  

        if ($query->num_rows() > 0){  
            return true;
        }  
        return false;
    }

    public function add_admin($new_admin_name,$new_admin_password){
        $data = [
            'uid' => 'ADMIN_' . rand(1000, 9999).'_'.date('y-m-d'),
            'name' => $new_admin_name,
            'password' => $new_admin_password,
            'type' => 'secondary',
        ] ;
        $inserted = $this->db->insert(table_admin, $data);

        if($inserted){
            return true;
        }
        return false;       
    }
    public function get_all_users(){
        $allUsers = $this->db
                        ->select('uid as id,user_type,name,email,relationship,phone_number,image,')
                        ->get(table_user);

        $allUsers = $allUsers->result_array();
        return $allUsers; 
    }




}


?>