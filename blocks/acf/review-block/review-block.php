<?php

/**
 * Review Block template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Path to your screenshot (put screenshot.png inside the block folder)
$screenshot = get_template_directory_uri() . '/blocks/review-block/screenshot.png';

// Show screenshot in inserter or editor preview
if (! empty($block['data']['is_example']) || ! empty($is_preview)) {
    echo '<img src="' . esc_url($screenshot) . '" alt="Block preview" style="max-width:100%;height:auto;" />';
    return;
}

// Get ACF fields
$title = get_field('review_block_title');
$link = get_field('review_block_link');
?>

<section class="review-block">
    <div class="review-block__container">
        <div class="review-block__circle review-block__circle--top-right"></div>
        <div class="review-block__circle review-block__circle--bottom-left"></div>

        <div class="review-block__content">
            <div class="review-block__icon">
                <img src="<?php echo get_template_directory_uri(); ?>/icons/handshake.svg" alt="Handshake" width="40" height="40">
            </div>

            <?php if ($title) : ?>
                <h2 class="review-block__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if ($link) : ?>
                <a href="<?php echo esc_url($link['url']); ?>"
                    class="button button--white"
                    <?php echo $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
                    <?php echo esc_html($link['title']); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>