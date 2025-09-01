<?php
/**
 * Plugin Name:       Spiraclethemes Site Library
 * Plugin URI:        https://wordpress.org/plugins/spiraclethemes-site-library/
 * Description:       A plugin by Spiracle Themes that adds one-click demo import, theme customization, starter templates, and page builder support to its free themes.
 * Version:           1.5.6
 * Author:            SpiracleThemes
 * Author URI:        https://spiraclethemes.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       spiraclethemes-site-library
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Define constants
$constants = [
    'SPIR_SITE_LIBRARY_FILE'     => __FILE__,
    'SPIR_SITE_LIBRARY_URL'      => plugins_url( '/', __FILE__ ),
    'SPIR_SITE_LIBRARY_DIR_URL'  => plugin_dir_url( __FILE__ ),
    'SPIR_SITE_LIBRARY_PATH'     => plugin_dir_path( __FILE__ ),
];

foreach ( $constants as $key => $value ) {
    if ( ! defined( $key ) ) {
        define( $key, $value );
    }
}

use \YeEasyAdminNotices\V1\AdminNotice;

class Spiraclethemes_Site_Library {
    private $theme_name;
    private $theme_slug;
    private $theme_version;
    private $notification;

    // Activate
    public function activate() {
        add_option( 'spiraclethemes_sitelib_install_date', current_time( 'mysql' ), '', 'yes' );
    }

    // Deactivate
    public function deactivate() {
        global $current_user;
        $user_id = $current_user->ID;
        AdminNotice::cleanUpDatabase( 'spiraclethemes-site-library-' );
        delete_option( 'spiraclethemes_sitelib_install_date' );
        delete_user_meta( $user_id, 'spiraclethemes_sitelib_rating_ignore_notice' );
        delete_user_meta( $user_id, 'spiraclethemes_sitelib_training_ignore_notice' );
    }

    public function __construct() {
        
        if ("1" === get_option('ssl_disable_demo_import')) {
            require_once SPIR_SITE_LIBRARY_PATH . 'vendor/ocdi/one-click-demo-import.php';
        }
        require_once SPIR_SITE_LIBRARY_PATH . 'vendor/admin-notices/AdminNotice.php';

        $theme = wp_get_theme();
        $this->theme_name    = $theme->get( 'Name' );
        $this->theme_slug    = $theme->get( 'TextDomain' );
        $this->theme_version = $theme->get( 'Version' );

        // Define allowed Spiraclethemes theme slugs
        $allowed_themes = [
            'own-shop',
            'purea-magazine',
            'colon',
            'somalite',
            'purea-fashion',
            'own-store',
            'colon-plus',
            'own-shop-lite',
            'mestore',
            'blogson',
            'blogson-child',
            'own-shope',
            'crater-free',
            'lawfiz',
            'legalblow',
            'own-shop-trend',
            'lawfiz-one',
            'krystal',
            'krystal-lawyer',
            'krystal-business',
            'krystal-shop'
        ];

        if (is_admin() && in_array($this->theme_slug, $allowed_themes)) {
            add_action( 'admin_init', [ $this, 'spiraclethemes_site_library_set_notification' ] );
            add_action( 'admin_notices', [ $this, 'spiraclethemes_site_library_display_welcome_notice' ] );
            add_action( 'admin_notices', [ $this, 'spiraclethemes_site_library_display_sale10_notice' ] );
            add_action( 'admin_notices', [ $this, 'spiraclethemes_site_library_display_sale20_notice' ] );
            add_action( 'admin_notices', [ $this, 'spiraclethemes_site_library_display_sale40_notice' ] );
            add_action( 'admin_init', [ $this, 'spiraclethemes_site_library_ignore_rating_notice' ] );
            add_action( 'admin_init', [ $this, 'spiraclethemes_site_library_ignore_sale10_notice' ] );
            add_action( 'admin_init', [ $this, 'spiraclethemes_site_library_ignore_sale20_notice' ] );
            add_action( 'admin_init', [ $this, 'spiraclethemes_site_library_ignore_sale40_notice' ] );
        }
        add_action('init', [ $this, 'spiraclethemes_site_library_load_plugin_textdomain' ] );
    }

    // function to set notification after init
    public function spiraclethemes_site_library_set_notification() {
        $raw_html = sprintf(
            '<p>%1$s <a href="%2$s" class="button" style="text-decoration: none;">%3$s</a></p>',
            esc_html__( 'Kickstart your WordPress website with our free demo starter templates, tailored for this theme.', 'spiraclethemes-site-library' ),
            esc_url( admin_url( 'themes.php?page=one-click-demo-import' ) ),
            esc_html__( 'Start Importing Templates', 'spiraclethemes-site-library' )
        );

        $this->notification = wp_kses( $raw_html, [
            'p' => [],
            'a' => [
                'href' => [],
                'class' => [],
                'style' => [],
                'target' => [],
                'rel' => [],
            ]
        ]);
    }

    // spiraclethemes site library functions
    function spiraclethemes_site_library_functions() {
        if ("1" === get_option('ssl_disable_demo_import')) {
            require_once SPIR_SITE_LIBRARY_PATH . '/inc/themes.php';
        }
        require_once SPIR_SITE_LIBRARY_PATH . '/inc/widget/widget.php';
        //Admin init
        require_once SPIR_SITE_LIBRARY_PATH . '/admin/admin-init.php';
        // System Info
        require_once SPIR_SITE_LIBRARY_PATH . '/admin/includes/system-info.php';
        // System Settings
        require_once SPIR_SITE_LIBRARY_PATH . '/admin/includes/system-settings.php';
    }

    //register styles
    function spiraclethemes_site_library_register_styles() {
       add_action( 'admin_enqueue_scripts', array( $this, 'spiraclethemes_site_library_admin_styles' ), 0 );
    }

    // Admin styles include
    function spiraclethemes_site_library_admin_styles() {
        // Main css
        wp_enqueue_style( 'spiraclethemes-site-library-main', plugins_url( '/css/main.css', __FILE__ ) );
    }
    
    //Load plugin text domain
    function spiraclethemes_site_library_load_plugin_textdomain() {
        load_plugin_textdomain('spiraclethemes-site-library', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    private function spiraclethemes_site_library_get_days_since_install() {
        $install_date = get_option( 'spiraclethemes_sitelib_install_date' );
        if ( ! $install_date ) return 0;

        $install_timestamp = strtotime( $install_date );
        return ( time() - $install_timestamp ) / DAY_IN_SECONDS;
    }


    // Reusable method to check if notice should be shown
    private function spiraclethemes_site_library_should_display_notice( $ignore_key, $days_after_install ) {

        $install_date = get_option( 'spiraclethemes_sitelib_install_date' );
        if ( strtotime( "+$days_after_install days", strtotime( $install_date ) ) > time() ) {
            return false;
        }

        $user_id = get_current_user_id();
        return ! get_user_meta( $user_id, $ignore_key, true );
    }

    // Reusable method to display a notice
    private function spiraclethemes_site_library_display_custom_notice( $message ) {
        echo '<div class="notice updated ssl-pro-upgrade-notice">' . wp_kses_post( $message ) . '</div>';
    }

    // Reusable method to build notice message
    private function spiraclethemes_site_library_build_sale_notice( $discount, $code, $ignore_param, $theme_name ) {
        $pricing_url = esc_url( 'https://spiraclethemes.com/pricing/' );
        $ignore_url  = esc_url( wp_nonce_url( admin_url( 'themes.php?' . $ignore_param . '=0' ), $ignore_param . '_nonce' ) );

        switch ( $discount ) {
            case 10:
                $message = __( '🎉 Congratulations! You\'re eligible for an exclusive 10%% discount on %4$s PRO upgrade. Use promotional code <strong>%1$s</strong> at checkout. Visit <a href="%2$s" target="_blank">our pricing page</a> to learn more. <a href="%3$s"> | No thanks</a>', 'spiraclethemes-site-library' );
                break;
            case 20:
                $message = __( '🎉 Great news! You\'ve unlocked a 20%% discount on %4$s PRO upgrade. Use promotional code <strong>%1$s</strong> at checkout. Visit <a href="%2$s" target="_blank">our pricing page</a> to learn more. <a href="%3$s"> | No thanks</a>', 'spiraclethemes-site-library' );
                break;
            case 40:
                $message = __( '🎉 Final chance! A massive 40%% discount awaits you on %4$s PRO upgrade. Use promotional code <strong>%1$s</strong> at checkout. Visit <a href="%2$s" target="_blank">our pricing page</a> to learn more. <a href="%3$s"> | No thanks</a>', 'spiraclethemes-site-library' );
                break;
            default:
                return '';
        }

        return sprintf( wp_kses_post( $message ), esc_html( $code ), $pricing_url, $ignore_url, $theme_name );
    }



    // Welcome notice
    public function spiraclethemes_site_library_display_welcome_notice() {
        $days_since = $this->spiraclethemes_site_library_get_days_since_install();

        // Show Import CTA during first 7 days
        if ( $days_since < 7 && ! empty( $this->notification ) ) {
            AdminNotice::create( 'spiraclethemes-site-library-notice' )
                ->persistentlyDismissible( AdminNotice::DISMISS_PER_SITE )
                ->success( $this->notification )
                ->show();
        }

        // Show rating notice after 7 days
        if ( $days_since >= 7 && $this->spiraclethemes_site_library_should_display_notice( 'spiraclethemes_sitelib_rating_ignore_notice', 7 ) ) {
            $theme_info_url = esc_url( admin_url( 'themes.php' ) );
            $rating_url = esc_url( 'https://wordpress.org/support/theme/' . $this->theme_slug . '/reviews/?filter=5' );
            $ignore_url = esc_url( wp_nonce_url( admin_url( 'themes.php?wp_spiraclethemes_sitelib_rating_ignore=0' ), 'wp_spiraclethemes_sitelib_rating_ignore_nonce' ) );

            echo '<div class="notice updated ssl-notice">';
            printf(
                esc_html__( 'Awesome, you\'ve been using %s for over a week! Please consider giving us a 5-star review.', 'spiraclethemes-site-library' ) .
                ' <a href="%s" target="_blank">%s</a> | <a href="%s">%s</a>',
                '<a href="' . $theme_info_url . '">' . esc_html( $this->theme_name ) . '</a>',
                $rating_url,
                esc_html__( 'Ok, you deserved it!', 'spiraclethemes-site-library' ),
                $ignore_url,
                esc_html__( 'No, thanks', 'spiraclethemes-site-library' )
            );
            echo '</div>';
        }
    }


    // Sale notices
    public function spiraclethemes_site_library_display_sale10_notice() {
        $days_since = $this->spiraclethemes_site_library_get_days_since_install();

        if ( $days_since >= 7 && $days_since < 14 &&
             $this->spiraclethemes_site_library_should_display_notice( 'spiraclethemes_sitelib_sale10_ignore_notice', 7 ) ) {
            $message = $this->spiraclethemes_site_library_build_sale_notice( 10, 'SALE10', 'wp_spiraclethemes_sitelib_sale10_ignore', $this->theme_name );
            $this->spiraclethemes_site_library_display_custom_notice( $message );
        }
    }

    public function spiraclethemes_site_library_display_sale20_notice() {
        $days_since = $this->spiraclethemes_site_library_get_days_since_install();

        if ( $days_since >= 14 && $days_since < 28 &&
             $this->spiraclethemes_site_library_should_display_notice( 'spiraclethemes_sitelib_sale20_ignore_notice', 14 ) ) {
            $message = $this->spiraclethemes_site_library_build_sale_notice( 20, '20SALEOFF', 'wp_spiraclethemes_sitelib_sale20_ignore', $this->theme_name );
            $this->spiraclethemes_site_library_display_custom_notice( $message );
        }
    }

    public function spiraclethemes_site_library_display_sale40_notice() {
        $days_since = $this->spiraclethemes_site_library_get_days_since_install();

        if ( $days_since >= 28 &&
             $this->spiraclethemes_site_library_should_display_notice( 'spiraclethemes_sitelib_sale40_ignore_notice', 28 ) ) {
            $message = $this->spiraclethemes_site_library_build_sale_notice( 40, 'SALE40', 'wp_spiraclethemes_sitelib_sale40_ignore', $this->theme_name );
            $this->spiraclethemes_site_library_display_custom_notice( $message );
        }
    }


    // Generic ignore handler
    private function spiraclethemes_site_library_handle_ignore_notice( $param, $meta_key ) {
        if ( current_user_can( 'manage_options' ) && isset( $_GET[ $param ] ) && isset( $_GET['_wpnonce'] ) ) {
            if ( wp_verify_nonce( sanitize_text_field($_GET['_wpnonce']), $param . '_nonce' ) ) {
                $user_id = get_current_user_id();
                add_user_meta( $user_id, sanitize_key( $meta_key ), true, true );
            }
        }
    }

    // Public ignore handlers
    public function spiraclethemes_site_library_ignore_rating_notice() {
        $this->spiraclethemes_site_library_handle_ignore_notice( 'wp_spiraclethemes_sitelib_rating_ignore', 'spiraclethemes_sitelib_rating_ignore_notice' );
    }

    public function spiraclethemes_site_library_ignore_sale10_notice() {
        $this->spiraclethemes_site_library_handle_ignore_notice( 'wp_spiraclethemes_sitelib_sale10_ignore', 'spiraclethemes_sitelib_sale10_ignore_notice' );
    }

    public function spiraclethemes_site_library_ignore_sale20_notice() {
        $this->spiraclethemes_site_library_handle_ignore_notice( 'wp_spiraclethemes_sitelib_sale20_ignore', 'spiraclethemes_sitelib_sale20_ignore_notice' );
    }

    public function spiraclethemes_site_library_ignore_sale40_notice() {
        $this->spiraclethemes_site_library_handle_ignore_notice( 'wp_spiraclethemes_sitelib_sale40_ignore', 'spiraclethemes_sitelib_sale40_ignore_notice' );
    }

}


// Class Register

if ( class_exists( 'Spiraclethemes_Site_Library' ) ) :
    $spiraclethemes_site_library = new Spiraclethemes_Site_Library();
    $spiraclethemes_site_library->spiraclethemes_site_library_register_styles();
    $spiraclethemes_site_library->spiraclethemes_site_library_functions();

endif;

// Activation
register_activation_hook( __FILE__, array( $spiraclethemes_site_library, 'activate' ) );
// Deactivation
register_deactivation_hook( __FILE__, array( $spiraclethemes_site_library, 'deactivate' ) );