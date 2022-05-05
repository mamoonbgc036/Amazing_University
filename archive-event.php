<?php get_header(); 
	pageBanner(
		array(
			'title' => 'All Events',
			'subtitle'=> 'See What going on our world',
		)
	);
?>
 <div class="container container--narrow page-section">
    <?php 
      while( have_posts() ) {
        the_post();
        get_template_part( 'template-part/events' );
      }

      echo paginate_links();
    ?>
    <hr class="section-break">
    <a href="<?php echo site_url( '/past-events' );?>">Please see our past event</a>
  </div>
<?php get_footer(); ?>