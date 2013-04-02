<?php

/*******************************************
 * Custom Walkers
 *******************************************/

/*******************************************
 * Ln_Responsive_Nav_Menu_Walker
 *
 * - used to generate <select> dropdown menu
 *******************************************/
class Ln_Responsive_Nav_Menu_Walker extends Walker_Nav_Menu{
    
    function start_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
	}
 
 
	function end_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
	}
 
	 function start_el(&$output, $item, $depth, $args) {
		
		// mark current page as selected
		
		if($item->current == true){
			$current = 'selected=selected';
		}else{
			$current = '';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
 
		$sel_val = ' value="'.esc_attr( $item->url).'"';

 		$dp = str_repeat("&nbsp;", $depth * 4);
 
		$output .= '<option'. $sel_val.' '. $current . '>'.$dp;
 
		$item_output = $args->before;
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= $args->after;
 		
 		$item_output .= '</option>';
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
 
	function end_el(&$output, $item, $depth) {
		
	}
}


?>
