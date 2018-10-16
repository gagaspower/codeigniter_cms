<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_model extends CI_Model {

	// fungsi menampilkan data 
	public function berita()
	{
		$this->db->select('berita.*,users.nama_users');
		$this->db->from('berita','users');
		$this->db->join('users','users.username=berita.username','inner');
		$this->db->order_by('id_berita','desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	

	public function hitungberita(){
		return $this->db->query("SELECT * FROM berita");
	}
	
	public function detailblog($id){
		return $this->db->query("select * from berita a inner join users b on b.username=a.username where a.id_berita='".$this->db->escape_str($id)."' or a.judul_seo='".$this->db->escape_str($id)."'");
	}

	public function updatebaca($id){
		return $this->db->query("UPDATE berita SET dibaca=dibaca+1 WHERE id_berita='".$this->db->escape_str($id)."' or judul_seo='".$this->db->escape_str($id)."'");
	}

	public function detailhalaman($id){
		return $this->db->query("select * from halamanstatis where id_halaman='".$this->db->escape_str($id)."' or judul_seo='".$this->db->escape_str($id)."'");
	}

	public function ambilmenu(){
        return $this->db->query("SELECT * FROM mainmenu where aktif='Y'");
    }

    
    public function kunjungan(){
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
        return $this->db->query("SELECT count(*) as jumlah, tanggal FROM statistik GROUP BY tanggal ORDER BY tanggal DESC LIMIT 10");
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

    function pengunjungonline(){
        $bataswaktu       = time() - 300;
        return $this->db->query("SELECT * FROM statistik WHERE online > '$bataswaktu'");
    }

    function beritapopuler(){
        return $this->db->query("SELECT * FROM berita ORDER BY dibaca DESC LIMIT 0,5");
    }

    function kategoriartikel(){
        return $this->db->query("SELECT * FROM kategori");
    }

    function hitungberitakategori($kat){
        return $this->db->query("SELECT * FROM berita where id_kategori='".$this->db->escape_str($kat)."'");
    }

    function detail_kategori($id,$dari,$sampai){
        return $this->db->query("SELECT * FROM berita,kategori where kategori.id_kategori=berita.id_kategori AND berita.id_kategori='".$this->db->escape_str($id)."' ORDER BY id_berita DESC LIMIT $dari,$sampai");
    }

    function search($kata){
        $katacari = $this->db->escape_str($kata);
        $pisah_kata = explode(" ",$kata);
        $jml_katakan = (integer)count($pisah_kata);
        $jml_kata = $jml_katakan-1;

        $cari = "SELECT * FROM berita WHERE " ;
            for ($i=0; $i<=$jml_kata; $i++){
              $cari .= "judul OR isi_berita LIKE '%$pisah_kata[$i]%'";
              if ($i < $jml_kata ){
                $cari .= " OR ";
              }
            }
        $cari .= " ORDER BY id_berita DESC LIMIT 0,10";
        return $this->db->query($cari);
    }

    function simpandata($table,$data){
        return $this->db->insert($table,$data);
    }

    function komentar_berita($id_berita){
        return $this->db->query("SELECT * FROM komentar where id_berita = '$id_berita' AND publish='Y' ORDER BY id_komentar ASC");
    }
    

    

}
