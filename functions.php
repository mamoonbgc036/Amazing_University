<?php 
	function amazing_css_and_js_registration() {
		wp_enqueue_style( 'amazing_custom_style', get_stylesheet_uri() );

		wp_enqueue_style( 'amazing-app-css', get_theme_file_uri( 'css/app.css' ) );

		wp_enqueue_style( 'university-google-font', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');

		wp_enqueue_style( 'university_fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', [], [] );
		wp_enqueue_script( 'amazing_app', get_theme_file_uri( '/js/app.js' ), NULL, '1.0', true );
	}
	add_action( 'wp_enqueue_scripts', 'amazing_css_and_js_registration' );

	function university_facilities() {
		add_theme_support( 'title-tag' );
	}

	add_action( 'after_setup_theme', 'university_facilities' )
?>