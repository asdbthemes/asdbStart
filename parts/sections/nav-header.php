<?php if ( has_nav_menu('header') ): ?>
<section class="navheader">
	<div class="wrap">
			<nav class="nav-container group" id="nav-header">
				<div class="nav-toggle"><i class="icon icon-bars"></i></div>
				<div class="nav-text"><!-- put your mobile menu text here --></div>
				<div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'header','menu_class'=>'nav group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>
			</nav><!--/#nav-header-->
	</div><!-- .wrap -->
</section>
<?php endif; ?>