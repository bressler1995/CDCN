<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );

function your_thumbnail_sizes() {
	global $_wp_additional_image_sizes;
	$sizes = array();
	$rSizes = array();
	foreach (get_intermediate_image_sizes() as $s) {
		$sizes[$s] = array(0, 0);
		if (in_array($s, array('thumbnail', 'medium', 'medium_large', 'large'))) {
			$sizes[$s][0] = get_option($s . '_size_w');
			$sizes[$s][1] = get_option($s . '_size_h');
		}else {
			if (isset($_wp_additional_image_sizes) && isset($_wp_additional_image_sizes[$s]))
				$sizes[$s] = array($_wp_additional_image_sizes[$s]['width'], $_wp_additional_image_sizes[$s]['height'],);
		}
	}
	foreach ($sizes as $size => $atts) {
		$rSizes[$size] = $size . ' ' . implode('x', $atts);
	}
	return $rSizes;
}