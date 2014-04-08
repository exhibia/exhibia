<?php
include("config/connect.php");
include_once 'common/sitesetting.php';

include("functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('page_headers.php'); ?>
        <link rel="stylesheet" href="css/EA_Form.css" media="screen,projection" type="text/css" />
        <link rel="stylesheet" href="css/inviter.css" media="screen,projection" type="text/css" />


        <script language="javascript" src="js/pwd_strength.js" type="text/javascript"></script>

    </head>
    <body class="single">
        <div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                <div id="column-left">
                    <!-- last winner -->
                    <?php include("leftside.php"); ?>
                </div><!-- /column-left-->
                <div id="column-right">
                    <div id="registerBox" class="content">
                        <h2><span><?php echo "Invite Friends"; ?></span></h2>

                        <?php
                        if (Sitesetting::isEnableInviter()) {
                            include 'inviter.php';
                        } else {
                            echo "Inviter feature is disabled";
                        }
                        ?>

                    </div><!-- /content -->
                </div><!-- /column-right -->
            </div><!-- /container -->
<?php include("footer.php"); ?>
        </div><!-- /main -->
    </body>
</html>