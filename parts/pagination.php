<nav class="pagination group">
	<?php if ( function_exists('wp_pagenavi') ) :  ?>
		<?php wp_pagenavi(); ?>
	<?php else : ?>
	<span class="pull-left"><?php previous_post_link('%link', '<i class="icon icon-angle-left"></i>&nbsp;' . esc_html__( 'Previous', 'asdbstart' ) , true); ?></span>
	<span class="pull-right"><?php next_post_link('%link', esc_html__( 'Next', 'asdbstart' ) . '&nbsp;<i class="icon icon-angle-right"></i>' , true); ?></span>
	<?php endif; ?>
</nav><!--/.pagination-->