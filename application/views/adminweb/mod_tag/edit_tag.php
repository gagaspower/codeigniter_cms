
						<div class="page-header">
							<h1>
								Edit Tag Cloud
							</h1>
						</div><!-- /.page-header -->

								<form class="form-horizontal" role="form" action="<?php echo base_url();?>admin/aksi_edittag" method="POST">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
									<div class="form-group">
										<input type="hidden" name="id_tag" value="<?php echo $id_tag;?>">
										<label class="col-sm-3 control-label no-padding-right" for="nama tag"> Nama Tag </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" placeholder="Nama Tag" name="nama_tag" class="col-xs-10 col-sm-5" value="<?php echo $nama_tag;?>" />
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Update" id="bootbox-confirm">
											&nbsp; &nbsp; &nbsp;
											<a href="<?php echo base_url();?>admin/tag"><button class="btn" type="button">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Kembali
											</button></a>
										</div>
									</div>

									<div class="hr hr-24"></div>

								</form>