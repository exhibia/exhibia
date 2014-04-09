
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->
           <div id="wrapper" class="clearfix" >
                <div id="maincol">
                    <div id="auction-listing">

                        <!-- ============= Live Auctions =============  -->
                        <?php
                        $aid = isset($_GET["aid"]) ? chkInput($_GET["aid"], 'i') : 0;
                        $id = isset($_GET["id"]) ? chkInput($_GET["id"], 'i') : 0;

                         
				if(empty($_REQUEST['aid']) & empty($_REQUEST['id'])){
				include("/home/dev_server/public_html/include/quibids-1.5/allliveauction.php");
                        
                            include("/home/dev_server/public_html/include/quibids-1.5/futureauctions.php");
                       
                            include("/home/dev_server/public_html/include/quibids-1.5/endedauctions.php");



			      }else{
				if ($_REQUEST['aid'] == 2 | $_REQUEST['id'] > 0 | !empty($searchdata))
                            include("/home/dev_server/public_html/include/quibids-1.5/allliveauction.php");
                        if ($_REQUEST['aid'] == 1 || $_REQUEST['id'] > 0)
                            include("/home/dev_server/public_html/include/quibids-1.5/futureauctions.php");
                        if ($_REQUEST['aid'] == 3 || $_REQUEST['id'] > 0)
                            include("/home/dev_server/public_html/include/quibids-1.5/endedauctions.php");



			    }
                        ?>
                        <!-- ============= End Live Auctions =============  -->

                    </div>
                </div>


            </div>
            <div id="wrap-end"></div>
        </div>
        <?php include("$BASE_DIR/include/$template/footer.php") ?>

    
