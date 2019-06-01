<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if (function_exists('current_user_can'))
    if (!current_user_can('manage_options')) {
        die(__('Access Denied',"product-catalog"));
    }
if (!function_exists('current_user_can')) {
    die(__('Access Denied',"product-catalog"));
}

function      html_showStyles($param_values, $op_type)
{
    ?>
<script>
function display_zoom_type(){
    if(jQuery("#ht_catalog_zoom_window_type").val() == "window"){
        jQuery("#ht_catalog_zoom_window_type").parent().nextAll().css({"display" : "",});
        jQuery(".tint-options").css({"display" : "block",});
    }
    else{
        jQuery("#ht_catalog_zoom_window_type").parent().nextAll().css({"display" : "none",});
        jQuery(".tint-options").css({"display" : "none",});
    }
}

jQuery(document).ready(function () {
	popupsizes(jQuery('#light_box_size_fix'));
	function popupsizes(checkbox){
			if(checkbox.is(':checked')){
				jQuery('.lightbox-options-block .not-fixed-size').css({'display':'none'});
				jQuery('.lightbox-options-block .fixed-size').css({'display':'block'});
			}else {
				jQuery('.lightbox-options-block .fixed-size').css({'display':'none'});
				jQuery('.lightbox-options-block .not-fixed-size').css({'display':'block'});
			}
		}
	jQuery('#light_box_size_fix').change(function(){
		popupsizes(jQuery(this));
	});
	
	
	jQuery('input[data-slider="true"]').bind("slider:changed", function (event, data) {
		 jQuery(this).parent().find('span').html(parseInt(data.value)+"%");
		 jQuery(this).val(parseInt(data.value));
	});	
});
jQuery(document).ready(function () {
	var strliID=jQuery(location).attr('hash');
	//alert(strliID);
	jQuery('#catalog-view-tabs li').removeClass('active');
	if(jQuery('#catalog-view-tabs li a[href="'+strliID+'"]').length>0){
		jQuery('#catalog-view-tabs li a[href="'+strliID+'"]').parent().addClass('active');
	}else {
		jQuery('#catalog-view-tabs li a[href="#lightbox-options"]').parent().addClass('active');
	}
	jQuery('#catalog-view-tabs-contents li').removeClass('active');
	strliID=strliID;
	//alert(strliID);
	if(jQuery(strliID).length>0){
		jQuery(strliID).addClass('active');
	}else {
		jQuery('#lightbox-options').addClass('active');
	}
	jQuery('input[data-slider="true"]').bind("slider:changed", function (event, data) {
		 jQuery(this).parent().find('span').html(parseInt(data.value)+"%");
		 jQuery(this).val(parseInt(data.value));
	});
        
        jQuery(".help").hover(function () {
            jQuery(this).find(".help-block").addClass("active");
        },
        function () {
            jQuery(this).find(".help-block").removeClass("active");
        });
        
        jQuery("#ht_catalog_zoom_window_type").change(function(){
            display_zoom_type();
        });
        
        jQuery("#ht_catalog_zoom_lens_size_fix").change(function(){
            display_sizes();
        });
});
jQuery(window).load(function(){
        display_zoom_type();
});
</script>

<div id="poststuff">
    <?php $path_site2 = plugins_url("../images", __FILE__);
    require "product-catalog-admin-free-banner.php";
    ?>
        <div style="clear:both;"></div>
        <div style="color: #a00; margin-bottom: 15px;"><?php echo __("This options are for commercial users, it includes one of Personal, Multi-Site or Developer versions.Please upgrade to use this section. Please upgrade to use this section.","product-catalog");?>
        </div>
    <div id="post-body-content" class="catalog-options">            
            <div id="post-body-heading"><h3><?php echo __("Image View Options","product-catalog");?></h3>
                <a onclick="document.getElementById('adminForm').submit()" onclick="" class="save-catalog-options button-primary"><?php echo __("Save","product-catalog");?></a>
            </div>
            
            <form action="admin.php?page=Options_catalog_lightbox_styles&task=save" method="post" id="adminForm" name="adminForm">
            <div id="catalog-options-list">
                <ul id="catalog-view-tabs">
                    <li><a href="#lightbox-options"><?php echo __("Lightbox Options","product-catalog");?></a></li>
                    <li><a href="#zoom-options"><?php echo __("Zoom Options","product-catalog");?></a></li>
                </ul>

                <ul class="options-block" id="catalog-view-tabs-contents">
                    <li id="lightbox-options">
                                <!--<div id="post-body-content" class="catalog-options" style="width: 100%;">-->
                                        <img style="width: 100%;" src="<?php echo $path_site2; ?>/options-5.jpg">
                                <!--</div>-->			
                    </li>


                    <!-- VIEW 1 -->
                    <li id="zoom-options">
                        <!--<div id="post-body-content" class="catalog-options" style="width: 100%;">-->
                                <img style="width: 100%;" src="<?php echo $path_site2; ?>/options-4.jpg">
                        <!--</div>-->	
                    </li>

                </ul>

                <div id="post-body-footer">
                        <a onclick="" class="save-catalog-options button-primary"><?php echo __("Save","product-catalog");?></a>
                        <div class="clear"></div>
                </div>
            </div>
            </form>
    </div>  
</div>
<input type="hidden" name="option" value=""/>
<input type="hidden" name="task" value=""/>
<input type="hidden" name="controller" value="options"/>
<input type="hidden" name="op_type" value="styles"/>
<input type="hidden" name="boxchecked" value="0"/>


<script>
    jQuery("#post-body-heading a, #post-body-footer a").click(function(){
        alert('<?php echo __("Product Catalog Settings are disabled in free version. If you need those functionalityes, you need to buy the commercial version.","product-catalog");?>');return false;
    });
    
</script>


<?php
}