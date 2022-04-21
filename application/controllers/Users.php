<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Choirul Anam
	 * choirulanamm@gmail.com
	 */
	public function index()
	{
		if ($this->session->userdata("username")=="") {
			redirect("Login");
		}else{
			$data['title'] = ".::DASHBOARD APP PNL ::.";
			$this->load->view('user',$data);
		}
	}
}
