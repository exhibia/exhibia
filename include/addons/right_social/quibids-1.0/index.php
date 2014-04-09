<?php
if(empty($social_shown)){
$social_shown = 'true';
?>
<?php include('config/config.inc.php'); ?>
<div id="right-social">

   
	  

    <ul>
	  <!--<li>
	    <pazoogle src="http://pazoogle.com/grafton-hills/Admin/Images/share.png" id="pazshare_<?php echo $obj['productID'];?>" method="get" action="ajaxpage" container="share" type="buttonlink" usecount="yes" module="SHARE" clicked="pazshare_<?php echo $obj['productID'];?>"  class="pazoogle-button" href="http://pazoogle.com/grafton-hills/Admin/Modules/FACEBOOK/SHAREALL/index.php?&url=<?php echo $SITE_URL . $_SERVER['REQUEST_URI'];?>&" style="height:45px;width:auto;margin-right:-10px;margin-top:-2px;"></pazoogle>
	    <script>
	    $('#share').dialog({
	    width:500
	    });

	      processPaztags();
	    </script>
	  </li>-->
            <?php
            $socialsql="select * from social_support order by id";
            $socialres=  db_query($socialsql);
            while($social=  db_fetch_array($socialres)){
                $socialname=$social['socialname'];
                $socialpath=$social['socialpath'];
                $socialurl=$social['socialurl'];
                $socialactived=$social['actived'];
                if($socialactived==false){
                    continue;
                }
            
            ?>
            <li style="display:inline;"><a href="<?php echo $socialurl; ?>"><img style="height:25px;width:auto;" src="<?php echo "$UploadImagePath/social/".$socialpath; ?>"/></a></i>
            <?php }?>
            
        </ul>

    
</div>

<?php } ?>
