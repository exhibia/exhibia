var title = document.title;
var posDist;
var posNow = 0;
var popupRunning;
function popupAlert() {
        // Failsafe
        if( popupRunning) return;
                popupRunning = true;
                var div = document.getElementById( "popup");
                // Set start position
                div.style.display = "block";
                posDist = div.offsetHeight;
                div.style.height = "0px";
                div.style.overflow = "hidden";
                // Start appear....
                popupUp();
}
function popupUp() {
        var div = document.getElementById( "popup");
        // How far to go?
        var dist = posDist -posNow;
                if( dist >1) {
                        // Move up a bit
                        posNow += Math.ceil( dist /8);
                        div.style.height = posNow +"px";
                        setTimeout( "popupUp();", 25);
		} else {
			Cufon.replace('h3');
			playSound('includes/alert.mp3');
		}
}
function popupDown() {
        var div = document.getElementById( "popup");
        // How far to go?
        var dist = posNow;
                if( dist >1) {
                        // Move down a bit
                        posNow -= Math.ceil( dist /8);
                        div.style.height = posNow +"px";
                        setTimeout( "popupDown();", 20);
                } else {
                        // Done, reset the box
                        div.style.height = posDist +"px";
                        div.style.display = "none";
                        popupRunning = false;
                }
}

function setTimer(user) {
        var ajaxTimer;
        try{
                ajaxTimer = new XMLHttpRequest();
        } catch (e){
                try{
                        ajaxTimer = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                        try{
                                ajaxTimer = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                                alert("There appears to have been a problem, please reload the page.");
                                return false;
                        }
                }
        }
                ajaxTimer.open("GET", "includes/setTimer.php?user=" + user,true);
                ajaxTimer.send(null);
} // close setTimer()
function setChecker() {
        var ajaxChecker;
        try{
                ajaxChecker = new XMLHttpRequest();
        } catch (e){
                try{
                        ajaxChecker = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                        try{
                                ajaxChecker = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                                alert("There appears to have been a problem, please reload the page.");
                                return false;
                        }
                }
        }
        ajaxChecker.onreadystatechange = function(){
                if(ajaxChecker.readyState == 4){
                        if(ajaxChecker.responseText == "1") {
                        	document.title = "New Message!"; 
			        popupAlert();
                        } else {
				document.title = title;
			}
               }
        }
                ajaxChecker.open("GET", "includes/setChecker.php?output=true",true);
                ajaxChecker.send(null);
} // close setChecker()

function playSound(soundfile) {
 document.getElementById("audio_alert").innerHTML=
 "<embed src=\""+soundfile+"\" hidden=\"true\" autostart=\"true\" loop=\"false\" />";
 }

