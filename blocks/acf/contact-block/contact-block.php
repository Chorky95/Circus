<?php

/**
 * Contact Block template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Path to your screenshot (put screenshot.png inside the block folder)
$screenshot = get_template_directory_uri() . '/blocks/contact-block/screenshot.png';

// Show screenshot in inserter or editor preview
if (! empty($block['data']['is_example']) || ! empty($is_preview)) {
    echo '<img src="' . esc_url($screenshot) . '" alt="Block preview" style="max-width:100%;height:auto;" />';
    return;
}

// Get ACF fields
$title = get_field('contact_title');
$delivery_title = get_field('contact_delivery_title');
$delivery_link = get_field('contact_delivery_call_link');
$address_title = get_field('contact_address_title');
$address_link = get_field('contact_address_link');
$catering_title = get_field('contact_catering_title');
$catering_link = get_field('contact_catering_link');
?>

<section class="contact-block">
    <div class="contact-block__container">
        <?php if ($title) : ?>
            <h2 class="contact-block__title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <div class="contact-block__items">
            <?php if ($delivery_title || $delivery_link) : ?>
                <div class="contact-block__item">
                    <?php if ($delivery_title) : ?>
                        <p class="contact-block__item-title"><?php echo esc_html($delivery_title); ?></p>
                    <?php endif; ?>

                    <?php if ($delivery_link) : ?>
                        <a href="<?php echo esc_url($delivery_link['url']); ?>"
                            class="contact-block__item-link"
                            <?php echo $delivery_link['target'] ? 'target="' . esc_attr($delivery_link['target']) . '"' : ''; ?>>
                            <?php echo esc_html($delivery_link['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($address_title || $address_link) : ?>
                <div class="contact-block__item">
                    <?php if ($address_title) : ?>
                        <p class="contact-block__item-title"><?php echo esc_html($address_title); ?></p>
                    <?php endif; ?>

                    <?php if ($address_link) : ?>
                        <a href="<?php echo esc_url($address_link['url']); ?>"
                            class="contact-block__item-link"
                            <?php echo $address_link['target'] ? 'target="' . esc_attr($address_link['target']) . '"' : ''; ?>>
                            <?php echo esc_html($address_link['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($catering_title || $catering_link) : ?>
                <div class="contact-block__item">
                    <?php if ($catering_title) : ?>
                        <p class="contact-block__item-title"><?php echo esc_html($catering_title); ?></p>
                    <?php endif; ?>

                    <?php if ($catering_link) : ?>
                        <a href="<?php echo esc_url($catering_link['url']); ?>"
                            class="contact-block__item-link"
                            <?php echo $catering_link['target'] ? 'target="' . esc_attr($catering_link['target']) . '"' : ''; ?>>
                            <?php echo esc_html($catering_link['title']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>