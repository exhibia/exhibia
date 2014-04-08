<?php
//This file is now deprecated but may still be needed in a few places
//Functions are now loaded from the Functions folder, but this is one
//of thoose weird instances where I am not sure of all of the files
//that might be referencing this one
if(!function_exists('SendMail')){
function SendMail($to, $subject, $mailcontent, $from) {

    $array = explode("@", $from, 2);
    $SERVER_NAME = $array[1];
    $username = $array[0];
    $fromnew = "From: $username@$SERVER_NAME\nReply-To:$username@$SERVER_NAME\n";
    mail($to, $subject, $mailcontent, $fromnew);
}
}
if(!function_exists('SendHTMLMail')){
function SendHTMLMail($to, $subject, $mailcontent, $from) {

    $array = explode("@", $from, 2);
    $SERVER_NAME = $array[1];
    $username = $array[0];
    $headers = "From: $username@$SERVER_NAME\nReply-To:$username@$SERVER_NAME\n";

 

    $headers .= "Date: " . date("l j F Y, G:i") . "\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: text/html;\n";
    

    mail($to, $subject, $mailcontent, $headers);
}
}
?>