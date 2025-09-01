<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


function blogson_elementor_widget_categories( $elements_manager ) {

    $categories = [];
    $categories['sslb-elementor'] =
        [
            'title'  => esc_html__('Blogson Free Elements', 'spiraclethemes-site-library'),
            'icon'   => 'eicon-font',
        ];

    $old_categories = $elements_manager->get_categories();
    $categories = array_merge($categories, $old_categories);

    $set_categories = function ( $categories ) {
        $this->categories = $categories;
    };

    $set_categories->call( $elements_manager, $categories );

}
add_action( 'elementor/elements/categories_registered', 'blogson_elementor_widget_categories', 1 );
