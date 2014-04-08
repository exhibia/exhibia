<?php
$sockets = 'enabled';
$template = 'exhibia';
$ds_enabled = '';
if(isset($_SERVER['HTTP_USER_AGENT'])){
    $agent = $_SERVER['HTTP_USER_AGENT'];
}
$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
db_select_db($DATABASENAME, $db);

    ?>
	<script src="http://<?php echo $_SERVER['SERVER_NAME'];?>:8080/socket.io/socket.io.js"></script>
	<?php //} ?>
	 
		<script src="<?php echo $SITE_URL;?>js/jquery-1.9.1.js"></script>
		<script>
		function tryParseJSON (jsonString){
			  try {
			      var o = JSON.parse(jsonString);

			      // Handle non-exception-throwing cases:
			      // Neither JSON.parse(false) or JSON.parse(1234) throw errors, hence the type-checking,
			      // but... JSON.parse(null) returns 'null', and typeof null === "object", 
			      // so we must check for that, too.
			      if (o && typeof o === "object" && o !== null) {
				  return true;
			      }
			  }
			  catch (e) { }

			  return false;
		}
		function usewebsocket(ws){
		      
		    var socket = io.connect('http://<?php echo $_SERVER['SERVER_NAME']; ?>:8080');
			 socket.on('connect', function () { 
			 socket.emit("message", {hello: 'success'});
			 
			  refresh_data = function(){
			      socket.emit("message", {hello: 'success'});
			      setTimeout("refresh_data", 1000);
			      
			   }
			 
			      socket.on('message', function (data) { // TIP: you can avoid listening on `connect` and listen on events directly too!
				//  if(tryParseJSON (data) == true){
			      
				  <?php include($BASE_DIR . "/js/websocket_update.php"); ?>
				//  }
			      });
			      //refresh_data();
			        socket.on('error', function (message) { 
				  <?php include($BASE_DIR . "/js/ajax_update.php"); ?>
				});
			      
			});
			window.onunload = function(){ socket.disconnect()  };
		}
		function use_ajax(ws){
		//  $(document).ready(function(){
		    
			<?php include($BASE_DIR . "/js/ajax_update.php"); ?>
		    
		           window.onunload = function(){ add_timer_break('body'); };
		//    });
		
		  
		}
		  function UpdateLoginLogout() {
			  $(document).ready(function(){
			      $.ajax({
				  type: "GET",
				  url: siteurl+"updatelogin.php",
				  success: function(responseData){
				  }
			      });
			      });
			  }
		</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <?php

if(class_exists('SEOSupport')){

$meta = new SEOSupport();
 if(empty($_GET['share_net'])){
 $other = '';
 
 }else{
 
 $other = "Hey ". ucfirst(str_replace("0", "o", $_GET['share_net'])). " Freinds Check this Out ";
 }
switch(basename($_SERVER['PHP_SELF'])){
    case 'viewproduct.php':
 

    
	$metaTags = $meta->dynamicMeta($_REQUEST['aid'], $other);
	$title = $meta->dynamicTitle($_REQUEST['aid'], $other);
    
    break;
    case 'wonauction.php':
 	$metaTags = $meta->dynamicMeta($_REQUEST['auctionId'], $other);
 	$title = $meta->dynamicTitle($_REQUEST['auctionId'], $other);
    
    break;
    case 'about.php':
	$metaTags = $meta->staticMeta('about');
	$title = "Find Out About ";
    break;
    
    case 'help.php':
	$metaTags = $meta->staticMeta('help');
	$title = "Get Auction Help ";
    break;
    case 'login.php':
    
      $metaTags = $meta->staticMeta('login');
      $title = LOGIN . ' ' . TO . ' ' . $SITE_NM;
    
    break;

    case 'registration.php':
    
      $metaTags = $meta->staticMeta('registration');
      $title = REGISTER . ' ' . ON . ' ' . $SITE_NM;
    
    break;
    case 'rules.php':
    
      $metaTags = $meta->staticMeta('rules');
      $title = $SITE_NM . ' ' . RULES . ' ' . AND_TXT . ' ' . POLICIES; 
    
    break;
    case 'siterules.php':
    
      $metaTags = $meta->staticMeta('rules');
      $title = $SITE_NM . ' ' . RULES . ' ' . AND_TXT . ' ' . POLICIES; 
    
    break;
    
   
    case 'newsletter.php':
    
      $metaTags = $meta->staticMeta('newsletter');
      $title = $SITE_NM . ' ' . RULES . ' ' . AND_TXT . ' ' . POLICIES; 
    
    break;
    case 'privacy.php':
    
      $metaTags = $meta->staticMeta('privacy');
      $title = $SITE_NM . ' ' . RULES . ' ' . AND_TXT . ' ' . POLICIES; 
    
    break;
    case 'forums.php':
    
      $metaTags = $meta->staticMeta('forums');
      $title = $SITE_NM . ' ' . FORUMS; 
    
    break;

    case 'terms.php':
    
      $metaTags = $meta->staticMeta('terms');
      $title = $SITE_NM . ' ' . TERMS_CONDITIONS; 
    
    break;
}


}



if(empty($metaTags)){
?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title><?php if(!empty($_GET['share_net'])){ echo "Hey ". ucfirst($_GET['share_net']) . " Friends Check This Out "; }?><?php echo $AllPageTitle; ?></title>

        <meta name="description" content="<?php if(!empty($_GET['share_net'])){ echo "Hey ". ucfirst($_GET['share_net']) . " Friends Check This Out "; }?><?php echo $MetaTagsdescripton; ?>"/>

        <meta name="keywords" content="<?php echo $MetaTagskeywords; ?>"/>

        <meta name="verify-v1" content="<?php echo $googleverification; ?>" />

        <?php echo $customtags; ?>
        
        <?php
        }else{
        
        ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	      <title><?php echo $title;?> on <?php echo $SITE_NM;?></title>
	      
	      <?php
        foreach($metaTags as $key => $content){
        
	      ?>

              <meta name="<?php echo $key;?>" content="<?php echo $content; ?>" />

      <?php
      
      
      ?>
                          <meta name="verify-v1" content="<?php echo $googleverification; ?>" />

        <?php echo $customtags; ?>
        
        <?php
       } 
       
       
       }
       if(empty($backend)){
       ?>
 	
<base href="<?php echo $SITE_URL;?>" />  

   <?php
   }





    echo db_error();
    ?>
    <?php
  foreach($addons as $key => $value){

	if(file_exists("include/addons/$value/$value" . "_styles.php")){

	    include_once("include/addons/$value/$value" . "_styles.php");

	}


	}
      ?>
      <?php
   if(empty($backend)){

     if(preg_match('/mobile/i', $agent) & file_exists("$BASE_DIR/css/$template-mobile.css")){
     ?>
     
	  <link rel="stylesheet" href="<?php echo $SITE_URL;?>css/<?php echo $template;?>-mobile.css" media="screen,projection" type="text/css" />
      <?php
     
     }else{
    ?>
	 <link rel="stylesheet" href="<?php echo $SITE_URL;?>css/<?php echo $template;?>.css" media="screen,projection" type="text/css" />
    <?php
    }
  }
  ?>
        <!-- JavaScript -->

        <!--[if lte IE 6]><link href="<?php echo $SITE_URL;?>css/menu_ie.css" rel="stylesheet" type="text/css" /><![endif]-->
	<?php
	if(file_exists("$BASE_DIR/css/themes/$template.css")){
	?>
	 <link rel="stylesheet" href="<?php echo $SITE_URL;?>css/themes/<?php echo $template;?>.css" media="screen,projection" type="text/css" />
	<?php }else{ ?>
 	 <link rel="stylesheet" href="<?php echo $SITE_URL;?>css/themes/jquery-ui-1.10.0.custom.min.css" media="screen,projection" type="text/css" />
	<?php } ?>
	<link href="<?php echo $SITE_URL;?>css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
	
	
	<link href="<?php echo $SITE_URL;?>css/jquery.qtip.css" rel="stylesheet" type="text/css" />
	

		<script src="<?php echo $SITE_URL;?>js/preload_images.js"></script>
	
		<script language="javascript" src="<?php echo $SITE_URL; ?>js/gbcf_focus.js"></script>
	<?php

	if(empty($_REQUEST['bust_cache'])){
	?>
	
	<script language="javascript" src="<?php echo $SITE_URL; ?>js/data.php?template=<?php echo $template;?>"></script>
	
	<?php }else{ ?>
	<script language="javascript" src="<?php echo $SITE_URL; ?>js/data.php?template=<?php echo $template;?>&_<?php echo time(); ?>"></script>
	
	<?php } ?>
	<?php if(!empty($_SESSION['userid']) & empty($ckeditor)){ ?>	
	<script type="text/javascript" src="<?php echo $SITE_URL;?>backendadmin/js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo $SITE_URL;?>backendadmin/js/ckeditor/adapters/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $SITE_URL;?>backendadmin/js/ckeditor/config.js"></script>
	<script>
	
	var siteurl = 'http://' + window.location.hostname + '/';
	var template  = '<?php echo $template;?>';
	CKEDITOR.editorConfig = function(config) {
	  var siteurl = 'http://' + window.location.hostname + '/';
	  CKEDITOR.config.filebrowserBrowseUrl = siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/browse.php?type=files';
	  CKEDITOR.config.filebrowserImageBrowseUrl = siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/browse.php?type=images';
	  CKEDITOR.config.filebrowserFlashBrowseUrl = siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/browse.php?type=flash';
	  CKEDITOR.config.filebrowserUploadUrl = siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/upload.php?type=files';
	  CKEDITOR.config.filebrowserImageUploadUrl = siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/upload.php?type=images';
	  CKEDITOR.config.filebrowserFlashUploadUrl = siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/upload.php?type=flash';
	  CKEDITOR.config.baseFloatZIndex = '99999999999';
	  CKEDITOR.config.skin = 'moono';
	  

	  CKEDITOR.config.contentsCss = siteurl + 'css/styles.php?template=' + template + '&page=' + template + '.css' ;
	  
		    CKEDITOR.config.width = 800;
		    CKEDITOR.config.height = 222;
			
		    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;


	};



	</script>
	<?php $ckeditor = 'true'; } ?>
	<?php if(!empty($_SESSION['userid']) & empty($uploader)){ ?>
	<link rel="stylesheet" href="<?php echo $SITE_URL;?>include/addons/uploader/js/fileuploader.css" type="text/css" />
	<script type="text/javascript" src="<?php echo $SITE_URL;?>include/addons/uploader/js/fileuploader.js"></script>
	<?php $uploader = 'true'; } ?>
 		<script src="<?php echo $SITE_URL;?>js/ui/jquery-ui-1.10.3.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo $SITE_URL;?>js/jquery.marquee.min.js"></script>
		<script src="<?php echo $SITE_URL;?>js/ui/jquery.mCustomScrollbar.js"></script>
		
		
		<script src="<?php echo $SITE_URL;?>js/jquery.jshowoff.min.js" type="text/javascript"></script>  
        <?php
	if(preg_match('/mobile/i', $agent) & file_exists("$BASE_DIR/css/$template-mobile.css")){
	  ?>
	  <script>
	  $(document).ready(function(){
	  $('.clear').each(function()
	      $(this).remove();
	   });
	  });
	  </script>
	<?php } ?>
	  
		<script>

		jQuery.uaMatch = function( ua ) {
		ua = ua.toLowerCase();
		var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
		    /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
		    /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
		    /(msie) ([\w.]+)/.exec( ua ) ||
		    ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
		    [];
		return {
		    browser: match[ 1 ] || "",
		    version: match[ 2 ] || "0"
		};
		};
		if ( !jQuery.browser ) {
		matched = jQuery.uaMatch( navigator.userAgent );
		browser = {};
		if ( matched.browser ) {
		    browser[ matched.browser ] = true;
		    browser.version = matched.version;
		}
		// Chrome is Webkit, but Webkit is also Safari.
		if ( browser.chrome ) {
		    browser.webkit = true;
		} else if ( browser.webkit ) {
		    browser.safari = true;
		}
		jQuery.browser = browser;
		}
		</script>
		  

<script language="javascript" type="text/javascript">

  
            function showHide(faq){
                $('#'+faq+'_Content').toggle();
            }



function checkWatchList(){
	var aucids='';
	$('.pin_icon').each(function(i){
	    var id=$(this).attr('id');
	    var ids= id.split('_');
	    if(ids.length>1){
		if(aucids.length>0){
		    aucids+=",";
		}
		$(this).bind('click', function(){
		  addWatchlist(ids[1]);
		  $('#watch_'+ids[1]+' img').attr('src', 'img/red_star.png');
		});
		aucids+=ids[1];
	    }
	})

    
    if(aucids.length==0) return;
    var url="checkwatchlist.php?ids="+aucids;
    //alert(aucids);
    $.ajax({
        type: "GET",
        url: url,
        cache:false,
        dataType:'json',
        success: function(response){
            if(response.message=='ok'){
                data=response.data;
                $('#total_watched').html(response.total);
                $('#won_total_total').html(response.total_wins);
                $('#notifications_total').html(response.announcements);
                $('#bids_count').html(response.bids);
                $('#total_buynow').html(response.total_buynow);
                $('#free_bids_count').html(response.free_bids_count);
                $('#bid_msg').html(response.bid_msg);
             //   $('#cart_total_total').html(response.total_wins);
                $('#won_auctions').html(response.total_wins);
                $.each(data, function(i, item){
		    $('#watch_'+data[i]+' img').prop('src', 'img/red_star.png');
		      if($('#pinicon_'+data[i]).length>0){
			  if($('#pinicon_'+data[i]).hasClass('watching')==false){
				$('#pinicon_'+data[i]).addClass('watching');
			    }
		      }
		});
            }
        },
        error:function(XMLHttpRequest, textStatus, errorThrown){
        //alert(errorThrown);
        }
       
    });
     setTimeout('checkWatchList();', 60000);
}
function addWatchlist(id) {
    var url2="addwatchauction.php";//?aid="+auc_id+"&uid="+uid;
    $.ajax({
        type: "GET",
        url: url2,
        dataType:'json',
        data: {
            aid:id, uid: '<?php echo $_SESSION['userid']; ?>'
        },
        success: function(response){
          
	  checkWatchList();
        }
    });

}
$(document).ready(function(){
checkWatchList();
<?php if($splash == true){ ?>
$('a').addClass('disabled');
$('form').each(function(){
  $(this).prop('action', 'splash.php');

});
$('a').each(function(){
  $(this).prop('href', 'splash.php');

});
$('a').click(function() {
    if($(this).hasClass('disabled')){
        
        window.location.href= 'splash.php';
        }
});

<?php } ?>
        $('#category').change(function(){
            window.location=$(this).val();
        });

        var strSeatDescription = "<?php echo SEAT_AUCTION_DESCRIPTION; ?>";
        
        var nWatchWidth = 135;
        var nWatchX = -66;
    
        var userid = '<?php echo $_SESSION['userid']; ?>';
        <?php
        if(empty($_SESSION['userid'])){
        ?>
        var strWatchTip = "Log in to watch this item";
        var strUnwatchTip = "Log in to watch this item";
        <?php }else{ ?>
        var strWatchTip = "Joel I need an ajax function here";
        var strUnwatchTip = "Joel I need an ajax function here";
        
        
        <?php } ?>
        $('div.unwatched').qtip({
            content: { text: strWatchTip },
            show:{single:true, ready:false },
             position: {
               
            },
            style:{ classes: 'qtip-<?php echo str_replace('.', '', $template); ?>' }
        });

        $('div.watching').qtip({
           
             content: { text: strUnwatchTip },
            show:{single:true, ready:false },
            position: {
               
            },
            style:{ classes: 'qtip-<?php echo str_replace('.', '', $template); ?>' }
        });

        $(".sortable").sortable();
        $(".sortable").disableSelection();
        
         $('.auction_box_normal_view_pin_icon_normal').click(function(){

        if($(this).hasClass('auction_box_normal_view_pin_icon_over')){
            $(this).addClass("auction_box_normal_view_pin_icon_normal");
            $(this).removeClass("auction_box_normal_view_pin_icon_over");
        }else{

            $(this).removeClass("auction_box_normal_view_pin_icon_normal");
            $(this).addClass("auction_box_normal_view_pin_icon_over");
        }
//
    });
//
//
$('.cleardefault').bind('click, focus', function(){
  $(this).val('');
});
    $("#sortable2").sortable();
    $("#sortable2").disableSelection();

    $('.auction_box_easy_view_pin_icon_normal').click(function(){

        if($(this).hasClass('auction_box_easy_view_pin_icon_normal')){

            $(this).addClass("auction_box_easy_view_pin_icon_over");
            $(this).removeClass("auction_box_easy_view_pin_icon_normal");
        }else{

            $(this).removeClass("auction_box_easy_view_pin_icon_over");
            $(this).addClass("auction_box_easy_view_pin_icon_normal");
        }

    });
        
        
        $('#how_it_works').hover(
        function(){
            $(this).toggleClass('btn_how_it_works_home_normal',false);
            $(this).toggleClass('btn_how_it_works_home_over',true);
        }, function(){
            $(this).toggleClass('btn_how_it_works_home_normal',true);
            $(this).toggleClass('btn_how_it_works_home_over',false);
        });

        $('#l_invite_friends').hover(
        function(){
            $(this).toggleClass('btn_login_box_invite_friend_normal',false);
            $(this).toggleClass('btn_login_box_invite_friend_over',true);
        }, function(){
            $(this).toggleClass('btn_login_box_invite_friend_normal',true);
            $(this).toggleClass('btn_login_box_invite_friend_over',false);
        }).click(function(){
            window.location='<?php echo $SITE_URL; ?>affiliate.php';
        });

        $('#how_it_works').click(function(){
            window.location='<?php echo $SITE_URL; ?>help.php';
        });
 $("#marquee").marquee();
    });
</script>
<script language="javascript" type="text/javascript">

    function _delete_login_fields(_field, _default, _current) { try{if (_default == _current) { _field.value=''; }}catch(p){} }
 




  
var template = '<?php echo $template; ?>';


            var onlineperbidvalue = '<?= $onlineperbidvalue; ?>';
            reloadWhenEnd=false;

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

</script>


  
      


 <?php
/* live support */
// create session so we can keep track of users



if(in_array('livesupport', $addons)){

$banippath = 'include/addons/easy-ban-ip/ban/';

include_once "include/addons/easy-ban-ip/ban/ban.php";

// define path to support directory
$livesupportpath = "include/addons/livesupport/";
// include php
include $livesupportpath . "includes/client.php";
/* live support */

//define the juice
}

define("IN_WOL", true);
if(in_array('whosonline', $addons)){
$onlinepath = 'include/addons/whosonline/';
//include the config
require_once($onlinepath . "assets/config.php");

if (isset($_SESSION["userid"])) {
//add users and remove inactive ones
    $wol->userRecorder(time(), $_SESSION["username"], $wol->pageLocator());
} else {
    $wol->userRecorder(time(), false, $wol->pageLocator());
}

}

?>


<link rel="shortcut icon" type="image/x-icon" href="<?php echo $SITE_URL;?>favicon.ico" />
<!--link rel="icon" href="<?php echo $SITE_URL;?>animated_favicon.gif" type="image/gif" -->


<?php
if (isset($_SESSION['url']) && $_SESSION['url'] != $SITE_URL) {
    session_destroy();
?>
    <script language="javascript">window.location.href="<?php echo $SITE_URL; ?>index.php";</script>
<?php
    exit;
}



?>
<script>

    $(document).ready(function(){
  
        $('#category, #auc_cat').change(function(){
            window.location=$(this).val();
        });

       
    });

            function CheckForum()
            {
                if(document.postthread.title.value=="")
                {
                    alert("<?php echo PLEASE_ENTER_TOPIC_TITLE; ?>");
                    document.postthread.title.focus();
                    return false;
                }
                if(document.postthread.post_body.value=="")
                {
                    alert("<?php echo PLEASE_ENTER_TOPIC_CONTENT; ?>");
                    document.postthread.post_body.focus();
                    return false;
                }
            }
            
            $('#delivery_country').change(function(){
		    $('#delivery_state option').each(function(){
		    
			if($(this).attr('title') != $('#delivery_country').val()){
			    $(this).css('display', 'none');
			
			}else{
			    $(this).css('display', 'block');
			
			}
            
		    });
            
            });
            
            $('#country').change(function(){
		    $('#state option').each(function(){
		    
			if($(this).attr('title') != $('#country').val()){
			    $(this).css('display', 'none');
			
			}else{
			    $(this).css('display', 'block');
			
			}
            
		    });
            
            });

      function change_bidpack(id){
	  $.ajax({
	      url: 'bidpack_details.php',
	      data: { id: id },
	      dataType: 'json',
	      type: 'get',
	      success: function(response){
		  $('#bid_price').html(' <?php echo $Currency; ?>' + parseFloat(response.bid_price));
		  $('#pkg').val(response.id);
		  $('#bidpack_submit').prop('disabled', false);
		  $('#bidpackid').val(response.bidpackid);
		  $('#buybids').val(response.bidpackid);
	      }
	  });
      
      }							
</script>

<?php

  foreach($addons as $key => $value){

  if(file_exists("include/addons/$value/$value" . "_headers.php")){


	include_once("include/addons/$value/$value" . "_headers.php");

  }


  }
 
if(file_exists("include/addons/user_levels/login.php")){
include_once("include/addons/user_levels/login.php");

}

if(function_exists('extra_css_for_template')){
extra_css_for_template($BASE_DIR, $template);
}




if(strlen(strstr($agent,"Firefox")) > 0 ){ 

  $browser = 'firefox';

}else if(strlen(strstr($agent,"Chrome")) > 0 ){ 

  $browser = 'chrome';

}else if(strlen(strstr($agent,"Safari")) > 0 ){ 

  $browser = 'safari';

}else if(strlen(strstr($agent,"MSIE")) > 0 ){ 

  $browser = 'explorer';

}
if($browser != 'firefox'){
?>
<style>
.chrome_ul{
top:15px!important
}
</style>
<?php
}
switch($browser){

   case('firefox'):
   if(file_exists($BASE_DIR . "/css/" . $template . "-firefox.css")){
   ?>
    <link rel="stylesheet" href="<?php echo $SITE_URL;?>css/<?php echo $template;?>-firefox.css" media="screen,projection" type="text/css" />
   <?php
   }
   break;
   case('safari'):
   if(file_exists($BASE_DIR . "/css/" . $template . "-safari.css")){
   ?>
    <link rel="stylesheet" href="<?php echo $SITE_URL;?>css/<?php echo $template;?>-safari.css" media="screen,projection" type="text/css" />
   <?php
   }
   break;
   case('explorer'):
   if(file_exists($BASE_DIR . "/css/" . $template . "-explorer.css")){
   ?>
    <link rel="stylesheet" href="<?php echo $SITE_URL;?>css/<?php echo $template;?>-explorer.css" media="screen,projection" type="text/css" />
   <?php
   }
   break;
   case('chrome'):
   if(file_exists($BASE_DIR . "/css/" . $template . "-chrome.css")){
   ?>
    <link rel="stylesheet" href="<?php echo $SITE_URL;?>css/<?php echo $template;?>-chrome.css" media="screen,projection" type="text/css" />
   <?php
   }
   break;
}
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $googleverification; ?>', '<?php echo $_SERVER['SERVER_NAME']; ?>');
  ga('send', 'pageview');

</script> 
<style>
div.auction-item p.timerbox, .auction-item label.endingtimer, .auction-item span.counter_index_page, .auction-item label.counter_index_page {
 
  height: 30px !important;
  
}
div.product-box div.product-content:first-child {

  height: 260px;
 
}
div.product-box:last-child {
 
  max-height: 200px;
  
}
</style>
		
<script src="<?php echo $SITE_URL;?>js/jquery.qtip.min.js"></script>		
<?php
include("$BASE_DIR/include/addons/cometchat/page_headers.php");
?>