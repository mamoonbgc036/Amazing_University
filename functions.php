<?php 

	require get_theme_file_path('/inc/search-route.php');

	function university_rest_api(){
		register_rest_field('post', 'authorName', array(
			'get_callback' => function(){ return get_the_author(); }
		));
	}
	add_action('rest_api_init', 'university_rest_api');

	function pageBanner($args=null) {
		if ( !$args['title'] ) {
			$args['title'] = get_the_title();
		}

		if ( !$args['subtitle'] ) {
			$args['subtitle'] = get_field( 'page_banner_subtitle' );
		}

		if ( ! $args['photo'] ) {
			if ( get_field( 'page_banner_background_image' ) ) {
				$args['photo'] = get_field( 'page_banner_background_image' )['sizes']['pageBannerImage'];
			} else {
				$args['photo'] = get_theme_file_uri( '/images/ocean.jpg' );
			}
		}
		?>
		<div class="page-banner">
			  <div class="page-banner__bg-image" style="background-image: url(<?php $pagebannerimage = get_field( 'page_banner_background_image' ); echo $args['photo'] ?>)"></div>
			  <div class="page-banner__content container container--narrow">
			    <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
			    <div class="page-banner__intro">
			      <p><?php echo $args['subtitle'] ?></p>
			    </div>
			  </div>
			</div>
		<?php
	}
	function amazing_css_and_js_registration() {
		wp_enqueue_style( 'amazing_custom_style', get_stylesheet_uri() );

		wp_enqueue_style( 'amazing-app-css', get_theme_file_uri( 'css/app.css' ) );

		wp_enqueue_style( 'university-google-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');

		wp_enqueue_style( 'university_fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', [], [] );
		wp_enqueue_script( 'amazing_custom-js', get_theme_file_uri( '/js/dist/bundle.js' ), NULL, '1.0', true );
		wp_enqueue_script( 'amazing_app', get_theme_file_uri( '/js/app.js' ), NULL, '1.0', true );
		wp_localize_script( 'university_live_search', 'universityData', [
			'root_url' => get_site_url(),
		] );
	}
	add_action( 'wp_enqueue_scripts', 'amazing_css_and_js_registration' );

	function university_facilities() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'professorLandscape', 400, 250, true );
		add_image_size( 'professorVerticle', 250, 350, true );
		add_image_size( 'pageBannerImage', 1500, 250, true );
	}

	add_action( 'after_setup_theme', 'university_facilities' );

	function adjust_university_custom_query($query) {
		if( !is_admin() AND is_post_type_archive( 'program' ) AND $query->is_main_query() ) {
			$query->set( 'orderby', 'title' );
			$query->set( 'order', 'ASC' );
			$query->set('posts_per_page', 100 );
		}
		if( !is_admin() AND is_post_type_archive( 'event' ) AND $query->is_main_query() ) {
			$today = date( 'Ymd' );
			$query->set( 'meta_key', 'event_date' );
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'order', 'ASC' );
			$query->set( 'meta_query', array(
				array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type'=> 'numeric'
                  ),
			) );
		}
	}

	add_action( 'pre_get_posts', 'adjust_university_custom_query' );

	function universityMapKey( $api ) {
		$api['key'] = 'AIzaSyAE2zrvgue9j-Zsk7e0zIACgeaLmIbuzhU';
		return $api;
	}

	add_filter( 'acf/fields/google_map/api', 'universityMapKey' );
?>