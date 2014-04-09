    function PAS_parseScript(_source) {
		var source = _source;
		var scripts = new Array();
		
		while(source.indexOf("<script") > -1 || source.indexOf("</script") > -1) {
			var s = source.indexOf("<script");
			var s_e = source.indexOf(">", s);
			var e = source.indexOf("</script", s);
			var e_e = source.indexOf(">", e);
			
			// Add to scripts array
			scripts.push(source.substring(s_e+1, e));
			// Strip from source
			source = source.substring(0, s) + source.substring(e_e+1);
		}
		
		// Loop through every script collected and eval it
		for(var i=0; i<scripts.length; i++) {
			try {
				eval(scripts[i]);
			}catch(ex) {}
				
		      }
		
		
		// Return the cleaned source
		return source;

    }