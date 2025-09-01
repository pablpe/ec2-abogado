<?php
/**
 * Admin functionality for Spiraclethemes Site Library plugin.
 *
 * @package spiraclethemes-site-library
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Ensure no output before JSON response
ob_start();

class Spiraclethemes_site_library_Admin {

    /**
     * Nonce name for AJAX and form security.
     */
    const NONCE_NAME = 'ssl_settings_nonce';

    /**
     * Default settings for the plugin.
     *
     * @var array
     */
    private $default_settings;

    /**
     * Constructor.
     */
    public function __construct() {
        $this->default_settings = [
            'ssl_disable_demo_import' => 1, // Demo import disabled by default
            'ssl_disable_discount_widget' => 1, // Dashboard widget disabled by default
        ];

        // Initialize settings with defaults if not set
        foreach ($this->default_settings as $key => $value) {
            if (false === get_option($key)) {
                update_option($key, $value);
            }
        }

        $this->spiraclethemes_site_library_init_hooks();
    }

    /**
     * Register admin menu.
     */
    public function spiraclethemes_site_library_register_admin_menu() {
        add_menu_page(
            esc_html__('Spiraclethemes Site Library', 'spiraclethemes-site-library'),
            esc_html__('Spiraclethemes Site Library', 'spiraclethemes-site-library'),
            'manage_options',
            'ssl-settings',
            [$this, 'spiraclethemes_site_library_display_settings_pages'],
            'dashicons-art'
        );
    }

    /**
     * Initialize hooks.
     */
    public function spiraclethemes_site_library_init_hooks() {
        add_action('admin_menu', [$this, 'spiraclethemes_site_library_register_admin_menu']);
        add_action('admin_enqueue_scripts', [$this, 'spiraclethemes_site_library_enqueue_scripts']);
        add_action('wp_ajax_ssl_save_settings', [$this, 'spiraclethemes_site_library_save_settings']);
    }

    /**
     * Enqueue scripts and styles.
     *
     * @param string $hook The current admin page hook.
     */
    public function spiraclethemes_site_library_enqueue_scripts($hook) {
        if ('toplevel_page_ssl-settings' !== $hook) {
            return;
        }

        wp_enqueue_style(
            'ssl-admin',
            plugins_url('/assets/css/admin.css', __FILE__),
            [],
            '1.0'
        );
        wp_enqueue_style(
            'ssl-toggle-switch',
            plugins_url('/assets/css/toggle-switch.css', __FILE__),
            [],
            '1.0'
        );
        wp_enqueue_script(
            'ssl-admin-plugin-settings-js',
            plugins_url('/assets/js/admin-plugin-settings.js', __FILE__),
            ['jquery', 'jquery-ui-tabs'],
            '1.0',
            true
        );
        wp_localize_script(
            'ssl-admin-plugin-settings-js',
            'ssl_ajax_object',
            [
                'ajax_url' => esc_url_raw(admin_url('admin-ajax.php')),
                'nonce' => wp_create_nonce(self::NONCE_NAME),
            ]
        );
    }

    /**
     * Save settings via AJAX.
     */
    public function spiraclethemes_site_library_save_settings() {
        // Verify nonce
        if (!check_ajax_referer(self::NONCE_NAME, 'nonce', false)) {
            wp_send_json_error(
                [
                    'message' => esc_html__('Invalid nonce', 'spiraclethemes-site-library'),
                    'code' => 'invalid_nonce',
                ],
                403
            );
            wp_die();
        }

        // Check user permissions
        if (!current_user_can('manage_options')) {
            wp_send_json_error(
                [
                    'message' => esc_html__('Unauthorized user', 'spiraclethemes-site-library'),
                    'code' => 'unauthorized',
                ],
                403
            );
            wp_die();
        }

        // Validate and sanitize POST data
        $demo_import = isset($_POST['ssl_disable_demo_import'])
            ? absint($_POST['ssl_disable_demo_import'])
            : 0;
        $discount_widget = isset($_POST['ssl_disable_discount_widget'])
            ? absint($_POST['ssl_disable_discount_widget'])
            : 0;

        // Ensure values are 0 or 1
        $demo_import = in_array($demo_import, [0, 1], true) ? $demo_import : 0;
        $discount_widget = in_array($discount_widget, [0, 1], true) ? $discount_widget : 0;

        // Update options
        $updated1 = update_option('ssl_disable_demo_import', $demo_import, true);
        $updated2 = update_option('ssl_disable_discount_widget', $discount_widget, true);

        // Clear object cache
        wp_cache_delete('ssl_disable_demo_import', 'options');
        wp_cache_delete('ssl_disable_discount_widget', 'options');
        wp_cache_flush(); // Ensure no stale cache

        // Fallback: Direct database update
        global $wpdb;
        $option_names = ['ssl_disable_demo_import', 'ssl_disable_discount_widget'];
        $values = [$demo_import, $discount_widget];

        foreach ($option_names as $index => $option_name) {
            $exists = $wpdb->get_var(
                $wpdb->prepare(
                    "SELECT COUNT(*) FROM {$wpdb->options} WHERE option_name = %s",
                    $option_name
                )
            );

            if ($exists) {
                $result = $wpdb->update(
                    $wpdb->options,
                    ['option_value' => $values[$index]],
                    ['option_name' => $option_name],
                    ['%d'],
                    ['%s']
                );
            } else {
                $result = $wpdb->insert(
                    $wpdb->options,
                    [
                        'option_name' => $option_name,
                        'option_value' => $values[$index],
                        'autoload' => 'yes',
                    ],
                    ['%s', '%d', '%s']
                );
            }
        }

        // Verify current values using get_option to ensure consistency
        $current_demo_import = (int) get_option('ssl_disable_demo_import', 1);
        $current_discount_widget = (int) get_option('ssl_disable_discount_widget', 1);

        // Check if saved values match
        if ($current_demo_import === $demo_import && $current_discount_widget === $discount_widget) {
            wp_send_json_success([
                'message' => esc_html__('Settings saved successfully', 'spiraclethemes-site-library'),
                'demo_import' => $demo_import,
                'discount_widget' => $discount_widget,
            ]);
        } else {
            wp_send_json_error(
                [
                    'message' => esc_html__('Failed to verify saved settings', 'spiraclethemes-site-library'),
                    'code' => 'verification_error',
                    'expected' => ['demo_import' => $demo_import, 'discount_widget' => $discount_widget],
                    'actual' => ['demo_import' => $current_demo_import, 'discount_widget' => $current_discount_widget],
                ],
                500
            );
        }

        // Clean output buffer before sending response
        ob_end_clean();
        wp_die();
    }

    /**
     * Display settings pages.
     */
    public function spiraclethemes_site_library_display_settings_pages() {
        // Explicit capability check
        if (!current_user_can('manage_options')) {
            wp_die(
                esc_html__('You do not have permission to access this page.', 'spiraclethemes-site-library'),
                esc_html__('Permission Denied', 'spiraclethemes-site-library'),
                ['response' => 403]
            );
        }

        $plugins = get_plugins();
        $plugin_version = '';

        foreach ($plugins as $plugin_info) {
            if ('Spiraclethemes Site Library' === sanitize_text_field($plugin_info['Name'])) {
                $plugin_version = sanitize_text_field($plugin_info['Version']);
                break;
            }
        }

        ?>
        <div class="wrap">
            <div class="response-wrap"></div>
            <form action="" method="POST" id="ssl-settings" name="ssl-settings">
                <?php wp_nonce_field(self::NONCE_NAME, self::NONCE_NAME); ?>
                <div class="ssl-header-wrapper">
                    <div class="ssl-title-left">
                        <h1 class="ssl-title-main">
                            <?php echo esc_html__('Spiraclethemes Site Library', 'spiraclethemes-site-library'); ?> 
                            <span class="plugin-version"><?php echo esc_html__('Ver: ', 'spiraclethemes-site-library') . esc_html($plugin_version); ?></span>
                        </h1>
                    </div>
                </div>
                <div class="ssl-settings-tabs">
                    <ul class="ssl-settings-tabs-list">
                        <li><a class="ssl-tab-list-item" href="#ssl-about"><?php esc_html_e('About', 'spiraclethemes-site-library'); ?></a></li>
                        <li><a class="ssl-tab-list-item" href="#ssl-info"><?php esc_html_e('Info', 'spiraclethemes-site-library'); ?></a></li>
                        <li><a class="ssl-tab-list-item" href="#ssl-settings"><?php esc_html_e('Settings', 'spiraclethemes-site-library'); ?></a></li>
                    </ul>
                    <div id="ssl-about" class="ssl-settings-tab">
                        <div class="ssl-row">
                            <div class="ssl-col">
                                <div class="ssl-about-panel">
                                    <div class="ssl-icon-container">
                                        <i class="dashicons dashicons-editor-help"></i>
                                    </div>
                                    <div class="ssl-text-container">
                                        <h4>
                                            <?php
                                            esc_html_e(
                                                'A plugin by Spiracle Themes that adds one-click demo import, theme customization, starter templates, and page builder support to its free themes.',
                                                'spiraclethemes-site-library'
                                            );
                                            ?>
                                            <a target="_blank" href="<?php echo esc_url('https://spiraclethemes.com/'); ?>">
                                                <?php esc_html_e('Spiraclethemes', 'spiraclethemes-site-library'); ?>
                                            </a>
                                            <?php esc_html_e('for more information', 'spiraclethemes-site-library'); ?>
                                        </h4><br/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="ssl-info" class="ssl-settings-tab">
                        <div class="ssl-row">
                            <h3><?php esc_html_e('System setup information useful for debugging purposes.', 'spiraclethemes-site-library'); ?></h3>
                            <div class="ssl-system-info-container">
                                <?php
                                // Assume ssl_get_sysinfo() is properly sanitized
                                echo nl2br(wp_kses_post(spiraclethemes_site_library_get_sysinfo()));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div id="ssl-settings" class="ssl-settings-tab">
                        <div class="ssl-row">
                            <h3><?php esc_html_e('Plugin Settings', 'spiraclethemes-site-library'); ?></h3>
                            <div class="ssl-system-settings-container">
                                <?php
                                // Assume ssl_get_syssettings() is properly sanitized
                                echo wp_kses_post(spiraclethemes_site_library_get_syssettings());
                                ?>
                                <p class="submit">
                                    <input
                                        type="submit"
                                        name="submit"
                                        id="submit"
                                        class="button button-primary"
                                        value="<?php esc_attr_e('Save Changes', 'spiraclethemes-site-library'); ?>"
                                    >
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
    }
}

new Spiraclethemes_site_library_Admin();