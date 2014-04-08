<?php
	include("config/connect.php");
	include("session.php");
	include("functions.php");
        
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

	$qrysel = "select * from bidbutler bb left join auction a on bb.auc_id=a.auctionID left join products p on a.productID=p.productID where bb.user_id='$uid' and a.auc_status='2'  and butler_status='0'";
	$ressel = db_query($qrysel);
	$total = db_num_rows($ressel);
	$totalpage=ceil($total/$PRODUCTSPERPAGE_MYACCOUNT);
	if($totalpage>=1)
	{
	$startrow=$PRODUCTSPERPAGE_MYACCOUNT*($PageNo-1);
	$qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE_MYACCOUNT";
	//echo $sql;
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
//		alert(id);
		var url = "deletebutler.php?delid=" + id; 
		$.ajax({
			url: url = "deletebutler.php?delid=" + id,
			dataType: 'json',
			success: function(data){
			$.each(data, function(i, item){
			result = item.result;
			if(result=="unsuccess")
			{
				alert("Your AutoBidder is running you can't delete it!");
			}
			else
			{
				window.location.href='mybidbutler.php';
			}
			});
		},
		error: function(XMLHttpRequest,textStatus, errorThrown){
//				alert(textStatus);
		}
		});
}
</script>
</head>

<body class="single">
<div id="main">
  <?php include("header.php"); ?>
  	 <div id="container">
        <?php include("include/topmenu.php"); ?>
        
         <div class="tab-area">
        <div id="column-right">
			<?php include("include/searchbox.php"); ?>
            <div id="title-category-content">
                <?php include("include/categorymenu.php"); ?>
                <p class="bid-title"><em><?php echo MY_ACTIVE_AUTOBIDDER; ?></em></p>
            </div><!-- /title-category-content -->
            <div id="mybids-box" class="content">	
            <?php
                
            if($total>0)
            {						
                while($obj = db_fetch_array($ressel))
            	{
            ?>				
            <div class="bid-box">
                <div class="bid-image">
                    <a href="productdetails.php?aid=<?=$obj["auctionID"];?>">
                        <img src="<?=$UploadImagePath;?>products/thumbs_small/thumbsmall_<?=$obj["picture1"];?>" alt="" width="118" height="100" border="0"/>
                    </a>
                    <img src="img/buttons/btn_closezoom.png" style="cursor: pointer;" onclick="DeleteBidButler1('<?=$obj["id"]?>');"/>                    
                </div><!-- /bid-image -->
                <div class="bid-content">
                    <h2><a href="productdetails.php?aid=<?=$obj["auctionID"];?>"><?=stripslashes($obj["name"]);?></a></h2>
                    <h3><?php echo DESCRIPTION; ?>:</h3>
                    <p><?=choose_short_desc(stripslashes($obj["short_desc"]),110);?><a href="productdetails.php?aid=<?=$obj["auctionID"];?>"><?php echo MORE; ?></a></p>
                    
                </div><!-- /bid-content -->
                <div class="bid-countdown">
                	<br />
                    <p>
                    	<strong><?php echo START_PRICE;?>:</strong><?=$Currency.number_format($obj["butler_start_price"],2);?>
                    </p>
                    <br />
                    <p>
                    	<strong><?php echo END_PRICE; ?>:</strong><?=$Currency.number_format($obj["butler_end_price"],2);?>
                    </p>
                    <br />
                    <p id="placebidsbut_<?=$obj["id"];?>">
                    	<strong><?php echo PLACE_BID; ?>:</strong><?=$obj["butler_bid"];?>
                    </p>
                    <br />
                </div><!-- /bid-countdown -->
            </div><!-- /bid-box -->
            <?php } ?>
            
                <!-- start page number-->
                
                <div class="clear">&nbsp;</div>
                <?php if($totalpage>1){ ?>
                <div class="pagenumber" align="right">
                    <ul>
                    <?
                    if($PageNo>1)
                    {
                          $PrevPageNo = $PageNo-1;
                    
                    ?>
                      <li><a href="myaccount.php?pgno=<?=$PrevPageNo; ?>">&lt; <?php echo PREVIOUS_PAGE; ?></a></li>
                    <?php 
                    }
                    ?>
                    
                    <?php
                    if($PageNo<$totalpage)
                    {
                     $NextPageNo = 	$PageNo + 1;
                    ?>
                      <li><a id="next" href="myaccount.php?pgno=<?=$NextPageNo;?>"><?php echo NEXT_PAGE; ?> &gt;</a></li>
                    <?php
                       }
                    ?>
                    </ul>
                </div>		
                <?php } ?><!--page number-->                    
            
            <?php }else{?>
            <div class="clear" style="height: 20px;">&nbsp;</div>
            <div align="center"><?php echo YOU_DONT_CURRENTLY_HAVE_ANY_AUTOBIDDERS; ?></div>
            <div class="clear" style="height: 20px;">&nbsp;</div>
            <?	}	?>                    
                
            </div><!-- /content -->
        </div><!-- /column-right -->
        <div id="column-left">
            <?php include("leftside.php"); ?>
           
         
        </div><!-- /column-left -->
        </div>
	</div><!-- /container -->
  
  <?php include("footer.php"); ?>

</body>
</html>
