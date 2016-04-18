<?php

function ajax_block(){
    global $post;
    //get the data from ajax() call


    if (!empty($_POST['atts'])) {
        $atts = json_decode(stripslashes($_POST['atts']), true); //current block args
    } else {
        $atts = ''; //not ok
    }

    if (!empty($_POST['cur_cat'])) {
        $cur_cat = $_POST['cur_cat']; //the new id filter
    } else {
        $cur_cat = '';
    }

    if (!empty($_POST['column_number'])) {
        $column_number =  $_POST['column_number']; //the block is on x columns
    } else {
        $column_number = 0; //not ok
    }

    if (!empty($_POST['page'])) {
        $page = $_POST['page']+1;
    } else {
        $page = 1;
    }

    if (!empty($_POST['current_page'])) {
        $current_page = $_POST['$current_page'];
    } else {
        $current_page = 1;
    }

    if (!empty($cur_cat)) {
        $atts['category_ids'] = $cur_cat;
        unset($atts['category_id']);
    }

    if (!empty($_POST['block_id'])) {
        $block_id = $_POST['block_id'];
    } else {
        $block_id = ''; //not ok
    }

    if (!empty($_POST['block_uid'])) {
        $block_uid = $_POST['block_uid'];
    } else {
        $block_uid = '';
    }

    if (!empty($_POST['style'])) {
        $style = $_POST['style'];
    } else {
        $style = '';
    }

    $as_query = &data_source::get_wp_query($atts, $page); //by ref  do the query

    $assa ='';
    $assa  .= global_blocks::get_instance($block_id)->inner($as_query->posts, $column_number, $style);


    //pagination
    $hide_prev = false;
    $hide_next = false;
    if ($current_page == 1) {
        $hide_prev = true; //hide link on page 1
    }

    if ($current_page >= $as_query->max_num_pages ) {
        $hide_next = true; //hide link on last page
    }


    $assaArray = array(
        'data' => $assa,
        'block_id' => $block_id,
        'block_uid' => $block_uid,
        'style' => $style,
        'column_number' => $column_number,
        'cur_cat' => $cur_cat,
        'hide_prev' => $hide_prev,
        'hide_next' => $hide_next
    );

    // Return the String
    //die(json_encode($assaArray));
    die($assa);
}

// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_ajax_block', 'ajax_block' );
add_action( 'wp_ajax_ajax_block', 'ajax_block' );
