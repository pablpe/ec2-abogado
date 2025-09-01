<?php
/**
 * Theme Customizer Controls
 *
 * @package lawfiz
 */


if ( ! function_exists( 'lawfiz_customizer_page_register' ) ) :
function lawfiz_customizer_page_register( $wp_customize ) {
 
 	$wp_customize->add_section(
        'lawfiz_page_settings',
        array (
            'priority'      => 25,
            'capability'    => 'edit_theme_options',
            'title'         => esc_html__( 'Page Settings', 'lawfiz' )
        )
    );

    // Info label
     $wp_customize->add_setting( 
        'lawfiz_label_page_title_hide_settings', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_page_title_hide_settings', 
        array(
            'label'       => esc_html__( 'Hide Page Title', 'lawfiz' ),
            'section'     => 'lawfiz_page_settings',
            'type'        => 'lawfiz-title',
            'settings'    => 'lawfiz_label_page_title_hide_settings',
        ) 
    ));

  

    // Hide page title section
    $wp_customize->add_setting(
        'lawfiz_enable_page_title',
        array(
            'type' => 'theme_mod',
            'default'           => true,
            'sanitize_callback' => 'lawfiz_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new Lawfiz_Toggle_Control( $wp_customize, 'lawfiz_enable_page_title', 
        array(
            'settings'      => 'lawfiz_enable_page_title',
            'section'       => 'lawfiz_page_settings',
            'type'          => 'lawfiz-toggle',
            'label'         => esc_html__( 'Show Page Title Section:', 'lawfiz' ),
            'description'   => '',           
        )
    ));


    // Info label
    $wp_customize->add_setting( 
        'lawfiz_label_page_breadcrumb_settings', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_page_breadcrumb_settings', 
        array(
            'label'       => esc_html__( 'Breadcrumb Settings', 'lawfiz' ),
            'section'     => 'lawfiz_page_settings',
            'type'        => 'title',
            'settings'    => 'lawfiz_label_page_breadcrumb_settings',
            'active_callback' => 'lawfiz_page_title_enable',
        ) 
    ));


    // Add an option to enable the breadcrumbs
	$wp_customize->add_setting( 
		'lawfiz_enable_page_breadcrumbs', 
		array(
		    'default'           => true,
		    'type'              => 'theme_mod',
		    'sanitize_callback' => 'lawfiz_sanitize_checkbox',
		) 
	);

	$wp_customize->add_control( 
		new Lawfiz_Toggle_Control( $wp_customize, 'lawfiz_enable_page_breadcrumbs', 
		array(
		    'label'       => esc_html__( 'Show Breadcrumbs', 'lawfiz' ),
		    'section'     => 'lawfiz_page_settings',
		    'type'        => 'lawfiz-toggle',
		    'settings'    => 'lawfiz_enable_page_breadcrumbs',
		    'active_callback' => 'lawfiz_page_title_enable',
		) 
	));


	// Choose the breadcrumb type
	$wp_customize->add_setting(
        'lawfiz_page_breadcrumb_select_radio',
        array(
            'type' => 'theme_mod',
            'default'           => 'default',
            'sanitize_callback' => 'lawfiz_sanitize_select'
        )
    );

    $wp_customize->add_control(
    	new Lawfiz_Text_Radio_Control( $wp_customize, 'lawfiz_page_breadcrumb_select_radio',
        array(
            'settings'      => 'lawfiz_page_breadcrumb_select_radio',
            'section'       => 'lawfiz_page_settings',
            'type'          => 'radio',
            'label'         => esc_html__( 'Choose Breadcrumb Type:', 'lawfiz' ),
            'choices' => array(
                            'default' => esc_html__('Default','lawfiz'),
                            'navxt' => esc_html__('NavXT','lawfiz'),
                            'yoast' => esc_html__('Yoast','lawfiz'),
                            ),
            'active_callback' => 'lawfiz_breadcrumb_enable',
        )
    ));


    // Info label
    $wp_customize->add_setting( 
        'lawfiz_label_page_title_bg_settings', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_page_title_bg_settings', 
        array(
            'label'       => esc_html__( 'Page Title Background', 'lawfiz' ),
            'section'     => 'lawfiz_page_settings',
            'type'        => 'title',
            'settings'    => 'lawfiz_label_page_title_bg_settings',
            'active_callback' => 'lawfiz_page_title_enable',
        ) 
    ));

    // Background selection
    $wp_customize->add_setting(
        'lawfiz_page_bg_radio',
        array(
            'type' => 'theme_mod',
            'default'           => 'color',
            'sanitize_callback' => 'lawfiz_sanitize_select'
        )
    );

    $wp_customize->add_control(
    	new Lawfiz_Text_Radio_Control( $wp_customize, 'lawfiz_page_bg_radio',
        array(
            'settings'      => 'lawfiz_page_bg_radio',
            'section'       => 'lawfiz_page_settings',
            'type'          => 'radio',
            'label'         => esc_html__( 'Choose Page Title Background Color or Background Image:', 'lawfiz' ),
            'description'   => esc_html__('This setting will change the background of the page title area.', 'lawfiz'),
            'choices' => array(
                            'color' => esc_html__('Background Color','lawfiz'),
                            'image' => esc_html__('Background Image','lawfiz'),
                            ),
            'active_callback' => 'lawfiz_page_title_enable',
        )
    ));


    // Background color
    $wp_customize->add_setting(
        'lawfiz_page_bg_color',
        array(
            'type' => 'theme_mod',
            'default'           => '#a2824d',
            'sanitize_callback' => 'sanitize_hex_color'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'lawfiz_page_bg_color',
            array(
                'label'      => esc_html__( 'Select Background Color', 'lawfiz' ),
                'description'   => esc_html__('This setting will add background color to the page title area if Background Color was selected above.', 'lawfiz'),
                'section'    => 'lawfiz_page_settings',
                'settings'   => 'lawfiz_page_bg_color',
                'active_callback' => 'lawfiz_page_title_color_enable',
            )
        )
    );
    

    // Info label
    $wp_customize->add_setting( 
        'lawfiz_note', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_note', 
        array(
            'label'       => esc_html__( 'Note: You have to select image from featured image section of page', 'lawfiz' ),
            'section'     => 'lawfiz_page_settings',
            'type'        => 'title',
            'settings'    => 'lawfiz_note',
            'active_callback' => 'lawfiz_page_title_enable',
        ) 
    ));
    

    // Info label
    $wp_customize->add_setting( 
        'lawfiz_label_page_title_dark_overlay', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_page_title_dark_overlay', 
        array(
            'label'       => esc_html__( 'Dark Overlay Settings', 'lawfiz' ),
            'section'     => 'lawfiz_page_settings',
            'type'        => 'title',
            'settings'    => 'lawfiz_label_page_title_dark_overlay',
            'active_callback' => 'lawfiz_page_title_enable',
        ) 
    ));

    // Enable Dark Overlay
    $wp_customize->add_setting(
        'lawfiz_page_dark_overlay',
        array(
            'type' => 'theme_mod',
            'default'           => false,
            'sanitize_callback' => 'lawfiz_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        new Lawfiz_Toggle_Control( $wp_customize, 'lawfiz_page_dark_overlay', 
        array(
            'settings'      => 'lawfiz_page_dark_overlay',
            'section'       => 'lawfiz_page_settings',
            'type'          => 'lawfiz-toggle',
            'label'         => esc_html__( 'Enable Dark Overlay:', 'lawfiz' ),
            'description'   => esc_html__( 'Choose whether to show a dark overlay over page header background', 'lawfiz' ), 
            'active_callback' => 'lawfiz_page_title_enable',          
        )
    ));

     
    // Info label
    $wp_customize->add_setting( 
        'lawfiz_label_page_title_spacing', 
        array(
            'sanitize_callback' => 'lawfiz_sanitize_title',
        ) 
    );

    $wp_customize->add_control( 
        new Lawfiz_Title_Info_Control( $wp_customize, 'lawfiz_label_page_title_spacing', 
        array(
            'label'       => esc_html__( 'Page Title Spacing', 'lawfiz' ),
            'section'     => 'lawfiz_page_settings',
            'type'        => 'lawfiz-title',
            'settings'    => 'lawfiz_label_page_title_spacing',
            'active_callback' => 'lawfiz_page_title_enable',
        ) 
    ));

    // page title height from top //
    $wp_customize->add_setting(
        'lawfiz_pagetitle_hft',
        array(
            'type' => 'theme_mod',
            'default'           => '50',
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
    	new Lawfiz_Slider_Control( $wp_customize, 'lawfiz_pagetitle_hft',
        array(
            'settings'      => 'lawfiz_pagetitle_hft',
            'section'       => 'lawfiz_page_settings',
            'label'         => esc_html__( 'Page Title Height from Top(px)', 'lawfiz' ),
            'description'   => esc_html__( 'Add top padding to page title', 'lawfiz' ),
            'input_attrs' => array(
                'min' => 0, 
                'max' => 500,
                'step' => 1,
            ),
            'active_callback' => 'lawfiz_page_title_enable',
        )
    ));

    // page title height from bottom //
    $wp_customize->add_setting(
        'lawfiz_pagetitle_hfb',
        array(
            'type' => 'theme_mod',
            'default'           => '50',
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control(
    	new Lawfiz_Slider_Control( $wp_customize, 'lawfiz_pagetitle_hfb',
        array(
            'settings'      => 'lawfiz_pagetitle_hfb',
            'section'       => 'lawfiz_page_settings',
            'label'         => esc_html__( 'Page Title Height from Bottom(px)', 'lawfiz' ),
            'description'   => esc_html__( 'Add bottom padding to page title', 'lawfiz' ),
            'input_attrs' => array(
                'min' => 0, 
                'max' => 500,
                'step' => 1,
            ),
            'active_callback' => 'lawfiz_page_title_enable',
        )
    ));

    
}
endif;

add_action( 'customize_register', 'lawfiz_customizer_page_register' );