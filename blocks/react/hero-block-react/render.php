<?php

/**
 * Hero Block (React) Render Template
 *
 * @param array $attributes The block attributes.
 * @param string $content The block content.
 * @param WP_Block $block The block instance.
 */

// Get block attributes
$title = isset($attributes['title']) ? $attributes['title'] : '';
$subtitle = isset($attributes['subtitle']) ? $attributes['subtitle'] : '';
$background_image_url = isset($attributes['backgroundImageUrl']) ? $attributes['backgroundImageUrl'] : '';

// Create block ID and class attributes
$block_id = 'hero-' . uniqid();
$class_name = 'hero-block';
if (!empty($attributes['className'])) {
    $class_name .= ' ' . $attributes['className'];
}
if (!empty($attributes['align'])) {
    $class_name .= ' align' . $attributes['align'];
}
?>

<div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($class_name); ?>">
    <?php if ($background_image_url): ?>
        <img class="hero-block__background" src="<?php echo esc_url($background_image_url); ?>" alt="" />
    <?php endif; ?>
    <?php if ($title || $subtitle): ?>
        <div class="hero-block__content">
            <?php if ($title): ?>
                <h1 class="hero-block__title heading-1"><?php echo wp_kses_post($title); ?></h1>
            <?php endif; ?>

            <?php if ($subtitle): ?>
                <p class="hero-block__subtitle body-2"><?php echo wp_kses_post($subtitle); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>