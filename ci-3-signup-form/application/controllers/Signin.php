<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Signin extends CI_Controller{
    public function index(){
        $email=$this->input->post('emailid');
        $password=$this->input->post('password');
        $this->load->model('Signin_Model');
        $validate=$this->Signin_Model->index($email,$password);

        redirect('Signin/Welcome');
    }
    public function Welcome(){
        $userfname=$this->session->userdata('firstname');	
        $userlname=$this->session->userdata('lastname');	
        $this->load->view('welcome',['firstname'=>$userfname, 'lastname' => $userlname]);
    }
}
?>