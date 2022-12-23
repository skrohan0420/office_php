<?php

class User extends CI_Controller{

    public function index(){
        if($this->session->userData('userName')){
            redirect('User/dashboard');
        }else{
            $this->load->view('login');
        }
                
    }

    public function signup(){
        $this->load->view('signup');
    }





    public function signUpAct(){
        $userName = $this->input->post('userName');  
        $email = $this->input->post('email');
        $phoneNumber = $this->input->post('phoneNumber');
        $city = $this->input->post('city');
        $password = $this->input->post('password');

        $this->load->model('User_model');
        
        if($this->User_model->emailExist($email)){
            $this->session->set_flashdata('Email_exists', 'This Email is allready in use');
            redirect('User/signup');
        }else{
            $this->User_model->putData($userName,$email,$phoneNumber,$city,$password);
            redirect('User/index');
        }



    }








    public function login(){
        $userName = $this->input->post('userName');  
        $password = $this->input->post('password');

        $this->load->model('User_model');
        $hasAccount = $this->User_model->login($userName,$password);
        
        // echo '<pre>';
        // print_r($userData);
        // die;

        if($hasAccount){
            $userData = $this->User_model->getData($userName);

            $this->session->set_userdata('userName', $userData[0]['userName']);
            $this->session->set_userdata('city', $userData[0]['city']);
            $this->session->set_userdata('phoneNumber', $userData[0]['phoneNumber']);
            
            redirect('User/dashboard');
        }else{
            $this->session->set_flashdata('login_faild', 'Incorrect Username or password');
            redirect('User/index');
        } 
    }

    public function dashboard(){
        if($this->session->userData('userName')){
            $this->load->view('userData');
        }else{
            $this->load->view('login');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('user/index');
    }
}


?>