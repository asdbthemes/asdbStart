<?php

/**
  * Here we store the global state of the theme.
 */

class as_global {


    static $as_options; //here we store all the options of the theme will be used in as_first_install.php

    static $current_template = ''; //used by page-homepage-loop, 404

    static $current_author_obj; //set by the author page template, used by widgets

    static $cur_url_page_id; //the id of the main page (if we have loop in loop, it will return the id of the page that has the uri)

    static $load_sidebar_from_template; //used by some templates for custom sidebars (setted by page-homepage-loop.php etc)

    static $load_featured_img_from_template; //used by single.php to instruct as_module_single to load the full with thumb when necessary (ex. no sidebars)

    static $cur_single_template_sidebar_pos = ''; // set in single.php - used by the gallery short code to show appropriate images

    static $cur_single_template = ''; /** @var string set here: @see  */


    static $is_woocommerce_installed = false; // at the end of this file we check if woo commerce is installed


    /**
     * @var stdClass holds the category object
     *      - it's set on pre_get_posts hook @see as_modify_main_query_for_category_page
     *      - WARNING: it can be null on category pages that request a category ID that dosn't exists
     */
    static $current_category_obj;

    //this is used to check for if we are in loop
    //also used for quotes in blocks - check isf the module is displayed on blocks or not
    static $is_wordpress_loop = '';

    static $custom_no_posts_message = '';  /** used to set a custom post message for the template. If this is set to false, the default message will not show @see as_page_generator::no_posts */


    /**
     * @var string used to store texts for: includes/wp_booster/wp-admin/content-metaboxes/as_set_video_meta.php
     * is set in as_config @see as_wp_booster_config::as_global_after
     */
    static $as_wp_admin_text_list = array();


    static $http_or_https = 'http'; //is set below with either http or https string  @see EOF


	//@todo refactor all code to use TEMPLATEPATH instead
    static $get_template_directory = '';  // here we store the value from get_template_directory(); - it looks like the wp function does a lot of stuff each time is called

	//@todo refactor all code to use STYLESHEETPATH instead
    static $get_template_directory_uri = ''; // here we store the value from get_template_directory_uri(); - it looks like the wp function does a lot of stuff each time is called


	static $as_viewport_intervals = array(); // the tdViewport intervals are stored

	const as_MOB_KEY_PAD = '_mob'; // str padding added to the mobile keys settings


    /**
     * the js files that the theme uses on the front end (file_id - filename) @see as_wp_booster_config
     * @see as_wp_booster_hooks
     * @var array
     */
    static $js_files = array ();

    static $theme_plugins_list = array();


	static $as_animation_stack_effects = array();



    /**
     * @var array the tinyMCE style formats
     */
    static $tiny_mce_style_formats = array();


    /**
     * @var array
     *
     *  'as_full_width' => array(           - id used in the drop down in tinyMCE
     *      'text' => 'Full width',         - the text that will appear in the dropdown in tinyMCE
     *      'class' => 'td-post-image-full' - the class tha this image style will add to the image
     *  )
     *
     */
    static $tiny_mce_image_style_list = array();


    /**
     * here we store the fields form td-panel -> custom css
     * @var array
     */
    static $theme_panel_custom_css_fields_list = array();


    /**
     * the big grid styles used by the theme. This styles will show up in the panel @see as_panel_categories.php and on each big grid block
     */
    static $big_grid_styles_list = array();


    /**
     * @var array
     */
    static $all_theme_panels_list = array();


    /**
     * stack_filename => stack_name
     * @var array
     */
    public static $demo_list = array ();


    /**
     * the list of fonts used by the theme by default
     * @var array
     */
    public static $default_google_fonts_list = array();


    /**
     * @var string here we keep the typography settings from the THEME FONTS panel.
     * this is also used by the css compiler
     */
    public static $typography_settings_list = array ();




    // @todo clean this up
    private static $post = '';
    private static $primary_category = '';


    static function load_single_post($post) {

            self::$post = $post;


        /*  ----------------------------------------------------------------------------
            update the primary category Only on single posts :0
         */
        if (is_single()) {
            //read the post setting
            $as_post_theme_settings = get_post_meta(self::$post->ID, 'as_post_theme_settings', true);
            if (!empty($as_post_theme_settings['as_primary_cat'])) {
                self::$primary_category = $as_post_theme_settings['as_primary_cat'];
                return;
            }

            $categories = get_the_category(self::$post->ID);
            foreach($categories as $category) {
                if ($category->name != as_FEATURED_CAT) { //ignore the featured category name
                    self::$primary_category = $category->cat_ID;
                    break;
                }
            }
        }
    }


    //used on single posts
    static function get_primary_category_id() {
        if (empty(self::$post->ID)) {
            return get_queried_object_id();
        }
        return self::$primary_category;
    }

    //generate unique_ids
    private static $unique_counter = 0;

    static function as_generate_unique_id() {
        self::$unique_counter++;
        return 'asdb_uid_' . self::$unique_counter . '_' . uniqid();
    }

}


if (is_ssl()) {
    as_global::$http_or_https = 'https';
}


require_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('woocommerce/woocommerce.php')) {
    as_global::$is_woocommerce_installed = true;
}


/**
 * as_global::$get_template_directory must be used instead of get_template_directory()
 * as_global::$get_template_directory_uri must be used instead of get_template_directory_uri()
 *
 * They supplies the get_template_directory() and get_template_directory_uri() if the mobile theme is not activated (actually, the mobile plugin is not activated).
 *
 * If the mobile plugin is activated, they will return the same values, but for doing this it needs to consider the as_mobile_theme class who saves these values. In this case,
 * the get_template_directory() and get_template_directory_uri() returns values corresponding to the mobile theme, and not to the main theme.
 */

$current_theme_name = get_template();

if (empty($current_theme_name) and class_exists('as_mobile_theme')) {
	as_global::$get_template_directory = as_mobile_theme::$main_dir_path;
} else {
	as_global::$get_template_directory = get_template_directory();
}

if (empty($current_theme_name) and class_exists('as_mobile_theme')) {
	as_global::$get_template_directory_uri = as_mobile_theme::$main_uri_path;
} else {
	as_global::$get_template_directory_uri = get_template_directory_uri();
}
