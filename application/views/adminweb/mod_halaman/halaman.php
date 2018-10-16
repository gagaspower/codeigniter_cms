									
<div class="page-header">
	<h1>Halaman Statis</h1>
</div>
									
<a href="<?php echo base_url();?>admin/tambahhalaman">
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
				<th>Judul Halaman</th>
				<th>Judul SEO</th>
				<th>Tgl Posting</th>
				<th>Aksi</th>
			</tr>
		</thead>

			<tbody>
				<?php
				$no=1;
				foreach($statis as $r){
				$tglindo = tgl_indo($r['tgl_posting']);
				?>

					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $r['judul'];?></td>
						<td><?php echo $r['judul_seo'];?></td>
						<td><?php echo $tglindo;?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">

								<a href="<?php echo base_url();?>admin/edithalaman/<?php echo $r['id_halaman'];?>">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
								</a>

								<a href="<?php echo base_url();?>admin/hapushalaman/<?php echo $r['id_halaman'];?>">
									<button class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</button>
								</a>

							</div>
						</td>
					</tr>
						<?php 
							$no++;
							} 
							?>
			</tbody>
	</table>
