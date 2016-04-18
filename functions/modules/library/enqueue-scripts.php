<?php
/**
 * Enqueue all styles and scripts
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style }
 *
 * @package asdbbase
 * @since asdbbase 1.0.0
 */

if ( ! function_exists( 'asdbbase_scripts' ) ) :
	function asdbbase_scripts() {

	// Enqueue the main Stylesheet.


	// Deregister the jquery version bundled with WordPress.
	wp_deregister_script( 'jquery' );

	// CDN hosted jQuery placed in the header, as some plugins require that jQuery is loaded in the header.
	wp_enqueue_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', array(), '2.1.0', false );
//	wp_enqueue_script( 'prettyPhoto',	get_template_directory_uri() . '/js/jquery.prettyPhoto.js');
//	wp_enqueue_script( 'isotope',		get_template_directory_uri() . '/js/jquery.isotope.min.js');
//	wp_enqueue_script( 'main-js',		get_template_directory_uri() . '/js/main.js');
//	wp_enqueue_style ( 'prettyPhoto',	get_template_directory_uri() . '/css/prettyPhoto.css');

	// If you'd like to cherry-pick the foundation components you need in your project, head over to gulpfile.js and see lines 35-54.
	// It's a good idea to do this, performance-wise. No need to load everything if you're just going to use the grid anyway, you know :)
//	wp_enqueue_script( 'foundation', get_template_directory_uri() . '/assets/javascript/foundation.js', array('jquery'), '2.6.1', true );

	// Add the comment-reply library on pages where it is necessary
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	}

	add_action( 'wp_enqueue_scripts', 'asdbbase_scripts' );
endif;



/*  Enqueue css
/* ------------------------------------ */
if ( ! function_exists( 'asdb_styles' ) ) {

	function asdb_styles() {
	//	wp_enqueue_style( 'style', get_stylesheet_uri() );
//	wp_enqueue_style( 'main-stylesheet', get_template_directory_uri() . '/assets/stylesheets/foundation.css', array(), '2.6.1', 'all' );
	}

}
add_action( 'wp_enqueue_scripts', 'asdb_styles' );




/*  WP-PageNavi support - @devinsays (via GitHub)
/* ------------------------------------ */
function asdb_deregister_wp_s() {
	wp_deregister_style( 'wp-pagenavi' );
	wp_deregister_style( 'contact-form-7' );

}
add_action( 'wp_print_styles', 'asdb_deregister_wp_s', 100 );


function footer_enqueue_scripts(){
	remove_action('wp_head','wp_print_scripts');
	remove_action('wp_head','wp_print_head_scripts',9);
	remove_action('wp_head','wp_enqueue_scripts',1);
	add_action('wp_footer','wp_print_scripts',5);
	add_action('wp_footer','wp_enqueue_scripts',5);
	add_action('wp_footer','wp_print_head_scripts',5);
}
//add_action('after_setup_theme','footer_enqueue_scripts');


// Remove Open Sans that WP adds from frontend
if (!function_exists('remove_wp_open_sans')) :
  function remove_wp_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
  }
  add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
  // Uncomment below to remove from admin
  // add_action('admin_enqueue_scripts', 'remove_wp_open_sans');
endif;



function add_defer_attribute($tag, $handle) {
   $scripts_to_defer = array('jquery', 'another-handle');
   foreach($scripts_to_defer as $defer_script) {
      if ($async_script !== $handle) return $tag;
      return str_replace(' src', ' defer="defer" src', $tag);
   }
   return $tag;
}
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);

/*
function add_async_attribute($tag, $handle) {
   $scripts_to_async = array('my-js-handle', 'another-handle');
   foreach($scripts_to_async as $async_script) {
      if ($async_script !== $handle) return $tag;
      return str_replace(' src', ' async="async" src', $tag);
   }
   return $tag;
}
add_filter('script_loader_tag', 'add_async_attribute', 10, 2);
*/