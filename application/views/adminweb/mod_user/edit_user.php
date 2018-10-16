
						<div class="page-header">
							<h1>
								Tambah Pengguna Baru
							</h1>
						</div><!-- /.page-header -->
								<form class="form-horizontal" role="form" action="<?php echo base_url();?>admin/aksi_edituser" method="POST">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
								<input type="hidden" name="id_users" value="<?php echo $id_users;?>">
									<div class="form-group">
										<label class="col-xs-2" for="nama user"> Nama Pengguna </label>

										<div class="col-sm-10">
											<input type="text"  name="nama_users" class="col-xs-10 col-sm-10" value="<?php echo $nama_users;?>"/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="email"> Email Pengguna </label>

										<div class="col-sm-10">
											<input type="text"  name="email" class="col-xs-10 col-sm-10" value="<?php echo $email;?>"/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="level"> Level Pengguna </label>
										<div class="radio">
										<?php if($level == "admin"){ ?>
										<label><input name="level" type="radio" class="ace input-lg" value="admin" checked /><span class="lbl bigger-120"> Administrator</span></label>
										<label><input name="level" type="radio" class="ace input-lg" value="user" /><span class="lbl bigger-120"> User</span><label>
										<?php } else { ?>
										<label><input name="level" type="radio" class="ace input-lg" value="admin" /><span class="lbl bigger-120"> Administrator</span></label>
										<label><input name="level" type="radio" class="ace input-lg" value="user" checked /><span class="lbl bigger-120"> User</span><label>
										<?php } ?>
										</div>
										
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="blokir"> Blokir Pengguna </label>
										<div class="radio">
										<?php if($blokir == "Y"){ ?>
										<label><input name="blokir" type="radio" class="ace input-lg" value="Y" checked /><span class="lbl bigger-120"> Blokir</span></label>
										<label><input name="blokir" type="radio" class="ace input-lg" value="N" /><span class="lbl bigger-120"> Tidak</span><label>
										<?php } else { ?>
										<label><input name="blokir" type="radio" class="ace input-lg" value="Y" /><span class="lbl bigger-120">Blokir</span></label>
										<label><input name="blokir" type="radio" class="ace input-lg" value="N" checked /><span class="lbl bigger-120"> Tidak</span><label>
										<?php } ?>
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Update" id="bootbox-confirm">
											&nbsp; &nbsp; &nbsp;
											<a href="<?php echo base_url();?>admin/user"><button class="btn" type="button">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Kembali
											</button></a>
										</div>
									</div>

									<div class="hr hr-24"></div>

								</form>
