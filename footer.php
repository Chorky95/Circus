<footer class="footer">
    <div class="footer__container container">
        <?php
        $footer_logo = get_field('footer_title', 'option');
        $footer_text = get_field('footer_text', 'option');
        $footer_links = get_field('footer_links', 'option');
        $footer_copyright = get_field('footer_copyright_text', 'option');
        ?>

        <div class="footer__content">
            <?php if ($footer_logo): ?>
                <img class="footer__logo" src="<?php echo esc_url($footer_logo['url']); ?>" alt="<?php echo esc_attr($footer_logo['alt'] ?: 'Footer Logo'); ?>">
            <?php endif; ?>

            <?php if ($footer_text): ?>
                <p class="footer__text body-2"><?php echo esc_html($footer_text); ?></p>
            <?php endif; ?>
        </div>

        <div class="footer__bottom">
            <?php if ($footer_links): ?>
                <nav class="footer__links">
                    <?php foreach ($footer_links as $link_item):
                        $link = $link_item['footer_link'];
                        if ($link): ?>
                            <a class="footer__link" href="<?php echo esc_url($link['url']); ?>" <?php echo $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
                                <?php echo esc_html($link['title']); ?>
                            </a>
                    <?php endif;
                    endforeach; ?>
                </nav>
            <?php endif; ?>

            <?php if ($footer_copyright): ?>
                <p class="footer__copyright"><?php echo esc_html($footer_copyright); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <?php wp_footer(); ?>
    </body>

    </html>