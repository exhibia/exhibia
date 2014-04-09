	function hexToRgb(hex) {
	
	      try{
				  if(hex != '' & hex != 'undefined'){
					if(hex == 'transparent'){
					return 'rgba(0, 0, 0, 0)';
					
					}else{
					 if(hex.match('#')){
					try{
					    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
						  hex = hex.replace(shorthandRegex, function(m, r, g, b) {
						    return r + r + g + g + b + b;
					      });
					      }catch(oo){}
					   
						    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
						    
							r = parseInt(result[1], 16);
							g = parseInt(result[2], 16);
							b = parseInt(result[3], 16);
						  return 'rgba(' + r + ', ' + g + ', ' + b + ', 100)';
						  }else{
						  
						  return hex;
						  }

					  }
				 
				      }else{
					  return 'rgba(0,0,0, 0)';
				 
				 
				 }
				 
				 }catch(oops){  return 'rgba(0,0,0, 0)'; }
			      
			      }	