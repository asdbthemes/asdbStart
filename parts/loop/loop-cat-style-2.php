<?php
/**
 * Template part for displaying content style 2.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package asdbStart
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('cat-style-2'); ?>>
	<div class="entry-thumbnail">
			<?php if ( has_post_thumbnail() ): ?>
				<?php the_post_thumbnail('thumb-8col'); ?>
			<?php elseif ( ot_get_option('placeholder') != 'off' ): ?>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/no-thumb/thumb-medium.png" alt="<?php the_title(); ?>" />
			<?php endif; ?>
		<span class="entry-category"><?php the_category(' / '); ?></span>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h1><!--/.post-title-->
	</div><!--/.post-thumbnail-->

	<div class="entry-meta">
		<span class="entry-date"><i class="icon icon-calendar"></i><?php the_time('j M, Y'); ?></span>
		<span class="entry-comments pull-right"><i class="icon icon-comments-o"></i><?php comments_number( '0', '1', '%' ); ?></span>
	</div><!--/.post-meta-->
	<div class="entry-content excerpt">
		<?php the_excerpt(); ?>
	</div><!--/.entry-->
</article><!--/.post-->