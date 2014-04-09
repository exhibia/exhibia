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
        $startdate = ChangeDateFormat($_REQUEST["sdate"]);
        $enddate = ChangeDateFormat($_REQUEST["edate"]);
        $status =$_REQUEST["status"];
    }
    $urldata = "sdate=".ChangeDateFormatSlash($startdate)."&edate=".ChangeDateFormatSlash($enddate);

    $qrysel = "select * from registration where registration_date>='".$startdate."' and registration_date<='".$enddate."' order by id desc";
   
  

    //find all users without deleted users
    $qrycount = "select * from registration where registration_date>='".$startdate."' and registration_date<='".$enddate."'   and user_delete_flag!='d'";
    $rescount = db_query($qrycount);
    $totalcount = db_num_rows($rescount);

    //find not varified users
    $qrycount1 = "select * from registration where user_delete_flag!='d' and (account_status='0' or account_status = '') and registration_date>='".$startdate."' and registration_date<='".$enddate."'";
    $rescount1 = db_query($qrycount1);
    $totalcount1 = db_num_rows($rescount1);

    //find active users
 
    
    $qrycount2 = "select * from registration where user_delete_flag!='d' and account_status='1' and member_status='1' and registration_date>='".$startdate."' and registration_date<='".$enddate."'";
    $rescount2 = db_query($qrycount2);
    $totalcount2 = db_num_rows($rescount2);

    //find unsubscribed users
    $qrysel3 = "select * from registration where user_delete_flag!='d' and account_status='2' and registration_date>='".$startdate."' and registration_date<='".$enddate."'";
    $qrycount3 = "select * from registration where user_delete_flag!='d' and account_status='2' and registration_date>='".$startdate."' and registration_date<='".$enddate."'";
    $rescount3 = db_query($qrycount3);
    $totalcount3 = db_num_rows($rescount3);

    //find suspended users
    $qrysel4 = "select * from registration where user_delete_flag='d' and member_status='0' and registration_date>='".$startdate."' and registration_date<='".$enddate."'";
    $qrycount4 = "select * from registration where user_delete_flag='d' and member_status='0' and registration_date>='".$startdate."' and registration_date<='".$enddate."'";
    $rescount4 = db_query($qrycount4);
    $totalcount4 = db_num_rows($rescount4);
    
   //find deleted / blocked users
   
    $qrycount5 = "select * from registration where user_delete_flag='d' and registration_date>='".$startdate."' and registration_date<='".$enddate."'";
    $rescount5 = db_query($qrycount5);
    $totalcount5 = db_num_rows($rescount5);
    //find admin users
   
    $qrycount6 = "select * from registration where admin_user_flag >= 1 and registration_date>='".$startdate."' and registration_date<='".$enddate."'";
    $rescount6 = db_query($qrycount6);
    $totalcount6 = db_num_rows($rescount6);   
    
    $ressel = db_query($qrysel . $_REQUEST['search_type']);
    $total = db_num_rows($ressel);
    echo db_error();
    $totalrecords = $total;
    $totalpage=ceil($total/$PRODUCTSPERPAGE);

    if($totalpage>=1) {
        $startrow=$PRODUCTSPERPAGE*($PageNo-1);
        $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
        $ressel=db_query($qrysel);
        $total=db_num_rows($ressel);
    }
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
        <script type="text/javascript">
            $(function() {
<?php 
	  
		
	      
	      switch($globalDateformat){

		      case 'm/d/Y':
		   
		      $jsdateFormat = 'mm/dd/yy';
		      break;
		      case 'd/m/Y':
		
		      $jsdateFormat = 'dd/mm/yy';
		      break;
		      
		}

	    ?>
	      $.datepicker.setDefaults({dateFormat:'<?php echo $jsdateFormat;?>'});
                $("#datefrom").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                $("#dateto").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
            });
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
                                <h2>Daily User Registration Report</h2>
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
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                   
                                                                       <?php include("datepickers.php"); ?>
                                                                       
                                                                   
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

                        <?php  if(isset($total)) {
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
                                                            <span><strong>Active Users:</strong><?=$totalcount2;?>&nbsp;&nbsp;</span>
                                                            <span><strong>Admin Users:</strong><?=$totalcount6;?>&nbsp;&nbsp;</span>
                                                            <span><strong>Unsubscribed Users:</strong><?=$totalcount3;?>&nbsp;&nbsp;</span>
                                                            <span><strong>Unverified Users:</strong><?=$totalcount1;?>&nbsp;&nbsp;</span>
                                                            <span><strong>Suspended Users:</strong><?=$totalcount4;?>&nbsp;&nbsp;</span>
                                                            <span><strong>Deleted / Blocked Users:</strong><?=$totalcount5;?>&nbsp;&nbsp;</span>
                                                            <span><strong>Total Users:</strong><?=$totalcount;?>&nbsp;&nbsp;</span>
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
                                                                                <th>Referred By</th>
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

                                                                                        $qr = "select * from bid_account where user_id='".$obj->rid."' and bid_flag='c'";
                                                                                        $rs = db_query($qr);
                                                                                        $totalbid = db_num_rows($rs);
											if($obj->admin_user_flag >= 1 & $obj->user_delete_flag != 'd'){
											
											  $status1 = "<font color='blue'><b>Admin</b></font>";
											 
											  $admin_level = db_fetch_object(db_query("select admin_level from user_levels where id = '" . $obj->admin_user_flag . "'"));
											echo db_error();
											  $status1 .= "<br />" . $admin_level->admin_level;
											
											}else
											if($obj->account_status == '0' & $obj->user_delete_flag != 'd'){
											
											$status1 = "<font color='black'>Not verified</font>";
											
											}else
											if($obj->member_status == '0' & $obj->user_delete_flag != 'd'){
											
											  $status1 = "<font color='red'><b>Suspended</b></font>";
											
											}else
											if($obj->user_delete_flag == 'd'){
											
											$status1 = "<font color='red'><b>Deleted</b></font>";
											
											}else {
											    $status1 = "<font color='green'>Active</font>";
											}
                                                                                        if($totalbid>0) {
                                                                                            $status2 = "<font color='maroon'>Has Bid Before</font>";
                                                                                        }
                                                                                        else {
                                                                                            $status2 = "<font color='orange'>Has Not Bid Before</font>";
                                                                                        }
                                                                                        if($obj->sponser>"0") {
                                                                                            $qreg = "select * from registration where id='".$obj->sponser."'";
                                                                                            $rseg = db_query($qreg);
                                                                                            $objreg=db_fetch_object($rseg);
                                                                                            $refuname = $objreg->username;
                                                                                        }
                                                                                        ?>
                                                                                        
                                                                            <tr class="<?php echo ($colorflg==0)?'first':'second'; ?>">
                                                                                <td style="text-align:center;"><?=$obj->id;?></td>
                                                                                <td><?=$obj->username;?></td>
                                                                                <td><?=$obj->firstname."&nbsp;".$obj->lastname;?></td>
                                                                                <td><?=$obj->email;?></td>
                                                                                <td><?=$refuname!=""?$refuname:"-";?></td>
                                                                                <td style="text-align:center;"><?=arrangedate($obj->registration_date);?></td>
                                                                                <td style="text-align:center;"><?=$status1;?><br /><?=$status2;?></td>                                                                              
                                                                                <td style="text-align:center;">
                                                                                    <div class="actions_menu">
                                                                                        <ul>
                                                                                            <li>
                                                                                                <a name="details" class="details" href="view_member_statistics.php?uid=<?=$obj->id;?>">Statistics</a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
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