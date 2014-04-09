var get_values_from_browser = function(selector){


data = '';

$('.lin-g').each(function(){

    id = $(this).attr('id');
    
    if($('#' + id).val() != ''){
    
      data += '&' + id + '=' +  encodeURIComponent($('#' + id).val());
    
    }
});

$('.rad-g').each(function(){
    id = $(this).attr('id');
    
    if($('#' + id).val() != ''){
    data += '&' + id + '=' +  encodeURIComponent($('#' + id).val());
    
    }

});

if($('#ms_filter').val() != ''){
    data += '&filter=' + encodeURIComponent($('#ms_filter').val());
    
 }
 if($('#svg').val() != ''){
    data += '&svg=' + encodeURIComponent($('#svg').val());
    
    }
    
   if($('#position').val() != 'absolute'){
   
    data += '&left=' + encodeURIComponent($('#xr').val() + 'px');
    data += '&top=' + encodeURIComponent($('#yr').val() + 'px');
    data += '&position=' + encodeURIComponent($('#position').val());
   
   
   }else{
   
    data += '&left=' + encodeURIComponent($('#x').val() + 'px');
    data += '&top=' + encodeURIComponent($(' #y').val() + 'px');
    data += '&position=' + encodeURIComponent($('#position').val());   
   
   
   }

    data += '&z-index=' + $(selector).css('zIndex');
    
    
    
    
    
    data += '&display=' + encodeURIComponent($(selector).css('display'));
    data += '&float=' + encodeURIComponent($(selector).css('float'));
    data += '&border-top=' + encodeURIComponent($('#borderTopWidth').val() + $('#borderTopUnit').val() + ' ' + $('#borderTopStyle').val() + ' ' + $('#borderTopColor').val());
    data += '&border-bottom=' + encodeURIComponent($('#borderBottomWidth').val() + $('#borderBottomUnit').val() + ' ' + $('#borderBottomStyle').val() + ' ' + $('#borderBottomColor').val());
    
    data += '&border-right=' + encodeURIComponent($('#borderRightWidth').val() + $('#borderRightUnit').val() + ' ' + $('#borderRightStyle').val() + ' ' + $('#borderRightColor').val());
     
    data += '&border-left=' + encodeURIComponent($('#borderLeftWidth').val() + $('#borderLeftUnit').val() + ' ' + $('#borderLeftStyle').val() + ' ' + $('#borderLeftColor').val());
    
    data += '&border-radius=' + encodeURIComponent($('#border-radius-hidden').val());
    
    
     data += '&padding=' + encodeURIComponent($('#paddingTop').val() + $('#paddingTopUnit').val() + ' ' + $('#paddingRight').val() + $('#paddingRightUnit').val() + ' ' + $('#paddingBottom').val() + $('#paddingBottomUnit').val() + ' ' + $('#paddingLeft').val() + $('#paddingLeftUnit').val());
     
     
      data += '&margin=' + encodeURIComponent($('#marginTop').val() + $('#marginTopUnit').val() + ' ' + $('#marginRight').val() + $('#marginRightUnit').val() + ' ' + $('#marginBottom').val() + $('#marginBottomUnit').val() + ' ' + $('#marginLeft').val() + $('#marginLeftUnit').val());
      if($('#text-indent-value').val() + $('#text-indent').val() != '0null'){
	    data += '&text-indent=' + encodeURIComponent($('#text-indent-value').val() + $('#text-indent').val());
       }
       data += '&text-align=' + encodeURIComponent($('#text-align').val());
	data += '&color=' + encodeURIComponent($(selector).css('color'));
	data += '&font-style=' + encodeURIComponent($(selector).css('fontStyle'));
	data += '&font-variant=' + encodeURIComponent($(selector).css('fontVariant'));
	data += '&font-weight=' + encodeURIComponent($(selector).css('font-weight'));
	data += '&font-family=' + encodeURIComponent($(selector).css('fontFamily'));
	
	  
	  
	      data += '&width=' + encodeURIComponent($('#width').val() + $('#widthUnit').val());
	     data += '&max-width=' + encodeURIComponent($('#max-width').val() + $('#max-widthUnit').val());
	      data += '&min-width=' + encodeURIComponent($('#min-width').val() + $('#min-widthUnit').val());
	
	  
	      data += '&height=' + encodeURIComponent($('#height').val() + $('#heightUnit').val());
	      data += '&max-height=' + encodeURIComponent($('#max-height').val() + $('#max-heightUnit').val());
	      data += '&min-height=' + encodeURIComponent($('#min-height').val() + $('#min-heightUnit').val());
	
	

	
	data += '&background-size=' +encodeURIComponent($('selector').css('backgroundSize'));
if(encodeURIComponent($(selector).css('backgroundColor')) != '' ){	
	data += '&background-color=' + encodeURIComponent($(selector).css('backgroundColor'));
}
if(!$(selector).css('backgroundImage').match(/gradient/)){
	data += '&background-image=' + encodeURIComponent($(selector).css('backgroundImage'));

	data += '&background-repeat=' + encodeURIComponent($(selector).css('backgroundRepeat'));
	data += '&background-attachment=' + encodeURIComponent($(selector).css('backgroundAttachment'));
}
	data += '&opacity=' + encodeURIComponent($(selector).css('opacity'));
if($('#box-shadow').val() != 'none)'){
	data += '&box-shadow=' + encodeURIComponent($('#box-shadow').val());
}
if($('#text-shadow').val() != 'undefined'){
	data += '&text-shadow=' + encodeURIComponent($('#text-shadow').val());
}
if($('#box-reflect').val() != ''){
	data += '&box-reflect=' + encodeURIComponent($('#box-reflect').val());
}
if($('#transition').val() != ''){
	data += '&transition=' + encodeURIComponent($('#transition').val());
}
if($('#transform').val() != ''){
	data += '&transform=' + encodeURIComponent($('#transform').val());
}
	data += '&background-position=' + encodeURIComponent($('#backgroundPosition').val());
	
	data += '&text-decoration=' + encodeURIComponent($('#text-decoration').val());
	
	return data;









}