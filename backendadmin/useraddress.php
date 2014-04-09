<?php
session_start();
$active = "Auctions";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");
include("functions.php");

$uid = chkInput($_GET["userid"], 'i');
$qr = "select * from registration r left join countries c on r.country=c.countryId where id='" . $uid . "'";
$result = db_query($qr);
if (db_num_rows($result) > 0) {
    $userobj = db_fetch_array($result);
} else {
    exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Manage Sold Auction-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript">
            function Submitform()
            {
                document.form1.submit();
            }
        </script>

        <style type="text/javascript">
            body{
                text-align: center;
                padding:30px;
                font-size: 14px;
                width:100%;
            }

            #table{
                text-align: left;
            }

            #table th{
                text-align: left;
            }
        </style>
    </head>

    <body>
        <table id="table" width="100%" cellspacing="2" cellpadding="2">
            <tr>
                <th align="left" width="100">Name:</th>
                <td>
                    <?php echo $userobj['firstname'] . ' ' . $userobj['lastname'] ?>
                </td>
            </tr>

            <tr>
                <th align="left" >Address:</th>
                <td>
                    <?php echo $userobj['addressline1'] ?> <br/>
                    <?php echo $userobj['addressline2'] ?>
                </td>
            </tr>
            

            <tr>
                <th align="left" >City:</th>
                <td>
                    <?php echo $userobj['city'] ?>
                </td>
            </tr>

            <tr>
                <th align="left" >State:</th>
                <td>
                    <?php echo $userobj['state'] ?>
                </td>
            </tr>
            <tr>
                <th align="left" >Zip Code:</th>
                <td>
                    <?php echo $userobj['postcode'] ?>
                </td>
            </tr>

            <tr>
                <th align="left" >Country:</th>
                <td>
                    <?php echo $userobj['printable_name'] ?>
                </td>
            </tr>

            <tr valign="bottom">
                <td height="50" colspan="2" align="center">
                    <input type="button" value="Print" onclick="javascript:window.print();"/>
                </td>
            </tr>
        </table>
    </body>
</html>
