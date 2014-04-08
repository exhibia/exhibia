<?php
ini_set('display_errors', 1);
include("config/connect.php");
include("functions.php");

$uid = $_SESSION["userid"];
$changeimage = "help";
if($_REQUEST['pt'] == 'affilliate'){

    if(db_num_rows(db_query("select * from sitesetting where name = 'afilliate_progr' and value!= 'PAS' limit 1")) >0){
    
     $showanstitle = 4;
      $shoansanswer = 7;   
    
    
    }else{
    //PAS affilliate code goes here
    
    
    }


}else{
if($_GET["pt"]!="") {
    $showanstitle = 1;
    $shoansanswer = 2;
}
else {
    $showanstitle = 1;
    $shoansanswer = 1;
}

}

?>
<?php
if(empty($dont_show_left)){
$dont_show_left = array();
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

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
       
 <?php include("page_headers.php"); ?>
        
       
        <script type="text/javascript">
            function ShowMainTitle(div_id)
            {
		$('.help_links').css('display', 'none');
                $('#subtitle_' + div_id).css('display', 'block');
            }
            function ShowAnsTitle(ans_id)
            {
		$('.help_entry').css('display', 'none');
		$('#answer_' + ans_id).css('display', 'block');
                
            }
        </script>
    </head>

    <body onload="ShowMainTitle('<?=$showanstitle;?>');ShowAnsTitle('<?=$shoansanswer;?>')" class="single">
 
      <?php
         
         
	      foreach($addons as $key => $value){

		if(file_exists("include/addons/$value/$template/top_bar.php")){
		
		    include("include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists("include/addons/$value/top_bar.php")){
		

		    include_once("include/addons/$value/top_bar.php");

		}


	      }
	      if(file_exists($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF'])  )  ) {
		include($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/" . basename($_SERVER['PHP_SELF']));
		
		}
		


	  ?>
        <label id="GetGlobalID" style="display: none;"><?php echo $showanstitle;?></label>
        <label id="GetGlobalAnsID" style="display: none;"><?php echo $showanstitle;?></label>
    </body>
</html>
