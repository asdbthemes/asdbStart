<?php
/**
 * Template part for displaying content style 2 for single.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package asdbStart
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('entry-style-2'); ?>>
	<div class="entry-thumbnail">
			<?php if ( has_post_thumbnail() ): ?>
				<?php the_post_thumbnail('thumb-medium'); ?>
			<?php elseif ( ot_get_option('placeholder') != 'off' ): ?>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/no-thumb/thumb-medium.png" alt="<?php the_title(); ?>" />
			<?php endif; ?>
		<span class="entry-category"><?php the_category(' / '); ?></span>
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1><!--/.post-title-->
	</div><!--/.post-thumbnail-->

	<div class="entry-meta">
		<span class="entry-date"><i class="icon icon-calendar"></i><?php the_time('j M, Y'); ?></span>
		<span class="entry-comments pull-right"><i class="icon icon-comments-o"></i><?php comments_number( '0', '1', '%' ); ?></span>
	</div><!--/.post-meta-->
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!--/.entry-->
</article><!--/.post-->