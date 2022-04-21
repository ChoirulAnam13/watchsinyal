<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
			$data['content'] = "utama";
			$this->load->view('dashboard',$data);
		}
	}
}
