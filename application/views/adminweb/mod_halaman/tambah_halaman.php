
						<div class="page-header">
							<h1>
								Buat Halaman Statis
							</h1>
						</div><!-- /.page-header -->
								<form class="form-horizontal" role="form" action="<?php echo base_url();?>admin/simpanhalaman" method="POST">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
									<div class="form-group">
										<label class="col-xs-2" for="judul"> Judul Halaman </label>

										<div class="col-sm-10">
											<input type="text"  name="judul" class="col-xs-10 col-sm-10" required="required"/>
										</div>
									</div>


									<div class="form-group">
										<label class="col-sm-2" for="isi"> Isi Halaman </label>

										<div class="col-sm-10">
											<textarea name="isi_halaman" id="loko" class="col-xs-10 col-sm-12"></textarea>
										
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Simpan" id="bootbox-confirm">
											&nbsp; &nbsp; &nbsp;
											<a href="<?php echo base_url();?>admin/halaman"><button class="btn" type="button">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Kembali
											</button></a>
										</div>
									</div>

									<div class="hr hr-24"></div>

								</form>
