<?php
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
?>
<rss version="2.0"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
xmlns:admin="http://webns.net/mvcb/"
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:media="http://search.yahoo.com/mrss/"
xmlns:content="http://purl.org/rss/1.0/modules/content/">
 
	<channel>
		<title><?php echo $feed_name; ?></title>
		<link><?php echo $feed_url; ?></link>
		<description><?php echo $page_description; ?></description>
		<dc:language><?php echo $page_language; ?></dc:language>
		<dc:creator><?php echo $creator_email; ?></dc:creator>
		<dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
		<admin:generatorAgent rdf:resource="http://ruangpojok.net/" />

		<?php foreach($posts->result() as $post):
		$isi_berita = htmlspecialchars_decode($post->isi_berita); 
    	$isi = substr($isi_berita,0,200); 
    	$isi = substr($isi_berita,0,strrpos($isi," ")); 
    	$konten = html_entity_decode(strip_tags($isi));

		 ?>

	<item>
 
      <title><?php echo xml_convert($post->judul); ?></title>
      <link><?php echo site_url("blog/detail/".$post->judul_seo); ?></link>
      <guid><?php echo site_url("blog/detail/".$post->judul_seo); ?></guid>
 
        <description><![CDATA[ <?php echo $konten;?> ]]></description>
        <pubDate><?php echo $post->tanggal; ?></pubDate>
    </item>
 
     
<?php endforeach; ?>

	</channel>
</rss>