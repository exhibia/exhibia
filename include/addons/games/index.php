<?php
require("../../../config/connect.php");


@db_query("CREATE TABLE if not exists `lobby` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) not null,
  `in_game` varchar(30) NOT NULL default '',
  `timestamp` datetime not null,
  `status` varchar(30) NOT NULL default 'waitting',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;");


@db_query("CREATE TABLE if not exists `games_won` (
  `id` int(11) NOT NULL auto_increment,
  `userid` varchar(30) NOT NULL default 'alerts.png',
  `game` varchar(30) NOT NULL default 'alerts.png',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;");





include($BASE_DIR . "/include/addons/games/config.inc.php");

if(!empty($_REQUEST['game']) | !empty($_REQUEST['gcat'])  ){

	  if(!empty($_REQUEST['gcat'])){
	  
		$lobby_sql = "select * from chat where room = '$_REQUEST[gcat]'";
		$slider_sql = "select picture1 from games where categoryID = $_REQUEST[gcat]";
		$index_sql = "select * from games where categoryID = $_REQUEST[gcat]";
		
		$limit = '';
		
		$data = db_fetch_object(db_query($index_sql));
		$room = $data->name;
		
		include("$BASE_DIR/include/addons/games/slider.php");
		
		include("$BASE_DIR/include/addons/games/category.php");
	  
	  }
	else{
if(!empty($_REQUEST['game']) & file_exists($BASE_DIR . "/include/addons/games/$_REQUEST[game]/index.php")){

		    if(db_num_rows(db_query("select * from sitesetting where name = '$_REQUEST[game]:min_players' and value >= 2")) == 0){
			  include($BASE_DIR . "/include/addons/games/$_REQUEST[game]/config.inc.php");
			  include($BASE_DIR . "/include/addons/games/$_REQUEST[game]/index.php");
			
		      }else{
		      
			include($BASE_DIR . "/include/addons/games/$_REQUEST[game]/lobby.php");
		    }
                                
               }else{
                                
?>
<ul>
<?php
$sql = db_query("select * from sitesetting where name = 'games'");

while($row = db_fetch_array($sql)){

    ?>
    <li><a href="games.php?game=<?php echo $row['value'];?>" style="text-align:center;">
    <img src="include/addons/games/<?php echo $row['value'];?>/icon.png" style="width:150px;height:auto;" />
    <br />
   <?php echo ucfirst($row['value']);?></a>
    </li>
    <?php

}

echo db_error();
?>
</ul>
<?php }
  }
  }

?>