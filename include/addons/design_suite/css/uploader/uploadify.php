<?php

if($_REQUEST['type'] == 'logo'){
        $tmp_name = $_FILES["logo"]["tmp_name"];
        $name = $_FILES["logo"]["name"];


$newfile = "../img/logo" . time("Y-m-d-H:i:s") . ".php";


if(!preg_match("/.png$/i", $name)){

$msg = "Logo must be a PNG file";
}else{
if (copy("../img/logo.png", $newfile)) {




$msg = "{'success':true}";


        move_uploaded_file($tmp_name, "../img/logo.png");



}
}
}