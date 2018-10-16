
						<div class="page-header">
							<h1>
								Edit Halaman Statis
							</h1>
						</div><!-- /.page-header -->
								<form class="form-horizontal" role="form" action="<?php echo base_url();?>admin/aksi_edithalaman" method="POST">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
									<div class="form-group">
										<label class="col-xs-2" for="form-field-1"> Judul Halaman </label>
										<input type="hidden" name="id_halaman" value="<?php echo $id_halaman;?>">
										<div class="col-sm-10">
											<input type="text"  name="judul" class="col-xs-10 col-sm-10" value="<?php echo $judul;?>" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2" for="form-field-1"> Isi Halaman </label>

										<div class="col-sm-10">
											<textarea name="isi_halaman" id="loko" class="col-xs-10 col-sm-12"><?php echo $isi_halaman;?></textarea>
										
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Update" id="bootbox-confirm">
											&nbsp; &nbsp; &nbsp;
											<a href="<?php echo base_url();?>admin/halaman"><button class="btn" type="button">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Kembali
											</button></a>
										</div>
									</div>

									<div class="hr hr-24"></div>

								</form>
