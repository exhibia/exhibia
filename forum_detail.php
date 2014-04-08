<?php
ini_set('display_errors', 1);
include("config/connect.php");

include("session.php");
include("functions.php");

$changeimage = "forum";
$user = $_SESSION['userid'];

$msg = $_GET['msg'];
$forum_id = chkInput($_GET["fid"],'i');

$select = "Select * from forums where forum_status = '0' and forums_id='".$forum_id."'";
$result = db_query($select) or die(db_error());

$rowforum = db_fetch_object($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <?php include("page_headers.php"); ?>
        <script language="javascript" type="text/javascript">
            function GiveAlert(alertid,forum_id)
            {
                if(alertid==1)
                {
                    var message = "<?php echo YOU_MUST_BE_LOGGED_IN_TODO_THAT; ?>";
                    if(confirm(message))
                    {
                        window.location.href = 'login.php?fid='+forum_id;
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
