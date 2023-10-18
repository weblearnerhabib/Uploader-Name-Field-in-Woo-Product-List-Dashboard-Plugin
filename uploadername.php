<?php
/*
 * Plugin Name:       Add Uploader Name in Woo-Commerce Product List
 * Plugin URI:        https://github.com/weblearnerhabib/Uploader-Name-Field-in-Woo-Product-List-Dashboard-Plugin
 * Description:       You can add Uploader Name column to Woo-Commerce product list
 * Version:           1.1.4
 * Requires at least: 5.3
 * Requires PHP:      7.2
 * Author:            Freelancer Habib
 * Author URI:        https://freelancer.com/u/csehabiburr183/
 * Update URI:        https://github.com/weblearnerhabib/Uploader-Name-Field-in-Woo-Product-List-Dashboard-Plugin
 * Text Domain:       HR-Habib
 */


// Change the position of the "Uploader Name" column
function custom_product_list_columns($columns) {
    $new_columns = array();

    // Add existing columns and insert "Uploader Name" after "sku"
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;

        if ($key == 'sku') {
            $new_columns['uploader_name'] = 'Uploader Name';
        }
    }

    return $new_columns;
}
add_filter('manage_product_posts_columns', 'custom_product_list_columns', 15);


// Populate the custom column with uploader's name
function custom_product_list_column_content($column, $product_id) {
    if ($column == 'uploader_name') {
        $user_id = get_post_field('post_author', $product_id);
        $user_info = get_userdata($user_id);
        echo $user_info->display_name;
    }
}
add_action('manage_product_posts_custom_column', 'custom_product_list_column_content', 10, 2);


// Add CSS for adjusting column width
function custom_product_list_column_css() {
    echo '<style> #uploader_name{ width: 150px; }</style>';
}
add_action('admin_head', 'custom_product_list_column_css');


?>