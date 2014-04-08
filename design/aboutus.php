<?

include("config/connect.php");

include("functions.php");



$staticvar = "about";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <?php include('page_headers.php'); ?>

    </head>



    <body class="single">
        <div id="main">
            <?
            include("header.php");
            ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>

                <div id="column-right">

                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><strong><?=$SITE_NM;?> - <?php echo ABOUT_US; ?></strong></p>
                    </div><!-- /title-category-content -->

                    <div class="rounded_corner">
                        <div class="content">
                            <?

                            $rssel = db_query("select content from static_pages where id=2");

                            echo (db_num_rows($rssel) > 0 ? stripslashes(db_result($rssel, 0)) : "");

                            db_free_result($rssel);

                            ?>
                        </div>

                    </div>
                </div>
                <div id="column-left">
                    <?php include("leftstatic.php"); ?>
                    <img src="img/icons/credit-cards.gif" alt="" />
                </div><!-- /column-left -->
            </div>

            <?
            include("footer.php");
            ?>
        </div>
    </body>
</html>