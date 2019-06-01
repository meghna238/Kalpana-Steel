if (typeof allowZooming != 'undefined' &&  allowZooming != 'off') {
    if (jQuery(window).width() >= 600) {
        jQuery('.product-catalog-content.liquid-slider ').find(for_zoom).hover(function () {
            for_zoom = jQuery(this);
            zoom_start2();
        }, function () {
            zoom_resize();
        });
        zoom_start();
        jQuery(window).resize(function () {
            zoom_resize();
        });
    }
}

jQuery(window).resize(function () {
    if (typeof allowZooming != 'undefined' &&  allowZooming != 'off') {
        if (jQuery(window).width() >= 600) {
            jQuery('.main-image-block.not_for_zoom').hide();
            jQuery('.main-image-block.for_zoom').show();
            jQuery('.product-catalog-content.liquid-slider ').find(for_zoom).hover(function () {
                for_zoom = jQuery(this);
                zoom_start2();
            }, function () {
                zoom_resize();
            });
            zoom_start();
        }
        else {
            jQuery('.main-image-block.for_zoom').hide();
            jQuery('.main-image-block.not_for_zoom').show();
        }
    }
});
jQuery(window).resize();
function zoom_resize() {
    jQuery('img.zoomed').removeData('elevateZoom');//remove zoom instance from image
    jQuery('.zoomWrapper img.zoomed').unwrap();
    jQuery('.zoomContainer2').remove();
    if (jQuery(window).width() > 640) {
        jQuery('.product-catalog-content.liquid-slider ').find(for_zoom).hover(function () {
            for_zoom = jQuery(this);
            zoom_start2();
        });
        zoom_start();
    }
    var image_width, image_height;
    jQuery('.main-image-block a').find("img").each(function () {
        image_width = jQuery(this).width();
        image_height = jQuery(this).find("img").height();
        jQuery('.zoomWrapper').width(image_width);
        jQuery('.zoomWrapper').height(image_height);
    });


}

function zoom_start() {
    if (allowZooming == "on") {
        jQuery('.product-catalog-content').not('.liquid-slider').each(function () {
            if (catalogZoomType == "window") {
                jQuery(this).find(for_zoom).elevateZoom({
                    responsive: true,
                    imageCrossfade: true,
                    loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif',
                    easingType: "zoomdefault",
                    easingDuration: 2000,
                    containLensZoom: false,

                    //    //////////////////////     Zoom Window      ///////////////////////

                    zoomType: catalogZoomType,
                    zoomWindowWidth: catalogWindowWidth,
                    zoomWindowHeight: catalogWindowHeight,
                    zoomWindowOffetx: catalogWindowOffetx,
                    zoomWindowOffety: catalogWindowOffety,
                    zoomWindowPosition: catalogWindowPosition,
                    zoomWindowFadeIn: catalogWindowFadeIn,
                    zoomWindowFadeOut: catalogWindowFadeOut, //
                    borderSize: catalogBorderSize,
                    borderColour: "#" + catalogBorderColour,
                    lensSize: catalogLensSize,
                    constrainSize: 200,

                    //////////////////////     Lens Options

                    lensFadeIn: catalogLensFadeIn,
                    lensFadeOut: catalogLensFadeOut,
                    lensShape: catalogLensShape,
                    lensColour: "#" + catalogLensColour,
                    lensOpacity: catalogLensOpacity,
                    lenszoom: false,
                    cursor: catalogCursor,
                    scrollZoom: catalogScrollZoom,
                    easing: catalogEasing,
                    tint: catalogTint,
                    tintColour: "#" + catalogTintColour,
                    tintOpacity: catalogTintOpacity,
                    zoomTintFadeIn: catalogZoomTintFadeIn,
                    zoomTintFadeOut: catalogZoomTintFadeOut
                });

            }
            else {
                jQuery(this).find(for_zoom).elevateZoom({
                    responsive: true,
                    imageCrossfade: true,
                    loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif',
                    easingType: "zoomdefault",
                    easingDuration: 2000,
                    containLensZoom: true,
                    zoomType: catalogZoomType,
                    lensFadeIn: catalogLensFadeIn,
                    lensFadeOut: catalogLensFadeOut,
                    lensShape: catalogLensShape,
                    lensColour: "#" + catalogLensColour,
                    lensOpacity: catalogLensOpacity,
                    lenszoom: false,
                    cursor: catalogCursor,
                    scrollZoom: catalogScrollZoom,
                    easing: catalogEasing
                });
            }
        });

    }
}

function zoom_start2() {
    jQuery('.product-catalog-content.liquid-slider ').each(function () {

        if (catalogZoomType == "window") {

            jQuery(this).find(for_zoom).elevateZoom2({
                responsive: true,
                imageCrossfade: true,
                loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif',
                easingType: "zoomdefault",
                easingDuration: 2000,
                containLensZoom: false,

                //    //////////////////////     Zoom Window      ///////////////////////

                zoomType: catalogZoomType,
                zoomWindowWidth: catalogWindowWidth,
                zoomWindowHeight: catalogWindowHeight,
                zoomWindowOffetx: catalogWindowOffetx,
                zoomWindowOffety: catalogWindowOffety,
                zoomWindowPosition: catalogWindowPosition,
                zoomWindowFadeIn: catalogWindowFadeIn,
                zoomWindowFadeOut: catalogWindowFadeOut, //
                borderSize: catalogBorderSize,
                borderColour: "#" + catalogBorderColour,
                lensSize: catalogLensSize,
                constrainSize: 200,

                //////////////////////     Lens Options

                lensFadeIn: catalogLensFadeIn,
                lensFadeOut: catalogLensFadeOut,
                lensShape: catalogLensShape,
                lensColour: "#" + catalogLensColour,
                lensOpacity: catalogLensOpacity,
                lenszoom: false,
                cursor: catalogCursor,
                scrollZoom: catalogScrollZoom,
                easing: catalogEasing,
                tint: catalogTint,
                tintColour: "#" + catalogTintColour,
                tintOpacity: catalogTintOpacity,
                zoomTintFadeIn: catalogZoomTintFadeIn,
                zoomTintFadeOut: catalogZoomTintFadeOut
            });

        }
        else {
            jQuery(this).find(for_zoom).elevateZoom2({
                responsive: true,
                imageCrossfade: true,
                loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif',
                easingType: "zoomdefault",
                easingDuration: 2000,
                containLensZoom: true,
                zoomType: catalogZoomType,
                lensFadeIn: catalogLensFadeIn,
                lensFadeOut: catalogLensFadeOut,
                lensShape: catalogLensShape,
                lensColour: "#" + catalogLensColour,
                lensOpacity: catalogLensOpacity,
                lenszoom: false,
                cursor: catalogCursor,
                scrollZoom: catalogScrollZoom,
                easing: catalogEasing
            });
        }
    });
}