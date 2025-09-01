<?php 
if (!defined('ABSPATH')) exit;

function spiraclethemes_site_library_get_syssettings() {
    ob_start();
    ?>
    <table class="form-table">
        <tbody>
            <tr>
                <th scope="row"><?php esc_html_e('Demo Import', 'spiraclethemes-site-library'); ?></th>
                <td>
                    <label class="ssl-toggle-switch">
                        <input type="checkbox" name="ssl_disable_demo_import" value="1" <?php checked(1, get_option('ssl_disable_demo_import', 1), true); ?> />
                        <span class="ssl-toggle-slider"></span>
                    </label>
                    <p class="description"><?php esc_html_e('Enable or disable the demo import feature.', 'spiraclethemes-site-library'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php esc_html_e('Dashboard Widget', 'spiraclethemes-site-library'); ?></th>
                <td>
                    <label class="ssl-toggle-switch">
                        <input type="checkbox" name="ssl_disable_discount_widget" value="1" <?php checked(1, get_option('ssl_disable_discount_widget', 1), true); ?> />
                        <span class="ssl-toggle-slider"></span>
                    </label>
                    <p class="description"><?php esc_html_e('Enable or disable the dashboard widget discounts & news.', 'spiraclethemes-site-library'); ?></p>
                </td>
            </tr>
        </tbody>
    </table>
    <?php
    return ob_get_clean();
}