<?php

/**
 * Give Me Jokes (React) Render Template
 *
 * @param array $attributes The block attributes.
 * @param string $content The block content.
 * @param WP_Block $block The block instance.
 */

// Get block attributes
$title = isset($attributes['title']) ? $attributes['title'] : '';
$text = isset($attributes['text']) ? $attributes['text'] : '';
$get_jokes_label = isset($attributes['getJokesButtonLabel']) ? $attributes['getJokesButtonLabel'] : 'Get Jokes';
$load_more_label = isset($attributes['loadMoreButtonLabel']) ? $attributes['loadMoreButtonLabel'] : 'Load More';

// Create block ID and class attributes
$block_id = 'give-me-jokes-' . uniqid();
$class_name = 'give-me-jokes';
if (!empty($attributes['className'])) {
    $class_name .= ' ' . $attributes['className'];
}
if (!empty($attributes['align'])) {
    $class_name .= ' align' . $attributes['align'];
}
?>

<div id="<?php echo esc_attr($block_id); ?>" class="<?php echo esc_attr($class_name); ?>">
    <div class="give-me-jokes__initial">
        <?php if ($title): ?>
            <h2 class="give-me-jokes__title heading-2"><?php echo wp_kses_post($title); ?></h2>
        <?php endif; ?>

        <?php if ($text): ?>
            <p class="give-me-jokes__text body-2"><?php echo wp_kses_post($text); ?></p>
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
                <h2 class="give-me-jokes__title heading-2"><?php echo wp_kses_post($title); ?></h2>
            <?php endif; ?>

            <?php if ($text): ?>
                <p class="give-me-jokes__text body-2"><?php echo wp_kses_post($text); ?></p>
            <?php endif; ?>

            <div class="give-me-jokes__filter">
                <label for="joke-type-filter" class="caption">FILTER</label>
                <select id="joke-type-filter" class="js-joke-type-filter body-2">
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