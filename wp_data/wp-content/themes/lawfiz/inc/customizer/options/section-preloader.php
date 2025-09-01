<?php
/**
 * Theme Customizer Controls
 *
 * @package lawfiz
 */


if ( ! function_exists( 'lawfiz_customizer_preloader_register' ) ) :
function lawfiz_customizer_preloader_register( $wp_customize ) {
 
 	$wp_customize->add_section(
        'lawfiz_preloader_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Preloader Settings', 'lawfiz' )
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'lawfiz_label_preloader_settings_title', 
		array(
		    'sanitize_callback' => 'lawfiz_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_preloader_settings_title', 
		array(
		    'label'       => esc_html__( 'Preloader Settings', 'lawfiz' ),
		    'section'     => 'lawfiz_preloader_settings',
		    'type'        => 'lawfiz-title',
		    'settings'    => 'lawfiz_label_preloader_settings_title',
		) 
	));

	// Add an option to enable the preloader
	$wp_customize->add_setting( 
		'lawfiz_enable_preloader', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'lawfiz_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Lawfiz_Toggle_Control( $wp_customize, 'lawfiz_enable_preloader', 
		array(
		    'label'       => esc_html__( 'Show Preloader', 'lawfiz' ),
		    'section'     => 'lawfiz_preloader_settings',
		    'type'        => 'lawfiz-toggle',
		    'settings'    => 'lawfiz_enable_preloader',
		) 
	));

}
endif;

add_action( 'customize_register', 'lawfiz_customizer_preloader_register' );