<?php

/**
 * Image Content Block template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Path to your screenshot (put screenshot.png inside the block folder)
$screenshot = get_template_directory_uri() . '/blocks/image-content-block/screenshot.png';

// Show screenshot in inserter or editor preview
if (! empty($block['data']['is_example']) || ! empty($is_preview)) {
    echo '<img src="' . esc_url($screenshot) . '" alt="Block preview" style="max-width:100%;height:auto;" />';
    return;
}

// Get ACF fields
$image = get_field('image_content_image');
$content = get_field('image_content_content');
$left_button = get_field('image_content_left_button');
$right_button = get_field('image_content_right_button');
$show_delivery_info = get_field('show_delivery_info');
$delivery_info = get_field('delivery_info');
?>

<section class="image-content">
    <div class="image-content__container">
        <?php if ($image) : ?>
            <div class="image-content__image">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Image'); ?>">
            </div>
        <?php endif; ?>

        <div class="image-content__content">
            <?php if ($content) : ?>
                <div class="image-content__text">
                    <?php echo wp_kses_post($content); ?>
                </div>
            <?php endif; ?>

            <?php if ($left_button || $right_button) : ?>
                <div class="image-content__buttons">
                    <?php if ($left_button) :
                        $left_button_type = $left_button['button_type'] ?? 'link';
                        $left_color = $left_button['image_content_left_button_type'] ?? 'orange';
                        $left_class = 'button' . ($left_color === 'white' ? ' button--white-bordered' : '');

                        if ($left_button_type === 'link' && !empty($left_button['image_content_left_button_link'])) :
                            $left_link = $left_button['image_content_left_button_link'];
                    ?>
                            <a href="<?php echo esc_url($left_link['url']); ?>"
                                class="<?php echo esc_attr($left_class); ?>"
                                <?php echo $left_link['target'] ? 'target="' . esc_attr($left_link['target']) . '"' : ''; ?>>
                                <?php echo esc_html($left_link['title']); ?>
                            </a>
                        <?php elseif ($left_button_type === 'order') : ?>
                            <?php get_template_part('components/order-button', null, ['class' => $left_class]); ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ($right_button) :
                        $right_button_type = $right_button['button_type'] ?? 'link';
                        $right_color = $right_button['image_content_right_button_type'] ?? 'orange';
                        $right_class = 'button' . ($right_color === 'white' ? ' button--white-bordered' : '');

                        if ($right_button_type === 'link' && !empty($right_button['image_content_right_button_link'])) :
                            $right_link = $right_button['image_content_right_button_link'];
                    ?>
                            <a href="<?php echo esc_url($right_link['url']); ?>"
                                class="<?php echo esc_attr($right_class); ?>"
                                <?php echo $right_link['target'] ? 'target="' . esc_attr($right_link['target']) . '"' : ''; ?>>
                                <?php echo esc_html($right_link['title']); ?>
                            </a>
                        <?php elseif ($right_button_type === 'order') : ?>
                            <?php get_template_part('components/order-button', null, ['class' => $right_class]); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($show_delivery_info && $delivery_info) : ?>
                <div class="image-content__delivery">
                    <?php if (!empty($delivery_info['delivery_info_title'])) : ?>
                        <div class="image-content__delivery-header">
                            <div class="image-content__delivery-icon-wrapper">
                                <img src="<?php echo get_template_directory_uri(); ?>/icons/delivery-icon.svg" alt="" class="image-content__delivery-icon" width="24" height="24">
                            </div>
                            <h3 class="image-content__delivery-title"><?php echo esc_html($delivery_info['delivery_info_title']); ?></h3>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($delivery_info['delivery_info_items'])) : ?>
                        <div class="image-content__delivery-list">
                            <?php foreach ($delivery_info['delivery_info_items'] as $item) : ?>
                                <div class="image-content__delivery-item">
                                    <div class="image-content__delivery-check"></div>
                                    <span><?php echo esc_html($item['delivery_info_item']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>