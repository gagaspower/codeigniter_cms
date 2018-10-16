<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_notfound extends CI_Controller {
   
	public function index()
	{
		$this->output->set_status_header('404');
		$this->template->load('front/media','front/notfound');
	}

       
}
