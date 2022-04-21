<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_mod extends CI_model {

	public function GetData($data)
	{
		$view= $this->db->query("SELECT * FROM user WHERE username='".$data['username']."' and password='".md5($data['password'])."'");
		if ($view->num_rows()>0) {

			$userdata = $view->row();
			$data = array(
				'user_id' => $userdata->id,
				'username' => $userdata->username,
				'roles' => $userdata->roles
			);

			$this->session->set_userdata($data);

			return TRUE;

		}else{

			return FALSE;

		}
	}

}