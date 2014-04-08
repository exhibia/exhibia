<?php

if(file_exists($BASE_DIR . "/include/$template/footer.php")){

include("$BASE_DIR/include/$template/footer.php");

}else{
	switch($template){
	
	  case('pas'):
	    
		  include($BASE_DIR . "/include/footer.php");
	     echo "</div> <!--end main-->";
	  break;
	  case('falconbids'):
	  	  include($BASE_DIR . "/include/' . $template . '/footer.php");
	     echo "</div> <!--end main-->";
	  break;
	  case('sticky'):
	       echo "</div> <!--end main-->";
	  	  include("include/$template/footer.php");
	    
	  break;
	  case('gunbidder'):
	      // echo "</div>";
	  	  include($BASE_DIR . "/include/$template/footer.php");
	  break;
	  case('wavee'):
	       echo "</div> <!--end main-->";
	  	  include($BASE_DIR . "/include/$template/footer.php");
	  break;
	  case('quibids-2.0'):
	       echo "</div> <!--end main-->";
	  	  include($BASE_DIR . "/include/quibids-2.0/footer.php");
	    
	  break;
	  case('dealdash'):
	       echo "</div> <!--end main-->";
	  	  include($BASE_DIR . "/include/dealdash/footer.php");
	    
	  break;
      }
      
 
      ?>
<?php 
}
foreach($addons as $key => $value){

  if(file_exists($BASE_DIR . "/include/addons/$value/footer.php")){
    ?><?php
      include_once($BASE_DIR . "/include/addons/$value/footer.php");
  }
}


?>
<a href="http://pennyauctionsoftwarescript.com"></a>
<a href="http://pennyauctionsoft.com"></a>