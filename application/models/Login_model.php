<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	// fungsi menampilkan data admin berdasarkan username, password, status blokir dan level usernya
	public function ambiluser($data)
	{
	$this->db->select('*')->from('users');
	$this->db->where($data);
	$query=$this->db->get();
	return $query;
	}
}

