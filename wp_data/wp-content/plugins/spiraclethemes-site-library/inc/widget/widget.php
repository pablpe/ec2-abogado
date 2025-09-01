<?php
/**
 *
 * @package spiraclethemes-site-library
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) :
    die;
endif;


// Define theme constants
define('WP_THEME', wp_get_theme()->Name);
define('WP_THEME_SLUG', wp_get_theme()->get('TextDomain'));
if (!defined('SPIRACLETHEMES_POSTS_PER_PAGE')) {
    define('SPIRACLETHEMES_POSTS_PER_PAGE', 3);
}
if (!defined('SPIRACLETHEMES_NEW_POST_DAYS')) {
    define('SPIRACLETHEMES_NEW_POST_DAYS', 7);
}
if (!defined('HOUR_IN_SECONDS')) {
    define('HOUR_IN_SECONDS', 3600);
}


// Function to add dashboard widget
function spiraclethemes_site_library_add_dashboard_widgets() {
    // Set the widget title
    $widget_title = sprintf( __( '%s Theme', 'spiraclethemes-site-library' ), WP_THEME );

    // Add dashboard widget
    wp_add_dashboard_widget(
        'spiraclethemes_site_library_dashboard_widget', // Widget slug
        $widget_title, // Title
        'spiraclethemes_site_library_display_dashboard_widget' // Display function
    );
}

// Function to display dashboard widget content
function spiraclethemes_site_library_display_dashboard_widget() {

    // Validate constants
    $theme_slug = sanitize_key(wp_get_theme()->get('TextDomain'));
    $theme_name = esc_html(wp_get_theme()->get('Name'));

    if ("1" === get_option('ssl_disable_discount_widget')) {
        if (!current_user_can('manage_options')) {
            echo '<p>' . esc_html__('You do not have permission to view this content.', 'spiraclethemes-site-library') . '</p>';
            return;
        }

        $cache_key = 'spiraclethemes_discount_data';
        $xml_body = get_transient($cache_key);

        if (false === $xml_body || !is_string($xml_body) || empty($xml_body)) {
            $api_url = esc_url_raw('https://api.spiraclethemes.com/discounts/disapi.php');
            $response = wp_safe_remote_get($api_url, [
                'timeout' => 10,
                'sslverify' => true,
            ]);

            if (is_wp_error($response)) {
                echo '<p>' . esc_html__('Error fetching discount data: ', 'spiraclethemes-site-library') . esc_html($response->get_error_message()) . '</p>';
                return;
            }

            $response_code = wp_remote_retrieve_response_code($response);
            if ($response_code !== 200) {
                echo '<p>' . sprintf(esc_html__('Error fetching discount data. HTTP Status Code: %s', 'spiraclethemes-site-library'), esc_html($response_code)) . '</p>';
                return;
            }

            $xml_body = wp_remote_retrieve_body($response);
            set_transient($cache_key, $xml_body, HOUR_IN_SECONDS * 24);
        }

        if (version_compare(PHP_VERSION, '8.0.0', '<')) {
            libxml_disable_entity_loader(true);
        }
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xml_body, 'SimpleXMLElement', LIBXML_NOCDATA);

        if ($xml === false) {
            if (defined('WP_DEBUG') && WP_DEBUG) {
                error_log('Spiraclethemes Site Library: XML parsing errors: ' . print_r(libxml_get_errors(), true));
            }
            echo '<p>' . esc_html__('Error parsing XML data.', 'spiraclethemes-site-library') . '</p>';
            libxml_clear_errors();
            return;
        }

        $theme_discount = null;
        $theme_url = null;
        foreach ($xml->theme as $theme) {
            if ((string) $theme->slug === $theme_slug) {
                $theme_discount = !empty($theme->sale) ? (string) $theme->sale : null;
                $theme_url = !empty($theme->purchase_url) ? (string) $theme->purchase_url : null;
                break;
            }
        }

        echo '<h3><b>' . esc_html__('Special Discount', 'spiraclethemes-site-library') . '</b></h3>';
        if ($theme_discount && $theme_url) {
            echo '<span class="new-badge">' . esc_html__('NEW', 'spiraclethemes-site-library') . '</span>';
            printf(
                '<span>' . esc_html__('Unlock the Pro version for just $%1$s! Take advantage of our limited-time discount on %2$s. <a href="%3$s" target="_blank">Buy now</a>!', 'spiraclethemes-site-library') . '</span>',
                esc_html($theme_discount),
                esc_html($theme_name),
                esc_url($theme_url)
            );
        } else {
            echo '<span>' . esc_html__('No special discount currently available.', 'spiraclethemes-site-library') . '</span>';
        }
        libxml_clear_errors();
    }

    $rocket_img = defined('SPIR_SITE_LIBRARY_URL') ? esc_url(SPIR_SITE_LIBRARY_URL . 'img/rocket.svg') : '';
    if (empty($rocket_img)) {
        echo '<p>' . esc_html__('Image not found.', 'spiraclethemes-site-library') . '</p>';
        return;
    }

    echo '<br/><br/>';

    echo '<h3><span><img src="' . esc_url($rocket_img) . '" /> </span><b>' . __( 'Design, Build or Revamp existing WordPress website starting from $999', 'spiraclethemes-site-library' ) . '</b></h3>';

    wp_add_inline_style( 'spiraclethemes-site-library-main', 'ul { list-style: disc; padding-left: 20px; }' );
    echo '<ul>';
    echo '<li><b>Stunning Custom Design</b> – Make a lasting impression with a beautiful, modern website or redesign.</li>';
    echo '<li><b>Tailor-Made Features</b> – We build exactly what your business needs – no fluff, just functionality.</li>';
    echo '<li><b>SEO-Optimized</b> – Climb the search rankings and get discovered faster on Google.</li>';
    echo '<li><b>Blazing-Fast Speed</b> – Say goodbye to slow loading. We make your site lightning quick!</li>';
    echo '<li><b>Rock-Solid Security</b> – Sleep easy knowing your website is shielded with top-notch protection.</li>';
    echo '<li><b>100% Mobile-Responsive</b> – Your site will look perfect on every screen – phones, tablets, and desktops.</li>';
    echo '<li><b>Google Analytics Ready</b> – Gain powerful insights and track every visitor with ease.</li>';
    echo '<li><b>Live Chat Integration</b> – Connect instantly with your visitors and turn chats into conversions.</li>';
    echo '<li><b>SSL Renewal Support</b> – We help you stay secure, always – no more expired certificates.</li>';
    echo '<li><b>Spam Shield Setup</b> – Keep your site clean and junk-free with robust spam protection.</li>';
    echo '<li><b>30 Days Free Expert Support</b> – We’ve got your back, even after launch – no extra cost!</li>';
    echo '</ul>';

    echo sprintf(
        '<p><a href="https://spiraclethemes.com/hire-us/" target="_blank" class="button button-primary">%s</a></p>',
        __('Get Started Today for Just $999 (Limited Time Offer)!', 'spiraclethemes-site-library')
    );

    
    if ("1" === get_option('ssl_disable_discount_widget')) {
        echo '<h3><b>' . esc_html__('News & Updates', 'spiraclethemes-site-library') . '</b></h3>';
        echo '<ul>';

        $cache_key = 'spiraclethemes_news_posts';
        $posts = get_transient($cache_key);

        if (false === $posts) {
            $api_url = esc_url_raw('https://spiraclethemes.com/wp-json/wp/v2/posts?per_page=' . SPIRACLETHEMES_POSTS_PER_PAGE);
            $response_posts = wp_safe_remote_get($api_url, [
                'timeout' => 10,
                'sslverify' => true,
            ]);

            if (is_wp_error($response_posts)) {
                echo '<li>' . esc_html__('Error fetching blog posts: ', 'spiraclethemes-site-library') . esc_html($response_posts->get_error_message()) . '</li>';
                echo '</ul>';
                return;
            }

            $response_code = wp_remote_retrieve_response_code($response_posts);
            if ($response_code !== 200) {
                echo '<li>' . sprintf(esc_html__('Error fetching blog posts. HTTP Status Code: %s', 'spiraclethemes-site-library'), esc_html($response_code)) . '</li>';
                echo '</ul>';
                return;
            }

            $posts = json_decode(wp_remote_retrieve_body($response_posts), true);
            if (!is_array($posts)) {
                echo '<li>' . esc_html__('Invalid blog post data.', 'spiraclethemes-site-library') . '</li>';
                echo '</ul>';
                return;
            }

            set_transient($cache_key, $posts, HOUR_IN_SECONDS * 24);
        }

        if (!empty($posts)) {
            foreach ($posts as $post) {
                if (!isset($post['date'], $post['link'], $post['title']['rendered'])) {
                    continue;
                }

                $post_date = strtotime($post['date'] ?? '');
                $seven_days_ago = strtotime('-' . SPIRACLETHEMES_NEW_POST_DAYS . ' days');
                $is_new = $post_date !== false && $post_date > $seven_days_ago;

                echo '<li>';
                if ($is_new) {
                    echo '<span class="new-badge">' . esc_html__('NEW', 'spiraclethemes-site-library') . '</span>';
                }
                printf(
                    '<a href="%1$s" target="_blank">%2$s</a>',
                    esc_url($post['link']),
                    esc_html($post['title']['rendered'])
                );
                echo '</li>';
            }
        } else {
            echo '<li>' . esc_html__('No recent posts found.', 'spiraclethemes-site-library') . '</li>';
        }

        echo '</ul>';
    }

    

    // Display footer links
    echo '<div>';
    printf(
        '<a href="%1$s" target="_blank">' . __( 'Help Us to Translate %2$s', 'spiraclethemes-site-library' ) . ' <span class="dashicons dashicons-external"></span></a> | ',
        esc_url( 'https://translate.wordpress.org/projects/wp-themes/' . WP_THEME_SLUG . '/' ),
        esc_html( WP_THEME )
    );
    printf(
        '<a href="%1$s" target="_blank">' . __( 'Write a Review', 'spiraclethemes-site-library' ) . '<span class="dashicons dashicons-external"></span></a>',
        esc_url( 'https://wordpress.org/support/theme/' . WP_THEME_SLUG . '/reviews/#new-post' )
    );

    echo '</div>';
}

// Hook into the dashboard setup action
add_action('wp_dashboard_setup', 'spiraclethemes_site_library_add_dashboard_widgets');


// Ensure our widget is always on top
function spiraclethemes_site_library_move_widget_to_top() {
    if (get_current_screen()->id !== 'dashboard') {
        return;
    }
    
    global $wp_meta_boxes;

    // Check if our widget is set
    if (isset($wp_meta_boxes['dashboard']['normal']['core']['spiraclethemes_site_library_dashboard_widget'])) {
        $widget_backup = $wp_meta_boxes['dashboard']['normal']['core']['spiraclethemes_site_library_dashboard_widget'];
        unset($wp_meta_boxes['dashboard']['normal']['core']['spiraclethemes_site_library_dashboard_widget']);

        // Insert the widget at the beginning of the array
        $wp_meta_boxes['dashboard']['normal']['core'] =
            array_merge(['spiraclethemes_site_library_dashboard_widget' => $widget_backup], $wp_meta_boxes['dashboard']['normal']['core']);
    }
}
add_action('admin_head', 'spiraclethemes_site_library_move_widget_to_top');