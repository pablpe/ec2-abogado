<?php
/**
 * Theme Customizer Controls
 *
 * @package lawfiz
 */


if ( ! function_exists( 'lawfiz_customizer_color_settings_register' ) ) :
function lawfiz_customizer_color_settings_register( $wp_customize ) {
 	
 	// Color Settings 
    $wp_customize->add_section(
        'lawfiz_color_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'theme_supports'=> '',
            'title'         => esc_html__( 'Color Settings', 'lawfiz' )
        )
    );

    // Info label
    $wp_customize->add_setting( 
        'lawfiz_label_color_settings', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_color_settings', 
        array(
            'label'       => esc_html__( 'Color Settings', 'lawfiz' ),
            'section'     => 'lawfiz_color_settings',
            'type'        => 'lawfiz-title',
            'settings'    => 'lawfiz_label_color_settings',
        ) 
    ));        

    
    // Link Color
    $wp_customize->add_setting(
        'lawfiz_link_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#C39953',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_link_color',
        array(
        'label'      => esc_html__( 'Links Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_link_color',
        ) )
    );

    // Link Hover Color
    $wp_customize->add_setting(
        'lawfiz_link_hover_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#a0762f',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_link_hover_color',
        array(
        'label'      => esc_html__( 'Links Hover Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_link_hover_color',
        ) )
    );

    // Heading Color
    $wp_customize->add_setting(
        'lawfiz_heading_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#444444',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_heading_color',
        array(
        'label'      => esc_html__( 'Headings Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_heading_color',
        ) )
    );

    // Heading Hover Color
    $wp_customize->add_setting(
        'lawfiz_heading_hover_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#000000',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_heading_hover_color',
        array(
        'label'      => esc_html__( 'Heading Hover Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_heading_hover_color',
        ) )
    );


    // Buttons Color
    $wp_customize->add_setting(
        'lawfiz_button_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#C39953',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_button_color',
        array(
        'label'      => esc_html__( 'Buttons Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_button_color',
        ) )
    );

    // Buttons Hover Color
    $wp_customize->add_setting(
        'lawfiz_button_hover_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#a0762f',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_button_hover_color',
        array(
        'label'      => esc_html__( 'Buttons Hover Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_button_hover_color',
        ) )
    );    


    // Info label
    $wp_customize->add_setting( 
        'lawfiz_label_menu_color_settings', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_menu_color_settings', 
        array(
            'label'       => esc_html__( 'Top Menu', 'lawfiz' ),
            'section'     => 'lawfiz_color_settings',
            'type'        => 'lawfiz-title',
            'settings'    => 'lawfiz_label_menu_color_settings',
        ) 
    )); 

    // Top menu color
    $wp_customize->add_setting(
        'lawfiz_top_menu_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#000',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_top_menu_color',
        array(
        'label'      => esc_html__( 'Menu Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_top_menu_color',
        ) )
    );

         // Info label
         $wp_customize->add_setting( 
            'lawfiz_label_menu_color_info', 
            array(
                'sanitize_callback' => 'lawfiz_sanitize_title',
            ) 
        );
    
        $wp_customize->add_control( 
            new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_menu_color_info', 
            array(
                'label'       => esc_html__( 'Note:Menu color will not work for transparent header,default color is white.', 'lawfiz' ),
                'section'     => 'lawfiz_color_settings',
                'type'        => 'lawfiz-title',
                'settings'    => 'lawfiz_label_menu_color_info',
            ) 
        )); 
   
    // Top menu button background color
    $wp_customize->add_setting(
        'lawfiz_top_menu_button_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#C39953',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_top_menu_button_color',
        array(
        'label'      => esc_html__( 'Menu Button Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_top_menu_button_color',
        ) )
    );


    // Top menu button hover background color
    $wp_customize->add_setting(
        'lawfiz_top_menu_button_hover_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#a0762f',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_top_menu_button_hover_color',
        array(
        'label'      => esc_html__( 'Menu Button Hover Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_top_menu_button_hover_color',
        ) )
    );

    // Top menu button text color
    $wp_customize->add_setting(
        'lawfiz_top_menu_button_text_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_top_menu_button_text_color',
        array(
        'label'      => esc_html__( 'Menu Button Text Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_top_menu_button_text_color',
        ) )
    );

    // Menu dropdown color
    $wp_customize->add_setting(
        'lawfiz_top_menu_dd_bg_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#eaeaea',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_top_menu_dd_bg_color',
        array(
        'label'      => esc_html__( 'Dropdown Background Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_top_menu_dd_bg_color',
        ) )
    );


    // Menu dropdown text color
    $wp_customize->add_setting(
        'lawfiz_top_menu_dd_text_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#444',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_top_menu_dd_text_color',
        array(
        'label'      => esc_html__( 'Dropdown Text Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_top_menu_dd_text_color',
        ) )
    );

    // Info label
    $wp_customize->add_setting( 
        'lawfiz_label_page_bg_color_settings', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_page_bg_color_settings', 
        array(
            'label'       => esc_html__( 'Page Background Section', 'lawfiz' ),
            'section'     => 'lawfiz_color_settings',
            'type'        => 'lawfiz-title',
            'settings'    => 'lawfiz_label_page_bg_color_settings',
        ) 
    )); 

    // Page Background Image text color
    $wp_customize->add_setting(
        'lawfiz_page_bg_image_text_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#ffffff',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_page_bg_image_text_color',
        array(
        'label'      => esc_html__( 'Page Background Image Text Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_page_bg_image_text_color',
        ) )
    );

   
     // Info label
     $wp_customize->add_setting( 
        'lawfiz_label_breadcrumb_color_settings', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_breadcrumb_color_settings', 
        array(
            'label'       => esc_html__( 'Breadcrumbs', 'lawfiz' ),
            'section'     => 'lawfiz_color_settings',
            'type'        => 'lawfiz-title',
            'settings'    => 'lawfiz_label_breadcrumb_color_settings',
        ) 
    )); 

    // Breadcrumb color
    $wp_customize->add_setting(
        'lawfiz_breadcrumb_text_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#fff',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
        $wp_customize,
        'lawfiz_breadcrumb_text_color',
        array(
        'label'      => esc_html__( 'Breadcrumb Color', 'lawfiz' ),
        'section'    => 'lawfiz_color_settings',
        'settings'   => 'lawfiz_breadcrumb_text_color',
        ) )
    );
 	
}
endif;

add_action( 'customize_register', 'lawfiz_customizer_color_settings_register' );