<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rss_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	// get all postings
    function getPosts($limit = NULL)
    {
        return $this->db->get('berita',$limit);
    }
	
}