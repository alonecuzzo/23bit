<?php 

/**********************************************************************
 * Author extensions
 **********************************************************************/
$ln_author_social_icons = array();

$ln_author_social_icons['pinterest'] = array("Pinterest", "pinterest-big.png");
$ln_author_social_icons['facebook'] = array("Facebook", "picons36.png");
$ln_author_social_icons['twitter'] = array("Twitter", "picons33.png");
$ln_author_social_icons['googleplus'] = array("Google+", "picons39.png");
$ln_author_social_icons['linkedin'] = array("LinkedIn", "picons41.png");
$ln_author_social_icons['vimeo'] = array("Vimeo", "picons43.png");
$ln_author_social_icons['youtube'] = array("YouTube", "picons48.png");
$ln_author_social_icons['flickr'] = array("Flickr", "picons34.png");

/**********************************************************************
 * Add custom social profiles fields
 **********************************************************************/
function ln_add_author_custom_fields( $user ){

?>
	<h3>Social Profiles:</h3>
	<table class="form-table">

		<tr>
			<th><label for="ln-pinterest">Pinterest: </label></th>
			<td>
				<input type="text" name="ln-pinterest" id="ln-pinterest" value="<?php echo esc_attr( get_the_author_meta( 'ln_user_social_pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Enter your Pinterest URL.</span>
			</td>
		</tr>

		<tr>
			<th><label for="ln-facebook">Facebook: </label></th>
			<td>
				<input type="text" name="ln-facebook" id="ln-facebook" value="<?php echo esc_attr( get_the_author_meta( 'ln_user_social_facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Enter your Facebook URL.</span>
			</td>
		</tr>

		<tr>
			<th><label for="ln-twitter">Twitter: </label></th>
			<td>
				<input type="text" name="ln-twitter" id="ln-twitter" value="<?php echo esc_attr( get_the_author_meta( 'ln_user_social_twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Enter your Twitter URL.</span>
			</td>
		</tr>

		<tr>
			<th><label for="ln-googleplus">Google Plus: </label></th>
			<td>
				<input type="text" name="ln-googleplus" id="ln-googleplus" value="<?php echo esc_attr( get_the_author_meta( 'ln_user_social_googleplus', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Enter your Google Plus URL.</span>
			</td>
		</tr>

		<tr>
			<th><label for="ln-linkedin">LinkedIn: </label></th>
			<td>
				<input type="text" name="ln-linkedin" id="ln-linkedin" value="<?php echo esc_attr( get_the_author_meta( 'ln_user_social_linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Enter your LinkedIn URL.</span>
			</td>
		</tr>

		<tr>
			<th><label for="ln-vimeo">Vimeo: </label></th>
			<td>
				<input type="text" name="ln-vimeo" id="ln-vimeo" value="<?php echo esc_attr( get_the_author_meta( 'ln_user_social_vimeo', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Enter your Vimeo URL.</span>
			</td>
		</tr>

		<tr>
			<th><label for="ln-youtube">YouTube: </label></th>
			<td>
				<input type="text" name="ln-youtube" id="ln-youtube" value="<?php echo esc_attr( get_the_author_meta( 'ln_user_social_youtube', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Enter your YouTube URL.</span>
			</td>
		</tr>

		<tr>
			<th><label for="ln-flickr">Flickr: </label></th>
			<td>
				<input type="text" name="ln-flickr" id="ln-flickr" value="<?php echo esc_attr( get_the_author_meta( 'ln_user_social_flickr', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Enter your Flickr URL.</span>
			</td>
		</tr>

	</table>

<?php

}

add_action( 'show_user_profile', 'ln_add_author_custom_fields' );
add_action( 'edit_user_profile', 'ln_add_author_custom_fields' );

/**********************************************************************
 * Save custom social profiles fields
 **********************************************************************/
function ln_save_author_custom_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_user_meta( $user_id, 'ln_user_social_twitter', $_POST['ln-twitter'] );
	update_user_meta( $user_id, 'ln_user_social_facebook', $_POST['ln-facebook'] );
	update_user_meta( $user_id, 'ln_user_social_pinterest', $_POST['ln-pinterest'] );
	update_user_meta( $user_id, 'ln_user_social_googleplus', $_POST['ln-googleplus'] );
	update_user_meta( $user_id, 'ln_user_social_linkedin', $_POST['ln-linkedin'] );

	update_user_meta( $user_id, 'ln_user_social_vimeo', $_POST['ln-vimeo'] );
	update_user_meta( $user_id, 'ln_user_social_youtube', $_POST['ln-youtube'] );
	update_user_meta( $user_id, 'ln_user_social_flickr', $_POST['ln-flickr'] );
}

add_action( 'personal_options_update', 'ln_save_author_custom_fields' );
add_action( 'edit_user_profile_update', 'ln_save_author_custom_fields' );

/**********************************************************************
 * Outputs author social icons <li>....</li>
 **********************************************************************/
function ln_get_author_social_icons(){

	global $ln_author_social_icons;

	$author_id = get_the_author_meta('ID');
	$output = '';

	foreach( $ln_author_social_icons as $id => $icon){

		if( get_the_author_meta('ln_user_social_'.$id, $author_id) ){
			$output .= '<li><a class="no-eff" href="'.esc_attr( get_the_author_meta('ln_user_social_'.$id, $author_id) ).'" title="'.$icon[0].'"><img src="'.INC_CSS.'/images/light/social/'.$icon[1].'"></a></li>';
		}
	}

	echo $output;
}

?>