<?php
/**
 *
 * @package spiraclethemes-site-library
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) :
    die;
endif;


/**
 *  Set Import files
 */

if ( ! function_exists( 'spiraclethemes_site_library_purea_magazine_set_import_files' ) ) :
function spiraclethemes_site_library_purea_magazine_set_import_files() {

    $returnArray = array();
    for ($i = 1; $i <= 2; $i++) {
        $customizer_pureamagazine_demo[$i] = spiraclethemes_site_library_api_data('pureamagazine', 'demo'.$i, 'customizer');
        $widgets_pureamagazine_demo[$i] = spiraclethemes_site_library_api_data('pureamagazine', 'demo'.$i, 'widgets');
        $content_pureamagazine_demo[$i] = spiraclethemes_site_library_api_data('pureamagazine', 'demo'.$i, 'content');
        $image_pureamagazine_demo[$i] = spiraclethemes_site_library_api_data('pureamagazine', 'demo'.$i, 'image');

        $returnArray[] = array(
            'import_file_name'           => esc_html__('Demo'.$i, 'spiraclethemes-site-library'),
            'import_file_url'            => $content_pureamagazine_demo[$i],
            'import_widget_file_url'     => $widgets_pureamagazine_demo[$i],
            'import_customizer_file_url' => $customizer_pureamagazine_demo[$i],    
            'import_preview_image_url'   => $image_pureamagazine_demo[$i],
            'import_notice'              => esc_html__( 'After you import this demo, you will have to change some menu links. Please check documentation for more information', 'spiraclethemes-site-library' ),
            'preview_url'                => 'https://pureamagwp.spiraclethemes.com/demo'.$i,
        );
    }
    return $returnArray;
}
endif;
add_filter( 'pt-ocdi/import_files', 'spiraclethemes_site_library_purea_magazine_set_import_files' );



if ( ! function_exists( 'spiraclethemes_site_library_purea_magazine_after_import_setup' ) ) :
function spiraclethemes_site_library_purea_magazine_after_import_setup( $selected_import ) {
	//Assign menus to their locations
	$main_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
	$footer_menu = get_term_by( 'name', 'Footer', 'nav_menu' );
	$sidebar_social_menu = get_term_by( 'name', 'Social Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
	      'primary' => $main_menu->term_id,
	      'footer' => $footer_menu->term_id,
	      'social' => $sidebar_social_menu->term_id,
	    )
	);

    //Assign front & blog page
    $front_page = get_page_by_title( 'Home' );  

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page -> ID );
    
}
endif;
add_action( 'pt-ocdi/after_import', 'spiraclethemes_site_library_purea_magazine_after_import_setup' );