var Redirectlocation='ban/ban.php';
	
function sajax(url, target) {
    // native XMLHttpRequest object
//    document.getElementById(target).innerHTML = '';
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = function() {
            ajaxDone(target);
        };
        req.open("GET", url, true);
        req.send(null);
        // IE/Windows ActiveX version
    } else if (window.ActiveXObject) {
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = function() {
                ajaxDone(target);
            };
            req.open("GET", url, true);
            req.send();
        }
    }
}

function ajaxDone(target) {
    // only if req is "loaded"
    if (req.readyState == 4) {
        // only if "OK"
        if (req.status == 200 || req.status == 304) {
            results = req.responseText;
            document.getElementById(target).innerHTML = results;
        } else {
            document.getElementById(target).innerHTML = "error:\n" + req.statusText;
        }
    }
}

function GET_XMLHTTPRequest() {
    var request;
    try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
    } catch(ex1) {
        try {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(ex2) {
            request = null;
        }
    }
    if (!request && typeof XMLHttpRequest != "undefined") {
        request = new XMLHttpRequest();
    }

    return request;
}

function ajax(url) {
    var req = GET_XMLHTTPRequest();
    if (req) {
        req.open("GET", url, true);
	    req.onreadystatechange = function (aEvt) {
    		if(req.readyState == 4){
				if(req.responseText=='1'){
				document.body.innerHTML ='';
				alert("You have been banned from this website!");
					window.location = Redirectlocation;
				}
		    }
	    };
        req.send(null);
    } else {
        alert("Ajax error!");
    }
}

ajax('ban/ban.php?check=javascript');