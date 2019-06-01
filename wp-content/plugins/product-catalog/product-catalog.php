<?php

/*
Plugin Name: Huge IT Product Catalog
Plugin URI: https://huge-it.com/product-catalog
Description: Let us introduce our Huge-IT Product Catalog incomparable plugin. To begin with, why do we need this plugin and what are the advantages.
Version: 1.5.6
Author: Huge-IT
Author URI: http://huge-it.com
License: GNU/GPLv3 https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: product-catalog
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

add_action('media_buttons_context', 'add_my_custom_button_for_catalog');

function add_my_custom_button_for_catalog($context) {

    $img = plugins_url( '/images/huge_it_catalog_logo_shortcode.png' , __FILE__ );
    $container_id = 'huge_it_catalog';

    $title = 'Select Catalog IT Slider To insert Into Post';

    $context .= '<a class="button thickbox" title="Select Catalog To Insert Into Post"    href="?page=catalogs_huge_it_catalog&task=catalog_add_shortcode_popup&TB_iframe=1&width=400&inlineId='.$container_id.'">
		<span class="wp-media-buttons-icon" style="background: url('.$img.'); background-repeat: no-repeat; background-position: left bottom;"></span>'.
        __('Add Catalog','product-catalog').
        '</a>';

    return $context;
}

//////////////////////////// Meta tags for share buttons/////////////////////////////////

add_action("wp_head","meta_tags_for_share_butons");
function meta_tags_for_share_butons(){
    global $wpdb;
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
    $actual_link = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."";

    if(strpos( $actual_link,"single_prod_id" ) != FALSE){
        $singl_id = explode("=",$actual_link);
        $singl_id = end($singl_id);
        $table_name = $wpdb->prefix."huge_it_catalog_products";
        $sql_share = $wpdb->prepare("SELECT * FROM ".$table_name." WHERE id=%s",$singl_id);
        $images_share = $wpdb->get_row($sql_share);

        if (strpos(get_permalink(),'/?') !== false) {
            $product_page_link = get_permalink()."&single_prod_id=$images_share->id";
        } else {
            if (strpos(get_permalink(),'/') !== false) {
                $product_page_link = get_permalink()."?single_prod_id=$images_share->id";
            } else {
                $product_page_link = get_permalink()."/?single_prod_id=$images_share->id";
            }
        }

        $title_share = $images_share->name;
        $description_share = htmlspecialchars($images_share->description);
        if(strpos( $description_share,'<img')){
            $img_pos = strpos( $description_share,'<img');
            $description_share = substr($description_share,0,$img_pos);
        }

        $image_share = $images_share->image_url;
        $image_share = explode(";",$image_share);
        $image_share = array_shift($image_share);
        $site_name = get_bloginfo("title");



        echo   '<meta property="og:site_name" content="'.$site_name.'" />
                <meta property="og:title" content="'.$title_share.'" />
                <meta property="og:image" content="'.$image_share.'" />
                <meta property="og:url" content="'.$product_page_link.'" />    
                <meta property="og:description" content="'.$description_share.'" />';
    }
}

///////////////////////////////////shortcode update/////////////////////////////////////////////

add_action('init', 'hugesl_catalog_do_output_buffer');
function hugesl_catalog_do_output_buffer() {
    ob_start();
}
add_action('init', 'product_catalog_lang_load');

function product_catalog_lang_load()
{
    load_plugin_textdomain('product-catalog', false, basename(dirname(__FILE__)) . '/languages');
}

function huge_it_catalog_products_list_shotrcode($atts)
{
    wp_register_script( 'catalog-all-js', plugins_url('/js/catalog-all.js', __FILE__), array('jquery'),'1.0.0',true  );
    wp_enqueue_script( 'catalog-all-js' );

    wp_register_style( 'catalog-all-css', plugins_url('/style/catalog-all.css', __FILE__) );
    wp_enqueue_style( 'catalog-all-css' );

    wp_register_script( 'jquery.ccolorbox-js', plugins_url('/js/jquery.colorbox.js', __FILE__), array('jquery'),'1.0.0',true  );
    wp_enqueue_script( 'jquery.ccolorbox-js' );

    wp_register_script( 'hugeitmicro-min-js', plugins_url('/js/jquery.hugeitmicro.min.js', __FILE__), array('jquery'),'1.0.0',true  );
    wp_enqueue_script( 'hugeitmicro-min-js' );

    wp_register_script( 'elevateZoom-3.0.8', plugins_url('/js/jquery.elevateZoom-3.0.8.min.js', __FILE__), array('jquery'),'1.0.0',true  );
    wp_enqueue_script( 'elevateZoom-3.0.8' );

    wp_register_script( 'elevateZoomParams', plugins_url('/js/elevateZoomParams.js', __FILE__), array('jquery'),'1.0.0',true  );
    wp_enqueue_script( 'elevateZoomParams' );

    wp_register_script( 'elevateZoomParams2', plugins_url('/js/jquery.elevateZoom-ContentSlider-3.0.8.min.js', __FILE__), array('jquery'),'1.0.0',true  );
    wp_enqueue_script( 'elevateZoomParams2' );

    wp_register_script('catalog-carousel', (plugins_url('/js/jquery.cycle2.js', __FILE__)), false);
    wp_enqueue_script('catalog-carousel');

    wp_register_script('catalog-carousel-2', (plugins_url('/js/jquery.cycle2.carousel.js', __FILE__)), false);
    wp_enqueue_script('catalog-carousel-2');

    wp_register_style( 'catalog-carousel-style',plugins_url('/style/catalog-carousel-style.css', __FILE__) );
    wp_enqueue_style( 'catalog-carousel-style' );

    wp_register_style( 'style2-os-css', plugins_url('/style/style2-os.css', __FILE__) );
    wp_enqueue_style( 'style2-os-css' );

    wp_register_style( 'lightbox-css', plugins_url('/style/lightbox.css', __FILE__) );
    wp_enqueue_style( 'lightbox-css' );

    wp_register_style( 'fontawesome-css', plugins_url('/style/css/hugeiticons.css', __FILE__) );
    wp_enqueue_style( 'fontawesome-css' );

    wp_localize_script('catalog-all-js', 'catalog_disable_right_click', get_option('product_catalog_disable_right_click'));

    extract(shortcode_atts(array(
        'id' => 'no huge_it catalog',

    ), $atts));

    return huge_it_catalog_products_list($atts['id']);

}
add_shortcode('huge_it_catalog', 'huge_it_catalog_products_list_shotrcode');

function   huge_it_catalog_products_list($id)
{
    require_once("Front_end/catalog_front_end_view.php");
    require_once("Front_end/catalog_front_end_func.php");
    if (isset($_GET['product_id'])) {
        if (isset($_GET['view'])) {
            if ($_GET['view'] == 'huge_it_catalog') {
                return showPublishedcatalogs_1($id);
            } else {
                return front_end_single_product($_GET['product_id']);
            }
        } else {
            return front_end_single_product($_GET['product_id']);
        }
    } else {
        return showPublishedcatalogs_1($id);
    }
}

function huge_it_catalog_album_shotrcode($atts)
{
    extract(shortcode_atts(array(
        'id' => 'no huge_it catalog',

    ), $atts));

    return huge_it_catalog_album($atts['id']);

}
add_shortcode('huge_it_catalog_album', 'huge_it_catalog_album_shotrcode');

function   huge_it_catalog_album($id)
{
    require_once("Front_end/catalog_front_end_view.php");
    require_once("Front_end/catalog_front_end_func.php");
    return show_catalogs_from_album($id);
}

function huge_it_catalog_single_product_shotrcode($atts)
{
    wp_register_script( 'catalog-all-js', plugins_url('/js/catalog-all.js', __FILE__), array('jquery'),'1.0.0',true  );
    wp_enqueue_script( 'catalog-all-js' );

    wp_register_style( 'catalog-all-css', plugins_url('/style/catalog-all.css', __FILE__) );
    wp_enqueue_style( 'catalog-all-css' );

    wp_register_script( 'jquery.ccolorbox-js', plugins_url('/js/jquery.colorbox.js', __FILE__), array('jquery'),'1.0.0',true  );
    wp_enqueue_script( 'jquery.ccolorbox-js' );

    wp_register_script( 'hugeitmicro-min-js', plugins_url('/js/jquery.hugeitmicro.min.js', __FILE__), array('jquery'),'1.0.0',true  );
    wp_enqueue_script( 'hugeitmicro-min-js' );

    wp_register_script( 'elevateZoom-3.0.8', plugins_url('/js/jquery.elevateZoom-3.0.8.min.js', __FILE__), array('jquery'),'1.0.0',true  );
    wp_enqueue_script( 'elevateZoom-3.0.8' );

    wp_register_script( 'elevateZoomParams', plugins_url('/js/elevateZoomParams.js', __FILE__), array('jquery'),'1.0.0',true  );
    wp_enqueue_script( 'elevateZoomParams' );

    wp_register_script( 'elevateZoomParams2', plugins_url('/js/jquery.elevateZoom-ContentSlider-3.0.8.min.js', __FILE__), array('jquery'),'1.0.0',true  );
    wp_enqueue_script( 'elevateZoomParams2' );

    wp_register_script('catalog-carousel', (plugins_url('/js/jquery.cycle2.js', __FILE__)), false);
    wp_enqueue_script('catalog-carousel');

    wp_register_script('catalog-carousel-2', (plugins_url('/js/jquery.cycle2.carousel.js', __FILE__)), false);
    wp_enqueue_script('catalog-carousel-2');

    wp_register_style( 'catalog-carousel-style',plugins_url('/style/catalog-carousel-style.css', __FILE__) );
    wp_enqueue_style( 'catalog-carousel-style' );

    wp_register_style( 'style2-os-css', plugins_url('/style/style2-os.css', __FILE__) );
    wp_enqueue_style( 'style2-os-css' );

    wp_register_style( 'lightbox-css', plugins_url('/style/lightbox.css', __FILE__) );
    wp_enqueue_style( 'lightbox-css' );

    wp_register_style( 'fontawesome-css', plugins_url('/style/css/hugeiticons.css', __FILE__) );
    wp_enqueue_style( 'fontawesome-css' );

    wp_localize_script('catalog-all-js', 'catalog_disable_right_click', get_option('product_catalog_disable_right_click'));

    extract(shortcode_atts(array(
        'id' => 'no huge_it catalog',

    ), $atts));

    return huge_it_catalog_single_product($atts['id']);

}
add_shortcode('huge_it_catalog_single_product', 'huge_it_catalog_single_product_shotrcode');

function   huge_it_catalog_single_product($id)
{
    require_once("Front_end/catalog_front_end_view.php");
    require_once("Front_end/catalog_front_end_func.php");
    return show_catalogs_single_product($id);
}

/////////////// Filter Catalog

function product_catalog_after_search_results($query)
{
    global $wpdb;
    if (isset($_REQUEST['s']) && $_REQUEST['s']) {
        $serch_word = htmlspecialchars(($_REQUEST['s']));
        $query = str_replace($wpdb->prefix . "posts.post_content", gen_string_product_catalog_search($serch_word, $wpdb->prefix . 'posts.post_content') . " " . $wpdb->prefix . "posts.post_content", $query);
    }
    return $query;

}

add_filter('posts_request', 'product_catalog_after_search_results');


function gen_string_product_catalog_search($serch_word, $wordpress_query_post)
{
    $string_search = '';

    global $wpdb;
    if ($serch_word) {
        $rows_catalog = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "huge_it_catalogs WHERE (description LIKE %s) OR (name LIKE %s)", '%' . $serch_word . '%', "%" . $serch_word . "%"));

        $count_cat_rows = count($rows_catalog);

        for ($i = 0; $i < $count_cat_rows; $i++) {
            $string_search .= $wordpress_query_post . ' LIKE \'%[huge_it_catalog id="' . $rows_catalog[$i]->id . '" details="1" %\' OR ' . $wordpress_query_post . ' LIKE \'%[huge_it_catalog id="' . $rows_catalog[$i]->id . '" details="1"%\' OR ';
        }

        $rows_catalog = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "huge_it_catalogs WHERE (name LIKE %s)","'%" . $serch_word . "%'"));
        $count_cat_rows = count($rows_catalog);
        for ($i = 0; $i < $count_cat_rows; $i++) {
            $string_search .= $wordpress_query_post . ' LIKE \'%[huge_it_catalog id="' . $rows_catalog[$i]->id . '" details="0"%\' OR ' . $wordpress_query_post . ' LIKE \'%[huge_it_catalog id="' . $rows_catalog[$i]->id . '" details="0"%\' OR ';
        }

        $rows_single = $wpdb->get_results($wpdb->prepare("SELECT * FROM " . $wpdb->prefix . "huge_it_catalog_products WHERE name LIKE %s","'%" . $serch_word . "%'"));

        $count_sing_rows = count($rows_single);
        if ($count_sing_rows) {
            for ($i = 0; $i < $count_sing_rows; $i++) {
                $string_search .= $wordpress_query_post . ' LIKE \'%[huge_it_catalog_Product id="' . $rows_single[$i]->id . '"]%\' OR ';
            }

        }
    }
    return $string_search;
}

///////////////////// end filter

add_filter('admin_head', 'huge_it_catalog_ShowTinyMCE');
function huge_it_catalog_ShowTinyMCE()
{
    // conditions here
    wp_enqueue_script('common');
    wp_enqueue_script('jquery-color');
    wp_print_scripts('editor');
    if (function_exists('add_thickbox')) add_thickbox();
    wp_print_scripts('media-upload');
    if (version_compare(get_bloginfo('version'), 3.3) < 0) {
        if (function_exists('wp_tiny_mce')) wp_tiny_mce();
    }
    wp_admin_css();
    wp_enqueue_script('utils');
    do_action("admin_print_styles-post-php");
    do_action('admin_print_styles');
}

function catalog_frontend_scripts_and_styles() {
    if ( wp_script_is( 'jquery', 'registered' ) )
        wp_enqueue_script('jquery');
    else {
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', __FILE__ );
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'catalog_frontend_scripts_and_styles');

add_action('admin_menu', 'huge_it_catalog_options_panel');
function huge_it_catalog_options_panel()
{
    $page_cat = add_menu_page('Theme page title', 'Huge IT Catalog', 'delete_pages', 'catalogs_huge_it_catalog', 'catalogs_huge_it_catalog', plugins_url('images/huge_it_catalogLogoHover -for_menu.png', __FILE__));
    $catalogs = add_submenu_page('catalogs_huge_it_catalog', 'Catalogs', 'Catalogs', 'delete_pages', 'catalogs_huge_it_catalog', 'catalogs_huge_it_catalog');
    $general_options = add_submenu_page('catalogs_huge_it_catalog', 'General Options', 'General Options', 'manage_options', 'huge_it_catalog_general_options_page', 'huge_it_catalog_general_options_page');
    $Submitions = add_submenu_page('catalogs_huge_it_catalog', 'Submissions', 'Submissions', 'manage_options', 'huge_it_catalog_submitions_page', 'huge_it_catalog_submitions_page');
    $Reviews = add_submenu_page('catalogs_huge_it_catalog', 'Comments Manager', 'Comments Manager', 'manage_options', 'huge_it_catalog_reviews_page', 'huge_it_catalog_reviews_page');
    $Ratings = add_submenu_page('catalogs_huge_it_catalog', 'Ratings Manager', 'Ratings Manager', 'manage_options', 'huge_it_catalog_ratings_page', 'huge_it_catalog_ratings_page');
    $page_option = add_submenu_page('catalogs_huge_it_catalog', 'Catalog Options', 'Catalog Options', 'manage_options', 'Options_product_Catalog_styles', 'Options_product_Catalog_styles');
    $products_options = add_submenu_page('catalogs_huge_it_catalog', 'Products Options', 'Products Options', 'manage_options', 'huge_it_catalog_products_page', 'huge_it_catalog_products_page');

    if ( is_plugin_active( 'product-catalog-releated-products/product-catalog-releated-products.php' ) ) {
        $related_products = add_submenu_page('catalogs_huge_it_catalog', 'Related Products', 'Related Products', 'manage_options', 'huge_it_catalog_related_products', 'huge_it_catalog_related_products');
        add_action('admin_print_styles-' . $related_products, 'huge_it_catalog_option_admin_script');
    }
    if ( is_plugin_active( 'product-catalog-csv/product-catalog-csv.php' ) ) {
        $catalog_csv = add_submenu_page('catalogs_huge_it_catalog', 'Export CSV', 'Export CSV', 'manage_options', 'huge_it_catalog_export_csv', 'huge_it_catalog_export_csv');
        add_action('admin_print_styles-' . $catalog_csv, 'huge_it_catalog_option_admin_script');
    }

    $lightbox_options = add_submenu_page('catalogs_huge_it_catalog', 'Image View Options', 'Image View Options', 'manage_options', 'Options_catalog_lightbox_styles', 'Options_catalog_lightbox_styles');
    $featured = add_submenu_page('catalogs_huge_it_catalog', 'Featured Plugins', 'Featured Plugins', 'manage_options', 'huge_it__catalog_featured_plugins', 'huge_it__catalog_featured_plugins');
    $licensing = add_submenu_page( 'catalogs_huge_it_catalog', 'Licensing', 'Licensing', 'manage_options', 'huge_it_catalog_Licensing', 'huge_it_catalog_Licensing');

    add_action('admin_print_styles-' . $page_cat, 'huge_it_catalog_admin_script');
    add_action('admin_print_styles-' . $page_option, 'huge_it_catalog_option_admin_script');
    add_action('admin_print_styles-' . $Submitions, 'huge_it_catalog_admin_script');
    add_action('admin_print_styles-' . $lightbox_options, 'huge_it_catalog_option_admin_script');
    add_action('admin_print_styles-' . $featured, 'huge_it_catalog_featured_styles');
    add_action('admin_print_styles-' . $licensing, 'huge_it_catalog_licensing_styles');
}

function huge_it__catalog_featured_plugins()
{
    include_once("admin/huge_it_featured_plugins.php");
}

function huge_it_catalog_featured_styles() {
    wp_register_style( 'huge_it_catalog_featured', plugins_url( 'style/featured.css', __FILE__  ) );
    wp_enqueue_style( 'huge_it_catalog_featured' );
}

function huge_it_catalog_Licensing(){

    require_once("admin/licensing.php");?>

    <?php

}

function huge_it_catalog_licensing_styles() {
    wp_register_style( 'huge_it_catalog_licensing', plugins_url( 'style/licensing.css', __FILE__  ) );
    wp_enqueue_style( 'huge_it_catalog_licensing' );
}


function huge_it_catalog_admin_script()
{
    wp_enqueue_media();
    wp_enqueue_style("jquery_ui", "http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css", FALSE);
    wp_enqueue_script("jquery_ui_new", "http://code.jquery.com/ui/1.10.4/jquery-ui.js", FALSE);
    wp_enqueue_style("admin_css", plugins_url("style/admin.style.css", __FILE__), FALSE);
    wp_enqueue_script("admin_js", plugins_url("js/admin.js", __FILE__), FALSE);
}


function huge_it_catalog_option_admin_script()
{
    wp_enqueue_media();
    wp_enqueue_script("jquery_old", "http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js", FALSE);
    wp_enqueue_script("simple_slider_js",  plugins_url("js/simple-slider.js", __FILE__), FALSE);
    wp_enqueue_style("simple_slider_css", plugins_url("style/simple-slider.css", __FILE__), FALSE);
    wp_enqueue_style("admin_css", plugins_url("style/admin.style.css", __FILE__), FALSE);
    wp_enqueue_script("admin_js", plugins_url("js/admin.js", __FILE__), FALSE);
    wp_enqueue_script('param_block2', plugins_url("elements/jscolor/jscolor.js", __FILE__));
}

function catalogs_huge_it_catalog()
{
    require_once("admin/catalogs_func.php");
    require_once("admin/catalogs_view.php");
    wp_enqueue_style("free-banner", plugins_url("style/free-banner.css", __FILE__), FALSE);
    if (!function_exists('print_html_nav'))
        require_once("catalog_function/html_catalog_func.php");

    if (isset($_GET["del_review"]))
        $del_review_id = absint($_GET["del_review"]);
    if (isset($_GET["task"]))
        $task = sanitize_text_field($_GET["task"]);
    else
        $task = '';
    if (isset($_GET["id"]))
        $id = absint($_GET["id"]);
    else
        $id = 0;
    global $wpdb;
    switch ($task) {

        case 'add_cat':
            add_catalog();
            break;

        case 'popup_posts':
            if ($id)
                popup_posts($id);
            else {
                $id = $wpdb->get_var("SELECT MAX( id ) FROM " . $wpdb->prefix . "huge_itgallery_gallerys");
                popup_posts($id);
            }
            break;
        case 'catalog_add_shortcode_popup':
            catalog_add_shortcode_popup();
            break;
        case 'reviews':
            if ($id)
                catalog_reviews($id);
            else {
                $id = $wpdb->get_var("SELECT MAX( id ) FROM " . $wpdb->prefix . "huge_itgallery_gallerys");
                catalog_reviews($id);
            }
            if(isset($_GET["del_id"])){
                if($_GET["del_id"] != ''){

                    $wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."huge_it_catalog_reviews WHERE id = '%d' ",$_GET["del_id"]));
                    header("Location: admin.php?page=catalogs_huge_it_catalog&id=".$_GET['id']."&task=reviews&prod_id=".$_GET['prod_id']."&TB_iframe=1");
                }
            }
            break;

        case 'ratings':
            if ($id)
                catalog_ratings($id);
            else {
                $id = $wpdb->get_var("SELECT MAX( id ) FROM " . $wpdb->prefix . "huge_itgallery_gallerys");
                catalog_ratings($id);
            }
            if(isset($_GET["del_id"])){
                if($_GET["del_id"] != ''){
                    $wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."huge_it_catalog_rating WHERE id = '%d' ",$_GET["del_id"]));
                    header("Location: admin.php?page=catalogs_huge_it_catalog&id=".$_GET['id']."&task=ratings&prod_id=".$_GET['prod_id']."&TB_iframe=1");
                }
            }
            break;

        case 'edit_cat':
            if ($id)
                edit_catalog($id);
            else {
                $id = $wpdb->get_var("SELECT MAX( id ) FROM " . $wpdb->prefix . "huge_it_catalogs");
                edit_catalog($id);
            }
            break;

        case 'edit_album':
            if ($id)
                edit_album($id);
            else {
                $id = $wpdb->get_var("SELECT MAX( id ) FROM " . $wpdb->prefix . "huge_it_catalogs");
                edit_album($id);
            }
            break;

        case 'save':
            if ($id)
                apply_cat($id);
        case 'apply':
            if ($id) {
                apply_cat($id);
                edit_catalog($id);
            }
            break;
        case 'remove_cat':
            removecatalog($id);
            showcatalog();
            break;
        default:
            showcatalog();
            break;
    }


}


function Options_product_Catalog_styles()
{
    require_once("admin/catalog_Options_func.php");
    require_once("admin/catalog_Options_view.php");
    wp_enqueue_style("free-banner", plugins_url("style/free-banner.css", __FILE__), FALSE);
    wp_enqueue_script("admin_js", plugins_url("js/admin.js", __FILE__), FALSE);
    showStyles();
}
function Options_catalog_lightbox_styles()
{
    require_once("admin/catalog_lightbox_func.php");
    require_once("admin/catalog_lightbox_view.php");
    wp_enqueue_style("free-banner", plugins_url("style/free-banner.css", __FILE__), FALSE);
    wp_enqueue_script("admin_js", plugins_url("js/admin.js", __FILE__), FALSE);
    if (isset($_GET['task']))
        if ($_GET['task'] == 'save')
            save_styles_options();
    showStyles();
}

function huge_it_catalog_reviews_page() {
    require_once("admin/reviews_func.php");
    require_once("admin/reviews_view.php");
    wp_enqueue_style("free-banner", plugins_url("style/free-banner.css", __FILE__), FALSE);
    wp_enqueue_script("admin_js", plugins_url("js/admin.js", __FILE__), FALSE);
    show_reviews();
}

function huge_it_catalog_submitions_page() {
    require_once("admin/submitions_func.php");
    require_once("admin/submitions_view.php");
    wp_enqueue_style("free-banner", plugins_url("style/free-banner.css", __FILE__), FALSE);
    if (isset($_GET["task"])){ $task = sanitize_text_field($_GET["task"]); }
    else
    { $task = ''; }
    if (isset($_GET["id"]))
    { $id = absint($_GET["id"]); }
    else
    { $id = 0; }
    global $wpdb;
    switch ($task) {

        case 'show_message':
            huge_it_catalog_show_message($id);
            break;
        default:
            show_submitions();
            break;
    }

}

function huge_it_catalog_products_page(){
    require_once("admin/product_options_func.php");
    require_once("admin/product_options_view.php");
    wp_enqueue_style("free-banner", plugins_url("style/free-banner.css", __FILE__), FALSE);
    wp_enqueue_script("admin_js", plugins_url("js/admin.js", __FILE__), FALSE);
    wp_enqueue_script('param_block2', plugins_url("elements/jscolor/jscolor.js", __FILE__));
    if (isset($_GET['task'])){
        if ($_GET['task'] == 'save'){
            save_styles_options();
        }
    }
    show_product_options();

}

function huge_it_catalog_general_options_page(){
    require_once("admin/catalog_general_options_func.php");
    require_once("admin/catalog_general_options_view.php");
    wp_enqueue_style("free-banner", plugins_url("style/free-banner.css", __FILE__), FALSE);
    wp_enqueue_script("admin_js", plugins_url("js/admin.js", __FILE__), FALSE);
    if (isset($_GET['task'])){
        if ($_GET['task'] == 'save'){
            save_styles_options();
        }
    }
    show_general_options();

}

function huge_it_catalog_ratings_page() {
    require_once("admin/ratings_func.php");
    require_once("admin/ratings_view.php");
    wp_enqueue_style("free-banner", plugins_url("style/free-banner.css", __FILE__), FALSE);
    wp_enqueue_script("admin_js", plugins_url("js/admin.js", __FILE__), FALSE);
    show_ratings();
}



/**
 * Huge IT Widget
 */
class Huge_it_catalog_Widget extends WP_Widget {


    public function __construct() {
        parent::__construct(
            'Huge_it_catalog_Widget',
            'Huge IT Catalog',
            array( 'description' => __( 'Huge IT Catalog', 'huge_it_catalog' ), )
        );
    }


    public function widget( $args, $instance ) {
        extract($args);

        if (isset($instance['catalog_id'])) {
            $catalog_id = $instance['catalog_id'];

            $title = apply_filters( 'widget_title', $instance['title'] );

            echo $before_widget;
            if ( ! empty( $title ) )
                echo $before_title . $title . $after_title;

            echo do_shortcode("[huge_it_catalog id={$catalog_id}]");
            echo $after_widget;
        }
    }


    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['catalog_id'] = strip_tags( $new_instance['catalog_id'] );
        $instance['title'] = strip_tags( $new_instance['title'] );

        return $instance;
    }


    public function form( $instance ) {
        $selected_catalog = 0;
        $title = "";
        $catalogs = false;

        if (isset($instance['catalog_id'])) {
            $selected_catalog = $instance['catalog_id'];
        }

        if (isset($instance['title'])) {
            $title = $instance['title'];
        }




        ?>
        <p>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <label for="<?php echo $this->get_field_id('catalog_id'); ?>"><?php echo __('Select Catalog:',"product-catalog"); ?></label>
        <select id="<?php echo $this->get_field_id('catalog_id'); ?>" name="<?php echo $this->get_field_name('catalog_id'); ?>">

            <?php
            global $wpdb;
            $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalogs ";
            $rowwidget=$wpdb->get_results($query);
            foreach($rowwidget as $rowwidgetecho){

                selected
                ?>
                <option <?php if($rowwidgetecho->id == $instance['catalog_id']){ echo 'selected'; } ?> value="<?php echo $rowwidgetecho->id; ?>"><?php echo $rowwidgetecho->name; ?></option>

            <?php } ?>
        </select>

        </p>
        <?php
    }
}

add_action('widgets_init', 'register_Huge_it_catalog_Widget');

function register_Huge_it_catalog_Widget() {
    register_widget('Huge_it_catalog_Widget');
}


add_action('wp_ajax_my_action', 'huge_it_catalog_my_action_callback');

function huge_it_catalog_my_action_callback() {
    global $wpdb; // this is how you get access to the database
    if($_POST["post"] == "delanyreviews"){
        $reviews_for_delete =  $_POST['reviews_for_delete'];
        foreach($reviews_for_delete as $id_for_delete){
            $sqlForDelete = $wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."huge_it_catalog_reviews WHERE id = '%d' ",$id_for_delete));
        }
        if($sqlForDelete) { echo json_encode(1); }
        die(); // this is required to return a proper result
    }
    else
        if($_POST["post"] == "delanyratings") {
            $ratings_for_delete =  $_POST['ratings_for_delete'];
            foreach($ratings_for_delete as $id_for_delete){
                $sqlForDelete = $wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."huge_it_catalog_rating WHERE id = '%d' ",$id_for_delete));
            }
            if($sqlForDelete) { echo json_encode(1); }
            die();
        }
        else
            if($_POST["post"] == "editratingip") {
                $rating_new_ip = sanitize_text_field($_POST['rating_new_ip']);
                $rating_new_id = absint($_POST['rating_new_id']);

                $sqlForUpdateIp = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_rating SET  ip = '%s'  WHERE id = '%s' ", $rating_new_ip, $rating_new_id));
                if($sqlForUpdateIp) { echo json_encode(1); }
                else { echo json_encode(2); }
                die();
            }
            else
                if($_POST["post"] == "editratingvalue") {
                    $rating_new_value = absint($_POST['rating_new_value']);
                    $rating_new_id = absint($_POST['rating_new_id']);
                    $sqlForUpdateIp = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_rating SET  value = '%s'  WHERE id = '%s' ", $rating_new_value, $rating_new_id));

                    if($sqlForUpdateIp) { echo json_encode(1); }
                    else { echo json_encode(2); }
                    die();
                }
                else
                    if($_POST["post"] == "editreviewname"){
                        $com_new_name = sanitize_text_field($_POST['com_new_name']);
                        $com_new_id = absint($_POST['com_new_id']);
                        $sqlForUpdateName = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_reviews SET  name = '%s'  WHERE id = '%s' ", $com_new_name, $com_new_id));

                        if($sqlForUpdateName) { echo json_encode(1); }
                        die(); // this is required to return a proper result
                    }
                    else
                        if($_POST["post"] == "editreviewcontent"){
                            $com_new_name = sanitize_text_field($_POST['com_new_name']);
                            $com_new_id = absint($_POST['com_new_id']);
                            $sqlForUpdateName = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_reviews SET  content = '%s'  WHERE id = '%s' ", $com_new_name, $com_new_id));

                            if($sqlForUpdateName) { echo json_encode(1); }
                            die(); // this is required to return a proper result
                        }
                        else
                            if($_POST["post"] == "movetospamreviews"){
                                $spam_reviews =  absint($_POST['spam_reviews']);
                                foreach($spam_reviews as $spam_reviews_id){
                                    $sqlForSpam = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_reviews SET  spam='1'  WHERE id = '%d' ", $spam_reviews_id));
                                }
                                if($sqlForSpam) { echo json_encode(1); }
                                die(); // this is required to return a proper result
                            }
                            else
                                if($_POST["post"] == "removefromtospamreviews"){
                                    $spam_reviews =  absint($_POST['spam_reviews']);
                                    foreach($spam_reviews as $spam_reviews_id){
                                        $sqlForSpam = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_reviews SET  spam='0'  WHERE id = '%d' ", $spam_reviews_id));
                                    }
                                    if($sqlForSpam) { echo json_encode(1); }
                                    die(); // this is required to return a proper result
                                }
                                else
                                    if($_POST["post"] == "productsShortcodeSelectIsChanged"){
                                        $catalog_id = absint($_POST["catalog_id"]);
                                        $catalogsAsCategory = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products WHERE catalog_id = '%s' ", $catalog_id));
                                        if($catalogsAsCategory) { echo json_encode($catalogsAsCategory); }
                                        else { echo json_encode(0); }
                                        die(); // this is required to return a proper result
                                    }
                                    else {
                                        if($_POST["post"] == "deleteanysubmitions"){
                                            $submitions_for_delete =  $_POST['submitions_for_delete'];
                                            foreach($submitions_for_delete as $id_for_delete){
                                                if($id_for_delete != "" && $id_for_delete != 0){
                                                    $sqlForDelete = $wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."huge_it_catalog_asc_seller WHERE id = '%d' ",$id_for_delete));
                                                }
                                            }
                                            if($sqlForDelete){ echo json_encode(1); }
                                            die(); // this is required to return a proper result
                                        }
                                        else{
                                            if($_POST["post"] == "movetospamsubmitions"){
                                                $spam_submitions =  $_POST['spam_submitions'];
                                                foreach($spam_submitions as $spam_submitions_id){
                                                    $sqlForSpam = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_asc_seller SET  spam='1'  WHERE id = '%d' ", $spam_submitions_id));
                                                }
                                                echo json_encode(1);
                                                die(); // this is required to return a proper result
                                            }
                                            else{
                                                if($_POST["post"] == "removefromtospamsubmitions"){
                                                    $spam_submitions =  $_POST['spam_submitions'];
                                                    foreach($spam_submitions as $spam_reviews_id){
                                                        $sqlForSpam = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_asc_seller SET  spam='0'  WHERE id = '%d' ", $spam_reviews_id));
                                                    }
                                                    if($sqlForSpam) { echo json_encode(1); }
                                                    die(); // this is required to return a proper result
                                                }
                                                else
                                                    if($_POST["post"] == "editsubmitionmessage"){
                                                        $submition_new_name = sanitize_text_field($_POST['submition_new_name']);
                                                        $submition_new_id = absint($_POST['submition_new_id']);
                                                        $sqlForUpdateName = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_asc_seller SET user_massage = '%s'  WHERE id = '%s' ", $submition_new_name, $submition_new_id));

                                                        if($sqlForUpdateName) { echo json_encode(1); }
                                                        die(); // this is required to return a proper result
                                                    }
                                                    else{
                                                        if($_POST["post"] == "editsubmitionusername"){
                                                            $submition_new_name = sanitize_text_field($_POST['submition_new_name']);
                                                            $submition_new_id = absint($_POST['submition_new_id']);
                                                            $sqlForUpdateName = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_asc_seller SET  user_name = '%s'  WHERE id = '%s' ", $submition_new_name, $submition_new_id));

                                                            if($sqlForUpdateName) { echo json_encode(1); }
                                                            die(); // this is required to return a proper result
                                                        }
                                                        else{
                                                            if($_POST["post"] == "editsubmitionemail"){
                                                                $submition_new_name = sanitize_text_field($_POST['submition_new_name']);
                                                                $submition_new_id = absint($_POST['submition_new_id']);
                                                                $sqlForUpdateName = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_asc_seller SET  user_email = '%s'  WHERE id = '%s' ", $submition_new_name, $submition_new_id));

                                                                if($sqlForUpdateName) { echo json_encode(1); }
                                                                die(); // this is required to return a proper result
                                                            }
                                                            else{
                                                                if($_POST["post"] == "editsubmitionphone"){
                                                                    $submition_new_name = sanitize_text_field($_POST['submition_new_name']);
                                                                    $submition_new_id = absint($_POST['submition_new_id']);
                                                                    $sqlForUpdateName = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_asc_seller SET  user_phone = '%s'  WHERE id = '%s' ", $submition_new_name, $submition_new_id));

                                                                    if($sqlForUpdateName) { echo json_encode(1); }
                                                                    die(); // this is required to return a proper result
                                                                }
                                                            }
                                                        }
                                                    }
                                            }
                                        }
                                    }
}
add_action('wp_ajax_my_action', 'huge_it_catalog_my_action_callback_frontend');
add_action('wp_ajax_nopriv_my_action', 'huge_it_catalog_my_action_callback_frontend' );

function huge_it_catalog_my_action_callback_frontend() {
    global $wpdb; // this is how you get access to the database

    if($_POST["post"] == "applyproductcommentfromuser"){
        $comments_name =  sanitize_text_field($_POST['comments_name']);
        $author_comment =  sanitize_text_field($_POST['author_comment']);
        $spam = intval($_POST["spam"]);
        $product_id = absint($_POST["product_id"]);
        $ip = sanitize_text_field($_POST["ip"]);
        $date = date("Y/m/d");
        $time = date("h:i");
        $datetime = $date." at ".$time;
        $captcha_val = intval($_POST['captcha_val']);
        if($spam == 1){
            $response = array('index' => '1', 'spamer' => 'true');
            echo json_encode($response);die();
        }
        else {
            $sqlForCheckingCaptcha = $wpdb->get_row("SELECT published_in_sl_width FROM ".$wpdb->prefix."huge_it_catalog_products");
            if($sqlForCheckingCaptcha->published_in_sl_width != $captcha_val){
                $response = array('index' => '2', 'captcha' => 'invalid');
                echo json_encode($response);
                die();
            }
            else{
                $sqlAddUserReview = $wpdb->query($wpdb->prepare("INSERT INTO `".$wpdb->prefix."huge_it_catalog_reviews` (`name`, `content`, `product_id`, `spam`, `ip`, `date`)"
                    . "                                      VALUES ('%s', '%s', '%s', '0', '%s', '%s')",$comments_name, $author_comment, $product_id, $ip, $datetime));
                if($sqlAddUserReview) {
                    $captcha1 = rand(1,9);
                    $captcha2 = rand(1,9);
                    $captcha12 = $captcha1 + $captcha2;
                    $updateCaptcha = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products  SET published_in_sl_width = '%s'", $captcha12));
                    if($updateCaptcha){
                        $response = array('index' => '1', 'captcha1' => $captcha1, 'captcha2' => $captcha2, 'comment' => 'true');
                        echo json_encode($response);
                        die(); // this is required to return a proper result
                    }
                }
                else {
                    $response = array('index' => '3', 'sql' => 'false');
                    json_encode($response);
                    die();
                }
            }
        }
    }
    else
        if($_POST["post"] == "applyproductascsellerfromuser"){
            if(isset($_POST["user_name"]))       { $name = sanitize_text_field($_POST["user_name"]);              $name = sanitize_text_field($name);               }
            if(isset($_POST["user_mail"]))       { $mail = sanitize_email($_POST["user_mail"]);              $mail = sanitize_text_field($mail);               }
            if(isset($_POST["user_phone"]))      { $phone = sanitize_text_field($_POST["user_phone"]);            $phone = sanitize_text_field($phone);             }
            if(isset($_POST["user_massage"]))    { $massage = sanitize_text_field($_POST["user_massage"]);        $massage = sanitize_text_field($massage);         }
            if(isset($_POST["user_ip"]))         { $user_ip = sanitize_text_field($_POST["user_ip"]);             $user_ip = sanitize_text_field($user_ip);         }
            if(isset($_POST["user_product_id"])) { $product_id = absint($_POST["user_product_id"]);  $product_id  = sanitize_text_field($product_id);  }
            if(isset($_POST["user_spam"]))       { $spam = absint($_POST["user_spam"]);              $spam = sanitize_text_field($spam);               }
            if(isset($_POST["captcha_val"]))     { $captcha_val = intval($_POST['captcha_val']);     $captcha_val = sanitize_text_field($captcha_val); }
            if(isset($_POST["captcha_sum"]))     { $captcha_sum = intval($_POST['captcha_sum']);     $captcha_sum = sanitize_text_field($captcha_sum); }
            if(isset($_POST["product_name"]))    { $product_name = sanitize_text_field($_POST['product_name']);                                                     }

            $getAllParams = $wpdb->get_results("SELECT name,value FROM ".$wpdb->prefix."huge_it_catalog_general_params");
            foreach($getAllParams AS $allParams){
                if($allParams->name == "ht_catalog_general_message_to_user")     { $sendToUser = $allParams->value; }
                if($allParams->name == "ht_catalog_general_user_subject")        { $userSubject = $allParams->value; }
                if($allParams->name == "ht_catalog_general_user_message")        { $userMessage = $allParams->value; }
                if($allParams->name == "ht_catalog_general_message_to_admin")    { $sendToAdmin = $allParams->value; }
                if($allParams->name == "ht_catalog_general_admin_email")         { $adminEmail = $allParams->value; }
                if($allParams->name == "ht_catalog_general_admin_email_subject") { $adminSubject = $allParams->value; }
                if($allParams->name == "ht_catalog_general_admin_email_message") { $sendMessage = $allParams->value; }
                if($allParams->name == "ht_catalog_general_admin_from_text")     { $from = $allParams->value; }
            }

            $massage = "<table class='message-block'>
                                <tr>
                                    <td width='1000'><strong>Customer Name: </strong> ".$name." </td>
                                </tr>
                                <tr>
                                    <td width='1000'><strong>Customer E-mail: </strong> ".$mail." </td>
                                </tr>
                                <tr>
                                    <td width='1000'><strong>Phone: </strong> ".$phone."</td>
                                </tr>
                                <tr>
                                    <td width='1000'><strong>Product Name: </strong> ".$product_name."</td>
                                </tr>
                                <tr>
                                    <td width='1000'><strong>IP Adress: </strong> ".$user_ip." </td>
                                </tr>
                                <tr><td height='10' ></td></tr>
                                <tr class='message-text'>
                                    <td width='1000' >
                                            <strong>Message: </strong> ".$massage."
                                    </td>
                                </tr>
                        </table>";
            $sendMessage = str_ireplace("{userMessage}",$massage,$sendMessage);
            $date = date("Y/m/d");
            $time = date("h:i");
            $datetime = $date." at ".$time;
            $headers[] = 'From: '.$mail.' <'.$mail.'>';
            $headers[] = 'Content-type: text/html' ;
            $captcha_sum = intval($_POST['captcha_sum']);

            if($spam == 1){
                $response = array('index' => '1', 'reason' => 'spamer');
                echo json_encode($response);die();
            }
            else {
                if($captcha_sum != $captcha_val){
                    $response = array('index' => '2', 'reason' => 'Invalid Captcha');
                    echo json_encode($response);
                    die();
                }
                else{
                    $sqlAddUserAscSeller = $wpdb->query($wpdb->prepare(""
                        . "INSERT INTO `".$wpdb->prefix."huge_it_catalog_asc_seller` (`user_name`, `user_email`, `user_phone`, `user_massage`, `user_ip`, `date`, `spam`, `product_id`)"
                        . " VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%d', '%d')",$name, $mail, $phone, $massage, $user_ip, $datetime, $spam, $product_id));
                    if($sqlAddUserAscSeller) {
                        $captcha1 = rand(1,9);
                        $captcha2 = rand(1,9);
                        $captcha12 = $captcha1 + $captcha2;
                        $updateCaptcha = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products  SET published_in_sl_width = '%s'", $captcha12));
                        if($sendToAdmin == "on"){
                            $send = wp_mail( $adminEmail, $adminSubject, $sendMessage , $headers );
                        }
                        $headersUser = 'From: '.$from.' <'.$from.'>' . "\r\n";
                        if($sendToAdmin == "on"){
                            $responseToUser = wp_mail( $mail, $userSubject, $userMessage, $headersUser );
                        }

                        $response = array('index' => '1', 'captcha1' => $captcha1, 'captcha2' => $captcha2, 'reason' => 'allOk');
                        echo json_encode($response);
                        die(); // this is required to return a proper result
                    }
                    else {
                        $response = array('index' => '3', 'reason' => 'wrongSql');
                        json_encode($response);
                        die();
                    }
                }
            }
        }
        else
            if($_POST["post"] == "productratingfromuser"){
                $date = date("Y/m/d"); $time = date("h:i");
                $datetime = $date." at ".$time;
                $ip =  sanitize_text_field($_POST['ip']);
                $spam = intval($_POST["spam"]);
                $product_id = absint($_POST["product_id"]);
                $rate_val =  absint($_POST["rate_val"]);
                if($spam == 1){
                    echo json_encode(1);die();
                }
                else {
                    $ifAlreadyVoted = $wpdb->query($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_rating WHERE ip='%s' AND prod_id='%s'", $ip, $product_id));
                    if($ifAlreadyVoted) {
                        $sqlAddUserRating = $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_rating SET  value = '%s', date = '%s' WHERE ip = '%s' AND prod_id='%s' ", $rate_val, $date, $ip, $product_id));
                    }
                    else {
                        $sqlAddUserRating = $wpdb->query($wpdb->prepare(""
                            . " INSERT INTO `".$wpdb->prefix."huge_it_catalog_rating` (`value`, `prod_id`, `ip`, `date`)"
                            . " VALUES ('%s', '%s', '%s', '%s')",$rate_val, $product_id, $ip, $datetime));
                    }
                    if($sqlAddUserRating){
                        $newRating=$wpdb->get_results($wpdb->prepare("SELECT value FROM ".$wpdb->prefix."huge_it_catalog_rating WHERE prod_id='%s'",$product_id));
                        $response = 0;
                        foreach ($newRating as $key => $newRatingValue) {
                            $response = $response + $newRatingValue->value;
                        }
                        $response = intval($response/count($newRating));
                        $response = array('index' => '1', 'rating' => $response);
                        echo json_encode($response);
                        die();
                    }
                }
            }
            elseif($_POST["post"] == "load_more_elements_into_catalog"){
                $catalog_id = absint($_POST["catalog_id"]);
                $count_into_page = absint($_POST["count_into_page"]);
                $show_thumbs = sanitize_text_field($_POST["show_thumbs"]);
                $show_description = sanitize_text_field($_POST["show_description"]);
                $show_linkbutton = sanitize_text_field($_POST["show_linkbutton"]);
                $parmalink = sanitize_text_field($_POST["parmalink"]);

                $allow_lightbox = sanitize_text_field($_POST["allow_lightbox"]);
                if($allow_lightbox == 'on'){ $allow_lightbox = 'catalog_colorbox_grouping_'.$catalog_id; } else { $allow_lightbox = ""; }


                $show_price = sanitize_text_field($_POST["show_price"]);
                if($show_price == "on"){
                    $price_text = sanitize_text_field($_POST["price_text"]);
                }else{ $price_text = ""; }

                if($show_linkbutton == "on"){
                    $linkbutton_text = sanitize_text_field($_POST["linkbutton_text"]);
                }else{ $linkbutton_text = ""; }

                $to = $count_into_page - 1;

                /****<SEARCH AND LOAD MORE>****/	//+ changed group_keys_in cases

                if(isset($_POST["text"]) && $_POST["text"] != '')
                    $test = sanitize_text_field($_POST["text"]);
                else $test = '';
                if(isset($_POST["elements"]) && $_POST["elements"] !='()')//    'AND id NOT IN  (4,7,8)
                    $elements = 'AND id NOT IN '.$_POST["elements"];

                else $elements = '';
                if(isset($_POST["type"]) && $_POST["type"] != '')
                    $type = sanitize_text_field($_POST["type"]);
                if(isset($_POST["pagetype"]) && $_POST["pagetype"] != '')
                    $pagetype = sanitize_text_field($_POST["pagetype"]);
                if($type == 'search') {
                    $query = ($pagetype == 'load_more')?"SELECT * FROM `".$wpdb->prefix."huge_it_catalog_products` WHERE (`catalog_id`='".$catalog_id."' AND `name` LIKE '%".$test."%') order by ordering ASC LIMIT ".$count_into_page
                        :"SELECT * FROM `".$wpdb->prefix."huge_it_catalog_products` WHERE (`catalog_id`='".$catalog_id."' AND `name` LIKE '%".$test."%')";
                }
                else if($type == 'load') {
                    $query = ($test == '')?$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products WHERE catalog_id = '%d' ".$elements." order by ordering ASC LIMIT %d ",$catalog_id,$count_into_page)
                        :"SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products WHERE catalog_id = '".$catalog_id."' ".$elements." AND `name` LIKE '%".$test."%' order by ordering ASC LIMIT ".$count_into_page;

                }
                else if($type == 'show_all') {
                    $query = 'SELECT * FROM '.$wpdb->prefix.'huge_it_catalog_products WHERE catalog_id ='.$catalog_id;
                }

                /****</SEARCH AND LOAD MORE>****/	//+ changed group_keys_in cases

                $moreImagesInArray = $wpdb->get_results($query);

                $view = absint($_POST["view"]);
                $group_key = 0;
                switch ($view){
                    case 0:
                        $moreImages = "";
                        foreach($moreImagesInArray as $key=>$row)
                        {

                            if($row->single_product_url_type == 'default'){
                                $page_link = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                                if (strpos(get_permalink(),'/?') !== false) { $product_page_link = get_permalink().'&single_prod_id=$row->id'; } else { if (strpos(get_permalink(),'/') !== false) { $product_page_link = get_permalink().'?single_prod_id=$row->id'; } else { $product_page_link = get_permalink().'/?single_prod_id=$row->id'; } }
                            }
                            else{ $product_page_link = $row->single_product_url_type; }
                            $my_linkbutton = "<div class='button-block'>
                                                  <a href='".$product_page_link."' target='_blank'>".$linkbutton_text."</a>
                                              </div>";
                            if($show_description == "on"){
                                $description = "<div class='description-block_".$catalog_id."'>
                                                    <p>".$row->description."</p>
                                                </div>";
                            }else{ $description = ""; }

                            $imgurl=explode(";",$row->image_url);

                            $thumbs_position = sanitize_text_field($_POST["thumbs_position"]);

                            $thumbs_imgurl = $imgurl;
                            unset($thumbs_imgurl[0]);
                            $thumbs_li = "";
                            foreach($thumbs_imgurl as $key=>$img)
                            {
                                if($img != "" && $img != ";"){
                                    $thumbs_li .="<li>
                                                <a href='".$img."'><img src='".$img."'></a>
                                            </li>";
                                }
                            }


                            $moreImages .= "<div class='element_".$catalog_id." ".$allow_lightbox."' data-symbol='".$row->name."' data-element-id='".$row->id."' data-category='alkaline-earth'>";
                            $moreImages .= "<div class='default-block_".$catalog_id."'>";
                            $moreImages .= "<div class='image-block_".$catalog_id." for_zoom'>";
                            if($row->image_url != ';'){
                                $moreImages .= "<a href='".$imgurl[0]."'><img id='wd-cl-img".$key."' src='".$imgurl[0]."' />  </a>";
                            }else{
                                $moreImages .= "<img id='wd-cl-img".$key."' src='images/noimage.png' />";
                            }

                            $moreImages .= "</div>
                                                <div class='title-block_".$catalog_id."'>
                                                    <h3 class='title'>".$row->name."</h3>
                                                    <div class='open-close-button'></div>
                                                </div>
                                        </div>
                                        <div class='wd-catalog-panel_".$catalog_id."' id='panel".$key."'>";
//
                            if($show_thumbs == "on" && $thumbs_position == "before"){
                                $moreImages .= "<div>
                                                    <ul class='thumbs-list_".$catalog_id."'>
                                                        ".$thumbs_li."
                                                    </ul>
                                                </div>";
                            }
                            if($show_description == "on"){
                                $moreImages .= "<div class='description-block_".$catalog_id."'>
                                                    <p>".$row->description."</p>
                                                </div>";
                            }
                            if($show_thumbs == "on" && $thumbs_position == "after"){
                                $moreImages .= "<div>
                                                    <ul class='thumbs-list_".$catalog_id."'>
                                                        ".$thumbs_li."
                                                    </ul>
                                                </div>";
                            }
                            if($show_price == "on" && $row->price != ''){
                                if($row->market_price == '') { $market_style = "style='text-decoration: none !important;'"; } else { $market_style = ""; }
                                $moreImages .= "<div class='price-block_".$catalog_id."'>
                                                        <span class='old-price-block' >".$price_text." : <span class='old-price' ".$market_style.">".$row->price."</span></span>
                                                        <span class='discont-price-block' ><span class='discont-price' >".$row->market_price."</span></span>
                                                  </div>";
                            }
                            if($row->single_product_url_type == 'default'){
                                $page_link = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                                if (strpos($parmalink,'/?') !== false) { $product_page_link = $parmalink.'&single_prod_id='.$row->id; } else { if (strpos($parmalink,'/') !== false) { $product_page_link = $parmalink.'?single_prod_id='.$row->id; } else { $product_page_link = $parmalink.'/?single_prod_id='.$row->id; } }
                            }
                            else{ $product_page_link = $row->single_product_url_type; }
                            $moreImages .= "<div class='button-block'>
                                                <a href='".$product_page_link."' target='_blank'>".$linkbutton_text."</a>
                                            </div>
                                        </div>
                                    </div>";
                        }
                        $response = array('moreImages' => $moreImages, 'query' => $query);
                        echo json_encode($response);
                        die();
                        break;
                    case 1:

                        $moreImages = "";
                        foreach($moreImagesInArray as $key=>$row)
                        {

                            if($row->single_product_url_type == 'default'){
                                $page_link = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                                if (strpos(get_permalink(),'/?') !== false) { $product_page_link = get_permalink().'&single_prod_id=$row->id'; } else { if (strpos(get_permalink(),'/') !== false) { $product_page_link = get_permalink().'?single_prod_id=$row->id'; } else { $product_page_link = get_permalink().'/?single_prod_id=$row->id'; } }
                            }
                            else{ $product_page_link = $row->single_product_url_type; }
                            $my_linkbutton = "<div class='button-block'>
                                                  <a href='".$product_page_link."' target='_blank'>".$linkbutton_text."</a>
                                              </div>";
                            if($show_description == "on"){
                                $description = "<div class='description-block_".$catalog_id."'>
                                                    <p>".$row->description."</p>
                                                </div>";
                            }else{ $description = ""; }

                            $imgurl=explode(";",$row->image_url);

                            $thumbs_position = sanitize_text_field($_POST["thumbs_position"]);

                            $thumbs_li = "";
                            foreach($imgurl as $key=>$img)
                            {
                                if($img != "" && $img != ";"){
                                    $thumbs_li .="<li>
                                                <a href='".$img."'><img src='".$img."'></a>
                                            </li>";
                                }
                            }

                            $moreImages .= "<div class='element_".$catalog_id." ".$allow_lightbox."' data-symbol='".$row->name."'  data-element-id='".$row->id."' data-category='alkaline-earth'>";
                            $moreImages .= "<div class='default-block_".$catalog_id."'>";
                            $moreImages .= "<div class='image-block_".$catalog_id." for_zoom'>";
                            if($row->image_url != ';'){
                                $moreImages .= "<img id='wd-cl-img".$key."' src='".$imgurl[0]."' />  </a>";
                            }else{
                                $moreImages .= "<img id='wd-cl-img".$key."' src='images/noimage.png' />";
                            }

                            $moreImages .= "</div>
                                                <div class='title-block_".$catalog_id."'>
                                                    <h3 class='title'>".$row->name."</h3>
                                                    <div class='open-close-button'></div>
                                                </div>
                                        </div>
                                        <div class='wd-catalog-panel_".$catalog_id."' id='panel".$key."'>";
//
                            if($show_thumbs == "on" && $thumbs_position == "before"){
                                $moreImages .= "<div>
                                                    <ul class='thumbs-list_".$catalog_id."'>
                                                        ".$thumbs_li."
                                                    </ul>
                                                </div>";
                            }
                            if($show_description == "on"){
                                $moreImages .= "<div class='description-block_".$catalog_id."'>
                                                    <p>".$row->description."</p>
                                                </div>";
                            }
                            if($show_thumbs == "on" && $thumbs_position == "after"){
                                $moreImages .= "<div>
                                                    <ul class='thumbs-list_".$catalog_id."'>
                                                        ".$thumbs_li."
                                                    </ul>
                                                </div>";
                            }
                            if($show_price == "on" && $row->price != ''){
                                if($row->market_price == '') { $market_style = "style='text-decoration: none !important;'"; } else { $market_style = ""; }
                                $moreImages .= "<div class='price-block_".$catalog_id."'>
                                                        <span class='old-price-block' >".$price_text." : <span class='old-price' ".$market_style.">".$row->price."</span></span>
                                                        <span class='discont-price-block' ><span class='discont-price' >".$row->market_price."</span></span>
                                                  </div>";
                            }
                            if($row->single_product_url_type == 'default'){
                                $page_link = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                                if (strpos($parmalink,'/?') !== false) { $product_page_link = $parmalink.'&single_prod_id='.$row->id; } else { if (strpos($parmalink,'/') !== false) { $product_page_link = $parmalink.'?single_prod_id='.$row->id; } else { $product_page_link = $parmalink.'/?single_prod_id='.$row->id; } }
                            }
                            else{ $product_page_link = $row->single_product_url_type; }
                            $moreImages .= "<div class='button-block'>
                                                <a href='".$product_page_link."' target='_blank'>".$linkbutton_text."</a>
                                            </div>
                                        </div>
                                    </div>";
                        }

                        $response = array('moreImages' => $moreImages, 'query' => $query);
                        echo json_encode($response);                die();
                        break;
                    case 2:
                        // $group_key = $from;
                        $moreImages = "";
                        foreach($moreImagesInArray as $key=>$row)
                        {

                            if($row->single_product_url_type == 'default'){
                                $page_link = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                                if (strpos($parmalink,'/?') !== false) { $product_page_link = $parmalink.'&single_prod_id='.$row->id; } else { if (strpos($parmalink,'/') !== false) { $product_page_link = $parmalink.'?single_prod_id='.$row->id; } else { $product_page_link = $parmalink.'/?single_prod_id='.$row->id; } }
                            }
                            else{ $product_page_link = $row->single_product_url_type; }
                            $my_linkbutton = "<div class='button-block'>
                                                  <a href='".$product_page_link."' target='_blank'>".$linkbutton_text."</a>
                                              </div>";
                            if($show_description == "on"){
                                $description = "<div class='description-block_".$catalog_id."'>
                                                    <p>".$row->description."</p>
                                                </div>";
                            }else{ $description = ""; }

                            $imgurl=explode(";",$row->image_url);

                            $thumbs_position = sanitize_text_field($_POST["thumbs_position"]);

                            $thumbs_li = "";
                            foreach($imgurl as $key=>$img)
                            { $thumbs_li .="<li>
                                                <a href=''><img src='".$img."'></a>
                                            </li>";
                            }


                            // $group_key ++;
                            $moreImages .= "<div class='element_".$catalog_id." ".$allow_lightbox."' data-symbol='".$row->name."' data-element-id='".$row->id."' data-category='alkaline-earth'>";
                            $moreImages .= "<div class='image-block_".$catalog_id."'>";
                            $imgurl=explode(";",$row->image_url);
                            if($row->image_url != ';'){
                                $moreImages .= "<img id='wd-cl-img".$key."' src='".$imgurl[0]."' />";
                            }else{
                                $moreImages .= "<img id='wd-cl-img".$key."' src='images/noimage.png' />";
                            }
                            $moreImages .= "<div class='image-overlay'><a href=#".$row->id."></a></div>"
                                . "</div>";

                            if($row->single_product_url_type == 'default'){
                                $page_link = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                                if (strpos($parmalink,'/?') !== false) { $product_page_link = $parmalink.'&single_prod_id='.$row->id; } else { if (strpos($parmalink,'/') !== false) { $product_page_link = $parmalink.'?single_prod_id='.$row->id; } else { $product_page_link = $parmalink.'/?single_prod_id='.$row->id; } }
                            }
                            else{ $product_page_link = $row->single_product_url_type; }

                            $moreImages .= "<div class='title-block_".$catalog_id."'>
                                                   <h3 class='title'>".$row->name."</h3>
                                            ";

                            $moreImages .= "    <div class='button-block'>
                                                    <a href='".$product_page_link."' target='_blank'>".$linkbutton_text."</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                        }





                        $show_popup_linkbutton = sanitize_text_field($_POST["show_popup_linkbutton"]);
                        $show_popup_title = sanitize_text_field($_POST['show_popup_title']);
                        $morePopups = "";
                        foreach($moreImagesInArray as $key=>$row)
                        {

                            if($row->single_product_url_type == 'default'){
                                $page_link = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                                if (strpos(get_permalink(),'/?') !== false) { $product_page_link = get_permalink().'&single_prod_id='.$row->id; } else { if (strpos(get_permalink(),'/') !== false) { $product_page_link = get_permalink().'?single_prod_id='.$row->id; } else { $product_page_link = get_permalink().'/?single_prod_id='.$row->id; } }
                            }
                            else{ $product_page_link = $row->single_product_url_type; }
                            $my_linkbutton = "<div class='button-block'>
                                          <a href='".$product_page_link."' target='_blank'>".$linkbutton_text."</a>
                                      </div>";
                            if($show_description == "on"){
                                $description = "<div class='description-block_".$catalog_id."'>
                                            <p>".$row->description."</p>
                                        </div>";
                            }else{ $description = ""; }

                            $thumbs_position = sanitize_text_field($_POST["thumbs_position"]);

                            $imgurl=explode(";",$row->image_url);
                            array_pop($imgurl);

                            $thumbs_li = "";
                            foreach($imgurl as $key=>$img)
                            { if($img != "" && $img != ";"){ $thumbs_li .="<li><a href='".$row->sl_url."' class=''><img src='".$img."'></a></li>"; }  }

                            $morePopups .= "<li class='pupup-element' id='huge_it_catalog_pupup_element_".$row->id."'>
			<div class='heading-navigation_".$catalog_id."'>
				<a href='#close' class='close'></a>
				<div style='clear:both;'></div>
			</div>
			<div class='popup-wrapper_".$catalog_id."'>
                            <div class='image-block_".$catalog_id."'>";
                            if($row->image_url != ';'){
                                $morePopups .= "<img id='wd-cl-img".$key."' src='' />";
                            }else{
                                $morePopups .= "<img id='wd-cl-img".$key."' src='images/noimage.png' />";
                            }
                            $morePopups .= ""
                                . "</div>"
                                . "<div class='right-block'>";
                            if($show_popup_title == "on"){
                                $morePopups .= "<h3 class='title'>".$row->name."</h3>";
                            }
                            if($show_thumbs == "on" && $thumbs_position == "after"){
                                $morePopups .= "<div>
                                                       <ul class='thumbs-list_".$catalog_id."'>
                                                           ".$thumbs_li."
                                                       </ul>
                                                   </div>";
                            }
                            if($show_description == "on"){
                                $morePopups .= "<div class='description'>".$row->description."</div>";
                            }

                            if($show_thumbs == "on" && $thumbs_position == "before"){
                                $morePopups .= "<div>
                                                       <ul class='thumbs-list_".$catalog_id."'>
                                                           ".$thumbs_li."
                                                       </ul>
                                                   </div>";
                            }


                            if($show_price == "on" && $row->price != ''){
                                if($row->market_price == '') { $market_style = "style='text-decoration: none !important;'"; } else { $market_style = ""; }
                                $morePopups .= "<div class='price-block_".$catalog_id."'>
                                                           <span class='old-price-block' >".$price_text." : <span class='old-price' ".$market_style.">".$row->price."</span></span>
                                                           <span class='discont-price-block' ><span class='discont-price' >".$row->market_price."</span></span>
                                                     </div>";
                            }

                            if($row->single_product_url_type == 'default'){
                                $page_link = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                                if (strpos($parmalink,'/?') !== false) { $product_page_link = $parmalink.'&single_prod_id='.$row->id; } else { if (strpos($parmalink,'/') !== false) { $product_page_link = $parmalink.'?single_prod_id='.$row->id; } else { $product_page_link = $parmalink.'/?single_prod_id='.$row->id; } }
                            }
                            else{ $product_page_link = $row->single_product_url_type; }
                            $morePopups .= "<div class='button-block'>
                                                    <a href='".$product_page_link."' target='_blank'>".$linkbutton_text."</a>
                                                </div>
                                                <div style='clear:both;'></div>
                                            </div>
                                            <div style='clear:both;'></div>
                                            </div></li>";
                        }

                        $response = array('moreImages' => $moreImages, 'morePopups' => $morePopups,'query' => $query);
                        echo json_encode($response);
                        die();
                        break;
                    case 3:

                        $moreImages = "";
                        foreach($moreImagesInArray as $key=>$row)
                        {
                            $link = $row->sl_url;
                            $imgurl = explode(";",$row->image_url);
                            $thumbs_li = '';
                            foreach($imgurl as $key=>$img)
                            {
                                if($img != "" && $img != ";"){
                                    $thumbs_li .="<li><a href='".$img."'><img src='".$img."'></a></li>";
                                }
                            }
                            $moreImages .= "<div class='element_".$catalog_id." ".$allow_lightbox."' data-symbol='".$row->name."'  data-element-id='".$row->id."'  data-category='alkaline-earth' data>";
                            $moreImages .= "<div class='left-block_".$catalog_id."'>
                                                <div class='main-image-block_".$catalog_id." for_zoom'>";

                            if($row->image_url != ';'){
                                $moreImages .= "<a href='".$imgurl[0]."''><img id='wd-cl-img".$key."'src='".$imgurl[0]."'></a>";
                            }else{
                                $moreImages .= "<a href='".$imgurl[0]."'><img id='wd-cl-img".$key."' src='images/noimage.png'></a>";
                            }
                            $moreImages .= "</div>
                                                                    <div class='thumbs-block'>";
                            if($show_thumbs == "on"){
                                $moreImages .= "<div>
                                                                           <ul class='thumbs-list_".$catalog_id."'>
                                                                               ".$thumbs_li."
                                                                           </ul>
                                                                       </div>";
                            }
                            $moreImages .= "</div>
                                                </div>
                                                <div class='right-block'>";
                            if($row->name!=''){
                                $moreImages .= "<div class='title-block_".$catalog_id."'><h3>".$row->name."</h3></div>";
                            }
                            if($show_description == "on" && $row->description != ''){
                                $moreImages .= "<div class='description-block_".$catalog_id."'>".$row->description."</div>";
                            }

                            if($show_price == "on" && $row->price != ''){
                                if($row->market_price == '') { $market_style = "style='text-decoration: none !important;'"; } else { $market_style = ""; }
                                $moreImages .= "<div class='price-block_".$catalog_id."'>
                                                                             <span class='old-price-block' >".$price_text." : <span class='old-price' ".$market_style.">".$row->price."</span></span>
                                                                             <span class='discont-price-block' ><span class='discont-price' >".$row->market_price."</span></span>
                                                                       </div>";
                            }

                            if($row->single_product_url_type == 'default'){
                                $page_link = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                                if (strpos($parmalink,'/?') !== false) { $product_page_link = $parmalink.'&single_prod_id='.$row->id; } else { if (strpos($parmalink,'/') !== false) { $product_page_link = $parmalink.'?single_prod_id='.$row->id; } else { $product_page_link = $parmalink.'/?single_prod_id='.$row->id; } }
                            }
                            else{ $product_page_link = $row->single_product_url_type; }
                            $moreImages .= "<div class='button-block'>
                                                                       <a href='".$product_page_link."' target='_blank'>".$linkbutton_text."</a>
                                                                   </div>";
                            $moreImages .= "</div>
                                </div>";
                        }
                        $response = array('moreImages' => $moreImages, 'query' => $query);
                        echo json_encode($response);
                        die();
                        break;
                    case 5:
                        echo 5;
                        die();
                        break;
                }
            }
}
//}



//////////////////////////////////////////////////////                                             ///////////////////////////////////////////////////////
//////////////////////////////////////////////////////               Activate catalog                    ///////////////////////////////////////////////////////
//////////////////////////////////////////////////////                                             ///////////////////////////////////////////////////////
//////////////////////////////////////////////////////                                             ///////////////////////////////////////////////////////


function huge_it_catalog_activate()
{
    global $wpdb;

/// creating database tables

    $sql_huge_it_catalog_general_params = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_it_catalog_general_params`(
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `value` varchar(200) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
)  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ";

    $sql_huge_it_catalog_album_catalog_contact = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_it_catalog_album_catalog_contact`(
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `album_id` int(11),
  `catalog_id` int(11),
  PRIMARY KEY (`id`)
)  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ";


    $sql_huge_it_catalog_products = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_it_catalog_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `catalog_id` varchar(200) DEFAULT NULL,
  `description` text,
  `image_url` text,
  `sl_url` varchar(128) DEFAULT NULL,
  `sl_type` text NOT NULL,
  `link_target` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` varchar(5) NOT NULL,
  `published_in_sl_width` text NOT NULL,
  `price` varchar(200) NOT NULL,
  `market_price` varchar(200) NOT NULL,
  `parameters` text  NOT NULL,
  `single_product_url_type` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
)  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8";

    $sql_huge_catalogs = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_it_catalogs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `sl_height` int(11) unsigned DEFAULT NULL,
  `sl_width` int(11) unsigned DEFAULT NULL,
  `pause_on_hover` text,
  `catalog_list_effects_s` text,
  `description` text,
  `url` text,
  `link_target` text,
  `param` text,
  `sl_position` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` text,
  `categories` text,
  `ht_show_sorting` text,
  `ht_show_filtering` text,
  `album_id` int(11) NOT NULL,
  `cat_thumb` text,
  `pagination_type` text,
  `count_into_page` text,
  `catalog_search` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) AUTO_INCREMENT=8 ";


    $sql_huge_it_catalog_rating = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_it_catalog_rating`(
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` text CHARACTER SET utf8 NOT NULL,
  `prod_id` int(11) unsigned NOT NULL,
  `ip` text CHARACTER SET utf8 NOT NULL,
  `date` text CHARACTER SET utf8 NOT NULL,
  
  PRIMARY KEY (`id`)
)  AUTO_INCREMENT=8 ";

    $sql_huge_it_catalog_reviews = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_it_catalog_reviews`(
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `spam` int(11) unsigned NOT NULL,
  `ip` text CHARACTER SET utf8 NOT NULL,
  `date` text CHARACTER SET utf8 NOT NULL,
  
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=8 ";


    $sql_huge_it_catalog_asc_seller = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_it_catalog_asc_seller`(
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` text CHARACTER SET utf8 NOT NULL,
  `user_email` text CHARACTER SET utf8 NOT NULL,
  `user_phone` text CHARACTER SET utf8 NOT NULL,
  `user_massage` text CHARACTER SET utf8 NOT NULL,
  `user_ip` text CHARACTER SET utf8 NOT NULL,
  `date` text CHARACTER SET utf8 NOT NULL,
  `spam` text CHARACTER SET utf8 NOT NULL,
  `read_or_not` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  
  PRIMARY KEY (`id`)
)  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ";

    $sql_huge_it_catalog_albums = "
CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "huge_it_catalog_albums` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 NOT NULL,
  `catalog_album_view_mode` int(11) NOT NULL,
  
  PRIMARY KEY (`id`)
)  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ";

    $table_name = $wpdb->prefix . "huge_it_catalog_album_catalog_contact";
    $sql_7 = <<<query7
INSERT INTO `$table_name` (`album_id`, `catalog_id`) VALUES


('8', '8'),
('9', '0'),
('8', '9');

query7;


    $table_name = $wpdb->prefix . "huge_it_catalog_products";
    $sql_2 = "
INSERT INTO 

`" . $table_name . "` (`id`, `name`, `catalog_id`, `description`, `image_url`, `sl_url`, `sl_type`, `link_target`, `ordering`, `published`, `published_in_sl_width`, `price`, `market_price`, `parameters`,`single_product_url_type`) VALUES
(21, 'Aerodinamico Carbon Fibre Chronograph Watch', '8', '<p>Aerodynamics and aesthetics blend seamlessly in this line of casually sophisticated Scuderia Ferrari timepieces.\r\nDesigned to hit the racetrack in sleek, wind-deflecting style, Aerodinamico features an integrated, ventilated silicone strap molded to echo the design of the diffuser on the Scuderia Ferrari single-seater.\r\nIts masculine 46mm TR90 thermoplastic chassis reveals a distinctive stepped case design with curved rectangular contours</p>', '".plugins_url("Front_images/projects/6.jpg", __FILE__).";".plugins_url("Front_images/projects/6.1.jpg", __FILE__).";".plugins_url("Front_images/projects/6.2.jpg", __FILE__).";".plugins_url("Front_images/projects/6.3.jpg", __FILE__).";', NULL, '', 'off', 1, 'on', '10', '$415.00', '$315.00', 'Condition_()_NEW*()*Brand_()_FERRARI*()*Movement_()_CHRONOGRAPH*()*Color_()_BLACK*()*CASE DIAMETER_()_46 MM*()*Color Case_()_BLACK*()*Segment_()_CHALLENGE', 'default'),
(20, 'Scuderia Ferrari Aero Touch', '8', '<p>Aerodynamics and aesthetics blend seamlessly in this line of casually sophisticated Scuderia Ferrari timepieces. Designed to hit the racetrack in sleek, wind-deflecting style, Aerodinamico features an integrated, ventilated silicone strap molded to echo the design of the diffuser on the Scuderia Ferrari single-seater. Its masculine 46mm TR90 thermoplastic chassis reveals a distinctive stepped case design with curved rectangular contours..</p>', '".plugins_url("Front_images/projects/5.jpg", __FILE__).";".plugins_url("Front_images/projects/5.1.jpg", __FILE__).";".plugins_url("Front_images/projects/5.2.jpg", __FILE__).";".plugins_url("Front_images/projects/5.3.jpg", __FILE__).";', NULL, '', 'off', 3, 'on', '10', ' $300.00', ' $235.00', 'Condition_()_NEW*()*Brand_()_FERRARI*()*Movement_()_DIGITAL*()*Color_()_BLACK*()*CASE DIAMETER_()_46 MM*()*Color Case_()_BLACK*()*Segment_()_FANS', 'default'),
(16, 'Pit Crew Watch', '8', '<p>Capturing all the thrills of race day with its tire-design crown, Pit Crew adds new 3-hand bracelet models with bold links made of silicon-wrapped TR90, a high tech thermoplastic composite prized for its light weight and rich color. New designs feature graphic new stylized stripe straps suggested by an aerial view of the Abu-Dhabi Ferrari World theme park, or the Racing Shield logo on the strap upper half, mimicking the position of the shield on the sides of the racing cars.</p>', '".plugins_url("Front_images/projects/1.jpg", __FILE__).";".plugins_url("Front_images/projects/1.3.jpg", __FILE__).";".plugins_url("Front_images/projects/1.2.jpg", __FILE__).";".plugins_url("Front_images/projects/1.1.jpg", __FILE__).";', NULL, '', 'off', 5, 'on', '10', '$200.00', '$135.00', 'Condition_()_NEW*()*Brand_()_FERRARI*()*Movement_()_QUARTZ*()*Color_()_BLUE*()*CASE DIAMETER_()_44 MM*()*Color Case_()_BLUE*()*Segment_()_FANS', 'default'),
(17, 'Scuderia Ferrari chronograph', '8', 'Available from next week on our Worldwide online store for all our customers.\r\nAvailable on our US online store in the beginning of July. \r\n<p>Р В Р вЂ Р В РІР‚С™Р РЋРЎв„ўScuderiaР В Р вЂ Р В РІР‚С™Р РЋРЎС™,  Ferrari''s most classic watch line, boasts a timeless style with traditional male details, including its 44 mm case. </p>', '".plugins_url("Front_images/projects/2.jpg", __FILE__).";".plugins_url("Front_images/projects/2.1.jpg", __FILE__).";".plugins_url("Front_images/projects/2.2.jpg", __FILE__).";".plugins_url("Front_images/projects/2.3.jpg", __FILE__).";', NULL, '', 'off', 7, 'on', '10', '$550.45', '$445.00', 'Condition_()_NEW*()*Brand_()_FERRARI*()*Movement_()_CHRONOGRAPH*()*Color_()_BLACK*()*CASE DIAMETER_()_44 MM*()*Color Case_()_STAINLESS STEEL*()*Segment_()_ESSENZIALE', 'default'),
(18, 'Grand Prix Watch', '8', '<p>In 2013, Gran Premio premiered as a pinnacle family of automatic timepieces inspired by the high-performance 2005 FXX car. New quartz-powered 3-hand and chronograph models on strap and bracelet join this distinguished family. The diamond pattern on the new leather strap was inspired by the pattern on the vented steering wheel of another venerated race car.</p>', '".plugins_url("Front_images/projects/3.jpg", __FILE__).";".plugins_url("Front_images/projects/3.1.jpg", __FILE__).";".plugins_url("Front_images/projects/3.2.jpg", __FILE__).";".plugins_url("Front_images/projects/3.3.jpg", __FILE__).";', NULL, '', 'off', 11, 'on', '10', '$350.00', '$295.00', 'Condition_()_NEW*()*Brand_()_FERRARI*()*Movement_()_QUARTZ*()*Color_()_WHITE*()*CASE DIAMETER_()_45 MM*()*Color Case_()_STAINLESS STEEL*()*Segment_()_ESSENZIALE', 'default'),
(19, 'D50 Chronograph Watch', '8', '<p>Proudly invoking the past, the name of this Scuderia Ferrari watch collection pays tribute to the single-seater that brought the DriverР В Р вЂ Р В РІР‚С™Р Р†РІР‚С›РЎС›s World Championship to Maranello in 1956.\r\nThe distinctively thin 44 mm D-50 case features fluidly elongated lugs and a glare-reducing domed crystal, popular in wristwatches from that era.</p>', '".plugins_url("Front_images/projects/4.jpg", __FILE__).";".plugins_url("Front_images/projects/4.1.jpg", __FILE__).";".plugins_url("Front_images/projects/4.2.jpg", __FILE__).";".plugins_url("Front_images/projects/4.3.jpg", __FILE__).";', NULL, '', 'off', 9, 'on', '10', '$415.00', '$315.00', 'Condition_()_NEW*()*Brand_()_FERRARI*()*Movement_()_ CHRONOGRAPH*()*Color_()_YELLOW & BLACK*()*CASE DIAMETER_()_44 MM*()*Color Case_()_STAINLESS STEEL*()*Segment_()_CLASSICHE', 'default')";





    $table_name = $wpdb->prefix . "huge_it_catalogs";

    $sql_3 = "

INSERT INTO `$table_name` (`id`,`name`, `sl_height`, `sl_width`, `pause_on_hover`, `catalog_list_effects_s`, `description`, `url`, `link_target`, `param`, `sl_position`, `ordering`, `published`, `categories`, `ht_show_sorting`, `ht_show_filtering`,`album_id`, `cat_thumb`, `pagination_type`, `count_into_page`,`catalog_search`) VALUES
(8, 'Watches', 375, 600, 'on', '3', 'description2', 'url2', 'on', '1000', 'center', 1, 'on', 'Condition,Brand,Movement,Color,Case Diameter,Color Case,Segment', 'off', 'off', 1, NULL, 'show_all', '2','off')";




    $table_name = $wpdb->prefix . "huge_it_catalog_rating";

    $sql_4 = "
INSERT INTO 

`" . $table_name . "` (`id`, `value`, `prod_id`, `ip`, `date`) VALUES
(1, '5', '16', '127.0.0.1', '12.04'),
(2, '4', '17', '127.0.0.2', '12.04'),
(3, '5', '18', '127.0.0.3', '12.04'),
(4, '5', '19', '127.0.0.2', '12.044'),
(5, '1', '20', '127.0.0.5', '12.04'),
(6, '2', '21', '127.0.0.4', '12.04')";

    $table_name = $wpdb->prefix . "huge_it_catalog_reviews";


    $sql_5 = <<<query5
INSERT INTO `$table_name` (`name`, `content`, `product_id`, `spam`, `ip`, `date`) VALUES

('Daniel', 'Lorem ipsum dolor sit amet', '16', '0', '127.0.0.1', '12.01.2015'),
('Emily', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquet, massa sit amet viverra tristique, urna sapien aliquam massa, sit amet ornare odio erat eleifend quam.', '17', '0', '127.0.0.1', '12.01.2015'),
('Michael', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '18', '0', '127.0.0.1', '12.01.2015'),
('Harry', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquet, massa sit amet viverra tristique, urna sapien aliquam massa, sit amet ornare odio erat eleifend quam. In hac habitasse platea dictumst.', '19', '0', '127.0.0.1', '12.01.2015'),
('Jack', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquet, massa sit amet viverra tristique, urna sapien aliquam massa, sit amet ornare odio erat eleifend quam. In hac habitasse platea dictumst. Sed tincidunt arcu ut vestibulum lobortis.', '20', '0', '127.0.0.1', '12.01.2015'),
('Maria', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean aliquet, massa sit amet viverra tristique, urna sapien aliquam massa.', '21', '0', '127.0.0.1', '12.01.2015');

query5;


    $table_name = $wpdb->prefix . "huge_it_catalog_albums";

    $sql_6 = <<<query6
INSERT INTO `$table_name` (`name`, `catalog_album_view_mode`) VALUES

('album1', '2'),('album2', '6');

query6;

    $table_name = $wpdb->prefix . "huge_it_catalog_product_params";
    $sql_8 = <<<query8
INSERT INTO `$table_name` (`name`, `title`, `value`) VALUES
    
('ht_single_product_allow_lightbox', 'Allow Lightbox', 'on'),
('ht_single_product_allow_zooming', 'Allow Zooming', 'on'),
            
('ht_single_product_border_width', 'Product Border Width', '1'),
('ht_single_product_border_color', 'Product Border Color', 'f9f9f9'),
('ht_single_product_background_color', 'Product Background Color', 'efefef'),
('ht_single_product_mainimage_width', 'Product Image Width', '240'),
('ht_single_product_show_separator_lines', 'Product Show Separator Lines', 'on'),
            
('ht_single_product_title_font_size', 'Product Title Font Size', '24'),
('ht_single_product_title_font_color', 'Product Title Font Color', '0074A2'),
('ht_single_product_show_description', 'Product Show Description', 'on'),
('ht_single_product_description_font_size', 'Product Description Font Size', '14'),
('ht_single_product_description_font_color', 'Product Description Font Color', '000'),
            
('ht_single_product_show_thumbs', 'Product Show Thumbs', 'on'),
('ht_single_product_thumbs_width', 'Product Thumbs Width', '75'),
('ht_single_product_thumbs_height', 'Product Thumbs Height', '75'),
            
('ht_single_product_price_font_size', 'Product Price Font Size', '14'),
('ht_single_product_price_font_color', 'Product Price Font Color', 'E22828'),
('ht_single_product_market_price_font_size', 'Product Market Price Font Size', '14'),
('ht_single_product_market_price_font_color', 'Product Market Price Font Color', 'E22828'),
('ht_single_product_rating_font_size', 'Product Rating Font Size', '14'),
('ht_single_product_rating_font_color', 'Product Rating Font Color', '000000'),
            
('ht_single_product_tabs_font_color', 'Zoom Window Type', '000000'),
('ht_single_product_tabs_font_hover_color', 'Zoom Window Type', '636363'),    
    
('ht_single_product_params_tab_box_background_color', 'Zoom Window Type', 'fff'),
/*
    ('ht_single_product_params_tab_words_font_size', 'Zoom Window Type', '16'),
    ('ht_single_product_comments_tab_words_font_size', 'Zoom Window Type', '16'),
*/
('ht_single_product_params_tab_words_font_color', 'Zoom Window Type', '000'),
('ht_single_product_comments_tab_words_font_color', 'Zoom Window Type', '000'),
('ht_single_product_params_name_font_color', 'Zoom Window Type', '000'),
('ht_single_product_params_values_font_color', 'Zoom Window Type', '000'),
('ht_single_product_comments_name_font_color', 'Zoom Window Type', '000'),
('ht_single_product_comments_content_font_color', 'Zoom Window Type', '000'),
('ht_single_product_comments_submit_button_text', 'Zoom Window Type', 'Submit'),
('ht_single_product_comments_submit_button_text_font_size', 'Zoom Window Type', '14'),
('ht_single_product_comments_submit_button_text_font_color', 'Zoom Window Type', 'ffffff'),
('ht_single_product_comments_submit_button_text_font_hover_color', 'Zoom Window Type', 'ffffff'),
('ht_single_product_comments_submit_button_text_background_color', 'Zoom Window Type', '4ca6cf'),
('ht_single_product_comments_submit_button_text_background_hover_olor', 'Zoom Window Type', '21759b'),

('ht_single_product_price_text', 'ht_single_product_price_text', 'Price'),
('ht_single_product_market_price_text', 'ht_single_product_market_price_text', 'Discount Price'),
('ht_single_product_comments_text', 'ht_single_product_comments_text', 'Comments'),
('ht_single_product_parameters_text', 'ht_single_product_parameters_text', 'Parameters'),
('ht_single_product_rating_text', 'ht_single_product_rating_text', 'Rating'),
('ht_single_product_share_text', 'ht_single_product_share_text', 'Share'),
('ht_single_product_show_price', 'ht_single_product_show_price', 'on'),
('ht_single_product_show_rating', 'ht_single_product_show_rating', 'on'),
('ht_single_product_show_share_buttons', 'ht_single_product_show_share_buttons', 'on'),
('ht_single_product_show_parameters', 'ht_single_product_show_parameters', 'on'),
('ht_single_product_show_comments', 'ht_single_product_show_comments', 'on'),
('ht_single_product_tabs_border_color', 'ht_single_product_tabs_border_color', 'cccccc'),
('ht_single_product_your_name_text', 'ht_single_product_your_name_text', 'Your Name'),
('ht_single_product_your_Comment_text', 'ht_single_product_your_Comment_text', 'Your Comment'),
('ht_single_product_captcha_text', 'ht_single_product_captcha_text', 'Captcha'),
('ht_single_product_invalid_captcha_text', 'ht_single_product_invalid_captcha_text', 'Invalid Captcha');

query8;


    $admin_email_default = get_option('admin_email');

    $table_name = $wpdb->prefix . "huge_it_catalog_general_params";
    $sql_9 = <<<query9
INSERT INTO `$table_name` (`name`, `title`, `value`) VALUES

('ht_single_product_price_text', 'ht_single_product_price_text', 'Price'),
('ht_single_product_comments_text', 'ht_single_product_comments_text', 'Comments'),
('ht_single_product_parameters_text', 'ht_single_product_parameters_text', 'Parameters'),
('ht_single_product_rating_text', 'ht_single_product_rating_text', 'Rating'),
('ht_single_product_share_text', 'ht_single_product_share_text', 'Share'),
('ht_single_product_your_name_text', 'ht_single_product_your_name_text', 'Your Name'),
('ht_single_product_your_Comment_text', 'ht_single_product_your_Comment_text', 'Your Comment'),
('ht_single_product_captcha_text', 'ht_single_product_captcha_text', 'Captcha'),
('ht_single_product_invalid_captcha_text', 'ht_single_product_invalid_captcha_text', 'Invalid Captcha'),
('ht_single_product_asc_to_seller_text', 'ht_single_product_asc_to_seller_text', 'Contact Seller'),
('ht_single_product_your_mail_text', 'Your E-mail', 'Your E-mail'),
('ht_single_product_your_phone_text', 'Your Phone', 'Your Phone'),
('ht_single_product_your_message_text', 'Your Message', 'Your Message'),
('ht_catalog_general_message_to_admin', 'ht_catalog_general_message_to_admin', 'on'),
('ht_catalog_general_admin_email', 'ht_catalog_general_admin_email', '$admin_email_default'),
('ht_catalog_general_admin_email_subject', 'ht_catalog_general_admin_email_subject', 'Admin subject'),
('ht_catalog_general_admin_email_message', 'ht_catalog_general_admin_email_message', 'Message For admin {userMessage}'),
('ht_catalog_general_admin_from_text', 'ht_catalog_general_admin_from_text', '$admin_email_default'),
('ht_catalog_general_message_to_user', 'ht_catalog_general_message_to_user', 'on'),
('ht_catalog_general_user_subject', 'ht_catalog_general_user_subject', 'User subject'),
('ht_catalog_general_user_message', 'ht_catalog_general_user_message', 'Message for user'),
('ht_catalog_general_linkbutton_text', 'ht_catalog_general_linkbutton_text', 'View Product'),
('ht_single_product_show_asc_seller_button', 'ht_single_product_show_asc_seller_button', 'on'),
('ht_single_product_comments_submit_button_text', 'Zoom Window Type', 'Submit'),
('ht_single_product_asc_seller_popup_button_text', 'Zoom Window Type', 'Submit'),
('ht_single_product_asc_seller_button_text', 'ht_single_product_asc_seller_button_text', 'Contact Seller');

query9;



    $wpdb->query($sql_huge_it_catalog_products);
    $wpdb->query($sql_huge_catalogs);
    $wpdb->query($sql_huge_it_catalog_rating);
    $wpdb->query($sql_huge_it_catalog_reviews);
    $wpdb->query($sql_huge_it_catalog_asc_seller);
    $wpdb->query($sql_huge_it_catalog_albums);
    $wpdb->query($sql_huge_it_catalog_album_catalog_contact);
    $wpdb->query($sql_huge_it_catalog_general_params);

    if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_it_catalog_products")) {
        $wpdb->query($sql_2);
    }
    if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_it_catalogs")) {
        $wpdb->query($sql_3);
    }
    if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_it_catalog_rating")) {
        $wpdb->query($sql_4);
    }
    if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_it_catalog_reviews")) {
        $wpdb->query($sql_5);
    }
    if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_it_catalog_albums")) {
        $wpdb->query($sql_6);
    }
    if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_it_catalog_album_catalog_contact")) {
        $wpdb->query($sql_7);
    }
    if (!$wpdb->get_var("select count(*) from " . $wpdb->prefix . "huge_it_catalog_general_params")) {
        $wpdb->query($sql_9);
    }

    $table_name = $wpdb->prefix . "huge_it_catalog_general_params";
    $sql_update_catalog_5 = "INSERT INTO `$table_name` (`name`, `title`,`description`, `value`) VALUES
    ('ht_single_product_invalid_mail_text', 'ht_single_product_invalid_mail_text', 'ht_single_product_invalid_mail_text', 'Invalid Email')";

    $query="SELECT name FROM ".$wpdb->prefix."huge_it_catalog_general_params";
    $update_catalog_5=$wpdb->get_results($query);
    if(end($update_catalog_5)->name=='ht_single_product_asc_seller_button_text'){
        $wpdb->query($sql_update_catalog_5);
    };

    $needToUpdateProductLink = 0;
    $catalogProductsAllFieldsInArray = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "huge_it_catalog_products", ARRAY_A);
    foreach($catalogProductsAllFieldsInArray as $catalogProductsFields){
        if ($catalogProductsFields['Field'] == 'single_product_url_type'){
            $needToUpdateProductLink = 1;
        }
    }
    if($needToUpdateProductLink == 0){
        $wpdb->query("ALTER TABLE ".$wpdb->prefix."huge_it_catalog_products ADD single_product_url_type text");
        $wpdb->query("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET single_product_url_type = 'default'");

    }

    $needToUpdatePagination = 0;
    $catalogProductsAllFieldsInArray = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "huge_it_catalogs", ARRAY_A);
    foreach($catalogProductsAllFieldsInArray as $catalogProductsFields){
        if ($catalogProductsFields['Field'] == 'pagination_type'){
            $needToUpdatePagination = 1;
        }
    }
    if($needToUpdatePagination == 0){
        $wpdb->query("ALTER TABLE ".$wpdb->prefix."huge_it_catalogs ADD pagination_type text");
        $wpdb->query("UPDATE ".$wpdb->prefix."huge_it_catalogs SET pagination_type = 'show_all'");

        $wpdb->query("ALTER TABLE ".$wpdb->prefix."huge_it_catalogs ADD count_into_page text");
        $wpdb->query("UPDATE ".$wpdb->prefix."huge_it_catalogs SET count_into_page = '2'");
    }

    $needToUpdateSearch = 0;
    $catalogProductsAllFieldsInArray = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "huge_it_catalogs", ARRAY_A);
    foreach($catalogProductsAllFieldsInArray as $catalogProductsFields){
        if ($catalogProductsFields['Field'] == 'catalog_search'){
            $needToUpdateSearch = 1;
        }
    }
    if($needToUpdateSearch == 0){
        $wpdb->query("ALTER TABLE ".$wpdb->prefix."huge_it_catalogs ADD catalog_search text");
        $wpdb->query("UPDATE ".$wpdb->prefix."huge_it_catalogs SET catalog_search = 'off'");
    }


    //#############PARAMETERS NEW VERSION UPDATE#####################//
    $plugin_data = get_plugin_data( __FILE__, false, false );
    $plugin_version = $plugin_data['Version'];
    if($plugin_version > '1.3.3') {
        $catalogsParamsUpdateQuery = "SELECT * FROM ".$wpdb->prefix."huge_it_catalogs";
        $catalogsParamsUpdate = $wpdb->get_results($catalogsParamsUpdateQuery);
        foreach ($catalogsParamsUpdate as $catalogParamsUpdate){
            $categories = explode(",",$catalogParamsUpdate->categories);
            if(end($categories) == ""){
                array_pop($categories);
                $categories = implode(",",$categories);
                $query1 = $wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalogs SET categories='%s' WHERE id=%d",$categories,$catalogParamsUpdate->id );
                $wpdb->query($query1);
            }
            $productsParamsUpdateQuery = $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products WHERE catalog_id=%d",$catalogParamsUpdate->id);
            $productsParamsUpdate = $wpdb->get_results($productsParamsUpdateQuery);
            foreach ($productsParamsUpdate as $productParamsUpdate){
                $productParams = $productParamsUpdate->parameters;
                $productParams = str_replace("@@", "*()*", $productParams);
                $productParams = str_replace("@", "_()_", $productParams);
                $query = $wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET parameters='%s' WHERE id=%d",$productParams,$productParamsUpdate->id );
                $wpdb->query($query);
                //echo $query;
            }
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //Show Product


    $catalogProductsAllFieldsInArray = $wpdb->get_results("DESCRIBE " . $wpdb->prefix . "huge_it_catalog_products", ARRAY_A);
    foreach($catalogProductsAllFieldsInArray as $catalogProductsFields){
        if ($catalogProductsFields['Field'] == 'published' && $catalogProductsFields['Type'] != 'varchar(5)'){
            $wpdb->query("ALTER TABLE ".$wpdb->prefix."huge_it_catalog_products  CHANGE `published` `published` VARCHAR(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");
            $wpdb->query("UPDATE ".$wpdb->prefix."huge_it_catalog_products SET `published` = 'on'");
        }
    }


    $table_name = $wpdb->prefix . "huge_it_catalog_general_params";
    $sql_update_catalog_6 = "INSERT INTO `$table_name` (`name`, `title`, `value`) VALUES
    ('ht_catalog_general_no_search_result_text', 'ht_catalog_general_no_search_result_text',  'No product matches your request.')";

    $query="SELECT name FROM ".$wpdb->prefix."huge_it_catalog_general_params";
    $update_catalog_6=$wpdb->get_results($query);
    if(end($update_catalog_6)->name=='ht_single_product_invalid_mail_text'){
        $wpdb->query($sql_update_catalog_6);
    };


}


register_activation_hook(__FILE__, 'huge_it_catalog_activate');
$plugin_info = get_plugin_data( __FILE__, false, false );
if($plugin_info['Version'] > '1.2.1'){
    huge_it_catalog_activate();
}

function catalog_add_shortcode_popup()
{
    ?>

    <div class="clear"></div>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#hugeit_cataloginsert').on('click', function() {
                var id = jQuery('#huge_it_catalog-select option:selected').val();

                window.send_to_editor('[huge_it_catalog id="' + id + '"]');
                tb_remove();
            });
            jQuery('#hugeit_cataloginsert_album').on('click', function() {
                var id = jQuery('#huge_it_catalog-select option:selected').val();

                window.send_to_editor('[huge_it_catalog_album  id="' + id + '"]');
                tb_remove();
            });
            jQuery('#hugeit_cataloginsert_single_product').on('click', function() {
                var id = jQuery('#huge_it_catalog-select-single-product option:selected').val();

                window.send_to_editor('[huge_it_catalog_single_product  id="' + id + '"]');
                tb_remove();
            });
        });
    </script>

    <div id="huge_it_catalog" style="">
        <h3>Select Huge IT Catalogs or Huge IT Products From Catalog To Insert Into Post</h3>
        <?php
        global $wpdb;
        $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalogs order by id ASC";
        $shortcodecatalogs=$wpdb->get_results($query);
        $query = "SELECT count(*) AS count FROM `".$wpdb->prefix."huge_it_catalogs`,`".$wpdb->prefix."huge_it_catalog_products`"
            . "WHERE `".$wpdb->prefix."huge_it_catalogs`.id=`".$wpdb->prefix."huge_it_catalog_products`.catalog_id GROUP BY `".$wpdb->prefix."huge_it_catalogs`.id";
        $productCountsArray = $wpdb->get_results($query);

        $query = "SELECT * FROM ".$wpdb->prefix."huge_it_catalog_albums order by id ASC";
        $shortcodeAlbums = $wpdb->get_results($query);

        $query = "SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products order by id ASC";
        $shortcodeSingleProduct = $wpdb->get_results($query);

        $query = "SELECT * FROM " . $wpdb->prefix . "huge_it_catalog_albums,". $wpdb->prefix . "huge_it_catalog_album_catalog_contact WHERE " . $wpdb->prefix . "huge_it_catalog_album_catalog_contact.album_id=" . $wpdb->prefix . "huge_it_catalog_albums.id GROUP BY ". $wpdb->prefix . "huge_it_catalog_album_catalog_contact.album_id";
        $albumsArray = $wpdb->get_results($query);
        $query = "SELECT count(*) as count FROM " . $wpdb->prefix . "huge_it_catalog_album_catalog_contact GROUP BY album_id";
        $catalogsCountsArray = $wpdb->get_results($query);
        ?>
        <style>
            /*#####ADD POSTS POPUP###*/
            #wpadminbar,.auto-fold #adminmenu, .auto-fold #adminmenu li.menu-top, .auto-fold #adminmenuback, .auto-fold #adminmenuwrap {
                display: none;
            }

            #wpcontent {
                margin-top: -55px;
            }

            .wp-core-ui .button {margin:0px 0px 0px 10px !important;}

            #slider-unique-options-list li {
                clear:both;
                margin:10px 0px 5px 0px;
            }

            #slider-unique-options-list li label {width:130px;}

            #save-buttom {display:none;}

            h3 {
                margin:30px 0px 15px -40px;
            }



            #TB_ajaxContent {
                width: 96% !important;
                background: #f1f1f1;
                height: 88% !important;
            }

            #huge_it_slider_add_posts {
                position:relative;
                margin:0px 0px 10px -45px;
            }


            #slider-posts-tabs {
                position:relative;
                list-style:none;
                border-bottom:1px solid #999;
                height:40px;
            }

            #slider-posts-tabs  li  {
                float:left;
                margin:0px 5px 0px 5px;
            }

            #slider-posts-tabs  li a {
                display:block;
                height:30px;
                padding:9px 10px 0px 10px;
                border:1px solid #999;
                border-bottom:0px;
                text-decoration:none;
                background:#fcfcfc;
            }

            #slider-posts-tabs  li.active a {
                padding-bottom:1px;
                background:#f0f0f0;
            }

            #slider-posts-tabs-contents > li  {
                position:relative;
                width:100%;
                float:left;
                display:none;
            }

            #slider-posts-tabs-contents > li.active  {
                display:block;
            }
            #slider-posts-tabs-contents > li form {
                display: inline;
            }
            #huge-it-category-form {
                float:left;
            }

            #huge-it-categories-list {
                width:150px;
                margin:0px 10px 0px 0px;
            }

            .huge-it-insert-post-button {
                float:right;
            }

            #huge-it-description-length {
                width:60px;
            }

            #huge_it_slider_add_posts_wrap .view-type-block {
                float:right;
                margin:0px 5px 0px -10px;
            }

            #huge_it_slider_add_posts_wrap .view-type-block a {
                display:block;
                margin-left:5px;
                width:30px;
                height:30px;
                padding:1px;
                float:right;
                text-indent:-9999px;
                border:1px solid rgba(0,0,0,0);
            }

            #huge_it_slider_add_posts_wrap .view-type-block a.active {
                border:1px solid #999;
            }

            #huge_it_slider_add_posts_wrap .view-type-block a.list {
                background:url(<?php echo plugins_url("", __FILE__); ?>/images/view_list.png) center center no-repeat;
            }

            #huge_it_slider_add_posts_wrap .view-type-block a.thumbs {
                background:url(<?php echo plugins_url("", __FILE__); ?>/images/view_thumbs.png) center center no-repeat;
            }

            #huge-it-posts-list {
                position:relative;
                display:table;
                width:99%;
            }


            /*TYPE-LIST*/
            #huge-it-posts-list.list  li {
                position:relative;
                float:left;
                width:100%;
                clear:both;
                padding:10px 0px 10px 0px;
            }

            #huge-it-posts-list.list  li.hascolor {
                background:#fff;
            }

            #huge-it-posts-list.list  li.active {
                border-right:2px solid #0074a2;
            }

            #huge-it-posts-list  li input.huge-it-post-checked-0,#huge-it-posts-list  li input.huge-it-post-checked-1,#huge-it-posts-list  li input.huge-it-post-checked-2 {
                z-index:1000;
                position:absolute;
                top:0px;
                left:0px;
                width:100%;
                height:100%;
                border:0px;
                opacity:0.3;
            }

            #huge-it-posts-list  li input.huge-it-post-checked-0.active,#huge-it-posts-list  li input.huge-it-post-checked-1.active,#huge-it-posts-list  li input.huge-it-post-checked-2.active {opacity:0;}

            #huge-it-posts-list.list  li#huge-it-posts-list.list-heading {
                border-bottom:2px solid #666;
                height:30px;
                margin:0px;
                font-weight:bold;
            }



            #huge-it-posts-list.list  li > div {
                float:left;
                padding:0px 5px 0px 5px;

            }

            #huge-it-posts-list.list .huge-it-posts-list-image {
                width:100px;
                min-height:10px;
                clear:both;
            }

            #huge-it-posts-list.list .huge-it-posts-list-image img{
                width:100px;
                max-height:100px;
            }

            #huge-it-posts-list.list .huge-it-posts-list-title {width:150px;}
            #huge-it-posts-list.list .huge-it-posts-list-description {width:200px;max-height:98px;overflow:hidden;}
            #huge-it-posts-list.list .huge-it-posts-list-description *{margin:0px;padding:0px;}
            #huge-it-posts-list.list .huge-it-posts-list-link {width:100px;word-break:break-all;}
            #huge-it-posts-list.list .huge-it-posts-list-category {display:none;}


            #slider-posts-tabs-contents .recent-post-options form > div {
                height:55px;
                clear:both;
            }

            #slider-posts-tabs-contents .recent-post-options form > div.clear {height:20px;}

            #slider-posts-tabs-contents .recent-post-options form div.left {
                float:left;
            }

            #slider-posts-tabs-contents .recent-post-options form div.left.margin {
                margin-right:30px;
            }

            #slider-posts-tabs-contents .recent-post-options form div.left.less-margin {
                margin-right:10px;
            }

            #slider-posts-tabs-contents .recent-post-options form div.left.top {
                margin-top:-10px;
            }

            #slider-posts-tabs-contents .recent-post-options  label {
                display:inline-block;
                width:136px;
                display: inline-block;
                float: left;
                vertical-align: center;
            }

            #slider-posts-tabs-contents .recent-post-options  form div.left.height  label {padding-top:10px;}

            #slider-posts-tabs-contents .recent-post-options  select.categories-list {
                width:260px;
            }

            #slider-posts-tabs-contents .recent-post-options  input.number {
                width:65px;
            }

            #slider-posts-tabs-contents li .control-panel {
                margin: 10px 0px 10px 5px;
                overflow: hidden;
            }

            #slider-posts-tabs-contents li .save-slider-options{
                margin: 3px 8px 0px 5px;
            }

            /*TYPE-THUMBS*/

            #huge-it-posts-list.thumbs  li {
                position:relative;
                float:left;
                width:100px;
                height:100px;
                overflow:hidden;
                padding:5px;
                margin:7px;
                border:1px solid #666;
                border-radius:3px;
            }

            #huge-it-posts-list.thumbs  li.active {
                border:2px solid #0074a2;
                margin:6px;
            }

            #huge-it-posts-list.thumbs .huge-it-posts-list-image {
                width:100px;
                height:100px;
                overflow:hidden;
                display:table-cell;
                vertical-align:middle;
            }

            #huge-it-posts-list.thumbs .huge-it-posts-list-image img {
                width:100px;
                max-height:100px;
            }



            #huge-it-posts-list.thumbs #huge-it-posts-list-heading,
            #huge-it-posts-list.thumbs .huge-it-posts-list-title,
            #huge-it-posts-list.thumbs .huge-it-posts-list-description,
            #huge-it-posts-list.thumbs .huge-it-posts-list-link,
            #huge-it-posts-list.thumbs .huge-it-posts-list-category {display:none;}

            #huge-it-posts-list .help-message {
                position:absolute;
                top:100px;
            }

            .editimageicon {
                border:0;
                color:#2ea2cc;
                outline:none;
                display:inline;
                height: 24px;
                cursor:pointer;
                text-decoration:underline;
                padding:0 20px 0 0;
                background: url(../images/edit.png) right 8px no-repeat;
            }

            .editimageicon:hover {
                color:#0074a2;
            }

            .update-nag{
                display: none !important;
            }

        </style>
        <script type="text/javascript">
            jQuery(document).ready(function() {

                jQuery('#slider-posts-tabs li a').click(function(){
                    jQuery('#slider-posts-tabs li').removeClass('active');
                    jQuery(this).parent().addClass('active');
                    jQuery('#slider-posts-tabs-contents li').removeClass('active');
                    var liID=jQuery(this).attr('href');
                    jQuery(liID).addClass('active');
                    return false;
                });

                jQuery('#huge_it_slider_add_posts_wrap .view-type-block a').click(function(){
                    jQuery('#huge_it_slider_add_posts_wrap .view-type-block a').removeClass('active');
                    jQuery(this).addClass('active');
                    var strtype=jQuery(this).attr('href').replace('#','');
                    jQuery(this).parent().parent().parent().find("#huge-it-posts-list").removeClass('list').removeClass('thumbs');
                    jQuery(this).parent().parent().parent().find("#huge-it-posts-list").addClass(strtype);
                    return false;
                });

                jQuery('.updated').css({"display":"none"});
                <?php
                if(isset($_GET["closepop"])){
                if($_GET["closepop"] == 1){ ?>
                jQuery("#closepopup").click();
                self.parent.location.reload();
                <?php  }
                } ?>




                jQuery('#slider-posts-tabs-content-0 .huge-it-insert-post-button').on('click', function() {
                    var ID1 = jQuery('#huge-it-add-posts-params-0').val();
                    if(ID1==""){
                        alert("Please Choos Album");
                        return false;
                    }
                    else{
                        ID1 = ID1.split(';')
                        var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                        forEach( ID1, function( node ) {       //      alert( node );
                            if(node != ""){
                                window.parent.send_to_editor('[huge_it_catalog_album  id="' + node + '"]');
                            }
                        });
                        tb_remove();
                    }
                });

                jQuery('.huge-it-post-checked-0').change(function(){
                    if(jQuery(this).is(':checked')){
                        jQuery(this).addClass('active');
                        jQuery(this).parent().addClass('active');
                        jQuery(this).parent().find(".huge-it-posts-list-image input").prop('checked',true);
                    }else {
                        jQuery(this).removeClass('active');
                        jQuery(this).parent().removeClass('active');
                        jQuery(this).parent().find(".huge-it-posts-list-image input").prop('checked', false);
                    }

                    var inputval="";
                    jQuery('#huge-it-add-posts-params-0').val("");
                    jQuery('.huge-it-post-checked-0').each(function(){
                        if(jQuery(this).is(':checked')){
                            inputval+=jQuery(this).val()+";";
                        }
                    });
                    jQuery('#huge-it-add-posts-params-0').val(inputval);
                });

                jQuery('#check_all_checkbox').change(function(){
                    var inputval = "";
                    jQuery("#huge-it-posts-list li").not(":first-child").each(function(){
                        if(jQuery(this).hasClass('active')){
                            jQuery(this).removeClass('active');
                            jQuery(this).find(".huge-it-post-checked-0").removeClass('active');
                            jQuery(this).parent().find(".huge-it-posts-list-image input").prop('checked', false);
                        }else {
                            jQuery(this).addClass('active');
                            jQuery(this).find(".huge-it-post-checked-0").addClass('active');
                            jQuery(this).parent().find(".huge-it-posts-list-image input").prop('checked',true);
                            jQuery('#huge-it-add-posts-params-0').val("");
                        }
                    });
                    if(jQuery('.huge-it-posts-list-image:first-child input').is(':checked')){
                        jQuery('.huge-it-post-checked-0').each(function(){
                            inputval+=jQuery(this).val()+";";
                        });
                    }
                    jQuery('#huge-it-add-posts-params-0').val(inputval);
                });

                jQuery('#slider-posts-tabs-content-1 .huge-it-insert-post-button').on('click', function() {
                    var ID1 = jQuery('#huge-it-add-posts-params-1').val();
                    if(ID1==""){
                        alert("Please Choos Catalog");
                        return false;
                    }
                    else{
                        ID1 = ID1.split(';')
                        var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                        forEach( ID1, function( node ) {       //      alert( node );
                            if(node != ""){
                                window.parent.send_to_editor('[huge_it_catalog  id="' + node + '"]');
                            }
                        });
                        tb_remove();
                    }
                });

                jQuery('.huge-it-post-checked-1').change(function(){
                    if(jQuery(this).is(':checked')){
                        jQuery(this).addClass('active');
                        jQuery(this).parent().addClass('active');
                    }else {
                        jQuery(this).removeClass('active');
                        jQuery(this).parent().removeClass('active');
                    }

                    var inputval="";
                    jQuery('#huge-it-add-posts-params-1').val("");
                    jQuery('.huge-it-post-checked-1').each(function(){
                        if(jQuery(this).is(':checked')){
                            inputval+=jQuery(this).val()+";";
                        }
                    });
                    jQuery('#huge-it-add-posts-params-1').val(inputval);
                });

                jQuery('#slider-posts-tabs-content-2 .huge-it-insert-post-button').on('click', function() {
                    var ID1 = jQuery('#huge-it-add-posts-params-2').val();
                    if(ID1==""){
                        alert("Please Choos Product");
                        return false;
                    }
                    else{
                        ID1 = ID1.split(';')
                        var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                        forEach( ID1, function( node ) {       //      alert( node );
                            if(node != ""){
                                window.parent.send_to_editor('[huge_it_catalog_single_product  id="' + node + '"]');
                            }
                        });
                        tb_remove();
                    }
                });



                jQuery('.huge-it-post-checked-2').change(function(){
                    if(jQuery(this).is(':checked')){
                        jQuery(this).addClass('active');
                        jQuery(this).parent().addClass('active');
                    }else {
                        jQuery(this).removeClass('active');
                        jQuery(this).parent().removeClass('active');
                    }

                    var inputval="";
                    jQuery('#huge-it-add-posts-params-2').val("");
                    jQuery('.huge-it-post-checked-2').each(function(){
                        if(jQuery(this).is(':checked')){
                            inputval+=jQuery(this).val()+";";
                        }
                    });
                    jQuery('#huge-it-add-posts-params-2').val(inputval);
                });

                jQuery("#huge_it_catalogs-select").change(function(){
                    jQuery("a[href='#slider-posts-tabs-content-2'").click();
                });

            });

        </script>

        <div id="huge_it_slider_add_posts" style="">
            <div id="huge_it_slider_add_posts_wrap">
                <ul id="slider-posts-tabs">
                    <li class="active" ><a href="#slider-posts-tabs-content-1"><?php echo __("Catalogs"); ?></a></li>
                    <li><a href="#slider-posts-tabs-content-2"><?php echo __("Products","product-catalog"); ?></a></li>
                </ul>
                <ul id="slider-posts-tabs-contents">
                    <li id="slider-posts-tabs-content-1"  class="active">
                        <!-- STATIC POSTS -->
                        <div class="control-panel">
                            <button class='save-slider-options button-primary huge-it-insert-post-button' id='huge-it-insert-post-button-top'><?php echo __("Insert Posts"); ?></button>
                            <div class="view-type-block">
                                <a class="view-type list active" href="#list"><?php echo __("View List","product-catalog"); ?></a>
                                <a class="view-type thumbs" href="#thumbs"><?php echo __("View List","product-catalog"); ?></a>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <ul id="huge-it-posts-list" class="list">
                            <li id="huge-it-posts-list-heading" class="hascolor">
                                <div class="huge-it-posts-list-image">Image</div>
                                <div class="huge-it-posts-list-title">Title</div>
                                <div class="huge-it-posts-list-description">
                                    Products
                                </div>
                            </li>
                            <?php
                            $strx=1;
                            foreach($shortcodecatalogs as $productKey => $shortcodecatalog){
                                if($shortcodecatalog->id != ""){
                                    $strx++;
                                    $hascolor="";
                                    if($strx%2==0){ $hascolor='class="hascolor"'; }

                                    $imgUrl = explode(";;;", $shortcodecatalog->cat_thumb);

//                                                          var_dump($imgUrl[0]);
                                    if($imgUrl[0] == ""){
                                        $thumbnail = plugins_url("/images/noimage.png", __FILE__);
                                    }
                                    else{ $thumbnail = $imgUrl[0]; }
                                    ?>


                                    <li <?php echo $hascolor; ?>>
                                        <input type="checkbox" class="huge-it-post-checked-1"  value="<?php echo $shortcodecatalog->id; ?>">
                                        <div class="huge-it-posts-list-image">
                                            <img src="<?php echo $thumbnail; ?>"  width="100" height="80" />
                                        </div>
                                        <div class="huge-it-posts-list-title">
                                            <?php echo	$shortcodecatalog->name; ?>
                                        </div>
                                        <div class="huge-it-posts-list-description">
                                            (<?php if($productCountsArray[$productKey]->count == "") echo 0;else echo $productCountsArray[$productKey]->count; ?>)
                                        </div>
                                    </li>
                                    <?php
                                }
                            }   ?>
                        </ul>
                        <input id="huge-it-add-posts-params-1" type="hidden" name="popupposts" value="" />
                        <div class="clear"></div>
                        <button class='save-slider-options button-primary huge-it-insert-post-button' id='huge-it-insert-post-button-bottom'><?php echo __("Insert Posts","product-catalog"); ?></button>
                    </li>

                    <li id="slider-posts-tabs-content-2" class="recent-post-options">
                        <div class="control-panel">

                            <?php
                            if(isset($_POST["huge_it_catalog_id"])){
                                $id=absint($_POST["huge_it_catalog_id"]);
                                ?>
                                <script>
                                    var tab_key = 1;
                                    jQuery("#slider-posts-tabs li").each(function(){
                                        if(tab_key != 3){
                                            jQuery(this).removeClass("active");
                                        }
                                        else{ jQuery(this).addClass("active"); }
                                        tab_key = tab_key + 1;
                                    });

                                    jQuery("#slider-posts-tabs-contents li").each(function(){
                                        jQuery(this).removeClass("active");
                                        jQuery("#slider-posts-tabs-content-2").addClass("active");
                                    });
                                </script>
                            <?php }
                            else { $id="1"; }
                            $container_id = 'huge_it_catalog';
                            ?>
                            <form action="?page=catalogs_huge_it_catalog&task=catalog_add_shortcode_popup&TB_iframe=1&width=400&inlineId=<?php echo $container_id; ?>&htslider_id=<?php echo $id; ?>" method="post" name="adminForm" id="adminForm">
                                <?php

                                $query = $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products WHERE catalog_id= %d", $id);
                                $productsInArray = $wpdb->get_results($query);

                                if (count($shortcodecatalogs)) {
                                    echo "<select id='huge_it_catalogs-select' onchange='this.form.submit();' name='huge_it_catalog_id'>";
                                    ?>
                                    <option value="">Select Category</option>
                                    <?php
                                    foreach ($shortcodecatalogs as $catalog) {
                                        $selected='';
                                        if($catalog->id == $_POST["huge_it_catalog_id"]){$selected='selected="selected"';}
                                        echo "<option ".$selected." value='".$catalog->id."'>".$catalog->name."</option>";
                                    }
                                    echo "</select>";
                                }
                                else {
                                    echo __("No Products Found","product-catalog");
                                }

                                ?>
                            </form>
                            <button class='save-slider-options button-primary huge-it-insert-post-button' id='huge-it-insert-post-button-top'><?php echo __("Insert Posts");?></button>
                            <div class="view-type-block">
                                <a class="view-type list active" href="#list"><?php echo __("View List","product-catalog"); ?></a>
                                <a class="view-type thumbs" href="#thumbs"><?php echo __("View List","product-catalog"); ?></a>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <ul id="huge-it-posts-list" class="list">
                            <li id="huge-it-posts-list-heading" class="hascolor">
                                <div class="huge-it-posts-list-image">Image</div>
                                <div class="huge-it-posts-list-title">Title</div>
                                <div class="huge-it-posts-list-description">Images</div>
                            </li>
                            <?php
                            $strx=1;
                            foreach($productsInArray as $product){
                                if($product->id != ""){
                                    $strx++;
                                    $hascolor="";
                                    if($strx%2==0){$hascolor='class="hascolor"';}
                                    $imgUrl = explode(";", $product->image_url);
                                    $imagesCount = count($imgUrl);
                                    ?>

                                    <li <?php echo $hascolor; ?>>
                                        <input type="checkbox" class="huge-it-post-checked-2"  value="<?php echo $product->id; ?>">
                                        <div class="huge-it-posts-list-image">
                                            <img src="<?php echo $imgUrl[0]; ?>"  width="100" height="80" />
                                        </div>
                                        <div class="huge-it-posts-list-title">
                                            <?php echo $product->name; ?>
                                        </div>
                                        <div class="huge-it-posts-list-description">
                                            (<?php echo $imagesCount; ?>)
                                        </div>
                                    </li>
                                    <?php
                                }
                            }   ?>
                        </ul>
                        <input id="huge-it-add-posts-params-2" type="hidden" name="popupposts" value="" />
                        <div class="clear"></div>
                        <button class='save-slider-options button-primary huge-it-insert-post-button' id='huge-it-insert-post-button-bottom'><?php echo __("Insert Posts","product-catalog");?></button>
                    </li>
            </div>
        </div>

    </div>
    <?php
}
