<?php
$jam=date("H:i:s");
$tgl=tgl_indo(date("Y m d")); 	
  echo "<br /><p align=center>Hai <b>".$this->session->userdata('nama_users')."</b>, selamat datang di halaman admin. 
          Silahkan klik menu pilihan yang berada di bagian sidebar untuk mengelola content website. <br /> <b>".hari_ini().", $tgl, <span id='jam'></span></b> WIB</p><br />";
?>
<div class="col-sm-5">
	<div class="widget-box transparent">
<h3 class="header smaller lighter green">Control Panel</h3>
<a href="<?php echo base_url();?>admin/artikel" class="btn btn-app btn-light">
	<i class="ace-icon fa fa-newspaper-o bigger-230"></i>
	Article
</a>
<a href="<?php echo base_url();?>admin/kategori" class="btn btn-app btn-light">
	<i class="ace-icon fa fa-bookmark bigger-230"></i>
	Categories
</a>
<a href="<?php echo base_url();?>admin/tag" class="btn btn-app btn-light">
	<i class="ace-icon fa fa-tags bigger-230"></i>
	Tag 
</a>
<a href="<?php echo base_url();?>admin/mainmenu" class="btn btn-app btn-light">
	<i class="ace-icon fa fa-sitemap bigger-230"></i>
	Menu
</a>
<a href="<?php echo base_url();?>admin/user" class="btn btn-app btn-light">
	<i class="ace-icon fa fa-users bigger-230"></i>
	User
</a>
<a href="<?php echo base_url();?>admin/halaman" class="btn btn-app btn-light">
	<i class="ace-icon fa fa-file-o bigger-230"></i>
	Page
</a>
<a href="<?php echo base_url();?>admin/pengaturan" class="btn btn-app btn-light">
	<i class="ace-icon fa fa-cogs bigger-230"></i>
	Setting
</a>
<a href="<?php echo base_url();?>admin/hubungi" class="btn btn-app btn-light">
	<i class="ace-icon fa fa-envelope-o bigger-230"></i>
	Pesan
</a>
<a href="<?php echo base_url();?>admin/komentar" class="btn btn-app btn-light">
	<i class="ace-icon fa fa-comments bigger-230"></i>
	Komentar
</a>
</div></div>
<div class="col-sm-7">
	<div class="widget-box transparent">
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/backend/js/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
            data: {
                table: 'datatable'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: ''
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br/>' +
                        'Ada ' + this.point.y + ' Orang';
                }
            }
        });
    });
</script>

<div class="box box-success">
    <div class="box-header">
    <h3 class="box-title">Grafik Kunjungan</h3>
        <!--<div class="box-tools pull-right">
           <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>-->
        </div>

<div class="box-body chat" id="chat-box">
    <div id="container" style="min-width: 310px; min-height: 340px; margin: 0 auto"></div>

<table id="datatable" style='display:none'>
    <thead>
        <tr>
            <th></th>
            <th>Jumlah Kunjungan</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        
            $grafik = $this->admin_model->grafik_kunjungan();
            foreach ($grafik->result_array() as $row){
                echo "<tr>
                        <th>".tgl_grafik($row['tanggal'])."</th>
                        <td>$row[jumlah]</td>
                      </tr>";
            }
            
        ?>
    </tbody>
</table>
</div><!-- /.chat -->
</div><!-- /.box (chat box) -->
</div>
</div>


