<?php


class block_4 extends blocks {


    function __construct() {
        $this->block_id = 4;
        add_shortcode('block4', array($this, 'render'));
    }


    function render($atts){
        $this->block_uid = as_global::generate_unique_id(); //update unique id on each render
        //global $post;

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
                'tag_slug' => '',
                'header_color' => ''
            ),$atts));

        $buffy = ''; //output buffer
        $unique_id = as_global::generate_unique_id();


        $as_query = &data_source::get_wp_query($atts); //by ref  do the query

        //get the js for this block
        $buffy .= $this->get_block_js($atts, $as_query);

        $buffy .= '<div class="block_wrap block4">';

        //get the block title
        $buffy .= $this->get_block_title($atts);

        //get the sub category filter for this block
        $buffy .= $this->get_block_sub_cats($atts, $unique_id);

        $buffy .= '<div id=' . $this->block_uid . ' class="block_inner">';
        //inner content of the block
        $buffy .= $this->inner($as_query->posts);
        $buffy .= '</div>';

        //get the ajax pagination for this block
        $buffy .= $this->get_block_pagination($atts, $unique_id);
        $buffy .= '</div> <!-- ./block1 -->';
        return $buffy;
    }

    function inner($posts, $column_number = '') {
        //global $post;

        $buffy = '';

        $blocks_layout = new blocks_layout();
        if (empty($column_number)) {
            $column_number = $blocks_layout->get_column_number(); // get the column width of the block
        }
        $post_count = 0; // the number of posts rendered
        $current_column = 1; //the current column


        if (!empty($posts)) {
            foreach ($posts as $post) {

                $mod_3 = new mod_3($post);

                switch ($column_number) {

                    case '1': //one column layout
                        $buffy .= $mod_3->render($post);
                        break;

                    case '2': //two column layout
                        $buffy .= $blocks_layout->open_row();

                        $buffy .= $blocks_layout->open6();
                        $buffy .= $mod_3->render($post);
                        $buffy .= $blocks_layout->close6();

                        if ($current_column == 2) {
                            $buffy .= $blocks_layout->close_row();
                        }
                        break;

                    case '3': //three column layout
                        $buffy .= $blocks_layout->open_row();

                        $buffy .= $blocks_layout->open4();
                        $buffy .= $mod_3->render($post);
                        $buffy .= $blocks_layout->close4();

                        if ($current_column == 3) {
                            $buffy .= $blocks_layout->close_row();
                        }
                        break;
                }

                //current column
                if ($current_column == $column_number) {
                    $current_column = 1;
                } else {
                    $current_column++;
                }


                $post_count++;
            }
        }
        $buffy .= $blocks_layout->close_all_tags();
        return $buffy;
    }


    function get_map () {

        //get the generic filter array
        $generic_filter_array = generic_filter_array::get_array();

        //add custom filter fields to generic filter array
        array_push ($generic_filter_array,
            array(
                "param_name" => "limit",
                "type" => "textfield",
                "value" => __("5", 'asdbbase'),
                "heading" => __("Limit post number:", 'asdbbase'),
                "description" => "",
                "holder" => "div",
                "class" => ""
            ),
            array(
                "param_name" => "offset",
                "type" => "textfield",
                "value" => __("", 'asdbbase'),
                "heading" => __("Offset posts:", 'asdbbase'),
                "description" => "",
                "holder" => "div",
                "class" => ""
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Header color", 'asdbbase'),
                "param_name" => "header_color",
                "value" => '', //Default Red color
                "description" => __("Choose a custom header color for this block", 'asdbbase')
            ),
            array(
                "type" => "colorpicker",
                "holder" => "div",
                "class" => "",
                "heading" => __("Header text color", 'asdbbase'),
                "param_name" => "header_text_color",
                "value" => '', //Default Red color
                "description" => __("Choose a custom header color for this block", 'asdbbase')
            ),
            array(
                "param_name" => "custom_title",
                "type" => "textfield",
                "value" => "",
                "heading" => __("Optional - custom title for this block:", 'asdbbase'),
                "description" => "",
                "holder" => "div",
                "class" => ""
            ),
            array(
                "param_name" => "custom_url",
                "type" => "textfield",
                "value" => "",
                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'asdbbase'),
                "description" => "",
                "holder" => "div",
                "class" => ""
            ),
            array(
                "param_name" => "title_style",
                "type" => "dropdown",
                "value" => array('- default style -' => '', 'Style 1' => 'title_style_1'),
                "heading" => __("Title style:", 'asdbbase'),
                "description" => "",
                "holder" => "div",
                "class" => ""
            ),
            array(
                "param_name" => "show_child_cat",
                "type" => "dropdown",
                "value" => array('- Hide -' => '', 'Show 1 category' => '1', 'Show 2 categories' => '2', 'Show 3 categories' => '3', 'Show 4 categories' => '4', 'Show 5 categories' => '5', 'Show 6 categories' => '6', 'Show 7 categories' => '7', 'Show 8 categories' => '8', 'Show all' => 'all'),
                "heading" => __("Show child categories menu:", 'asdbbase'),
                "description" => "This will show a menu at the top of the block that contains the child categories of the selected category. It only works when you're using a single category filter form the dropdown. It doss't work with multiple categories IDs",
                "holder" => "div",
                "class" => ""
            ),
            array(
                "param_name" => "sub_cat_ajax",
                "type" => "dropdown",
                "value" => array('- Use ajax -' => '', 'Do not use ajax' => 'n'),
                "heading" => __("Use ajax in child categories menu:", 'asdbbase'),
                "description" => "",
                "holder" => "div",
                "class" => ""
            ),
            array(
                "param_name" => "ajax_pagination",
                "type" => "dropdown",
                "value" => array('- No pagination -' => '', 'Next Prev ajax' => 'next_prev', 'Load More button' => 'load_more', 'Infinite load' => 'infinite'),
                "heading" => __("Pagination:", 'asdbbase'),
                "description" => "",
                "holder" => "div",
                "class" => ""
            ),
            array(
                "param_name" => "ajax_pagination_infinite_stop",
                "type" => "textfield",
                "value" => '',
                "heading" => __("Infinite load show 'Load more' after x pages:", 'asdbbase'),
                "description" => "Shows 'load more' button after x number of pages. Leave this blank to load posts forever when infinite load is set for ajax pagination",
                "holder" => "div",
                "class" => ""
            )
        );

        return array(
            "name" => __("Block 4", 'asdbbase'),
            "base" => "block4",
            "class" => "block4",
            "controls" => "full",
            "category" => __('Blocks', 'asdbbase'),
            'icon' => 'icon-pagebuilder-block4',
            "params" => $generic_filter_array
        );

    }

}



global_blocks::add_instance('Block 4', new block_4());
