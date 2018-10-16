
						<div class="page-header">
							<h1>
								Pengaturan Identitas Website
							</h1>
						</div><!-- /.page-header -->
						<?php echo $this->session->flashdata('k');?>
						<?php foreach($seting->result_array() as $r); ?>
						<form class="form-horizontal" role="form" action="<?php echo base_url();?>admin/aksi_editpengaturan" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
								<input type="hidden" name="id_identitas" value="<?php echo $r['id_identitas'];?>">
									<div class="form-group">
										<label class="col-xs-2" for="nama website"> Nama Website </label>

										<div class="col-sm-10">
											<input type="text"  name="nama_website" class="col-xs-10 col-sm-10" value="<?php echo $r['nama_website'];?>"/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="alamat_website"> Alamat URL Website </label>

										<div class="col-sm-10">
											<input type="text"  name="alamat_website" class="col-xs-10 col-sm-10" value="<?php echo $r['alamat_website'];?>"/>
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="deskripsi"> Deskripsi Website </label>

										<div class="col-sm-10">
											<textarea name="meta_deskripsi" class="col-xs-10 col-sm-12"><?php echo $r['meta_deskripsi'];?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-xs-2" for="deskripsi"> Kata kunci Website </label>

										<div class="col-sm-10">
											<textarea name="meta_keyword" class="col-xs-10 col-sm-12"><?php echo $r['meta_keyword'];?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="form-field-1"> Logo Lama </label>
											<div class="col-sm-4">
												<?php
												if($r['logo'] != ""){
													echo "<img src='".base_url()."public/upload/logo_kecil/".$r['logo']."'>";
												}else{
													echo "<img src='".base_url()."public/upload/no_image.jpg'>";
												}
												?>
											</div>
									</div>									

									<div class="form-group">
										<label class="col-xs-2" for="form-field-1"> Upload Logo </label>
											<div class="col-sm-4">
												<input multiple="" type="file" id="id-input-file-3" name="fupload" />
											</div>
									</div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Update" id="bootbox-confirm">
										</div>
									</div>

									<div class="hr hr-24"></div>

								</form>
