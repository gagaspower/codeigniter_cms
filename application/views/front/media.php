<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php include "judul.php"; ?></title>
    <meta charset="utf-8" />
    <meta name="description" content="<?php include "deskripsi.php"; ?>">
    <meta name="keywords" content="<?php include "keyword.php"; ?>">
    <meta name="google-site-verification" content="SbFkHJVQunGleMyuK33Z4NK3vCLDlzRIAaOJQB70bZQ" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="index, follow" />
    <meta content='id' name='geo.country' />
    <meta http-equiv="Copyright" content="ruangpojok" />
    <meta name="author" content="ruangpojok" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="language" content="Indonesia" />
    <meta name="revisit-after" content="7" />
    <meta name="webcrawlers" content="all" />
    <meta name="rating" content="general" />
    <meta name="spiders" content="all" />
    <meta http-equiv="imagetoolbar" content="no" />
    <link href='<?php echo base_url();?>favicon.ico' rel='icon' type='image/x-icon' />

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>public/assets/front/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>public/assets/front/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/assets/front/css/font-awesome.min.css" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="<?php echo base_url();?>public/assets/front/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript" src="<?php echo base_url();?>public/assets/front/js/modernizr.js"></script>
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>">
		    <?php $ambilLogo = $this->db->select('*')->from('identitas')->get();
		    if($ambilLogo->num_rows() == 1){
		    foreach($ambilLogo->result_array() as $r);
		    ?>
		        <img src="<?php echo base_url();?>public/upload/<?php echo $r['logo'];?>" alt="Ruangpojok" />
		    <?php }else{ ?>
		        <img src="<?php echo base_url();?>public/upload/<?php echo $r['logo'];?>" alt="Ruangpojok" />
		    <?php
		    }
		    ?>
		    </a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <?php $this->load->view('front/menu');?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

	 
	<!-- *****************************************************************************************************************
	 BLOG CONTENT
	 ***************************************************************************************************************** -->

	 <div class="container mtb">
	 	<div class="row">
	 	
	 		<div class="col-lg-8">
	 			
		 		 <?php echo $contents; ?>
		 		
			</div>
	 		
	 		
	 		
	 		<div class="col-lg-4">
		 			<p>
		 				<br/>
		 				<form action="<?php echo base_url();?>blog/pencarian/" method="POST">
		 				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" 
		 				style="display: none;">
		 				<input type="text" class="form-control" placeholder="masukan kata kunci" name="cari">
		 				</form>
		 			</p>
		 			
		 		<div class="spacing"></div>
		 		
		 		<h4>Kategori</h4>
		 		<div class="hline"></div>
		 		<?php $categories = $this->blog_model->kategoriartikel();
		 		if($categories->num_rows() == 0){
		 		echo "tidak ada kategori artikel";
		 		}else{
		    	foreach($categories->result_array() as $k){
		 		?>
			 		<p><a href="<?php echo base_url();?>blog/category/<?php echo $k['kategori_seo'];?>"><i class="fa fa-angle-right"></i> <?php echo $k['nama_kategori'];?></a> </p>
			 	<?php } }?>	
		 		<div class="spacing"></div>
		 		
		 		<h4>Sering Dibaca</h4>
		 		<div class="hline"></div>
					<ul class="popular-posts">
					<?php  $sql = $this->blog_model->beritapopuler();
						   foreach($sql->result_array() as $r){
						   $tanggal = tgl_indo($r['tanggal']);
					?>
		                <li>
		                <?php if($r['gambar'] != NULL){ ?>
		                    <a href="#"><img src="<?php echo base_url();?>public/upload/gambar_artikel/medium/<?php echo $r['gambar'];?>" alt="<?php echo $r['judul'];?>"></a>
		                <?php } else{ ?>
		                	<a href="#"><img src="<?php echo base_url();?>public/upload/no_image.jpg" alt="<?php echo $r['judul'];?>"></a>
		                <?php } ?>
		                    <p><a href="<?php echo base_url();?>blog/detail/<?php echo $r['judul_seo'];?>"><?php echo $r['judul'];?></a></p>
		                    <em>Posted on <?php echo $tanggal;?></em>
		                </li>
		            <?php  	}
		        ?>
		            </ul>
		            
		 		<div class="spacing"></div>
		 		
 		</div>
	 	</div>
	 </div>


	<!-- *****************************************************************************************************************
	 FOOTER
	 ***************************************************************************************************************** -->
	 <div id="footerwrap">
	 	<div class="container">
		 	<div class="row">
            	<?php $this->blog_model->kunjungan(); ?>
                <p>Copyright &copy;<?php echo date("Y");?> - Ruangpojok.net</p>
		 	
		 	</div>
	 	</div>
	 </div>
	 <script async src="https://www.googletagmanager.com/gtag/js?id=UA-106637622-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-106637622-1');
</script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?php echo base_url();?>public/assets/front/js/bootstrap.min.js"></script>
  	<script src="<?php echo base_url();?>public/assets/front/js/custom.js"></script>
  		<script src="<?php echo base_url();?>public/assets/front/js/jquery.prettyPhoto.js"></script>
  </body>
</html>
