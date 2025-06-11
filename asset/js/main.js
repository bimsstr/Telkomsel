$(function(){
 "use strict";
    
/*----------------------------
    wow js active
------------------------------ */
    //new WOW().init();
    
/*----------------------------
    jQuery MeanMenu
------------------------------ */
	//jQuery('nav#dropdown').meanmenu();	
	
/*----------------------------
    Best Sell Owl Carousel
------------------------------ */  
/*
    $(".best-sell-slider").owlCarousel({
        autoPlay: false, 
        slideSpeed:2000,
        pagination:false,
        navigation:true,	  
        items : 2,
*/
        /* transitionStyle : "fade", */    /* [This code for animation ] */
/*
        navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        itemsDesktop : [1199,2],
        itemsDesktopSmall : [980,3],
        itemsTablet: [768,2],
        itemsMobile : [479,1],
    });
*/
/*----------------------------
    Partner Owl Carousel
------------------------------ */  
/*
    $(".partner-carousel").owlCarousel({
        autoPlay: false, 
        slideSpeed:2000,
        pagination:false,
        navigation:true,	  
        items : 4,
*/
        /* transitionStyle : "fade", */    /* [This code for animation ] */
/*
        navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [980,3],
        itemsTablet: [768,2],
        itemsMobile : [479,1],
    });
*/
/*----------------------------
    Price Slider Activate
------------------------------ */  
/*
    $( "#slider-range" ).slider({
        range: true,
        min: 110,
        max: 300,
        values: [ 120, 240 ],
        slide: function( event, ui ) {
		$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
	   " - $" + $( "#slider-range" ).slider( "values", 1 ) );  
 */
/*--------------------------
    ScrollUp
---------------------------- */	
    $.scrollUp({
        scrollName: 'scrollUp',
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade',
        animationInSpeed: 2000
    });	   
 
/*--------------------------
    Counter Up
---------------------------- */	
    //$('.counter').counterUp({
    //    delay: 70,
    //    time: 5000
    //});
    
/*------------------------------------
    Tooltip
-------------------------------------- */
    $('[data-toggle="tooltip"]').tooltip(); 
	
/*------------------------------------
    Middle Images
-------------------------------------- */
	//$(".middle-block").middleblock();
	
/*------------------------------------
    Gallery PopUp
-------------------------------------- */
	$(".gallery").each(function(){
		$(this).magnificPopup({
			delegate: "a", // child items selector, by clicking on it popup will open
			type: "image",
			gallery:{
				enabled:true
			}
		});
		
	});

/*------------------------------------
    Checkbox & Radio
-------------------------------------- */
	$(".checkbox input[type='checkbox'], .radio input[type='radio']").each(function(){
        if ($(this).is(":checked")) {
            $(this).closest(".checkbox").addClass("checked");
            $(this).closest(".radio").addClass("checked");
        }
    });
    $(".checkbox input[type='checkbox']").bind("change", function(){
        if ($(this).is(":checked")) {
            $(this).closest(".checkbox").addClass("checked");
        } else {
            $(this).closest(".checkbox").removeClass("checked");
        }
    });
    $(".radio input[type='radio']").bind("change", function(event, ui){
        if ($(this).is(":checked")) {
            var name = $(this).prop("name");
            if (typeof name != "undefined") {
                $(".radio input[name='" + name + "']").closest('.radio').removeClass("checked");
            }
            $(this).closest(".radio").addClass("checked");
        }
    });
    
});

// middle block plugin(set image in the middle of its parent object)
/*
;(function(window, document, $) {
    var middleblock;
    var prototype = $.fn;
    middleblock = prototype.middleblock = function() {
        var $this = this;
        if ($(this).is(":visible")) {
            $this.bind("set.middleblock", set_middle_block).trigger('set.middleblock');
        }
        return $this;
    };

    function set_middle_block(event, value) {
        var $this = $(this);
        var $middleItem = $this.find(".middle-item");
        if ($middleItem.length < 1) {
            $middleItem = $this.children("img");
        }
        if ($middleItem.length < 1) {
            return;
        }
        var width = $middleItem.width();
        var height = $middleItem.height();
        if ($this.width() <= 1) {
            var parentObj = $this;
            while (parentObj.width() <= 1) {
                parentObj = parentObj.parent();
            }
            $this.css("width", parentObj.width() + "px");
        }
        $this.css("position", "relative");
        $middleItem.css("position", "absolute");

        if ($this.hasClass("middle-block-auto-height")) {
            $this.removeClass("middle-block-auto-height");
            $this.height(0);
        }
        if ($this.height() <= 1) {
            var parentObj = $this;
            while (parentObj.height() <= 1) {
                if (parentObj.css("float") =="left" && parentObj.index() == 0 && parentObj.next().length > 0) {
                    parentObj = parentObj.next();
                } else if (parentObj.css("float") == "left" && parentObj.index() > 0) {
                    parentObj = parentObj.prev();
                } else {
                    parentObj = parentObj.parent();
                }
            }
            $this.css("height", parentObj.outerHeight() + "px");
            $this.addClass("middle-block-auto-height");

            width = $middleItem.width();
            height = $middleItem.height();
            if (height <= 1) {
                height = parentObj.outerHeight();
            }
        }
        $middleItem.css("top", "50%");
        $middleItem.css("margin-top", "-" + (height / 2) + "px");
        if (width >= 1) {
            if ($this.width() == width) {
                $this.width(width);
            }
            $middleItem.css("left", "50%");
            $middleItem.css("margin-left", "-" + (width / 2) + "px");
        } else {
            $middleItem.css("left", "0");
        }
    }
}(this, document, jQuery));
*/