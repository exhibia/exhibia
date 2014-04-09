<?php
ini_set('display_errors', 1);
$json_script == 'true';
include("../config/config.inc.php");
include_once $BASE_DIR . '/common/sitesetting.php';
$defaultlanguage=Sitesetting::getLanguage();
Sitesetting::setLanguage();
//include($BASE_DIR . "/session.php");
//include($BASE_DIR . "/functions.php");
$PRODUCTSPERPAGE_MYACCOUNT = 5;

$uid = $_REQUEST["uid"];
include($BASE_DIR . "/Functions/arrangedate.php");
include($BASE_DIR . "/Functions/cornerImag.php");
include($BASE_DIR . "/Functions/getTotalPlaceBids.php");
include($BASE_DIR . "/Functions/getBidHistory.php");

//include_once $BASE_DIR . '/common/seosupport.php';
  

          
	?>
	<style>
	
	#myqb {
				font-family : Arial;
	}
	#myqb h1 {
				font-family : "HelveticaRounded LT Std Bd";
				color : navy;
				margin : 0;
				padding : 0;
				font-size : 20px;
				font-weight : bold;
	}
	#myqb p {
				font-size : 13px;
				color : #5c5c5c;
				font-weight : normal;
	
				margin : 0;
				border-bottom : 5px solid #ededed;
				border-left : 5px solid #ededed;
				border-right : 5px solid #ededed;
	}
	#myqb-auctions-head {
				background : url(../css/ajaxy/myqb-auctions-head-bg.png) repeat-x;
				height : 37px;
				font-size : 13px;
				color : #5c5c5c;
	}
	#myqb-auction-body {
				padding : 10px 0px 0 0px;
	}
	#pagination2-container {
				height : 35px;
				background : #eeeeee;
				margin : 10px 0 0 0;
				padding : 0px;
				line-height : 35px;
				text-align : right;
				padding-right : 10px;
	}
	.live-auction {
				width : 700px;
				margin : 0px auto 10px auto;
				height : 140px;
				background : url(../css/ajaxy/myQuibids-liveauctions-bg.png) no-repeat;
				background-size: 700px 140px!important;
				background-repeat:no-repeat;
	}
	.live-auction h4 {
				margin : 0px;
				color : #5c5c5c;
				font-size : 18px;
				font-weight : bold;
				background : none;
				height : 110px;
				text-align : center;
				line-height : 110px;
	}
	.grid {
				background : #f7f7f7!important;
	}
	a.buy {
				width : 121px;
				height : 26px;
				padding-top : 5px;
				display : inline-block;
				margin-left : 10px;
				margin-top : 15px;
				background : url(../css/ajaxy/pay-now-btn.png) left top no-repeat;
	}
	a.buypaynow {
				width : 121px;
				height : 26px;
				padding-top : 5px;
				display : inline-block;
				margin-left : 10px;
				margin-top : 15px;
				background : url(../css/ajaxy/pay-now-btn.png) left top no-repeat;
	}
	a.buy:hover {
				width : 121px;
				height : 26px;
				padding-top : 5px;
				display : inline-block;
				margin-left : 10px;
				background : url(../css/ajaxy/pay-now-btn.png) left bottom no-repeat;
	}
	.thumb {
				width : 120px;
				height : 90px;
	}
	.live-auction .live-a-content {
				padding : 0;
				width : 666px;
	
				margin : 0;
				padding : 13px 0 11px 20px;
	
				
				margin : 0;
				font-size : 11px;
				color : #363636;
	}
	.live-auction .countdown {
				margin : -25px 0px 0px 550px;
				padding : 0px;
				width : 145px;
	}
	.live-auction a.login {
				background : url(../css/ajaxy/login-register-btn-bg.gif);
	}
	.live-auction .price-bidder {
				margin: -25px 0 0 270px;
				padding: 0;
				text-align: center;
				width: 125px;
	}
	#live-auctions-end {
				background : url(../css/ajaxy/myQuibids-liveauctions-bg-end.png);
				height : 49px;
				text-align : right;
	}
	#myqb-auctions-head #thumbheader {
				width : 120px;
				float : left;
				display : block;
	}
	#myqb-auctions-head #product_title {
				width : 276px;
				padding : 0;
				height : 37px;
				line-height : 37px;
				float : left;
	}
	#myqb-auctions-head #price_title {
				width : 125px;
				text-align : center;
				height : 37px;
				line-height : 37px;
				float : left;
	}
	#myqb-auctions-head #countdown_title {
				width : 145px;
				text-align : center;
				height : 37px;
				line-height : 37px;
				float : left;
				text-transform : uppercase;
	}
	.live-a-content h2 {
				margin: 0;
	}
	</style>
                            <div id="myqb-wrap">
                                <div id="myqb">
                                    <?php
                                    include("actual_bids.php");
                                    ?>


                                    <?php 
                                    include("free_bids.php");
                                    ?>

                                                    <!--end free bid-->

                                                    <!-- place bid-->

                                    <?php
                                                   
                                                   
                                                   include("placed_bids.php");
                                                   
                                                   ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>