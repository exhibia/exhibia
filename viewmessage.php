<?php
include("config/connect.php");
include("session.php");
include("functions.php");

$changeimage = "forum";
$user = $_SESSION['userid'];
$topic_id = $_GET['tid'];
$msg = $_GET['msg'];
$selectQuery = "Select * from forum_topic ft left join forums fr on ft.forum_id = fr.forums_id where ft.topic_status = '0' and ft.topic_id = '".$topic_id."'";

$resultQuery = db_query($selectQuery); echo db_error();

$row = db_fetch_object($resultQuery);

$forumname = $row->forums_name;
$topictitle = $row->topic_title;
$forum_id = $row->forum_id;
$topic_body = $row->topic_body;
$tcontent = wordwrap($topictitle, 95, "<br />",1);

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include("page_headers.php"); ?>
        <script language="javascript" type="text/javascript">
            function GiveAlert(alertid,topic_id)
            {
                if(alertid==1)
                {
                    var message = "<?php echo YOU_MUST_BE_LOGGED_IN_TODO_THAT;?>";
                    if(confirm(message))
                    {
                        window.location.href = 'login.php?tid='+topic_id;
                    }
                }
            }
        </script>
    </head>
    <body class="single">
                <?php
         
         
	    
	      if(file_exists($BASE_DIR . "/include/$template/forums/" . basename($_SERVER['PHP_SELF']))){
		include($BASE_DIR . "/include/$template/forums/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/forums/" . basename($_SERVER['PHP_SELF']));
		
		}
		


	  ?>
    </body>
</html>
