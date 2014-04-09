<?php
session_start();
$active="Report";
$master_item = 'Auctions';
include_once("admin.config.inc.php");
include("connect.php");
include("functions.php");
include("security.php");
$PRODUCTSPERPAGE = 10;

if($_POST["submit"]!="" || $_GET["sdate"]!="") {
    if($_POST["submit"]=="") {
        if(!$_GET['pgno']) {
            $PageNo = 1;
        }
        else {
            $PageNo = $_GET['pgno'];
        }
    }
    else {
        $PageNo = 1;
    }

    if($_POST["datefrom"]!="") {
        $startdate = ChangeDateFormat($_POST["datefrom"]);
        $enddate = ChangeDateFormat($_POST["dateto"]);
        $auctionstatus = $_POST["auctionstatus"];
        $auctiontype = $_POST["auctiontype"];
    }
    else {
        $startdate = ChangeDateFormat($_GET["sdate"]);
        $enddate = ChangeDateFormat($_GET["edate"]);
        $auctionstatus = $_GET["stat"];
        $auctiontype = $_GET["type"];
    }

    $urldata = "sdate=".ChangeDateFormatSlash($startdate)."&edate=".ChangeDateFormatSlash($enddate)."&stat=".$auctionstatus."&type=".$auctiontype;

    if($auctiontype!="none") {
        if($auctiontype=="fpa") {
            $auctype = "and fixedpriceauction='1'";
        }
        if($auctiontype=="pa") {
            $auctype = "and pennyauction='1'";
        }
        if($auctiontype=="nba") {
            $auctype = "and nailbiterauction='1'";
        }
        if($auctiontype=="off") {
            $auctype = "and offauction='1'";
        }
        if($auctiontype=="na") {
            $auctype = "and nightauction='1'";
        }
        if($auctiontype=="oa") {
            $auctype = "and openauction='1'";
        }
    }

    if($auctionstatus!="") {
        if($auctionstatus==2) {
            $qrysel = "select * from auction a left join products p on a.productID=p.productID where (a.auc_status='$auctionstatus' or a.auc_status='1') and  auc_start_date>='$startdate' and auc_end_date<='$enddate' ".$auctype;
        }
        else {
            $qrysel = "select * from auction a left join products p on p.productID=a.productID where a.auc_status='$auctionstatus' and auc_start_date>='$startdate' and auc_end_date<='$enddate' ".$auctype;
        }
    }
    else {
        $qrysel = "select * from auction a left join products p on p.productID=a.productID where auc_start_date>='$startdate' and auc_end_date<='$enddate' ".$auctype;
    }
    $qrysel2=$qrysel;
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);
    $totalpage=ceil($total/$PRODUCTSPERPAGE);

    if($totalpage>=1) {
        $startrow=$PRODUCTSPERPAGE*($PageNo-1);
        $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
        //echo $sql;
        $ressel=db_query($qrysel);
        $total=db_num_rows($ressel);
    }
}


/*if($_POST['export'])
	{
		
		// Must be a writeable location for file
		//$output_file="export.csv";
		 
		// The query to output to CSV
		$sql = $qrysel2;
		// Support for multi-table select
		// $sql = "SELECT * FROM tbl2, tbl1 WHERE tbl1.col1 = tbl2.col2";
		 
		//---------------------------------------------------
		// Connect database
		//db_connect($host,$username,$password,$DATABASENAME);
		//db_select_db($database);
		 
		$result=db_query($sql);
		 
		$output = '';
		 
		// Get a list of all the fields in the table
		// $fields = db_list_fields($database,$table);
		// Count the number of fields
		$count_fields = 6; //db_num_fields($result);
		 
		// Put the name of all fields to $out.
		for ($i = 0; $i < $count_fields; $i++) 
		{
			if($i==0)
			{
				$output.= '"Auction ID",';
			}
			elseif($i==1)
			{
				$output.= '"Name",';
			}
			elseif($i==2)
			{
				$output.= '"Start Price",';
			}
			elseif($i==3)
			{
				$output.= '"Fixed Price",';
			}
			elseif($i==4)
			{
				$output.= '"Auction Status",';
			}
			elseif($i==5)
			{
				$output.= '"Duration",';
			}
		}
		$output .="\n";
		 
		// Add all values in the table to $out.
		while ($row = db_fetch_array($result)) 
		{
			for ($i = 0; $i < $count_fields; $i++) 
			{
				
				if($i==0)
				{
					$val=$row["auctionID"];
				}
				elseif($i==1)
				{
					$val=$row["name"];
				}
				elseif($i==2)
				{
					$val=$row['auc_start_price'];
				}
				elseif($i==3)
				{
					$val=$row['auc_fixed_price'];	
				}
				elseif($i==4)
				{					
					if($row['auc_status']=="2" || $row['auc_status']=="1") 
					{
						if($row['pause_status']=="1")
						{
							$val = "Paused";	
						}
						else
						{
							$val = "Active";
						}
				  	}
					if($row['auc_status']=="3") { $val = "Sold"; }
					if($row['auc_status']=="4") { $val = "Pending"; }
					
				}
				elseif($i==5)
				{
					if($row['time_duration']=="none"){ $val = "Default"; }
					elseif($row['time_duration']=="10sa"){ $val = "10 Second"; }
					elseif($row['time_duration']=="15sa"){ $val = "15 Second"; }
					elseif($row['time_duration']=="20sa"){ $val = "20 Second"; }
				}
					
				$output .='"'.$val.'",';
				$val="";
			}
		
			$output .="\n";
		}
		 
		
		// Output the file to the local filesystem.  You could append a 
		// date to the filename to keep a record of the exports.
		 
		// Open a new output file
		$filenm='auctionwisereport.csv';
		$output_file='reports/auctionwisereport.csv';
		if(file_exists($output_file))
		{
			@unlink($output_file);
		}
		
		$file = fopen ($output_file,'w');
		// Put contents of $output into the $file
		fputs($file, $output);
		fclose($file);
		
		?>
		<script language="javascript">
			window.location.href="download.php?filenm=<?=base64_encode($filenm)?>&mime=<?=base64_encode('application/octet-stream')?>&foldername=<?=base64_encode('reports')?>";
		</script>
		<?				
	}*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Auctionwise Report-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.core.min.js"></script>
        <script type="text/javascript" src="js/ui/ui.datepicker.min.js"></script>
        <script type="text/javascript">
            function Check(f1)
            {
                if(document.f1.datefrom.value=="")
                {
                    alert("Please select start date!!!");
                    return false;
                    document.f1.datefrom.focus();
                }
                if(document.f1.dateto.value=="")
                {
                    alert("Please select end date!!!");
                    return false;
                    document.f1.dateto.focus();
                }
            }
            function OpenPopup(url)
            {
                window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=100,height=100,screenX=300,screenY=350,top=300,left=350');

            }
        </script>
        <script type="text/javascript">
            // USE FOR AJAX //
            function GetXmlHttpObject()
            {
                var xmlHttp=null;
                try
                {
                    // Firefox, Opera 8.0+, Safari
                    xmlHttp=new XMLHttpRequest();
                }
                catch (e)
                {
                    // Internet Explorer
                    try
                    {
                        xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
                    }
                    catch (e)
                    {
                        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                }
                return xmlHttp;
            }

            function PauseAuction(aucid)
            {
                xmlHttp=GetXmlHttpObject();
                if (xmlHttp==null)
                {
                    alert ("Your browser does not support AJAX!");
                    return;
                }
                var url="pauseauction.php";
                url=url+"?aucid="+aucid
                xmlHttp.onreadystatechange=changeStatus;
                xmlHttp.open("GET",url,true);
                xmlHttp.send(null);
            }
            function changeStatus()
            {
                if (xmlHttp.readyState==4)
                {
                    var temp=xmlHttp.responseText;
                    redata = temp.split('|');
                    if(redata[0]=="success")
                    {
                        document.getElementById('pause_' + redata[1]).style.display = 'none';
                        document.getElementById('resume_' + redata[1]).style.display = 'block';
                        document.getElementById('auctionstatus_' + redata[1]).style.color = 'green';
                        document.getElementById('auctionstatus_' + redata[1]).innerHTML = 'Paused';
                    }
                }
            }
            function StartAuction(aucid1)
            {
                xmlHttp=GetXmlHttpObject();
                if (xmlHttp==null)
                {
                    alert ("Your browser does not support AJAX!");
                    return;
                }
                var url="pauseauction.php";
                url=url+"?aucidstart="+aucid1
                xmlHttp.onreadystatechange=changeStatus1;
                xmlHttp.open("GET",url,true);
                xmlHttp.send(null);
            }
            function changeStatus1()
            {
                if (xmlHttp.readyState==4)
                {
                    var temp=xmlHttp.responseText;
                    redata = temp.split('|');
                    if(redata[0]=="success")
                    {
                        document.getElementById('pause_' + redata[1]).style.display = 'block';
                        document.getElementById('resume_' + redata[1]).style.display = 'none';
                        document.getElementById('auctionstatus_' + redata[1]).style.color = '#FF0000';
                        document.getElementById('auctionstatus_' + redata[1]).innerHTML = 'Active';
                    }
                }
            }


        </script>

    </head>

    <body>
        <!--[if !IE]>start wrapper<![endif]-->
        <div id="wrapper">
            <!--[if !IE]>start head<![endif]-->
            <div id="head">
                <?php include('include/header.php'); ?>
            </div>
            <!--[if !IE]>end head<![endif]-->

            <!--[if !IE]>start content<![endif]-->
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">
                    <div class="inner">
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Auctionwise Report</h2>
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>
                            <!--[if !IE]>end title wrapper<![endif]-->
                            <!--[if !IE]>start section content<![endif]-->
                            <div class="section_content">
                                <!--[if !IE]>start section content top<![endif]-->
                                <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form action="" method="post" name="f1" onSubmit="return Check(this)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                               <?php include("datepickers.php"); ?>

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Type:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="auctiontype">
                                                                                <option value="none">Please Select</option>
                                                                                <option value="standard">Standard Auction</option>
                                                                                <option <?=$auctiontype=="seatauction"?"selected":"";?> value="seatauction">Seat Auction</option>
                                                                                <option <?=$auctiontype=="beginner_auction"?"selected":"";?> value="beginner_auction">Beginner Auction</option>
                                                                                <option <?=$auctiontype=="fpa"?"selected":"";?> value="fpa">Set Price Auction</option>
                                                                                <option <?=$auctiontype=="pa"?"selected":"";?> value="pa">1 Cent Auction</option>
                                                                                <option <?=$auctiontype=="nba"?"selected":"";?> value="nba">NailBiter Auction</option>
                                                                                <option <?=$auctiontype=="off"?"selected":"";?> value="off">Totally Free</option>
                                                                                <option <?=$auctiontype=="na"?"selected":"";?> value="na">Night Auction</option>
                                                                                <option <?=$auctiontype=="oa"?"selected":"";?> value="oa">Open Auction</option>
                                                                                <option <?=$auctiontype=="reserve"?"selected":"";?> value="reserve">Reserve Auction</option>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Status:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="auctionstatus">
                                                                                <option value="">select</option>
                                                                                <option <?=$auctionstatus=="2"?"selected":"";?> value="2">Active</option>
                                                                                <option <?=$auctionstatus=="3"?"selected":"";?> value="3">Sold</option>
                                                                                <option <?=$auctionstatus=="4"?"selected":"";?> value="4">Pending</option>
                                                                            </select>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <span class="button send_form_btn"><span><span>Search</span></span><input name="submit" type="submit"/></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                            </div>
                                                            <!--[if !IE]>end forms<![endif]-->

                                                        </fieldset>
                                                        <!--[if !IE]>end fieldset<![endif]-->
                                                    </form>
                                                    <!--[if !IE]>end forms<![endif]-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
                        <!--[if !IE]>end section<![endif]-->

                        <?php if(isset($total)) {
                            ?>
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->

                            <div class="title_wrapper">
                                <h2>Auction List</h2>
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>

                            <!--[if !IE]>end title wrapper<![endif]-->
                            <!--[if !IE]>start section content<![endif]-->
                            <div class="section_content">
                                <!--[if !IE]>start section content top<![endif]-->
                                <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                    <?php if($total==0) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No Auctions To Display.</strong></li>
                                                                </ul>
                                                                        <?php }else {?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="width:80px;text-align: center;">Auctino ID</th>
                                                                            <th>Name</th>
                                                                            <th style="text-align:center;">Start Price</th>
                                                                            <th style="text-align:center;">Fixed Price</th>
                                                                            <th style="text-align:center;">Auction Status</th>
                                                                            <th style="text-align:center;width:100px;">Duration</th>
                                                                            <th style="text-align:center;width:60px;">Option</th>
                                                                        </tr>
                                                                     
                                                                                <?php
                                                                                $i=1;
                                                                                $id = 'auctionID';
                                                                                
                                                                                while($obj = db_fetch_object($ressel)) {
										
                                                                                 
                                                                           
                                                                              
                                                                             
                                                                                    if($obj->time_duration=="none") {
                                                                                        $duration = "Default";
                                                                                    }
                                                                                    elseif($obj->time_duration=="10sa") {
                                                                                        $duration = "10 Second";
                                                                                    }
                                                                                    elseif($obj->time_duration=="15sa") {
                                                                                        $duration = "15 Second";
                                                                                    }
                                                                                    elseif($obj->time_duration=="20sa") {
                                                                                        $duration = "20 Second";
                                                                                    }

                                                                                    if($obj->auc_status=="2" || $obj->auc_status=="1") {
                                                                                        if($obj->pause_status=="1") {
                                                                                            $status = "<font color='green'>Paused</font>";
                                                                                        }
                                                                                        else {
                                                                                            $status = "<font color='red'>Active</font>";
                                                                                        }
                                                                                    }
                                                                                    if($obj->auc_status=="3") {
                                                                                        $status = "<font color='blue'>Sold</font>";
                                                                                    }
                                                                                    if($obj->auc_status=="4") {
                                                                                        $status = "<font color='green'>Pending</font>";
                                                                                    }

                                                                                    ?>
                                                                        <tr class="<?php echo ($i==1)?'first':'second'; ?>">
                                                                            <td style="text-align:center;">
                                                                                            <?php if($obj->auctionID) {
                                                                                                echo $obj->auctionID;
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?>
                                                                            </td>
                                                                            <td><?php if($obj->name) {
                                                                                                echo stripslashes($obj->name);
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?></td>
                                                                            <td style="text-align:right;">
                                                                                            <?=$Currency;?><?php if($obj->auc_start_price) {
                                                                                                echo $obj->auc_start_price;
                                                                                            }else {
                                                                                                echo "0.00";
                                                                                            }?>
                                                                            </td>
                                                                            <td style="text-align:right;">
                                                                                            <?=$Currency;?><?php if($obj->auc_fixed_price) {
                                                                                                echo $obj->auc_fixed_price;
                                                                                            }else {
                                                                                                echo "0.00";
                                                                                            }?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                <span id="auctionstatus_<?=$obj->auctionID;?>"><?php if($status) {
                                                                                                    echo $status;
                                                                                                }else {
                                                                                                    echo "&nbsp;";
                                                                                                }?></span>
                                                                            </td>
                                                                            <td>
                                                                                            <?php if($duration) {
                                                                                                echo $duration;
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?>
                                                                            </td>

                                                                            <td style="text-align:center;">
                                                                                <div class="actions_menu">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a class="details" name="details" href="auctiondetails.php?aid=<?=$obj->auctionID;?>">Details</a>
                                                                                        </li>

                                                                                                    <?php if($obj->pause_status=="0" && $obj->auc_status=="2") { ?>
                                                                                        <li id="pause_<?=$obj->auctionID;?>" >
                                                                                            <a name="pause" href="#" onClick="PauseAuction('<?=$obj->auctionID;?>');">Pause</a>
                                                                                        </li>
                                                                                        <li id="resume_<?=$obj->auctionID;?>" style="display: none;">
                                                                                            <a name="resume" href="#" onClick="StartAuction('<?=$obj->auctionID;?>');">Resume</a>
                                                                                        </li>
                                                                                                        <?php } elseif($obj->pause_status=="1" && $obj->auc_status=="2") { ?>
                                                                                        <li id="pause_<?=$obj->auctionID;?>" style="display: none;" >
                                                                                            <a name="pause" href="#" onClick="PauseAuction('<?=$obj->auctionID;?>');">Pause</a>
                                                                                        </li>
                                                                                        <li id="resume_<?=$obj->auctionID;?>" >
                                                                                            <a name="resume" href="#" onClick="StartAuction('<?=$obj->auctionID;?>');">Resume</a>
                                                                                        </li>
                                                                                                        <?php } ?>

                                                                                    </ul>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                                    <?php
                                                                                    $i=$i*-1;
                                                                                }
                                                                                ?>
                                                                    </tbody>
                                                                </table>
                                                                        <?php }?>

                                                            </div>
                                                        </div>
                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                    </div>

                                                        <?php if($total) { ?>
                                                    <!--[if !IE]>start pagination<![endif]-->
                                                    <div class="pagination">
                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpage; ?></span>
                                                        <ul class="pag_list">
                                                                    <?php
                                                                    if($PageNo>1) {
                                                                        $PrevPageNo = $PageNo-1;
                                                                        ?>
                                                            <li><a href="auctionwisereport.php?pgno=<?=$PrevPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                        <?php } ?>

                                                                    <?php
                                                                    $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                    $pageTo=$PageNo+3>$totalpage?$totalpage:$PageNo+3;
                                                                    for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                        ?>
                                                                        <?php if($i==$PageNo) { ?>
                                                            <li><a href="auctionwisereport.php?pgno=<?=$i;?>&<?=$urldata;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                            <?php }else {?>
                                                            <li><a href="auctionwisereport.php?pgno=<?=$i;?>&<?=$urldata;?>"><?php echo $i; ?></a></li>
                                                                            <?php }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if($PageNo<$totalpage) {
                                                                        $NextPageNo = 	$PageNo + 1;
                                                                        ?>
                                                            <li><a href="auctionwisereport.php?pgno=<?=$NextPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                        <?php } ?>
                                                        </ul>

                                                    </div>
                                                    <!--[if !IE]>end pagination<![endif]-->
                                                            <?php }?>

                                                    <div class="categoryorder" style="text-align: center;">
                                                            <?
                                                            if($total>0) {
                                                                ?>                                                     
                                                        <span class="button send_form_btn"><span><span>Export to CSV</span></span><input type="button" name="submit" onclick="OpenPopup('download.php?export=auction&datefrom=<?=$_POST["datefrom"]?>&dateto=<?=$_POST["dateto"]?>&auctiontype=<?=$_POST["auctiontype"]?>&auctionstatus=<?=$_POST["auctionstatus"]?>')"/></span>
                                                        <br/><br/>
                                                                <?
                                                            }
                                                            ?>
                                                    </div>



                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
                        <!--[if !IE]>end section<![endif]-->

                            <?php } ?>

                    </div>
                </div>
                <!--[if !IE]>end page<![endif]-->
                <!--[if !IE]>start sidebar<![endif]-->
                <div id="sidebar">
                    <div class="inner">
                        <?php include 'include/leftside.php' ?>
                    </div>
                </div>
                <!--[if !IE]>end sidebar<![endif]-->

            </div>
            <!--[if !IE]>end content<![endif]-->

        </div>
        <!--[if !IE]>end wrapper<![endif]-->

        <!--[if !IE]>start footer<![endif]-->
        <div id="footer">
            <div id="footer_inner">
                <?php 
                $ressel = db_query("select auc_final_price, bc.bid_count, auc_end_date from auctions left join bid_account_bidding bc on bc.auction_id = auctions.auctionID sort by auc_end_date desc LIMIT $startrow,$PRODUCTSPERPAGE");
                $master_item = 'auctionID';
                
                include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

    </body>
</html>