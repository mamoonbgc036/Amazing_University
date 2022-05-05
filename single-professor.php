<?php get_header(); ?>

	<?php 
		while( have_posts() ) {
			the_post();
			pageBanner();
			?>
			<div class="container container--narrow page-section">
				<div class="generic-content">
					<div class="row group">
						<div class="one-third">
							<?php the_post_thumbnail( 'professorVerticle' ); ?>
						</div>
						<div class="two-third">
							<?php the_content(); ?>
						</div>
					</div>
				<?php
				$relatedPrograms = get_field( 'related_programs' );
				if ( $relatedPrograms ) {
					?>
					<hr class="section-break">
					<h3>Subject Taught</h3>
					<?php
					foreach(  $relatedPrograms as $program ) {
					?>
						<li><a href="<?php echo get_permalink( $program ) ?>"><?php echo get_the_title( $program ) ?></a></li>
						<?php
					}
				}
				?>
				</div>
			</div>
			<?php
		}
	?>
<?php get_footer(); ?>