<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if (function_exists('current_user_can'))
    if (!current_user_can('manage_options')) {
        die('Access Denied');
    }
if (!function_exists('current_user_can')) {
    die('Access Denied');
}


function show_reviews() {
    global $wpdb;
    $query = "SELECT " . $wpdb->prefix . "huge_it_catalog_reviews.id," . $wpdb->prefix . "huge_it_catalog_products.name AS product_name," . $wpdb->prefix . "huge_it_catalog_reviews.content," . $wpdb->prefix . "huge_it_catalog_reviews.product_id," . $wpdb->prefix . "huge_it_catalog_reviews.spam," . $wpdb->prefix . "huge_it_catalog_reviews.name AS author_name," . $wpdb->prefix . "huge_it_catalog_reviews.date FROM " . $wpdb->prefix . "huge_it_catalog_reviews," . $wpdb->prefix . "huge_it_catalog_products WHERE " . $wpdb->prefix . "huge_it_catalog_reviews.product_id= " . $wpdb->prefix . "huge_it_catalog_products.id";
    $reviewsArray = $wpdb->get_results($query);
    html_show_reviews($reviewsArray);
}



?>
