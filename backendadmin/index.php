<?php
session_start();
if(isset($_SESSION["logedin"])) {
    header("location:innerhome.php");
    exit;
}
include_once("admin.config.inc.php");
include ("config.inc.php");
if(isset($_GET['id']))
    $id=$_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>WelCome To <?php echo $ADMIN_MAIN_SITE_NAME ;?></title>

        <link media="screen" rel="stylesheet" type="text/css" href="css/admin-login.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-login-ie.css" /><![endif]-->
	<link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
        <script type="type/javascript">
            function Process()
            {
                document.all.loading.style.visibility = 'visible';
            }

        </script>
    </head>
    <body>
        <!--[if !IE]>start wrapper<![endif]-->
        <div id="wrapper">
            <!--[if !IE]>start login wrapper<![endif]-->
            <div id="login_wrapper">
                <?php
                if($id==1) {
                    ?>
                <div class="error">
                    <div class="error_inner">
                        <strong>Access Denied</strong> | <span>Invalid Username or Passwor</span>
                    </div>
                </div>
                    <?php }else if($id==2) { ?>
                <div class="error">
                    <div class="error_inner">
                        <strong>Access Denied</strong> | <span>Verify Code Incorrect</span>
                    </div>
                </div>
                    <?php }?>
                <!--[if !IE]>start login<![endif]-->
                <form id="_cti0" action="password.php" method="post">
                    <fieldset>
                        <h1 id="logo"><a href="#">Welcome to <?=$ADMIN_MAIN_SITE_NAME;?></a></h1>
                        <div class="formular">
                            <div class="formular_inner">
                                <div id="loading" class="white system_title">
                                    One moment please. <b>Loading Page..........</b>
                                </div>

                                <label>
                                    <strong>Username:</strong>
                                    <span class="input_wrapper">
                                        <input class="field" id="username" size="25" name="name" />
                                    </span>
                                </label>
                                <label>
                                    <strong>Password:</strong>
                                    <span class="input_wrapper">
                                        <input class="field" id="pass" type="password" size="25" name="pass" />
                                    </span>
                                </label>

                                <label>
                                    <strong>Verify Code:</strong>
                                    <span class="input_wrapper_verify">
                                        <input class="field" id="rndcode" type="text" size="12" name="rndcode" />
                                        <img alt="" src="../CaptchaSecurityImages.php?width=150&height=40&character=6" width="90px" height="24px"/>
                                    </span>
                                </label>

                                <ul class="form_menu">
                                    <li><span class="button"><span><span>Sign In</span></span><input onClick="Process(); if (typeof(Page_ClientValidate) == 'function') Page_ClientValidate(); "  type="submit" name="_ctl1"/></span></li>
                                </ul>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <!--[if !IE]>end login<![endif]-->
            </div>
            <!--[if !IE]>end login wrapper<![endif]-->
        </div>
    </body>
</html>