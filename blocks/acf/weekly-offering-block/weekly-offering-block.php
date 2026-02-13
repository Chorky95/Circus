<?php

/**
 * Weekly Offering Block Template
 *
 * @param array $block The block settings and attributes.
 */

// Get block fields
$title_icon = get_field('weekly_offering_title_icon');
$title = get_field('weekly_offering_title');
$subtitle = get_field('weekly_offering_subtitle');
$cta_boxes = get_field('weekly_offering_cta_boxes');

// Get weekly offerings from options page
$weekly_offerings = get_field('weekly_offerings', 'option');

// Support custom ID
$block_id = 'weekly-offering-block-' . ($block['id'] ?? uniqid());

if (is_admin()) {
    echo '<p style="padding: 20px; background: #f0f0f0; border: 1px solid #ddd;">Weekly Offering Block Preview</p>';
    return;
}
?>

<div id="<?php echo esc_attr($block_id); ?>" class="weekly-offering-block">
    <div class="weekly-offering-block__container">
        <!-- Title Section -->
        <div class="weekly-offering-block__header">
            <?php if ($title_icon) : ?>
                <div class="weekly-offering-block__title-icon">
                    <img src="<?php echo esc_url($title_icon['url']); ?>" alt="<?php echo esc_attr($title_icon['alt'] ?? ''); ?>">
                </div>
            <?php endif; ?>

            <?php if ($title) : ?>
                <h2 class="weekly-offering-block__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
        </div>

        <?php if ($subtitle) : ?>
            <p class="weekly-offering-block__subtitle"><?php echo esc_html($subtitle); ?></p>
        <?php endif; ?>

        <?php if ($weekly_offerings) : ?>
            <!-- Mobile Tabs -->
            <div class="weekly-offering-block__tabs">
                <?php foreach ($weekly_offerings as $index => $offering) : ?>
                    <button
                        class="weekly-offering-block__tab <?php echo $index === 0 ? 'weekly-offering-block__tab--active' : ''; ?>"
                        data-day-index="<?php echo esc_attr($index); ?>">
                        <?php echo esc_html($offering['day']); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Daily Offerings Grid -->
            <div class="weekly-offering-block__grid">
                <?php foreach ($weekly_offerings as $index => $offering) :
                    $day = $offering['day'];
                    $foods = $offering['foods'];
                ?>
                    <div class="weekly-offering-block__day-box <?php echo $index === 0 ? 'weekly-offering-block__day-box--active' : ''; ?>" data-day-index="<?php echo esc_attr($index); ?>">
                        <?php
                        get_template_part('components/offering-card', null, array(
                            'day' => $day,
                            'foods' => $foods,
                            'class' => ''
                        ));
                        ?>
                    </div>
                <?php endforeach; ?>

                <!-- CTA Boxes -->
                <?php if ($cta_boxes) : ?>
                    <?php foreach ($cta_boxes as $cta) : ?>
                        <div class="weekly-offering-block__cta-wrapper">
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
        <?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const blockId = '<?php echo esc_js($block_id); ?>';
        const block = document.getElementById(blockId);

        if (!block) return;

        const tabs = block.querySelectorAll('.weekly-offering-block__tab');
        const dayBoxes = block.querySelectorAll('.weekly-offering-block__day-box');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const dayIndex = this.getAttribute('data-day-index');

                // Update active tab
                tabs.forEach(t => t.classList.remove('weekly-offering-block__tab--active'));
                this.classList.add('weekly-offering-block__tab--active');

                // Update active day box
                dayBoxes.forEach(box => {
                    if (box.getAttribute('data-day-index') === dayIndex) {
                        box.classList.add('weekly-offering-block__day-box--active');
                    } else {
                        box.classList.remove('weekly-offering-block__day-box--active');
                    }
                });
            });
        });
    });
</script>