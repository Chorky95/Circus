<?php

/**
 * Image Content Block (React) - Render Template
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block content.
 * @param WP_Block $block      Block instance.
 */

// Get block attributes
$title = isset($attributes['title']) ? $attributes['title'] : '';
$text = isset($attributes['text']) ? $attributes['text'] : '';
$link_url = isset($attributes['linkUrl']) ? $attributes['linkUrl'] : '';
$link_text = isset($attributes['linkText']) ? $attributes['linkText'] : '';
$link_target = isset($attributes['linkTarget']) ? $attributes['linkTarget'] : '';
$image_url = isset($attributes['imageUrl']) ? $attributes['imageUrl'] : '';
$image_alt = isset($attributes['imageAlt']) ? $attributes['imageAlt'] : '';

// Create block ID and class attributes
$block_id = 'image-content-react-' . uniqid();
$class_name = 'image-content-block';
if (!empty($attributes['className'])) {
    $class_name .= ' ' . $attributes['className'];
}
if (!empty($attributes['align'])) {
    $class_name .= ' align' . $attributes['align'];
}

// Don't render if no content
if (empty($title) && empty($text) && empty($link_url) && empty($image_url)) {
    return;
}
?>

<div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($class_name); ?>">
    <div class="image-content-block__container container">
        <div class="image-content-block__content">
            <?php if (!empty($title)) : ?>
                <h2 class="image-content-block__title heading-2"><?php echo wp_kses_post($title); ?></h2>
            <?php endif; ?>

            <?php if (!empty($text)) : ?>
                <p class="image-content-block__text body-2"><?php echo wp_kses_post($text); ?></p>
            <?php endif; ?>

            <?php if (!empty($link_url) && !empty($link_text)) : ?>
                <a href="<?php echo esc_url($link_url); ?>" class="image-content-block__link button" <?php echo !empty($link_target) ? 'target="' . esc_attr($link_target) . '"' : ''; ?>>
                    <?php echo esc_html($link_text); ?>
                </a>
            <?php endif; ?>
        </div>

        <?php if (!empty($image_url)) : ?>
            <div class="image-content-block__image">
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt ?: strip_tags($title)); ?>">
            </div>
        <?php endif; ?>
    </div>
</div>