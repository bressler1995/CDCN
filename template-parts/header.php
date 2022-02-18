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
					if ( $header_nav_menu ) {
						echo $header_nav_menu;
					}

					if ( $header_nav_menu_mobile ) {
						echo '<div id="eccent_mobile_wrapper" class="eccent_mobile_wrapper">
							<div id="eccent_mobile_controls" class="eccent_mobile_controls">' . $logo_output . '<button id="eccent_mobile_close" class="eccent_mobile_close"><img src="' . get_stylesheet_directory_uri() . '/svg/close.svg"></button></div>' 
							. $header_nav_menu_mobile . 
						'<div id="eccent_mobile_social" class="eccent_mobile_social">
							<a href="#" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/svg/social/footericonone.svg"></a>
							<a href="#" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/svg/social/footericontwo.svg"></a>
							<a href="#" target="_blank"><img src="' . get_stylesheet_directory_uri() . '/svg/social/footericonthree.svg"></a>
						</div></div>';
					}

				 ?>
				 <a class="eccent_header_phone" href="#"><img src="<?php echo get_stylesheet_directory_uri() . '/svg/viber.svg' ?>"><span>(408) 836-4839</span></a>
				 <a class="eccent_header_toggle" id="eccent_header_toggle" href="javascript:void(0)"><img src="<?php echo get_stylesheet_directory_uri() . '/svg/menu.svg' ?>"></a>
			</div>
		</div>
	</div>
</header>