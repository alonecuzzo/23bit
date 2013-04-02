<?php

/**
 * CustomCSSTheme
 * - Helper class generates CSS string from styling options
 */
Class CustomCSSTheme {

	private $output = '';
	private $is_selector_closed = true;

	public function __construct(){
		$this->output = ' ';
		$is_selector_closed = true;
	}

	/**
	 * Add Selector
	 * - add CSS selector to output string
	 * @param $selector - string 
	 */
	public function add_selector($selector){
		
		if(! $this->is_selector_closed){
			$this->output .= '} '; // close prev selector
			$this->is_selector_closed = true;
		}

		$this->output .= $selector;
		$this->is_selector_closed = false;
	}

	/**
	 * Add Property
	 * - add property to current selector
	 *
	 * @param $property - property name (font-size:)
	 * @param $value - property value (12)
	 * @param $end - value end (px)
	 * @param $is_rgb - default false if set to true color will be transformed to rgb
	 */
	public function add_property($property, $value, $end, $is_rgb = false){
		
		if(is_array($property)){

			// used for multiple properties with same value
			foreach ($property as $pr) {
				
				if(!empty($value) && $value != ''){

					if($is_rgb){
						$this->output .= $pr.''.$this->get_rgb_value( $value ).$end.' ';
						// IE8 FIX
						$this->output .= $pr.''.$value.'\;';
					}else{
						$this->output .= $pr.''.$value.$end.' ';
					}
					
				}
			}

		}else{
			
			if(!empty($value) && $value != ''){

				if($is_rgb){
					$this->output .= $property.''.$this->get_rgb_value( $value ).$end.' ';
				}else{
					$this->output .= $property.''.$value.$end.' ';
				}
			}
		}
	}

	/**
	 * Get Generated CSS
	 * - returns generated CSS string
	 */
	public function get_generated_CSS(){
		return str_replace( array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $this->output.'}'); // close last selector and remove new lines (minify CSS)
	}

	/**
	 * Is Selector Closed
	 * @return bool  
	 */
	public function is_selector_closed(){
		return $this->is_selector_closed;
	}


	/**
	 * get_rgb_value
	 * - returns rgb value from hex
	 * @param $colour string
	 */
	private function get_rgb_value($colour){

        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );

        return $r.', '.$g.', '.$b;
	}


}


?>