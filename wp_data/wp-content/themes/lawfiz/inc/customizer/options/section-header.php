<?php
/**
 * Theme Customizer Controls
 *
 * @package lawfiz
 */


if ( ! function_exists( 'lawfiz_customizer_header_register' ) ) :
function lawfiz_customizer_header_register( $wp_customize ) {
	
	$wp_customize->add_panel(
        'lawfiz_header_settings_panel',
        array (
            'priority'      => 30,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Header Settings', 'lawfiz' ),
        )
    );

	// Section Header Styles
    $wp_customize->add_section(
        'lawfiz_header_styles_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Header Styles', 'lawfiz' ),
            'panel'          => 'lawfiz_header_settings_panel',
        )
    ); 


    // Title label
	$wp_customize->add_setting( 
		'lawfiz_label_header_styles_show', 
		array(
		    'sanitize_callback' => 'lawfiz_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_header_styles_show', 
		array(
		    'label'       => esc_html__( 'Header Styles', 'lawfiz' ),
		    'section'     => 'lawfiz_header_styles_settings',
		    'type'        => 'lawfiz-title',
		    'settings'    => 'lawfiz_label_header_styles_show',
		) 
	));


    $wp_customize->add_setting( 
        'lawfiz_select_header_styles', 
        array(
            'default'           => 'style1',
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'lawfiz_sanitize_select',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Text_Radio_Control( $wp_customize, 'lawfiz_select_header_styles', 
        array(
            'label'       => esc_html__( 'Choose Header Style', 'lawfiz' ),
            'section'     => 'lawfiz_header_styles_settings',
            'type'        => 'lawfiz-text-radio',
            'settings'    => 'lawfiz_select_header_styles',
            'choices' => array( 
                'style1' => esc_html__( 'Normal','lawfiz' ),
                'style2' => esc_html__( 'Transparent','lawfiz' ),
                ),

        ) 
    ));


    /*================================*/

    // Section Header Styles
    $wp_customize->add_section(
        'lawfiz_header_menu_styles_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Header Menu', 'lawfiz' ),
            'panel'          => 'lawfiz_header_settings_panel',
        )
    ); 

    // Title label
    $wp_customize->add_setting( 
        'lawfiz_label_header_menu_button_show', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_header_menu_button_show', 
        array(
            'label'       => esc_html__( 'Menu Last Button', 'lawfiz' ),
            'section'     => 'lawfiz_header_menu_styles_settings',
            'type'        => 'lawfiz-title',
            'settings'    => 'lawfiz_label_header_menu_button_show',
        ) 
    ));


    // Enable last menu as button
    $wp_customize->add_setting(
        'lawfiz_enable_last_menu_button',
        array(
            'type' => 'theme_mod',
            'default'           => false,
            'sanitize_callback' => 'lawfiz_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new Lawfiz_Toggle_Control( $wp_customize, 'lawfiz_enable_last_menu_button', 
        array(
            'settings'      => 'lawfiz_enable_last_menu_button',
            'section'       => 'lawfiz_header_menu_styles_settings',
            'type'          => 'lawfiz-toggle',
            'label'         => esc_html__( 'Make last menu item as button', 'lawfiz' ),
            'description'   => esc_html__( 'This will make last menu item as button which can be used as a call to action', 'lawfiz' ),         
        )
    ));


    // Title label
    $wp_customize->add_setting( 
        'lawfiz_label_header_menu_spacing_show', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_header_menu_spacing_show', 
        array(
            'label'       => esc_html__( 'Header Menu Spacing', 'lawfiz' ),
            'section'     => 'lawfiz_header_menu_styles_settings',
            'type'        => 'lawfiz-title',
            'settings'    => 'lawfiz_label_header_menu_spacing_show',
        ) 
    ));


    // menu margin spacing
    $wp_customize->add_setting(
        'lawfiz_header_menu_margin_spacing',
        array(
            'type' => 'theme_mod',
            'default'           => '20',
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        new Lawfiz_Slider_Control( $wp_customize, 'lawfiz_header_menu_margin_spacing',
        array(
            'settings'      => 'lawfiz_header_menu_margin_spacing',
            'section'       => 'lawfiz_header_menu_styles_settings',
            'label'         => esc_html__( 'Menu Margin Spacing', 'lawfiz' ),
            'description'   => esc_html__( 'Add margins to menu', 'lawfiz' ),
            'input_attrs' => array(
                'min' => 0, 
                'max' => 200,
                'step' => 1,
            ),
        )
    ));


    // menu padding spacing
    $wp_customize->add_setting(
        'lawfiz_header_menu_padding_spacing',
        array(
            'type' => 'theme_mod',
            'default'           => '20',
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
        new Lawfiz_Slider_Control( $wp_customize, 'lawfiz_header_menu_padding_spacing',
        array(
            'settings'      => 'lawfiz_header_menu_padding_spacing',
            'section'       => 'lawfiz_header_menu_styles_settings',
            'label'         => esc_html__( 'Menu Padding Spacing', 'lawfiz' ),
            'description'   => esc_html__( 'Add paddings to menu', 'lawfiz' ),
            'input_attrs' => array(
                'min' => 0, 
                'max' => 200,
                'step' => 1,
            ),
        )
    ));


    // Title label
    $wp_customize->add_setting( 
        'lawfiz_label_header_res_toggle_menu', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_header_res_toggle_menu', 
        array(
            'label'       => esc_html__( 'Mobile Toggle Menu', 'lawfiz' ),
            'section'     => 'lawfiz_header_menu_styles_settings',
            'type'        => 'lawfiz-title',
            'settings'    => 'lawfiz_label_header_res_toggle_menu',
        ) 
    ));

    // toggle menu padding spacing
    $wp_customize->add_setting(
        'lawfiz_header_res_toggle_menu_spacing',
        array(
            'type' => 'theme_mod',
            'default'           => '0',
            'sanitize_callback' => 'lawfiz_sanitize_integer'
        )
    );

    $wp_customize->add_control(
        new Lawfiz_Slider_Control( $wp_customize, 'lawfiz_header_res_toggle_menu_spacing',
        array(
            'settings'      => 'lawfiz_header_res_toggle_menu_spacing',
            'section'       => 'lawfiz_header_menu_styles_settings',
            'label'         => esc_html__( 'Toggle Menu Spacing', 'lawfiz' ),
            'input_attrs' => array(
                'min' => -100, 
                'max' => 100,
                'step' => 1,
            ),
        )
    ));

}
endif;

add_action( 'customize_register', 'lawfiz_customizer_header_register' );