<?php 
foreach($page->result_array() as $r);
$isi = htmlspecialchars_decode($r['isi_halaman']);
?>
<a href="#"><h3 class="ctitle"><?php echo $r['judul'];?></h3></a>
<p><?php echo $isi;?></p>
<div class="spacing"></div>
<div class="hline"></div>
