<?php
/**
 * @package lawfiz
 */


/**
 * Header
 */
 if (! function_exists('lawfiz_header_menu_styles')) :
    function lawfiz_header_menu_styles() {
        get_template_part( 'inc/header-menu/content',esc_html(get_theme_mod('lawfiz_select_header_styles','style1')));
    }
 endif;
 add_action( 'lawfiz_action_header', 'lawfiz_header_menu_styles' ); 


/**
 * Function for Minimizing dynamic CSS
 */
function lawfiz_minimize_css($css){
    $css = preg_replace('/\/\*((?!\*\/).)*\*\//', '', $css);
    $css = preg_replace('/\s{2,}/', ' ', $css);
    $css = preg_replace('/\s*([:;{}])\s*/', '$1', $css);
    $css = preg_replace('/;}/', '}', $css);
    return $css;
}


/**
 * Footer
 */
 if (! function_exists( 'lawfiz_footer_copyrights' ) ):
    function lawfiz_footer_copyrights() {
        ?>
            <div class="row">
                <div class="copyrights">
                    <p>
                        <?php
                            if("" != esc_html(get_theme_mod( 'lawfiz_footer_copyright_text'))) :
                                echo esc_html(get_theme_mod( 'lawfiz_footer_copyright_text'));
                                if(get_theme_mod('lawfiz_en_footer_credits',true)) :
                                    ?>
                                    <span><?php esc_html_e(' | Theme by ','lawfiz') ?><a href="<?php echo esc_url(LAWFIZ_THEME_AUTH); ?>" target="_blank" rel="nofollow noopener"><?php esc_html_e('Spiracle Themes','lawfiz') ?></a></span>
                                    <?php   
                                endif;
                            else :
                                echo date_i18n(
                                    /* translators: Copyright date format, see https://secure.php.net/date */
                                    _x( 'Y', 'copyright date format', 'lawfiz' )
                                );
                                ?>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                                    <span><?php esc_html_e(' | Theme by ','lawfiz') ?><a href="<?php echo esc_url(LAWFIZ_THEME_AUTH); ?>" target="_blank" rel="nofollow noopener"><?php esc_html_e('Spiracle Themes','lawfiz') ?></a></span>
                                <?php
                            endif;
                        ?>
                        <?php
                            if(true===get_theme_mod( 'lawfiz_footer_enable_footer_links',false)) :
                                ?>
                                    <span class="copyrights-links">
                                        <?php
                                            if("" != esc_html(get_theme_mod( 'lawfiz_footer_link_1_text'))) :
                                                ?>
                                                    <span>|</span>
                                                    <a href="<?php echo esc_url(get_theme_mod( 'lawfiz_footer_link_1_url')); ?>"><?php echo esc_html(get_theme_mod( 'lawfiz_footer_link_1_text')) ?></a>
                                                <?php
                                            endif;
                                            if("" != esc_html(get_theme_mod( 'lawfiz_footer_link_2_text'))) :
                                                ?>
                                                    <span>|</span>
                                                    <a href="<?php echo esc_url(get_theme_mod( 'lawfiz_footer_link_2_url')); ?>"><?php echo esc_html(get_theme_mod( 'lawfiz_footer_link_2_text')) ?></a>
                                                <?php
                                            endif;
                                            if("" != esc_html(get_theme_mod( 'lawfiz_footer_link_3_text'))) :
                                                ?>
                                                    <span>|</span>
                                                    <a href="<?php echo esc_url(get_theme_mod( 'lawfiz_footer_link_3_url')); ?>"><?php echo esc_html(get_theme_mod( 'lawfiz_footer_link_3_text')) ?></a>
                                                <?php
                                            endif;
                                        ?>
                                    </span>
                                <?php
                            endif;
                        ?>
                    </p>
                </div>
            </div>
        <?php    
    }
endif;
add_action( 'lawfiz_action_footer', 'lawfiz_footer_copyrights' );


/**
 * Page Title Settings
 */
if (!function_exists('lawfiz_show_page_title')):
    function lawfiz_show_page_title( $blogtitle=false,$archivetitle=false,$searchtitle=false,$pagenotfoundtitle=false ) {
        if(!is_front_page()){
            if ('color' === esc_html(get_theme_mod( 'lawfiz_page_bg_radio','color' ))) {
                ?>
                    <div class="page-title" style="background:<?php echo sanitize_hex_color(get_theme_mod( 'lawfiz_page_bg_color','#a2824d' )); ?>;">
                <?php
            }
            else if('image' === esc_html(get_theme_mod( 'lawfiz_page_bg_radio','color' ))){
                $image= esc_url(get_template_directory_uri().'/img/start-bg.jpg');
                
                if ( has_post_thumbnail()) {
                    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
                    ?>
                        <div class="page-title" style="background:url('<?php echo esc_url($featured_img_url) ?>') no-repeat scroll center center / cover;"> 
                    <?php
                }
                else{
                    ?>
                        <div class="page-title"  style="background:url('<?php echo esc_url($image ); ?>') no-repeat scroll center center / cover;">    
                    <?php   
                }
                    
            }
            else{
                ?>
                    <div class="page-title" style="background:#a2824d;"> 
                <?php
            }
            
            ?>
                
                <div class="content-section img-overlay">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <div class="section-title page-title"> 
                                    <?php
                                        if($blogtitle){
                                            ?><h1 class="main-title"><?php single_post_title(); ?></h1><?php
                                        }
                                        if($archivetitle){
                                            ?><h1 class="main-title"><?php the_archive_title(); ?></h1><?php
                                        }
                                        if($searchtitle){
                                            ?><h1 class="main-title"><?php esc_html_e('SEARCH RESULTS','lawfiz') ?></h1><?php
                                        }
                                        if($pagenotfoundtitle){
                                            ?><h1 class="main-title"><?php esc_html_e('PAGE NOT FOUND','lawfiz') ?></h1><?php
                                        }                                       
                                        
                                        if($blogtitle==false && $archivetitle==false && $searchtitle==false && $pagenotfoundtitle==false){
                                            ?><h1 class="main-title"><?php the_title(); ?></h1><?php
                                        }
                                    ?>
                                    <div class="breadcrumb-wrapper">
                                        <?php 
                                            if(get_theme_mod( 'lawfiz_enable_page_breadcrumbs',true)) :
                                                $breadcrumb_from = esc_html(get_theme_mod( 'lawfiz_page_breadcrumb_select_radio','default'));
                                                if (function_exists('yoast_breadcrumb') && $breadcrumb_from == 'yoast') :
                                                    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
                                                elseif (function_exists('bcn_display') && $breadcrumb_from == 'navxt'): 
                                                    bcn_display();
                                                else:
                                                    require get_template_directory() . '/inc/breadcrumbs.php';
                                                    $breadcrumb_args = array(
                                                        'container' => 'div',
                                                        'show_browse' => false
                                                    );        
                                                    breadcrumb_trail($breadcrumb_args);
                                                endif;
                                            endif;
                                        ?>
                                    </div>                                                         
                                </div>                      
                            </div>
                        </div>
                    </div>  
                </div>
                </div>  <!-- End page-title --> 
            <?php
        }
    }
endif;
add_action('lawfiz_get_page_title', 'lawfiz_show_page_title');


/** 
* Disable Plugin Redirect
*/
function lawfiz_prevent_plugins_redirect() {
    delete_transient( 'elementor_activation_redirect' );
}
add_action('admin_init', 'lawfiz_prevent_plugins_redirect');


/**
 * Shop Page Title Settings
 */
if (!function_exists('lawfiz_show_shop_page_title')):
    function lawfiz_show_shop_page_title() {
        if(!is_front_page()){
            if ('color' === esc_html(get_theme_mod( 'lawfiz_page_bg_radio','color' ))) {
                ?>
                    <div class="page-title" style="background:<?php echo sanitize_hex_color(get_theme_mod( 'lawfiz_page_bg_color','#a2824d' )); ?>;">
                <?php
            }
            else if('image' === esc_html(get_theme_mod( 'lawfiz_page_bg_radio','color' ))){
                $image= esc_url(get_template_directory_uri().'/img/start-bg.jpg');
                
                if ( has_post_thumbnail()) {
                    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
                    ?>
                        <div class="page-title" style="background:url('<?php echo esc_url($featured_img_url) ?>') no-repeat scroll center center / cover;"> 
                    <?php
                }
                else{
                    ?>
                        <div class="page-title"  style="background:url('<?php echo esc_url($image ); ?>') no-repeat scroll center center / cover;">    
                    <?php   
                }
                   
            }
            else{
                ?>
                    <div class="page-title" style="background:#a2824d;"> 
                <?php
            }
            
            ?>
                
                <div class="content-section img-overlay">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <div class="section-title page-title"> 
                                    <?php
                                        if ( class_exists( 'woocommerce' ) ) {
                                            if(!is_product()){   
                                                ?><h2 class="main-title"><?php echo esc_html(get_theme_mod( 'lawfiz_shop_name','SHOP' )) ?></h2> <?php
                                            }
                                            else{
                                                ?><h1 class="main-title"><?php the_title(); ?></h1><?php
                                            }
                                        }                                        
                                    ?>
                                    <div class="breadcrumb-wrapper">
                                        <?php 
                                            if(get_theme_mod( 'lawfiz_enable_page_breadcrumbs',true)) :
                                                $breadcrumb_from = esc_html(get_theme_mod( 'lawfiz_page_breadcrumb_select_radio','default'));
                                                if (function_exists('yoast_breadcrumb') && $breadcrumb_from == 'yoast') :
                                                    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
                                                elseif (function_exists('bcn_display') && $breadcrumb_from == 'navxt'): 
                                                    bcn_display();
                                                else:
                                                    require get_template_directory() . '/inc/breadcrumbs.php';
                                                    $breadcrumb_args = array(
                                                        'container' => 'div',
                                                        'show_browse' => false
                                                    );        
                                                    breadcrumb_trail($breadcrumb_args);
                                                endif;
                                            endif;
                                        ?>
                                    </div>                                                         
                                </div>                      
                            </div>
                        </div>
                    </div>  
                </div>
                </div>  <!-- End page-title --> 
            <?php
        }
    }
endif;
add_action('lawfiz_get_shop_page_title', 'lawfiz_show_shop_page_title');