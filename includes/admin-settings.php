<?php
// Register settings
add_action('admin_init', function () {
    register_setting('post_notifier_settings_group', 'post_notifier_enabled');
});

// Settings page content
function post_notifier_settings_page() {
    ?>
    <div class="wrap">
        <h1>Post Notifier Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('post_notifier_settings_group');
            do_settings_sections('post_notifier_settings_group');
            $enabled = get_option('post_notifier_enabled');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Enable Email Notifications</th>
                    <td>
                        <input type="checkbox" name="post_notifier_enabled" value="1" <?php checked(1, $enabled, true); ?> />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
