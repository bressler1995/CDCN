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

function cdcn_customizer_register( $wp_customize ) {
	$wp_customize->add_setting( 'cdcn_setting_headerphone' , array(
		'default'   => '(000) 000-0000',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting( 'cdcn_setting_headerfacebook' , array(
		'default'   => 'https://facebook.com',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting( 'cdcn_setting_headerlinkedin' , array(
		'default'   => 'https://linkedin.com',
		'transport' => 'refresh',
	));

	$wp_customize->add_setting( 'cdcn_setting_headeryoutube' , array(
		'default'   => 'https://youtube.com',
		'transport' => 'refresh',
	));

	$wp_customize->add_section( 'cdcn_setting_header_section' , array(
		'title'      => __( 'CDCN Header Settings' ),
		'priority'   => 30,
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cdcn_setting_headerphone_control', array(

		'label'          => __( 'Header Phone Number' ),
		'section'        => 'cdcn_setting_header_section',
		'settings'       => 'cdcn_setting_headerphone',
		'type'           => 'text'

	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cdcn_setting_headerfacebook_control', array(

		'label'          => __( 'Mobile Menu Facebook Link' ),
		'section'        => 'cdcn_setting_header_section',
		'settings'       => 'cdcn_setting_headerfacebook',
		'type'           => 'text'

	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cdcn_setting_headerlinkedin_control', array(

		'label'          => __( 'Mobile Menu LinkedIn Link' ),
		'section'        => 'cdcn_setting_header_section',
		'settings'       => 'cdcn_setting_headerlinkedin',
		'type'           => 'text'

	)));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'cdcn_setting_headeryoutube_control', array(

		'label'          => __( 'Mobile Menu Youtube Link' ),
		'section'        => 'cdcn_setting_header_section',
		'settings'       => 'cdcn_setting_headeryoutube',
		'type'           => 'text'

	)));
}

add_action( 'customize_register', 'cdcn_customizer_register' );

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