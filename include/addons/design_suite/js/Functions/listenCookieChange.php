var cookieRegistry = [];	
  var getCookie = function(c_name)
      {
      var i,x,y,ARRcookies=document.cookie.split(";");
      for (i=0; i<ARRcookies.length;i++)
      {
	x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
	y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
	x=x.replace(/^\s+|\s+$/g,"");
	if (x==c_name)
	  {
	  return unescape(y);
	  }
	}
      }

  var checkCookie = function(cookie_name, cookie_value)
	{
	var cookie_set=getCookie(cookie_name);
	  if(cookie_set == cookie_value){
	    return 'true';
	  }else{
	    return 'false';
	  }
	}
	
      function listenCookieChange(cookieName, callback) {
	      setInterval(function() {
		  if (cookieRegistry[cookieName]) {
		      if (getCookie(cookieName) != cookieRegistry[cookieName]) {
			  // update registry so we dont get triggered again
			  cookieRegistry[cookieName] = getCookie(cookieName);
			  return callback();
		      }
		  } else {
		      cookieRegistry[cookieName] = getCookie(cookieName);
		  }
	      }, 100);
	  }
	  
	  
	  
	if(checkCookie('edit_mode', 'advanced') != 'true'){
	
	  setCookie('edit_mode','basic','365');
	
	
	}
      	
	    listenCookieChange('edit_mode', function() {
		 // $('.edit_css_interfaces').css('display', 'none');
		   $('.universal').css('display', 'block');
		 // $('.' + getCookie('edit_mode')).css('display', 'block');
	    });
	    


	    
	