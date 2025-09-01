<?php
/**
 *
 * @package spiraclethemes-site-library
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) :
    die;
endif;


/**
 *  Set theme classname
 */

function spiraclethemes_site_library_admin_classes( $classes ) {
    global $pagenow;
    $classes .= 'theme-blogson';
    return $classes;
}

add_filter( 'admin_body_class', 'spiraclethemes_site_library_admin_classes' );


/**
 *  Set Import files
 */


if ( ! function_exists( 'spiraclethemes_site_library_blogson_set_import_files' ) ) :
function spiraclethemes_site_library_blogson_set_import_files() {

    $customizer_blogson_demo1 = spiraclethemes_site_library_api_data('blogson', 'demo1', 'customizer');
    $widgets_blogson_demo1 = spiraclethemes_site_library_api_data('blogson', 'demo1', 'widgets');
    $content_blogson_demo1 = spiraclethemes_site_library_api_data('blogson', 'demo1', 'content');
    $image_blogson_demo1 = spiraclethemes_site_library_api_data('blogson', 'demo1', 'image');

    return array(
        array(
            'import_file_name'           => esc_html__('Demo 1', 'spiraclethemes-site-library'),
            'import_file_url'          => $content_blogson_demo1,
            'import_widget_file_url'   => $widgets_blogson_demo1,
            'import_customizer_file_url' => $customizer_blogson_demo1,
            'import_preview_image_url'     => $image_blogson_demo1,
            'import_notice'              => esc_html__( 'After you import this demo, you will have to change some menu links. Please check documentation for more information', 'spiraclethemes-site-library' ),
            'preview_url'                  => 'https://wpthemes.spiraclethemes.com/blogson/',
        ),
    );
}
endif;
add_filter( 'pt-ocdi/import_files', 'spiraclethemes_site_library_blogson_set_import_files' );


/**
 *  After Import
 */

if ( ! function_exists( 'spiraclethemes_site_library_blogson_after_import_setup' ) ) :
function spiraclethemes_site_library_blogson_after_import_setup( $selected_import ) {
	//Assign menus to their locations
	$main_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
	$footer_menu = get_term_by( 'name', 'Footer', 'nav_menu' );
	$sidebar_social_menu = get_term_by( 'name', 'Social Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
	      'primary' => $main_menu->term_id,
	      'footer' => $footer_menu->term_id,
	      'social' => $sidebar_social_menu->term_id,
	    )
	);

    //Assign front & blog page
    $front_page = get_page_by_title( 'Home' );  

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page -> ID ); 
    
}
endif;
add_action( 'pt-ocdi/after_import', 'spiraclethemes_site_library_blogson_after_import_setup' );


function spiraclethemes_site_library_blogson_check_pro_plugin() {
    if ( ! function_exists( 'ocdi_register_plugins' ) ) :
        function ocdi_register_plugins( $plugins ) {
         
            // List of plugins used by all theme demos.
            $theme_plugins = [
                [ 
                  'name'     => 'Elementor Website Builder',
                  'slug'     => 'elementor',
                  'required' => true,
                ],
            ];
         
            return array_merge( $plugins, $theme_plugins );
        }
    endif;
    add_filter( 'ocdi/register_plugins', 'ocdi_register_plugins' );
}
add_action( 'admin_init', 'spiraclethemes_site_library_blogson_check_pro_plugin' );


/**
 *  Blogson functions
 */

function spiraclethemes_site_library_blogson_get_categories(){
    $categories = get_categories( [
        'taxonomy'     => 'category',
        'type'         => 'post',
        'child_of'     => 0,
        'parent'       => '',
        'orderby'      => 'name',
        'order'        => 'ASC',
        'hide_empty'   => 1,
        'hierarchical' => 1,
        'exclude'      => '',
        'include'      => '',
        'number'       => 0,
        'pad_counts'   => false,
    ]);
    if( $categories ){
        foreach( $categories as $cat ){
            $cat_select[$cat->slug] = $cat->name;
        }
    } else {
        $cat_select = array(''=>'No categories');
    }
    return $cat_select;
}


function spiraclethemes_site_library_blogson_get_all_posts(){
    $args = array(
        'post_status' => 'publish',
        'post_type' => 'post',
        'posts_per_page' => -1,
        'orderby'       => 'date'
    );
    $the_query = new WP_Query( $args );
    $array_of_post = array();
    $array_of_post['no'] = esc_html__('-- No select --', 'spiraclethemes-site-library');
    if($the_query->have_posts()){
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $array_of_post[get_the_ID()] = esc_html(get_the_title());
        }
    }
    wp_reset_postdata();
    return $array_of_post;
}



if (!function_exists('spiraclethemes_site_library_blogson_gridposts')) {
    function spiraclethemes_site_library_blogson_gridposts($atts, $content = null) {
        $atts = shortcode_atts(array(
            'show_section_title'            => 'true',
            'section_title'                 => '',
            'section_title_size'           => 'h2',
            'post_count'                   => '4',
            'post_columns'                 => 'span6',
            'post_style'                   => 'style_1',
            'post_orderby'                 => 'date',
            'post_order'                   => 'DESC',
            'post_cat_slug'                => '',
            'post_ids'                     => '',
            'post__not_in'                 => '',
            'post_thumbsize'               => 'post-thumbnail',
            'post_content_show'            => 'false',
            'post_excerpt_count'           => '15',
            'post_display_categories'      => 'true',
            'post_display_date'            => 'true',
            'post_display_author'          => 'true',
            'post_display_author_pre_text' => 'By',
            'post_display_comments'        => 'true',
            'post_show_readmore'           => 'false',
            'post_readmore_text'           => 'Read More',
            'post_ignore_featured'         => 'true',
            'post_trim_title'              => 'true',
            'post_trim_title_count'        => '7',
            'post_text_position'           => 'bottomcenter',
        ), $atts, 'gridposts');

        // Sanitize
        $atts['section_title']                = sanitize_text_field($atts['section_title']);
        $atts['section_title_size']           = sanitize_text_field($atts['section_title_size']);
        $atts['post_count']                   = absint($atts['post_count']);
        $atts['post_columns']                 = sanitize_html_class($atts['post_columns']);
        $atts['post_style']                   = sanitize_html_class($atts['post_style']);
        $atts['post_orderby']                 = sanitize_text_field($atts['post_orderby']);
        $atts['post_order']                   = in_array($atts['post_order'], ['ASC', 'DESC']) ? $atts['post_order'] : 'DESC';
        $atts['post_cat_slug']                = sanitize_text_field($atts['post_cat_slug']);
        $atts['post_ids']                     = sanitize_text_field($atts['post_ids']);
        $atts['post__not_in']                 = sanitize_text_field($atts['post__not_in']);
        $atts['post_thumbsize']               = sanitize_text_field($atts['post_thumbsize']);
        $atts['post_excerpt_count']           = absint($atts['post_excerpt_count']);
        $atts['post_display_author_pre_text'] = sanitize_text_field($atts['post_display_author_pre_text']);
        $atts['post_readmore_text']           = sanitize_text_field($atts['post_readmore_text']);
        $atts['post_trim_title_count']        = absint($atts['post_trim_title_count']);
        $atts['post_text_position']           = sanitize_html_class($atts['post_text_position']);

        $bool_keys = [
            'show_section_title',
            'post_content_show',
            'post_display_categories',
            'post_display_date',
            'post_display_author',
            'post_display_comments',
            'post_show_readmore',
            'post_ignore_featured',
            'post_trim_title',
        ];
        foreach ($bool_keys as $key) {
            $atts[$key] = in_array($atts[$key], ['true', '1'], true);
        }

        // Convert CSV post IDs to arrays
        $atts['post_ids'] = $atts['post_ids'] ? array_map('absint', explode(',', str_replace(' ', '', $atts['post_ids']))) : [];
        $atts['post__not_in'] = $atts['post__not_in'] ? array_map('absint', explode(',', str_replace(' ', '', $atts['post__not_in']))) : [];

        // Determine style-specific adjustments
        $contentoverimage = in_array($atts['post_style'], ['style_1', 'style_2']) ? 'contentoverimage' : 'nocontentoverimage';

        // Sticky logic
        $sticky_count = (new WP_Query([
            'post__in' => get_option('sticky_posts'),
            'post_status' => 'publish',
        ]))->post_count;

        if ($atts['post_style'] === 'style_1') {
            $atts['post_count'] = ($atts['post_cat_slug'] === '' && $sticky_count > 0) ? max(0, 3 - $sticky_count) : 3;
            $atts['post_columns'] = 'span4f';
        }

        // Query args
        $args = [
            'post_type'      => 'post',
            'posts_per_page'=> $atts['post_count'],
            'order'         => $atts['post_order'],
            'orderby'       => $atts['post_orderby'],
            'post_status'   => 'publish',
            'post__in'      => $atts['post_ids'],
            'post__not_in'  => $atts['post__not_in'],
        ];

        if ($atts['post_cat_slug'] && $atts['post_cat_slug'] !== 'all') {
            $args['tax_query'][] = [
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => explode(',', str_replace(' ', '', $atts['post_cat_slug'])),
            ];
        }

        $query = new WP_Query($args);
        $output = '';

        if ($query->have_posts()) {
            static $post_section_id = 0;
            $post_section_id++;

            $output .= '<div class="latest-posts">';
            if (!empty($atts['show_section_title']) && !empty($atts['section_title'])) {
                // Whitelist allowed heading tags
                $allowed_tags = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');

                $tag = in_array($atts['section_title_size'], $allowed_tags, true) 
                    ? $atts['section_title_size'] 
                    : 'h2'; // default tag

                $output .= sprintf(
                    '<%1$s class="post_title">%2$s</%1$s>',
                    $tag,
                    esc_html($atts['section_title'])
                );
            }

            $output .= '<div id="blog-posts-' . $post_section_id . '" class="row-fluid blog-posts">';

            while ($query->have_posts()) {
                $query->the_post();

                $post_id = get_the_ID();
                $img = has_post_thumbnail() ?
                    wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $atts['post_thumbsize'])[0] :
                    esc_url(plugins_url('img/no-image.jpg', dirname(__FILE__)));

                $classes = implode(' ', get_post_class('', $post_id));
                $classes = str_replace('sticky ', '', $classes);

                $output .= '<article class="textcenter ' . esc_attr("$classes {$contentoverimage} {$atts['post_columns']} {$atts['post_style']} {$atts['post_text_position']}") . '">';
                $output .= '<div id="post-' . esc_attr($post_id) . '" class="post-grid-area-box">';

                if ($atts['post_style'] === 'style_3') {
                    $output .= '<div class="post-grid">';
                    $output .= '<div class="content-wrapper">';
                    $output .= '<div class="post-image"><img src="' . esc_url($img) . '" alt=""></div>';
                } else {
                    $output .= '<div class="post-grid-area-content" style="background-image:url(\'' . esc_url($img) . '\');">';
                    $output .= '<div class="content-wrapper">';
                }

                $output .= '<div class="content"><div class="content-inner">';

                // Categories
                if ($atts['post_display_categories']) {
                    $output .= '<div class="category"><span>' . wp_kses(get_the_category_list(', '), [
                        'a' => ['href' => [], 'rel' => []],
                        'span' => [],
                    ]) . '</span></div>';
                }

                // Title
                $output .= '<div class="title">';
                $title = get_the_title();
                $output .= '<h2><a href="' . esc_url(get_permalink()) . '" title="' . esc_attr($title) . '" rel="bookmark">';
                $output .= $atts['post_trim_title'] ? esc_html(wp_trim_words($title, $atts['post_trim_title_count'])) : esc_html($title);
                $output .= '</a></h2></div>';

                // Meta
                $output .= '<div class="meta">';
                if ($atts['post_display_author']) {
                    $output .= '<span class="author">' . esc_html($atts['post_display_author_pre_text']) . ': ';
                    $output .= '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>';
                }
                if ($atts['post_display_date']) {
                    $output .= '<span class="date">' . esc_html(get_the_time(get_option('date_format'))) . '</span>';
                }
                if ($atts['post_display_comments']) {
                    $output .= '<span class="comments"><a href="' . esc_url(get_comments_link()) . '">' . esc_html(get_comments_number()) . ' ' . esc_html__('Comments', 'blogson') . '</a></span>';
                }
                $output .= '</div>'; // meta

                // Content
                if ($atts['post_content_show']) {
                    $output .= '<div class="main-content"><p class="post-content">' . esc_html(wp_trim_words(strip_tags(get_the_content()), $atts['post_excerpt_count'])) . '</p></div>';
                }

                // Read More
                if ($atts['post_show_readmore']) {
                    $output .= '<div class="post-read-more"><a href="' . esc_url(get_permalink()) . '">' . esc_html($atts['post_readmore_text']) . '</a></div>';
                }

                $output .= '</div></div>';

                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</article>';
            }

            $output .= '</div></div>';
        }

        wp_reset_postdata();
        return $output;
    }
    add_shortcode('gridposts', 'spiraclethemes_site_library_blogson_gridposts');
}
