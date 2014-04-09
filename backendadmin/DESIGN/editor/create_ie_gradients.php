<?php
$return = array();

		  $svg_sring .= '<?xml version="1.0" ?><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1 1" preserveAspectRatio="none"><linearGradient id="grad-ucgg-generated" gradientUnits="userSpaceOnUse" x1="0%" y1="0%" x2="0%" y2="100%">';
			    
			    foreach($_REQUEST['color'] as $key => $value){
			       $svg_sring .= '<stop offset="' . $_REQUEST['c_offset'][$key] . '%" stop-color="' . $_REQUEST['color'][$key] . '" stop-opacity="1"/>';
			      
			      }
			    
			    $svg_sring .= '</linearGradient>
			    <rect x="0" y="0" width="1" height="1" fill="url(#grad-ucgg-generated)" />
			  </svg>';
		    
		    
		     $svg_sring = base64_encode($svg_sring);
		     
		     
		     $svg_sring = "url(data:image/svg+xml;base64,$svg_sring)";
		     
		     
$return['svg'] = $svg_sring;		     
		     
		     
$return['filter'] = "progid:DXImageTransform.Microsoft.gradient( startColorstr='" . $_REQUEST['color'][0] . "',  endColorstr='" . $_REQUEST['color'][1] . "',GradientType=0 );"; 
			  
	echo $return['filter'];		  

echo json_encode($return);