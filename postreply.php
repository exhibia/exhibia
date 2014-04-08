<?php
include("config/connect.php");
include("functions.php");
include("session.php");

$changeimage = "forum";	
$user = $_SESSION['userid'];

$topic_id = $_REQUEST['tid'];

$selectQuery = "Select * from forum_topic ft left join forums fr on ft.forum_id = fr.forums_id where ft.topic_status = '0' and ft.topic_id = '".$topic_id."'";
$resultQuery = db_query($selectQuery) or die(db_error());

$row = db_fetch_object($resultQuery);
$forumname = $row->forums_name;
$topictitle = $row->topic_title;
$forum_id = $row->forum_id;
$msg = 0;

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $post_body = nl2br(addslashes($_POST['post_body']));

    $date_time = time();
    $insertQuery = "insert into forum_reply(topicid,reply_body,reply_user,reply_time)values('".$topic_id."','".$post_body."','".$user."','".$date_time."')";
    $insertResult = db_query($insertQuery) or die(db_error());
    $msg = 1;
    header("location: viewmessage.php?tid=".$topic_id."&msg=1");
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <?php include("page_headers.php"); ?>
        <!--[if lte IE 6]>
        <link href="../css/menu_ie.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script language="javascript" type="text/javascript">
            function Check()
            {
                if(document.f1.post_body.value=="")
                {
                    alert("<?php echo PLEASE_ENTER_MESSAGE; ?>");
                    document.f1.post_body.focus();
                    return false;
                }
            }

            function PutSmileys(value)
            {
                document.f1.post_body.value += value;
                document.f1.post_body.focus();
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
