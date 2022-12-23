<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyController extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Mymodel', 'u');
        $this->load->database();
        $this->load->library('form_validation');
        
    }
    public function index(){
        $this->load->view('login');
    }

    public function register()
	{
		$this->form_validation->set_rules('reg_email', 'Email-ID', 'required|valid_email');
		$this->form_validation->set_rules('reg_name', 'Full Name', 'required');
		$this->form_validation->set_rules('reg_dob', 'Date Of Birth', 'required');
		$this->form_validation->set_rules('reg_password', 'Password', 'required');
		$this->form_validation->set_rules('reg_confirm_password', 'Confirm Password', 'required|matches[reg_password]');

        if ($this->form_validation->run() == FALSE){
            $this->load->view('regitration');
        }else{
            $insert = array(
                'reg_email' => $this->db->escape_str(trim($this->input->post('reg_email'))),
                'reg_name' => $this->db->escape_str(trim($this->input->post('reg_name'))),
                'reg_dob' => $this->db->escape_str(trim($this->input->post('reg_dob'))),
                'reg_password' => $this->db->escape_str(md5(trim($this->input->post('reg_password')))),
            );
            $array = $this->u->register($insert);
            if(!empty($array)){
                $this->session->set_userdata('userdata', $array);
                redirect('index');
            }else{
                $this->session->set_flashdata('reg_error','Registration Not Successfull');
                $this->load->view('regitration');
            }
        }
	}

    #login
    public function login(){
        if(!empty($this->session->userdata('userdata'))){
            redirect('dashboard');

        }else{
            $this->form_validation->set_rules('reg_email', 'Email-ID', 'required|valid_email');
            $this->form_validation->set_rules('reg_password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE){
                $this->load->view('login');
            }else{
                $check = array(
                    'reg_email' => $this->db->escape_str(trim($this->input->post('reg_email'))),
                    'reg_password' => $this->db->escape_str(trim($this->input->post('reg_password'))),
                );
                $checking = $this->u->login($check);
                if($checking){
                    $this->session->set_userdata('userdata', $checking);
                    redirect('dashboard');
                }
                $this->session->set_flashdata('login_error','Your Email-ID Or Password does not matched.');
                redirect('login');  
            }      
       }
    }


    #dashboard
    public function dashboard(){
        
       
        $session = $this->session->userdata('userdata');
        if(!empty($session)){
            $data['users'] = $this->u->alldata();
            $this->load->view('dashboard', $data);
        }else{
            $this->session->unset_userdata('userdata');
            $this->session->sess_destroy();
            redirect('login');
        } 
        
    }

    function logout()
    {
        $this->session->unset_userdata('userdata');
        $this->session->sess_destroy();
        redirect('login'); 
    }

   
}
?>