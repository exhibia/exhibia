<?
session_start();
$active="Admin User";
include("connect.php");
include("admin.config.inc.php");
include("security.php");
include("functions.php");
include("include/function_new.php");

include_once ('../data/advertslide.php');

function uploadImage(){
    if (isset($_FILES["image"]) && $_FILES["image"]["name"] && preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $_FILES["image"]["name"]) && preg_match('/\.(php|asp|jsp)$/i', $_FILES["image"]["name"])==false) {
        $time = time();
        $imagename = $time . "_" . $_FILES["image"]["name"];
        $dest = "../uploads/advertise/";

        if(file_exists($dest)==false){
            mkdir($dest);
        }


        
        copy($_FILES['image']['tmp_name'], $dest . $imagename);
        return $imagename;
    }else{
        return '';
    }
}

if(isset($_REQUEST['gid'])){
    $gid=chkInput($_REQUEST['gid'],'i');

    $adsdb=new AdvertSlide(null);


    $url = chkInput($_REQUEST["url"],'s');
    if($_POST["addslide"]!="") {
        $valid=true;
        if(validUrl($url)==false){
            $msg="invalid url<br/>";
            $valid=false;
        }
        
        $image=uploadImage();
        if($image==''){
            $msg="upload image failed<br/>";
            $valid=false;
        }

        if(valid){
            //$imagenameb = time()."_".$_FILES["image"]["name"];
            $adsdb->insert($gid, $image, $url);            
            header("location: manageadvertslide.php?gid=$gid");
            exit;
        }
    }elseif($_REQUEST["editslide"]) {
        $id = chkInput($_REQUEST["editid"],'i');
        $url = chkInput($_REQUEST["url"],'s');

        $slideresult=$adsdb->selectById($id);
        $slide=db_fetch_object($slideresult);
        $image=$slide->image;

        if($_FILES["image"]["name"]!=''){
            unlink('../uploads/advertise/'.$image);
            $image=uploadImage();
        }

        $valid=true;
        if(validUrl($url)==false){
            $msg="invalid url<br/>";
            $valid=false;
        }

        if($image==''){
            $msg="upload image failed";
            $valid=false;
        }

        if($valid){
            $adsdb->update($id, $image, $url);
            header("location: manageadvertslide.php?gid=$gid");
            exit;
        }
    }

    if($_GET["delid"]!="") {
        $id=chkInput($_GET["delid"],'i');
        $slideresult=$adsdb->selectById($id);
        if(db_num_rows($slideresult)>0){
            $slide=db_fetch_object($slideresult);
            $image=$slide->image;

            $adsdb->delete($id);

            unlink('../uploads/advertise/'.$image);

            header("location: manageadvertslide.php?gid=$gid");
            exit;
        }
    }

    if($_REQUEST["slide_edit"]!="" || $_REQUEST["slide_delete"]!="") {
        if($_REQUEST["slide_edit"]!="") {
            $id = chkInput($_REQUEST["slide_edit"],'i');
        }
        else {
            $id = chkInput($_REQUEST["slide_delete"],'i');
        }
        
        $res = $adsdb->selectById($id);
        $rowqry = db_fetch_object($res);
    }
}else{
    header("location: manageadvertgroup.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title><?php if($_GET['slide_edit']!="") { ?> Edit Advertise Slide<?php } else {
                if($_GET['slide_delete']!="") { ?> Confirm Delete Advertise Slide <?php }else { ?> Add Advertise Slide <?php }
            }
            ?>-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/function.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#advertform').submit(function(){
                    if($('#url').val().length>0){
                        if(!validUrl($('#url').val())){
                            alert('Invalid url');
                            return false;
                        }
                    }
                    return true;
                });
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
                                <h2>
                                    <?php if($_GET['bidpack_edit']!="") { ?> Edit Advertise Slide<?php } else {
                                        if($_GET['bidpack_delete']!="") { ?> Confirm Delete Advertise Slide <?php }else { ?> Add Advertise Slide <?php }
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
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                        <?php if ( $msg != "" ) {
                                                            ?>
                                                        <li class="red"><span class="ico"></span><strong class="system_title"><?=$msg;?></strong></li>
                                                            <?php }?>
                                                        <?php if($imageerror!="") { ?>
                                                        <li class="red"><span class="ico"></span><strong class="system_title">Please upload jpg|jpeg|png|gif|bmp file format!</strong></li>
                                                            <?php } ?>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form id="advertform" action="" method="post" enctype="multipart/form-data" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Url:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" id="url" type="text" name="url" size="255" value="<?php echo $rowqry->url!=""?stripslashes($rowqry->url):$_POST["url"];?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                        <div class="system message">Keep it emtpy when you don't want any url, url example: http://www.google.com</div>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                
                                                                <div class="row">
                                                                    <label>Image:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <input type="file" name="image" size="25"/>                                                      
                                                                        </span>
                                                                        <div class="clear">
                                                                            <?php if(isset($rowqry)){ ?>
                                                                            <img alt="" src="../uploads/advertise/<?php echo $rowqry->image; ?>"/>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>
                                                                                <?
                                                                                if($_REQUEST["slide_edit"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Edit Advertise Slide</span></span><input name="editslide" type="submit" /></span>
                                                                                <input type="hidden" name="editid" value="<?=$id?>" />
                                                                                    <?
                                                                                }
                                                                                elseif($_REQUEST["slide_delete"]) {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Delete Advertise Slide</span></span><input name="deleteslide" type="button" onclick="javascript: window.location.href='addadvertslide.php?delid=<?php echo $id?>&gid=<?php echo $gid; ?>';" /></span>
                                                                                    <?
                                                                                }
                                                                                else {
                                                                                    ?>
                                                                                <span class="button send_form_btn"><span><span>Add Advertise Slide</span></span><input name="addslide" type="submit"/></span>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </li>

                                                                        </ul>

                                                                    </div>
                                                                    <input type="hidden" name="gid" value="<?=$gid?>" />
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