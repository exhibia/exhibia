<?
session_start();
$active = "Admin User";
include_once("admin.config.inc.php");
include("connect.php");
include("functions.php");

$defaultlanguage = 'english';

if (isset($_POST['submitdefault'])) {

    $defaultlanguage = chkInput($_POST['defaultlanguage'],'s');
    $sql = "update sitesetting set value='$defaultlanguage' where name='defaultlanguage';";
    db_query($sql) or die('Query Not Success');

    $editsuccess = true;
}

if(isset($_REQUEST['langid'])){
    $langid=chkInput($_REQUEST['langid'],'i');
    $enable=chkInput($_REQUEST['enable'],'i');
    $upsql="update language set enable=$enable where id=$langid";
    db_query($upsql);
}

$sql = "select * from sitesetting where name='defaultlanguage';";
$result = db_query($sql);
if (db_num_rows($result) > 0) {
    $obj = db_fetch_object($result);
    $defaultlanguage = $obj->value;
    db_free_result($result);
} else {
    $sql = "insert into sitesetting(name,value) values('defaultlanguage','english');";
    db_query($sql) or die('Insert Not Success');
}

$langsql = "select * from language";
$langres = db_query($langsql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Language Setting-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

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
                                <h2>Language Setting</h2>
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
                                                        <?php if (isset($msg)) {
                                                        ?>
                                                            <li class="red"><span class="ico"></span><strong class="system_title"><?= $msg; ?></strong></li>
                                                        <?php } ?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>
                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <br/>

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form id="form1" action="" method="post" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">


                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Default Language:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="defaultlanguage">
                                                                                <?php
                                                                                $selsql="select language,languagename from language where enable=1";
                                                                                $selres=  db_query($selsql);
                                                                                while($selitem=  db_fetch_array($selres)){
                                                                                $lang=$selitem['language'];
                                                                                    ?>
                                                                                <option value="<?php echo $lang; ?>" <?php echo $defaultlanguage == $lang ? 'selected' : ''; ?>><?php echo $selitem['languagename'] ?></option>

                                                                                <?php } ?>
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
                                                                                <span class="button send_form_btn"><span><span>Save</span></span><input name="submitdefault" type="submit"/></span>
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

                                                    <br/>
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start forms<![endif]-->
                                                        <form id="form1" action="" method="post" class="search_form general_form">

                                                            <!--[if !IE]>start table_wrapper<![endif]-->
                                                            <div class="table_wrapper">
                                                                <div class="table_wrapper_inner">
                                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th>Language</th>
                                                                                <th style="text-align:center;">Status</th>
                                                                                <th style="width: 120px;">Action</th>
                                                                            </tr>
                                                                            <?php
                                                                            $i=1;
                                                                            while($lang=  db_fetch_array($langres)){
                                                                            ?>
                                                                                    <tr class="<?php echo ($i % 2 != 0) ? 'first' : 'second'; ?>">
                                                                                        <td class="product_name">
                                                                                    <?php echo $lang['languagename']; ?>
                                                                                </td>
                                                                                <td style="text-align:center;">
                                                                                    <?php echo $lang['enable'] ==1 ? 'Enable' : 'Disable'; ?>
                                                                                </td>
                                                                               
                                                                                <td style="width: 120px;">
                                                                                    <div class="actions_menu">
                                                                                        <ul>
                                                                                            <li>
                                                                                                <?php if ($lang['enable'] ==1) {
                                                                                                ?>
                                                                                                    <a class="edit" href="languagesetting.php?langid=<?php echo $lang['id']; ?>&enable=0">Disable</a>
                                                                                                <?php } else {
                                                                                                ?>
                                                                                                    <a class="edit" href="languagesetting.php?langid=<?php echo $lang['id']; ?>&enable=1">Enable</a>
                                                                                                <?php } ?>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                                        }
                                                                            ?>
                                                                                    </tbody>
                                                                                </table>

                                                                            </div>
                                                                        </div>
                                                                        <!--[if !IE]>end table_wrapper<![endif]-->

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