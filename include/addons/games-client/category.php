<?php
if(db_num_rows(db_query($index_sql)) == 0){
    $images = server_images($_REQUEST, $games_server);

	    foreach($images as $key => $value){
		if(!empty($images[$key]['icon']) & !empty($images[$key]['link'])){
		  ?>
		  <li style="display:inline!important;float:left;width:120px;margin:10px 20px 5px 0;">
		    <ul>
			<li>
			<a href="games.php?game=<?php echo $images[$key]['link']; ?>" style="text-align:center;">
			  <img src="<?php echo $games_server;?>/uploads/games/page/<?php echo $images[$key]['icon']; ?>" style="width:125px;height:125px;" />
			</li>
			<li>
			<a href="games.php?game=<?php echo $images[$key]['link']; ?>" style="text-align:center;">
			  <?php echo ucfirst($images[$key]['text']);?>
			</a>
			</li>
			
		    </ul>
			<span class="game_preview" id="category_<?php echo $images[$key]['categoryID'];?>"></span>
		  </li>
		  <?php
    
		}
		
	    }




}else{
$sql = db_query("$index_sql and max_players = 1 order by name asc $limit");
if(db_num_rows($sql) >= 1){
?>
<h3>Single Player Games</h3>

<ul>

<?php

while($row = db_fetch_array($sql)){
  //if($row['min_players'] == 1){
    ?>
    <li style="display:inline!important;float:left;width:120px;margin:10px 20px 5px 0;">
      <ul>
	  <li>
	  <a href="games.php?game=<?php echo strtolower(str_replace(" ", "", $row['name'])); ?>" style="text-align:center;">
	    <img src="uploads/games/page/<?php echo $row['picture2']; ?>" style="width:125px;height:125px;" />
	  </li>
	  <li>
	  <a href="games.php?game=<?php echo strtolower(str_replace(" ", "", $row['name'])); ?>" style="text-align:center;">
	    <?php echo ucfirst($row['name']);?>
	  </a>
	  </li>
	  
      </ul>
	  <span class="game_preview" id="category_<?php echo $row['categoryID'];?>"></span>
    </li>
    <?php
  //  }else{
    
    
    
    //}
    

}
echo db_error();

echo db_error();
?>
</ul> 
<?php
}

$sql = db_query("$index_sql and min_players > 1 order by name asc $limit");
if(db_num_rows($sql) >= 1){
?>
<h3>Multi-Player Games</h3>

<ul>

<?php

while($row = db_fetch_array($sql)){
  //if($row['min_players'] == 1){
    ?>
    <li style="display:inline!important;float:left;width:120px;margin:10px 20px 5px 0;">
      <ul>
	  <li>
	  <a href="games.php?game=<?php echo strtolower(str_replace(" ", "", $row['name'])); ?>" style="text-align:center;">
	    <img src="uploads/games/page/<?php echo $row['picture2']; ?>" style="width:125px;height:125px;" />
	  </li>
	  <li>
	  <a href="games.php?game=<?php echo strtolower(str_replace(" ", "", $row['name'])); ?>" style="text-align:center;">
	    <?php echo ucfirst($row['name']);?>
	  </a>
	  </li>
	  
      </ul>
	  <span class="game_preview" id="category_<?php echo $row['categoryID'];?>"></span>
    </li>
    <?php
  //  }else{
    
    
    
    //}
    

}
echo db_error();

echo db_error();
?>
</ul> 
<?php } 

}
?>