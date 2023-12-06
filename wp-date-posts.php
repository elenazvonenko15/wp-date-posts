<?php
/*
Plugin Name: WP Date Posts Plugin
Description: Plugin for displaying posts with specified date range.
Version: 1.0
Author: Elena Zvonenko
*/

include( plugin_dir_path( __FILE__ ) . 'includes/shortcodes.php');

function wp_date_posts_enqueue() {
    wp_enqueue_style('wp-date-posts-styles', plugin_dir_url( __FILE__ ) . 'assets/scss/main.scss');

    wp_enqueue_script('jquery');
    wp_enqueue_script('wp-date-posts-scripts', plugin_dir_url( __FILE__ ) . 'assets/dist/main.bundle.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'wp_date_posts_enqueue');


function get_post_data() {
    $post = get_post($_POST['data']);
    $data = array(
        'excerpt'   => get_the_excerpt($post),
        'link'      => get_permalink($post),
        'img'       => get_the_post_thumbnail_url($post)
    );

    wp_send_json_success($data);
}

add_action('wp_ajax_get_post_data', 'get_post_data');
add_action('wp_ajax_nopriv_get_post_data', 'get_post_data');