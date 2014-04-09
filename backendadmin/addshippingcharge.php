<?php
session_start();
$active="Database";
include("connect.php");
include("admin.config.inc.php");
include("security.php");

$shipping = $_REQUEST["shippingcharge"];
$title = $_REQUEST["shippingchargetitle"];

if($_REQUEST["addshipping"]) {
    $qrysel = "select * from shipping where shipping_title='$title'";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if($totalrow>0) {
        header("location: message.php?msg=47");
        exit;
    }
    else {
        $qryins = "insert into shipping (shipping_title,shippingcharge) values ('$title','$shipping')";
        db_query($qryins) or die(db_error());
        header("location: message.php?msg=45");
        exit;
    }
}

if($_POST["editshipping"]!="") {
    $id = $_POST["editid"];
    $qrysel = "select * from shipping where shipping_title='$title' and id<>$id";
    $ressel = db_query($qrysel);
    $totalrow = db_affected_rows();
    if($totalrow>0) {
        header("location: message.php?msg=47");
        exit;
    }
    else {
        $qryupd = "update shipping set shipping_title='$title',shippingcharge='$shipping', shippingtypeid='$_POST[shippingtypeid]' where id='$id'";
        db_query($qryupd) or die(db_error());
        header("location: message.php?msg=48");
        exit;
    }
}

if($_GET["delid"]!="") {
    $qryauc = "select * from auction where shipping_id='".$_GET["delid"]."'";
    $resauc = db_query($qryauc);
    $totalauc = db_num_rows($resauc);
    if($totalauc>0) {
        header("location: message.php?msg=49");
        exit;
    }
    else {
        $qryd = "delete from shipping where id='".$_GET["delid"]."'";
        db_query($qryd) or die(db_error());
        header("location: message.php?msg=46");
        exit;
    }
}

if($_REQUEST["shipping_edit"]!="" || $_REQUEST["shipping_delete"]!="") {
    if($_REQUEST["shipping_edit"]!="") {
        $id = $_REQUEST["shipping_edit"];
    }
    else {
        $id = $_REQUEST["shipping_delete"];
    }
    $qrysel = "select * from shipping where id='$id'";
    echo $qrysel;
    $res = db_query($qrysel);
    $totalrow = db_affected_rows();
    $row = db_fetch_object($res);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Add Shipping Charge-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="text/javascript">
            function Check(f1)
            {
                if(document.f1.shippingcharge.value=="")
                {
                    alert("Please enter shipping charge.");
                    document.f1.shippingcharge.focus();
                    return false;
                }
                if(document.f1.shippingchargetitle.value=="")
                {
                    alert("Please enter shipping charge title");
                    document.f1.shippingchargetitle.focus();
                    return false;
                }
            }
        </script>
        <script type="text/javascript">
            function TrackCount(fieldObj,countFieldName,maxChars){
                var countField = eval("fieldObj.form."+countFieldName);
                var diff = maxChars - fieldObj.value.length;

                // Need to check & enforce limit here also in case user pastes data
                if (diff < 0)
                {
                    fieldObj.value = fieldObj.value.substring(0,maxChars);
                    diff = maxChars - fieldObj.value.length;
                }
                countField.value = diff;
            }

            function LimitText(fieldObj,maxChars){
                var result = true;
                if (fieldObj.value.length >= maxChars)
                    result = false;

                if (window.event)
                    window.event.returnValue = result;
                return result;
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
                                <h2>Add Shipping Charge</h2>
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
                                                    <form name="f1" id="f1" action="addshippingcharge.php" method="post" onsubmit="return Check(this)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Shipping charge title:</label>
                                                                    <div class="inputs">
                                                                        <?php $lengthname = strlen($row->shipping_title);
                                                                        $newlength = 30 - $lengthname;
                                                                        ?>
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="shippingchargetitle" size="32" class="solidinput" value="<?php echo stripslashes($row->shipping_title); ?>" maxlength="30" ONKEYUP="TrackCount(this,'textcount1',30)" ONKEYPRESS="LimitText(this,30)"/>                                                                        
                                                                        </span>
                                                                        <span>Remain Characters: <input type="text" readonly size="2" value="<?=$newlength;?>" name="textcount1" class="textbox"/></span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Shipping charge:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="shippingcharge" size="10" value="<?=$row->shippingcharge!=""?number_format($row->shippingcharge,2):"";?>" />
                                                                        </span>
                                                                        <span class="currency"><?=$Currency;?></span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
								 <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Shipping provider:</label>
                                                                    <div class="inputs">
                                                                       
                                                                            <select name="shippingtypeid" id="shippingtypeid">
                                                                            <option value="">Please Choose</option>
                                                                            <?php
                                                                            $sql_s = db_query("select * from shippingtype");
                                                                            while($row_s = db_fetch_array($sql_s)){
                                                                            ?>
										<option alt="<?php echo $row_s['logoimage'];?>" value="<?php echo $row_s['id']; ?>" <?php if($row->shippingtypeid == $row_s['id']){
										echo "selected"; }?>><?php echo $row_s['name']; ?></option>
									    <?php } ?>
									    </select>
                                                                       
                                                                        <span class="system required">*</span>
                                                                        <div id="s_logo" style="float:right;margin-right:20px;"></div>
                                                                        <script>
									    $('#shippingtypeid').change(function(){
									    
										$('#s_logo').html('<img src="<?php echo $SITE_URL; ?>uploads/other/' + $('#shippingtypeid option:selected').attr('alt') + '" />');  
									    
									    })
                                                                        $('#s_logo').html('<img src="<?php echo $SITE_URL; ?>uploads/other/' + $('#shippingtypeid option:selected').attr('alt') + '" />'); 
                                                                        
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Description:</label>
                                                                    <div class="inputs">
                                                                    
                                                                            <textarea name="description" rows="" cols="" class="text"><?=$desc;?></textarea>
                                                                  
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <?
                                                                                if($_REQUEST["shipping_edit"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Edit Shipping Charge</span></span><input name="editshipping" type="submit" /></span>
                                                                                <input type="hidden" name="editid" value="<?=$id?>" />
                                                                                    <?
                                                                                }
                                                                                elseif($_REQUEST["shipping_delete"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete Shipping Charge</span></span><input name="deleteshipping" type="button" onclick="javascript: window.location.href='addshippingcharge.php?delid=<?=$id?>';"/></span>
                                                                                    <?
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Add Shipping Charge</span></span><input name="addshipping" type="submit" /></span>
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