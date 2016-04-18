<?php
/**
 * Template part for displaying content style 1.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package asdbStart
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('cat-style-1'); ?>>

	<div class="entry-thumbnail">
	<?php asdb_get_thumb( 'thumb-8col'); ?>
	</div><!--/.post-thumbnail-->

	<h1 class="entry-title">
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	</h1><!--/.post-title-->

	<div class="entry-meta">
		<span class="entry-date"><i class="icon icon-calendar"></i><?php the_time('j M, Y'); ?></span>
		<span class="entry-category"><i class="icon icon-folder-open"></i><?php the_category(' / '); ?></span>
		<span class="entry-comments pull-right"><i class="icon icon-comments-o"></i><?php comments_number( '0', '1', '%' ); ?></span>
	</div><!--/.post-meta-->

	<div class="entry-content excerpt">
		<?php the_excerpt(); ?>
	</div><!--/.entry-->

</article><!--/.post-->