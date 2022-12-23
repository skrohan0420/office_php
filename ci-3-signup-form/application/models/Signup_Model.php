<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Signup_Model extends CI_Model{
    public function index($fname,$lname,$emailid,$password){
        $data=array(
            'FirstName'=>$fname,
            'LastName'=>$lname,
            'Email'=>$emailid,
            'Password'=>$password
        );
        $query=$this->db->insert('user_table',$data);
    }
}
