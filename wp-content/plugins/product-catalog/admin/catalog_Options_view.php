<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if (function_exists('current_user_can'))
    if (!current_user_can('delete_pages')) {
        die(__('Access Denied',"product-catalog"));
    }
if (!function_exists('current_user_can')) {
    die(__('Access Denied',"product-catalog"));
}

function      html_showStyles($param_values, $op_type)
{
    ?>
<script>

jQuery(document).ready(function () {
	var strliID=jQuery(location).attr('hash');
	//alert(strliID);
	jQuery('#catalog-view-tabs li').removeClass('active');
	if(jQuery('#catalog-view-tabs li a[href="'+strliID+'"]').length>0){
		jQuery('#catalog-view-tabs li a[href="'+strliID+'"]').parent().addClass('active');
	}else {
		jQuery('#catalog-view-tabs li a[href="#catalog-view-options-0"]').parent().addClass('active');
	}
	jQuery('#catalog-view-tabs-contents li').removeClass('active');
	strliID=strliID;
	//alert(strliID);
	if(jQuery(strliID).length>0){
		jQuery(strliID).addClass('active');
	}else {
		jQuery('#catalog-view-options-0').addClass('active');
	}
	jQuery('input[data-slider="true"]').bind("slider:changed", function (event, data) {
		 jQuery(this).parent().find('span').html(parseInt(data.value)+"%");
		 jQuery(this).val(parseInt(data.value));
	});	
});
</script>
<div class="wrap">

<?php $path_site2 = plugins_url("../images", __FILE__); ?>

    <div id="poststuff">
	<?php $path_site2 = plugins_url("../images/", __FILE__); ?>
        <?php $path_site2 = plugins_url("../images", __FILE__);
        require "product-catalog-admin-free-banner.php";
	?>
        <div style="clear:both;"></div>
        <div style="color: #a00; margin-bottom: 15px;"><?php echo __("This options are for commercial users, it includes one of Personal, Multi-Site or Developer versions.Please upgrade to use this section. Please upgrade to use this section.","product-catalog");?>  
        </div>
            <div id="post-body-content" class="catalog-options">
                    <div id="post-body-heading">
                            <h3><?php echo __("Themes Options","product-catalog");?></h3>

                            <a class="save-catalog-options button-primary"><?php echo __("Save");?></a>

                    </div>
                    <form action="admin.php?page=Options_product_Catalog_styles&task=save" method="post" id="adminForm" name="adminForm">
                        <div id="catalog-options-list">
			
                            <ul id="catalog-view-tabs">
                                    <li><a href="#catalog-view-options-0"><?php echo __("Blocks Toggle Up/Down","product-catalog");?></a></li>
                                    <li><a href="#catalog-view-options-1"><?php echo __("Full-Height Blocks","product-catalog");?></a></li>
                                    <li><a href="#catalog-view-options-2"><?php echo __("Catalog/Content-Popup","product-catalog");?></a></li>
                                    <li><a href="#catalog-view-options-3"><?php echo __("Full-Width Blocks","product-catalog");?></a></li>
                                    <li><a href="#catalog-view-options-5"><?php echo __("Content Slider","product-catalog");?></a></li>
                            </ul>
                            <ul class="options-block" id="catalog-view-tabs-contents">
                                 <li id="catalog-view-options-0" style="list-style-type: none;">
                                    <img src="<?php echo $path_site2; ?>/catalog-options-1.jpg" style="width: 100%;"/>
                                </li>
                                <li id="catalog-view-options-1">
                                    <img src="<?php echo $path_site2; ?>/catalog-options-2.jpg" style="width: 100%;" />
                                </li>
                                <li id="catalog-view-options-2">
                                    <img src="<?php echo $path_site2; ?>/catalog-options-3.jpg" style="width: 100%;" />
                                </li>
                                <li id="catalog-view-options-3">
                                    <img src="<?php echo $path_site2; ?>/catalog-options-4.jpg" style="width: 100%;" />
                                </li>
                                <li id="catalog-view-options-5">
                                    <img src="<?php echo $path_site2; ?>/catalog-options-5.jpg" style="width: 100%;" />
                                </li>
                            </ul>
                                    <div id="post-body-footer">
                                        <a  class="save-catalog-options button-primary"><?php echo __("Save","product-catalog");?></a>
                                        <div class="clear"></div>
                                </div>
                            </form>
                        </div>
                        
            </div>
    </div>
</div>

<script>
    jQuery("#post-body-heading a, #post-body-footer a").click(function(){
        alert("Product Catalog Settings are disabled in free version. If you need those functionalityes, you need to buy the commercial version.");return false;
    });
    
</script>

<input type="hidden" name="option" value=""/>
<input type="hidden" name="task" value=""/>
<input type="hidden" name="controller" value="options"/>
<input type="hidden" name="op_type" value="styles"/>
<input type="hidden" name="boxchecked" value="0"/>

<?php
}