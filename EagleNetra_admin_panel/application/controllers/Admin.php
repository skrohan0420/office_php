<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller{
    public function index(){
        $this->load->view('login');        
    }

    public function login(){
        $userName = $this->input->post(param_user_name);  
        $password = $this->input->post(param_user_name);

        $this->load->model('User_model');
        $hasAccount = $this->User_model->login($userName,$password);
    }

}


?>