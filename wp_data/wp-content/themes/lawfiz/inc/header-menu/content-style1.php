<?php
/**
 * Template part for displaying header menu
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lawfiz
 */

?>
<?php
    $page_val= is_front_page() ? 'home':'page' ;

?>

<header id="<?php echo esc_attr($page_val);?>-inner" class="elementer-menu-anchor theme-menu-wrapper full-width-menu style1 page" role="banner">
    <?php
        if(true===get_theme_mod('lawfiz_enable_highlighted area',true) && is_front_page()){
            ?><a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('skip to content','lawfiz'); ?> </a> <?php
        }
        else{
        ?><a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('skip to content','lawfiz');?></a> <?php
    }
    ?>

    <?php
        if(true===get_theme_mod('lawfiz_enable_top_bar',false)) :
            /**
            * Hook - lawfiz_action_enable_header_topbar_style
            *
            * @hooked lawfiz_enable_header_topbar_style - 10
            */
            do_action( 'lawfiz_action_enable_header_topbar_style' );
        endif;
    ?>

    <div id="header-main" class="header-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <div class="logo <?php echo (has_custom_logo() ? 'has-logo' : 'no-logo'); ?>" itemscope itemtype="https://schema.org/Organization">
                        <?php 
                            if (has_custom_logo()) :
                                lawfiz_custom_logo();
                            endif;               		                	
                        ?>
                        <?php 
                            if ( get_theme_mod( 'lawfiz_enable_logo_stickyheader', false )) :
                                $alt_logo=esc_url(get_theme_mod( 'lawfiz_logo_stickyheader' ));
                                if(!empty($alt_logo)) :
                                    ?>
                                        <a id="logo-alt" class="logo-alt" href="<?php echo esc_url(home_url( '/' )); ?>"><img src="<?php echo esc_url( get_theme_mod( 'lawfiz_logo_stickyheader' ) ); ?>" alt="<?php esc_attr_e( 'logo', 'lawfiz' ); ?>"></a>
                                    <?php
                                endif;
                            endif;
                        ?>
                        <?php
                            $show_title   = ( true === get_theme_mod( 'lawfiz_display_site_title_tagline', true ) );
                            $header_class = $show_title ? 'site-title' : 'screen-reader-text';
                            if(!empty(get_bloginfo( 'name' ))) {
                                if ( is_front_page() ) {
                                    ?>
                                        <h1 class="<?php echo esc_attr( $header_class ); ?>">
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a>
                                        </h1>

                                    <?php

                                    if(true === get_theme_mod( 'lawfiz_display_site_title_tagline', true )) {
                                        $description = esc_html(get_bloginfo( 'description', 'display' ));
                                        if ( $description || is_customize_preview() ) { 
                                            ?>
                                                <p class="site-description"><?php echo $description; ?></p>
                                            <?php 
                                        }
                                    }
                                }
                                else {
                                    ?>
                                        <p class="<?php echo esc_attr( $header_class ); ?>">
                                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html(bloginfo( 'name' )); ?></a>
                                        </p>
                                    <?php

                                    if(true === get_theme_mod( 'lawfiz_display_site_title_tagline', true )) {
                                        $description = esc_html(get_bloginfo( 'description', 'display' ));
                                        if ( $description || is_customize_preview() ) { 
                                            ?>
                                                <p class="site-description"><?php echo $description; ?></p>
                                            <?php 
                                        }
                                    }
                                }
                            }
                        ?>	
                    </div>                     
                </div>
                <div class="col-9">
                    <div class="top-menu-wrapper">
                        <nav class="top-menu navbar navbar-expand-md" role="navigation" aria-label="<?php esc_attr_e('primary', 'lawfiz'); ?>">
                            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                                <?php
                                    wp_nav_menu(array(
                                        'theme_location' => 'primary',
                                        'depth' => 3,
                                        'container' => 'ul',
                                        'container_class' => 'navigation',
                                        'container_id' => 'menu-primary',
                                        'menu_class' => 'navigation',
                                    ));
                                ?>
                            </div>
                        </nav>

                        <nav class="responsive-mobile">
                            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"><i class="bi bi-list"></i></span>
                            </button>
                            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                                <div class="offcanvas-header">
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <div class="" id="navbar-collapse-2">
                                        <?php
                                            wp_nav_menu(array(
                                                'theme_location' => 'primary',
                                                'depth' => 3,
                                                'container' => 'ul',
                                                'container_class' => 'navbar-nav',
                                                'container_id' => 'menu-primary',
                                                'menu_class' => 'navigation',
                                            ));
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </nav>
                        <?php  do_action( 'lawfiz_woocommerce_show_cart' );  ?>
                    </div>
                </div>                
            </div>
        </div>
    </div>    
</header>

<div class="clearfix"></div>
<div id="content" class="elementor-menu-anchor"></div>

<?php
    if(true===get_theme_mod('lawfiz_enable_highlight_area',true)){
         /**
	    * Hook - lawfiz_action_highlight_area
	    *
	    * @hooked lawfiz_highlight_area - 10
	    */
        do_action('lawfiz_action_highlighted_area');
    }
?>
<div class="content-wrap">

