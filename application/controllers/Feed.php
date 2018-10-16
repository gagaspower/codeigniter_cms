<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Feed extends CI_Controller{

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('xml','text'));
		$this->load->model('rss_model');
    }
	
	public function index()
    {
        $data['feed_name'] = 'ruangpojok.net';
        $data['encoding'] = 'utf-8';
        $data['feed_url'] = 'https://ruangpojok.net/rss.xml';
        $data['page_description'] = 'Kumpulan Tutorial Website';
        $data['page_language'] = 'en-en';
        $data['creator_email'] = 'gagas@ruangpojok.net';
        $data['posts'] = $this->rss_model->getPosts(10);    
        header("Content-Type: application/rss+xml");
         
        $this->load->view('front/rss',$data);
    }
}

