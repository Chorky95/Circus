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
    register_block_type(__DIR__ . '/../blocks/acf/image-content-block');
    register_block_type(__DIR__ . '/../blocks/acf/give-me-jokes');
}
// Here we call our circus_register_acf_block() function on init.
add_action('init', 'circus_register_acf_blocks');

/**
 * Register React blocks with proper script dependencies
 */
function circus_register_react_blocks()
{
    // Define all React blocks to register
    $react_blocks = array(
        'image-content-block-react',
        'hero-block-react',
        'give-me-jokes-react',
    );

    // Register the shared stylesheet once
    $block_style = 'circus-react-blocks-style';
    $style_path = get_template_directory_uri() . '/assets/css/style.css';
    $style_file = get_template_directory() . '/assets/css/style.css';

    if (file_exists($style_file)) {
        wp_register_style(
            $block_style,
            $style_path,
            array(),
            filemtime($style_file)
        );
    }

    // Loop through each block and register it
    foreach ($react_blocks as $block_name) {
        $react_block_script = 'circus-' . $block_name;
        $react_block_path = get_template_directory_uri() . '/blocks/react/' . $block_name . '/build/index.js';
        $react_block_file = get_template_directory() . '/blocks/react/' . $block_name . '/build/index.js';

        // Only register if the build file exists
        if (file_exists($react_block_file)) {
            wp_register_script(
                $react_block_script,
                $react_block_path,
                array('wp-blocks', 'wp-i18n', 'wp-block-editor', 'wp-components', 'wp-element'),
                filemtime($react_block_file)
            );

            register_block_type(__DIR__ . '/../blocks/react/' . $block_name, array(
                'editor_script' => $react_block_script,
                'style' => $block_style,
                'editor_style' => $block_style,
            ));
        }
    }
}
add_action('init', 'circus_register_react_blocks');
