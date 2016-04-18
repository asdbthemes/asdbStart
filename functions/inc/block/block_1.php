<?php


class block_1 extends blocks {


    function __construct() {
        $this->block_id = 1;
        add_shortcode('block1', array($this, 'render'));
    }


    function render($atts) {
        $this->block_uid = as_global::generate_unique_id(); //update unique id on each render

        //global $post;
        extract(shortcode_atts(
            array(
                'column_number' => 1,
                'style' => 1,
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


        $assa = ''; //output buffer

        //do the query
        $as_query = data_source::get_wp_query($atts); //by ref  do the query



        //get the js for this block - last parm is block id
        $assa .= $this->get_block_js($atts, $as_query);

        $assa .= '<div class="asdb_block block_wrap block1 style-' .$style. ' col-num-' . $column_number . ' ">';

        //get the block title
        $assa .= $this->get_block_title($atts);

        //get the sub category filter for this block
        $assa .= $this->get_block_sub_cats($atts);

        $assa .= '<div id=' . $this->block_uid . ' class="block_inner">';
        //inner content of the block
        $assa .= $this->inner($as_query->posts, $column_number, $style);
        $assa .= '</div>';

        //get the ajax pagination for this block
        $assa .= $this->get_block_pagination($atts);
        $assa .= '</div> <!-- ./block1 -->';
        return $assa;
    }

    function inner($posts, $column_number, $style) {
        //global $post;
        $assa = '';
        $blocks_layout = new blocks_layout();
        $post_count = 0;
        $current_column = 1;
        $current_row = 1;
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $mod_1 = new mod_1($post);
                $mod_10 = new mod_10($post);

				switch ($style) {
				case '1':

                        if ($current_column == 1) {$assa .= '<div class="row">';}
                        if ($column_number>1) {$assa .= '<div class="columns medium-'. 12/$column_number . '">';} else {$assa .= '<div class="single-column">';}
                            $assa .= $mod_1->render();
                        	$assa .= '</div>';
                        	if ( $current_column == $column_number) { $assa .= '</div>';}

				break;

				case '2':

                        if ($current_column == 1) {$assa .= '<div class="row">';}
                        if ($column_number>1) {$assa .= '<div class="columns medium-'. 12/$column_number . '">';} else {$assa .= '<div class="single-column">';}

                        //$assa .= asdb_pre( array('ii'=>$post_count,'cc'=>$current_column,'cr'=>$current_row,'!!'=>$post_count % $current_column) );
                        if ( $current_row == 1 ) {$assa .= $mod_1->render();}
                        if ( $current_row > 1 ) {$assa .= $mod_10->render();}

                        $assa .= '</div><!--./columns-->';
                        if ( $current_column == $column_number) { $assa .= '</div><!--./row-->';}


				break;
				}


                if ($current_column == $column_number) {
                    $current_column = 1;
                    $current_row++;
                } else {
                    $current_column++;
                }

                $post_count++;

            }

        }
     //   $assa .= $blocks_layout->close_all_tags();
        return $assa;
    }
}

global_blocks::add_instance('Block 1', new block_1());
