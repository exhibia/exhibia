<?php 
// creat session so we can keep track of users
ob_start();
session_start();
if(empty($_SESSION['userID'])) {
        header('location: start.php');
}
include "includes/base.php";
// grab config data
$fetch_config = db_query("SELECT * FROM config ORDER BY id ASC LIMIT 1 ");
$config = db_fetch_array($fetch_config);
?>

<script type="text/javascript">
$(document).ready(function(){
                var intervalID = setInterval("getInput();", <?=$config['clientRefresh'];?>);
		getInput();
});
function sendInput() {  // open send input
        var ajaxInsert;
        try{
                ajaxInsert = new XMLHttpRequest();
        } catch (e){
                try{
                        ajaxInsert = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                        try{
                                ajaxInsert = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                                alert("There appears to have been a problem, please reload the page.");
                                return false;
                        }
                }
        } // close ajax request
        ajaxInsert.onreadystatechange = function(){
                if(ajaxInsert.readyState == 4){
			getInput();
		}
        }
		var message = document.getElementById('message').value;
		var user = document.getElementById('userID').value;
		var name = document.getElementById('userName').value;
		var convoID = document.getElementById('convoID').value;
	        var queryString = "?message=" + message + "&userID=" + user + "&name=" + name + "&convoID=" + convoID;
		if(message != "") {
	        	ajaxInsert.open("GET", "<?php echo $SITE_URL;?>include/addons/livesupport/includes/insert.php" + queryString, true);
		        ajaxInsert.send(null);
			if(document.getElementById('message').value = message) {
				document.getElementById('message').value = "";
			}
		}
} // close send input
function getInput() {  
        var ajaxGet;
        try{
                ajaxGet = new XMLHttpRequest();
        } catch (e){
                try{
                        ajaxGet = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                        try{
                                ajaxGet = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                                alert("There appears to have been a problem, please reload the page.");
                                return false;
                        }
                }
        } 
        ajaxGet.onreadystatechange = function(){
                if(ajaxGet.readyState == 4){
			document.getElementById('chatOutput').innerHTML = ajaxGet.responseText;
			var objDiv = document.getElementById('chatOutput');
                        objDiv.scrollTop = objDiv.scrollHeight;
                }
        }
                var convo = document.getElementById('convoID').value;
                var queryString = "?convo=" + convo;
                ajaxGet.open("GET", "<?php echo $SITE_URL; ?>include/addons/livesupport/includes/retrieve.php" + queryString, true);
                ajaxGet.send(null);
} // close get input
function kill_chat(convoID){

    $.ajax({
	    url: '<?php echo $SITE_URL; ?>include/addons/livesupport/stop.php?id=' + convoID,
	    method: 'get',
	    dataType: 'html',
	    success: function(response){
		
		window.location.href = window.location.href;
	    }
      });


}
</script>

		<!--- Container -->
		<div class="container_support" id="live_support">
				<h2><img src="images/icons/ls.png" width="38" alt="live support" title="Live Support" style="vertical-align:middle;" />&nbsp; Live Support <a href="javascript:kill_chat('<?=$_SESSION['convoID'];?>');" class="red small_text"> - Click here to terminate conversation</a></h2>
				</div>
				<!--- Chat output -->
				<div id="chatOutput"></div>
			<div id="client_input_container">
					<!-- Client Input -->
					<form action="javascript:sendInput();" name="messageInput" id="MessageInput">
					<input type="hidden" name="userID" id="userID" value="<?=$_SESSION['userID'];?>" />
					<input type="hidden" name="userName" id="userName" value="<?=$_SESSION['name'];?>" />
					<input type="hidden" name="convoID" id="convoID" value="<?=$_SESSION['convoID'];?>" />
					<input type="text" name="message" id="message" size="60" class="input_field" />
					<input type="submit" class="input_field submit" value="Send" /><br />
					</form>	

			</div>
		</div>



<?php ob_flush(); ?>
