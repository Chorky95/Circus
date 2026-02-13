<?php

/**
 * This is file for all of your custom taxonomies for the project
 */

/**
 * Enables the Link Manager that existed in WordPress until version 3.5.
 */
// add_filter('pre_option_link_manager_enabled', '__return_true');

function circus_register_custom_taxonomies()
{
    // register_taxonomy('genres', array('movies'), array(
    //     'labels'       => array(
    //         'name'          => 'Genres',
    //         'singular_name' => 'Genre',
    //         'edit_item'     => 'Edit Genre',
    //         'update_item'   => 'Update Genre',
    //         'add_new_item'  => 'Add New Genre',
    //         'new_item_name' => 'New Genre Name',
    //         'menu_name'     => 'Genres',
    //     ),
    //     'hierarchical' => true,
    //     'rewrite'      => array('slug' => 'genre'),
    //     'show_in_rest'           => true,
    // ));
}

add_action('init', 'circus_register_custom_taxonomies');
