<?php
/*
Plugin Name: Post Notifier
Description: Sends an email to the admin when a new post is published.
Version: 1.0
Author: Sanjana Varade
*/

defined('ABSPATH') or die('No script kiddies please!');

// Add admin menu
add_action('admin_menu', 'post_notifier_add_admin_menu');
function post_notifier_add_admin_menu() {
    add_options_page(
        'Post Notifier Settings',
        'Post Notifier',
        'manage_options',
        'post-notifier',
        'post_notifier_settings_page'
    );
}

// Include settings page
require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';

// Send email on new post publish if enabled
add_action('publish_post', 'post_notifier_send_email', 10, 2);
function post_notifier_send_email($ID, $post) {
    $enabled = get_option('post_notifier_enabled');
    if ($enabled) {
        $admin_email = get_option('admin_email');
        $subject = "New Post Published: " . $post->post_title;
        $message = "A new post has been published:\n\n";
        $message .= $post->post_title . "\n";
        $message .= get_permalink($ID);
        wp_mail($admin_email, $subject, $message);
    }
}
