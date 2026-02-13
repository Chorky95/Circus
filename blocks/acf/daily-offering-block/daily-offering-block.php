<?php

/**
 * Daily Offering Block Template
 *
 * @param array $block The block settings and attributes.
 */

// Get block fields
$show_daily_offer = get_field('show_daily_offer');
$daily_offer = get_field('daily_offer');
$cta_boxes = get_field('daily_offering_cta_boxes');

// Check if offering card will be shown
$choose_from_menu = $daily_offer['choose_from_menu'] ?? 'no';
$has_foods = ($choose_from_menu === 'yes' && !empty($daily_offer['daily_offer_foods'])) ||
    ($choose_from_menu === 'no' && !empty($daily_offer['daily_offer_items']));
$has_offering_card = $show_daily_offer && $daily_offer && $has_foods;

// Support custom ID
// $block_id = 'daily-offering-block-' . ($block['id'] ?? uniqid());

if (is_admin()) {
    echo '<p style="padding: 20px; background: #f0f0f0; border: 1px solid #ddd;">Daily Offering Block Preview</p>';
    return;
}
?>

<div id="daily-offering" class="daily-offering-block">
    <div class="daily-offering-block__container">
        <div class="daily-offering-block__grid <?php echo !$has_offering_card ? 'daily-offering-block__grid--no-offering' : ''; ?>">
            <!-- Daily Offer Card (conditional) -->
            <?php if ($show_daily_offer && $daily_offer) : ?>
                <?php
                $choose_from_menu = $daily_offer['choose_from_menu'] ?? 'no';
                $items_to_display = [];
                $is_from_menu = false;

                if ($choose_from_menu === 'yes') {
                    $items_to_display = $daily_offer['daily_offer_foods'] ?? [];
                    $is_from_menu = true;
                } else {
                    $items_to_display = $daily_offer['daily_offer_items'] ?? [];
                    $is_from_menu = false;
                }

                if ($items_to_display) :
                ?>
                    <div class="daily-offering-block__card-wrapper">
                        <?php
                        get_template_part('components/offering-card', null, array(
                            'day' => $daily_offer['daily_offer_title'] ?? 'Dnevna ponuda',
                            'items' => $items_to_display,
                            'is_from_menu' => $is_from_menu,
                            'class' => ''
                        ));
                        ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- CTA Boxes -->
            <?php if ($cta_boxes) : ?>
                <?php foreach ($cta_boxes as $cta) : ?>
                    <div class="daily-offering-block__cta-wrapper">
                        <?php
                        get_template_part('components/cta-box', null, array(
                            'background' => $cta['background'],
                            'icon' => $cta['icon'],
                            'title' => $cta['title'],
                            'text' => $cta['text'],
                            'note' => $cta['note'],
                            'link_type' => $cta['link_type'],
                            'link' => $cta['link'],
                            'button_position' => 'bottom'
                        ));
                        ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>