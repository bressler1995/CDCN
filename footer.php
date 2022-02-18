<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	if ( did_action( 'elementor/loaded' ) && hello_header_footer_experiment_active() ) {
		get_template_part( 'template-parts/dynamic-footer' );
	} else {
		get_template_part( 'template-parts/footer' );
	}
}
?>

<?php wp_footer(); ?>

<div id="cdcn_vlightbox" class="cdcn_vlightbox">
	<div id="cdcn_vlb_overlay" class="cdcn_vlb_overlay"></div>
	<div id="cdcn_vlb_content" class="cdcn_vlb_content">
		<div class="cdcn_vlb_cmedia">
			<div class="cdcn_vlb_iframeholder">
				<iframe id="cdcn_vlb_iframe" width="560" height="315" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				<button id="cdcn_vlb_close"><img src="<?php echo get_stylesheet_directory_uri() . '/svg/close.svg' ?>"></button>
			</div>
		</div>
		<div class="cdcn_vlb_ctext">
			<p id="cdcn_vlb_title" class="cdcn_vlb_title"></p>
			<p id="cdcn_vlb_description" class="cdcn_vlb_description"></p>
		</div>
	</div>
</div>
</body>
</html>
