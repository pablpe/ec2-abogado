<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


function own_shop_elementor_widget_categories( $elements_manager ) {

    $categories = [];
    $categories['sslb-elementor'] =
        [
            'title'  => esc_html__('Own Shop Free', 'spiraclethemes-site-library'),
            'icon'   => 'eicon-font',
        ];

    $old_categories = $elements_manager->get_categories();
    $categories = array_merge($categories, $old_categories);

    $set_categories = function ( $categories ) {
        $this->categories = $categories;
    };

    $set_categories->call( $elements_manager, $categories );

}
add_action( 'elementor/elements/categories_registered', 'own_shop_elementor_widget_categories', 1 );
