<?php 

class User extends CI_Controller{

	function index(){
		$this->load->view('signup');
	}
	public function logout(){
        $this->session->sess_destroy();
        redirect('User');
    }
}

?>
