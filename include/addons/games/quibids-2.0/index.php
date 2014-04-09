<ul>
<?php
include("../../../config/connect.php");

include($BASE_DIR . "/include/addons/games/config.inc.php");


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