<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Signup extends CI_Controller {
    public function index(){
        $fname=$this->input->post('firstname');
        $lname=$this->input->post('lastname');
        $emailid=$this->input->post('emailid');
        $password=$this->input->post('password');
        $this->load->model('Signup_Model');
        $this->Signup_Model->index($fname,$lname,$emailid,$password);

        $this->session->set_userdata('firstname', $fname);
        $this->session->set_userdata('lastname', $lname);


        $this->load->view('signin');
    }
}