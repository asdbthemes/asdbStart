<?php


//here we store the global statet

class as_global {


    static $current_author_obj; //set by the author page template, used by widgets

    static $cur_url_page_id; //the id of the main page (if we have loopp in loop, it will return the id of the page that has the uri)

    static $load_sidebar_from_template; //used by some templates for custom sidebars (setted by page-homepage-loop.php etc)

    static $load_featured_img_from_template; //used by single.php to instruct td_module_1 to load the full with thumb when necessary (ex. no sidebars)

    static $cur_single_template_sidebar_pos = ''; // set in single.php - used by the gallery short code to show appropriate images

    static $is_bbpress_forum_home = false; //used by breadcrumbs

    static $category_background = '';



    static $http_or_https = 'http'; //is set below with either http or https string



    private static $post = '';
    private static $primary_category = '';
    private static $unique_counter = 0;

    //generate unique_ids
    static function generate_unique_id() {
        return 'uid_' . uniqid();
    }

}


if (is_ssl()) {
    td_global::$http_or_https = 'https';
}