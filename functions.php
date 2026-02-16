<?php

/**
 * Custom functions / External files
 */

require_once 'includes/custom-functions.php';
require_once 'includes/acf-blocks.php';
require_once 'includes/custom-post-types.php';
require_once 'includes/custom-taxonomies.php';
require_once 'includes/custom-endpoints.php';

/**
 * ACF options Page
 */
add_action('acf/init', function () {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title'    => 'Site General Settings',
            'menu_title'    => 'Site Settings',
            'menu_slug'     => 'site-general-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
});

/**
 * Add support for useful stuff
 */

if (function_exists('add_theme_support')) {

    // Add support for document title tag
    add_theme_support('title-tag');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    // add_image_size( 'custom-size', 700, 200, true );

    // Add Support for post formats
    // add_theme_support( 'post-formats', ['post'] );
    // add_post_type_support( 'page', 'excerpt' );

    // Localisation Support
    load_theme_textdomain('circus', get_template_directory() . '/languages');
}


/**
 * Hide admin bar
 */

add_filter('show_admin_bar', '__return_false');


/**
 * Remove junk
 */

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');


/**
 * Remove comments feed
 *
 * @return void
 */

function circus_post_comments_feed_link()
{
    return;
}

add_filter('post_comments_feed_link', 'circus_post_comments_feed_link');


/**
 * Enqueue scripts
 */

function circus_enqueue_scripts()
{
    // wp_enqueue_style( 'fonts', '//fonts.googleapis.com/css?family=Font+Family' );
    // wp_enqueue_style( 'icons', '//use.fontawesome.com/releases/v5.0.10/css/all.css' );
    wp_deregister_script('jquery');
    wp_enqueue_style('styles', get_stylesheet_directory_uri() . '/style.css?' . filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_style('custom-styles', get_stylesheet_directory_uri() . '/assets/css/style.css?');
    wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.min.js?' . filemtime(get_stylesheet_directory() . '/assets/js/scripts.min.js'), [], null, true);

    wp_localize_script('scripts', 'wpAjax', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('acf_dynamic_form_submit'),
    ]);
}

add_action('wp_enqueue_scripts', 'circus_enqueue_scripts');


/**
 * Add async and defer attributes to enqueued scripts
 *
 * @param string $tag
 * @param string $handle
 * @param string $src
 * @return void
 */

function defer_scripts($tag, $handle, $src)
{

    // The handles of the enqueued scripts we want to defer
    $defer_scripts = [
        'SCRIPT_ID'
    ];

    // Find scripts in array and defer
    if (in_array($handle, $defer_scripts)) {
        return '<script type="text/javascript" src="' . $src . '" defer="defer"></script>' . "\n";
    }

    return $tag;
}

add_filter('script_loader_tag', 'defer_scripts', 10, 3);


/**
 * Add custom scripts to head
 *
 * @return string
 */

function add_gtag_to_head()
{

    // Check is staging environment
    if (strpos(get_bloginfo('url'), '.test') !== false) return;

    // Google Analytics
    $tracking_code = 'UA-*********-1';

?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $tracking_code; ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', '<?php echo $tracking_code; ?>');
    </script>
<?php
}

add_action('wp_head', 'add_gtag_to_head');



/**
 * Remove unnecessary scripts
 *
 * @return void
 */

function deregister_scripts()
{
    wp_deregister_script('wp-embed');
}

add_action('wp_footer', 'deregister_scripts');


/**
 * Remove unnecessary styles
 *
 * @return void
 */

function deregister_styles()
{
    wp_dequeue_style('wp-block-library');
}

add_action('wp_print_styles', 'deregister_styles', 100);


/**
 * Register nav menus
 *
 * @return void
 */

function circus_register_nav_menus()
{
    register_nav_menus([
        'header' => 'Header',
        'footer' => 'Footer',
    ]);
}

add_action('after_setup_theme', 'circus_register_nav_menus', 0);


/**
 * Nav menu args
 *
 * @param array $args
 * @return void
 */

function circus_nav_menu_args($args)
{
    $args['container'] = false;
    $args['container_class'] = false;
    $args['menu_id'] = false;
    $args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';

    return $args;
}

add_filter('wp_nav_menu_args', 'circus_nav_menu_args');


/**
 * Button Shortcode
 *
 * @param array $atts
 * @param string $content
 * @return void
 */

function circus_button_shortcode($atts, $content = null)
{
    $atts['class'] = isset($atts['class']) ? $atts['class'] : 'btn';
    $atts['target'] = isset($atts['target']) ? $atts['target'] : '_self';
    return '<a class="' . $atts['class'] . '" href="' . $atts['link'] . '" target="' . $atts['target'] . '">' . $content . '</a>';
}

add_shortcode('button', 'circus_button_shortcode');


/**
 * TinyMCE
 *
 * @param array $buttons
 * @return void
 */

function circus_mce_buttons_2($buttons)
{
    array_unshift($buttons, 'styleselect');
    $buttons[] = 'hr';

    return $buttons;
}

add_filter('mce_buttons_2', 'circus_mce_buttons_2');


/**
 * TinyMCE styling
 *
 * @param array $settings
 * @return void
 */

function circus_tiny_mce_before_init($settings)
{
    $style_formats = [
        [
            'title' => 'Text Sizes',
            'items' => [
                [
                    'title'    => '2XL',
                    'selector' => 'span, p',
                    'classes'  => 'text-2xl'
                ],
                [
                    'title'    => 'XL',
                    'selector' => 'span, p',
                    'classes'  => 'text-xl'
                ],
                [
                    'title'    => 'LG',
                    'selector' => 'span, p',
                    'classes'  => 'text-lg'
                ],
                [
                    'title'    => 'MD',
                    'selector' => 'span, p',
                    'classes'  => 'text-md'
                ],
                [
                    'title'    => 'SM',
                    'selector' => 'span, p',
                    'classes'  => 'text-sm'
                ],
                [
                    'title'    => 'XD',
                    'selector' => 'span, p',
                    'classes'  => 'text-xs'
                ],
            ]
        ]
    ];

    $settings['style_formats'] = json_encode($style_formats);
    $settings['style_formats_merge'] = true;

    return $settings;
}

add_filter('tiny_mce_before_init', 'circus_tiny_mce_before_init');


/**
 * Get post thumbnail url
 *
 * @param string $size
 * @param boolean $post_id
 * @param boolean $icon
 * @return void
 */

function get_post_thumbnail_url($size = 'full', $post_id = false, $icon = false)
{
    if (! $post_id) {
        $post_id = get_the_ID();
    }

    $thumb_url_array = wp_get_attachment_image_src(
        get_post_thumbnail_id($post_id),
        $size,
        $icon
    );
    return $thumb_url_array[0];
}


/**
 * Add Front Page edit link to admin Pages menu
 */

function front_page_on_pages_menu()
{
    global $submenu;
    if (get_option('page_on_front')) {
        $submenu['edit.php?post_type=page'][501] = array(
            __('Front Page', 'circus'),
            'manage_options',
            get_edit_post_link(get_option('page_on_front'))
        );
    }
}

add_action('admin_menu', 'front_page_on_pages_menu');


function allow_svg_uploads($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_uploads');


// Enqueue theme scripts
function mytheme_enqueue_scripts()
{
    // Swiper CSS
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.0.0'
    );

    // Swiper JS
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.0.0',
        true
    );

    // Your custom JS (depends on Swiper)
    // wp_enqueue_script(
    //     'theme-scripts',
    //     get_template_directory_uri() . '/assets/js/scripts.js', // adjust path!
    //     array('swiper-js'),
    //     null,
    //     true
    // );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');
