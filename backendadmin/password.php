<?php
ini_set('display_errors', 1);
session_destroy();
//session_start();

include("../config/config.inc.php");
include("connect.php");
include("functions.php");



$name = chkInput($_POST["name"], 's', 30);
$pass = chkInput($_POST["pass"], 's', 30);
$rndcode = chkInput(strtolower($_POST["rndcode"]), 's', 30);

if (db_num_rows(db_query("select * from captcha_codes where captcha_code = '$rndcode'")) == 0) {

    header("Location:index.php?id=2");
} else {
    db_query("delete from captcha_codes where captcha_code = '$rndcode'");
    $result = db_query("select 1 as res from admin where username='$name' and pass='$pass'");
      $num_2 = db_num_rows(db_query("select * from registration where username='$name' and password = '$pass' and admin_user_flag >= '1'"));
    
      
$user_data = db_fetch_array(db_query("select * from registration where username='$name' and password = '$pass'"));
	      if(!empty($user_data['admin_user_flag'])){
	      $_SESSION['user_level'] = $user_data['admin_user_flag'];
	      }else{

	      $_SESSION['user_level'] = 'admin';
	      }

      if (db_num_rows($result) >= 1 | $num_2 >= 1) {
   
        $res = 1;
        if (isset($res) && $res == '1') {
            $_SESSION["UsErOfAdMiN"] = $name;
            $_SESSION['logedin'] = true;
	  
            $lssql = "select name,username,admin from users where name='admin'";
            $lsresult = db_query($lssql);

	   // if (db_num_rows($lsresult) > 0) {
                $lsuser=db_fetch_array($lsresult);
                //for live support
                session_regenerate_id (); //this is a security measure
                $_SESSION['valid'] = 1;

                $_SESSION['username'] = $lsuser['username'];
                $_SESSION['name'] = $lsuser['name'];
                $_SESSION['admin'] = $lsuser['admin'];
	  //  }

            header("Location:innerhome.php");
        }
    } else {
    
        header("Location:index.php?id=1");
    }
    db_free_result($result);
}
?>
