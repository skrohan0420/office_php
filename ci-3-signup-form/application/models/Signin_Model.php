<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Signin_Model extends CI_Model{
        public function index($email,$password){
            $data=array(
                'Email'=>$email,
                'Password'=>$password
            );
            $query=$this->db->where($data);
            $login=$this->db->get('user_table');
            

            if($login!=NULL){
                return $login->row();
            }  
        }
    }