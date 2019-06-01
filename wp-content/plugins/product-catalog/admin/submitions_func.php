<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if (function_exists('current_user_can'))
    if (!current_user_can('manage_options')) {
        die('Access Denied');
    }
if (!function_exists('current_user_can')) {
    die('Access Denied');
}


function show_submitions() {
    global $wpdb;
    if(isset($_POST["page_number"])){ $number = ($_POST["page_number"]-1) * 50; $offset = "OFFSET ".$number; } else {$offset = "";}
    
    if(isset($_POST["search_events_by_title"]) && $_POST["search_events_by_title"] != ""){
        $search_value = $_POST["search_events_by_title"];
        $query = "SELECT " . $wpdb->prefix . "huge_it_catalog_asc_seller.id," . $wpdb->prefix . "huge_it_catalog_asc_seller.read_or_not,"
                . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.date," . $wpdb->prefix . "huge_it_catalog_asc_seller.spam,"
                . "" . $wpdb->prefix . "huge_it_catalog_products.name AS product_name," . $wpdb->prefix . "huge_it_catalog_asc_seller.user_name,"
                . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.product_id," . $wpdb->prefix . "huge_it_catalog_asc_seller.user_phone,"
                . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.user_email," . $wpdb->prefix . "huge_it_catalog_asc_seller.user_massage FROM `"
                . "" . $wpdb->prefix . "huge_it_catalog_asc_seller`,`" . $wpdb->prefix . "huge_it_catalog_products` WHERE (("
                . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.user_name LIKE '" .$search_value . "%') OR ("
                . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.user_phone LIKE '" .$search_value . "%') OR ("
                . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.user_email LIKE '" .$search_value . "%') OR ("
                     . $wpdb->prefix . "huge_it_catalog_asc_seller.user_massage LIKE '" .$search_value . "%') OR ("
                     . $wpdb->prefix . "huge_it_catalog_asc_seller.date LIKE '" .$search_value . "%')  OR (" 
                     . $wpdb->prefix . "huge_it_catalog_products.name LIKE '" .$search_value . "%') AND "
                . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.product_id=" . $wpdb->prefix . ""
                . "huge_it_catalog_products.id) GROUP BY " . $wpdb->prefix . "huge_it_catalog_asc_seller.id ORDER BY " . $wpdb->prefix . "huge_it_catalog_asc_seller.id DESC LIMIT 50 $offset";
    }
    else{
        $query = "SELECT " . $wpdb->prefix . "huge_it_catalog_asc_seller.id," . $wpdb->prefix . "huge_it_catalog_asc_seller.read_or_not,"
                      . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.date," . $wpdb->prefix . "huge_it_catalog_asc_seller.spam,"
                      . "" . $wpdb->prefix . "huge_it_catalog_products.name AS product_name," . $wpdb->prefix . "huge_it_catalog_asc_seller.user_name,"
                      . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.product_id," . $wpdb->prefix . "huge_it_catalog_asc_seller.user_phone,"
                      . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.user_email," . $wpdb->prefix . "huge_it_catalog_asc_seller.user_massage FROM "
                      . "" . $wpdb->prefix . "huge_it_catalog_asc_seller," . $wpdb->prefix . "huge_it_catalog_products WHERE "
                      . "" . $wpdb->prefix."huge_it_catalog_asc_seller.product_id= " . $wpdb->prefix."huge_it_catalog_products.id ORDER BY " . $wpdb->prefix . "huge_it_catalog_asc_seller.id DESC LIMIT 50 $offset";
    }
    $submitionsArray = $wpdb->get_results($query);
    $submitionsCount = $wpdb->get_results("SELECT count(read_or_not) AS all_count FROM " . $wpdb->prefix . "huge_it_catalog_asc_seller");
    html_show_submitions($submitionsArray, $submitionsCount);
}
function huge_it_catalog_show_message($id) {
    global $wpdb;
    $sqlForUpdateUnredMessageToRead = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_asc_seller SET read_or_not = '%d'  WHERE id = '%d' ", 1, $id));
    $query = "SELECT " . $wpdb->prefix . "huge_it_catalog_asc_seller.user_name," . $wpdb->prefix . "huge_it_catalog_asc_seller.user_email,"
                  . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.id," . $wpdb->prefix . "huge_it_catalog_asc_seller.user_phone,"
                  . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.user_massage," . $wpdb->prefix . "huge_it_catalog_asc_seller.spam ,"
                  . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.date," . $wpdb->prefix . "huge_it_catalog_products.name AS product_name FROM "
                  . "" . $wpdb->prefix . "huge_it_catalog_asc_seller," . $wpdb->prefix . "huge_it_catalog_products WHERE "
                  . "" . $wpdb->prefix . "huge_it_catalog_asc_seller.id= ".$id." AND "
                  . "" . $wpdb->prefix . "huge_it_catalog_products.id=" . $wpdb->prefix."huge_it_catalog_asc_seller.product_id";
    $messageInArray = $wpdb->get_results($query);
    $submitionsCount = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "huge_it_catalog_asc_seller ORDER BY id ASC");
    html_huge_it_catalog_show_message($messageInArray, $submitionsCount);
}

?>
