<?php

/**
 * Give Me Jokes Block Template
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Get ACF fields
$title = get_field('give_me_jokes_title');
$text = get_field('give_me_jokes_text');
$get_jokes_label = get_field('give_me_jokes_get_jokes_button_label');
$load_more_label = get_field('give_me_jokes_load_more_button_label');

// Show screenshot in preview mode when no content is set
if ($is_preview && empty($title) && empty($text)) {
    echo '<img src="' . get_template_directory_uri() . '/blocks/acf/give-me-jokes/screenshot.png" alt="Give Me Jokes Block Preview" style="width: 100%; height: auto;">';
    return;
}

// Create block ID and class attributes
$block_id = 'give-me-jokes-' . $block['id'];
$class_name = 'give-me-jokes';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}
?>

<div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($class_name); ?>">
    <div class="give-me-jokes__initial">
        <?php if ($title): ?>
            <h2 class="give-me-jokes__title heading-2"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>

        <?php if ($text): ?>
            <p class="give-me-jokes__text body-2"><?php echo esc_html($text); ?></p>
        <?php endif; ?>

        <?php if ($get_jokes_label): ?>
            <button class="give-me-jokes__button button js-get-jokes">
                <?php echo esc_html($get_jokes_label); ?>
            </button>
        <?php endif; ?>
    </div>

    <div class="give-me-jokes__content" style="display: none;">
        <div class="give-me-jokes__header">
            <?php if ($title): ?>
                <h2 class="give-me-jokes__title heading-2"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if ($text): ?>
                <p class="give-me-jokes__text body-2"><?php echo esc_html($text); ?></p>
            <?php endif; ?>

            <div class="give-me-jokes__filter">
                <label for="joke-type-filter">FILTER</label>
                <select id="joke-type-filter" class="js-joke-type-filter">
                    <option value="">Type</option>
                </select>
            </div>
        </div>

        <div class="give-me-jokes__grid js-jokes-grid"></div>

        <?php if ($load_more_label): ?>
            <button class="give-me-jokes__button button js-load-more" style="display: none;">
                <?php echo esc_html($load_more_label); ?>
            </button>
        <?php endif; ?>
    </div>
</div>