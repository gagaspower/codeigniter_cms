<?php header("Content-Type: text/xml;charset=iso-8859-1"); ?>
<?php '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
     <loc><?php echo base_url();?></loc>
     <priority>1.0</priority>
  </url>

  <?php foreach($artikel as $r) { ?>
  <url>
     <loc><?php echo base_url('blog/detail').'/'.$r->judul_seo;?></loc>
     <lastmod><?php echo $r->tanggal;?></lastmod>
     <changefreq>daily</changefreq>
     <priority>0.5</priority>
  </url>
  <?php } ?>
</urlset>

