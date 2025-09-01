<?php
/**
 * Theme Customizer Controls
 *
 * @package lawfiz
 */


if ( ! function_exists( 'lawfiz_customizer_footer_register' ) ) :
function lawfiz_customizer_footer_register( $wp_customize ) {
 	
 	$wp_customize->add_section(
        'lawfiz_footer_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Footer Settings', 'lawfiz' )
        )
    );

    // Title label
	$wp_customize->add_setting( 
		'lawfiz_label_footer_settings_title', 
		array(
		    'sanitize_callback' => 'lawfiz_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_footer_settings_title', 
		array(
		    'label'       => esc_html__( 'Footer Settings', 'lawfiz' ),
		    'section'     => 'lawfiz_footer_settings',
		    'type'        => 'lawfiz-title',
		    'settings'    => 'lawfiz_label_footer_settings_title',
		) 
	));

	// Copyright text
    $wp_customize->add_setting(
        'lawfiz_footer_copyright_text',
        array(
            'type' => 'theme_mod',
            'sanitize_callback' => 'lawfiz_sanitize_textarea_field'
        )
    );

    $wp_customize->add_control(
        'lawfiz_footer_copyright_text',
        array(
            'settings'      => 'lawfiz_footer_copyright_text',
            'section'       => 'lawfiz_footer_settings',
            'type'          => 'textarea',
            'label'         => esc_html__( 'Footer Copyright Text', 'lawfiz' ),
            'description'   => esc_html__( 'Copyright text to be displayed in the footer. No HTML allowed.', 'lawfiz' )
        )
    ); 

     // Info label
    $wp_customize->add_setting( 
        'lawfiz_label_footer_add_links_settings', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_footer_add_links_settings', 
        array(
            'label'       => esc_html__( 'Footer Copyright Links Settings', 'lawfiz' ),
            'section'     => 'lawfiz_footer_settings',
            'type'        => 'lawfiz-title',
            'settings'    => 'lawfiz_label_footer_add_links_settings',
        ) 
    ));

    $wp_customize->add_setting(
        'lawfiz_footer_enable_footer_links',
        array(
            'type' => 'theme_mod',
            'default'           => false,
            'sanitize_callback' => 'lawfiz_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new Lawfiz_Toggle_Control( $wp_customize, 'lawfiz_footer_enable_footer_links', 
        array(
            'settings'      => 'lawfiz_footer_enable_footer_links',
            'section'       => 'lawfiz_footer_settings',
            'type'          => 'lawfiz-toggle',
            'label'         => esc_html__( 'Enable Footer Links', 'lawfiz' ),
            'description'   => '',           
        )
    ));

    // Link 1 Text
    $wp_customize->add_setting(
        'lawfiz_footer_link_1_text',
        array( 
            'type' => 'theme_mod',           
            'default'           => '',
            'sanitize_callback' => 'lawfiz_sanitize_text_field',
            
        )
    );

    $wp_customize->add_control(
        'lawfiz_footer_link_1_text',
        array(
            'settings'      => 'lawfiz_footer_link_1_text',
            'section'       => 'lawfiz_footer_settings',
            'type'          => 'textbox',
            'description'   => esc_html__( 'Link 1 Text', 'lawfiz' ),
            'active_callback'    => 'lawfiz_footer_copyrights_links_enable',
        )
    );  

    // Link 1 URL
    $wp_customize->add_setting(
        'lawfiz_footer_link_1_url',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'lawfiz_sanitize_url'
        )
    );

    $wp_customize->add_control(
        'lawfiz_footer_link_1_url',
        array(
            'settings'      => 'lawfiz_footer_link_1_url',
            'section'       => 'lawfiz_footer_settings',
            'type'          => 'textbox',
            'description'   => esc_html__( 'Link 1 URL', 'lawfiz' ),
            'active_callback'    => 'lawfiz_footer_copyrights_links_enable',
        )
    );

    // Link 2 Text
    $wp_customize->add_setting(
        'lawfiz_footer_link_2_text',
        array( 
            'type' => 'theme_mod',           
            'default'           => '',
            'sanitize_callback' => 'lawfiz_sanitize_text_field',
            
        )
    );

    $wp_customize->add_control(
        'lawfiz_footer_link_2_text',
        array(
            'settings'      => 'lawfiz_footer_link_2_text',
            'section'       => 'lawfiz_footer_settings',
            'type'          => 'textbox',
            'description'   => esc_html__( 'Link 2 Text', 'lawfiz' ),
            'active_callback'    => 'lawfiz_footer_copyrights_links_enable',
        )
    );  

    // Link 2 URL
    $wp_customize->add_setting(
        'lawfiz_footer_link_2_url',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'lawfiz_sanitize_url'
        )
    );

    $wp_customize->add_control(
        'lawfiz_footer_link_2_url',
        array(
            'settings'      => 'lawfiz_footer_link_2_url',
            'section'       => 'lawfiz_footer_settings',
            'type'          => 'textbox',
            'description'   => esc_html__( 'Link 2 URL', 'lawfiz' ),
            'active_callback'    => 'lawfiz_footer_copyrights_links_enable',
        )
    );

    // Link 3 Text
    $wp_customize->add_setting(
        'lawfiz_footer_link_3_text',
        array( 
            'type' => 'theme_mod',           
            'default'           => '',
            'sanitize_callback' => 'lawfiz_sanitize_text_field',
            
        )
    );

    $wp_customize->add_control(
        'lawfiz_footer_link_3_text',
        array(
            'settings'      => 'lawfiz_footer_link_3_text',
            'section'       => 'lawfiz_footer_settings',
            'type'          => 'textbox',
            'description'   => esc_html__( 'Link 3 Text', 'lawfiz' ),
            'active_callback'    => 'lawfiz_footer_copyrights_links_enable',
        )
    );  

    // Link 3 URL
    $wp_customize->add_setting(
        'lawfiz_footer_link_3_url',
        array(
            'type' => 'theme_mod',
            'default'           => '',
            'sanitize_callback' => 'lawfiz_sanitize_url'
        )
    );

    $wp_customize->add_control(
        'lawfiz_footer_link_3_url',
        array(
            'settings'      => 'lawfiz_footer_link_3_url',
            'section'       => 'lawfiz_footer_settings',
            'type'          => 'textbox',
            'description'   => esc_html__( 'Link 3 URL', 'lawfiz' ),
            'active_callback'    => 'lawfiz_footer_copyrights_links_enable',
        )
    );

    /*================== */

    // Info label
    $wp_customize->add_setting( 
        'lawfiz_label_footer_color_settings', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_footer_color_settings', 
        array(
            'label'       => esc_html__( 'Footer Color Settings', 'lawfiz' ),
            'section'     => 'lawfiz_footer_settings',
            'type'        => 'lawfiz-title',
            'settings'    => 'lawfiz_label_footer_color_settings',
        ) 
    ));   

    // Footer background color
    $wp_customize->add_setting(
        'lawfiz_footer_bg_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_footer_bg_color',
        array(
        'label'      => esc_html__( 'Footer Background Color', 'lawfiz' ),
        'section'    => 'lawfiz_footer_settings',
        'settings'   => 'lawfiz_footer_bg_color',
        ) )
    );    
   

    // Footer Content Color
    $wp_customize->add_setting(
        'lawfiz_footer_content_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_footer_content_color',
        array(
        'label'      => esc_html__( 'Footer Content Color', 'lawfiz' ),
        'section'    => 'lawfiz_footer_settings',
        'settings'   => 'lawfiz_footer_content_color',
        ) )
    );  

    // Footer links Color
    $wp_customize->add_setting(
        'lawfiz_footer_links_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#b3b3b3',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_footer_links_color',
        array(
        'label'      => esc_html__( 'Footer Links Color', 'lawfiz' ),
        'section'    => 'lawfiz_footer_settings',
        'settings'   => 'lawfiz_footer_links_color',
        ) )
    );  

     // Title label
	$wp_customize->add_setting( 
		'lawfiz_label_footer_settings_title', 
		array(
		    'sanitize_callback' => 'lawfiz_sanitize_title',
		) 
	);

	$wp_customize->add_control( 
		new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_footer_settings_title', 
		array(
		    'label'       => esc_html__( 'Footer Spacing', 'lawfiz' ),
		    'section'     => 'lawfiz_footer_settings',
		    'type'        => 'lawfiz-title',
		    'settings'    => 'lawfiz_label_footer_settings_title',
		) 
	));

    // page title height from left //
    $wp_customize->add_setting(
        'lawfiz_footer_padding_top',
        array(
            'type' => 'theme_mod',
            'default'           => '70',
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
    	new Lawfiz_Slider_Control( $wp_customize, 'lawfiz_footer_padding_top',
        array(
            'settings'      => 'lawfiz_footer_padding_top',
            'section'       => 'lawfiz_footer_settings',
            'label'         => esc_html__( 'Footer spacing(top)', 'lawfiz' ),
            'description'   => esc_html__( 'Add spacing to footers', 'lawfiz' ),
            'input_attrs' => array(
                'min' => 0, 
                'max' => 200,
                'step' => 1,
            ),
        )
    ));

     // page title height from right //
     $wp_customize->add_setting(
        'lawfiz_footer_padding_right',
        array(
            'type' => 'theme_mod',
            'default'           => '15',
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
    	new Lawfiz_Slider_Control( $wp_customize, 'lawfiz_footer_padding',
        array(
            'settings'      => 'lawfiz_footer_padding_right',
            'section'       => 'lawfiz_footer_settings',
            'label'         => esc_html__( 'Footer spacing Columns', 'lawfiz' ),
            'description'   => esc_html__( 'Add spacing to footers columns', 'lawfiz' ),
            'input_attrs' => array(
                'min' => 0, 
                'max' => 200,
                'step' => 1,
            ),
        )
    ));

}
endif;

add_action( 'customize_register', 'lawfiz_customizer_footer_register' );