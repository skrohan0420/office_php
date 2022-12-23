<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
    public function index(){
        $userfname=$this->session->userdata('fname');	
        $this->load->view('welcome',['firstname'=>$userfname]);
    }
}