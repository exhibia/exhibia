<?php
include("../../../config/connect.php");

?>
    <ul>
    <?php
    
    $sql = db_query("select distinct bingo_winners.winner, avatar from bingo_winners left join registration r on r.username = bingo_winners.winner left join avatar a on a.id=r.avatarid where bingo_winners.winner like '$_REQUEST[username]%' order by instance desc limit 0, 10");
    
      while($row = db_fetch_array($sql)){
      if(empty($row['avatar'])){
      $row['avatar'] = 'default.png';
      }
      ?><li onclick="$('#winners').val('<?php echo $row['winner']; ?>');$('#preview_winners').css('display', 'none');" style="margin:5px;"><img src="uploads/avatars/<?php echo $row['avatar']; ?>" style="width:20px;height:20px;float:left;margin-right:10px;"><?php echo $row['winner']; ?></li><li class="clear"></li><?php
      }
    ?>
    </ul>
	
