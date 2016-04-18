<?php

/** Various clean up functions */
require_once( 'modules/library/cleanup.php' );

/** Clean Admin panel */
require_once( 'modules/library/cleanup-admin.php' );


/** Required for Foundation to work properly */
require_once( 'modules/library/foundation.php' );

/** Register all navigation menus */
require_once( 'modules/library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'modules/library/menu-walkers.php' );

/** Create widget areas in sidebar and footer */
require_once( 'modules/library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'modules/library/entry-meta.php' );

/** Breadcrumbs */
require_once( 'modules/library/kama_breadcrumbs.php' );

/** Enqueue scripts */
require_once( 'modules/library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'modules/library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'modules/library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'modules/library/sticky-posts.php' );

/** Configure responsive image sizes */
//require_once( 'modules/library/responsive-images.php' );

 add_image_size( 'thumb-small'		, 120,	80, true );
 add_image_size( 'thumb-folio'		, 300,	200, true );
 add_image_size( 'thumb-slider'		, 550,	385, true );

 add_image_size( 'thumb-12col'		, 1200,	580, true );
 add_image_size( 'thumb-8col'		, 800,	400, true );
 add_image_size( 'thumb-6col'		, 580,	360, true );
 add_image_size( 'thumb-4col'		, 370,	185, true );
 add_image_size( 'thumb-3col'		, 270,	135, true );
 add_image_size( 'thumb-2col'		, 170,	115, true );


// add_image_size( 'thumb-4col'		, 195,	130, true );

/** Add Custom Post Type */
require_once( 'modules/cpt/custom-post-type.php' );

/** Add custom meta to taxonomy **/
//require_once( 'modules/tax/add-meta.php' );
require_once( 'modules/tax/add-meta-to-category.php' );
require_once( 'modules/tax/add-meta-to-taxonomy.php' );

/** Modify main WP_Query */
require_once( 'modules/library/query-modify.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
	//require_once( 'library/protocol-relative-theme-assets.php' );

require_once( 'modules/library/asdb_tweaks.php' );
require_once( 'modules/library/asdb_blocks.php' );
	//require_once( 'modules/library/kama_postviews.php' );
require_once( 'modules/library/kama_excerpt.php' );
require_once( 'widgets/asdb-posts.php' );
	//require_once( 'inc/load.php' );