<?php
//To turn off html content change this to no
$enable_html_slider_content = 'no';
//To turn off auction content change this to no
$enable_auction_slider_content = 'yes';
?>
<script type="text/javascript">

    $(document).ready(function(){
        window.blnShowMyAuctionsTab = false;
      //  $('#ezpz-suggestion').ezpz_hint();
        $('#banner-rotator').css('display', 'block');
        //$("#banner-rotator-ads").easySlider({auto:true, continuous:true});
    });

    function showVideo() {
        $().jOverlay({url:'global/promo-video', imgLoading : 'images/ajax-loader.gif'});
    }

</script>
<?php


$uid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : 0;
$changeimage = "home";
$pagename = "index";
if (!isset($_SESSION["ipid"]) && !isset($_SESSION["login_logout"])) {

    $_SESSION["ipid"] = date("Y-m-d G:i:s");

    $_SESSION["ipaddress"] = $_SERVER['REMOTE_ADDR'];



    $qryipins = "Insert into login_logout (ipaddress,load_time) values('" . $_SESSION["ipaddress"] . "', '" . $_SESSION["ipid"] . "')";

    db_query($qryipins) or die(db_error());
}

?>
<div id="banner-rotator" >
      
   <?php include($BASE_DIR . "/include/addons/slider/index.php"); ?>
    <div id="banner-help">
        <div class="help-links">
            <a style="cursor:pointer" onclick="javascript:showVideo()" id="banner_watch_video"></a>
            <a href="registration.php" id="banner_sign_up"></a>
        </div>
    </div>

</div>
   
