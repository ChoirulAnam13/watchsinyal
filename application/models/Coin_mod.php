<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coin_mod extends CI_model {

	public function GetData()
	{
		$data =  $this->db->query("SELECT * FROM coin WHERE title!='BUSD' order by title");
		return $data;
	}
}