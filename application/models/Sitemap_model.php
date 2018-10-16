<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sitemap_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
  
    function create() {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->order_by('id_berita',"ASC");
        $query = $this->db->get();
        return $query->result();
    }
}