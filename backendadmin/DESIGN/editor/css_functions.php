<?php

function rgb2html($color)
{
if(!preg_match('/#(.*)/', $color)){
$rgb = explode(",", $color);
    
    
    $r = $rgb[0];
    $g = $rgb[1];
    $b = $rgb[2];
    
    if (is_array($r) && sizeof($r) == 3)
        list($r, $g, $b) = $r;

    $r = intval($r); 
    $g = intval($g);
    $b = intval($b);

    $r = dechex($r<0?0:($r>255?255:$r));
    $g = dechex($g<0?0:($g>255?255:$g));
    $b = dechex($b<0?0:($b>255?255:$b));

    $color = (strlen($r) < 2?'0':'').$r;
    $color .= (strlen($g) < 2?'0':'').$g;
    $color .= (strlen($b) < 2?'0':'').$b;
    return '#'.$color;
  }else{
  
      return $color;
  }

return $color;
}








function get_values($grad_type, $browser, $css_rule){

//Function to get color values
$values = array();
    switch($grad_type){
    
	case('linear'):
	
	    switch($browser){
	    
		case('webkit'):
		      //top, #ffffff 0%, #f3f3f3 50%, #ededed 51%, #ffffff 100%
		      $values_out = explode(", rgb(", $css_rule);
		     
		      foreach($values as $value){
		      
			$value = ltrim(rtrim($value));
		      }
		      
		     
		      $values['start_from'] = $values_out[0];
		    
		      $values_2 = explode(") ", $values_out[1]);
		      
		      $values['type'] = 'linear';
		      $values['start_color'] = $values_2[0];
		     
		      $values['start_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		    
		      $values['mid_color'] = rgb2html("$values_2[0]");
		     
		      $values['mid_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		      
		      
		     
		      $values['end_color'] = rgb2html("$values_2[0]");
		   
		      $values['end_perc'] = $values_2[1];
		break;
		case('moz'):
		//-moz-linear-gradient(50% 0%, rgb(217, 32, 32), rgb(229, 18, 18))
		      $values_out = explode(", rgb(", $css_rule);
		  
		      foreach($values as $value){
		      
			$value = ltrim(rtrim($value));
		      }
		      
		      $values['type'] = 'linear';
		      $values['start_from'] = $values_out[0];
		    
		      $values_2 = explode(") ", $values_out[1]);
		      
		      
		      $values['start_color'] = $values_2[0];
		      
		      $values['start_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		     
		      $values['mid_color'] = rgb2html("$values_2[0]");
		     
		      $values['mid_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		      
		      
		      
		      $values['end_color'] = rgb2html("$values_2[0]");
		    
		      $values['end_perc'] = $values_2[1];
		      
		break;	    
		case('khtml'):
		      $values_out = explode(", rgb(", $css_rule);
		     
		      foreach($values as $value){
		      
			$value = ltrim(rtrim($value));
		      }
		      
		      $values['type'] = 'linear';
		      $values['start_from'] = $values_out[0];
		    
		      $values_2 = explode(") ", $values_out[1]);
		      
		      
		      $values['start_color'] = $values_2[0];
		      
		      $values['start_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		     
		      $values['mid_color'] = rgb2html("$values_2[0]");
		     
		      $values['mid_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		      
		      
		      
		      $values['end_color'] = rgb2html("$values_2[0]");
		    
		      $values['end_perc'] = $values_2[1];
		break;
		      $values_out = explode(", rgb(", $css_rule);
		     
		      foreach($values as $value){
		      
			$value = ltrim(rtrim($value));
		      }
		      
		      $values['type'] = 'linear';
		      $values['start_from'] = $values_out[0];
		    
		      $values_2 = explode(") ", $values_out[1]);
		      
		      
		      $values['start_color'] = $values_2[0];
		      
		      $values['start_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		     
		      $values['mid_color'] = rgb2html("$values_2[0]");
		     
		      $values['mid_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		      
		      
		      
		      $values['end_color'] = rgb2html("$values_2[0]");
		    
		      $values['end_perc'] = $values_2[1];
		case('o'):
		      $values_out = explode(", rgb(", $css_rule);
		     
		      foreach($values as $value){
		      
			$value = ltrim(rtrim($value));
		      }
		      
		      $values['type'] = 'linear';
		      $values['start_from'] = $values_out[0];
		    
		      $values_2 = explode(") ", $values_out[1]);
		      
		      
		      $values['start_color'] = $values_2[0];
		      
		      $values['start_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		     
		      $values['mid_color'] = rgb2html("$values_2[0]");
		     
		      $values['mid_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		      
		      
		      
		      $values['end_color'] = rgb2html("$values_2[0]");
		    
		      $values['end_perc'] = $values_2[1];
		break;		
		case('ms'):
		      $values_out = explode(", rgb(", $css_rule);
		     
		      foreach($values as $value){
		      
			$value = ltrim(rtrim($value));
		      }
		      
		      $values['type'] = 'linear';
		      $values['start_from'] = $values_out[0];
		    
		      $values_2 = explode(") ", $values_out[1]);
		      
		      
		      $values['start_color'] = $values_2[0];
		      
		      $values['start_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		     
		      $values['mid_color'] = rgb2html("$values_2[0]");
		     
		      $values['mid_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		      
		      
		      
		      $values['end_color'] = rgb2html("$values_2[0]");
		    
		      $values['end_perc'] = $values_2[1];
		break;		
		case(''):
		      $values_out = explode(", rgb(", $css_rule);
		     
		      foreach($values as $value){
		      
			$value = ltrim(rtrim($value));
		      }
		      
		      $values['type'] = 'linear';
		      $values['start_from'] = $values_out[0];
		    
		      $values_2 = explode(") ", $values_out[1]);
		      
		      
		      $values['start_color'] = $values_2[0];
		      
		      $values['start_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		     
		      $values['mid_color'] = rgb2html("$values_2[0]");
		     
		      $values['mid_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		      
		      
		      
		      $values['end_color'] = rgb2html("$values_2[0]");
		    
		      $values['end_perc'] = $values_2[1];
		break;		
	    }
	
	break;
	case('radial'):
	    switch($browser){
	    
		case('webkit'):
		      $values_out = explode(", rgb(", $css_rule);
		     
		      foreach($values as $value){
		      
			$value = ltrim(rtrim($value));
		      }
		      
		      $values['type'] = 'radial';
		      $values['start_from'] = $values_out[0];
		    
		      $values_2 = explode(") ", $values_out[1]);
		      
		      
		      $values['start_color'] = $values_2[0];
		      
		      $values['start_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		     
		      $values['mid_color'] = rgb2html("$values_2[0]");
		     
		      $values['mid_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		      
		      
		      
		      $values['end_color'] = rgb2html("$values_2[0]");
		    
		      $values['end_perc'] = $values_2[1];
		break;
		case('moz'):
		    $values_out = explode(", rgb(", $css_rule);
		     
		      foreach($values as $value){
		      
			$value = ltrim(rtrim($value));
		      }
		      
		      $values['type'] = 'radial';
		      $values['start_from'] = $values_out[0];
		    
		      $values_2 = explode(") ", $values_out[1]);
		      
		      
		      $values['start_color'] = $values_2[0];
		      
		      $values['start_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		     
		      $values['mid_color'] = rgb2html("$values_2[0]");
		     
		      $values['mid_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		      
		      
		      
		      $values['end_color'] = rgb2html("$values_2[0]");
		    
		      $values['end_perc'] = $values_2[1];
		break;	    
		case('khtml'):
		  $values_out = explode(", rgb(", $css_rule);
		     
		      foreach($values as $value){
		      
			$value = ltrim(rtrim($value));
		      }
		      
		      $values['type'] = 'radial';
		      $values['start_from'] = $values_out[0];
		    
		      $values_2 = explode(") ", $values_out[1]);
		      
		      
		      $values['start_color'] = $values_2[0];
		      
		      $values['start_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		     
		      $values['mid_color'] = rgb2html("$values_2[0]");
		     
		      $values['mid_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		      
		      
		      
		      $values['end_color'] = rgb2html("$values_2[0]");
		    
		      $values['end_perc'] = $values_2[1];
		break;	 
		case('o'):
		    $values_out = explode(", rgb(", $css_rule);
		     
		      foreach($values as $value){
		      
			$value = ltrim(rtrim($value));
		      }
		      
		      $values['type'] = 'radial';
		      $values['start_from'] = $values_out[0];
		    
		      $values_2 = explode(") ", $values_out[1]);
		      
		      
		      $values['start_color'] = $values_2[0];
		      
		      $values['start_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		     
		      $values['mid_color'] = rgb2html("$values_2[0]");
		     
		      $values['mid_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		      
		      
		      
		      $values['end_color'] = rgb2html("$values_2[0]");
		    
		      $values['end_perc'] = $values_2[1];
		break;		
		case('ms'):
		    $values_out = explode(", rgb(", $css_rule);
		     
		      foreach($values as $value){
		      
			$value = ltrim(rtrim($value));
		      }
		      
		      $values['type'] = 'radial';
		      $values['start_from'] = $values_out[0];
		    
		      $values_2 = explode(") ", $values_out[1]);
		      
		      
		      $values['start_color'] = $values_2[0];
		      
		      $values['start_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		     
		      $values['mid_color'] = rgb2html("$values_2[0]");
		     
		      $values['mid_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		      
		      
		      
		      $values['end_color'] = rgb2html("$values_2[0]");
		    
		      $values['end_perc'] = $values_2[1];
		break;		
		case(''):
		    $values_out = explode(", rgb(", $css_rule);
		     
		      foreach($values as $value){
		      
			$value = ltrim(rtrim($value));
		      }
		      
		      $values['type'] = 'radial';
		      $values['start_from'] = $values_out[0];
		    
		      $values_2 = explode(") ", $values_out[1]);
		      
		      
		      $values['start_color'] = $values_2[0];
		      
		      $values['start_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		     
		      $values['mid_color'] = rgb2html("$values_2[0]");
		     
		      $values['mid_perc'] = $values_2[1];
		      
		      
		      $values_2 = explode(") ", $values_out[2]);
		      
		      
		      
		      $values['end_color'] = rgb2html("$values_2[0]");
		    
		      $values['end_perc'] = $values_2[1];
		break;		
	    }
	break;
    }
    
return $values;


}


  

   


        
    
	      
	      
		 
		  
		  
		


function add_prefixes($_GET, $key, $value, $selector){

   include($_SERVER['DOCUMENT_ROOT']. '/config/config.inc.php');
    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);


      db_select_db($DATABASENAME, $db);
      
      
    $prefixes = array("webkit", "ms", "khtml", "o", "moz");
      foreach($prefixes as $prefix){
  
      $value = preg_replace("/^-$prefix-/", "", $value);
  
      }
      
      
    $keys = explode("-", $key);
    $props  = array("box", "border");

    
    
  
    
	$key = $keys[0] . "-" . $keys[1]; 
	if(!empty($keys[2])){
	  $key .= "-" . $keys[2];
	 }
	if(!empty($keys[3])){
	  $key .= "-" . $keys[3];
	 }
   

				   
				      
				      $selector = rtrim(ltrim($_REQUEST['selector']));
				      $selector = $selector;
				      
				      if(preg_match('/#/', $selector) ){
		
					    if(!preg_match('/\s+/', $selector)){
						$type = 'id';
					    }else{
						$type = 'psudeo';
					    
					    }
					    
					  }else if(preg_match('/\./', $selector) ){
					  
					  if(!preg_match('/\s+/', $selector)){
						$type = 'class';
					    }else{
						$type = 'psudeo';
					    
					    }
					    
					  }else{
					    
					    
						if(!preg_match('/\s+/', $selector)){
						    $type = 'tag';
						    }else{
						    $type = 'psudeo';
						
						}
					    
					    
					  }
	  
					      		if($value != '   none)' & $value != 'undefined'){
					      		
					      		foreach($prefixes as $pre){
					      		db_query("insert into style_sheets values(null, '$_REQUEST[template]', 'global.css', '$selector', '-$pre-$key', '$value', '$type', '" . addslashes($_GET['human_name']) . "', '" . addslashes($_GET['human_description']) . "', '1');");
					      		//echo "insert into style_sheets values(null, '$_REQUEST[template]', 'global.css', '$selector', '-$pre-$key', '$value', '$type', '" . addslashes($_GET['human_name']) . "', '" . addslashes($_GET['human_description']) . "', '1');";
					      		
					      		}
								db_query("insert into style_sheets values(null, '$_REQUEST[template]', 'global.css', '$selector', '$key', '$value', '$type', '" . addslashes($_GET['human_name']) . "', '" . addslashes($_GET['human_description']) . "', '1');");
							      
			
						      }
    
    
    
    
    }

    

function  check_css_3($_GET, $key, $value){
    include('../../../../../config/config.inc.php');
    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
  
      db_select_db($DATABASENAME, $db);
      
      
 
 
      $string = '';
 //echo $key;
     switch($rule){
     
	    case (preg_match('/radius/',$value)  ? true : false):
	    
	   
		add_prefixes($_GET, $key, $value, $_GET['selector']);
		
	    break;
	    
	    case (preg_match('/shadow/', $value) ? true : false);
	      if($value != 'undefined' & $value != '' & $value != 'none' & $value != 'none) '){
		add_prefixes($_GET, $key, $value, $_GET['selector']);
		}
	    break;
	    
		  
	    //echo db_error();
     }

}

function create_linear_gradient_from_real($_REQUEST, $selector, $value, $key){
   include('../../../../../config/config.inc.php');
    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);


      db_select_db($DATABASENAME, $db);
if(preg_match('/-ms-/', $key)){


}
$grradient_name = explode("(", $value);

$value = str_replace("rgba( 0, 0, 0, 0) 50%,", "", $value);
$value = str_replace("rgba( 0, 0, 0, 0),", "", $value);


//db_query("delete from style_sheets where selector ='$slector' and template = '$_REQUEST[template]' and (property = 'background' or property = 'bakground-image') and page= 'global.css' and value = '$gradient_name[0]%'");


////echo "insert into style_sheets values(null, '$_REQUEST[template]', '$_REQUEST[css_file]', '$_REQUEST[selector]', 'background', '$value', '$type', '$_REQUEST[human_name]', '$_REQUEST[human_description]', '1');";

       db_query("insert into style_sheets values(null, '$_REQUEST[template]', '$_REQUEST[css_file]', '$_REQUEST[selector]', 'background', '$value', '$type', '$_REQUEST[human_name]', '$_REQUEST[human_description]', '1');");

}
