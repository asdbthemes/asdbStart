<?php


class block_5 extends blocks {


    function __construct() {
        $this->block_id = 5;
        add_shortcode('block5', array($this, 'render'));
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

        $buffy .= '<div class="block_wrap block5">';

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

                $mod_4 = new mod_4($post);

                switch ($column_number) {

                    case '1': //one column layout
                        $buffy .= $mod_4->render($post);
                        break;

                    case '2': //two column layout
                        $buffy .= $blocks_layout->open_row();

                        $buffy .= $blocks_layout->open6();
                        $buffy .= $mod_4->render($post);
                        $buffy .= $blocks_layout->close6();

                        if ($current_column == 2) {
                            $buffy .= $blocks_layout->close_row();
                        }
                        break;

                    case '3': //three column layout
                        $buffy .= $blocks_layout->open_row();

                        $buffy .= $blocks_layout->open4();
                        $buffy .= $mod_4->render($post);
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

}

global_blocks::add_instance('Block 5', new block_5());
