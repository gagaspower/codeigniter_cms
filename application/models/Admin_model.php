<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	// fungsi menampilkan data 
	function datakategori()
	{
		$this->db->select('*')->from('kategori');
		$this->db->order_by('id_kategori','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

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
	function beritaadmin(){

		$this->db->select('*')->from('berita');
		$this->db->order_by('id_berita','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function katakunci(){
    $this->db->select('*')->from('tag');
    $query=$this->db->get();
    return $keyword = $query->result();
	}
	
	function ambilGambar($where =''){
		return $this->db->query("select gambar from berita $where;");
	}

	function Menuutama(){
		$this->db->select('*')->from('mainmenu');
		$this->db->order_by('id_main','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	function halamanstatis(){
		$this->db->select('*')->from('halamanstatis');
		$this->db->order_by('id_halaman','desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	function dataadmin(){
		$this->db->select('*')->from('users');
		$this->db->order_by('id_users','desc');
		$query = $this->db->get();
		return $query->result_array();
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

	function ambilidentitas(){
		return $this->db->query("SELECT * FROM identitas");
	}

	function ambilLogo($where=''){
		return $this->db->query("select logo from identitas $where;");
	}

	 function kunjungan(){
        $ip      = $_SERVER['REMOTE_ADDR'];
        $tanggal = date("Y-m-d");
        $waktu   = time(); 
        $cekk = $this->db->query("SELECT * FROM statistik WHERE ip='$ip' AND tanggal='$tanggal'");
        $rowh = $cekk->row_array();
        if($cekk->num_rows() == 0){
            $datadb = array('ip'=>$ip, 'tanggal'=>$tanggal, 'hits'=>'1', 'online'=>$waktu);
            $this->db->insert('statistik',$datadb);
        }else{
            $hitss = $rowh['hits'] + 1;
            $datadb = array('ip'=>$ip, 'tanggal'=>$tanggal, 'hits'=>$hitss, 'online'=>$waktu);
            $array = array('ip' => $ip, 'tanggal' => $tanggal);
            $this->db->where($array);
            $this->db->update('statistik',$datadb);
        }
    }

    function grafik_kunjungan(){
        return $this->db->query("SELECT count(*) as jumlah, tanggal FROM statistik GROUP BY tanggal ORDER BY tanggal ASC LIMIT 10");
    }

    function pengunjung(){
        return $this->db->query("SELECT * FROM statistik WHERE tanggal='".date("Y-m-d")."' GROUP BY ip");
    }

    function totalpengunjung(){
        return $this->db->query("SELECT COUNT(hits) as total FROM statistik");
    }

    function hits(){
        return $this->db->query("SELECT SUM(hits) as total FROM statistik WHERE tanggal='".date("Y-m-d")."' GROUP BY tanggal");
    }

    function totalhits(){
        return $this->db->query("SELECT SUM(hits) as total FROM statistik");
    }

    function datahubungi(){
    	return $this->db->query("SELECT * FROM hubungi ORDER BY id_hubungi DESC");
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

    function updatemailstatus($id){
    	return $this->db->query("update hubungi set dibaca='Sudah' WHERE id_hubungi='".$id."'");
    }

    function hitungpesan(){
    	return $this->db->query("SELECT * FROM hubungi WHERE dibaca='Belum'");
    }


    function menusub(){
    	$this->db->select('*');    
		$this->db->from('submenu');
		$this->db->join('mainmenu', 'mainmenu.id_main = submenu.id_main');
		$query = $this->db->get();
		return $query->result_array();
    }

    function mainmenuaktif(){
    	return $this->db->query("SELECT * FROM mainmenu WHERE aktif='Y'");
    }

}
