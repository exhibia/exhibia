<?php
session_start();
$active="Users";
include("connect.php");
$PRODUCTSPERPAGE=20;
include("security.php");
include('../sendmail.php');

if($_GET['sendemail']!="") {
    $sqlsendemail = "select * from registration where id > 2 and user_delete_flag!='d' and id='".$_GET['sendemail']."'";
    $ressendemail = db_query($sqlsendemail) or die(db_error());
    $rowsendemail = db_fetch_array($ressendemail);
    $email = $rowsendemail['email'];

    $content='';
    $content.= "<font style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>"."</font><br>"."<br>"."<p align='center' style='font-size: 14px;font-family: Arial, Helvetica, sans-serif;font-weight:bold;'>Account Information</p>"."<br>".

            "<table border='0' cellpadding='3' cellspacing='0' width='100%' align='center' class='style13'>";

    $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
		<td>Dear ".$rowsendemail['firstname'].", </td>
		</tr>";

    $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
		<td>Welcome to $SITE_NM !  We are pleased and proud that you have decided to join us.</td>
		</tr>";

    $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
		<td>Below is your new account information </td>
		</tr>";

    $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
		<td>Your Username for $SITE_NM : ".$rowsendemail['username']."</td>
		</tr>";

    $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
		<td>The $SITE_NM user ID: ".$rowsendemail['id']."</td>
		</tr>";

    $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
		<td>Please click on the link below to Activate Your Account Now: <a href='".$SITE_URL."password.php?auc_key=".$rowsendemail['verifycode']."'>Click Here</a></td>
		</tr>";

    $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
		<td>Thanks and Welcome to $SITE_NM!</td>
		</tr>";

    $content.="<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>
		<td>Customer Support<br><?=$SITE_NM;?></td>
		</tr>
		</table>";

    $subject="Account Information @ $SITE_NM";
    $from=$adminemailadd;

    //$ADMIN_EMAIL = "monitor@Pennyauctionsoft.com";
    //$ADMIN_EMAIL = "monitor@Pennyauctionsoft.com";
    SendHTMLMail($email,$subject,$content,$from);
    header("location:message.php?msg=50");
    exit;
}

if($_GET["verifyit"]!="") {
    $userverify = $_GET["verifyit"];
    $qryupd = "update registration set account_status='1' where id='".$userverify."' and admin_user_flag='0'";
    db_query($qryupd) or die(db_error());
    header("location: message.php?msg=93");
    exit;
}

if($_POST['ChangeStatus']) {
    if(is_array($_POST['enable_disable'])) {
        for($j=0;$j<count($_POST['enable_disable']);$j++) {
            $cvariable = explode("|",$_POST['enable_disable'][$j]);
            $m_id = $cvariable[0];
            $c_status = $cvariable[1];
            if(trim($c_status)=="0" or trim($c_status)=="") {
                $chag_status = "1";
            }
            elseif(trim($c_status)=="1") {
                $chag_status = "0";
            }
            $udpatestatus = "update registration set member_status='".$chag_status."' where id='".$m_id."' and admin_user_flag='0'";
            db_query($udpatestatus) or die(db_error());
        }
    }
}

// calculation for order
if($_REQUEST['order']) {
    $order=$_REQUEST['order'];
}
//calculation for page no
if(!$_GET['pgno']) {
    $PageNo = 1;
}
else {
    $PageNo = $_GET['pgno'];
}
if($order) {
    if($_REQUEST['memstatus']!="") {
        if($_REQUEST['memstatus']=="0" || $_REQUEST['memstatus']=="1" || $_REQUEST['memstatus']=="2") {
            $addquery = " and account_status='".$_REQUEST['memstatus']."' ";
        }
        elseif($_REQUEST['memstatus']=="d") {
            $addquery = " and member_status='1' ";
        }
        $memstatus = $_REQUEST['memstatus'];
    }
    if($_REQUEST["stext"]!="") {
        $searchdata = $_REQUEST["stext"];
        $addquery2 = "and (username like '%".$searchdata."%' or firstname like '%".$searchdata."%' or lastname like '%".$searchdata."%')";
    }
    if($_REQUEST['memstatus']=="d"){
    
    
    
    }
    $sql="select * from registration where id > 2 and username like '$order%' ";
    
	
      $sql .= $addquery.$addquery2." order by id";
}
else {
    if($_REQUEST['memstatus']!="") {
        if($_REQUEST['memstatus']=="0" || $_REQUEST['memstatus']=="1" || $_REQUEST['memstatus']=="2") {
            $addquery = " and account_status='".$_REQUEST['memstatus']."' ";
        }
        elseif($_REQUEST['memstatus']=="d") {
       
        
	  $addquery .= " and user_delete_flag='1'  ";
        }
        $memstatus = $_REQUEST['memstatus'];
    }
    if($_REQUEST["stext"]!="") {
        $searchdata = $_REQUEST["stext"];
        $addquery2 = "and (username like '%".$searchdata."%' or firstname like '%".$searchdata."%' or lastname like '%".$searchdata."%')";
    }
    $sql="select * from registration where id > 2 and username != '' ";
    


      $sql .= $addquery.$addquery2." order by id";
}


$PRODUCTSPERPAGE=20;
$result=db_query($sql);
$total=db_num_rows($result);
$totexprecords = $total;
$totalpage=ceil($total/$PRODUCTSPERPAGE);
//echo $totalpage;
if($totalpage>=1) {
    $startrow=$PRODUCTSPERPAGE*($PageNo-1);
    $sql.=" LIMIT $startrow,$PRODUCTSPERPAGE";
//echo $sql;
    $result=db_query($sql);
    $total=db_num_rows($result);
}

//find all users without deleted users
$qrycount = "select * from registration where id > 2 and user_delete_flag!='1'";
$rescount = db_query($qrycount);
$totalcount = db_num_rows($rescount);

//find deleted users to permanantly remove them
$qrycountD = "select * from registration where id > 2 and user_delete_flag='1'";
$rescountD = db_query($qrycountD);
$totalcountD = db_num_rows($rescountD);

//find admin users
$qrycountA = "select * from registration where id > 2 and admin_user_flag='1'";
$rescountA = db_query($qrycountA);
$totalcountA = db_num_rows($rescountA);

//find affiliate users
/*
$qrycountD = "select * from registration where id > 2 and user_delete_flag='d'";
$rescountD = db_query($qrycountD);
$totalcountD = db_num_rows($rescountD);
*/

//find not varified users
$qrycount1 = "select * from registration where id > 2 and user_delete_flag!='1' and account_status='0' and member_status='0'";
$rescount1 = db_query($qrycount1);
$totalcount1 = db_num_rows($rescount1);

//find active users
$qrycount2 = "select * from registration where id > 2 and user_delete_flag!='1' and account_status='1' and member_status='0'";
$rescount2 = db_query($qrycount2);
$totalcount2 = db_num_rows($rescount2);

//find unsubscribed users

$qrycount3 = "select * from registration where id > 2 and user_delete_flag!='1' and account_status='2'";
$rescount3 = db_query($qrycount3);
$totalcount3 = db_num_rows($rescount3);

//find suspended users
$qrycount4 = "select * from registration where id > 2 and user_delete_flag!='1' and member_status='1'";
$rescount4 = db_query($qrycount4);
$totalcount4 = db_num_rows($rescount4);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Members-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
 
	
	<script type="text/javascript" src="js/ui/ui.dialog.min.js"></script>
        <!--[if lte IE 6]>
        <link href="css/menu_ie.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <script language="javascript">
            function BidHistoryPlus(id,plus,minus)
            {
                document.getElementById(plus).style.display = 'none';
                document.getElementById(minus).style.display = 'block';
                document.getElementById(id).style.display = 'block';
            }

            function BidHistoryMinus(id,plus,minus)
            {
                document.getElementById(plus).style.display = 'block';
                document.getElementById(minus).style.display = 'none';
                document.getElementById(id).style.display = 'none';
            }
            function ajax_user(url){
		
		    $.ajax({
			    url: url,
			    success: function(response){
			    
			      $('#mybids-box').html(response);
			    }
		  });
		}
	            function bidhistory(url){
		$('#myqb-wrap').html('Loading');
		    $.ajax({
			    url: url,
			    success: function(response){
			    
			      $('#myqb-wrap').html(response);
			    }
		  });
		}
        </script>
        <style>
        #user_info {
        display:none;
        }
        </style>
        <script type="text/javascript">
        
        
            function BidHistoryPlus(id,plus,minus)
            {
                document.getElementById(plus).style.display = 'none';
                document.getElementById(minus).style.display = 'block';
                document.getElementById(id).style.display = 'block';
            }

            function BidHistoryMinus(id,plus,minus)
            {
                document.getElementById(plus).style.display = 'block';
                document.getElementById(minus).style.display = 'none';
                document.getElementById(id).style.display = 'none';
            }
	    function edit_text(){
	    return null;
	    }
	    function  get_user_page(url){
	    <?php
	    $admin_pass = db_fetch_array(db_query("select pass from admin"));
	    ?>
	    
	      var openDialog = function(element){

		  
		$('h25').css('border', '');
		$('.edit').css('background', '');
		$('.edit').css('background-image', '');
		//actually open the dialog
		$('#' + element).dialog('open');

	    };
	    $.get(url + '&ajax=set&admin_pass=<?php echo $admin_pass[0];?>', function(response){
	      response = response + '<link media="screen" rel="stylesheet" type="text/css" href="../css/myaccount.css"  />';
			  $("#user_info").html(response);
			  
			  $("#user_info").dialog({modal: true, width : 750, height: 600, autoOpen: false, buttons: { "Ok": function() { $(this).dialog("close"); } }});
			    
				openDialog('user_info');
			      
			}
		    );



	      }

	    
	    
	    
	   
            function delconfirm(loc)
            {
                if(confirm("Are you sure to delete this member?"))
                {
                    window.location.href=loc;
                }
                return false;
            }
            function Submitform()
            {
                document.form1.submit();
            }
            function EnterData()
            {
                if(document.searchuser.stext.value=="")
                {
                    alert("Please enter search text");
                    document.searchuser.stext.focus();
                    return false;
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
    <div id="user_info"></div>
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
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Manage Users</h2>
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
                                                            <span><strong>Unsubscribed Users:</strong><?=$totalcount3;?>&nbsp;&nbsp;</span>
                                                            <span><strong>Unverified Users:</strong><?=$totalcount1;?>&nbsp;&nbsp;</span>
                                                            <span><strong>Suspended Users:</strong><?=$totalcount4;?>&nbsp;&nbsp;</span>
                                                            <span><strong>Total Users:</strong><?=$totalcount;?>&nbsp;&nbsp;</span>
                                                        </div>
                                                        <br/>
                                                        <div>                                                               
                                                            <div style="float:left;">
                                                                <strong>Export member details to CSV :&nbsp;From</strong>:<input id="recfrom" type="text" name="recfrom" value="0" />&nbsp;-&nbsp;
                                                                <strong>To</strong>:<input id="recto" type="text" name="recto" value="<?=$totexprecords?>" />&nbsp;&nbsp;&nbsp;
                                                            </div>
                                                            <span class="button send_form_btn"><span><span>Export to CSV</span></span><input name="submit" type="button" onclick="OpenPopup('download.php?export=musers&mstatus=<?=$memstatus?>&stext=<?=$searchdata?>')" /></span>
                                                            <div style="margin-left:30px;float:left;">
                                                                <form action="" method="post" onsubmit="return EnterData();">
                                                                    <span style="float:left;">
                                                                        <strong>Search:</strong> <input type="text" name="stext" value="<?=$searchdata;?>" />&nbsp;&nbsp;
                                                                    </span>
                                                                    <span class="button send_form_btn"><span><span>Search</span></span><input name="searchsubmit" type="submit" /></span>
                                                                    <input type="hidden" name="memstatus" value="<?=$memstatus;?>" />
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="clear"></div>
                                                        <br/>
                                                        <form id="form1" name="form1" action="manage_members.php" method="post">
                                                            <span style="float:left;margin-right:40px;">

                                                                <span><a href="manage_members.php?memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">All</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=A&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">A</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=B&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">B</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=C&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">C</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=D&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">D</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=E&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">E</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=F&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">F</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=G&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">G</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=H&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">H</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=I&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">I</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=J&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">J</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=K&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">K</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=L&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">L</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=M&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">M</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=N&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">N</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=O&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">O</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=P&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">P</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=Q&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">Q</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=R&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">R</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=S&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">S</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=T&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">T</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=U&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">U</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=V&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">V</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=W&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">W</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=X&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">X</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=Y&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">Y</a></span><span class="sp">|</span>
                                                                <span><a href="manage_members.php?order=Z&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>">Z</a></span>

                                                            </span>
                                                            <span>
                                                                <strong>Member Status:</strong>
                                                                <select name="memstatus" onchange="Submitform();">
                                                                    <option value="" <?php if($memstatus=="") {?> selected="selected"<?php } ?>>All</option>
                                                                    <option value="2" <?php if($memstatus=="2") {?> selected="selected"<?php } ?>>Unsubscribed</option>
                                                                    <option value="0" <?php if($memstatus=="0") {?>selected="selected"<?php } ?>>Unverified</option>
                                                                    <option value="1" <?php if($memstatus=="1") {?>selected="selected"<?php } ?>>Active</option>
                                                                    <option value="d" <?php if($memstatus=="d") {?>selected="selected"<?php } ?>>Suspended</option>
                                                                    <option value="a" <?php if($memstatus=="a") {?> selected="selected"<?php } ?>>Admin</option>
                                                                </select>
                                                            </span>
                                                            <input type="hidden" name="stext" value="<?=$searchdata;?>" />
                                                        </form>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                <?php if(!$total) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No Members To Display</strong></li>
                                                                </ul>
                                                                    <?php }else {?>
                                                                <form id="form2" name="form2" action="" method="post">
                                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th style="text-align:center;width:20px">E/D</th>
                                                                                <th>User Name</th>
                                                                                <th>Name</th>
                                                                                <th>City</th>
                                                                                <th>Country</th>
                                                                                <th>Email</th>
                                                                                <th style="text-align:center;">Status</th>
                                                                                <th>Referred By</th>
                                                                                <th style="text-align:center;">Newsletter</th>
                                                                                <th style="text-align:center;width:140px;">Options</th>
                                                                            </tr>
                                                                            <tr>
                                                                            
                                                                                <?php
                                                                                
                                                                                $colorflg=0;
                                                                                for($i=0;$i<$total;$i++) {
                                                                                
                                                                                    $row = db_fetch_object($result);
                                                                                    echo db_error();
                                                                                    $id=$row->id;
                                                                                
                                                                                    $fname = stripslashes($row->firstname);
                                                                                    $lname = stripslashes($row->lastname);
                                                                                    $bids = $row->final_bids;
                                                                                    $f_bids = $row->free_bids;
                                                                                  
                                                                                    $city=$row->city;
                                                                                    $member_status = $row->member_status;
										    $admin=$row->admin_user_flag;
                                                                                    $account_status = $row->account_status;
                                                                                    
                                                                                    $country=$row->country;
                                                                                    $qrycou = "select * from countries";
                                                                                    $rescou = db_query($qrycou);
                                                                                    while($cou=db_fetch_array($rescou)) {
                                                                                        if($country==$cou["countryId"]) {
                                                                                            $country = $cou["printable_name"];
                                                                                        }
                                                                                    }
                                                                                    if($row->sponser!='0') {
                                                                                        $qryreg = "select * from registration where id > 2 and id='".$row->sponser."'";
                                                                                        $resreg = db_query($qryreg);
                                                                                        $objreg = db_fetch_object($resreg);
                                                                                        $sponsername = $objreg->username;
                                                                                    }
                                                                                    $email=stripslashes($row->email);
                                                                                    $username=stripslashes($row->username);
                                                                                    ?>
                                                                            <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                                <td style="width:5%" class="alignCenter">
                                                                                    <input type="checkbox" name="enable_disable[]" value="<?=$id."|".$member_status;?>" style="border:none; background-color:<?=$colorid?>" />
                                                                                </td>
                                                                                <td><?=$username."&nbsp;"; ?></td>
                                                                                <td><?php echo $fname ."&nbsp;".$lname; 
                                                                           
                                                                               
                                                                                   
                                                                                
                                                                                ?><br />
                                                                                <?php echo "<span style=\"font-size:10px;color:red;\">";
                                                                                echo "Bids:" . $bids;
                                                                                echo "<br />";
                                                                                echo "Free Bids:" . $f_bids;
                                                                                echo "</span>";
                                                                                ?>
                                                                                
                                                                                </td>
                                                                                <td><?=$city."&nbsp;"; ?></td>
                                                                                <td><?=$country."&nbsp;"; ?></td>
                                                                                <td><?=$email."&nbsp;"; ?></td>
                                                                                <td style="text-align:center;">
                                                                                            <?php 
                                                                                            if($row->user_delete_flag >= 1){
											    
											    echo "<br />Deleted User";
											    
											    }else
                                                                                            if($row->admin_user_flag >= 1){
                                                                                    
											    $admin_level = db_fetch_array(db_query("select * from user_levels where id = '" . $row->admin_user_flag . "'"));
											    
											    if(!empty($admin_level[0])){
											    echo db_error();
											      echo "<br /><a href=\"edit_user_levels.php?level=$admin_level[0]\">" . $admin_level[1] . "</a>";
											      }else{
											      
											      echo "<br /><font style=\"font-size:8px;\">Admin rights added outside of program</font><br />";
											      }
											    
											      
											      }else
											    
											    
											    
                                                                                            
                                                                                            if($member_status==0 && $account_status==1) {
                                                                                                echo "<font color='green'>Enable</font>";
                                                                                            } elseif($member_status==0 && $account_status==2) {
                                                                                                echo "<font color='red'>Closed</font>";
                                                                                            }elseif($member_status==1) {
                                                                                                echo "<font color='green'>Active</font>";
                                                                                            } elseif($member_status==0 && $account_status==0) {
                                                                                                echo "<font color='green'>Enable</font>";
                                                                                            } 
                                                                                     
										if(file_exists("../include/addons/infusion/infusion.php")){
										      if(db_num_rows(db_query("select * from afilliate_links where userid = ".  $row->id . " and addon_value = 'infusion'")) >= 1){
											?>
										   <br />
										      I.S. Affilliate
										      
										      
										      <?php } 
										  
										  }
										  
										
                                                                                            
                                                                                            ?>
                                                                                </td>
                                                                                
                                                               
										<td><a href="reverse_registrationreport.php?uid=<?php echo $row->sponser;?>">
										<?php 
										    if(preg_match('/vendor/i', $admin_level[1])){
										      
										      
											  echo "<a href=\"addvendors.php?vendor=". $row->vendors . "\">" . $row->vendors . "</a>";
											  
											  
										      
										      }else{
										      
										      echo $sponsername!=""?$sponsername:"--";
										      
										      }
										
										
										?>
										</a>  
										</td>
                                                                                <td style="text-align:center;"><?=$row->newsletter=="1"?"Yes":"No";?></td>
                                                                                <td style="text-align:center;">
                                                                                    <div class="actions_menu">
                                                                                        <ul>
                                                                                            <li>
                                                                                                <a title="Edit"  class="edit" href="edit_member.php?editid=<?=$id;?>">&nbsp;</a>
                                                                                            </li>                                                                                            
                                                                                            <li>
                                                                                                <a class="delete" name="button" onClick="return delconfirm('edit_member.php?delid=<?=$id;?>')" href="" title="Delete">&nbsp;</a>
                                                                                            </li>
                                                                                        
                                                                                            <li>
                                                                                                <a name="Statistics" class="details" href="javascript: get_user_page('member_stats.php?uid=<?=$id;?>');" alt="Statistics" title="Statistics">&nbsp;</a>
                                                                                            </li>                                                                                                    
                                                                                        
                                                                                                <?php if($account_status=='0') {?>
                                                                                       
                                                                                            <li>
                                                                                                <a name="re_sent" href="manage_members.php?sendemail=<?=$id;?>">Send Email</a>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a name="verify_it" href="manage_members.php?verifyit=<?=$id;?>">Verify</a>
                                                                                            </li>
                                                                                    
                                                                                                    <?php } ?>

                                                                                        <?php if($account_status=='1') {?>
                                                                                    
                                                                                            <li>
                                                                                                <a class="assigncoupon" title="Assign Coupon" name="assigncoupon" href="assigncoupontouser.php?memberid=<?=$id;?>">&nbsp;</a>
                                                                                            </li>
                                                                                            
                                                                                      
                                                                                            <li>
                                                                                                <a class="coupon" title="View Coupons" name="usercoupon" href="usercoupon.php?memberid=<?=$id;?>">&nbsp;</a>
                                                                                            </li>
											    
											       <?php
										      if(file_exists("../include/addons/infusion/infusion.php")){
										      if(db_num_rows(db_query("select * from afilliate_links where userid = ".  $row->id . " and addon_value = 'infusion'")) >= 1){
											?>
										    <ul>
											<li>
											<a class="IS" title="Infusion Soft" href="https://yy117.infusionsoft.com/Contact/manageContact.jsp?view=edit&ID=<?php echo $row_referred['infusion_id'];?>">Infusion
											</a>
										      </li>
										  </ul>
										  <?php } 
										  
										  }
										  ?>
                                                                                        </ul>
                                                                                        <?php }?>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                                    <?php
                                                                                    $sponsername = '';
                                                                                }
                                                                                ?>
                                                                            <tr>
                                                                                <td colspan="10">
                                                                                    <input type="hidden" name="searchtext" value="<?=$searchdata;?>" />
                                                                                    <span class="button send_form_btn"><span><span>Enable/Disable</span></span><input name="ChangeStatus" type="submit" /></span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </form>
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
                                                            <li><a href="manage_members.php?pgno=<?=$PrevPageNo; ?>&order=<?=$order?>&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                    <?php } ?>

                                                                <?php
                                                                $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                $pageTo=$PageNo+3>$totalpage?$totalpage:$PageNo+3;
                                                                for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                    ?>
                                                                    <?php if($i==$PageNo) { ?>
                                                            <li><a href="manage_members.php?pgno=<?=$i;?>&order=<?=$order?>&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                        <?php }else {?>
                                                            <li><a href="manage_members.php?pgno=<?=$i;?>&order=<?=$order?>&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>"><?php echo $i; ?></a></li>
                                                                        <?php }
                                                                }
                                                                ?>
                                                                <?php
                                                                if($PageNo<$totalpage) {
                                                                    $NextPageNo = 	$PageNo + 1;
                                                                    ?>
                                                            <li><a href="manage_members.php?pgno=<?=$NextPageNo;?>&order=<?=$order?>&memstatus=<?=$memstatus?>&stext=<?=$searchdata;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
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
									  <script>
                                                                            $('a[title]').qtip();
                                                                               </script>
    </body>
</html>