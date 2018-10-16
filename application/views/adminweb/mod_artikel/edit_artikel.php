
						<div class="page-header">
							<h1>
								Edit Artikel
							</h1>
						</div><!-- /.page-header -->

					<form class="form-horizontal" role="form" action="<?php echo base_url();?>admin/aksi_editartikel" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none;">
									<div class="form-group">
										<label class="col-xs-2" for="judul"> Judul Artikel </label>
										<input type="hidden" name="id_berita" value="<?php echo $id_berita;?>">
										<div class="col-sm-10">
											<input type="text"  name="judul" class="col-xs-10 col-sm-10" value="<?php echo $judul;?>">
										</div>
									</div>
									<div class="form-group">
										<label class="col-xs-2" for="form-field-1"> Kategori Artikel </label>

										<div class="col-sm-2">
										
											<select class="chosen-select" id="form-field-select-3" data-placeholder="Pilih Kategori" name="id_kategori">
													<option value="0">--pilih--</option>
													<?php 
														foreach($kategori as $k){
														if($k['id_kategori'] == $id_kategori){
														?>
			                                            <option value="<?php echo $k['id_kategori'];?>" selected><?php echo $k['nama_kategori'] ?></option>
													<?php } else { ?>
														<option  value="<?php echo $k['id_kategori'];?>"><?php echo $k['nama_kategori'] ?></option>
													<?php } } ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2" for="form-field-1"> Isi Artikel </label>

										<div class="col-sm-10">
											<textarea name="isi_berita" id="loko" class="col-xs-10 col-sm-12"><?php echo $isi_berita;?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="form-field-1"> Tag Cloud </label>

										<div class="col-sm-9">
										
											<select multiple="multiple" class="chosen-select form-control" id="form-field-select-4" data-placeholder="Tag Cloud..." name="tag_seo[]">
										    <?php 
											$cats = explode(',', $tag);
											foreach($cats as $vald) {
											foreach($katakunci as $key=>$keywords) { ?>                    
											<option value="<?php echo $keywords->tag_seo; ?>" <?=($vald == $keywords->tag_seo ? 'selected' : '')?>>
											<?php echo $keywords->nama_tag; ?></option> 
											<?php   
													}
												}
											?>
											</select>
										
										</div>
									</div>

									<div class="form-group">
										<label class="col-xs-2" for="form-field-1"> Gambar Lama </label>
											<div class="col-sm-4">
												<?php
												if($gambar != NULL){
													echo "<img src='".base_url()."public/upload/gambar_artikel/thumb/".$gambar."'>";
												}else{
													echo "<img src='".base_url()."public/upload/no_image.jpg'>";
												}
												?>
											</div>
									</div>
									<div class="form-group">
										<label class="col-xs-2" for="form-field-1"> Ganti Gambar </label>
											<div class="col-sm-4">
												<input multiple="" type="file" id="id-input-file-3" name="fupload" />
											</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<input class="btn btn-info" type="submit" class="ace-icon fa fa-check bigger-110" value="Update" id="bootbox-confirm">
											&nbsp; &nbsp; &nbsp;
											<a href="<?php echo base_url();?>admin/artikel"><button class="btn" type="button">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Kembali
											</button></a>
										</div>
									</div>

									<div class="hr hr-24"></div>

								</form>
