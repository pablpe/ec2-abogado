<?php

/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section
 * 
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lawfiz
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('at-sticky-sidebar'); ?>>
    <?php
        if (function_exists('wp_body_open')) {
            wp_body_open();
        }
        else {
            do_action('wp_body_open');
        }
    ?>

    <?php
        if(true===get_theme_mod('lawfiz_enable_preloader',true)) {
            ?>
                <!-- start preloader -->
                <div class="loader-wrapper lds-flickr">
                    <div id="pre-loader">
                        <div class="loader-pulse"></div>
                    </div>
                </div>
                <!-- end preloader -->
            <?php
        }
    ?>

    <!-- header styles -->
    <?php
        do_action('lawfiz_action_header');
    ?>