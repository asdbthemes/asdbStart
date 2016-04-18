<?php
/**
 * Template part for displaying content style 1 for single.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package asdbStart
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('entry-style-1'); ?>>

	<div class="entry-thumbnail">
	<?php asdb_get_thumb( 'thumb-8col'); ?>
	</div><!--/.post-thumbnail-->

	<h1 class="entry-title">
		<?php the_title(); ?>
	</h1><!--/.post-title-->

	<div class="entry-meta">
		<span class="entry-date"><i class="icon icon-calendar"></i><?php the_time('j M, Y'); ?></span>
		<span class="entry-category"><i class="icon icon-folder-open"></i><?php the_category(' / '); ?></span>
		<span class="entry-comments pull-right"><i class="icon icon-comments-o"></i><?php comments_number( '0', '1', '%' ); ?></span>
	</div><!--/.post-meta-->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!--/.entry-->

</article><!--/.post-->