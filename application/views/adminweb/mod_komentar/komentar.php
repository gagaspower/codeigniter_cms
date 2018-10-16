									
<div class="page-header">
	<h1>Komentar</h1>
</div>
									
<?php echo $this->session->flashdata("k");?>
<br/>
	<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" id="provinsi">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama</th>
				<th>Komentar</th>
				<th>Status</th>
			</tr>
		</thead>

			<tbody>
				<?php
				$no=1;
				foreach($komen->result_array() as $r){
				$tglindo = tgl_indo($r['tgl_komentar']);
				$isi_komen = htmlspecialchars_decode($r['isi_komentar']);
                $isian=nl2br($isi_komen); 
				?>

					<tr>
						<td><?php echo $no;?></td>
						<td><?php 
							if($r['moderator'] != NULL){?> <?php echo $r['nama'];?><br><b><?php echo $r['moderator'];?></b> 
							<i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i> <?php }else{ ?> <?php echo $r['nama'];?> <?php } ?></td>
						<td><?php echo $isi_komen;?><br>
						Di artikel: <a href="<?php echo base_url();?>blog/detail/<?php echo $r['judul_seo'];?>" target="_blank"><?php echo $r['judul'];?></a><br>
						<a href="<?php echo base_url();?>admin/balaskomentar/<?php echo $r['id_komentar'];?>">Balas komentar</a> | 
						<a href="<?php echo base_url();?>admin/hapuskomen/<?php echo $r['id_komentar'];?>">Hapus komentar</a> | 
						<?php if($r['publish'] == "N" ){?>
						<a href="<?php echo base_url();?>admin/approve/<?php echo $r['id_komentar'];?>">Approve</a>
						<?php } else{ ?>
						<a href="<?php echo base_url();?>admin/unapprove/<?php echo $r['id_komentar'];?>">Unapprove</a>
						<?php } ?>
						</td>
						<td> <?php echo $r['publish'];?></td>
					</tr>
						<?php 
							$no++;
							} 
							?>
			</tbody>
	</table>
