<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package asdbStart
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php global $is_IE; if ( $is_IE ) : ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php endif; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<span class="svg-defs"><?php asdbstart_include_svg_icons(); ?></span>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'asdbstart' ); ?></a>

	<header class="site-header">

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
	<section class="site-branding">
		<div class="wrap">
				<?php echo asdb_site_title(); ?>
				<?php if ( ot_get_option('site-description') != 'off' ): ?><p class="site-description"><?php bloginfo( 'description' ); ?></p><?php endif; ?>
		</div><!-- .wrap -->
	</section>
<!--
			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php asdbstart_do_svg( array( 'icon' => 'bars', 'title' => 'Display Menu' ) ); ?><span class="menu-toggle-text"><?php esc_html_e( 'Menu', 'asdbstart' ); ?></span></button>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class'     => 'primary-menu menu dropdown'
					) );
				?>
			</nav><!-- #site-navigation -->
	<section class="navheader">
		<div class="wrap">
			<?php if ( has_nav_menu('header') ): ?>
				<nav class="nav-container group" id="nav-header">
					<div class="nav-toggle"><i class="icon icon-bars"></i></div>
					<div class="nav-text"><!-- put your mobile menu text here --></div>
					<div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'header','menu_class'=>'nav group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>
				</nav><!--/#nav-header-->
			<?php endif; ?>
		</div><!-- .wrap -->
	</section>
	<section class="navsubheader">
		<div class="wrap">
			<?php if ( has_nav_menu('subheader') ): ?>
				<nav class="nav-container group" id="nav-subheader">
					<div class="nav-toggle"><i class="icon icon-bars"></i></div>
					<div class="nav-text"><!-- put your mobile menu text here --></div>
					<div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'subheader','menu_class'=>'nav group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>
				</nav><!--/#nav-subheader-->
			<?php endif; ?>
		</div><!-- .wrap -->
	</section>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
