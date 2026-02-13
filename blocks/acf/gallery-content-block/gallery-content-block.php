<?php

/**
 * Gallery Content Block template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Path to your screenshot (put screenshot.png inside the block folder)
$screenshot = get_template_directory_uri() . '/blocks/gallery-content-block/screenshot.png';

// Show screenshot in inserter or editor preview
if (! empty($block['data']['is_example']) || ! empty($is_preview)) {
    echo '<img src="' . esc_url($screenshot) . '" alt="Block preview" style="max-width:100%;height:auto;" />';
    return;
}

// Get ACF fields
$gallery = get_field('gallery_content_gallery');
$content = get_field('gallery_content_content');

// Generate unique ID for this block instance
$block_id = 'gallery-content-' . $block['id'];
?>

<section class="gallery-content">
    <div class="gallery-content__container">
        <?php if ($gallery && is_array($gallery)) : ?>
            <div class="gallery-content__gallery">
                <!-- Main Swiper -->
                <div class="swiper gallery-content__main" id="<?php echo esc_attr($block_id); ?>-main">
                    <div class="swiper-wrapper">
                        <?php foreach ($gallery as $item) :
                            $image = $item['gallery_content_gallery_image'];
                            if ($image) :
                        ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Gallery image'); ?>">
                                </div>
                        <?php endif;
                        endforeach; ?>
                    </div>
                </div>

                <!-- Thumbnail Swiper -->
                <div class="swiper gallery-content__thumbs" id="<?php echo esc_attr($block_id); ?>-thumbs">
                    <div class="swiper-wrapper">
                        <?php foreach ($gallery as $item) :
                            $image = $item['gallery_content_gallery_image'];
                            if ($image) :
                        ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo esc_url($image['sizes']['medium'] ?? $image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Gallery thumbnail'); ?>">
                                </div>
                        <?php endif;
                        endforeach; ?>
                    </div>
                    <div class="swiper-scrollbar"></div>
                </div>
            </div>
        <?php endif; ?>

        <div class="gallery-content__content">
            <?php if ($content) : ?>
                <div class="gallery-content__text">
                    <?php echo wp_kses_post($content); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>