<?php
function asdb_class( $args = '' ) {
		$layout = asdb_layout_class();
		$coloffset = '';
		$cat_class='';
		parse_str($args, $i);
		$class = isset($i['class']) ? trim($i['class']) : 'main';
		$cat_style = isset($i['cat_style']) ? trim($i['cat_style']) : null;
	if ($class == 'col' ) {
		$col = 'medium-12';
		if ( ( $layout == 'col-3cm' ) || ( $layout == 'col-3cl' ) || ( $layout == 'col-3cr' ) ) { $col = 'medium-6 columns'; }
		if ( ( $layout == 'col-2cl' ) || ( $layout == 'col-2cr' ) ) { $col = 'medium-8 columns'; }
		if ( $layout == 'col-3cm' ) { $coloffset = 'medium-push-3 '; }
		if ( $layout == 'col-2cr' ) { $coloffset = 'medium-push-4 '; }
		if ( $layout == 'col-3cr' ) { $coloffset = 'medium-push-6 '; }
		$out = $col . ' ' . $coloffset;
		}
	if ($class == 's1' ) {
	    if ( ( $layout == 'col-3cm' ) || ( $layout == 'col-3cl' ) || ( $layout == 'col-3cr' ) ) { $col = 'medium-3 columns'; }
	    if ( ( $layout == 'col-2cl' ) ||	( $layout == 'col-2cr' ) ) { $col = 'medium-4 columns'; }
	    if ( $layout == 'col-2cr' ) { $coloffset = 'medium-pull-8'; }
	    if ( ( $layout == 'col-3cm' ) || ( $layout == 'col-3cr' ) ) { $coloffset = 'medium-pull-6 columns'; }
		$out = $col . ' ' . $coloffset;
		}
	if ($class == 's2' ) {
	    if ( $layout == 'col-3cr' ) { $coloffset = 'medium-pull-6'; }
		$out = $coloffset;
		}
	if ($cat_style) {
		$qobj = get_queried_object();
		$col = ot_get_option('blog-columns');
		$cat_col = get_term_meta( $qobj->term_id, 'cat_col',true );
		$cat_style = get_term_meta( $qobj->term_id, 'cat_style',true )?get_term_meta( $qobj->term_id, 'cat_style',true ):'style-1';
		$fslider = get_term_meta( $qobj->term_id, 'fslider',true )?get_term_meta( $qobj->term_id, 'fslider',true ):'0';
		$columns=$col;
		$cat_class = $cat_style;
		if ($cat_col>0) {$columns=$cat_col;}
		if ($columns>1) {$cat_class .= ' multi-columns';} else { $cat_class .=' one-column'; }
		if ($fslider>0) {$cat_class .= ' featured-slider'; }
		}
		$out .= $cat_class;

	return $out;
}

function _bgstyle() {
	global $post;
$bgstyle = '';
$gbg = '';
$pbg = '';
if ( ot_get_option('site-background') != '') {$gbg = ot_get_option('site-background');}

if ( is_singular() && get_post_meta($post->ID, 'page-background', true )!= '') {$pbg = get_post_meta($post->ID, 'page-background', true );}

if ($gbg!='') {$bg = $gbg;} else {$bg = $pbg;}

if ( $bg != '' ) {
$bg_color = $bg['background-color'];
$bg_image = $bg['background-image'];
$bg_position = $bg['background-position'];
$bg_attachment = $bg['background-attachment'];
$bg_repeat = $bg['background-repeat'];
$bg_size = $bg['background-size'];
		if ( $bg_image && $bg_size == "" ) {
		$bgstyle .= 'background: '.$bg_color.' url('.$bg_image.') '.$bg_attachment.' '.$bg_position.' '.$bg_repeat.';';
		} elseif ( $bg_image && $bg_size != "" ) {
		$bgstyle .= 'background: '.$bg_color.' url('.$bg_image.') '.$bg_attachment.' '.$bg_position.' '.$bg_repeat.'; background-size: '.$bg_size.';';
		} elseif ( $bg_color ) {
		$bgstyle .= 'background-color: '.$bg_color.';';
		} else { $bgstyle .= ''; }
	}
	return $bgstyle;
}

function section_background( $termID ) {
if ($termID) :
$bgstyle = '';
$bg = get_post_meta( $termID, 'section-background', true );
if ( $bg != '' ) {
$bg_color = $bg['background-color'];
$bg_image = $bg['background-image'];
$bg_position = $bg['background-position'];
$bg_attachment = $bg['background-attachment'];
$bg_repeat = $bg['background-repeat'];
$bg_size = $bg['background-size'];
		if ( $bg_image && $bg_size == "" ) {
		$bgstyle .= 'background: '.$bg_color.' url('.$bg_image.') '.$bg_attachment.' '.$bg_position.' '.$bg_repeat.';';
		} elseif ( $bg_image && $bg_size != "" ) {
		$bgstyle .= 'background: '.$bg_color.' url('.$bg_image.') '.$bg_attachment.' '.$bg_position.' '.$bg_repeat.'; background-size: '.$bg_size.';';
		} elseif ( $bg_color ) {
		$bgstyle .= 'background-color: '.$bg_color.';';
		} else { $bgstyle .= ''; }
	}
	return $bgstyle;
else :
	return 'background:transparent;';
endif;


}

/*
   Excerpt ending
/* ------------------------------------ */

function asdb_excerpt_more( $more ) {
	global $post;
	return '<a class="readmore" href="'. get_permalink($post->ID) . '"><i class="fa fa-angle-double-right"></i></a>';
}
add_filter('excerpt_more', 'asdb_excerpt_more');




// modify-ing the custom query on category pages
// if( is_page_template( 'template-search.php' ) ){ ... }
// if( is_page_template( 'page-templates/template-search.php' ) ){ ... }




/*  Related posts
/* ------------------------------------ */
if ( ! function_exists( 'asdb_related_posts' ) ) {

	function asdb_related_posts() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'				=> true,
			'update_post_meta_cache'	=> false,
			'update_post_term_cache'	=> false,
			'ignore_sticky_posts'		=> 1,
			'orderby'					=> 'rand',
			'post__not_in'				=> array($post->ID),
			'posts_per_page'			=> 4
		);
			$tags = get_post_meta($post->ID, 'related_tag', true);
			if ( !$tags ) {
				$tags = wp_get_post_tags($post->ID, array('fields'=>'ids'));
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode(',', $tags);
			}
			if ( !$tags ) { $break = true; }
		$query = !isset($break)?new WP_Query($args):new WP_Query;
		return $query;
	}

}







/*
   Related products
/* ------------------------------------ */
if ( ! function_exists( 'asdb_related_tags' ) ) {
	function asdb_related_tags() {
		global $post;
		$numlinks = get_post_meta( $post->ID, '_numlinks', true  );
		if ( $numlinks == '' ) {$numlinks = 4;}
		// Define shared post arguments
		$args = array(
			'no_found_rows'				=> true,
			'update_post_meta_cache'	=> false,
			'update_post_term_cache'	=> false,
			'ignore_sticky_posts'		=> 1,
			'orderby'					=> 'rand',
			'post__not_in'				=> array($post->ID),
			'posts_per_page'			=> $numlinks,
			'post_type'					=> array( 'post'),
		);
		$tags = get_post_meta( $post->ID, 'related_tag');
			if ( $tags ) {
				$args['tag__in'] = $tags;
			}
			if ( ! $tags ) {
				$tags = wp_get_post_tags($post->ID, array('fields' => 'ids'));
				$args['tag__in'] = $tags; }
			if ( ! $tags ) { $break = true; }
		$query = ! isset($break)?new WP_Query($args):new WP_Query;
		return $query;
	}
}


/*
   Related products
/* ------------------------------------ */
if ( ! function_exists( 'asdb_related_blocks' ) ) {
	function asdb_related_blocks() {
		global $post;
		$numlinks = get_post_meta( $post->ID, '_numlinks', true  );
		$block = get_post_meta( $post->ID, 'related_block', true  );
		if ( $numlinks == '' ) {$numlinks = 4;}
		$args = array(
			'no_found_rows'				=> true,
			'update_post_meta_cache'	=> false,
			'update_post_term_cache'	=> false,
			'orderby'					=> 'rand',
			'posts_per_page'			=> (int) $numlinks,
			'post_type'					=> array( 'features' ),
			'post__in'					=> array( $block ),
		);
		$query = ! isset($break)?new WP_Query($args):new WP_Query;
		return $query;
	}
}


/*
   Page title
/* ------------------------------------ */
if ( ! function_exists( 'asdb_page_title' ) ) {
	function asdb_page_title() {
		global $post;
		$heading = esc_attr( get_post_meta( $post->ID, '_heading', true ) );
		$subheading = esc_attr( get_post_meta($post->ID,'_subheading',true) );
		if ($heading) { $title = $heading; } else {$title = get_the_title();}
		$pagetitle = '<h1 class="entry-title">'.$title.'</h1>';
		if ($subheading) {	$pagetitle .= '<h4 class="entry-subtitle">'.$subheading.'</h4>'; }
		return $pagetitle;
	}
}


/*
  ------------------------------------------------------------------------- *
 *  Template functions
/* ------------------------------------------------------------------------- */

/*
   Layout class
/* ------------------------------------ */
if ( ! function_exists( 'asdb_layout_class' ) ) {

	function asdb_layout_class() {
		// Default layout
		$layout = 'col-3cm';
		$default = 'col-3cm';

		// Check for page/post specific layout
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$meta = get_post_meta($post->ID,'_layout',true);
			// Get if set and not set to inherit
			if ( isset($meta) && ! empty($meta) && $meta != 'inherit' ) { $layout = $meta; }
			// Else check for page-global / single-global
			elseif ( is_single() && ( ot_get_option('layout-single') != 'inherit' ) ) { $layout = ot_get_option('layout-single',''.$default.''); }
			elseif ( is_page() && ( ot_get_option('layout-page') != 'inherit' ) ) { $layout = ot_get_option('layout-page',''.$default.''); }
			elseif ( (get_query_var('post_type') == 'portfolio') && ( ot_get_option('layout-portfolio') != 'inherit' ) ) { $layout = ot_get_option('layout-portfolio',''.$default.''); }
			// Else get global option
			else { $layout = ot_get_option('layout-global',''.$default.''); }
		}

		// Set layout based on page
		elseif ( is_home() && ( ot_get_option('layout-home') != 'inherit' ) ) { $layout = ot_get_option('layout-home',''.$default.''); }
		elseif ( is_category() && ( ot_get_option('layout-archive-category') != 'inherit' ) ) { $layout = ot_get_option('layout-archive-category',''.$default.''); }
		elseif ( is_archive() && ( ot_get_option('layout-archive') != 'inherit' ) ) { $layout = ot_get_option('layout-archive',''.$default.''); }
		elseif ( is_search() && ( ot_get_option('layout-search') != 'inherit' ) ) { $layout = ot_get_option('layout-search',''.$default.''); }
		elseif ( is_404() && ( ot_get_option('layout-404') != 'inherit' ) ) { $layout = ot_get_option('layout-404',''.$default.''); }
		//elseif ( if (function_exists( 'is_woocommerce' ) ) {is_woocommerce() } && ( ot_get_option('layout-woocommerce') !='inherit' ) ) $layout = ot_get_option('layout-woocommerce',''.$default.'');
		elseif ( (get_query_var('post_type') == 'portfolio') && ( ot_get_option('layout-portfolio') != 'inherit' ) ) { $layout = ot_get_option('layout-portfolio',''.$default.''); }

		// Global option
		else { $layout = ot_get_option('layout-global',''.$default.''); }

		// Return layout class
		return $layout;
	}
}

add_filter('body_class','my_class_names');
function my_class_names( $classes ) {
	global $post;
	$classes[] = 'col-2cr';
	$default = 'col-2cr';
	$meta = get_post_meta($post->ID,'_layout',true);
if ( isset($meta) && ! empty($meta) && $meta != 'inherit' ) { $classes[] = $meta; }

	return $classes;
}

/*
   Dynamic sidebar primary
/* ------------------------------------ */
if ( ! function_exists( 'asdb_sidebar_primary' ) ) {

	function asdb_sidebar_primary() {
		// Default sidebar
		$sidebar = 'primary';

		// Set sidebar based on page
		if ( is_home() && ot_get_option('s1-home') ) { $sidebar = ot_get_option('s1-home'); }
		if ( is_single() && ot_get_option('s1-single') ) { $sidebar = ot_get_option('s1-single'); }
		if ( is_archive() && ot_get_option('s1-archive') ) { $sidebar = ot_get_option('s1-archive'); }
		if ( is_category() && ot_get_option('s1-archive-category') ) { $sidebar = ot_get_option('s1-archive-category'); }
		if ( is_search() && ot_get_option('s1-search') ) { $sidebar = ot_get_option('s1-search'); }
		if ( is_404() && ot_get_option('s1-404') ) { $sidebar = ot_get_option('s1-404'); }
		//if ( is_woocommerce() && ot_get_option('s1-woo') ) $sidebar = ot_get_option('s1-woo');
		if ( is_page() && ot_get_option('s1-page') ) { $sidebar = ot_get_option('s1-page'); }

		// Check for page/post specific sidebar
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$meta = get_post_meta($post->ID,'_sidebar_primary',true);
			if ( $meta ) { $sidebar = $meta; }
		}

		// Return sidebar
		return $sidebar;
	}
}


/*
   Dynamic sidebar secondary
/* ------------------------------------ */
if ( ! function_exists( 'asdb_sidebar_secondary' ) ) {

	function asdb_sidebar_secondary() {
		// Default sidebar
		$sidebar = 'secondary';

		// Set sidebar based on page
		if ( is_home() && ot_get_option('s2-home') ) { $sidebar = ot_get_option('s2-home'); }
		if ( is_single() && ot_get_option('s2-single') ) { $sidebar = ot_get_option('s2-single'); }
		if ( is_archive() && ot_get_option('s2-archive') ) { $sidebar = ot_get_option('s2-archive'); }
		if ( is_category() && ot_get_option('s2-archive-category') ) { $sidebar = ot_get_option('s2-archive-category'); }
		if ( is_search() && ot_get_option('s2-search') ) { $sidebar = ot_get_option('s2-search'); }
		if ( is_404() && ot_get_option('s2-404') ) { $sidebar = ot_get_option('s2-404'); }
		//if ( is_woocommerce() && ot_get_option('s2-woo') ) $sidebar = ot_get_option('s2-woo');
		if ( is_page() && ot_get_option('s2-page') ) { $sidebar = ot_get_option('s2-page'); }

		// Check for page/post specific sidebar
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$meta = get_post_meta($post->ID,'_sidebar_secondary',true);
			if ( $meta ) { $sidebar = $meta; }
		}

		// Return sidebar
		return $sidebar;
	}
}


/*
   Social links
/* ------------------------------------ */
if ( ! function_exists( 'asdb_social_links' ) ) {

	function asdb_social_links() {
		if ( ! ot_get_option('social-links') == '' ) {
			$links = ot_get_option('social-links', array());
			if ( ! empty( $links ) ) {
				echo '<ul class="social-links">';
				foreach ( $links as $item ) {

					// Build each separate html-section only if set
					if ( isset($item['title']) && ! empty($item['title']) ) { $title = 'title="' .esc_attr( $item['title'] ). '"'; } else { $title = ''; }
					if ( isset($item['social-link']) && ! empty($item['social-link']) ) { $link = 'href="' .esc_attr( $item['social-link'] ). '"'; } else { $link = ''; }
					if ( isset($item['social-target']) && ! empty($item['social-target']) ) { $target = 'target="' .$item['social-target']. '"'; } else { $target = ''; }
					if ( isset($item['social-icon']) && ! empty($item['social-icon']) ) { $icon = 'class="fa ' .esc_attr( $item['social-icon'] ). '"'; } else { $icon = ''; }
					if ( isset($item['social-color']) && ! empty($item['social-color']) ) { $color = 'style="color: ' .$item['social-color']. ';"'; } else { $color = ''; }

					// Put them together
					if ( isset($item['title']) && ! empty($item['title']) && isset($item['social-icon']) && ! empty($item['social-icon']) && ($item['social-icon'] != 'fa-') ) {
						echo '<li><a rel="nofollow" class="social-tooltip" '.$title.' '.$link.' '.$target.'><i '.$icon.' '.$color.'></i></a></li>';
					}
				}
				echo '</ul>';
			}
		}
	}
}



/*
   Site name/logo
/* ------------------------------------ */
if ( ! function_exists( 'asdb_site_title' ) ) {

	function asdb_site_title() {
		if (ot_get_option('site-description')!='off'){$sd='<span class="subtitle">'.get_bloginfo('description').'<span>';}
		// Text or image?
		if ( ot_get_option('custom-logo') ) {
			$logo = '<img src="'.ot_get_option('custom-logo').'" alt="'.get_bloginfo('name').'">';
		} else {
			$logo = get_bloginfo('name').$sd;
		}

		$link = '<a href="'.home_url('/').'" rel="home">'.$logo.'</a>';

		if ( is_front_page() || is_home() ) {
			$sitename = '<span class="site-title">'.$link.'</span>'."\n";
		} else {
			$sitename = '<span class="site-title">'.$link.'</span>'."\n";
		}

		return $sitename;
	}
}



/*
   Related posts
/* ------------------------------------ */
if ( ! function_exists( 'asdb_related_posts' ) ) {

	function asdb_related_posts() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'				=> true,
			'update_post_meta_cache'	=> false,
			'update_post_term_cache'	=> false,
			'ignore_sticky_posts'		=> 1,
			'orderby'					=> 'rand',
			'post__not_in'				=> array($post->ID),
			'posts_per_page'			=> 3,
		);
		// Related by categories
		if ( ot_get_option('related-posts') == 'categories' ) {

			$cats = get_post_meta($post->ID, 'related-cat', true);

			if ( ! $cats ) {
				$cats = wp_get_post_categories($post->ID, array('fields' => 'ids'));
				$args['category__in'] = $cats;
			} else {
				$args['cat'] = $cats;
			}
		}
		// Related by tags
		if ( ot_get_option('related-posts') == 'tags' ) {

			$tags = get_post_meta($post->ID, 'related-tag', true);

			if ( ! $tags ) {
				$tags = wp_get_post_tags($post->ID, array('fields' => 'ids'));
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode(',', $tags);
			}
			if ( ! $tags ) { $break = true; }
		}

		$query = ! isset($break)?new WP_Query($args):new WP_Query;
		return $query;
	}
}


/*
   Get images attached to post
/* ------------------------------------ */
if ( ! function_exists( 'asdb_post_images' ) ) {

	function asdb_post_images( $args = array() ) {
		global $post;

		$defaults = array(
			'numberposts'		=> -1,
			'order'				=> 'ASC',
			'orderby'			=> 'menu_order',
			'post_mime_type'	=> 'image',
			'post_parent'		=> $post->ID,
			'post_type'			=> 'attachment',
		);

		$args = wp_parse_args( $args, $defaults );

		return get_posts( $args );
	}
}


/*
   Get featured post ids
/* ------------------------------------ */
if ( ! function_exists( 'asdb_get_featured_post_ids' ) ) {

	function asdb_get_featured_post_ids() {
		$args = array(
			'category'		=> ot_get_option('featured-category'),
			'numberposts'	=> ot_get_option('featured-posts-count'),
		);
		$posts = get_posts($args);
		if ( ! $posts ) { return false; }
		foreach ( $posts as $post ) {
			$ids[] = $post->ID; }
		return $ids;
	}
}


/*
  ------------------------------------------------------------------------- *
 *  Admin panel functions
/* ------------------------------------------------------------------------- */

/*
   Post formats script
/* ------------------------------------ */
if ( ! function_exists( 'asdb_post_formats_script' ) ) {

	function asdb_post_formats_script( $hook ) {
		// Only load on posts, pages
		if ( ! in_array($hook, array('post.php', 'post-new.php')) ) {
			return; }
		wp_enqueue_script('post-formats', get_template_directory_uri() . '/functions/js/post-formats.js', array( 'jquery' ));
	}
}
add_action( 'admin_enqueue_scripts', 'asdb_post_formats_script');


/*
  ------------------------------------------------------------------------- *
 *  Filters
/* ------------------------------------------------------------------------- */

/*
   Body class
/* ------------------------------------ */
if ( ! function_exists( 'asdb_body_class' ) ) {

	function asdb_body_class( $classes ) {
		$classes[] = asdb_layout_class();
		if ( ot_get_option( 'boxed' ) != 'on' ) { $classes[] = 'full-width'; }
		if ( ot_get_option( 'boxed' ) == 'on' ) { $classes[] = 'boxed'; }
		if ( has_nav_menu('topbar') ) {	$classes[] = 'topbar-enabled'; }
		return $classes;
	}
}
add_filter( 'body_class', 'asdb_body_class' );


/*
   Custom rss feed
/* ------------------------------------ */
if ( ! function_exists( 'asdb_feed_link' ) ) {

	function asdb_feed_link( $output, $feed ) {
		// Do not redirect comments feed
		if ( strpos( $output, 'comments' ) ) {
			return $output; }
		// Return feed url
		return esc_attr( ot_get_option('rss-feed',$output) );
	}
}
add_filter( 'feed_link', 'asdb_feed_link', 10, 2 );


/*
   Custom favicon
/* ------------------------------------ */
if ( ! function_exists( 'asdb_favicon' ) ) {

	function asdb_favicon() {
		if ( ot_get_option('favicon') ) {
			echo '<link rel="shortcut icon" href="'.ot_get_option('favicon').'" />'."\n";
		}
	}
}
add_filter( 'wp_head', 'asdb_favicon' );




/*
   Excerpt length
/* ------------------------------------ */
if ( ! function_exists( 'asdb_excerpt_length' ) ) {

	function asdb_excerpt_length( $length ) {
		return ot_get_option('excerpt-length',$length);
	}
}
add_filter( 'excerpt_length', 'asdb_excerpt_length', 999 );


/*
   Add wmode transparent to media embeds
/* ------------------------------------ */
if ( ! function_exists( 'asdb_embed_wmode_transparent' ) ) {

	function asdb_embed_wmode_transparent( $html, $url, $attr ) {
		if ( strpos( $html, '<embed src=' ) !== false ) { return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html); }
		elseif ( strpos( $html, 'feature=oembed' ) !== false ) { return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html ); }
		else { return $html; }
	}
}
add_filter( 'embed_oembed_html', 'asdb_embed_wmode_transparent', 10, 3 );


/*
   Add responsive container to embeds
/* ------------------------------------ */
if ( ! function_exists( 'asdb_embed_html' ) ) {

	function asdb_embed_html( $html, $url ) {

		$pattern    = '/^https?:\/\/(www\.)?twitter\.com/';
		$is_twitter = preg_match( $pattern, $url );

		if ( 1 === $is_twitter ) {
			return $html;
		}

		return '<div class="video-container">' . $html . '</div>';
	}
}
add_filter( 'embed_oembed_html', 'asdb_embed_html', 10, 3 );


/*
   Add responsive container to jetpack embeds
/* ------------------------------------ */
if ( ! function_exists( 'asdb_embed_html_jp' ) ) {

	function asdb_embed_html_jp( $html ) {
		return '<div class="video-container">' . $html . '</div>';
	}
}
add_filter( 'video_embed_html', 'asdb_embed_html_jp' );


/*
   Upscale cropped thumbnails
/* ------------------------------------ */
if ( ! function_exists( 'asdb_thumbnail_upscale' ) ) {

	function asdb_thumbnail_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ) {
		if ( ! $crop ) { return null; // let the wordpress default function handle this
}
		$aspect_ratio = $orig_w / $orig_h;
		$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

		$crop_w = round($new_w / $size_ratio);
		$crop_h = round($new_h / $size_ratio);

		$s_x = floor( ($orig_w - $crop_w) / 2 );
		$s_y = floor( ($orig_h - $crop_h) / 2 );

		return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
	}
}
add_filter( 'image_resize_dimensions', 'asdb_thumbnail_upscale', 10, 6 );


/*
   Add shortcode support to text widget
/* ------------------------------------ */
add_filter( 'widget_text', 'do_shortcode' );



/*
  ------------------------------------------------------------------------- *
 *  Actions
/* ------------------------------------------------------------------------- */

/*
   Include or exclude featured articles in loop
/* ------------------------------------ */
if ( ! function_exists( 'asdb_pre_get_posts' ) ) {

	function asdb_pre_get_posts( $query ) {
		// Are we on main query ?
		if ( ! $query->is_main_query() ) { return; }
		if ( $query->is_home() ) {

			// Featured posts enabled
			if ( ot_get_option('featured-posts-count') != '0' && ot_get_option('featured-slider') != 'off'  ) {
				// Get featured post ids
				$featured_post_ids = asdb_get_featured_post_ids();
				// Exclude posts
				if ( $featured_post_ids && ! ot_get_option('featured-posts-include') ) {
					$query->set('post__not_in', $featured_post_ids); }
			}
		}
	}
}

add_action( 'pre_get_posts', 'asdb_pre_get_posts' );


/*
   Script for no-js / js class
/* ------------------------------------ */
if ( ! function_exists( 'asdb_html_js_class' ) ) {

	function asdb_html_js_class() {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}
}
add_action( 'wp_head', 'asdb_html_js_class', 1 );


/*
   IE js header
/*
  ------------------------------------ */
/*
if ( ! function_exists( 'asdb_ie_js_header' ) ) {

	function asdb_ie_js_header () {
		echo '<!--[if lt IE 9]>'. "\n";
		echo '<script src="' . esc_url( get_template_directory_uri() . '/js/ie/html5.js' ) . '"></script>'. "\n";
		echo '<script src="' . esc_url( get_template_directory_uri() . '/js/ie/selectivizr.js' ) . '"></script>'. "\n";
		echo '<![endif]-->'. "\n";
	}

}

add_action( 'wp_head', 'asdb_ie_js_header' );
*/

/*
   IE js footer
/* ------------------------------------ */
if ( ! function_exists( 'asdb_ie_js_footer' ) ) {

	function asdb_ie_js_footer() {
		echo '<!--[if lt IE 9]>'. "\n";
		echo '<script src="' . esc_url( get_template_directory_uri() . '/js/ie/respond.js' ) . '"></script>'. "\n";
		echo '<![endif]-->'. "\n";
	}
}
add_action( 'wp_footer', 'asdb_ie_js_footer', 20 );


/*
   TGM plugin activation
/* ------------------------------------ */
if ( ! function_exists( 'asdb_plugins' ) ) {

	function asdb_plugins() {
		if ( ot_get_option('recommended-plugins') != 'off' ) {
			// Add the following plugins
			$plugins = array(
				array(
					'name' 				=> 'Regenerate Thumbnails',
					'slug' 				=> 'regenerate-thumbnails',
					'required'			=> false,
					'force_activation' 	=> false,
					'force_deactivation' => false,
				),
				array(
					'name' 				=> 'WP-PageNavi',
					'slug' 				=> 'wp-pagenavi',
					'required'			=> false,
					'force_activation' 	=> false,
					'force_deactivation' => false,
				),
				array(
					'name' 				=> 'Responsive Lightbox',
					'slug' 				=> 'responsive-lightbox',
					'required'			=> false,
					'force_activation' 	=> false,
					'force_deactivation' => false,
				),
				array(
					'name' 				=> 'Contact Form 7',
					'slug' 				=> 'contact-form-7',
					'required'			=> false,
					'force_activation' 	=> false,
					'force_deactivation' => false,
				),
			);
			tgmpa( $plugins );
		}
	}
}
add_action( 'tgmpa_register', 'asdb_plugins' );


if ( ! function_exists('asdb_link_pages') ) {

    function asdb_link_pages( $args = '' ) {
        $defaults = array(
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'next_or_number' => 'number',
            'nextpagelink' => __('Next page', 'asdbflat'),
            'previouspagelink' => __('Previous page', 'asdbflat'),
            'pagelink' => '%',
            'echo' => 1,
            );

        $r = wp_parse_args( $args, $defaults );
        $r = apply_filters( 'wp_link_pages_args', $r );
        extract( $r, EXTR_SKIP );

        global $page, $numpages, $multipage, $more, $pagenow;

        $output = '';
        if ( $multipage ) {
            if ( 'number' == $next_or_number ) {
                $output .= $before . '<ul class="pagination">';
                $laquo = $page == 1 ? 'class="disabled"' : '';
                $output .= '<li ' . $laquo .'>' . _wp_link_page($page -1) . '&laquo;</li>';
                for ( $i = 1; $i < ($numpages + 1); $i = $i + 1 ) {
                    $j = str_replace('%',$i,$pagelink);

                    if ( ($i != $page) || (( ! $more) && ($page == 1)) ) {
                        $output .= '<li>';
                        $output .= _wp_link_page($i);
                    }
                    else {
                        $output .= '<li class="active">';
                        $output .= _wp_link_page($i);
                    }
                    $output .= $link_before . $j . $link_after ;

                    $output .= '</li>';
                }
                $raquo = $page == $numpages ? 'class="disabled"' : '';
                $output .= '<li ' . $raquo .'>' . _wp_link_page($page + 1) . '&raquo;</li>';
                $output .= '</ul>' . $after;
            } else {
                if ( $more ) {
                    $output .= $before . '<ul class="pager">';
                    $i = $page - 1;
                    if ( $i && $more ) {
                        $output .= '<li class="previous">' . _wp_link_page($i);
                        $output .= $link_before. $previouspagelink . $link_after . '</li>';
                    }
                    $i = $page + 1;
                    if ( $i <= $numpages && $more ) {
                        $output .= '<li class="next">' .  _wp_link_page($i);
                        $output .= $link_before. $nextpagelink . $link_after . '</li>';
                    }
                    $output .= '</ul>' . $after;
                }
            }
        }

        if ( $echo ) {
            echo $output;
        } else {
            return $output;
        }
    }
}

if ( ! function_exists( 'asdb_share' ) ) {
		function asdb_share() {
	        global $post;
	        $twitter_user = ot_get_option( 'twitter_username' );
	        $assa = '';
		    $assa .= '
            <div class="asdb-box-sharing show-for-medium">
	            <!--<label> '. __('Sharing:', 'asdbflat') .'</label>-->
	            <a rel="nofollow" class="asdb-social-sharing-buttons asdb-social-vk" href="http://vk.com/share.php?url=' . urlencode( esc_url( get_permalink() ) ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-vk"></i><div class="asdb-social-but-text">Вконтакте</div></a>
	            <a rel="nofollow" class="asdb-social-sharing-buttons asdb-social-facebook" href="http://www.facebook.com/sharer.php?u=' . urlencode( esc_url( get_permalink() ) ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-facebook"></i><div class="asdb-social-but-text">Facebook</div></a>
	            <a rel="nofollow" class="asdb-social-sharing-buttons asdb-social-twitter" href="https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($post->title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . urlencode( esc_url( get_permalink() ) ) . '&via=' . urlencode( $twitter_user ? $twitter_user : get_bloginfo( 'name' ) ) . '"><i class="fa fa-twitter"></i><div class="asdb-social-but-text">Twitter</div></a>
	            <a rel="nofollow" class="asdb-social-sharing-buttons asdb-social-pinterest" href="http://pinterest.com/pin/create/button/?url=' . esc_url( get_permalink() ) . '&amp;media=' . ( ! empty( $image[0] ) ? $image[0] : '' ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-pinterest"></i></a>
	            <a rel="nofollow" class="asdb-social-sharing-buttons asdb-social-google" href="http://plus.google.com/share?url=' . esc_url( get_permalink() ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="fa fa-google-plus"></i></a>
            </div>
            ';
	return $assa;
	}
}


if ( ! function_exists( 'asdb_get_thumb' ) ) {
		function asdb_get_thumb( $args ) {
		global $post;
		$args = isset($args) ? $args : 'thumb-medium';
		$gthumb = ot_get_option( 'featured-image' );
		$placeholder = ot_get_option( 'placeholder' );
		$lthumb = get_post_meta( $post->ID, '_thumb', true );
		if ( is_single() && $lthumb === 'off' ) {
		echo '<!-- lthumb off -->';
		} elseif ( is_single() && $gthumb === 'off' ) {
		echo '<!-- gthumb off -->';
		} else {
        if ( has_post_thumbnail() && ! post_password_required() ) { ?>
        <div class="entry-thumbnail">
            <?php edit_post_link( '<i class="fa fa-edit"></i>', '<small class="edit-link pull-right">', '</small>' ); ?>
            <?php the_post_thumbnail($args); ?>
        </div>
        <?php } //.entry-thumbnail
        elseif ( !is_single() && ot_get_option('placeholder') != 'off' ) { ?>
        <div class="entry-thumbnail">
        	<img src="<?php echo get_template_directory_uri(); ?>/assets/images/td_696x0.png" alt="<?php the_title(); ?>" />
        </div>
        <?php }

		}
	}
}


function asdb_wp_page_menu() {
	//this is the default menu
	echo '<ul class="menu desktop-menu">';
	echo '<li class="menu-home active"><a href="' . esc_url(home_url( '/' )) . 'wp-admin/nav-menus.php?action=locations">Click here - to select or create a menu</a></li>';
	echo '</ul>';
}
