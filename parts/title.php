<?php
// If a feature image is set, get the id, so it can be injected as a css background property
//if ( has_post_thumbnail( $post->ID ) ) :
//$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
//$image = $image[0];

global $meta;
?>

<?php if ( isset($meta['_parallax'][0]) && $meta['_parallax'][0] =='on' ) { $parallaxId[]='prlx-'.$post->ID; $prlx=$meta['_parallax-img'][0];?>
<header class="prlx">
	<div class="parallax-wrapper">
	<div id="prlx-<?php echo $post->ID; ?>" class="parallax parallax-section" style="background-image: url('<?php echo $prlx; ?>')">
	<div class="container">
		<div class="parallax-content">
			<?php echo asdb_page_title(); ?>
			<div class="divider">&nbsp;</div>
		</div>
	</div>
	</div><!-- /.parallax -->
	</div>
</header>
<?php } elseif ( isset($meta['_hero'][0]) && $meta['_hero'][0] =='on') { $hero=$meta['_hero-img'][0];?>
<header id="title-hero" role="banner" style="background-image: url('<?php echo $hero; ?>')">
		<?php echo asdb_page_title(); ?>
		<div class="divider">&nbsp;</div>
</header>
<?php } ?>
