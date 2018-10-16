									
<div class="page-header">
	<h1>Artikel</h1>
</div>
									
<a href="<?php echo base_url();?>admin/tambahartikel">
											<button class="btn btn-xs btn-info">
												<i class="ace-icon fa fa-plus bigger-110"></i>
												Tambah
												<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
											</button></a><br/><br/>
<?php echo $this->session->flashdata("k");?>
	<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" id="provinsi">
		<thead>
			<tr>
				<th>No.</th>
				<th>Judul Artikel</th>
				<th>Username</th>
				<th>Tgl Posting</th>
				<th>Aksi</th>
			</tr>
		</thead>

			<tbody>
			<?php
			$no=1;
			foreach($konten as $r){
			$tgl = tgl_indo($r['tanggal']);
			?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $r['judul'];?></td>
						<td><?php echo $r['username'];?></td>
						<td><?php echo $tgl;?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">

								<a href="<?php echo base_url();?>admin/editartikel/<?php echo $r['id_berita'];?>">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
								</a>

								<a href="<?php echo base_url();?>admin/hapusartikel/<?php echo $r['id_berita'];?>">
									<button class="btn btn-xs btn-danger">
										<i class="ace-icon fa fa-trash-o bigger-120"></i>
									</button>
								</a>

							</div>
						</td>
					</tr>
					<?php $no++; } ?>
			</tbody>
	</table>
