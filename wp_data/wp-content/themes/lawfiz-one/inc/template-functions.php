<?php
/**
 * @package lawfiz-one
 */


/**
 * Header Topbar
 */
if ( ! function_exists( 'lawfiz_enable_header_topbar_style' ) ) :
function lawfiz_enable_header_topbar_style() {
   	if ( is_active_sidebar('topsidebar')) :
   		get_sidebar('topsidebar');
    endif;
}
endif;
add_action('lawfiz_action_enable_header_topbar_style', 'lawfiz_enable_header_topbar_style');