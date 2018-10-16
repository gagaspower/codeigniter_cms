
						<div class="page-header">
							<h1>
								Buat Artikel Baru
							</h1>
						</div><!-- /.page-header -->
								<form class="form-horizontal" role="form" action="<?php echo base_url();?>user/simpanartikel" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
									<div class="form-group">
										<label class="col-xs-2" for="judul"> Judul Artikel </label>

										<div class="col-sm-10">
											<input type="text"  name="judul" class="col-xs-10 col-sm-10" required="required"/>
										</div>
									</div>
									<div class="form-group">
										<label class="col-xs-2" for="kategori"> Kategori Artikel </label>

										<div class="col-sm-2">
										
											<select class="chosen-select" id="form-field-select-3" data-placeholder="Pilih Kategori" name="id_kategori" required="required">
													<option value="0">--pilih--</option>
													<?php
													foreach($categories as $cat){
													?>
													<option value="<?php echo $cat['id_kategori'];?>"><?php echo $cat['nama_kategori'];?></option>
													<?php 
													}
													?>
											</select>
										
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2" for="isi"> Isi Artikel </label>

										<div class="col-sm-10">
											<textarea name="isi_berita" id="loko" class="col-xs-10 col-sm-12"></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="tagcloud"> Tag Cloud </label>

										<div class="col-sm-9">
										
											<select multiple="multiple" class="chosen-select form-control" id="form-field-select-4" data-placeholder="Tag Cloud..." name="tag_seo[]">
													<option value="0">--pilih--</option>
													<?php
													foreach($tagnews as $tagged){
													?>
													<option value="<?php echo $tagged['tag_seo'] ?>"><?php echo $tagged['nama_tag'];?></option>
													<?php 
													}
													?>
											</select>
										
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="gambar"> Gambar Thumbnail </label>
											<div class="col-sm-4">
												<input multiple="" type="file" id="id-input-file-3" name="fupload" />
											</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Simpan" id="bootbox-confirm">
											&nbsp; &nbsp; &nbsp;
											<a href="<?php echo base_url();?>user/artikel"><button class="btn" type="button">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Kembali
											</button></a>
										</div>
									</div>

									<div class="hr hr-24"></div>

								</form>
