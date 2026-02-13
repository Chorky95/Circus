<?php

/**
 * Home Hero Block template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param (int|string) $post_id The post ID this block is saved to.
 */

// Path to your screenshot (put screenshot.png inside the block folder)
$screenshot = get_template_directory_uri() . '/blocks/home-hero-block/screenshot.png';

// Show screenshot in inserter or editor preview
if (! empty($block['data']['is_example']) || ! empty($is_preview)) {
    echo '<img src="' . esc_url($screenshot) . '" alt="Block preview" style="max-width:100%;height:auto;" />';
    return;
}

// Get ACF fields
$background = get_field('home_hero_background');
$logo = get_field('home_hero_logo');
$title = get_field('home_hero_title');
$subtitle = get_field('home_hero_subtitle');
$buttons = get_field('home_hero_buttons');
$boxes = get_field('home_hero_boxes');
$notes = get_field('home_hero_notes');
?>

<section class="home-hero" <?php if ($background) : ?>style="background-image: url('<?php echo esc_url($background['url']); ?>');" <?php endif; ?>>
    <div class="home-hero__overlay"></div>
    <div class="home-hero__container">
        <div class="home-hero__content">
            <?php if ($logo) : ?>
                <div class="home-hero__logo">
                    <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: 'Logo'); ?>">
                </div>
            <?php endif; ?>

            <?php if ($title) : ?>
                <h1 class="home-hero__title"><?php echo esc_html($title); ?></h1>
            <?php endif; ?>

            <?php if ($subtitle) : ?>
                <p class="home-hero__subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>

            <?php if ($buttons) : ?>
                <div class="home-hero__buttons">
                    <?php foreach ($buttons as $button) :
                        $button_type = $button['home_hero_button_type'] ?? 'link';
                        $button_color = $button['home_hero_button_color'] ?? 'orange';
                        $button_class = 'button';

                        if ($button_color === 'white') {
                            $button_class .= ' button--white-bordered';
                        } elseif ($button_color === 'transparent') {
                            $button_class .= ' button--transparent';
                        }

                        if ($button_type === 'link' && !empty($button['home_hero_button_link'])) :
                            $link = $button['home_hero_button_link'];
                    ?>
                            <a href="<?php echo esc_url($link['url']); ?>"
                                class="<?php echo esc_attr($button_class); ?>"
                                <?php echo $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
                                <?php echo esc_html($link['title']); ?>
                            </a>
                        <?php elseif ($button_type === 'order') : ?>
                            <?php get_template_part('components/order-button', null, ['class' => $button_class]); ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($boxes) : ?>
            <div class="home-hero__boxes">
                <?php foreach ($boxes as $box) : ?>
                    <div class="home-hero__box">
                        <div class="home-hero__box__header">
                            <?php if (!empty($box['home_hero_box_icon'])) :
                                $icon = $box['home_hero_box_icon'];
                            ?>
                                <div class="home-hero__box-icon">
                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?: 'Icon'); ?>">
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($box['home_hero_box_title'])) : ?>
                                <p class="home-hero__box-title"><?php echo esc_html($box['home_hero_box_title']); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($box['home_hero_box_items'])) : ?>
                            <ul class="home-hero__box-list">
                                <?php foreach ($box['home_hero_box_items'] as $item) : ?>
                                    <?php if (!empty($item['home_hero_box_item'])) : ?>
                                        <li class="home-hero__box-item">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.3337 4L6.00033 11.3333L2.66699 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <span><?php echo esc_html($item['home_hero_box_item']); ?></span>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</section>

<?php if ($notes) : ?>
    <section class="home-hero-notes">
        <?php foreach ($notes as $note) : ?>
            <div class="home-hero-notes__note">
                <?php if (!empty($note['home_hero_note_icon'])) :
                    $note_icon = $note['home_hero_note_icon'];
                ?>
                    <div class="home-hero-notes__note-icon">
                        <img src="<?php echo esc_url($note_icon['url']); ?>" alt="<?php echo esc_attr($note_icon['alt'] ?: 'Icon'); ?>">
                    </div>
                <?php endif; ?>

                <?php if (!empty($note['home_hero_note_text'])) : ?>
                    <p class="home-hero-notes__note-text"><?php echo esc_html($note['home_hero_note_text']); ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </section>
<?php endif; ?>