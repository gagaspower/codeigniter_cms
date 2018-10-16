
						<div class="page-header">
							<h1>
								Ganti Password Saya
							</h1>
						</div><!-- /.page-header -->
						<br>
						<?php echo $this->session->flashdata("k");?>
						<br>
						<?php foreach($uid->result_array() as $r); ?>
								<form class="form-horizontal" role="form" action="<?php echo base_url();?>user/aksi_gantipaswod" method="POST">
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
								<input type="hidden" name="id_users" value="<?php echo $r['id_users'];?>">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="username">Username</label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1"  name="username" class="col-xs-10 col-sm-5" readonly=""
											 value="<?php echo $r['username'];?>" />
										</div>
									</div>
									<div class="form-group">

										<label class="col-sm-3 control-label no-padding-right" for="password"> Password Baru </label>

										<div class="col-sm-9">
											<input type="password" id="form-field-1"  name="password" class="col-xs-10 col-sm-5" required="required"/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="pass_conf">Ulangi Password </label>

										<div class="col-sm-9">
											<input type="password" id="form-field-1"  name="pass_conf" class="col-xs-10 col-sm-5" required="required"/>
										</div>
									</div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Update" id="bootbox-confirm">
											
										</div>
									</div>

									<div class="hr hr-24"></div>
								</form>
