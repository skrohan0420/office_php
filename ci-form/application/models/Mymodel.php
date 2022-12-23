<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	class Mymodel extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
            $this->load->database();
		}

        public function register($data){
            if($this->db->insert("reg",$data))
            return true;
        }

        public function login($data){
            $query = $this->db->select('*')->from('reg')
                        ->where('reg_email', $data['reg_email'])
                        ->where('reg_password', $data['reg_password'])
                        ->get()
                        ->result();
            if(count($query) > 0){
                return $query;
            }else{
                return false;
            }
        }

        public function alldata(){
            return $this->db->select('*')->from('reg')->get()->result();
        }

    }
?>