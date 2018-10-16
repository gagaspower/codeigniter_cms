<?php foreach($news as $r){ 
$tanggal = tgl_indo($r['tanggal']);
$isi_berita = htmlspecialchars_decode($r['isi_berita']); 
$isi = substr($isi_berita,0,200); 
$isi = substr($isi_berita,0,strrpos($isi," ")); 
$konten = html_entity_decode(strip_tags($isi));
if($r['gambar'] != NULL){
?>
<p><img class="img-responsive" src="<?php echo base_url();?>public/upload/gambar_artikel/medium/<?php echo $r['gambar'];?>" alt="<?php echo $r['judul'];?>"></p>
<?php } ?>
	<a href="<?php echo base_url();?>blog/detail/<?php echo $r['judul_seo'];?>"><h3 class="ctitle"><?php echo $r['judul'];?></h3></a>
		<p><csmall>By: <?php echo $r['nama_users'];?></csmall> | <csmall2>Tanggal: <?php echo $tanggal;?></csmall2></p>
		 	<p><?php echo $konten;?></p>
		 			<p><a href="<?php echo base_url();?>blog/detail/<?php echo $r['judul_seo'];?>">[Read More]</a></p>
		 		<div class="hline"></div>
<?php } ?>
<div class="spacing"></div>
		 		
		 	