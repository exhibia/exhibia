<?php
session_start();
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
$lang='english';
$url='index.php';
if(isset($_GET['lang'])) {
    $lang=$_GET['lang'];
    
    if(isset($_GET['url'])) {
        $url=$_GET['url'];
    }

    $_SESSION['lang']=$lang;
    setcookie('lang', $lang, time()-(3600*24), '/');
    setcookie('lang', $lang, time()+(3600*24), '/');
}
//echo $_SESSION['lang'];
header('location:'.$url);
?>
