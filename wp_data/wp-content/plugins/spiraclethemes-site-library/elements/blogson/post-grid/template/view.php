<?php
$settings = $this->get_settings();
$id = $this->get_id();

$section_title              = esc_attr($settings['section_title'] ?? '');
$section_title_size        = sanitize_text_field($settings['section_title_size'] ?? 'h2');
$post_count                = absint($settings['post_count'] ?? 4);
$post_columns              = sanitize_text_field($settings['post_columns'] ?? 'span6');
$post_style                = sanitize_text_field($settings['post_style'] ?? 'style_1');
$post_orderby              = sanitize_text_field($settings['post_orderby'] ?? 'date');
$post_order                = sanitize_text_field($settings['post_order'] ?? 'DESC');
$post_thumbsize            = sanitize_text_field($settings['post_thumbsize'] ?? 'post-thumbnail');
$post_excerpt_count        = absint($settings['post_excerpt_count'] ?? 15);
$post_display_author_pre_text = esc_attr($settings['post_display_author_pre_text'] ?? 'By');
$post_readmore_text        = esc_attr($settings['post_readmore_text'] ?? 'Read More');
$post_trim_title_count     = absint($settings['post_trim_title_count'] ?? 7);
$post_text_position        = sanitize_text_field($settings['post_text_position'] ?? 'bottomcenter');

$show_section_title      = (($settings['show_section_title'] ?? 'true') === 'true' || ($settings['show_section_title'] ?? 'true') === '1') ? 'true' : 'false';
$post_content_show       = (($settings['post_content_show'] ?? 'true') === 'true' || ($settings['post_content_show'] ?? 'true') === '1') ? 'true' : 'false';
$post_display_categories = (($settings['post_display_categories'] ?? 'true') === 'true' || ($settings['post_display_categories'] ?? 'true') === '1') ? 'true' : 'false';
$post_display_date       = (($settings['post_display_date'] ?? 'true') === 'true' || ($settings['post_display_date'] ?? 'true') === '1') ? 'true' : 'false';
$post_display_author     = (($settings['post_display_author'] ?? 'true') === 'true' || ($settings['post_display_author'] ?? 'true') === '1') ? 'true' : 'false';
$post_display_comments   = (($settings['post_display_comments'] ?? 'true') === 'true' || ($settings['post_display_comments'] ?? 'true') === '1') ? 'true' : 'false';
$post_show_readmore      = (($settings['post_show_readmore'] ?? 'false') === 'true' || ($settings['post_show_readmore'] ?? 'false') === '1') ? 'true' : 'false';
$post_ignore_featured    = (($settings['post_ignore_featured'] ?? 'true') === 'true' || ($settings['post_ignore_featured'] ?? 'true') === '1') ? 'true' : 'false';
$post_trim_title         = (($settings['post_trim_title'] ?? 'true') === 'true' || ($settings['post_trim_title'] ?? 'true') === '1') ? 'true' : 'false';


// Handle arrays
$post_ids = $settings['post_ids'] ?? array();
$post_ids = is_array($post_ids) ? implode(',', array_map('absint', $post_ids)) : '';

$post_cat_slug = $settings['post_cat_slug'] ?? array();
$post_cat_slug = is_array($post_cat_slug) ? implode(',', array_map('sanitize_title', $post_cat_slug)) : '';

$post__not_in = $settings['post__not_in'] ?? array();
$post__not_in = is_array($post__not_in) ? implode(',', array_map('absint', $post__not_in)) : '';

$shortcode = '[gridposts'
    . ' show_section_title="' . $show_section_title . '"'
    . ' section_title="' . $section_title . '"'
    . ' section_title_size="' . $section_title_size . '"'
    . ' post_count="' . $post_count . '"'
    . ' post_columns="' . $post_columns . '"'
    . ' post_style="' . $post_style . '"'
    . ' post_orderby="' . $post_orderby . '"'
    . ' post_order="' . $post_order . '"'
    . ' post_thumbsize="' . $post_thumbsize . '"'
    . ' post_content_show="' . $post_content_show . '"'
    . ' post_excerpt_count="' . $post_excerpt_count . '"'
    . ' post_display_categories="' . $post_display_categories . '"'
    . ' post_display_date="' . $post_display_date . '"'
    . ' post_display_author="' . $post_display_author . '"'
    . ' post_display_author_pre_text="' . $post_display_author_pre_text . '"'
    . ' post_display_comments="' . $post_display_comments . '"'
    . ' post_show_readmore="' . $post_show_readmore . '"'
    . ' post_readmore_text="' . $post_readmore_text . '"'
    . ' post_ignore_featured="' . $post_ignore_featured . '"'
    . ' post_trim_title="' . $post_trim_title . '"'
    . ' post_trim_title_count="' . $post_trim_title_count . '"'
    . ' post_text_position="' . $post_text_position . '"';

if (!empty($post_ids)) {
    $shortcode .= ' post_ids="' . $post_ids . '"';
}
if (!empty($post_cat_slug)) {
    $shortcode .= ' post_cat_slug="' . $post_cat_slug . '"';
}
if (!empty($post__not_in)) {
    $shortcode .= ' post__not_in="' . $post__not_in . '"';
}

$shortcode .= ']';

echo do_shortcode($shortcode);

?>