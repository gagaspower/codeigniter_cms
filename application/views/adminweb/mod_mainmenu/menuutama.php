											
						<div class="page-header">
							<h1>
								<center>Menu Utama</center>
							</h1>
						</div><!-- /.page-header -->
											<a href="<?php echo base_url();?>admin/tambahmenu">
											<button class="btn btn-xs btn-info">
												<i class="ace-icon fa fa-plus bigger-110"></i>
												Tambah
												<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
											</button></a><br/><br/>
											<?php echo $this->session->flashdata("k");?>
											<br/>
												<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" id="provinsi">
													<thead>
														<tr>
															<th>No.</th>
															<th>Nama Menu</th>
															<th>Link Menu</th>
															<th>Aktif</th>
															<th>Aksi</th>
														</tr>
													</thead>

													<tbody>

													<?php
													$no=1;
													foreach($menus as $m){
													?>
														<tr>
															<td><?php echo $no;?></td>
															<td><?php echo $m['nama_menu'];?></td>
															<td><?php echo $m['link'];?></td>
															<td><?php echo $m['aktif'];?></td>
															<td>
														<div class="hidden-sm hidden-xs btn-group">

															<a href="<?php echo base_url();?>admin/editmenu/<?php echo $m['id_main'];?>"><button class="btn btn-xs btn-info">
																<i class="ace-icon fa fa-pencil bigger-120"></i>
															</button></a>

															<a href="<?php echo base_url();?>admin/hapusmain/<?php echo $m['id_main'];?>"><button class="btn btn-xs btn-danger">
																<i class="ace-icon fa fa-trash-o bigger-120"></i>
															</button></a>

														</div>
														</td>
														</tr>

													<?php $no++; } ?>	
													</tbody>
												</table>
