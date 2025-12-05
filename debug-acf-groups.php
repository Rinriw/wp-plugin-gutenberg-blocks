<?php
// Load WordPress
require_once( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-load.php' );

echo "List of ACF Field Groups in DB:\n";
echo "--------------------------------\n";

$groups = get_posts(array(
    'post_type' => 'acf-field-group',
    'posts_per_page' => -1,
    'post_status' => array('publish', 'acf-disabled', 'trash', 'any')
));

if (empty($groups)) {
    echo "No field groups found in DB.\n";
} else {
    foreach ($groups as $group) {
        echo "ID: " . $group->ID . "\n";
        echo "Title: " . $group->post_title . "\n";
        echo "Name (Slug): " . $group->post_name . "\n";
        echo "Key: " . $group->post_excerpt . "\n"; // ACF stores the key in post_excerpt usually, or post_name
        echo "Status: " . $group->post_status . "\n";
        echo "--------------------------------\n";
    }
}
