<?php

ini_set('display_errors', 1);
define('INST_RUNSCRIPT', pathinfo(__FILE__, PATHINFO_BASENAME));
define('INST_BASEDIR', str_replace(INST_RUNSCRIPT, '', __FILE__));
define('INST_RUNFOLDER', 'installer/');
define('INST_RUNINSTALL', 'installer.php');
if (is_dir(INST_BASEDIR . INST_RUNFOLDER) &&
        is_readable(INST_BASEDIR . INST_RUNFOLDER . INST_RUNINSTALL)){
    require(INST_BASEDIR . INST_RUNFOLDER . INST_RUNINSTALL);
   

}
?>
<?php
if(empty($dont_show_left)){
$dont_show_left = array();
}
if(empty($dont_show_right)){
$dont_show_right = array();
}
//Uncomment items below to remove them from ALL PAGES for ALL TEMPLATES SO LONG AS THEY ARE 100% USING THE NORMAL FRAMEWORK...IF NOT THEN LETS FIX THAT FIRST
//Skinny column
//$dont_show_left[] = 'testimonials';
//$dont_show_left[] = 'last_winner';
//$dont_show_left[] = 'right_social';
//$dont_show_left[] = 'coupon_menu';
//$dont_show_left[] = 'bidpack_menu';
//$dont_show_left[] = 'user_menu';
//$dont_show_left[] = 'help_menu';
//$dont_show_left[] = 'faq_menu';
//$dont_show_left[] = 'top_menu';
//$dont_show_left[] = 'search_box';
//$dont_show_left[] = 'category_menu';
//$dont_show_right[] = 'steps_box';
//$dont_show_right[] = 'auction_boxes';
//$dont_show_right[] = 'slider';
//$dont_show_right[] = 'category_menu';
//$dont_show_right[] = 'top_menu';
//$dont_show_right[] = 'search_box';

?>
<?php

include_once("config/connect.php");

include_once 'functions.php';

include_once 'include/advertisefunction.php';


if(!empty($_SESSION['userid'])){
$uid = $_SESSION['userid'];
}else{
$uid = 0;
}
$changeimage = "home";
$pagename = "index";
if (!isset($_SESSION["ipid"]) && !isset($_SESSION["login_logout"])) {

    $_SESSION["ipid"] = date("Y-m-d G:i:s");

    $_SESSION["ipaddress"] = $_SERVER['REMOTE_ADDR'];



    $qryipins = "Insert into login_logout (ipaddress,load_time) values('" . $_SESSION["ipaddress"] . "', '" . $_SESSION["ipid"] . "')";

    db_query($qryipins);
}



//end for first nine products
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

	<?php  include($BASE_DIR . "/page_headers.php"); ?>

    </head>
    <body class="homepage" onload="OnloadPage();">
    <?php

     foreach($addons as $key => $value){
		if(file_exists($BASE_DIR . "/include/addons/$value/$template/top_bar.php")){
		   include_once($BASE_DIR . "/include/addons/$value/$template/top_bar.php");
		}else	if(file_exists($BASE_DIR . "/include/addons/$value/top_bar.php")){
		    include_once($BASE_DIR . "/include/addons/$value/top_bar.php");
		}
	      }
	   ?>
           <?php include($BASE_DIR . "/include/" . $template . "/main.php");  ?>
		<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="js/jquery.contentcarousel.js"></script>
		<script type="text/javascript">
			$('#escroe_results').contentcarousel();
			
		</script>


    </body>
</html>
