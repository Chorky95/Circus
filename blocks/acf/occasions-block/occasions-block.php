<?php

/**
 * Occasions Block template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Path to your screenshot (put screenshot.png inside the block folder)
$screenshot = get_template_directory_uri() . '/blocks/occasions-block/screenshot.png';

// Show screenshot in inserter or editor preview
if (! empty($block['data']['is_example']) || ! empty($is_preview)) {
    echo '<img src="' . esc_url($screenshot) . '" alt="Block preview" style="max-width:100%;height:auto;" />';
    return;
}

// Get ACF fields
$occasions_image = get_field('occasions_image');
$occasions_title = get_field('occasions_title');
$occasions_items = get_field('occasions_items');
$occasion_price_notice = get_field('occasion_price_notice');
$ocassions_extra_services_title = get_field('ocassions_extra_services_title');
$ocassions_extra_services_items = get_field('ocassions_extra_services_items');
$kontakt_text = get_field('kontakt_text');
$kontakt_link = get_field('kontakt_link');
?>

<section class="occasions">
    <div class="occasions__container">
        <?php if ($occasions_image) : ?>
            <div class="occasions__image">
                <img src="<?php echo esc_url($occasions_image['url']); ?>" alt="<?php echo esc_attr($occasions_image['alt'] ?: 'Occasions'); ?>">
            </div>
        <?php endif; ?>

        <div class="occasions__content">
            <?php if ($occasions_title) : ?>
                <h2 class="occasions__title"><?php echo esc_html($occasions_title); ?></h2>
            <?php endif; ?>

            <?php if ($occasions_items) : ?>
                <div class="occasions__list">
                    <?php foreach ($occasions_items as $item) : ?>
                        <div class="occasions__item">
                            <img src="<?php echo get_template_directory_uri(); ?>/icons/hand_meal.svg" alt="" class="occasions__icon" width="20" height="20">
                            <span><?php echo esc_html($item['occasions_title']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($occasion_price_notice) : ?>
                <div class="occasions__price-notice">
                    <?php echo esc_html($occasion_price_notice); ?>
                </div>
            <?php endif; ?>

            <?php if ($ocassions_extra_services_title || $ocassions_extra_services_items) : ?>
                <div class="occasions__extra-services">
                    <?php if ($ocassions_extra_services_title) : ?>
                        <p class="occasions__extra-title"><?php echo esc_html($ocassions_extra_services_title); ?></p>
                    <?php endif; ?>

                    <?php if ($ocassions_extra_services_items) : ?>
                        <div class="occasions__extra-list">
                            <?php foreach ($ocassions_extra_services_items as $service) : ?>
                                <div class="occasions__extra-item">
                                    <img src="<?php echo get_template_directory_uri(); ?>/icons/hand_meal.svg" alt="" class="occasions__icon" width="20" height="20">
                                    <span><?php echo esc_html($service['ocassions_extra_services_item']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($kontakt_text) : ?>
                <p class="occasions__contact-text"><?php echo esc_html($kontakt_text); ?></p>
            <?php endif; ?>

            <?php if ($kontakt_link) : ?>
                <a href="<?php echo esc_url($kontakt_link['url']); ?>"
                    class="occasions__button button"
                    <?php echo $kontakt_link['target'] ? 'target="' . esc_attr($kontakt_link['target']) . '"' : ''; ?>>
                    <?php echo esc_html($kontakt_link['title']); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>