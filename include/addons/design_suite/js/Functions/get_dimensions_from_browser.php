var get_dimensions_from_browser = function(divId){
   if($(divId).css('width') == $(document).css('width')){
   prompt('100%');
   
   
   }
    $('#width').val(extract_number_from_string($(divId).css('width')));
    $('#widthUnit').val(extract_text_from_string($(divId).css('width')));

    $('#height').val(extract_number_from_string($(divId).css('height')));
    $('#heightUnit').val(extract_text_from_string($(divId).css('height')));


}