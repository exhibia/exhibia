<?php
session_start();
$active="CMS";
include("connect.php");
include("admin.config.inc.php");
include("security.php");
include("functions.php");
include("imgsize.php");

$ex='';
$msg='';

//*** ADD COMMUNITY ***//
if($_POST['addcommunity']) {

    $title=addslashes($_POST['title']);
    $com_status=$_REQUEST["status"];
    $short_desc=addslashes($_REQUEST["short_desc"]);
    $long_desc=addslashes($_REQUEST["description"]);

    $comdate = explode("/",$_POST['com_date']);

    $date_time = strtotime(date("Y-m-d H:i:s"));

    if($ex!=1) {
        //add new Community
        $insertQuery="INSERT INTO community (title,com_short_desc,com_long_desc,com_date,status)  VALUES('".$title."','".$short_desc."','".$long_desc."','".$date_time."','".$com_status."')";
        $insertResult = db_query($insertQuery) or die (db_error());
        $cid = db_insert_id();

        // COMMUNITY IMAGE UPLOAD FILE //
        for($i=1;$i<=1;$i++) {
            if(isset($_FILES["image".$i])) {
                if (isset($_FILES["image".$i]) && $_FILES["image".$i]["name"] && preg_match('/\.(jpg|jpeg|gif|jpe|pcx|bmp)$/i', $_FILES["image".$i]["name"])) {
                    $time = time();
                    $logo = $i."_".$time."_".$_FILES["image".$i]["name"];
                    $logo_temp = $_FILES["image".$i]["tmp_name"];
                    communityimage($logo,$cid,$logo_temp);
                    db_query("update community set picture".$i."='".$logo."' where id=$cid") or die (db_error());
                }
            }
        }

        ?>
<script type="text/javascript">
    window.location.href="message.php?msg=78";
</script>			
        <?
        exit;
    }

} 

//*** UPDATE COMMUNITY****//
elseif($_POST['editcommunity']) {

    $qryselcat = "select * from community where id='".$_POST['edit']."'";
    $resselcat = db_query($qryselcat);
    $objcat = db_fetch_object($resselcat);

    $title=$_POST['title'];
    $status=$_REQUEST["status"];
    $short_desc=addslashes($_REQUEST["short_desc"]);
    $long_desc=addslashes($_REQUEST["description"]);

    $comdate = explode("/",$_POST['com_date']);
    $date_time = strtotime($comdate[2]."-".$comdate[0]."-".$comdate[1]." ".date("H").":".date("i").":".date("s"));
//		duplication check			
    $co_id = $_POST['edit'];

    $qryselect = "select * from community where title='$title' and id<>".$co_id;
    $resselect = db_query($qryselect);
    $totalcount = db_affected_rows();

    if($totalcount>0) {
        header("location: message.php?msg=81");
        exit;
    }

    $qryupd= "update community set title='".$title."', status='".$status."',com_short_desc='".$short_desc."', com_long_desc='".$long_desc."' where id=".$co_id;
    db_query($qryupd) or die(db_error());
    $co_id = $_POST['edit'];



    for($i=1;$i<=1;$i++) {
        if(isset($_FILES["image".$i])) {
            if (isset($_FILES["image".$i]) && $_FILES["image".$i]["name"] && preg_match('/\.(jpg|jpeg|gif|jpe|pcx|bmp)$/i', $_FILES["image".$i]["name"])) {
                if($_FILES["image".$i]["name"]!="") {
                    $time = time();
                    $logo = $i."_".$time."_".$_FILES["image".$i]["name"];
                    $logo_temp = $_FILES["image".$i]["tmp_name"];
                    communityimage($logo,$co_id,$logo_temp);
                    db_query("update community set picture".$i."='".$logo."' where id='".$co_id."'") or die (db_error());
                }
            }
        }
    }
    ?>
<script  type="text/javascript">
    window.location.href="message.php?msg=79";
</script>			
    <?
    exit;
}				

//delete from community
if($_REQUEST["community_delete"]!="") {

    $qrydel = "delete from community where id=".$_REQUEST["community_delete"];
    db_query($qrydel) or dir(db_error());
    ?>
<script  type="text/javascript">
    window.location.href="message.php?msg=80";
</script>			
    <?
//			header("location: message.php?msg=9");
    exit;
}

//selection for edit
if($_REQUEST["community_edit"]!="" or $_REQUEST["community_delete"]!="") {
    if($_REQUEST["community_edit"]!="") {
        $co_id=$_REQUEST["community_edit"];
    }
    if($_REQUEST["community_delete"]!="") {
        $co_id=$_REQUEST["community_delete"];
    }
    $qry = "select * from community where id=".$co_id;
    $resqry = db_query($qry);
    $row = db_fetch_object($resqry);
    $title = stripslashes($row->title);
    $status = $row->status;
    $short_desc = stripslashes($row->com_short_desc);
    $long_desc = stripslashes($row->com_long_desc);
    $comdate = $row->com_date;

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if($_GET['community_edit']!="") { ?> Edit Community<?php } else {
                if($_GET['community_delete']!="") { ?> Confirm Delete Community <?php }else { ?> Add Community <?php }
            }
            ?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/ui/ui.accordion.min.js"></script>
        <script type="text/javascript" src="validation.js"></script>
        <script type="text/javascript" src="popupimage.js"></script>
        <script type="text/javascript" src="editor/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript" src="editor.js"></script>

        <script type="text/javascript">

            function delconfirm(loc)
            {
                if(confirm("Are you sure do you want to delete this?"))
                {
                    window.location.href=loc;
                }
                return false;
            }
            function Check(f1)
            {
                /*	if(document.f1.com_date.value=="")
                {
                        alert("Please Enter Community Date!!!");
                        document.f1.com_date.focus();
                        return false;
                }*/
                if(document.f1.title.value=="")
                {
                    alert("Please Enter Community Title!!!");
                    document.f1.title.focus();
                    return false;
                }
                if(document.f1.short_desc.value=="")
                {
                    alert("Please Enter Short Description!!!");
                    document.f1.short_desc.focus();
                    return false;
                }

                if(document.f1.editimage.value=="")
                {
                    if(document.f1.image1.value=="")
                    {
                        alert("Please enter upload file name!!!");
                        document.f1.image1.focus();
                        return false;
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
                                <h2>
                                    <?php if($_GET['community_edit']!="") { ?> Edit Community<?php } else {
                                        if($_GET['community_delete']!="") { ?> Confirm Delete Community <?php }else { ?> Add Community <?php }
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
                                                    <form  action="" method="POST" enctype="multipart/form-data" onSubmit="return checkform(this);" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Item Title:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input type="text" name="title" size="73" class="text" value="<?php echo $title; ?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Item Status:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="status">
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

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Short Description:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper textarea_wrapper">
                                                                            <textarea class="text" rows="5" cols="60" name="short_desc"><?=$short_desc;?></textarea>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Full Description:</label>
                                                                    <div class="inputs">
                                                                        <span class="">
                                                                            <textarea name="description" rows="20" cols="" class="text"><?php echo $long_desc;?></textarea>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Item Image:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <input name="image1" type="file" value="<?php echo $image;?>"/>
                                                                            
                                                                        </span>
                                                                        <span class="system required">(Recommended Image Size: 350 &times; 275)*</span>
                                                                        <?php if($_GET["community_edit"]!="" || $_GET["community_delete"]!="") { ?><span><img src="../uploads/community/thumb/thumb_<?=$row->picture1;?>" alt="" /></span><?php } ?>
                                                                        <input type="hidden" name="editimage" value="<?=$_GET['community_edit']?>"/>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <?php
                                                                                if($_GET['community_delete']!="" and $co_id!="") {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span><?php if($_GET['community_delete']!="") {?> Delete Community <?php }else { ?> Add Community <?php } ?></span></span><input name='<?php if($_GET['community_delete']!="") {?>deletecommunity<?php }else {?>addcommunity<?php } ?>' type="button" onClick="delconfirm('addcommunity.php?delete=<?=$co_id?>&community_cid=<?=$_REQUEST["community_cid"];?>')"/></span>
                                                                                    <?php
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span><?php if($_GET['community_edit']!="") {?> Edit Community <?php }else { ?> Add Community <?php } ?></span></span><input name='<?php if($_GET['community_edit']!="") {?>editcommunity<?php }else {?>addcommunity<?php } ?>' type="submit" /></span>
                                                                                    <?php
                                                                                }
                                                                                ?>

                                                                                <?php if($_GET['community_edit']!="" || $_GET["community_cid"]!="") {?>
                                                                                <input type="hidden" name="edit" value="<?=$_GET['community_edit']?>"/>
                                                                                    <?php } ?>
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