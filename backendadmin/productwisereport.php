<?php
session_start();
$active="Report";
include_once("admin.config.inc.php");
include("connect.php");
include("functions.php");
include("security.php");
$PRODUCTSPERPAGE = 10;



if($_POST["submit"]!="" || $_GET["sdate"]!="") {

    if(!$_GET['pgno']) {
        $PageNo = 1;
    }
    else {
        $PageNo = $_GET['pgno'];
    }

    if($_POST["datefrom"]!="") {
        $startdate = ChangeDateFormat($_POST["datefrom"]);
        $enddate = ChangeDateFormat($_POST["dateto"]);
        $product = $_POST["products"];
        $auctionstatus = $_POST["auctionstatus"];
    }
    else {
        $startdate = ChangeDateFormat($_GET["sdate"]);
        $enddate = ChangeDateFormat($_GET["edate"]);
        $auctionstatus = $_GET["stat"];
        $product = $_GET["prod"];
    }

    $urldata = "sdate=".ChangeDateFormatSlash($startdate)."&edate=".ChangeDateFormatSlash($enddate)."&stat=".$auctionstatus."&prod=".$product;

    if($auctionstatus!="") {
        if($auctionstatus=="1") {
            $qrysel = "select * from auction a left join products p on a.productID=p.productID where a.auc_start_date>='$startdate' and auc_end_date<='$enddate' and a.productID='$product' and (a.auc_status='1' or a.auc_status='2')";
        }
        else {
            $qrysel = "select * from auction a left join products p on a.productID=p.productID where a.auc_start_date>='$startdate' and auc_end_date<='$enddate' and a.productID='$product' and a.auc_status='$auctionstatus'";
        }
    }
    else {
        $qrysel = "select * from auction a left join products p on a.productID=p.productID where a.auc_start_date>='$startdate' and auc_end_date<='$enddate' and a.productID='$product'";
    }
    $qrysel2=$qrysel;
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);
    $totalpage=ceil($total/$PRODUCTSPERPAGE);

    if($totalpage>=1) {
        $startrow=$PRODUCTSPERPAGE*($PageNo-1);
        $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
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
				$output.= '"Auction Type",';
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
				$output.= '"End Date",';
			}
			elseif($i==5)
			{
				$output.= '"Auction Status",';
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
					if($row['fixedpriceauction']=="1") { $val = "Fixed Price Auction"; }
					if($row['pennuauction']=="1") { $val = "Penny Auction"; }
					if($row['nailbiterauction']=="1") { $val = "NailBiter Auction"; }
					if($row['offauction']=="1") { $val = "100% Off Auction"; }
					if($row['nightauction']=="1") { $val = "Night Auction"; }
					if($row['openauction']=="1") { $val = "Open Auction"; }
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
					$val=substr(ChangeDateFormatSlash($row['auc_final_end_date']),0,10);
				}
				elseif($i==5)
				{
					if($row['auc_status']=="2" || $row['auc_status']=="1") { $val = "Active"; }
					elseif($row['auc_status']=="4") { $val = "Pending"; }
					elseif($row['auc_status']=="3") { $val = "Sold"; }
				}
					
				$output .='"'.$val.'",';
				$val="";
			}
		
			$output .="\n";
		}
		 
		
		// Output the file to the local filesystem.  You could append a 
		// date to the filename to keep a record of the exports.
		 
		// Open a new output file
		$filenm='productwisereport.csv';
		$output_file='reports/productwisereport.csv';
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
			window.open("download.php?filenm=<?=base64_encode($filenm)?>&mime=<?=base64_encode('application/octet-stream')?>&foldername=<?=base64_encode('reports')?>,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=650,height=650,screenX=150,screenY=200,top=100,left=100'");
		</script>
		<?				
	}*/


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Productwise Report-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
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
                if(document.f1.products.value=="none")
                {
                    alert("Please select product!!!");
                    return false;
                    document.f1.products.focus();
                }
            }
            function OpenPopup(url)
            {
                window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=100,height=100,screenX=300,screenY=350,top=300,left=350');

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
                                <h2>Productwise Report</h2>
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
                                                    <form name="f1" action="" method="post" onSubmit="return Check(this)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <?php include("datepickers.php"); ?>

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Products:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <?php
                                                                            $qrr="select * from products order by name";
                                                                            $resp = db_query($qrr) or die(db_error());
                                                                            $totalp = db_num_rows($resp);
                                                                            ?>
                                                                            <select name="products">
                                                                                <option value="none">Please Select</option>
                                                                                <?php if($totalp>0) {
                                                                                    while($roww=db_fetch_array($resp)) {
                                                                                        ?>
                                                                                <option <?=$product==$roww["productID"]?"selected":"";?> value="<?=$roww["productID"];?>"><?=stripslashes($roww["name"]);?></option>
                                                                                        <?
                                                                                    }
                                                                                }
                                                                                ?>
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
                                                                                <option <?=$auctionstatus==""?"selected":"";?> value="">Please Select</option>
                                                                                <option <?=$auctionstatus=="1"?"selected":"";?> value="1">Active</option>
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
                                <h2>Product List</h2>
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
                                                                            <th>Auction Type</th>
                                                                            <th style="text-align:center;">Start Price</th>
                                                                            <th style="text-align:center;">Fixed Price</th>
                                                                            <th style="text-align:center;">End Date</th>
                                                                            <th style="text-align:center;width:100px;">Auction Status</th>
                                                                            <th style="text-align:center;width:60px;">Option</th>
                                                                        </tr>
                                                                                <?
                                                                                $i=1;
                                                                                while($obj = db_fetch_object($ressel)) {
                                                                                    if($obj->fixedpriceauction=="1") {
                                                                                        $type = "Set Price Auction";
                                                                                    }
                                                                                    if($obj->pennyauction=="1") {
                                                                                        $type = "1 Cent Auction";
                                                                                    }
                                                                                    if($obj->nailbiterauction=="1") {
                                                                                        $type = "NailBiter Auction";
                                                                                    }
                                                                                    if($obj->offauction=="1") {
                                                                                        $type = "Totally Free";
                                                                                    }
                                                                                    if($obj->nightauction=="1") {
                                                                                        $type = "Night Auction";
                                                                                    }
                                                                                    if($obj->openauction=="1") {
                                                                                        $type = "Open Auction";
                                                                                    }

                                                                                    if($obj->auc_status=="2" || $obj->auc_status=="1") {
                                                                                        $status = "<font color='red'>Active</font>";
                                                                                    }
                                                                                    elseif($obj->auc_status=="4") {
                                                                                        $status = "<font color='green'>Pending</font>";
                                                                                    }
                                                                                    elseif($obj->auc_status=="3") {
                                                                                        $status = "<font color='blue'>Sold</font>";
                                                                                    }
                                                                                    ?>
                                                                        <tr class="<?php echo ($i==1)?'first':'second'; ?>">
                                                                            <td style="text-align:center;">
                                                                                            <?php if($obj->auctionID) {
                                                                                                echo $obj->auctionID;
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?></td>
                                                                            <td><?=$type!=""?$type:"&nbsp;";?></td>
                                                                            <td style="text-align:right;">
                                                                                            <?=$Currency;?><?php if($obj->auc_start_price) {
                                                                                                echo $obj->auc_start_price;
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?></td>
                                                                            <td style="text-align:right;">
                                                                                            <?=$Currency;?><?php if($obj->auc_fixed_price) {
                                                                                                echo $obj->auc_fixed_price;
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?></td>
                                                                            <td style="text-align:center;">
                                                                                            <?php if($obj->auc_final_end_date) {
                                                                                                echo substr(ChangeDateFormatSlash($obj->auc_final_end_date),0,10);
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?></td>
                                                                            <td style="text-align:center;">
                                                                                            <?php if($status) {
                                                                                                echo $status;
                                                                                            }else {
                                                                                                echo "&nbsp;";
                                                                                            }?></td>

                                                                            <td style="text-align:center;">
                                                                                <div class="actions_menu">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a class="details" name="details" href="auctiondetails.php?aid=<?=$obj->auctionID;?>">Details</a>
                                                                                        </li>
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
                                                            <li><a href="productwisereport.php?pgno=<?=$PrevPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                        <?php } ?>

                                                                    <?php
                                                                    $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                    $pageTo=$PageNo+3>$totalpage?$totalpage:$PageNo+3;
                                                                    for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                        ?>
                                                                        <?php if($i==$PageNo) { ?>
                                                            <li><a href="productwisereport.php?pgno=<?=$i;?>&<?=$urldata;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                            <?php }else {?>
                                                            <li><a href="productwisereport.php?pgno=<?=$i;?>&<?=$urldata;?>"><?php echo $i; ?></a></li>
                                                                            <?php }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if($PageNo<$totalpage) {
                                                                        $NextPageNo = 	$PageNo + 1;
                                                                        ?>
                                                            <li><a href="productwisereport.php?pgno=<?=$NextPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                        <?php } ?>
                                                        </ul>

                                                    </div>
                                                    <!--[if !IE]>end pagination<![endif]-->
                                                            <?php }?>

                                                    <div class="categoryorder" style="text-align: center;">
                                                            <?
                                                            if($total>0) {
                                                                ?>
                                                        <span class="button send_form_btn"><span><span>Export to CSV</span></span><input type="button" name="submit" onclick="OpenPopup('download.php?export=product&datefrom=<?=$_POST["datefrom"]?>&dateto=<?=$_POST["dateto"]?>&products=<?=$_POST["products"]?>&auctionstatus=<?=$_POST["auctionstatus"]?>')"/></span>
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
                <?php include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

    </body>
</html>