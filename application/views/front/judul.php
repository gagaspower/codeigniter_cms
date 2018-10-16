<?php
if ($this->uri->segment(1)=='blog' AND $this->uri->segment(2)=='detail'){
	$row1 = $this->db->query("SELECT judul FROM berita where judul_seo='".$this->uri->segment(3)."'")->row_array();
	echo "$row1[judul]";
}else{
	$row1 = $this->db->query("SELECT nama_website FROM identitas")->row_array();
	echo "$row1[nama_website]";
}