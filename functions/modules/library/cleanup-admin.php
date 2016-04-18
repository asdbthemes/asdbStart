<?php
/**
 * Clean up Admin panel defaults
 *
 * @package asdbbase
 * @since asdbbase 1.0.0
 */

/*
* Удаляем кнопки с панели администрирования
*/

function asdb_remove_admin_bar_links() {
  global $wp_admin_bar;

  $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
  $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
  $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
  $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
  $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
  $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
}
add_action('wp_before_admin_bar_render', 'asdb_remove_admin_bar_links');

if (!(current_user_can('administrator'))) {
function remove_wpcf7() {
remove_menu_page( 'wpcf7' );
}
add_action('admin_menu', 'remove_wpcf7');
}



if (current_user_can('contributor') && !current_user_can('upload_files')) :
 add_action('admin_init', 'razreshit_uchasnikam_gruzit_faili');
endif;

function razreshit_uchasnikam_gruzit_faili() {
 	$uchasnik= get_role('contributor');
 	$uchasnik->add_cap('upload_files');
	}
