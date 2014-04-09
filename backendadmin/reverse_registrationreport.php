<?php
session_start();
$active="Report";
include_once("admin.config.inc.php");
include("connect.php");
include("functions.php");
include("security.php");
$PRODUCTSPERPAGE = 15;

if($_POST["submit"]!="" || $_GET["sdate"]!="") {
    if(!$_GET['pgno']) {
        $PageNo = 1;
    }
    else {
        $PageNo = $_GET['pgno'];
    }

    if($_POST["datefrom"]!="") {
        $status = $_POST["userstatus"];
        $startdate = ChangeDateFormat($_POST["datefrom"]);
        $enddate = ChangeDateFormat($_POST["dateto"]);
    }
    else {
    if(!empty($_GET['sdate'])){
        $startdate = ChangeDateFormat($_GET["sdate"]);
        $enddate = ChangeDateFormat($_GET["edate"]);
        $status =$_GET["status"];
	}
    }
    $urldata = "sdate=".ChangeDateFormatSlash($startdate)."&edate=".ChangeDateFormatSlash($enddate);

    
}else{

        $PageNo = 1;
	
}

if(empty($_REQUEST['uid'])){
$qrysel = "select distinct sponser from registration where ";
}else{

$qrysel = "select distinct sponser from registration where ";

}
if(!empty($startdate)){

$qrysel .= "registration_date>='".$startdate."'";

}

if(!empty($enddate)){

$qrysel .= "and registration_date<='".$enddate."' ";

}
if(empty($_REQUEST['uid'])){
$qrysel .= " and sponser != '0'";
}


if(!empty($_REQUEST['uid'])){

$qrysel .= " sponser = '$_REQUEST[uid]'";

}

    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);
    $totalrecords = $total;
    $totalpage=ceil($total/$PRODUCTSPERPAGE);

    if($totalpage>=1) {
        $startrow=$PRODUCTSPERPAGE*($PageNo-1);
        $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
        $ressel=db_query($qrysel);
        $total=db_num_rows($ressel);
    }



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Daily User Registration Report-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
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
                var recto = Number(document.getElementById('recto').value);
                var recfrom = Number(document.getElementById('recfrom').value);

                if(recfrom!="")
                {
                    if(recfrom>=recto)
                    {
                        alert("Record To value must be greater than Record From value!");
                        return false;
                    }
                }
                url = url + "&recfrom=" + recfrom + "&recto=" + recto;
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
                                <h2>Daily Referral Report</h2>
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
                                                    <form action="" method="post" name="f1" onsubmit="return Check(this)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <?php include("datepickers.php"); ?>

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
                            if($total<=0) { ?>
                        <ul class="system_messages">
                            <li class="blue"><span class="ico"></span><strong class="system_title">No Members To Display</strong></li>
                        </ul>
                                <?php }else {?>
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Users List</h2>
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
                                                     <div class="categoryorder">
                                                      <div>
                                                            <span><strong>Active Sponsers:</strong><?=$totalcount;?>&nbsp;&nbsp;</span>
                                                           
							  </div>
                                                        <br/>
                                                        <div>
                                                            <div style="float:left;">
                                                                <strong>Export member details to CSV :&nbsp;From</strong>:<input id="recfrom" type="text" name="recfrom" value="0" />&nbsp;-&nbsp;
                                                                <strong>To</strong>:<input id="recto" type="text" name="recto" value="<?=$totexprecords?>" />&nbsp;&nbsp;&nbsp;
                                                            </div>
                                                            <span class="button send_form_btn"><span><span>Export to CSV</span></span><input name="submit" type="button" onclick="OpenPopup('download.php?export=regreport&<?=$urldata;?>')" /></span>

                                                        </div>
                                                        <div class="clear"></div>

                                                    </div>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">

                                                                <form id="form2" name="form2" action="" method="post">
                                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th style="text-align:center;width:60px;">User ID</th>
                                                                                <th>User Name</th>
                                                                                <th>First Name</th>
                                                                                <th>Email</th>                                                                              
                                                                                <th># Users Referred</th>
                                                                                <th style="text-align:center;">Registration Date</th>
                                                                                <th style="text-align:center;">Status</th>
                                                                                <th style="text-align:center;width:80px;">Option</th>
                                                                            </tr>
                                                                                    <?php
                                                                                    $colorflg=0;
                                                                                    while($obj = db_fetch_object($ressel)) {
                                                                                        if ($colorflg==1) {
                                                                                            $colorflg=0;
                                                                                        }else {
                                                                                            $colorflg=1;
                                                                                        }

                                                                                        $qr = "select * from bid_account where user_id='".$objS->rid."' and bid_flag='c'";
                                                                                        $rs = db_query($qr);
                                                                                        $totalbid = db_num_rows($rs);

                                                                                        if($totalbid>0) {
                                                                                            $status1 = "<font color='green'>Active</font>";
                                                                                        }
                                                                                        else {
                                                                                            $status1 = "<font color='red'>Not Active</font>";
                                                                                        }

                                                                                        if($objS->sponser>"0") {
                                                                                            $qreg = "select * from registration where id='".$objS->sponser."'";
                                                                                            $rseg = db_query($qreg);
                                                                                            $objreg=db_fetch_object($rseg);
                                                                                            $refuname = $objreg->username;
                                                                                        }
                                                                                        ?>
                                                                            <tr class="<?php echo ($colorflg==0)?'first':'second'; ?>">
						<?php $objS = db_fetch_object(db_query("select * from registration where id = '" . $obj->sponser . "' limit 1")); ?>
                                                                                <td style="text-align:center;">
										  <a href="javascript:;" onclick="document.getElementById('refered[<?php echo $obj->sponser;?>]').style.display = 'block';"><b>+&nbsp;&nbsp;&nbsp;&nbsp;</b></a>
										  <?=$obj->sponser;?></td>
										  <td>
											<a href="http://biddersparadise.com/backendadmin/view_member_statistics.php?uid=<?php echo $obj->sponser;?>">
											  <?=$objS->username;?></a>
											  
										  </td>
										    
                                                                                <td><?=$objS->firstname."&nbsp;".$objS->lastname;?></td>
                                                                                <td><?=$objS->email;?></td>
										<td>
										<?php echo "(" . db_num_rows(db_query("select * from registration where sponser = '" . $obj->sponser . "' and registration_date>='".$startdate."' and registration_date<='".$enddate."'")) .")";?> - <?php echo db_num_rows(db_query("select * from registration where sponser = '" . $obj->sponser . "'"));?>
										
										</td>
                                                                                <td style="text-align:center;"><?=arrangedate($objS->registration_date);?></td>
                                                                                <td style="text-align:center;"><?=$status1;?></td>                                                                              
                                                                                <td style="text-align:center;">
                                                                                    <div class="actions_menu">
                                                                                        <ul>
                                                                                            <li>
                                                                                                <a name="details" class="details" href="view_member_statistics.php?uid=<?=$objS->id;?>">Statistics</a>
                                                                                            </li>
											   <?php if(!empty($objS->infusion_id)){
											     ?>
											     <li>
                                                                                                <a name="details" class="details" href="https://yy117.infusionsoft.com/Contact/manageContact.jsp?view=edit&ID=<?=$objS->infusion_id;?>">Infusion</a>
                                                                                            </li>
											    <?php } ?>
                                                                                        </ul>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
									    <tr>
									      <td colspan="8">
								<table  id="refered[<?php echo $obj->sponser; ?>]" style="width:100%;display:none;border:1px solid black;">
								  <tr>
									      <td>
									      </td>
									      <td style="font-weight:bold;">
										User Id
									      </td>
									      <td style="font-weight:bold;">
										User Name
									      </td>
									      <td style="font-weight:bold;">
										Email
									      </td>
																											      <td style="font-weight:bold;">
										Bid Pack History
									      </td>
									      <td style="font-weight:bold;">
										Won Auction History
									      </td>
									      <td style="font-weight:bold;">
										Buy It Now History
									      </td>
									      <td style="font-weight:bold;">
										Registration Date
									      </td>
									      <td style="font-weight:bold;">
										Status
									      </td>
									      <?php
									      if(file_exists("../include/addons/infusion/daemon.php")){
										?>
									      <td style="font-weight:bold;">
										Infusion Link
									      </td>
									      <?php } ?>
									    </tr>
									   
										
										
			<?php
			  $sqlUsers_Referred = "select * from registration where sponser = '" . $obj->sponser . "'";
			  
			  if(!empty($startdate)){
			      $sqlUsers_Referred .= " and registration_date>='".$startdate."'";
			      
			      }
			      if(!empty($enddate)){
			      
			      $sqlUsers_Referred .= " and registration_date<='".$enddate."'";
			  
			    }
			      $referred = db_query($sqlUsers_Referred);
			      
			      while($row_referred = db_fetch_array($referred)){
			      
			       $qrR = "select * from bid_account where user_id='".$row_referred['id'] ."' and bid_flag='c'";
                                                                                        $rsR = db_query($qrR);
                                                                                        $totalbidR = db_num_rows($rsR);

                                                                                        if($totalbidR>0) {
                                                                                            $status1R = "<font color='green'>Active</font>";
                                                                                        }
                                                                                        else {
                                                                                            $status1R = "<font color='red'>Not Active</font>";
                                                                                        }

                                                                                      
			
			
			  ?>						
										  
										  <tr>
										   
										    <td>
										    </td>
										    <td>
										      <?php echo $row_referred['id'];?> 
										    </td>
										    <td>
											<a href="http://biddersparadise.com/backendadmin/view_member_statistics.php?uid=<?php echo $row_referred['id'];?>"><?php echo $row_referred['username'];?> 
											</a>
										    </td>
										    <td>
										      <?php echo $row_referred['email'];?> 
										    </td>
										    <td style="width:300px;width:auto;word-wrap:break-word;">
										      <ul style="font-size:7px;border:1px solid black;">
											<b>Bidpacks</b>
											  
										      <?php 
										      $qryselPoints = db_query("select user_id,bid_count,bidpack_buy_date,credit_description,username from bid_account b inner join registration r on r.id=b.user_id where bid_flag!='c' and recharge_type!='ad' and credit_description like '%Bid Pack%' and user_id = '" . $row_referred['id'] . "'");
										      while($rowPoints = db_fetch_array($qryselPoints)){
										    
											?>
											  <li>
											    
											    <?php echo $rowPoints['credit_description'];?> : <?php echo $rowPoints['bidpack_buy_date']; ?> : 
											      <?php echo $rowPoints['bid_count'];?>
											  
											  </li>
										      
										      
										      <?php
										      }
										      
										    
										      
										      
										      
											?>
										      </ul>
										      <ul style="font-size:7px;border:1px solid black;">
											<b>Admin Credits<b>
											  
										      <?php 
										      $qryselPoints = db_query("select user_id,bid_count,bidpack_buy_date,credit_description,username from bid_account b inner join registration r on r.id=b.user_id where bid_flag='c' and recharge_type='ad' and user_id = '" . $row_referred['id'] . "'");
										      while($rowPoints = db_fetch_array($qryselPoints)){
										    
											?>
											  <li>
											    
											    <?php echo $rowPoints['credit_description'];?> : <?php echo $rowPoints['bidpack_buy_date']; ?> : 
											      <?php echo $rowPoints['bid_count'];?>
											  
											  </li>
										      
										      
										      <?php
										      }
										      
										    
										      
										      
										      
											?>
										      </ul>
										      <ul style="font-size:7px;border:1px solid black;">
											<b>Free Points</b>
											  
										      <?php 
										      $qryselPoints = db_query("select user_id,bid_count,bidpack_buy_date,credit_description,username from free_account b inner join registration r on r.id=b.user_id where bid_flag='c' and recharge_type='ad'  and user_id = '" . $row_referred['id'] . "'");
										      while($rowPoints = db_fetch_array($qryselPoints)){
										    
											?>
											  <li>
											    
											    <?php echo $rowPoints['credit_description'];?> : <?php echo $rowPoints['bidpack_buy_date']; ?> : 
											      <?php echo $rowPoints['bid_count'];?>
											  
											  </li>
										      
										      
										      <?php
										      }
										      
										    
										      
										      
										      
											?>
										      </ul>
										    </td>
										    <td>
			<?php
						            $sqlA = "select itemid,itemname,datetime,username,firstname,lastname,addressline1,addressline2,city,postcode,phone,printable_name,amount,shippingcharge
							    from payment_order_history p 
							    left join registration r on r.id=p.userid
							    left join countries c on r.country=c.countryId
									where  payfor='" . PAYFOR_WONAUCTION . "' and username = 
									'$referred[username]' order by datetime";
if(!empty($startdate)){
							  $sqlA .= " and datetime>='$startdate' and datetime<='$enddate'";
							  
							  
}
						  $queryA = db_query($sqlA);
						  
						  while($rowA = db_fetch_array($queryA)){
						  
						  
						  
						 print_r($rowA); 
						  
						  
						  
						  
						  }
						  echo db_error();
 ?>
										
										    </td>
										    <td>
										      
<?php
        $sqlBIN = db_query("select itemid,itemname,datetime,username,firstname,lastname,addressline1,addressline2,city,postcode,phone,printable_name,amount,shippingcharge
from payment_order_history p
left join registration r on r.id=p.userid
left join countries c on r.country=c.countryId
            where datetime>='$startdate 00:00:00' and datetime<='$enddate 00:00:00' and payfor='" . PAYFOR_BUYITNOW . "' order by datetime");

	      while($rowBIN - db_fetch_array($sqlBIN)){
	      print_r($rowBIN);
   
 ?>
										     
 
 
   <?php } ?>
										    </td>
										    <td>
										      <?php echo $row_referred['registration_date'];?> 
										    </td>
										    <td>
										      <?php echo $status1R;?> 
										    </td>
										    <?php
										      if(file_exists("../include/addons/infusion/daemon.php")){
											?>
										    <td>
										      <a href="https://yy117.infusionsoft.com/Contact/manageContact.jsp?view=edit&ID=<?php echo $row_referred['infusion_id'];?>">Infusion
										    </a>
										  </td>							<?php } ?>			     
										    
										  </tr>
										  
								
										
			<?php } ?>
			  
			  
			</table>
									    
									      
									      
									      
									      </td>
									    </tr>
                                                                                        <?php
                                                                                        $refuname = '';
                                                                                    }
                                                                                    ?>
                                                                            <tr>
                                                                                <td colspan="8">
                                                                                    Total Registered Users :<?=$totalrecords;?>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </form>

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
                                                            <li><a href="registrationreport.php?pgno=<?=$PrevPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                            <?php } ?>

                                                                        <?php
                                                                        $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                        $pageTo=$PageNo+3>$totalpage?$totalpage:$PageNo+3;
                                                                        for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                            ?>
                                                                            <?php if($i==$PageNo) { ?>
                                                            <li><a href="registrationreport.php?pgno=<?=$i;?>&<?=$urldata;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                                <?php }else {?>
                                                            <li><a href="registrationreport.php?pgno=<?=$i;?>&<?=$urldata;?>"><?php echo $i; ?></a></li>
                                                                                <?php }
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if($PageNo<$totalpage) {
                                                                            $NextPageNo = 	$PageNo + 1;
                                                                            ?>
                                                            <li><a href="registrationreport.php?pgno=<?=$NextPageNo;?>&<?=$urldata;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                            <?php } ?>
                                                        </ul>

                                                    </div>
                                                    <!--[if !IE]>end pagination<![endif]-->
                                                                <?php }?>

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

                                <?php }
                        }
                        ?>

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