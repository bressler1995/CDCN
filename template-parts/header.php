<?php
/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
$header_nav_menu = wp_nav_menu( [
	'theme_location' => 'menu-1',
	'fallback_cb' => false,
	'echo' => false,
	'menu_class' => 'eccent_desktop_menu',
] );

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


?>
<header id="eccent_header" class="eccent_header" role="banner">
	<div class="eccent_ui_container">
		<div class="eccent_header_row">
			<div class="ecc_col">
				<a class="eccent_logo_link" href="<?php echo get_home_url() ?>"><?php echo $logo_output ?></a>
			</div>
			<div class="ecc_col" role="navigation">
				<?php
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

					if ( $header_nav_menu ) {
						echo $header_nav_menu;
					}

					if ( $header_nav_menu_mobile ) {
						echo '<div id="eccent_mobile_wrapper" class="eccent_mobile_wrapper">
							<div id="eccent_mobile_controls" class="eccent_mobile_controls">' . $logo_output . '<button id="eccent_mobile_close" class="eccent_mobile_close"><img src="' . get_stylesheet_directory_uri() . '/svg/close.svg"></button></div>' 
							. $header_nav_menu_mobile . 
						'<div id="eccent_mobile_social" class="eccent_mobile_social">' . 
							$header_facebook_output . $header_linkedin_output . $header_youtube_output . 
						'</div></div>';
					}

					echo $header_phone_output;
					echo do_shortcode('[language-switcher]');
				 ?>
				 
				 <a class="eccent_header_toggle" id="eccent_header_toggle" href="javascript:void(0)"><img src="<?php echo get_stylesheet_directory_uri() . '/svg/menu.svg' ?>"></a>
			</div>
		</div>
	</div>
</header>