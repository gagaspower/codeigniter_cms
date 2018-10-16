<?php 
foreach($record->result_array() as $r);
$tanggal = tgl_indo($r['tanggal']);
$isi_berita = htmlspecialchars_decode($r['isi_berita']);
?>	 		
<a href="#"><h3 class="ctitle"><?php echo $r['judul'];?></h3></a>
<p><csmall>Posted: <?php echo $tanggal;?></csmall> | <csmall2>By: <?php echo $r['nama_users'];?></csmall2></p>
<p><?php echo $isi_berita;?></p>
<div class="spacing"></div>
<div class="hline"></div>
<div class="spacing"></div>

<!-- LIST KOMENTAR-->
<?php
$total_komentar = $this->blog_model->komentar_berita($r['id_berita'])->num_rows();
?>
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h2 class="page-header"><?php echo $total_komentar;?> Komentar</h2>
        <section class="comment-list">
          <!-- First Comment -->
          <?php if ($total_komentar > 0 ){
              $komentar = $this->blog_model->komentar_berita($r['id_berita']);
                foreach ($komentar->result_array() as $rows) {
                $isi_komen = htmlspecialchars_decode($rows['isi_komentar']);
                $isian=nl2br($isi_komen); 
                $tglkomen = tgl_indo($rows['tgl_komentar']);
           ?>
          <article class="row">
            <div class="col-md-2 col-sm-2 hidden-xs">
              <figure class="thumbnail">
              <?php if($rows['moderator'] != NULL){?>
                  <img class="img-responsive" src="<?php echo base_url();?>public/gravatar/unnamed.png" />
                  <figcaption class="text-center"><?php echo $rows['moderator'];?></figcaption>
              <?php }else{ ?>
              <img class="img-responsive" src="<?php echo base_url();?>public/gravatar/avatar.jpg" />
              <?php } ?>
                </figure>
              
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow left">
                <div class="panel-body">
                  <header class="text-left">
                  <?php 
                  if($rows['moderator'] == NULL){
                  ?>
                    <div class="comment-user"><i class="fa fa-user"></i> <b><?php echo $rows['nama'];?></b></div>
                  <?php }else{ ?>
                    <div class="comment-user"><i class="fa fa-user"></i> <b><?php echo $rows['nama'];?> [<?php echo $rows['moderator'];?>]</b></div>
                  <?php } ?>
                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo $tglkomen;?></time>
                 
                  </header>
                  <div class="comment-post">
                    <p><?php echo $isian;?></p>
                  </div>
                </div>
              </div>
            </div>
          </article>

          <?php } } ?> 
        </section>
    </div>
  </div>
</div>
<!-- LIST KOMENTAR SELESAI-->

<h4>Tinggalkan Komentar</h4>
<style type="text/css">
.error {
color:red;
font-size:13px;
margin-bottom:-15px
}
</style>

<form role="form" action="<?php echo base_url();?>blog/kirimkomentar" method="POST">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" 
style="display: none;">
<input type="hidden" name="id_berita" value="<?php echo $r['id_berita'];?>">
	<div class="form-group">
<label for="Nama">Nama</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="nama" id="nama" required="required">
    <?php echo form_error('nama');?>
  </div>
	<div class="form-group">
<label for="Email">Email</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="email" id="email" required="required">
    <?php echo form_error('email');?>
  </div>
  <div class="form-group">
  	<label for="Isi Komentar">Komentar</label>
  	<textarea class="form-control"  rows="3" name="isi_komentar" id="isi_komentar" required="required"></textarea>
  	 <?php echo form_error('isi_komentar');?>
  </div>
    <div class="form-group">
        <?php echo $captcha; ?>
    </div>
        <div class="form-group">
            <label for="captcha">Verifikasi</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="secutity_code" id="secutity_code" required="required">
    </div>
<button type="submit" class="btn btn-theme">Submit</button>
</form>
<p>&raquo; Komentar Akan Di Publikasikan Jika Disetujui Administrator.</p>
<p>&raquo; Notifikasi Balasan Juga akan terkirim Ke email anda. Mohon masukan email yang valid dan aktif</p>
