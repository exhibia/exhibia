var muted = "false";
var title = document.title;
function toggleMute() {
var data = document.getElementById('muter').src;
var m = data.match(/(.*)[\/\\]([^\/\\]+\.\w+)$/);
if(m[2] == "sound.png") {
document.getElementById('muter').src = "images/icons/mute.png";
muted = "true";
} else {
document.getElementById('muter').src = "images/icons/sound.png";
muted = "false";
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
				if(muted == "false") {
	                                playSound("includes/alert.mp3");
				}
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

