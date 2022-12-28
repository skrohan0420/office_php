<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller{
    public function index(){
        $this->load->view('login');        
    }

    public function initialize_model($model){
        $this->load->model($model);
    }

    public function login(){
        $admin_name = $this->input->post(param_name);  
        $admin_password = $this->input->post(param_password);
        $this->initialize_model(model_admin);
      
        $isAdmin = $this->Admin_model->adminExists($admin_name,$admin_password);
        if($isAdmin){
            $this->load->view('dashboard');        
        }else{
            $this->session->mark_as_flash('wrong_user');
            $this->session->set_flashdata('wrong_user','wrong user name or password');
            redirect(base_url('Admin')); 
        }
    }
    public function add_admin(){
        $new_admin_name = $this->input->post(param_name);  
        $new_admin_password = $this->input->post(param_password);
        $this->initialize_model(model_admin);

        if(empty($new_admin_name) || empty($new_admin_password)){
            $this->session->mark_as_flash('wrong_user');
            $this->session->set_flashdata('wrong_user','wrong user name or password');
            $this->load->view('dashboard');
            return false;
        }
        $adminExists = $this->Admin_model->adminExists($new_admin_name,$new_admin_password);
        if($adminExists){
            $this->session->mark_as_flash('admin_exists');
            $this->session->set_flashdata('admin_exists','admin allready registered');
            $this->load->view('dashboard');
            return false; 
        }
        else{
            $set_new_admin = $this->Admin_model->add_admin($new_admin_name,$new_admin_password);
            $this->session->mark_as_flash('data_inserted');
            $this->session->set_flashdata('data_inserted','data inserted successfully');
            $this->load->view('dashboard');
            return true;    
        }
    }
    public function get_all_users(){
        $this->initialize_model(model_admin);
        $userData['userData'] = $this->Admin_model->get_all_users();
        // echo "<pre>";
        // print_r($userData); 
        $this->load->view('dashboard', $userData);
    }
}


?>