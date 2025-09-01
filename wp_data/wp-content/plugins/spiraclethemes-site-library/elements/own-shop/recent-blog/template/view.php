<?php

$settings = $this->get_settings();
$id = $this->get_id();

$posts_count = absint($settings['posts_count'] ?? 3);

$post_display_excerpt = (($settings['post_display_excerpt'] ?? 'true') === 'true' || ($settings['post_display_excerpt'] ?? 'true') === '1') ? 'true' : 'false';

$post_display_readmore = (($settings['post_display_readmore'] ?? 'true') === 'true' || ($settings['post_display_readmore'] ?? 'true') === '1') ? 'true' : 'false';

$post_read_more = esc_attr($settings['post_read_more'] ?? 'READ MORE');

$post_cat_slug = $settings['post_cat_slug'] ?? '';
if (is_array($post_cat_slug)) {
    $post_cat_slug = implode(',', array_map('sanitize_title', $post_cat_slug));
} else {
    $post_cat_slug = sanitize_title($post_cat_slug);
}

$out = '[recentblog'
    . ' posts_count="' . $posts_count . '"'
    . ' post_cat_slug="' . $post_cat_slug . '"'
    . ' post_display_readmore="' . $post_display_readmore . '"'
    . ' post_read_more="' . $post_read_more . '"'
    . ' post_display_excerpt="' . $post_display_excerpt . '"]';

echo shortcode_unautop(do_shortcode($out));
?>
