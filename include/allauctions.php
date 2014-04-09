
        <div id="main">
                <?php include("header.php"); ?>
            <div id="container">
<?php include("include/topmenu.php"); ?>
<div class="tab-area">
                <div id="column-right">
		    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content" style="position:relative;top:38px;left:-10px;">
                            <?php include("include/categorymenu.php"); ?>
                    </div>
                  
                    <?php
                  
                            if( isset( $_REQUEST["aid"] ) )
										 $aid = $_REQUEST['aid'];
									 else
										 $aid = -1;

									 if( isset( $_REQUEST['id'] ) )
										 $id = $_REQUEST['id'];
									 else
										 $id = -1;

                            if ($aid == 2 || $id >= 0 || $searchdata != "")
                                include("include/allliveauction.php");
                            if ($aid == 1 || $id >= 0)
                                include("include/futureauctions.php");
                            if ($aid == 3 || $id >= 0)
                                include("include/endedauctions.php");

                            if ($aid == 4)
                                include("include/reverseauction.php");
                            if ($aid == 5)
                                include("include/lowestuniqueauction.php");
                    ?>
                        </div><!-- /column-right -->
                        <div id="column-left">
				      <?php include("leftside.php"); ?>
                                </div><!-- /column-left -->
                                </div>
                            </div><!-- /container -->

<?php include("footer.php"); ?>
        </div> <!--end main-->


        <label style="display: none" id="zoomimagename"></label>