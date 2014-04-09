function add_css3_rules(css){

    $.post( 'include/addons/design_suite/DESIGN/editor/parse_css.php?css=' + encodeURIComponent(css), function(response){
    
	if(response != ''){
	
	    return response;
	}else{
	
	    return response;
	}
    });


}