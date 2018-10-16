<style type="text/css">
.error {
color:red;
font-size:13px;
margin-bottom:-15px
}
</style>
<h4>Hubungi Saya Disini</h4>
<div class="hline"></div>
<p>Jika anda pertanyaan dan request source code anda bisa menghubungi saya melalui form dibawah ini. Saya akan segera membalas pesan anda.<br>Terima kasih.</p>
<br>
<?php echo $this->session->flashdata("h");?><br>
<form role="form" method="POST" action="<?php echo base_url();?>kirim_hubungi/">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" 
		 				style="display: none;">
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
    <label for="Subjek">Subjek</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="subjek"  id="subjek">
     <?php echo form_error('subjek');?>
  </div>
  <div class="form-group">
  	<label for="Pesan">Pesan</label>
  	<textarea class="form-control" id="message1" rows="3" name="pesan" id="pesan" required="required"></textarea>
  	 <?php echo form_error('pesan');?>
  </div>
   <div class="form-group">
        <?php echo $captcha; ?>
    </div>
        <div class="form-group">
            <label for="captcha">Verifikasi</label>
        <input type="text" class="form-control" id="exampleInputEmail1" name="secutity_code" id="secutity_code" required="required">
    </div>
  <button type="submit" class="btn btn-theme">Kirim Pesan</button>
</form>