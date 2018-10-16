									
<div class="page-header">
	<h1>Pesan Masuk</h1>
</div>
									
<?php echo $this->session->flashdata("h");?>
<br/>
	<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" id="provinsi">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Tgl & Jam </th>
				<th>Dibaca</th>
				<th>Aksi</th>
			</tr>
		</thead>

			<tbody>
				<?php
				$no=1;
				foreach($message->result_array() as $r){
				$tglindo = tgl_indo($r['tgl_hubungi']);
				?>

					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $r['nama'];?></td>
						<td><?php echo $r['email'];?></td>
						<td><?php echo $tglindo;?> & <?php echo $r['jam_hubungi'];?></td>
						<td><?php echo $r['dibaca'];?></td>
						<td>
							<div class="hidden-sm hidden-xs btn-group">

								<a href="<?php echo base_url();?>admin/balashubungi/<?php echo $r['id_hubungi'];?>">
									<button class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</button>
								</a>

								<a href="<?php echo base_url();?>admin/hapuspesan/<?php echo $r['id_hubungi'];?>">
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
