<?
	include("config/connect.php");
	include("functions.php");
        
	$changeimage = "redemption";
	$uid = $_SESSION["userid"];
	
	$PRODUCTSPERPAGE_REDEEM = 8;

	if(!$_GET['pgno'])
	{
		$PageNo = 1;
	}
	else
	{
		$PageNo = $_GET['pgno'];
	}
	
	$currentdate = date("Y-m-d");
	
	$qrysel = "select * from redemption red left join products p on red.product_id=p.productID where (red.redem_startdate='".$currentdate."' and red.redem_enddate>='".$currentdate."') or (red.redem_startdate<='".$currentdate."' and red.redem_enddate>='".$currentdate."')";
	$ressel = db_query($qrysel);
	$totalpro = db_num_rows($ressel);
	$totalpage=ceil($totalpro/$PRODUCTSPERPAGE_REDEEM);

	if($totalpage>=1)
	{
		$startrow=$PRODUCTSPERPAGE_REDEEM*($PageNo-1);
		$qrysel .=" LIMIT $startrow,$PRODUCTSPERPAGE_REDEEM";
		$ressel = db_query($qrysel);
		$totalpro=db_num_rows($ressel);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$AllPageTitle;?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 6]>
<link href="css/menu_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>

<body>
<div class="main">
  <?php include("header.php"); ?>
  <div class="telebidbody">
    <div class="bodyin">
      <div class="bottumbody" style="min-height: 300px;">
		<div class="moreauction">
        	<div class="bidtitalbox">
              <div class="image"><img src="images/bidtitalcuve_1.png" width="10" height="29" /></div>
              <div class="bidtitalgred"><?=$SITE_NM;?> - Redemption</div>
              <div class="image"><img src="images/bidtitalcuve_2.png" width="10" height="29" /></div>
            </div>
        </div>     
          <?
		  	if($totalpro>0)
			{
		  ?>
          <div class="redemmain">
          <?
		  		$i = 1;
				while($obj = db_fetch_array($ressel))
				{
					if($i==4) { $classname = "redembox2"; } else { $classname = "redembox"; }
		  ?>
          		<div class="<?=$classname;?>">
	          		<div class="<?=strlen(stripslashes($obj["name"]))>29?"redem_pro_top2":"redem_pro_top";?>"><a class="prodtitle" href="redemptiondetail.php?rid=<?=$obj["id"];?>"><?=$obj["name"];?></a></div>
                    <div class="reddemboxmid">
                    	<div class="redemproimage"><a href="redemptiondetail.php?rid=<?=$obj["id"];?>"><img src="<?=$UploadImagePath;?>products/thumbs_big/thumbbig_<?=$obj["picture1"];?>" border="0" /></a></div>
                        <div class="redemprodetail">
                        	<div style="height:30px;">Product Price: <?=$Currency.$obj["price"];?></div>
                        	<div style="height:30px;">Redemption Points: <?=$obj["redem_points"];?></div>
                        	<div style="height:40px;">Expiration date: <?=arrangedate($obj["redem_enddate"]);?></div>
                        	<div style="position: absolute; float: left; margin-top: -20px; margin-left: 75px;">(Item)</div>
                            <div style="padding-top: 5px;">
                            <?php if($obj["redem_qty"]>$obj["redem_soldqty"]) { ?>
                            	<?php if($uid==""){ ?>
                                <img src="images/redeem.png" onmouseover="this.src='images/biglogin_hover.png'" onmouseout="this.src='images/redeem.png'" onclick="window.location.href='login.php'" style="cursor: pointer" />
                                <?php } else { ?>
	                                <img src="images/redeem.png" onmouseover="this.src='images/redeem_hover.png'" onmouseout="this.src='images/redeem.png'" onclick="window.location.href='redemptiondetail.php?rid=<?=$obj["id"];?>'" style="cursor: pointer;" />
                                <?php } ?>
                             <?php } else { ?>
                             	<img src="images/soldbut.png" />
                             <?php } ?>
                            </div>
                        </div>
                        
                    </div>
                    <div class="image"><img src="images/bidboxbot.png" /></div>
                </div>
          <?
		  			$i++;
					if($i==5) { $i = 1; }
		  		}
		  ?>
          </div>
		 <?php if($totalpage>1){ ?>
              <div class="imagetital" align="center">
              <?
                if($PageNo>1)
                {
                  $PrevPageNo = $PageNo-1;
              ?>
               	   <a class="darkblue-12-link" href="redemption.php?pgno=<?=$PrevPageNo; ?>">&lt; Previous Page</a>
              <?
                    if($totalpage>2 && $totalpage!=$PageNo)
                    {
              ?>
                    <span class="blue_link">&nbsp;|</span>
              <?
                    }
               }
              ?>&nbsp;
              <?
               if($PageNo<$totalpage)
               {
                  $NextPageNo = 	$PageNo + 1;
              ?>
                  <a class="darkblue-12-link" id="next" href="redemption.php?pgno=<?=$NextPageNo;?>">Next Page &gt;</a>
              <?
                   }
              ?>
              </div>		
          <?php } ?>
          <?
		  	}
			else
			{
		  ?>
            <div class="clear" style="height: 15px;">&nbsp;</div>
            <div class="clear" style="height: 15px;">&nbsp;</div>
            <div class="clear" style="height: 15px;">&nbsp;</div>
            <div class="darkblue-14" align="center">No redemption to display</div>
            <div class="clear" style="height: 250px;">&nbsp;</div>
          <?
		  	}
		  ?>	
    </div>
  </div><div class="image"><img src="images/mainbodybotcuve.png" /></div>
  </div>
  <?php include("footer.php");  ?>
</div>
</body>
</html>
