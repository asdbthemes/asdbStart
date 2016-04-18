<?php if ( has_nav_menu('topbar') ): ?>
<section class="topbar">
	<div class="wrap">
		<nav class="nav-container group" id="nav-topbar">
			<div class="nav-toggle"><i class="icon icon-bars"></i></div>
			<div class="nav-text">MENU<!-- put your mobile menu text here --></div>
			<div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'topbar','menu_class'=>'nav container-inner group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>
			<div class="toggle-search"><i class="icon icon-search"></i></div>
			<div class="search-expand">
				<div class="search-expand-inner">
					<?php get_search_form(); ?>
				</div>
			</div>
		</nav><!--/#nav-topbar-->
	</div><!-- .wrap -->
</section>
<?php endif; ?>
