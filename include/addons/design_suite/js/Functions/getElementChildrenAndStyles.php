var getElementChildrenAndStyles = function (selector) {

  var html = $(selector);
  var b = 0;
 // var prefixes = get_prefixes();
  
  
  elts = $(selector);

  var rulesUsed = [];
  // main part: walking through all declared style rules
  // and checking, whether it is applied to some element
  sheets = document.styleSheets;
  try{
  for(var c = 0; c < sheets.length; c++) {
    var rules = sheets[c].rules || sheets[c].cssRules;
    for(var r = 0; r < rules.length; r++) {
      var selectorText = rules[r].selectorText;
      var matchedElts = $(selectorText);
      for (var i = 0; i < elts.length; i++) {
        if (matchedElts.index(elts[i]) != -1) {
        
		
		rulesUsed.push(rules[r]);
		
		
      
          break;
        }
      }
    }
  }
  }catch(oops){}
  
  var style = rulesUsed.map(function(cssRule){
  b++;
    if ($.browser.msie) {
      var cssText = cssRule.style.cssText.toLowerCase();
    } else {
   // prompt(cssRule.cssText);
	
	  
	     
	    var cssText = cssRule.cssText;
	      
	     
	 
    }
    // some beautifying of css

     
        


       
 return cssText.replace(/(\{|;)\s+/g, "\$1\n  ").replace(/\A\s+}/, "}");
   
    
    //                 set indent for css here ^ 
  }).join("\n");
  return style;
  
  }