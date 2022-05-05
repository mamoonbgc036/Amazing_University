<?php get_header();
	pageBanner();
 ?>

	<?php 
		while( have_posts() ) {
			the_post();
			?>
			<div class="container container--narrow page-section">
				<div class="metabox metabox--position-up metabox--with-home-link">
				       <p>
				         <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( 'program' ); ?>"><i class="fa fa-home" aria-hidden="true"></i>All Programs</a> <span class="metabox__main"><?php the_title(); ?></span>
				       </p>
				     </div>
				<div class="generic-content">
				<?php
				the_content();
				?>
				</div>
				<?php

				$relatedProfessor = new WP_QUERY(
					array(
						'posts_per_page' => -1,
						'orderby'=> 'title',
						'order' => 'ASC',
						'post_type'=> 'professor',
						'meta_query' => array(
							array(
								'key' => 'related_programs',
								'compare'=> 'LIKE',
								'value'=> '"' . get_the_ID() . '"'
							)
						),
					)
				);
				if( $relatedProfessor->have_posts() ) {
				?>
				<h3>Related Professor</h3>
				<?php
				while( $relatedProfessor->have_posts() ){
					$relatedProfessor->the_post();
					?>
					<li class="professor-card__list-item">
						<a class="professor-card" href="<?php the_permalink(); ?>"><img class="professor-card__image" src="<?php the_post_thumbnail_url( 'professorLandscape' ); ?>">
						<span class="professor-card__name"><?php the_title(); ?></span>
						</a>
					</li>
					<?php
					}
				}

				wp_reset_postdata();
			 $today = date('Ymd');
            $homepageEvents = new WP_QUERY(
              array(
                'posts_per_page' => -1,
                'post_type' => 'event',
                'orderby'=> 'meta_value_num',
                'meta_key'=> 'event_date',
                'order'=> 'ASC',
                'meta_query'=> array(
                  array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type'=> 'numeric'
                  ),
                  array(
                  	'key' => 'related_programs',
                  	'compare'=> 'LIKE',
                  	'value' => '"' . get_the_ID() . '"',
                  ),
                ),
              )
            );

           if ( $homepageEvents->have_posts() ) {
           	?>
           	<hr class="section-break">
				<h3 class="headline headline--medium">Related Events</h3>
           	<?php
           	 while( $homepageEvents->have_posts() ) {
              $homepageEvents->the_post();
        get_template_part( 'template-part/events' );
		}
           }
		?>
		</div>
		<?php
	}
	?>
<?php get_footer(); ?>