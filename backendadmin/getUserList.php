<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$q = strtolower($_GET["q"]);
if (!$q)
    return;
include("connect.php");
include("security.php");
$qrysel = "select id,username from registration where username like '$q%'";
$ressel = db_query($qrysel);
$total = db_num_rows($ressel);
$obj=new stdClass();
$obj->id='allusers';
$obj->username='All Users';
$array=array($obj);
while ($obj = db_fetch_object($ressel)) {
    array_push($array, $obj);
}
echo json_encode($array);
?>
