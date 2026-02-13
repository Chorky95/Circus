<?php

/**
 * Special Offers Block Template
 *
 * @param array $block The block settings and attributes.
 */

// Get block fields
$title = get_field('special_offers_title');
$special_offers = get_field('special_offers');
$contact_link = get_field('_special_offers_contact_link');
$brand_element = get_field('brand_element');

// Support custom ID
$block_id = 'special-offers-block-' . ($block['id'] ?? uniqid());

if (is_admin()) {
    echo '<p style="padding: 20px; background: #f0f0f0; border: 1px solid #ddd;">Special Offers Block Preview</p>';
    return;
}
?>

<div id="<?php echo esc_attr($block_id); ?>" class="special-offers-block">
    <div class="special-offers-block__container">
        <?php if ($title) : ?>
            <h2 class="special-offers-block__title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($special_offers || $brand_element) : ?>
            <div class="special-offers-block__grid">
                <!-- Special Offers -->
                <?php if ($special_offers) : ?>
                    <?php foreach ($special_offers as $offer) :
                        if (!$offer) continue;

                        $offer_title = get_the_title($offer->ID);
                        $offer_excerpt = get_field('special_offer_description', $offer->ID);
                        $offer_link = get_permalink($offer->ID);
                    ?>
                        <?php
                        get_template_part('components/offer-card', null, array(
                            'title' => $offer_title,
                            'description' => $offer_excerpt,
                            'link_url' => $offer_link,
                            'contact_link' => $contact_link
                        ));
                        ?>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Brand Element -->
                <?php if ($brand_element) :
                    $logo = $brand_element['brand_element_logo'];
                    $brand_title = $brand_element['brand_element_title'];
                    $brand_text = $brand_element['brand_element_text'];
                ?>
                    <div class="special-offers-block__brand">
                        <?php if ($logo) : ?>
                            <div class="special-offers-block__brand-icon">
                                <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?? ''); ?>">
                            </div>
                        <?php endif; ?>

                        <?php if ($brand_title) : ?>
                            <h3 class="special-offers-block__brand-title"><?php echo esc_html($brand_title); ?></h3>
                        <?php endif; ?>

                        <?php if ($brand_text) : ?>
                            <p class="special-offers-block__brand-text"><?php echo esc_html($brand_text); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>