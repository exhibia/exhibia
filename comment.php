<?php
if(!isset($_GET['com_id'])) {
    header("Location: community.php");
}


include("config/connect.php");
include("functions.php");

$uid = $_SESSION["userid"];

if(!$_GET['pgno']) {
    $PageNo = 1;
}
else {
    $PageNo = chkInput($_GET['pgno'],'i');
}

$StartRow =   $PRODUCTSPERPAGE * ($PageNo-1);

$comid =$_GET['com_id'];

$selectuserwise = "select * from community_comment where community_id = '".$comid."' and user_id = '".$_SESSION['userid']."'";
$resultuserwise = db_query($selectuserwise);
$totalCheckRow = db_num_rows($resultuserwise);

$selectCommunity = "select * from community where id = '".$comid."'";
$resultCommunity = db_query($selectCommunity) or die(db_error());

$total = db_num_rows($resultCommunity);
$rowcommunity = db_fetch_object($resultCommunity);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('page_headers.php'); ?>
        <link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />
    
        <script language="javascript" type="text/javascript">
            function GiveAlert(alertid)
            {
                if(alertid==1)
                {
                    var message = "<?php echo YOU_MUST_BE_LOGGED_TODO_THAT; ?>";
                    if(confirm(message))
                    {
                        window.location.href = 'login.php';
                    }
                }
                if(alertid==2)
                {
                    var message = "<?php echo YOU_CAN_ONLY_POST_ONE_COMMENT_ON_PER_COMMUNITY; ?>";
                    alert(message);
                }
            }
        </script>
        <script language="javascript" type="text/javascript">
            function GiveRating(rate,comid)
            {
                var url1="rating.php?rat=" + rate + "&cid=" + comid;

                $.ajax({
                    type: "GET",
                    url: url1,
                    success: function(msg){
                        if(msg=="yourcomm")
                        {
                            alert("<?php echo YOU_CANT_GIVE_RATING_ON_YOUR_POSTED_COMMENT; ?>");
                        }
                        else if(msg=="moreone")
                        {
                            alert("<?php echo YOU_CANT_GIVE_RATING_MORE_THEN_ONE_TIME_ON_PER_COMMUNITY;?>");
                        }
                        if(msg!="")
                        {
                            restext = msg.split("|");
                            if(restext[0]=="success")
                            {
                                $('#thumbuprateup_' + restext[3]).html(restext[1]);
                                $('#thumbupratedown_' + restext[3]).html(restext[2]);

                            }
                        }
                    }
                });

            }
        </script>
    </head>
    <body class="single">
                <?php
         
       
	      foreach($addons as $key => $value){

		if(file_exists("include/addons/$value/$template/top_bar.php")){
		
		    include("include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists("include/addons/$value/top_bar.php")){
		

		    include_once("include/addons/$value/top_bar.php");

		}


	      }
	      if(file_exists($BASE_DIR . "/include/$template/cms_pages/" . basename($_SERVER['PHP_SELF'])  )  ) {
		include($BASE_DIR . "/include/$template/cms_pages/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/cms_pages/" . basename($_SERVER['PHP_SELF']));
		
		}
		

	  ?>
    </body>
</html>
