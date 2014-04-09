<?php
//if(empty($social_shown)){
$social_shown = 'true';
?>
<div id="socialBox" class="box">
    <h3><?php echo SUPPORT_US; ?></h3>
    <div class="box-content">
        <div class="entry">
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
            <a href="<?php echo $socialurl; ?>"><img src="<?php echo "$UploadImagePath/social/".$socialpath; ?>"/></a>
  
            <?php }?>
	                   
        </div>
        <div style="padding:2px;"></div>


	
    </div>
</div>
 
<?php //} ?>