<?php

function my_theme_enqueue_styles() {

	$parent_style = 'sparkling-style';

	// Add Bootstrap default CSS
	wp_enqueue_style( 'sparkling-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );

	// Add Font Awesome stylesheet
	wp_enqueue_style( 'sparkling-icons', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );

	// Add Google Fonts
	$font = of_get_option('main_body_typography');
	if ( isset( $font['subset'] ) ) {
		wp_register_style( 'sparkling-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700|Roboto+Slab:400,300,700&subset=' . $font['subset'] );
	}else{
		wp_register_style( 'sparkling-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700|Roboto+Slab:400,300,700' );
	}
	
	

	wp_enqueue_style( 'sparkling-fonts' );

	// Add slider CSS only if is front page ans slider is enabled
	if ( ( is_home() || is_front_page() ) && of_get_option( 'sparkling_slider_checkbox' ) == 1 ) {
		wp_enqueue_style( 'flexslider-css', get_template_directory_uri() . '/assets/css/flexslider.css' );
	}

	// Add main theme stylesheet
	
	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'sparkling-style', get_stylesheet_uri() );

	// Add Modernizr for better HTML5 and CSS3 support
	wp_enqueue_script( 'sparkling-modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr.min.js', array( 'jquery' ) );

	// Add Bootstrap default JS
	wp_enqueue_script( 'sparkling-bootstrapjs', get_template_directory_uri() . '/assets/js/vendor/bootstrap.min.js', array( 'jquery' ) );

	if ( ( is_home() || is_front_page() ) && of_get_option( 'sparkling_slider_checkbox' ) == 1 ) {
		// Add slider JS only if is front page ans slider is enabled
		wp_enqueue_script( 'flexslider-js', get_template_directory_uri() . '/assets/js/vendor/flexslider.min.js', array( 'jquery' ), '20140222', true );
		// Flexslider customization
		wp_enqueue_script( 'flexslider-customization', get_template_directory_uri() . '/assets/js/flexslider-custom.min.js', array( 'jquery', 'flexslider-js' ), '20140716', true );
	}

	// Main theme related functions
	wp_enqueue_script( 'sparkling-functions', get_template_directory_uri() . '/assets/js/functions.min.js', array( 'jquery' ) );

	// This one is for accessibility
	wp_enqueue_script( 'sparkling-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), '20140222', true );

	// Treaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );


}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


?>