/*
 * 	Easy Tooltip 1.0 - jQuery plugin
 *	written by Alen Grakalic
 *	http://cssglobe.com/post/4380/easy-tooltip--jquery-plugin
 *
 *	Copyright (c) 2009 Alen Grakalic (http://cssglobe.com)
 *	Dual licensed under the MIT (MIT-LICENSE.txt)
 *	and GPL (GPL-LICENSE.txt) licenses.
 *
 *	Built for jQuery library
 *	http://jquery.com
 *
 */

(function($) {

	$.fn.easyTooltip = function(options){

		// default configuration properties
		var defaults = {
			xOffset: 10,
			yOffset: 25,
			tooltipId: "easyTooltip",
			clickRemove: false,
			content: "",
			useElement: "",
            fixed: false,
            wavee: false,
            keepHover: false,
            width: 0,
            height: 0
		};

		var options = $.extend(defaults, options);
		var content;

		this.each(function() {
			var title = $(this).attr("title");
            var hiddenFilter = "";

			$(this).hover(function(e){
                if(options.wavee) {
                    clearTimeout(window.easyTimeout);
                    if(options.keepHover) {
                        $("#global-tooltip").removeClass("no-hover");
                    }
                    else {
                        $("#global-tooltip").addClass("no-hover");
                    }
                    var contentChanged = buildGlobalTooltip(options.width,options.height,options.content,options.useElement);
                    if(!contentChanged) {
                        hiddenFilter = ":hidden";
                    }
                    content = "wavee";
                    options.tooltipId = "global-tooltip";
                }
                else {
                    content = (options.content != "") ? options.content : title;
                    content = (options.useElement != "") ? $("#" + options.useElement).html() : content;
                }
				$(this).attr("title","");
				if (content != "" && content != undefined){
                    var x = 0;
                    var y = 0;
                    var strPosition = "absolute";
                    if(options.fixed) {
                        if(options.fixed == 2) {
                            strPosition = "absolute";
                            if(typeof e.pageX != 'undefined'){
                                var sensitivityPixels = 100;
                                if(options.width > sensitivityPixels) sensitivityPixels = options.width;
                                //get a consistent mouse reading to serve as anchor coordinates
                                x = Math.round((e.pageX)/sensitivityPixels)*sensitivityPixels;
                                y = Math.round((e.pageY)/sensitivityPixels)*sensitivityPixels;
                            }
                        }
                        else if(options.fixed == 3) {
                            x = $(this).attr("offsetLeft");
                            y = $(this).attr("offsetTop");
                            strPosition = "absolute";
                        }
                        else {
                            x = $(this).attr("offsetLeft");
                            y = $(this).attr("offsetTop");
                            strPosition = "fixed";
                        }
                    }
                    else if(typeof e.pageX != 'undefined'){
                        x = e.pageX;
                        y = e.pageY;
                    }
                    if(!options.wavee) {
                        $("body").append("<div id='"+ options.tooltipId +"'>"+ content +"</div>");
                    }
                    if($("#" + options.tooltipId).css("left") != (x + options.xOffset) + "px") {
                        hiddenFilter = "";
                    }
					$("#" + options.tooltipId + hiddenFilter)
						.css("position",strPosition)
						.css("top",(y - options.yOffset) + "px")
						.css("left",(x + options.xOffset) + "px")
						.css("display","none")
						.fadeIn("fast");
				}
			},function(e){
                if(options.wavee) {
                    var nTimeout = 10;
                    var objGlobalTooltip = $("#global-tooltip");
                    if(options.keepHover) {
                        objGlobalTooltip.hover(function(e){
                            if(!$("#global-tooltip").hasClass("no-hover")) {
                                clearTimeout(window.easyTimeout);
                            }
                        },
                        function(){
                            if(!$("#global-tooltip").hasClass("no-hover")) {
                                clearTimeout(window.easyTimeout);
                                window.easyTimeout = window.setTimeout("fadeGlobalTooltip()",300);
                            }
                        });
                        nTimeout = 400;
                    }
                    clearTimeout(window.easyTimeout);
                   // window.easyTimeout = window.setTimeout("hideGlobalTooltip()",nTimeout);
                }
                else {
                    $("#" + options.tooltipId).remove();
                }
				$(this).attr("title",title);
			});

            if(!options.fixed) {
                $(this).mousemove(function(e){
                    $("#" + options.tooltipId)
                        .css("top",(e.pageY - options.yOffset) + "px")
                        .css("left",(e.pageX + options.xOffset) + "px");
                });
            }

			if(options.clickRemove){
				$(this).mousedown(function(e){
                    if(options.wavee) {
                        $("#global-tooltip").hide();
                    }
                    else {
                        $("#" + options.tooltipId).remove();
                    }
					$(this).attr("title",title);
				});
			}
		});

	};

})(jQuery);
