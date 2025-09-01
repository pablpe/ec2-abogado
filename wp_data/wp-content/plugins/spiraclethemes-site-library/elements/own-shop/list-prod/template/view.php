<?php

$settings = $this->get_settings();
$id = $this->get_id();

$prod_count         = absint($settings['prod_count'] ?? 8);
$prod_columns_count = absint($settings['prod_columns_count'] ?? 4);
$prod_display_tabs  = (($settings['prod_display_tabs'] ?? 'true') === 'true' || ($settings['prod_display_tabs'] ?? 'true') === '1') ? 'true' : 'false';

$prod_options_raw = $settings['prod_options'] ?? '';

if (is_array($prod_options_raw)) {
    $prod_options = implode(',', array_map('esc_attr', $prod_options_raw));
} else {
    $prod_options = esc_attr($prod_options_raw);
}

$out = '[listprod'
    . ' prod_options="' . $prod_options . '"'
    . ' prod_count="' . $prod_count . '"'
    . ' prod_columns_count="' . $prod_columns_count . '"'
    . ' prod_display_tabs="' . $prod_display_tabs . '"]';

echo shortcode_unautop(do_shortcode($out));
?>
