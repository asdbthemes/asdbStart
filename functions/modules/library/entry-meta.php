<?php
/**
 * Entry meta information for posts
 *
 * @package asdb
 * @since asdb 1.0.0
 */

if ( ! function_exists( 'asdb_entry_meta' ) ) :
	function asdb_entry_meta() { ?>
        <div class="entry-meta">
                <span class="date"><i class="fa fa-calendar"></i> <time class="entry-date" datetime="<?php the_time( 'c' ); ?>"><?php the_time('j M Y'); ?></time></span>
                <!--
                <span class="author"><i class="icon icon-user"></i> <?php the_author_posts_link() ?></span>
                -->
                <span class="category"><i class="icon icon-folder-open"></i> <?php echo get_the_category_list(' / '); ?></span>
                <span class="views"><i class="icon icon-eye"></i><?php if ( is_single() ) {fresh_kap_views();}  else {kap_views();} ?></span>
                <?php if ( comments_open() && ! is_single() ) { ?>
                <span class="comments-link pull-right"><i class="icon icon-comments"></i><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'asdbflat' ) . '</span>', __( 'One comment so far', 'asdbflat' ), __( 'View all % comments', 'asdbflat' ) ); ?></span>
                <?php } //.comment-link ?>
        </div><!--/.entry-meta -->
<?php	}
endif;
