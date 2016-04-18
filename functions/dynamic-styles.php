<?php
/*
  ------------------------------------------------------------------------- *
 *  Dynamic styles
/* ------------------------------------------------------------------------- */

/*  Google fonts
/* ------------------------------------ */
if ( ! function_exists( 'asdb_google_fonts' ) ) {

	function asdb_google_fonts () {
		if ( ot_get_option('dynamic-styles') != 'off' ) {

		$fb = 'font=' . ot_get_option( 'font-body' );
		$fh = 'font=' . ot_get_option( 'font-head' );
		$fm = 'font=' . ot_get_option( 'font-meta' );

		echo asdb_fgonts( $fb );
		if ($fh!=$fb) {echo asdb_fgonts( $fh );}
		if ( ($fm!=$fb) && ($fm!=$fh) ){echo asdb_fgonts( $fm );}

		}
	}
}

add_action( 'wp_head', 'asdb_google_fonts', 2 );


/*
   Convert hexadecimal to rgb
/* ------------------------------------ */
if ( ! function_exists( 'asdb_hex2rgb' ) ) {

	function asdb_hex2rgb( $hex, $array = false ) {
		$hex = str_replace('#', '', $hex);

		if ( strlen($hex) == 3 ) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}

		$rgb = array( $r, $g, $b );
		if ( ! $array ) { $rgb = implode(',', $rgb); }
		return $rgb;
	}
}


/*
   Google fonts
/* ------------------------------------ */
if ( ! function_exists( 'asdb_google_fonts' ) ) {

	function asdb_google_fonts() {
		if ( ot_get_option('dynamic-styles') != 'off' ) {

		$fb = 'font=' . ot_get_option( 'font-body' );
		$fh = 'font=' . ot_get_option( 'font-head' );
		$fm = 'font=' . ot_get_option( 'font-meta' );

		echo asdb_fgonts( $fb );
		if ($fh != $fb ) {echo asdb_fgonts( $fh );}
		if ( ($fm != $fb) && ($fm != $fh) ) { echo asdb_fgonts( $fm );}
}
	}
}


/*
   Dynamic css output
/* ------------------------------------ */
if ( ! function_exists( 'asdb_dynamic_css' ) ) {

	function asdb_dynamic_css() {
		if ( ot_get_option('dynamic-styles') != 'off' ) {

			// rgb values
			$color_1 = ot_get_option('color-1');
			$color_1_rgb = asdb_hex2rgb($color_1);
			// start output
			$styles = '<style type="text/css">'."\n";
			$styles .= '/* Dynamic CSS: For no styles in head, copy and put the css below in your custom.css or child theme\'s style.css, disable dynamic styles */'."\n";
			// Fonts
			$styles .= 'body { font-family: '.asdb_fgonts( 'opt=font-family&font='.ot_get_option( 'font-body' ) ).', Arial; }'."\n";
			$styles .= 'h1, h2, h3, h4, h5, h6, .post-title, .entry-title { font-family: '.asdb_fgonts( 'opt=font-family&font='.ot_get_option( 'font-head' ) ).', Georgia; }'."\n";
			$styles .= 'p.post-byline, div.sharrre-container span, .post-meta,.kama_breadcrumbs,.nav-container,.entry-meta { font-family: '.asdb_fgonts( 'opt=font-family&font='.ot_get_option( 'font-meta' ) ).', Arial; }'."\n";
			// container width
			if ( ot_get_option('container-width') !== '1200' ) {
				if ( ot_get_option( 'boxed' ) === 'on') {
					$styles .= '#boxed { max-width: '.ot_get_option('container-width').'px; }'."\n";
					$styles .= '#boxed #page { max-width: '.ot_get_option('container-width').'px; }'."\n";
					$styles .= '#boxed .row { max-width: '.ot_get_option('container-width').'px; }'."\n";
					$styles .= '#boxed .row .container-inner { max-width: '.ot_get_option('container-width').'px; }'."\n";
				} else {
   					$styles .= '#page { max-width: '.ot_get_option('container-width').'px; }'."\n";
					$styles .= '.row { max-width: '.ot_get_option('container-width').'px; }'."\n";
					$styles .= '.container-inner { max-width: '.ot_get_option('container-width').'px; }'."\n";
				}
			}
			// header logo max-height
			if ( ot_get_option('logo-max-height') != '60' ) {
				$styles .= '.site-title a img { max-height: '.ot_get_option('logo-max-height').'px; }'."\n";
			}
			// image border radius
			if ( ot_get_option('image-border-radius') != '0' ) {
				$styles .= 'img { -webkit-border-radius: '.ot_get_option('image-border-radius').'px; border-radius: '.ot_get_option('image-border-radius').'px; }'."\n";
			}
			// body background
			if ( ot_get_option('body-background') != '' ) {

				$body_background = ot_get_option('body-background');
				$body_color = $body_background['background-color'];
				$body_image = $body_background['background-image'];
				$body_position = $body_background['background-position'];
				$body_attachment = $body_background['background-attachment'];
				$body_repeat = $body_background['background-repeat'];
				$body_size = $body_background['background-size'];

				if ( $body_image && $body_size == '' ) {
					$styles .= 'body { background: '.$body_color.' url('.$body_image.') '.$body_attachment.' '.$body_position.' '.$body_repeat.'; }'."\n";
				} elseif ( $body_image && $body_size != '' ) {
					$styles .= 'body { background: '.$body_color.' url('.$body_image.') '.$body_attachment.' '.$body_position.' '.$body_repeat.'; background-size: '.$body_size.'; }'."\n";
				} elseif ( $body_background['background-color'] ) {
					$styles .= 'body { background-color: '.$body_color.'; }'."\n";
				} else {
					$styles .= '';
				}
			}
			$styles .= '</style>'."\n";
			// end output
			echo $styles;
		}
	}
}
add_action( 'wp_head', 'asdb_dynamic_css', 100 );
