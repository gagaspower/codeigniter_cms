<?php
$total_komentar = $this->user_model->komentar_berita($r['id_berita'])->num_rows();
?>
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h2 class="page-header"><?php echo $total_komentar;?> Komentar</h2>
        <section class="comment-list">
          <!-- First Comment -->
          <?php if ($total_komentar >= '1'){ ?>
          <article class="row">
            <div class="col-md-2 col-sm-2 hidden-xs">
              <figure class="thumbnail">
                <img class="img-responsive" src="<?php echo base_url();?>assets/images/avatar.jpg" />
                <figcaption class="text-center">username</figcaption>
              </figure>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow left">
                <div class="panel-body">
                  <header class="text-left">
                    <div class="comment-user"><i class="fa fa-user"></i> That Guy</div>
                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                  </header>
                  <div class="comment-post">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                  </div>
                  <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
                </div>
              </div>
            </div>
          </article>

          <?php } ?> 
        </section>
    </div>
  </div>
</div>