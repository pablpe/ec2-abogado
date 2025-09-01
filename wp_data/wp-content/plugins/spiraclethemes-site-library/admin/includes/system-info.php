<?php 

if (!defined('ABSPATH')) exit; // Exit if accessed directly

function spiraclethemes_site_library_get_sysinfo() {
    global $wpdb;

    // Sanitize theme data retrieval
    $theme_data = wp_get_theme();
    $theme = esc_html($theme_data->Name . ' ' . $theme_data->Version);

    // Start system info container
    $return = '<div class="ospa-system-info-container">';
    $return .= '<table class="ospa-system-info-table">';
    $return .= '<tr><th colspan="2">' . esc_html__('Begin System Info', 'spiraclethemes-site-library') . '</th></tr>';

    // Sanitize site info retrieval
    $return .= '<tr><td colspan="2"><strong>' . esc_html__('-- Site Info --', 'spiraclethemes-site-library') . '</strong></td></tr>';
    $return .= '<tr><td>' . esc_html__('Site URL:', 'spiraclethemes-site-library') . '</td><td>' . esc_url(site_url()) . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('Home URL:', 'spiraclethemes-site-library') . '</td><td>' . esc_url(home_url()) . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('Multisite:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(is_multisite() ? 'Yes' : 'No') . '</td></tr>';

    // Sanitize WordPress Configuration
    $return .= '<tr><td colspan="2"><strong>' . esc_html__('-- WordPress Configuration --', 'spiraclethemes-site-library') . '</strong></td></tr>';
    $return .= '<tr><td>' . esc_html__('Version:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(get_bloginfo('version')) . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('Language:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(get_bloginfo('language')) . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('Permalink Structure:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(get_option('permalink_structure', 'Default')) . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('Active Theme:', 'spiraclethemes-site-library') . '</td><td>' . esc_html($theme) . '</td></tr>';

    // Sanitize Plugins List
    $return .= '<tr><td colspan="2"><strong>' . esc_html__('-- WordPress Plugins --', 'spiraclethemes-site-library') . '</strong></td></tr>';
    $plugins = get_plugins();
    foreach ($plugins as $plugin) {
        $return .= '<tr><td>' . esc_html($plugin['Name']) . ':</td><td>' . esc_html($plugin['Version']) . '</td></tr>';
    }

    // Sanitize Webserver Configuration
    $return .= '<tr><td colspan="2"><strong>' . esc_html__('-- Webserver Configuration --', 'spiraclethemes-site-library') . '</strong></td></tr>';
    $return .= '<tr><td>' . esc_html__('PHP Version:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(PHP_VERSION) . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('MySQL Version:', 'spiraclethemes-site-library') . '</td><td>' . esc_html($wpdb->db_version()) . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('Webserver Info:', 'spiraclethemes-site-library') . '</td><td>' . esc_html($_SERVER['SERVER_SOFTWARE']) . '</td></tr>';

    // Sanitize PHP Configuration
    $return .= '<tr><td colspan="2"><strong>' . esc_html__('-- PHP Configuration --', 'spiraclethemes-site-library') . '</strong></td></tr>';
    $return .= '<tr><td>' . esc_html__('Memory Limit:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(ini_get('memory_limit')) . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('Upload Max Size:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(ini_get('upload_max_filesize')) . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('Post Max Size:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(ini_get('post_max_size')) . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('Upload Max Filesize:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(ini_get('upload_max_filesize')) . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('Time Limit:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(ini_get('max_execution_time')) . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('Max Input Vars:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(ini_get('max_input_vars')) . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('Display Errors:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(ini_get('display_errors') ? 'On (' . ini_get('display_errors') . ')' : 'N/A') . '</td></tr>';

    // Sanitize PHP Extensions
    $return .= '<tr><td colspan="2"><strong>' . esc_html__('-- PHP Extensions --', 'spiraclethemes-site-library') . '</strong></td></tr>';
    $return .= '<tr><td>' . esc_html__('cURL:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(function_exists('curl_init') ? 'Supported' : 'Not Supported') . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('fsockopen:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(function_exists('fsockopen') ? 'Supported' : 'Not Supported') . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('SOAP Client:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(class_exists('SoapClient') ? 'Installed' : 'Not Installed') . '</td></tr>';
    $return .= '<tr><td>' . esc_html__('Suhosin:', 'spiraclethemes-site-library') . '</td><td>' . esc_html(extension_loaded('suhosin') ? 'Installed' : 'Not Installed') . '</td></tr>';

    $return .= '<tr><th colspan="2">' . esc_html__('End System Info', 'spiraclethemes-site-library') . '</th></tr>';
    $return .= '</table></div>';

    return $return;
}

?>