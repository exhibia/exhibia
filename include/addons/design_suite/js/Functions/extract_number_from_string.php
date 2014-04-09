        var extract_number_from_string = function(str){
      
			value = 0;
		if(str !== 'auto' && str !== 'undefined'){
			value1 = str.replace( /[a-z]/g, '');//remove alpha
			if(!isNaN(value1)){
			    value = Math.round(value1);
			    }
		}
				return value;
				
      }