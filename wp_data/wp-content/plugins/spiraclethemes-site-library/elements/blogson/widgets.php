<?php


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Widgets
 *
 *
 * @since 1.0.0
 */
class Blogson_Add_Widgets {

	public function get_widgets() {
		// Include Post Grid Widget files
        require_once SPIR_SITE_LIBRARY_PATH  . '/elements/blogson/post-grid/template/config.php';

        // Register widget
        \Elementor\Plugin::instance()->widgets_manager->register( new Blogson_Postgrid() );
	}
}