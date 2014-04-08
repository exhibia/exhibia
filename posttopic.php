<?php
include("config/connect.php");
include("session.php");
include("functions.php");


$changeimage = "forum";	
$user = $_SESSION['userid'];
$fid = $_REQUEST['fid'];

$select = "Select * from forums where forum_status = '0' and forums_id='".$fid."'";
$result = db_query($select) or die(db_error());

$row = db_fetch_object($result);
$msg = 0;


if(isset($_POST['submit'])) {

    $title = $_POST['title'];
    $post_body = $_POST['post_body'];
    $forum_id = $_POST['forumid'];
    $date_time = time();
    $insertQuery = "insert into forum_topic(forum_id,topic_title,topic_body,topic_starter,topic_time)values('".$forum_id."','".$title."','".$post_body."','".$user."','".$date_time."')";
    $insertResult = db_query($insertQuery);
    echo db_error();

    $msg = 1;
    header("location: forum_detail.php?fid=".$fid."&msg=1");
    exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
<?php include("page_headers.php"); ?>
        <script language="javascript" type="text/javascript">

            function PutSmileys(value)
            {
                document.postthread.post_body.value += value;
                document.postthread.post_body.focus();
            }

            function Check()
            {
                if(document.postthread.title.value=="")
                {
                    alert("<?php echo PLEASE_ENTER_TOPIC_TITLE; ?>");
                    document.postthread.title.focus();
                    return false;
                }
                if(document.postthread.post_body.value=="")
                {
                    alert("<?php echo PLEASE_ENTER_TOPIC_CONTENT; ?>");
                    document.postthread.post_body.focus();
                    return false;
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
