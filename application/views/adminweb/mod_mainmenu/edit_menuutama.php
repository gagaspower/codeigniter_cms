
						<div class="page-header">
							<h1>
								Edit Menuutama
							</h1>
						</div><!-- /.page-header -->

								<form class="form-horizontal" role="form" action="<?php echo base_url();?>admin/aksi_editmenu" method="POST">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
									<div class="form-group">
										<input type="hidden" name="id_main" value="<?php echo $id_main;?>">
										<label class="col-sm-3 control-label no-padding-right" for="nama menu"> Nama Menu </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="nama_menu" class="col-xs-10 col-sm-5" value="<?php echo $nama_menu;?>" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="link"> link </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="link" class="col-xs-10 col-sm-5" value="<?php echo $link;?>" />
										</div>
									</div>


									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Aktif </label>

										<div class="col-sm-9">
										<div class="radio">
										<?php if($aktif == "Y"){ ?>
											<label><input name="aktif" type="radio" class="ace input-lg" value="Y" checked /><span class="lbl bigger-120"> Y</span></label>
											<label><input name="aktif" type="radio" class="ace input-lg" value="N" /><span class="lbl bigger-120"> N</span><label>
										<?php } else { ?>
											<label><input name="aktif" type="radio" class="ace input-lg" value="Y" /><span class="lbl bigger-120"> Y</span></label>
											<label><input name="aktif" type="radio" class="ace input-lg" value="N" checked /><span class="lbl bigger-120"> N</span><label>
										<?php } ?>

										</div>
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Update" id="bootbox-confirm">
											&nbsp; &nbsp; &nbsp;
											<a href="<?php echo base_url();?>admin/mainmenu"><button class="btn" type="button">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Kembali
											</button></a>
										</div>
									</div>

									<div class="hr hr-24"></div>

								</form>