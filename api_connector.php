<?php
include("config/connect.php");
$games_folder = "$BASE_DIR/include/addons/games/";

//This will send game and other settings back to the master games server as json so that payouts and such will be set by the owner of this site


if(!empty($_REQUEST['game'])){

 if(!empty($_REQUEST['check_payout'])){
 
 include("$games_folder$_REQUEST[game].payout.php");
 
 }else{
 
  include("$games_folder$_REQUEST[game].config.inc.php");
 
 }

}else if(!empty($_REQUEST['master_game_settings'])){



include("$BASE_DIR/include/addons/games/config.inc.php");
echo json_encode($master_game_settings);




}