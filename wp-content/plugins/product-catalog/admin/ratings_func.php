<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if (function_exists('current_user_can'))
    if (!current_user_can('manage_options')) {
        die('Access Denied');
    }
if (!function_exists('current_user_can')) {
    die('Access Denied');
}


function show_ratings() {
    global $wpdb;
    $query = "SELECT " . $wpdb->prefix . "huge_it_catalog_rating.id," . $wpdb->prefix . "huge_it_catalog_rating.value," . $wpdb->prefix . "huge_it_catalog_rating.prod_id," . $wpdb->prefix . "huge_it_catalog_rating.ip," . $wpdb->prefix . "huge_it_catalog_rating.date," . $wpdb->prefix . "huge_it_catalog_products.name FROM " . $wpdb->prefix . "huge_it_catalog_rating," . $wpdb->prefix . "huge_it_catalog_products WHERE " . $wpdb->prefix . "huge_it_catalog_rating.prod_id= " . $wpdb->prefix . "huge_it_catalog_products.id";
    $ratingsArray = $wpdb->get_results($query);
    html_show_ratings($ratingsArray);
}



?>
