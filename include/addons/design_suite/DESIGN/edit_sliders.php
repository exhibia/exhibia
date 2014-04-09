<?php
require_once("../../../../config/config.inc.php");
db_connect($DBSERVER, $USERNAME, $PASSWORD);

include("../js/ckeditor/ckeditor_php5.php");

db_select_db($DATABASENAME);

if(!empty($_REQUEST['find_last'])){


      $row = db_fetch_array(db_query("select * from languages where constant like 'SLIDER%' and language = 'english' order by constant desc limit 1"));
      
      $constant = str_replace("SLIDER", "", $row['constant']);
      
      
	  $id = $constant + 1;
	  
	  //show previews of dynamic sliders here


    }else{
		  function translate($to, $from, $text){

		  //echo $text;

		  $count = strlen($text);

		      $cycles = $count / 200;



		  $r = 0;

		  $newString = '';
			//while( $r <= round($cycles) ){


		  //$text = truncate($text, '200','', $r * 200) ;

		  $useragent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";

		  $ch = curl_init();

		  // set user agent
		  curl_setopt($ch, CURLOPT_USERAGENT, $useragent);


		  $url = "http://ets.freetranslation.com/?";
		  $parameters = "language=" . ucfirst($from) . "/" . ucfirst($to) . "&sequence=core&" . "srcText=" . urlencode($text);

			  curl_setopt($ch, CURLOPT_URL, $url );
			  curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);

		  // receive server response ...
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			  $output = curl_exec($ch);

			  // close curl resource to free up system resources
			  curl_close($ch);
			  
		  //die();
		  $newString = '';

		  if(  !preg_match("/Error:/", $output)){

		  $newString = $output;
		  }
		  $r++;
		  //}
		  if(!empty($newString)){

		  return $newString;

		  }else{


			  echo "\n<font style='color:red;font-size:12px;>Translation not available</font>";

		  }




		  }



				if($_REQUEST['translate'] == 'yes'){



				    $lang_text = db_fetch_array(db_query("select * from language_choices where lang_text = '$_REQUEST[oldlanguage]' limit 1"));

				    $source = strtolower($lang_text[1]);


				    $lang_text = db_fetch_array(db_query("select * from language_choices where lang_text = '$_REQUEST[target_language]' limit 1"));
				  
				    $target = $lang_text[1];



				    $targetData = translate($_REQUEST['target_language'], $_REQUEST['oldlanguage'], $_REQUEST['value']);

				    if(!empty($targetData)){
				    $_REQUEST['value'] = $targetData;
				    }else{
				      $msg = "<font color=\"red\">We could not find a translation</font>";
				$error = 'yes';
				      }


				}



if(!empty($_REQUEST['dome'])){


	    if(!empty($_REQUEST['constant2'])){
	    $_REQUEST['constant'] = $_REQUEST['constant2'];
	    }


		    $_REQUEST['value'] = stripslashes(urldecode($_REQUEST['value']));

		    if(!isset($error)){

			  if(isset($_REQUEST['new_constant']) | db_num_rows(db_query("select * from languages where language = '$_REQUEST[target_language]' and constant = '$_REQUEST[constant]'")) == 0){

			  if(db_query("insert into languages values(null, '$_REQUEST[target_language]', '$_REQUEST[constant]', '". db_real_escape_string($_REQUEST['value']) . "');")){

				  $msg = "<span  style=\"padding-top:10px;\">you have updated $_REQUEST[constant] For language $_REQUEST[target_language]</span>";
			  
			      }else{

				echo db_error();
			      }
		    if(!empty($_REQUEST['oldid'])){
			    ?>

				<?php
		    }else{

		    ?>

			<?php


		    }
		    echo $msg;
		    die();
		    
		    
		    }else{

				$_REQUEST['value'] = str_replace(array("\n", "\r", "\t", "\s+"), "", $_REQUEST['value']);
					if(db_query("update languages set value = '". addslashes(urldecode($_REQUEST['value'])) . "' where constant = '$_REQUEST[constant]' and language = '$_REQUEST[target_language]'")){
		    
		    ?>
		    
		    <?php
					      $msg = "<font color='red'>You have updated $_REQUEST[constant] For language $_REQUEST[target_language]</font>";
					  echo $msg;
					  die();
						$id = db_fetch_array(db_query("select * from languages where value = '". db_real_escape_string($_REQUEST['value']) . "' and constant = '$_REQUEST[constant]' and language = '$_REQUEST[target_language]' order by id desc limit 1"));
		      ?>

			<?php
				  }else{
					  echo db_error();


			      }
			}
		    echo db_error();
		    }

$id = $_REQUEST['id'];
$constant = $_REQUEST['constant'];
}


if( $_REQUEST['get'] == 'sliderTextForEditor'){


$id = $_REQUEST['id'];
$constant = $_REQUEST['constant'];


$values = explode(":", $_REQUEST['id']);
$id = $values[1];
$constant = $values[0];


if(!isset($_REQUEST['get']) | isset($id)){
$where = " id = '$id'";
}else{

if( !isset($_REQUEST['constant'])){
$_REQUEST['constant'] = 'SLIDER1';

}
$where = "constant = '$_REQUEST[constant]'";
}

if(empty($_REQUEST['language'])){

 $_REQUEST['language'] = 'english';

}
$where .= " and language = '$_REQUEST[language]'";
//echo "select * from languages where $where limit 1";
    $qry = db_query("select * from languages where $where limit 1");


    

	$rowl = db_fetch_array($qry);


$rowl['value'] = str_replace("display: none", "display:block", str_replace("display:none", "display:block", $rowl['value']));

preg_match_all("/\[\[(.*?)\]\]/", $rowl['value'], $matches);
  foreach($matches[1] as $match){

    $sqlText = db_fetch_array(db_query("select value from languages where constant = '$match' and language = 'english' limit 1"));
  if(!empty($sqlText[0])){



  $rowl['value'] = str_replace($match, $sqlText[0], $rowl['value']);
	  }
	  }

	echo str_replace("[[", " ", str_replace("]]", " ", str_replace("[[SITE_URL]]", $SITE_URL, str_replace("[[SITE_NM]]", $SITE_NM, $rowl['value'] ))));

	
	  ?>
	  
	  <?php

}else{
$_REQUEST['constant'] = strtoupper($_REQUEST['constant']);
if(!empty($error)){
  ?>

<?php
}
  ?>





	<?php


$values = explode(":", $_REQUEST['id']);


$id = $values[1];

if(!empty($_REQUEST['oldid'])){
$id = $_REQUEST['oldid'];
}
$constant = $values[0];


if(!isset($_REQUEST['get']) | isset($id)){
$where = " id = '$id'";
}else{

if( !isset($_REQUEST['constant'])){
$_REQUEST['constant'] = 'SLIDER1';

}
$where = "constant = '$_REQUEST[constant]'";
}

        $langstr = '';
        //echo $_SESSION['lang1'];
//        echo $_COOKIE['lang'];
        if (isset($_SESSION['lang1'])) {
            $langstr = $_SESSION['lang1'];
        } else if (isset($_COOKIE['lang'])) {
            $langstr = $_COOKIE['lang'];
        }
//echo $langstr;
        if (empty($langstr)) {

	    if(empty($defaultlanguage)){

	    $langstr = 'english';
	    }else{
            $langstr = $defaultlanguage;
	    }
        }

	
$where .= " and language = '$langstr'";
//echo "select * from languages where $where limit 1";
    $qry = "select * from languages where $where order by id desc limit 1";

	$rowl = db_fetch_array(db_query($qry));
	echo db_error();
	

 ?>
			
			
				
				  <div id="language_form_inner">
				  
					<table  align="center">
						    <tr>
							<td colspan="10" align="left">
							
							    <div style="position:absolute;top:5px;" id="text_editor">
								<input type="hidden" id="dome" name="dome" value="yes">
								</div>		  
								<div id="lang_value" id="lang_value" style="border-radius:8px;border:1px dotted red;height:auto;width:auto;margin-bottom:20px;" contenteditable="true" ><?php echo stripslashes($rowl['value']);?></div>
								  <input type="hidden" value="<?php echo $rowl['id'];?>" id="id" name="id">
								  <input type="hidden" value="<?php echo $id;?>" name="oldid" id="oldid">
					     
								 
							  
		<script>
		$('#lang_value').css('width', $('#slider_box').css('width'));
		$('#lang_value').css('height', $('#slider_box').css('height'));
		
		
		</script>
							</td>
						    </tr>
						<tr>
							<td colspan="2" valign="top" height="100%">
							<?php
							//if(!isset($_REQUEST['get'])){
							?>
											<h2>Add New Slider</h2>
					
					  			<input type="checkbox" value="new" id="new" name="new" onclick="add_new_slider();" />
							</td>
							<td>  
		
							<?php
						
								if(isset($_REQUEST['get']) & empty($_REQUEST['find_last'])){
							?><h2>Choose A Slider</h2>
									<select id="constant2" name="constant" onchange="javascript:edit_sliders($(this).val());">
									<option value=""></option>
							<?php
							$qry4 = db_query("select * from languages where constant like 'SLIDER%'");
							
							while($row4 = db_fetch_array($qry4)){
							?>
										
										<option value="<?php echo $row4['constant'];?>" <?php if($_REQUEST['constant'] == $row4['constant']){ echo 'selected'; } ?>><?php echo $row4['constant'];?></option>
							<?php } ?>
									</select>
				      					<div id="constant_wrap" style="margin-left:50px;">
					    					<input type="hidden" value="<?php echo $rowl['constant'];?>" id="constant" name="constant" style="width:400px;" size="400">
				      					</div>
							<?php
								//}
							?>
					  
				
			
			
							<?php
							}
							else{
						
							?><h2>Choose A Slider</h2>
									<select id="constant2" name="constant" onchange="javascript:edit_sliders($(this).val());">
									<option value=""></option>
							<?php
							$qry4 = db_query("select * from languages where constant like 'SLIDER%'");
							
							while($row4 = db_fetch_array($qry4)){
							?>
										
										<option value="<?php echo $row4['constant'];?>" <?php if($_REQUEST['constant'] == $row4['constant']){ echo 'selected'; } ?>><?php echo $row4['constant'];?></option>
							<?php } ?>
									</select>
								<input type="hidden" name="editslider" value="yes" id="editslider" />
								<input type="hidden" name="get" id="get" value="sliderform" />
			

							<?php
							}
							?>
							</td>

						
				     			<td colspan="1" align="left" valign="top" height="100%">
							<h2>Auto Translate?</h2>
								<input type="checkbox" value="yes" id="translate" name="translate"/>
				    			</td>
				   			 <td colspan="1" align="left" valign="top" height="100%">
				      
						    		<h2>Convert From</h2>
								<select name="oldlanguage" id="oldlanguage">
					    
						    			<option value="<?php echo $rowl['language'];?>"><?php echo $rowl['language'];?></option>
									<?php
									$qry3 = db_query("SELECT distinct(language) from language");
									
									while($rowAllLang = db_fetch_array($qry3)){
									
									?>
						      
						    			<option value="<?php echo $rowAllLang['language'];?>"><?php echo $rowAllLang['language'];?></option>		  
						      
									<?php
									}
										?>
								</select>  

				     			 </td>
							<td colspan="1" align="left" valign="top" height="100%">


						  		<h2>Target Language</h2> 
					     			 <select name="target_language" id="target_language">
								<?php
								if(!empty($_REQUEST['target_language'])){
								?>
						   			 <option value="<?php echo $_REQUEST['target_language'];?>"><?php echo $_REQUEST['target_language'];?></option>
								<?php
									}
								?>
						    			<option value="<?php echo $rowl['language'];?>"><?php echo $rowl['language'];?></option>

						 		 <?php
									$allL = db_query("SELECT distinct(language) from language");


						 			 while($rowAllL = db_fetch_array($allL)){




						 		 ?><option value="<?php echo $rowAllL['language'];?>" style="word-wrap:break-word;width:100px;"><?php echo $rowAllL['language'];?></option><?php

						 			 }


						  		?>
					      			</select>
							</td>
							<td>
							 <input type="submit" name="update_language_button" id="update_language_button" />
							 
							 </td>
						    </tr>
						   
						  
						
						
					</table>
	
			       
			        </div>
			 
 		
		
	
<?php
}

}
  ?>
	 <script>
	
	
		 </script>