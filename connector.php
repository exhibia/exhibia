<?php
include("config/config.inc.php");

if(!empty($_REQUEST['addon'])){

require("$BASE_DIR/include/addons/$_REQUEST[addon]/api/$_REQUEST[page]");


}
