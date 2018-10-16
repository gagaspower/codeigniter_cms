<?php
$jam=date("H:i:s");
$tgl=tgl_indo(date("Y m d")); 	
  echo "<br /><p align=center>Hai <b>".$this->session->userdata('nama_users')."</b>, selamat datang di halaman admin. 
          Silahkan klik menu pilihan yang berada di bagian sidebar untuk mengelola content website. <br /> <b>".hari_ini().", $tgl, <span id='jam'></span></b> WIB</p><br />";
?>