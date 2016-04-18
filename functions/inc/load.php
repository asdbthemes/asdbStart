<?php
require_once('as_global.php');
require_once('util.php');
require_once('global_blocks.php');   // no autoload -
require_once('modules.php');
require_once('blocks.php');
require_once('data_source.php');
require_once('blocks_layout.php');
locate_template('functions/inc/block/block_1.php', true);
locate_template('functions/inc/block/block_2.php', true);
locate_template('functions/inc/block/block_3.php', true);
locate_template('functions/inc/block/block_4.php', true);
locate_template('functions/inc/block/block_5.php', true);

locate_template('functions/inc/mod/mod_1.php', true);
locate_template('functions/inc/mod/mod_10.php', true);
locate_template('functions/inc/mod/mod_2.php', true);
locate_template('functions/inc/mod/mod_3.php', true);
locate_template('functions/inc/mod/mod_4.php', true);
locate_template('functions/inc/mod/mod_5.php', true);
locate_template('functions/inc/mod/mod_9.php', true);

locate_template('functions/inc/ajax.php', true);

/* ----------------------------------------------------------------------------
 * Ajax support
 */
//td_api_autoload::add('td_ajax', td_global::$get_template_directory . '/includes/wp_booster/td_ajax.php');

/***
// ajax: block ajax hooks
add_action('wp_ajax_nopriv_td_ajax_block', array('td_ajax', 'on_ajax_block'));
add_action('wp_ajax_td_ajax_block',        array('td_ajax', 'on_ajax_block'));

// ajax: Renders loop pagination, for now used only on categories
add_action('wp_ajax_nopriv_td_ajax_loop', array('td_ajax', 'on_ajax_loop'));
add_action('wp_ajax_td_ajax_loop',        array('td_ajax', 'on_ajax_loop'));

// ajax: site wide search
add_action('wp_ajax_nopriv_td_ajax_search', array('td_ajax', 'on_ajax_search'));
add_action('wp_ajax_td_ajax_search',        array('td_ajax', 'on_ajax_search'));

// ajax: login window login
add_action('wp_ajax_nopriv_td_mod_login', array('td_ajax', 'on_ajax_login'));
add_action('wp_ajax_td_mod_login',        array('td_ajax', 'on_ajax_login'));

// ajax: login window register
add_action('wp_ajax_nopriv_td_mod_register', array('td_ajax', 'on_ajax_register'));
add_action('wp_ajax_td_mod_register',        array('td_ajax', 'on_ajax_register'));

// ajax: login window remember pass?
add_action('wp_ajax_nopriv_td_mod_remember_pass', array('td_ajax', 'on_ajax_remember_pass'));
add_action('wp_ajax_td_mod_remember_pass',        array('td_ajax', 'on_ajax_remember_pass'));

// ajax: admin panel - new sidebar
add_action('wp_ajax_nopriv_td_ajax_new_sidebar', array('td_ajax', 'on_ajax_new_sidebar'));
add_action('wp_ajax_td_ajax_new_sidebar',        array('td_ajax', 'on_ajax_new_sidebar'));

// ajax: admin panel - delete sidebar
add_action('wp_ajax_nopriv_td_ajax_delete_sidebar', array('td_ajax', 'on_ajax_delete_sidebar'));
add_action('wp_ajax_td_ajax_delete_sidebar',        array('td_ajax', 'on_ajax_delete_sidebar'));

// ajax: update views - via ajax only when enable in panel
add_action('wp_ajax_nopriv_td_ajax_update_views', array('td_ajax', 'on_ajax_update_views'));
add_action('wp_ajax_td_ajax_update_views',        array('td_ajax', 'on_ajax_update_views'));

// ajax: get views - via ajax only when enabled in panel
add_action('wp_ajax_nopriv_td_ajax_get_views', array('td_ajax', 'on_ajax_get_views'));
add_action('wp_ajax_td_ajax_get_views',        array('td_ajax', 'on_ajax_get_views'));
***/






/** ----------------------------------------------------------------------------
 * The function hook to alter body css classes.
 * It applies the necessary animation images effect to body @see animation-stack.less
 *
 * @param $classes
 *
 * @return array
 */
function td_hook_add_custom_body_class($classes) {

	if (empty(td_global::$td_options['tds_animation_stack'])) {

		$td_animation_stack_effect_type = 'type0';
		if (!empty(td_global::$td_options['tds_animation_stack_effect'])) {
			$td_animation_stack_effect_type = td_global::$td_options['tds_animation_stack_effect'];
		}

		$classes[] = 'td-animation-stack-' . $td_animation_stack_effect_type;
	}
	return $classes;
}






/*  ----------------------------------------------------------------------------
    add span wrap for category number in widget
 */
add_filter('wp_list_categories', 'cat_count_span');
function cat_count_span($links) {
    $links = str_replace('</a> (', '<span class="td-widget-no">', $links);
    $links = str_replace(')', '</span></a>', $links);
    return $links;
}




/*  ----------------------------------------------------------------------------
    remove gallery style css
 */
add_filter( 'use_default_gallery_style', '__return_false' );


/*  ----------------------------------------------------------------------------
    add extra contact information for author in wp-admin -> users -> your profile
 */
add_filter('user_contactmethods', 'td_extra_contact_info_for_author');
function td_extra_contact_info_for_author($contactmethods) {
    unset($contactmethods['aim']);
    unset($contactmethods['yim']);
    unset($contactmethods['jabber']);
    foreach (td_social_icons::$td_social_icons_array as $td_social_id => $td_social_name) {
        $contactmethods[$td_social_id] = $td_social_name;
    }
    return $contactmethods;
}


/* ----------------------------------------------------------------------------
 * shortcodes in widgets
 */
add_filter('widget_text', 'do_shortcode');
