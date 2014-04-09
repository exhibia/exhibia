//STEALING CODE IS ILLEGAL, UNETHICAL, UNRIGHTFUL, UNTHOUGHTFUL, and SELFISH - DON'T DO IT!
//plz?

function HttpRequest() { var request;  var browser = navigator.appName; if(browser == "Microsoft Internet Explorer") { request = new ActiveXObject("Microsoft.XMLHTTP"); } else { request = new XMLHttpRequest(); } return request; } function Response(response) { document.getElementById('wol_minimized').innerHTML = response;   }  http = HttpRequest();  http.onreadystatechange = function() { if(http.readyState == 4) { Response(http.responseText); } } 
http.open('GET', "wol_display.php", true); 
http.send(null);