<?php
	include("config/connect.php");
	include("session.php");
	include("functions.php");
        include_once 'common/seosupport.php';
        
	$changeimage = "myaccount";
	$uid = $_SESSION["userid"];
	if(!$_GET['pgno'])
	{
		$PageNo = 1;
	}
	else
	{
		$PageNo = $_GET['pgno'];
	}

	$qrysel = "select * from bidbutler bb left join auction a on bb.auc_id=a.auctionID left join products p on a.productID=p.productID where bb.user_id='$uid'   and butler_status='0'";
	$ressel = db_query($qrysel);
	$total = db_num_rows($ressel);
	$totalpage=ceil($total/$PRODUCTSPERPAGE_MYACCOUNT);
	if($totalpage>=1)
	{
	$startrow=$PRODUCTSPERPAGE_MYACCOUNT*($PageNo-1);
	$qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE_MYACCOUNT";

	$ressel=db_query($qrysel);
	$total=db_num_rows($ressel);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php include("page_headers.php"); ?>

<script language="javascript" type="text/javascript">
function DeleteBidButler1(id)
{
		var url = "deletebutler.php?delid=" + id; 
		$.ajax({
			url: url = "deletebutler.php?delid=" + id,
			dataType: 'json',
			success: function(data){
			$.each(data, function(i, item){
			result = item.result;
			if(result=="unsuccess")
			{
				alert("<?php echo YOUR_AUTOBIDDER_IS_RUNNING_YOU_CANT_DELETE_IT; ?>");
			}
			else
			{
				window.location.href='myautobidder.php';
			}
			});
		},
		error: function(XMLHttpRequest,textStatus, errorThrown){

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
	      if(file_exists($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF'])  )  ) {
		include($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF']));
		}else{
		include($BASE_DIR . "/include/user_pages/" . basename($_SERVER['PHP_SELF']));
	      }
	  ?>
</body>
</html>