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

include('custom-shortcodes.php');

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

function eccentrik_ui_function() {
	wp_register_script('eccentrik_ui', get_stylesheet_directory_uri() . '/uicontrol.js', array( 'jquery'),'1.0', true);
	wp_enqueue_script('eccentrik_ui');
	wp_localize_script( 'eccentrik_ui', 'themeDirURI', get_stylesheet_directory_uri() ) ;
}

add_action( 'wp_enqueue_scripts', 'eccentrik_ui_function' );

function my_plugin_editor_scripts() {

	wp_register_script('editor-script-1', get_stylesheet_directory_uri() . '/uicontrol.js', array( 'jquery' ),'1.0', true);
	wp_enqueue_script('editor-script-1');
	wp_localize_script( 'editor-script-1', 'themeDirURI', get_stylesheet_directory_uri() ) ;

}

add_action( 'elementor/editor/after_enqueue_scripts', 'my_plugin_editor_scripts' );

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