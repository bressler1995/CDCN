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

<?php 
wp_footer(); 

$header_nav_menu_mobile = wp_nav_menu( [
	'theme_location' => 'menu-1',
	'fallback_cb' => false,
	'echo' => false,
	'menu_class' => 'eccent_mobile_menu',
] );

$logo_output = '';

if( function_exists( 'the_custom_logo' ) ) {

    if(has_custom_logo()) {
		$logo = get_theme_mod( 'custom_logo' );
		$logo_image = wp_get_attachment_image_src( $logo , 'medium' );

        $logo_output = '<img src="' . $logo_image[0] . '">';
    } else {
        $logo_output = '<img src="' . get_stylesheet_directory_uri() . '/img/cdcn_logo_current_white.png">';
    }
}

$cdcn_setting_headerphone = get_theme_mod('cdcn_setting_headerphone', '(000) 000-0000');
$cdcn_setting_headerfacebook = get_theme_mod('cdcn_setting_headerfacebook', 'https://facebook.com');
$cdcn_setting_headerlinkedin = get_theme_mod('cdcn_setting_headerlinkedin', 'https://linkedin.com');
$cdcn_setting_headeryoutube = get_theme_mod('cdcn_setting_headeryoutube', 'https://youtube.com');

$header_phone_output = '';
$header_facebook_output = '';
$header_linkedin_output = '';
$header_youtube_output = '';

if($cdcn_setting_headerphone != "" && empty($cdcn_setting_headerphone) == false) {
	$phone_unformatted = preg_replace('/\D+/', '', $cdcn_setting_headerphone);
	$header_phone_output = '<a class="eccent_header_phone" href="tel:' . $phone_unformatted . '"><img src="' . get_stylesheet_directory_uri() . '/svg/viber.svg"><span>' . $cdcn_setting_headerphone . '</span></a>';
} else {
	$header_phone_output = '<a class="eccent_header_phone" href="tel:0000000000"><img src="' . get_stylesheet_directory_uri() . '/svg/viber.svg"><span>(000) 000-0000</span></a>';
}

if($cdcn_setting_headerfacebook != "" && empty($cdcn_setting_headerfacebook) == false) {
	$header_facebook_output = '<a href="' . $cdcn_setting_headerfacebook . '" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/svg/social/footericonone.svg"></a>';
}

if($cdcn_setting_headerlinkedin != "" && empty($cdcn_setting_headerlinkedin) == false) {
	$header_linkedin_output = '<a href="' . $cdcn_setting_headerlinkedin . '" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/svg/social/footericontwo.svg"></a>';
}

if($cdcn_setting_headeryoutube != "" && empty($cdcn_setting_headeryoutube) == false) {
	$header_youtube_output = '<a href="' . $cdcn_setting_headeryoutube . '" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/svg/social/footericonthree.svg"></a>';
}
?>

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

<?php
if ( $header_nav_menu_mobile ) {
	echo '<div id="eccent_mobile_wrapper" class="eccent_mobile_wrapper">
		<div id="eccent_mobile_controls" class="eccent_mobile_controls">' . $logo_output . '<button id="eccent_mobile_close" class="eccent_mobile_close"><img src="' . get_stylesheet_directory_uri() . '/svg/close.svg"></button></div>' 
		. $header_nav_menu_mobile . 
	'<div id="eccent_mobile_social" class="eccent_mobile_social">' . 
		$header_facebook_output . $header_linkedin_output . $header_youtube_output . 
	'</div></div>';
}
?>
</body>
</html>
