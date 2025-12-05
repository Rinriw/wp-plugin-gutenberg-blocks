<?php
// Load WordPress
require_once( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-load.php' );

if ( ! current_user_can( 'manage_options' ) ) {
    // Attempt to run anyway if CLI or just script, but usually requires auth. 
    // Since we run via php command line on local, we might bypass auth checks or need to simulate.
    // Actually, wp-load.php loads the environment. We can just run code.
}

echo "Searching for ACF Field Groups...\n";

$groups = get_posts(array(
    'post_type' => 'acf-field-group',
    'posts_per_page' => -1,
    'post_status' => 'any' // ACF groups might be 'publish' or 'acf-disabled'
));

$found = false;

foreach ($groups as $group) {
    echo "Found Group: ID: " . $group->ID . " | Title: " . $group->post_title . " | Name (Key): " . $group->post_name . "\n";
    
    // Check if this is the one we want to delete (the one blocking our PHP)
    // The PHP key is 'group_ficha_animacion'. If there is a post with this name/slug, it overrides PHP.
    if ($group->post_name === 'group_ficha_animacion' || $group->post_excerpt === 'group_ficha_animacion') {
        echo "MATCH FOUND! Deleting group ID " . $group->ID . "...\n";
        $deleted = wp_delete_post($group->ID, true); // Force delete
        if ($deleted) {
            echo "Successfully deleted old field group.\n";
            $found = true;
        } else {
            echo "Failed to delete.\n";
        }
    }
}

if (!$found) {
    echo "No conflicting database field group found for 'group_ficha_animacion'.\n";
} else {
    echo "Cleanup complete. PHP definition should now take precedence.\n";
}
