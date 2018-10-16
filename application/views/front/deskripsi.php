<?php
if ($this->uri->segment(1)=='blog' AND $this->uri->segment(2)=='detail'){
	$row = $this->db->query("SELECT isi_berita FROM berita where judul_seo='".$this->uri->segment(3)."'")->row_array();
    $isi_berita = htmlspecialchars_decode($row['isi_berita']); // membuat paragraf pada isi berita dan mengabaikan tag html
    $isi = substr($isi_berita,0,150); // ambil sebanyak 220 karakter
    $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat
    $konten = html_entity_decode(strip_tags($isi));
	echo "$konten";
}else{
	$row = $this->db->query("SELECT meta_deskripsi FROM identitas")->row_array();
	echo "$row[meta_deskripsi]";
}