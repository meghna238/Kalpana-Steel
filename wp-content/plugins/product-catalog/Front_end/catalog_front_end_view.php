<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function front_end_catalog($images, $paramssld, $paramssld3, $catalog)
{
 ob_start();
	$catalogID=$catalog[0]->id;
	$catalogtitle=$catalog[0]->name;
	$catalogheight=$catalog[0]->sl_height;
	$catalogwidth=$catalog[0]->sl_width;
	$catalogeffect=$catalog[0]->catalog_list_effects_s;
	$slidepausetime=($catalog[0]->description+$catalog[0]->param);
	$catalogpauseonhover=$catalog[0]->pause_on_hover;
	$catalogposition=$catalog[0]->sl_position;
	$slidechangespeed=$catalog[0]->param;
        $catalogCats=$catalog[0]->categories;
        $catalogShowSorting=$catalog[0]->ht_show_sorting;
        $catalogShowFiltering=$catalog[0]->ht_show_filtering;
        $catalogSearch=$catalog[0]->catalog_search;
		$myAllImages = count($images);		

        global $wpdb;
        
        ///////////////////Catalog sorting and floatinf not existing variables////////////////
        if ($paramssld==null) $paramssld=array();

        $paramssld["ht_view0_sorting_float"] = "left";
        $paramssld["ht_view1_sorting_float"] = "left";
        $paramssld["ht_view2_sorting_float"] = "left";
        $paramssld["ht_view3_sorting_float"] = "left";
        $paramssld["ht_view0_filtering_float"] = "left";
        $paramssld["ht_view1_filtering_float"] = "left";
        $paramssld["ht_view2_filtering_float"] = "left";
        $paramssld["ht_view3_filtering_float"] = "left";
        $sorting_block_width = "100%";
        $filtering_block_width = "100%";
        $paramssld["ht_view0_sorting_float"] = "left";
        $paramssld["ht_view1_sorting_float"] = "left";
        $paramssld["ht_view2_sorting_float"] = "left";
        $paramssld["ht_view3_sorting_float"] = "left";
        $paramssld["ht_view0_filtering_float"] = "left";
        $paramssld["ht_view1_filtering_float"] = "left";
        $paramssld["ht_view2_filtering_float"] = "left";
        $paramssld["ht_view3_filtering_float"] = "left";
        $paramssld["ht_view0_show_sorting"] = "on";
        $paramssld["ht_view1_show_sorting"] = "on";
        $paramssld["ht_view2_show_sorting"] = "on";
        $paramssld["ht_view3_show_sorting"] = "on";
        $paramssld["ht_view0_show_filtering"] = "on";
        $paramssld["ht_view1_show_filtering"] = "on";
        $paramssld["ht_view2_show_filtering"] = "on";
        $paramssld["ht_view3_show_filtering"] = "on";
        $paramssld["ht_view0_sortbutton_border_radius"] = "3px";
        $paramssld["ht_view1_sortbutton_border_radius"] = "3px";
        $paramssld["ht_view2_sortbutton_border_radius"] = "3px";
        $paramssld["ht_view3_sortbutton_border_radius"] = "3px";
        $left_to_top = "ok";
        $paramssld["ht_view0_sortbutton_font_size"] = "12px";
        $paramssld["ht_view1_sortbutton_font_size"] = "12px";
        $paramssld["ht_view2_sortbutton_font_size"] = "12px";
        $paramssld["ht_view3_sortbutton_font_size"] = "12px";
        $paramssld["ht_view0_sortbutton_font_color"] = "#000";
        $paramssld["ht_view1_sortbutton_font_color"] = "#000";
        $paramssld["ht_view2_sortbutton_font_color"] = "#000";
        $paramssld["ht_view3_sortbutton_font_color"] = "#000";
        $paramssld["ht_view0_sortbutton_hover_background_color"] = "#fff";
        $paramssld["ht_view1_sortbutton_hover_background_color"] = "#fff";
        $paramssld["ht_view2_sortbutton_hover_background_color"] = "#fff";
        $paramssld["ht_view3_sortbutton_hover_background_color"] = "#fff";
        $paramssld["ht_view0_filterbutton_hover_background_color"] = "#fff";
        $paramssld["ht_view1_filterbutton_hover_background_color"] = "#fff";
        $paramssld["ht_view2_filterbutton_hover_background_color"] = "#fff";
        $paramssld["ht_view3_filterbutton_hover_background_color"] = "#fff";
        $paramssld["ht_view0_filterbutton_hover_font_color"] = "#000";
        $paramssld["ht_view1_filterbutton_hover_font_color"] = "#000";
        $paramssld["ht_view2_filterbutton_hover_font_color"] = "#000";
        $paramssld["ht_view3_filterbutton_hover_font_color"] = "#000";
        $paramssld["ht_view0_sortbutton_hover_font_color"] = "#000";
        $paramssld["ht_view1_sortbutton_hover_font_color"] = "#000";
        $paramssld["ht_view2_sortbutton_hover_font_color"] = "#000";
        $paramssld["ht_view3_sortbutton_hover_font_color"] = "#000";
        $paramssld["ht_view3_filterbutton_hover_font_color"] = "#000";
        $paramssld["ht_view0_sortbutton_hover_background_color"] = "#fff";
        $paramssld["ht_view1_sortbutton_hover_background_color"] = "#fff";
        $paramssld["ht_view2_sortbutton_hover_background_color"] = "#fff";
        $paramssld["ht_view3_sortbutton_hover_background_color"] = "#fff";
        $paramssld["ht_view0_sortbutton_background_color"] = "#fff";
        $paramssld["ht_view1_sortbutton_background_color"] = "#fff";
        $paramssld["ht_view2_sortbutton_background_color"] = "#fff";
        $paramssld["ht_view3_sortbutton_background_color"] = "#fff";
        $paramssld["ht_view0_filterbutton_font_size"] = "12px";
        $paramssld["ht_view1_filterbutton_font_size"] = "12px";
        $paramssld["ht_view2_filterbutton_font_size"] = "12px";
        $paramssld["ht_view3_filterbutton_font_size"] = "12px";
        $paramssld["ht_view0_filterbutton_font_color"] = "#000";
        $paramssld["ht_view1_filterbutton_font_color"] = "#000";
        $paramssld["ht_view2_filterbutton_font_color"] = "#000";
        $paramssld["ht_view3_filterbutton_font_color"] = "#000";
        $paramssld["ht_view0_filterbutton_background_color"] = "#fff";
        $paramssld["ht_view1_filterbutton_background_color"] = "#fff";
        $paramssld["ht_view2_filterbutton_background_color"] = "#fff";
        $paramssld["ht_view3_filterbutton_background_color"] = "#fff";
        $paramssld["ht_view0_filterbutton_border_radius"] = "3px";
        $paramssld["ht_view1_filterbutton_border_radius"] = "3px";
        $paramssld["ht_view2_filterbutton_border_radius"] = "3px";
        $paramssld["ht_view3_filterbutton_border_radius"] = "3px";
        $width_middle = "10px";
        
        //////////////////////////////////////////////////////////////////////////////////////
        
       // var_dump($paramssld3);
        
        $paramssld["ht_view0_border_width"] = "0";
        $paramssld["ht_view0_togglebutton_style"] = "dark";
        $paramssld["ht_view0_show_separator_lines"] = "on";
        $paramssld["ht_view0_linkbutton_text"] = "View Product";
        $paramssld["ht_view0_show_linkbutton"] = "on";
        $paramssld["ht_view0_linkbutton_background_hover_color"] = "df2e1b";
        $paramssld["ht_view0_linkbutton_background_color"] = "e74c3c";
        $paramssld["ht_view0_linkbutton_font_hover_color"] = "ffffff";
        $paramssld["ht_view0_linkbutton_color"] = "ffffff";
        $paramssld["ht_view0_linkbutton_font_size"] = "14";
        $paramssld["ht_view0_description_color"] = "5b5b5b";
        $paramssld["ht_view0_description_font_size"] = "14";
        $paramssld["ht_view0_show_description"] = "on";
        $paramssld["ht_view0_thumbs_width"] = "75";
        $paramssld["ht_view0_thumbs_position"] = "before";
        $paramssld["ht_view0_show_thumbs"] = "on";
        $paramssld["ht_view0_title_font_size"] = "15";
        $paramssld["ht_view0_title_font_color"] = "555555";
        $paramssld["ht_view0_element_border_width"] = "1";
        $paramssld["ht_view0_element_border_color"] = "D0D0D0";
        $paramssld["ht_view0_element_background_color"] = "f7f7f7";
        $paramssld["ht_view0_block_width"] = "275";
        $paramssld["ht_view0_block_height"] = "275";

        $paramssld["ht_view1_show_separator_lines"] = "on";
        $paramssld["ht_view1_linkbutton_text"] = "View Product";
        $paramssld["ht_view1_show_linkbutton"] = "on";
        $paramssld["ht_view1_linkbutton_background_hover_color"] = "df2e1b";
        $paramssld["ht_view1_linkbutton_background_color"] = "e74c3c";
        $paramssld["ht_view1_linkbutton_font_hover_color"] = "ffffff";
        $paramssld["ht_view1_linkbutton_color"] = "ffffff";
        $paramssld["ht_view1_linkbutton_font_size"] = "14";
        $paramssld["ht_view1_description_color"] = "5b5b5b";
        $paramssld["ht_view1_description_font_size"] = "14";
        $paramssld["ht_view1_show_description"] = "on";
        $paramssld["ht_view1_thumbs_width"] = "75";
        $paramssld["ht_view1_thumbs_position"] = "before";
        $paramssld["ht_view1_show_thumbs"] = "on";
        $paramssld["ht_view1_title_font_size"] = "15";
        $paramssld["ht_view1_title_font_color"] = "555555";
        $paramssld["ht_view1_element_border_width"] = "1";
        $paramssld["ht_view1_element_border_color"] = "D0D0D0";
        $paramssld["ht_view1_element_background_color"] = "f7f7f7";
        $paramssld["ht_view1_block_width"] = "275";
        $paramssld["ht_view2_element_linkbutton_text"] = "View Product";
        $paramssld["ht_view2_element_show_linkbutton"] = "on";
        $paramssld["ht_view2_element_linkbutton_color"] = "ffffff";
        $paramssld["ht_view2_element_linkbutton_font_size"] = "14";
        $paramssld["ht_view2_element_linkbutton_background_color"] = "2ea2cd";
        $paramssld["ht_view2_show_popup_linkbutton"] = "on";
        $paramssld["ht_view2_popup_linkbutton_text"] = "View Product";
        $paramssld["ht_view2_popup_linkbutton_background_hover_color"] = "0074a2";
        $paramssld["ht_view2_popup_linkbutton_background_color"] = "2ea2cd";
        $paramssld["ht_view2_popup_linkbutton_font_hover_color"] = "ffffff";
        $paramssld["ht_view2_popup_linkbutton_color"] = "ffffff";
        $paramssld["ht_view2_popup_linkbutton_font_size"] = "14";
        $paramssld["ht_view2_description_color"] = "222222";
        $paramssld["ht_view2_description_font_size"] = "14";
        $paramssld["ht_view2_show_description"] = "on";
        $paramssld["ht_view2_thumbs_width"] = "75";
        $paramssld["ht_view2_thumbs_height"] = "75";
        $paramssld["ht_view2_thumbs_position"] = "before";
        $paramssld["ht_view2_show_thumbs"] = "on";
        $paramssld["ht_view2_popup_background_color"] = "FFFFFF";
        $paramssld["ht_view2_popup_overlay_color"] = "000000";
        $paramssld["ht_view2_popup_overlay_transparency_color"] = "70";
        $paramssld["ht_view2_popup_closebutton_style"] = "dark";
        $paramssld["ht_view2_show_separator_lines"] = "on";
        $paramssld["ht_view2_show_popup_title"] = "on";
        $paramssld["ht_view2_element_title_font_size"] = "18";
        $paramssld["ht_view2_element_title_font_color"] = "222222";
        $paramssld["ht_view2_popup_title_font_size"] = "18";
        $paramssld["ht_view2_popup_title_font_color"] = "222222";
        $paramssld["ht_view2_element_overlay_color"] = "FFFFFF";
        $paramssld["ht_view2_element_overlay_transparency"] = "70";
        $paramssld["ht_view2_zoombutton_style"] = "light";
        $paramssld["ht_view2_element_border_width"] = "1";
        $paramssld["ht_view2_element_border_color"] = "dedede";
        $paramssld["ht_view2_element_background_color"] = "f9f9f9";
        $paramssld["ht_view2_element_width"] = "275";
        $paramssld["ht_view2_element_height"] = "275";

        $paramssld["ht_view3_show_separator_lines"] = "on";
        $paramssld["ht_view3_linkbutton_text"] = "View Product";
        $paramssld["ht_view3_show_linkbutton"] = "on";
        $paramssld["ht_view3_linkbutton_background_hover_color"] = "0074a2";
        $paramssld["ht_view3_linkbutton_background_color"] = "2ea2cd";
        $paramssld["ht_view3_linkbutton_font_hover_color"] = "ffffff";
        $paramssld["ht_view3_linkbutton_color"] = "ffffff";
        $paramssld["ht_view3_linkbutton_font_size"] = "14";
        $paramssld["ht_view3_description_color"] = "555555";
        $paramssld["ht_view3_description_font_size"] = "14";
        $paramssld["ht_view3_show_description"] = "on";
        $paramssld["ht_view3_thumbs_width"] = "75";
        $paramssld["ht_view3_thumbs_height"] = "75";
        $paramssld["ht_view3_show_thumbs"] = "on";
        $paramssld["ht_view3_title_font_size"] = "18";
        $paramssld["ht_view3_title_font_color"] = "0074a2";
        $paramssld["ht_view3_mainimage_width"] = "240";
        $paramssld["ht_view3_element_border_width"] = "1";
        $paramssld["ht_view3_element_border_color"] = "dedede";
        $paramssld["ht_view3_element_background_color"] = "f9f9f9";

        $paramssld["ht_view5_icons_style"] = "dark";
        $paramssld["ht_view5_show_separator_lines"] = "on";
        $paramssld["ht_view5_linkbutton_text"] = "View Product";
        $paramssld["ht_view5_show_linkbutton"] = "on";
        $paramssld["ht_view5_linkbutton_background_hover_color"] = "0074a2";
        $paramssld["ht_view5_linkbutton_background_color"] = "2ea2cd";
        $paramssld["ht_view5_linkbutton_font_hover_color"] = "ffffff";
        $paramssld["ht_view5_linkbutton_color"] = "ffffff";
        $paramssld["ht_view5_linkbutton_font_size"] = "14";
        $paramssld["ht_view5_description_color"] = "555555";
        $paramssld["ht_view5_description_font_size"] = "14";
        $paramssld["ht_view5_show_description"] = "on";
        $paramssld["ht_view5_thumbs_width"] = "75";
        $paramssld["ht_view5_thumbs_height"] = "75";
        $paramssld["ht_view5_show_thumbs"] = "on";
        $paramssld["ht_view5_title_font_size"] = "16";
        $paramssld["ht_view5_title_font_color"] = "0074a2";
        $paramssld["ht_view5_main_image_width"] = "275";
        $paramssld["ht_view5_slider_tabs_font_color"] = "d9d99";
        $paramssld["ht_view5_slider_tabs_background_color"] = "555555";
        $paramssld["ht_view5_slider_background_color"] = "f9f9f9";

        $paramssld["ht_view6_title_font_size"] = "16";
        $paramssld["ht_view6_title_font_color"] = "0074A2";
        $paramssld["ht_view6_title_font_hover_color"] = "2EA2CD";
        $paramssld["ht_view6_title_background_color"] = "000000";
        $paramssld["ht_view6_title_background_transparency"] = "80";
        $paramssld["ht_view6_border_radius"] = "3";
        $paramssld["ht_view6_border_width"] = "0";
        $paramssld["ht_view6_border_color"] = "eeeeee";
        $paramssld["ht_view6_width"] = "275";

        $paramssld["light_box_size"] = "17";
        $paramssld["light_box_width"] = "500";
        $paramssld["light_box_transition"] = "elastic";
        $paramssld["light_box_speed"] = "800";
        $paramssld["light_box_href"] = "False";
        $paramssld["light_box_title"] = "false";
        $paramssld["light_box_scalephotos"] = "true";
        $paramssld["light_box_rel"] = "false";
        $paramssld["light_box_scrolling"] = "false";
        $paramssld["light_box_opacity"] = "20";
        $paramssld["light_box_open"] = "false";
        $paramssld["light_box_overlayclose"] = "true";
        $paramssld["light_box_esckey"] = "false";
        $paramssld["light_box_arrowkey"] = "false";
        $paramssld["light_box_loop"] = "true";
        $paramssld["light_box_data"] = "false";
        $paramssld["light_box_classname"] = "false";
        $paramssld["light_box_fadeout"] = "300";
        $paramssld["light_box_closebutton"] = "false";
        $paramssld["light_box_current"] = "image";
        $paramssld["light_box_previous"] = "previous";
        $paramssld["light_box_next"] = "next";
        $paramssld["light_box_close"] = "close";
        $paramssld["light_box_iframe"] = "false";
        $paramssld["light_box_inline"] = "false";
        $paramssld["light_box_html"] = "false";
        $paramssld["light_box_photo"] = "false";
        $paramssld["light_box_height"] = "500";
        $paramssld["light_box_innerwidth"] = "false";
        $paramssld["light_box_innerheight"] = "false";
        $paramssld["light_box_initialwidth"] = "300";
        $paramssld["light_box_initialheight"] = "100";
        $paramssld["light_box_maxwidth"] = "768";
        $paramssld["light_box_maxheight"] = "500";
        $paramssld["light_box_slideshow"] = "false";
        $paramssld["light_box_slideshowspeed"] = "2500";
        $paramssld["light_box_slideshowauto"] = "true";
        $paramssld["light_box_slideshowstart"] = "start slideshow";
        $paramssld["light_box_slideshowstop"] = "stop slideshow";
        $paramssld["light_box_fixed"] = "true";
        $paramssld["light_box_top"] = "false";
        $paramssld["light_box_bottom"] = "false";
        $paramssld["light_box_left"] = "false";
        $paramssld["light_box_right"] = "false";
        $paramssld["light_box_reposition"] = "false";
        $paramssld["light_box_retinaimage"] = "true";
        $paramssld["light_box_retinaurl"] = "false";
        $paramssld["light_box_retinasuffix"] = "@2x.$1";
        $paramssld["light_box_returnfocus"] = "true";
        $paramssld["light_box_trapfocus"] = "true";
        $paramssld["light_box_fastiframe"] = "true";
        $paramssld["light_box_preloading"] = "true";
        $paramssld["slider_title_position"] = "5";
        $paramssld["light_box_style"] = "1";
        $paramssld["light_box_size_fix"] = "false";

        $paramssld["ht_view2_popup_full_width"] = "on";
        $paramssld["ht_view0_price_text"] = "Price";
        $paramssld["ht_view1_price_text"] = "Price";
        $paramssld["ht_view2_price_text"] = "Price";
        $paramssld["ht_view3_price_text"] = "Price";
        $paramssld["ht_view5_price_text"] = "Price";

        $paramssld["ht_catalog_view0_show_price"] = "on";
        $paramssld["ht_catalog_view0_price_font_size"] = "15";
        $paramssld["ht_catalog_view0_price_font_color"] = "e74c3c";
        $paramssld["ht_catalog_view0_market_price_font_size"] = "15";
        $paramssld["ht_catalog_view0_market_price_font_color"] = "000000";
        $paramssld["ht_catalog_view1_show_price"] = "on";
        $paramssld["ht_catalog_view1_price_font_size"] = "15";
        $paramssld["ht_catalog_view1_price_font_color"] = "e74c3c";
        $paramssld["ht_catalog_view1_market_price_font_size"] = "15";
        $paramssld["ht_catalog_view1_market_price_font_color"] = "000000";
        $paramssld["ht_catalog_view2_show_price"] = "on";
        $paramssld["ht_catalog_view2_price_font_size"] = "15";
        $paramssld["ht_catalog_view2_price_font_color"] = "e74c3c";
        $paramssld["ht_catalog_view2_market_price_font_size"] = "15";
        $paramssld["ht_catalog_view2_market_price_font_color"] = "000000";
        $paramssld["ht_catalog_view3_show_price"] = "on";
        $paramssld["ht_catalog_view3_price_font_size"] = "15";
        $paramssld["ht_catalog_view3_price_font_color"] = "0074a2";
        $paramssld["ht_catalog_view3_market_price_font_size"] = "15";
        $paramssld["ht_catalog_view3_market_price_font_color"] = "000000";
        $paramssld["ht_catalog_view5_show_price"] = "on";
        $paramssld["ht_catalog_view5_price_font_size"] = "15";
        $paramssld["ht_catalog_view5_price_font_color"] = "0074a2";
        $paramssld["ht_catalog_view5_market_price_font_size"] = "15";
        $paramssld["ht_catalog_view5_market_price_font_color"] = "000000";
        
        
        $paramssld["ht_catalog_zoom_window_type"] = "window";
        $paramssld["ht_catalog_zoom_window_width"] = "300";
        $paramssld["ht_catalog_zoom_window_height"] = "200";
        $paramssld["ht_catalog_zoom_x_asis"] = "0";
        $paramssld["ht_catalog_zoom_y_asis"] = "200";
        $paramssld["ht_catalog_zoom_window_position"] = "16";
        $paramssld["ht_catalog_zoom_window_border_size"] = "0";
        $paramssld["ht_catalog_zoom_window_border_color"] = "#000";
        $paramssld["ht_catalog_zoom_window_lens_size"] = "200";
        $paramssld["ht_catalog_zoom_window_fadein"] = "200";
        $paramssld["ht_catalog_zoom_window_fadeout"] = "200";
        $paramssld["ht_catalog_zoom_lens_fadein"] = "200";
        $paramssld["ht_catalog_zoom_lens_fadeout"] = "200";
        $paramssld["ht_catalog_zoom_lens_hide"] = "false";
        $paramssld["ht_catalog_zoom_lens_shape"] = "square";
        $paramssld["ht_catalog_zoom_lens_color"] = "fff";
        $paramssld["ht_catalog_zoom_lens_opacity"] = "40";
        $paramssld["ht_catalog_zoom_cursor"] = "crosshair";
        $paramssld["ht_catalog_zoom_scrollzoom"] = "true";
        $paramssld["ht_catalog_zoom_easing"] = "true";
        $paramssld["ht_catalog_zoom_lens_size_fix"] = "false";
        $paramssld["ht_catalog_zoom_lens_height"] = "100";
        $paramssld["ht_catalog_zoom_lens_width"] = "100";
        $paramssld["ht_catalog_zoom_tint"] = "false";
        $paramssld["ht_catalog_zoom_tint_colour"] = "#fff";
        $paramssld["ht_catalog_zoom_tint_opacity"] = "40";
        $paramssld["ht_catalog_zoom_tint_fadein"] = "200";
        $paramssld["ht_catalog_zoom_tint_fadeout"] = "200";
        $paramssld['ht_catalog_zoom_lens_hide'] = "false";
        $paramssld["ht_view3_allow_lightbox"] = "on";
        $paramssld["ht_catalog_zoom_thumbs_zoom"] = "off";
        $paramssld["ht_view3_allow_zooming"] = "on";

        $paramssld["ht_view0_sorting_float"] = "none";
        $paramssld["ht_view1_sorting_float"] = "none";
        $paramssld["ht_view2_sorting_float"] = "none";
        $paramssld["ht_view3_sorting_float"] = "none";
        $paramssld["ht_view4_sorting_float"] = "none";
        $paramssld["ht_view5_sorting_float"] = "none";
        $paramssld["ht_view6_sorting_float"] = "none";

        $paramssld["ht_view0_filtering_float"] = "none";
        $paramssld["ht_view1_filtering_float"] = "none";
        $paramssld["ht_view2_filtering_float"] = "none";
        $paramssld["ht_view3_filtering_float"] = "none";
        $paramssld["ht_view4_filtering_float"] = "none";
        $paramssld["ht_view5_filtering_float"] = "none";
        $paramssld["ht_view6_filtering_float"] = "none";
        $paramssld["ht_view0_allow_zooming"] = "off";
        $paramssld["ht_view0_allow_lightbox"] = "on";
        $paramssld["ht_view1_allow_zooming"] = "on";
        $paramssld["ht_view1_allow_lightbox"] = "on";
        $paramssld["ht_view2_allow_zooming"] = "off";
        $paramssld["ht_view2_allow_lightbox"] = "on";
        $paramssld["ht_view5_allow_zooming"] = "on";
        $paramssld["ht_view5_allow_lightbox"] = "off";
        
        $paramssld["htc_view0_load_more_position"] = "center";
        $paramssld["htc_view1_load_more_position"] = "center";
        $paramssld["htc_view2_load_more_position"] = "center";
        $paramssld["htc_view3_load_more_position"] = "center";
        $paramssld["htc_view0_load_more_font_size"] = "18";
        $paramssld["htc_view1_load_more_font_size"] = "18";
        $paramssld["htc_view2_load_more_font_size"] = "22";
        $paramssld["htc_view3_load_more_font_size"] = "20";
        $paramssld["htc_view0_load_more_font_color"] = "F2F2F2";
        $paramssld["htc_view1_load_more_font_color"] = "F2F2F2";
        $paramssld["htc_view2_load_more_font_color"] = "F2F2F2";
        $paramssld["htc_view3_load_more_font_color"] = "F2F2F2";
        $paramssld["htc_view0_load_more_font_hover_color"] = "F2F2F2";
        $paramssld["htc_view1_load_more_font_hover_color"] = "F2F2F2";
        $paramssld["htc_view2_load_more_font_hover_color"] = "F2F2F2";
        $paramssld["htc_view3_load_more_font_hover_color"] = "FFFFFF";
        $paramssld["htc_view0_load_more_button_background_color"] = "A1A1A1";
        $paramssld["htc_view1_load_more_button_background_color"] = "A1A1A1";
        $paramssld["htc_view2_load_more_button_background_color"] = "FF2C2C";
        $paramssld["htc_view3_load_more_button_background_color"] = "A1A1A1";
        $paramssld["htc_view0_load_more_button_background_hover_color"] = "A1A1A1";
        $paramssld["htc_view1_load_more_button_background_hover_color"] = "A1A1A1";
        $paramssld["htc_view2_load_more_button_background_hover_color"] = "991A1A";
        $paramssld["htc_view3_load_more_button_background_hover_color"] = "A1A1A1";
        $paramssld["htc_view0_load_more_loading_icon"] = "1";
        $paramssld["htc_view1_load_more_loading_icon"] = "1";
        $paramssld["htc_view2_load_more_loading_icon"] = "1";
        $paramssld["htc_view3_load_more_loading_icon"] = "1";
        
        $paramssld["htc_view0_pagination_font_size"] = "22";
        $paramssld["htc_view1_pagination_font_size"] = "22";
        $paramssld["htc_view2_pagination_font_size"] = "22";
        $paramssld["htc_view3_pagination_font_size"] = "22";
        $paramssld["htc_view0_pagination_font_color"] = "000";
        $paramssld["htc_view1_pagination_font_color"] = "000";
        $paramssld["htc_view2_pagination_font_color"] = "000";
        $paramssld["htc_view3_pagination_font_color"] = "000";
        $paramssld["htc_view0_pagination_icon_size"] = "22";
        $paramssld["htc_view1_pagination_icon_size"] = "22";
        $paramssld["htc_view2_pagination_icon_size"] = "22";
        $paramssld["htc_view3_pagination_icon_size"] = "22";
        $paramssld["htc_view0_pagination_icon_color"] = "000";
        $paramssld["htc_view1_pagination_icon_color"] = "000";
        $paramssld["htc_view2_pagination_icon_color"] = "000";
        $paramssld["htc_view3_pagination_icon_color"] = "000";
        $paramssld["htc_view0_pagination_position"] = "center";
        $paramssld["htc_view1_pagination_position"] = "center";
        $paramssld["htc_view2_pagination_position"] = "center";
        $paramssld["htc_view3_pagination_position"] = "center";
		
		/** <add search> **/
		$paramssld['ht_view0_search_form_width']= '94';
		$paramssld['ht_view0_search_form_position']='left';   
		$paramssld['ht_view0_search_form_border_radius']= '0';	
		$paramssld['ht_view0_search_form_border_color']='dedede';	
		$paramssld['ht_view0_search_form_border_width']= '1';	
		$paramssld['ht_view0_search_button_background'] = '6EBFDC';
		$paramssld['ht_view0_search_button_hover_color'] = '718B94';
		$paramssld['ht_view0_search_button_text_color'] ='ffffff';	
		$paramssld['ht_view1_search_form_width']= '94';
		$paramssld['ht_view1_search_form_position']='left';   
		$paramssld['ht_view1_search_form_border_radius']= '0';	
		$paramssld['ht_view1_search_form_border_color']='dedede';	
		$paramssld['ht_view1_search_form_border_width']= '1';	
		$paramssld['ht_view1_search_button_background'] = '6EBFDC';
		$paramssld['ht_view1_search_button_hover_color'] = '718B94';
		$paramssld['ht_view1_search_button_text_color'] ='ffffff';	
		$paramssld['ht_view2_search_form_width']= '94';
		$paramssld['ht_view2_search_form_position']='left';   
		$paramssld['ht_view2_search_form_border_radius']= '0';	
		$paramssld['ht_view2_search_form_border_color']='dedede';	
		$paramssld['ht_view2_search_form_border_width']= '1';	
		$paramssld['ht_view2_search_button_background'] = '6EBFDC';
		$paramssld['ht_view2_search_button_hover_color'] = '718B94';
		$paramssld['ht_view2_search_button_text_color'] ='ffffff';		
		$paramssld['ht_view3_search_form_width']= '94';
		$paramssld['ht_view3_search_form_position']='left';   
		$paramssld['ht_view3_search_form_border_radius']= '0';	
		$paramssld['ht_view3_search_form_border_color']='dedede';	
		$paramssld['ht_view3_search_form_border_width']= '1';	
		$paramssld['ht_view3_search_button_background'] = '6EBFDC';
		$paramssld['ht_view3_search_button_hover_color'] = '718B94';
		$paramssld['ht_view3_search_button_text_color'] ='ffffff';					
		
		/** </add search> **/
                
?>
<script>
        var allowZooming;
        var allowLightbox;
            var for_zoom;
            if("<?php echo $paramssld['ht_catalog_zoom_thumbs_zoom']; ?>" == "on"){
                for_zoom = ".for_zoom img, .thumbs-block img";
            }
            else if("<?php echo $paramssld['ht_catalog_zoom_thumbs_zoom']; ?>" == "off"){
                for_zoom = ".for_zoom img";
            }
            var view_num = <?php echo $catalogeffect; ?>;
            
            var catalogZoomType = "<?php echo $paramssld['ht_catalog_zoom_window_type'];?>";
		var catalogWindowWidth = <?php echo $paramssld['ht_catalog_zoom_window_width'];?>;
		var catalogWindowHeight = <?php echo $paramssld['ht_catalog_zoom_window_height'];?>;
		var catalogWindowOffetx = <?php echo $paramssld['ht_catalog_zoom_x_asis'];?>;
		var catalogWindowOffety = <?php echo $paramssld['ht_catalog_zoom_y_asis'];?>;
		var catalogWindowPosition = <?php echo $paramssld['ht_catalog_zoom_window_position'];?>;
		var catalogBorderSize = <?php echo $paramssld['ht_catalog_zoom_window_border_size'];?>;
		var catalogBorderColour = "<?php echo $paramssld['ht_catalog_zoom_window_border_color'];?>";
		var catalogWindowFadeIn = <?php echo $paramssld['ht_catalog_zoom_window_fadein'];?>;
		var catalogWindowFadeOut = <?php echo $paramssld['ht_catalog_zoom_window_fadeout'];?>;
		var catalogLensSize = <?php echo $paramssld['ht_catalog_zoom_window_lens_size'];?>;

		var catalogLensFadeIn = <?php echo $paramssld['ht_catalog_zoom_lens_fadein'];?>;
		var catalogLensFadeOut = <?php echo $paramssld['ht_catalog_zoom_lens_fadeout'];?>;
		var catalogZoomLens = <?php echo $paramssld['ht_catalog_zoom_lens_hide'];?>;
		var catalogLensShape = "<?php echo $paramssld['ht_catalog_zoom_lens_shape'];?>";
		var catalogLensColour = "<?php echo $paramssld['ht_catalog_zoom_lens_color'];?>";
		var catalogLensOpacity = <?php echo $paramssld['ht_catalog_zoom_lens_opacity'];?>/100;
		var catalogCursor = "<?php echo $paramssld['ht_catalog_zoom_cursor'];?>";
                if(catalogZoomType != "inner") { var catalogScrollZoom = <?php echo $paramssld['ht_catalog_zoom_scrollzoom'];?>; }
                else{ var catalogScrollZoom = false; }
                                                          
		var catalogEasing = <?php echo $paramssld['ht_catalog_zoom_easing'];?>;

		var catalogTint = <?php echo $paramssld['ht_catalog_zoom_tint'];?>;
		var catalogTintColour = "<?php echo $paramssld['ht_catalog_zoom_tint_colour'];?>";
		var catalogTintOpacity = <?php echo $paramssld['ht_catalog_zoom_tint_opacity'];?>/100;
		var catalogZoomTintFadeIn = <?php echo $paramssld['ht_catalog_zoom_tint_fadein'];?>;
		var catalogZoomTintFadeOut = <?php echo $paramssld['ht_catalog_zoom_tint_fadeout'];?>;

		var catalogGallery = null;
            
            var lightbox_transition = '<?php echo $paramssld['light_box_transition'];?>';
            var lightbox_speed = <?php echo $paramssld['light_box_speed'];?>;
            var lightbox_fadeOut = <?php echo $paramssld['light_box_fadeout'];?>;
            var lightbox_title = <?php echo $paramssld['light_box_title'];?>;
            var lightbox_scalePhotos = <?php echo $paramssld['light_box_scalephotos'];?>;
            var lightbox_scrolling = <?php echo $paramssld['light_box_scrolling'];?>;
            var lightbox_opacity = <?php echo ($paramssld['light_box_opacity']/100)+0.001;?>;
            var lightbox_open = <?php echo $paramssld['light_box_open'];?>;
            var lightbox_returnFocus = <?php echo $paramssld['light_box_returnfocus'];?>;
            var lightbox_trapFocus = <?php echo $paramssld['light_box_trapfocus'];?>;
            var lightbox_fastIframe = <?php echo $paramssld['light_box_fastiframe'];?>;
            var lightbox_preloading = <?php echo $paramssld['light_box_preloading'];?>;
            var lightbox_overlayClose = <?php echo $paramssld['light_box_overlayclose'];?>;
            var lightbox_escKey = <?php echo $paramssld['light_box_esckey'];?>;
            var lightbox_arrowKey = <?php echo $paramssld['light_box_arrowkey'];?>;
            var lightbox_loop = <?php echo $paramssld['light_box_loop'];?>;
            var lightbox_closeButton = <?php echo $paramssld['light_box_closebutton'];?>;
            var lightbox_previous = "<?php echo $paramssld['light_box_previous'];?>";
            var lightbox_next = "<?php echo $paramssld['light_box_next'];?>";
            var lightbox_close = "<?php echo $paramssld['light_box_close'];?>";
            var lightbox_html = <?php echo $paramssld['light_box_html'];?>;
            var lightbox_photo = <?php echo $paramssld['light_box_photo'];?>;
            var lightbox_width = '<?php if($paramssld['light_box_size_fix'] == 'false'){ echo 'false';} else { echo $paramssld['light_box_width']; } ?>';
            var lightbox_height = '<?php if($paramssld['light_box_size_fix'] == 'false'){ echo 'false';} else { echo $paramssld['light_box_height']; } ?>';
            var lightbox_innerWidth = '<?php echo $paramssld['light_box_innerwidth'];?>';
            var lightbox_innerHeight = '<?php echo $paramssld['light_box_innerheight'];?>';
            var lightbox_initialWidth = '<?php echo $paramssld['light_box_initialwidth'];?>';
            var lightbox_initialHeight = '<?php echo $paramssld['light_box_initialheight'];?>';

            var maxwidth=jQuery(window).width();
            if(maxwidth><?php echo $paramssld['light_box_maxwidth'];?>){ maxwidth=<?php echo $paramssld['light_box_maxwidth'];?>; }
            var lightbox_maxWidth = <?php if($paramssld['light_box_size_fix'] == 'true'){ echo '"100%"';} else { echo 'maxwidth'; } ?>;
            var lightbox_maxHeight = <?php if($paramssld['light_box_size_fix'] == 'true'){ echo '"100%"';} else { echo $paramssld['light_box_maxheight']; } ?>;

            var lightbox_slideshow = <?php echo $paramssld['light_box_slideshow'];?>;
            var lightbox_slideshowSpeed = <?php echo $paramssld['light_box_slideshowspeed'];?>;
            var lightbox_slideshowAuto = <?php echo $paramssld['light_box_slideshowauto'];?>;
            var lightbox_slideshowStart = "<?php echo $paramssld['light_box_slideshowstart'];?>";
            var lightbox_slideshowStop = "<?php echo $paramssld['light_box_slideshowstop'];?>";
            var lightbox_fixed = <?php echo $paramssld['light_box_fixed'];?>;
        
        
	<?php
	$pos = $paramssld['slider_title_position'];
	switch($pos){
	case 1:
	?>
		var lightbox_top = '10%';
		var lightbox_bottom = false;
		var lightbox_left = '10%';
		var lightbox_right = false;
	<?php
	break;	
	case 1:
	?>
		var lightbox_top = '10%';
		var lightbox_bottom = false;
		var lightbox_left = '10%';
		var lightbox_right = false;
	<?php
	break;	
	case 2:
	?>
		var lightbox_top = '10%';
		var lightbox_bottom = false;
		var lightbox_left = false;
		var lightbox_right = false;
	<?php
	break;	
	case 3:
	?>
		var lightbox_top = '10%';
		var lightbox_bottom = false;
		var lightbox_left = false;
		var lightbox_right = '10%';
	<?php
	break;
	case 4:
	?>
		var lightbox_top = false;
		var lightbox_bottom = false;
		var lightbox_left = '10%';
		var lightbox_right = false;
	<?php
	break;	
	case 5:
	?>
		var lightbox_top = false;
		var lightbox_bottom = false;
		var lightbox_left = false;
		var lightbox_right = false;
	<?php
	break;	
	case 6:
	?>
		var lightbox_top = false;
		var lightbox_bottom = false;
		var lightbox_left = false;
		var lightbox_right = '10%';
	<?php
	break;	
	case 7:
	?>
		var lightbox_top = false;
		var lightbox_bottom = '10%';
		var lightbox_left = '10%';
		var lightbox_right = false;
	<?php
	break;	
	case 8:
	?>
		var lightbox_top = false;
		var lightbox_bottom = '10%';
		var lightbox_left = false;
		var lightbox_right = false;
	<?php
	break;	
	case 9:
	?>
		var lightbox_top = false;
		var lightbox_bottom = '10%';
		var lightbox_left = false;
		var lightbox_right = '10%';
	<?php
	break;	
	} ?>
	
	var lightbox_reposition = <?php echo $paramssld['light_box_reposition'];?>;
	var lightbox_retinaImage = <?php echo $paramssld['light_box_retinaimage'];?>;
	var lightbox_retinaUrl = <?php echo $paramssld['light_box_retinaurl'];?>;
	var lightbox_retinaSuffix = "<?php echo $paramssld['light_box_retinasuffix'];?>";
    var disable_right_click = '<?php echo get_option( 'product_catalog_disable_right_click' ); ?>' == 'on';
	
				jQuery(document).ready(function(){

                                        var group_count = 0;
                                        jQuery(".catalog_ccolorbox_grouping_<?php echo $catalogID; ?>").each(function(){
                                            group_count++;
                                        });
                                        var i;
                                        for(i = 1; i <= group_count; i++){
                                            jQuery(".catalog_group" + i + "<?php echo "_".$catalogID; ?>").ccolorbox({rel:'catalog_group' + i + "<?php echo "_".$catalogID; ?>"});
                                        }

                                        var catalog_slider_slides_count = 0;
                                        jQuery(".slider-content").each(function(){
                                            catalog_slider_slides_count++;
                                        });
                                        catalog_slider_slides_count = catalog_slider_slides_count - 1;
                                        
                                        for(i = 1; i <= catalog_slider_slides_count; i++){
                                            jQuery(".catalog_slider_group" + i + "_<?php echo $catalogID; ?>").ccolorbox({rel:'catalog_slider_group' + i + "_<?php echo $catalogID; ?>"});
                                            jQuery(".clone .catalog_slider_group" + i + "_<?php echo $catalogID; ?>").removeClass("catalog_slider_group" + i + "_<?php echo $catalogID; ?>" + " ccboxElement");
                                        }
                                        //alert(catalog_slider_slides_count);
                                        
                                        jQuery(".callbacks").ccolorbox({
                                                onOpen:function(){ alert('onOpen: ccolorbox is about to open'); },
                                                onLoad:function(){ alert('onLoad: ccolorbox has started to load the targeted content'); },
                                                onComplete:function(){ alert('onComplete: ccolorbox has displayed the loaded content'); },
                                                onCleanup:function(){ alert('onCleanup: ccolorbox has begun the close process'); },
                                                onClosed:function(){ alert('onClosed: ccolorbox has completely closed'); }
                                        });
        
                                        jQuery('.non-retina').ccolorbox({rel:'group5', transition:'none'})
                                        jQuery('.retina').ccolorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
        				
        
                                        jQuery("#click").click(function(){ 
                                                jQuery('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
                                                return false;
                                        });
                                });
</script>
<script>
function HugeCatalogSearch_<?php echo $catalogID; ?>(searchText,type,paginationType,view_obj) {
			var existElements,data,query,group_count,i,max_count;

                max_count = <?php echo $myAllImages; ?>;
				data = {};
				data.type = type;
				data.pagetype = paginationType;
				data.text = searchText;
				jQuery.extend(data,view_obj);
				
				if(type == 'load') {
					jQuery('.load_more_elements_<?php echo $catalogID; ?>').css({ "display" : "none" });
					jQuery('.catalog_load_block_<?php echo $catalogID; ?>').find(".load_more_loading_icon").css({ "display" : "" });
					existElements = '('+getCurrentElementsId_<?php echo $catalogID; ?>().toString()+')';
					data.elements = existElements;
				}
				else {
					jQuery(".catalog_load_block_<?php echo $catalogID; ?>").css('display','block');             
					jQuery('#huge_it_catalog_container_<?php echo $catalogID; ?>').html('');
				}
                
				jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function(response) {
					response = JSON.parse(response);
					 query = response.query;
					 var morePopups = response.morePopups;
					response = response.moreImages;
					if(view_obj.show_popup_linkbutton) {//when content popup
						jQuery("#huge_it_catalog_popup_list_<?php echo $catalogID; ?>").append(morePopups);
					}
					if(type=='load') {
						 if(!response) {
							 jQuery(".catalog_load_block_<?php echo $catalogID; ?>").css('display','none'); 
							 jQuery('#search_block_<?php echo $catalogID; ?> form > input').keyup();
						 }
						 jQuery("#huge_it_catalog_container_<?php echo $catalogID; ?>").append(response);
                          jQuery("#huge_it_catalog_container_<?php echo $catalogID; ?> img").load(function () {
                                 if( getCurrentElementsId_<?php echo $catalogID; ?>().length >=  max_count){
                                        jQuery(".catalog_load_block_<?php echo $catalogID; ?>").css('display','none');
                                 }
                                 else jQuery(".catalog_load_block_<?php echo $catalogID; ?>").css('display','block');
                          });
                           setTimeout(function () {
                                  if( jQuery(window).width() >= 600) {
                                         jQuery('.main-image-block.not_for_zoom').hide();
                                         jQuery('.main-image-block.for_zoom').show();
                                  }
                           },100);
                           if(disable_right_click) {
                                  jQuery('section[id^="huge_it_catalog_content_"] img, ul[id^="huge_it_catalog_popup_list_"] img, div[id^="main-slider_"] img').bind('contextmenu', function () {
                                         return false;
                                  });
                                  jQuery('#ccolorbox').bind('contextmenu', '#pcboxLoadedContent img', function () {
                                         return false;
                                  });
                           }
					}
					else {
						if(response != '') {
							jQuery("#huge_it_catalog_container_<?php echo $catalogID; ?>").append(response);
							jQuery('#huge_it_catalog_content_<?php echo $catalogID; ?>').find('#search_not_results_<?php echo $catalogID; ?>').css('display','none');		
						}							
						else {
							jQuery('#huge_it_catalog_content_<?php echo $catalogID; ?>').find('#search_not_results_<?php echo $catalogID; ?>').css('display','block');
							jQuery(".catalog_load_block_<?php echo $catalogID; ?>").css('display','none'); 
							jQuery('#search_block_<?php echo $catalogID; ?> form > input').keyup();
						}

                        if(disable_right_click) {
                               jQuery('section[id^="huge_it_catalog_content_"] img, ul[id^="huge_it_catalog_popup_list_"] img, div[id^="main-slider_"] img').bind('contextmenu', function () {
                                      return false;
                               });
                               jQuery('#ccolorbox').bind('contextmenu', '#pcboxLoadedContent img', function () {
                                      return false;
                               });
                        }
					}
                        setTimeout(function(){
                              jQuery("#huge_it_catalog_container_<?php echo $catalogID; ?>").hugeitmicro('reloadItems' ).hugeitmicro({ sortBy: 'original-order' }).hugeitmicro( 'reLayout' );
                              jQuery(".load_more_elements_<?php echo $catalogID; ?>").css({ "display" : "" });
                              jQuery(".load_more_elements_<?php echo $catalogID; ?>").parent().find(".load_more_loading_icon").css({ "display" : "none" });
                       }, 100);
						if(data.allow_lightbox == "on") {
                               setccolorboxGrouping();
                               group_count = getCurrentElementsId_<?php echo $catalogID; ?>().length;

                               for(i = 0; i <= group_count; i++){
                                      jQuery(".catalog_group" + i + "<?php echo "_".$catalogID; ?>").ccolorbox({rel:'catalog_group' + i + "<?php echo "_".$catalogID; ?>"});
                               }
                               for(i = 0; i <= group_count; i++){
                                      jQuery(".catalog_group_not_for_zoom" + i + "<?php echo "_".$catalogID; ?>").ccolorbox({rel:'catalog_group_not_for_zoom' + i + "<?php echo "_".$catalogID; ?>"});
                               }
						}
                        zoom_resize();               //      CALLING ELEVATEZOOM 
						
                });
 };
  function getCurrentElementsId_<?php echo $catalogID; ?>() {
	 var ExistElementsArray = [];
	 jQuery('#huge_it_catalog_container_<?php echo $catalogID; ?> .element_<?php echo $catalogID; ?>').each(function(){
		 ExistElementsArray.push(jQuery(this).attr('data-element-id'));
	 });
	 return ExistElementsArray;
 }
 
 function setccolorboxGrouping() {
	 var i = 0;
	 jQuery('#huge_it_catalog_container_<?php echo $catalogID; ?> .element_<?php echo $catalogID; ?>').each(function(){
		 jQuery(this).find('img').parent('a').not('.not_for_zoom_class').removeClass().addClass('catalog_group'+i+'_'+<?php echo $catalogID; ?>);
		 i++;
	 });
 }
 
/****<calling events for loading elements> ***/
 
	jQuery(function(){
		if('<?php echo $catalogSearch;?>' == 'on') {

			jQuery('#search_block_<?php echo $catalogID; ?> > form').submit(function(event){
				event.preventDefault();
				jQuery('#search_block_<?php echo $catalogID; ?> form > input').keyup();
				var searchText = jQuery(this).find('input').val();
				HugeCatalogSearch_<?php echo $catalogID; ?>(searchText,'search','<?php echo $catalog[0]->pagination_type;?>',$ob_<?php echo $catalogID; ?>);
			});
			
			jQuery('#search_block_<?php echo $catalogID; ?> form > input').on('keyup',function(event){
				event.preventDefault();
				(jQuery(this).val() != '')?jQuery(this).next().css('display','block'):jQuery(this).next().css('display','none');
			});	
			jQuery('#search_block_<?php echo $catalogID; ?> form > input+div').on('click',function(event){
				event.preventDefault();
				(jQuery(this).prev().val(''))&&(jQuery(this).prev().attr('placeholder','Search products...'));
				jQuery(this).css('display','none');
				HugeCatalogSearch_<?php echo $catalogID; ?>('','search','<?php echo $catalog[0]->pagination_type;?>',$ob_<?php echo $catalogID; ?>);
				jQuery('#huge_it_catalog_content_<?php echo $catalogID; ?>').find('#search_not_results_<?php echo $catalogID; ?>').css('display','none');				
			});				
			jQuery('.show_all_<?php echo $catalogID; ?>').click(function(){						
				jQuery('#search_items_<?php echo $catalogID; ?>').find('#search_block_<?php echo $catalogID; ?> form > input').val('');
				jQuery(this).css('display','none');
				HugeCatalogSearch_<?php echo $catalogID; ?>('','show_all','<?php echo $catalog[0]->pagination_type;?>',$ob_<?php echo $catalogID; ?>);														
			});
			
		}
				/*        <!--     VIEW 0 LOAD MORE CLICK          */
				
		jQuery(".load_more_elements_<?php echo $catalogID; ?>").click(function(){
			jQuery('#search_block_<?php echo $catalogID; ?> form > input').keyup();
			var searchText = jQuery(this).parents('#huge_it_catalog_content_<?php echo $catalogID; ?>').find('#search_block_<?php echo $catalogID; ?> form > input').val();
			searchText||(searchText='');
			HugeCatalogSearch_<?php echo $catalogID; ?>(searchText,'load','<?php echo $catalog[0]->pagination_type;?>',$ob_<?php echo $catalogID; ?>);
			return false;                            
		});	
	});

/****</calling events for loading elements> ***/
</script>
	<!--Huge IT catalog START-->
	<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' );?>
	<link href="<?php echo plugins_url('../style/colorbox-'.$paramssld['light_box_style'].'.css', __FILE__);?>" rel="stylesheet" type="text/css" />
		
	<?php
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( !(is_plugin_active( 'wp-lightbox-2/wp-lightbox-2.php' ) )) { ?>

	<?php } ?>
	
	
	
	

	<?php 
	$i = $catalogeffect;
	switch ($i) {
	
	
	/////////////////////////////// VIEW 0 Toggle Up/Down Blocks /////////////////////////////////////////
    case 0:
	?>

<?php
if($catalog[0]->pagination_type == "show_all"){
    $myAllImages = count($images);
    if($myAllImages < $catalog[0]->count_into_page)            //update pagination bug
        $countIntoPage = $myAllImages;
    else
    $countIntoPage = $catalog[0]->count_into_page;
    if($countIntoPage == "" || $countIntoPage < 1){ $countIntoPage = 1; }
    $pages = ceil($myAllImages / $countIntoPage);
    if(isset($_GET["catalog_page_".$catalogID])){ $page_index = absint($_GET["catalog_page_".$catalogID]); }
    else{ $page_index = 1; }
    $maxCount = $page_index * $countIntoPage;
    $morePaste = $maxCount - $myAllImages;
}
else{
    if(isset($_GET["catalog_page_".$catalogID])){
            $myAllImages = count($images);
            if($myAllImages < $catalog[0]->count_into_page)            //update pagination bug
                $countIntoPage = $myAllImages;
            else
                $countIntoPage = $catalog[0]->count_into_page;    echo 'aaa'.$countIntoPage;       
            $pages = ceil($myAllImages / $countIntoPage);
            $page_index = absint($_GET["catalog_page_".$catalogID]);
            $maxCount = $page_index * $countIntoPage;
            $morePaste = $maxCount - $myAllImages;
            
//            var_dump($page_index." ".$countIntoPage." ".$maxCount." ".$morePaste." ".$myAllImages." ".$pages);
            if($page_index <= 1 || ($maxCount > $myAllImages) && $morePaste > $countIntoPage){
                $imagesUsefulElements = array();
                for($usefulKeys = 0; $usefulKeys < $countIntoPage; $usefulKeys++){
                    $imagesUsefulElements[] = $images[$usefulKeys];
                }
                $images = $imagesUsefulElements;
            }
            elseif (($maxCount <= $myAllImages) || ($maxCount > $myAllImages && $morePaste <= $countIntoPage)){
                $show_from = $page_index * $countIntoPage - $countIntoPage;
                $show_until = $page_index * $countIntoPage - 1;
                $usefulElementsKey = 0;
                
                foreach($images as $galleryElements){
                    if($usefulElementsKey >= $show_from && $usefulElementsKey <= $show_until){
                        $imagesUsefulElements[] = $galleryElements;
                    }
                    $usefulElementsKey++;
                }
                $images = $imagesUsefulElements;
            }
    }
    else{
        $myAllImages = count($images);
        $page_index = 1;
        if($myAllImages < $catalog[0]->count_into_page)            //update pagination bug
            $countIntoPage = $myAllImages;
        else
        $countIntoPage = $catalog[0]->count_into_page;
        if($countIntoPage == "" || $countIntoPage < 1){ $countIntoPage = 1; }
        $pages = ceil($myAllImages / $countIntoPage);
        $imagesUsefulElements = array();
        for($usefulKeys = 0; $usefulKeys < $countIntoPage; $usefulKeys++){
            $imagesUsefulElements[] = $images[$usefulKeys];
        }
        $images = $imagesUsefulElements;
    }
}

?>
<style type="text/css">

.element_<?php echo $catalogID; ?> {
	background:#<?php echo $paramssld['ht_view0_element_background_color']?>;
	width:<?php echo $paramssld['ht_view0_block_width']; ?>px !important;
	margin: 5px;
	float: left;
	overflow: hidden;
	outline:none;
	border:<?php echo $paramssld['ht_view0_element_border_width']; ?>px solid #<?php echo $paramssld['ht_view0_element_border_color']; ?>;
    max-width: calc(100% - 10px);
}

.element_<?php echo $catalogID; ?>.large,
.variable-sizes .element_<?php echo $catalogID; ?>.large,
.variable-sizes .element_<?php echo $catalogID; ?>.large.width2.height2 {
	width: <?php echo $paramssld['ht_view0_block_width']; ?>px;
	z-index: 10;
}

.default-block_<?php echo $catalogID; ?> {
	position:relative;
	width:<?php echo $paramssld['ht_view0_block_width']; ?>px !important;
	height:<?php echo $paramssld['ht_view0_block_height']+45;?>px !important;
    max-width: 100%;
} 

.default-block_<?php echo $catalogID; ?> .image-block_<?php echo $catalogID; ?> {
	margin:0px;
	padding:0px;
	line-height:0px;
	border-bottom:1px solid #<?php echo $paramssld['ht_view0_element_border_color']; ?>;
}

.default-block_<?php echo $catalogID; ?> img {
	margin:0px !important;
	padding:0px !important;
	max-width:none !important;
	width:<?php echo $paramssld['ht_view0_block_width']; ?>px !important;
	height:<?php echo $paramssld['ht_view0_block_height']; ?>px !important;
	border-radius:0px;
}

.default-block_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> {
	position:relative;
	display:block;
	height:35px;
	padding:10px 0px 0px 0px;
	width:<?php echo $paramssld['ht_view0_block_width']; ?>px !important;
    max-width: 100%;
}

.default-block_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> h3 {
	position:relative;
	margin:0px !important;
	padding:0px 0px 0px 5px !important;
	width:<?php echo $paramssld['ht_view0_block_width']-30; ?>px !important;
	text-overflow: ellipsis;
	overflow: hidden; 
	white-space:nowrap;
	font-weight:normal;
	color:#<?php echo $paramssld['ht_view0_title_font_color']; ?>;
	font-size:<?php echo $paramssld['ht_view0_title_font_size']; ?>px !important;
	line-height:<?php echo $paramssld['ht_view0_title_font_size']+4; ?>px !important;
}

.element_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> .open-close-button {
	width:20px;
	height:20px;
	display:block;
	position:absolute;
	top:13px;
	right:2%;
	background:url('<?php echo  plugins_url( '../images/open-close.'.$paramssld['ht_view0_togglebutton_style'].'.png' , __FILE__ ); ?>') left top no-repeat;
	z-index:5;
	cursor:pointer;
	opacity:0.33;
}

 .element_<?php echo $catalogID; ?>:hover .title-block_<?php echo $catalogID; ?> .open-close-button {opacity:1;}

.element_<?php echo $catalogID; ?>.large .open-close-button {
	background:url('<?php echo  plugins_url( '../images/open-close.'.$paramssld['ht_view0_togglebutton_style'].'.png' , __FILE__ ); ?>') left bottom no-repeat;
}

.wd-catalog-panel_<?php echo $catalogID; ?> {
	position: absolute;
	display:block;
	width:<?php echo $paramssld['ht_view0_block_width']-10; ?>px !important;
	margin:0px 5px 0px 5px;
	padding:0px;
	text-align:left;
	top:<?php echo $paramssld['ht_view0_block_height']+45; ?>px;  
	z-index:6; 
	height:200px;
}


.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?>, .element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> * {
	position:relative;
	clear:both;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> p,.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> {	
	text-align:justify;
	font-weight:normal;
	font-size:<?php echo $paramssld['ht_view0_description_font_size']; ?>px;
	color:#<?php echo $paramssld['ht_view0_description_color']; ?>;
	margin:0px;
	padding:0px;
}



.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> h1,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> h2,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> h3,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> h4,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> h5,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> h6,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> p, 
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> strong,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> span {
	padding:2px !important;
	margin:0px !important;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> ul,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> li {
	padding:2px 0px 2px 5px;
	margin:0px 0px 0px 8px;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .price-block_<?php echo $catalogID; ?> {
    color: #<?php echo $paramssld['ht_catalog_view0_price_font_color']?>;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .price-block_<?php echo $catalogID; ?> .old-price {
	text-decoration: line-through;
        margin: 0px;
        padding: 0px;
        font-weight: normal;
/*        font-size: 14px;*/
        padding: 7px 10px 7px 10px;
        margin: 0px 10px 0px 0px;
        border-radius: 5px;
        color: #<?php echo $paramssld['ht_view0_element_background_color']?>;
        background: #<?php echo $paramssld['ht_catalog_view0_price_font_color']?>;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .price-block_<?php echo $catalogID; ?>> .old-price-block {
	font-size: <?php echo $paramssld['ht_catalog_view0_price_font_size']; ?>px;
        color: #<?php echo $paramssld['ht_catalog_view0_price_font_color']; ?>;
        
}

.wd-catalog-panel_<?php echo $catalogID; ?> .price-block_<?php echo $catalogID; ?>> .discont-price-block {
	/*font-size: <?php echo $paramssld['ht_catalog_view0_market_price_font_size']; ?>px;*/
        /*color: #<?php echo $paramssld['ht_catalog_view0_market_price_font_color']; ?>;*/
}

.wd-catalog-panel_<?php echo $catalogID; ?> .thumbs-list_<?php echo $catalogID; ?> {
	position:relative;
	clear:both;
	list-style:none;
	//display:table;
	width:100%;
	padding:0px;
	margin:3px 0px 0px 0px;
	text-align:center;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .thumbs-list_<?php echo $catalogID; ?> li {
	display:inline-block;
	margin:0px 3px 0px 2px;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .thumbs-list_<?php echo $catalogID; ?> li a {
	display:block;
	width:<?php echo $paramssld['ht_view0_thumbs_width']; ?>px;
	height:<?php echo $paramssld['ht_view0_thumbs_width']; ?>px;
	opacity:0.7;
	display:table;
        border: none;
        text-decoration: none;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .thumbs-list_<?php echo $catalogID; ?> li a:hover {
	opacity:1;
}

.wd-catalog-panel_<?php echo $catalogID; ?> img {
	margin:0px !important;
	padding:0px !important;
	display:table-cell;
	vertical-align:middle;
	width:<?php echo $paramssld['ht_view0_thumbs_width']; ?>px !important;
	max-height:<?php echo $paramssld['ht_view0_thumbs_width']; ?>px !important;
	width:100%;
	height:100%;
}

.wd-catalog-panel_<?php echo $catalogID; ?> > div {
	position:relative;
	clear:both;
	padding: 15px 0 3px 0px;
	margin-bottom:10px;
	<?php if($paramssld['ht_view0_show_separator_lines']=="on") {?>
		background:url('<?php echo  plugins_url( '../images/divider.line.png' , __FILE__ ); ?>') center top repeat-x;
	<?php } ?>
}

.wd-catalog-panel_<?php echo $catalogID; ?> .button-block {
	padding-top:10px;
	margin-bottom:10px;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .button-block a, .wd-catalog-panel_<?php echo $catalogID; ?> .button-block a:link, .wd-catalog-panel_<?php echo $catalogID; ?> .button-block a:visited {
	padding:6px 12px;
	text-decoration:none;
	display:inline-block;
	font-size:<?php echo $paramssld['ht_view0_linkbutton_font_size']; ?>px;
	background:#<?php echo $paramssld['ht_view0_linkbutton_background_color']; ?>;
	color:#<?php echo $paramssld['ht_view0_linkbutton_color']; ?>;
        border: none;
        text-decoration: none;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .button-block a:hover, .wd-catalog-panel_<?php echo $catalogID; ?> .button-block a:focus, .wd-catalog-panel_<?php echo $catalogID; ?> .button-block a:active {
	background:#<?php echo $paramssld['ht_view0_linkbutton_background_hover_color']; ?>;
	color:#<?php echo $paramssld['ht_view0_linkbutton_font_hover_color']; ?>;
	text-decoration:none;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> {
    <?php if ($paramssld["ht_view0_show_sorting"] == 'off')
    echo "display:none;";
    if($paramssld["ht_view0_filtering_float"] == 'left' && $paramssld["ht_view0_sorting_float"] == 'none') { if($catalogShowFiltering == "on") { echo "margin-left: 31%;"; } else echo "margin-left: 1%;"; }
    else if($paramssld["ht_view0_filtering_float"] == 'right' && $paramssld["ht_view0_sorting_float"] == 'none' || ($sorting_block_width == '100%' && $filtering_block_width == "100%")) { echo "margin-left: 1%;"; } ?>
    overflow: hidden;
    margin-top: 5px;
    float: <?php echo $paramssld["ht_view0_sorting_float"]; ?>;
    width: <?php echo $sorting_block_width; ?>;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul {
  margin: 0px !important;
  padding: 0px !important;
  list-style: none;
<?php if($paramssld["ht_view0_sorting_float"] == 'top') {
      echo "float:left;margin-left:1%;";
      } ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> ul {
  margin: 0px !important;
  padding: 0px !important;
  overflow: hidden;
  <?php if($paramssld["ht_view0_filtering_float"] == 'top') {
      echo "float:left;margin-left:1%;";
      } ?>
}

<?php if($paramssld["ht_view0_sorting_float"] == 'none') { ?>
            #huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul {
                float: left;
            }
    <?php } ?>
            
#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li {
    border-radius: <?php echo $paramssld["ht_view0_sortbutton_border_radius"];?>px;
    list-style-type: none;
    margin: 0px !important;
    <?php
        if($sorting_block_width == "100%" ) {
            echo "float:left !important;margin: 4px 8px 4px 0px !important;";
        }
        if($left_to_top == "ok")
        { echo "float:left !important;"; }
        if($paramssld["ht_view0_sorting_float"] == "left" || $paramssld["ht_view0_sorting_float"] == "right")
        { echo 'border-bottom: 1px solid #ccc;'; }
        else
        { echo 'border: 1px solid #ccc;'; }
    ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li a {
    background-color: #<?php echo $paramssld["ht_view0_sortbutton_background_color"];?> !important;
    font-size:<?php echo $paramssld["ht_view0_sortbutton_font_size"];?>px !important;
    color:#<?php echo $paramssld["ht_view0_sortbutton_font_color"];?> !important;
    text-decoration: none;
    cursor: pointer;
    margin: 0px !important;
    display: block;
    padding:3px;
}

/*#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li:hover {
    
}*/

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li a:hover {
    background-color: #<?php echo $paramssld["ht_view0_sortbutton_hover_background_color"];?> !important;
    color:#<?php echo $paramssld["ht_view0_sortbutton_hover_font_color"];?> !important;
    cursor: pointer;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> {
    margin-top: 5px;
    float: <?php echo $paramssld["ht_view0_filtering_float"]; ?>;
    width: <?php echo $filtering_block_width; ?>;
    <?php
        if ($paramssld["ht_view0_show_filtering"] == 'off') echo "display:none;";
        if($paramssld["ht_view0_filtering_float"] == 'none' && ($paramssld["ht_view0_sorting_float"] == 'left') ) { if($catalogShowSorting == 'on') { echo "margin-left: 31%;"; } else echo "margin-left: 1%"; } 
        if(($paramssld["ht_view0_filtering_float"] == 'none' && ($paramssld["ht_view0_sorting_float"] == 'right')) || ($sorting_block_width == '100%' && $filtering_block_width == "100%")) { echo "margin-left: 1%";}
    ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> ul li {
    list-style-type: none;
    <?php
        if($filtering_block_width == "100%") { echo "float:left !important;margin: 4px 8px 4px 0px !important;"; }
        if($left_to_top == "ok") { echo "float:left !important;"; }
        if($paramssld["ht_view0_filtering_float"] == "left" || $paramssld["ht_view0_filtering_float"] == "right")
        { echo 'border-bottom: 1px solid #ccc;'; }
        else echo "border: 1px solid #ccc;";
    ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> ul li a {
    font-size:<?php echo $paramssld["ht_view0_filterbutton_font_size"];?>px !important;
    color:#<?php echo $paramssld["ht_view0_filterbutton_font_color"];?> !important;
    background-color: #<?php echo $paramssld["ht_view0_filterbutton_background_color"];?> !important;
    border-radius: <?php echo $paramssld["ht_view0_filterbutton_border_radius"];?>px;
    padding: 3px;
    display: block;
    text-decoration: none;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?>  ul li a:hover {
    color:#<?php echo $paramssld["ht_view0_filterbutton_hover_font_color"];?> !important;
    background-color: #<?php echo $paramssld["ht_view0_filterbutton_hover_background_color"];?> !important;
    cursor: pointer;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> section {
    position:relative;
    display:block;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_container_<?php echo $catalogID; ?> {
<?php if($paramssld["ht_view0_sorting_float"] == "left" && $paramssld["ht_view0_filtering_float"] == "right" ||
         $paramssld["ht_view0_sorting_float"] == "right" && $paramssld["ht_view0_filtering_float"] == "left")
       { echo "margin: 0px auto;"; }
       if((($paramssld["ht_view0_filtering_float"] == "left" || $paramssld["ht_view0_filtering_float"] == "right" && $paramssld["ht_view0_sorting_float"] == "top") || ($paramssld["ht_view0_sorting_float"] == "left" || $paramssld["ht_view0_sorting_float"] == "right" && $paramssld["ht_view0_filting_float"] == "top")) && $catalogShowFiltering == "on" && $catalogShowSorting == "on")
       {
?>
        width: <?php echo $width_middle; ?> !important;
 <?php } ?>
}
.catalog_pagination_block_<?php echo $catalogID; ?>{
    /*text-align: <?php echo $paramssld["htc_view0_pagination_position"]; ?>;*/
    padding: 20px 0px;
    margin: 16px 0px 35px 0px;
}
.catalog_pagination_<?php echo $catalogID; ?>{
    text-align: <?php echo $paramssld["htc_view0_pagination_position"]; ?>;
    /*display: inline-block;*/
    /*height: 50px;*/
/*    border: 1px solid #dadada;
    border-radius: 6px;*/
}
.catalog_pagination_<?php echo $catalogID; ?> a, .catalog_pagination_<?php echo $catalogID; ?> span{
    color: #515151;
    font-size: 20px;
    text-decoration: none;
    text-align: center;
/*    width: 48px;
    height: 48px;*/
    /*display: inline-block;*/
    /*float: left;*/
    margin: 0;
    padding: 0;
}
.catalog_pagination_<?php echo $catalogID; ?> .pagination-text{
    /*float: left;*/
    color: #<?php echo $paramssld["htc_view0_pagination_font_color"]; ?>;
    font-size: <?php echo $paramssld["htc_view0_pagination_font_size"]; ?>px;
    /*font-weight: bold;*/
    padding: 12px 0px;
    text-decoration: none;
    text-align: center;
    /*display: inline-block;*/
/*    width: 180px;
    height: 48px;*/
    /*background-color: #fff;*/
}
@media only screen and (max-width:500px) {
	.catalog_pagination_<?php echo $catalogID; ?> .pagination-text{
            font-size: 16px !important;
            width: 120px !important;
	}
        .catalog_pagination_block_<?php echo $catalogID; ?>{
            text-align: left;
        }
}
.catalog_pagination_<?php echo $catalogID; ?> a{
    text-align: center;
    position: relative;
    margin-right: 5px;
    
}
.catalog_pagination_<?php echo $catalogID; ?> a i{
    font-size: <?php echo $paramssld["htc_view0_pagination_icon_size"]; ?>px;
    color: #<?php echo $paramssld["htc_view0_pagination_icon_color"]; ?>;
/*    position: absolute;
    top: -moz-calc(50% - 8px) !important;
    top: -webkit-calc(50% - 8px)  !important;
    top: calc(50% - 8px) !important;
    top: -o-calc(50% - 8px) !important;
    top: -ms-calc(50% - 8px) !important;
    
    left: -moz-calc(50% - 8px) !important;
    left: -webkit-calc(50% - 8px)  !important;
    left: calc(50% - 8px) !important;
    left: -o-calc(50% - 8px) !important;
    left: -ms-calc(50% - 8px) !important;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-first{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/first-active.png' , __FILE__ ); ?>') center center no-repeat;*/
/*    border-right: 1px solid #D0D0D0;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 10px;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-first-passive{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/first-passive.png' , __FILE__ ); ?>') center center no-repeat;*/
/*    border-right: 1px solid #D0D0D0;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;*/
}

.catalog_pagination_<?php echo $catalogID; ?> .go-to-previous{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/left-active.png' , __FILE__ ); ?>') center center no-repeat;*/
    /*border-right: 1px solid #D0D0D0;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-previous-passive{
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/left-passive.png' , __FILE__ ); ?>') center center no-repeat;*/
    /*border-right: 1px solid #D0D0D0;*/
}

.catalog_pagination_<?php echo $catalogID; ?> .go-to-last{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/last-active.png' , __FILE__ ); ?>') center center no-repeat;*/
/*    border-left: 1px solid #D0D0D0;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-last-passive{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/last-passive.png' , __FILE__ ); ?>') center center no-repeat;*/
/*    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    border-left: 1px solid #D0D0D0;*/
}

.catalog_pagination_<?php echo $catalogID; ?> .go-to-next{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/right-active.png' , __FILE__ ); ?>') center center no-repeat;*/
    /*border-left: 1px solid #D0D0D0;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-next-passive{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/right-passive.png' , __FILE__ ); ?>') center center no-repeat;*/
    /*border-left: 1px solid #D0D0D0;*/
}

.zoomContainer {
    z-index: 10;
}
.catalog_load_block_<?php echo $catalogID; ?>{
    margin: 35px 0px;
}
.catalog_load_<?php echo $catalogID; ?>{
    text-align: <?php echo $paramssld["htc_view0_load_more_position"]; ?>;
}
.catalog_load_<?php echo $catalogID; ?> a{
    text-decoration: none;
    /*width: 100%;*/
    border-radius: 5px;
    display: inline-block;
    padding: 5px 15px;
    font-size: <?php echo $paramssld["htc_view0_load_more_font_size"]; ?>px !important;
    color: #<?php echo $paramssld["htc_view0_load_more_font_color"]; ?> !important;
    background: #<?php echo $paramssld["htc_view0_load_more_button_background_color"]; ?> !important;
    cursor: pointer;
}
.catalog_load_<?php echo $catalogID; ?> a:hover{
    color: #<?php echo $paramssld["htc_view0_load_more_font_hover_color"]; ?> !important;
    background: #<?php echo $paramssld["htc_view0_load_more_button_background_hover_color"]; ?> !important;
}
.catalog_load_<?php echo $catalogID; ?> a:focus{
    outline: none;
}
/*<add search>*/
#search_block_<?php echo $catalogID; ?> {
	text-align: <?php echo $paramssld["ht_view0_search_form_position"]; ?>;	
	margin: 5px;
}
#search_block_<?php echo $catalogID; ?> > form {
	position: relative;
	height: 36px;
	display: inline-block;
	width: <?php echo $paramssld["ht_view0_search_form_width"]; ?>%;
	overflow: hidden;
	border-radius: <?php echo $paramssld["ht_view0_search_form_border_radius"]; ?>px;
	border: <?php echo $paramssld["ht_view0_search_form_border_width"]; ?>px solid #<?php echo $paramssld["ht_view0_search_form_border_color"]; ?>;	
}
#search_block_<?php echo $catalogID; ?> > form > input {
	width: 100%;
	height: 36px;		
	display: block;	
	position: absolute;
	padding:5px 10px;
	top: 0;
	left: 0;
	border: none;
	color: #272717;
	background: #FFFFFF;
    margin: 0;
} 
#search_block_<?php echo $catalogID; ?> > form > input + div {
	display: inline-block;
	color: #<?php echo $paramssld["ht_view0_search_button_background"]; ?>;
    position: absolute;
	display: none;
    cursor: pointer;
    height: calc(100% - 2px);
    top: 1px;
    width: 6%;
    right: 20%;
    text-align: center;
    font-size: 20px;
	background: #FFFFFF;	
}
#search_block_<?php echo $catalogID; ?> > form:hover > input + div {
	display: block;
}
#search_block_<?php echo $catalogID; ?> > form > input:blur + div {
	display: none;
}
#search_block_<?php echo $catalogID; ?> > form > #search_button_<?php echo $catalogID; ?> {
	width: 20%;
	height: 36px;		
	display: block;
	position: absolute;
	padding:0 10px 5px;
	top: 0;
	right: 0%;	
	border-top-right-radius: <?php echo $paramssld["ht_view0_search_form_border_radius"]; ?>px;
	border: 0;
	background: #<?php echo $paramssld["ht_view0_search_button_background"]; ?>;
	color: #<?php echo $paramssld["ht_view0_search_button_text_color"]; ?>;
    margin: 0;
} 

#search_block_<?php echo $catalogID; ?> > form > #search_button_<?php echo $catalogID; ?>:hover {
	background: #<?php echo $paramssld["ht_view0_search_button_hover_color"]; ?>;
} 
#search_not_results_<?php echo $catalogID; ?> {
	width: 100%;
	height: 40px;
	background: #F1F1F1;
	color: #A49999;
	border-radius: 5px;
	border: 2px solid #E1E3DF;
	text-align: center;
	display: none;	
}
#search_not_results_<?php echo $catalogID; ?> > span {
	padding: 0;
	margin: 0;	
	line-height: 36px;
	font-size: 14px;	
}
/*</add search>*/
</style>

<section id="huge_it_catalog_content_<?php echo $catalogID; ?>" class="product-catalog-content">
      <?php if($catalogShowSorting == "on")
        { ?>
          <div id="huge_it_catalog_options_<?php echo $catalogID; ?>" class="" >
            <ul id="sort-by" class="option-set clearfix" data-option-key="sortBy">
                <li><a href="#sortBy=original-order" data-option-value="original-order" class="selected" data><?php echo $paramssld["ht_view0_sorting_name_by_default"]; ?></a></li>
                <li><a href="#sortBy=id" data-option-value="id"><?php echo $paramssld["ht_view0_sorting_name_by_id"]; ?></a></li>
                <li><a href="#sortBy=symbol" data-option-value="symbol"><?php echo $paramssld["ht_view0_sorting_name_by_name"]; ?></a></li>
                <li id="shuffle"><a href='#shuffle'><?php echo $paramssld["ht_view0_sorting_name_by_random"]; ?></a></li>
            </ul>
              
            <ul id="sort-direction" class="option-set clearfix" data-option-key="sortAscending">
                <li><a href="#sortAscending=true" data-option-value="true" class="selected"><?php echo $paramssld["ht_view0_sorting_name_by_asc"]; ?></a></li>
                <li><a href="#sortAscending=false" data-option-value="false"><?php echo $paramssld["ht_view0_sorting_name_by_desc"]; ?></a></li>
            </ul>
          </div>
  <?php }
   if($catalogShowFiltering == "on")
      { ?>
         <div id="huge_it_catalog_filters_<?php echo $catalogID; ?>" style>
            <ul>
                <li rel="*"><a>All</a></li>
                <?php
                $catalogCats = explode(",", $catalogCats);
                foreach ($catalogCats as $catalogCatsValue) {
                    if(!empty($catalogCatsValue))
                    {
                ?>
                <li rel=".<?php echo str_replace(" ","_",$catalogCatsValue); ?>"><a><?php echo str_replace("_"," ",$catalogCatsValue); ?></a></li>
                    <?php
                    }
                }
                ?>
            </ul>
        </div>
<?php }  if($catalogSearch == 'on') {?>
		<div id="search_block_<?php echo $catalogID; ?>">	
			<form>
				<input type="text"/><div><i class="hugeiticons hugeiticons-times"></i></div>
				<button id="search_button_<?php echo $catalogID; ?>" type="submit" ><i class="hugeiticons hugeiticons-search"></i>
				</button>
			</form>	
			<div id="search_not_results_<?php echo $catalogID; ?>"><span><?php echo $paramssld3['ht_catalog_general_no_search_result_text']?></span></div>
		</div>		
<?php } ?>	        
<div id="huge_it_catalog_container_<?php echo $catalogID; ?>" class="super-list variable-sizes clearfix" <?php // if($paramssld["ht_view0_sorting_float"] == "top" && $paramssld["ht_view0_filtering_float"] == "top") echo "style='clear: both;'";?>>
              <?php
              $group_key = 0;
              foreach($images as $key=>$row)
              {
                      $group_key++;
                      $link = $row->sl_url;
                      $descnohtml=strip_tags($row->description);
                      $result = substr($descnohtml, 0, 50);
//                      $catForFilter = explode(",", $row->category);
                      ?>
                      <div class="element_<?php echo $catalogID; ?>  <?php if($paramssld['ht_view0_allow_lightbox'] == "on"){ echo "catalog_ccolorbox_grouping_".$catalogID;} ?> "  data-element-id="<?php echo $row->id; ?>"  data-symbol="<?php echo esc_attr($row->name); ?>" data-category="alkaline-earth">
                              <div class="default-block_<?php echo $catalogID; ?>">
                                      <div class="image-block_<?php echo $catalogID; ?> for_zoom">
                                              <?php $imgurl=explode(";",$row->image_url); ?>
                                              <?php if($row->image_url != ';'){
                                                        if($paramssld['ht_view0_allow_zooming'] == "off" && $paramssld['ht_view0_allow_lightbox'] == "on"){
                                              ?>
                                                            <a href="<?php echo $imgurl[0] ?>" class="catalog_group<?php echo $group_key."_".$catalogID; ?>">
                                                                <img id="wd-cl-img<?php echo $key; ?>" src="<?php echo esc_attr($imgurl[0]); ?>" />
                                                            </a>
                                              <?php      }else{ ?>
                                                                <img id="wd-cl-img<?php echo $key; ?>" src="<?php echo esc_attr($imgurl[0]); ?>" />
                                                   <?php } ?>
                                                        
                                              <?php     }else { ?>
                                                            <img id="wd-cl-img<?php echo $key; ?>" src="images/noimage.png" />
                                              <?php } ?>	
                                      </div>
                                      <div class="title-block_<?php echo $catalogID; ?>">
                                              <h3 class="title"><?php echo $row->name; ?></h3>
                                              <div class="open-close-button"></div>
                                      </div>
                              </div>

                              <div class="wd-catalog-panel_<?php echo $catalogID; ?>" id="panel<?php echo $key; ?>">
                              <?php if($paramssld['ht_view0_show_thumbs']=='on' and $paramssld['ht_view0_thumbs_position']=="before")
                                      { ?>
                                              <div class="thumbs-block">
                                                      <ul class="thumbs-list_<?php echo $catalogID; ?>">
                                                              <?php
                                                              $imgurl=explode(";",$row->image_url);
                                                              array_pop($imgurl);
                                                              
                                                              if($paramssld['ht_view0_allow_zooming'] == "on" && $paramssld['ht_view0_allow_lightbox'] == "off"){  }
                                                              else{ array_shift($imgurl); }
                                                              
                                                              foreach($imgurl as $key1=>$img)
                                                              {
                                                              ?>
                                                              <li>
                                                                      <a href="<?php echo esc_attr($img); ?>" class="catalog_group<?php echo $group_key."_".$catalogID; ?>"><img src="<?php echo esc_attr($img); ?>"></a>
                                                              </li>
                                                              <?php
                                                              }
                                                              ?>
                                                      </ul>
                                              </div>
                                      <?php } 
                                      if($paramssld['ht_view0_show_description']=='on'){?>
                                              <div class="description-block_<?php echo $catalogID; ?>">
                                                      <p><?php echo $row->description; ?></p>
                                              </div>
                                      <?php }
                                      if($paramssld['ht_view0_show_thumbs']=='on' and $paramssld['ht_view0_thumbs_position']=="after"){?>
                                          <div class="thumbs-block">
                                              <div class="thumbs-block">
                                                      <ul class="thumbs-list_<?php echo $catalogID; ?>">
                                                              <?php
                                                              $imgurl=explode(";",$row->image_url);
                                                              array_pop($imgurl);
                                                              if(($paramssld['ht_view1_allow_zooming'] == "on" && $paramssld['ht_view1_allow_lightbox'] == "off") || ($paramssld['ht_view1_allow_zooming'] == "off" && $paramssld['ht_view1_allow_lightbox'] == "off")){  }
                                                              else{ array_shift($imgurl); }
                                                              
                                                              foreach($imgurl as $key1=>$img)
                                                              {
                                                              ?>
                                                              <li>
                                                                      <a href="<?php echo esc_attr($img); ?>" class="catalog_group<?php echo $group_key."_".$catalogID; ?>"><img src="<?php echo esc_attr($img); ?>"></a>
                                                              </li>
                                                              <?php
                                                              }
                                                              ?>
                                                      </ul>
                                              </div>
                                          </div>
                                <?php } ?>
                                  
                                <?php if($paramssld["ht_catalog_view0_show_price"] == 'on' && $row->price != ""){ ?>
                                          <div class="price-block_<?php echo $catalogID; ?>">
                                              <span class="old-price-block" ><?php echo $paramssld3['ht_single_product_price_text']; ?> : <span class="old-price" <?php if($row->market_price == "") { echo "style='text-decoration: none !important;'"; } ?>><?php echo $row->price; ?></span></span>
                                              <span class="discont-price-block" ><span class="discont-price" ><?php echo $row->market_price; ?></span></span>
                                          </div>
                                <?php } ?>
                                  
                                <?php
                                      if($paramssld['ht_view0_show_linkbutton']=='on'){
                                         if($row->single_product_url_type == "default"){
                                             $page_link = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
                                             if (strpos(get_permalink(),'/?') !== false) { $product_page_link = get_permalink()."&single_prod_id=$row->id"; } else { if (strpos(get_permalink(),'/') !== false) { $product_page_link = get_permalink()."?single_prod_id=$row->id"; } else { $product_page_link = get_permalink()."/?single_prod_id=$row->id"; } }
                                         }
                                         else{ $product_page_link = $row->single_product_url_type; }
                                            ?>
                                                <div class="button-block">
                                                        <a href="<?php echo esc_url($product_page_link); ?>" <?php if($row->link_target == 'on'){echo ' target="_blank"';} ?>><?php echo $paramssld3['ht_catalog_general_linkbutton_text']; ?></a>
                                                </div>
                                <?php } ?>
                              </div>
                      </div>

                      <?php
              }
              ?>
        </div>
    
        <?php
            if($catalog[0]->pagination_type == "pagination"){
        ?>
        <div class="catalog_pagination_block_<?php echo $catalogID; ?>" >
            <div class="catalog_pagination_<?php echo $catalogID; ?>" >
                <?php
//                var_dump($_SERVER);
                
                    if (strpos($_SERVER['QUERY_STRING'], 'catalog_page_') !== false)
                {                                                                   //      IF WE HAVE $_GET PAGE
                    $oneMore = $page_index + 1;
                    $oneLess = $page_index - 1;
                    
                    if(isset($_GET["catalog_page_".$catalogID])){                   //      IF WE HAVE $_GET PAGE FOR THAT CATALOG
                        $prevPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$oneLess,$_SERVER['QUERY_STRING']);
                        $nextPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$oneMore,$_SERVER['QUERY_STRING']);
                        $firstPagePath = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=1",$_SERVER['QUERY_STRING']);
                        $lastPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$pages,$_SERVER['QUERY_STRING']);
//                        var_dump($nextPagePath);
                    }
                    else{                                                           //      IF WE HAVE $_GET PAGE FOR ANOTHER CATALOG
                        $prevPagePath  = "#";
                        $nextPagePath = $_SERVER['QUERY_STRING']."&catalog_page_".$catalogID."=2";
//                        $nextPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$oneMore,$_SERVER['QUERY_STRING']);
                        $firstPagePath = $_SERVER['QUERY_STRING']."&catalog_page_".$catalogID."=1";
                        $lastPagePath  = $_SERVER['QUERY_STRING']."&catalog_page_".$catalogID."=".$pages;
                    }
                }
                else{                                                               //      IF WE HAVE NOOOT $_GET PAGE
                    $oneMore = $page_index + 1;
                    $oneLess = $page_index - 1;
                    
                    $prevPagePath  = "#";
                    $nextPagePath  = "catalog_page_".$catalogID."=2";
                    $firstPagePath = "catalog_page_".$catalogID."=1";
                    $lastPagePath  = "catalog_page_".$catalogID."=".$pages;
                }
                

               
                    if (strpos(get_permalink(),'/?') !== false) { $pathSumbol = "&"; }
                    else {
                        if (strpos(get_permalink(),'/') !== false) { $pathSumbol = "?"; }
                        else { $pathSumbol = "/?"; }
                    }
                    // The "back" link
//                    $prevlink = ($page_index > 1) ? ''
//                            . '<a href="'.$pathSumbol.$firstPagePath. '" class="go-to-first"></a> <a href="'.$pathSumbol.$prevPagePath. '" class="go-to-previous"></a>' : '<span class="disabled go-to-first-passive"></span> <span class="disabled go-to-previous-passive"></span>';
//
//                    // The "forward" link
//                    $nextlink = ($page_index < $pages) ? ''
//                            . '<a href="'.$pathSumbol.$nextPagePath. '" class="go-to-next"></a> <a href="'.$pathSumbol.$lastPagePath. '" class="go-to-last"></a>' : '<span class="disabled go-to-next-passive"></span> <span class="disabled go-to-last-passive"></span>';
                    
                    // The "back" link
                    $prevlink = ($page_index > 1) ? ''
                            . '<a href="'.$pathSumbol.$firstPagePath. '" class="go-to-first"><i class="icon-style4 hugeiticons-fast-backward" ></i></a>'
                            . '<a href="'.$pathSumbol.$prevPagePath. '" class="go-to-previous"><i class="icon-style4 hugeiticons-chevron-left"></i></a>' : '<span class="disabled go-to-first-passive"></span> <span class="disabled go-to-previous-passive"></span>';

                    // The "forward" link
                    $nextlink = ($page_index < $pages) ? ''
                            . '<a href="'.$pathSumbol.$nextPagePath. '" class="go-to-next"><i class="icon-style4 hugeiticons-chevron-right"></i></a>'
                            . '<a href="'.$pathSumbol.$lastPagePath. '" class="go-to-last"><i class="icon-style4 hugeiticons-fast-forward" ></i></a>' : 
                              '<span class="disabled go-to-next-passive"></span>'
                            . '<span class="disabled go-to-last-passive"></span>';
                    
                    echo $prevlink." <span class='pagination-text'>".$page_index." / ".$pages."</span> ".$nextlink;
                    
                ?>
                <input type="hidden" class="pagination-scroll-position" value=""/>
            </div>
        </div>
        <?php
            }
            elseif($catalog[0]->pagination_type == "load_more"){ $path_site = plugins_url("/../images", __FILE__); ?>
                <div class="catalog_load_block_<?php echo $catalogID; ?>" >
                    <div class="catalog_load_<?php echo $catalogID; ?>" >
                        <a href="#" class="load_more_elements_<?php echo $catalogID; ?>"><?php echo __("Load More...","product-catalog");?></a>
                        <img src="<?php echo $path_site; ?>/load_more_icon_<?php echo $paramssld['htc_view0_load_more_loading_icon']; ?>.gif" class="load_more_loading_icon" style="display: none"/>
                        <input type="hidden" class="load-more-elements-count" value="<?php echo esc_attr($countIntoPage); ?>"/>
                    <?php
                        
                    ?>
                    </div>
                </div>
      <?php } ?>
    
</section>

<script>

/***<object for ajax  add search> ***/

var $ob_<?php echo $catalogID; ?> = {
            action: 'my_action',
            post: 'load_more_elements_into_catalog',
            view: <?php echo $catalog[0]->catalog_list_effects_s; ?>,
            catalog_id: <?php echo $catalogID; ?>,
            count_into_page: <?php echo $countIntoPage; ?>,
            allow_lightbox: "<?php echo $paramssld['ht_view0_allow_lightbox']; ?>",
            show_thumbs: "<?php echo $paramssld['ht_view0_show_thumbs']; ?>",
            thumbs_position: "<?php echo $paramssld['ht_view0_thumbs_position']; ?>",
            show_description: "<?php echo $paramssld['ht_view0_show_description']; ?>",
            show_price: "<?php echo $paramssld["ht_catalog_view0_show_price"]; ?>",
            price_text: "<?php echo $paramssld3['ht_single_product_price_text']; ?>",
            show_linkbutton: "<?php echo $paramssld['ht_view0_show_linkbutton']; ?>",
            linkbutton_text: "<?php echo $paramssld3['ht_catalog_general_linkbutton_text']; ?>",
            parmalink: "<?php echo get_permalink(); ?>"
};
 

/***</object for ajax  add search> ***/
	
    var allowZooming = '<?php echo $paramssld['ht_view0_allow_zooming'];?>';
jQuery(function(){        
var defaultBlockHeight=<?php echo $paramssld['ht_view0_block_height']; ?>;
var defaultBlockWidth=<?php echo $paramssld['ht_view0_block_width']; ?>;
    
    var $container = jQuery('#huge_it_catalog_container_<?php echo $catalogID; ?>');
    
    
      // add randomish size classes
      $container.find('.element_<?php echo $catalogID; ?>').each(function(){
        var $this = jQuery(this),
            number = parseInt( $this.find('.number').text(), 10 );
			//alert(number);
        if ( number % 7 % 2 === 1 ) {
          $this.addClass('width2');
        }
        if ( number % 3 === 0 ) {
          $this.addClass('height2');
        }
      });
    
    $container.hugeitmicro({
      itemSelector : '.element_<?php echo $catalogID; ?>',
      masonry : {
        columnWidth :  <?php echo $paramssld['ht_view0_block_width']; ?>+20+<?php echo $paramssld['ht_view0_element_border_width']*2; ?>
      },
      masonryHorizontal : {
        rowHeight: 300+20
      },
      cellsByRow : {
        columnWidth : 300+20,
        rowHeight : 240
      },
      cellsByColumn : {
        columnWidth : 300+20,
        rowHeight : 240
      },
      getSortData : {
        symbol : function( $elem ) {
          return $elem.attr('data-symbol');
        },
        category : function( $elem ) {
          return $elem.attr('data-category');
        },
        number : function( $elem ) {
          return parseInt( $elem.find('.number').text(), 10 );
        },
        weight : function( $elem ) {
          return parseFloat( $elem.find('.weight').text().replace( /[\(\)]/g, '') );
        },
        id : function ( $elem ) {
          return $elem.find('.id').text();
        }
      }
    });
        

    var $optionSets = jQuery('#huge_it_catalog_options_<?php echo $catalogID; ?> .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = jQuery(this);

        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
  

        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');

        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
            
          changeLayoutMode( $this, options )
        } else {

          $container.hugeitmicro( options );
        }
        
        return false;
      });

      var isHorizontal = false;
      function changeLayoutMode( $link, options ) {
        var wasHorizontal = isHorizontal;
        isHorizontal = $link.hasClass('horizontal');

        if ( wasHorizontal !== isHorizontal ) {

          var style = isHorizontal ? 
            { height: '75%', width: $container.width() } : 
            { width: 'auto' };

          $container.filter(':animated').stop();

          $container.addClass('no-transition').css( style );
          setTimeout(function(){
            $container.removeClass('no-transition').hugeitmicro( options );
          }, 100 )
        } else {
          $container.hugeitmicro( options );
        }
      }


       $container.delegate('.title-block_<?php echo $catalogID; ?>', 'click', function () {
              var strheight = 0;
              jQuery(this).parents('.element_<?php echo $catalogID; ?>').find('.wd-catalog-panel_<?php echo $catalogID; ?> > div').each(function () {
                     strheight += jQuery(this).outerHeight() + 10;
              });
              strheight +=<?php echo $paramssld['ht_view0_block_height'] + 45; ?>;
              if (jQuery(this).parents('.element_<?php echo $catalogID; ?>').hasClass("large")) {
                     jQuery(this).parents('.element_<?php echo $catalogID; ?>').animate({
                            height: "<?php echo $paramssld['ht_view0_block_height'] + 45; ?>px"
                     }, 300, function () {
                            jQuery(this).removeClass('large');
                            $container.hugeitmicro('reLayout');
                     });
                     jQuery(this).parents('.element_<?php echo $catalogID; ?>').removeClass("active");
                     return false;
              }


              jQuery(this).parents('.element_<?php echo $catalogID; ?>').css({height: strheight});
              jQuery(this).parents('.element_<?php echo $catalogID; ?>').addClass('large');

              $container.hugeitmicro('reLayout');
              jQuery(this).parents('.element_<?php echo $catalogID; ?>').css({height: "<?php echo $paramssld['ht_view0_block_height'] + 45; ?>px"});

              jQuery(this).parents('.element_<?php echo $catalogID; ?>').animate({
                     height: strheight + "px",
              }, 300, function () {
                     $container.hugeitmicro('reLayout');
              });
       });

    var $sortBy =  jQuery('#huge_it_catalog_content_<?php echo $catalogID; ?> #sort-by');
    jQuery('#huge_it_catalog_content_<?php echo $catalogID; ?> #shuffle a').click(function(){
      $container.hugeitmicro('shuffle');
      $sortBy.find('.selected').removeClass('selected');
      $sortBy.find('[data-option-value="random"]').addClass('selected');
      return false;
    });
    
        // bind filter on select change
       jQuery(document).ready(function () {
              jQuery('#huge_it_catalog_filters_<?php echo $catalogID; ?> ul li').click(function () {
                     // get filter value from option value
                     var filterValue = jQuery(this).attr('rel');
                     // use filterFn if matches value
                     filterValue = filterValue;//filterFns[ filterValue ] ||
                     $container.hugeitmicro({filter: filterValue});
              });

              jQuery(".element_<?php echo $catalogID; ?> .thumbs-block ul li a img").click(function (e) {
                     var lightbox_is = "<?php echo $paramssld['ht_view0_allow_lightbox']; ?>";
                     if (lightbox_is != "on") {
                            e.preventDefault();
                            var new_src = jQuery(this).attr("src");    //    alert(new_src);
                            var image = jQuery(this).closest(".element_<?php echo $catalogID; ?>").find(".default-block_<?php echo $catalogID; ?> .image-block_<?php echo $catalogID; ?> img");
                            image.attr("src", new_src);
                            zoom_start();
                     }
              });
       });
        
        jQuery(window).load(function(){

            $container.hugeitmicro({ filter: '*' });
        });
  });
</script>
	
<?php        
        break;
	
	///////////////////////////////// VIEW 1 FullHeight Blocks //////////////////////////////////////////////
	
	case 1;
 ?>
<?php
if($catalog[0]->pagination_type == "show_all"){
    $myAllImages = count($images);
    if($myAllImages < $catalog[0]->count_into_page)            //update pagination bug
        $countIntoPage = $myAllImages;
    else
    $countIntoPage = $catalog[0]->count_into_page;
    if($countIntoPage == "" || $countIntoPage < 1){ $countIntoPage = 1; }
    $pages = ceil($myAllImages / $countIntoPage);
    if(isset($_GET["catalog_page_".$catalogID])){ $page_index = absint($_GET["catalog_page_".$catalogID]); }
    else{ $page_index = 1; }
    $maxCount = $page_index * $countIntoPage;
    $morePaste = $maxCount - $myAllImages;
}
else{
    if(isset($_GET["catalog_page_".$catalogID])){
            $myAllImages = count($images);
            if($myAllImages < $catalog[0]->count_into_page)            //update pagination bug
                $countIntoPage = $myAllImages;
            else
            $countIntoPage = $catalog[0]->count_into_page;
            if($countIntoPage == "" || $countIntoPage < 1){ $countIntoPage = 1; }
            $pages = ceil($myAllImages / $countIntoPage);
            $page_index = absint($_GET["catalog_page_".$catalogID]);
            $maxCount = $page_index * $countIntoPage;
            $morePaste = $maxCount - $myAllImages;
            
//            var_dump($page_index." ".$countIntoPage." ".$maxCount." ".$morePaste." ".$myAllImages." ".$pages);
            if($page_index <= 1 || ($maxCount > $myAllImages) && $morePaste > $countIntoPage){
                $imagesUsefulElements = array();
                for($usefulKeys = 0; $usefulKeys < $countIntoPage; $usefulKeys++){
                    $imagesUsefulElements[] = $images[$usefulKeys];
                }
                $images = $imagesUsefulElements;
            }
            elseif (($maxCount <= $myAllImages) || ($maxCount > $myAllImages && $morePaste <= $countIntoPage)){
                $show_from = $page_index * $countIntoPage - $countIntoPage;
                $show_until = $page_index * $countIntoPage - 1;
                $usefulElementsKey = 0;
                
//                var_dump("from ".$show_from." ".$show_until);
                foreach($images as $galleryElements){
                    if($usefulElementsKey >= $show_from && $usefulElementsKey <= $show_until){
                        $imagesUsefulElements[] = $galleryElements;
                    }
                    $usefulElementsKey++;
                }
                $images = $imagesUsefulElements;
            }
    }
    else {
        $myAllImages = count($images);
        $page_index = 1;
        if($myAllImages < $catalog[0]->count_into_page)            //update pagination bug
            $countIntoPage = $myAllImages;
        else
        $countIntoPage = $catalog[0]->count_into_page;
        if($countIntoPage == "" || $countIntoPage < 1){ $countIntoPage = 1; }
        $pages = ceil($myAllImages / $countIntoPage);
        $imagesUsefulElements = array();
        for($usefulKeys = 0; $usefulKeys < $countIntoPage; $usefulKeys++){
            $imagesUsefulElements[] = $images[$usefulKeys];
//                    var_dump($usefulKeys);
        }
        $images = $imagesUsefulElements;
    }
}


?>

<style type="text/css">
.element_<?php echo $catalogID; ?> {
  width:<?php echo $paramssld['ht_view1_block_width']; ?>px;
  height:auto;
  margin: 5px;
  float: left;
  overflow: hidden;
  position: relative;
  outline:none; 
  background:#<?php echo $paramssld['ht_view1_element_background_color']?>;
  border:<?php echo $paramssld['ht_view1_element_border_width']; ?>px solid #<?php echo $paramssld['ht_view1_element_border_color']; ?>;
}

.default-block_<?php echo $catalogID; ?> {
	position:relative;;
	width:<?php echo $paramssld['ht_view1_block_width']; ?>px;
} 

.default-block_<?php echo $catalogID; ?> .image-block_<?php echo $catalogID; ?> {
	margin:0px;
	padding:0px;
	line-height:0px;
	border:1px solid #<?php echo $paramssld['ht_view1_element_border_color']; ?>;
}

.default-block_<?php echo $catalogID; ?> img {
  margin:0px !important;
  padding:0px !important;
  max-width:none !important;
  width:<?php echo $paramssld['ht_view1_block_width']; ?>px !important;
  border-radius:0px;
}

.default-block_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> {
	display:block;
	height:35px;
	padding:10px 0px 0px 0px;
	width:100%;
}

.default-block_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> h3 {
	position:relative;
	margin:0px !important;
	padding:0px 5px 0px 5px !important;
	width:<?php echo $paramssld['ht_view1_block_width']; ?>px !important;
	text-overflow: ellipsis;
	overflow: hidden; 
	white-space:nowrap;
	font-weight:normal;
	color:#<?php echo $paramssld['ht_view1_title_font_color']; ?>;
	font-size:<?php echo $paramssld['ht_view1_title_font_size']; ?>px !important;
	line-height:<?php echo $paramssld['ht_view1_title_font_size']+4; ?>px !important;
}


.wd-catalog-panel_<?php echo $catalogID; ?> {
	position: relative;
	display:block;
	width:<?php echo $paramssld['ht_view1_block_width']-10; ?>px !important;
	margin:10px 5px 0px 5px;
	padding:0px;
	text-align:left;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> p,.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> {	
	text-align:justify;
	font-weight:normal;
	font-size:<?php echo $paramssld['ht_view1_description_font_size']; ?>px !important;
	color:#<?php echo $paramssld['ht_view1_description_color']; ?>;
	margin:0px !important;
	padding:0px !important;
}


.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> h1,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> h2,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> h3,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> h4,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> h5,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> h6,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> p, 
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> strong,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> span {
	padding:2px !important;
	margin:0px !important;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> ul,
.wd-catalog-panel_<?php echo $catalogID; ?> .description-block_<?php echo $catalogID; ?> li {
	padding:2px 0px 2px 5px;
	margin:0px 0px 0px 8px;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .price-block_<?php echo $catalogID; ?>{
    color: #<?php echo $paramssld['ht_catalog_view1_price_font_color']?>;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .price-block_<?php echo $catalogID; ?> .old-price {
	text-decoration: line-through;
        margin: 0px;
        padding: 0px;
        font-weight: normal;
/*        font-size: 14px;*/
        padding: 7px 10px 7px 10px;
        margin: 0px 10px 0px 0px;
        border-radius: 5px;
        color: #<?php echo $paramssld['ht_view1_element_background_color']?>;
        background: #<?php echo $paramssld['ht_catalog_view1_price_font_color']?>;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .price-block_<?php echo $catalogID; ?> .old-price-block {
	font-size: <?php echo $paramssld['ht_catalog_view1_price_font_size']; ?>px;
        color: #<?php echo $paramssld['ht_catalog_view1_price_font_color']; ?>;
        
}

.wd-catalog-panel_<?php echo $catalogID; ?> .price-block_<?php echo $catalogID; ?> .discont-price-block {
/*	font-size: <?php echo $paramssld['ht_catalog_view1_market_price_font_size']; ?>px;
        color: #<?php echo $paramssld['ht_catalog_view1_market_price_font_color']; ?>; */
}

.wd-catalog-panel_<?php echo $catalogID; ?> .thumbs-list_<?php echo $catalogID; ?> {
	list-style:none;
	clear:both;
	display:table;
	width:100%;
	padding:0px;
	margin:3px 0px 0px 0px;
	text-align:center;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .thumbs-list_<?php echo $catalogID; ?> li {
	display:inline-block;
	margin:0px 3px 0px 2px;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .thumbs-list_<?php echo $catalogID; ?> li a {
	display:block;
	width:<?php echo $paramssld['ht_view1_thumbs_width']; ?>px;
	height:<?php echo $paramssld['ht_view1_thumbs_width']; ?>px;
	opacity:0.7;
	display:table;
        border: none;
        text-decoration: none;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .thumbs-list_<?php echo $catalogID; ?> li a:hover {
	opacity:1;
}

.wd-catalog-panel_<?php echo $catalogID; ?> img {
	margin:0px !important;
	padding:0px !important;
	display:table-cell;
	vertical-align:middle;
	width:<?php echo $paramssld['ht_view1_thumbs_width']; ?>px !important;
	max-height:<?php echo $paramssld['ht_view1_thumbs_width']; ?>px !important;
	width:100%;
	height:100%;
}

.wd-catalog-panel_<?php echo $catalogID; ?> > div {
	padding: 15px 0 3px 0px;
	margin-bottom:10px;
	<?php if($paramssld['ht_view1_show_separator_lines']=="on") {?>
		background:url('<?php echo  plugins_url( '../images/divider.line.png' , __FILE__ ); ?>') center top repeat-x;
	<?php } ?>
}

.wd-catalog-panel_<?php echo $catalogID; ?> .button-block {
	padding-top:10px;
	margin-bottom:10px;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .button-block a, .wd-catalog-panel_<?php echo $catalogID; ?> .button-block a:link, .wd-catalog-panel_<?php echo $catalogID; ?> .button-block a:visited {
	padding:10px;
	display:inline-block;
	font-size:<?php echo $paramssld['ht_view1_linkbutton_font_size']; ?>px;
	background:#<?php echo $paramssld['ht_view1_linkbutton_background_color']; ?>;
	color:#<?php echo $paramssld['ht_view1_linkbutton_color']; ?>;
	padding:6px 12px;
	text-decoration:none;
        border: none;
}

.wd-catalog-panel_<?php echo $catalogID; ?> .button-block a:hover, .wd-catalog-panel_<?php echo $catalogID; ?> .button-block a:focus, .wd-catalog-panel_<?php echo $catalogID; ?> .button-block a:active {
	background:#<?php echo $paramssld['ht_view1_linkbutton_background_hover_color']; ?>;
	color:#<?php echo $paramssld['ht_view1_linkbutton_font_hover_color']; ?>;
	text-decoration:none;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> {
    <?php if ($paramssld["ht_view1_show_sorting"] == 'off')
    echo "display:none;";
//    if($paramssld["ht_view1_filtering_float"] == 'left' && $paramssld["ht_view1_sorting_float"] == 'none') { if($catalogShowFiltering == "on") { echo "margin-left: 31%;"; } else echo "margin-left: 1%;"; }
//    else if($paramssld["ht_view1_filtering_float"] == 'right' && $paramssld["ht_view1_sorting_float"] == 'none' || ($sorting_block_width == '100%' && $filtering_block_width == "100%")) { echo "margin-left: 1%;"; } ?>
    overflow: hidden;
    margin-top: 5px;
    float: <?php // echo $paramssld["ht_view1_sorting_float"]; ?>;
    width:<?php echo $sorting_block_width; ?>;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul {
  margin: 0px !important;
  padding: 0px !important;
  list-style: none;
<?php // if($paramssld["ht_view1_sorting_float"] == 'top') {
//      echo "float:left;margin-left:1%;";
//      } ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> ul {
  margin: 0px !important;
  padding: 0px !important;
  overflow: hidden;
  <?php // if($paramssld["ht_view1_filtering_float"] == 'top') {
//      echo "float:left;margin-left:1%;";
//      } ?>
}

<?php // if($paramssld["ht_view1_sorting_float"] == 'none') { ?>
/*            #huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul {
                float: left;
            }*/
    <?php // } ?>


#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li {
    border-radius: <?php echo $paramssld["ht_view1_sortbutton_border_radius"];?>px;
    list-style-type: none;
    margin: 0px !important;
    <?php
//        if($sorting_block_width == "100%" ) {
//            echo "float:left !important;margin: 4px 8px 4px 0px !important;";
//        }
//        if($left_to_top == "ok")
//        { echo "float:left !important;"; }
//        if($paramssld["ht_view1_sorting_float"] == "left" || $paramssld["ht_view1_sorting_float"] == "right")
//        { echo 'border-bottom: 1px solid #ccc;'; }
//        else
//        { echo 'border: 1px solid #ccc;'; }
    ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li a {
    background-color: #<?php echo $paramssld["ht_view1_sortbutton_background_color"];?> !important;
    font-size:<?php echo $paramssld["ht_view1_sortbutton_font_size"];?>px !important;
    color:#<?php echo $paramssld["ht_view1_sortbutton_font_color"];?> !important;
    text-decoration: none;
    cursor: pointer;
    margin: 0px !important;
    display: block;
    padding:3px;
}

/*#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li:hover {
    
}*/

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li a:hover {
    background-color: #<?php echo $paramssld["ht_view1_sortbutton_hover_background_color"];?> !important;
    color:#<?php echo $paramssld["ht_view1_sortbutton_hover_font_color"];?> !important;
    cursor: pointer;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> {
    margin-top: 5px;
/*    float: <?php echo $paramssld["ht_view1_filtering_float"]; ?>;
    width: <?php echo $filtering_block_width; ?>;*/
    <?php
        if ($paramssld["ht_view1_show_filtering"] == 'off') echo "display:none;";
//        if($paramssld["ht_view1_filtering_float"] == 'none' && $paramssld["ht_view1_sorting_float"] == 'left' ) { if($catalogShowSorting == 'on') { echo "margin-left: 31%;"; } else echo "margin-left: 1%";} 
//        if(($paramssld["ht_view1_filtering_float"] == 'none' && ($paramssld["ht_view1_sorting_float"] == 'right')) || ($sorting_block_width == '100%' && $filtering_block_width == "100%")) { echo "margin-left: 1%";}
    ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> ul li {
    list-style-type: none;
    <?php
//        if($filtering_block_width == "100%") { echo "float:left !important;margin: 4px 8px 4px 0px !important;"; }
//        if($left_to_top == "ok") { echo "float:left !important;"; }
//        if($paramssld["ht_view1_filtering_float"] == "left" || $paramssld["ht_view1_filtering_float"] == "right")
//        { echo 'border-bottom: 1px solid #ccc;'; }
//        else echo "border: 1px solid #ccc;";
    ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> ul li a {
    font-size:<?php echo $paramssld["ht_view1_filterbutton_font_size"];?>px !important;
    color:#<?php echo $paramssld["ht_view1_filterbutton_font_color"];?> !important;
    background-color: #<?php echo $paramssld["ht_view1_filterbutton_background_color"];?> !important;
    border-radius: <?php echo $paramssld["ht_view1_filterbutton_border_radius"];?>px;
    padding: 3px;
    display: block;
    text-decoration: none;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?>  ul li a:hover {
    color:#<?php echo $paramssld["ht_view1_filterbutton_hover_font_color"];?> !important;
    background-color: #<?php echo $paramssld["ht_view1_filterbutton_hover_background_color"];?> !important;
    cursor: pointer
}

#huge_it_catalog_content_<?php echo $catalogID; ?> section {
    position:relative;
    display:block;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_container_<?php echo $catalogID; ?> {
<?php // if($paramssld["ht_view1_sorting_float"] == "left" && $paramssld["ht_view1_filtering_float"] == "right" ||
//         $paramssld["ht_view1_sorting_float"] == "right" && $paramssld["ht_view1_filtering_float"] == "left")
//       { echo "margin: 0px auto;"; }
//       if((($paramssld["ht_view1_filtering_float"] == "left" || $paramssld["ht_view1_filtering_float"] == "right" && $paramssld["ht_view1_sorting_float"] == "top") || ($paramssld["ht_view1_sorting_float"] == "left" || $paramssld["ht_view1_sorting_float"] == "right" && $paramssld["ht_view1_filting_float"] == "top")) && $catalogShowFiltering == "on" && $catalogShowSorting == "on")
//       {
?>
    /*width: <?php echo $width_middle; ?> !important;*/
 <?php // } ?>
}

.catalog_pagination_block_<?php echo $catalogID; ?>{
    /*text-align: <?php echo $paramssld["htc_view1_pagination_position"]; ?>;*/
    padding: 20px 0px;
    margin: 16px 0px 35px 0px;
}
.catalog_pagination_<?php echo $catalogID; ?>{
    text-align: <?php echo $paramssld["htc_view1_pagination_position"]; ?>;
    /*display: inline-block;*/
    /*height: 50px;*/
/*    border: 1px solid #dadada;
    border-radius: 6px;*/
}
.catalog_pagination_<?php echo $catalogID; ?> a, .catalog_pagination_<?php echo $catalogID; ?> span{
    color: #515151;
    font-size: 20px;
    text-decoration: none;
    text-align: center;
/*    width: 48px;
    height: 48px;*/
    /*display: inline-block;*/
    /*float: left;*/
    margin: 0;
    padding: 0;
}
.catalog_pagination_<?php echo $catalogID; ?> .pagination-text{
    /*float: left;*/
    color: #<?php echo $paramssld["htc_view1_pagination_font_color"]; ?>;
    font-size: <?php echo $paramssld["htc_view1_pagination_font_size"]; ?>px;
    /*font-weight: bold;*/
    padding: 12px 0px;
    text-decoration: none;
    text-align: center;
    /*display: inline-block;*/
/*    width: 180px;
    height: 48px;*/
    /*background-color: #fff;*/
}
@media only screen and (max-width:500px) {
	.catalog_pagination_<?php echo $catalogID; ?> .pagination-text{
            font-size: 16px !important;
            width: 120px !important;
	}
        .catalog_pagination_block_<?php echo $catalogID; ?>{
            text-align: left;
        }
}
.catalog_pagination_<?php echo $catalogID; ?> a{
    text-align: center;
    position: relative;
    margin-right: 5px;
    
}
.catalog_pagination_<?php echo $catalogID; ?> a i{
    font-size: <?php echo $paramssld["htc_view1_pagination_icon_size"]; ?>px;
    color: #<?php echo $paramssld["htc_view1_pagination_icon_color"]; ?>;
/*    position: absolute;
    top: -moz-calc(50% - 8px) !important;
    top: -webkit-calc(50% - 8px)  !important;
    top: calc(50% - 8px) !important;
    top: -o-calc(50% - 8px) !important;
    top: -ms-calc(50% - 8px) !important;
    
    left: -moz-calc(50% - 8px) !important;
    left: -webkit-calc(50% - 8px)  !important;
    left: calc(50% - 8px) !important;
    left: -o-calc(50% - 8px) !important;
    left: -ms-calc(50% - 8px) !important;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-first{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/first-active.png' , __FILE__ ); ?>') center center no-repeat;*/
/*    border-right: 1px solid #D0D0D0;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 10px;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-first-passive{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/first-passive.png' , __FILE__ ); ?>') center center no-repeat;*/
/*    border-right: 1px solid #D0D0D0;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;*/
}

.catalog_pagination_<?php echo $catalogID; ?> .go-to-previous{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/left-active.png' , __FILE__ ); ?>') center center no-repeat;*/
    /*border-right: 1px solid #D0D0D0;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-previous-passive{
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/left-passive.png' , __FILE__ ); ?>') center center no-repeat;*/
    /*border-right: 1px solid #D0D0D0;*/
}

.catalog_pagination_<?php echo $catalogID; ?> .go-to-last{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/last-active.png' , __FILE__ ); ?>') center center no-repeat;*/
/*    border-left: 1px solid #D0D0D0;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-last-passive{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/last-passive.png' , __FILE__ ); ?>') center center no-repeat;*/
/*    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    border-left: 1px solid #D0D0D0;*/
}

.catalog_pagination_<?php echo $catalogID; ?> .go-to-next{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/right-active.png' , __FILE__ ); ?>') center center no-repeat;*/
    /*border-left: 1px solid #D0D0D0;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-next-passive{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/right-passive.png' , __FILE__ ); ?>') center center no-repeat;*/
    /*border-left: 1px solid #D0D0D0;*/
}

.zoomContainer {
    z-index: 10;
}
.catalog_load_block_<?php echo $catalogID; ?>{
    margin: 35px 0px;
}
.catalog_load_<?php echo $catalogID; ?>{
    text-align: center;
}
.catalog_load_<?php echo $catalogID; ?> a{
    text-decoration: none;
    /*width: 100%;*/
    border-radius: 5px;
    display: inline-block;
    padding: 5px 15px;
    font-size: <?php echo $paramssld["htc_view1_load_more_font_size"]; ?>px !important;
    color: #<?php echo $paramssld["htc_view1_load_more_font_color"]; ?> !important;
    background: #<?php echo $paramssld["htc_view1_load_more_button_background_color"]; ?> !important;
    cursor: pointer;
}
.catalog_load_<?php echo $catalogID; ?> a:hover{
    color: #<?php echo $paramssld["htc_view1_load_more_font_hover_color"]; ?> !important;
    background: #<?php echo $paramssld["htc_view1_load_more_button_background_hover_color"]; ?> !important;
}
.catalog_load_<?php echo $catalogID; ?> a:focus{
    outline: none;
}

/*<add search>*/
#search_block_<?php echo $catalogID; ?> {
	text-align: <?php echo $paramssld["ht_view1_search_form_position"]; ?>;	
	margin: 5px;
}
#search_block_<?php echo $catalogID; ?> > form {
	position: relative;
	height: 36px;
	display: inline-block;
	width: <?php echo $paramssld["ht_view1_search_form_width"]; ?>%;
	overflow: hidden;
	border-radius: <?php echo $paramssld["ht_view1_search_form_border_radius"]; ?>px;
	border: <?php echo $paramssld["ht_view1_search_form_border_width"]; ?>px solid #<?php echo $paramssld["ht_view1_search_form_border_color"]; ?>;	
}
#search_block_<?php echo $catalogID; ?> > form > input {
	width: 100%;
	height: 36px;		
	display: block;	
	position: absolute;
	padding:5px 10px;
	top: 0;
	left: 0;
	border: none;
	color: #272717;
	background: #FFFFFF;
       margin: 0;
} 
#search_block_<?php echo $catalogID; ?> > form > input + div {
	display: inline-block;
	color: #<?php echo $paramssld["ht_view1_search_button_background"]; ?>;
    position: absolute;
	display: none;
    cursor: pointer;
    height: calc(100% - 2px);
    top: 1px;
    width: 6%;
    right: 20%;
    text-align: center;
    font-size: 20px;
	background: #FFFFFF;	
}
#search_block_<?php echo $catalogID; ?> > form:hover > input + div {
	display: block;
}
#search_block_<?php echo $catalogID; ?> > form > input:blur + div {
	display: none;
}
#search_block_<?php echo $catalogID; ?> > form > #search_button_<?php echo $catalogID; ?> {
	width: 20%;
	height: 36px;		
	display: block;
	position: absolute;
	padding:0 10px 5px;
	top: 0;
	right: 0%;	
	border-top-right-radius: <?php echo $paramssld["ht_view1_search_form_border_radius"]; ?>px;
	border: 0;
	background: #<?php echo $paramssld["ht_view1_search_button_background"]; ?>;
	color: #<?php echo $paramssld["ht_view1_search_button_text_color"]; ?>;
    margin: 0;
} 

#search_block_<?php echo $catalogID; ?> > form > #search_button_<?php echo $catalogID; ?>:hover {
	background: #<?php echo $paramssld["ht_view1_search_button_hover_color"]; ?>;
} 
#search_not_results_<?php echo $catalogID; ?> {
	width: 100%;
	height: 40px;
	background: #F1F1F1;
	color: #A49999;
	border-radius: 5px;
	border: 2px solid #E1E3DF;
	text-align: center;
	display: none;	
}
#search_not_results_<?php echo $catalogID; ?> > span {
	padding: 0;
	margin: 0;	
	line-height: 36px;
	font-size: 14px;	
}
/*</add search>*/
</style>
<section id="huge_it_catalog_content_<?php echo $catalogID; ?>" class="product-catalog-content">
    <?php if($catalogShowSorting == "on")
        { ?>
          <div id="huge_it_catalog_options_<?php echo $catalogID; ?>" class="">
            <ul id="sort-by" class="option-set clearfix" data-option-key="sortBy">
                <li><a href="#sortBy=original-order" data-option-value="original-order" class="selected" data><?php echo $paramssld["ht_view1_sorting_name_by_default"]; ?></a></li>
                <li><a href="#sortBy=id" data-option-value="id"><?php echo $paramssld["ht_view1_sorting_name_by_id"]; ?></a></li>
                <li><a href="#sortBy=symbol" data-option-value="symbol"><?php echo $paramssld["ht_view1_sorting_name_by_name"]; ?></a></li>
                <li id="shuffle"><a href='#shuffle'><?php echo $paramssld["ht_view1_sorting_name_by_random"]; ?></a></li>
            </ul>
              
            <ul id="sort-direction" class="option-set clearfix" data-option-key="sortAscending">
                <li><a href="#sortAscending=true" data-option-value="true" class="selected"><?php echo $paramssld["ht_view1_sorting_name_by_asc"]; ?></a></li>
                <li><a href="#sortAscending=false" data-option-value="false"><?php echo $paramssld["ht_view1_sorting_name_by_desc"]; ?></a></li>
            </ul>
          </div>
  <?php }
   if($catalogShowFiltering == "on")
      { ?>
         <div id="huge_it_catalog_filters_<?php echo $catalogID; ?>" >
            <ul>
                <li rel="*"><a>All</a></li>
                <?php
                $catalogCats = explode(",", $catalogCats);
                foreach ($catalogCats as $catalogCatsValue) {
                    if(!empty($catalogCatsValue))
                    {
                ?>
                <li rel=".<?php echo str_replace(" ","_",$catalogCatsValue); ?>"><a><?php echo str_replace("_"," ",$catalogCatsValue); ?></a></li>
                    <?php
                    }
                }
                ?>
            </ul>
        </div>
<?php }  if($catalogSearch == 'on') {?>
		<div id="search_block_<?php echo $catalogID; ?>">	
			<form>
				<input type="text"/><div><i class="hugeiticons hugeiticons-times"></i></div>
				<button id="search_button_<?php echo $catalogID; ?>" type="submit"><i class="hugeiticons hugeiticons-search"></i>
				</button>
			</form>	
			<div id="search_not_results_<?php echo $catalogID; ?>"><span><?php echo $paramssld3['ht_catalog_general_no_search_result_text']; ?></span></div>
		</div>		
<?php } ?>	 	
        <div id="huge_it_catalog_container_<?php echo $catalogID; ?>" class="super-list variable-sizes clearfix" <?php //if($paramssld["ht_view1_sorting_float"] == "top" && $paramssld["ht_view1_filtering_float"] == "top") echo "style='clear: both;'";?>>
              <?php
              $group_key = 0;
              foreach($images as $key=>$row)
              {
                      $group_key ++;
                      $link = $row->sl_url;
                      $descnohtml=strip_tags($row->description);
                      $result = substr($descnohtml, 0, 50);
//                      $catForFilter = explode(",", $row->category);
                      ?>
                      <div class="element_<?php echo $catalogID; ?>  <?php if($paramssld['ht_view1_allow_lightbox'] == "on"){ echo "catalog_ccolorbox_grouping_".$catalogID;} ?> "  data-element-id="<?php echo $row->id; ?>"  data-symbol="<?php echo esc_attr($row->name); ?>" data-category="alkaline-earth">
                          <div class="default-block_<?php echo $catalogID; ?>">
                              <div class="image-block_<?php echo $catalogID; ?> for_zoom">
                                      <?php $imgurl=explode(";",$row->image_url); ?>
                                       <?php  if($row->image_url != ';'){
                                                  if($paramssld['ht_view1_allow_zooming'] == "off" && $paramssld['ht_view1_allow_lightbox'] == "on"){ ?>
                                                      <a href="<?php echo esc_attr($imgurl[0]); ?>" class="catalog_group<?php echo $group_key."_".$catalogID; ?>">
                                                          <img id="wd-cl-img<?php echo $key; ?>" src="<?php echo esc_attr($imgurl[0]); ?>" />
                                                      </a>
                                       <?php      }else{ ?>
                                                          <img id="wd-cl-img<?php echo $key; ?>" src="<?php echo esc_attr($imgurl[0]); ?>" />
                                       <?php      } ?>
                                                     
                                       <?php }else { ?>
                                               <img id="wd-cl-img<?php echo $key; ?>" src="images/noimage.png" />
                                       <?php } ?>	
                              </div>
                              <div class="title-block_<?php echo $catalogID; ?>">
                                      <h3 class="title"><?php echo $row->name; ?></h3>
                              </div>
                          </div>

                          <div class="wd-catalog-panel_<?php echo $catalogID; ?>" id="panel<?php echo $key; ?>">
                              <?php if($paramssld['ht_view1_show_thumbs']=='on' and $paramssld['ht_view1_thumbs_position']=="before")
                                    {?>
                                        <div>
                                            <ul class="thumbs-list_<?php echo $catalogID; ?>">
                                            <?php
                                                    $imgurl=explode(";",$row->image_url);
                                                    array_pop($imgurl);
                                                    if(($paramssld['ht_view1_allow_zooming'] == "on" && $paramssld['ht_view1_allow_lightbox'] == "off") || ($paramssld['ht_view1_allow_zooming'] == "off" && $paramssld['ht_view1_allow_lightbox'] == "off")){  }
                                                    else{ array_shift($imgurl); }

                                                    foreach($imgurl as $key1=>$img)
                                                    {
                                                    ?>
                                                    <li>
                                                            <a href="<?php echo esc_attr($img); ?>" class="catalog_group<?php echo $group_key."_".$catalogID; ?>"><img src="<?php echo esc_attr($img); ?>"></a>
                                                    </li>
                                                    <?php
                                                    }
                                            ?>
                                            </ul>
                                        </div>
                              <?php } 
                                    if($paramssld['ht_view1_show_description']=='on'){ ?>
                                        <div class="description-block_<?php echo $catalogID; ?>">
                                            <p><?php echo $row->description; ?></p>
                                        </div>
                              <?php }
                                      if($paramssld['ht_view1_show_thumbs']=='on' and $paramssld['ht_view1_thumbs_position']=="after"){?>
                                              <div>
                                                      <ul class="thumbs-list_<?php echo $catalogID; ?>">
                                                            <?php
                                                                    $imgurl=explode(";",$row->image_url);
                                                                    array_pop($imgurl);
                                                                    if(($paramssld['ht_view1_allow_zooming'] == "on" && $paramssld['ht_view1_allow_lightbox'] == "off") || ($paramssld['ht_view1_allow_zooming'] == "off" && $paramssld['ht_view1_allow_lightbox'] == "off")){  }
                                                                    else{ array_shift($imgurl); }

                                                                    foreach($imgurl as $key1=>$img)
                                                                    {
                                                                    ?>
                                                                    <li>
                                                                            <a href="<?php echo esc_attr($img); ?>" class="catalog_group<?php echo $group_key."_".$catalogID; ?>"><img src="<?php echo esc_attr($img); ?>"></a>
                                                                    </li>
                                                                    <?php
                                                                    }
                                                              ?>
                                                      </ul>
                                              </div>
                                      <?php } ?>
                                      
                                      <?php if($paramssld["ht_catalog_view1_show_price"]=='on' && $row->price != ""){ ?>
                                                <div class="price-block_<?php echo $catalogID; ?>">
                                                    <span class="old-price-block" ><?php echo $paramssld3['ht_single_product_price_text']; ?> : <span class="old-price" <?php if($row->market_price == "") { echo "style='text-decoration: none !important;'"; } ?>><?php echo $row->price; ?></span></span>
                                                    <span class="discont-price-block" ><span class="discont-price" ><?php echo $row->market_price; ?></span></span>
                                                </div>
                                      <?php } ?>
                                      
                                      <?php
                                      if($paramssld['ht_view1_show_linkbutton']=='on'){
                                          if($row->single_product_url_type == "default"){
                                             $page_link = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
                                             if (strpos(get_permalink(),'/?') !== false) { $product_page_link = get_permalink()."&single_prod_id=$row->id"; } else { if (strpos(get_permalink(),'/') !== false) { $product_page_link = get_permalink()."?single_prod_id=$row->id"; } else { $product_page_link = get_permalink()."/?single_prod_id=$row->id"; } }
                                         }
                                         else{ $product_page_link = $row->single_product_url_type; }
                                         ?>
                                              <div class="button-block">
                                                      <a href="<?php echo esc_url($product_page_link); ?>" <?php if($row->link_target == 'on'){echo ' target="_blank"';} ?>><?php echo $paramssld3['ht_catalog_general_linkbutton_text']; ?></a>
                                              </div>
                                      <?php } ?>
                              </div>
                      </div>

                      <?php
              }
              ?>
        </div>

        <?php
            if($catalog[0]->pagination_type == "pagination"){
        ?>
        <div class="catalog_pagination_block_<?php echo $catalogID; ?>" >
            <div class="catalog_pagination_<?php echo $catalogID; ?>" >
                <?php
//                var_dump($_SERVER);
                
                    if (strpos($_SERVER['QUERY_STRING'], 'catalog_page_') !== false)
                {                                                                   //      IF WE HAVE $_GET PAGE
                    $oneMore = $page_index + 1;
                    $oneLess = $page_index - 1;
                    
                    if(isset($_GET["catalog_page_".$catalogID])){                   //      IF WE HAVE $_GET PAGE FOR THAT CATALOG
                        $prevPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$oneLess,$_SERVER['QUERY_STRING']);
                        $nextPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$oneMore,$_SERVER['QUERY_STRING']);
                        $firstPagePath = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=1",$_SERVER['QUERY_STRING']);
                        $lastPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$pages,$_SERVER['QUERY_STRING']);
//                        var_dump($nextPagePath);
                    }
                    else{                                                           //      IF WE HAVE $_GET PAGE FOR ANOTHER CATALOG
                        $prevPagePath  = "#";
                        $nextPagePath = $_SERVER['QUERY_STRING']."&catalog_page_".$catalogID."=2";
//                        $nextPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$oneMore,$_SERVER['QUERY_STRING']);
                        $firstPagePath = $_SERVER['QUERY_STRING']."&catalog_page_".$catalogID."=1";
                        $lastPagePath  = $_SERVER['QUERY_STRING']."&catalog_page_".$catalogID."=".$pages;
                    }
                }
                else{                                                               //      IF WE HAVE NOOOT $_GET PAGE
                    $oneMore = $page_index + 1;
                    $oneLess = $page_index - 1;
                    
                    $prevPagePath  = "#";
                    $nextPagePath  = "catalog_page_".$catalogID."=2";
                    $firstPagePath = "catalog_page_".$catalogID."=1";
                    $lastPagePath  = "catalog_page_".$catalogID."=".$pages;
                }
                

               
                    if (strpos(get_permalink(),'/?') !== false) { $pathSumbol = "&"; }
                    else {
                        if (strpos(get_permalink(),'/') !== false) { $pathSumbol = "?"; }
                        else { $pathSumbol = "/?"; }
                    }
                    // The "back" link
//                    $prevlink = ($page_index > 1) ? ''
//                            . '<a href="'.$pathSumbol.$firstPagePath. '" class="go-to-first"></a> <a href="'.$pathSumbol.$prevPagePath. '" class="go-to-previous"></a>' : '<span class="disabled go-to-first-passive"></span> <span class="disabled go-to-previous-passive"></span>';
//
//                    // The "forward" link
//                    $nextlink = ($page_index < $pages) ? ''
//                            . '<a href="'.$pathSumbol.$nextPagePath. '" class="go-to-next"></a> <a href="'.$pathSumbol.$lastPagePath. '" class="go-to-last"></a>' : '<span class="disabled go-to-next-passive"></span> <span class="disabled go-to-last-passive"></span>';
//                    echo $prevlink." <span class='pagination-text'>Page ".$page_index." / ".$pages."</span> ".$nextlink;
                
                    // The "back" link
                    $prevlink = ($page_index > 1) ? ''
                            . '<a href="'.$pathSumbol.$firstPagePath. '" class="go-to-first"><i class="icon-style4 hugeiticons-fast-backward" ></i></a>'
                            . '<a href="'.$pathSumbol.$prevPagePath. '" class="go-to-previous"><i class="icon-style4 hugeiticons-chevron-left"></i></a>' : '<span class="disabled go-to-first-passive"></span> <span class="disabled go-to-previous-passive"></span>';

                    // The "forward" link
                    $nextlink = ($page_index < $pages) ? ''
                            . '<a href="'.$pathSumbol.$nextPagePath. '" class="go-to-next"><i class="icon-style4 hugeiticons-chevron-right"></i></a>'
                            . '<a href="'.$pathSumbol.$lastPagePath. '" class="go-to-last"><i class="icon-style4 hugeiticons-fast-forward" ></i></a>' : 
                              '<span class="disabled go-to-next-passive"></span>'
                            . '<span class="disabled go-to-last-passive"></span>';
                    
                    echo $prevlink." <span class='pagination-text'>".$page_index." / ".$pages."</span> ".$nextlink;
                    
                ?>
            </div>
        </div>
        <?php
            }
            elseif($catalog[0]->pagination_type == "load_more"){ $path_site = plugins_url("/../images", __FILE__); ?>
                <div class="catalog_load_block_<?php echo $catalogID; ?>" >
                    <div class="catalog_load_<?php echo $catalogID; ?>" >
                        <a href="#" class="load_more_elements_<?php echo $catalogID; ?>"><?php echo __("Load","product-catalog");?></a>
                        <img src="<?php echo $path_site; ?>/load_more_icon_<?php echo $paramssld['htc_view1_load_more_loading_icon']; ?>.gif" class="load_more_loading_icon" style="display: none"/>
                        <input type="hidden" class="load-more-elements-count" value="<?php echo esc_attr($countIntoPage); ?>"/>
                    <?php
                        
                    ?>
                    </div>
                </div>
      <?php } ?>

 </section>

<!--<script>
//    jQuery(".search-imput").change(function(){
//       var dd = 3;
//       jQuery(".element_8").each(function(){
//           dd += 1;
//           if(dd % 2 == 0){
//               jQuery(this).remove();
//           }
//       });

//       saxin display block.im uzacnerin display none u relayout
//       
//    });
    
</script>-->

<script>
/***<object for view  add search> ***/

var $ob_<?php echo $catalogID; ?> = {
            action: 'my_action',
            post: 'load_more_elements_into_catalog',
            view: <?php echo $catalog[0]->catalog_list_effects_s; ?>,
            catalog_id: <?php echo $catalogID; ?>,
            count_into_page: <?php echo $countIntoPage; ?>,
            allow_lightbox: "<?php echo $paramssld['ht_view1_allow_lightbox']; ?>",
            show_thumbs: "<?php echo $paramssld['ht_view1_show_thumbs']; ?>",
            thumbs_position: "<?php echo $paramssld['ht_view1_thumbs_position']; ?>",
            show_description: "<?php echo $paramssld['ht_view1_show_description']; ?>",
            show_price: "<?php echo $paramssld["ht_catalog_view1_show_price"]; ?>",
            price_text: "<?php echo $paramssld3['ht_single_product_price_text']; ?>",
            show_linkbutton: "<?php echo $paramssld['ht_view1_show_linkbutton']; ?>",
            linkbutton_text: "<?php echo $paramssld3['ht_catalog_general_linkbutton_text']; ?>",
            parmalink: "<?php echo get_permalink(); ?>"
};
/***</object for view  add search> ***/

    var allowZooming = '<?php echo $paramssld['ht_view1_allow_zooming'];?>';
    var allowLightbox = '<?php // echo $paramssld['ht_view1_allow_lightbox'];?>';
jQuery(function(){    
var defaultBlockWidth=<?php echo $paramssld['ht_view1_block_width']; ?>;
    
    var $container = jQuery('#huge_it_catalog_container_<?php echo $catalogID; ?>');
    
    
      // add randomish size classes
      $container.find('.element_<?php echo $catalogID; ?>').each(function(){
        var $this = jQuery(this),
            number = parseInt( $this.find('.number').text(), 10 );
			//alert(number);
        if ( number % 7 % 2 === 1 ) {
          $this.addClass('width2');
        }
        if ( number % 3 === 0 ) {
          $this.addClass('height2');
        }
      });
    
    $container.hugeitmicro({
      itemSelector : '.element_<?php echo $catalogID; ?>',
      masonry : {
        columnWidth : <?php echo $paramssld['ht_view1_block_width']; ?>+20+<?php echo $paramssld['ht_view1_element_border_width']*2; ?>
      },
      masonryHorizontal : {
        rowHeight: 300+20
      },
      cellsByRow : {
        columnWidth : 300+20,
        rowHeight : 240
      },
      cellsByColumn : {
        columnWidth : 300+20,
        rowHeight : 240
      },
      getSortData : {
        symbol : function( $elem ) {
          return $elem.attr('data-symbol');
        },
        category : function( $elem ) {
          return $elem.attr('data-category');
        },
        number : function( $elem ) {
          return parseInt( $elem.find('.number').text(), 10 );
        },
        weight : function( $elem ) {
          return parseFloat( $elem.find('.weight').text().replace( /[\(\)]/g, '') );
        },
        id : function ( $elem ) {
          return $elem.find('.id').text();
        }
      }
    });
    
    
      var $optionSets = jQuery('#huge_it_catalog_options_<?php echo $catalogID; ?> .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = jQuery(this);

        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
  

        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');

        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {

          changeLayoutMode( $this, options )
        } else {

          $container.hugeitmicro( options );
        }
        
        return false;
      });


    

      var isHorizontal = false;
      function changeLayoutMode( $link, options ) {
        var wasHorizontal = isHorizontal;
        isHorizontal = $link.hasClass('horizontal');

        if ( wasHorizontal !== isHorizontal ) {

          var style = isHorizontal ? 
            { height: '75%', width: $container.width() } : 
            { width: 'auto' };

          $container.filter(':animated').stop();

          $container.addClass('no-transition').css( style );
          setTimeout(function(){
            $container.removeClass('no-transition').hugeitmicro( options );
          }, 100 )
        } else {
          $container.hugeitmicro( options );
        }
      }

    var $sortBy =  jQuery('#huge_it_catalog_content_<?php echo $catalogID; ?> #sort-by');
    jQuery('#huge_it_catalog_content_<?php echo $catalogID; ?> #shuffle a').click(function(){
      $container.hugeitmicro('shuffle');
      $sortBy.find('.selected').removeClass('selected');
      $sortBy.find('[data-option-value="random"]').addClass('selected');
      return false;
    });
    
    ////filteringgggggg

        // bind filter on select change
        jQuery(document).ready(function(){
            jQuery('#huge_it_catalog_filters_<?php echo $catalogID; ?> ul li').click(function() {
              // get filter value from option value
              var filterValue = jQuery(this).attr('rel');
              // use filterFn if matches value
              filterValue = filterValue;//filterFns[ filterValue ] || 
              $container.hugeitmicro({ filter: filterValue });
            });
            <?php // if(($paramssld["ht_view1_sorting_float"] == "left" || $paramssld["ht_view1_sorting_float"] == "right") && $paramssld["ht_view1_filtering_float"] == "none")
//                  { ?>
//                        var topmargin = jQuery("#huge_it_catalog_filters_<?php echo $catalogID; ?> ul").height();
//                        jQuery("#huge_it_catalog_options_<?php echo $catalogID; ?>").css({'margin-top':parseInt(topmargin) + 5});
            <?php // }
//            else  {
//                    if(($paramssld["ht_view1_filtering_float"] == "left" || $paramssld["ht_view1_filtering_float"] == "right") && $paramssld["ht_view1_sorting_float"] == "none")
//                      { ?>
//                         var topmargin = jQuery("#huge_it_catalog_options_<?php echo $catalogID; ?>").height();
//                         jQuery("#huge_it_catalog_filters_<?php echo $catalogID; ?>").css({'margin-top':'5px'});
                <?php // }
//                  } ?>
            
            /*    <--   VIEW 1 ELEMENTS THUMBS CLICK    */
            
            jQuery(".element_<?php echo $catalogID; ?> .thumbs-list_<?php echo $catalogID; ?> li a img").click(function(e){
                var lightbox_is = "<?php echo $paramssld['ht_view1_allow_lightbox']; ?>";
                    if(lightbox_is != "on"){
                        e.preventDefault();
//                        alert(lightbox_is);
                        var new_src = jQuery(this).attr("src");    //    alert(new_src);
                        var image = jQuery(this).closest(".element_<?php echo $catalogID; ?>").find(".default-block_<?php echo $catalogID; ?> .image-block_<?php echo $catalogID; ?> img");
                            image.attr("src", new_src);
                            zoom_start();
                    }
            });
            
        });
        
        jQuery(window).load(function(){

            $container.hugeitmicro({ filter: '*' });
        });
  });
</script>	  
	  <?php
	  
        break;
/////////////////////////////// VIEW 2 Popup /////////////////////////////
		  case 2:
      
	
	  ?>
<?php
//    if($paramssld["ht_view2_sorting_float"] == "left" && $paramssld["ht_view2_filtering_float"] == "right" ||
//       $paramssld["ht_view2_sorting_float"] == "right" && $paramssld["ht_view2_filtering_float"] == "left" ||
//       $paramssld["ht_view2_sorting_float"] == $paramssld["ht_view2_filtering_float"])
//       { $sorting_block_width ="20%"; $filtering_block_width ="20%"; $middle_with = "56%"; }
//    else if($paramssld["ht_view2_sorting_float"] == "left" || $paramssld["ht_view2_sorting_float"] == "right" && $paramssld["ht_view2_filtering_float"] == "top")
//       { $sorting_block_width ="30%"; $filtering_block_width ="100%"; $paramssld["ht_view2_filtering_float"] = "none"; $width_middle = "65%"; }
//    else if($paramssld["ht_view2_filtering_float"] == "left" || $paramssld["ht_view2_filtering_float"] == "right" && $paramssld["ht_view2_sorting_float"] == "top")
//       { $sorting_block_width ="100%"; $filtering_block_width ="30%"; $paramssld["ht_view2_sorting_float"] = "none"; $width_middle = "65%"; }
//    if($paramssld["ht_view2_sorting_float"] == "top" && $paramssld["ht_view2_filtering_float"] == "top")
//       { $sorting_block_width ="100%"; $filtering_block_width ="100%"; $left_to_top = "ok"; }

if($catalog[0]->pagination_type == "show_all"){
    $myAllImages = count($images);
    if($myAllImages < $catalog[0]->count_into_page)            //update pagination bug
        $countIntoPage = $myAllImages;
    else
    $countIntoPage = $catalog[0]->count_into_page;
    if($countIntoPage == "" || $countIntoPage < 1){ $countIntoPage = 1; }
    $pages = ceil($myAllImages / $countIntoPage);
    if(isset($_GET["catalog_page_".$catalogID])){ $page_index = absint($_GET["catalog_page_".$catalogID]); }
    else{ $page_index = 1; }
    $maxCount = $page_index * $countIntoPage;
    $morePaste = $maxCount - $myAllImages;
}
else{
    if(isset($_GET["catalog_page_".$catalogID])){
            $myAllImages = count($images);
            if($myAllImages < $catalog[0]->count_into_page)            //update pagination bug
                $countIntoPage = $myAllImages;
            else
            $countIntoPage = $catalog[0]->count_into_page;
            if($countIntoPage == "" || $countIntoPage < 1){ $countIntoPage = 1; }
            $pages = ceil($myAllImages / $countIntoPage);
            $page_index = absint($_GET["catalog_page_".$catalogID]);
            $maxCount = $page_index * $countIntoPage;
            $morePaste = $maxCount - $myAllImages;
            
//            var_dump($page_index." ".$countIntoPage." ".$maxCount." ".$morePaste." ".$myAllImages." ".$pages);
            if($page_index <= 1 || ($maxCount > $myAllImages) && $morePaste > $countIntoPage){
                $imagesUsefulElements = array();
                for($usefulKeys = 0; $usefulKeys < $countIntoPage; $usefulKeys++){
                    $imagesUsefulElements[] = $images[$usefulKeys];
                }
                $images = $imagesUsefulElements;
            }
            elseif (($maxCount <= $myAllImages) || ($maxCount > $myAllImages && $morePaste <= $countIntoPage)){
                $show_from = $page_index * $countIntoPage - $countIntoPage;
                $show_until = $page_index * $countIntoPage - 1;
                $usefulElementsKey = 0;
                
//                var_dump("from ".$show_from." ".$show_until);
                foreach($images as $galleryElements){
                    if($usefulElementsKey >= $show_from && $usefulElementsKey <= $show_until){
                        $imagesUsefulElements[] = $galleryElements;
                    }
                    $usefulElementsKey++;
                }
                $images = $imagesUsefulElements;
            }
    }
    else{
        $myAllImages = count($images);
        $page_index = 1;
        if($myAllImages < $catalog[0]->count_into_page)            //update pagination bug
            $countIntoPage = $myAllImages;
        else
        $countIntoPage = $catalog[0]->count_into_page;
        if($countIntoPage == "" || $countIntoPage < 1){ $countIntoPage = 1; }
        $pages = ceil($myAllImages / $countIntoPage);
        $imagesUsefulElements = array();
        for($usefulKeys = 0; $usefulKeys < $countIntoPage; $usefulKeys++){
            $imagesUsefulElements[] = $images[$usefulKeys];
//                    var_dump($usefulKeys);
        }
        $images = $imagesUsefulElements;
    }
}

?>

<script>
/***<add search for view> ***/

var $ob_<?php echo $catalogID; ?> = {
                            action: 'my_action',
                            post: 'load_more_elements_into_catalog',
                            view: <?php echo $catalog[0]->catalog_list_effects_s; ?>,
                            catalog_id: <?php echo $catalogID; ?>,
                            count_into_page: <?php echo $countIntoPage; ?>,
                            allow_lightbox: "<?php echo $paramssld['ht_view2_allow_lightbox']; ?>",
                            show_thumbs: "<?php echo $paramssld['ht_view2_show_thumbs']; ?>",
                            thumbs_position: "<?php echo $paramssld['ht_view2_thumbs_position']; ?>",
                            show_popup_title: "<?php echo $paramssld['ht_view2_show_popup_title']; ?>",
                            show_description: "<?php echo $paramssld['ht_view2_show_description']; ?>",
                            show_price: "<?php echo $paramssld["ht_catalog_view2_show_price"]; ?>",
                            price_text: "<?php echo $paramssld3['ht_single_product_price_text']; ?>",
                            show_linkbutton: "<?php echo $paramssld['ht_view2_element_show_linkbutton']; ?>",
                            linkbutton_text: "<?php echo $paramssld3["ht_catalog_general_linkbutton_text"]; ?>",
                            parmalink: "<?php echo get_permalink(); ?>",
                            show_popup_linkbutton: "<?php echo $paramssld["ht_view2_show_popup_linkbutton"]; ?>"
};
/***</add search for view> ***/

    var allowZooming = '<?php echo $paramssld['ht_view2_allow_zooming'];?>';
    
jQuery(function(){    
var defaultBlockWidth=<?php echo $paramssld['ht_view2_element_width']; ?>;
var defaultBlockHeight=<?php echo $paramssld['ht_view2_element_height']; ?>;
    
    var $container = jQuery('#huge_it_catalog_container_<?php echo $catalogID; ?>');
    
    
      // add randomish size classes
      $container.find('.element_<?php echo $catalogID; ?>').each(function(){
        var $this = jQuery(this),
            number = parseInt( $this.find('.number').text(), 10 );
			//alert(number);
        if ( number % 7 % 2 === 1 ) {
          $this.addClass('width2');
        }
        if ( number % 3 === 0 ) {
          $this.addClass('height2');
        }
      });
    
    $container.hugeitmicro({
      itemSelector : '.element_<?php echo $catalogID; ?>',
      masonry : {
        columnWidth : <?php echo $paramssld['ht_view2_element_width']; ?>+20+<?php echo $paramssld['ht_view2_element_border_width']*2; ?>
      },
      masonryHorizontal : {
        rowHeight: 300+20
      },
      cellsByRow : {
        columnWidth : 300+20,
        rowHeight : 240
      },
      cellsByColumn : {
        columnWidth : 300+20,
        rowHeight : 240
      },
      getSortData : {
        symbol : function( $elem ) {
          return $elem.attr('data-symbol');
        },
        category : function( $elem ) {
          return $elem.attr('data-category');
        },
        number : function( $elem ) {
          return parseInt( $elem.find('.number').text(), 10 );
        },
        weight : function( $elem ) {
          return parseFloat( $elem.find('.weight').text().replace( /[\(\)]/g, '') );
        },
        id : function ( $elem ) {
          return $elem.find('.id').text();
        }
      }
    });
    
    
      var $optionSets = jQuery('#huge_it_catalog_options_<?php echo $catalogID; ?> .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = jQuery(this);

        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
  

        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');

        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {

          changeLayoutMode( $this, options )
        } else {

          $container.hugeitmicro( options );
        }
        
        return false;
      });


    

      var isHorizontal = false;
      function changeLayoutMode( $link, options ) {
        var wasHorizontal = isHorizontal;
        isHorizontal = $link.hasClass('horizontal');

        if ( wasHorizontal !== isHorizontal ) {

          var style = isHorizontal ? 
            { height: '75%', width: $container.width() } : 
            { width: 'auto' };

          $container.filter(':animated').stop();

          $container.addClass('no-transition').css( style );
          setTimeout(function(){
            $container.removeClass('no-transition').hugeitmicro( options );
          }, 100 )
        } else {
          $container.hugeitmicro( options );
        }
      }


    

      $container.delegate( '.default-block_<?php echo $catalogID; ?>', 'click', function(){
          var strheight=0;
          jQuery(this).parents('.element_<?php echo $catalogID; ?>').find('.wd-catalog-panel_<?php echo $catalogID; ?> > div').each(function(){
                strheight+=jQuery(this).outerHeight()+10;
                //alert(strheight);
          })
          strheight+=<?php echo $paramssld['ht_view0_block_height']+45; ?>;
	  			if(jQuery(this).parents('.element_<?php echo $catalogID; ?>').hasClass("large")){
			jQuery(this).parents('.element_<?php echo $catalogID; ?>').animate({
				height: "<?php echo $paramssld['ht_view0_block_height']+45; ?>px"
			}, 300, function() {
				jQuery(this).removeClass('large');
				$container.hugeitmicro('reLayout');
			});
			
			jQuery(this).parents('.element_<?php echo $catalogID; ?>').removeClass("active");
			return false;
		}
		
	
		jQuery(this).parents('.element_<?php echo $catalogID; ?>').css({height:strheight});
		jQuery(this).parents('.element_<?php echo $catalogID; ?>').addClass('large');

		$container.hugeitmicro('reLayout');
		jQuery(this).parents('.element_<?php echo $catalogID; ?>').css({height:"<?php echo $paramssld['ht_view0_block_height']+45; ?>px"});		 
		 
		//alert(strheight);
		 
		 jQuery(this).parents('.element_<?php echo $catalogID; ?>').animate({
			height:strheight+"px",
		  }, 300,function(){	$container.hugeitmicro('reLayout');});
	});

    var $sortBy =  jQuery('#huge_it_catalog_content_<?php echo $catalogID; ?> #sort-by');
    jQuery('#huge_it_catalog_content_<?php echo $catalogID; ?> #shuffle a').click(function(){
      $container.hugeitmicro('shuffle');
      $sortBy.find('.selected').removeClass('selected');
      $sortBy.find('[data-option-value="random"]').addClass('selected');
      return false;
    });
    
    jQuery(window).load(function(){
        $container.hugeitmicro({ filter: '*' });
    });
    
    ////filteringgggggg

        // bind filter on select change
        jQuery(document).ready(function(){
            jQuery('#huge_it_catalog_filters_<?php echo $catalogID; ?> ul li').click(function() {
              // get filter value from option value
              var filterValue = jQuery(this).attr('rel');
              // use filterFn if matches value
              filterValue = filterValue;//filterFns[ filterValue ] || 
              $container.hugeitmicro({ filter: filterValue });
            });
            <?php // if(($paramssld["ht_view2_sorting_float"] == "left" || $paramssld["ht_view2_sorting_float"] == "right") && $paramssld["ht_view2_filtering_float"] == "none")
//                  { ?>
//                        var topmargin = jQuery("#huge_it_catalog_filters_<?php echo $catalogID; ?> ul").height();
//                        jQuery("#huge_it_catalog_options_<?php echo $catalogID; ?>").css({'margin-top':parseInt(topmargin) + 5});
            <?php // }
//            else  {
//                    if(($paramssld["ht_view2_filtering_float"] == "left" || $paramssld["ht_view2_filtering_float"] == "right") && $paramssld["ht_view2_sorting_float"] == "none")
//                      { ?>
//                         var topmargin = jQuery("#huge_it_catalog_options_<?php echo $catalogID; ?>").height();
//                         jQuery("#huge_it_catalog_filters_<?php echo $catalogID; ?>").css({'margin-top':'5px'});
                <?php // }
//                  } ?>
            
            
            /*    <--    VIEW 2 LOAD MORE CLICK    */
           /* 

			*/
            
            /*           VIEW 2 LOAD MORE CLICK    -->    */
            /*      <-- POPUP LEFT CLICK -->        */
        jQuery("#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .left-change").click(function(){
        	//var strid = jQuery(this).closest(".pupup-element").prev(".pupup-element").find('a').data('popupid').replace('#','');
        	var height = jQuery(window).height();
        	//jQuery('#huge_it_gallery_pupup_element_'+strid).css({height:height*0.7});
            var num = jQuery(this).find("a").attr("href").replace('#', '');
            if(num >= 1){
            	var strid = jQuery(this).closest(".pupup-element").prev(".pupup-element").find('a').data('popupid').replace('#','');
            	jQuery('#huge_it_catalog_pupup_element_'+strid).css({height:height*0.7});
                jQuery(this).closest(".pupup-element").removeClass("active");
                jQuery(this).closest(".pupup-element").prev(".pupup-element").addClass("active");
            }else{
            	var strid = jQuery("#huge_it_catalog_popup_list_<?php echo $catalogID; ?>").find(".pupup-element").last().find('a').data('popupid').replace('#','');
            	jQuery('#huge_it_catalog_pupup_element_'+strid).css({height:height*0.7});
                jQuery(this).closest(".pupup-element").removeClass("active");
                jQuery("#huge_it_catalog_popup_list_<?php echo $catalogID; ?>").find(".pupup-element").last().addClass("active");
            }
            if(jQuery('.pupup-element.active .description').height() + jQuery('.right-block h3').height() + 350 > jQuery('.pupup-element.active .right-block').height()){
            if(jQuery('.pupup-element.active img').height() > jQuery('.pupup-element.active .image-block_<?php echo $catalogID; ?>').height()){
                jQuery('.pupup-element.active .right-block').css('overflow-y', '');
                jQuery('.pupup-element.active .popup-wrapper_<?php echo $catalogID; ?>').css('overflow-y', 'auto');
            }else{
                jQuery('.pupup-element.active .right-block').css('overflow-y', 'auto');
            }
            }else {
                if(jQuery('.pupup-element.active img').height() > jQuery('.pupup-element.active .image-block_<?php echo $catalogID; ?>').height()){
                    jQuery('.pupup-element.active .popup-wrapper_<?php echo $catalogID; ?>').css('overflow-y', 'auto');
                }
            }
            
        });
            
        /*      <-- POPUP RIGHT CLICK -->        */
        jQuery("#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .right-change").click(function(){
        	var height = jQuery(window).height();
            var num = jQuery(this).find("a").attr("href").replace('#', '');
            var cnt = 0;
            jQuery("#huge_it_catalog_popup_list_<?php echo $catalogID; ?>").find(".pupup-element").each(function(){
                cnt++;
        });
//            alert(num+" "+cnt);
            if(num <= cnt){
            	var strid = jQuery(this).closest(".pupup-element").next(".pupup-element").find('a').data('popupid').replace('#','');
	        	jQuery('#huge_it_catalog_pupup_element_'+strid).css({height:height*0.7});
                jQuery(this).closest(".pupup-element").removeClass("active");
                jQuery(this).closest(".pupup-element").next(".pupup-element").addClass("active");
            }else{
            	var strid = jQuery("#huge_it_catalog_popup_list_<?php echo $catalogID; ?>").find(".pupup-element:first-child a").data('popupid').replace('#','');	        	
	        	jQuery('#huge_it_catalog_pupup_element_'+strid).css({height:height*0.7});
                jQuery(this).closest(".pupup-element").removeClass("active");
                jQuery("#huge_it_catalog_popup_list_<?php echo $catalogID; ?>").find(".pupup-element:first-child").addClass("active");
            }
            if(jQuery('.pupup-element.active .description').height() + jQuery('.right-block h3').height() + 350 > jQuery('.pupup-element.active .right-block').height()){
            if(jQuery('.pupup-element.active img').height() > jQuery('.pupup-element.active .image-block_<?php echo $catalogID; ?>').height()){
                jQuery('.pupup-element.active .right-block').css('overflow-y', '');
                jQuery('.pupup-element.active .popup-wrapper_<?php echo $catalogID; ?>').css('overflow-y', 'auto');
            }else{
                jQuery('.pupup-element.active .right-block').css('overflow-y', 'auto');
            }
            }else {
                if(jQuery('.pupup-element.active img').height() > jQuery('.pupup-element.active .image-block_<?php echo $catalogID; ?>').height()){
                    jQuery('.pupup-element.active .popup-wrapper_<?php echo $catalogID; ?>').css('overflow-y', 'auto');
                }
            }
        });
	//////

  });

  });
  jQuery(document).ready(function(){

	jQuery('body').delegate('.element_<?php echo $catalogID; ?> .image-block_<?php echo $catalogID; ?> .image-overlay a', 'click', function() {
		var strid = jQuery(this).attr('href').replace('#','');
		jQuery('body').append('<div id="huge-popup-overlay_<?php echo $catalogID; ?>"></div>');
		jQuery('#huge_it_catalog_popup_list_<?php echo $catalogID; ?>').insertBefore('#huge-popup-overlay_<?php echo $catalogID; ?>');
		var height = jQuery(window).height();
		var width=jQuery(window).width();
		if(width<=767){
			jQuery('body').scrollTop(0);
		}
		jQuery('#huge_it_catalog_pupup_element_'+strid).addClass('active').css({height:height*0.7});
		jQuery('#huge_it_catalog_popup_list_<?php echo $catalogID; ?>').addClass('active');
		
		jQuery('#huge_it_catalog_pupup_element_'+strid+' ul.thumbs-list_<?php echo $catalogID; ?> li:first-child').addClass('active');
		var strsrc=jQuery('#huge_it_catalog_pupup_element_'+strid+' ul.thumbs-list_<?php echo $catalogID; ?> li:first-child a img').attr('src');
		jQuery('#huge_it_catalog_pupup_element_'+strid+' .image-block_<?php echo $catalogID; ?> img').attr('src',strsrc);
		//alert(strsrc);
        if(jQuery('.pupup-element.active .description').height() + jQuery('.right-block h3').height() + 350 > jQuery('.pupup-element.active .right-block').height()){
            if(jQuery('.pupup-element.active img').height() > jQuery('.pupup-element.active .image-block_<?php echo $catalogID; ?>').height()){
                jQuery('.pupup-element.active .right-block').css('overflow-y', '');
                jQuery('.pupup-element.active .popup-wrapper_<?php echo $catalogID; ?>').css('overflow-y', 'auto');
            }else{
                jQuery('.pupup-element.active .right-block').css('overflow-y', 'auto');
            }
            }else {
                if(jQuery('.pupup-element.active img').height() > jQuery('.pupup-element.active .image-block_<?php echo $catalogID; ?>').height()){
                    jQuery('.pupup-element.active .popup-wrapper_<?php echo $catalogID; ?>').css('overflow-y', 'auto');
                }
            }
		return false;
	});
	
        jQuery('body').delegate('#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block ul.thumbs-list_<?php echo $catalogID; ?> li a', 'click', function() {
		var width=jQuery(window).width();
		if(width<=767){
			jQuery('body').scrollTop(0);
		}
		jQuery(this).parent().parent().find('li.active').removeClass('active');
		jQuery(this).parent().addClass('active');
		jQuery(this).parents('.right-block').prev().find('img').attr('src',jQuery(this).find('img').attr('src'));
		return false;
	});
	
        jQuery('body').delegate('#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .close', 'click', function() {
		closePopup();
		return false;
	});
	
	jQuery('body').on('click','#huge-popup-overlay_<?php echo $catalogID; ?>',function(){
		closePopup();
		return false;
	});
	
	function closePopup() {
		jQuery('#huge-popup-overlay_<?php echo $catalogID; ?>').remove();
		jQuery('#huge_it_catalog_popup_list_<?php echo $catalogID; ?> li').removeClass('active');
		jQuery('#huge_it_catalog_popup_list_<?php echo $catalogID; ?>').removeClass('active');
	}        
}); 
</script>

<style type="text/css">

.element_<?php echo $catalogID; ?> {
	width:<?php echo $paramssld['ht_view2_element_width']; ?>px;
	height:<?php echo $paramssld['ht_view2_element_height']+45; ?>px;
	margin:0px 0px 10px 0px;
	background:#<?php echo $paramssld['ht_view2_element_background_color']; ?>;
	border:<?php echo $paramssld['ht_view2_element_border_width']; ?>px solid #<?php echo $paramssld['ht_view2_element_border_color']; ?>;
	outline:none;
}

.element_<?php echo $catalogID; ?> .image-block_<?php echo $catalogID; ?> {
	position:relative;
	width:100%;
}

.element_<?php echo $catalogID; ?> .image-block_<?php echo $catalogID; ?> img {
	margin:0px !important;
	padding:0px !important;
	width:<?php echo $paramssld['ht_view2_element_width']; ?>px !important;
	height:<?php echo $paramssld['ht_view2_element_height']; ?>px !important;
	display:block;
	border-radius: 0px !important;
	box-shadow: 0 0px 0px rgba(0, 0, 0, 0) !important; 
}

.element_<?php echo $catalogID; ?> .image-block_<?php echo $catalogID; ?> .image-overlay {
	position:absolute;
	top:0px;
	left:0px;
	width:100%;
	height:100%;
	background: <?php
			list($r,$g,$b) = array_map('hexdec',str_split($paramssld['ht_view2_element_overlay_color'],2));
				$titleopacity=$paramssld["ht_view2_element_overlay_transparency"]/100;						
				echo 'rgba('.$r.','.$g.','.$b.','.$titleopacity.')  !important'; 		
	?>;
	display:none;
}

.element_<?php echo $catalogID; ?>:hover .image-block_<?php echo $catalogID; ?>  .image-overlay {
	display:block;
}

.element_<?php echo $catalogID; ?> .image-block_<?php echo $catalogID; ?> .image-overlay a {
	position:absolute;
	top:0px;
	left:0px;
	display:block;
	width:100%;
	height:100%;
	background:url('<?php echo  plugins_url( '../images/zoom.'.$paramssld["ht_view2_zoombutton_style"].'.png' , __FILE__ ); ?>') center center no-repeat;
}

.element_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> {
	position:relative;
	height: 30px;
	margin: 0;
	padding: 15px 0px 15px 0px;
	-webkit-box-shadow: inset 0 1px 0 rgba(0,0,0,.1);
	box-shadow: inset 0 1px 0 rgba(0,0,0,.1);
}

.element_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> h3 {
	position:relative;
	margin:0px !important;
	padding:0px 1% 0px 1% !important;
	width:98%;
	text-overflow: ellipsis;
	overflow: hidden; 
	white-space:nowrap;
	font-weight:normal;
	font-size: <?php echo $paramssld["ht_view2_element_title_font_size"];?>px !important;
	line-height: <?php echo $paramssld["ht_view2_element_title_font_size"]+4;?>px !important;
	color:#<?php echo $paramssld["ht_view2_element_title_font_color"];?>;
}

.element_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> .button-block {
	position:absolute;
	right:0px;
	top:0px;
	display:none;
	vertical-align:middle;
	height:30px;
	padding:10px 10px 4px 10px;
	background: <?php
			list($r,$g,$b) = array_map('hexdec',str_split($paramssld['ht_view2_element_overlay_color'],2));
				$titleopacity=$paramssld["ht_view2_element_overlay_transparency"]/100;						
				echo 'rgba('.$r.','.$g.','.$b.','.$titleopacity.')  !important'; 		
	?>;
	border-left: 1px solid rgba(0,0,0,.05);
}
.element_<?php echo $catalogID; ?>:hover .title-block_<?php echo $catalogID; ?> .button-block {display:block;}

.element_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> a,.element_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> a:link,.element_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> a:visited,
.element_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> a:hover,.element_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> a:focus,.element_<?php echo $catalogID; ?> .title-block_<?php echo $catalogID; ?> a:active {
	position:relative;
	display:block;
	vertical-align:middle;
	padding: 3px 10px 3px 10px; 
	border-radius:3px;
	font-size:<?php echo $paramssld["ht_view2_element_linkbutton_font_size"];?>px;
	background:#<?php echo $paramssld["ht_view2_element_linkbutton_background_color"];?>;
	color:#<?php echo $paramssld["ht_view2_element_linkbutton_color"];?>;
	text-decoration:none;
}

/*#####POPUP#####*/

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> {
	position:fixed;
	display:table;
	width:80%;
	top:7%;
	left:7%;
	margin:0px !important;
	list-style:none;
	z-index:20000000;
	display:none;
	height:90%;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?>.active {display:table;}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> li.pupup-element {
	position:relative;
	display:none;
	width:100%;
	padding:40px 0px 20px 0px;
	min-height:100%;
	position:relative;
	background:#<?php echo $paramssld["ht_view2_popup_background_color"];?>;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> li.pupup-element.active {
	display:block;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> {
	position:absolute;
	width:100%;
	height:40px;
	top:0px;
	left:0px;
	z-index:2001;
	background:url('<?php echo  plugins_url( '../images/divider.line.png' , __FILE__ ); ?>') center bottom repeat-x;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .close,#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .close:link, #huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .close:visited {
	position:relative;
	float:right;
	width:40px;
	height:40px;
	display:block;
	background:url('<?php echo  plugins_url( '../images/close.popup.'.$paramssld["ht_view2_popup_closebutton_style"].'.png' , __FILE__ ); ?>') center center no-repeat;
	border-left:1px solid #ccc;
	opacity:.65;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .close:hover, #huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .close:focus, #huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .close:active {opacity:1;}


#huge_it_catalog_popup_list_<?php echo $catalogID; ?> li.pupup-element .popup-wrapper_<?php echo $catalogID; ?> {
	position:relative;
	width:98%;
	height:98%;
	padding:2% 0% 0% 2%;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .image-block_<?php echo $catalogID; ?> {
	width:55%;
        <?php if($paramssld['ht_view2_popup_full_width'] == 'off') { echo "height:100%;"; } 
			else {echo "height: 100%;";} ?>
	position:relative;
	float:left;
	margin-right:2%;
	border-right:1px solid #ccc;
	min-width:200px;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .image-block_<?php echo $catalogID; ?> img {
        <?php
            if($paramssld['ht_view2_popup_full_width'] == 'off') { echo "max-width:100% !important; max-height:100% !important; margin: 0px auto !important; position:relative;"; }
            else { echo "width:100% !important;"; }
        ?>
	display:block;
	padding:0px !important;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block {
	height: 100%;
	width:42.8%;
	position:relative;
	float:left;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> li.pupup-element .popup-wrapper_<?php echo $catalogID; ?> .right-block > div {
	padding-top:10px;
    margin-right: 4%;
	margin-bottom:10px;
	<?php if($paramssld['ht_view2_show_separator_lines']=="on") {?>
		background:url('<?php echo  plugins_url( '../images/divider.line.png' , __FILE__ ); ?>') center top repeat-x;
	<?php } ?>
}
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> li.pupup-element .popup-wrapper_<?php echo $catalogID; ?> .right-block > div:last-child {background:none;}


#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .title {
	position:relative;
	display:block;
	margin:0px 0px 10px 0px !important;
	font-size:<?php echo $paramssld["ht_view2_popup_title_font_size"];?>px !important;
	line-height:<?php echo $paramssld["ht_view2_popup_title_font_size"]+4;?>px !important;
	color:#<?php echo $paramssld["ht_view2_popup_title_font_color"];?>;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .description {
	clear:both;
	position:relative;
	font-weight:normal;
	text-align:justify;
	font-size:<?php echo $paramssld["ht_view2_description_font_size"];?>px !important;
	color:#<?php echo $paramssld["ht_view2_description_color"];?>;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .description h1,
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .description h2,
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .description h3,
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .description h4,
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .description h5,
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .description h6,
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .description p, 
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .description strong,
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .description span {
	padding:2px !important;
	margin:0px !important;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .description ul,
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .description li {
	padding:2px 0px 2px 5px;
	margin:0px 0px 0px 8px;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .price-block_<?php echo $catalogID; ?> {
    padding: 20px 0px 7px 0px !important;
    font-size: <?php echo $paramssld['ht_catalog_view2_price_font_size']; ?>px;
    color: #<?php echo $paramssld['ht_catalog_view2_price_font_color']; ?>;
}
    
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .old-price {
	text-decoration: line-through;
        margin: 0px;
        padding: 0px;
        font-weight: normal;
/*        font-size: 14px;*/
        padding: 7px 10px 7px 10px;
        margin: 0px 10px 0px 0px;
        border-radius: 5px;
        color: #<?php echo $paramssld['ht_view2_popup_background_color']; ?>;
        background: #<?php echo $paramssld['ht_catalog_view2_price_font_color']; ?>;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .old-price-block {
	font-size: <?php echo $paramssld['ht_catalog_view2_price_font_size']; ?>px;
        color: #<?php echo $paramssld['ht_catalog_view2_price_font_color']; ?>;
        
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .discont-price-block {
/*	font-size: <?php echo $paramssld['ht_catalog_view2_market_price_font_size']; ?>px;
        color: #<?php echo $paramssld['ht_catalog_view2_market_price_font_color']; ?>; */
}


#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block ul.thumbs-list_<?php echo $catalogID; ?> {
	list-style:none;
	display:table;
	position:relative;
	clear:both;
	width:100%;
	margin:0px auto;
	padding:0px;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block ul.thumbs-list_<?php echo $catalogID; ?> li {
	display:block;
	float:left;
	width:<?php echo $paramssld["ht_view2_thumbs_width"];?>px;
	height:<?php echo $paramssld["ht_view2_thumbs_height"];?>px;
	margin:0px 2% 5px 1% !important;
	opacity:0.45;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block ul.thumbs-list_<?php echo $catalogID; ?> li.active,#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block ul.thumbs-list_<?php echo $catalogID; ?> li:hover {
	opacity:1;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block ul.thumbs-list_<?php echo $catalogID; ?> li a {
	display:block;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block ul.thumbs-list_<?php echo $catalogID; ?> li img {
	margin:0px !important;
	padding:0px !important;
	width:<?php echo $paramssld["ht_view2_thumbs_width"];?>px !important;
	height:<?php echo $paramssld["ht_view2_thumbs_height"];?>px !important;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .price-block_<?php echo $catalogID; ?> p {
        font-size: <?php echo $paramssld['ht_catalog_view2_price_font_size']; ?>px;
        color: #<?php echo $paramssld['ht_catalog_view2_price_font_color']; ?>;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block .market-price-block_<?php echo $catalogID; ?> p {
        font-size: <?php echo $paramssld['ht_catalog_view2_market_price_font_size']; ?>px;
        color: #<?php echo $paramssld['ht_catalog_view2_market_price_font_color']; ?>;
}

.pupup-element .button-block {
	position:relative;
}

.pupup-element .button-block a,.pupup-element .button-block a:link,.pupup-element .button-block a:visited{
	position:relative;
	display:inline-block;
	padding:6px 12px;
	background:#<?php echo $paramssld["ht_view2_popup_linkbutton_background_color"];?>;
	color:#<?php echo $paramssld["ht_view2_popup_linkbutton_color"];?>;
	font-size:<?php echo $paramssld["ht_view2_popup_linkbutton_font_size"];?>;
	text-decoration:none;
}

.pupup-element .button-block a:hover,.pupup-element .button-block a:focus,.pupup-element .button-block a:active {
	background:#<?php echo $paramssld["ht_view2_popup_linkbutton_background_hover_color"];?>;
	color:#<?php echo $paramssld["ht_view2_popup_linkbutton_font_hover_color"];?>;
}


#huge-popup-overlay_<?php echo $catalogID; ?> {
	position:fixed;
	top:0px;
	left:0px;
	width:100%;
	height:100%;
	z-index:199;
	background: <?php
			list($r,$g,$b) = array_map('hexdec',str_split($paramssld['ht_view2_popup_overlay_color'],2));
				$titleopacity=$paramssld["ht_view2_popup_overlay_transparency_color"]/100;						
				echo 'rgba('.$r.','.$g.','.$b.','.$titleopacity.')  !important'; 		
	?>
}


@media only screen and (max-width: 767px) {
	
	#huge_it_catalog_popup_list_<?php echo $catalogID; ?> {
		position:absolute;
		left:0px;
		top:0px;
		width:100%;
		height:auto !important;
		left:0px;
	}
	
	#huge_it_catalog_popup_list_<?php echo $catalogID; ?> li.pupup-element {
		margin:0px;
		height:auto !important;
		position:absolute;
		left:0px;
		top:0px;
	}

	#huge_it_catalog_popup_list_<?php echo $catalogID; ?> li.pupup-element .popup-wrapper_<?php echo $catalogID; ?> {
		height:auto !important;
		overflow-y:auto;
	}


	#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .image-block_<?php echo $catalogID; ?> {
		width:100%;
		float:none;
		clear:both;
		margin-right:0px;
		border-right:0px;
	}

	#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .popup-wrapper_<?php echo $catalogID; ?> .right-block {
		width:100%;
		float:none;
		clear:both;
		margin-right:0px;
		border-right:0px;
	}

	#huge-popup-overlay_<?php echo $catalogID; ?> {
		position:fixed;
		top:0px;
		left:0px;
		width:100%;
		height:100%;
		z-index:199;
	}

}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> {
    <?php if ($paramssld["ht_view2_show_sorting"] == 'off')
    echo "display:none;";
    if($paramssld["ht_view2_filtering_float"] == 'left' && $paramssld["ht_view2_sorting_float"] == 'none') { if($catalogShowFiltering == "on") { echo "margin-left: 30%;"; } else { echo "margin-left: 0%;"; } }
    //else if($paramssld["ht_view2_filtering_float"] == 'right' && $paramssld["ht_view2_sorting_float"] == 'none' || ($sorting_block_width == '100%' && $filtering_block_width == "100%")) { echo "margin-left: 1%;"; } ?>
    overflow: hidden;
    /*margin-top: 5px;*/
    float: <?php echo $paramssld["ht_view2_sorting_float"]; ?>;
    width: <?php echo $sorting_block_width; ?>;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul {
  margin: 0px !important;
  padding: 0px !important;
  list-style: none;
<?php if($paramssld["ht_view2_sorting_float"] == 'top') {
      echo "float:left;margin-left:1%;";
      } ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> ul {
  margin: 0px !important;
  padding: 0px !important;
  overflow: hidden;
  <?php if($paramssld["ht_view2_filtering_float"] == 'top') {
      echo "float:left;margin-left:1%;";
      } ?>
}

<?php if($paramssld["ht_view2_sorting_float"] == 'none') { ?>
            #huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul {
                float: left;
            }
    <?php } ?>
            
            
#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li {
    border-radius: <?php echo $paramssld["ht_view2_sortbutton_border_radius"];?>px;
    list-style-type: none;
    margin: 0px !important;
    <?php
        if($sorting_block_width == "100%" ) {
            echo "float:left !important;margin: 4px 8px 4px 0px !important;";
        }
        if($left_to_top == "ok")
        { echo "float:left !important;"; }
        if($paramssld["ht_view2_sorting_float"] == "left" || $paramssld["ht_view2_sorting_float"] == "right")
        { echo 'border-bottom: 1px solid #ccc;'; }
        else
        { echo 'border: 1px solid #ccc;'; }
    ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li a {
    background-color: #<?php echo $paramssld["ht_view2_sortbutton_background_color"];?> !important;
    font-size:<?php echo $paramssld["ht_view2_sortbutton_font_size"];?>px !important;
    color:#<?php echo $paramssld["ht_view2_sortbutton_font_color"];?> !important;
    text-decoration: none;
    cursor: pointer;
    margin: 0px !important;
    display: block;
    padding:3px;
}

/*#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li:hover {
    
}*/

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li a:hover {
    background-color: #<?php echo $paramssld["ht_view2_sortbutton_hover_background_color"];?> !important;
    color:#<?php echo $paramssld["ht_view2_sortbutton_hover_font_color"];?> !important;
    cursor: pointer;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> {
    /*margin-top: 5px;*/
    float: <?php echo $paramssld["ht_view2_filtering_float"]; ?>;
    width: <?php echo $filtering_block_width; ?>;
    <?php
        if ($paramssld["ht_view2_show_filtering"] == 'off') echo "display:none;";
        if($paramssld["ht_view2_filtering_float"] == 'top' && ($paramssld["ht_view2_sorting_float"] == 'left') ) { if($catalogShowSorting == 'on') { echo "margin-left: 31%;"; } else echo "margin-left: 1%"; } 
        //if(($paramssld["ht_view2_filtering_float"] == 'none' && ($paramssld["ht_view2_sorting_float"] == 'right')) || ($sorting_block_width == '100%' && $filtering_block_width == "100%")) { echo "margin-left: 1%";}
    ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> ul li {
    list-style-type: none;
    <?php
        if($filtering_block_width == "100%") { echo "float:left !important;margin: 4px 8px 4px 0px !important;"; }
        if($left_to_top == "ok") { echo "float:left !important;"; }
        if($paramssld["ht_view2_filtering_float"] == "left" || $paramssld["ht_view2_filtering_float"] == "right")
        { echo 'border-bottom: 1px solid #ccc;'; }
        else echo "border: 1px solid #ccc;";
    ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> ul li a {
    font-size:<?php echo $paramssld["ht_view2_filterbutton_font_size"];?>px !important;
    color:#<?php echo $paramssld["ht_view2_filterbutton_font_color"];?> !important;
    background-color: #<?php echo $paramssld["ht_view2_filterbutton_background_color"];?> !important;
    border-radius: <?php echo $paramssld["ht_view2_filterbutton_border_radius"];?>px;
    padding: 3px;
    display: block;
    text-decoration: none;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?>  ul li a:hover {
    color:#<?php echo $paramssld["ht_view2_filterbutton_hover_font_color"];?> !important;
    background-color: #<?php echo $paramssld["ht_view2_filterbutton_hover_background_color"];?> !important;
    cursor: pointer
}

#huge_it_catalog_content_<?php echo $catalogID; ?> section {
    position:relative;
    display:block;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_container_<?php echo $catalogID; ?> {
<?php if($paramssld["ht_view2_sorting_float"] == "left" && $paramssld["ht_view2_filtering_float"] == "right" ||
         $paramssld["ht_view2_sorting_float"] == "right" && $paramssld["ht_view2_filtering_float"] == "left")
       { echo "margin: 0px auto;"; }
       if((($paramssld["ht_view2_filtering_float"] == "left" || $paramssld["ht_view2_filtering_float"] == "right" && $paramssld["ht_view2_sorting_float"] == "top") || ($paramssld["ht_view2_sorting_float"] == "left" || $paramssld["ht_view2_sorting_float"] == "right" && $paramssld["ht_view2_filting_float"] == "top")) && $catalogShowFiltering == "on" && $catalogShowSorting == "on")
       {
?>
        width: <?php echo $width_middle; ?> !important;
 <?php } ?>
}

.catalog_pagination_block_<?php echo $catalogID; ?>{
    /*text-align: <?php echo $paramssld["htc_view2_pagination_position"]; ?>;*/
    padding: 20px 0px;
    margin: 16px 0px 35px 0px;
}
.catalog_pagination_<?php echo $catalogID; ?>{
    text-align: <?php echo $paramssld["htc_view2_pagination_position"]; ?>;
    /*display: inline-block;*/
    /*height: 50px;*/
/*    border: 1px solid #dadada;
    border-radius: 6px;*/
}
.catalog_pagination_<?php echo $catalogID; ?> a, .catalog_pagination_<?php echo $catalogID; ?> span{
    color: #515151;
    font-size: 20px;
    text-decoration: none;
    text-align: center;
/*    width: 48px;
    height: 48px;*/
    /*display: inline-block;*/
    /*float: left;*/
    margin: 0;
    padding: 0;
}
.catalog_pagination_<?php echo $catalogID; ?> .pagination-text{
    /*float: left;*/
    color: #<?php echo $paramssld["htc_view2_pagination_font_color"]; ?>;
    font-size: <?php echo $paramssld["htc_view2_pagination_font_size"]; ?>px;
    /*font-weight: bold;*/
    padding: 12px 0px;
    text-decoration: none;
    text-align: center;
    /*display: inline-block;*/
/*    width: 180px;
    height: 48px;*/
    /*background-color: #fff;*/
}
@media only screen and (max-width:500px) {
	.catalog_pagination_<?php echo $catalogID; ?> .pagination-text{
            font-size: 16px !important;
            width: 120px !important;
	}
        .catalog_pagination_block_<?php echo $catalogID; ?>{
            text-align: left;
        }
}
.catalog_pagination_<?php echo $catalogID; ?> a{
    text-align: center;
    position: relative;
    margin-right: 5px;
    
}
.catalog_pagination_<?php echo $catalogID; ?> a i{
    font-size: <?php echo $paramssld["htc_view2_pagination_icon_size"]; ?>px;
    color: #<?php echo $paramssld["htc_view2_pagination_icon_color"]; ?>;
/*    position: absolute;
    top: -moz-calc(50% - 8px) !important;
    top: -webkit-calc(50% - 8px)  !important;
    top: calc(50% - 8px) !important;
    top: -o-calc(50% - 8px) !important;
    top: -ms-calc(50% - 8px) !important;
    
    left: -moz-calc(50% - 8px) !important;
    left: -webkit-calc(50% - 8px)  !important;
    left: calc(50% - 8px) !important;
    left: -o-calc(50% - 8px) !important;
    left: -ms-calc(50% - 8px) !important;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-first{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/first-active.png' , __FILE__ ); ?>') center center no-repeat;*/
/*    border-right: 1px solid #D0D0D0;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 10px;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-first-passive{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/first-passive.png' , __FILE__ ); ?>') center center no-repeat;*/
/*    border-right: 1px solid #D0D0D0;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;*/
}

.catalog_pagination_<?php echo $catalogID; ?> .go-to-previous{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/left-active.png' , __FILE__ ); ?>') center center no-repeat;*/
    /*border-right: 1px solid #D0D0D0;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-previous-passive{
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/left-passive.png' , __FILE__ ); ?>') center center no-repeat;*/
    /*border-right: 1px solid #D0D0D0;*/
}

.catalog_pagination_<?php echo $catalogID; ?> .go-to-last{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/last-active.png' , __FILE__ ); ?>') center center no-repeat;*/
/*    border-left: 1px solid #D0D0D0;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-last-passive{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/last-passive.png' , __FILE__ ); ?>') center center no-repeat;*/
/*    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    border-left: 1px solid #D0D0D0;*/
}

.catalog_pagination_<?php echo $catalogID; ?> .go-to-next{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/right-active.png' , __FILE__ ); ?>') center center no-repeat;*/
    /*border-left: 1px solid #D0D0D0;*/
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-next-passive{
    font-size: 10px !important;
    /*background-color: #F0F0F0 !important;*/
    /*background:url('<?php echo  plugins_url( '../images/right-passive.png' , __FILE__ ); ?>') center center no-repeat;*/
    /*border-left: 1px solid #D0D0D0;*/
}

.zoomContainer {
    z-index: 10;
}
.catalog_load_block_<?php echo $catalogID; ?>{
    margin: 35px 0px;
}
.catalog_load_<?php echo $catalogID; ?>{
    text-align: center;
}
.catalog_load_<?php echo $catalogID; ?> a{
    text-decoration: none;
    /*width: 100%;*/
    border-radius: 5px;
    display: inline-block;
    padding: 5px 15px;
    font-size: <?php echo $paramssld["htc_view2_load_more_font_size"]; ?>px !important;
    color: #<?php echo $paramssld["htc_view2_load_more_font_color"]; ?> !important;
    background: #<?php echo $paramssld["htc_view2_load_more_button_background_color"]; ?> !important;
    cursor: pointer;
}
.catalog_load_<?php echo $catalogID; ?> a:hover{
    color: #<?php echo $paramssld["htc_view2_load_more_font_hover_color"]; ?> !important;
    background: #<?php echo $paramssld["htc_view2_load_more_button_background_hover_color"]; ?> !important;
}
.catalog_load_<?php echo $catalogID; ?> a:focus{
    outline: none;
}
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .left-change, #huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .right-change{
    width: 40px;
    height: 39px;
    font-size: 25px;
    display: inline-block;
    text-align: center;
    border: 1px solid #eee;
    border-bottom: none;
    border-top: none;
}
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .right-change{
	margin-left: -6px;
}
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .right-change:hover, #huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .left-change:hover{
    background: #ddd;
    border-color: #ccc;
    color: #000 !important;
    cursor: pointer;
}
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .right-change a:hover, #huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .left-change a:hover{
    color: #000 !important;
}
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .right-change a:active, #huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .left-change a:active{
    outline:none;
    border:none;
}
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .right-change a:visited, #huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .left-change a:visited{
    color:#000 !important;
}

#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .right-change a, #huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> .left-change a{
    color: #777;
    text-decoration: none;
    width: 12px;
    height: 17px;
    display: inline-block;
}
#huge_it_catalog_popup_list_<?php echo $catalogID; ?> .heading-navigation_<?php echo $catalogID; ?> a{
    border:none;
    text-decoration: none;
}

/*<add search>*/
#search_block_<?php echo $catalogID; ?> {
	text-align: <?php echo $paramssld["ht_view2_search_form_position"]; ?>;	
	margin: 5px;
}
#search_block_<?php echo $catalogID; ?> > form {
	position: relative;
	height: 36px;
	display: inline-block;
	width: <?php echo $paramssld["ht_view2_search_form_width"]; ?>%;
	overflow: hidden;
	border-radius: <?php echo $paramssld["ht_view2_search_form_border_radius"]; ?>px;
	border: <?php echo $paramssld["ht_view2_search_form_border_width"]; ?>px solid #<?php echo $paramssld["ht_view2_search_form_border_color"]; ?>;	
}
#search_block_<?php echo $catalogID; ?> > form > input {
	width: 100%;
	height: 36px;		
	display: block;	
	position: absolute;
	padding:5px 10px;
	top: 0;
	left: 0;
	border: none;
	color: #272717;
	background: #FFFFFF;
       margin: 0;
} 
#search_block_<?php echo $catalogID; ?> > form > input + div {
	display: inline-block;
	color: #<?php echo $paramssld["ht_view2_search_button_background"]; ?>;
    position: absolute;
	display: none;
    cursor: pointer;
    height: calc(100% - 2px);
    top: 1px;
    width: 6%;
    right: 20%;
    text-align: center;
    font-size: 20px;
	background: #FFFFFF;	
}
#search_block_<?php echo $catalogID; ?> > form:hover > input + div {
	display: block;
}
#search_block_<?php echo $catalogID; ?> > form > input:blur + div {
	display: none;
}
#search_block_<?php echo $catalogID; ?> > form > #search_button_<?php echo $catalogID; ?> {
	width: 20%;
	height: 36px;		
	display: block;
	position: absolute;
	padding:0 10px 5px;
	top: 0;
	right: 0%;	
	border-top-right-radius: <?php echo $paramssld["ht_view2_search_form_border_radius"]; ?>px;
	border: 0;
	background: #<?php echo $paramssld["ht_view2_search_button_background"]; ?>;
	color: #<?php echo $paramssld["ht_view2_search_button_text_color"]; ?>;
    margin: 0;
} 

#search_block_<?php echo $catalogID; ?> > form > #search_button_<?php echo $catalogID; ?>:hover {
	background: #<?php echo $paramssld["ht_view2_search_button_hover_color"]; ?>;
} 
#search_not_results_<?php echo $catalogID; ?> {
	width: 100%;
	height: 40px;
	background: #F1F1F1;
	color: #A49999;
	border-radius: 5px;
	border: 2px solid #E1E3DF;
	text-align: center;
	display: none;	
}
#search_not_results_<?php echo $catalogID; ?> > span {
	padding: 0;
	margin: 0;	
	line-height: 36px;
	font-size: 14px;	
}
/*</add search>*/
</style>
    
<section id="huge_it_catalog_content_<?php echo $catalogID; ?>" class="product-catalog-content">
    <?php if($catalogShowSorting == "on")
        { ?>
          <div id="huge_it_catalog_options_<?php echo $catalogID; ?>" class="">
            <ul id="sort-by" class="option-set clearfix" data-option-key="sortBy">
                <li><a href="#sortBy=original-order" data-option-value="original-order" class="selected" data><?php echo $paramssld["ht_view2_sorting_name_by_default"]; ?></a></li>
                <li><a href="#sortBy=id" data-option-value="id"><?php echo $paramssld["ht_view2_sorting_name_by_id"]; ?></a></li>
                <li><a href="#sortBy=symbol" data-option-value="symbol"><?php echo $paramssld["ht_view2_sorting_name_by_name"]; ?></a></li>
                <li id="shuffle"><a href='#shuffle'><?php echo $paramssld["ht_view2_sorting_name_by_random"]; ?></a></li>
            </ul>
              
            <ul id="sort-direction" class="option-set clearfix" data-option-key="sortAscending">
                <li><a href="#sortAscending=true" data-option-value="true" class="selected"><?php echo $paramssld["ht_view2_sorting_name_by_asc"]; ?></a></li>
                <li><a href="#sortAscending=false" data-option-value="false"><?php echo $paramssld["ht_view2_sorting_name_by_desc"]; ?></a></li>
            </ul>
          </div>
  <?php }
   if($catalogShowFiltering == "on")
      { ?>
         <div id="huge_it_catalog_filters_<?php echo $catalogID; ?>">
            <ul>
                <li rel="*"><a>All</a></li>
                <?php
                $catalogCats = explode(",", $catalogCats);
                foreach ($catalogCats as $catalogCatsValue) {
                    if(!empty($catalogCatsValue))
                    {
                ?>
                <li rel=".<?php echo str_replace(" ","_",$catalogCatsValue); ?>"><a><?php echo str_replace("_"," ",$catalogCatsValue); ?></a></li>
                    <?php
                    }
                }
                ?>
            </ul>
        </div>
<?php }  if($catalogSearch == 'on') {?>
		<div id="search_block_<?php echo $catalogID; ?>">	
			<form>
				<input type="text"/><div><i class="hugeiticons hugeiticons-times"></i></div>
				<button id="search_button_<?php echo $catalogID; ?>" type="submit" ><i class="hugeiticons hugeiticons-search"></i>
				</button>
			</form>	
			<div id="search_not_results_<?php echo $catalogID; ?>"><span><?php echo $paramssld3['ht_catalog_general_no_search_result_text']; ?></span></div>
		</div>		
<?php } ?>	
    <div id="huge_it_catalog_container_<?php echo $catalogID; ?>" class="super-list variable-sizes clearfix" <?php //if($paramssld["ht_view2_sorting_float"] == "top" && $paramssld["ht_view2_filtering_float"] == "top") echo "style='clear: both;'";?> style="margin-top: 5px;">
              <?php

              foreach($images as $key=>$row)
              {
                      $link = $row->sl_url;
                      $descnohtml=strip_tags($row->description);
                      $result = substr($descnohtml, 0, 50);
//                      $catForFilter = explode(",", $row->category);
                      ?>
                      <div class="element_<?php echo $catalogID; ?> <?php if($paramssld['ht_view2_allow_lightbox'] == "on"){ echo "catalog_ccolorbox_grouping_".$catalogID;} ?> " tabindex="0"  data-element-id="<?php echo esc_attr($row->id); ?>"  data-symbol="<?php echo esc_attr($row->name); ?>" data-category="alkaline-earth">
                              <div class="image-block_<?php echo $catalogID; ?>">
                                      <?php $imgurl=explode(";",$row->image_url); ?>
                                              <?php 	if($row->image_url != ';'){ ?>
                                              <img id="wd-cl-img<?php echo $key; ?>" src="<?php echo esc_attr($imgurl[0]); ?>" alt="" />
                                              <?php } else { ?>
                                              <img id="wd-cl-img<?php echo $key; ?>" src="images/noimage.png" alt="" />
                                              <?php
                                              } ?>	
                                      <div class="image-overlay"><a href="#<?php echo $row->id; ?>"></a></div>
                              </div>
                              <div class="title-block_<?php echo $catalogID; ?>">
                                      <h3><?php echo $row->name; ?></h3>
                                      <?php if($paramssld["ht_view2_element_show_linkbutton"]=='on'){
                                          if($row->single_product_url_type == "default"){
                                             $page_link = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
                                             if (strpos(get_permalink(),'/?') !== false) { $product_page_link = get_permalink()."&single_prod_id=$row->id"; } else { if (strpos(get_permalink(),'/') !== false) { $product_page_link = get_permalink()."?single_prod_id=$row->id"; } else { $product_page_link = get_permalink()."/?single_prod_id=$row->id"; } }
                                         }
                                         else{ $product_page_link = $row->single_product_url_type; }
                                      ?>
                                              <div class="button-block"><a href="<?php echo esc_url($product_page_link); ?>" <?php if($row->link_target == 'on'){echo ' target="_blank"';} ?> ><?php echo $paramssld3["ht_catalog_general_linkbutton_text"]; ?></a></div>
                                      <?php } ?>
                              </div>
                      </div>	
                      <?php
              }?>
              <div style="clear:both;"></div>
        </div>
    
        <?php
            if($catalog[0]->pagination_type == "pagination"){
        ?>
        <div class="catalog_pagination_block_<?php echo $catalogID; ?>" >
            <div class="catalog_pagination_<?php echo $catalogID; ?>" >
                <?php
//                var_dump($_SERVER);
                
                    if (strpos($_SERVER['QUERY_STRING'], 'catalog_page_') !== false)
                {                                                                   //      IF WE HAVE $_GET PAGE
                    $oneMore = $page_index + 1;
                    $oneLess = $page_index - 1;
                    
                    if(isset($_GET["catalog_page_".$catalogID])){                   //      IF WE HAVE $_GET PAGE FOR THAT CATALOG
                        $prevPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$oneLess,$_SERVER['QUERY_STRING']);
                        $nextPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$oneMore,$_SERVER['QUERY_STRING']);
                        $firstPagePath = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=1",$_SERVER['QUERY_STRING']);
                        $lastPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$pages,$_SERVER['QUERY_STRING']);
//                        var_dump($nextPagePath);
                    }
                    else{                                                           //      IF WE HAVE $_GET PAGE FOR ANOTHER CATALOG
                        $prevPagePath  = "#";
                        $nextPagePath = $_SERVER['QUERY_STRING']."&catalog_page_".$catalogID."=2";
//                        $nextPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$oneMore,$_SERVER['QUERY_STRING']);
                        $firstPagePath = $_SERVER['QUERY_STRING']."&catalog_page_".$catalogID."=1";
                        $lastPagePath  = $_SERVER['QUERY_STRING']."&catalog_page_".$catalogID."=".$pages;
                    }
                }
                else{                                                               //      IF WE HAVE NOOOT $_GET PAGE
                    $oneMore = $page_index + 1;
                    $oneLess = $page_index - 1;
                    
                    $prevPagePath  = "#";
                    $nextPagePath  = "catalog_page_".$catalogID."=2";
                    $firstPagePath = "catalog_page_".$catalogID."=1";
                    $lastPagePath  = "catalog_page_".$catalogID."=".$pages;
                }
                

               
                    if (strpos(get_permalink(),'/?') !== false) { $pathSumbol = "&"; }
                    else {
                        if (strpos(get_permalink(),'/') !== false) { $pathSumbol = "?"; }
                        else { $pathSumbol = "/?"; }
                    }
                    // The "back" link
//                    $prevlink = ($page_index > 1) ? ''
//                            . '<a href="'.$pathSumbol.$firstPagePath. '" class="go-to-first"></a> <a href="'.$pathSumbol.$prevPagePath. '" class="go-to-previous"></a>' : '<span class="disabled go-to-first-passive"></span> <span class="disabled go-to-previous-passive"></span>';
//
//                    // The "forward" link
//                    $nextlink = ($page_index < $pages) ? ''
//                            . '<a href="'.$pathSumbol.$nextPagePath. '" class="go-to-next"></a> <a href="'.$pathSumbol.$lastPagePath. '" class="go-to-last"></a>' : '<span class="disabled go-to-next-passive"></span> <span class="disabled go-to-last-passive"></span>';
//                    echo $prevlink." <span class='pagination-text'>Page ".$page_index." / ".$pages."</span> ".$nextlink;
                
                    // The "back" link
                    $prevlink = ($page_index > 1) ? ''
                            . '<a href="'.$pathSumbol.$firstPagePath. '" class="go-to-first"><i class="icon-style4 hugeiticons-fast-backward" ></i></a>'
                            . '<a href="'.$pathSumbol.$prevPagePath. '" class="go-to-previous"><i class="icon-style4 hugeiticons-chevron-left"></i></a>' : '<span class="disabled go-to-first-passive"></span> <span class="disabled go-to-previous-passive"></span>';

                    // The "forward" link
                    $nextlink = ($page_index < $pages) ? ''
                            . '<a href="'.$pathSumbol.$nextPagePath. '" class="go-to-next"><i class="icon-style4 hugeiticons-chevron-right"></i></a>'
                            . '<a href="'.$pathSumbol.$lastPagePath. '" class="go-to-last"><i class="icon-style4 hugeiticons-fast-forward" ></i></a>' : 
                              '<span class="disabled go-to-next-passive"></span>'
                            . '<span class="disabled go-to-last-passive"></span>';
                    
                    echo $prevlink." <span class='pagination-text'>".$page_index." / ".$pages."</span> ".$nextlink;
                    
                ?>
            </div>
        </div>
        <?php
            }
            elseif($catalog[0]->pagination_type == "load_more"){ $path_site = plugins_url("/../images", __FILE__); ?>
                <div class="catalog_load_block_<?php echo $catalogID; ?>" >
                    <div class="catalog_load_<?php echo $catalogID; ?>" >
                        <a href="#" class="load_more_elements_<?php echo $catalogID; ?>"><?php echo __("Load","product-catalog");?></a>
                        <img src="<?php echo $path_site; ?>/load_more_icon_<?php echo $paramssld['htc_view2_load_more_loading_icon']; ?>.gif" class="load_more_loading_icon" style="display: none"/>
                        <input type="hidden" class="load-more-elements-count" value="<?php echo esc_attr($countIntoPage); ?>"/>
                    <?php
                        
                    ?>
                    </div>
                </div>
      <?php } ?>
    
</section>
<ul id="huge_it_catalog_popup_list_<?php echo $catalogID; ?>">
	<?php
        $changePopup=1;
	foreach($images as $key=>$row)
	{
		$imgurl=explode(";",$row->image_url);array_pop($imgurl);
		$link = $row->sl_url;
		$descnohtml=strip_tags($row->description);
		$result = substr($descnohtml, 0, 50);
		?>
		<li class="pupup-element" id="huge_it_catalog_pupup_element_<?php echo $row->id; ?>">
			<div class="heading-navigation_<?php echo $catalogID; ?>">
                            <div style="display: inline-block; float: left;">
                            <div class="left-change" ><a href="#<?php echo $changePopup - 1; ?>" data-popupid="#<?php echo $row->id; ?>"><</a></div>
                            <div class="right-change" ><a href="#<?php echo $changePopup + 1; ?>" data-popupid="#<?php echo $row->id; ?>">></a></div>
                        </div>
                            <?php $changePopup=$changePopup+1; ?>
				<a href="#close" class="close"></a>
				<div style="clear:both;"></div>
			</div>
			<div class="popup-wrapper_<?php echo $catalogID; ?>">
				<div class="image-block_<?php echo $catalogID; ?>">
					<?php 	if($row->image_url != ';'){ ?>
					<img id="wd-cl-img<?php echo $key; ?>" src="<?php echo esc_attr($imgurl[0]); ?>" alt="" />
					<?php } else { ?>
					<img id="wd-cl-img<?php echo $key; ?>" src="images/noimage.png" alt="" />
					<?php
					} ?>					
				</div>
				<div class="right-block">
					<?php if($paramssld["ht_view2_show_popup_title"]=='on'){?><h3 class="title"><?php echo $row->name; ?></h3><?php } ?>
					
					<?php if($paramssld["ht_view2_thumbs_position"]=='before' and $paramssld["ht_view2_show_thumbs"] == 'on'){?>
					<div>
                                            <ul class="thumbs-list_<?php echo $catalogID; ?>">
						<?php   
                                                    foreach($imgurl as $key=>$img){ ?>
                                                            <li><a href="<?php echo esc_attr($row->sl_url); ?>" class=""><img src="<?php echo esc_attr($img); ?>"></a></li>
                                              <?php } ?>
                                            </ul>
                                        </div>
					<?php } ?>
					
					<?php if($paramssld["ht_view2_show_description"]=='on'){?><div class="description"><?php echo $row->description; ?></div><?php } ?>
					
					<?php if($paramssld["ht_view2_thumbs_position"]=='after' and $paramssld["ht_view2_show_thumbs"] == 'on'){?>
					<div><ul class="thumbs-list_<?php echo $catalogID; ?>">
						<?php   $imgurl=explode(";",$row->image_url);array_pop($imgurl);
								foreach($imgurl as $key=>$img){?>
									<li><a href="#" class="group1"><img src="<?php echo esc_attr($img); ?>"></a></li>
								<?php } ?>
					</ul></div>
					<?php } ?>
                                        
                                         <?php if($paramssld["ht_catalog_view2_show_price"]=='on' && $row->price != ""){ ?>
                                                   <div class="price-block_<?php echo $catalogID; ?>">
                                                       <span class="old-price-block" ><?php echo $paramssld3['ht_single_product_price_text']; ?> : <span class="old-price" <?php if($row->market_price == "") { echo "style='text-decoration: none !important;'"; } ?>><?php echo $row->price; ?></span></span>
                                                       <span class="discont-price-block" ><span class="discont-price" ><?php echo $row->market_price; ?></span></span>
                                                   </div>
                                         <?php } ?>
                                        
                                       <?php if($paramssld["ht_view2_show_popup_linkbutton"]=='on'){
                                           if($row->single_product_url_type == "default"){
                                             $page_link = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
                                             if (strpos(get_permalink(),'/?') !== false) { $product_page_link = get_permalink()."&single_prod_id=$row->id"; } else { if (strpos(get_permalink(),'/') !== false) { $product_page_link = get_permalink()."?single_prod_id=$row->id"; } else { $product_page_link = get_permalink()."/?single_prod_id=$row->id"; } }
                                         }
                                         else{ $product_page_link = $row->single_product_url_type; }
                                         ?>
						<div class="button-block">
						<a href="<?php echo esc_url($product_page_link); ?>"  <?php if($row->link_target == 'on'){echo ' target="_blank"';} ?>><?php echo $paramssld3["ht_catalog_general_linkbutton_text"]; ?></a>
						</div>
					<?php } ?>
					<div style="clear:both;"></div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</li>
		<?php
	}?>
</ul>
	  
  <?php	  
	break;
	////////////////////////////// VIEW 3 FullWidth ////////////////////////////////////////////// 
	case 3:
  ?>

<?php
//    if($paramssld["ht_view3_sorting_float"] == "left" && $paramssld["ht_view3_filtering_float"] == "right" ||
//       $paramssld["ht_view3_sorting_float"] == "right" && $paramssld["ht_view3_filtering_float"] == "left" ||
//       $paramssld["ht_view3_sorting_float"] == $paramssld["ht_view3_filtering_float"])
//       { $sorting_block_width ="20%"; $filtering_block_width ="20%"; $middle_with = "56%"; }
//    else if($paramssld["ht_view3_sorting_float"] == "left" || $paramssld["ht_view3_sorting_float"] == "right" && $paramssld["ht_view3_filtering_float"] == "top")
//       { $sorting_block_width ="30%"; $filtering_block_width ="100%"; $paramssld["ht_view3_filtering_float"] = "none"; $width_middle = "65%"; }
//    else if($paramssld["ht_view3_filtering_float"] == "left" || $paramssld["ht_view3_filtering_float"] == "right" && $paramssld["ht_view3_sorting_float"] == "top")
//       { $sorting_block_width ="100%"; $filtering_block_width ="30%"; $paramssld["ht_view3_sorting_float"] = "none"; $width_middle = "65%"; }
//    if($paramssld["ht_view3_sorting_float"] == "top" && $paramssld["ht_view3_filtering_float"] == "top")
//       { $sorting_block_width ="100%"; $filtering_block_width ="100%"; $left_to_top = "ok"; }

if($catalog[0]->pagination_type == "show_all"){
    $myAllImages = count($images);
    $countIntoPage = $catalog[0]->count_into_page;
    if($countIntoPage == "" || $countIntoPage < 1){ $countIntoPage = 1; }
    $pages = ceil($myAllImages / $countIntoPage);
    if(isset($_GET["catalog_page_".$catalogID])){ $page_index = absint($_GET["catalog_page_".$catalogID]); }
    else{ $page_index = 1; }
    $maxCount = $page_index * $countIntoPage;
    $morePaste = $maxCount - $myAllImages;
}
else{
    if(isset($_GET["catalog_page_".$catalogID])){
            $myAllImages = count($images);
            if($myAllImages < $catalog[0]->count_into_page)            //update pagination bug
                $countIntoPage = $myAllImages;
            else
                $countIntoPage = $catalog[0]->count_into_page;
            if($countIntoPage == "" || $countIntoPage < 1){ $countIntoPage = 1; }
            $pages = ceil($myAllImages / $countIntoPage);
            $page_index = absint($_GET["catalog_page_".$catalogID]);
            $maxCount = $page_index * $countIntoPage;
            $morePaste = $maxCount - $myAllImages;
            
//            var_dump($page_index." ".$countIntoPage." ".$maxCount." ".$morePaste." ".$myAllImages." ".$pages);
                $imagesUsefulElements = array();
            if($page_index <= 1 || ($maxCount > $myAllImages) && $morePaste > $countIntoPage){
                for($usefulKeys = 0; $usefulKeys < $countIntoPage; $usefulKeys++){
                    $imagesUsefulElements[] = $images[$usefulKeys];
                }
                $images = $imagesUsefulElements;
            }
            elseif (($maxCount <= $myAllImages) || ($maxCount > $myAllImages && $morePaste <= $countIntoPage)){
                $show_from = $page_index * $countIntoPage - $countIntoPage;
                $show_until = $page_index * $countIntoPage - 1;
                $usefulElementsKey = 0;
                
//                var_dump("from ".$show_from." ".$show_until);
                foreach($images as $galleryElements){
                    if($usefulElementsKey >= $show_from && $usefulElementsKey <= $show_until){
                        $imagesUsefulElements[] = $galleryElements;
                    }
                    $usefulElementsKey++;
                }
                $images = $imagesUsefulElements;
            }
    }
    else{
        $myAllImages = count($images);
        $page_index = 1;
        if($myAllImages < $catalog[0]->count_into_page)            //update pagination bug
                $countIntoPage = $myAllImages;
            else
                $countIntoPage = $catalog[0]->count_into_page;
        if($countIntoPage == "" || $countIntoPage < 1){ $countIntoPage = 1; }
        $pages = ceil($myAllImages / $countIntoPage);
        $imagesUsefulElements = array();
        for($usefulKeys = 0; $usefulKeys < $countIntoPage; $usefulKeys++){
            $imagesUsefulElements[] = $images[$usefulKeys];
//                    var_dump($usefulKeys);
        }
        $images = $imagesUsefulElements;
    }
}

?>

<style type="text/css">
<?php // if($paramssld["ht_catalog_zoom_lens_size_fix"] == "true") { ?>

/*.zoomLens {
    width: <?php echo $paramssld["ht_catalog_zoom_lens_width"]; ?>px !important;
    height: <?php echo $paramssld["ht_catalog_zoom_lens_height"]; ?>px !important;*/
/*}*/
<?php // } ?>

.element_<?php echo $catalogID; ?> {
	position: relative;
	width:93%; 
	margin:5px 0px 5px 0px;
	padding:2%;
	clear:both;
	overflow: hidden;
	border:<?php echo $paramssld['ht_view3_element_border_width']; ?>px solid #<?php echo $paramssld['ht_view3_element_border_color']; ?>;
	background:#<?php echo $paramssld['ht_view3_element_background_color']; ?>;
}

.element_<?php echo $catalogID; ?> > div {
	display:table-cell;
}

.element_<?php echo $catalogID; ?> div.left-block_<?php echo $catalogID; ?> {
	padding-right:10px;
}

.element_<?php echo $catalogID; ?> div.left-block_<?php echo $catalogID; ?> .main-image-block_<?php echo $catalogID; ?> {
	clear:both;
	width:<?php echo $paramssld['ht_view3_mainimage_width']; ?>px; 
}

.element_<?php echo $catalogID; ?> div.left-block_<?php echo $catalogID; ?> .main-image-block_<?php echo $catalogID; ?> img {
	margin:0px !important;
	padding:0px !important;
	width:<?php echo $paramssld['ht_view3_mainimage_width']; ?>px !important; 
	height:auto;
}

.element_<?php echo $catalogID; ?> div.left-block_<?php echo $catalogID; ?> .thumbs-block {
	position:relative;
	margin-top:10px;
}

.element_<?php echo $catalogID; ?> div.left-block_<?php echo $catalogID; ?> .thumbs-block ul {
	width:<?php echo $paramssld['ht_view3_mainimage_width']; ?>px; 
	height:auto;
	display:table;
	margin:0px;
	padding:0px;
	list-style:none;
}

.element_<?php echo $catalogID; ?> div.left-block_<?php echo $catalogID; ?> .thumbs-block ul li {
	margin:0px 3px 5px 2px;
	padding:0px;
	width:<?php echo $paramssld['ht_view3_thumbs_width']; ?>px; 
	height:<?php echo $paramssld['ht_view3_thumbs_height']; ?>px; 
	float:left;
}

.element_<?php echo $catalogID; ?> div.left-block_<?php echo $catalogID; ?> .thumbs-block ul li a {
	display:block;
	width:<?php echo $paramssld['ht_view3_thumbs_width']; ?>px; 
	height:<?php echo $paramssld['ht_view3_thumbs_height']; ?>px; 
}

.element_<?php echo $catalogID; ?> div.left-block_<?php echo $catalogID; ?> .thumbs-block ul li a img {
	margin:0px !important;
	padding:0px !important;
	width:<?php echo $paramssld['ht_view3_thumbs_width']; ?>px; 
	height:<?php echo $paramssld['ht_view3_thumbs_height']; ?>px; 
}

.element_<?php echo $catalogID; ?> div.right-block {
	vertical-align:top;
}

.element_<?php echo $catalogID; ?> div.right-block > div {
	width:100%;
	padding-bottom:10px;
	margin-top:10px;
	<?php if($paramssld['ht_view3_show_separator_lines']=="on") {?>
		background:url('<?php echo  plugins_url( '../images/divider.line.png' , __FILE__ ); ?>') center bottom repeat-x;
	<?php } ?>	
}

.element_<?php echo $catalogID; ?> div.right-block > div:last-child {
	background:none;
}

.element_<?php echo $catalogID; ?> div.right-block .title-block_<?php echo $catalogID; ?>  {
	margin-top:3px;
}

.element_<?php echo $catalogID; ?> div.right-block .title-block_<?php echo $catalogID; ?> h3 {
	margin:0px;
	padding:0px;
	font-weight:normal;
	font-size:<?php echo $paramssld['ht_view3_title_font_size']; ?>px !important;
	line-height:<?php echo $paramssld['ht_view3_title_font_size']+4; ?>px !important;
	color:#<?php echo $paramssld['ht_view3_title_font_color']; ?>;
}

.element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> p,.element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> {
	margin:0px;
	padding:0px;
	font-weight:normal;
	font-size:<?php echo $paramssld['ht_view3_description_font_size']; ?>px;
	color:#<?php echo $paramssld['ht_view3_description_color']; ?>;
}


.element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> h1,
.element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> h2,
.element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> h3,
.element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> h4,
.element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> h5,
.element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> h6,
.element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> p, 
.element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> strong,
.element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> span {
	padding:2px !important;
	margin:0px !important;
}

.element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> ul,
.element_<?php echo $catalogID; ?> div.right-block .description-block_<?php echo $catalogID; ?> li {
	padding:2px 0px 2px 5px;
	margin:0px 0px 0px 8px;
}

.element_<?php echo $catalogID; ?> div.right-block .price-block_<?php echo $catalogID; ?> {
    color: #<?php echo $paramssld['ht_catalog_view3_price_font_color']; ?>;
}

.element_<?php echo $catalogID; ?> div.right-block .old-price {
	text-decoration: line-through;
        margin: 0px;
        padding: 0px;
        font-weight: normal;
        font-size: <?php echo $paramssld['ht_catalog_view3_price_font_size']; ?>px;
        padding: 7px 10px 7px 10px;
        margin: 0px 10px 0px 0px;
        border-radius: 5px;
        color: #<?php echo $paramssld['ht_view3_element_background_color']; ?>;
        background: #<?php echo $paramssld['ht_catalog_view3_price_font_color']; ?>;
}

.element_<?php echo $catalogID; ?> div.right-block .old-price-block {

}

.element_<?php echo $catalogID; ?> div.right-block .discont-price-block {

}

.element_<?php echo $catalogID; ?> .button-block {
	position:relative;
}

.element_<?php echo $catalogID; ?> div.right-block .button-block a,.element_<?php echo $catalogID; ?> div.right-block .button-block a:link,.element_<?php echo $catalogID; ?> div.right-block .button-block a:visited {
	position:relative;
	display:inline-block;
	padding:6px 12px;
	background:#<?php echo $paramssld["ht_view3_linkbutton_background_color"];?>;
	color:#<?php echo $paramssld["ht_view3_linkbutton_color"];?>;
	font-size:<?php echo $paramssld["ht_view3_linkbutton_font_size"];?>;
	text-decoration:none;
}

.element_<?php echo $catalogID; ?> div.right-block .button-block a:hover,.pupup-elemen.element div.right-block .button-block a:focus,.element_<?php echo $catalogID; ?> div.right-block .button-block a:active {
	background:#<?php echo $paramssld["ht_view3_linkbutton_background_hover_color"];?>;
	color:#<?php echo $paramssld["ht_view3_linkbutton_font_hover_color"];?>;
}



@media only screen and (max-width: 767px) {
	
	.element_<?php echo $catalogID; ?> > div {
		display:block;
		width:100%;
		clear:both;
	}

	.element_<?php echo $catalogID; ?> div.left-block_<?php echo $catalogID; ?> {
		padding-right:0px;
	}

	.element_<?php echo $catalogID; ?> div.left-block_<?php echo $catalogID; ?> .main-image-block_<?php echo $catalogID; ?> {
		clear:both;
		width:100%; 
	}

	.element_<?php echo $catalogID; ?> div.left-block_<?php echo $catalogID; ?> .thumbs-block ul {
		width:100%; 
	}
}

@media only screen and (max-width: 600px) {
       .element_<?php echo $catalogID; ?> div.left-block_<?php echo $catalogID; ?> .main-image-block_<?php echo $catalogID; ?> img {
              margin: 0px !important;
              padding: 0px !important;
              width: 100% !important;
              height: auto;
       }
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> {
    <?php if ($paramssld["ht_view3_show_sorting"] == 'off')
    echo "display:none;";
    if($paramssld["ht_view3_filtering_float"] == 'left' && $paramssld["ht_view3_sorting_float"] == 'none') { if($catalogShowFiltering == "on") { echo "margin-left: 30%;"; } else echo "margin-left: 0%;"; }
//    else if($paramssld["ht_view3_filtering_float"] == 'right' && $paramssld["ht_view3_sorting_float"] == 'none' || ($sorting_block_width == '100%' && $filtering_block_width == "100%")) { echo "margin-left: 1%;"; } ?>
    overflow: hidden;
    margin-top: 5px;
    float: <?php echo $paramssld["ht_view3_sorting_float"]; ?>;
    width: <?php echo $sorting_block_width; ?>;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul {
  margin: 0px !important;
  padding: 0px !important;
  list-style: none;
<?php if($paramssld["ht_view3_sorting_float"] == 'top') {
      echo "float:left;margin-left:1%;";
      } ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> ul {
  margin: 0px !important;
  padding: 0px !important;
  overflow: hidden;
  <?php if($paramssld["ht_view3_filtering_float"] == 'top') {
      echo "float:left;margin-left:1%;";
      } ?>
}

<?php if($paramssld["ht_view3_sorting_float"] == 'none') { ?>
            #huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul {
                float: left;
            }
    <?php } ?>

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li {
    border-radius: <?php echo $paramssld["ht_view3_sortbutton_border_radius"];?>px;
    list-style-type: none;
    margin: 0px !important;
    <?php
        if($sorting_block_width == "100%" ) {
            echo "float:left !important;margin: 4px 8px 4px 0px !important;";
        }
        if($left_to_top == "ok")
        { echo "float:left !important;"; }
        if($paramssld["ht_view3_sorting_float"] == "left" || $paramssld["ht_view3_sorting_float"] == "right")
        { echo 'border-bottom: 1px solid #ccc;'; }
        else
        { echo 'border: 1px solid #ccc;'; }
    ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li a {
    background-color: #<?php echo $paramssld["ht_view3_sortbutton_background_color"];?> !important;
    font-size:<?php echo $paramssld["ht_view3_sortbutton_font_size"];?>px !important;
    color:#<?php echo $paramssld["ht_view3_sortbutton_font_color"];?> !important;
    text-decoration: none;
    cursor: pointer;
    margin: 0px !important;
    display: block;
    padding:3px;
}

/*#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li:hover {
    
}*/

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_options_<?php echo $catalogID; ?> ul li a:hover {
    background-color: #<?php echo $paramssld["ht_view3_sortbutton_hover_background_color"];?> !important;
    color:#<?php echo $paramssld["ht_view3_sortbutton_hover_font_color"];?> !important;
    cursor: pointer;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> {
    margin-top: 5px;
    float: <?php echo $paramssld["ht_view3_filtering_float"]; ?>;
   width: <?php echo $filtering_block_width; ?>;
    <?php
        if ($paramssld["ht_view3_show_filtering"] == 'off') echo "display:none;";
        if($paramssld["ht_view3_filtering_float"] == 'none' && ($paramssld["ht_view3_sorting_float"] == 'left') ) { if($catalogShowSorting == 'on') { echo "margin-left: 31%;"; } else echo "margin-left: 1%"; } 
//        if(($paramssld["ht_view3_filtering_float"] == 'none' && ($paramssld["ht_view3_sorting_float"] == 'right')) || ($sorting_block_width == '100%' && $filtering_block_width == "100%")) { echo "margin-left: 1%";}
    ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> ul li {
    list-style-type: none;
    <?php
        if($filtering_block_width == "100%") { echo "float:left !important;margin: 4px 8px 4px 0px !important;"; }
        if($left_to_top == "ok") { echo "float:left !important;"; }
        if($paramssld["ht_view3_filtering_float"] == "left" || $paramssld["ht_view3_filtering_float"] == "right")
        { echo 'border-bottom: 1px solid #ccc;'; }
        else echo "border: 1px solid #ccc;";
    ?>
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?> ul li a {
    font-size:<?php echo $paramssld["ht_view3_filterbutton_font_size"];?>px !important;
    color:#<?php echo $paramssld["ht_view3_filterbutton_font_color"];?> !important;
    background-color: #<?php echo $paramssld["ht_view3_filterbutton_background_color"];?> !important;
    border-radius: <?php echo $paramssld["ht_view3_filterbutton_border_radius"];?>px;
    padding: 3px;
    display: block;
    text-decoration: none;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_filters_<?php echo $catalogID; ?>  ul li a:hover {
    color:#<?php echo $paramssld["ht_view3_filterbutton_hover_font_color"];?> !important;
    background-color: #<?php echo $paramssld["ht_view3_filterbutton_hover_background_color"];?> !important;
    cursor: pointer;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> section {
    position:relative;
    display:block;
}

#huge_it_catalog_content_<?php echo $catalogID; ?> #huge_it_catalog_container_<?php echo $catalogID; ?> {

    <?php
        if($paramssld["ht_view3_sorting_float"] == "left" && $paramssld["ht_view3_filtering_float"] == "right" ||
           $paramssld["ht_view3_sorting_float"] == "right" && $paramssld["ht_view3_filtering_float"] == "left")
        { ?>
            margin-left: 21%;
            <?php } 
            if((($paramssld["ht_view3_filtering_float"] == "left" || $paramssld["ht_view3_filtering_float"] == "right" && $paramssld["ht_view3_sorting_float"] == "top") || ($paramssld["ht_view3_sorting_float"] == "left" || $paramssld["ht_view3_sorting_float"] == "right" && $paramssld["ht_view3_filting_float"] == "top")) && $catalogShowFiltering == "on" && $catalogShowSorting == "on")
                 { ?>
                  width: <?php echo $width_middle; ?> !important;
           <?php } ?>
}

.catalog_pagination_block_<?php echo $catalogID; ?>{
    /*text-align: <?php echo $paramssld["htc_view3_pagination_position"]; ?>;*/
    padding: 20px 0px;
    margin: 16px 0px 35px 0px;
}
.catalog_pagination_<?php echo $catalogID; ?>{
    text-align: <?php echo $paramssld["htc_view3_pagination_position"]; ?>;
    /*display: inline-block;*/
    /*height: 50px;*/
/*    border: 1px solid #dadada;
    border-radius: 6px;*/
}
.catalog_pagination_<?php echo $catalogID; ?> a, .catalog_pagination_<?php echo $catalogID; ?> span{
    color: #515151;
    font-size: 20px;
    text-decoration: none;
    text-align: center;
/*    width: 48px;
    height: 48px;*/
    /*display: inline-block;*/
    /*float: left;*/
    margin: 0;
    padding: 0;
}
.catalog_pagination_<?php echo $catalogID; ?> .pagination-text{
    /*float: left;*/
    color: #<?php echo $paramssld["htc_view3_pagination_font_color"]; ?>;
    font-size: <?php echo $paramssld["htc_view3_pagination_font_size"]; ?>px;
    /*font-weight: bold;*/
    padding: 12px 0px;
    text-decoration: none;
    text-align: center;
    /*display: inline-block;*/
/*    width: 180px;
    height: 48px;*/
    /*background-color: #fff;*/
}
@media only screen and (max-width:500px) {
	.catalog_pagination_<?php echo $catalogID; ?> .pagination-text{
            font-size: 16px !important;
            width: 120px !important;
	}
        .catalog_pagination_block_<?php echo $catalogID; ?>{
            text-align: left;
        }
}
.catalog_pagination_<?php echo $catalogID; ?> a{
    text-align: center;
    position: relative;
    margin-right: 5px;
    
}
.catalog_pagination_<?php echo $catalogID; ?> a i{
    font-size: <?php echo $paramssld["htc_view3_pagination_icon_size"]; ?>px;
    color: #<?php echo $paramssld["htc_view3_pagination_icon_color"]; ?>;
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-first{
    font-size: 10px !important;
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-first-passive{
    font-size: 10px !important;
}

.catalog_pagination_<?php echo $catalogID; ?> .go-to-previous{
    font-size: 10px !important;
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-previous-passive{
}

.catalog_pagination_<?php echo $catalogID; ?> .go-to-last{
    font-size: 10px !important;
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-last-passive{
    font-size: 10px !important;
}

.catalog_pagination_<?php echo $catalogID; ?> .go-to-next{
    font-size: 10px !important;
}
.catalog_pagination_<?php echo $catalogID; ?> .go-to-next-passive{
    font-size: 10px !important;
}

.zoomContainer {
    z-index: 10;
}
.catalog_load_block_<?php echo $catalogID; ?>{
    margin: 35px 0px;
}
.catalog_load_<?php echo $catalogID; ?>{
    text-align: center;
}
.catalog_load_<?php echo $catalogID; ?> a{
    text-decoration: none;
    /*width: 100%;*/
    border-radius: 5px;
    display: inline-block;
    padding: 5px 15px;
    font-size: <?php echo $paramssld["htc_view3_load_more_font_size"]; ?>px !important;
    color: #<?php echo $paramssld["htc_view3_load_more_font_color"]; ?> !important;
    background: #<?php echo $paramssld["htc_view3_load_more_button_background_color"]; ?> !important;
    cursor: pointer;
}
.catalog_load_<?php echo $catalogID; ?> a:hover{
    color: #<?php echo $paramssld["htc_view3_load_more_font_hover_color"]; ?> !important;
    background: #<?php echo $paramssld["htc_view3_load_more_button_background_hover_color"]; ?> !important;
}
.catalog_load_<?php echo $catalogID; ?> a:focus{
    outline: none;
}
/*<add search>*/
#search_block_<?php echo $catalogID; ?> {
	text-align: <?php echo $paramssld["ht_view3_search_form_position"]; ?>;	
	margin: 5px;
}
#search_block_<?php echo $catalogID; ?> > form {
	position: relative;
	height: 36px;
	display: inline-block;
	width: <?php echo $paramssld["ht_view3_search_form_width"]; ?>%;
	overflow: hidden;
	border-radius: <?php echo $paramssld["ht_view3_search_form_border_radius"]; ?>px;
	border: <?php echo $paramssld["ht_view3_search_form_border_width"]; ?>px solid #<?php echo $paramssld["ht_view3_search_form_border_color"]; ?>;	
}
#search_block_<?php echo $catalogID; ?> > form > input {
	width: 100%;
	height: 36px;		
	display: block;	
	position: absolute;
	padding:5px 10px;
	top: 0;
	left: 0;
	border: none;
	color: #272717;
	background: #FFFFFF;
       margin: 0;
} 
#search_block_<?php echo $catalogID; ?> > form > input + div {
	display: inline-block;
	color: #<?php echo $paramssld["ht_view3_search_button_background"]; ?>;
    position: absolute;
	display: none;
    cursor: pointer;
    height: calc(100% - 2px);
    top: 1px;
    width: 6%;
    right: 20%;
    text-align: center;
    font-size: 20px;
	background: #FFFFFF;	
}
#search_block_<?php echo $catalogID; ?> > form:hover > input + div {
	display: block;
}
#search_block_<?php echo $catalogID; ?> > form > input:blur + div {
	display: none;
}
#search_block_<?php echo $catalogID; ?> > form > #search_button_<?php echo $catalogID; ?> {
	width: 20%;
	height: 36px;		
	display: block;
	position: absolute;
	padding:0 10px 5px;
	top: 0;
	right: 0%;	
	border-top-right-radius: <?php echo $paramssld["ht_view3_search_form_border_radius"]; ?>px;
	border: 0;
	background: #<?php echo $paramssld["ht_view3_search_button_background"]; ?>;
	color: #<?php echo $paramssld["ht_view3_search_button_text_color"]; ?>;
    margin: 0;
} 

#search_block_<?php echo $catalogID; ?> > form > #search_button_<?php echo $catalogID; ?>:hover {
	background: #<?php echo $paramssld["ht_view3_search_button_hover_color"]; ?>;
} 
#search_not_results_<?php echo $catalogID; ?> {
	width: 100%;
	height: 40px;
	background: #F1F1F1;
	color: #A49999;
	border-radius: 5px;
	border: 2px solid #E1E3DF;
	text-align: center;
	display: none;	
}
#search_not_results_<?php echo $catalogID; ?> > span {
	padding: 0;
	margin: 0;	
	line-height: 36px;
	font-size: 14px;	
}
/*</add search>*/
</style>
      
<section id="huge_it_catalog_content_<?php echo $catalogID; ?>" class="product-catalog-content">
    <?php if($catalogShowSorting == "on")
        { ?>
          <div id="huge_it_catalog_options_<?php echo $catalogID; ?>" class="">
            <ul id="sort-by" class="option-set clearfix" data-option-key="sortBy">
                <li><a href="#sortBy=original-order" data-option-value="original-order" class="selected" data><?php echo $paramssld["ht_view3_sorting_name_by_default"]; ?></a></li>
                <li><a href="#sortBy=id" data-option-value="id"><?php echo $paramssld["ht_view3_sorting_name_by_id"]; ?></a></li>
                <li><a href="#sortBy=symbol" data-option-value="symbol"><?php echo $paramssld["ht_view3_sorting_name_by_name"]; ?></a></li>
                <li id="shuffle"><a href='#shuffle'><?php echo $paramssld["ht_view3_sorting_name_by_random"]; ?></a></li>
            </ul>
              
            <ul id="sort-direction" class="option-set clearfix" data-option-key="sortAscending">
                <li><a href="#sortAscending=true" data-option-value="true" class="selected"><?php echo $paramssld["ht_view3_sorting_name_by_asc"]; ?></a></li>
                <li><a href="#sortAscending=false" data-option-value="false"><?php echo $paramssld["ht_view3_sorting_name_by_desc"]; ?></a></li>
            </ul>
          </div>
  <?php }
   if($catalogShowFiltering == "on")
      { ?>
         <div id="huge_it_catalog_filters_<?php echo $catalogID; ?>">
            <ul>
                <li rel="*"><a>All</a></li>
                <?php
                $catalogCats = explode(",", $catalogCats);
                foreach ($catalogCats as $catalogCatsValue) {
                    if(!empty($catalogCatsValue))
                    {
                ?>
                <li rel=".<?php echo str_replace(" ","_",$catalogCatsValue); ?>"><a><?php echo str_replace("_"," ",$catalogCatsValue); ?></a></li>
                    <?php
                    }
                }
                ?>
            </ul>
        </div>
<?php }  if($catalogSearch == 'on') {?>
		<div id="search_block_<?php echo $catalogID; ?>">	
			<form>
				<input type="text"/><div><i class="hugeiticons hugeiticons-times"></i></div>
				<button id="search_button_<?php echo $catalogID; ?>" type="submit" ><i class="hugeiticons hugeiticons-search"></i>
				</button>
			</form>	
			<div id="search_not_results_<?php echo $catalogID; ?>"><span><?php echo $paramssld3['ht_catalog_general_no_search_result_text']; ?></span></div>
		</div>		
<?php } ?>		
        <div id="huge_it_catalog_container_<?php echo $catalogID; ?>" class="super-list variable-sizes clearfix" <?php // if($paramssld["ht_view3_sorting_float"] == "top" && $paramssld["ht_view3_filtering_float"] == "top") echo "style='clear: both;'";?>>
              <?php
              $group_key = 0;
              foreach($images as $key=>$row)
              {
                      $group_key++;
                      $link = $row->sl_url;
                      ?>
                      <div class="element_<?php echo $catalogID; ?> <?php if($paramssld['ht_view3_allow_lightbox'] == "on"){ echo "catalog_ccolorbox_grouping_".$catalogID;} ?> " data-element-id="<?php echo $row->id; ?>" data-symbol="<?php echo esc_attr($row->name); ?>" data-category="alkaline-earth">
                              <div class="left-block_<?php echo $catalogID; ?>">
                                      <div class="main-image-block_<?php echo $catalogID; ?> main-image-block for_zoom">
                                           <?php
                                               $imgurl=explode(";",$row->image_url);
                                               if($row->image_url != ';'){
                                                   if($paramssld['ht_view3_allow_zooming'] == "off" && $paramssld['ht_view3_allow_lightbox'] == "on"){ ?>
                                                      <a href="<?php echo esc_attr($imgurl[0]); ?>" class="catalog_group<?php echo $group_key."_".$catalogID; ?>" >
                                                          <img id="wd-cl-img<?php echo $key; ?>" src="<?php echo esc_attr($imgurl[0]); ?>" />
                                                      </a>
                                           <?php   }else{ ?>
                                                          <a href="<?php echo esc_attr($imgurl[0]); ?>" class="catalog_group<?php echo $group_key."_".$catalogID; ?>"  <?php if($paramssld['ht_view3_allow_lightbox'] == "off"){ echo "onclick='return false;'"; } ?>>
                                                              <img id="wd-cl-img<?php echo $key; ?>" src="<?php echo esc_attr($imgurl[0]); ?>" />
                                                          </a>
                                         <?php     } ?>
                                         <?php } else{ ?>
                                                      <a href="<?php echo esc_attr($imgurl[0]); ?>"><img id="wd-cl-img<?php echo $key; ?>" src="images/noimage.png"></a>
                                          <?php } ?>
                                      </div>
                                     <div class="main-image-block_<?php echo $catalogID; ?> main-image-block not_for_zoom">
                                            <?php
                                            $imgurl=explode(";",$row->image_url);
                                            if($row->image_url != ';'){
                                                   if($paramssld['ht_view3_allow_zooming'] == "off" && $paramssld['ht_view3_allow_lightbox'] == "on"){ ?>
                                                          <a href="<?php echo esc_attr($imgurl[0]); ?>" class="not_for_zoom_class catalog_group_not_for_zoom<?php echo $group_key."_".$catalogID; ?>" >
                                                                 <img id="wd-cl-img<?php echo $key; ?>" src="<?php echo esc_attr($imgurl[0]); ?>" />
                                                          </a>
                                                   <?php   }else{ ?>
                                                          <a href="<?php echo esc_attr($imgurl[0]); ?>" class="not_for_zoom_class catalog_group_not_for_zoom<?php echo $group_key."_".$catalogID; ?>"  <?php if($paramssld['ht_view3_allow_lightbox'] == "off"){ echo "onclick='return false;'"; } ?>>
                                                                 <img id="wd-cl-img<?php echo $key; ?>" src="<?php echo esc_attr($imgurl[0]); ?>" />
                                                          </a>
                                                   <?php     } ?>
                                            <?php } else{ ?>
                                                   <a href="<?php echo esc_attr($imgurl[0]); ?>"><img id="wd-cl-img<?php echo $key; ?>" src="images/noimage.png"></a>
                                            <?php } ?>
                                     </div>
                                      <div class="thumbs-block">
                                          <?php
                                          if($paramssld["ht_view3_show_thumbs"] == 'on')
                                              {
                                          ?>
                                              <ul class="thumbs-list_<?php echo $catalogID; ?>">					
                                                  <?php
                                                      $imgurl=explode(";",$row->image_url);
                                                      array_pop($imgurl);       //      array_shift($imgurl);
                                                      
                                                      if(($paramssld['ht_view3_allow_zooming'] == "on" && $paramssld['ht_view3_allow_lightbox'] == "off") || ($paramssld['ht_view3_allow_zooming'] == "off" && $paramssld['ht_view3_allow_lightbox'] == "off")){  }
                                                      else{ array_shift($imgurl); }
                                                      
                                                      foreach($imgurl as $key=>$img)
                                                      { ?>
                                                            <li><a href="<?php echo esc_attr($img);?>" class="catalog_group<?php echo $group_key."_".$catalogID; ?>"><img src="<?php echo esc_attr($img); ?>"></a></li>
                                                <?php } ?>
                                              </ul>
                                          <?php
                                          }
                                          ?>
                                      </div>
                              </div>
                              <div class="right-block">
                                <?php if($row->name!=''){?><div class="title-block_<?php echo $catalogID; ?>"><h3><?php echo $row->name; ?></h3></div><?php } ?>
                                <?php
                                if($paramssld["ht_view3_show_description"] == 'on')
                                    {
                                      if($row->description!='')
                                          { ?>
                                          <div class="description-block_<?php echo $catalogID; ?>"><p><?php echo $row->description; ?></p></div>
                                    <?php } ?>
                              <?php } ?>
                                          
                                  <?php if($paramssld["ht_catalog_view3_show_price"]=='on' && $row->price != ""){ ?>
                                            <div class="price-block_<?php echo $catalogID; ?>">
                                                <span class="old-price-block" ><?php echo $paramssld3['ht_single_product_price_text']; ?> : <span class="old-price" <?php if($row->market_price == "") { echo "style='text-decoration: none !important;'"; } ?>><?php echo $row->price; ?></span></span>
                                                <span class="discont-price-block" ><span class="discont-price" ><?php echo $row->market_price; ?></span></span>
                                            </div>
                                  <?php } ?>
                                          
                                      <?php
                                      if($paramssld["ht_view3_show_linkbutton"] == 'on') {
                                          if($row->single_product_url_type == "default"){
                                             $page_link = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
                                             if (strpos(get_permalink(),'/?') !== false) { $product_page_link = get_permalink()."&single_prod_id=$row->id"; } else { if (strpos(get_permalink(),'/') !== false) { $product_page_link = get_permalink()."?single_prod_id=$row->id"; } else { $product_page_link = get_permalink()."/?single_prod_id=$row->id"; } }
                                         }
                                         else{ $product_page_link = $row->single_product_url_type; }
                                      ?>
                                          <div class="button-block">
                                                  <a href="<?php echo esc_url($product_page_link); ?>" <?php if($row->link_target == 'on'){echo ' target="_blank"';} ?>><?php echo $paramssld3["ht_catalog_general_linkbutton_text"]; ?></a>
                                          </div>
                                      <?php 
                                      } ?>
                              </div>
                      </div>

          <?php
              }
              ?>

        </div>
    
    <?php
            if($catalog[0]->pagination_type == "pagination"){
        ?>
        <div class="catalog_pagination_block_<?php echo $catalogID; ?>" >
            <div class="catalog_pagination_<?php echo $catalogID; ?>" >
                <?php
//                var_dump($_SERVER);
                
                    if (strpos($_SERVER['QUERY_STRING'], 'catalog_page_') !== false)
                {                                                                   //      IF WE HAVE $_GET PAGE
                    $oneMore = $page_index + 1;
                    $oneLess = $page_index - 1;
                    
                    if(isset($_GET["catalog_page_".$catalogID])){                   //      IF WE HAVE $_GET PAGE FOR THAT CATALOG
                        $prevPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$oneLess,$_SERVER['QUERY_STRING']);
                        $nextPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$oneMore,$_SERVER['QUERY_STRING']);
                        $firstPagePath = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=1",$_SERVER['QUERY_STRING']);
                        $lastPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$pages,$_SERVER['QUERY_STRING']);
//                        var_dump($nextPagePath);
                    }
                    else{                                                           //      IF WE HAVE $_GET PAGE FOR ANOTHER CATALOG
                        $prevPagePath  = "#";
                        $nextPagePath = $_SERVER['QUERY_STRING']."&catalog_page_".$catalogID."=2";
//                        $nextPagePath  = str_replace("catalog_page_".$catalogID."=".$page_index,"catalog_page_".$catalogID."=".$oneMore,$_SERVER['QUERY_STRING']);
                        $firstPagePath = $_SERVER['QUERY_STRING']."&catalog_page_".$catalogID."=1";
                        $lastPagePath  = $_SERVER['QUERY_STRING']."&catalog_page_".$catalogID."=".$pages;
                    }
                }
                else{                                                               //      IF WE HAVE NOOOT $_GET PAGE
                    $oneMore = $page_index + 1;
                    $oneLess = $page_index - 1;
                    
                    $prevPagePath  = "#";
                    $nextPagePath  = "catalog_page_".$catalogID."=2";
                    $firstPagePath = "catalog_page_".$catalogID."=1";
                    $lastPagePath  = "catalog_page_".$catalogID."=".$pages;
                }
                

               
                    if (strpos(get_permalink(),'/?') !== false) { $pathSumbol = "&"; }
                    else {
                        if (strpos(get_permalink(),'/') !== false) { $pathSumbol = "?"; }
                        else { $pathSumbol = "/?"; }
                    }
                    // The "back" link
//                    $prevlink = ($page_index > 1) ? ''
//                            . '<a href="'.$pathSumbol.$firstPagePath. '" class="go-to-first"></a> <a href="'.$pathSumbol.$prevPagePath. '" class="go-to-previous"></a>' : '<span class="disabled go-to-first-passive"></span> <span class="disabled go-to-previous-passive"></span>';

                    // The "forward" link
//                    $nextlink = ($page_index < $pages) ? ''
//                            . '<a href="'.$pathSumbol.$nextPagePath. '" class="go-to-next"></a> <a href="'.$pathSumbol.$lastPagePath. '" class="go-to-last"></a>' : '<span class="disabled go-to-next-passive"></span> <span class="disabled go-to-last-passive"></span>';
                    
                    // The "back" link
                    $prevlink = ($page_index > 1) ? ''
                            . '<a href="'.$pathSumbol.$firstPagePath. '" class="go-to-first"><i class="icon-style4 hugeiticons-fast-backward" ></i></a>'
                            . '<a href="'.$pathSumbol.$prevPagePath. '" class="go-to-previous"><i class="icon-style4 hugeiticons-chevron-left"></i></a>' : '<span class="disabled go-to-first-passive"></span> <span class="disabled go-to-previous-passive"></span>';

                    // The "forward" link
                    $nextlink = ($page_index < $pages) ? ''
                            . '<a href="'.$pathSumbol.$nextPagePath. '" class="go-to-next"><i class="icon-style4 hugeiticons-chevron-right"></i></a>'
                            . '<a href="'.$pathSumbol.$lastPagePath. '" class="go-to-last"><i class="icon-style4 hugeiticons-fast-forward" ></i></a>' : 
                              '<span class="disabled go-to-next-passive"></span>'
                            . '<span class="disabled go-to-last-passive"></span>';
                    
                    echo $prevlink." <span class='pagination-text'>".$page_index." / ".$pages."</span> ".$nextlink;
                
                    
                ?>
            </div>
        </div>
        <?php
            }
            elseif($catalog[0]->pagination_type == "load_more"){ $path_site = plugins_url("/../images", __FILE__); ?>
                <div class="catalog_load_block_<?php echo $catalogID; ?>" >
                    <div class="catalog_load_<?php echo $catalogID; ?>" >
                        <a href="#" class="load_more_elements_<?php echo $catalogID; ?>"><?php echo __("Load","product-catalog");?></a>
                        <img src="<?php echo $path_site; ?>/load_more_icon_<?php echo $paramssld['htc_view3_load_more_loading_icon']; ?>.gif" class="load_more_loading_icon" style="display: none"/>
                        <input type="hidden" class="load-more-elements-count" value="<?php echo esc_attr($countIntoPage); ?>"/>
                    <?php
                        
                    ?>
                    </div>
                </div>
      <?php } ?>
    
 </section>
  
<script>

/***<object for ajax add search> ***/

var $ob_<?php echo $catalogID; ?> = {
                        action: 'my_action',
                        post: 'load_more_elements_into_catalog',
                        view: <?php echo $catalog[0]->catalog_list_effects_s; ?>,
                        catalog_id: <?php echo $catalogID; ?>,
                        count_into_page: <?php echo $countIntoPage; ?>,
                        allow_lightbox: "<?php echo $paramssld['ht_view3_allow_lightbox']; ?>",
                        show_thumbs: "<?php echo $paramssld['ht_view3_show_thumbs']; ?>",
                        show_description: "<?php echo $paramssld['ht_view3_show_description']; ?>",
                        show_price: "<?php echo $paramssld["ht_catalog_view3_show_price"]; ?>",
                        show_linkbutton: "<?php echo $paramssld['ht_view3_show_linkbutton']; ?>",
                        price_text: "<?php echo $paramssld3['ht_single_product_price_text']; ?>",
                        linkbutton_text: "<?php echo $paramssld3["ht_catalog_general_linkbutton_text"]; ?>",
                        parmalink: "<?php echo get_permalink(); ?>",
                        thumbs_position: "useLess",
                        show_popup_title: "useLess",
                       // show_popup_linkbutton: "useLess"
};

/***</object for ajax add search > ***/


    var allowZooming = '<?php echo $paramssld['ht_view3_allow_zooming'];?>';
jQuery(function(){  
    var defaultBlockWidth=<?php echo $paramssld['ht_view3_mainimage_width']; ?>;
    
    var $container = jQuery('#huge_it_catalog_container_<?php echo $catalogID; ?>');
    
    
      // add randomish size classes
      $container.find('.element_<?php echo $catalogID; ?>').each(function(){
        var $this = jQuery(this),
            number = parseInt( $this.find('.number').text(), 10 );
			//alert(number);
        if ( number % 7 % 2 === 1 ) {
          $this.addClass('width2');
        }
        if ( number % 3 === 0 ) {
          $this.addClass('height2');
        }
      });
    
    $container.hugeitmicro({
      itemSelector : '.element_<?php echo $catalogID; ?>',
      masonry : {
        columnWidth : <?php echo $paramssld['ht_view3_mainimage_width']; ?>+20+<?php echo $paramssld['ht_view3_element_border_width']*2; ?>
      },
      masonryHorizontal : {
        rowHeight: 300+20
      },
      cellsByRow : {
        columnWidth : 300+20,
        rowHeight : 240
      },
      cellsByColumn : {
        columnWidth : 300+20,
        rowHeight : 240
      },
      getSortData : {
        symbol : function( $elem ) {
          return $elem.attr('data-symbol');
        },
        category : function( $elem ) {
          return $elem.attr('data-category');
        },
        number : function( $elem ) {
          return parseInt( $elem.find('.number').text(), 10 );
        },
        weight : function( $elem ) {
          return parseFloat( $elem.find('.weight').text().replace( /[\(\)]/g, '') );
        },
        id : function ( $elem ) {
          return $elem.find('.id').text();
        }
      }
    });
    
    
      var $optionSets = jQuery('#huge_it_catalog_options_<?php echo $catalogID; ?> .option-set'),
          $optionLinks = $optionSets.find('a');

      $optionLinks.click(function(){
        var $this = jQuery(this);

        if ( $this.hasClass('selected') ) {
          return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');
  

        var options = {},
            key = $optionSet.attr('data-option-key'),
            value = $this.attr('data-option-value');

        value = value === 'false' ? false : value;
        options[ key ] = value;
        if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {

          changeLayoutMode( $this, options )
        } else {

          $container.hugeitmicro( options );
        }
        
        return false;
      });


    

      var isHorizontal = false;
      function changeLayoutMode( $link, options ) {
        var wasHorizontal = isHorizontal;
        isHorizontal = $link.hasClass('horizontal');

        if ( wasHorizontal !== isHorizontal ) {

          var style = isHorizontal ? 
            { height: '75%', width: $container.width() } : 
            { width: 'auto' };

          $container.filter(':animated').stop();

          $container.addClass('no-transition').css( style );
          setTimeout(function(){
            $container.removeClass('no-transition').hugeitmicro( options );
          }, 100 )
        } else {
          $container.hugeitmicro( options );
        }
      }


    

      $container.delegate( '.default-block_<?php echo $catalogID; ?>', 'click', function(){
          var strheight=0;
          jQuery(this).parents('.element_<?php echo $catalogID; ?>').find('.wd-catalog-panel_<?php echo $catalogID; ?> > div').each(function(){
                strheight+=jQuery(this).outerHeight()+10;
                //alert(strheight);
          })
          strheight+=<?php echo $paramssld['ht_view0_block_height']+45; ?>;
	  			if(jQuery(this).parents('.element_<?php echo $catalogID; ?>').hasClass("large")){
			jQuery(this).parents('.element_<?php echo $catalogID; ?>').animate({
				height: "<?php echo $paramssld['ht_view0_block_height']+45; ?>px"
			}, 300, function() {
				jQuery(this).removeClass('large');
				$container.hugeitmicro('reLayout');
			});
			
			jQuery(this).parents('.element_<?php echo $catalogID; ?>').removeClass("active");
			return false;
		}
		
	
		jQuery(this).parents('.element_<?php echo $catalogID; ?>').css({height:strheight});
		jQuery(this).parents('.element_<?php echo $catalogID; ?>').addClass('large');

		$container.hugeitmicro('reLayout');
		jQuery(this).parents('.element_<?php echo $catalogID; ?>').css({height:"<?php echo $paramssld['ht_view0_block_height']+45; ?>px"});		 
		 
		//alert(strheight);
		 
		 jQuery(this).parents('.element_<?php echo $catalogID; ?>').animate({
			height:strheight+"px",
		  }, 300,function(){	$container.hugeitmicro('reLayout');});
	});

    var $sortBy =  jQuery('#huge_it_catalog_content_<?php echo $catalogID; ?> #sort-by');
    jQuery('#huge_it_catalog_content_<?php echo $catalogID; ?> #shuffle a').click(function(){
      $container.hugeitmicro('shuffle');
      $sortBy.find('.selected').removeClass('selected');
      $sortBy.find('[data-option-value="random"]').addClass('selected');
      return false;
    });
    
    ////filteringgggggg

        // bind filter on select change
        jQuery(document).ready(function(){
            jQuery('#huge_it_catalog_filters_<?php echo $catalogID; ?> ul li').click(function() {
              // get filter value from option value
              var filterValue = jQuery(this).attr('rel');
              // use filterFn if matches value
              filterValue = filterValue;//filterFns[ filterValue ] || 
              $container.hugeitmicro({ filter: filterValue });
            });
            <?php // if(($paramssld["ht_view3_sorting_float"] == "left" || $paramssld["ht_view3_sorting_float"] == "right") && $paramssld["ht_view3_filtering_float"] == "none")
//                  { ?>
//                        var topmargin = jQuery("#huge_it_catalog_filters_<?php echo $catalogID; ?> ul").height();
//                        jQuery("#huge_it_catalog_options_<?php echo $catalogID; ?>").css({'margin-top':parseInt(topmargin) + 5});
            <?php // }
//            else  {
//                    if(($paramssld["ht_view3_filtering_float"] == "left" || $paramssld["ht_view3_filtering_float"] == "right") && $paramssld["ht_view3_sorting_float"] == "none")
//                      { ?>
//                         var topmargin = jQuery("#huge_it_catalog_options_<?php echo $catalogID; ?>").height();
//                         jQuery("#huge_it_catalog_filters_<?php echo $catalogID; ?>").css({'margin-top':'5px'});
                <?php // }
//                  } ?>
           
           
            /*    <--   VIEW 3 ELEMENTS THUMBS CLICK    */
            
            var lightbox_is = "<?php echo $paramssld['ht_view3_allow_lightbox']; ?>";
                if(lightbox_is != "on"){
                    jQuery(".element_<?php echo $catalogID; ?> .left-block_<?php echo $catalogID; ?> .thumbs-list_<?php echo $catalogID; ?> li a img").click(function(e){
                        e.preventDefault();
//                        alert(lightbox_is);
                        var new_src = jQuery(this).attr("src");    //    alert(new_src);
                        var container = jQuery(this).closest(".element_<?php echo $catalogID; ?>");
//                        alert(container.html());
                        var image_block = container.find(".main-image-block_<?php echo $catalogID; ?>");
                                                
                        var image_block_height = image_block.height();
                            image_block.height(image_block_height);
                            
                            
                        var image = image_block.find("a img");
                        var container_height = container.height();
                            container.height(container_height);
                            
                            container.find('.zoomWrapper img').unwrap();
                            
                            container.find(".main-image-block_<?php echo $catalogID; ?> .zoomWrapper").each(function(){
                                jQuery(this).find("img").unwrap();
                            });
                            
                            zoom_resize();
                        
//                          image_block.height("auto");
                        
//                          container.height("auto");
                          
//                            zoom_resize();
                        setTimeout(function(){
                            image.after("<img src='" + new_src + "' style='height: " + image_block.height() + "px !important;' />")
                            image.remove();
                        }, 100);
                        setTimeout(function(){
                            zoom_start();
//                            jQuery("#huge_it_catalog_container_<?php echo $catalogID; ?>").hugeitmicro( 'reloadItems' ).hugeitmicro({ sortBy: 'original-order' }).hugeitmicro( 'reLayout' );
                        }, 100);
                    });
                }
                                
            /*           VIEW 3 ELEMENTS THUMBS CLICK    -->    */
                                
            /*    <--    VIEW 3 LOAD MORE CLICK    */
            

            
            /*           VIEW 3 LOAD MORE CLICK    -->    */

        });
        
        //end of filtering
        
        jQuery(window).load(function(){
		$container.hugeitmicro('reLayout');
		jQuery(window).resize(function(){$container.hugeitmicro('reLayout');});
	});

  });
  
</script>
	  
	  <?php
	    
        break;
		

?>
  
	  <?php
	  
        break;
/////////////////////////////////// VIEW 5 Content Slider ////////////////////////////////////
		case 5;
?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.0.0/animate.min.css">
  <link href="<?php echo plugins_url('../style/liquid-slider.css', __FILE__);?>" rel="stylesheet" type="text/css" />
 
<style>
#main-slider_<?php echo $catalogID; ?>-wrapper .ls-nav { display: none; }
#main-slider_<?php echo $catalogID; ?> {background:#<?php echo $paramssld["ht_view5_slider_background_color"];?>;}

#main-slider_<?php echo $catalogID; ?> div.slider-content {
	position:relative;
	width:100%;
	padding:0px 0px 0px 0px;
	position:relative;
	background:#<?php echo $paramssld["ht_view5_slider_background_color"];?>;
}



[class$="-arrow"] {
	background-image:url(<?php echo plugins_url('../images/arrow.'.$paramssld["ht_view5_icons_style"].'.png', __FILE__);?>);
}

.ls-select-box {
	background:url(<?php echo plugins_url('../images/menu.'.$paramssld["ht_view5_icons_style"].'.png', __FILE__);?>) right center no-repeat #<?php echo $paramssld["ht_view5_slider_background_color"];?>;
}

#main-slider_<?php echo $catalogID; ?>-nav-select {
	color:#<?php echo $paramssld["ht_view5_title_font_color"];?>;
}

#main-slider_<?php echo $catalogID; ?> div.slider-content .slider-content-wrapper {
	position:relative;
	width:100%;
	padding:0px;
	display:block;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .image-block_<?php echo $catalogID; ?> {
	width:<?php echo $paramssld["ht_view5_main_image_width"];?>px;
	display:table-cell;
	padding:0px 10px 0px 0px;
	float:left;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .image-block_<?php echo $catalogID; ?> img.main-image {
	position:relative !important;
	width:100%;
	height:auto;
	display:block;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .image-block_<?php echo $catalogID; ?> ul.thumbs-list_<?php echo $catalogID; ?> {
	list-style:none;
	display:table;
	position:relative;
	clear:both;
	width:100%;
	margin:10px 0px 0px 0px;
	padding:0px;
	clear:both;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .image-block_<?php echo $catalogID; ?> ul.thumbs-list_<?php echo $catalogID; ?> li {
	display:block;
	float:left;
	width:<?php echo $paramssld["ht_view5_thumbs_width"];?>px;
	height:<?php echo $paramssld["ht_view5_thumbs_height"];?>px;
	margin:0px 2% 5px 1%;
	opacity:0.45;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .image-block_<?php echo $catalogID; ?> ul.thumbs-list_<?php echo $catalogID; ?> li.active,#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .image-block_<?php echo $catalogID; ?> ul.thumbs-list_<?php echo $catalogID; ?> li:hover {
	opacity:1;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .image-block_<?php echo $catalogID; ?> ul.thumbs-list_<?php echo $catalogID; ?> li a {
	display:block;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .image-block_<?php echo $catalogID; ?> ul.thumbs-list_<?php echo $catalogID; ?> li img {
	margin:0px !important;
	padding:0px !important;
	width:<?php echo $paramssld["ht_view5_thumbs_width"];?>px !important;
	height:<?php echo $paramssld["ht_view5_thumbs_height"];?>px !important;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block {
	display:table-cell;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block > div {
	padding-bottom:10px;
	margin-top:10px;
	<?php if($paramssld['ht_view5_show_separator_lines']=="on") {?>
		background:url('<?php echo  plugins_url( '../images/divider.line.png' , __FILE__ ); ?>') center bottom repeat-x;
	<?php } ?>
}
#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block > div:last-child {background:none;}


#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .title {
	position:relative;
	display:block;
	margin:-10px 0px 0px 0px;
	font-size:<?php echo $paramssld["ht_view5_title_font_size"];?>px !important;
	line-height:<?php echo $paramssld["ht_view5_title_font_size"]+4;?>px !important;
	color:#<?php echo $paramssld["ht_view5_title_font_color"];?>;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .description {
	clear:both;
	position:relative;
	font-weight:normal;
	text-align:justify;
	font-size:<?php echo $paramssld["ht_view5_description_font_size"];?>px !important;
	line-height:<?php echo $paramssld["ht_view5_description_font_size"]+4;?>px !important;
	color:#<?php echo $paramssld["ht_view5_description_color"];?>;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .description h1,
#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .description h2,
#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .description h3,
#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .description h4,
#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .description h5,
#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .description h6,
#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .description p, 
#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .description strong,
#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .description span {
	padding:2px !important;
	margin:0px !important;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .description ul,
#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .description li {
	padding:2px 0px 2px 5px;
	margin:0px 0px 0px 8px;
}



#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .old-price {
	text-decoration: line-through;
        margin: 0px;
        padding: 0px;
        font-weight: normal;
/*        font-size: 14px;*/
        padding: 7px 10px 7px 10px;
        margin: 0px 10px 0px 0px;
        border-radius: 5px;
        color: #<?php echo $paramssld['ht_view5_slider_background_color']; ?>;
        background: #<?php echo $paramssld['ht_catalog_view5_price_font_color']; ?>;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .price-block_<?php echo $catalogID; ?> {
	font-size: <?php echo $paramssld['ht_catalog_view5_price_font_size']; ?>px;
        color: #<?php echo $paramssld['ht_catalog_view5_price_font_color']; ?>;
       line-height: 2 !important;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block .discont-price-block {
	
}



#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .button-block {
	position:relative;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .button-block a,#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .button-block a:link,#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .button-block a:visited{
	position:relative;
	display:inline-block;
	padding:6px 12px;
	background:#<?php echo $paramssld["ht_view5_linkbutton_background_color"];?>;
	color:#<?php echo $paramssld["ht_view5_linkbutton_color"];?>;
	font-size:<?php echo $paramssld["ht_view5_linkbutton_font_size"];?>;
	text-decoration:none;
}

#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .button-block a:hover,#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .button-block a:focus,#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .button-block a:active {
	background:#<?php echo $paramssld["ht_view5_linkbutton_background_hover_color"];?>;
	color:#<?php echo $paramssld["ht_view5_linkbutton_font_hover_color"];?>;
}

@media only screen and (min-width:500px) {
	#main-slider-nav-ul {
		visibility:hidden !important;
		height:1px;
	}
}

@media only screen and (max-width:500px) {
	#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .image-block_<?php echo $catalogID; ?>,#main-slider_<?php echo $catalogID; ?> .slider-content-wrapper .right-block {
		width:100%;
		display:block;
		float:none;
		clear:both;
	}
}
.zoomContainer {
    z-index: 10;
}

</style>
<div id="main-slider_<?php echo $catalogID; ?>" class="liquid-slider product-catalog-content">
	<?php
	$catalog_slider_group = 0;
	foreach($images as $key=>$row)
	{
                $catalog_slider_group++;
		$imgurl=explode(";",$row->image_url);array_pop($imgurl);
		$link = $row->sl_url;
		$descnohtml=strip_tags($row->description);
		$result = substr($descnohtml, 0, 50);
		?>
		<div class="slider-content">
			
			<div class="slider-content-wrapper">
				<div class="image-block_<?php echo $catalogID; ?>  ">
					<?php 	if($row->image_url != ';'){ ?>
					<div class="main-image-block_<?php echo $catalogID; ?> for_zoom">
                                            <a <?php if($paramssld['ht_view5_allow_lightbox'] == "on"){ echo "class='catalog_slider_group".$catalog_slider_group."_".$catalogID."'"; }else{ echo "onclick='return false'"; } ?> href="<?php echo esc_attr($imgurl[0]); ?>" >
                                                <img class="main-image" src="<?php echo esc_attr($imgurl[0]); ?>" alt="" />
                                            </a>
                                        </div>
					<?php } else { ?>
                                                <img class="main-image" src="images/noimage.png" alt="" />
					<?php } ?>

					<?php if($paramssld["ht_view5_show_thumbs"] == "on"){ ?>
                                            <div class="thumbs-block">
                                                <ul class="thumbs-list_<?php echo $catalogID; ?>">
                                                    <?php

                                                    if(($paramssld['ht_view5_allow_zooming'] == "on" && $paramssld['ht_view5_allow_lightbox'] == "off") || ($paramssld['ht_view5_allow_zooming'] == "off" && $paramssld['ht_view5_allow_lightbox'] == "off")){  }
                                                    else{ array_shift($imgurl); }

                                                    foreach($imgurl as $key=>$img){?>
                                                            <li><a class="<?php if($paramssld['ht_view5_allow_lightbox'] == "on"){ echo "catalog_slider_group".$catalog_slider_group."_".$catalogID; } ?>" href="<?php echo esc_attr($img); ?>"><img src="<?php echo esc_attr($img); ?>"></a></li>
                                        <?php       } ?>
                                                </ul>
                                            </div>
					<?php } ?>					
				</div>
				<div class="right-block">
					<div><h2 class="title"><?php echo $row->name; ?></h2></div>
					<?php if($paramssld["ht_view5_show_description"]=='on'){ ?>
                                            <div class="description"><?php echo $row->description; ?></div>
                                        <?php } ?>
                                        
                                        <?php if($paramssld["ht_catalog_view5_show_price"]=='on' && $row->price != ""){ ?>
                                                  <div class="price-block_<?php echo $catalogID; ?>">
                                                      <span class="old-price-block" ><?php echo $paramssld3['ht_single_product_price_text']; ?> : <span class="old-price" <?php if($row->market_price == "") { echo "style='text-decoration: none !important;'"; } ?> ><?php echo $row->price; ?></span></span>
                                                      <span class="discont-price-block" ><span class="discont-price" ><?php echo $row->market_price; ?></span></span>
                                                  </div>
                                        <?php } ?>
                                        
                                        <?php if($paramssld["ht_view5_show_linkbutton"]=='on'){
                                         if($row->single_product_url_type == "default"){
                                             $page_link = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
                                             if (strpos(get_permalink(),'/?') !== false) { $product_page_link = get_permalink()."&single_prod_id=$row->id"; } else { if (strpos(get_permalink(),'/') !== false) { $product_page_link = get_permalink()."?single_prod_id=$row->id"; } else { $product_page_link = get_permalink()."/?single_prod_id=$row->id"; } }
                                         }
                                         else{ $product_page_link = $row->single_product_url_type; }
                                         ?>
						<div class="button-block">
							<a class="" href="<?php echo esc_url($product_page_link); ?>"  <?php if($row->link_target == 'on'){echo ' target="_blank"';} ?>><?php echo $paramssld3["ht_catalog_general_linkbutton_text"]; ?></a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
	} ?>
</div>
  <script src="<?php echo plugins_url('../js/jquery.liquid-slider.min.js', __FILE__);?>"></script>  
   <script>
       var allowZooming = '<?php echo $paramssld['ht_view5_allow_zooming'];?>';
    /**
     * If you need to access the internal property or methods, use this:
     * var api = $.data( jQuery('#main-slider_<?php echo $catalogID; ?>')[0], 'liquidSlider');
     * console.log(api);
     */
	 jQuery('#main-slider_<?php echo $catalogID; ?>').liquidSlider();
         
         
         jQuery(document).ready(function(){
             
            /*    <--   VIEW 5 ELEMENTS THUMBS CLICK    */
            
            jQuery(".slider-content-wrapper .image-block_<?php echo $catalogID; ?> .thumbs-list_<?php echo $catalogID; ?> li a img").click(function(e){
                var lightbox_is = "<?php echo $paramssld['ht_view5_allow_lightbox']; ?>";
                    if(lightbox_is != "on"){
                        e.preventDefault();

                        var new_src = jQuery(this).attr("src");                                                               //       alert(new_src);
//                        var container = jQuery(this).closest(".slider-content-wrapper");
//                        var image_block = container.find(".main-image-block_<?php echo $catalogID; ?>");                    //      alert(image_block.html());
//                        var image = image_block.find("a img.main-image");     //      alert(image.html());
//                            
//                        var image_block_height = image_block.height();
//                            
//                            container.find('.zoomWrapper img').unwrap();
//                            container.find(".main-image-block_<?php echo $catalogID; ?> .zoomWrapper").each(function(){
//                                jQuery(this).find("img").unwrap();
//                            });
//                                                        
//                            setTimeout(function(){
//                                image.after("<img src='" + new_src + "' style='height: " + image_block.height() + "px !important;' class='main-image' />")
//                                image.remove();
//                            }, 100);
//                            setTimeout(function(){
//                                zoom_resize();
//                                zoom_start();
//                            }, 1000);
                        var container = jQuery(this).closest(".slider-content-wrapper");
                        var image_block = container.find(".main-image-block_<?php echo $catalogID; ?>");
                        var image = image_block.find("a img.main-image");
                        
                        var image_block_height = image_block.height();
                        
//                        var image = jQuery(".slider-content .image-block_<?php echo $catalogID; ?> a .main-image");
                            
//                            image.after("<img src='" + new_src + "' style='height: " + image_block.height() + "px !important;' class='main-image' />")
//                            image.remove();
                            image.attr("src", new_src);
                            
                            var new_img_height = image.height();
//                            container.height(new_img_height);
                            container.find(".zoomWrapper").height(new_img_height);
                                
                            zoom_resize();
                            
                            setTimeout(function(){
                                jQuery(".ls-nav-left-arrow").click();
                                jQuery(".ls-nav-right-arrow").click();
                            }, 100);
                            
                    }
                        
            });
            
            
         });
           
  </script>
<?php  
        break;
   ?>




<?php 
}
 ?>
<?php
	return ob_get_clean();
}
?>

<?php
    function html_single_product_page($productArray, $paramssld, $paramssld2, $paramssld3, $paramssld4, $ratingsArray, $reviewsArray, $spamReviewsArray, $captchaFirstNum, $captchaSecondNum, $captcha_val){
        ob_start();                                             //          var_dump($paramssld4);
        $rating = 0;
        if(!empty($ratingsArray)){
            for($i = 0; $i < count($ratingsArray) ; $i++ ){
                $rating = $rating + $ratingsArray[$i]->value;
            }
            $rating = intval($rating / count($ratingsArray));
        };
        if(isset($_GET['single_prod_id'])) $prod_id = absint($_GET['single_prod_id']);
        else $prod_id = 1;

        wp_get_current_user() ;
        global $user_level;$user_info = get_userdata(1);
        
        

        $prod_params = $productArray[0]->parameters;
        $productArray = $productArray[0];
        $allParamsAndChildsInArray = explode('*()*', $prod_params);
        //var_dump($prod_params);     var_dump($rating);
        $group_key = $productArray->id;
        //		var_dump($productArray->id);exit;
        $link =$productArray->image_url;

        $myPageLink = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        
        $adminLink = get_option( 'admin_email' );

        if ($paramssld==null) $paramssld=array();
        if ($paramssld2==null) $paramssld2=array();
        
        $paramssld["ht_view0_sorting_float"] = "none";
        $paramssld["ht_view1_sorting_float"] = "none";
        $paramssld["ht_view2_sorting_float"] = "none";
        $paramssld["ht_view3_sorting_float"] = "none";
        $paramssld["ht_view4_sorting_float"] = "none";
        $paramssld["ht_view5_sorting_float"] = "none";
        $paramssld["ht_view6_sorting_float"] = "none";

        $paramssld["ht_view0_filtering_float"] = "none";
        $paramssld["ht_view1_filtering_float"] = "none";
        $paramssld["ht_view2_filtering_float"] = "none";
        $paramssld["ht_view3_filtering_float"] = "none";
        $paramssld["ht_view4_filtering_float"] = "none";
        $paramssld["ht_view5_filtering_float"] = "none";
        $paramssld["ht_view6_filtering_float"] = "none";
        $paramssld["ht_single_product_allow_lightbox"] = "off";
        $paramssld["ht_single_product_allow_zooming"] = "on";
        $paramssld["ht_single_product_border_width"] = "1";
        $paramssld["ht_single_product_border_color"] = "f9f9f9";
        $paramssld["ht_single_product_background_color"] = "efefef";
        $paramssld["ht_single_product_mainimage_width"] = "240";
        $paramssld["ht_single_product_show_separator_lines"] = "on";
        $paramssld["ht_single_product_title_font_size"] = "24";
        $paramssld["ht_single_product_title_font_color"] = "0074A2";
        $paramssld["ht_single_product_show_description"] = "on";
        $paramssld["ht_single_product_description_font_size"] = "14";
        $paramssld["ht_single_product_description_font_color"] = "000";
        $paramssld["ht_single_product_show_thumbs"] = "on";
        $paramssld["ht_single_product_thumbs_width"] = "75";
        $paramssld["ht_single_product_thumbs_height"] = "75";
        $paramssld["ht_single_product_price_font_size"] = "14";
        $paramssld["ht_single_product_price_font_color"] = "E22828";
        $paramssld["ht_single_product_market_price_font_size"] = "14";
        $paramssld["ht_single_product_market_price_font_color"] = "E22828";
        $paramssld["ht_single_product_rating_font_size"] = "14";
        $paramssld["ht_single_product_rating_font_color"] = "000000";
        $paramssld["ht_single_product_tabs_font_color"] = "000";
        $paramssld["ht_single_product_tabs_font_hover_color"] = "fff";
        $paramssld["ht_single_product_params_tab_box_background_color"] = "fff";
        $paramssld["ht_single_product_params_tab_words_font_color"] = "000";
        $paramssld["ht_single_product_comments_tab_words_font_color"] = "000";
        $paramssld["ht_single_product_params_name_font_color"] = "000";
        $paramssld["ht_single_product_params_values_font_color"] = "000";
        $paramssld["ht_single_product_comments_name_font_color"] = "000";
        $paramssld["ht_single_product_comments_content_font_color"] = "000";
        $paramssld["ht_single_product_comments_submit_button_text"] = "Submit";
        $paramssld["ht_single_product_comments_submit_button_text_font_size"] = "14";
        $paramssld["ht_single_product_comments_submit_button_text_font_color"] = "FFFFFF";
        $paramssld["ht_single_product_comments_submit_button_text_font_hover_color"] = "FFFFFF";
        $paramssld["ht_single_product_comments_submit_button_text_background_color"] = "4ca6cf";
        $paramssld["ht_single_product_comments_submit_button_text_background_hover_olor"] = "21759b";
        $paramssld["ht_single_product_price_text"] = "Price";
        $paramssld["ht_single_product_market_price_text"] = "Discount Price";
        $paramssld["ht_single_product_comments_text"] = "Comments";
        $paramssld["ht_single_product_parameters_text"] = "Parameters";
        $paramssld["ht_single_product_rating_text"] = "Rating";
        $paramssld["ht_single_product_share_text"] = "Share";
        $paramssld["ht_single_product_show_price"] = "on";
        $paramssld["ht_single_product_show_rating"] = "on";
        $paramssld["ht_single_product_show_share_buttons"] = "on";
        $paramssld["ht_single_product_show_parameters"] = "on";
        $paramssld["ht_single_product_show_comments"] = "on";
        $paramssld["ht_single_product_tabs_border_color"] = "cccccc";
        $paramssld["ht_single_product_your_name_text"] = "Your Name";
        $paramssld["ht_single_product_your_Comment_text"] = "Your Comment";
        $paramssld["ht_single_product_captcha_text"] = "Captcha";
        $paramssld["ht_single_product_invalid_captcha_text"] = "Invalid Captcha";

        $paramssld2["ht_view0_togglebutton_style"] = "dark";
        $paramssld2["ht_view0_show_separator_lines"] = "on";
        $paramssld2["ht_view0_linkbutton_text"] = "View Product";
        $paramssld2["ht_view0_show_linkbutton"] = "on";
        $paramssld2["ht_view0_linkbutton_background_hover_color"] = "df2e1b";
        $paramssld2["ht_view0_linkbutton_background_color"] = "e74c3c";
        $paramssld2["ht_view0_linkbutton_font_hover_color"] = "ffffff";
        $paramssld2["ht_view0_linkbutton_color"] = "ffffff";
        $paramssld2["ht_view0_linkbutton_font_size"] = "14";
        $paramssld2["ht_view0_description_color"] = "5b5b5b";
        $paramssld2["ht_view0_description_font_size"] = "14";
        $paramssld2["ht_view0_show_description"] = "on";
        $paramssld2["ht_view0_thumbs_width"] = "75";
        $paramssld2["ht_view0_thumbs_position"] = "before";
        $paramssld2["ht_view0_show_thumbs"] = "on";
        $paramssld2["ht_view0_title_font_size"] = "15";
        $paramssld2["ht_view0_title_font_color"] = "555555";
        $paramssld2["ht_view0_element_border_width"] = "1";
        $paramssld2["ht_view0_element_border_color"] = "D0D0D0";
        $paramssld2["ht_view0_element_background_color"] = "f7f7f7";
        $paramssld2["ht_view0_block_width"] = "275";
        $paramssld2["ht_view0_block_height"] = "160";
        $paramssld2["ht_view1_show_separator_lines"] = "on";
        $paramssld2["ht_view1_linkbutton_text"] = "View Product";
        $paramssld2["ht_view1_show_linkbutton"] = "on";
        $paramssld2["ht_view1_linkbutton_background_hover_color"] = "df2e1b";
        $paramssld2["ht_view1_linkbutton_background_color"] = "e74c3c";
        $paramssld2["ht_view1_linkbutton_font_hover_color"] = "ffffff";
        $paramssld2["ht_view1_linkbutton_color"] = "ffffff";
        $paramssld2["ht_view1_linkbutton_font_size"] = "14";
        $paramssld2["ht_view1_description_color"] = "5b5b5b";
        $paramssld2["ht_view1_description_font_size"] = "14";
        $paramssld2["ht_view1_show_description"] = "on";
        $paramssld2["ht_view1_thumbs_width"] = "75";
        $paramssld2["ht_view1_thumbs_position"] = "before";
        $paramssld2["ht_view1_show_thumbs"] = "on";
        $paramssld2["ht_view1_title_font_size"] = "15";
        $paramssld2["ht_view1_title_font_color"] = "555555";
        $paramssld2["ht_view1_element_border_width"] = "1";
        $paramssld2["ht_view1_element_border_color"] = "D0D0D0";
        $paramssld2["ht_view1_element_background_color"] = "f7f7f7";
        $paramssld2["ht_view1_block_width"] = "275";
        $paramssld2["ht_view2_element_linkbutton_text"] = "View Product";
        $paramssld2["ht_view2_element_show_linkbutton"] = "on";
        $paramssld2["ht_view2_element_linkbutton_color"] = "ffffff";
        $paramssld2["ht_view2_element_linkbutton_font_size"] = "14";
        $paramssld2["ht_view2_element_linkbutton_background_color"] = "2ea2cd";
        $paramssld2["ht_view2_show_popup_linkbutton"] = "on";
        $paramssld2["ht_view2_popup_linkbutton_text"] = "View Product";
        $paramssld2["ht_view2_popup_linkbutton_background_hover_color"] = "0074a2";
        $paramssld2["ht_view2_popup_linkbutton_background_color"] = "2ea2cd";
        $paramssld2["ht_view2_popup_linkbutton_font_hover_color"] = "ffffff";
        $paramssld2["ht_view2_popup_linkbutton_color"] = "ffffff";
        $paramssld2["ht_view2_popup_linkbutton_font_size"] = "14";
        $paramssld2["ht_view2_description_color"] = "222222";
        $paramssld2["ht_view2_description_font_size"] = "14";
        $paramssld2["ht_view2_show_description"] = "on";
        $paramssld2["ht_view2_thumbs_width"] = "75";
        $paramssld2["ht_view2_thumbs_height"] = "75";
        $paramssld2["ht_view2_thumbs_position"] = "before";
        $paramssld2["ht_view2_show_thumbs"] = "on";
        $paramssld2["ht_view2_popup_background_color"] = "FFFFFF";
        $paramssld2["ht_view2_popup_overlay_color"] = "000000";
        $paramssld2["ht_view2_popup_overlay_transparency_color"] = "70";
        $paramssld2["ht_view2_popup_closebutton_style"] = "dark";
        $paramssld2["ht_view2_show_separator_lines"] = "on";
        $paramssld2["ht_view2_show_popup_title"] = "on";
        $paramssld2["ht_view2_element_title_font_size"] = "18";
        $paramssld2["ht_view2_element_title_font_color"] = "222222";
        $paramssld2["ht_view2_popup_title_font_size"] = "18";
        $paramssld2["ht_view2_popup_title_font_color"] = "222222";
        $paramssld2["ht_view2_element_overlay_color"] = "FFFFFF";
        $paramssld2["ht_view2_element_overlay_transparency"] = "70";
        $paramssld2["ht_view2_zoombutton_style"] = "light";
        $paramssld2["ht_view2_element_border_width"] = "1";
        $paramssld2["ht_view2_element_border_color"] = "dedede";
        $paramssld2["ht_view2_element_background_color"] = "f9f9f9";
        $paramssld2["ht_view2_element_width"] = "275";
        $paramssld2["ht_view2_element_height"] = "160";
        $paramssld2["ht_view3_show_separator_lines"] = "on";
        $paramssld2["ht_view3_linkbutton_text"] = "View Product";
        $paramssld2["ht_view3_show_linkbutton"] = "on";
        $paramssld2["ht_view3_linkbutton_background_hover_color"] = "0074a2";
        $paramssld2["ht_view3_linkbutton_background_color"] = "2ea2cd";
        $paramssld2["ht_view3_linkbutton_font_hover_color"] = "ffffff";
        $paramssld2["ht_view3_linkbutton_color"] = "ffffff";
        $paramssld2["ht_view3_linkbutton_font_size"] = "14";
        $paramssld2["ht_view3_description_color"] = "555555";
        $paramssld2["ht_view3_description_font_size"] = "14";
        $paramssld2["ht_view3_show_description"] = "on";
        $paramssld2["ht_view3_thumbs_width"] = "75";
        $paramssld2["ht_view3_thumbs_height"] = "75";
        $paramssld2["ht_view3_show_thumbs"] = "on";
        $paramssld2["ht_view3_title_font_size"] = "18";
        $paramssld2["ht_view3_title_font_color"] = "0074a2";
        $paramssld2["ht_view3_mainimage_width"] = "240";
        $paramssld2["ht_view3_element_border_width"] = "1";
        $paramssld2["ht_view3_element_border_color"] = "dedede";
        $paramssld2["ht_view3_element_background_color"] = "f9f9f9";
        $paramssld2["ht_view5_icons_style"] = "dark";
        $paramssld2["ht_view5_show_separator_lines"] = "on";
        $paramssld2["ht_view5_linkbutton_text"] = "View Product";
        $paramssld2["ht_view5_show_linkbutton"] = "on";
        $paramssld2["ht_view5_linkbutton_background_hover_color"] = "0074a2";
        $paramssld2["ht_view5_linkbutton_background_color"] = "2ea2cd";
        $paramssld2["ht_view5_linkbutton_font_hover_color"] = "ffffff";
        $paramssld2["ht_view5_linkbutton_color"] = "ffffff";
        $paramssld2["ht_view5_linkbutton_font_size"] = "14";
        $paramssld2["ht_view5_description_color"] = "555555";
        $paramssld2["ht_view5_description_font_size"] = "14";
        $paramssld2["ht_view5_show_description"] = "on";
        $paramssld2["ht_view5_thumbs_width"] = "75";
        $paramssld2["ht_view5_thumbs_height"] = "75";
        $paramssld2["ht_view5_show_thumbs"] = "on";
        $paramssld2["ht_view5_title_font_size"] = "16";
        $paramssld2["ht_view5_title_font_color"] = "0074a2";
        $paramssld2["ht_view5_main_image_width"] = "275";
        $paramssld2["ht_view5_slider_tabs_font_color"] = "d9d99";
        $paramssld2["ht_view5_slider_tabs_background_color"] = "555555";
        $paramssld2["ht_view5_slider_background_color"] = "f9f9f9";
        $paramssld2["ht_view6_title_font_size"] = "16";
        $paramssld2["ht_view6_title_font_color"] = "0074A2";
        $paramssld2["ht_view6_title_font_hover_color"] = "2EA2CD";
        $paramssld2["ht_view6_title_background_color"] = "000000";
        $paramssld2["ht_view6_title_background_transparency"] = "80";
        $paramssld2["ht_view6_border_radius"] = "3";
        $paramssld2["ht_view6_border_width"] = "0";
        $paramssld2["ht_view6_border_color"] = "eeeeee";
        $paramssld2["ht_view6_width"] = "275";
        $paramssld2["light_box_size"] = "17";
        $paramssld2["light_box_width"] = "500";
        $paramssld2["light_box_transition"] = "elastic";
        $paramssld2["light_box_speed"] = "800";
        $paramssld2["light_box_href"] = "False";
        $paramssld2["light_box_title"] = "false";
        $paramssld2["light_box_scalephotos"] = "true";
        $paramssld2["light_box_rel"] = "false";
        $paramssld2["light_box_scrolling"] = "false";
        $paramssld2["light_box_opacity"] = "20";
        $paramssld2["light_box_open"] = "false";
        $paramssld2["light_box_overlayclose"] = "true";
        $paramssld2["light_box_esckey"] = "false";
        $paramssld2["light_box_arrowkey"] = "false";
        $paramssld2["light_box_loop"] = "true";
        $paramssld2["light_box_data"] = "false";
        $paramssld2["light_box_classname"] = "false";
        $paramssld2["light_box_fadeout"] = "300";
        $paramssld2["light_box_closebutton"] = "false";
        $paramssld2["light_box_current"] = "image";
        $paramssld2["light_box_previous"] = "previous";
        $paramssld2["light_box_next"] = "next";
        $paramssld2["light_box_close"] = "close";
        $paramssld2["light_box_iframe"] = "false";
        $paramssld2["light_box_inline"] = "false";
        $paramssld2["light_box_html"] = "false";
        $paramssld2["light_box_photo"] = "false";
        $paramssld2["light_box_height"] = "500";
        $paramssld2["light_box_innerwidth"] = "false";
        $paramssld2["light_box_innerheight"] = "false";
        $paramssld2["light_box_initialwidth"] = "300";
        $paramssld2["light_box_initialheight"] = "100";
        $paramssld2["light_box_maxwidth"] = "768";
        $paramssld2["light_box_maxheight"] = "500";
        $paramssld2["light_box_slideshow"] = "false";
        $paramssld2["light_box_slideshowspeed"] = "2500";
        $paramssld2["light_box_slideshowauto"] = "true";
        $paramssld2["light_box_slideshowstart"] = "start slideshow";
        $paramssld2["light_box_slideshowstop"] = "stop slideshow";
        $paramssld2["light_box_fixed"] = "true";
        $paramssld2["light_box_top"] = "false";
        $paramssld2["light_box_bottom"] = "false";
        $paramssld2["light_box_left"] = "false";
        $paramssld2["light_box_right"] = "false";
        $paramssld2["light_box_reposition"] = "false";
        $paramssld2["light_box_retinaimage"] = "true";
        $paramssld2["light_box_retinaurl"] = "false";
        $paramssld2["light_box_retinasuffix"] = "@2x.$1";
        $paramssld2["light_box_returnfocus"] = "true";
        $paramssld2["light_box_trapfocus"] = "true";
        $paramssld2["light_box_fastiframe"] = "true";
        $paramssld2["light_box_preloading"] = "true";
        $paramssld2["slider_title_position"] = "5";
        $paramssld2["light_box_style"] = "1";
        $paramssld2["light_box_size_fix"] = "false";
        $paramssld2["ht_view2_popup_full_width"] = "on";
        $paramssld2["ht_view0_price_text"] = "Price";
        $paramssld2["ht_view1_price_text"] = "Price";
        $paramssld2["ht_view2_price_text"] = "Price";
        $paramssld2["ht_view3_price_text"] = "Price";
        $paramssld2["ht_view5_price_text"] = "Price";
        $paramssld2["ht_catalog_view0_show_price"] = "on";
        $paramssld2["ht_catalog_view0_price_font_size"] = "15";
        $paramssld2["ht_catalog_view0_price_font_color"] = "e74c3c";
        $paramssld2["ht_catalog_view0_market_price_font_size"] = "15";
        $paramssld2["ht_catalog_view0_market_price_font_color"] = "000000";
        $paramssld2["ht_catalog_view1_show_price"] = "on";
        $paramssld2["ht_catalog_view1_price_font_size"] = "15";
        $paramssld2["ht_catalog_view1_price_font_color"] = "e74c3c";
        $paramssld2["ht_catalog_view1_market_price_font_size"] = "15";
        $paramssld2["ht_catalog_view1_market_price_font_color"] = "000000";
        $paramssld2["ht_catalog_view2_show_price"] = "on";
        $paramssld2["ht_catalog_view2_price_font_size"] = "15";
        $paramssld2["ht_catalog_view2_price_font_color"] = "e74c3c";
        $paramssld2["ht_catalog_view2_market_price_font_size"] = "15";
        $paramssld2["ht_catalog_view2_market_price_font_color"] = "000000";
        $paramssld2["ht_catalog_view3_show_price"] = "on";
        $paramssld2["ht_catalog_view3_price_font_size"] = "15";
        $paramssld2["ht_catalog_view3_price_font_color"] = "0074a2";
        $paramssld2["ht_catalog_view3_market_price_font_size"] = "15";
        $paramssld2["ht_catalog_view3_market_price_font_color"] = "000000";
        $paramssld2["ht_catalog_view5_show_price"] = "on";
        $paramssld2["ht_catalog_view5_price_font_size"] = "15";
        $paramssld2["ht_catalog_view5_price_font_color"] = "0074a2";
        $paramssld2["ht_catalog_view5_market_price_font_size"] = "15";
        $paramssld2["ht_catalog_view5_market_price_font_color"] = "000000";
        $paramssld2["ht_catalog_zoom_window_type"] = "window";
        $paramssld2["ht_catalog_zoom_window_width"] = "300";
        $paramssld2["ht_catalog_zoom_window_height"] = "200";
        $paramssld2["ht_catalog_zoom_x_asis"] = "0";
        $paramssld2["ht_catalog_zoom_y_asis"] = "200";
        $paramssld2["ht_catalog_zoom_window_position"] = "16";
        $paramssld2["ht_catalog_zoom_window_border_size"] = "0";
        $paramssld2["ht_catalog_zoom_window_border_color"] = "#000";
        $paramssld2["ht_catalog_zoom_window_lens_size"] = "200";
        $paramssld2["ht_catalog_zoom_window_fadein"] = "200";
        $paramssld2["ht_catalog_zoom_window_fadeout"] = "200";
        $paramssld2["ht_catalog_zoom_lens_fadein"] = "200";
        $paramssld2["ht_catalog_zoom_lens_fadeout"] = "200";
        $paramssld2["ht_catalog_zoom_lens_hide"] = "false";
        $paramssld2["ht_catalog_zoom_lens_shape"] = "square";
        $paramssld2["ht_catalog_zoom_lens_color"] = "fff";
        $paramssld2["ht_catalog_zoom_lens_opacity"] = "40";
        $paramssld2["ht_catalog_zoom_cursor"] = "crosshair";
        $paramssld2["ht_catalog_zoom_scrollzoom"] = "true";
        $paramssld2["ht_catalog_zoom_easing"] = "true";
        $paramssld2["ht_catalog_zoom_lens_size_fix"] = "false";
        $paramssld2["ht_catalog_zoom_lens_height"] = "100";
        $paramssld2["ht_catalog_zoom_lens_width"] = "100";
        $paramssld2["ht_catalog_zoom_tint"] = "false";
        $paramssld2["ht_catalog_zoom_tint_colour"] = "#fff";
        $paramssld2["ht_catalog_zoom_tint_opacity"] = "40";
        $paramssld2["ht_catalog_zoom_tint_fadein"] = "200";
        $paramssld2["ht_catalog_zoom_tint_fadeout"] = "200";
        $paramssld2['ht_catalog_zoom_lens_hide'] = "false";
        $paramssld2["ht_view3_allow_lightbox"] = "on";
        $paramssld2["ht_catalog_zoom_thumbs_zoom"] = "off";
        $paramssld2["ht_view3_allow_zooming"] = "on";
        $paramssld["ht_view0_allow_zooming"] = "off";
        $paramssld["ht_view0_allow_lightbox"] = "on";
        $paramssld["ht_view1_allow_zooming"] = "on";
        $paramssld["ht_view1_allow_lightbox"] = "on";
        $paramssld["ht_view2_allow_zooming"] = "off";
        $paramssld["ht_view2_allow_lightbox"] = "on";
        $paramssld["ht_view5_allow_zooming"] = "on";
        $paramssld["ht_view5_allow_lightbox"] = "off";
        $paramssld["ht_single_product_show_asc_seller_button"] = "on";
        $paramssld["ht_single_product_asc_seller_button_text"] = "Contact Seller";
        $paramssld["ht_single_product_asc_seller_button_text_size"] = "18";
        $paramssld["ht_single_product_asc_seller_button_text_color"] = "ffffff";
        $paramssld["ht_single_product_asc_seller_button_text_hover_color"] = "ffffff";
        $paramssld["ht_single_product_asc_seller_button_background_color"] = "E22828";
        $paramssld["ht_single_product_asc_seller_button_background_hover_color"] = "E22828";
        $paramssld["ht_single_product_asc_to_seller_text"] = "Asc Seller";
        $paramssld["ht_single_product_asc_seller_popup_background_1"] = "ffffff";
        $paramssld["ht_single_product_asc_seller_popup_background_2"] = "ffffff";
        $paramssld["ht_single_product_your_mail_text"] = "Your E-mail";
        $paramssld["ht_single_product_your_phone_text"] = "Your Phone";
        $paramssld["ht_single_product_your_message_text"] = "Your Message";
        $paramssld["ht_single_product_asc_seller_popup_button_text"] = "Submit";
        $paramssld["ht_single_product_asc_seller_popup_button_text_size"] = "19";
        $paramssld["ht_single_product_asc_seller_popup_button_text_color"] = "fff";
        $paramssld["ht_single_product_asc_seller_popup_button_background_color"] = "E22828";
        $paramssld["ht_single_product_asc_seller_popup_button_background_hover_color"] = "C52323";
        $paramssld["ht_single_product_asc_seller_popup_close_style"] = "dark";
		$paramssld["ht_single_product_asc_seller_button_position"] = "left";
        $paramssld["ht_single_product_asc_seller_button_border_radius"] = "5";
        
        
        $paramssld["htc_view0_load_more_position"] = "center";
        $paramssld["htc_view1_load_more_position"] = "center";
        $paramssld["htc_view2_load_more_position"] = "center";
        $paramssld["htc_view3_load_more_position"] = "center";
        $paramssld["htc_view0_load_more_font_size"] = "18";
        $paramssld["htc_view1_load_more_font_size"] = "18";
        $paramssld["htc_view2_load_more_font_size"] = "22";
        $paramssld["htc_view3_load_more_font_size"] = "20";
        $paramssld["htc_view0_load_more_font_color"] = "F2F2F2";
        $paramssld["htc_view1_load_more_font_color"] = "F2F2F2";
        $paramssld["htc_view2_load_more_font_color"] = "F2F2F2";
        $paramssld["htc_view3_load_more_font_color"] = "F2F2F2";
        $paramssld["htc_view0_load_more_font_hover_color"] = "F2F2F2";
        $paramssld["htc_view1_load_more_font_hover_color"] = "F2F2F2";
        $paramssld["htc_view2_load_more_font_hover_color"] = "F2F2F2";
        $paramssld["htc_view3_load_more_font_hover_color"] = "FFFFFF";
        $paramssld["htc_view0_load_more_button_background_color"] = "A1A1A1";
        $paramssld["htc_view1_load_more_button_background_color"] = "A1A1A1";
        $paramssld["htc_view2_load_more_button_background_color"] = "FF2C2C";
        $paramssld["htc_view3_load_more_button_background_color"] = "A1A1A1";
        $paramssld["htc_view0_load_more_button_background_hover_color"] = "A1A1A1";
        $paramssld["htc_view1_load_more_button_background_hover_color"] = "A1A1A1";
        $paramssld["htc_view2_load_more_button_background_hover_color"] = "991A1A";
        $paramssld["htc_view3_load_more_button_background_hover_color"] = "A1A1A1";
        $paramssld["htc_view0_load_more_loading_icon"] = "1";
        $paramssld["htc_view1_load_more_loading_icon"] = "1";
        $paramssld["htc_view2_load_more_loading_icon"] = "1";
        $paramssld["htc_view3_load_more_loading_icon"] = "1";
        
        $paramssld["htc_view0_pagination_font_size"] = "22";
        $paramssld["htc_view1_pagination_font_size"] = "22";
        $paramssld["htc_view2_pagination_font_size"] = "22";
        $paramssld["htc_view3_pagination_font_size"] = "22";
        $paramssld["htc_view0_pagination_font_color"] = "000";
        $paramssld["htc_view1_pagination_font_color"] = "000";
        $paramssld["htc_view2_pagination_font_color"] = "000";
        $paramssld["htc_view3_pagination_font_color"] = "000";
        $paramssld["htc_view0_pagination_icon_size"] = "22";
        $paramssld["htc_view1_pagination_icon_size"] = "22";
        $paramssld["htc_view2_pagination_icon_size"] = "22";
        $paramssld["htc_view3_pagination_icon_size"] = "22";
        $paramssld["htc_view0_pagination_icon_color"] = "000";
        $paramssld["htc_view1_pagination_icon_color"] = "000";
        $paramssld["htc_view2_pagination_icon_color"] = "000";
        $paramssld["htc_view3_pagination_icon_color"] = "000";
        $paramssld["htc_view0_pagination_position"] = "center";
        $paramssld["htc_view1_pagination_position"] = "center";
        $paramssld["htc_view2_pagination_position"] = "center";
        $paramssld["htc_view3_pagination_position"] = "center";
    
        $paramssld["ht_single_product_asc_to_seller_input_border_size"]  = "1";
        $paramssld["ht_single_product_asc_to_seller_text_font_size"]     = "26";
        $paramssld["ht_single_product_asc_to_seller_text_font_color"]    = "D91A1A";
        $paramssld["ht_single_product_asc_to_seller_input_border_color"] = "B3B3B3";
        
    if ( is_plugin_active( 'product-catalog-releated-products/product-catalog-releated-products.php' ) ){  }
    else{

        if ($paramssld4==null) $paramssld4=array();

        $paramssld4['ht_catalog_related_products_show'] = "off";
        $paramssld4['ht_catalog_related_products_visible_count'] = "4";
        $paramssld4['ht_catalog_related_products_vertical'] = "false";
        $paramssld4['ht_catalog_related_products_start'] = "1";
        $paramssld4['ht_catalog_related_products_circular'] = "true";
        $paramssld4['ht_catalog_related_products_autoplay'] = "off";
        $paramssld4['ht_catalog_related_products_show_arrows'] = "on";
        $paramssld4['ht_catalog_related_products_delay'] = "1000";
        $paramssld4['ht_catalog_related_products_changing_speed'] = "1000";
        $paramssld4['ht_catalog_related_products_direction_reverse'] = "off";
        $paramssld4['ht_catalog_related_products_position'] = "bottom";
        $paramssld4['ht_catalog_related_products_pause_on_hover'] = "off";
        $paramssld4['ht_catalog_related_products_vertical_elem_height'] = "105";
        $paramssld4['ht_catalog_related_products_vertical_elem_width'] = "250";
        $paramssld4['ht_catalog_related_products_vertical_caption_width'] = "50";
        $paramssld4['ht_catalog_related_products_horizontal_elem_width'] = "190";
        $paramssld4['ht_catalog_related_products_horizontal_elem_height'] = "143";
        $paramssld4['ht_catalog_related_products_horizontal_border_size'] = "1";
        $paramssld4['ht_catalog_related_products_horizontal_border_color'] = "c0c0c0";
        $paramssld4['ht_catalog_related_products_vertical_border_size'] = "1";
        $paramssld4['ht_catalog_related_products_vertical_border_color'] = "c0c0c0";
        $paramssld4['ht_catalog_related_products_vertical_font_size'] = "17";
        $paramssld4['ht_catalog_related_products_vertical_font_color'] = "c0c0c0";
        $paramssld4['ht_catalog_related_products_horizontal_font_size'] = "17";
        $paramssld4['ht_catalog_related_products_horizontal_font_color'] = "c0c0c0";
        $paramssld4['ht_catalog_related_products_autoplay_speed'] = "2000";
        $paramssld4['ht_catalog_related_products_horizontal_caption_height'] = "105";
//        var_dump($paramssld4);exit;
    }
        
//        exit;
        
?>

<script>
	var allowZooming = '<?php echo $paramssld['ht_single_product_allow_zooming'];?>';
	var allowLightbox = '<?php echo $paramssld['ht_single_product_allow_lightbox'];?>';
        
        var view_num = 0;
        
	if(allowZooming == "on"){
		var for_zoom;
		if("<?php echo $paramssld2['ht_catalog_zoom_thumbs_zoom']; ?>" == "on"){
			for_zoom = ".for_zoom img, .thumbs-block img";
		}
		else if("<?php echo $paramssld2['ht_catalog_zoom_thumbs_zoom']; ?>" == "off"){
			for_zoom = ".for_zoom img";
		}
//            var catalogThumbsZoom = "<?php echo $paramssld2['ht_catalog_zoom_thumbs_zoom'];?>";
		var catalogZoomType = "<?php echo $paramssld2['ht_catalog_zoom_window_type'];?>";
		var catalogWindowWidth = <?php echo $paramssld2['ht_catalog_zoom_window_width'];?>;
		var catalogWindowHeight = <?php echo $paramssld2['ht_catalog_zoom_window_height'];?>;
		var catalogWindowOffetx = <?php echo $paramssld2['ht_catalog_zoom_x_asis'];?>;
		var catalogWindowOffety = <?php echo $paramssld2['ht_catalog_zoom_y_asis'];?>;
		var catalogWindowPosition = <?php echo $paramssld2['ht_catalog_zoom_window_position'];?>;
		var catalogBorderSize = <?php echo $paramssld2['ht_catalog_zoom_window_border_size'];?>;
		var catalogBorderColour = "<?php echo $paramssld2['ht_catalog_zoom_window_border_color'];?>";
		var catalogWindowFadeIn = <?php echo $paramssld2['ht_catalog_zoom_window_fadein'];?>;
		var catalogWindowFadeOut = <?php echo $paramssld2['ht_catalog_zoom_window_fadeout'];?>;
		var catalogLensSize = <?php echo $paramssld2['ht_catalog_zoom_window_lens_size'];?>;

		var catalogLensFadeIn = <?php echo $paramssld2['ht_catalog_zoom_lens_fadein'];?>;
		var catalogLensFadeOut = <?php echo $paramssld2['ht_catalog_zoom_lens_fadeout'];?>;
		var catalogZoomLens = <?php echo $paramssld2['ht_catalog_zoom_lens_hide'];?>;
		var catalogLensShape = "<?php echo $paramssld2['ht_catalog_zoom_lens_shape'];?>";
		var catalogLensColour = "<?php echo $paramssld2['ht_catalog_zoom_lens_color'];?>";
		var catalogLensOpacity = <?php echo $paramssld2['ht_catalog_zoom_lens_opacity'];?>/100;
		var catalogCursor = "<?php echo $paramssld2['ht_catalog_zoom_cursor'];?>";
         if(catalogZoomType != "inner") { var catalogScrollZoom = <?php echo $paramssld2['ht_catalog_zoom_scrollzoom'];?>; }
         else{ var catalogScrollZoom = false; }
                                                          
		var catalogEasing = <?php echo $paramssld2['ht_catalog_zoom_easing'];?>;

		var catalogTint = <?php echo $paramssld2['ht_catalog_zoom_tint'];?>;
		var catalogTintColour = "<?php echo $paramssld2['ht_catalog_zoom_tint_colour'];?>";
		var catalogTintOpacity = <?php echo $paramssld2['ht_catalog_zoom_tint_opacity'];?>/100;
		var catalogZoomTintFadeIn = <?php echo $paramssld2['ht_catalog_zoom_tint_fadein'];?>;
		var catalogZoomTintFadeOut = <?php echo $paramssld2['ht_catalog_zoom_tint_fadeout'];?>;

		var catalogGallery = null;
	}
	if(allowLightbox == "on"){
		var lightbox_transition = '<?php echo $paramssld2['light_box_transition'];?>';
		var lightbox_speed = <?php echo $paramssld2['light_box_speed'];?>;
		var lightbox_fadeOut = <?php echo $paramssld2['light_box_fadeout'];?>;
		var lightbox_title = <?php echo $paramssld2['light_box_title'];?>;
		var lightbox_scalePhotos = <?php echo $paramssld2['light_box_scalephotos'];?>;
		var lightbox_scrolling = <?php echo $paramssld2['light_box_scrolling'];?>;
		var lightbox_opacity = <?php echo ($paramssld2['light_box_opacity']/100)+0.001;?>;
		var lightbox_open = <?php echo $paramssld2['light_box_open'];?>;
		var lightbox_returnFocus = <?php echo $paramssld2['light_box_returnfocus'];?>;
		var lightbox_trapFocus = <?php echo $paramssld2['light_box_trapfocus'];?>;
		var lightbox_fastIframe = <?php echo $paramssld2['light_box_fastiframe'];?>;
		var lightbox_preloading = <?php echo $paramssld2['light_box_preloading'];?>;
		var lightbox_overlayClose = <?php echo $paramssld2['light_box_overlayclose'];?>;
		var lightbox_escKey = <?php echo $paramssld2['light_box_esckey'];?>;
		var lightbox_arrowKey = <?php echo $paramssld2['light_box_arrowkey'];?>;
		var lightbox_loop = <?php echo $paramssld2['light_box_loop'];?>;
		var lightbox_closeButton = <?php echo $paramssld2['light_box_closebutton'];?>;
		var lightbox_previous = "<?php echo $paramssld2['light_box_previous'];?>";
		var lightbox_next = "<?php echo $paramssld2['light_box_next'];?>";
		var lightbox_close = "<?php echo $paramssld2['light_box_close'];?>";
		var lightbox_html = <?php echo $paramssld2['light_box_html'];?>;
		var lightbox_photo = <?php echo $paramssld2['light_box_photo'];?>;
		var lightbox_width = '<?php if($paramssld2['light_box_size_fix'] == 'false'){ echo 'false';} else { echo $paramssld2['light_box_width']; } ?>';
		var lightbox_height = '<?php if($paramssld2['light_box_size_fix'] == 'false'){ echo 'false';} else { echo $paramssld2['light_box_height']; } ?>';
		var lightbox_innerWidth = '<?php echo $paramssld2['light_box_innerwidth'];?>';
		var lightbox_innerHeight = '<?php echo $paramssld2['light_box_innerheight'];?>';
		var lightbox_initialWidth = '<?php echo $paramssld2['light_box_initialwidth'];?>';
		var lightbox_initialHeight = '<?php echo $paramssld2['light_box_initialheight'];?>';

		var maxwidth=jQuery(window).width();
		if(maxwidth><?php echo $paramssld2['light_box_maxwidth'];?>){ maxwidth=<?php echo $paramssld2['light_box_maxwidth'];?>; }
		var lightbox_maxWidth = <?php if($paramssld2['light_box_size_fix'] == 'true'){ echo '"100%"';} else { echo 'maxwidth'; } ?>;
		var lightbox_maxHeight = <?php if($paramssld2['light_box_size_fix'] == 'true'){ echo '"100%"';} else { echo $paramssld2['light_box_maxheight']; } ?>;

		var lightbox_slideshow = <?php echo $paramssld2['light_box_slideshow'];?>;
		var lightbox_slideshowSpeed = <?php echo $paramssld2['light_box_slideshowspeed'];?>;
		var lightbox_slideshowAuto = <?php echo $paramssld2['light_box_slideshowauto'];?>;
		var lightbox_slideshowStart = "<?php echo $paramssld2['light_box_slideshowstart'];?>";
		var lightbox_slideshowStop = "<?php echo $paramssld2['light_box_slideshowstop'];?>";
		var lightbox_fixed = <?php echo $paramssld2['light_box_fixed'];?>;
		
		<?php
		$pos = $paramssld2['slider_title_position'];
		switch($pos){ 
			case 1:
			?>
				var lightbox_top = '10%';
				var lightbox_bottom = false;
				var lightbox_left = '10%';
				var lightbox_right = false;
			<?php
			break;	
			case 1:
			?>
				var lightbox_top = '10%';
				var lightbox_bottom = false;
				var lightbox_left = '10%';
				var lightbox_right = false;
			<?php
			break;	
			case 2:
			?>
				var lightbox_top = '10%';
				var lightbox_bottom = false;
				var lightbox_left = false;
				var lightbox_right = false;
			<?php
			break;	
			case 3:
			?>
				var lightbox_top = '10%';
				var lightbox_bottom = false;
				var lightbox_left = false;
				var lightbox_right = '10%';
			<?php
			break;
			case 4:
			?>
				var lightbox_top = false;
				var lightbox_bottom = false;
				var lightbox_left = '10%';
				var lightbox_right = false;
			<?php
			break;	
			case 5:
			?>
				var lightbox_top = false;
				var lightbox_bottom = false;
				var lightbox_left = false;
				var lightbox_right = false;
			<?php
			break;	
			case 6:
			?>
				var lightbox_top = false;
				var lightbox_bottom = false;
				var lightbox_left = false;
				var lightbox_right = '10%';
			<?php
			break;	
			case 7:
			?>
				var lightbox_top = false;
				var lightbox_bottom = '10%';
				var lightbox_left = '10%';
				var lightbox_right = false;
			<?php
			break;	
			case 8:
			?>
				var lightbox_top = false;
				var lightbox_bottom = '10%';
				var lightbox_left = false;
				var lightbox_right = false;
			<?php
			break;	
			case 9:
			?>
				var lightbox_top = false;
				var lightbox_bottom = '10%';
				var lightbox_left = false;
				var lightbox_right = '10%';
			<?php
			break;	
		} ?>
		
		var lightbox_reposition = <?php echo $paramssld2['light_box_reposition'];?>;
		var lightbox_retinaImage = <?php echo $paramssld2['light_box_retinaimage'];?>;
		var lightbox_retinaUrl = <?php echo $paramssld2['light_box_retinaurl'];?>;
		var lightbox_retinaSuffix = "<?php echo $paramssld2['light_box_retinasuffix'];?>";

			jQuery(document).ready(function(){
								
            jQuery(".catalog_single_product_group_<?php echo $productArray->id; ?>").ccolorbox({rel:'catalog_single_product_group_<?php echo $productArray->id; ?>'});

			jQuery(".callbacks").ccolorbox({
				onOpen:function(){ alert('onOpen: ccolorbox is about to open'); },
				onLoad:function(){ alert('onLoad: ccolorbox has started to load the targeted content'); },
				onComplete:function(){ alert('onComplete: ccolorbox has displayed the loaded content'); },
				onCleanup:function(){ alert('onCleanup: ccolorbox has begun the close process'); },
				onClosed:function(){ alert('onClosed: ccolorbox has completely closed'); }
			});

			jQuery('.non-retina').ccolorbox({rel:'group5', transition:'none'})
			jQuery('.retina').ccolorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
			

			jQuery("#click").click(function(){ 
				jQuery('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
				return false;
			});
		});
	}
                
        
                        /*    <-- Related Products    */
                        
        var related_products_show           = "<?php echo $paramssld4['ht_catalog_related_products_show'];           ?>";
        var related_products_visible_count  = <?php  echo $paramssld4['ht_catalog_related_products_visible_count'];  ?>;
        var related_products_circular       = <?php  echo $paramssld4['ht_catalog_related_products_circular'];       ?>;
        var related_products_autoplay       = "<?php echo $paramssld4['ht_catalog_related_products_autoplay'];       ?>";
        var related_products_autoplay_speed = <?php  echo $paramssld4['ht_catalog_related_products_autoplay_speed']; ?>;
        var related_products_start          = <?php  echo $paramssld4['ht_catalog_related_products_start'] - 1;      ?>;
        var related_products_changing_speed = <?php  echo $paramssld4['ht_catalog_related_products_changing_speed']; ?>;
        var related_products_pause_on_hover = "<?php  echo $paramssld4['ht_catalog_related_products_pause_on_hover']; ?>";
//        var related_products_vertical       = <?php  echo $paramssld4['ht_catalog_related_products_vertical']; ?>;
        var vertical_carousel_li_height     = <?php  echo $paramssld4['ht_catalog_related_products_vertical_elem_height']; ?>;
        
                                /*    Related Products -->    */
        
</script>

<?php
    

    if($paramssld4['ht_catalog_related_products_autoplay'] == "on"){ $autoplay_speed = $paramssld4['ht_catalog_related_products_autoplay_speed']; } else { $autoplay_speed = 0; }
    if($paramssld4['ht_catalog_related_products_position'] == "left" || $paramssld4['ht_catalog_related_products_position'] == "right"){
        $paramssld4['ht_catalog_related_products_vertical'] = "true"; $carousel_vertical = "vertical"; $fullWithProducts = "false";
    }
    else { $paramssld4['ht_catalog_related_products_vertical'] = "false"; $carousel_vertical = "responsive"; $fullWithProducts = "true"; }
?>

	<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
	<link href="<?php echo plugins_url('../style/colorbox-'.$paramssld2['light_box_style'].'.css', __FILE__);?>" rel="stylesheet" type="text/css" />
		
	<?php
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( !(is_plugin_active( 'wp-lightbox-2/wp-lightbox-2.php' ) )) { ?>

	<?php } ?>
                
<style type="text/css">
<?php // if($paramssld2["ht_catalog_zoom_lens_size_fix"] == "true") { ?>

/*.zoomLens {
    width: <?php echo $paramssld2["ht_catalog_zoom_lens_width"]; ?>px !important;
    height: <?php echo $paramssld2["ht_catalog_zoom_lens_height"]; ?>px !important;
}*/

.zoomContainer {
    z-index: 10;
}

<?php // } ?>
.huge_it_catalog_single_product_page li{list-style:none !important;}
.huge_it_catalog_single_product_page {
	position: relative;
	<?php
            if($paramssld4['ht_catalog_related_products_show'] == "on" && $paramssld4['ht_catalog_related_products_position'] == "left"){ ?>
                float: left;
                width: -moz-calc(94% - <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width']; ?>px) !important;
                width: -webkit-calc(94% - <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width']; ?>px)  !important;
                width: calc(94% - <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width']; ?>px) !important;
                width: -o-calc(94% - <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width']; ?>px) !important;
                width: -ms-calc(94% - <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width']; ?>px) !important;
                margin-left: 2% !important;
      <?php }
      else{
          if($paramssld4['ht_catalog_related_products_show'] == "on" && $paramssld4['ht_catalog_related_products_position'] == "right"){ ?>
              float: right;
              width: -moz-calc(94% - <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width']; ?>px) !important;
              width: -webkit-calc(94% - <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width']; ?>px) !important;
              width: calc(94% - <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width']; ?>px) !important;
              width: -o-calc(94% - <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width']; ?>px) !important;
              width: -ms-calc(94% - <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width']; ?>px) !important;
              margin-right: 2% !important;
    <?php }
          else{ ?>
                width: 96% !important;
      <?php }
      }
      ?> 
	margin:5px 0px 5px 0px;
	padding:2%;
	/*clear:both;*/
	overflow: hidden;
	/*border:<?php echo $paramssld['ht_single_product_border_width']; ?>px solid #<?php echo $paramssld['ht_single_product_border_color']; ?>;*/
	background:#<?php echo $paramssld['ht_single_product_background_color']; ?>;
}

.huge_it_catalog_single_product_page div.left-block {
	position:relative;
	float:left;
	width:40%;
}

.huge_it_catalog_single_product_page div.left-block .main-image-block {
	clear:both;
	width:<?php echo $paramssld['ht_single_product_mainimage_width']; ?>px; 
}

.for_zoom {
	max-width:100% !important;
}

.huge_it_catalog_single_product_page div.left-block .main-image-block img {
	margin:0px !important;
	padding:0px !important;
	width:<?php echo $paramssld['ht_single_product_mainimage_width']; ?>px !important; 
	height:auto;
}

.huge_it_catalog_single_product_page div.left-block .thumbs-block {
	position:relative;
	margin-top:10px;
}

.huge_it_catalog_single_product_page div.left-block .thumbs-block ul {
	width:100%; 
	height:auto;
	display:table;
	margin:0px;
	padding:0px;
	list-style:none;
}

.huge_it_catalog_single_product_page div.left-block .thumbs-block ul li {
	margin: 3px;
	padding:0px;
	width:<?php echo $paramssld['ht_single_product_thumbs_width']; ?>px; 
	height:<?php echo $paramssld['ht_single_product_thumbs_height']; ?>px !important; 
	float:left;
}

.huge_it_catalog_single_product_page div.left-block .thumbs-block ul li a {
	display:block;
	width:<?php echo $paramssld['ht_single_product_thumbs_width']; ?>px; 
	height:<?php echo $paramssld['ht_single_product_thumbs_height']; ?>px; 
}

.huge_it_catalog_single_product_page div.left-block .thumbs-block ul li a img {
	margin:0px !important;
	padding:0px !important;
	width:<?php echo $paramssld['ht_single_product_thumbs_width']; ?>px; 
	height:<?php echo $paramssld['ht_single_product_thumbs_height']; ?>px !important; 
}


/*######RIGHT BLOCK########*/

.huge_it_catalog_single_product_page .rating-and-share-blocks {
	font-size:<?php echo $paramssld['ht_single_product_rating_font_size']; ?>px !important;
	color:#<?php echo $paramssld['ht_single_product_rating_font_color']; ?> !important;
        background: none !important;;
        /*padding-bottom: 2% !important;*/
}

.huge_it_catalog_single_product_page div.right-block {
	position:relative;
	float:left;
	width:58%;
	padding-left:2%;
}

.huge_it_catalog_single_product_page div.right-block > div {
	padding:3px 0px 3px 0px;
	<?php if($paramssld['ht_single_product_show_separator_lines']=="on") {?>
		background:url('<?php echo  plugins_url( '../images/divider.line.png' , __FILE__ ); ?>') center bottom repeat-x;
	<?php } ?>	
}

.huge_it_catalog_single_product_page div.right-block > div p {
	margin:0px;
        padding: 4px 0px 12px 0px;
        font-size: initial;
}

.huge_it_catalog_single_product_page div.right-block > div:last-child {
    display: block;
    width: 100%;
	background:none !important;
}

.huge_it_catalog_single_product_page div.right-block .title-block  {
	margin-top:3px;
}

.huge_it_catalog_single_product_page div.right-block .title-block h2 {
	margin:-10px 0px 0px 0px;
	padding:0px;
	font-weight:normal;
	font-size:<?php echo $paramssld['ht_single_product_title_font_size']; ?>px !important;
	line-height:<?php echo $paramssld['ht_single_product_title_font_size']+4; ?>px !important;
	color:#404040;
}

.huge_it_catalog_single_product_page .price-block {
	margin:0px;
	padding:10px 0px 5px 0px !important;
	font-weight:normal;
	font-size:<?php echo $paramssld['ht_single_product_price_font_size']; ?>px;
	color:#<?php echo $paramssld['ht_single_product_price_font_color']; ?>;
}

.huge_it_catalog_single_product_page .price-block .old-price {
	text-decoration:line-through;
	margin:0px;
	padding:0px;
	font-weight:normal;
	font-size:<?php echo $paramssld['ht_single_product_price_font_size']; ?>px;
	padding:7px 10px 7px 10px;
	margin:0px 10px 0px 0px;
	border-radius:3px;
	color:#<?php echo $paramssld['ht_single_product_background_color']; ?>;
	background:#<?php echo $paramssld['ht_single_product_price_font_color']; ?>;
}



.huge_it_catalog_single_product_page div.right-block .description-block p,.huge_it_catalog_single_product_page div.right-block .description-block {
	margin:0px;
	padding:0px;
	font-weight:normal;
	font-size:<?php echo $paramssld['ht_single_product_description_font_size']; ?>px;
	color:#<?php echo $paramssld['ht_single_product_description_font_color']; ?>;
}


.huge_it_catalog_single_product_page div.right-block .description-block h1,
.huge_it_catalog_single_product_page div.right-block .description-block h2,
.huge_it_catalog_single_product_page div.right-block .description-block h3,
.huge_it_catalog_single_product_page div.right-block .description-block h4,
.huge_it_catalog_single_product_page div.right-block .description-block h5,
.huge_it_catalog_single_product_page div.right-block .description-block h6,
.huge_it_catalog_single_product_page div.right-block .description-block p, 
.huge_it_catalog_single_product_page div.right-block .description-block strong,
.huge_it_catalog_single_product_page div.right-block .description-block span {
	padding:2px !important;
	margin:0px !important;
}

.huge_it_catalog_single_product_page div.right-block .description-block ul,
.huge_it_catalog_single_product_page div.right-block .description-block li {
	padding:2px 0px 2px 5px;
	margin:0px 0px 0px 8px;
}



.huge_it_catalog_single_product_page .rating-block {
	margin:0px 10px 0px 0px;
	padding:0px;
	font-weight:normal;
	float:left;
        padding: 2% 0px;
}

.huge_it_catalog_single_product_page .rating-block .label {
	display: block;
	float:left;
	line-height:15px;
	margin-right: 5px;
}


.huge_it_catalog_single_product_page .right-block .rating-block ul.rating-stars  {
	background-image:url(<?php echo plugins_url('../images/stars.png', __FILE__); ?>);
	background-repeat: no-repeat;
	background-position: 0px <?php if($rating != 0) echo $rating * (-15); else echo 0; ?>px;
	line-height: 15px;
        height: 15px;
	width: 100px;
	display: table;
	margin: 0px !important;
        padding: 0px !important;
}

.huge_it_catalog_single_product_page .right-block .rating-stars li {
    float: left;
    list-style: none;
    height: 15px;
    width: 19px;
    margin: 0px !important;
    padding: 0px !important;
	
}

.huge_it_catalog_single_product_page .right-block .rating-stars li input[type='radio'] {
    display: block;
    opacity: 0;
    height: 19px;
    width: 16px;
    margin: 0px !important;
    padding: 0px !important;
    cursor:pointer;
}


.huge_it_catalog_single_product_page .right-block .share_buttons_block {
        padding: 0px;
        font-weight: normal;
        float: left;
        padding: 2% 0px;
        height: auto;

}

.huge_it_catalog_single_product_page .right-block .share_buttons_block .label {
	display: block;
        float: left;
        line-height: 15px;
        margin-right: 6px;
        margin-top: 3%;

}

.huge_it_catalog_single_product_page .right-block .share_buttons_block ul {
	display: table;
        margin: 0px 0px 0px 40px !important;
        padding: 0px !important;
        list-style: none !important;
        height: auto;

}

.huge_it_catalog_single_product_page .right-block .share_buttons_block ul li {
	float:left;
	margin:6px 3px 0px 3px;
        padding: 0;
	background: none;
	list-style: none;

}

.huge_it_catalog_single_product_page .right-block .share_buttons_block ul li a {
        border:none;
	display:block;
	width: 75px !important;
	height: 26px !important;
        padding: 0 !important;
        margin: 0 !important;
	cursor:pointer;
	text-indent:-9999px !important;
	background-image:url('<?php echo  plugins_url( '../images/share.buttons.png', __FILE__ ); ?>');

}

.huge_it_catalog_single_product_page .right-block .share_buttons_block ul li.facebook a:hover {
    background-position: 0 -28px;

}

.huge_it_catalog_single_product_page .right-block .share_buttons_block ul li.pinterest a:hover {
    background-position: -164px -28px;

}

.huge_it_catalog_single_product_page .right-block .share_buttons_block ul li.twitter a:hover{
	background-position: -82px -28px;

}

.huge_it_catalog_single_product_page .right-block .share_buttons_block ul li.google_plus a:hover{
	background-position: -246px -28px;

}

.huge_it_catalog_single_product_page .right-block .share_buttons_block ul li.facebook a {background-position:left top; }

.huge_it_catalog_single_product_page .right-block .share_buttons_block ul li.twitter a {background-position:-82px top;}

.huge_it_catalog_single_product_page .right-block .share_buttons_block ul li.pinterest a {background-position:-164px top;}

.huge_it_catalog_single_product_page .right-block .share_buttons_block ul li.google_plus a {background-position:-246px top; }



.huge_it_catalog_single_product_page .order_button {

    margin: 3px 0 5px 0;

}
.huge_it_catalog_single_product_page .contact-seller-block{
	text-align: left;
}
.huge_it_catalog_single_product_page .order_button {
  display: inline-block;
  /*width: 100%;*/
  text-decoration: none;
  font-weight: bold;
  margin: 0px;
  padding: 0px;
  font-size: <?php echo $paramssld['ht_single_product_asc_seller_button_text_size']; ?>px;
  border: none;
  padding: 7px 10px 7px 10px;
  border-radius: <?php echo $paramssld['ht_single_product_asc_seller_button_border_radius']; ?>px;
  color: #<?php echo $paramssld['ht_single_product_asc_seller_button_text_color']; ?>;
  background: #<?php echo $paramssld['ht_single_product_asc_seller_button_background_color']; ?>;
}

.huge_it_catalog_single_product_page .order_button:hover {
  color: #<?php echo $paramssld['ht_single_product_asc_seller_button_text_hover_color']; ?>;
  background: #<?php echo $paramssld['ht_single_product_asc_seller_button_background_hover_color']; ?>;
}



/*###NAYAC CHI###*/

#huge_it_catalog_content_<?php echo $productArray->id; ?> a{
	box-shadow: none;
}

#catalog-order-popup-1 label {
    display: block;
    padding: 6px 0px;
    overflow: hidden;
}
   
#catalog-order-popup-1 input, #catalog-order-popup-1 textarea {
    display: block;
    width: 100%;
    margin: 6px 0px 0px 0px;
    padding: 6px 0px;
    padding-left: 5px;
    font-size: initial;
    border: <?php echo $paramssld['ht_single_product_asc_to_seller_input_border_size']; ?>px solid #<?php echo $paramssld['ht_single_product_asc_to_seller_input_border_color']; ?>;
}

#catalog-order-popup-1 input::-webkit-input-placeholder, #catalog-order-popup-1 textarea::-webkit-input-placeholder { color: #666666; }
#catalog-order-popup-1 input:-moz-placeholder , #catalog-order-popup-1 textarea:-moz-placeholder { color: #666666; }
#catalog-order-popup-1 input::-moz-placeholder, #catalog-order-popup-1 textarea::-moz-placeholder { color: #666666; }
#catalog-order-popup-1 input:-ms-input-placeholder, #catalog-order-popup-1 textarea:-ms-input-placeholder { color: #666666; }

#catalog-order-popup-1 textarea{
    height: 120px;
}

.order_popup_submit_close{
    display: block;
    text-decoration: none;
    width:98%;
}
.order_popup_submit_close input{
    width: 100% !important;
}
#catalog-order-popup-1 #order_popup_submit {
    font-size: <?php echo $paramssld["ht_single_product_asc_seller_popup_button_text_size"]; ?>px !important;
    font-weight: bold;
    color: #<?php echo $paramssld["ht_single_product_asc_seller_popup_button_text_color"]; ?> !important;
    background: #<?php echo $paramssld["ht_single_product_asc_seller_popup_button_background_color"]; ?> !important;
    border: none;
    height: auto;
}

#catalog-order-popup-1 #order_popup_submit:hover {
    background: #<?php echo $paramssld["ht_single_product_asc_seller_popup_button_background_hover_color"]; ?> !important;
}

#catalog-order-popup-1 .empty::-webkit-input-placeholder { color: #E22828; }
     
.modalDialog {
	position: fixed;
	font-family: Arial, Helvetica, sans-serif;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background: rgba(0,0,0,0.5);
	z-index: 99999;
	opacity:0;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	pointer-events: none;
}
.modalDialog:target {
	opacity:1;
	pointer-events: auto;
}

.modalDialog > div {
	width: 400px;
	position: relative;
	margin: 10% auto;
	padding: 5px 20px 13px 20px;
	border-radius: 10px;
	background: #fff;
	background: -moz-linear-gradient(#<?php echo $paramssld["ht_single_product_asc_seller_popup_background_1"]; ?>, #<?php echo $paramssld["ht_single_product_asc_seller_popup_background_2"]; ?>);
	background: -webkit-linear-gradient(#<?php echo $paramssld["ht_single_product_asc_seller_popup_background_1"]; ?>, #<?php echo $paramssld["ht_single_product_asc_seller_popup_background_2"]; ?>);
	background: -o-linear-gradient(#<?php echo $paramssld["ht_single_product_asc_seller_popup_background_1"]; ?>, #<?php echo $paramssld["ht_single_product_asc_seller_popup_background_2"]; ?>);
}



.catalog-order-popup-close {
        line-height: 25px;
        position: absolute;
        right: 10px;
        text-align: center;
        top: 18px;
        width: 24px;
        text-decoration: none !important;
        border: none !important;
        /*font-weight: bold;*/
        font-size: 27px;
        color: #<?php if($paramssld["ht_single_product_asc_seller_popup_close_style"] == "dark"){ echo "000"; } else { echo "fff"; } ?> !important;
}

.catalog-order-popup-close:hover { color: #<?php if($paramssld["ht_single_product_asc_seller_popup_close_style"] == "dark"){ echo "000"; } else { echo "fff"; } ?> !important; }

#catalog-order-popup-1 h2 {
    font-size: <?php echo $paramssld["ht_single_product_asc_to_seller_text_font_size"]; ?>px !important;
    margin: 10px 0px;
    color: #<?php echo $paramssld["ht_single_product_asc_to_seller_text_font_color"]; ?>;
    display: inline-block;
    padding: 0;
}

.zoomContainer {
    z-index: 99999;
}
.huge-it-catalog-bottom-block {
	clear:both;
	padding-top:20px;
}


.huge_it_catalog_view_tabs {
	<?php if($paramssld["ht_single_product_show_parameters"] == 'on' && $paramssld["ht_single_product_show_comments"] == 'on')
      { ?>
          border-top: 1px solid #<?php echo $paramssld['ht_single_product_tabs_border_color']; ?>;
	<?php } ?>
	margin:0px 0px -1px 0px !important;
	padding:0px !important;
	position:relative;
	list-style:none;
	height:30px;
	clear:both;
}

.huge_it_catalog_view_tabs > li  {
	float:left;
	margin:0px 10px 0px 0px;
        list-style-type: none;
        background: none !important;
}

.huge_it_catalog_view_tabs  > li > a,.huge_it_catalog_view_tabs  > li > a:link,.huge_it_catalog_view_tabs  > li > a:visited {
	display:block;
	height:30px;
	border-bottom:0px;
	text-decoration:none;
	outline:none;
        color: #<?php echo $paramssld["ht_single_product_tabs_font_color"]; ?> !important;
                font-size: 16px;
        <?php if($paramssld["ht_single_product_show_parameters"] == 'on' && $paramssld["ht_single_product_show_comments"] == 'on')
              { ?>
                border: 1px solid #<?php echo $paramssld['ht_single_product_tabs_border_color']; ?>;
                               
        <?php } ?>
                padding:0px 10px !important;
}


.huge_it_catalog_view_tabs  > li > a:hover,.huge_it_catalog_view_tabs  > li > a:focus, .huge_it_catalog_view_tabs  > li > a:active {
	background:#<?php echo $paramssld['ht_single_product_background_color']; ?>;
}

.huge_it_catalog_view_tabs  > li.active > a {
	color: #fff !important;
	height:30px;
	margin:0px 0px -1px 0px !important;
	background: #<?php echo $paramssld['ht_single_product_asc_seller_button_background_color']; ?>;
	border-radius: 2px;
}

.huge_it_catalog_view_tabs_contents {
	margin:0px !important;
	padding:10px 0% 10px 0% !important;
	width:100%;
}

.huge_it_catalog_view_tabs_contents > li {
        margin-top: 1% !important;
	position:relative;
	width:100%;
	float:left;
	display:none;
}

.huge_it_catalog_view_tabs_contents > li.active  {
	display:block;
        margin-top: 10px !important;
}


.huge_it_catalog_view_tabs_contents > li .params-list {
	padding:0px !important;
	margin:0px !important;
	width:100%;
        font-size: 80%
}

.huge_it_catalog_view_tabs_contents > li .params-list li {
	float: left;
        display: block;
        width: 29%;
        height: 27px;
        margin: 0px 0% 10px 0px !important;
        padding: 3px 0px 0px 1% !important;
        background: #f9f7f7;
}

.huge_it_catalog_view_tabs_contents > li .params-list li.parameter-block {
		padding-left: 20px !important;
        text-align: left;
        font-size: 15px;
        overflow: hidden;
        text-overflow: ellipsis;
	color: #<?php echo $paramssld['ht_single_product_params_name_font_color']; ?>;
        /*line-height*/
}


.huge_it_catalog_view_tabs_contents > li .params-list li.value-block {
	padding-left: 20px !important;
	width:69%;
	background: #e2e2e2;
        color: #<?php echo $paramssld['ht_single_product_params_values_font_color']; ?>;
        font-size: 13px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
}

/*UNCHECKED*/

.huge_it_catalog_view_tabs_contents > li   div.has-background {background:#fff;}
.huge_it_catalog_view_tabs_contents > li   div.has-height > div {display:inline-block;}


.huge_it_catalog_view_tabs_contents > li  > div  h3 {
	display:block;
	text-align:center;
	margin:0px 0px 10px 0px;
}

.huge_it_catalog_view_tabs_contents > li  > div > div {
	position:relative;
	clear:both;
	width:100%;
	/*height:60px;*/
	padding:5px 0px 0px 0px;
	margin:0px !important;
}

.huge_it_catalog_view_tabs_contents .reviews-block .review p {
	margin: 0px 0px 10px 0px !important;
        padding: 0px !important;
        line-height: 20px !important;
}

.huge_it_catalog_view_tabs_contents .reviews-block .review p:first-child {
	color: #<?php echo $paramssld["ht_single_product_comments_name_font_color"];?>;
}

.huge_it_catalog_view_tabs_contents .reviews-block .review p:last-child {
	color: #<?php echo $paramssld["ht_single_product_comments_content_font_color"];?>;
        margin-top: 3% !important;
}

.huge_it_catalog_view_tabs_contents .reviews-block .review {
	margin: 0px 0px 10px 0 !important;
        padding: 0px !important;
        line-height: 20px !important;
        border-bottom: 1px solid #<?php echo $paramssld["ht_single_product_tabs_border_color"]; ?>;
}

.huge_it_catalog_view_tabs_contents > li  > div > div label {
	display:inline-block;
	width:60%;
	padding:5px 0px 0px 2%;
	height:30px;
	float:left;
}



.huge_it_catalog_view_tabs_contents > li  > div > div div.slider-container {
	position:relative;
	display: inline-block;
	width: 145px;
	margin-left:-5px;
}

.huge_it_catalog_view_tabs_contents > li  > div > div div.slider-container span {
	position:absolute;
	top:-3px;
	right:0px;
}

.huge_it_catalog_view_tabs_contents > li  > div > div input[type='text'],.huge_it_catalog_view_tabs_contents > li  > div > div select {
	width:100px;
}

.huge_it_catalog_view_tabs_contents > li  > div > div input[type='checkbox'] {
	margin:7px 0px 3px 0px;
}

.huge_it_catalog_view_tabs_contents > li  > div > div.bws_position_table input {
	margin:3px 17px 3px 3px;
}



.huge_it_catalog_view_tabs_contents > li  > div {
	position:relative;
	display:block;
	float:left;
	/*margin:10px 1% 25px 1%;*/
	/*padding:0px 1% 10px 0%;*/
	width: 100%;
	/*background:#f9f9f9;*/
}
.huge_it_catalog_view_tabs_contents > li   div.has-background {background:#fff;}
.huge_it_catalog_view_tabs_contents > li   div.has-height > div {display:inline-block;}


.huge_it_catalog_view_tabs_contents > li  > div  h2 {
	display:block;
	text-align:center;
	margin:0px 0px 10px 0px;
}

/*.huge_it_catalog_view_tabs_contents > li  > div > div {
	position:relative;
	clear:both;
	width:100%;
	height:35px;
	padding:5px 0px 0px 0px;
	margin:0px !important;
}*/

.huge_it_catalog_view_tabs_contents > li  > div > div label {
	display:inline-block;
	width:60%;
	padding:5px 0px 0px 2%;
	height:30px;
	float:left;
}


.huge_it_catalog_view_tabs_contents > li  > div > div div.slider-container {
	position:relative;
	display: inline-block;
	width: 145px;
	margin-left:-5px;
}

.huge_it_catalog_view_tabs_contents > li  > div > div div.slider-container span {
	position:absolute;
	top:-3px;
	right:0px;
}

.huge_it_catalog_view_tabs_contents > li  > div > div input[type='text'],.huge_it_catalog_view_tabs_contents > li  > div > div select {
	width:100px;
}

.huge_it_catalog_view_tabs_contents > li  > div > div input[type='checkbox'] {
	margin:7px 0px 3px 0px;
}

.huge_it_catalog_view_tabs_contents > li  > div > div.bws_position_table input {
	margin:3px 17px 3px 3px;
}

.huge_it_catalog_view_tabs_contents div {
	width: 100%;
}

.huge_it_catalog_view_tabs li a {
	color: #<?php echo $paramssld["ht_single_product_tabs_font_color"];?> !important;
      
}

.huge_it_catalog_view_tabs_contents .options-block > li:first-child {
	color: #<?php echo $paramssld["ht_single_product_params_tab_words_font_color"];?>;
        font-size: 15px;
        background-color: #<?php echo $paramssld["ht_single_product_background_color"];?>;
        overflow: hidden;
}

.huge_it_catalog_view_tabs_contents .options-block .review {
	display: inline;
}

.huge_it_catalog_view_tabs_contents .options-block li div ,.huge_it_catalog_view_tabs_contents .options-block li:last-child {
	color: #<?php echo $paramssld["ht_single_product_comments_tab_words_font_color"];?>;
        font-size: 15px;
/*        background-color: #<?php echo $paramssld["ht_single_product_background_color"];?>;*/
        /*overflow: hidden;*/
}

.huge_it_catalog_view_tabs_contents #catalog-view-options-1_<?php echo $productArray->id; ?> {
    
}

.huge_it_catalog_single_product_page .write-rate-block form {
    margin: 0;
    padding: 0;
}

.huge_it_catalog_single_product_page .write-rate-block p {
    margin: 0;
    padding: 0;
}

.huge_it_catalog_single_product_page .write-rate-block input, .huge_it_catalog_single_product_page .write-rate-block label {
	margin: 0%;
        margin-bottom: 10px;
        display: block;
        width: 100%;
}

.huge_it_catalog_single_product_page .write-rate-block input,.huge_it_catalog_single_product_page .write-rate-block textarea, .huge_it_catalog_single_product_page .write-rate-block label.rating-label {
	margin: 0%;
        display: block;
        width: 100%;
        padding: 6px 0px;
}

.huge_it_catalog_single_product_page .write-rate-block textarea {
    min-height: 100px;
    width: 100%;
}


.huge_it_catalog_single_product_page .write-rate-block #comments_submit {
    font-size: <?php echo $paramssld["ht_single_product_comments_submit_button_text_font_size"];?>px;
    color: #<?php echo $paramssld["ht_single_product_comments_submit_button_text_font_color"];?>;
    background: #<?php echo $paramssld["ht_single_product_comments_submit_button_text_background_color"];?>;
    background-color: #<?php echo $paramssld["ht_single_product_comments_submit_button_text_background_color"];?>;
    border: none;
    display: block;
    width: 100%;
}
.huge_it_catalog_single_product_page .write-rate-block #comments_submit:hover {
    color: #<?php echo $paramssld["ht_single_product_comments_submit_button_text_font_hover_color"];?>;
    background-color: #<?php echo $paramssld["ht_single_product_comments_submit_button_text_background_hover_olor"];?>;
    border: none;
}

.huge_it_catalog_single_product_page .write-rate-block .empty {
    border: 1px solid #ff0000;
}

/*
.huge_it_catalog_single_product_page .button-block {
	position:relative;
}

.huge_it_catalog_single_product_page div.right-block .button-block a,.huge_it_catalog_single_product_page div.right-block .button-block a:link,.huge_it_catalog_single_product_page div.right-block .button-block a:visited {
	position:relative;
	display:inline-block;
	padding:6px 12px;
	background:#<?php echo $paramssld["ht_view3_linkbutton_background_color"];?>;
	color:#<?php echo $paramssld["ht_view3_linkbutton_color"];?>;
	font-size:<?php echo $paramssld["ht_view3_linkbutton_font_size"];?>;
	text-decoration:none;
}

.huge_it_catalog_single_product_page div.right-block .button-block a:hover,.pupup-elemen.huge_it_catalog_single_product_page div.right-block .button-block a:focus,.huge_it_catalog_single_product_page div.right-block .button-block a:active {
	background:#<?php echo $paramssld["ht_view3_linkbutton_background_hover_color"];?>;
	color:#<?php echo $paramssld["ht_view3_linkbutton_font_hover_color"];?>;
}
*/




/*  ################### MOBILE ################  */



@media only screen and (max-width: 640px) {
    
/*  ### responsive tabs ###  */
	
        .huge_it_catalog_view_tabs {
            display: none;
        }
        
        #catalog-view-options-0_<?php echo $productArray->id; ?> {
            display: block !important;
        }
        #catalog-view-options-1_<?php echo $productArray->id; ?> {
            display: block !important;
        }
        #catalog-view-options-0_<?php echo $productArray->id; ?> .title_for_mobile {
            display: block !important;
        }
        #catalog-view-options-1_<?php echo $productArray->id; ?> .title_for_mobile {
            display: block !important;
        }
        
/*  ### responsive tabs  OVER ###  */   
        


	.huge_it_catalog_single_product_page > div {
		display:block;
		width:100%;
		clear:both;
	}

	.huge_it_catalog_single_product_page div.left-block,.huge_it_catalog_single_product_page div.right-block {
		clear:both;
		float:none;
		width:100%;
		margin:10px 0px 10px 0px;
	}

	.huge_it_catalog_single_product_page div.left-block .main-image-block {
		clear:both;
		width:100%; 
	}

	.huge_it_catalog_single_product_page div.left-block .main-image-block img {
		margin:0px !important;
		padding:0px !important;
		width:100% !important;  
		height:auto;
	}

	.huge_it_catalog_single_product_page div.left-block .thumbs-block ul {
		width:100%; 
	}
        
        
        
}
.zoomContainer {
    z-index: 10;
}

</style>
      
        <?php
            if ( is_plugin_active( 'product-catalog-releated-products/product-catalog-releated-products.php' ) ){
                if($paramssld4['ht_catalog_related_products_show'] == "on" && $paramssld4['ht_catalog_related_products_position'] != "bottom"){
                    show_related_products($productArray->id, $carousel_vertical, $paramssld4['ht_catalog_related_products_show_arrows'], "off", $productArray);
                }
            }
        ?>

<section id="huge_it_catalog_content_<?php echo $productArray->id; ?>" class="huge_it_catalog_single_product_page product-catalog-content">
    <div class="huge_it_catalog_container">
		<div class="left-block">
			<div class="main-image-block for_zoom">
				<?php $imgurl=explode(";",$productArray->image_url); ?>
				<?php 	if($productArray->image_url != ';'){ ?>
					<a href="<?php echo esc_attr($imgurl[0]); ?>" <?php if($paramssld['ht_single_product_allow_lightbox'] == "on"){ echo "class='catalog_single_product_group_".$productArray->id."'"; }else{ echo "onclick='return false'"; } ?> ><img id="wd-cl-img<?php echo $productArray->id; ?>" src="<?php echo esc_attr($imgurl[0]); ?>"></a>
				<?php } else { ?>
					  <a href="<?php echo esc_attr($imgurl[0]); ?>"><img id="wd-cl-img<?php echo $key; ?>" src="images/noimage.jpg"></a>
				<?php
					}
				?>
			</div>
			<?php
			if($paramssld["ht_single_product_show_thumbs"] == 'on')
			{
			?>
                            <div class="thumbs-block">
                                    <ul class="thumbs-list">
                                      <?php
                                      $imgurl=explode(";",$productArray->image_url);
                                      array_pop($imgurl);

                                      foreach($imgurl as $key=>$img){
                                      ?>
                                              <li><a href="<?php echo esc_attr($img);?>" class="catalog_single_product_group_<?php echo $productArray->id; ?>"><img src="<?php echo esc_attr($img); ?>"></a></li>
                                      <?php
                                      }
                                      ?>
                                    </ul>
                            </div>
			<?php
			}
			?>
		</div>
		<div class="right-block">
			
			
			<?php if($productArray->name!=''){?>
				<div class="title-block"><h2><?php echo $productArray->name; ?></h2></div>
			<?php } ?>
			<?php
                        
                            if($paramssld["ht_single_product_show_price"] == 'on' && $productArray->price != "")
                            {  ?>
                                <div class="price-block">
                                    <p><?php echo $paramssld3["ht_single_product_price_text"]; ?> :
                                        <span class="old-price" <?php if($productArray->market_price == '') { echo "style='text-decoration: none !important;'"; } ?>> <?php echo $productArray->price; ?> </span>
                                        <?php
                                                if($productArray->market_price != ''){ ?>
                                                    <span class="discont-price"><?php echo $productArray->market_price; ?></span>
                                        <?php   } ?>
                                    </p>
                                </div>
                     <?php  }
			
			if($paramssld["ht_single_product_show_description"] == 'on')
			{
				if($productArray->description!='') { ?>
					<div class="description-block">
						<p><?php echo $productArray->description; ?></p>
					</div>
				<?php }
			}
			?>
                        <div class="rating-and-share-blocks">
                     <?php
			
                        if($paramssld["ht_single_product_show_rating"] == 'on')
                        {  ?>
                            <div class="rating-block">
				<span class="label"><?php echo $paramssld3["ht_single_product_rating_text"]; ?>:</span>
				<ul class="rating-stars">
					<li><input type="radio" name="" value="1"></li>
					<li><input type="radio" name="" value="2"></li>
					<li><input type="radio" name="" value="3"></li>
					<li><input type="radio" name="" value="4"></li>
					<li><input type="radio" name="" value="5"></li>
				</ul>
				<?php 
                    $path_site = plugins_url("/../images", __FILE__);
                    $pageTitle = get_the_title();
                    if($productArray->image_url != ';'){ $pintimage[0] = $productArray->image_url; }
                    else { $pintimage[0] = $path_site.'/noimage.jpg'; }
					$spam = 0;
                                        
					foreach($spamReviewsArray as $spamReviews) {
                                            if($spamReviews == $_SERVER['REMOTE_ADDR']){ $spam = 1; }
                                        }
				?>
				<input type="hidden" name="spam" class="huge_it_catalog_spam" value="<?php echo esc_attr($spam); ?>" />
				<input type="hidden" name="product_id" class="huge_it_catalog_product_id" value="<?php echo $productArray->id; ?>" />
				<input type="hidden" name="ip" class="huge_it_catalog_product_ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
                            </div>
                            
                        <?php }
                        
                        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
				$actual_link = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."";
				$pattern="/\?p=/";
				$pattern2="/&page-img[0-9]+=[0-9]+/";
				$pattern3="/\?page-img[0-9]+=[0-9]+/";
					if(preg_match($pattern, $actual_link)){
						if(preg_match($pattern2, $actual_link)){
							$actual_link=preg_replace($pattern2, '', $actual_link);
							header("Location:".$actual_link."");
							exit;
						}	
					}elseif(preg_match($pattern3, $actual_link)){
						$actual_link=preg_replace($pattern3, '', $actual_link);
							header("Location:".$actual_link."");
							exit;
					}
                        if($paramssld["ht_single_product_show_share_buttons"] == 'on')
                        {  ?>

                            <div class="share_buttons_block">
				<span class="label"><?php echo $paramssld3["ht_single_product_share_text"]; ?>:</span>
				<ul>


					<li class="facebook">
                                            <li class="facebook"><a href=""  target="_blank" onclick="javascript:void window.open('<?php echo "https://www.facebook.com/sharer/sharer.php?u=".$myPageLink.""; ?>','1410949501326','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;">Facebook</a></li>
                                        </li>
					<li class="twitter" style="">
                                            <a onclick="Share.twitter('URL','<?php echo $actual_link;?>')">Twitter</a>
                                        </li>
					<li class="pinterest"  >
                                            <a  href="#" target="_blank" onclick="javascript:void window.open('http://www.pinterest.com/pin/create/button/?url=<?php echo $myPageLink; ?>&media=<?php echo $pintimage[0]; ?>&description=<?php echo $pageTitle; ?>','1410949501326','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;">Pinterest</a>
                                        </li>
                                        <li class="google_plus" style="">
                                            <a href="https://plus.google.com/share?url=<?php echo $actual_link;?>" onclick="javascript:window.open(this.href,

  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
                                        </li>
				</ul>
                            </div>
                  <?php } ?>
                            </div>
                                <?php $product_page_link = get_permalink()."&single_prod_id=$productArray->id&asc_seller"; ?>
                            
                            
                            <div style="clear: both;" ></div>
                        
                            <?php
                                 if($paramssld3["ht_single_product_show_asc_seller_button"] == 'on'){ ?>
                                     <div class="contact-seller-block">
                                        <div class="order_button" style="cursor:pointer"><span class="label"><?php echo $paramssld3['ht_single_product_asc_seller_button_text']; ?></span>
                                        </div>

                                        <div id="catalog-order-popup-1" class="modalDialog">
                                            <div>
                                                    <div title="Close" class="catalog-order-popup-close" style="cursor:pointer">X</div>
                                                    <h2><?php echo $paramssld3['ht_single_product_asc_to_seller_text']; ?></h2>
                                                    <label><input type="text" name="asc_seller_name" class="asc_seller_name" placeholder="<?php echo esc_attr($paramssld3["ht_single_product_your_name_text"]); ?>" /></label>
                                                    <label><input type="text" name="asc_seller_mail" class="asc_seller_mail" placeholder="<?php echo esc_attr($paramssld3["ht_single_product_your_mail_text"]); ?>"  /></label>
                                                    <label><input type="text" name="asc_seller_phone" class="asc_seller_phone" placeholder="<?php echo esc_attr($paramssld3["ht_single_product_your_phone_text"]); ?>" /></label>
                                                    <label>
                                                        <textarea name="asc_seller_massage" class="asc_seller_massage" placeholder="<?php echo esc_attr($paramssld3["ht_single_product_your_message_text"]); ?>" ></textarea>
                                                    </label>
                                                    <label>
                                                        <input type="text" class="captchaInputValue" placeholder="<?php echo $captchaFirstNum." + ".$captchaSecondNum." = ?"; ?>" autocomplete="off" />
                                                        <p class="invalid"></p>
                                                    </label>
                                                    <input type="hidden" name="asc_seller_product_id" class="asc_seller_product_id" value="<?php echo $productArray->id; ?>" />
                                                    <input type="hidden" name="asc_seller_spam" class="asc_seller_spam" value="<?php echo esc_attr($spam); ?>" />
                                                    <input type="hidden" name="asc_seller_ip" class="huge_it_catalog_product_ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
                                                    <input type="hidden" name="captcha_sum" id="captcha_sum" value="<?php echo $captcha_val; ?>">
                                                    <a href="#1" title="Close" class="order_popup_submit_close">
                                                        <input type="submit" name="order_popup_submit" id="order_popup_submit" value="<?php echo esc_attr($paramssld3["ht_single_product_asc_seller_popup_button_text"]);?>" />
                                                    </a>
                                            </div>
                                        </div>
                                    </div>
                            
                           <?php } ?>
		</div>
		
		
    <div class="huge-it-catalog-bottom-block" style="display: block;">
            <ul class="huge_it_catalog_view_tabs">
                <?php if($paramssld["ht_single_product_show_parameters"] == 'on'){ ?>
                    <li class="active" >
                        <a href="#catalog-view-options-0_<?php echo $productArray->id; ?>">
                            <?php echo $paramssld3["ht_single_product_parameters_text"]; ?>
                        </a>
                    </li>
                <?php } ?>
                <?php if($paramssld["ht_single_product_show_comments"] == 'on'){ ?>
                        <li>
                            <a href="#catalog-view-options-1_<?php echo $productArray->id; ?>">
                                <?php echo $paramssld3["ht_single_product_comments_text"]; ?> (<?php echo count($reviewsArray) - count($spamReviewsArray); ?>)
                            </a>
                        </li>
              <?php } ?>
            </ul>
            <ul class="huge_it_catalog_view_tabs_contents">
                <?php if($paramssld["ht_single_product_show_parameters"] == 'on'){ ?>
                    <li id="catalog-view-options-0_<?php echo $productArray->id; ?>" class="active" >
                        <h4 style="display: none;" class="title_for_mobile"><?php echo $paramssld3["ht_single_product_parameters_text"]; ?></h4>
                            <ul class="params-list">
                            <?php
//                            var_dump($allParamsAndChildsInArray);exit;
                                if($allParamsAndChildsInArray != ""){
                                    foreach ($allParamsAndChildsInArray as $singleParamAndChild) {
                                        if(!empty($singleParamAndChild)){
                                            $separateParamAndChildsInArray = explode("_()_", $singleParamAndChild);
                                            foreach ($separateParamAndChildsInArray as $paramKey => $separateParamAndChild) {
//                                                var_dump($separateParamAndChild);
                                                if($paramKey == 0){
                                                    if(count($separateParamAndChildsInArray) == 1){
//                                                        echo "param/datark child<br>";
                                                        echo "<li class='parameter-block'>".$separateParamAndChild."</li>";
                                                        echo "<li class='value-block'></li>";
                                                    }
                                                    else{
                                                        echo "<li class='parameter-block'>".$separateParamAndChild."</li>";
                                                    }
                                                }
                                                else{
//                                                        $separateParamAndChild = "&lt;a href=&quot;aaaaa&quot;&gt;";
                                                        if(count($separateParamAndChildsInArray) != ($paramKey + 1)){
                                                                echo $separateParamAndChild.", ";
//                                                                if(count($separateParamAndChildsInArray == 1)) echo '<li class="value-block"></li>';
                                                        }
                                                        else {
                                                                $separateParamAndChild = htmlspecialchars_decode($separateParamAndChild);
                                                                $separateParamAndChild = str_replace("thisisat", "_()_", $separateParamAndChild);
                                                                echo '<li class="value-block">'.  $separateParamAndChild.'</li>';
                                                        }
                                                }
                                            }
                                        }
                                    }
                                }
                                else { echo "<br>".__("No Parameters"); }
                            ?>
                            </ul>
                      </li>
                      <?php } ?>
                      <?php if($paramssld["ht_single_product_show_comments"] == 'on'){ ?>
                      <li id="catalog-view-options-1_<?php echo $productArray->id; ?>"  <?php if($paramssld["ht_single_product_show_parameters"] == 'off'){ echo "class='active'"; } ?>>
                          <h4 style="display: none;" class="title_for_mobile"><?php echo __("Comments","product-catalog","product-catalog");?></h4>
                          <div class="reviews-block"><?php
                            if(!empty($reviewsArray)){
                              if($reviewsArray[0]->id == ""){
                                      echo "<br>".__("No Comments","product-catalog");
                              }
                              else{
                                      foreach ($reviewsArray as $review) { ?>
                                            <div class="review">
                                               <?php if($review->spam == 0) echo "<p style='font-weight: bold;' >".$review->name."</p><p>".$review->content."</p>"; ?>
                                            </div>
                       <?php          }
                                  }
                            } ?>

                          </div>
                          <div class="write-rate-block">
                              <form action="<?php echo wp_get_referer(); ?>" method="POST" name="comments-form">
                                    <label><?php echo $paramssld3["ht_single_product_your_name_text"]; ?>: 
                                        <?php if ($user_level > 9) { ?> <input type="text" name="comments_name" id="comments_name" value="<?php echo ' '.$user_info->user_login; ?>"/> <?php } else { ?>
                                        <input type="text" name="comments_name" id="comments_name"/> <?php } ?>
                                    </label>
                                    <label><?php echo $paramssld3["ht_single_product_your_Comment_text"]; ?>:
                                        <textarea name="author_comment" id="author_comment" value="" ></textarea>
                                    </label>
                                    <label>
                                        <?php echo $paramssld3["ht_single_product_captcha_text"]; ?>
                                        <input type="text" id="captchaInputValue" placeholder="<?php echo $captchaFirstNum." + ".$captchaSecondNum." = ?"; ?>" autocomplete="off" />
                                        <p class="invalid"></p>
                                    </label>
                                    <input type="submit" name="comments_submit" id="comments_submit" value="<?php echo esc_attr($paramssld3["ht_single_product_comments_submit_button_text"]);?>" />
                              </form>
                          </div>
                    </li>
                    <?php } ?>
            </ul>
    </div>
	<div class="clear"></div>
	</div>
</section>
<div class="clear"></div>
       
<style>
    .huge-it-related-carousel {
         <?php
            if($paramssld4['ht_catalog_related_products_vertical'] == "true"){ ?>
                display: table;
                margin: 0 !important;
                margin-top: 5px !important;
                padding: 0 !important;
      <?php }
       else { ?>
                /*display: block;*/
                margin: auto;
                margin-right: 4%;
                padding: 0;
                width: 96%;
       <?php } ?>
    }
    
    .huge-it-related-carousel li {
        margin: 0;
        padding: 0;
        <?php
            if($paramssld4['ht_catalog_related_products_vertical'] == "false"){ ?>
                /*height: <?php echo $paramssld4['ht_catalog_related_products_horizontal_elem_height']; ?>px;*/
                /*max-height: <?php echo $paramssld4['ht_catalog_related_products_horizontal_elem_height']; ?>px;*/
        <?php }
            else{ ?>
                position: relative !important;
                width:  <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width']; ?>px;
      <?php } ?>
    }
    
    .huge-it-related-carousel li div.RelatedOnHoverVertical {
        border-color: #<?php echo $paramssld4["ht_catalog_related_products_vertical_border_color"]; ?> !important;
    }
    
    .huge-it-related-carousel li div.RelatedOnHoverHorizontal {
        border-color: #<?php echo $paramssld4["ht_catalog_related_products_horizontal_border_color"]; ?> !important;
    }
    
    .catalog-related-item-block {
        width: 100%;
        height: calc(100% - 2px);
        height: -moz-calc(100% - 2px);
        height: -webkit-calc(100% - 2px);
        height: calc(100% - 2px);
        height: -o-calc(100% - 2px);
        height: -ms-calc(100% - 2px);
        /*border: 1px solid transparent;*/ 
    }
    
    .huge-it-related-carousel li:hover {
        /*width: <?php // echo $paramssld4['ht_catalog_related_products_vertical_elem_width'] * 2; ?>px;*/
    }
    
    .huge-it-related-carousel li a {
        text-decoration: none;
    }
                                /* <-- Slider Images */
    .huge-it-related-carousel img {
        <?php
            if($paramssld4['ht_catalog_related_products_vertical'] == "false"){ ?>
/*                height: <?php echo $paramssld4['ht_catalog_related_products_horizontal_elem_height']; ?>px;
                max-height: <?php echo $paramssld4['ht_catalog_related_products_horizontal_elem_height']; ?>px;*/
                width: auto !important;
                margin: 0 auto !important;
                display: block;
      <?php }
            else { ?>
                height: auto;
                width: <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width']; ?>px !important;
                vertical-align: middle;
                position: absolute;
                top: 0;
                bottom: 0;
                margin: auto 0 !important;
      <?php } ?>
    }
                                /*     Slider Images --> */
    
    /* Responsive Slider Images */
    .huge-it-related-carousel.responsive img {
        padding-right: 10px;
    }
        /*  <--  pagination block   */
        
    .pager-block{
        
    }
    .cycle-pager {
        position: static;
    }
        /*       pagination block -->  */
            
    .catalog-related-item-block{
        position: relative;
        <?php
            if($paramssld4['ht_catalog_related_products_vertical'] == "false"){ ?>
                /*border-radius: <?php echo $paramssld4['ht_catalog_related_products_horizontal_border_radius']; ?>px;*/
        <?php }
            else{ ?>
                height: 100%;
                /*border-radius: <?php echo $paramssld4['ht_catalog_related_products_vertical_border_radius']; ?>px;*/
      <?php } ?>
    }
        
    .catalog-related-caption-block{
        <?php
        if($paramssld4['ht_catalog_related_products_vertical'] == "true" ){ ?>
            position: absolute;
            width: <?php echo $paramssld4['ht_catalog_related_products_vertical_caption_width'] - 8; ?>px;
            font-size: 60%;
            <?php if($paramssld4['ht_catalog_related_products_position'] == "left" ){ ?>
                      right: <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width'] + 3; ?>px;
            <?php }
                  else{ ?>
                      left: <?php echo $paramssld4['ht_catalog_related_products_vertical_elem_width'] + 3; ?>px;
            <?php } ?>
            top: 0;
            padding: 0;
            margin: 0;
            overflow: hidden;
            <?php if( $paramssld4['ht_catalog_related_products_position'] == "left") ?>{
                text-align: right;
            }
  <?php }
        else{ ?>
            position: relative;
            display: block;
            width: 90%;
            height: <?php echo $paramssld4['ht_catalog_related_products_horizontal_caption_height']; ?>px;
            padding: 0;
            margin: 0 auto;
            text-align: center;
  <?php } ?>
    }
    .catalog-related-caption{
        <?php if($paramssld4['ht_catalog_related_products_vertical'] == "true" ){ ?>
                  visibility: hidden;
                  font-size: <?php echo $paramssld4['ht_catalog_related_products_vertical_font_size']; ?>px;
                  color: #<?php echo $paramssld4['ht_catalog_related_products_vertical_font_color']; ?>;
        <?php }
        else{ ?>
                  visibility: visible;
                  font-size: <?php echo $paramssld4['ht_catalog_related_products_horizontal_font_size']; ?>px;
                  color: #<?php echo $paramssld4['ht_catalog_related_products_horizontal_font_color']; ?>;
      <?php }?>
    }
    .catalog-related-caption p{
        margin: 0;
        padding: 0;
        overflow: hidden !important;
        text-overflow: ellipsis;
    }
    
</style>

<style>
        /* prev / next links */

<?php
      if($paramssld4['ht_catalog_related_products_vertical'] == "false"){ ?>
            .cycle-prev, .cycle-next {
                position: absolute;
                top: 0; 
                width: 5%;
                opacity: 0;
                filter: alpha(opacity=0);
                z-index: 800;
                height: 100%; 
                cursor: pointer;
            }
            .cycle-prev {
                left: 0;
                background: url(<?php echo plugins_url('../images/leftArrow.png', __FILE__);?>) 10% 50% no-repeat;
                background-color: #c0c0c0;
            }
            .cycle-next {
                right: 0;
                background: url(<?php echo plugins_url('../images/rightArrow.png', __FILE__);?>) 90% 50% no-repeat;
                background-color: #c0c0c0;
            }
            .cycle-prev:hover, .cycle-next:hover {
                opacity: .5;
                filter: alpha(opacity=70); 
            }

            .disabled {
                opacity: .5;
                filter:alpha(opacity=50);
            }
<?php }
      else{ ?>
            .cycle-prev, .cycle-next {
                position: absolute;
                /*width: 45%;*/
                height: 5%;
                opacity: 0;
                filter: alpha(opacity=0);
                z-index: 800;
                cursor: pointer;
            }
            .cycle-prev { 
                top: 0;
                background: url(<?php echo plugins_url('../images/upArrow.png', __FILE__);?>) 50% 50% no-repeat;
                background-color: #c0c0c0;
            }
            .cycle-next {
                bottom: 0;
                background: url(<?php echo plugins_url('../images/downArrow.png', __FILE__);?>) 50% 50% no-repeat;
                background-color: #c0c0c0;
            }
            .cycle-prev:hover, .cycle-next:hover {
/*                opacity: 0.5; 
                filter: alpha(opacity=70); */
            }

            .disabled { 
                opacity: .5;
                filter:alpha(opacity=50);
            }
<?php } ?>
    
    @media (max-width: 1200px) {
        
        .huge-it-related-carousel li .catalog-related-caption{
            <?php
            if($paramssld4['ht_catalog_related_products_vertical'] == "true"){ ?>
                display: none;
          <?php  } ?>
        }
    }
    @media (max-width: 640px) {
        .huge-it-related-carousel{
            <?php
            if($paramssld4['ht_catalog_related_products_vertical'] == "true"){ ?>
                display: none;
                float: none !important;
     <?php  } ?>
        }
        .huge_it_catalog_single_product_page{
            <?php
            if($paramssld4['ht_catalog_related_products_vertical'] == "true"){ ?>
                width: 98%;
                float: none !important;
     <?php  } ?>
        }
        
         /* <--  Carousel Horizontalling */
       
        .huge-it-related-carousel {
            <?php
                if($paramssld4['ht_catalog_related_products_vertical'] == "true"){ ?>
                    margin: auto;
                    margin-right: 2%;
                    padding: 0;
                    width: 98%;
          <?php } ?>
        }

        .huge-it-related-carousel img {
             <?php
                if($paramssld4['ht_catalog_related_products_vertical'] == "true"){ ?>
                    position: relative;
                    width: auto !important;
                    margin: 0 auto !important;
                    display: block;
                <?php } ?>
        }

        .catalog-related-item-block{
            <?php
                if($paramssld4['ht_catalog_related_products_vertical'] == "true"){ ?>
                    position: relative;
                <?php } ?>
        }
        
        .catalog-related-caption-block{
    <?php
        if($paramssld4['ht_catalog_related_products_vertical'] == "true"){ ?>
            position: relative;
            display: block;
            width: 90%;
            height: <?php echo $paramssld4['ht_catalog_related_products_horizontal_caption_height']; ?>px;
            padding: 0;
            margin: 0 auto;
            text-align: center;
            left: 0;
            right: 0;
    <?php } ?>
    }
    .huge-it-related-carousel li .catalog-related-caption{
    <?php
        if($paramssld4['ht_catalog_related_products_vertical'] == "true"){ ?>
            display: block;
            visibility: visible;
            font-size: <?php echo $paramssld4['ht_catalog_related_products_horizontal_font_size']; ?>px;
            color: #<?php echo $paramssld4['ht_catalog_related_products_horizontal_font_color']; ?>;
  <?php } ?>
    }
    
    /* slider horizontallimg --> */
    
        .cycle-prev, .cycle-next {
                position: absolute;
                top: 0; 
                width: 5%;
                opacity: 0.5; 
                filter: alpha(opacity=70); 
                z-index: 800;
                height: 100%; 
                cursor: pointer;
            }
            .cycle-prev {
                left: 0;
                background: url(<?php echo plugins_url('../images/leftArrow.png', __FILE__);?>) 10% 50% no-repeat;
                background-color: #c0c0c0;
            }
            .cycle-next {
                right: 0;
                background: url(<?php echo plugins_url('../images/rightArrow.png', __FILE__);?>) 90% 50% no-repeat;
                background-color: #c0c0c0;
            }
/*            .cycle-prev:hover, .cycle-next:hover {
                opacity: .5;
                filter: alpha(opacity=70);
            }*/

            .disabled {
                opacity: .5;
                filter:alpha(opacity=50);
            }

    }
    
@media (min-width: 640px) {
    .huge-it-related-carousel{
    <?php
      if($paramssld4['ht_catalog_related_products_position'] == "left"){ ?>
          float: left;
          padding-left: <?php echo $paramssld4['ht_catalog_related_products_vertical_caption_width'] + 3; ?>px !important;
          margin-left: -<?php echo $paramssld4['ht_catalog_related_products_vertical_caption_width'] + 3; ?>px !important;
<?php }
      else{
          if($paramssld4['ht_catalog_related_products_position'] == "right"){ ?>
              float:right;
              padding-right: <?php echo $paramssld4['ht_catalog_related_products_vertical_caption_width']; ?>px !important;
              margin-right: -<?php echo $paramssld4['ht_catalog_related_products_vertical_caption_width']; ?>px !important;
    <?php }
      }
?>
}

    .cycle-carousel-wrap{
        <?php if($paramssld4['ht_catalog_related_products_position'] == "left"){ ?>
            left: <?php echo $paramssld4['ht_catalog_related_products_vertical_caption_width'] - 3; ?>px !important;
        <?php } ?>
    }
}

</style>

    <?php
            if ( is_plugin_active( 'product-catalog-releated-products/product-catalog-releated-products.php' ) ){
                if($paramssld4['ht_catalog_related_products_show'] == "on" && $paramssld4['ht_catalog_related_products_position'] == "bottom"){                   
                    show_related_products($productArray->id, $carousel_vertical, $paramssld4['ht_catalog_related_products_show_arrows'], "off", $productArray);
                }
            }
    ?>

  
<script>
    
jQuery(window).load(function(){
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        horizontal_slider_load_function();
        related_horizontal_carousel_call();
    }
    else{
        if(<?php echo $paramssld4['ht_catalog_related_products_vertical']; ?>  == true){
            vertical_slider_load_function();
            related_vertical_container_resize();
   	}
    	else{
      	    horizontal_slider_load_function();
        }
    }
});

jQuery(document).ready(function(){
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ){
       jQuery(".huge-it-related-carousel").css({"display" : "block"});
    }
    else{
        related_carousel_call();
    }
    related_carousel_ready_styles();
});

jQuery(window).resize(function(){
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ){
        return false;
    }
    else{
        if(<?php  echo $paramssld4['ht_catalog_related_products_vertical']; ?> == false){
            related_horizontal_container_resize();
        }
        else{
            related_vertical_container_resize();
        }   
    }
});

function horizontal_slider_load_function(){
        var kayficent = <?php echo $paramssld4['ht_catalog_related_products_horizontal_elem_width'] / $paramssld4['ht_catalog_related_products_horizontal_elem_height']; ?>;
        var container_width = jQuery(".huge-it-related-carousel").parent().width() * 0.96;
        var elements_max_width = container_width / <?php echo $paramssld4['ht_catalog_related_products_visible_count']; ?>;
        var element_max_height = elements_max_width  / kayficent;
        jQuery(".huge-it-related-carousel li").width(elements_max_width);
        jQuery(".huge-it-related-carousel li .catalog-related-item-block").height(element_max_height);
        jQuery(".huge-it-related-carousel li img").height(element_max_height);
        
//        jQuery(".huge-it-related-carousel li img").css("cssText", "height: " + element_max_height +"px !important;");
        var caption_and_elem_height = element_max_height + parseInt(<?php echo $paramssld4['ht_catalog_related_products_horizontal_caption_height'] + $paramssld4['ht_catalog_related_products_horizontal_border_size']; ?>);
        jQuery(".huge-it-related-carousel li").height(caption_and_elem_height);
        jQuery(".huge-it-related-carousel").attr("huge-it-carousel-horizontal-li-width", elements_max_width);
        jQuery(".huge-it-related-carousel").attr("huge-it-carousel-horizontal-li-height", caption_and_elem_height);
}
function vertical_slider_load_function(){
        var elements_max_height = 1;
        jQuery(".huge-it-related-carousel li").each(function(){
            if(jQuery(this).find("img").height() > elements_max_height ){
                elements_max_height = jQuery(this).find("img").height();
            }
        });
        elements_max_height = elements_max_height + parseInt(10);       //      img bottom padding
        jQuery(".huge-it-related-carousel li").height(elements_max_height);
        jQuery(".huge-it-related-carousel li .catalog-related-caption-block").height(elements_max_height);
        var carousel_height = <?php echo $paramssld4['ht_catalog_related_products_visible_count']; ?> * elements_max_height;
        jQuery(".huge-it-related-carousel").height(carousel_height);

        var product_width = jQuery('.huge_it_catalog_single_product_page').width();
        jQuery(".huge-it-related-carousel").attr("huge-it-single-prod-width", product_width);
        var elements_max_width = jQuery(".huge-it-related-carousel li").width();
        jQuery(".huge-it-related-carousel").attr("huge-it-carousel-horizontal-li-width", elements_max_width);
        var elements_max_height = jQuery(".huge-it-related-carousel li").height();
        jQuery(".huge-it-related-carousel").attr("huge-it-carousel-vertical-li-width", elements_max_height);
}
function related_horizontal_container_resize(){
        var image = '.huge-it-related-carousel li .catalog-related-item-block img';
        var li = '.huge-it-related-carousel li';
        var new_li_width = jQuery(li).width();
        var old_li_width = jQuery(".huge-it-related-carousel").attr("huge-it-carousel-horizontal-li-width");
        var old_li_height = jQuery(".huge-it-related-carousel").attr("huge-it-carousel-horizontal-li-height");
        var new_li_height = old_li_height * new_li_width / old_li_width;
        jQuery(li).height(new_li_height);
        var li_minus_caption_height = new_li_height - parseInt(<?php  echo $paramssld4['ht_catalog_related_products_horizontal_caption_height'] + $paramssld4['ht_catalog_related_products_horizontal_border_size']; ?>);
        var elem_new_height = new_li_height - parseInt(<?php  echo $paramssld4['ht_catalog_related_products_horizontal_caption_height'] + $paramssld4['ht_catalog_related_products_horizontal_border_size']; ?>);
        jQuery(image).height(li_minus_caption_height);
        jQuery('.huge-it-related-carousel li .catalog-related-item-block').height(elem_new_height);
}
function related_vertical_container_resize(){
        var image = '.huge-it-related-carousel li .catalog-related-item-block img';
        var li = '.huge-it-related-carousel li';
        var caption = jQuery(li).find(".catalog-related-caption-block");
        var old_li_width  = jQuery(".huge-it-related-carousel").attr("huge-it-carousel-horizontal-li-width");
        var old_li_height = jQuery(".huge-it-related-carousel").attr("huge-it-carousel-vertical-li-width");
        var product = '.huge_it_catalog_single_product_page';
        var product_old_width = jQuery(".huge-it-related-carousel").attr("huge-it-single-prod-width");
        var product_new_width = jQuery(product).width();
//        alert(product_old_width + " " + product_new_width);
//        alert(old_li_width + " " + old_li_height);
        var new_li_width = product_new_width * old_li_width / product_old_width;
        var new_li_height = old_li_height * new_li_width / old_li_width;
            jQuery(li).width(new_li_width);
            jQuery(".huge-it-related-carousel .cycle-prev, .huge-it-related-carousel .cycle-next").width(new_li_width);
            jQuery(li).height(new_li_height);
        var caption_old_width = <?php echo $paramssld4['ht_catalog_related_products_vertical_caption_width']; ?>;
        var caption_old_height = old_li_height;
        var caption_new_height = new_li_height * 0.7;
        var caption_new_width  = product_new_width  * caption_old_width   / product_old_width * 0.7;
        var left_position = new_li_width + 10;
        if("<?php echo $paramssld4['ht_catalog_related_products_position']; ?>" == "right"){
            jQuery(".catalog-related-caption-block").css({"left" : left_position});
        }
        else{
            jQuery(".catalog-related-caption-block").css({"right" : left_position});
        }
//        var caption_new_width = caption_new_height * caption_old_width / caption_old_height;
            caption.height(new_li_height);
//            alert(caption_new_width);
            jQuery(caption).width(caption_new_width);
            new_li_width = new_li_width +10;
            if(jQuery(document).width() > 640){
                var product_width = "calc(94% - "+new_li_width+"px)";
                var moz_product_width = "-moz-calc(94% - "+new_li_width+"px)";
                var webkit_product_width = "-webkit-calc(94% - "+new_li_width+"px)";
                jQuery(product).css({"width" : moz_product_width});
                jQuery(product).css({"width" : webkit_product_width});
                jQuery(product).css({"width" : product_width});
            }else{
                var product_width = "98%";
                jQuery(product).css({"width" : product_width});
            }

            
            var carousel_height = <?php echo $paramssld4['ht_catalog_related_products_visible_count']; ?> * new_li_height;
            jQuery(".huge-it-related-carousel").height(carousel_height);
            
}
function related_carousel_call(){
    jQuery( '.huge-it-related-carousel' ).cycle({
        fx: "carousel",
        slides: "li",
        autoHeight: "calc",
        log: true,
        delay: <?php echo $paramssld4['ht_catalog_related_products_delay']; ?>,
        timeout: <?php echo $autoplay_speed; ?>,
        carouselVisible: <?php echo $paramssld4['ht_catalog_related_products_visible_count']; ?>,
        carouselFluid: <?php echo $fullWithProducts; ?>,
        allowWrap: <?php echo $paramssld4['ht_catalog_related_products_circular']; ?>,
        pauseOnHover: "<?php echo $paramssld4['ht_catalog_related_products_pause_on_hover']; ?>",
        speed: <?php echo $paramssld4['ht_catalog_related_products_changing_speed']; ?>,
        carouselVertical: <?php echo $paramssld4['ht_catalog_related_products_vertical']; ?>
    });
}
function related_horizontal_carousel_call(){
        jQuery( '.huge-it-related-carousel' ).cycle({
        fx: "carousel",
        slides: "li",
        autoHeight: "calc",
        log: true,
        delay: <?php echo $paramssld4['ht_catalog_related_products_delay']; ?>,
        timeout: <?php echo $autoplay_speed; ?>,
        carouselVisible: <?php echo $paramssld4['ht_catalog_related_products_visible_count']; ?>,
        carouselFluid: <?php echo $fullWithProducts; ?>,
        allowWrap: <?php echo $paramssld4['ht_catalog_related_products_circular']; ?>,
        pauseOnHover: "<?php echo $paramssld4['ht_catalog_related_products_pause_on_hover']; ?>",
        speed: <?php echo $paramssld4['ht_catalog_related_products_changing_speed']; ?>,
        carouselVertical: false
    });
}
function related_carousel_ready_styles(){
    setTimeout(function(){ jQuery(".huge-it-related-carousel .cycle-prev, .huge-it-related-carousel .cycle-next").removeClass("disabled"); }, 300);
    jQuery(".huge-it-related-carousel").hover(function() {
        jQuery(this).find(".cycle-prev, .cycle-next").css({"opacity" : "0.5", "filter" : "alpha(opacity=70)"});
    },function(){
        jQuery(this).find(".cycle-prev, .cycle-next").css({"opacity" : "0", "filter" : "alpha(opacity=0)"});
    });
    if(<?php echo $paramssld4['ht_catalog_related_products_vertical']; ?>  == true){
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ){}
        else{
            var arrow_width = jQuery(".huge-it-related-carousel li").width();
            jQuery(".huge-it-related-carousel .cycle-prev, .huge-it-related-carousel .cycle-next").width(arrow_width);
            jQuery(".huge-it-related-carousel li").each(function(){
                jQuery(this).find(".catalog-related-item-block").css({"border" : "<?php echo $paramssld4["ht_catalog_related_products_vertical_border_size"]; ?>px solid transparent"});
            });
            jQuery(".huge-it-related-carousel li").hover(function() {
                jQuery(this).find(".catalog-related-item-block").addClass("RelatedOnHoverVertical");
                jQuery(this).find(".catalog-related-caption").css({"visibility" : "visible"});
            },function(){
                jQuery(this).find(".catalog-related-item-block").removeClass("RelatedOnHoverVertical");
                jQuery(this).find(".catalog-related-caption").css({"visibility" : "hidden"});
            });
        }
    }
    else{
        jQuery(".huge-it-related-carousel li").each(function(){
            jQuery(this).find(".catalog-related-item-block").css({"border" : "<?php echo $paramssld4["ht_catalog_related_products_horizontal_border_size"]; ?>px solid transparent"});
        });
        jQuery(".huge-it-related-carousel li").hover(function() {
                jQuery(this).find(".catalog-related-item-block").addClass("RelatedOnHoverHorizontal");
            },function(){
                jQuery(this).find(".catalog-related-item-block").removeClass("RelatedOnHoverHorizontal");
            });
    }
}

function product_thumbs_click(){
            
var lightbox_is = allowLightbox;
    if(lightbox_is != "on"){
        jQuery(".huge_it_catalog_container .left-block .thumbs-block .thumbs-list li a img").click(function(e){
            e.preventDefault();
//                        alert(lightbox_is);
            var new_src = jQuery(this).attr("src");    //    alert(new_src);
            var container = jQuery(this).closest(".huge_it_catalog_container");
            var image_block = container.find(".left-block .main-image-block");
            var image = image_block.find("a img");

                image.attr("src", new_src);

                var new_img_height = image.height();
//                            container.height(new_img_height);
                container.find(".zoomWrapper").height(new_img_height);

                zoom_resize();
        });
    }
                                
}

        // bind filter on select change
jQuery(document).ready(function(){
    jQuery('#huge_it_catalog_filters ul li').click(function() {
      // get filter value from option value
      var filterValue = jQuery(this).attr('rel');
      // use filterFn if matches value
      filterValue = filterValue;//filterFns[ filterValue ] || 
      $container.hugeitmicro({ filter: filterValue });
    });
    
});

jQuery(document).ready(function($) {
//    jQuery('.ask_seller_popup').click(function() {
//        var NWin = window.open(jQuery(this).prop('href'), '', 'scrollbars=1,height=400,width=400');
//        if (window.focus)
//        {
//          NWin.focus();
//        }
//        return false;
//    });

    product_thumbs_click();
});
  
jQuery(document).ready(function () {
	jQuery('.huge_it_catalog_view_tabs > li > a').click(function(){
//            alert("ok");
		jQuery('.huge_it_catalog_view_tabs > li').removeClass('active');
		jQuery(this).parent().addClass('active');
		jQuery('.huge_it_catalog_view_tabs_contents > li').removeClass('active');
		var liID=jQuery(this).attr('href');
		jQuery(liID).addClass('active');
                return false;
	});
        
        jQuery(".order_button").click(function(){
            jQuery(".modalDialog").css({ 'opacity': '1','pointer-events':'auto' });
	});
        jQuery(".catalog-order-popup-close").click(function(){
            jQuery(".modalDialog").css({ 'opacity': '0','pointer-events':'none' });
	});
        
        jQuery('#comments_submit').click(function(){
//            if(jQuery("#captchaInputValue").val() == <?php echo $captcha_val; ?>){
                var comments_name = jQuery("#comments_name").val();
                var author_comment = jQuery("#author_comment").val();
                var ip = jQuery(".huge_it_catalog_product_ip").val();
                var spam =  jQuery(".huge_it_catalog_spam").val();
                var product_id =  jQuery(".huge_it_catalog_product_id").val();
                var captcha_val = jQuery("#captchaInputValue").val();
                if(comments_name == "" || author_comment == "" || captcha_val == ""){
//                    alert("empty field");alert(jQuery("#author_comment").val());
                    if(comments_name == ""){ jQuery("#comments_name").addClass("empty"); }
                    else{ jQuery("#comments_name").removeClass("empty"); }
                    
                    if(jQuery("#author_comment").val() == ""){ jQuery("#author_comment").addClass("empty"); }
                    else{ jQuery("#author_comment").removeClass("empty"); }
                    
                    if(captcha_val == ""){ jQuery("#captchaInputValue").addClass("empty"); }
                    else{ jQuery("#captchaInputValue").removeClass("empty"); }
                    
                    return false;
                }
                else{
                    jQuery("#comments_name,#author_comment,#captchaInputValue").removeClass("empty");
//                   alert(comments_name + " " + author_comment+ " " + ip + " " + spam + " " + product_id);
    //            return false;
                var data = {
                    action: 'my_action',
                    post: 'applyproductcommentfromuser',
                    comments_name: comments_name,
                    spam: spam,
                    ip: ip,
                    product_id: product_id,
                    author_comment: author_comment,
                    captcha_val: captcha_val
                };

                jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function(response) {
                    response = JSON.parse(response);      //       alert(response.captcha1 + " " + response.captcha2);
                    if(response.index == 1){
                        if( jQuery(".reviews-block .review").text().length == 0 ) { jQuery(".reviews-block").text(""); }
                        jQuery(".reviews-block").append("<div class='review'><p style='font-weight: bold;'>"+ comments_name +"</p><p>" + author_comment + "</p></div>");
                        jQuery("#comments_name").removeAttr('value');
                        jQuery("#author_comment").removeAttr('value');
                        jQuery("#captchaInputValue").removeAttr('value');
                        jQuery("#captchaInputValue").attr("placeholder",response.captcha1 +" + "+response.captcha2 + " = ?");
                        jQuery("#captchaInputValue").parent().find(".invalid").text("");
                    }
                    if(response.index == 2){
                        jQuery("#captchaInputValue").parent().find(".invalid").text("<?php echo $paramssld3["ht_single_product_invalid_captcha_text"]; ?>").css({ "color" : "#E22828" });
                    }
                });
                return false;
                }
        });
        
        jQuery('.order_popup_submit_close').click(function(e){
            e.preventDefault();
                var user_name       = jQuery("#catalog-order-popup-1 .asc_seller_name").val();
                var user_mail       = jQuery("#catalog-order-popup-1 .asc_seller_mail").val();
                var user_phone      = jQuery("#catalog-order-popup-1 .asc_seller_phone").val();
                var user_massage    = jQuery("#catalog-order-popup-1 .asc_seller_massage").val();
                var user_product_id = jQuery("#catalog-order-popup-1 .asc_seller_product_id").val();
                var user_spam       = jQuery("#catalog-order-popup-1 .asc_seller_spam").val();
                var captcha_val     = jQuery("#catalog-order-popup-1 .captchaInputValue").val();
                var product_name    = jQuery(".right-block .title-block h2").text(); 
                var user_ip         = jQuery("#catalog-order-popup-1 .huge_it_catalog_product_ip").val();
                var captchaSum      = jQuery("#catalog-order-popup-1 #captcha_sum").val();
                var emailCheck=/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i;
                    if(user_name == "" || user_mail == ""  || user_phone == ""  || user_massage == ""  || user_product_id == "" || captcha_val == "" || captcha_val != <?php echo $captcha_val; ?>){
                        jQuery("#catalog-order-popup-1 input[type=text], #catalog-order-popup-1 textarea").each(function(){
                            if(!jQuery(this).val()){        //        alert(jQuery(this).attr("name"));
                                jQuery(this).addClass("empty");
                            }
                            else{ jQuery(this).removeClass("empty"); }
                        });
                        if(captcha_val != <?php echo $captcha_val; ?>){
                            jQuery("#catalog-order-popup-1").find(".invalid").text("<?php echo $paramssld3["ht_single_product_invalid_captcha_text"]; ?>").css({ "color" : "#E22828" });
                        }
                        return false;
                    }
                    else{
                        var email_path = jQuery("#catalog-order-popup-1 .asc_seller_mail");
                        if(!(emailCheck.test(user_mail))){
                            jQuery(email_path).val("").attr("placeholder", "Invalid Email").addClass("empty");
                            return false;
                        }
                        else{
                            jQuery(email_path).removeClass("empty").attr("placeholder", "<?php echo $paramssld3["ht_single_product_your_mail_text"]; ?>");
                        var data = {
                            action: 'my_action',
                            post: 'applyproductascsellerfromuser',
                            user_name: user_name,
                            user_mail: user_mail,
                            user_phone: user_phone,
                            user_product_id: user_product_id,
                            user_massage: user_massage,
                            user_spam: user_spam,
                            user_ip: user_ip,
                            captcha_val: captcha_val,
                            product_name:   product_name,
                            captcha_sum: captchaSum
                        };

                        jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function(response) {    //    alert(response);
                            response = JSON.parse(response);
                            if(response.index == 1){
                                if( jQuery(".reviews-block .review").text().length == 0 ) { jQuery(".reviews-block").text(""); }
                                jQuery("#catalog-order-popup-1 .asc_seller_name").removeAttr('value');
                                jQuery("#catalog-order-popup-1 .asc_seller_mail").removeAttr('value');
                                jQuery("#catalog-order-popup-1 .asc_seller_phone").removeAttr('value');
                                jQuery("#catalog-order-popup-1 .asc_seller_massage").removeAttr('value');
                                jQuery("#catalog-order-popup-1 .captchaInputValue").val("").attr("placeholder",response.captcha1 +" + "+response.captcha2 + " = ?").parent().find(".invalid").text("");
                                jQuery("#catalog-order-popup-1 input[type=text]").each(function(){
                                    jQuery(this).removeClass("empty");
                                });
                                window.location = jQuery('.order_popup_submit_close').attr("href");
//                                jQuery(".modalDialog").css({ opacity: 0 });
    //                            jQuery(".modalDialog ").find("a.catalog-order-popup-close").click();
                            }
                            if(response.index == 2){
                                jQuery("#catalog-order-popup-1").find(".invalid").text("<?php echo $paramssld3["ht_single_product_invalid_captcha_text"]; ?>").css({ "color" : "#E22828" });
                                return false;
                            }
                        });
                        
                    }
                }
                jQuery(".modalDialog").css({ 'opacity': '0','pointer-events':'none' });
                        
        });
            
            jQuery(".rating-stars li").hover(function() {
                var rate_val = jQuery(this).find("input").val();
                var background_margin = (rate_val * 15);
				
                jQuery(this).parent().css({
                    'background-position' : '0px -' + background_margin + 'px'
                });
           },function(){
                    if(jQuery(this).parent().hasClass('rated')){
                            var rateis=jQuery(this).parent().attr('data-rateis')*15;
                            jQuery(this).parent().css({
                                    'background-position' : '0px -'+rateis+'px'
                            });
                    }else{
                       jQuery(this).parent().css({
                                    'background-position' : '0px  <?php echo $rating * (-15) ; ?>px'
                            });
                    }
            });
           
           
           jQuery(".rating-stars li input[type='radio']").click(function(){
               var strthis=jQuery(this);
               var rate_val = jQuery(this).val();
               var ip = jQuery(".huge_it_catalog_product_ip").val();
               var spam =  jQuery(".huge_it_catalog_spam").val();
               var product_id =  jQuery(".huge_it_catalog_product_id").val();
               var data = {
                    action: 'my_action',
                    post: 'productratingfromuser',
                    spam: spam,
                    ip: ip,
                    product_id: product_id,
                    rate_val: rate_val
               };
               
//               alert(ip + " " + spam + " " + product_id); return false;
               
               jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>", data, function(response) {     //    alert(response.index);
                    response = JSON.parse(response);
//                    alert(response.index);
//                    alert(response.rating);
                    if(response.index == 1){
                        var newrate = response.rating;      //      alert(newrate);
                        jQuery(strthis).parent().parent().addClass('rated').attr('data-rateis',newrate);
                        jQuery(strthis).parent().parent().css({
                                     'background-position' : '0px -' + newrate*15 + 'px'
                        });
                        
                    }
               });
           });
           
});

    window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return t;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
    Share = {
        url: "",
	vkontakte: function(purl, ptitle, pimg, text) {

		url  = 'http://vkontakte.ru/share.php?';

		url += 'url='          + encodeURIComponent(purl);

		url += '&title='       + encodeURIComponent(ptitle);

		url += '&description=' + encodeURIComponent(text);

		url += '&image='       + encodeURIComponent(pimg);

		url += '&noparse=true';

		Share.popup(url);

	},

	odnoklassniki: function(purl, text) {

		url  = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';

		url += '&st.comments=' + encodeURIComponent(text);

		url += '&st._surl='    + encodeURIComponent(purl);

		Share.popup(url);

	},

	facebook: function(purl, ptitle, pimg, text) {

		url  = 'http://www.facebook.com/sharer.php?s=100';

		url += '&p[title]='     + encodeURIComponent(ptitle);

		url += '&p[summary]='   + encodeURIComponent(text);

		url += '&p[url]='       + encodeURIComponent(purl);

		url += '&p[images][0]=' + encodeURIComponent(pimg);
                console.log(url);

		Share.popup(url);
                

	},

	twitter: function(purl, ptitle) {

		url  = 'http://twitter.com/share?';

		url += 'text='      + encodeURIComponent(ptitle);

		url += '&url='      + encodeURIComponent(purl);

		url += '&counturl=' + encodeURIComponent(purl);

		Share.popup(url);

	},

	mailru: function(purl, ptitle, pimg, text) {

		url  = 'http://connect.mail.ru/share?';

		url += 'url='          + encodeURIComponent(purl);

		url += '&title='       + encodeURIComponent(ptitle);

		url += '&description=' + encodeURIComponent(text);

		url += '&imageurl='    + encodeURIComponent(pimg);

		Share.popup(url)

	},

	google: function(purl) {

		url  = 'https://plus.google.com/share?';

		url += '&url='      + encodeURIComponent(purl);

		Share.popup(url);

	},



	popup: function(url) {

		window.open(url,'','toolbar=0,status=0,width=626,height=436');

	}

};
</script>

  <?php return ob_get_clean(); ?>

<?php  } ?>


    