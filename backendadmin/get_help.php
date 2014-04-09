<?php
ini_set('display_errors', 1);
session_start();
$active = "Database";
include("connect.php");
include("admin.config.inc.php");
include("security.php");
include("imgsize.php");


$i = 0;
$tooltips = array();
$query = db_query("SELECT topic, text FROM tooltips WHERE page = '$_GET[page]'");


while($help = db_fetch_array($query)){


    $tooltips[$i] = array('id' => $i, 'topic' => $help[0], 'text' => $help[1]);

$i++;

}



$str = json_encode($tooltips);

echo  "{ \"tooltips\" : \n" . $str . "}" ;