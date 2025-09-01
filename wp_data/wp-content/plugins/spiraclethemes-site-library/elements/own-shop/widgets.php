<?php


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Widgets
 *
 *
 * @since 1.0.0
 */
class Own_Shop_Add_Widgets {

	public function get_widgets() {
		// Include Widget files
        require_once SPIR_SITE_LIBRARY_PATH  . '/elements/own-shop/list-prod/template/config.php';

        // Register widget
        \Elementor\Plugin::instance()->widgets_manager->register( new Own_Shop_ListProd() );

        // Include Widget files
        require_once SPIR_SITE_LIBRARY_PATH  . '/elements/own-shop/featured-prod/template/config.php';

        // Register widget
        \Elementor\Plugin::instance()->widgets_manager->register( new Own_Shop_FeaturedProd() );

        // Include Widget files
        require_once SPIR_SITE_LIBRARY_PATH  . '/elements/own-shop/new-prod/template/config.php';

        // Register widget
        \Elementor\Plugin::instance()->widgets_manager->register( new Own_Shop_NewProd() );

        // Include Widget files
        require_once SPIR_SITE_LIBRARY_PATH  . '/elements/own-shop/popular-prod/template/config.php';

        // Register widget
        \Elementor\Plugin::instance()->widgets_manager->register( new Own_Shop_PopularProd() );

        // Include Widget files
        require_once SPIR_SITE_LIBRARY_PATH  . '/elements/own-shop/recent-blog/template/config.php';

        // Register widget
        \Elementor\Plugin::instance()->widgets_manager->register( new Own_Shop_RecentBlog() );
	}
}