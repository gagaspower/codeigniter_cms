										
						<div class="page-header">
							<h1>
Manajemen User
							</h1>
						</div><!-- /.page-header -->
											<a href="<?php echo base_url();?>admin/tambahuser">
											<button class="btn btn-xs btn-info">
												<i class="ace-icon fa fa-plus bigger-110"></i>
												Tambah
												<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
											</button></a><br/><br/>
											<?php echo $this->session->flashdata('k');?>
											<br/>
												<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" id="provinsi">
													<thead>
														<tr>
															<th>No.</th>
															<th>Nama </th>
															<th>Email</th>
															<th>Level</th>
															<th>Status Blokir</th>
															<th>Aksi</th>
														</tr>
													</thead>

													<tbody>
													<?php
													$no=1;
													foreach($author as $r){													
													?>

														<tr>
															<td><?php echo $no;?></td>
															<td><?php echo $r['nama_users'];?></td>
															<td><?php echo $r['email'];?></td>
															<td><?php echo $r['level'];?></td>
															<td><?php echo $r['blokir'];?></td>
															<td>
														<div class="hidden-sm hidden-xs btn-group">

															<a href="<?php echo base_url();?>admin/edituser/<?php echo $r['id_users'];?>"><button class="btn btn-xs btn-info">
																<i class="ace-icon fa fa-pencil bigger-120"></i>
															</button></a>

															<a href="<?php echo base_url();?>admin/hapususer/<?php echo $r['id_users'];?>"><button class="btn btn-xs btn-danger">
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