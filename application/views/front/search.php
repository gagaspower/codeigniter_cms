<?php 
if ($artikel->num_rows() == 0) { ?>
	<div class='alert alert-danger'>
	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
		Tidak Ditemukan artikel dengan <?php echo $title;?>
</div>
<?php }else{ ?>
<div class='alert alert-block alert-success'>
	<button type='button' class='close' data-dismiss='alert'><i class='ace-icon fa fa-times'></i></button>
		 <?php echo $title;?>
</div>
<?php
foreach($artikel->result_array() as $r){ 
$tanggal = tgl_indo($r['tanggal']);
$isi_berita = htmlspecialchars_decode($r['isi_berita']); 
$isi = substr($isi_berita,0,200); 
$isi = substr($isi_berita,0,strrpos($isi," ")); 
$konten = html_entity_decode(strip_tags($isi));
if($r['gambar'] != NULL){
?>
<div class='alert alert-danger'>
	<button type='button' class='close' data-dismiss='success'><i class='ace-icon fa fa-times'></i></button>
		Ditemukan artikel dengan kata kunci <?php echo $title;?>
</div>
<p><img class="img-responsive" src="<?php echo base_url();?>assets/upload/gambar_artikel/<?php echo $r['gambar'];?>" alt="<?php echo $r['judul'];?>"></p>
<?php } ?>
	<a href="<?php echo base_url();?>blog/detail/<?php echo $r['judul_seo'];?>"><h3 class="ctitle"><?php echo $r['judul'];?></h3></a>
		<p> <csmall2>Tanggal: <?php echo $tanggal;?></csmall2></p>
		 	<p><?php echo $konten;?></p>
		 			<p><a href="<?php echo base_url();?>blog/detail/<?php echo $r['judul_seo'];?>">[Read More]</a></p>
		 		<div class="hline"></div>
<?php } } ?>
<div class="spacing"></div>
		 		
		 	