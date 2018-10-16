
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard Admin Panel</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>public/assets/backend/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>public/assets/backend/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();?>public/assets/backend/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>public/assets/backend/css/chosen.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>public/assets/backend/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url();?>public/assets/backend/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>public/assets/backend/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>public/assets/backend/css/dataTables.bootstrap.css"/>

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?php echo base_url();?>public/assets/backend/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url();?>public/assets/ckeditor/ckeditor.js" type="text/javascript"></script>
		<link href="<?php echo base_url();?>public/assets/ckeditor/plugins/codesnippet/lib/highlight/styles/default.css" rel="stylesheet">
        <script src="<?php echo base_url();?>public/assets/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js"></script>
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-desktop"></i>
							PANEL ADMIN
						</small>
					</a>
				</div>
					<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="">
							<a href="<?php echo base_url();?>" target="_blank">
								<i class="ace-icon fa fa-external-link "></i>
								Lihat Web
							</a>
						</li>
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php echo base_url();?>public/upload/no_image.png" alt="<?php echo $this->session->userdata('username');?>" />
									<span class="user-info">
									<small><?php echo $this->session->userdata('level');?></small>
									<?php echo $this->session->userdata('username');?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>
							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">

								<li>
									<a href="<?php echo base_url();?>admin/gantipaswod">
										<i class="ace-icon fa fa-lock"></i>
										Ganti Password
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?php echo base_url();?>admin/logout">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- menu navbar dropdown disini-->
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<ul class="nav nav-list">
					<li class="active">
						<a href="<?php echo base_url();?>admin">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class=""><a href="<?php echo base_url();?>admin/artikel" ><i class="menu-icon fa fa-newspaper-o"></i><span class="menu-text"> Artikel </span></a></li>
					<li class=""><a href="<?php echo base_url();?>admin/kategori" ><i class="menu-icon fa fa-bookmark "></i><span class="menu-text"> Kategori Artikel</span></a></li>
					<li class=""><a href="<?php echo base_url();?>admin/tag" ><i class="menu-icon fa fa-tags "></i><span class="menu-text"> Tag Artikel</span></a></li>
					<li class=""><a href="<?php echo base_url();?>admin/komentar" ><i class="menu-icon fa fa-comments  "></i><span class="menu-text"> Komentar 
					<?php 
					
						$hitung = $this->admin_model->hitungkomen()->num_rows();
						if($hitung > 0){
						echo "($hitung) Baru";
						}else{ echo ""; }	
					
					?>
					</span></a></li>
					<li class=""><a href="<?php echo base_url();?>admin/mainmenu" ><i class="menu-icon fa fa-sitemap "></i><span class="menu-text"> Menuutama </span></a></li>
					<li class=""><a href="<?php echo base_url();?>admin/submenu" ><i class="menu-icon fa fa-sort-amount-asc "></i><span class="menu-text"> Submenu </span></a></li>
					<li class=""><a href="<?php echo base_url();?>admin/halaman" ><i class="menu-icon fa fa-file-o"></i><span class="menu-text"> Halaman Statis </span></a></li>
					<li class=""><a href="<?php echo base_url();?>admin/user" ><i class="menu-icon fa fa-users"></i><span class="menu-text"> Pengguna </span></a></li>
					<li class=""><a href="<?php echo base_url();?>admin/hubungi" ><i class="menu-icon fa  fa-envelope-o  "></i><span class="menu-text"> Pesan 
					<?php
					
					$hitung = $this->admin_model->hitungpesan()->num_rows();
					if($hitung > 0){
					echo "($hitung) Baru";
					}else{ echo ""; }	
					
					?>

					</span></a></li>
					<li class=""><a href="<?php echo base_url();?>admin/pengaturan" ><i class="menu-icon fa fa-cogs"></i><span class="menu-text"> Pengaturan </span></a></li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								 <!-- /. ROW  -->
								 <?php echo $contents; ?>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Dibuat Dengan Logika - Dirawat Dengan Cinta</span>
							 &copy; <?php echo date("Y");?>
						</span>

					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script src="<?php echo base_url();?>public/assets/backend/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="<?php echo base_url();?>public/assets/backend/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>public/assets/backend/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url();?>public/assets/backend/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="<?php echo base_url();?>public/assets/backend/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url();?>public/assets/backend/js/highcharts.js"></script>
		<script src="<?php echo base_url();?>public/assets/backend/js/data.js"></script>
		<script src="<?php echo base_url();?>public/assets/backend/js/exporting.js"></script>
		<script src="<?php echo base_url();?>public/assets/backend/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url();?>public/assets/backend/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url();?>public/assets/backend/js/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url();?>public/assets/backend/js/jquery.easypiechart.min.js"></script>
		<script src="<?php echo base_url();?>public/assets/backend/js/jquery.sparkline.index.min.js"></script>
		<script src="<?php echo base_url();?>public/assets/backend/js/jquery.flot.min.js"></script>
		<script src="<?php echo base_url();?>public/assets/backend/js/jquery.flot.pie.min.js"></script>
		<script src="<?php echo base_url();?>public/assets/backend/js/jquery.flot.resize.min.js"></script>
		

		<!-- ace scripts -->
		<script src="<?php echo base_url();?>public/assets/backend/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>public/assets/backend/js/ace.min.js"></script>
		<script src="<?php echo base_url();?>public/assets/backend/datatables/jquery.dataTables.js"></script>
        <script src="<?php echo base_url();?>public/assets/backend/datatables/dataTables.bootstrap.js"></script>

        <script type="text/javascript">
            $(function() {
                $("#provinsi").dataTable();
            });

			
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
			
			
					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}
			

			//upload gambar artikel

			$('#id-input-file-3').ace_file_input({
					style: 'well',
					btn_choose: 'Klik Untuk Memilih Gambar',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'large'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
			
				function jam(){
		        var waktu = new Date();
		        var jam = waktu.getHours();
		        var menit = waktu.getMinutes();
		        var detik = waktu.getSeconds();
		         
		        if (jam < 10){ jam = "0" + jam; }
		        if (menit < 10){ menit = "0" + menit; }
		        if (detik < 10){ detik = "0" + detik; }
		        var jam_div = document.getElementById('jam');
		        jam_div.innerHTML = jam + ":" + menit + ":" + detik;
		        setTimeout("jam()", 1000);
		      } jam();
				
			
				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Klik Untuk Memilih Gambar";
						no_icon = "ace-icon fa fa-picture-o";
			
						whitelist_ext = ["jpeg", "jpg"];
						whitelist_mime = ["image/jpg", "image/jpeg"];
					}
					else {
						btn_choose = "Klik Untuk Memilih Gambar";
						no_icon = "ace-icon fa fa-cloud-upload";
						
						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');
					
					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format
						
						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']
						
						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]
						
						
						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/
						
						
						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});
					
					
					/**
					file_input
					.off('file.preview.ace')
					.on('file.preview.ace', function(e, info) {
						console.log(info.file.width);
						console.log(info.file.height);
						e.preventDefault();//to prevent preview
					});
					*/
				
				});
			
        </script>
        		<script>CKEDITOR.replace( 'loko' ,{ 
			filebrowserBrowseUrl : '<?php echo base_url();?>public/assets/filemanager/dialog.php?type=2&editor=ckeditor&amp;fldr=', 
			filebrowserUploadUrl : '<?php echo base_url();?>public/assets/filemanager/dialog.php?type=2&editor=ckeditor&amp;fldr=', 
			filebrowserImageBrowseUrl : '<?php echo base_url();?>public/assets/filemanager/dialog.php?type=1&editor=ckeditor&amp;fldr=' 
		});</script>
	</body>
</html>
