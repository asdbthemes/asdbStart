<?php if ( has_nav_menu('subheader') ): ?>
<section class="navsubheader">
	<div class="wrap">
			<nav class="nav-container group" id="nav-subheader">
				<div class="nav-toggle"><i class="icon icon-bars"></i></div>
				<div class="nav-text"><!-- put your mobile menu text here --></div>
				<div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'subheader','menu_class'=>'nav group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>
			</nav><!--/#nav-subheader-->
	</div><!-- .wrap -->
</section>
<?php endif; ?>