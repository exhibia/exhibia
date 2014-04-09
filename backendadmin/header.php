<?php
include_once("session.php");
if(isset($_SESSION['UsErOfAdMiN']))
    $UsErOfAdMiN=$_SESSION['UsErOfAdMiN'];

//$active=$_GET['active'];
?><!-- Original:   (support@Pennyauctionsoft.com) This tag should not be removed-->
<!--Server time ticking clock v2.0 Updated by js-x.com-->

<link type="text/css" href="css/jquery.qtip.css" rel="stylesheet" />
	
<script type="text/javascript">

    function MakeArrayday(size)
    {
        this.length = size;
        for(var i = 1; i <= size; i++)
            this[i] = "";
        return this;
    }
    function MakeArraymonth(size)
    {
        this.length = size;
        for(var i = 1; i <= size; i++)
            this[i] = "";
        return this;
    }

    var hours;
    var minutes;
    var seconds;
    var timer=null;
    function sClock(hours1,minutes1,seconds1)
    {
        hours=parseInt(hours1);
        minutes=parseInt(minutes1);
        seconds=parseInt(seconds1);
        if(timer){clearInterval(timer);timer=null;}
        timer=setInterval("work();",1000);
    }

    function twoDigit(_v)
    {
        if(_v<10)_v="0"+_v;
        return _v;
    }

    function work()
    {
        if (!document.layers && !document.all && !document.getElementById) return;
        var runTime = new Date();
        var dn = "AM";
        var shours = hours;
        var sminutes = minutes;
        var sseconds = seconds;
        if (shours >= 12)
        {
            dn = "PM";
            shours-=12;
        }
        if (!shours) shours = 12;
        sminutes=twoDigit(sminutes);
        sseconds=twoDigit(sseconds);
        shours  =twoDigit(shours  );
        movingtime = ""+ shours + ":" + sminutes +":"+sseconds+" " + dn;
        if (document.getElementById){
            document.getElementById("clock").innerHTML=movingtime;
	    try{
	    if(document.getElementById("clock2")){
	                document.getElementById("clock2").innerHTML=movingtime;
		}
			}catch(o){}
			}
        else if (document.layers)
        {
            document.layers.clock.document.open();
            document.layers.clock.document.write(movingtime);
            document.layers.clock.document.close();
        }
        else if (document.all)
            clock.innerHTML = movingtime;

        if(++seconds>59)
        {
            seconds=0;
            if(++minutes>59)
            {
                minutes=0;
                if(++hours>23)
                {
                    hours=0;
                }
            }
        }
    }
      $.get('curl.php?url=<?php echo urlencode("http://pennyauctionsoft.com/licenseadminpanel/license.php?id=13&domain=$_SERVER[SERVER_NAME]&ip=$_SERVER[SERVER_ADDR]"); ?>',
	
	    function(result){
//	      console.log("http://pennyauctionsoft.com/licenseadminpanel/license.php?script=13&domain=<?php echo "$_SERVER[SERVER_NAME]&ip=$_SERVER[SERVER_ADDR]"; ?>");
		$('#paypal_area').html(result);
	    
	    }
	);
 
  
	window.onload=function load(){sClock('<?php echo date("G");?>','<?php echo date("i");?>','<?php echo date("s");?>');}
</script>
<!--[if !IE]>start logo and user details<![endif]-->

 <div id="logo_user_details">
   <div id="paypal_area" style="position:absolute;top:30px;right:250px;z-index:5000;"> </div>
   <div id="notification_area" style="position:absolute;top:30px;right:650px;z-index:5000;"></div>
    <h1 id="logo"><a href="innerhome.php">websitename Administration Panel</a></h1>
    <!--[if !IE]>start user details<![endif]-->
    <div id="user_details">
        <ul id="user_details_menu">
            <li>Welcome <strong><?php echo $UsErOfAdMiN; ?></strong></li>
            <li>
                <ul id="user_access">
                    <li class="first"><a href="inneraccount.php">My account</a></li>
                    <li class="last"><a href="../livesupport/admin.php" target="_blank">Live Support</a></li>
                    <li class="last"><a href="logout.php">Log out</a></li>
                </ul>
            </li>
            
            
            
        </ul>
        <div id="server_details">
            <dl>
                <dt>Server time :</dt>
                <dd><span id="clock"></span></dd>
            </dl>
            <dl>
                <dt>Date :</dt>
                <dd><?php echo date($globalDateformat); ?></dd>
            </dl>
        </div>
        
        
        <!--[if !IE]>start search<![endif]-->
         <!--
        <div id="search_wrapper">
            <form action="#">
                <fieldset>
                    <label>
                        <input class="text" name="" type="text" />
                    </label>
                    <span class="go"><input name="" type="submit" /></span>
                </fieldset>
            </form>
            <ul id="search_wrapper_menu">
                <li class="first"><a href="#" title="advanc">Advanced Search</a></li>
                <li class="last"><a href="#">Admin Map</a></li>
            </ul>
        </div>
	-->
        <!--[if !IE]>end search<![endif]-->
        
    </div>
    <!--[if !IE]>end user details<![endif]-->
</div>

<!--[if !IE]>end logo end user details<![endif]-->
<!--[if !IE]>start menus_wrapper<![endif]-->
<div id="menus_wrapper">
    <div id="main_menu">
        <ul>
            <?php
            include_once 'headlinks.txt.php';

            $HeaderLinksSize = sizeof($HeadLinksArray);
            $submenufile='';
            for($i=0;$i<$HeaderLinksSize;$i++) {

                $LinkTitle = $HeadLinksArray[$i][0];
                $HREF = $HeadLinksArray[$i][1];

                $target='';
                if(isset($HeadLinksArray[$i][4])){
                    $target=$HeadLinksArray[$i][4];
                }
                
                ?>
                <?php if($active==$LinkTitle) {
                    $submenufile=$HeadLinksArray[$i][3];
                    
                    ?>
            <li><a href="<?php echo $HREF; ?>" target="<?php echo $target; ?>" class="selected"><span><span><?php echo $LinkTitle; ?></span></span></a></li>
                    <?php }else if($i+1==$HeaderLinksSize) { ?>
            <li ><a href="<?php echo $HREF; ?>" target="<?php echo $target; ?>"><span><span><?php echo $LinkTitle; ?></span></span></a></li>
                    <?php }else { ?>
            <li><a href="<?php echo $HREF; ?>" target="<?php echo $target; ?>"><span><span><?php echo $LinkTitle; ?></span></span></a></li>
                    <?php } ?>
                <?php  } ?>

	  <?php if(is_dir('../../include/addons/autolister')){ ?>

	    <li><a href="autolister.php" target="<?php echo $target; ?>"><span><span>Autolister</span></span></a></li>
	  <?php } ?>
 	  <li class="last" class="tooltip" title="<?php echo str_replace(".php", "", basename($_SERVER['PHP_SELF']));?>"><a href="http://pennyauctionsoftdemo.com/PREINSTALL/user_help.php?page=<?php echo basename($_SERVER['SCRIPT_FILENAME']);?>"
target="_blank"><span><span>Help</span></span></a></li>
        </ul>
    </div>

    <?php if(strlen($submenufile)>0) {
        $currentPage = $_SERVER["PHP_SELF"];
        include_once $submenufile;
        ?>

    <div id="sec_menu">
        <ul>
                <?php
                $ChildLinksSize = sizeof($ChildLinksArray);
                 $currentPage = $_SERVER["REQUEST_URI"];
                for ( $j=0; $j<$ChildLinksSize && $j<7; $j++ ) {
                    $subTitle=$ChildLinksArray[$j][0];
                    $subHref=$ChildLinksArray[$j][1];
                    $target=isset($ChildLinksArray[$j][5])?$ChildLinksArray[$j][5]:'';
                    ?>
            <li><a href="<?php echo $subHref; ?>" target="<?php echo $target; ?>" class="<?php echo $ChildLinksArray[$j][4]; ?> <?php echo strpos($currentPage,$subHref)!=false?'selected':''; ?>"><?php echo $subTitle; ?></a></li>
                    <?php }
                    if($j==7){
                    ?>
            <li>

                <span class="drop"><span><span><a href="#" class="sm8">More</a></span></span></span>
                <ul>
                    <?php for(;$j<$ChildLinksSize;$j++){
                        $subTitle=$ChildLinksArray[$j][0];
                    $subHref=$ChildLinksArray[$j][1];
                    $target=isset($ChildLinksArray[$j][5])?$ChildLinksArray[$j][5]:'';
                        ?>
                    <li><a target="<?php echo $target; ?>" class="<?php echo $ChildLinksArray[$j][4]; ?> <?php echo strpos($currentPage,$subHref)!=false?'selected':''; ?>" href="<?php echo $subHref; ?>"><?php echo $subTitle; ?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php }?>
        </ul>
    </div>
        <?php } ?>
</div>

<!--[if !IE]>end menus_wrapper<![endif]-->
