<?php

/**
 * This is file for all of your custom endpoints for the project
 */

// Fetch jokes endpoint
add_action('rest_api_init', function () {
    register_rest_route('circus/v1', '/fetch-jokes', [
        'methods' => 'GET',
        'callback' => 'fetch_jokes_endpoint',
        'permission_callback' => '__return_true',
    ]);
});

function fetch_jokes_endpoint()
{
    $response = wp_remote_get('https://official-joke-api.appspot.com/random_ten');

    if (is_wp_error($response)) {
        return new WP_Error('fetch_failed', 'Failed to fetch jokes from API', ['status' => 500]);
    }

    $body = wp_remote_retrieve_body($response);
    $jokes = json_decode($body, true);

    if (!$jokes || !is_array($jokes)) {
        return new WP_Error('invalid_response', 'Invalid response from jokes API', ['status' => 500]);
    }

    return rest_ensure_response($jokes);
}

// ostavljeno kao primjer WP REST API endpointa, ali ćemo koristiti AJAX endpoint za ovo jer tako piše u zadatku

// WP AJAX handler for fetching jokes
add_action('wp_ajax_fetch_jokes', 'fetch_jokes_ajax_handler');
add_action('wp_ajax_nopriv_fetch_jokes', 'fetch_jokes_ajax_handler');

function fetch_jokes_ajax_handler()
{
    $response = wp_remote_get('https://official-joke-api.appspot.com/random_ten');

    if (is_wp_error($response)) {
        wp_send_json_error(['message' => 'Failed to fetch jokes from API']);
        return;
    }

    $body = wp_remote_retrieve_body($response);
    $jokes = json_decode($body, true);

    if (!$jokes || !is_array($jokes)) {
        wp_send_json_error(['message' => 'Invalid response from jokes API']);
        return;
    }

    wp_send_json_success($jokes);
}
