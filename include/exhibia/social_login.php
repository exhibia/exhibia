<?php
require("../../config/connect.php");
ini_set('display_errors', 1);


?>
	         <div id="fb_login">
<?php
    if(file_exists("$BASE_DIR/include/addons/facebook/index.php")){
    
       include("$BASE_DIR/include/addons/facebook/index.php");

    }
    if(file_exists("$BASE_DIR/include/addons/twitter/index.php")){
    
       include("$BASE_DIR/include/addons/twitter/index.php");

    }
    if(file_exists("$BASE_DIR/include/addons/google/index.php")){
      include("$BASE_DIR/include/addons/google/index.php");

    }
 ?>
		 </div>
		