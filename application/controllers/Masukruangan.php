<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/* 
	* class ini digunakan untuk menampilkan form login.
	*/

class Masukruangan extends CI_Controller {
   
   function __construct()
	{
    	parent::__construct();

    	/*
    	*	Fungsi ini digunakan jika administrator belum keluar dari halaman administrator maka jika mengetikan url login akan 
    	*	muncul peringatan dan akan redirect ke halaman sebelumnya masing-masing level.
    	*/

  		if ($this->session->userdata('username') !="" || $this->session->userdata('level') !="")
  		{
    		echo "<script>alert('Anda Belum Keluar Dari Halaman Administrator.');
				history.go(-1);
				</script>";
   		}
 	}

	function index()
	{
		$this->load->view('login');	
		
	}

	/*
	* important !!
	* Kurung kurawal dibawah adalah penutup class Adminweb
	* Location: application/controller/Adminweb.php
	*/
}

