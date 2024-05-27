<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UpConstruction
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
	<div class="col-lg-4 sidebar">
		
		<div class="widgets-container">
			
			<!-- Search Widget -->
			<aside id="secondary" class="widget-area container">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</aside><!-- #secondary -->
			
		</div>
	</div>