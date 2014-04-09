
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
<script src="<?php echo $SITE_URL;?>js/jquery.jshowoff2.min.js" type="text/javascript"></script>  
  
<!-- PROM BANNERS -->
   
            <div id="commentslider_box">
            
            <div class="jshowoff_comment" >
        
     
            
            
            <?php
        $imgpath = dir($BASE_DIR . '/include/addons/commentbox/img/' . $entry );
        $a = 0;
        while (false !== ($entry = $imgpath->read())) 
		{
		
            if (is_file($imgpath->path . '/' . $entry)) {
                if (preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $entry)) {
                
                $a++;
                    echo '<div class="commentslider-images"><img src="' . $SITE_URL . '/include/addons/commentbox/img/' . $entry . '" /></div>';
                    
                }
            }
        }
        
    ?>

	  
   	      
	</div>
      </div>
        <script type="text/javascript">
        
        
    $(document).ready(function() {
    $('.commentslider-images').each(function(){
    
	$(this).click(function(){
	
	
	    window.location.href = $(this).attr('title');
	
	});
    
    
    });
        $('.jshowoff_comment').jshowoff2({
        cssClass: 'thumbFeatures',
        effect:'none',
        controls: false,
	changeSpeed: 1,
	speed:6000,
        hoverPause : false,
        links:false,
        
        
        });
    });
    // OnloadPageSlider();
       
    </script>
   
    
    


    

    <div class="clear"></div>
   
