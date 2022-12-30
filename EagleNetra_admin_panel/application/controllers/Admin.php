<?php
    defined('BASEPATH') or exit('nothing found');

    class Admin extends CI_Controller{


        public function __construct(){
            // header(header_allow_origin);
            // header(header_allow_methods);
    
            parent::__construct();
            $this->load->database();   
            $this->load->helper(helper_url);     
        }

        public function initializeAdminModel(){
            $this->load->model(model_admin);
        }

        public function index(){
            $this->load->view(view_login);
        }

        public function login(){
            $email = $this->input->post(param_email);
            $password = md5($this->input->post(param_password));
            $this->initializeAdminModel();
            $isAdmin = $this->Admin_model->isAdmin($email, $password);

            if($isAdmin){
                $this->load->view(view_dashboard);   
            }else{
                return false;
            }
        }


    }
?>