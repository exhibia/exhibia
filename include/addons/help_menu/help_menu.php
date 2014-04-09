            <?php
            
            if(!in_array('help_menu', $dont_show)){
              if(db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and admin_user_flag >= 1")) >= 1){
              
              ?>
              <h2 onclick="javascript: add_helptopic('<?php echo basename($_SERVER['PHP_SELF']);?>');">Edit Help Topic</h2>
              
              
              <?php
              }
              ?>
              
   <div id="navigationBox" class="box">
    <h3 class="heading_about_menu"><?php echo NAVIGATION; ?></h3>
    <div class="box-content">        
        <ul>
            <li>                
                <ul>
                <?php
                $sql_m = db_query("select distinct(page) from static_pages order by page asc");
                while($row_m = db_fetch_array($sql_m)){
                ?>
                    <li><?php if($staticvar!=$row_m['page']){?><a href="<?php echo $row_m['page'];?>.php"><?php if(constant(strtoupper($row_m['page']))){ echo ucwords(constant(strtoupper($row_m['page']))); }else{ echo ucwords($row_m['page']); } ?></a><?php } else { ?><span class="red-text-12-b"><?php if(constant(strtoupper($row_m['page']))){ echo ucwords(constant(strtoupper($row_m['page']))); }else{ echo ucwords($row_m['page']); } ?></span><?php } ?></li>
                <?php  
                   }
                   ?>
                    <li><a href="help.php"><?php echo HELP; ?></a></li>
                    <li><?php if($changeimage!="community"){?><a href="community.php"><?php echo COMMUNITY; ?></a><?php } else { ?><span class="red-text-12-b"><?php echo COMMUNITY; ?></span><?php } ?></li>
                </ul>
            </li>            
        </ul>
    </div><!-- /box-content -->
</div><!-- /navigationBox --> 

 <?php } ?>

