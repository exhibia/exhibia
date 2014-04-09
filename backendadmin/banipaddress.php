<?php
session_start();
$active = "Plugin";

include("security.php");
include("admin.config.inc.php");
$parentpath = $SITE_URL . '/include/addons/easy-ban-ip/';

$adminuser = 'admin'; // configure admin user here
$adminpass = 'admin'; // configure admin pass here
$whois = $parentpath . 'ban/whois.php?ip=';
#$whois			='http://www.db.ripe.net/whois?form_type=simple&full_query_string=&searchtext=';
#####################################################
##												   ##
## Dynamic contact form, Copyright Adrian Petcu    ##
##			 All rights reserved 2010			   ##
## 												   ##
#####################################################
include $BASE_DIR . "/include/addons/easy-ban-ip/ban/functions_ban.php";

$content1 = file($BASE_DIR . "/include/addons/easy-ban-ip/ban/data.txt");
$continut = explode("$#", $content1[0]);

if (isset($_POST['delete'])) {
    $fp = fopen($BASE_DIR . "/include/addons/easy-ban-ip/ban/data.txt", 'w');
    unset($continut[$_POST['formid']]);
    $string = @implode("$#", $continut);
    fwrite($fp, $string);
    fclose($fp);
}

if (isset($_POST['addfield'])) {
    if (!is_ip($_POST['ip'])) {
        $_POST['ip'] = '';
        $err = "<div class='eroare'><img src='{$parentpath}ban/images/cross.png'/> String entered is not an IP</div>";
    } elseif (preg_match("/" . $_POST['ip'] . "/i", $content1[0])) {
        $_POST['ip'] = '';
        $err = "<div class='eroare'><img src='{$parentpath}ban/images/cross.png'/> Ip Already banned!</div>";
    }

    if ($_POST['ip']) {
        if ($_POST['duration']) {
            if ($_POST['duration'] == 'permanent')
                $timestamp = 'permanent';
            else
                $timestamp = time() + ($_POST['duration'] * 3600);

            $fp = fopen($BASE_DIR . "/include/addons/easy-ban-ip/ban/data.txt", 'w');
            $continut[] = $_POST['ip'] . "|" . $timestamp . '|' . $_POST['duration'];
            $string = implode("$#", $continut);
            fwrite($fp, $string);
            fclose($fp);
            $err = "<div class='success'><img src='{$parentpath}ban/images/apply.png' alt=''/> Ip Banned</div>";
        }
    }
}

$content1 = file($BASE_DIR . "/include/addons/easy-ban-ip/ban/data.txt");
$content = explode("$#", $content1[0]);
$to = $content['0'];

foreach ($content as $i => $val) {
    if ($content[$i]) {
        $forms[] = $content[$i];
    }
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Ban active users by IP-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>

        <style type="text/css" media="screen">@import url(<?php echo $parentpath; ?>ban/style.css);</style>
        <link rel="stylesheet" href="<?php echo $parentpath; ?>ban/thickbox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo $parentpath; ?>ban/jquery.js"></script>
        <script type="text/javascript" src="<?php echo $parentpath; ?>ban/thickbox.js"></script>

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
                                <h2>Ban active users by IP</h2>
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
                                                                <div id='container'>
                                                                    <table width='100%' cellspacing='0' cellpadding='0'>
                                                                        <tr>
                                                                            <td width='70%' valign='top'>
                                                                                <table width='100%' cellspacing='0' cellpadding='0'>
                                                                                    <tr>
                                                                                        <th class='tablehead'>ID</th>
                                                                                        <th class='tablehead'>IP</th>
                                                                                        <th class='tablehead'>Duration</th>
                                                                                        <th class='tablehead' style='width:190px;'>Expires</th>
                                                                                        <th class='tablehead' style='width:120px;'>Actions</th>
                                                                                    </tr>
                                                                                    <?
                                                                                    if ($forms) {
                                                                                        $i = 1;
                                                                                        foreach ($forms as $tag => $val) {
                                                                                            $z = explode('|', $val);
                                                                                            list($ip, $timestamp, $type) = $z;
                                                                                    ?>
                                                                                            <form action='' method='POST'>
                                                                                                <tr bgcolor='white' onmouseover="this.bgColor='#faffea'" onmouseout="this.bgColor='#ffffff'">
                                                                                                    <td style='padding-left:4px;text-align:center;'><?= $i ?></td>
                                                                                                    <td class='td1'><a href="<?= $whois . $ip ?>&keepThis=true&TB_iframe=true&height=450&width=480" title="Viw IP info <b><?= $ip ?></b>" class="thickbox"><?= $ip ?></a></td>
                                                                                                    <td class='td3'><?= time2type($type) ?></td>
                                                                                                    <td class='td2'><?
                                                                                            if ($timestamp != 'permanent')
                                                                                                echo countdown($timestamp); else
                                                                                                echo '-';
                                                                                    ?></td>
                                                                                            <td class='td4' align='right' nowrap><div class='buttons'><button type="submit" class="negative" name="delete"> <img src="<?php echo $parentpath; ?>ban/images/cross.png" alt="" style="display:inline;float:none;width:auto;"/> Remove</button> <input type='hidden' name='formid' value='<?= $tag ?>'/></div></td>
                                                                                        </tr>
                                                                                    </form>
                                                                                    <?
                                                                                                $i++;
                                                                                            }
                                                                                        }else
                                                                                            echo "<tr><td colspan='5' align='center'>No IP's banned Yet!</td></tr>";
                                                                                    ?>
                                                                                    </table>
                                                                                    <br/><br/>
                                                                                </td>
                                                                                <td style='border-left:1px solid #3b3b3b; padding:5px;' valign='top'>
                                                                                <?= $err ?>
                                                                                        <span class='title'>Ban IP</span>
                                                                                        <table width='100%'>
                                                                                            <form action='' method='POST'>
                                                                                                <tr>
                                                                                                    <td>IP</td>
                                                                                                    <td><input type='text' class='text' name='ip'/></td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Duration</td>
                                                                                                    <td>
                                                                                                        <select name='duration' class='select'>
                                                                                                            <option value=''>Select</option>
                                                                                                            <option value='12'>12 Hours</option>
                                                                                                            <option value='24'>One Day</option>
                                                                                                            <option value='48'>Two Days</option>
                                                                                                            <option value='72'>Three Days</option>
                                                                                                            <option value='168'>One Week</option>
                                                                                                            <option value='336'>Two Weeks</option>
                                                                                                            <option value='744'>A Month</option>
                                                                                                            <option value='8760'>A Year</option>
                                                                                                            <option value='permanent'>Permanent</option>
                                                                                                        </select>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td colspan='2'>
                                                                                                        <div class='buttons'><button type="submit" class="positive" name="addfield"> <img src="<?php echo $parentpath; ?>ban/images/apply.png" alt=""/> Ban IP</button></div></td>
                                                                                                </tr>
                                                                                            </form>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
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