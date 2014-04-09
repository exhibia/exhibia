
<?php include('config/config.inc.php'); ?>
<div id="right-social">

   
	  

    <ul>
	 
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


