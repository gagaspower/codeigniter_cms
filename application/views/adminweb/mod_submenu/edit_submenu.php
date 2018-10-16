
						<div class="page-header">
							<h1>
								Edit Submenu
							</h1>
						</div><!-- /.page-header -->

								<form class="form-horizontal" role="form" action="<?php echo base_url();?>admin/aksi_editsubmenu" method="POST">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
									<div class="form-group">
										<input type="hidden" name="id_sub" value="<?php echo $id_sub;?>">
										<label class="col-sm-3 control-label no-padding-right" for="nama submenu"> Nama Submenu </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="nama_sub" class="col-xs-10 col-sm-5" value="<?php echo $nama_sub;?>" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="link sub"> link Submenu </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="link_sub" class="col-xs-10 col-sm-5" value="<?php echo $link_sub;?>" />
										</div>
									</div>


									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="Menuutama"> Menu Utama </label>

										<div class="col-sm-2">
										
											<select class="chosen-select" id="form-field-select-3" data-placeholder="Pilih Menuutama" name="id_main">
													<option value="0">--pilih--</option>
													<?php 
														foreach($utama as $m){
														if($m['id_main'] == $id_main){
														?>
			                                            <option value="<?php echo $m['id_main'];?>" selected><?php echo $m['nama_menu'] ?></option>
													<?php } else { ?>
														<option  value="<?php echo $m['id_main'];?>"><?php echo $m['nama_menu'] ?></option>
													<?php } } ?>
											</select>
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Update" id="bootbox-confirm">
											&nbsp; &nbsp; &nbsp;
											<a href="<?php echo base_url();?>admin/submenu"><button class="btn" type="button">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Kembali
											</button></a>
										</div>
									</div>

									<div class="hr hr-24"></div>

								</form>