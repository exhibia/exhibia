<?php
ini_set('display_errors', 1);

if($_REQUEST['ajax'] != 'true'){

session_start();
$active = "Admin User";
include_once("admin.config.inc.php");

include("connect.php");
}else{

include("../config/connect.php");

}
@db_query("alter table sitesetting add column license varchar(200)");
@db_query("alter table sitesetting add column status int(1) not null");
$fireworks = '';
$gavel = '';
$editsuccess = false;
$email = "";
$bidprice = '1';
$maxdiscount = '50';
$avatarfeature = '0';

$winpermonth = '0';
$winperweek = '0';

$autobidderseconds = '0';
$featuredauctioncount = '8';
$taxenable = '0';
$timerdelay = '0';
$seourl = '0';
$flashbanner = '0';
$discounthalfback = 50;
$adminbidtype = '0';
$leavetimeout = 0;
$livemap = 0;
$social = '0';
$allowadminbid = '0';
$refreshrate = '1000';
$reftimeout = '3000';
$dateformat='d/m/Y';
$resettime='60';
$aggregate='1';
$reservetext='RESERVE NOT YET MET';
$reservetext_limit='20';
$enable_prompt = '0';
$prompt_price = '1000';
$prompt_text = '';

if (isset($_REQUEST['submit'])) {

    $email = $_REQUEST['email'];
    $bidprice = $_REQUEST['bidprice'];
    $maxdiscount = $_REQUEST['maxdiscount'];
    $avatarfeature = $_REQUEST['avatarfeature'];
    $winpermonth = $_REQUEST['winpermonth'];
    $winperweek = $_REQUEST['winperweek'];
    //$autobidderseconds = $_REQUEST['autobidderseconds'];
    $featuredauctioncount = $_REQUEST['featuredauctioncount'];
    $taxenable = $_REQUEST['taxenable'];
    $timerdelay = $_REQUEST['timerdelay'];
    $seourl = $_REQUEST['seourl'];
    $flashbanner = $_REQUEST['flashbanner'];
    $discounthalfback = $_REQUEST['halfback'];
    $adminbidtype = $_REQUEST['adminbidtype'];
    $leavetimeout = $_REQUEST['leavetimeout'];
    $livemap = $_REQUEST['livemap'];
    $social = $_REQUEST['social'];
    $allowadminbid = $_REQUEST['allowadminbid'];

    $refreshrate = $_REQUEST['refreshrate'];
    $reftimeout = $_REQUEST['reftimeout'];
    $dateformat=$_REQUEST['dateformat'];
    $forum=$_REQUEST['forum'];
    $redemption=$_REQUEST['redemption'];
    $tutorials=$_REQUEST['tutorials'];
    $notifications=$_REQUEST['notifications'];
    $max_discount=$_REQUEST['max_discount'];
    $allow_bn_coupon=$_REQUEST['allow_bn_coupon'];
    $allow_multiple=$_REQUEST['allow_multiple'];
    $resettime=$_REQUEST['resettime'];
    $reservetext=db_real_escape_string($_REQUEST['reservetext']);
    $reservetext_limit=$_REQUEST['reservetext_limit'];
    $aggregate=$_REQUEST['aggregate'];
    $fireworks = $_REQUEST['fireworks'];
    $gavel = $_REQUEST['gavel'];
    
    $valid = true;

    if (preg_match('/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/', $email) == false) {
        $msg = "<br/>Invalid email address";
        $valid = false;
    }

    if (is_numeric($bidprice) == false) {
        $msg = "<br/>Bid Price must be a numeric";
        $valid = false;
    }

    if (is_numeric($maxdiscount) == false) {
        $msg = "<br/>Max Discount must be a numeric";
        $valid = false;
    }


    if (is_numeric($winpermonth) == false) {
        $msg = "<br/>Win limit per month must be a numeric";
        $valid = false;
    }
    if (is_numeric($winperweek) == false) {
        $msg = "<br/>Win limit per week must be a numeric";
        $valid = false;
    }

    if (is_numeric($autobidderseconds) == false) {
        $msg = "<br/>Autobidder seconds must be a numeric";
        $valid = false;
    }

    if (is_numeric($featuredauctioncount) == false) {
        $msg = "<br/>Feature Auction Count must be a numeric";
        $valid = false;
    }

    if (is_numeric($discounthalfback) == false) {
        $msg = "<br/>The discount of half back bid pack must be a numeric";
        $valid = false;
    }

    if (is_numeric($leavetimeout) == false) {
        $msg = "<br/>The time of leave must be a numberic";
        $valid = false;
    }
    
         if(db_num_rows(db_query("select * from sitesetting where name = 'fireworks'")) >= 1){
        $sql = "update sitesetting set value='$fireworks' where name='fireworks';";
        db_query($sql) or die('Query Not Success');
        }else{
        db_query("insert into sitesetting (id, name, value) values(null, 'fireworks', '$fireworks');");
        } 
        
        if(db_num_rows(db_query("select * from sitesetting where name = 'gavel'")) >= 1){
        $sql = "update sitesetting set value='$gavel' where name='gavel';";
        db_query($sql) or die('Query Not Success');
        }else{
        db_query("insert into sitesetting (id, name, value) values(null, 'gavel', '$gavel');");
        } 
        
        if(db_num_rows(db_query("select * from sitesetting where name = 'resettime'")) >= 1){
        $sql = "update sitesetting set value='$resettime' where name='resettime';";
        db_query($sql) or die('Query Not Success');
        }else{
        db_query("insert into sitesetting (id, name, value) values(null, 'resettime', '$resettime');");
        } 
  
  
        if(db_num_rows(db_query("select * from sitesetting where name = 'aggregate'")) >= 1){
        $sql = "update sitesetting set value='$aggregate' where name='aggregate';";
        db_query($sql) or die('Query Not Success');
        }else{
        db_query("insert into sitesetting (id, name, value) values(null, 'aggregate', '$aggregate');");
        } 
        
        if(db_num_rows(db_query("select * from sitesetting where name = 'reservetext'")) >= 1){
        $sql = "update sitesetting set value='$reservetext' where name='reservetext';";
        db_query($sql) or die('Query Not Success');
        }else{
        db_query("insert into sitesetting (id, name, value) values(null, 'reservetext', '$reservetext');");
        }        
        if(db_num_rows(db_query("select * from sitesetting where name = 'reservetext_limit'")) >= 1){
        $sql = "update sitesetting set value='$reservetext_limit' where name='reservetext_limit';";
        db_query($sql) or die('Query Not Success');
        }else{
        db_query("insert into sitesetting (id, name, value) values(null, 'reservetext_limit', '$reservetext_limit');");
        }         
        
        
        
        
        
        
        
	  if(db_num_rows(db_query("select * from sitesetting where name = 'prompt_confirm'")) >= 1 ){
	      db_query("delete from sitesetting where name = 'prompt_confirm'");
	      
	    }
	  
	  
	  if($_POST['enable_prompt'] == 1){
	    db_query("insert into sitesetting (id, name, value) values(null, 'prompt_confirm', 'enabled:" . $_POST['prompt_price'] . ":" . db_real_escape_string($_POST['prompt_text']) . "');");
	  }else{
	      
	    db_query("insert into sitesetting (id, name, value) values(null, 'prompt_confirm', 'disabled:" . $_POST['prompt_price'] . ":" . db_real_escape_string($_POST['prompt_text']) . "');");
        
        }
 
        
    if ($valid == true) {
    
        if(db_num_rows(db_query("select * from sitesetting where name = 'redemption'")) >= 1){
        $sql = "update sitesetting set value='$redemption' where name='redemption';";
        db_query($sql) or die('Query Not Success');
        }else{
        db_query("insert into sitesetting (id, name, value) values(null, 'redemption', '$redemption');");
        }
       
        
        if(db_num_rows(db_query("select * from sitesetting where name = 'forum'")) >= 1){
        $sql = "update sitesetting set value='$forum' where name='forum';";
        db_query($sql) or die('Query Not Success');
        }else{
        db_query("insert into sitesetting (id, name, value) values(null, 'forum', '$forum');");
        }
        
        
 if($_REQUEST['notifications'] == 'enabled'){
    
    
    
       if(db_num_rows(db_query("select * from sitesetting where name = 'addons' and value = 'notifications'")) >= 1){
       	$sql = "insert into sitesetting (id, name, value) values(null, 'addons', 'notifications');";
        
        db_query($sql) or die('Query Not Success');
        
	    if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like 'backend:%'")) == 0){
	  
	      $sql = "insert into sitesetting (id, name, value) values(null, 'version', 'backend:6.5.1');";
	      
	      db_query($sql) or die('Query Not Success');
	    }
	    
$version = db_fetch_array(db_query("select value from sitesetting where name='version' and value like 'backend:%'")); 

$version = explode(":", $version[0]);


	    foreach($addons as $key => $value){
 
		if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like '$value:%'")) == 0){
	      
		  $sql = "insert into sitesetting (id, name, value) values(null, 'version', '$value:$version[1]');";
		  
		  db_query($sql) or die('Query Not Success');
		}	    
	    
	    
	    }
	    if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like 'common:%'")) == 0){
	      
		  $sql = "insert into sitesetting (id, name, value) values(null, 'version', 'common:$version[1]');";
		  
		  db_query($sql) or die('Query Not Success');
		}	  
        
    
        }else{
        
	$sql = "insert into sitesetting (id, name, value) values(null, 'addons', 'notifications');";
        
        db_query($sql) or die('Query Not Success');
        
	    if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like 'backend:%'")) == 0){
	  
	      $sql = "insert into sitesetting (id, name, value) values(null, 'version', 'backend:6.5.1');";
	      
	      db_query($sql) or die('Query Not Success');
	    }
	    
$version = db_fetch_array(db_query("select value from sitesetting where name='version' and value like 'backend:%'")); 

$version = explode(":", $version[0]);


	    foreach($addons as $key => $value){
 
		if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like '$value:%'")) == 0){
	      
		  $sql = "insert into sitesetting (id, name, value) values(null, 'version', '$value:$version[1]');";
		  
		  db_query($sql) or die('Query Not Success');
		}	    
	    
	    
	    }
	    if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like 'common:%'")) == 0){
	      
		  $sql = "insert into sitesetting (id, name, value) values(null, 'version', 'common:$version[1]');";
		  
		  db_query($sql) or die('Query Not Success');
		}
	    
        }
        }else{
	    if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like 'backend:%'")) == 0){
	  
	      $sql = "insert into sitesetting (id, name, value) values(null, 'version', 'backend:6.5.1');";
	      
	      db_query($sql) or die('Query Not Success');
	    }
	    
$version = db_fetch_array(db_query("select value from sitesetting where name='version' and value like 'backend:%'")); 

$version = explode(":", $version[0]);


	    foreach($addons as $key => $value){
 
		if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like '$value:%'")) == 0){
	      
		  $sql = "insert into sitesetting (id, name, value) values(null, 'version', '$value:$version[1]');";
		  
		  db_query($sql) or die('Query Not Success');
		}	    
	    
	    
	    }
	    if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like 'common:%'")) == 0){
	      
		  $sql = "insert into sitesetting (id, name, value) values(null, 'version', 'common:$version[1]');";
		  
		  db_query($sql) or die('Query Not Success');
		}
		
      if(!empty($_REQUEST['notifications']) & $_REQUEST['notifications'] == ''){
        db_query("delete from sitesetting  where name = 'addons' and value = 'notifications'");
       }
        
        }
        
        
        
    if($_REQUEST['allow_bn_coupon'] == '1'){
    
    
    if(db_num_rows(db_query("select * from sitesetting where name = 'allow_bn_coupon'")) >= 1){
      db_query("update sitesetting set value = 1 where name = 'allow_bn_coupon'");
    
    
    }else{
    
      db_query("insert into sitesetting (id, name, value) values(null, 'allow_bn_coupon', '1');");
    
    
    
    }
    
    
    
    }else{
    
	db_query("delete from sitesetting where name = 'allow_bn_coupon'");
    
    
    }
    if($_REQUEST['allow_multiple'] == '1'){
    
    
    if(db_num_rows(db_query("select * from sitesetting where name = 'multiple_coupon'")) >= 1){
      db_query("update sitesetting set value = 1 where name = 'multiple_coupon'");
    
    
    }else{
    
      db_query("insert into sitesetting (id, name, value) values(null, 'multiple_coupon', '1');");
    
    
    
    }
    
    
    
    }else{
    
	db_query("delete from sitesetting where name = 'multiple_coupon'");
    
    
    }
 
 
 
 
 
 
 
 
 
 
     if($_REQUEST['max_discount'] != ''){
    
    
    if(db_num_rows(db_query("select * from sitesetting where name = 'max_discount'")) >= 1){
      db_query("update sitesetting set value = '$max_discount' where name = 'allow_bn_coupon'");
    
    
    }else{
    
      db_query("insert into sitesetting (id, name, value) values(null, 'max_discount', '$max_discount');");
    
    
    
    }
    
    
    
    }else{
    
	db_query("delete from sitesetting where name = 'max_discount'");
    
    
    }
    
    
    if($_REQUEST['tutorials'] == 'enabled'){
       if(db_num_rows(db_query("select * from sitesetting where name = 'addons' and value = 'tutorials'")) >= 1){
       
	  
        
    
        }else{
        
	$sql = "insert into sitesetting (id, name, value) values(null, 'addons', 'tutorials');";
        
        db_query($sql) or die('Query Not Success');
        }
        }else{
        
        db_query("delete from sitesetting  where name = 'addons' and value = 'tutorials'");
        
        }
        
        $sql = "update sitesetting set value='$fireworks' where name='fireworks';";
        db_query($sql) or die('Query Not Success');
        $sql = "update sitesetting set value='$gavel' where name='gavel';";
        db_query($sql) or die('Query Not Success');
        
        
        
        $sql = "update sitesetting set value='$email' where name='adminemail';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$bidprice' where name='bidprice';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$maxdiscount' where name='maxdiscount';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$avatarfeature' where name='avatarfeature';";
        db_query($sql) or die('Query Not Success');


        $sql = "update sitesetting set value='$winpermonth' where name='winpermonth';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$winperweek' where name='winperweek';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$autobidderseconds' where name='autobidsecond';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$featuredauctioncount' where name='featuredcount';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$taxenable' where name='taxenable';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$timerdelay' where name='timerdelay';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$seourl' where name='seourl';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$flashbanner' where name='flashbanner'";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$discounthalfback' where name='halfback'";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$adminbidtype' where name='adminbidtype';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$leavetimeout' where name='leavetimeout';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$livemap' where name='livemap';";
        db_query($sql) or die('Query Not Success');


        $sql = "update sitesetting set value='$social' where name='social';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$allowadminbid' where name='allowadminbid';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$refreshrate' where name='refreshrate';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$reftimeout' where name='reftimeout';";
        db_query($sql) or die('Query Not Success');

        $sql = "update sitesetting set value='$dateformat' where name='dateformat';";
        db_query($sql) or die('Query Not Success');
        
        $editsuccess = true;
        if($_REQUEST['ajax'] != 'true'){
        header('location:message.php?msg=108');
        }else{
        
        echo "****Updated Your Site Settings****";
        }
    }
} else {
    $sql = "select * from sitesetting where name='fireworks';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $fireworks = $obj->value;
        db_free_result($result);
    } else {
        $fireworks = '';
    }
    $sql = "select * from sitesetting where name='gavel';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $gavel = $obj->value;
        db_free_result($result);
    } else {
        $gavel = '';
    }
    $sql = "select * from sitesetting where name='max_discount';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $max_discount = $obj->value;
        db_free_result($result);
    } else {
        $max_discount = '';
    } 

    
    $sql = "select * from sitesetting where name='multiple_coupon';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $allow_multiple = '1';
        db_free_result($result);
    } else {
        $allow_multiple = '';
    } 
    
    $sql = "select * from sitesetting where name='allow_bn_coupon';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $allow_bn_coupon = $obj->value;
        db_free_result($result);
    } else {
        $allow_bn_coupon = '';
    }   
    $sql = "select * from sitesetting where name='forum';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $forum = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('forum','0');";
        db_query($sql) or die('Insert Not Success');
    }
    
    
    $sql = "select * from sitesetting where name='redemption';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $redemption = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('redemption','0');";
        db_query($sql) or die('Insert Not Success');
    }
    
        
    if($_REQUEST['notifications'] == 'enabled'){
    
    
    
       if(db_num_rows(db_query("select * from sitesetting where name = 'addons' and value = 'notifications'")) >= 1){
       	$sql = "insert into sitesetting (id, name, value) values(null, 'addons', 'notifications');";
        
        db_query($sql) or die('Query Not Success');
        
	    if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like 'backend:%'")) == 0){
	  
	      $sql = "insert into sitesetting (id, name, value) values(null, 'version', 'backend:6.5.1');";
	      
	      db_query($sql) or die('Query Not Success');
	    }
	    
$version = db_fetch_array(db_query("select value from sitesetting where name='version' and value like 'backend:%'")); 

$version = explode(":", $version[0]);


	    foreach($addons as $key => $value){
 
		if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like '$value:%'")) == 0){
	      
		  $sql = "insert into sitesetting (id, name, value) values(null, 'version', '$value:$version[1]');";
		  
		  db_query($sql) or die('Query Not Success');
		}	    
	    
	    
	    }
	    if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like 'common:%'")) == 0){
	      
		  $sql = "insert into sitesetting (id, name, value) values(null, 'version', 'common:$version[1]');";
		  
		  db_query($sql) or die('Query Not Success');
		}	  
        
    
        }else{
        
	$sql = "insert into sitesetting (id, name, value) values(null, 'addons', 'notifications');";
        
        db_query($sql) or die('Query Not Success');
        
	    if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like 'backend:%'")) == 0){
	  
	      $sql = "insert into sitesetting (id, name, value) values(null, 'version', 'backend:6.5.1');";
	      
	      db_query($sql) or die('Query Not Success');
	    }
	    
$version = db_fetch_array(db_query("select value from sitesetting where name='version' and value like 'backend:%'")); 

$version = explode(":", $version[0]);


	    foreach($addons as $key => $value){
 
		if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like '$value:%'")) == 0){
	      
		  $sql = "insert into sitesetting (id, name, value) values(null, 'version', '$value:$version[1]');";
		  
		  db_query($sql) or die('Query Not Success');
		}	    
	    
	    
	    }
	    if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like 'common:%'")) == 0){
	      
		  $sql = "insert into sitesetting (id, name, value) values(null, 'version', 'common:$version[1]');";
		  
		  db_query($sql) or die('Query Not Success');
		}
	    
        }
        }else{
	    if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like 'backend:%'")) == 0){
	  
	      $sql = "insert into sitesetting (id, name, value) values(null, 'version', 'backend:6.5.1');";
	      
	      db_query($sql) or die('Query Not Success');
	    }
	    
$version = db_fetch_array(db_query("select value from sitesetting where name='version' and value like 'backend:%'")); 

$version = explode(":", $version[0]);


	    foreach($addons as $key => $value){
 
		if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like '$value:%'")) == 0){
	      
		  $sql = "insert into sitesetting (id, name, value) values(null, 'version', '$value:$version[1]');";
		  
		  db_query($sql) or die('Query Not Success');
		}	    
	    
	    
	    }
	    if(db_num_rows(db_query("select * from sitesetting where name = 'version' and value like 'common:%'")) == 0){
	      
		  $sql = "insert into sitesetting (id, name, value) values(null, 'version', 'common:$version[1]');";
		  
		  db_query($sql) or die('Query Not Success');
		}
		
      if(!empty($_REQUEST['notifications']) & $_REQUEST['notifications'] == ''){
        db_query("delete from sitesetting  where name = 'addons' and value = 'notifications'");
       }
        }
        
        
        
        
        
        
        
        

    
    $sql = "select * from sitesetting where name='adminemail';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $email = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('adminemail','');";
        db_query($sql) or die('Insert Not Success');
    }

    $sql = "select * from sitesetting where name='bidprice';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $bidprice = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('bidprice','');";
        db_query($sql) or die('Insert Not Success');
    }

    $sql = "select * from sitesetting where name='maxdiscount';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $maxdiscount = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('maxdiscount','');";
        db_query($sql) or die('Insert Not Success');
    }


    $sql = "select * from sitesetting where name='avatarfeature';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $avatarfeature = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('avatarfeature','0');";
        db_query($sql) or die('Insert Not Success');
    }


    $sql = "select * from sitesetting where name='winpermonth';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $winpermonth = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('winpermonth','0');";
        db_query($sql) or die('Insert Not Success');
    }

    $sql = "select * from sitesetting where name='winperweek';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $winperweek = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('winperweek','0');";
        db_query($sql) or die('Insert Not Success');
    }


    $sql = "select * from sitesetting where name='autobidsecond';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $autobidderseconds = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('autobidsecond','0');";
        db_query($sql) or die('Insert Not Success');
    }

    $sql = "select * from sitesetting where name='featuredcount';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $featuredauctioncount = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('featuredcount','8');";
        db_query($sql) or die('Insert Not Success');
    }

    $sql = "select * from sitesetting where name='taxenable';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $taxenable = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('taxenable','0');";
        db_query($sql) or die('Insert Not Success');
    }

    $sql = "select * from sitesetting where name='timerdelay';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $timerdelay = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('timerdelay','0');";
        db_query($sql) or die('Insert Not Success');
    }


    $sql = "select * from sitesetting where name='seourl';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $seourl = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('seourl','0');";
        db_query($sql) or die('Insert Not Success');
    }

    $sql = "select * from sitesetting where name='flashbanner';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $flashbanner = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('flashbanner','0');";
        db_query($sql) or die('Insert Not Success');
    }

    $sql = "select * from sitesetting where name='halfback';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $discounthalfback = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('halfback','50');";
        db_query($sql) or die('Insert Not Success');
    }

    $sql = "select * from sitesetting where name='adminbidtype';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $adminbidtype = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('adminbidtype','0');";
        db_query($sql) or die('Insert Not Success');
    }

    $sql = "select * from sitesetting where name='leavetimeout';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $leavetimeout = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('leavetimeout','0');";
        db_query($sql) or die('Insert Not Success');
    }

    $sql = "select * from sitesetting where name='livemap';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $livemap = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('livemap','0');";
        db_query($sql) or die('Insert Not Success');
    }


    $sql = "select * from sitesetting where name='social';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $social = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('social','0');";
        db_query($sql) or die('Insert Not Success');
    }


    $sql = "select * from sitesetting where name='allowadminbid';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $allowadminbid = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('allowadminbid','0');";
        db_query($sql) or die('Insert Not Success');
    }
    
    $sql = "select * from sitesetting where name='refreshrate';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $refreshrate = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('refreshrate','1000');";
        db_query($sql) or die('Insert Not Success');
    }
    
    $sql = "select * from sitesetting where name='reftimeout';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $reftimeout = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('reftimeout','3000');";
        db_query($sql) or die('Insert Not Success');
    }

    $sql = "select * from sitesetting where name='dateformat';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $dateformat = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('dateformat','d/m/Y');";
        db_query($sql) or die('Insert Not Success');
    }

}
    if(db_num_rows(db_query("select * from sitesetting where name = 'addons' and value = 'notifications'")) >= 1){
    
    $notifications = 'enabled';
    }else{
    $notifications = '';
    }   


    
    if(db_num_rows(db_query("select * from sitesetting where name = 'addons' and value = 'tutorials'")) >= 1){
    
    $tutorials = 'enabled';
    }else{
    $tutorials = '';
    }
    
    
    $sql = "select * from sitesetting where name='resettime';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $resettime = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('resettime','60');";
        db_query($sql) or die('Insert Not Success');
    } 
    
    
    $sql = "select * from sitesetting where name='reservetext';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $reservetext = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('reservetext','RESERVE NOT MET');";
        db_query($sql) or die('Insert Not Success');
    } 
    
    $sql = "select * from sitesetting where name='reservetext_limit';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $reservetext_limit = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('reservetext_limit','20');";
        db_query($sql) or die('Insert Not Success');
    }
    $sql = "select * from sitesetting where name='aggregate';";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $aggregate = $obj->value;
        db_free_result($result);
    } else {
        $sql = "insert into sitesetting(name,value) values('aggregate','1');";
        db_query($sql) or die('Insert Not Success');
    }  
    
    
    $sql = "select * from sitesetting where name='prompt_confirm'";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_object($result);
        $prompt_confirm = $obj->value;
        
        $prompt = explode(":", $prompt_confirm);
        
        $prompt_price = $prompt[1];
        $enable_prompt = '1';
        $prompt_text = $prompt[2];
        db_free_result($result);
    } else {
        $enable_prompt = 0;
    }  
if($_REQUEST['ajax'] == 'true'){
?>

<?php
}
if($_REQUEST['ajax'] != 'true'){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Site Setting-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <style>
        .hide_me{
        display:none;
        }
        </style>

        <script  type="text/javascript">
            $(document).ready(function(){
                $("#form1").submit(function(){
                    var reg=/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/;
                    if(!reg.exec($("#email").val())){
                        alert('invalide email address');
                        return false;
                    }

                    if(isNaN($('#bidprice').val())==true){
                        alert('bidprice must be a numberic');
                        return false;
                    }

                    if(isNaN($('#maxdiscount').val())==true){
                        alert('max discount must be a numberic');
                        return false;
                    }
                    
                    

                    if(isNaN($('#winpermonth').val())==true){
                        alert('Win Limit Per Month must be a numberic');
                        return false;
                    }

                    if(isNaN($('#winperweek').val())==true){
                        alert('Win Limit Per Week must be a numberic');
                        return false;
                    }

                    

                    if(isNaN($('#featuredauctioncount').val())==true){
                        alert('Featured Auction Count must be a numberic');
                        return false;
                    }

                    if(isNaN($('#halfback').val())==true){
                        alert('The discount of half back bid back must be a numberic');
                        return false;
                    }

                    if(isNaN($('#leavetimeout').val())==true){
                        alert('The time of leave page must be a numberic');
                        return false;
                    }

                });
            });
            
            function hide_show(class_or_id){
      
		if($(class_or_id).css('display') == 'block'){
		
		    $(class_or_id).css('display', 'none');
		
		}else{
		
		    $(class_or_id).css('display', 'block');
		
		}
		
		
	  }
        </script>
        

    </head>

    <body>
    
        <!--[if !IE]>start wrapper<![endif]-->
        <div id="wrapper">
            <!--[if !IE]>start head<![endif]-->
            <div id="head">
                <?php include('include/header.php'); ?>
            </div>
            <!--[if !IE]>end head<![endif]-->

            <!--[if !IE]>start content<![endif]-->
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">
                    <div class="inner">
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Site Setting</h2>
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>
                            <!--[if !IE]>end title wrapper<![endif]-->
                            <!--[if !IE]>start section content<![endif]-->
                            <div class="section_content">
                                <!--[if !IE]>start section content top<![endif]-->
                                <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">
                                                    <!--[if !IE]>start system messages<![endif]-->

                                                    <ul class="system_messages">
                                                        <?php if (isset($msg)) {
                                                        ?>
                                                            <li class="red"><span class="ico"></span><strong class="system_title"><?= $msg; ?></strong></li>
                                                        <?php } ?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>
                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <br/>

                                                   
<?php }

if($_REQUEST['ajax'] == 'true'){
    
    ?>  
<h2>You must also be logged into the backend for this to work</h2>
<form id="sitesetting" id="form1" class="settings_form">
<center>
<table width="100%" align="center"><tr>

<?php }else{ ?>  
 <form id="form1" action="#" method=post enctype="multipart/form-data" class="search_form general_form">
						      <fieldset>
						      <div class="forms">

<?php } ?><!--[if !IE]>start fieldset<![endif]-->
                                                       
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            
                                                                <!--[if !IE]>start row<![endif]-->
                                      <?php
                                      if($_REQUEST['ajax'] == 'true'){
                                      ?>
                                    
                                      <td align="left">
                                      <?php
                                      }
                                      ?>
                                                                <div class="row">
                                                                    <label>Email:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="email" id="email" size="32" maxlength="256" class="text" value="<?php echo $email; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        
                                                                        
                                                                
									<span class="system message">YOU NEED TO SET THIS UP FOR YOUR SERVER</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Bid Price:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="bidprice" id="bidprice" size="32" maxlength="256" class="text" value="<?php echo $bidprice; ?>"/>
                                                                        </span>
                                                                        <span class="currency"><?= $Currency; ?></span>
									<span class="system required">*</span><span class="system message">The discount of what bids are worth towards a buy it
now</span>

                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Max Discount of Buynow:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="maxdiscount" id="maxdiscount" size="32" maxlength="256" class="text" value="<?php echo $maxdiscount; ?>"/>
                                                                        </span>
                                                                        <span class="currency">%</span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]$avatarfeature-->
                                    
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Discount of Half Back Bid:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="halfback" id="halfback" size="32" maxlength="256" class="text" value="<?php echo $discounthalfback; ?>"/>
                                                                        </span>
                                                                        <span class="currency">%</span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]$avatarfeature-->
                                                                
                                      <?php
                                      if($_REQUEST['ajax'] == 'true'){
                                      ?>
                                      </td>
                                      <td align="left">
                                      <?php
                                      }
                                      ?>
                                                                
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>forum:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="forum">
                                                                                <option value="1" <?php
                                                                                        if ($forum == '1') {
                                                                                            echo " selected";
                                                                                        } ?> selected="selected">Enable</option>
                                                                                <option value="0" <?php
                                                                                        if ($forum != "" and $forum == '0') {
                                                                                            echo " selected";
                                                                                        }
                                                        ?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Redemption:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="redemption">
                                                                                <option value="1" <?php
                                                                                        if ($redemption == '1') {
                                                                                            echo " selected";
                                                                                        } ?> selected="selected">Enable</option>
                                                                                <option value="0" <?php
                                                                                        if ($redemption != "" and $redemption == '0') {
                                                                                            echo " selected";
                                                                                        }
                                                        ?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                              
                                                             
                                                                
                                      
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Avatar Feature:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="avatarfeature">
                                                                                <option value="1" <?php
                                                        if ($avatarfeature == '1') {
                                                            echo " selected";
                                                        } ?> selected="selected">Enable</option>
                                                                                <option value="0" <?php
                                                                                        if ($avatarfeature != "" and $avatarfeature == '0') {
                                                                                            echo " selected";
                                                                                        }
                                                        ?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                       <?php
                                      if($_REQUEST['ajax'] == 'true'){
                                      ?>
                                      </td>
                                      <td align="left">
                                      <?php
                                      }
                                      ?>


                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Win Limit Per Month:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="winpermonth" id="winpermonth" size="32" maxlength="10" class="text" value="<?php echo $winpermonth; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <span class="system message">if the value is 0, it will no limit</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]$avatarfeature-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Win Limit Per Week:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="winperweek" id="winperweek" size="32" maxlength="10" class="text" value="<?php echo $winperweek; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <span class="system message">if the value is 0, it will no limit</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]$avatarfeature-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <!--
                                                                <div class="row">
                                                                    <label>Auto bidder Seconds:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="autobidderseconds" id="autobidderseconds" size="32" maxlength="10" class="text" value="<?php echo $autobidderseconds; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <span class="system message">auto bidder will be working when the due time of the auction is less then this value,
                                                                            it will be working anytime when the value is 0.
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                -->
                                                                <!--[if !IE]>end row<![endif]$avatarfeature-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Featured Auction Count:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="featuredauctioncount" id="featuredauctioncount" size="32" maxlength="10" class="text" value="<?php echo $featuredauctioncount; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <span class="system message">the count of the featured auction on home page
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                          <!--[if !IE]>end row<![endif]$avatarfeature-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Timeout Leave Page:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="leavetimeout" id="leavetimeout" size="32" maxlength="10" class="text" value="<?php echo $leavetimeout; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*minute(s)</span>
                                                                        <span class="system message">
                                                                            The page will lock when the user leave the page for a long time.
                                                                            it will be not locked anytime when the value is 0,unit is minute.
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]$avatarfeature-->
				    
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Date Refresh Rate:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="refreshrate">
                                                                                <option value="200" <?php echo $refreshrate == '200' ? "selected" : ''; ?>>0.2</option>
                                                                                <option value="500" <?php echo $refreshrate == '500' ? "selected" : ''; ?>>0.5</option>
                                                                                <option value="1000" <?php echo $refreshrate == '1000' ? "selected" : ''; ?>>1</option>
                                                                                <option value="1500" <?php echo $refreshrate == '1500' ? "selected" : ''; ?>>1.5</option>
                                                                                <option value="2000" <?php echo $refreshrate == '2000' ? "selected" : ''; ?>>2</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system message">Seconds</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                      <?php
                                      if($_REQUEST['ajax'] == 'true'){
                                      ?>
                                      </td>
                                      <td align="left">
                                      <?php
                                      }
                                      ?> 

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Refresh Time Out:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="reftimeout">
                                                                                <option value="2000" <?php echo $reftimeout == '2000' ? 'selected' : ''; ?>>2</option>
                                                                                <option value="3000" <?php echo $reftimeout == '3000' ? 'selected' : ''; ?>>3</option>
                                                                                <option value="4000" <?php echo $reftimeout == '4000' ? 'selected' : ''; ?>>4</option>
                                                                                <option value="5000" <?php echo $reftimeout == '5000' ? 'selected' : ''; ?>>5</option>
                                                                                <option value="6000" <?php echo $reftimeout == '6000' ? 'selected' : ''; ?>>6</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system message">Seconds</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Tax Enable:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="taxenable">
                                                                                <option value="1" <?php
                                                                                        if ($taxenable == '1') {
                                                                                            echo " selected";
                                                                                        } ?> selected="selected">Enable</option>
                                                                                <option value="0" <?php
                                                                                        if ($taxenable != "" and $taxenable == '0') {
                                                                                            echo " selected";
                                                                                        }
                                                        ?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                
                                       <?php
                                      if($_REQUEST['ajax'] != 'true'){
                                      
                                      
                                      if($_REQUEST['ajax'] == 'true'){
                                      ?>
                                      </td>
                                      
                                      <td align="left" >
                                      <?php } ?>
					  
                                      <?php
                                      if($_REQUEST['ajax'] != 'true'){
                                      ?>
                                      <br />
                                      
                                      <?php } ?>
                                      
						 <div class="row"  style="border:1px dashed gray;border-radius:8px;"> 
                                          <h2>Coupon Settings</h2>
                                     
						    <table>
						      <tr>
							<td>
                                      
							    <label>Enable Buy It Now Coupons</label>
							      <input type="checkbox" name="allow_bn_coupon" id="allow_bn_coupon" value="1" <?php if($allow_bn_coupon == '1'){ echo 'checked'; } ?> />
                                       
                                     
							</td>
						      <?php
							if($_REQUEST['ajax'] == 'true'){
							?>
							</tr>
							<tr>
							
							<?php } ?>
							  <td>
                                      
							      <label>Allow Multiple Coupons</label>
							      <input type="checkbox" name="allow_multiple" id="allow_multiple" value="1" <?php if($allow_multiple == '1'){ echo 'checked'; } ?> />
							  </td>
						      <?php
						      if($_REQUEST['ajax'] == 'true'){
						      ?>
						      </tr><tr>
						      <?php } ?>
						      <td>
                                      
                                      
							      <label>Max Discount of Coupons</label>
							      <input type="decimal" size="5" value="<?php echo $max_discount;?>" name="max_discount" id="max_discount" /> %
                                      
						      </td>
						    </tr>
					      </table>
                                      
                                      
                                      </div>
                                      
                                      
                                       <?php
                                      if($_REQUEST['ajax'] == 'true'){
                                      ?>
                                      
                                      </td>
                                      <td align="left">
                                      <?php
                                      }
                                      
                                      }
                                      ?>
                                  
                                                                                                    <!--[if !IE]>end row<![endif]-->

                                                             


                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Flash Banner:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="flashbanner">
                                                                                <option value="1" <?php
                                                                                        if ($flashbanner == '1') {
                                                                                            echo " selected";
                                                                                        } ?> selected="selected">Enable</option>
                                                                                <option value="0" <?php
                                                                                        if ($flashbanner != "" and $flashbanner == '0') {
                                                                                            echo " selected";
                                                                                        }
                                                        ?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->


                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>SEO URL Support:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="seourl">
                                                                                <option value="1" <?php
                                                                                        if ($seourl == '1') {
                                                                                            echo " selected";
                                                                                        } ?> selected="selected">Enable</option>
                                                                                <option value="0" <?php
                                                                                        if ($seourl != "" and $seourl == '0') {
                                                                                            echo " selected";
                                                                                        }
                                                        ?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                      <?php
                                      if($_REQUEST['ajax'] == 'true'){
                                      ?>
                                      </td>
                                      <td align="left">
                                      <?php
                                      }
                                      ?>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Admin bid Type:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="adminbidtype">
                                                                                <option value="0" <?php
                                                                                        if ($adminbidtype == '0') {
                                                                                            echo " selected";
                                                                                        } ?> selected="selected">Auto bid</option>
                                                                                <option value="1" <?php
                                                                                        if ($adminbidtype == '1') {
                                                                                            echo " selected";
                                                                                        }
                                                        ?>>Single Bid</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                        

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Social:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="social">
                                                                                <option value="1" <?php
                                                                                        if ($social == '1') {
                                                                                            echo " selected";
                                                                                        } ?> selected="selected">Enable</option>
                                                                                <option value="0" <?php
                                                                                        if ($social == '0') {
                                                                                            echo " selected";
                                                                                        }
                                                        ?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Allow Admin Bidder:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="allowadminbid">
                                                                                <option value="1" <?php
                                                                                        if ($allowadminbid == '1') {
                                                                                            echo " selected";
                                                                                        } ?> selected="selected">Enable</option>
                                                                                <option value="0" <?php
                                                                                        if ($allowadminbid == '0') {
                                                                                            echo " selected";
                                                                                        }
                                                        ?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Date Format:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="dateformat">
                                                                                <option value="d/m/Y" <?php echo $dateformat=='d/m/Y'?'selected':''; ?>>DD/MM/YYYY</option>
                                                                                <option value="m/d/Y" <?php echo $dateformat=='m/d/Y'?'selected':''; ?>>MM/DD/YYYY</option>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <!--[if !IE]>start row<![endif]-->
                                        
                                                                <div class="row"  style="border:1px dashed gray;border-radius:8px;margin-bottom:20px;">
                                                              
								  <table>
								  <tr>
								  <td colspan="3">
								  <h2>UI Effects</h2>
								  
								  </td>
								  </tr>
								  <tr>
									     <td valign="top" height="100%" width="300px">
									      <p style="font-weight:bold;margin-bottom:-20px;">Timer Delay</p>
									      (Going Once, Going Twice, Gone)
									      <br />
										      <select name="timerdelay">
											  <option value="1" <?php
												  if ($timerdelay == '1') {
												      echo " selected";
												  } ?> selected="selected">Enable</option>
											  <option value="0" <?php
												  if ($timerdelay != "" and $timerdelay == '0') {
												      echo " selected";
												  }
												?>>Disable</option>
										      </select>
										    
									      </td>
									  
									      <td valign="top" height="100%" width="300px">
									      <p style="font-weight:bold;">Last Secconds Gavel</p>
									      
											  <select name="gavel">
											      <option value="1" <?php
												      if ($gavel == '1') {
													  echo " selected";
												      } ?> selected="selected">Enable</option>
											      <option value="0" <?php
												      if ($gavel != "" and $gavel == '0') {
													  echo " selected";
												      } ?>>Disable</option>
											  </select>
										      
									      </td>
									  
									      <td valign="top" height="100%" width="300px">
										<p style="font-weight:bold;">Winner Fireworks</p>
										
										 
											  <select name="fireworks">
											      <option value="1" <?php
												      if ($fireworks == '1') {
													  echo " selected";
												      } ?> selected="selected">Enable</option>
											      <option value="0" <?php
												      if ($fireworks != "" and $fireworks == '0') {
													  echo " selected";
												      } ?>>Disable</option>
											  </select>
										     
                                                                        
										</td>
									    </tr>
									 
								 
								  </table>
								  
								</div>
                                                  
                                                                <!--[if !IE]>start row<![endif]-->
                                        
                                                                <div class="row"  style="border:1px dashed gray;border-radius:8px;margin-bottom:20px;">
                                                              
								  <table>
								  <tr>
								  <td colspan="4">
								      <h2>Reserve Auction Settings</h2>
								  </td>
								  </tr>
								      <tr>
									  <td>
									      <label>Reserve Reset Time:</label>
									     
										      <select name="resettime" id="resettime">
											  <?php 
											  $i = 10;
											  while($i <= 300){
											  ?>
											  <option value="<?php echo $i; ?>" <?php if($resettime == $i) { echo ' selected'; } ?>><?php echo $i;?> Seconds</option>
											  <?php
											  $i = $i + 10;
											  }
											  ?>
										      </select>
										
									  </td><td>
									   <label>Reserve Text On Screen Time:</label>
									     
										      <select name="reservetext_limit" id="reservetext_limit">
											  <?php 
											  $i = 5;
											  while($i <= 300){
											  ?>
											  <option value="<?php echo $i; ?>" <?php if($reservetext_limit == $i) { echo ' selected'; } ?>><?php echo $i;?> Seconds</option>
											  <?php
											  $i = $i + 5;
											  }
											  $i = 2;
											   while($i <= 4){
											  ?>
											  <option value="<?php echo $i; ?>" <?php if($reservetext_limit == $i) { echo ' selected'; } ?>><?php echo $i;?> Seconds</option>
											  <?php
											  $i = $i + 1;
											  }
											  ?>
										      </select>
									
									  
									  </td><td>
									  <label>Default Reserve Text:</label>
									     
										      <input type="text" value="<?php echo $reservetext;?>" name="reservetext" id="reservetext" />
									
									  
									  </td><td>
									  
									      <label>Aggregate Seats And Bids?:</label>
									     
										      <select name="aggregate" id="aggregate">
											  
											  <option value="1" <?php if(!empty($aggregate)) { echo ' selected'; } ?>>Yes</option>
											  <option value="" <?php if(empty($aggregate)){ echo ' selected'; } ?>>No</option>
										      </select>
										
									  </td>
								      </tr>
								      
								   </table>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                
                                     <!--    <div class="row"  style="border:1px dashed gray;border-radius:8px;"> 
                                          <h2>Large Item User Prompt</h2>
                                     
						    <table>
						      <tr>
							<td colspan="2" valign="top" height="100%">
                                      
							    <label>Enable This Feature</label>
							      <input type="checkbox" name="enable_prompt" id="enable_prompt" value="1" <?php if($enable_prompt == '1'){ echo 'checked'; } ?> onclick="javascript: hide_show('.hide_me');" />
                                       
                                     
							</td>
							
						      <?php
							if($_REQUEST['ajax'] == 'true'){
							?>
						</tr><tr>
							
							<?php } ?>
							  <td valign="top" height="100%">
                                      
							      <label>Large Item Price</label>
							      $<input type="text" name="prompt_price" id="prompt_price" value="<?php echo $prompt_price;?>" <?php if($prompt_price == '1'){ echo 'checked'; } ?> />
							 
							</td> <td valign="top" height="100%">
                                      
							      <label>Prompt Text</label>
							     <br />
							      <textarea class="ckeditor" name="prompt_text" id="prompt_text"><?php echo $prompt_text;?></textarea>
                                      
						      </td>
						    </tr>
					      </table>
                                      
                                      
                                      </div>
			       
				      <?php
				      if($_REQUEST['ajax'] == 'true'){
                                      ?>
                                      
                                                               <input id="ajax" value="true" type="hidden" />
                                                                 <input name="submit" type="button" onclick="javascript: submit_test_ajax_form_settings('form1', '<?php echo $SITE_URL . 'backendadmin/sitesetting.php' ;?>', 'ajax', 'get');" value="Save" />
                                                               
                                                              </td>
                                                            </tr>
                                                          </table>
                                                       </center>
                                                     </form>

                                      <?php
                                      }else{
                                      ?>-->
                                     <div style="height:25px;"></div>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Save</span></span><input name="submit" type="submit"  /></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                         
                                                                <!--[if !IE]>end row<![endif]-->
                                                     </div>
                                                            <!--[if !IE]>end forms<![endif]-->

                                                        </fieldset>
                                                        
				   
                                  
                                                        <!--[if !IE]>end fieldset<![endif]-->
                                                    </form>
                                               <!--[if !IE]>end forms<![endif]-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
                        <!--[if !IE]>end section<![endif]-->

                    </div>
                </div>
                <!--[if !IE]>end page<![endif]-->
                <!--[if !IE]>start sidebar<![endif]-->
                <div id="sidebar">
                    <div class="inner">
                        <?php include 'include/leftside.php' ?>
                                                                                    </div>
                                                                                </div>
                                                                                <!--[if !IE]>end sidebar<![endif]-->

                                                                            </div>
                                                                            <!--[if !IE]>end content<![endif]-->

                                                                        </div>
                                                                        <!--[if !IE]>end wrapper<![endif]-->

                                                                        <!--[if !IE]>start footer<![endif]-->
                                                                        <div id="footer">
                                                                            <div id="footer_inner">
                <?php include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

    </body>
</html>

<?php }

?>
