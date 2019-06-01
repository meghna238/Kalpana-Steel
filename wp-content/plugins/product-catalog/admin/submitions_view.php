<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if (function_exists('current_user_can'))
    if (!current_user_can('manage_options')) {
        die(__('Access Denied',"product-catalog"));
    }
if (!function_exists('current_user_can')) {
    die(__('Access Denied',"product-catalog"));
}

function html_show_submitions($submitionsArray, $submitionsCount) { $keyForBackground = 1;
if(isset($_POST["page_number"])){
    $page_number = absint($_POST["page_number"]);
    $last_or_not = $submitionsCount[0]->all_count/($page_number * 50);
    if($last_or_not > 1){ $visible_submitions = ($_POST["page_number"] * 50-49)."-".$_POST["page_number"] * 50 ; }
    else{
        $max_count = $submitionsCount[0]->all_count;
        $visible_submitions =  ($_POST["page_number"] * 50-49)."-".$max_count;
    }
}
else{ $visible_submitions = "1-50"; } ?>

<div class="wrap">
     <?php $path_site2 = plugins_url("../images/", __FILE__); ?>
    <?php $path_site2 = plugins_url("../images", __FILE__);
    require "product-catalog-admin-free-banner.php";
	?>

    <div style="clear:both;"></div>
    <div id="poststuff">
        <div id="hugeit_messages_page">
            <div class="search_block">
                <form action="admin.php?page=huge_it_catalog_submitions_page" method="POST">
                    <input type="text" name="search_events_by_title" value="" class="search_input" placeholder="Search..." onchange="clear_serch_texts()">
                    <input  class="button" type="submit" value="Search" onclick="//document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\'; document.getElementById(\'admin_form\').submit();" >
                </form>
            </div>
            <div id="hugeit_top_controls">
                <ul class="controls-list">
                        <li class="select">
                                <input type="checkbox" name="all" />
                                <select class="">
                                        <option value="none"><?php echo __("None","product-catalog");?></option>
                                        <!--<option value="all">All</option>-->
                                        <option value="read"><?php echo __("Read","product-catalog");?></option>
                                        <option value="unread"><?php echo __("Unread","product-catalog");?></option>

                                </select>
                        </li>
                        <li class="spam"><a href="#" title="Mark as spam"><?php echo __("Spam","product-catalog");?></a></li>
                        <li class="trash"><a href="#"><?php echo __("Trash","product-catalog");?></a></li>
                        <li class="refrash"><a href="#" onclick="window.location.reload();" ><?php echo __("Refrash","product-catalog");?></a></li>
                </ul>
                <div class="page-navigation">
                        <span class="count"><?php if($submitionsCount[0]->all_count < 51 ){ echo "1-".$submitionsCount[0]->all_count." From ".$submitionsCount[0]->all_count; } else { echo $visible_submitions." From ".$submitionsCount[0]->all_count; } ?></span>
                        <div class="buttons">
                            <form action="admin.php?page=huge_it_catalog_submitions_page" method="POST">
                                <a href="#prev" class="prev" value="-1" ><?php echo __("Prev","product-catalog");?></a>
                                <a href="#next" class="next" value="1" ><?php echo __("Next","product-catalog");?></a>
                                <input type="hidden" name="page_number" class="page_number" value="<?php if(isset($_POST["page_number"])) echo esc_attr($_POST["page_number"]);else echo 1; ?>" />
                            </form>
                        </div>
                </div>
            </div>
            <table class="wp-list-table widefat fixed pages" style="width:95%">
                <thead>
                     <tr>
                        <th scope="col" id="id" style="width:5%" ><span></span><span class="sorting-indicator"></span></th>
                        <th scope="col" id="name" style="width:24%" ><span><?php echo __("Customer Name","product-catalog");?></span><span class="sorting-indicator"></span></th>
                        <th scope="col" id="name" style="width:24%" ><span><?php echo __("None","product-catalog");?></span><span class="sorting-indicator"></span></th>
                        <th scope="col" id="prod_count"  style="width:24%;" ><span><?php echo __("Customer Email","product-catalog");?></span><span class="sorting-indicator"></span></th>
                        <th scope="col" id="prod_count"  style="width:24%;" ><span><?php echo __("Customer Phone","product-catalog");?></span><span class="sorting-indicator"></span></th>
                        <th style="width:15%" class="manage-column column-date sorted asc"><a href=""><span><?php echo __("Product Name","product-catalog");?></span></a></th>
                     </tr>
                </thead>
<!--				<tbody>

<!---->			
<tbody id="the-comment-list" data-wp-lists="list:comment">
<?php foreach ($submitionsArray as $submition) { ?>
    <tr id="comment-<?php echo $submition->id; ?>" class="comment even thread-even <?php if($submition->read_or_not == 1){ echo "read"; } else { echo "unread"; } ?> depth-<?php echo $keyForBackground; if($keyForBackground%2 == 0) echo " alt"; ?> ">
        <th scope="row" class="check-column">
            <label class="screen-reader-text" for="cb-select-<?php echo $submition->id; ?>"><?php echo __("Select Submission","product-catalog");?></label>
            <input id="cb-select-<?php echo $keyForBackground; ?>" type="checkbox" name="check_comments" value="<?php echo $submition->id; ?>">
        </th>
        <td class="author column-author user-name">
            <input value="<?php echo esc_html(stripslashes($submition->user_name)); ?>" id_for_edit="<?php echo $submition->id; ?>" readonly="readonly" />
            <p class='spamer' <?php  if($submition->spam != 1) echo "style= 'display: none'"; ?>><?php echo __("None","product-catalog");?>Spam</p>
        </td>
        <td class="comment column-comment">
            <div class="comment-author">
                <strong>
                    <?php echo $submition->user_phone; ?>
                </strong>
                <a href="#"></a>
            </div>
            <div class="submitted-on"><?php echo __("Submitted on","product-catalog");?> <a><?php echo "  ".$submition->date; ?></a></div>
                <div class="submition_message" id_for_edit="<?php echo $submition->id; ?>" readonly >
                    <?php
                      echo esc_html(stripslashes($submition->user_massage));
                    ?>
                </div>
            <div id="inline-1" class="hidden">
            <textarea class="comment" rows="1" cols="1" readonly="readonly" ><?php echo esc_html(stripslashes($submition->user_name)); ?></textarea>
            <div class="author-email"></div>
            <div class="author"><?php echo esc_html(stripslashes($submition->user_email)); ?></div>
            <div class="comment_status">1</div>
            </div>
            <div class="row-actions">
                <span class="edit" value="<?php echo $submition->id; ?>">  | <a href="admin.php?page=huge_it_catalog_submitions_page&id=<?php echo $submition->id; ?>&task=show_message"><?php echo __("Edit","product-catalog");?></a></span>
                <span class="spam" value="<?php echo $submition->id; ?>" style='<?php  if($submition->spam == 1) { echo "display: none"; } ?>'>  | 
                    <a class="vim-s vim-destructive" title="Mark this comment as spam"><?php echo __("Spam","product-catalog");?></a>
                </span>
                <span class="not_spam" value="<?php echo $submition->id; ?>" style='<?php  if($submition->spam != 1) { echo "display: none"; } ?>'>  | 
                    <a class="vim-s vim-destructive" title="Reove this comment From spam"><?php echo __("Not Spam","product-catalog");?></a>
                </span>
                <span class="trash" value="<?php echo $submition->id; ?>"> | 
                    <a class="delete vim-d vim-destructive" title="Move this comment to the trash"><?php echo __("Trash","product-catalog");?></a>
                </span>
            </div>
        </td>
        <td class="author column-author user_email">
            <input value="<?php echo esc_html(stripslashes($submition->user_email)); ?>" id_for_edit="<?php echo $submition->id; ?>" readonly="readonly" />
        </td>
        <td class="author column-author user_phone">
            <input value="<?php echo esc_html(stripslashes($submition->user_phone)); ?>" id_for_edit="<?php echo $submition->id; ?>" readonly="readonly" />
            
        </td>
        <td class="response column-response">
            <div class="response-links">
                <span class="post-com-count-wrapper">
                    <a><?php echo $submition->product_name; ?></a>
                </span>
            </div>
        </td>
    </tr>
<?php $keyForBackground++; } ?>
</table>
             <input type="hidden" name="oreder_move" id="oreder_move" value="" />
             <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo esc_attr($_POST['asc_or_desc']);?>"  />
             <input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo esc_attr($_POST['order_by']);?>"  />
             <input type="hidden" name="saveorder" id="saveorder" value="" />


            <!--</form>-->
        </div>
    </div>
</div>


<script>
    jQuery(window).load(function(){                                 //    var i = 0;
        jQuery("#the-comment-list tr.comment").each(function(){     //    i++;    alert("comment" + i);
            jQuery(this).find(".message-block tr").each(function(){
                var this_class = jQuery(this).attr("class");        //    alert(this_class);
                if( this_class !== "message-text"){
                    jQuery(this).closest(".submition_message").css({ "opacity" : 1 });
                    jQuery(this).remove();
                }
            });
        });
    });
    jQuery(document).ready(function(){
            jQuery(".submition_message").each(function(){
                
            });
    });
</script>
<?php } ?>

<?php

function html_huge_it_catalog_show_message($messageInArray, $submitionsCount){       //var_dump($messageInArray); exit; ?>

<?php
    if(isset($_GET["id"])){
        $current_page_id   = absint($_GET["id"]);
        
        $max_count = count($submitionsCount);
        $myNum = 1;
        foreach($submitionsCount AS $num => $submition){
            if($submition->id == $current_page_id){ $myNum = $num + 1; $custom_id = $num; }
        }
        
        $current_page_url  = $_SERVER["REQUEST_URI"];
        $current_page_url  = strstr($current_page_url, 'admin.php');
//        $previous_page_id  = $submitionsCount[$custom_id - 1]->id;
        
        if (array_key_exists($custom_id - 1,$submitionsCount)){
            $previous_page_id  = $submitionsCount[$custom_id - 1]->id;
        }else{ $previous_page_id  = $submitionsCount[0]->id; }
        
        if (array_key_exists($custom_id + 1,$submitionsCount)){
            $next_page_id  = $submitionsCount[$custom_id + 1]->id;
        }else{ $next_page_id  = $submitionsCount[0]->id; }
        //    var_dump($next_page_id)." ";
        
        $next_page_url     = str_replace($current_page_id,$next_page_id,    $current_page_url);
        $previous_page_url = str_replace($current_page_id,$previous_page_id,$current_page_url);
    }
?>
<div class="wrap">
    <div id="poststuff">
        <div id="hugeit_messages_page">
            <h2><?php echo __("The Customer is Asking:","product-catalog");?></h2>
            <!--<form method="post"  onkeypress="doNothing()" action="admin.php?page=hugeit_contacts_huge_it_contact" id="admin_form" name="admin_form">-->
            <div id="hugeit_top_controls">
                <ul class="controls-list" style="overflow: hidden;margin: 3px 0;">
                        <li class="back"><a href="admin.php?page=huge_it_catalog_submitions_page" title="Mark as spam"><?php echo __("Spam","product-catalog");?></a></li>
                        <li class="spam" value="<?php echo $messageInArray[0]->id; ?>" need_to_reload="yes" ><a href="#" title="Mark as spam"><?php echo __("Spam","product-catalog");?></a></li>
                        <li class="trash" value="<?php echo $messageInArray[0]->id; ?>" need_to_reload="yes" ><a href="#"><?php echo __("Trash","product-catalog");?></a></li>
                </ul>
                <div class="page-navigation">
                        <span class="count"><?php echo "Submition ". $myNum . " Of " . $max_count; ?></span>
                        <div class="buttons">
                                <?php
//                                var_dump($previous_page_url)." ";
//                                var_dump($next_page_url)." ";
                                    if($myNum > 1){
                                        echo "<a href='".$previous_page_url."' class='prev_message' >".__('Prev')."</a>";
                                    }
//                                  
                                    if($myNum < $max_count){
                                        echo "<a href='".$next_page_url."' class='next_message' >".__('Next')."</a>";
                                    }
                                ?>
                        </div>
                </div>
            </div>
            <div style="clear: both;"></div>
            <div id="hugeit_messages_content">
                <p>
                    <?php
                        echo $messageInArray[0]->user_massage;
                    ?>
                </p>
            </div>
            
        </div>
    </div>
</div>
    
    
<?php } ?>

<style>
#hugeit_messages_content{
        background-color: #ffffff;
        border: 1px solid #ccc;
        border-radius: 10px;
        width: 95%;
}

#hugeit_messages_content p, #hugeit_messages_content table tr td{
    padding-left: 12px;
}

#hugeit_top_controls {
       width: 95%;
       height: 30px;
       display: inline-block;
       margin: 6px 0px 0px 0px;
       padding: 0;
    /*margin: 5px 0px 0px 0px;*/
}

#hugeit_top_controls .controls-list {
       height: 30px;
       display: inline-block;
       margin: 0;
       padding: 0;
    /*margin: 5px 0px 0px 0px;*/
}

#hugeit_top_controls .controls-list li {
        position:relative;
        float:left;
        display:block;
        margin:0px 1px 0px 0px;
}

#hugeit_top_controls .controls-list li.select {
        margin:0px 20px 0px 0px;
        border-radius:3px;
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -473px no-repeat #fafafa;
}

#hugeit_top_controls .controls-list li.select:hover {
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -973px no-repeat #fefefe;
}

#hugeit_top_controls .controls-list li.select input {
        position:absolute;
        top:10px;
        left:10px;
        z-index:2;
}

#hugeit_top_controls .controls-list li.select select {
        width:65px;
        height:28px;
        margin:0px 0px 0px 0px;
        opacity:0;
        z-index:1;
        cursor:pointer;

}



#hugeit_top_controls .controls-list li.back  a, #hugeit_top_controls .controls-list li.back  a:link, #hugeit_top_controls .controls-list li.back  a:visited {
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -326px no-repeat #fafafa;
        border-top-left-radius:3px;
        border-bottom-left-radius:3px;
}
#hugeit_top_controls .controls-list li.back  a:hover, #hugeit_top_controls .controls-list li.back  a:focus, #hugeit_top_controls .controls-list li.back  a:active {
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -826px no-repeat #fefefe;
}

#hugeit_top_controls .controls-list li  a, #hugeit_top_controls .controls-list li  a:link, #hugeit_top_controls .controls-list li  a:visited{
        display:block;
        min-width:40px;
        text-indent:-9999px;
        padding: 5px 10px;
        background-color:#fafafa;
}

#hugeit_top_controls .controls-list li  a:hover, #hugeit_top_controls .controls-list li  a:focus, #hugeit_top_controls .controls-list li  a:active {
        background-color:#fefefe;
}

#hugeit_top_controls .controls-list li.spam  a, #hugeit_top_controls .controls-list li.spam  a:link, #hugeit_top_controls .controls-list li.spam  a:visited {
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -195px no-repeat #fafafa;
        border-top-left-radius:3px;
        border-bottom-left-radius:3px;
}
#hugeit_top_controls .controls-list li.spam  a:hover, #hugeit_top_controls .controls-list li.spam  a:focus, #hugeit_top_controls .controls-list li.spam  a:active {
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -695px no-repeat #fefefe;
}

#hugeit_top_controls .controls-list li.trash  a, #hugeit_top_controls .controls-list li.trash  a:link, #hugeit_top_controls .controls-list li.trash  a:visited {
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -129px no-repeat #fafafa;
}
#hugeit_top_controls .controls-list li.trash  a:hover, #hugeit_top_controls .controls-list li.trash  a:focus, #hugeit_top_controls .controls-list li.trash  a:active {
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -629px no-repeat #fefefe;
}

#hugeit_top_controls .controls-list li.refrash  a, #hugeit_top_controls .controls-list li.refrash  a:link, #hugeit_top_controls .controls-list li.refrash  a:visited {
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -294px no-repeat #fafafa;
        border-top-right-radius:3px;
        border-bottom-right-radius:3px;
}
#hugeit_top_controls .controls-list li.refrash  a:hover, #hugeit_top_controls .controls-list li.refrash  a:focus, #hugeit_top_controls .controls-list li.refrash  a:active {
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -794px no-repeat #fefefe;
}


#hugeit_top_controls .controls-list li.spam a {

}

#hugeit_top_controls  .page-navigation {
        float:right;
}

#hugeit_top_controls  .page-navigation .count {
        display:block;
        height:25px;
        padding:5px 10px 0px 0px;
        float:left;
}

#hugeit_top_controls  .page-navigation  .buttons {
        height:30px;
        float:left;
}

#hugeit_top_controls  .page-navigation  a {
        display:block;
        min-width:20px;
        text-indent:-9999px;
        padding:5px 10px 5px 10px;
        margin:0px 1px 0px 0px;
        background-color:#fefefe;
        float:left;	
}

#hugeit_top_controls  .page-navigation  a.prev, #hugeit_top_controls  .page-navigation  a.prev:link, #hugeit_top_controls  .page-navigation  a.prev:visited {
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -106px no-repeat #fafafa;
        border-top-left-radius:3px;
        border-bottom-left-radius:3px;
} 
#hugeit_top_controls  .page-navigation  a.prev:hover, #hugeit_top_controls  .page-navigation  a.prev:focus, #hugeit_top_controls  .page-navigation  a.prev:active {
    background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -606px no-repeat #fefefe;
}

#hugeit_top_controls  .page-navigation  a.next, #hugeit_top_controls  .page-navigation  a.next:link, #hugeit_top_controls  .page-navigation  a.next:visited {
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -264px no-repeat #fafafa;
        border-top-right-radius:3px;
        border-bottom-right-radius:3px;
}
#hugeit_top_controls  .page-navigation  a.next:hover, #hugeit_top_controls  .page-navigation  a.next:focus, #hugeit_top_controls  .page-navigation  a.next:active {background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -764px no-repeat #fefefe;}

#hugeit_top_controls  .page-navigation  a.prev_message, #hugeit_top_controls  .page-navigation  a.prev_message:link, #hugeit_top_controls  .page-navigation  a.prev_message:visited {
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -106px no-repeat #fafafa;
        border-top-left-radius:3px;
        border-bottom-left-radius:3px;
} 
#hugeit_top_controls  .page-navigation  a.prev_message:hover, #hugeit_top_controls  .page-navigation  a.prev_message:focus, #hugeit_top_controls  .page-navigation  a.prev_message:active {
    background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -606px no-repeat #fefefe;
}

#hugeit_top_controls  .page-navigation  a.next_message, #hugeit_top_controls  .page-navigation  a.next_message:link, #hugeit_top_controls  .page-navigation  a.next_message:visited {
        background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -264px no-repeat #fafafa;
        border-top-right-radius:3px;
        border-bottom-right-radius:3px;
}
#hugeit_top_controls  .page-navigation  a.next_message:hover, #hugeit_top_controls  .page-navigation  a.next_message:focus, #hugeit_top_controls  .page-navigation  a.next_message:active {background:url('<?php echo  plugins_url( '../images/gicons.png' , __FILE__ ); ?>') center -764px no-repeat #fefefe;}


a {
        -webkit-transition: background -1s; /* For Safari 3.1 to 6.0 */
    transition: background -1s;
}

.fields-list .tinymce_custom_text {display:none;}
.fields-list  .open .tinymce_custom_text {display:block;}

.tinymce_custom_text, .input_block_custom_text {
        width: 100% !important;
}

.hc_captcha_input {
        width: 35px !important;
}
#hugeit_messages_page #the-comment-list tr, #hugeit_messages_page #the-comment-list tr td input{
    cursor: pointer;
}
#hugeit_messages_page #the-comment-list .read {
    opacity: 0.7;
}
#hugeit_messages_page #the-comment-list .unread {
    font-weight: bold;
}

#hugeit_messages_page a {
    cursor: pointer;
}

#hugeit_messages_page .submition_message {
    resize: none;
    border: none;
    box-shadow: none;
    background-color: inherit;
    width: 100%;
    height: 70px;
    overflow: hidden;
    opacity: 0;
}

#hugeit_messages_page .author input {
    border: none;
    box-shadow: none;
    background-color: inherit;
    width: 100%;
}

#hugeit_messages_page .spamer {
    color: #ff0000;
    margin-left: 6%;
}

#hugeit_messages_page .not_spam a {
    color: #a00;
}

#hugeit_messages_page .not_spam a:hover {
    color: #ff0000;
}

#poststuff h2 {
    margin-top: 0;
    padding-top: 0;
}
    
</style>

<script>
    
jQuery( document ).ready(function(){
    
//        <--     CHECK OR UNCHECK ALL SUBMITIONS
        var check_all = "#hugeit_messages_page #hugeit_top_controls .select input[name='all']";
        jQuery(check_all).change(function(){
            if(jQuery(this).is(':checked')){
                jQuery("input[name='check_comments']").each(function(){
                    jQuery(this).attr("checked","checked");
                });
            }
            else{
                jQuery("input[name='check_comments']").each(function(){
                    jQuery(this).removeAttr("checked");
                });
            }
        });
        //                 CHECK OR UNCHECK ALL SUBMITIONS -->
        
        jQuery('#hugeit_messages_page #hugeit_top_controls .controls-list .select select').change(function(){   //   alert(jQuery(this).val());
            var select_val = jQuery(this).val();
//            if(select_val == "all"){    //    alert(select_val);
//                jQuery("#the-comment-list tr").each(function(){
//                    jQuery(this).find("input[name='check_comments']").attr("checked","checked");
//                });
//            }
            if(select_val == "none"){
                jQuery(this).parent().find("input[name='all']").removeAttr("checked");
                jQuery("#the-comment-list tr").each(function(){
                    jQuery(this).find("input[name='check_comments']").removeAttr("checked");
                });
            }
            else{
                jQuery("#the-comment-list tr").each(function(){
                    if(jQuery(this).hasClass(select_val)){ jQuery(this).find("input[name='check_comments']").attr("checked","checked"); }
                    else{ jQuery(this).find("input[name='check_comments']").removeAttr("checked"); }
                });
            }
        });
        
        //        <--      ((MOVE TO SPAM) OR (DELETE IMAGE) CLICK)
        
        jQuery('#hugeit_messages_page #hugeit_top_controls .controls-list li').not(":first").not(":last").click(function(){
            var command = jQuery(this).attr("class");                 // VALUES CAN BE SPAM OR TRASH
            var marked_submitions = [];                               // THERE ARE ALL CHECKED SUBMITIONS(MESSAGES)
            jQuery("input[name='check_comments']").each(function(){   // GETTING CHECKED SUBMITIONS
                if(jQuery(this).is(':checked')){    
                    marked_submitions.push(jQuery(this).val());   
                }
            });
            if(marked_submitions.length > 0){                           // IF EXIST SOME CHECKED SUBMITION
                if(command == "spam"){                                  // IF CLICKED IN SPAM IMAGE
                    var data = {
                                action: 'my_action',
                                post: 'movetospamsubmitions',
                                spam_submitions: marked_submitions
                        };
                     jQuery.post(ajaxurl, data, function(response) {    //    alert(response);
                         if(response == 1) {                            //    alert(reviews_for_delete);
                             var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                             forEach( marked_submitions, function( submition_id ) {    //    alert( submition_id );
                                 jQuery("#comment-"+submition_id+" .row-actions .not_spam").css({"display" : ""});
                                 jQuery("#comment-"+submition_id+" .row-actions .spam").css({"display" : "none"});
                                 jQuery("#comment-"+submition_id+" .author p.spamer").css({"display" : ""});
                             });
                         }
                    });
                }
                else{
                    if(command == "trash"){                             // IF CLICKED IN TRASH IMAGE
                        jQuery("#huge-catalog-dialog-confirm").css({'font-size' : '15px','display' : 'block'});
                        jQuery( "#huge-catalog-dialog-confirm" ).dialog({            // ALERTING ARE YOU SURE DIALOG
                            resizable: false,
                            height:140,
                            modal: true,
                            buttons: {
                              "Yes Delete All Items": function() {      // ID USER CLICKED YES I SURE
                                jQuery( this ).dialog( "close" );
                                var data = {
                                    action: 'my_action',
                                    post: 'deleteanysubmitions',
                                    submitions_for_delete: marked_submitions
                                };

                                jQuery.post(ajaxurl, data, function(response) {    //      alert(response);
                                    if(response == 1) {
                                        var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                                            forEach( marked_submitions, function( submition_id ) {
                                                jQuery("#comment-"+submition_id).remove();         // DELETE ALL CHECKED SUBMITIONS FROM FRONT END
                                            });
                                            var key_for_background = 0;
                                            jQuery("#the-comment-list tr").each(function(){        // ADDING NEW BACKGROUNDS
                                                key_for_background++;
                                                if(key_for_background%2 == 0){ jQuery(this).addClass('alt'); }
                                                else{ jQuery(this).removeClass('alt'); }
                                            });
                                    }
                                });
//                                var check_all = "#hugeit_messages_page #hugeit_top_controls .select input[name='all']";
//                                if(jQuery(check_all).is(":checked")){
                                    window.location.reload();
//                                }
                                
                              },
                              Cancel: function() {
                                jQuery( this ).dialog( "close" );
                              }
                            }
                        });
                    }
                }
            }
            
        });
        
        //              <-- NAVIGATION 
        
        jQuery('#hugeit_messages_page .page-navigation .buttons a').on('click',function(){
            var command = jQuery(this).attr("class");                                   //    alert(command);
            var arrow_value = jQuery(this).attr("value");                               //    alert(arrow_value);
            var old_page_number = jQuery(this).parent().find(".page_number").val();     //    alert(old_page_number);
            var new_page_number = parseInt(old_page_number) + parseInt(arrow_value);    //    alert(new_page_number);
            var submition_count = 0;
            jQuery("input[name='check_comments']").each(function(){
                submition_count++;
            });
            if(new_page_number < 1 || (submition_count <50 && command=="next")){return false;}
            
            else{
                jQuery('#hugeit_messages_page .page-navigation .buttons .page_number').val(new_page_number);
                jQuery('#hugeit_messages_page .page-navigation .buttons form').submit();
            }
        });
        
        //                 NAVIGATION  -->
        
        //              <-- MOVE TO SPAM SINGLE MASSAGE
        
        jQuery('#hugeit_messages_page .spam').on('click',function(){
            var need_to_reload = jQuery(this).attr('need_to_reload');
            var submition_id = jQuery(this).attr('value');      //   alert(submition_id);
            var spam_submitions = [];
            spam_submitions.push(jQuery(this).attr('value'));   
            var data = {
                            action: 'my_action',
                            post: 'movetospamsubmitions',
                            spam_submitions: spam_submitions
                       };
            jQuery.post(ajaxurl, data, function(response) {    //    alert(response);
                if(response == 1){
                    if(need_to_reload == "yes"){
                        window.location.replace("admin.php?page=huge_it_catalog_submitions_page");
                        need_to_reload = "no";
                    }
                    else{
//                          <-- MARKING SUBMITION AS SPAM IN FRONT END -->
                        jQuery("#comment-"+submition_id+" .row-actions .not_spam").css({"display" : ""});
                        jQuery("#comment-"+submition_id+" .row-actions .spam").css({"display" : "none"});
                        jQuery("#comment-"+submition_id+" .author p.spamer").css({"display" : ""});
                        need_to_reload = "no";
                    }
                }
           });
           return false;
        });
    //              MOVE TO SPAM SINGLE MASSAGE    -->
    //              
        //           <-- DELETING SINGLE MASSAGE
                
        jQuery('#hugeit_messages_page .trash').click(function(){
            var need_to_reload = jQuery(this).attr('need_to_reload');
            var submition_id = jQuery(this).attr('value');
            var submitions_for_delete = [];
            submitions_for_delete.push(jQuery(this).attr('value'));
            var data = {
                            action: 'my_action',
                            post: 'deleteanysubmitions',
                            submitions_for_delete: submitions_for_delete
            };
            jQuery.post(ajaxurl, data, function(response) {      //    alert(response);
                if(response == 1){                            //      IF AJAX RESPONSE TRUE
                    if(need_to_reload == "yes"){
                        window.location.replace("admin.php?page=huge_it_catalog_submitions_page");
                        need_to_reload = "no";
                    }
                    else{
                        jQuery("#comment-"+submition_id).remove(); //      DELETE SUBMITION FROM FRONT END
                    //          <--     ADDING NEW BACKGROUNDS
                    var key_for_background = 0;
                    jQuery("#the-comment-list tr").each(function(){
                        key_for_background++;
                        if(key_for_background%2 == 0){ jQuery(this).addClass('alt'); }
                        else{ jQuery(this).removeClass('alt'); }
                    });
                        need_to_reload = "no";
                    }
                    //          ADDING NEW BACKGROUNDS     -->
                }
           });
           return false;
        });
        //              DELETING SINGLE MASSAGE -->
        
        //      <-- MARKING SUBMITION AS NOT-SPAM IN FRONT END
        jQuery('#hugeit_messages_page .not_spam').on('click',function(){
            var submition_id = jQuery(this).attr('value');   //   alert(submition_id);
            var spam_submitions = [];
            spam_submitions.push(jQuery(this).attr('value'));
            var data = {
                            action: 'my_action',
                            post: 'removefromtospamsubmitions',
                            spam_submitions: spam_submitions
                       };
            jQuery.post(ajaxurl, data, function(response) {     //   alert(response);
                if(response == 1) {
                    jQuery("#comment-"+submition_id+" .row-actions .not_spam").css({"display" : "none"});
                    jQuery("#comment-"+submition_id+" .row-actions .spam").css({"display" : ""});
                    jQuery("#comment-"+submition_id+" .author p.spamer").css({"display" : "none"});
                }
            });
            return false;
        });
        //          MARKING SUBMITION AS NOT-SPAM IN FRONT END -->
        
        //         
        
        jQuery("input[name='check_comments']").click(function(){
           if(jQuery(check_all).is(':checked')){
                jQuery(check_all).removeAttr("checked");
           }
        });
        
        
        jQuery("#the-comment-list tr td").click(function(){
            var message_id = jQuery(this).parent().attr("id");
            message_id = message_id.replace("comment-","");
            if(jQuery(this).parent().hasClass("unread")){
                jQuery(this).parent().removeClass("unread").addClass("read");
            }
            window.location = "admin.php?page=huge_it_catalog_submitions_page&id=" + message_id + "&task=show_message";
//            alert(message_id);
        });
        
});
    
    
</script>
<div id="huge-catalog-dialog-confirm" title="Delete Submition(s) ?" style="display: none;">
  ՙ<?php echo __("Are You Sure ?","product-catalog");?>
</div>