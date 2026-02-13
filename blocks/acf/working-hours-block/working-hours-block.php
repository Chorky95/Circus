<?php

/**
 * Working Hours Block template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Path to your screenshot (put screenshot.png inside the block folder)
$screenshot = get_template_directory_uri() . '/blocks/working-hours-block/screenshot.png';

// Show screenshot in inserter or editor preview
if (! empty($block['data']['is_example']) || ! empty($is_preview)) {
    echo '<img src="' . esc_url($screenshot) . '" alt="Block preview" style="max-width:100%;height:auto;" />';
    return;
}

// Get ACF fields
$daily_offering_title = get_field('working_hours_daily_offering_title');
$daily_offering_time = get_field('working_hours_daily_offering_time');
$working_hours_text = get_field('working_hours_text');
$working_hours_left_text = get_field('working_hours_left_text');
$working_hours_left_time = get_field('working_hours_left_time');
$working_hours_right_text = get_field('working_hours_right_text');
$working_hours_right_time = get_field('working_hours_right_time');
$lunches_text = get_field('working_hours_lunches_text');
$lunches_time = get_field('working_hours_lunches_time');
?>

<section class="working-hours">
    <div class="working-hours__container">
        <!-- Daily Offering -->
        <div class="working-hours__item">
            <div class="working-hours__icon">
                <img src="<?php echo get_template_directory_uri(); ?>/icons/coffee.svg" alt="Coffee" width="24" height="24">
            </div>
            <?php if ($daily_offering_title) : ?>
                <p class="working-hours__title"><?php echo esc_html($daily_offering_title); ?></p>
            <?php endif; ?>
            <?php if ($daily_offering_time) : ?>
                <p class="working-hours__time"><?php echo esc_html($daily_offering_time); ?></p>
            <?php endif; ?>
        </div>

        <!-- Working Hours Box -->
        <div class="working-hours__box">
            <div class="working-hours__box-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/icons/clock.svg" alt="Clock" width="40" height="40">
            </div>

            <?php if ($working_hours_text) : ?>
                <p class="working-hours__box-title"><?php echo esc_html($working_hours_text); ?></p>
            <?php endif; ?>

            <div class="working-hours__box-content">
                <div class="working-hours__box-item">
                    <?php if ($working_hours_left_text) : ?>
                        <p class="working-hours__box-label"><?php echo esc_html($working_hours_left_text); ?></p>
                    <?php endif; ?>
                    <?php if ($working_hours_left_time) : ?>
                        <p class="working-hours__box-time"><?php echo esc_html($working_hours_left_time); ?></p>
                    <?php endif; ?>
                </div>

                <div class="working-hours__box-item">
                    <?php if ($working_hours_right_text) : ?>
                        <p class="working-hours__box-label"><?php echo esc_html($working_hours_right_text); ?></p>
                    <?php endif; ?>
                    <?php if ($working_hours_right_time) : ?>
                        <p class="working-hours__box-time"><?php echo esc_html($working_hours_right_time); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Lunches -->
        <div class="working-hours__item">
            <div class="working-hours__icon">
                <img src="<?php echo get_template_directory_uri(); ?>/icons/fork-spoon.svg" alt="Fork and Spoon" width="24" height="24">
            </div>
            <?php if ($lunches_text) : ?>
                <p class="working-hours__title"><?php echo esc_html($lunches_text); ?></p>
            <?php endif; ?>
            <?php if ($lunches_time) : ?>
                <p class="working-hours__time"><?php echo esc_html($lunches_time); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>