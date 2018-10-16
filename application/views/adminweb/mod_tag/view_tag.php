										
						<div class="page-header">
							<h1>
								<center>Tag Cloud</center>
							</h1>
						</div><!-- /.page-header -->
											<a href="<?php echo base_url();?>admin/tambahtag">
											<button class="btn btn-xs btn-info">
												<i class="ace-icon fa fa-plus bigger-110"></i>
												Tambah
												<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
											</button></a><br/><br/>
												<?php echo $this->session->flashdata("t");?>
											<br/>
												<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" id="provinsi">
													<thead>
														<tr>
															<th>No.</th>
															<th>Nama Tag</th>
															<th>Tag SEO</th>
															<th>Aksi</th>
														</tr>
													</thead>

													<tbody>
														<?php 
														$no=1;
														foreach($tagcloud as $t){ 
															?>
														<tr>
															<td><?php echo $no;?></td>
															<td><?php echo $t['nama_tag'];?></td>
															<td><?php echo $t['tag_seo'];?></td>
															<td>
														<div class="hidden-sm hidden-xs btn-group">

															<a href="<?php echo base_url();?>admin/edittag/<?php echo $t['id_tag'];?>"><button class="btn btn-xs btn-info">
																<i class="ace-icon fa fa-pencil bigger-120"></i>
															</button></a>

															<a href="<?php echo base_url();?>admin/hapustag/<?php echo $t['id_tag'];?>"><button class="btn btn-xs btn-danger">
																<i class="ace-icon fa fa-trash-o bigger-120"></i>
															</button></a>

														</div>
														</td>
														</tr>
													<?php 
													$no++;
													} 
													?>
														
													</tbody>
												</table>