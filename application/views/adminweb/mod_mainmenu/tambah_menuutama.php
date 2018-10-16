
						<div class="page-header">
							<h1>
								Tambah Menuutama
							</h1>
						</div><!-- /.page-header -->
								<form class="form-horizontal" role="form" action="<?php echo base_url();?>admin/simpanmenu" method="POST">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="nama menu"> Nama menu </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="nama_menu" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="link"> Link menu </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="link" class="col-xs-10 col-sm-5" \/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Aktif </label>

										<div class="col-sm-9">
										<div class="radio">
											<label><input name="aktif" type="radio" class="ace input-lg" value="Y" checked /><span class="lbl bigger-120"> Y</span></label>
											<label><input name="aktif" type="radio" class="ace input-lg" value="N" /><span class="lbl bigger-120"> N</span><label>
										</div>
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Simpan" id="bootbox-confirm">
											&nbsp; &nbsp; &nbsp;
											<a href="<?php echo base_url();?>admin/mainmenu"><button class="btn" type="button">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Kembali
											</button></a>
										</div>
									</div>

									<div class="hr hr-24"></div>

								</form>
