<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Lawfiz_Rating_Notice {
    private $past_date;

    public function __construct() {
        $this->past_date = false == get_option('lawfiz_maybe_later_time') ? strtotime( '-5 days' ) : strtotime('-15 days');

        if ( current_user_can('administrator') ) {
            if ( empty(get_option('lawfiz_rating_dismiss_notice')) && empty(get_option('lawfiz_rating_already_rated')) ) {
                add_action( 'admin_init', [$this, 'lawfiz_check_theme_install_time'] );
            }
        }

        if ( is_admin() ) {
            add_action( 'admin_head', [$this, 'lawfiz_enqueue_scripts' ] );
        }

        add_action( 'wp_ajax_lawfiz_rating_dismiss_notice', [$this, 'lawfiz_rating_dismiss_notice'] );
        add_action( 'wp_ajax_lawfiz_rating_already_rated', [$this, 'lawfiz_rating_already_rated'] );
        add_action( 'wp_ajax_lawfiz_rating_maybe_later', [$this, 'lawfiz_rating_maybe_later'] );
    }

    public function lawfiz_check_theme_install_time() {   
        $install_date = get_option('lawfiz_activation_time');

        if ( false !== $install_date && $this->past_date >= $install_date ) {
            add_action( 'admin_notices', [$this, 'lawfiz_render_rating_notice' ]);
        }
    }

    public function lawfiz_rating_maybe_later() {
        update_option('lawfiz_maybe_later_time', true);
        update_option('lawfiz_activation_time', strtotime('now'));
    }
    
    public function lawfiz_rating_dismiss_notice() {
        update_option( 'lawfiz_rating_dismiss_notice', true );
    }

    function lawfiz_rating_already_rated() {    
        update_option( 'lawfiz_rating_already_rated' , true );
    }

    public function lawfiz_render_rating_notice() {
        if ( is_admin() ) {

            echo '<div class="notice lawfiz-rating-notice is-dismissible" style="border-left-color: #0073aa!important; display: flex; align-items: center;">
                        <div class="lawfiz-rating-notice-logo">
                        <img class="lawfiz-logo" src="'.get_theme_file_uri().'/inc/activation/img/logo-spiracle.png">
                        </div>
                        <div>
                            <h3>Thank you for using Lawfiz WordPress Theme to build this website!</h3>
                            <p>Could you please do us a BIG favor and give it a 5-star rating on WordPress? Just to help us spread the word and boost our motivation.</p>
                            <p>
                                <a href="https://wordpress.org/support/theme/lawfiz/reviews/?filter=5" target="_blank" class="lawfiz-you-deserve-it button button-primary">OK, you deserve it!</a>
                                <a class="lawfiz-maybe-later"><span class="dashicons dashicons-clock"></span> Maybe Later</a>
                                <a class="lawfiz-already-rated"><span class="dashicons dashicons-yes"></span> I Already did</a>
                            </p>
                        </div>
                </div>';
        }
    }

    public function lawfiz_enqueue_scripts() { 
        echo "
        <script>
        jQuery( document ).ready( function() {

            jQuery(document).on( 'click', '.lawfiz-rating-notice .notice-dismiss', function(e) {
                e.preventDefault();
                jQuery(document).find('.lawfiz-rating-notice').slideUp();
                jQuery.post({
                    url: ajaxurl,
                    data: {
                        action: 'lawfiz_rating_dismiss_notice',
                    }
                })
            });

            jQuery(document).on( 'click', '.lawfiz-maybe-later', function() {
                jQuery(document).find('.lawfiz-rating-notice').slideUp();
                jQuery.post({
                    url: ajaxurl,
                    data: {
                        action: 'lawfiz_rating_maybe_later',
                    }
                })
            });
        
            jQuery(document).on( 'click', '.lawfiz-already-rated', function() {
                jQuery(document).find('.lawfiz-rating-notice').slideUp();
                jQuery.post({
                    url: ajaxurl,
                    data: {
                        action: 'lawfiz_rating_already_rated',
                    }
                })
            });
        });
        </script>

        <style>
            .lawfiz-rating-notice {
              padding: 0 15px;
            }

            .lawfiz-rating-notice-logo {
                margin-right: 20px;
                width: 100px;
                height: 100px;
            }

            .lawfiz-rating-notice-logo img {
                max-width: 100%;
            }

            .lawfiz-rating-notice h3 {
              margin-bottom: 0;
            }

            .lawfiz-rating-notice p {
              margin-top: 3px;
              margin-bottom: 15px;
            }

            .lawfiz-already-rated,
            .lawfiz-maybe-later {
              text-decoration: none;
              margin-left: 12px;
              font-size: 14px;
              cursor: pointer;
            }

            .lawfiz-already-rated .dashicons,
            .lawfiz-maybe-later .dashicons {
              vertical-align: sub;
            }

            .lawfiz-logo {
                height: 100%;
                width: auto;
            }

        </style>
        ";
    }
}

new Lawfiz_Rating_Notice();