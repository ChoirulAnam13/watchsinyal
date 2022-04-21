<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Choirul Anam
	 * choirulanamm@gmail.com
	 */
	public function index()
	{
		if ($this->session->userdata("username")=="") {
			$data['title'] = ".::LOGIN APP PNL ::.";
			$this->load->view('login',$data);
		}else{
			redirect("Dashboard");
		}
	}

	public function Checking(){
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password') 
		);

		$getdata = $this->Login_mod->GetData($data);

		if ($getdata) {
			echo "{\"view_return\":".json_encode('OK')."}";
		}else{
			echo "{\"view_return\":".json_encode('NO')."}";
		}
	}

	public function Logout(){
		unset($_SESSION['username']);
		unset($_SESSION['LoginApp']);
		$this->session->sess_destroy();
		redirect('Login');
	}
}
