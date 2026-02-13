<?php

/**
 * Hero Block template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Path to your screenshot (put screenshot.png inside the block folder)
$screenshot = get_template_directory_uri() . '/blocks/hero-block/screenshot.png';

// Show screenshot in inserter or editor preview
if (! empty($block['data']['is_example']) || ! empty($is_preview)) {
    echo '<img src="' . esc_url($screenshot) . '" alt="Block preview" style="max-width:100%;height:auto;" />';
    return;
}

// Get ACF fields
$hero_title = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
$hero_background = get_field('hero_background');

// Include the hero-block component
get_template_part('components/hero-block', null, [
    'title' => $hero_title,
    'subtitle' => $hero_subtitle,
    'background' => $hero_background,
    'show_search' => false  // Always show logo, not search
]);
