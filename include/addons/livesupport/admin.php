<?php
// create session so we can keep track of users
session_start();

// check login
function isLoggedIn() {
    if ($_SESSION['valid'])
        return true;
    return false;
}

if (!isLoggedIn()) {
    header('Location: login.php');
    die();
}
// mysql interaction
include "includes/base.php";
include "includes/functions.php";
// get whether available or not
$current = db_query("SELECT available FROM users WHERE name = 'admin' ");
$result = db_fetch_array($current);

$_SESSION['username'] = 'admin';
if ($result['available'] == "yes") {
    $avail_string = '<h4><a href="#" onClick="available(false);"><img src="images/icons/available.png" title="Click to change availability" height="30" style="vertical-align:middle;"/>&nbsp;&nbsp;Available</a></h4>';
} else {
    $avail_string = '<h4><a href="#" onClick="available(false);"><img src="images/icons/unavailable.png" title="Click to change availability" height="30" style="vertical-align:middle;"/>&nbsp;&nbsp;Not Available</a></h4>';
}
// update keepalive
db_query("UPDATE users SET keepAlive = '" . time() . "' WHERE username = '" . $_SESSION['username'] . "' ");

//check for delete convo
if (isset($_POST['delete_convo'])) {
    // check to see if conversation is to be stored
    $check = db_query("SELECT * FROM sessions WHERE convoID = '" . $_POST['id'] . "' ");
    $check_result = db_fetch_array($check);
    if ($check_result['contact'] == "yes") {
        $idd = $_POST['id'];
        archive($idd, $check_result['name'], $check_result['email']);
    }
    include "includes/date.php";
    $timeStamp = date('g:i a');
    db_query("UPDATE sessions SET status = 'closed', ended = '" . time() . "', hide = 'yes'  WHERE convoID = '" . $_POST['id'] . "' ");
    db_query("INSERT INTO transcript
        (name,message,user,convoID,time,class)
        VALUES
        ('" . $_SESSION['name'] . "','has ended the conversation','" . $_SESSION['userID'] . "','" . $_POST['id'] . "','" . $timeStamp . "','notice')
        ");
}
// grab config data
$fetch_config = db_query("SELECT * FROM config ORDER BY id ASC LIMIT 1 ");
$config = db_fetch_array($fetch_config);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Live Assist!</title>
        <link rel="stylesheet" type="text/css" media="all" href="css/global.css" />
        <link rel="stylesheet" type="text/css" media="all" href="css/colorbox.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="js/admin.js"></script>
        <script type="text/javascript" src="js/cufon-yui.js"></script>
        <script type="text/javascript" src="js/font_400.font.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                Cufon.replace('h4,h3,h2,h1,label,a');
                $("#chat-list li").click(function(){
                    window.location=$(this).find("a").attr("href"); return false;
                });
                setChecker();
                setInterval("setChecker();",10000);
                setTimer('<?= $_SESSION['username']; ?>');
                setInterval("setTimer('<?= $_SESSION['username']; ?>');",120000);
                $(".delete_convo").colorbox({opacity:0.9});
            });
            // set refresh rate of conversations list
            var convoRefresh = <?= $config['adminRefresh']; ?>;
            // set refresh rate of chat window
            var chatRefresh = <?= $config['convoRefresh']; ?>;
            // by default we want to retrieve dashboard
            var activeConvo = "open";
            // set up auto refresh to pull new entries into chat window
            var intervalID = setInterval("getInput(activeConvo);", chatRefresh);
            // populate convo list
            function currentConvos() {
                var ajaxCurrent;
                try{
                    ajaxCurrent = new XMLHttpRequest();
                } catch (e){
                    try{
                        ajaxCurrent = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try{
                            ajaxCurrent = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                            alert("There appears to have been a problem, please reload the page.");
                            return false;
                        }
                    }
                }
                ajaxCurrent.onreadystatechange = function(){
                    if(ajaxCurrent.readyState == 1) {
                    }
                    if(ajaxCurrent.readyState == 4){
                        document.getElementById('currentConvos').innerHTML = "";
                        $('#currentConvos').append(ajaxCurrent.responseText);

                    }
                }
                ajaxCurrent.open("GET", "includes/currentConvos.php?output=true",true);
                ajaxCurrent.send(null);
            } // close currentConvos()

            function sendInput(convoID) {
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
                }
                ajaxInsert.onreadystatechange = function(){
                    if(ajaxInsert.readyState == 4){
                        getInput(convoID);
                    }
                }

        
                var message = document.getElementById('messageID').value;
                var user = document.getElementById('userID').value;
                var name = document.getElementById('userName').value;
                var queryString = "?message=" + message + "&userID=" + user + "&name=" + name + "&convoID=" + convoID;
                ajaxInsert.open("GET", "includes/insertAdmin.php" + queryString, true);
                ajaxInsert.send(null);
                if(document.getElementById('messageID').value = message) {
                    document.getElementById('messageID').value = "";
                }
            } // close sendInput()

            function getInput(convoID) {
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
                var queryString = "?id=" + convoID;
                ajaxGet.open("GET", "includes/retrieveAdmin.php" + queryString, true);
                ajaxGet.send(null);
		
            } // close getInput()
            function getInfo(user) {
                var ajaxInfo;
                try{
                    ajaxInfo = new XMLHttpRequest();
                } catch (e){
                    try{
                        ajaxInfo = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try{
                            ajaxInfo = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                            alert("There appears to have been a problem, please reload the page.");
                            return false;
                        }
                    }
                }
                ajaxInfo.onreadystatechange = function(){
                    if(ajaxInfo.readyState == 4){
                        document.getElementById('user_info').innerHTML = ajaxInfo.responseText;
                        Cufon.replace('h3,th')
                    }
                }
                var queryString = "?info=" + user;
                ajaxInfo.open("GET", "includes/user_info.php" + queryString, true);
                ajaxInfo.send(null);

            }
            function available() {
                var ajaxAvailable;
                try{
                    ajaxAvailable = new XMLHttpRequest();
                } catch (e){
                    try{
                        ajaxAvailable = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try{
                            ajaxAvailable = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e){
                            alert("There appears to have been a problem, please reload the page.");
                            return false;
                        }
                    }
                }
                ajaxAvailable.onreadystatechange = function(){
                    if(ajaxAvailable.readyState == 4){
                        document.getElementById('available').innerHTML = ajaxAvailable.responseText;
                        Cufon.replace('h4')
                    }
                }
                ajaxAvailable.open("GET", "includes/availability.php?user=<?= $_SESSION['username']; ?>", true);
                ajaxAvailable.send(null);

            }

        </script>
    </head>
    <body>
        <div id="main_container">
            <div class="container_12">
                <div class="grid_9">
                    <h1 class="ls"><img src="images/chat.png" alt="Live Support" title="Live Support" width="42" />&nbsp;&nbsp;Live Support Dashboard</h1>

                </div>
                <div class="grid_3">
                    <ul class="navigation">
                        <li><a href="admin.php"><img src="images/navhome.png" alt="Dashboard" title="Dashboard" width="40" style="margin-right:10px;"/></a></li>
                        <li><a href="leads.php"><img src="images/navleads.png" alt="Leads" title="Leads" width="40" style="margin-right:10px;"/></a></li>
                        <li><a href="users.php"><img src="images/navusers.png" alt="User Admin" title="User Admin" width="40" style="margin-right:10px;"/></a></li>
                        <li><a href="maint.php"><img src="images/navmaint.png" alt="Maintenance" title="Maintenance" width="40" style="margin-right:10px;" /></a></li>
                    </ul>

                </div>
                <div class="clear">&nbsp;</div>
                <div class="grid_3">
<?php if ($_SESSION['admin'] == "Yes") { ?>
                    <h4><img src="images/icons/admin.png" alt="Admin User" title="Admin User" height="30" style="vertical-align:middle;" /> <?= $_SESSION['name']; ?> | <a href="logout.php"><span class="red">logout</span></a> </h4>
<?php } else { ?>
                    <h4><img src="images/icons/standard.png" alt="Standard User" title="Standard User" height="30" style="vertical-align:middle;" /> <?= $_SESSION['name']; ?> | <a href="logout.php"><span class="red">logout</span></a></h4>
<?php } ?>
                </div>
                <div class="grid_2">
                    <div id="available"><?= $avail_string; ?></div>
                </div>
                <div class="grid_2">
                    <h4><a href="#" onClick="toggleMute();"><img id="muter" src="images/icons/sound.png" alt="Mute / Un Mute audio alerts" title="Mute / Un Mute audio alerts" height="30" style="vertical-align:middle;" /> Audio Alerts</a></h4>

                </div>
                <div class="clear">&nbsp;</div>


                <div class="grid_12"><div class="heading_light">&nbsp;</div></div>
                <div class="clear">&nbsp;</div>

                <div class="grid_3">
                    <div class="heading_solid">
                        <h3><img src="images/icons/identity.png" width="32" /> Current Chats</h3>
                    </div>
                    <div id="currentConvos"></div>
                </div>

                <script type="text/javascript">
                    currentConvos();
                    setInterval("currentConvos();",convoRefresh);
                </script>

                <div class="grid_9">
                    <!--- Chat container -->
                    <div class="chatContainer">
                        <div class="heading_solid">
                            <h3><img src="images/icons/userm.png" width="32" /> Active Conversation</h3>
                        </div>
                        <!--- user info output -->
                        <div id="user_info">
                            <script type="text/javascript">getInfo('open');</script>
                        </div>
                        <!--- chat output -->
                        <div id="chatOutput"></div>
                        <!--- Input form -->
                        <form action="javascript:sendInput(activeConvo);" id="inputForm">
                            <form name="messageInput" id="MessageInput" action="javascript:sendInput(activeConvo);">
                                <input type="hidden" name="userID" id="userID" value="<?= $_SESSION['userID']; ?>" />
                                <input type="hidden" name="userName" id="userName" value="<?= $_SESSION['name']; ?>" />
                                <input type="text" name="messageID" id="messageID" size="81" class="input_field" >
                                    <input type="submit" value="Send Message" class="input_field submit"/>&nbsp;&nbsp;
                            </form>
                    </div>
                </div>
            </div>
            <div class="clear">&nbsp;</div>
        </div>
        <div class="clear">&nbsp;</div>
        <span id="audio_alert"></span>
    </body>
</html>
