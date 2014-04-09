<?php
require("../config/connect.php");
ini_set('display_errors', 1);


?>
	         <div id="fb_login">
<?php
    if(file_exists("$BASE_DIR/include/addons/facebook/button.php")){
    
       include("$BASE_DIR/include/addons/facebook/button.php");
       echo "<br />";

    }
    if(file_exists("$BASE_DIR/include/addons/twitter/index.php")){
    
       include("$BASE_DIR/include/addons/twitter/index.php");
       echo "<br />";

    }
    if(file_exists("$BASE_DIR/include/addons/google/index.php")){
    
      include("$BASE_DIR/include/addons/google/index.php");

    }
    
 ?>
 <br />
 <a href="registration.php">Sign up with Email</a><br />
 <a href="login.php">Login</a>
		 </div>
		