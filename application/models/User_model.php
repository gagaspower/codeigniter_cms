<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


	// fungsi untuk menyimpan data
		function simpandata($table,$data){
		return $this->db->insert($table,$data);
	}

	// fungsi mengambil data berdasarkan kondisi
		 function Get_data_byid($table,$where = '') {
		return $this->db->query("SELECT * from $table $where;");	
	}
	//fungsi untuk update data
		function updateData($table,$data,$id){
		return $this->db->update($table,$data,$id);
	}

	// fungsi untuk menghapus data
		function hapusData($table,$where){
		return $this->db->delete($table,$where);
	}

	// fungsi menampilkan tag artikel
	function tag(){

		$this->db->select('*')->from('tag');
		$this->db->order_by('id_tag','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	// fungsi menampilkan data berita untuk admin
	function beritauser(){

		$this->db->select('*');    
		$this->db->from('berita');
		$this->db->join('users', 'users.username = berita.username');
		$this->db->order_by('id_berita','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	function katakunci(){
    $this->db->select('*')->from('tag');
    $query=$this->db->get();
    return $keyword = $query->result();
	}

	function datakategori()
	{
		$this->db->select('*')->from('kategori');
		$this->db->order_by('id_kategori','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function ambilGambar($where =''){
		return $this->db->query("select gambar from berita $where;");
	}

	function ambilfoto($where =''){
		return $this->db->query("select gravatar from users $where;");
	}

	function ambilakun($where=''){
		return $this->db->query("SELECT * from users $where;");
	}

	function updatePassword($table,$data,$username){
		return $this->db->update($table,$data,$username);
	}

	
    function datakomentar(){
    	return $this->db->query("SELECT * FROM komentar,berita WHERE berita.id_berita=komentar.id_berita ORDER BY komentar.id_komentar DESC");
    }

    function editkomen($id){
    	return $this->db->query("SELECT * from komentar,berita WHERE berita.id_berita=komentar.id_berita AND komentar.id_komentar ='".$this->db->escape_str($id)."'");
    }
    function komenaprove($id){
    	return $this->db->query("UPDATE komentar SET publish='Y' WHERE id_komentar='".$this->db->escape_str($id)."'");
    }

    function komenunaprove($id){
    	return $this->db->query("UPDATE komentar SET publish='N' WHERE id_komentar='".$this->db->escape_str($id)."'");
    }

    function hitungkomen(){
    	return $this->db->query("SELECT * FROM komentar WHERE publish='N'");
    }



   

}
