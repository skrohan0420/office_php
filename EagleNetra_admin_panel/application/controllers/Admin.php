<?php
    defined('BASEPATH') or exit('nothing found');

    class Admin extends CI_Controller{


        public function __construct(){
            // header(header_allow_origin);
            // header(header_allow_methods);
    
            parent::__construct();
            date_default_timezone_set('Asia/Kolkata');  
            $this->load->database();   
            // session_destroy(); 
            $this->load->helper(helper_url);     
        }
        public function print($data){
            echo '<pre>';
            print_r($data);
            echo '</pre>';
        }
        public function index(){
            if($this->session->userdata(session_name)){
                $this->dashboard();
                // session_destroy();
            }else{
                $this->load_header_link();
                $this->load_custom_style(css_login);
                $this->load->view(view_login);
                $this->load_footer_link();
                $this->load_custom_js(js_login);
            }   
        }
        public function initializeAdminModel(){
            $this->load->model(model_admin);
        }



        public function load_header_link(){
            $this->load->view(load_header_link);
        }
        public function load_custom_style($style){
            $this->load->view(load_custom_style . $style);
        }
        public function load_header(){
            $this->load->view(load_header);
        }
        public function load_side_bar(){
            $this->load->view(load_side_bar);
        }
        public function load_footer(){
            $this->load->view(load_footer);                                      
        }
        public function load_footer_link(){
            $this->load->view(load_footer_link);
        }
        public function load_custom_js($script){
            $this->load->view(load_custom_js . $script);
        }
        


       

        public function dashboard(){
            $this->initializeAdminModel();
            $total = $this->Admin_model->total_income();
            $total_user = $this->Admin_model->total_user();
            $total_subscriptions = $this->Admin_model->total_subscriptions();
            $total_kids = $this->Admin_model->total_kids();

            $total_income = 0;

            foreach($total as $key => $val){
                $total_income += $val[key_price] ;
            }
            $data = [
                'total_income' => $total_income,
                'total_user'  => $total_user,
                'total_subscriptions' => $total_subscriptions,
                'total_kids' => $total_kids
            ];

            if($this->session->userdata(session_name)){
                $this->load_header_link();
                $this->load_custom_style(css_dashboard);
                $this->load_header();
                $this->load_side_bar();
                $this->load->view(view_dashboard, $data);
                $this->load_footer();
                $this->load_footer_link();
                $this->load_custom_js(js_dashboard);
            }else{
                $this->index();
            }
        }

        public function login(){
            $email = $this->input->post(param_email);
            $password = md5($this->input->post(param_password));
            $this->initializeAdminModel();
            $isAdmin = $this->Admin_model->isAdmin($email, $password);

            if($isAdmin){
                $admin_data = $this->Admin_model->adminData($email, $password);

                $this->session->set_userdata(session_name, $admin_data[field_name]);
                $this->session->set_userdata(session_email, $admin_data[field_email]);
                $this->session->set_userdata(session_type, $admin_data[field_type]);
                redirect('Admin/dashboard');
            }else{
                $this->session->set_flashdata(key_wrong_user_name, text_incorrect_username_or_password);
                redirect('Admin/index');
            }
        }

        public function logout(){
            session_destroy();
            redirect('Admin/index');
        }

        public function new_users(){
            $this->initializeAdminModel();
            $new_users = $this->Admin_model->new_users();
            $new_users = json_encode($new_users);
            echo $new_users;
        }

        public function all_devices(){

            if($this->session->userdata(session_name)){
                $this->initializeAdminModel();
                $all_devices['data'] = $this->Admin_model->all_devices();
    
                $this->load_header_link();
                $this->load_custom_style(css_all_devices);
                $this->load_header();
                $this->load_side_bar();
                $this->load->view(view_all_devices, $all_devices);
                $this->load_footer();
                $this->load_footer_link();
                $this->load_custom_js(js_all_devices);
            }else{
               $this->index();
            }   

           

        }

        public function all_users(){

            if($this->session->userdata(session_name)){
                $this->initializeAdminModel();
                $all_users['data'] = $this->Admin_model->all_users();

                $this->load_header_link();
                $this->load_custom_style(css_all_users);
                $this->load_header();
                $this->load_side_bar();
                $this->load->view(view_all_users, $all_users);
                $this->load_footer();
                $this->load_footer_link();
                $this->load_custom_js(js_all_users);
            }else{
                $this->index();
            }

        }

        public function subscriptions(){
            if($this->session->userdata(session_name)){
                $this->initializeAdminModel();
                $subs['data'] = $this->Admin_model->subscriptions();

                $this->load_header_link();
                $this->load_custom_style(css_subscriptions);
                $this->load_header();
                $this->load_side_bar();
                $this->load->view(view_subscriptions, $subs);
                $this->load_footer();
                $this->load_footer_link();
                $this->load_custom_js(js_subscriptions);
            }else{
                $this->index();
            }
        }









    }
?>