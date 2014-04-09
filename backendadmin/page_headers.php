<?php
if(db_query("CREATE TABLE IF NOT EXISTS `tooltips` (   `id` int(11) NOT NULL AUTO_INCREMENT,   `topic` text NOT NULL,   `text` text NOT NULL,   `page` text not null,    KEY `index` (`id`) );")){











}
if(db_num_rows(db_query("SELECT * FROM tooltips")) <= 10){

//db_query("INSERT INTO tooltips values(null, 'Product Code', 'We reccomend using the manufacturer\'s UPC / SKU number to ensure unique product codes', 'addproducts.php');");
//db_query("INSERT INTO tooltips values(null, 'Product Name', 'We reccomend using a unique name for each product you wish to sell, for instance polo shirt is better as red polo shirt. This name must be less than 40 characters though.', 'addproducts.php');");







}



?>
<script>
var template = '<?php echo $template;?>';
</script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title><?php echo $AllPageTitle; ?></title>

        <meta name="description" content="<?php echo $MetaTagsdescripton; ?>"/>

        <meta name="keywords" content="<?php echo $MetaTagskeywords; ?>"/>

        <meta name="verify-v1" content="<?php echo $googleverification; ?>" />

        <?php echo $customtags; ?>
      

     
	<link rel="stylesheet" href="../css/themes/base/jquery.ui.all.css" media="screen,projection" type="text/css" />
	<link rel="stylesheet" href="../css/jquery.countdown.css" type="text/css"/>

   
     

        <script type="text/javascript" src="../js/jquery.js"></script>

        <script type="text/javascript" src="../js/ui/jquery.effects.core.min.js"></script>
        <script type="text/javascript" src="../js/ui/jquery.effects.highlight.min.js"></script>
        <script type="text/javascript" src="../js/ui/jquery-ui-1.8.7.custom.min.js"></script>
        <script type="text/javascript" src="../js/ui/jquery.effects.core.min.js"></script>
        <script type="text/javascript" src="../js/ui/jquery.effects.highlight.min.js"></script>

        <script type="text/javascript" src="../js/coin-slider.min.js"></script>
        <script language="javascript" type="text/javascript" src="../js/function.js"></script>
	<script type="text/javascript" src="../js/auctions_new.js"></script>
        <script type="text/javascript" src="../js/flashauction.js"></script>



        <script language="javascript" src="../js/jqModal.js"></script>
	
 <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="validation.js"></script>
        <script type="text/javascript" src="popupimage.js"></script>
 

<script>


function create_date_picker(id, options, format, thisYear){
if(!thisYear | thisYear == 'thisYear'){
thisYear = '-20:+0';
}

//jQuery('input[type=datetime]').datepicker();
if(!format){
<?php

$jsDate = explode("/", strtolower(Sitesetting::getDateFormat()));
 $realJsDateFormat = '';
$realJsDateFormat = $jsDate[0] . $jsDate[0] . "/" . $jsDate[1] . $jsDate[1] . "/" .$jsDate[2] . $jsDate[2];




?>
format = "<?php echo $realJsDateFormat;?>";
}

if(jQuery(document.getElementById(id))){
try{
jQuery(document.getElementById(id)).datepicker( {     yearRange:thisYear,  dateFormat: format, changeMonth: true, changeYear: true  });
}catch(oops){}
}
}
</script>







        <script language="javascript" type="text/javascript">

            var onlineperbidvalue = '<?php echo $onlineperbidvalue; ?>';
$('#wrapper').css("margin-top", "");
            function hideDisplayBids(id) {

                if(id==1) {
                    $('#producthistory1_hidden').css('display','none');
                    $('#producthistory1').css('display','block');                  

                }

                if(id==2) {
                    $('#producthistory1_hidden').css('display','block');
                    $('#producthistory1').css('display','none');
                    
                }

            }

/* alter dialog box*/
$(document).ready(function(){
        
        $( "#alert_message" ).dialog({
            modal: true,
            autoOpen: false,
            buttons: {
                "Ok": function() {
                    $( this ).dialog( "close" );
                }
            }
        });

        $( "#confirm_message" ).dialog({
            autoOpen: false,
            modal:true,
            resizable:false,
            buttons: {
                "Ok": function() {
                    window.location.href=siteurl+'buybids.php';
                    $( this ).dialog( "close" );
                },
                "Cancel":function(){
                    $( this ).dialog( "close" );
                }
            }
        });

$.getJSON('get_help.php?page=<?php echo basename($_SERVER['PHP_SELF']);?>', function(data) {

  $.each(data.items, function(i,item){
  console.log(i);
  });


});

});

            function ShowMyButler(id) {

                if(id==1) {
                    $('#bidbutler_show_main').css('display', 'block');
                    $('#bidbutler_hide').css('display', 'none');

                }

                if(id==2) {
                    $('#bidbutler_show_main').css('display', 'none');
                    $('#bidbutler_hide').css('display', 'block');

                }

            }

            function addWatchlist(auc_id, uid) {

                var url2="addwatchauction.php";//?aid="+auc_id+"&uid="+uid;
                $.ajax({
                    type: "POST",
                    url: url2,
                    data: {aid:auc_id,uid:uid},
                    success: function(){
                        alert("<?php echo AUCTION_SUCCESSFULLY_ADDED_TO_YOUR_WATCHLIST; ?>");

                        $('#added_watchlist').css('display', 'block');
                        $('#notadded_watchlist').css('display', 'none');
                    }
                });

            }
            function showAlertBox(msg){
$('#alert_message_content').html(msg);
$('#alert_message').dialog('open');
}

function showConfirmBox(msg){
$('#confirm_message_content').html(msg);
$('#confirm_message').dialog('open');
}

function showAutoBidStart(){
showAlertBox('Please enter AutoBidder start price!');
}

function showAutoBidEnd(){
showAlertBox('Please enter AutoBidder end price!');
}

function showAutoBids(){
showAlertBox('Please enter AutoBidder bids!');
}

function showMoreThenOneBids(){
showAlertBox('The bids of the auto bid must be more than one');
}

function showEndGreaterStart(){
showAlertBox('AutoBidder end price must be greater than start price!');
}
function showStartGreaterEnd(){
showAlertBox('AutoBidder start price must be greater than end price for reverse auction!');
}

function showInvalidPrice(){
showAlertBox('Invalid Price');
}

        </script>

                <script language="javascript" src="../js/default.js"></script>