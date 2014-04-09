<?php
session_start();
$active="Database";
include_once("config.inc.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");
include_once 'functions.php';
include_once '../data/shippingtype.php';

$stdb=new ShippingType(null);
$result=$stdb->selectAll();
$total=  db_num_rows($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Shipping Type-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript">

            function sentconfirm(loc)
            {
                if(confirm("Are you sure the product was sent to user?"))
                {
                    window.location.href=loc;
                }
                return false;
            }
            function Submitform()
            {
                document.form1.submit();
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
                                <h2>Manage Shipping Type</h2>
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

                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                <?php if($total<=0) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No Shipping Type To Display</strong></li>
                                                                </ul>
                                                                    <?php }else {?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>name</th>
                                                                            <th style="text-align: center;">logo</th>
                                                                            <th style="width:140px;text-align:center;">Action</th>
                                                                        </tr>
                                                                            <?
                                                                            for($i=0;$i<$total;$i++) {
                                                                                $row = db_fetch_object($result);                                                                                
                                                                                ?>
                                                                        <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
                                                                            <td class="product_name"><a href="<?php echo $row->url; ?>"><?php echo $row->name; ?></a></td>
                                                                            <td style="text-align:center;"><a href="<?php echo $row->url; ?>"><img alt="" src="../uploads/other/<?php echo $row->logoimage; ?>" border="0"/></a></td>
                                                                            <td style="text-align:center;">
                                                                                <div class="actions_menu">
                                                                                    <ul>
                                                                                        <li>
                                                                                            <a class="edit" href="addshippingtype.php?ship_edit=<?php echo $row->id;?>">Edit</a>
                                                                                        </li>
                                                                                        <li>
                                                                                            <a class="delete" name="button" href="addshippingtype.php?ship_delete=<?php echo $row->id;?>">Delete</a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                                <?php }
                                                                            ?>
                                                                    </tbody>
                                                                </table>
                                                                    <?php }?>
                                                            </div>
                                                        </div>
                                                        <!--[if !IE]>end table_wrapper<![endif]-->
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