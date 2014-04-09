<?php
session_start();
$active="Users";
include_once 'security.php';
include_once "admin.config.inc.php";
include_once '../data/coupon.php';
include("functions.php");


$PRODUCTSPERPAGE=20;

if(!$_REQUEST['order'])
    $iid = "";
else
    $iid = $_REQUEST['order'];
if(!$_GET['pgno']) {
    $PageNo = 1;
}
else {
    $PageNo = $_GET['pgno'];
}
//     Get how many products  are to be displayed according to the  Events

$StartRow =   $PRODUCTSPERPAGE * ($PageNo-1);

$status='';
if(isset($_REQUEST['status'])) {
    $status=$_REQUEST['status'];
}

$coupondb=new Coupon(null);
$totalrows=$coupondb->count($iid,$status);
$totalpages=ceil($totalrows/$PRODUCTSPERPAGE);

$result=$coupondb->select($iid, $StartRow, $PRODUCTSPERPAGE,$status);
$total=db_num_rows($result);

@db_query("alter table coupon add column operand varchar(1) null");
@db_query("alter table coupon add column max_per_user varchar(20) null");
@db_query("alter table coupon add column max_overall varchar(20) null");
@db_query("alter table coupon add column combinable varchar(20) null");
@db_query("alter table coupon modify column discount float(5,2) null");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Coupon-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link rel="stylesheet" href="uploader/fineuploader.css" type="text/css"></link>

	
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
       
<script src="uploader/js/fineuploader-3.0.js"></script>
<script src="uploader/js/jquery-plugin.js"></script>
	
	
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
 

	
	<script type="text/javascript">
            function conf()
            {
                if(confirm("Are You Sure"))
                {
                    return true;
                }
                return false;
            }
            function delconfirm(loc)
            {
                if(confirm("Are you Sure Do You Want To Delete"))
                {
                    window.location.href=loc;
                }
                return false;
            }
            function Submitform()
            {
                document.form1.submit();
            }
            function addcoupon_ajax(id, url){
            if(!id){
	      var id = document.getElementById('last_coupon').value;
	      
	      }
	      if(!url){
	       var url = 'addcoupon.php?id=' + id;
		  element = 'new_coupons';
		}else{
		
		   element = 'new_coupons';
		    }
		    
		    
		$.get(url, function(response){
		
		    $(document.getElementById(element)).html(response);
			
		});
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
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Manage Coupon</h2>
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
                                                    <form id="form1" name="form1" action="managecoupon.php" method="post">
                                                        <div class="categoryorder">
                                                         
                                                            <span style="float:left;margin-right:40px;">
                                                                <span><a href="managecoupon.php">All</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=A&status=<?php echo $status;?>">A</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=B&status=<?php echo $status;?>">B</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=C&status=<?php echo $status;?>">C</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=D&status=<?php echo $status;?>">D</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=E&status=<?php echo $status;?>">E</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=F&status=<?php echo $status;?>">F</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=G&status=<?php echo $status;?>">G</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=H&status=<?php echo $status;?>">H</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=I&status=<?php echo $status;?>">I</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=J&status=<?php echo $status;?>">J</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=K&status=<?php echo $status;?>">K</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=L&status=<?php echo $status;?>">L</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=M&status=<?php echo $status;?>">M</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=N&status=<?php echo $status;?>">N</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=O&status=<?php echo $status;?>">O</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=P&status=<?php echo $status;?>">P</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=Q&status=<?php echo $status;?>">Q</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=R&status=<?php echo $status;?>">R</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=S&status=<?php echo $status;?>">S</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=T&status=<?php echo $status;?>">T</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=U&status=<?php echo $status;?>">U</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=V&status=<?php echo $status;?>">V</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=W&status=<?php echo $status;?>">W</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=X&status=<?php echo $status;?>">X</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=Y&status=<?php echo $status;?>">Y</a></span><span class="sp">|</span>
                                                                <span><a href="managecoupon.php?order=Z&status=<?php echo $status;?>">Z</a></span>
                                                            </span>
                                                            <span>
                                                                <strong>Coupon Status:</strong>
                                                                <select name="status" onchange="Submitform();">
                                                                    <option value="" <?php if($status=="") {?> selected="selected"<?php } ?>>All</option>
                                                                    <option value="1" <?php if($status=="1") {?> selected="selected"<?php } ?>>Usable</option>
                                                                    <option value="2" <?php if($status=="2") {?>selected="selected"<?php } ?>>Overdue</option>
                                                                </select>
                                                            </span>

		
                                                        </div>
                                                       
                                                    </form>
                                                    <?php //if(!$total) { ?>
                                                    <!--<ul class="system_messages">
                                                        <li class="blue"><span class="ico"></span><strong class="system_title">No Coupon To Display</strong></li>
                                                    </ul> -->
                                                        <?php //}else {?>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">

                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th style="width:300px;">Title</th>
                                                                            <th style="text-align:center;">Discount</th>
                                                                            <th style="text-align:center;">Free bids</th>
                                                                            <th style="text-align:center;">Assigned</th>
                                                                            <th style="text-align:center;">Is Universal</th>
                                                                            <th style="text-align:center;">Combinable</th>
                                                                            <th style="text-align:center;">Max Per User</th>
                                                                            <th style="text-align:center;">Max Overall</th>
                                                                            <th style="text-align:center;">Useful life</th>
                                                                            <th style="text-align:center;width: 180px;">Action</th>
                                                                        </tr>
                                                                        
                                                                        
                                                                            <?php
                                                                         if(!$total){
                                                                         ?>
                                                                           <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                            <td class="product_name" colspan="10">
									    No Coupons To Display
									    </td>
									    </tr>
                                                                         
                                                                         <?php
                                                                         
                                                                         
                                                                         
                                                                         }else{
                                                                            for($i=0;$i<$total;$i++) {
                                                                                $row = db_fetch_object($result);
                                                                                $id=$row->id;
                                                                                $title=$row->title;
                                                                                $discount=$row->discount;
                                                                                $freebids=$row->freebids;
                                                                                $assigned=$row->assigned;
                                                                                $isuniversal=$row->isuniversal;
                                                                                $startdate=$row->startdate;
                                                                                $enddate=$row->enddate;
                                                                                $operand=$row->operand;
                                                                                $combinable=$row->combinable;
                                                                                $max_per_user=$row->max_per_user;
                                                                                $max_overall=$row->max_overall;
                                                                                ?>
                                                                        <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>"><div  id="coupon_<?php echo $row->id;?>">
                                                                            <td class="product_name">
                                                                                        <?php echo $title!=""?stripslashes($title):'&nbsp;'; ?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                        <?php 
                                                                                        
                                                                                        if($operand != '$') {
                                                                                        echo $discount;
                                                                                        echo '%';
                                                                                        }else{
                                                                                        echo '$'; 
                                                                                        echo $discount;
                                                                                        }
                                                                                        ?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                        <?php echo $freebids; ?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                        <?php echo $assigned?"<font color='green'>Yes</font>":"<font color='red'>No</font>"; ?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                        <?php echo $isuniversal?"<font color='green'>Yes</font>":"<font color='red'>No</font>"; ?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                        <?php echo $combinable?"<font color='green'>Yes</font>":"<font color='red'>No</font>"; ?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                        <?php echo $max_per_user?"<font color='green'>" . $max_per_user . "</font>":"1"; ?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                        <?php echo $max_overall?"<font color='green'>". $max_overall . "</font>":"Unlimited"; ?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                        <?php if(strtotime($enddate)<=strtotime("-1 day")) { ?>
											      <span style="color:red;"><?php echo date("M, d Y" , strtotime($startdate)) . "-" . date("M, d Y" , strtotime($enddate)); ?></span>
                                                                                            <?php }else { ?>
												<span style="color:green;"><?php echo date("M, d Y" , strtotime($startdate)) . "-" . date("M, d Y" , strtotime($enddate)); ?></span>
                                                                                            <?php }?>
                                                                            </td>
                                                                            <td style="text-align:center;">
                                                                                <div class="actions_menu" style="width:180px;">
                                                                                    <ul>
                                                                                                <?php if($assigned==false && strtotime($enddate)>strtotime("-1 day")) { ?>
                                                                                        <li>
                                                                                            <a class="edit" href="javascript: addcoupon_ajax(<?php echo $row->id;?>, 'addcoupon.php?coupon_edit=<?php echo $row->id;?>&');">Edit</a>
                                                                                        </li>
                                                                                                    <?php } ?>

                                                                                                <?php if($assigned==false || strtotime($enddate)<=strtotime("-1 day")) { ?>
                                                                                        <li>
                                                                                            <a class="delete" href="javascript: addcoupon_ajax(<?php echo $row->id;?>, 'addcoupon.php?coupon_delete=<?php echo $row->id;?>');">Delete</a>
                                                                                        </li>
                                                                                                    <?php } ?>

                                                                                                <?php if($assigned==false && strtotime($enddate)>strtotime("-1 day")) { ?>
                                                                                        <li>
                                                                                            <a class="details" href="assigncoupon.php?coupon_assign=<?=$id;?>">Assign</a>
                                                                                        </li>
                                                                                                    <?php } ?>
                                                                                                  <?php if($assigned==true && strtotime($enddate)>strtotime("-1 day")) { ?>
                                                                                        <li>
                                                                                            <a class="details" href="assigncoupon.php?coupon_assign=<?=$id;?>&pro=unassign">Unassign</a>
                                                                                        </li>
                                                                                                    <?php } ?>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                            </div>
                                                                        </tr>
                                                                     
                                                                      
                                                                                <?php }
                                                                                
                                                                                }
                                                                                db_free_result($result);
                                                                            ?>
                                                                            
								      <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
								      <td id="new_coupons" colspan="10" width="100%" cellpadding="0" cellspacing="0"></td>
                                                                           
                                                                       </tr>
                                                                       
                                                                      <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                         <td align="left" colspan="10">
                                                                         <?php if(!$id){ $id = 0 ; } ?>
                                                                         <input id="last_coupon" type="hidden" value="<?php echo $id + 1;?>" />
                                                                             <a href="javascript: addcoupon_ajax();">Add Coupon</a>
                                                                             
                                                                             	<?php if(is_dir('../include/addons/escel')){?>
										    <div id="excel_button">
											    <noscript>
												    <p>Please enable JavaScript to use file uploader.</p>
												    <!-- or put a simple form for upload here -->
											    </noscript>
										  </div>
										<div id="progress-excel" style="max-width:300px;"></div>
                                                                         <?php } ?>
                                                                         
									  </td>
                                                                        </tr>
                                                                     
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                    </div>

                                                        <?php if($total) { ?>
                                                    <!--[if !IE]>start pagination<![endif]-->
                                                    <div class="pagination">
                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpages; ?></span>
                                                        <ul class="pag_list">
                                                                    <?php
                                                                    if($PageNo>1) {
                                                                        $PrevPageNo = $PageNo-1;
                                                                        ?>
                                                            <li><a href="managecoupon.php?order=<?php echo $iid ?>&pgno=<?php echo $PrevPageNo; ?>&status=<?php echo $status;?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                        <?php } ?>

                                                                    <?php
                                                                    $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                    $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                                    for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                        ?>
                                                                        <?php if($i==$PageNo) { ?>
                                                            <li><a href="managecoupon.php?order=<?php echo $iid ?>&pgno=<?php echo $i; ?>&status=<?php echo $status;?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                            <?php }else {?>
                                                            <li><a href="managecoupon.php?order=<?php echo $iid ?>&pgno=<?php echo $i; ?>&status=<?php echo $status;?>"><?php echo $i; ?></a></li>
                                                                            <?php }
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if($PageNo<$totalpages) {
                                                                        $NextPageNo = 	$PageNo + 1;
                                                                        ?>
                                                            <li><a href="managecoupon.php?order=<?php echo $iid ?>&pgno=<?php echo $NextPageNo;?>&status=<?php echo $status;?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                        <?php } ?>
                                                        </ul>

                                                    </div>
                                                    <!--[if !IE]>end pagination<![endif]-->
                                                            <?php }?>
                                                        <?php ?>
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
        

<script>
$(document).ready(function () {
$('#excel_button').fineUploader({

multiple: false,
request: {
endpoint: '../include/addons/excel/addcoupon_excel.php'
},

        validation: {
            allowedExtensions: ['xls'],
            sizeLimit: 0,
            minSizeLimit: 0,
            stopOnFirstInvalidFile: true
        },
        callbacks: {
            onSubmit: function(id, fileName){}, // return false to cancel submit
            onComplete: function(id, fileName, responseJSON){
            
            alert(responseJSON);
            
            },
            onCancel: function(id, fileName){},
            onUpload: function(id, fileName, xhr){},
            onProgress: function(id, fileName, loaded, total){},
            onError: function(id, fileName, reason) {},
            onAutoRetry: function(id, fileName, attemptNumber) {},
            onManualRetry: function(id, fileName) {},
            onValidate: function(fileData) {} // return false to prevent upload
        },
        messages: {
            typeError: "{file} has an invalid extension. Valid extension(s): {extensions}.",
            sizeError: "{file} is too large, maximum file size is {sizeLimit}.",
            minSizeError: "{file} is too small, minimum file size is {minSizeLimit}.",
            emptyError: "{file} is empty, please select files again without it.",
            noFilesError: "No files to upload.",
            onLeave: "The files are being uploaded, if you leave now the upload will be cancelled."
        },
        text: {
            uploadButton: 'Import Excel'
            },
debug: true
});
});
</script>
        <!--[if !IE]>end footer<![endif]-->

    </body>
</html>