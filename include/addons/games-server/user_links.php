<strong><?php echo GAMES; ?></strong>
			    
	    <ul>
                
                <ul class="games">
                
                <?php
            
$sqlgg = db_query("select * from sitesetting where name = 'games'");

while($rowgg = db_fetch_array($sqlgg)){

    ?>
    
		    <li>
			<a href="games.php?game=<?php echo $rowgg['pointer'];?>"><?php echo ucfirst($rowgg['value']);?></a> 
		    </li>
		    
		    <?php } ?>
		</ul>
           </ul>
          
