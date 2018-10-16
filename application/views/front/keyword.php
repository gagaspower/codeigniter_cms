<?php
if ($this->uri->segment(1)=='blog' AND $this->uri->segment(2)=='detail'){
	$row1 = $this->db->query("SELECT tag FROM berita where judul_seo='".$this->uri->segment(3)."'")->row_array();
	$tagcloud = $row1['tag'];
	$str = str_replace("-",' ', $tagcloud);
	echo "$str";
}else{
	$row1 = $this->db->query("SELECT meta_keyword FROM identitas")->row_array();
	echo "$row1[meta_keyword]";
}