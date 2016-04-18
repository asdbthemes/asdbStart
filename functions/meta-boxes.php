<?php

/*  Initialize the meta boxes.
/* ------------------------------------ */
add_action( 'admin_init', '_custom_meta_boxes' );

function _custom_meta_boxes() {

/*  Custom meta boxes
/* ------------------------------------ */

$testimohial_options = array(
	'id'          => 'testimonial-options',
	'title'       => 'Testimonial Options',
	'desc'        => '',
	'pages'       => array( 'testimonials' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Heading',
			'id'		=> '_heading',
			'type'		=> 'text'
		),
		array(
			'label'		=> 'Subheading',
			'id'		=> '_subheading',
			'type'		=> 'text'
		),
		array(
			'label'		=> 'Testimonial',
			'id'		=> 'testimonial_description',
			'type'		=> 'textarea'
		),
		array(
			'id'		=> 'section-background',
			'label'		=> 'Section Background',
			'desc'		=> 'Set background color and/or upload your own background image',
			'type'		=> 'background',
			'std'		=> '',
		),
	),
);

$features_options = array(
	'id'          => 'features-options',
	'title'       => 'Features Options',
	'desc'        => '',
	'pages'       => array( 'features' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'id'		=> 'features-show-title',
			'label'		=> 'Show Title',
			'std'		=> 'off',
			'type'		=> 'on-off',
		),
		array(
			'id'		=> 'features-show-menu',
			'label'		=> 'Show in Menu',
			'std'		=> 'on',
			'type'		=> 'on-off',
		),
		array(
			'id'		=> 'features-type',
			'label'		=> 'Section Type',
			'std'		=> 'default',
			'type'		=> 'select',
			'choices'	=> array(
				array(
					'value' => 'default',
					'label' => 'Default'
				),
				array(
					'value' => 'fullwidth',
					'label' => 'Full Width'
				),
				array(
					'value' => 'parallax',
					'label' => 'Parallax'
				)
			)
		),
		array(
			'id'		=> 'section-background',
			'label'		=> 'Section Background',
			'desc'		=> 'Set background color and/or upload your own background image',
			'type'		=> 'background',
			'std'		=> '',
		),
	),
);

$page_options = array(
	'id'          => 'page-options',
	'title'       => 'Page Options',
	'desc'        => '',
	'pages'       => array( 'page','portfolio' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Page Title',
			'id'		=> '_pagetitle',
			'type'		=> 'on-off',
			'desc'		=> 'Display Page Title+Breadcrumbs',
			'std'		=> 'on',
		),
		array(
			'label'		=> 'Heading',
			'id'		=> '_heading',
			'type'		=> 'text'
		),
		array(
			'label'		=> 'Subheading',
			'id'		=> '_subheading',
			'type'		=> 'text'
		),
		array(
			'label'		=> 'Parallax Title',
			'id'		=> '_parallax',
			'type'		=> 'on-off',
			'desc'		=> '',
			'std'		=> 'off',
		),
		array(
		    'id'          => '_parallax-img',
    		'label'       => __( 'Image for Parallax', 'asdbbase' ),
    		'desc'        => __( 'Select Image for Parallax', 'asdbbase' ),
    		'type'        => 'upload',
    		'condition'   => '_parallax:is(on)',
		),

		array(
			'label'		=> 'Hero Title',
			'id'		=> '_hero',
			'type'		=> 'on-off',
			'desc'		=> '',
			'std'		=> 'off',
		),
		array(
		    'id'          => '_hero-img',
    		'label'       => __( 'Image for Hero', 'asdbbase' ),
    		'desc'        => __( 'Select Image for Hero', 'asdbbase' ),
    		'type'        => 'upload',
    		'condition'   => '_hero:is(on)',
		),
		array(
			'id'		=> 'page-background',
			'label'		=> 'Page Background',
			'desc'		=> 'Set background color and/or upload your own background image',
			'type'		=> 'background',
			'std'		=> '',
		),
		array(
			'label'		=> 'Primary Sidebar',
			'id'		=> '_sidebar_primary',
			'type'		=> 'sidebar-select',
			'desc'		=> ''
		),
		array(
			'label'		=> 'Secondary Sidebar',
			'id'		=> '_sidebar_secondary',
			'type'		=> 'sidebar-select',
			'desc'		=> ''
		),
		array(
			'label'		=> 'Layout',
			'id'		=> '_layout',
			'type'		=> 'radio-image',
			'desc'		=> '',
			'std'		=> 'inherit',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Layout',
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
	)
);

$portfolio_options = array(
	'id'          => 'portfolio-options',
	'title'       => 'Portfolio Options',
	'desc'        => '',
	'pages'       => array( 'portfolio' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Client Name',
			'id'		=> '_portfolio-clients',
			'type'		=> 'text',
		),
		array(
			'label'		=> 'Project URL',
			'id'		=> '_portfolio_url',
			'type'		=> 'text'
		),
		array(
			'label'		=> 'Project Date',
			'id'		=> '_portfolio-date',
			'type'		=> 'date-picker'
		),
		array(
			'label'		=> 'Project Gallery',
			'id'		=> '_portfolio-gallery',
			'type'		=> 'gallery'
		),

	)
);

$section_options = array(
	'id'          => 'section-options',
	'title'       => 'Section Options',
	'desc'        => '',
	'pages'       => array( 'page' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Featured Post Slider',
			'id'		=> 'featured-slider',
			'type'		=> 'on-off',
			'desc'		=> 'Display slider for Page',
			'std'		=> 'off',
		),
		array(
		    'id'          => 'featured-category',
    		'desc'        => __( 'Select Category for Featured Posts Slider', 'asdbbase' ),
    		'type'        => 'category-select',
			'condition'   => 'featured-slider:is(on)',
		),
		array(
			'id'		=> 'featured-style',
			'type'		=> 'select',
			'std'		=> 'style1',
			'condition'   => 'featured-slider:is(on)',
			'choices'	=> array(
				array(
					'value'		=> 'style1',
					'label'		=> 'Style 1',
				),
				array(
					'value'		=> 'style2',
					'label'		=> 'Style 2',
				),
				array(
					'value'		=> 'style3',
					'label'		=> 'Style 3',
				),
			),
		),
		array(
			'label'		=> 'Showcase',
			'id'		=> '_service',
			'type'		=> 'on-off',
			'desc'		=> 'Display Services',
			'std'		=> 'off',
		),
		array(
			'id'		=> '_service-category',
    		'desc'        => __( 'Select Showcase Category ', 'asdbbase' ),
    		'type'        => 'taxonomy-select',
    		'taxonomy'   => 'services_category',
			'condition'   => '_service:is(on)',
		),
		array(
			'label'		=> 'Portfolio',
			'id'		=> '_portfolio',
			'type'		=> 'on-off',
			'desc'		=> 'Display Portfolio',
			'std'		=> 'off',
		),
		array(
			'id'		=> '_portfolio-category',
    		'desc'        => __( 'Select Portfolio Category', 'asdbbase' ),
    		'type'        => 'taxonomy-select',
    		'taxonomy'   => 'portfolio_category',
			'condition'   => '_portfolio:is(on)',
		),
		array(
			'label'		=> 'Recent Works',
			'id'		=> '_rfolio',
    		'desc'        => __( 'Recent Work from Latest Portfolio', 'asdbbase' ),
    		'type'        => 'on-off',
    		'std'		=> 'off',
		),
		array(
			'id'		=> '_rfolio_subtitle',
    		'desc'        => __( 'SubTitle for Recent Work', 'asdbbase' ),
    		'type'        => 'text',
    		'std'		=> '',
			'condition'   => '_rfolio:is(on)',
		),
		array(
			'id'		=> '_rfolio_title',
    		'desc'        => __( 'Title for Recent Work', 'asdbbase' ),
    		'type'        => 'text',
    		'std'		=> __( 'Last Works', 'asdbbase' ),
			'condition'   => '_rfolio:is(on)',
		),
		array(
			'id'		=> '_rfolio-category',
    		'desc'        => __( 'Select Portfolio Category <br> <strong>if this select</strong> filter by [category] is turned off', 'asdbbase' ),
    		'type'        => 'taxonomy-select',
    		'taxonomy'   => 'portfolio_category',
			'condition'   => '_rfolio:is(on)',
		),
		array(
    		'label'       => __( 'Testimonials', 'asdbbase' ),
			'id'		=> '_testimonials',
    		'type'        => 'on-off',
    		'std'		=> 'off',
		),
		array(
		    'id'          => '_testimonials-category',
    		'desc'        => __( 'Select testimonial for page', 'asdbbase' ),
    		'type'        => 'taxonomy-select',
    		'taxonomy'   => 'testimonials_category',
			'condition'   => '_testimonials:is(on)',
		),
		array(
    		'label'       => __( 'Actions', 'asdbbase' ),
			'id'		=> '_actions',
    		'type'        => 'on-off',
    		'std'		=> 'off',
		),
		array(
		    'id'          => '_actions-block',
    		'desc'        => __( 'Select actions for page', 'asdbbase' ),
    		'type'        => 'custom-post-type-select',
    		'post_type'   => 'features',
			'condition'   => '_actions:is(on)',
		),
		array(
    		'label'       => __( 'Post carusel', 'asdbbase' ),
			'id'		=> '_carousel',
    		'type'        => 'on-off',
    		'std'		=> 'off',
		),
		array(
		    'id'          => '_carousel-category',
    		'desc'        => __( 'Select Category for Carusel', 'asdbbase' ),
    		'type'        => 'category-select',
			'condition'   => '_carousel:is(on)',
		),
		array(
			'label'		=> 'Related link Block',
			'id'		=> '_related_type',
			'type'		=> 'radio',
			'desc'		=> __( 'Show related for Tags or Individusl Bloks', 'asdbbase' ),
			'std'		=> '0',
			'choices'	=> array(
				array(
					'value'		=> '0',
					'label'		=> __( 'Dont Show', 'asdbbase' ),
				),
				array(
					'value'		=> '1',
					'label'		=> __( 'Tegs', 'asdbbase' ),
				),
				array(
					'value'		=> '2',
					'label'		=> __( 'Individual Block', 'asdbbase' ),
				),
			),
		),
		array(
		    'id'          => 'related_tag',
    		'label'       => __( 'Select Таg for related', 'asdbbase' ),
    		'desc'        => __( 'Select Tag for related', 'asdbbase' ),
    		'type'        => 'tag-select',
    		'condition'   => '_related_type:is(1)',
		),
		array(
		    'id'          => 'related_block',
    		'label'       => __( 'Select Block of related links', 'asdbbase' ),
    		'desc'        => __( 'Select Block of related links', 'asdbbase' ),
    		'type'        => 'custom-post-type-select',
    		'rows'		  => 8,
    		'condition'   => '_related_type:is(2)',
    		'post_type'   => 'features',
		),
		array(
			'id'		=> '_numlinks',
			'type'		=> 'select',
			'desc'		=> __( 'Number Links ', 'asdbbase' ),
			'std'		=> '4',
			'choices'	=> array(
				array(
					'value'		=> '2',
					'label'		=> '2',
				),
				array(
					'value'		=> '4',
					'label'		=> '4',
				),
				array(
					'value'		=> '6',
					'label'		=> '6',
				),
			),
		),
	)
);


$post_options = array(
	'id'          => 'post-options',
	'title'       => 'Post Options',
	'desc'        => '',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'id'		=> '_thumb',
			'label'		=> 'Use Thumbnail image for post',
			'desc'		=> '',
			'std'		=> 'on',
			'type'		=> 'on-off',
		),
		array(
			'label'		=> 'Parallax Title',
			'id'		=> '_parallax',
			'type'		=> 'on-off',
			'desc'		=> '',
			'std'		=> 'off',
		),
		array(
		    'id'          => '_parallax-img',
    		'label'       => __( 'Image for Parallax', 'asdbbase' ),
    		'desc'        => __( 'Select Image for Parallax', 'asdbbase' ),
    		'type'        => 'upload',
    		'condition'   => '_parallax:is(on)',
		),

		array(
			'label'		=> 'Hero Title',
			'id'		=> '_hero',
			'type'		=> 'on-off',
			'desc'		=> '',
			'std'		=> 'off',
		),
		array(
		    'id'          => '_hero-img',
    		'label'       => __( 'Image for Hero', 'asdbbase' ),
    		'desc'        => __( 'Select Image for Hero', 'asdbbase' ),
    		'type'        => 'upload',
    		'condition'   => '_hero:is(on)',
		),

		array(
			'label'		=> 'Primary Sidebar',
			'id'		=> '_sidebar_primary',
			'type'		=> 'sidebar-select',
			'desc'		=> 'Overrides default'
		),
		array(
			'label'		=> 'Secondary Sidebar',
			'id'		=> '_sidebar_secondary',
			'type'		=> 'sidebar-select',
			'desc'		=> 'Overrides default'
		),
		array(
			'label'		=> 'Related link Block',
			'id'		=> '_related_type',
			'type'		=> 'radio',
			'desc'		=> 'Показать релевантные материалы по тэгам или по индивидуальному выбору',
			'std'		=> '0',
			'choices'	=> array(
				array(
					'value'		=> '0',
					'label'		=> 'Не показывать',
				),
				array(
					'value'		=> '1',
					'label'		=> 'По Тэгу',
				),
				array(
					'value'		=> '2',
					'label'		=> 'Индивидуальный Блок',
				),
			),
		),
		array(
		    'id'          => 'related_tag',
    		'label'       => __( 'Select Таg for related', 'asdbbase' ),
    		'desc'        => __( 'Select Tag for related', 'asdbbase' ),
    		'type'        => 'tag-select',
    		'condition'   => '_related_type:is(1)',
		),
		array(
		    'id'          => 'related_block',
    		'label'       => __( 'Select Block of related links', 'asdbbase' ),
    		'desc'        => __( 'Select Block of related links', 'asdbbase' ),
    		'type'        => 'custom-post-type-select',
    		'rows'		  => 8,
    		'condition'   => '_related_type:is(2)',
    		'post_type'   => 'features',
		),
		array(
			'label'		=> 'Количество ссылок',
			'id'		=> '_numlinks',
			'type'		=> 'select',
			'desc'		=> '',
			'std'		=> '4',
			'choices'	=> array(
				array(
					'value'		=> '2',
					'label'		=> '2',
				),
				array(
					'value'		=> '4',
					'label'		=> '4',
				),
				array(
					'value'		=> '6',
					'label'		=> '6',
				),
			),
		),
		array(
			'label'		=> 'Layout',
			'id'		=> '_layout',
			'type'		=> 'radio-image',
			'desc'		=> 'Overrides the default layout option',
			'std'		=> 'inherit',
			'choices'	=> array(
				array(
					'value'		=> 'inherit',
					'label'		=> 'Inherit Layout',
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
		)
	)
);

$post_format_audio = array(
	'id'          => 'format-audio',
	'title'       => 'Format: Audio',
	'desc'        => 'These settings enable you to embed audio into your posts. You must provide both .mp3 and .ogg/.oga file formats in order for self hosted audio to function accross all browsers.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'MP3 File URL',
			'id'		=> '_audio_mp3_url',
			'type'		=> 'upload',
			'desc'		=> 'The URL to the .mp3 or .m4a audio file'
		),
		array(
			'label'		=> 'OGA File URL',
			'id'		=> '_audio_ogg_url',
			'type'		=> 'upload',
			'desc'		=> 'The URL to the .oga, .ogg audio file'
		)
	)
);
$post_format_gallery = array(
	'id'          => 'format-gallery',
	'title'       => 'Format: Gallery',
	'desc'        => '<a title="Add Media" data-editor="content" class="button insert-media add_media" id="insert-media-button" href="#">Add Media</a> <br /><br />
						To create a gallery, upload your images and then select "<strong>Uploaded to this post</strong>" from the dropdown (in the media popup) to see images attached to this post. You can drag to re-order or delete them there. <br /><br /><i>Note: Do not click the "Insert into post" button. Only use the "Insert Media" section of the upload popup, not "Create Gallery" which is for standard post galleries.</i>',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array()
);
$post_format_chat = array(
	'id'          => 'format-chat',
	'title'       => 'Format: Chat',
	'desc'        => 'Input chat dialogue.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Chat Text',
			'id'		=> '_chat',
			'type'		=> 'textarea',
			'rows'		=> '2'
		)
	)
);
$post_format_link = array(
	'id'          => 'format-link',
	'title'       => 'Format: Link',
	'desc'        => 'Input your link.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Link Title',
			'id'		=> '_link_title',
			'type'		=> 'text'
		),
		array(
			'label'		=> 'Link URL',
			'id'		=> '_link_url',
			'type'		=> 'text'
		)
	)
);
$post_format_quote = array(
	'id'          => 'format-quote',
	'title'       => 'Format: Quote',
	'desc'        => 'Input your quote.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Quote',
			'id'		=> '_quote',
			'type'		=> 'textarea',
			'rows'		=> '2'
		),
		array(
			'label'		=> 'Quote Author',
			'id'		=> '_quote_author',
			'type'		=> 'text'
		)
	)
);
$post_format_video = array(
	'id'          => 'format-video',
	'title'       => 'Format: Video',
	'desc'        => 'These settings enable you to embed videos into your posts.',
	'pages'       => array( 'post' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
		array(
			'label'		=> 'Video URL',
			'id'		=> '_video_url',
			'type'		=> 'text',
			'desc'		=> ''
		)
	)
);

$galleries_options = array(
	'id'          => 'galleries-options',
	'title'       => 'Galleries Options',
	'desc'        => '',
	'pages'       => array( 'galleries' ),
	'context'     => 'normal',
	'priority'    => 'high',
	'fields'      => array(
	array(
		'id'		=> 'slide-background',
		'label'		=> 'Slide Background',
		'desc'		=> 'Set background color and/or upload your own background image',
		'type'		=> 'background',
		'std'		=> '',
	),
	array(
		'id'		=> 'overlay',
		'label'		=> 'Use overlay for Sliders background images',
		'desc'		=> '',
		'std'		=> 'off',
		'type'		=> 'on-off',
	),
    array(
        'label'                     => __('Button Text', 'asdbbase'),
        'desc'                      => __('Show Slider Button and Button Text', 'asdbbase'),
        'id'                        => 'slider_button_text',
        'type'                      => 'text'
        ),
    array(
        'label'                     => __('Button URL', 'asdbbase'),
        'desc'                      => __('Slider URL link.', 'asdbbase'),
        'id'                        => 'slider_button_url',
        'type'                      => 'text'
        ),
    array(
        'label'                     => __('Boxed Style', 'asdbbase'),
        'desc'                      => __('Show boxed Style.', 'asdbbase'),
        'id'                        => 'slider_boxed',
        'type'                      => 'select',
		'choices'	=> array(
            array(
                'value'=>'no',
                'label'=>__('No', 'asdbbase')
                ),
            array(
                'value'=>'yes',
                'label'=>__('Yes', 'asdbbase')
                )
            )
        ),
    array(
        'label'                     => __('Position',       'asdbbase'),
        'desc'                      => __('Show slider Position.', 'asdbbase'),
        'id'                        => 'slider_position',
        'type'                      => 'select',
		'choices'	=> array(
            array(
                'value'=>'left',
                'label'=>__('Left', 'asdbbase')
                ),

            array(
                'value'=>'center',
                'label'=>__('Center', 'asdbbase')
                ),

            array(
                'value'=>'right',
                'label'=>__('Right', 'asdbbase')
                ),
            )
        ),
    array(
        'label'                     => __('Video Type', 'asdbbase'),
        'desc'                      => __('Select video type.', 'asdbbase'),
        'id'                        => 'slider_video_type',
        'type'                      => 'select',
		'choices'	=> array(
            array(
                'value'=>'',
                'label'=>__('None', 'asdbbase')
                ),

            array(
                'value'=>'youtube',
                'label'=>__('Youtube', 'asdbbase')
                ),

            array(
                'value'=>'vimeo',
                'label'=>__('Vimeo', 'asdbbase')
                )
            )
        ),
    array(
        'label'                     => __('Video', 'asdbbase'),
        'desc'                      => __('Video', 'asdbbase'),
        'id'                        => 'slider_video',
        'type'                      => 'upload'
        ),
    array(
        'label'                     => __('Video Link', 'asdbbase'),
        'desc'                      => __('Video link', 'asdbbase'),
        'id'                        => 'slider_video_link',
        'type'                      => 'text'
        ),
	),
);




/*  Register meta boxes
/* ------------------------------------ */
	ot_register_meta_box( $page_options );
	ot_register_meta_box( $portfolio_options );
	ot_register_meta_box( $section_options );
	ot_register_meta_box( $post_format_audio );
	ot_register_meta_box( $post_format_chat );
	ot_register_meta_box( $post_format_gallery );
	ot_register_meta_box( $post_format_link );
	ot_register_meta_box( $post_format_quote );
	ot_register_meta_box( $post_format_video );
	ot_register_meta_box( $post_options );
	ot_register_meta_box( $testimohial_options );
	ot_register_meta_box( $galleries_options );
	ot_register_meta_box( $features_options );
}
