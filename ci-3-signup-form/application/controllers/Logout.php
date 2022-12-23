<?php 

class Logout extends CI_Controller{
    public function index(){
        $this->session->unset_userdata('firstname');
        $this->session->unset_userdata('lastname');
        

        $this->load->view('signup')
    }
}

?>