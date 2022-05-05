<?php get_header();
   pageBanner(
    array(
      'title' => 'Past Events',
      'subtitle'=> 'A Recap of our past events',
    )
  );
 ?>

 <div class="container container--narrow page-section">
    <?php 

      $today = date('Ymd');
      $pastEvents = new WP_QUERY(
        array(
          'post_type' => 'event',
          'meta_key'=> 'event_date',
          'orderby' => 'meta_value_num',
          'order' => 'ASC',
          'meta_query' => array(
            'key' => 'event_date',
            'compare' => '<',
            'value' => $today,
            'type'=> 'numeric'
          ),
        )
      );
      while( $pastEvents->have_posts() ) {
        $pastEvents->the_post();
        get_template_part( 'template-part/events' );
      }

      echo paginate_links();
    ?>
  </div>
<?php get_footer(); ?>