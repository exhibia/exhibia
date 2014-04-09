<?
session_start();
$active="Admin User";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("functions.php");

include_once '../data/advertgroup.php';

$msg = "";

if ( isset($_POST["addgroup"]) ) {	// Add new category
    $name = chkSQL($_POST["name"], 255);
    $width = chkInput($_POST["width"],'i');
    $height = chkInput($_POST["height"], 'i');
    $stretch=chkInput($_POST["stretch"], 'i');
    $delay=chkInput($_POST["delay"], 'i');
    $effect=chkInput($_POST["effect"], 's');
    $position=chkInput($_POST["position"], 'i');
    $actived=chkInput($_POST["actived"], 'i');

    $adgdb=new AdvertGroup(null);

    // CHECK DUBPLICATE
    $result = db_query("SELECT 1 FROM advertgroup WHERE name='$name'");
    $row = db_num_rows($result) > 0 ? (db_result($result, 0) == 1 ? TRUE : FALSE) : FALSE;
    db_free_result($result);

    if ( $row ) {
        $msg = "Group '$category' already exists!";
    } else {
        $adgdb->insert($name, $width, $height, $stretch, $delay, $effect, $position, $actived);        
        header("location: message.php?msg=110");
        exit;
    }
} elseif ( isset($_POST["editgroup"]) ) {		// Update exists category
   $name = chkSQL($_POST["name"], 255);
    $width = chkInput($_POST["width"],'i');
    $height = chkInput($_POST["height"], 'i');
    $stretch=chkInput($_POST["stretch"], 'i');
    $delay=chkInput($_POST["delay"], 'i');
    $effect=chkInput($_POST["effect"], 's');
    $position=chkInput($_POST["position"], 'i');
    $actived=chkInput($_POST["actived"], 'i');

    if ( isset($_POST["edit"]) ) {
        // CHECK DUBPLICATE
        $edit = chkInput($_POST["edit"], 'i');
        $result = db_query("SELECT 1 FROM advertgroup WHERE name='$name' and id<>'$edit'");
        $row = db_num_rows($result) > 0 ? (db_result($result, 0) == 1 ? TRUE : FALSE) : FALSE;
        db_free_result($result);

        if ( $row ) {
            $msg = "Group '$name' Already Exists !";
        } elseif ( $edit > 0 ) {
            $adgdb=new AdvertGroup(null);
            $adgdb->update($edit, $name, $width, $height, $stretch, $delay, $effect, $position, $actived);
//            $category = htmlspecialchars(stripslashes($category), ENT_QUOTES);
//            db_query("UPDATE categories SET name='$category', description='$desc', status='$status' WHERE categoryID=$edit") or die (db_error());
            header("location: message.php?msg=111");
            exit;
        }
    }
} else {
    if ( isset($_GET['delete']) ) {		// Delete exists category
        $delete = chkInput($_GET["delete"], 'i');
        $result = db_query("SELECT count(*) FROM advertgroup WHERE id='$delete' and id<>0");
        $row = db_result($result, 0);
        db_free_result($result);

        if ( $row > 0 ) {
            $result = db_query("select count(*) from advertslide where groupid=$delete");
            $num_products = db_result($result, 0);
            db_free_result($result);

            if ( $num_products > 0 ) {
                header("location: message.php?msg=112");
            } else {
                db_query("delete from advertgroup where id=$delete") or die(db_error());
                header("location: message.php?msg=113");
            }
            exit;
        }
    }

    // EXIST FETCH THE VALUE FOR GET EDIT TIME FROM MANAGE CATEGORY
    if ( isset($_GET["group_edit"]) || isset($_GET["group_delete"]) ) {
        $cid = FALSE;
        if ( isset($_GET["group_edit"]) ) $cid = chkInput($_GET["group_edit"], 'i');
        if ( isset($_GET["group_delete"]) ) $cid = chkInput($_GET["group_delete"], 'i');

        $row = FALSE;
        if ( $cid > 0 ) {
            $adgdb=new AdvertGroup(null);
            $result = $adgdb->selectById($cid);
            if ( ( $row = db_fetch_object($result) ) ) {
                $name = $row->name;
                $width = $row->width;
                $height = $row->height;
                $stretch=$row->stretch;
                $delay=$row->delay;
                $effect=$row->effect;
                $position=$row->positionid;
                $actived=$row->actived;
            }
            db_free_result($result);
        }

        if ( $cid === 0 || !$row ) {
            echo "<center><font color=red>ERROR CAN NOT FIND REQUIRED PAGE</font>\n<br><br>\n";
            exit;
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?
            if ( isset($_GET["group_edit"]) ) {
                echo "Edit Advertise Group";
            } elseif ( isset($_GET["group_delete"]) ) {
                echo "Confirm Delete Advertise Group";
            } else {
                echo "Add Advertise Group";
            }
            ?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript">
            function delconfirm(loc) {
                if ( confirm("Are you sure do you want to delete this?") ) {
                    window.location.href=loc;
                }

                return false;
            }

            function checkform() {
                if ($('#name').val() == "" ) {
                    alert("Please enter group name.");
                    $('#name').focus();
                    return false;
                }
                if($('#width').val()=='' || $('#width').val()=='0'){
                    alert("width must be bigger then zero.");
                    $('#width').focus();
                    return false;
                }

                if(isNaN($('#width').val())){
                    alert("width must be a digital.");
                    $('#width').focus();
                    return false;
                }

                if($('#height').val()=='' || $('#height').val()=='0'){
                    alert("height must be bigger then zero.");
                    $('#height').focus();
                    return false;
                }

                if(isNaN($('#height').val())){
                    alert("height must be a digital.");
                    $('#height').focus();
                    return false;
                }

                return true;
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
                                    <?
                                    if ( isset($_GET["group_edit"]) ) {
                                        echo "Edit Advertise Group";
                                    } elseif ( isset($_GET["group_delete"]) ) {
                                        echo "Confirm Delete Advertise Group";
                                    } else {
                                        echo "Add Advertise Group";
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
                                                    <form  action="" method="POST" enctype="multipart/form-data" onSubmit="return checkform();" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Group Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text"  type="text" id="name" name="name" size="30" value="<?php echo $name;?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Width:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text"  type="text" name="width" id="width" size="32" value="<?php echo isset($width)?$width:'0';?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Height:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text"  type="text" name="height" id="height" size="32" value="<?php echo isset($height)?$height:'0';?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                               

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Delay:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text"  type="text" name="delay" size="32" value="<?php echo isset($delay)?$delay:'3000';?>"/>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Effect:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="effect">
                                                                                <option value="random" <?php echo ($effect == 'random' ? " selected" : ""); ?>>Random</option>
                                                                                <option value="swirl" <?php echo ($effect == 'swirl' ? " selected" : ""); ?>>Swirl</option>
                                                                                <option value="rain" <?php echo ($effect == 'rain' ? " selected" : ""); ?>>Rain</option>
                                                                                <option value="straight" <?php echo ($effect == 'straight' ? " selected" : ""); ?>>Straight</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Type:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="position">
                                                                                <option value="1" <?php echo ($position == '1' ? " selected" : ""); ?>>Horizontal Main</option>
                                                                                <option value="2" <?php echo ($position == '2' ? " selected" : ""); ?>>Banner Wide</option>
                                                                                <option value="3" <?php echo ($position == '3' ? " selected" : ""); ?>>Banner Left</option>
                                                                                <option value="4" <?php echo ($position == '4' ? " selected" : ""); ?>>Banner Right</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Status:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="actived">
                                                                                <option value="1" <?php echo ($actived == 1 ? " selected" : ""); ?>>Enable</option>
                                                                                <option value="0" <?php echo ($actived == 0 ? " selected" : ""); ?>>Disable</option>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <?php
                                                                                if ( isset($_GET['group_delete']) && $cid > 0 ) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete</span></span><input name="deletegroup" type="button" onClick="delconfirm('addadvertgroup.php?delete=<?=$cid;?>')" /></span>

                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span><?=((isset($_GET["group_edit"]) || $cid > 0) ? "Edit Group" : "Add Group");?></span></span><input type="submit" name="<?=((isset($_GET["group_edit"]) || $cid > 0) ? "editgroup" : "addgroup");?>" /></span>

                                                                                    <?php
                                                                                }
                                                                                ?>

                                                                                <?
                                                                                if ( isset($_GET['group_edit']) ) {
                                                                                    ?>
                                                                                <input type="hidden" name="edit" value="<?=$cid;?>" />
                                                                                    <?
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