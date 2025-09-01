<?php
/**
 * Lawfiz One Theme Customizer
 *
 * @package lawfiz-one
 */



if ( ! function_exists( 'lawfiz_one_customize_register' ) ) :
function lawfiz_one_customize_register( $wp_customize ) {

    // Add custom controls.
    require_once( get_stylesheet_directory(). '/inc/customizer/custom-controls/info/class-info-control.php' );
    require_once( get_stylesheet_directory(). '/inc/customizer/custom-controls/info/class-title-info-control.php' );
    require_once( get_stylesheet_directory(). '/inc/customizer/custom-controls/toggle-button/class-login-designer-toggle-control.php' );

    // Section Top Bar ===================================================


    $wp_customize->add_section(
        'lawfiz_one_topbar_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Top Bar Settings', 'lawfiz-one' ),
        )
    ); 


    // Title label
    $wp_customize->add_setting( 
        'lawfiz_one_label_topbar_settings_heading', 
        array(
            'sanitize_callback' => 'lawfiz_one_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_One_Title_Info_Control( $wp_customize, 'lawfiz_one_label_topbar_settings_heading', 
        array(
            'label'       => esc_html__( 'Top Bar Settings', 'lawfiz-one' ),
            'section'     => 'lawfiz_one_topbar_settings',
            'settings'    => 'lawfiz_one_label_topbar_settings_heading',
        ) 
    ));


    // Add an option to enable the topbar
    $wp_customize->add_setting( 
        'lawfiz_enable_top_bar', 
        array(
            'default'           => false,
            'type'              => 'theme_mod',
            'sanitize_callback' => 'lawfiz_one_sanitize_checkbox',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_One_Toggle_Control( $wp_customize, 'lawfiz_enable_top_bar', 
        array(
            'label'       => esc_html__( 'Show Top Bar', 'lawfiz-one' ),
            'section'     => 'lawfiz_one_topbar_settings',
            'type'        => 'lawfiz-toggle',
            'settings'    => 'lawfiz_enable_top_bar',
        ) 
    ));

}
endif;
add_action( 'customize_register', 'lawfiz_one_customize_register' );


/**
 * Title sanitization.
 */
if ( ! function_exists( 'lawfiz_one_sanitize_title' ) ) :
function lawfiz_one_sanitize_title( $str ) {
    return sanitize_title( $str );  
}
endif;

/**
 * Sanitize checkbox.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
if ( ! function_exists( 'lawfiz_one_sanitize_checkbox' ) ) :
function lawfiz_one_sanitize_checkbox( $checked ) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
endif;


/**
 * Enqueue the customizer stylesheet.
 */
if ( ! function_exists( 'lawfiz_one_enqueue_customizer_stylesheets' ) ) :
function lawfiz_one_enqueue_customizer_stylesheets() {
    wp_register_style( 'lawfiz-one-customizer', trailingslashit(get_stylesheet_directory_uri()) . 'inc/customizer/assets/css/customizer.css', NULL, NULL, 'all' );
    wp_enqueue_style( 'lawfiz-one-customizer' );
    wp_enqueue_script( 'lawfiz-one-customizer-js', trailingslashit(get_stylesheet_directory_uri()) . 'inc/customizer/assets/js/customizer.js', false, true);
}
endif;
add_action( 'customize_controls_print_styles', 'lawfiz_one_enqueue_customizer_stylesheets' );