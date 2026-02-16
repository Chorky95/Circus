<?php

/**
 * Image Content Block Template
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Get ACF fields
$title = get_field('image_content_title');
$text = get_field('image_content_text');
$link = get_field('image_content_link');
$image = get_field('image_content_image');

// Show screenshot in preview mode when no content is set
if ($is_preview && empty($title) && empty($text) && empty($link) && empty($image)) {
    echo '<img src="' . get_template_directory_uri() . '/blocks/acf/image-content-block/screenshot.png" alt="Image Content Block Preview" style="width: 100%; height: auto;">';
    return;
}

// Create block ID and class attributes
$block_id = 'image-content-block-' . $block['id'];
$class_name = 'image-content-block';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
?>

<div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($class_name); ?>">
    <div class="image-content-block__container container">
        <div class="image-content-block__content">
            <?php if ($title): ?>
                <h2 class="image-content-block__title heading-2"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if ($text): ?>
                <p class="image-content-block__text body-2"><?php echo esc_html($text); ?></p>
            <?php endif; ?>

            <?php if ($link): ?>
                <a href="<?php echo esc_url($link['url']); ?>" class="image-content-block__link button" <?php echo $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
                    <?php echo esc_html($link['title']); ?>
                </a>
            <?php endif; ?>
        </div>

        <?php if ($image): ?>
            <div class="image-content-block__image">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: $title); ?>">
            </div>
        <?php endif; ?>
    </div>
</div>