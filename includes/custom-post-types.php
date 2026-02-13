<?php

/**
 * This is file for all of your custom post types for the project
 */

/**
 * Enables the Link Manager that existed in WordPress until version 3.5.
 */
// add_filter('pre_option_link_manager_enabled', '__return_true');

function circus_register_custom_post_types()
{

    // register_post_type('movies', array(
    //     'labels' => array(
    //         'name'          => 'Moovies',
    //         'singular_name' => 'Moovie',
    //         'menu_name'     => 'Moovies',
    //         'add_new'       => 'Add New Moovie',
    //         'add_new_item'  => 'Add New Moovie',
    //         'new_item'      => 'New Moovie',
    //         'edit_item'     => 'Edit Moovie',
    //         'view_item'     => 'View Moovie',
    //         'all_items'     => 'All Moovies',
    //     ),
    //     'public' => true,
    //     'has_archive' => true,
    //     'show_in_rest' => true,
    //     'supports' => array('title', 'thumbnail'),
    // ));
}

add_action('init', 'circus_register_custom_post_types');

// Flush rewrite rules on theme activation
function circus_flush_rewrite_rules()
{
    circus_register_custom_post_types();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'circus_flush_rewrite_rules');
