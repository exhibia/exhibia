<?
session_start();
$active="Forum";
include("connect.php") ;
include_once("admin.config.inc.php");
include("security.php");
include_once("imgsize.php");
$ex="";
$msg="";
$forum_image = '';
@db_query("alter table forum_categories add column forum_image varchar(250) ;");
if($_POST['addcategory']) {
    $category=addslashes($_POST["categoryname"]);

    $status=$_POST["status"];

    // CHECK DUBPLICATE //
    $q=db_query("SELECT * FROM forum_categories WHERE category_name='".$category."'");

    $rows=db_fetch_array($q);
    if($rows) {
        $ex=1;
        $msg='This Category Already Exists !';
    }
    // CHECK DUBPLICATE //

    if($ex!=1) {
        $q = db_query("insert forum_categories (category_name,status) VALUES ('".$category."','".$status."')") or die ("insert error".db_error());

        $pid = db_insert_id();
        foreach($_FILES['forum_image']['name'] as $key => $value){
         forum_image($_FILES['forum_image']['name'][$key], $key,  $_FILES['forum_image']['tmp_name'][$key]);
		    $msg .= "update forum_categories set forum_image = '" . $_FILES['forum_image']['name'][$key] . "' where category_id = $pid";
		    db_query($msg);
		    
	}	  
        ?>
<script language="javascript">
    window.location.href="message.php?msg=84";
</script>				
        <?
        exit;
    }
}

//*** SECOND CATEGORY UPDATE ****//

elseif($_POST['editcategory']) {
    $category=addslashes($_POST["categoryname"]);
    $desc=addslashes($_POST["description"]);
    $status=$_POST["status"];

    if(isset($_POST['edit'])) {
        // CHECK DUBPLICATE //
        $q=db_query("SELECT * FROM forum_categories WHERE category_name='".$category."' and category_id<>'".$_POST['edit']."'");

        $rows=db_fetch_array($q);
        if($rows) {
            $ex=1;
            $msg="This Category Already Exists !";
        }
    }

    
         foreach($_FILES['forum_image']['name'] as $key => $value){
        
         forum_image($_FILES['forum_image']['name'][$key], $key,  $_FILES['forum_image']['tmp_name'][$key]);
		    $msg .= "update forum_categories set forum_image = '" . $_FILES['forum_image']['name'][$key] . "' where category_id = $_POST[edit]";
		    db_query($msg);
	}
    if ($ex!=1) {
        if(isset($_POST['edit'])) {
            db_query("UPDATE forum_categories SET category_name='".$category."', status='".$status."' WHERE category_id='".$_POST['edit']."'") or die (db_error());

            $pid = $_POST['edit'];
        foreach($_FILES['forum_image']['name'] as $key => $value){
         forum_image($_FILES['forum_image']['name'][$key], $key,  $_FILES['forum_image']['tmp_name'][$key]);
		    $msg .= "update forum_categories set forum_image = '" . $_FILES['forum_image']['name'][$key] . "' where category_id = $pid";
		    db_query($msg);
	}

            ?>
<script language="javascript">
    window.location.href="message.php?msg=85";
</script>				
            <?
            exit;
        }

    } //end if $ex
}

else {
    //*** THIRD CATEGORY DELETE ****//
    if(isset($_GET['delete'])) {
        $q = db_query("SELECT * FROM forum_categories WHERE category_id='".$_GET['delete']."' and category_id<>0") or die (db_error());
        $row = db_fetch_row($q);
        $totalrow = db_affected_rows();
        if($totalrow>0) {
            $qryd = "delete from forum_categories where category_id=".$_GET['delete'];
            db_query($qryd) or die(db_error());
            header("location: message.php?msg=86");
            exit;

        }
    }

    // EXIST FETCH THE VALUE FOR GET EDIT TIME FROM MANAGE CATEGORY //
    if($_GET["category_edit"] || $_GET["category_delete"]) {

        if(isset($_GET["category_edit"])) {
            $cid=$_GET["category_edit"];
        }
        if(isset($_GET["category_delete"])) {
            $cid=$_GET["category_delete"];
        }

        $q = db_query("SELECT * FROM forum_categories WHERE category_id='".$cid."'") or die (db_error());
        $row = db_fetch_object($q);
        if (!$row) //can't find category....
        {
            echo "<center><font color=red>ERROR CAN NOT FIND REQUIRED PAGE</font>\n<br><br>\n";
            exit;
        }
        $category=stripslashes($row->category_name);
        $status=$row->status;

    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if($_GET['category_edit']!="") { ?> Edit Forum Categories<?php } else {
                if($_GET['category_delete']!="") { ?> Confirm Delete Forum Categories <?php }else { ?> Add Forum Categories <?php }
            }
            ?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript">

            function delconfirm(loc)
            {
                if(confirm("Are you sure do you want to delete this?"))
                {
                    window.location.href=loc;
                }
                return false;
            }

            function checkform(f1)
            {
                if(f1.categoryname.value=="")
                {
                    alert("Please enter category name.");
                    f1.categoryname.focus();
                    return false;
                }
                if(f1.status.value=="")
                {
                    alert("Please select category status.");
                    f1.status.focus();
                    return false;
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
                                <h2>
                                    <?php if($_GET['category_edit']!="") { ?> Edit Forum Categories<?php } else {
                                        if($_GET['category_delete']!="") { ?> Confirm Delete Forum Categories <?php }else { ?> Add Forum Categories <?php }
                                    }
                                    ?>
                                </h2>
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
                                                    <!--[if !IE]>start system messages<![endif]-->

                                                    <ul class="system_messages">
                                                        <?php if ( $msg != "" ) {
                                                            ?>
                                                        <li class="red"><span class="ico"></span><strong class="system_title"><?=$msg;?></strong></li>
                                                            <?php }?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form action='' method='POST' enctype="multipart/form-data" onSubmit="return checkform(this);" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Category Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="categoryname" size="32" class="text" value="<?php echo stripslashes($category); ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Category Status:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="status">
                                                                                <!--<option value="" selected="selected">---Select---</option>-->
                                                                                <option value="0" <?php if($status==0) {
                                                                                    echo " selected";
                                                                                        } ?> selected="selected">Enable</option>
                                                                                <option value="1" <?php if($status!="" and $status==1) {
                                                                                    echo " selected";
                                                                                        } ?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <?php 
                                                                if($forum_image == 'enabled'){
                                                                ?>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Category Icon:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                        <?php
                                                                        if(!empty($row->forum_image)){
                                                                        ?>
                                                                        <img src="../uploads/forum_image/<?php echo $row->forum_image;?>" style="float:left;" />
                                                                        
                                                                        <?php } ?>
                                                                           <input type="file" name="forum_image[]" id="forum_image[]" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
								<?php } ?>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <?php
                                                                                if($_GET['category_delete']!="" and $cid!="") {

                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span><?php if($_GET['category_delete']!="" or $cid!="") {?> Delete Category <?php }else { ?> Add Category <?php } ?></span></span><input name="<?php if($_GET['category_delete']!="" or $cid!="") {?>deletecategory<?php }else {?>addcategory<?php } ?>" type="button" onClick="delconfirm('addforumcat.php?delete=<?=$cid?>')"/></span>
                                                                                    <?php
                                                                                }
                                                                                else {

                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span><?php if($_GET['category_edit']!="" or $cid!="") {?> Edit Category <?php }else { ?> Add Category <?php } ?></span></span><input name="<?php if($_GET['category_edit']!="" or $cid!="") {?>editcategory<?php }else {?>addcategory<?php } ?>" type="submit"/></span>
                                                                                    <?php
                                                                                }
                                                                                ?>

                                                                                <?php if($_GET['category_edit']!="") {?>
                                                                                <input type="hidden" name="edit" value="<?=$_GET['category_edit']?>"/>

                                                                                    <?php if($tmpnew!="1") {?>
                                                                                <input type="hidden" name="parents" value="0"/>
                                                                                        <?php }
                                                                                }
                                                                                ?>
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