
        <ul id="right-social">
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
            <li><a href="<?php echo $socialurl; ?>"><img src="<?php echo "$UploadImagePath/social/".$socialpath; ?>"/></a></li>
  
            <?php }?>
	                   
        </ul>
 
