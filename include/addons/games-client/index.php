<?php

require("$BASE_DIR/config/connect.php");
function server_images($array, $games_server){
    
    $ch = curl_init();
    $str = '';
    foreach($array as $key => $value){
    $str .= "$key=$value&";
    }
    $url = "$games_server/include/addons/games-server/slider.php?$str&output=json";
  
	curl_setopt($ch, CURLOPT_URL,"$url");
	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	//turning off the server and peer verification(TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURL_HTTP_VERSION_1_1, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,POSTVARSCOMPLETE);




	$response = curl_exec($ch);
	$images = json_decode($response, true);


    return $images;
}



?>

<div id="game_area" style="display:block;">
<?php


if(!empty($_REQUEST['game']) | !empty($_REQUEST['gcat'])  ){

	  if(!empty($_REQUEST['gcat'])){
	  
		$lobby_sql = "select * from chat where room = '$_REQUEST[gcat]'";
		$slider_sql = "select picture1 from games where categoryID = $_REQUEST[gcat]";
		$index_sql = "select * from games where categoryID = $_REQUEST[gcat]";
		
		$limit = '';
		
		$data = db_fetch_object(db_query($index_sql));
		$room = $data->name;
		
		include("$BASE_DIR/include/addons/games-client/slider.php");
		
		include("$BASE_DIR/include/addons/games-client/category.php");
	  
	  }
	else{
	
		    if(db_num_rows(db_query("select * from sitesetting where name = '$_REQUEST[game]'")) == 0){
		    
			$settings = server_images($_REQUEST, $games_server);
			
			if($settings[0]['min_players'] >= 2){
				$room = $_REQUEST['game'];
				
				include($BASE_DIR . "/include/addons/games-client/lobby.php");			
			
			}else{
		
			    
			      $room = $_REQUEST['game'];
			      include($BASE_DIR . "/include/addons/games-client/getgame.php");			
			
			
			}
			  
		    
		    }else{
		    if(db_num_rows(db_query("select * from sitesetting where name = '$_REQUEST[game]:min_players' and value >= 2")) == 0){
			  
				
				$room = $_REQUEST['game'];
				include($BASE_DIR . "/include/addons/games-client/getgame.php");
			    }else{
			    
			      $category = db_fetch_object(db_query("select gc.name from games left join game_categories gc on gc.categoryID = games.categoryID where games.name = '$_REQUEST[game]' limit 1"));
			      $room = $category->name;
			      include($BASE_DIR . "/include/addons/games-client/lobby.php");
			  }
			  
			   
                  } 
                  
                  }
                  
                  
               }else if(empty($_REQUEST['game']) & empty($_REQUEST['gcat'])  ){
               
               $lobby_sql = "select * from chat left join games g on g.id = chat.room order by room asc";
	       $slider_sql = "select picture1 from game_categories order by name asc";
	       $index_sql = "select * from game_categories left join games g on g.categoryID=game_categories.categoryID order by name asc";
		$room = 'lobby';
		
               require("$BASE_DIR/include/addons/games-client/slider.php");
              
                                
?>
<ul class="accordion">
<?php

$sql = db_query("select * from game_categories order by name asc");
if(db_num_rows($sql) > 0){

while($row = db_fetch_array($sql)){
  //if($row['min_players'] == 1){
    ?>
    <li style="display:inline!important;float:left;width:120px;margin:10px 20px 5px 0;">
      <ul>
	  <li>
	  <a href="games.php?gcat=<?php echo $row['categoryID'];?>" style="text-align:center;">
	    <img src="uploads/games/page/<?php echo $row['picture2']; ?>" style="width:125px;height:125px;" />
	  </li>
	  <li>
	  <a href="games.php?gcat=<?php echo $row['categoryID'];?>" style="text-align:center;">
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
}else{

    $images = server_images($_REQUEST, $games_server);

	    foreach($images as $key => $value){
		if(!empty($images[$key]['icon']) & !empty($images[$key]['link'])){
		  ?>
		  <li style="display:inline!important;float:left;width:120px;margin:10px 20px 5px 0;">
		    <ul>
			<li>
			<a href="games.php?gcat=<?php echo $images[$key]['categoryID']; ?>" style="text-align:center;">
			  <img src="<?php echo $games_server;?>/uploads/games/page/<?php echo $images[$key]['icon']; ?>" style="width:125px;height:125px;" />
			</li>
			<li>
			<a href="games.php?gcat=<?php echo $images[$key]['categoryID']; ?>" style="text-align:center;">
			  <?php echo ucfirst($images[$key]['text']);?>
			</a>
			</li>
			
		    </ul>
			<span class="game_preview" id="category_<?php echo $images[$key]['categoryID'];?>"></span>
		  </li>
		  <?php
    
		}
		
	    }

}
echo db_error();

echo db_error();
?>
</ul>
<?php } 

?>
</div>