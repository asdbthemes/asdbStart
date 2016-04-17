<?php
/*

*/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('group entry-style-1'); ?>>
	<div class="entry-thumbnail">
			<?php if ( has_post_thumbnail() ): ?>
				<?php the_post_thumbnail('thumb-medium'); ?>
			<?php elseif ( ot_get_option('placeholder') != 'off' ): ?>
				<img src="<?php echo get_template_directory_uri(); ?>/img/thumb-medium.png" alt="<?php the_title(); ?>" />
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



	<div class="entry-content">
		<?php the_content(); ?>
	</div><!--/.entry-->
</article><!--/.post-->