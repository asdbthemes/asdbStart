<?php
/**
 * Customize the output of menus for Foundation top bar
 *
 * @package asdbbase
 * @since asdbbase 1.0.0
 */

 // Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker

 if ( ! class_exists( 'asdbbase_Top_Bar_Walker' ) ) :
 class asdbbase_Top_Bar_Walker extends Walker_Nav_Menu {

 	function start_lvl( &$output, $depth = 0, $args = array() ) {
 			$indent = str_repeat("\t", $depth);
      $output .= "\n$indent<ul class=\"dropdown menu vertical\" data-toggle>\n";
 	}

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);

        if ( (strpos(implode(' ', $item->classes), 'menu-item-has-children')!== false ) && ($depth === 0)  ) {
            $item_html = str_replace('</a>', ' <i class="fa fa-angle-down"></i></a>', $item_html);
        }
        $output .= $item_html;
    }
 }


 if ( ! class_exists( 'asdbbase_Mobile_Walker' ) ) :
 class asdbbase_Mobile_Walker extends Walker_Nav_Menu {
 	function start_lvl( &$output, $depth = 0, $args = array() ) {
 			$indent = str_repeat("\t", $depth);
 			$output .= "\n$indent<ul class=\"vertical nested menu\">\n";
 	}
 }
 endif;

endif;
