
						<div class="page-header">
							<h1>
								Tambah Pengguna Baru
							</h1>
						</div><!-- /.page-header -->
								<form class="form-horizontal" role="form" action="<?php echo base_url();?>admin/simpanuser" method="POST">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
									<div class="form-group">
										<label class="col-xs-2" for="nama user"> Nama Pengguna </label>

										<div class="col-sm-10">
											<input type="text"  name="nama_users" class="col-xs-10 col-sm-10" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="email"> Email Pengguna </label>

										<div class="col-sm-10">
											<input type="text"  name="email" class="col-xs-10 col-sm-10" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="level"> Level Pengguna </label>
										<div class="radio">
											<label><input name="level" type="radio" class="ace input-lg" value="admin" checked /><span class="lbl bigger-120"> Administrator</span></label>
											<label><input name="level" type="radio" class="ace input-lg" value="user" /><span class="lbl bigger-120"> User</span><label>
										</div>
										
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="blokir"> Blokir Pengguna </label>
										<div class="radio">
											<label><input name="blokir" type="radio" class="ace input-lg" value="Y"  /><span class="lbl bigger-120"> Blokir</span></label>
											<label><input name="blokir" type="radio" class="ace input-lg" value="N" checked/><span class="lbl bigger-120"> Tidak</span><label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="username"> Username </label>

										<div class="col-sm-10">
											<input type="text"  name="username" class="col-xs-10 col-sm-10" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="password"> Password</label>

										<div class="col-sm-10">
											<input type="password"  name="password" class="col-xs-10 col-sm-10" />
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Simpan" id="bootbox-confirm">
											&nbsp; &nbsp; &nbsp;
											<a href="<?php echo base_url();?>admin/user"><button class="btn" type="button">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Kembali
											</button></a>
										</div>
									</div>

									<div class="hr hr-24"></div>

								</form>
