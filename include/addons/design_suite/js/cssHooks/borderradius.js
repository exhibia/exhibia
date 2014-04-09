 (function($){   

    if ( !$.cssHooks ){
        //if not, output an error message
       // alert("jQuery 1.4.3 or above is required for this plugin to work");
        return;
    }
    div = document.createElement( "div" ),
    css = "background-image:gradient(linear,left top,right bottom, from(#9f9), to(white));background-image:-webkit-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-moz-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-o-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-ms-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-khtml-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:linear-gradient(left top,#9f9, white);background-image:-webkit-linear-gradient(left top,#9f9, white);background-image:-moz-linear-gradient(left top,#9f9, white);background-image:-o-linear-gradient(left top,#9f9, white);background-image:-ms-linear-gradient(left top,#9f9, white);background-image:-khtml-linear-gradient(left top,#9f9, white);";    
    div.style.cssText = css;
    
    $.support.linearGradient = div.style.backgroundImage.indexOf( "-moz-linear-gradient" )  > -1 ? '-moz-linear-gradient' :
    (div.style.backgroundImage.indexOf( "-webkit-gradient" )  > -1 ? '-webkit-gradient' :
    (div.style.backgroundImage.indexOf( "linear-gradient" )  > -1 ? 'linear-gradient' : false));
    if ( $.support.linearGradient)
    {
     
      $.cssHooks['linearGradientColors'] = { 
        get: function(elem){
	  try {
          var currentStyle=$.css(elem, 'backgroundImage'),gradient,colors=[];
	 
          gradient=currentStyle.match(/gradient(\(.*\))/g);
         if(gradient.length)
          {
            gradient=gradient[0].replace(/(linear|radial|from|\bto\b|gradient|top|left|bottom|right|\d*%)/g,'');
            colors= jQuery.grep(gradient.match(/(rgb\([^\)]+\)|#[a-z\d]*|[a-z]*)/g),function (s) { return jQuery.trim( s )!=''})
          }
         
	 
	  }catch(oo){ colors = new Array(); colors[0] = $.css(elem, 'backgroundColor');}
	   return colors;
	}
    };
    
       }
})(jQuery); 


(function($){   

    if ( !$.cssHooks ){
        //if not, output an error message
       // alert("jQuery 1.4.3 or above is required for this plugin to work");
        return;
    }
    div = document.createElement( "div" ),
    css = "background-image:gradient(linear,left top,right bottom, from(#9f9), to(white));background-image:-webkit-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-moz-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-o-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-ms-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-khtml-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:linear-gradient(left top,#9f9, white);background-image:-webkit-linear-gradient(left top,#9f9, white);background-image:-moz-linear-gradient(left top,#9f9, white);background-image:-o-linear-gradient(left top,#9f9, white);background-image:-ms-linear-gradient(left top,#9f9, white);background-image:-khtml-linear-gradient(left top,#9f9, white);";    
    div.style.cssText = css;
    
    $.support.linearGradient = div.style.backgroundImage.indexOf( "-moz-linear-gradient" )  > -1 ? '-moz-linear-gradient' :
    (div.style.backgroundImage.indexOf( "-webkit-gradient" )  > -1 ? '-webkit-gradient' :
    (div.style.backgroundImage.indexOf( "linear-gradient" )  > -1 ? 'linear-gradient' : false));
    if ( $.support.linearGradient)
    {
     
      $.cssHooks['linearGradientColors_options'] = { 
        get: function(elem){
	  
	  try{
          var currentStyle=$.css(elem, 'backgroundImage'),gradient;
	 
          gradient=currentStyle;
         if(gradient.length)
          {
            gradient=gradient[0];
            
          }
	  }catch(oo){ options = new Array(); options[0] = linear; }
          return gradient;
	}
    };
    
       }
})(jQuery);    
    
(function($){   

    if ( !$.cssHooks ){
        //if not, output an error message
       // alert("jQuery 1.4.3 or above is required for this plugin to work");
        return;
    }
    div = document.createElement( "div" ),
    css = "background-image:gradient(linear,left top,right bottom, from(#9f9), to(white));background-image:-webkit-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-moz-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-o-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-ms-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-khtml-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:linear-gradient(left top,#9f9, white);background-image:-webkit-linear-gradient(left top,#9f9, white);background-image:-moz-linear-gradient(left top,#9f9, white);background-image:-o-linear-gradient(left top,#9f9, white);background-image:-ms-linear-gradient(left top,#9f9, white);background-image:-khtml-linear-gradient(left top,#9f9, white);";    
    div.style.cssText = css;


     
    $.support.linearGradient = div.style.backgroundImage.indexOf( "-moz-linear-gradient" )  > -1 ? '-moz-linear-gradient' :
    (div.style.backgroundImage.indexOf( "-webkit-gradient" )  > -1 ? '-webkit-gradient' :
    (div.style.backgroundImage.indexOf( "linear-gradient" )  > -1 ? 'linear-gradient' : false));
    if ( $.support.linearGradient)
    {
    
      $.cssHooks['linearGradientColors_seperate'] = { 
	
        get: function(elem){
	  
	  try{
          var currentStyle=$.css(elem, 'backgroundImage'),gradient,colors=[];
	 
          gradient=currentStyle.match(/gradient(\(.*\))/g);
          if(gradient.length)
          {
            gradient=gradient[0].replace(/(linear|radial|from|\bto\b|gradient|top|left|bottom|right|\d*%)/g,'');
	    gradient = gradient.replace(/\(\,/, '');
	    gradient = gradient.replace(') )', ')');
	    
	    //rgb(125, 185, 232) , rgb(41, 137, 216) , rgb(32, 124, 202) , rgb(30, 87, 153) )
            colors= jQuery.grep(gradient.match(/(rgb\([^\)]+\)|#[a-z\d]*|[a-z]*)/g),function (s) { return jQuery.trim( s )!=''})
	    if(!colors.length){
	     colors = new Array();
	     
	      
	    }
          }else{
	     colors = new Array();
	     colors[0] = $.css(elem, 'backgroundColor');
	     colors[1] = $.css(elem, 'backgroundColor');
	     colors[2] = $.css(elem, 'backgroundColor');
	 
	    
	  }
	  
	  
          return colors;
        
	
	
 
	}catch(nograd){
	  
	   colors = new Array();
	     colors[0] = $.css(elem, 'backgroundColor');
	     colors[1] = $.css(elem, 'backgroundColor');
	     colors[2] = $.css(elem, 'backgroundColor');
	    
	  
	}
	}
      
      };
    }else{
      
      
       $.support.linearGradient = div.style.background.indexOf( "-moz-linear-gradient" )  > -1 ? '-moz-linear-gradient' :
    (div.style.background.indexOf( "-webkit-gradient" )  > -1 ? '-webkit-gradient' :
    (div.style.background.indexOf( "linear-gradient" )  > -1 ? 'linear-gradient' : false));
    if ( $.support.linearGradient)
    {
    
      $.cssHooks['linearGradientColors_seperate'] = { 
	
        get: function(elem){
	  
	  try{
          var currentStyle=$.css(elem, 'background'),gradient,colors=[];
	 
          gradient=currentStyle.match(/gradient(\(.*\))/g);
          if(gradient.length)
          {
            gradient=gradient[0].replace(/(linear|radial|from|\bto\b|gradient|top|left|bottom|right|\d*%)/g,'');
	    gradient = gradient.replace(/\(\,/, '');
	    gradient = gradient.replace(') )', ')');
	    
	    //rgb(125, 185, 232) , rgb(41, 137, 216) , rgb(32, 124, 202) , rgb(30, 87, 153) )
            colors= jQuery.grep(gradient.match(/(rgb\([^\)]+\)|#[a-z\d]*|[a-z]*)/g),function (s) { return jQuery.trim( s )!=''})
	    if(!colors.length){
	     colors = new Array();
	     
	      
	    }
          }else{
	     colors = new Array();
	     colors[0] = $.css(elem, 'backgroundColor');
	     colors[1] = $.css(elem, 'backgroundColor');
	     colors[2] = $.css(elem, 'backgroundColor');
	
	    
	  }
	  
	  
          return colors;
        
	
	
 
	}catch(nograd){
	  
	   colors = new Array();
	     colors[0] = $.css(elem, 'backgroundColor');
	     colors[1] = $.css(elem, 'backgroundColor');
	     colors[2] = $.css(elem, 'backgroundColor');

	  
	}
	}
      
      };
    }
    }
    
})(jQuery);










   
(function($){   

    if ( !$.cssHooks ){
        //if not, output an error message
       // alert("jQuery 1.4.3 or above is required for this plugin to work");
        return;
    }
    div = document.createElement( "div" ),
    css = "background-image:gradient(linear,left top,right bottom, from(#9f9), to(white));background-image:-webkit-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-moz-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-o-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-ms-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:-khtml-gradient(linear,left top,right bottom,from(#9f9),to(white));background-image:linear-gradient(left top,#9f9, white);background-image:-webkit-linear-gradient(left top,#9f9, white);background-image:-moz-linear-gradient(left top,#9f9, white);background-image:-o-linear-gradient(left top,#9f9, white);background-image:-ms-linear-gradient(left top,#9f9, white);background-image:-khtml-linear-gradient(left top,#9f9, white);";    
    div.style.cssText = css;


     
    $.support.linearGradient = div.style.backgroundImage.indexOf( "-moz-linear-gradient" )  > -1 ? '-moz-linear-gradient' :
    (div.style.backgroundImage.indexOf( "-webkit-gradient" )  > -1 ? '-webkit-gradient' :
    (div.style.backgroundImage.indexOf( "linear-gradient" )  > -1 ? 'linear-gradient' : false));
    if ( $.support.linearGradient)
    {
    
      $.cssHooks['linearGradientColors_points'] = { 
	
        get: function(elem){
	  
	  try{
		var currentStyle=$.css(elem, 'background'),gradient,colors=[];
	      
		gradient=currentStyle.match(/gradient(\(.*\))/g);
          if(gradient.length)
          { 
            gradient=gradient[0].replace(/(linear|radial|from|\bto\b|gradient|top|left|bottom|right)/g,'');
	    gradient = gradient.replace(/\(\,/, '');
	    gradient = gradient.replace(') )', ')');
	    
	    //rgb(125, 185, 232) , rgb(41, 137, 216) , rgb(32, 124, 202) , rgb(30, 87, 153) )
            colors= gradient.replace(/(rgb\([^\)]+\)\s|#[a-z\d]\s*|[a-z]\s*)/g, '');
	    
	    colors= colors.replace(/\(/g, '');
	    colors= colors.replace(/\)/g, '');

	    
	
	    //rgb(125, 185, 232) , rgb(41, 137, 216) , rgb(32, 124, 202) , rgb(30, 87, 153) )
            points= colors.split(', ');
	    if(!points.length){
	     points = new Array();
	     
	      
	    }
          }else{
	     points = new Array();
	     points[0] = '100%';
	    
	  }
	  
	  
          
        
	
	
 
	}catch(nograd){
	  
	   points = new Array();
	     points[0] = '100%';
	   
	  
	}
	
	
	return points;
	}
      
      };
    }
    
})(jQuery);




















/*! Copyright (c) 2010 Burin Asavesna (http://helloburin.com)
 * Licensed under the MIT License (LICENSE.txt).
 */
(function($) {
  if ( !$.cssHooks ) {
    throw("jQuery 1.4.3+ is needed for this plugin to work");
    return;
  }
 
  function styleSupport( prop ) {
    var vendorProp, supportedProp,
        capProp = prop.charAt(0).toUpperCase() + prop.slice(1),
        prefixes = ["Khtml", "Webkit", "O", "ms" ],
        div = document.createElement( "div" );
 
    if ( prop in div.style ) {
      supportedProp = prop;
    } else {
      for ( var i = 0; i < prefixes.length; i++ ) {
        vendorProp = prefixes[i] + capProp;
        if ( vendorProp in div.style ) {
          supportedProp = vendorProp;
          break;
        }
      }
    }
 
    div = null;
    $.support[ prop ] = supportedProp
    return supportedProp;
  }
 
  var borderRadius = styleSupport( "borderRadius" );

  // Set cssHooks only for browsers that
  // support a vendor-prefixed border radius
  if ( borderRadius && borderRadius != 'borderRadius' ) {
    $.cssHooks.borderRadius = {
      get: function( elem, computed, extra ) {
        return $.css( elem, borderRadius );
      },
      set: function( elem, value) {
        elem.style[ borderRadius ] = value;
      }
    };
  }
})(jQuery);

				(function( $ ) {
				      $.widget( "ui.combobox", {
				      _create: function() {
				      var input,
				      that = this,
				      wasOpen = false,
				      select = this.element.hide(),
				      selected = select.children( ":selected" ),
				      value = selected.val() ? selected.text() : "",
				      wrapper = this.wrapper = $( "<span>" )
				      .addClass( "ui-combobox" )
				      .insertAfter( select );
				      function removeIfInvalid( element ) {
				      var value = $( element ).val(),
				      matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
				      valid = false;
				      select.children( "option" ).each(function() {
				      if ( $( this ).text().match( matcher ) ) {
				      this.selected = valid = true;
				      return false;
				      }
				      });
				      if ( !valid ) {
				      // remove invalid value, as it didn't match anything
				      $( element )
				      .val( "" )
				      .attr( "title", value + " didn't match any item" )
				      .tooltip( "open" );
				      select.val( "" );
				      setTimeout(function() {
				      input.tooltip( "close" ).attr( "title", "" );
				      }, 2500 );
				      input.data( "ui-autocomplete" ).term = "";
				      }
				      }
				      input = $( "<input>" )
				      .appendTo( wrapper )
				      .val( value )
				      .attr( "title", "" )
				      .addClass( "ui-state-default ui-combobox-input" )
				      .autocomplete({
				      delay: 0,
				      minLength: 0,
				      source: function( request, response ) {
				      var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
				      response( select.children( "option" ).map(function() {
				      var text = $( this ).text();
				      if ( this.value && ( !request.term || matcher.test(text) ) )
				      return {
				      label: text.replace(
				      new RegExp(
				      "(?![^&;]+;)(?!<[^<>]*)(" +
				      $.ui.autocomplete.escapeRegex(request.term) +
				      ")(?![^<>]*>)(?![^&;]+;)", "gi"
				      ), "<strong>$1</strong>" ),
				      value: text,
				      option: this
				      };
				      }) );
				      },
				      select: function( event, ui ) {
				      ui.item.option.selected = true;
				      that._trigger( "selected", event, {
				      item: ui.item.option
				      });
				      },
				      change: function( event, ui ) {
				      if ( !ui.item ) {
				      removeIfInvalid( this );
				      }
				      }
				      })
				      .addClass( "ui-widget ui-widget-content ui-corner-left" );
				      input.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
				      return $( "<li>" )
				      .append( "<a>" + item.label + "</a>" )
				      .appendTo( ul );
				      };
				      $( "<a>" )
				      .attr( "tabIndex", -1 )
				      .attr( "title", "Show All Items" )
				      .tooltip()
				      .appendTo( wrapper )
				      .button({
				      icons: {
				      primary: "ui-icon-triangle-1-s"
				      },
				      text: false
				      })
				      .removeClass( "ui-corner-all" )
				      .addClass( "ui-corner-right ui-combobox-toggle" )
				      .mousedown(function() {
				      wasOpen = input.autocomplete( "widget" ).is( ":visible" );
				      })
				      .click(function() {
				      input.focus();
				      // close if already visible
				      if ( wasOpen ) {
				      return;
				      }
				      // pass empty string as value to search for, displaying all results
				      input.autocomplete( "search", "" );
				      });
				      input.tooltip({
				      tooltipClass: "ui-state-highlight"
				      });
				      },
				      _destroy: function() {
				      this.wrapper.remove();
				      this.element.show();
				      }
				      });
				      })( jQuery );
$(function() {
$( "#font-family" ).combobox();
$( "#font-weight" ).combobox();
});