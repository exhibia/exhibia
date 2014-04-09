<?php
session_start();
$active = "Users";
include("connect.php");
include("security.php");

if ($_REQUEST['delete']) {
    $images = $_REQUEST['image'];
    foreach($images as $image){
        //echo $image;
        $sql="select * from avatar where id=$image";
        $resdel=db_query($sql);
        if(db_num_rows($resdel)>0){
            $obj=db_fetch_object($resdel);
            $filepath = "../uploads/avatars/".$obj->avatar;
            db_free_result($resdel);
            $sql="delete from avatar where id=$image";
            db_query($sql);
            if(file_exists($filepath)){
                unlink($filepath);
            }
        }
    }
}

if (!empty($_FILES['image'])) {


    if (preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $_FILES["image"]["name"])) {
        $time = time();
        $imagename = $time . "_" . $_FILES["image"]["name"];
        $dest = $BASE_DIR . "/uploads/avatars/";

        if(!file_exists($dest)){
            mkdir($dest);
        }
      //if ($error == UPLOAD_ERR_OK) {
       
        move_uploaded_file($_FILES['image']['tmp_name'], $dest . $imagename);
        $sql = "insert into avatar(avatar) values('$imagename');";
        db_query($sql) or die(db_error());
        
        
        
     // }
    }
}


$sql = "select * from avatar";

$result = db_query($sql);
$total = db_num_rows($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Avatar-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>

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
                                                <h2>Manage Bidding Users</h2>
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

                                                    <?php if ($total==0) { ?>
                                                                                                        <ul class="system_messages">
                                                                                                            <li class="blue"><span class="ico"></span><strong class="system_title">No Bidding Users  To Display</strong></li>
                                                                                                        </ul>
                                                    <?php } else { ?>
                                                                                                        <div  id="product_list">
                                                                                                            <!--[if !IE]>start table_wrapper<![endif]-->
                                                                                                            <div class="table_wrapper">
                                                                                                                <div class="table_wrapper_inner">
                                                                                                                    <form method="post" action="manageavatar.php" class="search_form general_form">
                                                                                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                            <tbody>
                                                                                                                                <tr align="center">

                                                                                <?php
                                                                                $i = 0;
                                                                                while ($obj = db_fetch_object($result)) { ?>
                                                                                                                                                                <td align="center">
                                                                                                                                                                    <div><img alt="" src="../uploads/avatars/<?php echo $obj->avatar; ?>"/></div>
                                                                                                                                                                    <div><input type="checkbox" name="image[]" value="<?php echo $obj->id; ?>"/></div>
                                                                                                                                                                </td>
                                                                                
                                                                                <?php
                                                                                $i++;
                                                                                if ($i % 8==0)
                                                                                    echo "</tr><tr>" ;
                                                                            }
                                                                            db_free_result($result);
                                                                                ?>

                                                                                                                                                            </tr>
                                                                                                                                                        </tbody>
                                                                                                                                                    </table>

                                                                                                                                                    <!--[if !IE]>start row<![endif]-->
                                                                                                                                                    <div class="row" style="padding-top:20px;">
                                                                                                                                                        <div class="buttons">
                                                                                                                                                            <span class="button send_form_btn"><span><span>Delete Select</span></span><input name="delete" type="submit"/></span>
                                                                                
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                    <!--[if !IE]>end row<![endif]-->
                                                                                                                                                </form>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                                                                                                    </div>
                                                    <?php } ?>

                                                                                                        <div style="padding:20px;clear:both;">
                                                                                                            <!--[if !IE]>start forms<![endif]-->
                                                                                                            <form action="manageavatar.php" method='POST' enctype="multipart/form-data" class="search_form general_form">
                                                                                                                <!--[if !IE]>start fieldset<![endif]-->
                                                                                                                <fieldset>
                                                                                                                    <!--[if !IE]>start forms<![endif]-->
                                                                                                                    <div class="forms">

                                                                                                                        <!--[if !IE]>start row<![endif]-->

                                                                                                                        <div class="row">
                                                                                                                            <label>Avatar Image:</label>
                                                                                                                            <div class="inputs">
                                                                                                                                <span class="input_wrapper blank">
                                                                                                                                    <input type="file" name="image" size="25"/>
                                                                                                                                </span>
                                                                                                                            </div>
                                                                                                                        </div>

                                                                                                                        <!--[if !IE]>end row<![endif]-->

                                                                                                                        <!--[if !IE]>start row<![endif]-->
                                                                                                                        <div class="row" style="padding-left:25px;">
                                                                                                                            <div class="buttons">
                                                                                                                                <ul>
                                                                                                                                    <li>
                                                                                                                                        <span class="button send_form_btn"><span><span>Upload Image</span></span><input name="upload" type="submit"/></span>

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