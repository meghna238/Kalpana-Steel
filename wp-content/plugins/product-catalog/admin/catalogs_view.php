<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if(function_exists('current_user_can'))
if(!current_user_can('delete_pages')) {
die(__("Access Denied","product-catalog"));
}	
if(!function_exists('current_user_can')){
	die(__("Access Denied","product-catalog"));
}

function html_showcatalogs( $rows,  $pageNav,$sort,$cat_row){
	global $wpdb;
	?>
    <script language="javascript">
		function ordering(name,as_or_desc)
		{
			document.getElementById('asc_or_desc').value=as_or_desc;		
			document.getElementById('order_by').value=name;
			document.getElementById('admin_form').submit();
		}
		function saveorder()
		{
			document.getElementById('saveorder').value="save";
			document.getElementById('admin_form').submit();
			
		}
		function listItemTask(this_id,replace_id)
		{
			document.getElementById('oreder_move').value=this_id+","+replace_id;
			document.getElementById('admin_form').submit();
			function doNothing() {  
			var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
			if( keyCode == 13 ) {
				if(!e) var e = window.event;
				e.cancelBubble = true;
				e.returnValue = false;
				if (e.stopPropagation) {
						e.stopPropagation();
						e.preventDefault();
				}
			}
            }
        }
	</script>


<div class="wrap">
    <?php $path_site2 = plugins_url("../images", __FILE__);
    require "product-catalog-admin-free-banner.php";
	?>
        <div style="clear:both;"></div>
	<div id="poststuff">
		<div id="catalogs-list-page">
			<form method="post"  onkeypress="doNothing()" action="admin.php?page=catalogs_huge_it_catalog" id="admin_form" name="admin_form">
			<h2><?php echo __("Huge-IT Catalogs","product-catalog");?>
				<a onclick="window.location.href='admin.php?page=catalogs_huge_it_catalog&task=add_cat'" class="add-new-h2" ><?php echo __("Add New Catalog","product-catalog");?></a>
			</h2>
			<?php
			$serch_value='';
			if(isset($_POST['serch_or_not'])) {if($_POST['serch_or_not']=="search"){ $serch_value=esc_html(stripslashes($_POST['search_events_by_title'])); }else{$serch_value="";}} 
			$serch_fields='<div class="alignleft actions"">
				<label for="search_events_by_title" style="font-size:14px">'.__("Filter","product-catalog").': </label>
					<input type="text" name="search_events_by_title" value="'.$serch_value.'" id="search_events_by_title" onchange="clear_serch_texts()">
			</div>
			<div class="alignleft actions">
				<input type="button" value="Search" onclick="document.getElementById(\'page_number\').value=\'1\'; document.getElementById(\'serch_or_not\').value=\'search\';
				 document.getElementById(\'admin_form\').submit();" class="button-secondary action">
				 <input type="button" value="'.__("Reset","product-catalog").'" onclick="window.location.href=\'admin.php?page=catalogs_huge_it_catalog\'" class="button-secondary action">
			</div>';

			 print_html_nav($pageNav['total'],$pageNav['limit'],$serch_fields);
			?>
			<table class="wp-list-table widefat fixed pages" style="width:95%">
				<thead>
				 <tr>
					<th scope="col" id="id" style="width:30px" ><span>ID</span><span class="sorting-indicator"></span></th>
					<th scope="col" id="name" style="width:85px" ><span><?php echo __("Name","product-catalog");?></span><span class="sorting-indicator"></span></th>
					<th scope="col" id="prod_count"  style="width:75px;" ><span><?php echo __("Images","product-catalog");?></span><span class="sorting-indicator"></span></th>
					<th style="width:40px"><?php echo __("Delete","product-catalog");?></th>
				 </tr>
				</thead>
				<tbody>
				 <?php 
				 $trcount=1;
				  for($i=0; $i<count($rows);$i++){
					$trcount++;
					$ka0=0;
					$ka1=0;
					if(isset($rows[$i-1]->id)){
						  if($rows[$i]->sl_width==$rows[$i-1]->sl_width){
						  $x1=$rows[$i]->id;
						  $x2=$rows[$i-1]->id;
						  $ka0=1;
						  }
						  else
						  {
							  $jj=2;
							  while(isset($rows[$i-$jj]))
							  {
								  if($rows[$i]->sl_width==$rows[$i-$jj]->sl_width)
								  {
									  $ka0=1;
									  $x1=$rows[$i]->id;
									  $x2=$rows[$i-$jj]->id;
									   break;
								  }
								$jj++;
							  }
						  }
						  if($ka0){
							$move_up='<span><a href="#reorder" onclick="return listItemTask(\''.$x1.'\',\''.$x2.'\')" title="Move Up">   <img src="'.plugins_url('images/uparrow.png',__FILE__).'" width="16" height="16" border="0" alt="Move Up"></a></span>';
						  }
						  else{
							$move_up="";
						  }
					}else{$move_up="";}
					
					
					if(isset($rows[$i+1]->id)){
						
						if($rows[$i]->sl_width==$rows[$i+1]->sl_width){
						  $x1=$rows[$i]->id;
						  $x2=$rows[$i+1]->id;
						  $ka1=1;
						}
						else
						{
							  $jj=2;
							  while(isset($rows[$i+$jj]))
							  {
								  if($rows[$i]->sl_width==$rows[$i+$jj]->sl_width)
								  {
									  $ka1=1;
									  $x1=$rows[$i]->id;
									  $x2=$rows[$i+$jj]->id;
									  break;
								  }
								$jj++;
							  }
						}
						
						if($ka1){
							$move_down='<span><a href="#reorder" onclick="return listItemTask(\''.$x1.'\',\''. $x2.'\')" title="Move Down">  <img src="'.plugins_url('images/downarrow.png',__FILE__).'" width="16" height="16" border="0" alt="Move Down"></a></span>';
						}else{
							$move_down="";	
						}
					}

					$uncat=$rows[$i]->par_name;
					if(isset($rows[$i]->prod_count))
						$pr_count=$rows[$i]->prod_count;
					else
						$pr_count=0;


					?>
					<tr <?php if($trcount%2==0){ echo 'class="has-background"';}?>>
						<td><?php echo $rows[$i]->id; ?></td>
						<td><a  href="admin.php?page=catalogs_huge_it_catalog&task=edit_cat&id=<?php echo $rows[$i]->id?>"><?php echo esc_html(stripslashes($rows[$i]->name)); ?></a></td>
						<td>(<?php if(!($pr_count)){echo '0';} else{ echo $rows[$i]->prod_count;} ?>)</td>
						<td><a  href="admin.php?page=catalogs_huge_it_catalog&task=remove_cat&id=<?php echo $rows[$i]->id?>" class="remove_gallery">Delete</a></td>
					</tr> 
				 <?php } ?>
				</tbody>
			</table>
			 <input type="hidden" name="oreder_move" id="oreder_move" value="" />
			 <input type="hidden" name="asc_or_desc" id="asc_or_desc" value="<?php if(isset($_POST['asc_or_desc'])) echo esc_attr($_POST['asc_or_desc']);?>"  />
			 <input type="hidden" name="order_by" id="order_by" value="<?php if(isset($_POST['order_by'])) echo esc_attr($_POST['order_by']);?>"  />
			 <input type="hidden" name="saveorder" id="saveorder" value="" />

			 <?php
			?>
			
			
		   
			</form>
		</div>
	</div>
</div>
    <?php

}
function Html_edit_catalog($catalogsInAlbumArray,$allAlbumsArray,$catalogAlbumIdesArray,$ord_elem, $count_ord, $images, $row, $cat_row, $rowim, $rowsld)
{
 global $wpdb;
	if(isset($_GET["addslide"])){
            if($_GET["addslide"] == 1){
                header('Location: admin.php?page=catalogs_huge_it_catalog&id='.$row->id.'&task=apply');
            }
	}
?>
<script type="text/javascript">
function submitbutton(pressbutton) 
{
	if(!document.getElementById('name').value){
	alert("Name is required.");
	return;
	}
        jQuery("#images-list > li").each(function(){
            jQuery(this).find('.order_by').val(jQuery(this).index());
        });
	filterInputs();
	document.getElementById("adminForm").action=document.getElementById("adminForm").action+"&task="+pressbutton;
	document.getElementById("adminForm").submit();
}

var  name_changeRight = function(e) {
	document.getElementById("name").value = e.value;
}
var  name_changeTop = function(e) {
		document.getElementById("huge_it_catalog_name").value = e.value;
};

function change_select()
{
		submitbutton('apply'); 
	
}

function filterInputs() {
	
		var mainInputs = "";
		
		jQuery("#images-list > li.highlights").each(function(){
			jQuery(this).next().addClass('submit-post');
			jQuery(this).prev().addClass('submit-post');
			jQuery(this).prev().prev().addClass('submit-post');
			jQuery(this).addClass('submit-post');
			jQuery(this).removeClass('highlights');
		})
				
		if(jQuery("#images-list > li.submit-post").length) {

                    jQuery("#images-list > li.submit-post").each(function(){

                            var inputs = jQuery(this).find('.order_by').attr("name");
                            var n = inputs.lastIndexOf('_');
                            var res = inputs.substring(n+1, inputs.length);
                            res +=',';
                            mainInputs += res;

                    });

                    mainInputs = mainInputs.substring(0,mainInputs.length-1);

                    jQuery(".changedvalues").val(mainInputs);

                    jQuery("#images-list > li").not('.submit-post').each(function(){
                            jQuery(this).find('input').not(".parameters").not(".order_by").removeAttr('name');
                            jQuery(this).find('textarea').removeAttr('name');
                            jQuery(this).find('select').removeAttr('name');
                    });
                    return mainInputs;
		
		}
		jQuery("#images-list > li").each(function(){
                            jQuery(this).find('input').not(".parameters").not(".order_by").removeAttr('name');
                            jQuery(this).find('textarea').removeAttr('name');
                            jQuery(this).find('select').removeAttr('name');
		});

}


jQuery(function() {
    jQuery(document).on('click','div.inside.params_inside',function(){
        isParamsClicked = true;
    });
    jQuery( "#images-list" ).sortable({
	  stop: function() {
              jQuery("#images-list > li").removeClass('has-background');
              count=jQuery("#images-list > li").length;
              for(var i=0;i<=count;i+=2){
                              jQuery("#images-list > li").eq(i).addClass("has-background");
              }
              jQuery("#images-list > li").each(function(){
                      jQuery(this).find('.order_by').val(jQuery(this).index());
              });
	  },
	  revert: true
	});
        
        /*********************OPTIONS SAVE optimization************************/
	jQuery( "#images-list > li input" ).on('keyup',function(){
		jQuery(this).parents("#images-list > li").addClass('submit-post');
	});
	jQuery( "#images-list > li textarea" ).on('keyup',function(){
		jQuery(this).parents("#images-list > li").addClass('submit-post');
	});
	jQuery( "#images-list > li input" ).on('change',function(){
		jQuery(this).parents("#images-list > li").addClass('submit-post');
	});
	jQuery( "#images-list > li select" ).on('change',function(){
		jQuery(this).parents("#images-list > li").addClass('submit-post');
	});
	jQuery('.add-image').on('hover',function(){
		jQuery(this).parent().parents("li").addClass('submit-post');
	});
	jQuery('.editthisimage').on('click',function(){
		jQuery(this).parent().parents("li").addClass('submit-post');
	});
});
</script>

<!-- GENERAL PAGE, ADD IMAGES PAGE -->

	
<div class="wrap">
<?php $path_site2 = plugins_url("../images", __FILE__);
	require "product-catalog-admin-free-banner.php";
		?>
    <div style="clear:both;"></div>
<form action="admin.php?page=catalogs_huge_it_catalog&id=<?php echo $row->id; ?>" method="post" name="adminForm" id="adminForm">
    <input type="hidden" class="changedvalues" value="" name="changedvalues" size="80">	
	<div id="poststuff" >
	<div id="catalog-header">
		<ul id="catalogs-list">
			
			<?php
			foreach($rowsld as $rowsldires){
				if($rowsldires->id != $row->id){
				?>
					<li>
                                            <a href="#" onclick="window.location.href='admin.php?page=catalogs_huge_it_catalog&task=edit_cat&id=<?php echo $rowsldires->id; ?>'" ><?php echo $rowsldires->name; ?></a>
					</li>
				<?php
				}
				else{ ?>
					<li class="active" style="background-image:url(<?php echo plugins_url('../images/edit.png', __FILE__) ;?>)">
                                            <input class="text_area" onkeyup = "name_changeTop(this)" onfocus="this.style.width = ((this.value.length + 1) * 8) + 'px'" type="text" name="name" id="name" maxlength="250" value="<?php echo esc_html(stripslashes($row->name));?>" />
					</li>
				<?php	
				}
			}
		?>
			<li class="add-new">
				<a onclick="window.location.href='admin.php?page=catalogs_huge_it_catalog&amp;task=add_cat'">+</a>
			</li>
		</ul>
		</div>
		<div id="post-body" class="metabox-holder columns-2">
			<!-- Content -->
			<div id="post-body-content">


			<?php add_thickbox(); ?>

				<div id="post-body">
					<div id="post-body-heading">
						<h3><?php echo __("Products","product-catalog");?></h3>
							<script>
jQuery(document).ready(function($){


	 

  jQuery('.huge-it-newuploader .button').click(function(e) {
    var send_attachment_bkp = wp.media.editor.send.attachment;
	
    var button = jQuery(this);
    var id = button.attr('id').replace('_button', '');
    _custom_media = true;

	jQuery("#"+id).val('');
	wp.media.editor.send.attachment = function(props, attachment){
      if ( _custom_media ) {
	     jQuery("#"+id).val(attachment.url+';;;'+jQuery("#"+id).val());
		 jQuery("#save-buttom").click();
      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };
    }
  
    wp.media.editor.open(button);
	 
    return false;
  });
  
  	/*#####HIDE NEW UPLOADER'S LEFT MENU######*/  
										jQuery(".wp-media-buttons-icon").click(function() {
											jQuery(".media-menu .media-menu-item").css("display","none");
											jQuery(".media-menu-item:first").css("display","block");
											jQuery(".separator").next().css("display","none");
											jQuery('.attachment-filters').val('image').trigger('change');
											jQuery(".attachment-filters").css("display","none");
										});

});
</script>

						<input type="hidden" name="imagess" id="_unique_name" />
						<span class="wp-media-buttons-icon"></span>
						<div class="huge-it-newuploader uploader button button-primary add-new-image">
						<input type="button" class="button wp-media-buttons-icon catalog-media-buttons-icon" name="_unique_name_button" id="_unique_name_button" value="Add New Product" />
						</div>
				
					</div>
					<ul id="images-list">
                                        <?php
                                                                 
                                        $j=2;
					                                        
                                        $myrows = explode(",",$row->categories);
                                        $getAllParamsArray = getParams();
					foreach ($rowim as $key=>$rowimages){ ?>
                                            <?php //var_dump($rowimages); ?>
						<li <?php if($j%2==0){echo "class='has-background'";}$j++; ?>>
							<input class="order_by" type="hidden" name="order_by_<?php echo $rowimages->id; ?>" value="<?php echo esc_attr($rowimages->ordering); ?>" />
							<div class="image-container">
								<ul class="widget-images-list">
									<?php $imgurl=explode(";",$rowimages->image_url);
									array_pop($imgurl);
									$i=0;
									foreach($imgurl as $key1=>$img)
									{	?>
										<li class="editthisimage editthisimage<?php echo $key; ?> <?php if($i==0){echo 'first';} ?>">
											<img src="<?php echo esc_attr($img); ?>" />
											<input type="button" class="edit-image"  id="" value="Edit" />
											<a href="#remove" class="remove-image"><?php echo __("remove","product-catalog");?></a>	
										</li>
									<?php $i++; } ?>
                                                                        <?php // var_dump($rowimages->id); ?>
									<li class="add-image-box">
                                                                            
										<img src="<?php echo plugins_url( '../images/plus.png', __FILE__ ) ?>" class="plus" alt="" />
										<input type="hidden" name="imagess<?php echo $rowimages->id; ?>" id="unique_name<?php echo $rowimages->id; ?>" class="all-urls" value="<?php echo $rowimages->image_url; ?>" />
										<input type="button" class="button<?php echo $rowimages->id; ?> wp-media-buttons-icon add-image"  id="unique_name_button<?php echo $rowimages->id; ?>" value="+" />	
									</li>
								</ul>
								<script>
									jQuery(document).ready(function($){
										function secondimageslistlisize(){
											var lisaze = jQuery('#images-list').width();
											lisaze=lisaze*0.06;
											jQuery('#images-list .widget-images-list li').not('.add-image-box').not('.first').height(lisaze);
										}
										jQuery(".wp-media-buttons-icon").click(function() {
											jQuery(".attachment-filters").css("display","none");
										});
									  var _custom_media = true,
										  _orig_send_attachment = wp.media.editor.send.attachment;
										 
										/*#####ADD NEW PROJECT######*/ 
										jQuery('.huge-it-newuploader .button').click(function(e) {
											var send_attachment_bkp = wp.media.editor.send.attachment; //  alert(send_attachment_bkp);
											var button = jQuery(this);
											var id = button.attr('id').replace('_button', '');
											_custom_media = true;

											jQuery("#"+id).val('');
											wp.media.editor.send.attachment = function(props, attachment){
											  if ( _custom_media ) {
                                                                                                 jQuery("#"+id).val(attachment.url+';;;'+jQuery("#"+id).val());
												 jQuery("#save-buttom").click();
											  } else {
												return _orig_send_attachment.apply( this, [props, attachment] );
											  };
											}
											wp.media.editor.open(button);
											return false;
										});
										  
										/*#####EDIT IMAGE######*/  
										jQuery('.widget-images-list').on('click','.edit-image',function(e) {
											var send_attachment_bkp = wp.media.editor.send.attachment;
											var button = jQuery(this);
											var id = button.parents('.widget-images-list').find('.all-urls').attr('id');
											var img= button.prev('img');
											_custom_media = true;
											jQuery(".media-menu .media-menu-item").css("display","none");
											jQuery(".media-menu-item:first").css("display","block");
											jQuery(".separator").next().css("display","none");
											jQuery('.attachment-filters').val('image').trigger('change');
											jQuery(".attachment-filters").css("display","none");
											wp.media.editor.send.attachment = function(props, attachment){
											  if ( _custom_media ) {	 
												 img.attr('src',attachment.url);
												 var allurls ='';
												 img.parents('.widget-images-list').find('img').not('.plus').each(function(){
													allurls = allurls+jQuery(this).attr('src')+';';
												 });
												 jQuery("#"+id).val(allurls);
												 secondimageslistlisize();
												 //jQuery("#save-buttom").click();
											  } else {
												return _orig_send_attachment.apply( this, [props, attachment] );
											  };
											}
											wp.media.editor.open(button);
											return false;
										});

										jQuery('.add_media').on('click', function(){
											_custom_media = false;
										});
										
										 /*#####ADD IMAGE######*/  
										jQuery('.add-image.button<?php echo $rowimages->id; ?>').click(function(e) {
											var send_attachment_bkp = wp.media.editor.send.attachment;

											var button = jQuery(this);
											var id = button.attr('id').replace('_button', '');
											_custom_media = true;

											wp.media.editor.send.attachment = function(props, attachment){
											  if ( _custom_media ) {
													jQuery("#"+id).parent().before('<li class="editthisimage editthisimage1 "><img src="'+attachment.url+'" alt="" /><input type="button" class="edit-image"  id="" value="Edit" /><a href="#remove" class="remove-image">remove</a></li>');
													//alert(jQuery("#"+id).val());
													jQuery("#"+id).val(jQuery("#"+id).val()+attachment.url+';');
													
													secondimageslistlisize();

											  } else {
												return _orig_send_attachment.apply( this, [props, attachment] );
											  };
											}

											wp.media.editor.open(button);
											 
											return false;
										});

										
										/*#####REMOVE IMAGE######*/  
										jQuery("ul.widget-images-list").on('click','.remove-image',function () {
											jQuery(this).parent().find('img').remove();
											var allUrls="";
											jQuery(this).parents('ul.widget-images-list').find('img').not('.plus').each(function(){
												allUrls=allUrls+jQuery(this).attr('src')+';';
												jQuery(this).parent().parent().parent().find('input.all-urls').val(allUrls);
												secondimageslistlisize();
											});					
											jQuery(this).parent().remove();
											return false;
										});
										

										/*#####HIDE NEW UPLOADER'S LEFT MENU######*/  
										jQuery(".wp-media-buttons-icon").click(function() {
											jQuery(".media-menu .media-menu-item").css("display","none");
											jQuery(".media-menu-item:first").css("display","block");
											jQuery(".separator").next().css("display","none");
											jQuery('.attachment-filters').val('image').trigger('change');
											jQuery(".attachment-filters").css("display","none");
										});
                                                                                
										var parameters_width = jQuery(".options-container").height();
										jQuery(".category-container").height(parameters_width);
									});
                                                                        
								</script>
							</div>
							<div class="image-options">
								<div class="options-container">
									<div>
										<label for="titleimage<?php echo $rowimages->id; ?>"><?php echo __("Title","product-catalog");?>:</label>
										<input  class="text_area" type="text" id="titleimage<?php echo $rowimages->id; ?>" name="titleimage<?php echo $rowimages->id; ?>" id="titleimage<?php echo $rowimages->id; ?>"  value="<?php echo esc_html(stripslashes($rowimages->name)); ?>">
									</div>
                                                                        <div>
										<label for="price<?php echo $rowimages->id; ?>"><?php echo __("Price","product-catalog");?>:</label>
										<input  class="text_area" type="text" id="price<?php echo $rowimages->id; ?>" name="price<?php echo $rowimages->id; ?>" id="price<?php echo $rowimages->id; ?>"  value="<?php echo esc_html(stripslashes($rowimages->price)); ?>">
									</div>
                                                                        <div>
										<label for="market_price<?php echo $rowimages->id; ?>"><?php echo __("Discount Price","product-catalog");?>:</label>
										<input  class="text_area" type="text" id="market_price<?php echo $rowimages->id; ?>" name="market_price<?php echo $rowimages->id; ?>" style="margin-top: 1%;" id="market_price<?php echo $rowimages->id; ?>"  value="<?php echo esc_html(stripslashes($rowimages->market_price)); ?>">
									</div>
                                                                        
                                                                        <div>
                                                                                <div style="position: relative;float:left;width:65%;">
                                                                                    <label for="single_product_url_type<?php echo $rowimages->id; ?>">Product Page Custom Link:</label>
                                                                                    <input class="text_area product_url_select" type="text" id="single_product_url_type<?php echo $rowimages->id; ?>" name="single_product_url_type<?php echo $rowimages->id; ?>" value="<?php echo esc_html(stripslashes($rowimages->single_product_url_type)); ?>">
                                                                                    <img src="<?php echo $path_site2; ?>/close.gif" width="14" height="16" value="a" class="del_product_link">
                                                                                </div>
                                                                            <div style="float:left;width:25%;">
                                                                                    <label for="view_link_open_type<?php echo $rowimages->id; ?>">Product page new tab</label>
                                                                                    <input type="hidden" value="off" name="view_link_open_type<?php echo $rowimages->id; ?>" />
                                                                                    <input type="checkbox" id="view_link_open_type<?php echo $rowimages->id; ?>" name="view_link_open_type<?php echo $rowimages->id; ?>" <?php if($rowimages->link_target == 'on') echo 'checked="checked"';?> value="on">
                                                                                </div>
                                                                        </div>
									<div class="description-block">
										<label for="im_description<?php echo $rowimages->id; ?>"><?php echo __("Description","product-catalog");?>:</label>
										<textarea id="im_description<?php echo $rowimages->id; ?>" name="im_description<?php echo $rowimages->id; ?>" ><?php echo esc_html(stripslashes($rowimages->description)); ?></textarea>
									</div>
                                    <div>
										<label for="show_product<?php echo $rowimages->id; ?>"><?php echo __("Show Product","product-catalog");?></label>
										<input type="hidden" value="off" name="show_product<?php echo $rowimages->id; ?>" />
										<input type="checkbox" id="show_product<?php echo $rowimages->id; ?>" name="show_product<?php echo $rowimages->id; ?>" <?php if($rowimages->published == 'on') echo 'checked="checked"';?> value="on">
                                    </div>                                 

								</div>
<div class="category-container">
    <?php
            $allParamsAndChildsInArray = explode('*()*', $rowimages->parameters);
            foreach ($allParamsAndChildsInArray as $singleParamAndChild) {   //    var_dump($singleParamAndChild);
                if($singleParamAndChild != "" && $singleParamAndChild != " "){
                    $separateParamAndChildsInArray = explode("_()_", $singleParamAndChild);
                    $separateParamAndChildFirstParam = $separateParamAndChildsInArray[0]; 
                    $separateParamAndChildWithoutParam = $separateParamAndChildsInArray;
                    unset($separateParamAndChildWithoutParam[0]);   //  var_dump($separateParamAndChildWithoutParam);   //there is a param field without param name 
                    $separateParamAndChildWithoutParam = array_reverse($separateParamAndChildWithoutParam);    //  var_dump($separateParamAndChildWithoutParam);   //there is a ordered param field without param name 

                    $separateParamAndChildsInArrayOrdered[] = $separateParamAndChildFirstParam; 
                    foreach($separateParamAndChildWithoutParam as $aaaa){
                        if($aaaa != ""){
                            $separateParamAndChildsInArrayOrdered[] = $aaaa;
                        }
                    }
                    if(count($separateParamAndChildsInArrayOrdered) != 1){
                        foreach ($separateParamAndChildsInArrayOrdered as $paramKey => $separateParamAndChild){
                            if($separateParamAndChild != "") {
//                                var_dump($separateParamAndChild);
//                                echo "'&lt;a href= &gt;aaa&lt;/a&gt;'";
                                if($paramKey == 0){ ?>
                                    <ul class="full_param">
                                        <li class="new_parameter"><span><?php echo $separateParamAndChild; ?></span>
                          <?php }
                                else
                                    if($paramKey == 1){ ?>
                                        <input type="text" size="" class="firstParam" added="added" val_for_editing="<?php echo str_replace("thisisat", "_()_", $separateParamAndChild); ?>" value="<?php echo str_replace("thisisat", "_()_", $separateParamAndChild); ?>">
                                        </li>
                              <?php }
                                    else
                                    { ?>
                                        <li style="">
                                            <input type="text" size="" class="firstParam" added="added" val_for_editing="<?php echo str_replace("thisisat", "_()_", $separateParamAndChild); ?>" value="<?php echo str_replace("thisisat", "_()_", $separateParamAndChild); ?>">
                                        </li>
                                    <?php }
                            }
                        } ?>
                                    </ul>
    <?php           }
               else {
//                   exit;
                        foreach ($separateParamAndChildsInArrayOrdered as $paramKey => $separateParamAndChild){ ?>
                            <ul class="full_param">
                                <li class="new_parameter"><span><?php echo $separateParamAndChild; ?></span>
                                   <input type="text" size="" class="firstParam">
                                </li>
                            </ul>
                  <?php } ?>

              <?php }
                }
                unset($separateParamAndChildsInArrayOrdered);
            } ?>
</div>
                                                                
							<div class="remove-image-container">
                                <a class="button remove-image" href="admin.php?page=catalogs_huge_it_catalog&id=<?php echo $row->id; ?>&task=apply&removeslide=<?php echo $rowimages->id; ?>"><?php echo __("Remove Product","product-catalog");?></a>
                                <a href="admin.php?page=catalogs_huge_it_catalog&id=<?php echo $row->id; ?>&task=ratings&prod_id=<?php echo $rowimages->id; ?>&TB_iframe=1" class="remove-image button thickbox"><?php echo __("View Ratings","product-catalog");?></a>
                                <a href="admin.php?page=catalogs_huge_it_catalog&id=<?php echo $row->id; ?>&task=reviews&prod_id=<?php echo $rowimages->id; ?>&TB_iframe=1" class="remove-image button thickbox"><?php echo __("View Comments","product-catalog");?></a>
							</div>
							</div>
                                <input type="hidden" name="parameter<?php echo $rowimages->id; ?>" class="parameters" value="<?php echo esc_attr($rowimages->parameters); ?>">
                                <input type="hidden" name="changing_param" class="changing_param" value="">
							<div class="clear"></div>
						</li>
					<?php } ?>
					</ul>
				</div>

			</div>
                        <script>
                                    jQuery(document).on('click', '#add_new_cat_button', function () {
                                       var newCatVal =  jQuery('.inside #add_cat_input input').val();
                                       if(newCatVal !== "") {
                                           jQuery('.parameters').each(function(){       //      alert(jQuery(this).val());
                                                if(jQuery(this).val() != "")
                                                    var new_param_val = jQuery(this).val() + "*()*" + newCatVal;
                                                else
                                                    var new_param_val = jQuery(this).val() + newCatVal;
                                                jQuery(this).val(new_param_val);
                                           });
                                           
                                           var oldValue = jQuery('.inside input:hidden').val();
                                           if(oldValue != "")
                                               var newValue =  oldValue + ','+ newCatVal;
                                           else 
                                               var newValue =  oldValue + newCatVal;
                                           //console.log(newCatVal); console.log(newValue); console.log(oldValue);
                                           jQuery('.params_inside input:hidden').val(newValue.replace(/ /g,"_"));
                                           jQuery('.inside #add_cat_input input').val('');
                                           jQuery('.inside ul').find('#allCategories').before("\n\
                                                        <span style='display: block;'>\n\
                                                            <li class='hndle'>\n\
                                                                <input class='del_val' value='"+newCatVal+"' style=''>\n\
                                                                <span id='delete_cat' style='' value='a'>\n\
                                                                    <img src='../wp-content/plugins/product-catalog/images/delete1.png' width='9' height='9' value='a'>\n\
                                                                </span>\n\
                                                                <span id='edit_cat' style=''>\n\
                                                                    <img src='../wp-content/plugins/product-catalog/images/edit3.png' width='10' height='10'>\n\
                                                                </span>\n\
                                                            </li>\n\
                                                        </span>");
                                          
                                          jQuery('.category-container').each(function() {
                                              jQuery(this).append("<ul class='full_param'><li class='new_parameter' ><span>"+newCatVal+"  </span>\n\
                                                                       <input type='text' size='' class='firstParam' />\n\
                                                                       </li></ul>");
                                          });
                                       }
                                       else { alert("Please fill the line"); }
                                       
                                    });
                                    
                                    jQuery(document).on('keypress', '#add_cat_input input', function (e){    //alert(jQuery(this).val());
                                        if(jQuery(this).val() !== "") {
                                            if(e.keyCode == 13) {
                                                jQuery('#add_new_cat_button').click();
                                            }
                                        }
                                    });
                                    
                                    jQuery(document).on('change', '.firstParam', function (e){    //alert(jQuery(this).val());
                                        
                                        var change_val_index = jQuery(this).parent().parent().index();
                                        var hidden_input = jQuery(this).parent().parent().parent().parent().parent().find(".parameters");
                                        var params_input_old_val = jQuery(this).parent().parent().parent().parent().parent().find(".parameters").val();    //    alert(params_hidden_input);
                                        var new_child_val = jQuery(this).val();
                                            new_child_val = new_child_val.replace(/_()_/g, 'thisisat');

                                        var params_input_old_val_in_array = params_input_old_val.split("*()*");
                                        if(params_input_old_val_in_array[0] == "")
                                            { var new_change_val_index = parseInt(change_val_index) + parseInt(1); }
                                        else
                                            { var new_change_val_index = parseInt(change_val_index); }
                                        
//                                        alert(params_input_old_val_in_array[new_change_val_index]);//param@child || param@
                                        
                                        var separate_param_and_child_in_array = params_input_old_val_in_array[new_change_val_index].split("_()_");
//                                        alert(separate_param_and_child_in_array[0]);
                                        if(new_child_val != ''){ var new_param_and_child = separate_param_and_child_in_array[0] + "_()_" + new_child_val; }
                                        else
                                        {    var new_param_and_child = separate_param_and_child_in_array[0]; }
                                        params_input_old_val_in_array[new_change_val_index] = new_param_and_child;


                                        var params_input_new_val = "";
                                        var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                                        forEach( params_input_old_val_in_array, function( node ) { //            alert( node );
                                            if (node != "") {
                                                if(params_input_new_val != "")
                                                    params_input_new_val = params_input_new_val + "*()*" + node;
                                                else 
                                                    params_input_new_val = params_input_new_val  + node;
                                            }
                                        });

                                        jQuery(hidden_input).val(params_input_new_val);
                                            
                                    });
                                        
                                   
                                    jQuery(document).on('click', '#delete_cat', function (){
                                        var index_new_val = 0;
                                        jQuery(this).parent().parent().each(function(){
                                            jQuery(this).index(index_new_val);
                                            index_new_val++;
                                        });
                                        var del_val_index = jQuery(this).parent().parent().index();                //     alert(del_val_index);
                                        var all_categories_old = jQuery('.inside #allCategories').val();           //     alert(all_categories_old);
                                        var all_categories_old_in_array = all_categories_old.split(",");
                                        
//                                      ###########     <<<<   allCategories hidden input changing     ###########                                       
                                        
                                        var foreach_key = 0;
                                        var newValue = "";
                                        var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                                            forEach( all_categories_old_in_array, function( node ) {               //    alert( node );
                                                if(foreach_key != del_val_index && node !=""){
                                                    if(newValue != "")
                                                        newValue = newValue + "," + node;
                                                    else 
                                                        newValue = newValue + node;
                                                }
                                                foreach_key++;
                                            });
                                        jQuery('.inside #allCategories').val(newValue);
                                        jQuery(this).parent().parent().find('.hndle').parent().remove();

                                        jQuery('.category-container').each(function(){
                                            jQuery(this).find('ul').eq(del_val_index).remove();
                                        });
                                        var need_to_much_index = 0;
                                        jQuery('.parameters').each(function(){
                                                                                                                                     //  alert(del_val_index);
                                            var all_params_old_val = jQuery(this).val();                                             //  alert(all_params_old_val);
                                            var all_params_old_val_in_array = all_params_old_val.split('*()*');                        //  alert(all_params_old_val_in_array[del_val_index]);
                                            if(all_params_old_val_in_array[0] == "" && need_to_much_index == 0){
                                                del_val_index = parseInt(del_val_index) + parseInt(1); need_to_much_index = 1;         ////if first key is empty key = key + 1;
                                            }
                                            var old_param_and_child = "*()*" + all_params_old_val_in_array[del_val_index];             //  alert(old_param_and_child);
                                            
                                            
                                            var foreach_key = 0;
                                            var all_params_new_val = "";
                                            var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                                            forEach( all_params_old_val_in_array, function( node ) {                            //      alert( node );
                                                if(foreach_key != del_val_index && node != ""){
                                                    if(all_params_new_val != "")
                                                        all_params_new_val = all_params_new_val + "*()*" +node;              //      alert(param_for_editing);
                                                    else all_params_new_val = all_params_new_val + node;
                                                }
                                                foreach_key++;
                                            });
                                            jQuery(this).val(all_params_new_val);   //    alert(all_params_new_val);
                                            
                                        });
                                    });
                                    jQuery(document).on('click', '#edit_cat', function (){
                                        jQuery(this).parent().find('.del_val').focus();
                                        var changing_val = jQuery(this).parent().find('.del_val').val().replace(/ /g, '_');
                                        jQuery('#changing_val').removeAttr('value').attr('value',changing_val);
                                    });

                                    jQuery(document).on('click', '#catalogs-list .active', function (){
                                        jQuery(this).find('input').focus();
                                    });

                                    jQuery(document).on('focus', '.del_val', function (){ // Know which category we want to change
                                            var changing_val = jQuery(this).parent().parent().index();  //console.log(changing_val);
                                            jQuery('#changing_val').removeAttr('value').attr('value',changing_val);
                                    });

                                    jQuery(document).on('change', '.del_val', function (){
                                            var input_old_val   = jQuery("#allCategories").val();
                                            var old_param_index = jQuery('#changing_val').val();
                                            var param_new_name  = jQuery(this).val();
                                            var input_old_val_in_array = input_old_val.split(",");
                                                input_old_val_in_array[old_param_index] = param_new_name;
                                                
                                            var new_cat = "";
                                            var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                                            forEach( input_old_val_in_array, function( node ) { 
                                                if(node != "")
                                                    if(new_cat != "")
                                                        new_cat = new_cat + "," + node;
                                                    else 
                                                        new_cat = new_cat +  node;
                                            });
                                            
                                            jQuery('#allCategories').val(new_cat);      //      alert(jQuery('#allCategories').val());
                                            
                                            jQuery('.parameters').each(function(){
                                                var hidden_input_old_val = jQuery(this).val();    //    all params and values in string

                                                var hidden_input_old_val_in_array = hidden_input_old_val.split("*()*");
                                                if(hidden_input_old_val_in_array[0] == ""){
                                                      var new_old_param_index = parseInt(old_param_index) + parseInt(1); }
                                                else{ var new_old_param_index = old_param_index; }
                                                                                                
                                                var old_param_and_child_in_array = hidden_input_old_val_in_array[new_old_param_index].split("_()_");
                                                var param_old_name = old_param_and_child_in_array[0];
                                                var child_name = old_param_and_child_in_array[1];
                                                    if(typeof child_name != 'undefined')
                                                    {    var new_param_and_child = param_new_name + "_()_" + child_name; }
                                                    else
                                                    {    var new_param_and_child = param_new_name; }

                                                hidden_input_old_val_in_array[new_old_param_index] = new_param_and_child;
                                                var params_input_new_val = "";
                                                var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                                                forEach( hidden_input_old_val_in_array, function( node ) { //            alert( node );
                                                    if (node != "") {
                                                        if(params_input_new_val != "")
                                                            params_input_new_val = params_input_new_val + "*()*" + node;
                                                        else
                                                            params_input_new_val = params_input_new_val + node;
                                                    }
                                                });
                                                jQuery(this).val(params_input_new_val);
                                                
                                            });
                                            
                                            jQuery('.new_parameter').parent().each(function() {
                                                if(jQuery(this).index() == old_param_index) {
                                                    jQuery(this).find("span").text(param_new_name);
                                                }
                                            });
                                    });
                                    
                                    jQuery(document).ready(function(){
                                        jQuery('.huge-it-catalog-thumb .button').click(function(e) {
                                            var send_attachment_bkp = wp.media.editor.send.attachment;
                                            var button = jQuery(this);  //  alert(jQuery(this).attr("id").replace('_button', ''));
                                            var id = button.attr("id").replace('_button', '');  //   alert(id);
                                            _custom_media = true;

                                                jQuery("#"+id).val('');  //   alert("#"+id);
                                                wp.media.editor.send.attachment = function(props, attachment){
                                                if ( _custom_media ) {
                                                     jQuery("#"+id).val(attachment.url+';;;');
                                                         jQuery("#save-buttom").click();
                                                }
                                                else {
                                                    return _orig_send_attachment.apply( this, [props, attachment] );
                                                };
                                            }

                                            wp.media.editor.open(button);

                                            return false;
                                       });
										jQuery('#catalog_effects_list').change(function() {
											if(jQuery(this).val()==5) jQuery('#catalog_search').parents('li').css('display','none');
											else jQuery('#catalog_search').parents('li').css('display','block');
                                   });
										jQuery('#catalog_effects_list').change();		
                                   });
                                   jQuery(document).ready(function(){
                                        jQuery('.categories_select select').change(function(){
                                            var catalog_cats_val = jQuery(this).val();
                                            jQuery(this).parent().find("#catalog_cats").val(catalog_cats_val);
                                        });
                                   });
                                   
                                   jQuery(document).ready(function(){
                                        jQuery('#pagination_type').change(function(){
                                            if(jQuery(this).val() != "show_all"){ jQuery('#count_into_page').parent().css({ "display" : "inline-block" }); }
                                            else{ jQuery('#count_into_page').parent().css({ "display" : "none" }); }
                                        });
                                        jQuery('#catalog_search').change(function(){
                                                (jQuery(this).attr('checked')=='checked')?jQuery(this).prev().val('on'):jQuery(this).prev().val('off') ;
                                        });
                                        
                                        jQuery('#catalog_search').on('change',function(){
                                            if(jQuery(this).prop('checked') != true){
                                                jQuery('li.multicheck').hide();
                                            }
                                            else{
                                                jQuery('li.multicheck').show();
                                            }
                                        });
                                        jQuery('#catalog_search').change();
                                   });
                                   
                                   jQuery(document).on('change', '.product_url_select', function (e){
                                        if(jQuery(this).val() == ""){
                                            jQuery(this).val("default");
                                        }
                                   });
                                   
                                   jQuery(document).on('click', '.del_product_link', function (e){
//                                        if(jQuery(this).val() == ""){
                                            jQuery(this).parent().find(".product_url_select").val("default");
//                                        }
                                   });
                                   
                                   /*   <--    IF VIEW IS A CONTENT SLIDER,ADDING NONE DISPLAY TO PAGINATIO OPTIONS    */
                                   jQuery(document).on('change', '#catalog_effects_list', function (e){
                                        var active_view = jQuery(this).val();
                                        var pagination_type = jQuery("#pagination_type").val();
                                        if(active_view == 5){
                                            jQuery("#pagination_type").parent().css({ "display" : "none" }); jQuery("#count_into_page").parent().css({ "display" : "none" });
                                        }
                                        else{
                                            jQuery("#pagination_type").parent().css({ "display" : "" });
                                            if(pagination_type != "show_all"){ jQuery("#count_into_page").parent().css({ "display" : "" }); }
                                        }
                                   });
                                   
                                   jQuery(window).load(function(){
                                       var active_view = <?php echo $row->catalog_list_effects_s; ?>;
                                       if(active_view == 5){ jQuery("#pagination_type").parent().css({ "display" : "none" }); jQuery("#count_into_page").parent().css({ "display" : "none" }); }
                                       
                                   });
    
                        </script>
                        
			<!-- SIDEBAR -->
			<div id="postbox-container-1" class="postbox-container">
				<div id="side-sortables" class="meta-box-sortables ui-sortable">
					<div id="catalog-unique-options" class="postbox">
					<h3 class="hndle"><span><?php echo __("Select The Catalog Theme","product-catalog");?></span></h3>
					<ul id="catalog-unique-options-list">
						<li style="display:none;">
							<label for="sl_width"><?php echo __("Width","product-catalog");?></label>
							<input type="text" name="sl_width" id="sl_width" value="<?php echo esc_html(stripslashes($row->sl_width)); ?>" class="text_area" />
						</li>
						<li style="display:none;">
							<label for="sl_height"><?php echo __("Height","product-catalog");?></label>
							<input type="text" name="sl_height" id="sl_height" value="<?php echo esc_html(stripslashes($row->sl_height)); ?>" class="text_area" />
						</li>
						<li style="display:none;">
							<label for="pause_on_hover"><?php echo __("Pause on hover","product-catalog");?></label>
							<input type="hidden" value="off" name="pause_on_hover" />					
							<input type="checkbox" name="pause_on_hover"  value="on" id="pause_on_hover"  <?php if($row->pause_on_hover  == 'on'){ echo 'checked="checked"'; } ?> />
						</li>
                                                
                                                <li>
							<label for="huge_it_catalog_name"><?php echo __("Catalog Name","product-catalog");?></label>
							<input type = "text" name="name" id="huge_it_catalog_name" value="<?php echo esc_html(stripslashes($row->name));?>" onkeyup = "name_changeRight(this)">
						</li>
                                               
						<li>
							<label for="catalog_effects_list"><?php echo __("Select The View","product-catalog");?></label>
							<select name="catalog_effects_list" id="catalog_effects_list">
									<option <?php if($row->catalog_list_effects_s == '0'){ echo 'selected'; } ?>  value="0"><?php echo __("Blocks Toggle Up/Down","product-catalog");?></option>
									<option <?php if($row->catalog_list_effects_s == '1'){ echo 'selected'; } ?>  value="1"><?php echo __("Full-Height Blocks","product-catalog");?></option>
									<option <?php if($row->catalog_list_effects_s == '2'){ echo 'selected'; } ?>  value="2"><?php echo __("Catalog/Content-Popup","product-catalog");?></option>
									<option <?php if($row->catalog_list_effects_s == '3'){ echo 'selected'; } ?>  value="3"><?php echo __("Full-Width Blocks","product-catalog");?></option>
									<option <?php if($row->catalog_list_effects_s == '5'){ echo 'selected'; } ?>  value="5"><?php echo __("Content Slider","product-catalog");?></option>
							</select>
						</li>
                                                
                                                <li style="">
							<label for="pagination_type"><?php echo __("Displaying Content","product-catalog");?></label>
							<select name="pagination_type" id="pagination_type">
                                                            <option <?php if($row->pagination_type == 'show_all'){ echo 'selected'; } ?>   value="show_all"><?php echo __("Show All","product-catalog");?></option>
                                                            <option <?php if($row->pagination_type == 'pagination'){ echo 'selected'; } ?> value="pagination"><?php echo __("Paginatiion","product-catalog");?></option>
                                                            <option <?php if($row->pagination_type == 'load_more'){ echo 'selected'; } ?>  value="load_more"><?php echo __("Load More","product-catalog");?></option>
							</select>
						</li>
                                                
                                                <li style=" <?php if($row->pagination_type == 'show_all'){echo "display:none;"; } ?>">
							<label for="count_into_page"><?php echo __("Content Per Page","product-catalog");?></label>
							<input type="text" name="count_into_page" id="count_into_page" value="<?php echo esc_html(stripslashes($row->count_into_page)); ?>" class="text_area" />
						</li>
						<li style="display:none;">
							<label for="sl_changespeed"><?php echo __("Change speed","product-catalog");?></label>
							<input type="text" name="sl_changespeed" id="sl_changespeed" value="<?php echo esc_html(stripslashes($row->param)); ?>" class="text_area" />
						</li>
						<li>
							<label for="catalog_search"><?php echo __( 'Catalog search ', 'product-catalog' );?></label>
							<input type="hidden" name="catalog_search" value="off">
							<input type="checkbox"  value="on" name="catalog_search" id="catalog_search"  <?php if($row->catalog_search  == 'on'){ echo 'checked="checked"'; } ?> />
						</li>	
	                    <li class="multicheck">
	                        <span><?php echo __( 'Search By', 'product-catalog' );?></span>
	                        <div>
	                            <span><input type="checkbox" name="" value="0" id="by_desc"  disabled="disabled" />
	                            <label for="by_desc"><?php echo __( 'Description', 'product-catalog' );?></label></span>
	                            <a class="probuttonlink" href="http://huge-it.com/product-catalog/" target="_blank">( <span style="color: red;font-size: 14px;"> PRO </span> )</a>
	                            <span><input type="checkbox" name="" value="1" id="by_parameter"  disabled="disabled" />
	                            <label for="by_parameter"><?php echo __( 'Parameter', 'product-catalog' );?></label></span>
	                            <a class="probuttonlink" href="http://huge-it.com/product-catalog/" target="_blank">( <span style="color: red;font-size: 14px;"> PRO </span> )</a>
	                        <div>
	                    </li>
						<li>
							<label
								for="disable_right_click"><?php echo __( 'Disable Image Right Click', 'product-catalog' ); ?></label>
							<select name="disable_right_click" id="disable_right_click">
								<option <?php if ( get_option( 'product_catalog_disable_right_click' ) == 'off' ) {
									echo 'selected';
								} ?> value="off">Off
								</option>
								<option <?php if ( get_option( 'product_catalog_disable_right_click' ) == 'on' ) {
									echo 'selected';
								} ?> value="on">On
								</option>

							</select>
						</li>

					</ul>
						<div id="major-publishing-actions">
							<div id="publishing-action">
                                                            <input type="button" onclick="submitbutton('apply')" value="<?php echo __("Save Catalog","product-catalog");?>" id="save-buttom" class="button button-primary button-large">
							</div>
							<div class="clear"></div>
						</div>
					</div>
                                    
                                        <div class="postbox" style="display: none;">
                                            <div class="inside2">
                                                <ul>
                                                    <li class="allowIsotope">
                                                        <?php echo __("Show Sorting Buttons","product-catalog");?> :
                                                        <input type="hidden" value="off" name="ht_show_sorting" />
							<input type="checkbox" id="ht_show_sorting"  <?php if($row->ht_show_sorting  == 'on'){ echo 'checked="checked"'; } ?>  name="ht_show_sorting" value="on" />
                                                    </li>
                                                    <li class="allowIsotope">
                                                        <?php echo __("Show Categorie Buttons","product-catalog");?> :
                                                        <input type="hidden" value="off" name="ht_show_filtering" />
							<input type="checkbox" id="ht_show_filtering"  <?php if($row->ht_show_filtering  == 'on'){ echo 'checked="checked"'; } ?>  name="ht_show_filtering" value="on" />
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    
                                    <div class="postbox">
                                            <h3 class="hndle"><span><?php echo __("Parameters","product-catalog");?></span></h3>
                                            <div class="inside params_inside">
                                                <ul>
                                                <?php
                                                $ifforempty= $row->categories;
                                                $ifforempty= stripslashes($ifforempty);
                                                $ifforempty= esc_html($ifforempty);
                                                $ifforempty= empty($ifforempty);
                                                if(!($ifforempty))
                                                {
                                                    foreach ($myrows as $value) {
                                                        if(!empty($value))
                                                        {
                                                        ?>
                                                            <span>
                                                                <li class="hndle">
                                                                    <input class="del_val" value="<?php echo str_replace("_", " ", $value); ?>" style="">
                                                                    <span id="delete_cat" style="" value="a"><img src="<?php echo $path_site2; ?>/delete1.png" width="9" height="9" value="a"></span>
                                                                    <span id="edit_cat" style=""><img src="<?php echo $path_site2; ?>/edit3.png" width="10" height="10"></span>
                                                                </li>
                                                            </span>
                                                        <?php
                                                        }
                                                    }
                                                }

                                                    ?>
                                                    <input type="hidden" value="<?php if (strpos($row->categories,',,') !== false)  { $row->categories = str_replace(",,",",",$row->categories); } echo $row->categories; ?>" id="allCategories" name="allCategories">
                                                    <li id="add_cat_input" style="">
                                                        <input type="text" size="11">
                                                        <a style="" id="add_new_cat_button">+ <?php echo __("Add New Parameter","product-catalog");?>	</a>
                                                    </li>
                                                </ul>
                                                <input type="hidden" value="" id="changing_val">
                                            </div>
                                        </div>
                                        
                                        <div class="postbox" style="display: none;">
                                            <h3 class="hndle"><span><?php echo __("Select Album","product-catalog");?></span></h3>
                                            <div class="inside">
                                                <div class="categories_select">
                                                    <input type="hidden" name="catalog_old_cats" id="catalog_old_cats" value="<?php foreach($catalogAlbumIdesArray as $catalogAlbumId) { echo $catalogAlbumId->album_id.","; } ?>"/>
                                                    <input type="hidden" name="catalog_cats" id="catalog_cats" value="<?php foreach($catalogAlbumIdesArray as $catalogAlbumId) { echo $catalogAlbumId->album_id.","; } ?>"/>
                                                    <select multiple="multiple" style="width: 100%;" name="" class="">
                                                        <?php
                                                        foreach($allAlbumsArray as $key=> $album){ ?>
                                                        <option value="<?php echo $album->id; ?> " <?php foreach($catalogAlbumIdesArray as $catalogAlbumId) { if($catalogAlbumId->album_id == $album->id)  { echo  "selected='selected'"; } }?>><?php echo $album->name; ?></option>;
                                                        <?php  } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="postbox" style="display: none;">
                                            <h3 class="hndle"><span><?php echo __("Catalog Thumbnail","product-catalog");?></span></h3>
                                            <div class="inside">
                                                <div style="width: 200px; height: 160px;margin: 10px auto;">
                                                    <img src="<?php echo esc_html(stripslashes(str_replace(";;;", "", $row->cat_thumb))); ?>" style="width: 200px; height: 150px;margin: 0px auto;" />
                                                </div>
                                                <?php // $row->$row->cat_thumb ?>
                                                <input type="hidden" name="cat_thumb" id="cat_thumb" value="<?php echo esc_attr($row->cat_thumb); ?>"/>
                                                <div class="huge-it-catalog-thumb" style="margin: 0px auto;width: 162px;">
                                                    <input type="button" class="button wp-media-buttons-icon button-primary" name="cat_thumb_button" id="cat_thumb_button" value="<?php if(esc_html(stripslashes(str_replace(";;;", "", $row->cat_thumb))) == "") echo 'Add Catalog Thumbnail'; else echo "Edit Catalog Thumbnail"; ?>" />
                                                </div>
                                            </div>
                                        </div>                                        
                                        
                                        <div id="catalog-shortcode-box" class="postbox shortcode ms-toggle">
                                            <h3 class="hndle"><span><?php echo __("Usage","product-catalog");?></span></h3>
                                            <div class="inside">
                                                <ul>
                                                    <li rel="tab-1" class="selected">
                                                        <h4><?php echo __("Shortcode","product-catalog");?></h4>
                                                        <p><?php echo __("Copy &amp; paste the shortcode directly into any WordPress post or page.","product-catalog");?></p>
                                                        <textarea class="full" readonly="readonly">[huge_it_catalog id="<?php echo $row->id; ?>"]</textarea>
                                                    </li>
                                                    <li rel="tab-2">
                                                        <h4><?php echo __("Template Include","product-catalog");?></h4>
                                                        <p><?php echo __("Copy &amp; paste this code into a template file to include the slideshow within your theme.","product-catalog");?></p>
                                                        <textarea class="full" readonly="readonly">&lt;?php echo do_shortcode("[huge_it_catalog id='<?php echo $row->id; ?>']"); ?&gt;</textarea>
                                                    </li>
                                                </ul>
                                            </div>
                                       </div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="task" value="" />
</form>
</div>

<?php

}

function html_catalog_reviews(){
        $getReviews = getComments()
?>
	<style>
		html.wp-toolbar {
			padding:0px !important;
		}
		#wpadminbar,#adminmenuback,#screen-meta, .update-nag,#dolly {
			display:none;
		}
		#wpbody-content {
			padding-bottom:30px;
		}
		#adminmenuwrap {display:none !important;}
		.auto-fold #wpcontent, .auto-fold #wpfooter {
			margin-left: 0px;
		}
		#wpfooter {display:none;}
		iframe {height:250px !important;}
		#TB_window {height:250px !important;}
	</style>
	<script type="text/javascript">
		jQuery(document).ready(function() {
		                
                    jQuery('#check_all_reviews').click(function() {
                        if(jQuery("#check_all_reviews").is(':checked'))
                                jQuery(".del_one_review").each(function(){
                                    jQuery(this).attr('checked',true);
                                });
                        else
                            jQuery(".del_one_review").each(function(){
                            jQuery(this).attr('checked',false);
                        });
                    });

                    jQuery(".del_one_review").click(function() {
                        if(jQuery("#check_all_reviews").is(':checked')) {
                            jQuery("#check_all_reviews").attr('checked',false);
                        }
                    });
                
                        
                    jQuery('.del_few_reviews').on('click',function(){
                            del_few_reviews();
                    });

                    function del_few_reviews() {
                        var reviews_for_delete = [];
                        jQuery(".del_one_review").each(function(){
                            if(jQuery(this).is(':checked')) {
                                reviews_for_delete.push(jQuery(this).val());
                            }
                        });
                        var data = {
                            action: 'my_action',
                            post: 'delanyreviews',
                            reviews_for_delete: reviews_for_delete
                        };

                        jQuery.post(ajaxurl, data, function(response) {    //      alert(response);
                            if(response == 1) {                            //      alert(reviews_for_delete);
                                var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                                forEach( reviews_for_delete, function( node ) {       //      alert( node );
                                      var class_for_delete = "." + node;              //      alert(jQuery(class_for_delete).val());
                                      jQuery(class_for_delete).parent().parent().remove();
                                });
                            }
                        });
                    }
                    
                    jQuery('.edit_com_name').on('change',function(){
                        var com_new_id = jQuery(this).parent().siblings(':first-child').find("input[name='values_for_delete']").val();  //  alert(com_id);
                        var com_new_name = jQuery(this).val();  //  alert(com_new_name);
                        
                        var data = {
                            action: 'my_action',
                            post: 'editreviewname',
                            com_new_name: com_new_name,
                            com_new_id: com_new_id
                        };

                        jQuery.post(ajaxurl, data, function(response) {     //    alert(response);
                            if(response == 1) {                            //      alert(reviews_for_delete);
                                jQuery('input').blur();
                            }
                            else {
//                                alert("Ajax Error.");
                            }
                        });
                    });
                    
                    jQuery('.edit_com_content').on('change',function(){
                        var com_new_id = jQuery(this).parent().siblings(':first-child').find("input[name='values_for_delete']").val();  //  alert(com_new_id);
                        var com_new_name = jQuery(this).val();   //    alert(com_new_name);
                        
                        var data = {
                            action: 'my_action',
                            post: 'editreviewcontent',
                            com_new_name: com_new_name,
                            com_new_id: com_new_id
                        };

                        jQuery.post(ajaxurl, data, function(response) {     //    alert(response);
                            if(response == 1) {                            //      alert(reviews_for_delete);
                                jQuery('input').blur();
                            }
                            else {
//                                alert("Ajax Error.");
                            }
                        });
                    });
                    
            jQuery("#huge_it_view_reviews_wrap .manager-link").click(function(){
            self.parent.tb_remove();
            self.parent.location.assign('admin.php?page=huge_it_catalog_reviews_page');
        });
                    
    });
	</script>
	 <div id="huge_it_view_reviews">
		<div id="huge_it_view_reviews_wrap">
			<h2><?php echo __("Product","product-catalog");?></h2>
                        <a class="manager-link button view_all_reviews"><?php echo __("All Comments Manager","product-catalog");?></a>
                            <div class="huge_it_prod_reviews_container">
                                <table>
                                    <tr><th><input type="checkbox" id="check_all_reviews"/></th><th><?php echo __("Name","product-catalog");?></th><th><?php echo __("Comment","product-catalog");?></th><th class="del_few_reviews"><a class=""></a></th></tr>
                                </table>
                                <table style="border-collapse: collapse;">
                                        <?php
                                            foreach ($getReviews as $reviews) {
                                        ?>
                                                <tr style="border-bottom: 1pt solid #eee;">
                                                    <td><input type="checkbox" class="del_one_review <?php echo $reviews->id; ?>" value="<?php echo $reviews->id; ?>" name="values_for_delete" /></td>
                                                    <td><input type="text" value="<?php echo esc_html(stripslashes($reviews->name)); ?>" style="text-align: center; border: none;" class="edit_com_name" /></td>
                                                    <td><input type="text" value="<?php echo esc_html(stripslashes($reviews->content)); ?>" style="text-align: center; border: none;" class="edit_com_content" /></td>
	                                                <?php  $catalog_id = absint($_GET['id']);?>
                                                    <td class="del_review"><a href="admin.php?page=catalogs_huge_it_catalog&id=<?php echo $catalog_id; ?>&task=reviews&prod_id=<?php echo $reviews->product_id; ?>&del_id=<?php echo $reviews->id; ?>"><?php echo __("Delete","product-catalog");?></a></td>
                                                </tr>
                                        <?php } ?>
                                </table>
                            </div>
		</div>	
	</div> 
<?php
}
?>

<?php

function Html_catalog_ratings(){
        $getRatings = getRatings();
?>
<style>
        html.wp-toolbar {
                padding:0px !important;
        }
        #wpadminbar,#adminmenuback,#screen-meta, .update-nag,#dolly {
                display:none;
        }
        #wpbody-content {
                padding-bottom:30px;
        }
        #adminmenuwrap {display:none !important;}
        .auto-fold #wpcontent, .auto-fold #wpfooter {
                margin-left: 0px;
        }
        #wpfooter {display:none;}
        iframe {height:250px !important;}
        #TB_window {height:250px !important;}
</style>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#check_all_ratings').click(function() {
            if(jQuery("#check_all_ratings").is(':checked'))
                    jQuery(".del_one_rating").each(function(){
                        jQuery(this).attr('checked',true);
                    });
            else
                jQuery(".del_one_rating").each(function(){
                jQuery(this).attr('checked',false);
            });
        });

        jQuery(".del_one_rating").click(function() {
            if(jQuery("#check_all_ratings").is(':checked')) {
                jQuery("#check_all_ratings").attr('checked',false);
            }
        });

        jQuery('.del_few_ratings').on('click',function(){
                del_few_ratings();
        });

        function del_few_ratings() {
            var ratings_for_delete = [];
            jQuery(".del_one_rating").each(function(){
                if(jQuery(this).is(':checked')) {
                    ratings_for_delete.push(jQuery(this).val());
                }
            });
//                                alert(ratings_for_delete);
            var data = {
                action: 'my_action',
                post: 'delanyratings',
                ratings_for_delete: ratings_for_delete
            };
            
            jQuery.post(ajaxurl, data, function(response) {
                if(response == 1) {
                    var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                    forEach( ratings_for_delete, function( node ) {
                          var class_for_delete = "." + node;
                          jQuery(class_for_delete).parent().parent().remove();
                    });
                }
            });
        }
        
        jQuery('.edit_rating_ip').on('change',function(){
            var rating_new_id = jQuery(this).parent().siblings(':first-child').find("input[name='rating_values_for_delete']").val();  //  alert(rating_new_id);
            var rating_new_ip = jQuery(this).val();

            var data = {
                action: 'my_action',
                post: 'editratingip',
                rating_new_ip: rating_new_ip,
                rating_new_id: rating_new_id
        };

        jQuery.post(ajaxurl, data, function(response) {
            if(response == 1) {
                jQuery('input').blur();
            }
        });
       });
                    
        jQuery('.edit_rating_value').on('change',function(){
            var rating_new_id = jQuery(this).parent().siblings(':first-child').find("input[name='rating_values_for_delete']").val();
            var rating_new_value = jQuery(this).val();
            var data = {
                action: 'my_action',
                post: 'editratingvalue',
                rating_new_value: rating_new_value,
                rating_new_id: rating_new_id
            };
            jQuery.post(ajaxurl, data, function(response) {
                if(response == 1) {
                    jQuery('input').blur();
                }
                else {
                }
            });
        });
        jQuery("#huge_it_view_ratings_wrap .manager-link").click(function(){
            self.parent.tb_remove();
            self.parent.location.assign('admin.php?page=huge_it_catalog_ratings_page');
        });
    });
</script>
	<div id="huge_it_view_ratings">
		<div id="huge_it_view_ratings_wrap">
			<h2><?php echo __( "Product Ratings", "product-catalog" ); ?></h2>
		</div>
		<a class="manager-link button"><?php echo __( "All Ratings Manager", "product-catalog" ); ?></a>
		<div class="huge_it_prod_ratings_container">
			<table>
				<tr>
					<th><input type="checkbox" id="check_all_ratings"/></th>
					<th>IP <?php echo __( "Adress", "product-catalog" ); ?></th>
					<th><?php echo __( "Value", "product-catalog" ); ?></th>
					<th class="del_few_ratings"><a class=""><?php echo __( "Delete", "product-catalog" ); ?></a></th>
				</tr>
			</table>
			<table style="border-collapse: collapse;">
				<?php
				foreach ( $getRatings as $rating ) {
					?>
					<tr style="border-bottom: 1pt solid #eee;">
						<td><input type="checkbox" class="del_one_rating <?php echo $rating->id; ?>"
						           value="<?php echo $rating->id; ?>" name="rating_values_for_delete"/></td>
						<td><input type="text" value="<?php echo $rating->ip; ?>"
						           style="text-align: center; border: none;" class="edit_rating_ip"/></td>
						<td><input type="text" value="<?php echo esc_html( stripslashes( $rating->value ) ); ?>"
						           style="text-align: center; border: none;" class="edit_rating_value"/></td>
						<?php  $catalog_id = absint($_GET['id']);?>
						<td class="del_rating"><a
								href="admin.php?page=catalogs_huge_it_catalog&id=<?php echo $catalog_id; ?>&task=ratings&prod_id=<?php echo $rating->prod_id; ?>&del_id=<?php echo $rating->id; ?>"><?php echo __( "Delete", "product-catalog" ); ?></a>
						</td>
					</tr>
				<?php } ?>


			</table>
		</div>
	</div> 
<?php
}
?>