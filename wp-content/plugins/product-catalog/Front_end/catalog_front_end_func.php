<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function showPublishedcatalogs_1($id)
{
 global $wpdb;
 // var_dump($GLOBALS['version']);exit;
// var_dump($id);
 
        $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalog_general_params";
        $rowspar3 = $wpdb->get_results($query);

        $paramssld3 = array();
        foreach ($rowspar3 as $rowpar3) {
            $key3 = $rowpar3->name;
            $value3 = $rowpar3->value;
            $paramssld3[$key3] = $value3;
        }
            
	$query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products WHERE catalog_id = '%d' and published='on' order by ordering ASC",$id);
        $images=$wpdb->get_results($query);
        
	$query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalogs WHERE id = '%d' order by id ASC",$id);
        $catalog=$wpdb->get_results($query);
			   
//        $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalog_params";
//        $rowspar = $wpdb->get_results($query);
        
//        $paramssld = array();
//        foreach ($rowspar as $rowpar) {
//            $key = $rowpar->name;
//            $value = $rowpar->value;
//            $paramssld[$key] = $value;
//        }
//        var_dump($paramssld[$key]);exit;
        
            $getCatalogsFromAlbum=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_album_catalog_contact,".$wpdb->prefix."huge_it_catalogs WHERE ".$wpdb->prefix."huge_it_catalog_album_catalog_contact.album_id = '%d' AND ".$wpdb->prefix."huge_it_catalog_album_catalog_contact.catalog_id=".$wpdb->prefix."huge_it_catalogs.id order by ordering ASC",$id);
            $catalogsFromAlbumArray=$wpdb->get_results($getCatalogsFromAlbum);
            
        if(isset($_GET['single_prod_id'])){
            
            $catalog_id = $id;
            $id = absint($_GET['single_prod_id']);
            
            $getProduct=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products WHERE id = '%d' order by ordering ASC",$id);
            $productArray=$wpdb->get_results($getProduct);
                        
            
            if($productArray[0]->catalog_id != $catalog_id){  }
            else{
                $getRatings=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_rating WHERE prod_id = '%d'",$id);
            $ratingsArray=$wpdb->get_results($getRatings);
            
            $getReviews=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_reviews WHERE product_id = '%d'",$id);
            $reviewsArray=$wpdb->get_results($getReviews);
            
            $getSpams = $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_reviews WHERE spam = '%d'",1);
            $spamsArray = $wpdb->get_results($getSpams);
//            var_dump($spamsArray);
            
            $spamReviewsArray = array();
            foreach ($spamsArray as $spamReview) {
                if($spamReview->spam != 0) { $spamReviewsArray[] = $spamReview->ip; }
            }
//            var_dump($spamReviewsArray);
//            $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalog_product_params";
//            $rowspar = $wpdb->get_results($query);
            $paramssld = array();
            $paramssld = "";
//            foreach ($rowspar as $rowpar) {
//                $key = $rowpar->name;
//                $value = $rowpar->value;
//                $paramssld[$key] = $value;
//            }
            
//            $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalog_params";
//            $rowspar2 = $wpdb->get_results($query);

            $paramssld2 = array();
//            foreach ($rowspar2 as $rowpar2) {
//                $key2 = $rowpar2->name;
//                $value2 = $rowpar2->value;
//                $paramssld2[$key2] = $value2;
//            }
            
            $paramssld1 = "";
            $paramssld2 = "";
            
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            $paramssld4 = array();
            if ( is_plugin_active( 'product-catalog-releated-products/product-catalog-releated-products.php' ) ){
                $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalog_related_params";
                $rowspar4 = $wpdb->get_results($query);

                foreach ($rowspar4 as $rowpar4) {
                    $key4 = $rowpar4->name;
                    $value4 = $rowpar4->value;
                    $paramssld4[$key4] = $value4;
                }
            }
            
            $captchaFirstNum = rand(1,9);
            $captchaSecondNum = rand(1,9);
            $captcha_val = $captchaFirstNum + $captchaSecondNum;
            $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products  SET published_in_sl_width = '%s'", $captcha_val));
//            var_dump($paramssld4);exit;
            
            if(!(function_exists("show_related_products"))){
                function show_related_products($productId, $carousel_vertical, $show_arrows, $show_pager, $productArray){
                global $wpdb;
                $relatedProductsArray=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products WHERE catalog_id = '%d' AND `id` NOT IN ('$productId') order by ordering ASC", $productArray->catalog_id));
            ?>
                <ul class="huge-it-related-carousel <?php echo $carousel_vertical; ?>"
                    huge-it-carousel-horizontal-li-width=1
                    huge-it-carousel-horizontal-li-height="1"
                    huge-it-carousel-vertical-li-width=1
                    huge-it-single-prod-width=1
                >

                   <div class="cycle-prev"></div>
                   <div class="cycle-next"></div>
                   <?php
                       foreach ($relatedProductsArray as $singleRelatedProduct){ 
                           $related_url = explode(';', $singleRelatedProduct->image_url);
                           $price = $singleRelatedProduct->price;
                           $discountPrice = $singleRelatedProduct->market_price;
                           if($singleRelatedProduct->single_product_url_type == "default"){
                                $page_link = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
                                if (strpos(get_permalink(),'/?') !== false) { $product_page_link = get_permalink()."&single_prod_id=$singleRelatedProduct->id"; } else { if (strpos(get_permalink(),'/') !== false) { $product_page_link = get_permalink()."?single_prod_id=$singleRelatedProduct->id"; } else { $product_page_link = get_permalink()."/?single_prod_id=$singleRelatedProduct->id"; } }
                            }
                            else{ $product_page_link = $singleRelatedProduct->single_product_url_type; }
                   ?>
                   <!--<a href="<?php echo $product_page_link; ?>" <?php echo ' target="_blank"'; ?>></a>-->
                        <li>
                            <a href="<?php echo $product_page_link; ?>" <?php echo ' target="_blank"'; ?>>
                                <div class="catalog-related-item-block">
                                    <img src='<?php echo $related_url[0]; ?>' alt='img' />
                                </div>
                                <div class="catalog-related-caption-block" style="" >
                                    <span class="catalog-related-caption" >
                                        <p><?php echo $singleRelatedProduct->name; ?></p>
                                        <p><?php  if($discountPrice == "") { echo $price; } else { echo " ".$discountPrice; } ?></p>
                                    </span>
                                </div>
                            </a>
                        </li>
              <?php } ?>
                </ul>

      <?php     }
            }
                return html_single_product_page($productArray, $paramssld, $paramssld2, $paramssld3, $paramssld4, $ratingsArray, $reviewsArray, $spamReviewsArray, $captchaFirstNum, $captchaSecondNum, $captcha_val);
            }
            
        }
        else{
            $paramssld = "";
            if(isset($_GET['asc_seller_product_id'])){
                return front_end_ask_seller();
            }
            else{
                return front_end_catalog($images, $paramssld, $paramssld3, $catalog, $catalogsFromAlbumArray);
            }
        }

}

function show_catalogs_single_product($id){

 global $wpdb;
// var_dump($id);exit;
            if(isset($_GET['single_prod_id'])){
                $id = absint($_GET['single_prod_id']);
            }
            $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalog_general_params";
            $rowspar3 = $wpdb->get_results($query);

            $paramssld3 = array();
            foreach ($rowspar3 as $rowpar3) {
                $key3 = $rowpar3->name;
                $value3 = $rowpar3->value;
                $paramssld3[$key3] = $value3;
            }
        
            $getRatings=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_rating WHERE prod_id = '%d'",$id);
            $ratingsArray=$wpdb->get_results($getRatings);
            
            $getReviews=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_reviews WHERE product_id = '%d'",$id);
            $reviewsArray=$wpdb->get_results($getReviews);
            
            $getProduct=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products WHERE id = '%d' order by ordering ASC",$id);
            $productArray=$wpdb->get_results($getProduct);
            
            $getCatalogsFromAlbum=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_album_catalog_contact,".$wpdb->prefix."huge_it_catalogs WHERE ".$wpdb->prefix."huge_it_catalog_album_catalog_contact.album_id = '%d' AND ".$wpdb->prefix."huge_it_catalog_album_catalog_contact.catalog_id=".$wpdb->prefix."huge_it_catalogs.id order by ordering ASC",$id);
            $catalogsFromAlbumArray=$wpdb->get_results($getCatalogsFromAlbum);
            
            $getSpamReviews="SELECT ip FROM ".$wpdb->prefix."huge_it_catalog_reviews WHERE spam = '1'";
            $spamReviewsArray = $wpdb->get_results($getSpamReviews);
            
//            var_dump($spamReviewsArray);exit;
//            $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalog_product_params";
//            $rowspar = $wpdb->get_results($query);
            $paramssld = array();
//            foreach ($rowspar as $rowpar) {
//                $key = $rowpar->name;
//                $value = $rowpar->value;
//                $paramssld[$key] = $value;
//            }
            
//            $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalog_params";
//            $rowspar2 = $wpdb->get_results($query);

            $paramssld2 = array();
            $paramssld2 = "";
            $paramssld = "";
//            foreach ($rowspar2 as $rowpar2) {
//                $key2 = $rowpar2->name;
//                $value2 = $rowpar2->value;
//                $paramssld2[$key2] = $value2;
//            }
            
            $captchaFirstNum = rand(0,9);
            $captchaSecondNum = rand(0,9);
            $captcha_val = $captchaFirstNum + $captchaSecondNum;
            $captchaValues = $captchaFirstNum.",".$captchaSecondNum;
            $wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."huge_it_catalog_products  SET published_in_sl_width = '%s'", $captchaValues));
            
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                $paramssld4 = array();
            if ( is_plugin_active( 'product-catalog-releated-products/product-catalog-releated-products.php' ) ){
                $query="SELECT * FROM ".$wpdb->prefix."huge_it_catalog_related_params";
                $rowspar4 = $wpdb->get_results($query);

                foreach ($rowspar4 as $rowpar4) {
                    $key4 = $rowpar4->name;
                    $value4 = $rowpar4->value;
                    $paramssld4[$key4] = $value4;
                }
            }
            
            if(!(function_exists("show_related_products"))){
                function show_related_products($productId, $carousel_vertical, $show_arrows, $show_pager, $productArray){
                global $wpdb;
                $relatedProductsArray=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_it_catalog_products WHERE catalog_id = '%d' AND `id` NOT IN ('$productId') order by ordering ASC", $productArray->catalog_id));
            ?>
                <ul class="huge-it-related-carousel <?php echo $carousel_vertical; ?>"
                    huge-it-carousel-horizontal-li-width=1
                    huge-it-carousel-horizontal-li-height="1"
                    huge-it-carousel-vertical-li-width=1
                    huge-it-single-prod-width=1
                >

                   <div class="cycle-prev"></div>
                   <div class="cycle-next"></div>
                   <?php
                       foreach ($relatedProductsArray as $singleRelatedProduct){ 
                           $related_url = explode(';', $singleRelatedProduct->image_url);
                           $price = $singleRelatedProduct->price;
                           $discountPrice = $singleRelatedProduct->market_price;
                           if($singleRelatedProduct->single_product_url_type == "default"){
                                $page_link = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
                                if (strpos(get_permalink(),'/?') !== false) { $product_page_link = get_permalink()."&single_prod_id=$singleRelatedProduct->id"; } else { if (strpos(get_permalink(),'/') !== false) { $product_page_link = get_permalink()."?single_prod_id=$singleRelatedProduct->id"; } else { $product_page_link = get_permalink()."/?single_prod_id=$singleRelatedProduct->id"; } }
                            }
                            else{ $product_page_link = $singleRelatedProduct->single_product_url_type; }
                   ?>
                   <!--<a href="<?php echo $product_page_link; ?>" <?php echo ' target="_blank"'; ?>></a>-->
                        <li>
                            <a href="<?php echo $product_page_link; ?>" <?php echo ' target="_blank"'; ?>>
                                <div class="catalog-related-item-block">
                                    <img src='<?php echo $related_url[0]; ?>' alt='img' />
                                </div>
                                <div class="catalog-related-caption-block" style="" >
                                    <span class="catalog-related-caption" >
                                        <p><?php echo $singleRelatedProduct->name; ?></p>
                                        <p><?php  if($discountPrice == "") { echo $price; } else { echo " ".$discountPrice; } ?></p>
                                    </span>
                                </div>
                            </a>
                        </li>
              <?php } ?>
                </ul>
                
                <?php if($show_pager == "on"){ ?>
<!--                          <div class="pager-block">
                              <div class="cycle-pager" id="pager_<?php echo $productId; ?>" ></div>
                          </div>-->
                <?php } ?>
      <?php }
            }
            
            return html_single_product_page($productArray, $paramssld, $paramssld2, $paramssld3, $paramssld4, $ratingsArray, $reviewsArray, $spamReviewsArray, $captchaFirstNum, $captchaSecondNum, $captcha_val);

}

?>






