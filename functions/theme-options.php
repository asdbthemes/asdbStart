<?php



/*  Initialize the options before anything else.
/* ------------------------------------ */
add_action( 'admin_init', 'custom_theme_options', 1 );


/*  Build the custom settings & update OptionTree.
/* ------------------------------------ */
function custom_theme_options() {

	// Get a copy of the saved settings array.
	$saved_settings = get_option( 'option_tree_settings', array() );

	// Custom settings array that will eventually be passed to the OptionTree Settings API Class.
	$custom_settings = array(

/*  Help pages
/* ------------------------------------ */
	'contextual_help' => array(
      'content'       => array(
        array(
          'id'        => 'general_help',
          'title'     => 'Documentation',
          'content'   => '
			<h1>https://asdbthemes.ru/asdbbase/</h1>
			<p>Thanks for using this theme! Enjoy.</p>
		'
        )
      )
    ),

/*  Admin panel sections
/* ------------------------------------ */
	'sections'        => array(
		array(
			'id'		=> 'general',
			'title'		=> 'General'
		),
		array(
			'id'		=> 'blog',
			'title'		=> 'Blog'
		),
		array(
			'id'		=> 'header',
			'title'		=> 'Header'
		),
		array(
			'id'		=> 'footer',
			'title'		=> 'Footer'
		),
		array(
			'id'		=> 'layout',
			'title'		=> 'Layout'
		),
		array(
			'id'		=> 'sidebars',
			'title'		=> 'Sidebars'
		),
		array(
			'id'		=> 'social-links',
			'title'		=> 'Social Links'
		),
		array(
			'id'		=> 'styling',
			'title'		=> 'Styling'
		),
		array(
			'id'		=> 'fonts',
			'title'		=> 'Fonts'
		),
		array(
			'id'		=> 'site',
			'title'		=> 'Custom Post Type'
		),
	),

/*  Theme options
/* ------------------------------------ */
	'settings'        => array(
		array(
			'id'		=> 'front-page',
			'label'		=> 'Front Page template asdb',
			'desc'		=> 'Swith to Off to disable a template ASDB on Frontpage',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		array(
			'id'		=> 'preloader',
			'label'		=> 'Use preloader for loading pages',
			'desc'		=> 'Swith to Off to disable preloader',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// General: Favicon
		array(
			'id'		=> 'favicon',
			'label'		=> 'Favicon',
			'desc'		=> 'Upload a 16x16px Png/Gif image that will be your favicon',
			'type'		=> 'upload',
			'std'		=> get_template_directory_uri() . '/assets/images/favicon.png',
			'section'	=> 'general'
		),
		// General: Tracking Code
		array(
			'id'		=> 'tracking-code',
			'label'		=> 'Tracking Code',
			'desc'		=> 'Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.',
			'type'		=> 'textarea-simple',
			'section'	=> 'general',
			'rows'		=> '3'
		),
		// General: Comments
		array(
			'id'		=> 'site-background',
			'label'		=> 'Site Background',
			'desc'		=> 'Set background color and/or upload your own background image',
			'type'		=> 'background',
			'std'		=> '',
			'section'	=> 'general'
		),
		array(
			'id'		=> 'page-comments',
			'label'		=> 'Page Comments',
			'desc'		=> 'Comments on pages',
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// General: Recommended Plugins
		array(
			'id'		=> 'recommended-plugins',
			'label'		=> 'Recommended Plugins',
			'desc'		=> 'Enable or disable the recommended plugins notice',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'general'
		),
		// Blog: Excerpt Length
		array(
			'id'			=> 'excerpt-length',
			'label'			=> 'Excerpt Length',
			'desc'			=> 'Maximum number of characters',
			'std'			=> '155',
			'type'			=> 'numeric-slider',
			'section'		=> 'blog',
			'min_max_step'	=> '0,400,1'
		),
		// Blog: Featured Posts
		array(
			'id'		=> 'featured-slider',
			'label'		=> 'Featured Posts for category',
			'desc'		=> 'To show featured posts in category ',
			'type'		=> 'on-off',
			'std'		=> 'off',
			'section'	=> 'blog',

		),

		// Blog: Featured Category
		array(
			'id'		=> 'featured-category',
			'label'		=> 'Featured Category',
			'desc'		=> 'By not selecting a category, it will show your latest post(s) from all categories',
			'type'		=> 'category-select',
			'section'	=> 'blog'
		),
		array(
			'label'		=> 'Featured Style',
			'id'		=> 'featured-style',
			'section'	=> 'blog',
			'type'		=> 'select',
			'std'		=> 'style-1',
			'choices'	=> array(
				array(
					'value'		=> 'style-1',
					'label'		=> 'Style 1',
				),
			),
		),
		// Blog: Featured Category Count
		array(
			'id'			=> 'featured-posts-count',
			'label'			=> 'Featured Post Count',
			'desc'			=> 'Max number of featured posts to display. <br /><i>Set to 1 and it will show it without any slider script</i><br /><i>Set it to 0 to disable</i>',
			'std'			=> '0',
			'type'			=> 'numeric-slider',
			'section'		=> 'blog',
			'min_max_step'	=> '0,10,1'
		),

		// Blog: Columns 1 or 2 or 3
		array(
			'id'		=> 'blog-columns',
			'label'		=> 'Number columns of Blog',
			'desc'		=> 'Show one, two or three post per row, image beside text',
			'std'		=> '2',
			'type'		=> 'select',
			'section'	=> 'blog',
			'choices'	=> array(
				array(
					'value' => '1',
					'label' => 'One columns'
				),
				array(
					'value' => '2',
					'label' => 'Two columns'
				),
				array(
					'value' => '3',
					'label' => 'Three columns'
				),
			)
		),
		// Blog: Thumbnail Placeholder
		array(
			'id'		=> 'placeholder',
			'label'		=> 'Thumbnail Placeholder',
			'desc'		=> 'Show featured image placeholders if no featured image is set',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Single - Sharrre
		array(
			'id'		=> 'sharrre',
			'label'		=> 'Single &mdash; Share Bar',
			'desc'		=> 'Social sharing buttons for each article',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Blog: Twitter Username
		array(
			'id'		=> 'twitter-username',
			'label'		=> 'Twitter Username',
			'desc'		=> 'Your @username will be added to share-tweets of your posts (optional)',
			'type'		=> 'text',
			'section'	=> 'blog'
		),
		// Blog: Single - Authorbox
		array(
			'id'		=> 'author-bio',
			'label'		=> 'Single &mdash; Author Bio',
			'desc'		=> 'Shows post author description, if it exists',
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'blog'
		),
		// Header: Style
		array(
			'id'		=> 'header-style',
			'label'		=> 'Style for header',
			'desc'		=> 'Style for header',
			'std'		=> 'style1',
			'type'		=> 'radio-image',
			'section'	=> 'header',
			'choices'	=> array(
				array(
					'value'		=> 'style1',
					'label'		=> 'Style 1',
					'src'		=> get_template_directory_uri() . '/functions/images/header-style1.png'
				),
			)
		),
		// Header: Ads
		array(
			'id'		=> 'header-ads',
			'label'		=> 'Header widget area',
			'desc'		=> 'Header widget area',
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'header'
		),
		// Header: Nav Menu
		array(
			'id'		=> 'nav-menu-full',
			'label'		=> 'Full Width Nav Menu',
			'desc'		=> 'ON - Full Width Nav Menu / OFF Block Width Nav Menu',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'header'
		),
		// Header: Custom Logo
		array(
			'id'		=> 'custom-logo',
			'label'		=> 'Custom Logo',
			'desc'		=> 'Upload your custom logo image. Set logo max-height in styling options.',
			'type'		=> 'upload',
			'section'	=> 'header'
		),
		// Header: Site Description
		array(
			'id'		=> 'site-description',
			'label'		=> 'Site Description',
			'desc'		=> 'The description that appears next to your logo',
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'header'
		),
		// Header: Header Image
		array(
			'id'		=> 'header-image',
			'label'		=> 'Header Image',
			'desc'		=> 'Upload a header image. This will disable header title/logo and description.',
			'type'		=> 'upload',
			'section'	=> 'header'
		),
		// Footer: Style
		array(
			'id'		=> 'footer-style',
			'label'		=> 'Style for footer',
			'desc'		=> 'Style for footer',
			'std'		=> 'style1',
			'type'		=> 'radio-image',
			'section'	=> 'footer',
			'choices'	=> array(
				array(
					'value'		=> 'style1',
					'label'		=> 'Style 1',
					'src'		=> get_template_directory_uri() . '/functions/images/footer-style1.png'
				),
			)
		),

		// Footer: Ads
		array(
			'id'		=> 'footer-ads',
			'label'		=> 'Footer Ads',
			'desc'		=> 'Footer widget ads area',
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'footer'
		),
		// Footer: Widget Columns
		array(
			'id'		=> 'footer-widgets',
			'label'		=> 'Footer Widget Columns',
			'desc'		=> 'Select columns to enable footer widgets<br /><i>Recommended number: 3</i>',
			'std'		=> '3',
			'type'		=> 'radio-image',
			'section'	=> 'footer',
			'class'		=> '',
			'choices'	=> array(
				array(
					'value'		=> '0',
					'label'		=> 'Disable',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> '1',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-1.png'
				),
				array(
					'value'		=> '2',
					'label'		=> '2 Columns',
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-2.png'
				),
				array(
					'value'		=> '3',
					'label'		=> '3 Columns',
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-3.png'
				),
				array(
					'value'		=> '4',
					'label'		=> '4 Columns',
					'src'		=> get_template_directory_uri() . '/functions/images/footer-widgets-4.png'
				)
			)
		),
		// Footer: Custom Logo
		array(
			'id'		=> 'footer-logo',
			'label'		=> 'Footer Logo',
			'desc'		=> 'Upload your custom logo image',
			'type'		=> 'upload',
			'section'	=> 'footer'
		),
		// Footer: Copyright
		array(
			'id'		=> 'copyright',
			'label'		=> 'Footer Copyright',
			'desc'		=> 'Replace the footer copyright text',
			'type'		=> 'text',
			'section'	=> 'footer'
		),
		// Footer: Footer text
		array(
			'id'		=> 'footer-text',
			'label'		=> 'Footer text',
			'desc'		=> '',
			'type'		=> 'textarea',
			'section'	=> 'footer'
		),
		// Footer: Credit
		array(
			'id'		=> 'credit',
			'label'		=> 'Footer Credit',
			'desc'		=> 'Footer credit text',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'footer'
		),
		// Layout : Global
		array(
			'id'		=> 'layout-global',
			'label'		=> 'Global Layout',
			'desc'		=> 'Other layouts will override this option if they are set',
			'std'		=> 'col-1c',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> '3 Column Middle',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> '3 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> '3 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Home
		array(
			'id'		=> 'layout-home',
			'label'		=> 'Home',
			'desc'		=> '[ <strong>is_home</strong> ] Posts homepage layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> '3 Column Middle',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> '3 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> '3 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Single
		array(
			'id'		=> 'layout-single',
			'label'		=> 'Single',
			'desc'		=> '[ <strong>is_single</strong> ] Single post layout - If a post has a set layout, it will override this.',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> '3 Column Middle',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> '3 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> '3 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Archive
		array(
			'id'		=> 'layout-archive',
			'label'		=> 'Archive',
			'desc'		=> '[ <strong>is_archive</strong> ] Category, date, tag and author archive layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> '3 Column Middle',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> '3 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> '3 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Archive - Category
		array(
			'id'		=> 'layout-archive-category',
			'label'		=> 'Archive &mdash; Category',
			'desc'		=> '[ <strong>is_category</strong> ] Category archive layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> '3 Column Middle',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> '3 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> '3 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Search
		array(
			'id'		=> 'layout-search',
			'label'		=> 'Search',
			'desc'		=> '[ <strong>is_search</strong> ] Search page layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> '3 Column Middle',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> '3 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> '3 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Error 404
		array(
			'id'		=> 'layout-404',
			'label'		=> 'Error 404',
			'desc'		=> '[ <strong>is_404</strong> ] Error 404 page layout',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> '3 Column Middle',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> '3 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> '3 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Default Page
		array(
			'id'		=> 'layout-page',
			'label'		=> 'Default Page',
			'desc'		=> '[ <strong>is_page</strong> ] Default page layout - If a page has a set layout, it will override this.',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> '3 Column Middle',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> '3 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> '3 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),
		// Layout : Portfolio
		array(
			'id'		=> 'layout-portfolio',
			'label'		=> 'Portfolio Page',
			'desc'		=> '[ <strong>is post_type == portfolio</strong> ] Portfolio Page layout - If a page has a set layout, it will override this.',
			'std'		=> 'inherit',
			'type'		=> 'radio-image',
			'section'	=> 'layout',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Global Layout',
					'src'		=> get_template_directory_uri() . '/functions/images/layout-off.png'
				),
				array(
					'value'		=> 'col-1c',
					'label'		=> '1 Column',
					'src'		=> get_template_directory_uri() . '/functions/images/col-1c.png'
				),
				array(
					'value'		=> 'col-2cl',
					'label'		=> '2 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cl.png'
				),
				array(
					'value'		=> 'col-2cr',
					'label'		=> '2 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-2cr.png'
				),
				array(
					'value'		=> 'col-3cm',
					'label'		=> '3 Column Middle',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cm.png'
				),
				array(
					'value'		=> 'col-3cl',
					'label'		=> '3 Column Left',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cl.png'
				),
				array(
					'value'		=> 'col-3cr',
					'label'		=> '3 Column Right',
					'src'		=> get_template_directory_uri() . '/functions/images/col-3cr.png'
				)
			)
		),

		// Sidebars: Create Areas
		array(
			'id'		=> 'sidebar-areas',
			'label'		=> 'Create Sidebars',
			'desc'		=> 'You must save changes for the new areas to appear below. <br /><i>Warning: Make sure each area has a unique ID.</i>',
			'type'		=> 'list-item',
			'section'	=> 'sidebars',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'id',
					'label'		=> 'Sidebar ID',
					'desc'		=> 'This ID must be unique, for example "sidebar-about"',
					'std'		=> 'sidebar-',
					'type'		=> 'text',
					'choices'	=> array()
				)
			)
		),
		// Sidebar 1 & 2
		array(
			'id'		=> 's1-home',
			'label'		=> 'Home',
			'desc'		=> '[ <strong>is_home</strong> ] Primary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-home',
			'label'		=> 'Home',
			'desc'		=> '[ <strong>is_home</strong> ] Secondary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-single',
			'label'		=> 'Single',
			'desc'		=> '[ <strong>is_single</strong> ] Primary - If a single post has a unique sidebar, it will override this.',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-single',
			'label'		=> 'Single',
			'desc'		=> '[ <strong>is_single</strong> ] Secondary - If a single post has a unique sidebar, it will override this.',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-archive',
			'label'		=> 'Archive',
			'desc'		=> '[ <strong>is_archive</strong> ] Primary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-archive',
			'label'		=> 'Archive',
			'desc'		=> '[ <strong>is_archive</strong> ] Secondary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-archive-category',
			'label'		=> 'Archive &mdash; Category',
			'desc'		=> '[ <strong>is_category</strong> ] Primary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-archive-category',
			'label'		=> 'Archive &mdash; Category',
			'desc'		=> '[ <strong>is_category</strong> ] Secondary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-search',
			'label'		=> 'Search',
			'desc'		=> '[ <strong>is_search</strong> ] Primary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-search',
			'label'		=> 'Search',
			'desc'		=> '[ <strong>is_search</strong> ] Secondary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-404',
			'label'		=> 'Error 404',
			'desc'		=> '[ <strong>is_404</strong> ] Primary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-404',
			'label'		=> 'Error 404',
			'desc'		=> '[ <strong>is_404</strong> ] Secondary',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's1-page',
			'label'		=> 'Default Page',
			'desc'		=> '[ <strong>is_page</strong> ] Primary - If a page has a unique sidebar, it will override this.',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars'
		),
		array(
			'id'		=> 's2-page',
			'label'		=> 'Default Page',
			'desc'		=> '[ <strong>is_page</strong> ] Secondary - If a page has a unique sidebar, it will override this.',
			'type'		=> 'sidebar-select',
			'section'	=> 'sidebars',
		),

		// Social Links : List
		array(
			'id'		=> 'social-links',
			'label'		=> 'Social Links',
			'desc'		=> 'Create and organize your social links',
			'type'		=> 'list-item',
			'section'	=> 'social-links',
			'choices'	=> array(),
			'settings'	=> array(
				array(
					'id'		=> 'social-icon',
					'label'		=> 'Icon Name',
					'desc'		=> 'Font Awesome icon names [<a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank"><strong>View all</strong>]</a>  ',
					'std'		=> 'fa-',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-link',
					'label'		=> 'Link',
					'desc'		=> 'Enter the full url for your icon button',
					'std'		=> 'http://',
					'type'		=> 'text',
					'choices'	=> array()
				),
				array(
					'id'		=> 'social-color',
					'label'		=> 'Icon Color',
					'desc'		=> 'Set a unique color for your icon (optional)',
					'std'		=> '',
					'type'		=> 'colorpicker',
				),
				array(
					'id'		=> 'social-target',
					'label'		=> 'Link Options',
					'desc'		=> '',
					'std'		=> '',
					'type'		=> 'checkbox',
					'choices'	=> array(
						array(
							'value' => '_blank',
							'label' => 'Open in new window'
						)
					)
				)
			)
		),

		// Styling: Enable
		array(
			'id'		=> 'dynamic-styles',
			'label'		=> 'Dynamic Styles',
			'desc'		=> 'Turn on to use the styling options below',
			'std'		=> 'on',
			'type'		=> 'on-off',
			'section'	=> 'styling'
		),
		// Styling: Container Width
		array(
			'id'			=> 'container-width',
			'label'			=> 'Website Max-width',
			'desc'			=> 'Max-width of the container. If you use 2 sidebars, your container should be at least 1200px.<br /><i>Note: For 720px content (default) use <strong>1380px</strong> for 2 sidebars and <strong>1120px</strong> for 1 sidebar. If you use a combination of both, try something inbetween.</i>',
			'std'			=> '1200',
			'type'			=> 'numeric-slider',
			'section'		=> 'styling',
			'min_max_step'	=> '990,1600,10'
		),
		// Styling: Featured Image
		array(
			'id'		=> 'featured-image',
			'label'		=> 'Featured Image',
			'desc'		=> 'Show featured image on single posts',
			'type'		=> 'on-off',
			'section'	=> 'styling',
			'std'		=> 'on'
		),
		// Styling: Boxed Layout
		array(
			'id'		=> 'boxed',
			'label'		=> 'Boxed Layout',
			'desc'		=> 'Use a boxed layout',
			'std'		=> 'off',
			'type'		=> 'on-off',
			'section'	=> 'styling'
		),
		// Styling: Image Border Radius
		array(
			'id'			=> 'image-border-radius',
			'label'			=> 'Image Border Radius',
			'desc'			=> 'Give your thumbnails and layout images rounded corners',
			'std'			=> '0',
			'type'			=> 'numeric-slider',
			'section'		=> 'styling',
			'min_max_step'	=> '0,15,1'
		),
		// Styling: Body Background
		array(
			'id'		=> 'body-background',
			'label'		=> 'Body Background',
			'desc'		=> 'Set background color and/or upload your own background image',
			'type'		=> 'background',
			'std'		=> '',
			'section'	=> 'styling'
		),

		// Fonts:
		array(
			'id'		=> 'font-head',
			'label'		=> 'Font Head',
			'desc'		=> 'Select font for the theme',
			'type'		=> 'select',
			'std'		=> 'play',
			'section'	=> 'fonts',
			'choices'	=> (array)asdb_fgonts('type=adm'),
		),

		array(
			'id'		=> 'font-meta',
			'label'		=> 'Font Meta',
			'desc'		=> 'Select font for the theme',
			'type'		=> 'select',
			'std'		=> 'cuprum',
			'section'	=> 'fonts',
			'choices'	=> (array)asdb_fgonts('type=adm'),
		),
		array(
			'id'		=> 'font-body',
			'label'		=> 'Font Body',
			'desc'		=> 'Select font for the theme',
			'type'		=> 'select',
			'std'		=> 'open-sans',
			'section'	=> 'fonts',
			'choices'	=> (array)asdb_fgonts('type=adm'),
		),
/*
      array(
        'id'          => 'body_google_fonts',
        'label'       => __( 'Google Fonts', 'asdbbase' ),
        'desc'        => sprintf( __( 'The Google Fonts option type will dynamically enqueue any number of Google Web Fonts into the document %1$s. As well, once the option has been saved each font family will automatically be inserted into the %2$s array for the Typography option type. You can further modify the font stack by using the %3$s filter, which is passed the %4$s, %5$s, and %6$s parameters. The %6$s parameter is being passed from %7$s, so it will be the ID of a Typography option type. This will allow you to add additional web safe fonts to individual font families on an as-need basis.', 'theme-text-domain' ), '<code>HEAD</code>', '<code>font-family</code>', '<code>ot_google_font_stack</code>', '<code>$font_stack</code>', '<code>$family</code>', '<code>$field_id</code>', '<code>ot_recognized_font_families</code>' ),
        'std'         => array(
          array(
            'family'    => 'opensans',
            'variants'  => array( '300', '300italic', 'regular', 'italic', '600', '600italic' ),
            'subsets'   => array( 'latin', 'cyrillic' ),
          ),
        ),
        'type'        => 'google-fonts',
        'section'     => 'fonts',
        'operator'    => 'and',
      ),

      array(
        'id'          => 'title_google_fonts',
        'label'       => __( 'Google Fonts', 'asdbbase' ),
        'desc'        => sprintf( __( 'The Google Fonts option type will dynamically enqueue any number of Google Web Fonts into the document %1$s. As well, once the option has been saved each font family will automatically be inserted into the %2$s array for the Typography option type. You can further modify the font stack by using the %3$s filter, which is passed the %4$s, %5$s, and %6$s parameters. The %6$s parameter is being passed from %7$s, so it will be the ID of a Typography option type. This will allow you to add additional web safe fonts to individual font families on an as-need basis.', 'theme-text-domain' ), '<code>HEAD</code>', '<code>font-family</code>', '<code>ot_google_font_stack</code>', '<code>$font_stack</code>', '<code>$family</code>', '<code>$field_id</code>', '<code>ot_recognized_font_families</code>' ),
        'std'         => array(
          array(
            'family'    => 'opensans',
            'variants'  => array( '300', '300italic', 'regular', 'italic', '600', '600italic' ),
            'subsets'   => array( 'latin', 'cyrillic' ),
          ),
        ),
        'type'        => 'google-fonts',
        'section'     => 'fonts',
        'operator'    => 'and',
      ),

      array(
        'id'          => 'meta_google_fonts',
        'label'       => __( 'Google Fonts', 'asdbbase' ),
        'desc'        => sprintf( __( 'The Google Fonts option type will dynamically enqueue any number of Google Web Fonts into the document %1$s. As well, once the option has been saved each font family will automatically be inserted into the %2$s array for the Typography option type. You can further modify the font stack by using the %3$s filter, which is passed the %4$s, %5$s, and %6$s parameters. The %6$s parameter is being passed from %7$s, so it will be the ID of a Typography option type. This will allow you to add additional web safe fonts to individual font families on an as-need basis.', 'theme-text-domain' ), '<code>HEAD</code>', '<code>font-family</code>', '<code>ot_google_font_stack</code>', '<code>$font_stack</code>', '<code>$family</code>', '<code>$field_id</code>', '<code>ot_recognized_font_families</code>' ),
        'std'         => array(
          array(
            'family'    => 'opensans',
            'variants'  => array( '300', '300italic', 'regular', 'italic', '600', '600italic' ),
            'subsets'   => array( 'latin', 'cyrillic' ),
          ),
        ),
        'type'        => 'google-fonts',
        'section'     => 'fonts',
        'operator'    => 'and',
      ),

*/
		// Site Structure
		array(
			'id'		=> 'site-gallery',
			'label'		=> 'Gallery',
			'desc'		=> 'Включить галлереи',
			'type'		=> 'on-off',
			'std'		=> 'off',
			'section'	=> 'site'
		),
		array(
			'id'		=> 'site-features',
			'label'		=> 'Features',
			'desc'		=> 'Включить Блоки',
			'type'		=> 'on-off',
			'std'		=> 'off',
			'section'	=> 'site'
		),
		array(
			'id'		=> 'site-portfolio',
			'label'		=> 'Portfolio',
			'desc'		=> 'Включить портфолио',
			'type'		=> 'on-off',
			'std'		=> 'off',
			'section'	=> 'site'
		),
		array(
			'id'		=> 'site-testimonials',
			'label'		=> 'Testimonials',
			'desc'		=> 'Включить отзывы',
			'type'		=> 'on-off',
			'std'		=> 'off',
			'section'	=> 'site'
		),
		array(
			'id'		=> 'site-services',
			'label'		=> 'Service',
			'desc'		=> 'Включить услуги',
			'type'		=> 'on-off',
			'std'		=> 'off',
			'section'	=> 'site'
		),
		array(
			'id'		=> 'site-partners',
			'label'		=> 'Clients / Partners',
			'desc'		=> 'Включить партнеры/клиенты',
			'type'		=> 'on-off',
			'std'		=> 'off',
			'rows'        => '5',
			'section'	=> 'site'
		),
		array(
			'id'		=> 'site-team',
			'label'		=> 'Our Team',
			'desc'		=> 'Включить команду',
			'type'		=> 'on-off',
			'std'		=> 'off',
			'rows'        => '1',
			'section'	=> 'site'
		),
	)
);

/*  Settings are not the same? Update the DB
/* ------------------------------------ */
	if ( $saved_settings !== $custom_settings ) {
		update_option( 'option_tree_settings', $custom_settings );
	}
}

if ( ! function_exists('asdb_fgonts') ) {

function asdb_fgonts( $args = '' ) {
		parse_str($args, $i);
		$type = isset($i['type'])	? trim($i['type'])	: 'none';
		$opt  = isset($i['opt'])	? trim($i['opt'])	: 'none';
		$font = isset($i['font'])	? trim($i['font'])	: 'none';
		$out = '';
$gfonts = array(
    'Arial'					=> array('family' => 'Arial','weight' => '400,600'),
    'Georgia'				=> array('family' => 'Georgia','weight' => '400,600'),
    'Verdana'				=> array('family' => 'Verdana','weight' => '400,600'),
    'Tahoma'				=> array('family' => 'Tahoma','weight' => '400,600'),
	'andika'				=> array('family' => 'Andika','weight' => '400'),
	'anonymous-pro'			=> array('family' => 'Anonymous Pro','weight' => '400,700,400italic,700italic'),
	'arimo'					=> array('family' => 'Arimo','weight' => '400,700,400italic,700italic'),
	'bad-script'			=> array('family' => 'Bad Script','weight' => '400'),
	'comfortaa'				=> array('family' => 'Comfortaa','weight' => '300,400,700'),
	'cousine'				=> array('family' => 'Cousine','weight' => '400,700,400italic,700italic'),
	'cuprum'				=> array('family' => 'Cuprum','weight' => '400,700'),
	'didact-gothic'			=> array('family' => 'Didact Gothic','weight' => '400'),
	'eb-garamond'			=> array('family' => 'EB Garamond','weight' => '400'),
	'exo-2'					=> array('family' => 'Exo 2','weight' => '100,200,300,400,500,600,700,800,900,100italic,200italic,300italic,400italic,500italic,600italic,700italic,800italic,900italic'),
	'fira-mono'				=> array('family' => 'Fira Mono','weight' => '400,700'),
	'fira-sans'				=> array('family' => 'Fira Sans','weight' => '300,400,500,700,300italic,400italic,500italic,700italic'),
	'forum'					=> array('family' => 'Forum','weight' => '400'),
	'istok-web'				=> array('family' => 'Istok Web','weight' => '400,700,400italic,700italic'),
	'jura'					=> array('family' => 'Jura','weight' => '300,400,500,600'),
	'kelly-slab'			=> array('family' => 'Kelly Slab','weight' => '400'),
	'kurale'				=> array('family' => 'Kurale','weight' => '400'),
	'ledger'				=> array('family' => 'Ledger','weight' => '400'),
	'lobster'				=> array('family' => 'Lobster','weight' => '400'),
	'lora'					=> array('family' => 'Lora','weight' => '400,700,400italic,700italic'),
	'marck-script'			=> array('family' => 'Marck Script','weight' => '400'),
	'marmelad'				=> array('family' => 'Marmelad','weight' => '400'),
	'neucha'				=> array('family' => 'Neucha','weight' => '400'),
	'noto-sans'				=> array('family' => 'Noto Sans','weight' => '400,700,400italic,700italic'),
	'noto-serif'			=> array('family' => 'Noto Serif','weight' => '400,700,400italic,700italic'),
	'open-sans'				=> array('family' => 'Open Sans','weight' => '300,400,600,700,800,300italic,400italic,600italic,700italic,800italic'),
	'open-sans-condensed'	=> array('family' => 'Open Sans Condensed','weight' => '300,700,300italic'),
	'oranienbaum'			=> array('family' => 'Oranienbaum','weight' => '400'),
	'pt-mono'				=> array('family' => 'PT Mono','weight' => '400'),
	'pt-sans'				=> array('family' => 'PT Sans','weight' => '400,700'),
	'pt-sans-caption'		=> array('family' => 'PT Sans Caption','weight' => '400,700'),
	'pt-sans-narrow'		=> array('family' => 'PT Sans Narrow','weight' => '400,700'),
	'pt-serif'				=> array('family' => 'PT Serif','weight' => '400,700,400italic,700italic'),
	'pt-serif-caption'		=> array('family' => 'PT Serif Caption','weight' => '400,400italic'),
	'philosopher'			=> array('family' => 'Philosopher','weight' => '400,700,400italic,700italic'),
	'play'					=> array('family' => 'Play','weight' => '400,700'),
	'playfair-display'		=> array('family' => 'Playfair Display','weight' => '400,700,900,400italic,700italic,900italic'),
	'playfair-display-sc'	=> array('family' => 'Playfair Display SC','weight' => '400,700,900,400italic,700italic,900italic'),
	'poiret-one'			=> array('family' => 'Poiret One','weight' => '400'),
	'press-start-2p'		=> array('family' => 'Press Start 2P','weight' => '400'),
	'prosto-one'			=> array('family' => 'Prosto One','weight' => '400'),
	'roboto'				=> array('family' => 'Roboto','weight' => '100,300,400,500,700,900,100italic,300italic,400italic,500italic,700italic,900italic'),
	'roboto-condensed'		=> array('family' => 'Roboto Condensed','weight' => '300,400,700,300italic,400italic,700italic'),
	'roboto-mono'			=> array('family' => 'Roboto Mono','weight' => '100,300,400,700,100italic,300italic,400italic,700italic'),
	'roboto-slab'			=> array('family' => 'Roboto Slab','weight' => '100,300,400,700'),
	'rubik'					=> array('family' => 'Rubik','weight' => '300,400,500,700,900,300italic,400italic,500italic,700italic,900italic'),
	'rubik-mono-one'		=> array('family' => 'Rubik Mono One','weight' => '400'),
	'rubik-one'				=> array('family' => 'Rubik One','weight' => '400'),
	'ruslan-display'		=> array('family' => 'Ruslan Display','weight' => '400'),
	'russo-one'				=> array('family' => 'Russo One','weight' => '400'),
	'scada'					=> array('family' => 'Scada','weight' => '400,700,400italic,700italic'),
	'seymour-one'			=> array('family' => 'Seymour One','weight' => '400'),
	'stalinist-one'			=> array('family' => 'Stalinist One','weight' => '400'),
	'tenor-sans'			=> array('family' => 'Tenor Sans','weight' => '400'),
	'tinos'					=> array('family' => 'Tinos','weight' => '400,700,400italic,700italic'),
	'ubuntu'				=> array('family' => 'Ubuntu','weight' => '300,400,500,700,300italic,400italic,500italic,700italic'),
	'ubuntu-condensed'		=> array('family' => 'Ubuntu Condensed','weight' => '400'),
	'ubuntu-mono'			=> array('family' => 'Ubuntu Mono','weight' => '400,700,400italic,700italic'),
	'underdog'				=> array('family' => 'Underdog','weight' => '400'),
	'yeseva-one'			=> array('family' => 'Yeseva One','weight' => '400'),
);
		if ($type == 'adm' ) {
		foreach ($gfonts as $key => $font ) {$out[] = array('value' => $key, 'label' => $font['family'] );}
		} else {
		if ($opt == 'font-family' ) {$out = $gfonts[ $font ]['family'];}
		if (($gfonts[ $font ]['family']=='Arial')||($gfonts[ $font ]['family']=='Georgia')||($gfonts[ $font ]['family']=='Verdana')||($gfonts[ $font ]['family']=='Tahoma')) {$out = $gfonts[ $font ]['family'];}
		elseif ( ($opt == 'none') && ($font != 'none') ) { $out = '<link rel="stylesheet" href="//fonts.googleapis.com/css?family=' . str_replace(' ','+', $gfonts[ $font ]['family'] ) . ':' . $gfonts[ $font ]['weight'] . '&subset=latin,cyrillic" type="text/css" media="all" />'. "\n";}

		}
	return $out;
	}
}
