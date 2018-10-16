
						<div class="page-header">
							<h1>
								Balas Komentar
							</h1>
						</div><!-- /.page-header -->
								<form class="form-horizontal" role="form" action="<?php echo base_url();?>user/userbalaskomen" method="POST">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
										<input type="hidden" name="id_berita" value="<?php echo $id_berita;?>">
										<input type="hidden" name="publish" value="Y">
										<input type="hidden" name="moderator" value="moderator">
										<input type="hidden" name="nama" value="<?php echo $nama;?>">
								<div class="form-group">
										<label class="col-xs-2" for="judul">Judul Artikel</label>

										<div class="col-sm-10">
											<input type="text"  name="judul" class="col-xs-10 col-sm-10" value="<?php echo $judul;?>" readonly="readonly" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-xs-2" for="email">Email</label>

										<div class="col-sm-10">
											<input type="text"  name="email" class="col-xs-10 col-sm-10" value="<?php echo $email;?>" readonly="readonly" />
										</div>
									</div>
								<div class="form-group">
										<label class="col-sm-2" for="form-field-1"> Komentar Pengirim</label>
																
										<div class="col-sm-10">
											<textarea name="isi" class="col-xs-10 col-sm-10" rows="10" readonly="readonly"><?php echo htmlspecialchars_decode($isi_komentar);?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2" for="form-field-1"> Komentar Balasan </label>
										
								
										<div class="col-sm-10">
											<textarea name="isi_komentar" class="col-xs-10 col-sm-10" rows="10"></textarea>
										</div>
									</div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Balas" id="bootbox-confirm">
											&nbsp; &nbsp; &nbsp;
											<a href="<?php echo base_url();?>user/komentar"><button class="btn" type="button">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Kembali
											</button></a>
										</div>
									</div>
									<div class="hr hr-24"></div>
								</form>
