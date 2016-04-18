<?php
/*
add_action( 'pre_get_posts', 'be_exclude_category_from_blog' );
function be_exclude_category_from_blog( $query ) {

    if( !is_admin() && $query->is_main_query() && $query->is_category( 'bib' ) ) {
// $query->set( 'cat', '-2' );
		$query->set('post_type', array ( 'books' ));

    }
}
*/
