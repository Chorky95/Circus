<?php

/**
 * Hero Block Template
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Get ACF fields
$title = get_field('hero_block_title');
$subtitle = get_field('hero_block_subtitle');
$background_image = get_field('hero_block_background_image');

// Show screenshot in preview mode when no content is set
if ($is_preview && empty($title) && empty($subtitle) && empty($background_image)) {
    echo '<img src="' . get_template_directory_uri() . '/blocks/acf/hero-block/screenshot.png" alt="Hero Block Preview" style="width: 100%; height: auto;">';
    return;
}

// Create block ID and class attributes
$block_id = 'hero-' . $block['id'];
$class_name = 'hero-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
?>

<div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($class_name); ?>">
    <?php if ($background_image): ?>
        <img class="hero-block__background" src="<?php echo esc_url($background_image['url']); ?>" />
    <?php endif; ?>
    <?php if ($title || $subtitle): ?>
        <div class="hero-block__content">
            <?php if ($title): ?>
                <h1 class="hero-block__title heading-1"><?php echo esc_html($title); ?></h1>
            <?php endif; ?>

            <?php if ($subtitle): ?>
                <p class="hero-block__subtitle body-2"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>