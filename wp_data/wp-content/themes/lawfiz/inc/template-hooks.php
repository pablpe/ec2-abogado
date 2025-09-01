<?php
/**
 * Custom template hooks for this theme.
 *
 *
 * @package lawfiz
 */


/**
 * Before title meta hook
 */
if ( ! function_exists( 'lawfiz_before_title' ) ) :
function lawfiz_before_title() {
	do_action('lawfiz_before_title');
}
endif;


/**
 * Before title content hook
 */
if ( ! function_exists( 'lawfiz_before_title_content' ) ) :
	function lawfiz_before_title_content() {
		do_action('lawfiz_before_title_content');
	}
endif;


/**
 * After title content hook
 */
if ( ! function_exists( 'lawfiz_after_title_content' ) ) :
	function lawfiz_after_title_content() {
		do_action('lawfiz_after_title_content');
	}
endif;


/**
 * After title meta hook
 */
if ( ! function_exists( 'lawfiz_after_title' ) ) :
function lawfiz_after_title() {
	do_action('lawfiz_after_title');
}
endif;


/**
 * topbar meta hook
 */
if ( ! function_exists( 'lawfiz_action_enable_header_topbar_style' ) ) :
function lawfiz_action_enable_header_topbar_style() {
	do_action('lawfiz_action_enable_header_topbar_style');
}
endif;


/**
 * WooCommerce show responsive menu cart icon
 */
if ( ! function_exists( 'lawfiz_responsive_woocommerce_cart_menu_icon' ) ) :
	function lawfiz_responsive_woocommerce_cart_menu_icon() {
		do_action('lawfiz_responsive_woocommerce_cart_menu_icon');
	}
endif;
	
	
/**
 * WooCommerce show cart
 */
if ( ! function_exists( 'lawfiz_woocommerce_show_cart' ) ) :
	function lawfiz_woocommerce_show_cart() {
		do_action('lawfiz_woocommerce_show_cart');
	}
endif;
	

/**
 * Single post content after meta hook
 */
if ( ! function_exists( 'lawfiz_single_post_after_content' ) ) :
	function lawfiz_single_post_after_content($postID) {
		do_action('lawfiz_single_post_after_content',$postID);
	}
endif;