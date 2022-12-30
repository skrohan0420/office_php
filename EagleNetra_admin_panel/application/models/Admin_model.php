<?php 
defined('BASEPATH') or exit('nothing found');

class Admin_model extends CI_Model {

    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');  
    }

    public function isAdmin($email, $password){

        $isAdmin = $this->db
                        ->select('*')
                        ->where(field_email,$email)
                        ->where(field_password,$password )
                        ->get(table_admin);
        $isAdmin = $isAdmin->num_rows();
        
        if($isAdmin > 0){
            return true;
        }
        return false;
    }








}
?>