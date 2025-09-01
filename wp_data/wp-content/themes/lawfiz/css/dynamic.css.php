<?php
/**
 * Lawfiz: Dynamic CSS Stylesheet
 * 
 */

function lawfiz_dynamic_css_stylesheet() {

    $header_logo_spacing_top= absint(get_theme_mod( 'lawfiz_header_logo_spacing_top','20' ));
    $header_logo_spacing_bottom= absint(get_theme_mod( 'lawfiz_header_logo_spacing_bottom','20' ));

    $link_color= sanitize_hex_color(get_theme_mod( 'lawfiz_link_color','#C39953' ));
    $link_hover_color= sanitize_hex_color(get_theme_mod( 'lawfiz_link_hover_color','#a0762f' ));

    $header_menu_margin_spacing= absint(get_theme_mod( 'lawfiz_header_menu_margin_spacing','20' ));
    $header_res_toggle_menu_spacing= intval(get_theme_mod( 'lawfiz_header_res_toggle_menu_spacing','0' ));

    $header_menu_padding_spacing= absint(get_theme_mod( 'lawfiz_header_menu_padding_spacing','20' ));

    $heading_color= sanitize_hex_color(get_theme_mod( 'lawfiz_heading_color','#444444' ));
    $heading_hover_color= sanitize_hex_color(get_theme_mod( 'lawfiz_heading_hover_color','#000000' ));
    
    $button_color= sanitize_hex_color(get_theme_mod( 'lawfiz_button_color','#C39953' ));
    $button_hover_color= sanitize_hex_color(get_theme_mod( 'lawfiz_button_hover_color','#a0762f' ));
    
    $footer_bg_color= sanitize_hex_color(get_theme_mod( 'lawfiz_footer_bg_color','#000000' ));
    $footer_content_color= sanitize_hex_color(get_theme_mod( 'lawfiz_footer_content_color','#ffffff' ));
    $footer_links_color= sanitize_hex_color(get_theme_mod( 'lawfiz_footer_links_color','#b3b3b3' ));
    
    $top_menu_color= sanitize_hex_color(get_theme_mod( 'lawfiz_top_menu_color','#000' ));
    $top_menu_button_color= sanitize_hex_color(get_theme_mod( 'lawfiz_top_menu_button_color','#C39953' ));
    $top_menu_button_hover_color= sanitize_hex_color(get_theme_mod( 'lawfiz_top_menu_button_hover_color','#a0762f' ));
    $top_menu_button_text_color= sanitize_hex_color(get_theme_mod( 'lawfiz_top_menu_button_text_color','#fff' ));
    $top_menu_dd_bg_color= sanitize_hex_color(get_theme_mod( 'lawfiz_top_menu_dd_bg_color','#eaeaea' ));
    $top_menu_dd_text_color= sanitize_hex_color(get_theme_mod( 'lawfiz_top_menu_dd_text_color','#444' ));
    
    $page_bg_image_text_color= sanitize_hex_color(get_theme_mod( 'lawfiz_page_bg_image_text_color','#ffffff' ));
    $pagetitle_hft= absint(get_theme_mod( 'lawfiz_pagetitle_hft','50' ));
    $pagetitle_hfb= absint(get_theme_mod( 'lawfiz_pagetitle_hfb','50' ));
    $footerspacing_pt=absint(get_theme_mod('lawfiz_footer_padding_top','12'));
    $footerspacing_pr=absint(get_theme_mod('lawfiz_footer_padding_right','12'));
    $breadcrumbs_color= sanitize_hex_color(get_theme_mod( 'lawfiz_breadcrumb_text_color','#fff' )); 
    

    $css = '        

        footer h4.widget-title {
            margin-bottom: 20px !important;
        }

        a {        
            color: ' . $link_color . '; 
        }

        a:hover {
            color: ' . $link_hover_color . '; 
            
        }  

        h1,h2,h3,h4,h5,h6 {        
            color: ' . $heading_color . '; 
        }

        h1:hover,
        h2:hover,
        h3:hover,
        h4:hover,
        h5:hover,
        h6:hover {
            color: ' . $heading_hover_color . ';    
        }

        footer h4.widget-title:hover {
            color: ' . $footer_content_color . ';
        }

        .logo .custom-logo-link > img {
            margin-top: ' . $header_logo_spacing_top . 'px;
            margin-bottom: ' . $header_logo_spacing_bottom . 'px;
        }

        .form-submit .submit{
            background: ' . $button_color . ' !important;
        }

        .form-submit .submit:hover {
            background: ' . $button_hover_color . ' !important;        
        }

        .slider-buttons a .btn-default {
            background:none !important;
        }

        .pagination .nav-links .current {
            background: ' . $link_color . ' !important;
        }

        footer#footer {        
            background: ' . $footer_bg_color . ';
            color: ' . $footer_content_color . ';
        }

        footer h4 {
            color: ' . $footer_content_color . ';   
        }

        footer#footer a,
        footer#footer a:hover {
            color: ' . $footer_links_color . ';      
        }

        .section-title.page-title {
            padding-top: ' . $pagetitle_hft . 'px;
            padding-bottom: ' . $pagetitle_hfb . 'px;
        }

        header.style1 .top-menu ul.navigation > li a:not(.top-menu .navigation > li:last-child a),
        header.style1 .site-title a, 
        header.style1 .site-title a:hover, 
        header.style1 .site-title a:focus, 
        header.style1 .site-title a:visited,
        header.style1 p.site-description,
        header.style1 .navbar-toggle {
            color: ' . $top_menu_color . ';      
        }

        header.menu-wrapper.fixed nav ul li a,
        header.menu-wrapper.style1.fixed nav ul li a {
            color: #555;
        }

        li.menu-button > a {
            background-color: ' . $top_menu_button_color . ';
            color: ' . $top_menu_button_text_color . ' !important;        
        }

       li.menu-button > a:active,
       li.menu-button > a:hover {
            background-color: ' . $top_menu_button_color . ';
            color: ' . $top_menu_button_text_color . ' !important;
        }

        header.menu-wrapper.fixed nav ul li.menu-button a, 
        header.menu-wrapper.style1.fixed nav ul li.menu-button a {
            color: ' . $top_menu_button_text_color . ' !important;   
            background: ' . $top_menu_button_color . ';
        }

        .section-title h1 {
            color: ' . $page_bg_image_text_color . ';            
        }

        .page-title span,
        .page-title span a,
        .page-title #breadcrumbs,
        .page-title #breadcrumbs a {
            color: ' . $breadcrumbs_color . ';
        }
    
        .page-title .breadcrumbs li:after {
            content: ">";
            display: inline-block;
            color: ' . $breadcrumbs_color . ';
        } 

        .footer-widgets-wrapper .widget-column{
            padding-top: ' . $footerspacing_pt . 'px;
            padding-right: ' . $footerspacing_pr . 'px;
            padding-left: ' . $footerspacing_pr . 'px;
        }

        form.wpcf7-form select {
            padding-left: 20px;
            margin-top: 20px;
        }

        .elementor-editor-active header.style2.menu-wrapper.fixed, 
        .elementor-editor-active header.style1.menu-wrapper.fixed {
            display: none;
        }

        .elementor-editor-active header.style2 {
            z-index: 0;
            display: none;
        }

        .top-menu .navigation>li {
            margin: 0 ' . $header_menu_margin_spacing . 'px;
        }

        ul.navigation>li a:not(.top-menu .navigation>li:last-child a) {
            padding: 20px ' . $header_menu_padding_spacing . 'px;
        }

        .dropdown-menu>li>a:focus,
        .top-menu .navigation>li>ul>li:hover>a, 
        .top-menu .navigation>li>ul>li>ul>li>a:hover {
            color: ' . $top_menu_dd_text_color . ' !important;
            background-color: ' . $top_menu_dd_bg_color . ';
        }

        @media (max-width: 991px) {
            .footer-widgets-wrapper .widget-column {
                padding: 0 !important;
            }

            .top-menu-wrapper nav.responsive-mobile,
            .top-menu-wrapper ul.md-cart-menu {
                margin-top: ' . $header_res_toggle_menu_spacing . 'px;
            }
        }
    ';

    // shop buttons color
    if(true===get_theme_mod('lfpa_menu_cart',true)) {
        $css .='
            .woocommerce .widget_price_filter .price_slider_amount .button{
                background-color: ' . $button_color. ';
            }
        ';
    }

   //if sticky header disabled
    if(false===get_theme_mod( 'lawfiz_sticky_menu',true)) {
        $css .='        
             header.menu-wrapper.fixed { 
                display:none !important;
            }           
        ';  
    }

    // if page title dark overlay enabled
    if(true===get_theme_mod( 'lawfiz_page_dark_overlay',false)) {
        $css .='        
             .page-title .img-overlay {
                background: rgba(0,0,0,.5);
                color: #fff;
            }          
        ';  
    }

    // breadcrumb enable
    if( true === get_theme_mod( 'lawfiz_enable_page_breadcrumbs',true)) {
        $css .='

            .page-title h1 {
                padding-bottom: 0;
            }

            .page-title #breadcrumbs {
                margin-top: 10px;
                margin-bottom: 30px;
            }

            .page-title span {
                display: inline-block;
                margin-top: 5px;
                margin-bottom: 15px;
            }

            .page-title .breadcrumbs li {
                display: inline-block;
                padding: 0 3px;
            }

            .page-title .breadcrumbs li:after {
                content: ">";
                display: inline-block;
            }

            .page-title .breadcrumbs li:last-child::after {
                display: none;
            }

            .page-title .breadcrumbs li a {
                padding-left: 10px;
                vertical-align: inherit;
            }

            .page-title .breadcrumb-wrapper span a {
                vertical-align: inherit;
            }

            .page-title h1 {
                padding-bottom: 0;
            }

            .page-title span {
                display: inline-block;
                margin-top: 5px;
                margin-bottom: 15px;
            }
        ';
    }

    // is customize preview
    if ( !is_customize_preview() ) {
         $css .='
            .admin-bar header.style2 {
                margin-top: 30px;
            }

        ';
    }


    // Check if last menu button enabled
    if(true===get_theme_mod( 'lawfiz_enable_last_menu_button',false)){
        $css .='
            .top-menu .navigation > li:last-child{
                color: ' . $top_menu_button_text_color . ';
                background: ' . $top_menu_button_color . ';
                    
            }

            .top-menu .navigation > li:last-child:hover {
                background: ' . $top_menu_button_hover_color . ';
            }
        ';
    }
    else{
        $css .='
        .top-menu .navigation > li:last-child{
            background: none;
            float: none;
            border-radius: none;
            margin :0;
            color: ' . $top_menu_color . ';
        }

        .top-menu .navigation > li:last-child:hover{
            background: none;
        }

        .style1 .top-menu .navigation > li:last-child a {
            color: ' . $top_menu_color . ';
                    
        }

        .top-menu .navigation>li:last-child {
            margin: 0 ' . $header_menu_margin_spacing . 'px;
            padding: 0;
        }

        .top-menu .navigation>li:last-child a {
            padding: 20px ' . $header_menu_padding_spacing . 'px;
        }

        ';
    }

    return apply_filters( 'lawfiz_dynamic_css_stylesheet', lawfiz_minimize_css($css));
}
