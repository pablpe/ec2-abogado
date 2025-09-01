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
 *  Admin Class
 */

function spiraclethemes_site_library_admin_classes( $classes ) {
    global $pagenow;
    $classes .= 'theme-lawfiz';
    return $classes;
}

add_filter( 'admin_body_class', 'spiraclethemes_site_library_admin_classes' );


/**
 *  Set Import files
 */

if ( ! function_exists( 'spiraclethemes_site_library_lawfiz_set_import_files' ) ) :
function spiraclethemes_site_library_lawfiz_set_import_files() {

    $customizer_lawfiz_demo1 = spiraclethemes_site_library_api_data('lawfiz', 'demo1', 'customizer');
    $widgets_lawfiz_demo1 = spiraclethemes_site_library_api_data('lawfiz', 'demo1', 'widgets');
    $content_lawfiz_demo1 = spiraclethemes_site_library_api_data('lawfiz', 'demo1', 'content');
    $image_lawfiz_demo1 = spiraclethemes_site_library_api_data('lawfiz', 'demo1', 'image');

    return array(
        array(
            'import_file_name'           => esc_html__('Demo 1', 'spiraclethemes-site-library'),
            'import_file_url'          => $content_lawfiz_demo1,
            'import_widget_file_url'   => $widgets_lawfiz_demo1,
            'import_customizer_file_url' => $customizer_lawfiz_demo1,
            'import_preview_image_url'     => $image_lawfiz_demo1,
            'import_notice'              => esc_html__( 'After you import this demo, you will have to change some menu links. Please check documentation for more information', 'spiraclethemes-site-library' ),
            'preview_url'                  => 'https://lawyerswp.spiraclethemes.com/lawfiz/',
        ),
        array(
            'import_file_name'           => esc_html__('More Demos', 'spiraclethemes-site-library'),
            'import_file_url'          => $content_lawfiz_demo1,
            'import_widget_file_url'   => $widgets_lawfiz_demo1,
            'import_customizer_file_url' => $customizer_lawfiz_demo1,
            'import_preview_image_url'     => SPIR_SITE_LIBRARY_URL . 'img/moredemo.jpg',
            'import_notice'              => esc_html__( 'After you import this demo, you will have to change some menu links. Please check documentation for more information', 'spiraclethemes-site-library' ),
            'preview_url'                  => 'https://lawyerswp.spiraclethemes.com/lawfiz/',
        ),
    );
}
endif;
add_filter( 'pt-ocdi/import_files', 'spiraclethemes_site_library_lawfiz_set_import_files' );


/**
 *  After Import
 */

if ( ! function_exists( 'spiraclethemes_site_library_lawfiz_after_import_setup' ) ) :
function spiraclethemes_site_library_lawfiz_after_import_setup( $selected_import ) {
	//Assign menus to their locations
	$main_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
	set_theme_mod( 'nav_menu_locations', array(
	      'primary' => $main_menu->term_id,
	    )
	);

    //Assign front & blog page
    $front_page = get_page_by_title( 'Home' );  
    $blog_page = get_page_by_title( 'Blog' );  

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page -> ID );    
    update_option( 'page_for_posts', $blog_page -> ID ); 
    
}
endif;
add_action( 'pt-ocdi/after_import', 'spiraclethemes_site_library_lawfiz_after_import_setup' );


function spiraclethemes_site_library_lawfiz_check_pro_plugin() {
    if ( ! function_exists( 'ocdi_register_plugins' ) ) :
        function ocdi_register_plugins( $plugins ) {
         
            // List of plugins used by all theme demos.
            $theme_plugins = [
                [ 
                  'name'     => 'Elementor Website Builder',
                  'slug'     => 'elementor',
                  'required' => true,
                ],
                [ 
                  'name'     => 'Contact Form 7',
                  'slug'     => 'contact-form-7',
                  'required' => true,
                ],
            ];
         
            return array_merge( $plugins, $theme_plugins );
        }
    endif;
    add_filter( 'ocdi/register_plugins', 'ocdi_register_plugins' );
}
add_action( 'admin_init', 'spiraclethemes_site_library_lawfiz_check_pro_plugin' );



// Define a function to add inline CSS to the admin area
function spiraclethemes_site_library_admin_inline_css() {
    ?>
    <style type="text/css">
        .theme-lawfiz div[data-name="more demos"] {
            display: none;
        }
    </style>
    <?php
}
// Hook the function to the admin_head action
add_action('admin_head', 'spiraclethemes_site_library_admin_inline_css');