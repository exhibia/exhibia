<?php

include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");
include('functions.php');

if ($_POST["edit"] != "") {
    $title = chkInput($_POST["auctitle"], 's');
    $price = chkInput($_POST["aucplusprice"], 's');
    $time = chkInput($_POST["minaucplustime"], 'i');

    $time1 = chkInput($_POST["maxaucplustime"], 'i');
    if($time1 < 0 ){
    $time1 = 5;
    }
    if($time < $time1){
    
    $time = $time1 + 5;
    
    }
    $id = chkInput($_POST["editid"], 'i');

    if ($id == 1) {
        $qryupd = "update auction_management set auc_plus_price='$price', auc_plus_time='$time',max_plus_time='$time1', picture = 'clock.php?time=$time' where id=$id";
    } else {

 if(db_num_rows(db_query("select * from auction_management where auc_title='$title'"))>=1){
        $qryupd = "update auction_management set auc_title='$title', auc_plus_price='$price', auc_plus_time='$time',max_plus_time='$time1', `picture` = 'clock.php?time=$time' where id=$id";

	}else{

	  $qryupd = "insert into auction_management(`id`, `auc_title`, `auc_plus_price`, `auc_plus_time`, `max_plus_time`, `auc_manage`, `picture`) VALUES
(null, '$title', '$price', '$time', '$time1', '$time". "sa', 'clock.php?time=$time');";

	}

	}
    db_query($qryupd) or die(db_error());



    header("location: message.php?msg=38");
    exit;
}
?>