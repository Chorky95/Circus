<?php

/**
 * We use WordPress's init hook to make sure
 * our blocks are registered early in the loading
 * process.
 *
 * @link https://developer.wordpress.org/reference/hooks/init/
 */
function circus_register_acf_blocks()
{
    /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */

    register_block_type(__DIR__ . '/../blocks/acf/hero-block');
    register_block_type(__DIR__ . '/../blocks/acf/occasions-block');
    register_block_type(__DIR__ . '/../blocks/acf/image-content-block');
    register_block_type(__DIR__ . '/../blocks/acf/gallery-content-block');
    register_block_type(__DIR__ . '/../blocks/acf/review-block');
    register_block_type(__DIR__ . '/../blocks/acf/contact-block');
    register_block_type(__DIR__ . '/../blocks/acf/working-hours-block');
    register_block_type(__DIR__ . '/../blocks/acf/home-hero-block');
    register_block_type(__DIR__ . '/../blocks/acf/weekly-offering-block');
    register_block_type(__DIR__ . '/../blocks/acf/special-offers-block');
    register_block_type(__DIR__ . '/../blocks/acf/daily-offering-block');
}
// Here we call our circus_register_acf_block() function on init.
// add_action('init', 'circus_register_acf_blocks');
