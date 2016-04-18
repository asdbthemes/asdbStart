<?php
class blocks {
    var $block_id; // the block type
    var $block_uid; // the block unique id, it changes on every render


    /**
     * Used by blocks that don't need auto generated titles. If default is empty and no title is set it will remove the title from the block
     */
    function get_block_title_raw($atts, $default_title = '', $default_url = '') {
        extract(shortcode_atts(
            array(
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'header_color' => '',
                'header_text_color' => '',
                'title_style' => ''
            ),$atts));


        if (empty($custom_title) and empty($default_title)) {
            //no title selected, and no default title - do nothing
            return;
        }



        //custom colors
            $header_color_css = '';
            $header_line_color_css = '';
            $header_text_color_css_class = '';


            if (!empty($header_text_color) and $header_text_color != '#') {
                $header_text_color_css_class = '; color:' . $header_text_color . ' !important';
            }

            if (!empty($header_color) and $header_color != '#') { //# is a fix for farbtastic
                $header_color_css = 'background-color:' . $header_color . '';
                $header_line_color_css = 'style="border-bottom: 2px solid ' . $header_color . '" ';
            }

            //append to the color_css the text color
            if (!empty($header_text_color_css_class)) {
                $header_color_css .= $header_text_color_css_class;
            }

            //wrap the header css
            if (!empty($header_color_css)) {
                $header_color_css = 'style="' . $header_color_css . '" ';
            }
        //end custom colors

        //print_r($header_text_color_css_class);

        $assa = '';

        $title = $default_title;
        $url = $default_url;

        if ($hide_title != 'hide_title') {
            // read the custom url and title from the shortcode
            if (!empty($custom_title)) {
                $title = $custom_title;
            }

            if (!empty($custom_url)) {
                $url = $custom_url;
            }

            $css_buffer = '';
            if (!empty($title_style)) {
                $css_buffer = ' ' . $title_style;
            }

            $assa .= '<h4 ' . $header_line_color_css . 'class="block-title' . $css_buffer . '">';
                if (!empty($url)) {
                    $assa .= '<a ' . $header_color_css . 'href="' . $url . '">' . $title . '</a>';
                } else {
                    $assa .= '<span ' . $header_color_css . '>' . $title . '</span>';
                }
            $assa .= '</h4>';

        }

        return $assa;
    }


    /**
     * Used by blocks that need auto generated titles
     * @param $atts
     * @return string
     */
    function get_block_title($atts) {
        extract(shortcode_atts(
            array(
                'limit' => 5,
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '',
                'header_color' => '',
                'header_text_color' => '',
                'title_style' => ''
            ),$atts));



        //all the theme and datasources work with $category_ids instead of $category_id
        if (!empty($category_id) and empty($category_ids)) {
            $category_ids = $category_id;
        }


        //custom colors
            $header_color_css = '';
            $header_line_color_css = '';
            $header_text_color_css_class = '';


            if (!empty($header_text_color) and $header_text_color != '#') {
                $header_text_color_css_class = '; color:' . $header_text_color . ' !important';
            }

            if (!empty($header_color) and $header_color != '#') { //# is a fix for farbtastic
                $header_color_css = 'background-color:' . $header_color . '';
                $header_line_color_css = 'style="border-bottom: 2px solid ' . $header_color . '" ';
            }

            //append to the color_css the text color
            if (!empty($header_text_color_css_class)) {
                $header_color_css .= $header_text_color_css_class;
            }

            //wrap the header css
            if (!empty($header_color_css)) {
                $header_color_css = 'style="' . $header_color_css . '" ';
            }
        //end custom colors



        // Get the block name - if we don't have any name set and we have category filters
        $computed_category_block_name = '';
        $computed_category_block_link = '';
        if (!empty($category_ids)) {
            //@todo fix this / make this faster
            $cat_id_array = explode (',', $category_ids);
            foreach ($cat_id_array as &$cat_id) {
                $cat_id = trim($cat_id);
                //get the category object
                $tmp_cat_obj =  get_category($cat_id);
                if (empty($computed_category_block_name)) {
                    //print_r($tmp_cat_obj);
                    if (!empty($tmp_cat_obj)) {
                        //due to import sometimes the cat object may be empty
                        $computed_category_block_link = get_category_link($tmp_cat_obj->cat_ID);
                        $computed_category_block_name = mb_strtoupper($tmp_cat_obj->name);
                    }
                } else {
                    $computed_category_block_name = $computed_category_block_name . ' - ' . mb_strtoupper($tmp_cat_obj->name);
                }
                unset($tmp_cat_obj);
            }
        }


        //start building the title
        $assa = '';

        //check to see if we show subcats
        //@todo the check is not like the one from get_block_sub_cats
        $css_buffer = '';
        if (!empty($show_child_cat) and !empty($category_id)) {
            $css_buffer = ' block-title-subcats';
        }

        if (!empty($title_style)) {
            $css_buffer .= ' ' . $title_style;
        }

        //show the block title
        if ($hide_title != 'hide_title') {
            $assa .= '<h4 ' . $header_line_color_css . 'class="block-title' . $css_buffer . '">';
            if (empty($custom_title)) {
                //@todo remove empty title space
                if (empty($custom_url)) {
                    //all is autogenerated
                    $assa .= '<a ' . $header_color_css . 'href="' . $computed_category_block_link . '">' . $computed_category_block_name . '</a>';
                } else {
                    //just custom url by user, the title is autogenerated
                    $assa .= '<a ' . $header_color_css . 'href="' . $custom_url . '">' . $computed_category_block_name . '</a>';
                }
            } else {
                if (empty($custom_url)) {
                    //url is autogenerated
                    if (empty($computed_category_block_link)) {
                        //no url? - popular files for example dosn't have a url
                        $assa .= '<span ' . $header_color_css . '>' . $custom_title . '</span>';
                    } else {
                        //url is present
                        $assa .= '<a ' . $header_color_css . 'href="' . $computed_category_block_link . '">' . $custom_title . '</a>';
                    }

                } else {
                    //url is custom + custom title
                    $assa .= '<a ' . $header_color_css . 'href="' . $custom_url . '">' . $custom_title . '</a>';
                }
            }
            $assa .= '</h4>';
        }

        return $assa;
    }

    function get_block_sub_cats($atts) {
        extract(shortcode_atts(
            array(
                'limit' => 5,
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '', //if empty, no child cats. If number show the number of child cats. If all show all of them ;)
                'sub_cat_ajax' => '', //empty we use ajax
                'header_color' => ''
            ),$atts));

        $assa = '';

        if (!empty($show_child_cat) and !empty($category_id)) {

            $subcategories = get_categories(array('child_of' => $category_id));
            if (!empty($subcategories)) {
                if ($show_child_cat != 'all') {
                    $subcategories = array_slice($subcategories, 0, $show_child_cat);
                }

                $assa .= '<ul class="block-child-cats ui-sc' . $this->block_uid . '">';  //ui-sc is just for color setting on current subcats

                //show all categories only on ajax
                if (empty($sub_cat_ajax)) {
                    $assa .= '<li><a class="cur-sub-cat ajax-sub-cat sub-cat-' . $this->block_uid . '" id="sub-cat-'
                        . $this->block_uid . '-' . $category_id . '" data-cat_id="' . $category_id . '"
                        data-block_id="' . $this->block_uid . '" href="' . get_category_link($category_id) . '">' . __('All') . '</a></li>';
                }

                //show the rest of the subcategories
                foreach ($subcategories as $category) {
                    if (empty($sub_cat_ajax)) {
                        $assa .= '<li><a class="ajax-sub-cat sub-cat-' . $this->block_uid . '" id="sub-cat-' . $this->block_uid . '-' . $category->cat_ID . '" data-cat_id="' . $category->cat_ID . '" data-block_id="' . $this->block_uid . '" href="' . get_category_link($category->cat_ID) . '">' . $category->name . '</a></li>';
                    } else {
                        $assa .= '<li><a href="' . get_category_link($category->cat_ID) . '">' . $category->name . '</a></li>';
                    }

                }


                $assa .= '</ul>';
            }
        }


        if ($header_color != '') {
            $assa .= '<style>';
            $assa .= '.ui-sc' . $this->block_uid . ' .cur-sub-cat { ';
            $assa .= 'color:' . $header_color . ' !important';
            $assa .= '}';
            $assa .= '</style>';
        }
        return $assa;
    }


    function get_block_js ($atts, &$as_query) {
        extract(shortcode_atts(
            array(
                'limit' => 5,
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '',
                'column_number' => 1,
                'style' => 1,
                'sub_cat_ajax' => '',
                'ajax_pagination' => '',
                'header_color' => '',
                'ajax_pagination_infinite_stop' => '',
            ),$atts));


        if (!empty($atts['custom_title'])) {
            $atts['custom_title'] = htmlspecialchars($atts['custom_title'], ENT_QUOTES );
        }

        if (!empty($atts['custom_url'])) {
            $atts['custom_url'] = htmlspecialchars($atts['custom_url'], ENT_QUOTES );
        }
//            $atts['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $assa = '';
        $assa .= '<script>' . "\n";
        $assa .= 'block_id = "' . $this->block_id . '";' . "\n";
        $assa .= 'block_uid = "' . $this->block_uid . '";' . "\n";
        $assa .= 'style = "' . $style . '";' . "\n";
        $assa .= "atts = '" . json_encode($atts) . "';" . "\n";
        $assa .= 'cur_cat = "' . $category_id . '";' . "\n";
        $assa .= 'column_number = "' . $column_number . '";' . "\n";
        //wordpress wp query parms
        $assa .= 'post_count = "' . $as_query->post_count . '";' . "\n";
        $assa .= 'found_posts = "' . $as_query->found_posts . '";' . "\n";
        $assa .= 'max_num_pages = "' . $as_query->max_num_pages . '";' . "\n";
        $assa .= 'header_color = "' . $header_color . '";' . "\n";
        $assa .= 'ajax_pagination_infinite_stop = "' . $ajax_pagination_infinite_stop . '";' . "\n";
        $assa .= '</script>' . "\n";

?>
<script>
jQuery(function($){
	var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
	var current_page = '<?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>';
	var max_pages = '<?php echo $pst->max_num_pages; ?>';
$('#next-page-<?php echo $this->block_uid;?>').click(function(){
	$(this).html('Загружаю...<i class="fa fa-angle-right "></i>');
            jQuery('#next-page-<?php echo $this->block_uid;?>').parent().append('<div id="squaresWaveG" class="is-hidden"><div id="squaresWaveG_1" class="squaresWaveG"></div><div id="squaresWaveG_2" class="squaresWaveG"></div><div id="squaresWaveG_3" class="squaresWaveG"></div><div id="squaresWaveG_4" class="squaresWaveG"></div><div id="squaresWaveG_5" class="squaresWaveG"></div><div id="squaresWaveG_6" class="squaresWaveG"></div><div id="squaresWaveG_7" class="squaresWaveG"></div><div id="squaresWaveG_8" class="squaresWaveG"></div></div>');
            setTimeout(function () {
                jQuery('#squaresWaveG')
                    .removeClass('is-hidden')
                    .addClass('is-visible');
            }, 50);
/*
            jQuery('#next-page-<?php echo $this->block_uid;?>').parent().append('<div class="td-loader-gif td-loader-blocks-load-more td-loader-animation-start"></div>');//td-loader-infinite
            tdLoadingBox.init( '#336699', 40);  //init the loading box
            setTimeout(function () {
                jQuery('.td-loader-gif')
                    .removeClass('td-loader-animation-start')
                    .addClass('td-loader-animation-mid');
            }, 50);
*/
	var data = {
		'action': 'ajax_block',
		'atts': '<?php echo json_encode($atts); ?>',
		'page' : current_page,
		'cur_cat':'<?php echo $category_id;?>',
		'block_uid':'<?php echo $this->block_uid;?>',
		'block_id':'<?php echo $this->block_id;?>',
		'column_number':'<?php echo $column_number ?>',
		'limit':'<?php echo $limit ?>',
		'style':'<?php echo $style ?>',
};
$.ajax({
	url:ajaxurl,
	data:data,
	type:'POST',
	success:function(data){
		if( data ) {
			$('#next-page-<?php echo $this->block_uid;?>').html('Загрузить ещё <i class="fa fa-angle-down"></i>').before(data);
			current_page++;
			if (current_page == max_pages) $("#next-page-<?php echo $this->block_uid;?>").remove();
//			jQuery('.td-loader-gif').remove();
            setTimeout(function () {
                jQuery('#squaresWaveG').remove();
            }, 50);

		} else {
			$('#next-page-<?php echo $this->block_uid;?>').remove();
//			jQuery('.td-loader-gif').remove();
            setTimeout(function () {
                jQuery('#squaresWaveG').remove();
            }, 50);

		}
	}
});
	});
});
</script>

<?php
        echo $assa;
    }


    function get_block_pagination($atts, $unique_id = '') {
        extract(shortcode_atts(
            array(
                'limit' => 5,
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '',
                'sub_cat_ajax' => '',
                'ajax_pagination' => ''
            ),$atts));

        $assa = '';

        switch ($ajax_pagination) {
            case 'next_prev':
                if ($hide_title != 'hide_title') {
                    $assa .= '<div class="td-next-prev-wrap">';
                        $assa .= '<a href="#" class="ajax-prev-page ajax-page-disabled" id="prev-page-' . $this->block_uid . '" data-block_id="' . $this->block_uid . '"></a>';
                        $assa .= '<a href="#"  class="td-ajax-next-page" id="next-page-' . $this->block_uid . '" data-block_id="' . $this->block_uid . '"></a>';
                    $assa .= '</div>';
                }
                break;
            case 'load_more':
                $assa .= '<div class="load-more-wrap">';
                    $assa .= '<a class="ajax_load_more" id="next-page-' . $this->block_uid . '" data-block_id="' . $this->block_uid . '">' . __('Загрузить еще <i class="fa fa-angle-down"></i>') . '</a>';
                $assa .= '</div>';
                break;
            case 'infinite':
                //this is the marker - when this marker is visible, or is near visisble we trigger a is_visible callback
                $assa .= '<div class="ajax_infinite" id="next-page-' . $this->block_uid . '" data-block_id="' . $this->block_uid . '">';
                    $assa .= ' ';
                $assa .= '</div>';


                //this is just a normal load more button that is hidden until page x
                $assa .= '<div class="td-load-more-wrap td-load-more-infinite-wrap" id="infinite-lm-' . $this->block_uid . '">';
                    $assa .= '<a href="#" class="ajax_load_more" id="next-page-' . $this->block_uid . '" data-block_id="' . $this->block_uid . '">' . __('Load more') . '</a>';
                    $assa .= '<div class="td-load-more-img-wrap">';
                        $assa .= '<div class="td-load-more-img"></div>';
                    $assa .= '</div>';
                $assa .= '</div>';
                break;
        }

        return $assa;
    }




}
