<?php
/**
 * The template for displaying search forms in Intro
 *
 * @package Intro
 * @since Intro 1.0
 */
?>
	<div class="search-form">
		<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
			<fieldset>
				<div class="row">
					<button type="submit" class="btn" name="submit" id="searchsubmit"><i class="icon-search"></i></button>
					<div class="txt">
						<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'intro' ); ?>" />
					</div>
				</div>
			</fieldset>
		</form>
	</div><!-- / search-form -->