<?php
/**
 * Register widget areas
 *
 * @package asdbBase
 * @since asbbBase 1.0.0
 */

if ( ! function_exists( 'asdb_sidebar_widgets' ) ) :
function asdb_sidebar_widgets() {
		register_sidebar(array( 'name' => 'Primary', 'id' => 'primary', 'description' => 'Sidebar Primary', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));
		register_sidebar(array( 'name' => 'Secondary', 'id' => 'secondary', 'description' => 'Sidebar Secondary', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));
		if ( ot_get_option('header-ads') == 'on' ) { register_sidebar(array( 'name' => 'Header Ads', 'id' => 'header-ads', 'description' => 'Header ads area', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>')); }
		if ( ot_get_option('footer-ads') == 'on' ) { register_sidebar(array( 'name' => 'Footer Ads', 'id' => 'footer-ads', 'description' => 'Footer ads area', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>')); }
		if ( ot_get_option('footer-widgets') >= '1' ) { register_sidebar(array( 'name' => 'Footer 1', 'id' => 'footer-1', 'description' => 'Widgetized footer', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>')); }
		if ( ot_get_option('footer-widgets') >= '2' ) { register_sidebar(array( 'name' => 'Footer 2', 'id' => 'footer-2', 'description' => 'Widgetized footer', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>')); }
		if ( ot_get_option('footer-widgets') >= '3' ) { register_sidebar(array( 'name' => 'Footer 3', 'id' => 'footer-3', 'description' => 'Widgetized footer', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>')); }
		if ( ot_get_option('footer-widgets') >= '4' ) { register_sidebar(array( 'name' => 'Footer 4', 'id' => 'footer-4', 'description' => 'Widgetized footer', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>')); }
}

add_action( 'widgets_init', 'asdb_sidebar_widgets' );
endif;


/*
   Register custom sidebars
/* ------------------------------------ */
if ( ! function_exists( 'asdb_custom_sidebars' ) ) :

	function asdb_custom_sidebars() {
		if ( ! ot_get_option('sidebar-areas') == '' ) {

			$sidebars = ot_get_option('sidebar-areas', array());

			if ( ! empty( $sidebars ) ) {
				foreach ( $sidebars as $sidebar ) {
					if ( isset($sidebar['title']) && ! empty($sidebar['title']) && isset($sidebar['id']) && ! empty($sidebar['id']) && ($sidebar['id'] != 'sidebar-') ) {
						register_sidebar(array('name' => ''.esc_attr( $sidebar['title'] ).'', 'id' => ''.esc_attr( strtolower($sidebar['id']) ).'', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h6>', 'after_title' => '</h6>'));
					}
				}
			}
		}
	}
add_action( 'widgets_init', 'asdb_custom_sidebars' );
endif;
