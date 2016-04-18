<?php

class block_2 extends blocks {

    function __construct() {
        $this->block_id = 2;
        add_shortcode('block2', array($this, 'render'));
    }

    function render($atts) {

        $this->block_uid = as_global::generate_unique_id();

        extract(shortcode_atts(
            array(
                'column_number' => 1,
                'style' => 1,
                'limit' => 4,
                'sort' => '',
                'category_id' => '',
                'category_ids' => '',
                'thumb' => 'thumb-4col',
                'custom_title' => '',
                'custom_url' => '',
                'hide_title' => '',
                'show_child_cat' => '',
                'tag_slug' => '',
                'header_color' => ''
            ),$atts));

        $assa = '';
        $as_query = data_source::get_wp_query($atts);
        $assa .= $this->get_block_js($atts, $as_query);
        $assa .= '<div class="asdb_block block_wrap block2 style-' .$style. ' col-num-' . $column_number . ' ">';
        $assa .= $this->get_block_title($atts);
        $assa .= $this->get_block_sub_cats($atts);
        $assa .= '<div id=' . $this->block_uid . ' class="block_inner">';
        $assa .= $this->inner($as_query->posts, $column_number, $style);
        $assa .= '</div>';
        $assa .= $this->get_block_pagination($atts);
        $assa .= '</div> <!-- ./block2 -->';
        return $assa;
    }

    function inner($posts, $column_number, $style) {
        $assa = '';
        $blocks_layout = new blocks_layout();
        $post_count = 0;
        $current_column = 1;
        $current_row = 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $mod_2 = new mod_2($post);
                        if ($current_column == 1) {$assa .= '<div class="row">';}
                        if ($column_number>1) {$assa .= '<div class="columns medium-'. 12/$column_number . '">';} else {$assa .= '<div class="single-column">';}
                            $assa .= $mod_2->render();
                        	$assa .= '</div>';
                        	if ( $current_column == $column_number) { $assa .= '</div>';}
                if ($current_column == $column_number) {
                    $current_column = 1;
                    $current_row++;
                } else {
                    $current_column++;
                }
                $post_count++;
            }
        }
        return $assa;
    }
}

global_blocks::add_instance('Block 2', new block_2());
