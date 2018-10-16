
						<div class="page-header">
							<h1>
								Detail Pesan
							</h1>
						</div><!-- /.page-header -->
								<form class="form-horizontal" role="form" action="<?php echo base_url();?>admin/kirim_email" method="POST">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
								<input type="hidden" name="id_hubungi" value="<?php echo $id_hubungi;?>">
									<div class="form-group">
										<label class="col-xs-2" for="form-field-1"> Nama Pengirim </label>
										<div class="col-sm-10">
											<input type="text"  name="nama" class="col-xs-10 col-sm-10" value="<?php echo $nama;?>" readonly="readonly"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-xs-2" for="form-field-1"> email Pengirim </label>
										<div class="col-sm-10">
											<input type="text"  name="email" class="col-xs-10 col-sm-10" value="<?php echo $email;?>" readonly="readonly"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-xs-2" for="form-field-1"> Subjek </label>
										<div class="col-sm-10">
											<input type="text"  name="subjek" class="col-xs-10 col-sm-10" value="Re: <?php echo $subjek;?>" readonly="readonly"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2" for="form-field-1"> Pesan Pengirim </label>

										<div class="col-sm-10">
											<textarea name="isi" rows="10" class="col-xs-10 col-sm-10" readonly="readonly"><?php echo htmlspecialchars_decode($pesan);?></textarea>
										
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2" for="form-field-1"> Pesan Balasan</label>

										<div class="col-sm-10">
											<textarea name="pesan" rows="10" class="col-xs-10 col-sm-10"></textarea>
										
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Kirim Balasan" id="bootbox-confirm">
											&nbsp; &nbsp; &nbsp;
											<a href="<?php echo base_url();?>admin/hubungi"><button class="btn" type="button">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Kembali
											</button></a>
										</div>
									</div>

									<div class="hr hr-24"></div>

								</form>
