<?php
if(!empty($BASE_DIR)){
require_once("$BASE_DIR/config/config.inc.php");

}else{
require_once("../../config/config.inc.php");

}
db_connect($DBSERVER, $USERNAME, $PASSWORD);

include("$BASE_DIR/js/ckeditor/ckeditor_php5.php");

db_select_db($DATABASENAME, $db);


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

if(!empty($_REQUEST['new_constant']) | db_num_rows(db_query("select * from languages where language = '$_REQUEST[target_language]' and constant = '$_REQUEST[constant]'")) == 0){
echo "insert into languages values(null, '$_REQUEST[target_language]', '$_REQUEST[constant]', '". db_real_escape_string($_REQUEST['value']) . "');";

if(db_query("insert into languages values(null, '$_REQUEST[target_language]', '$_REQUEST[constant]', '". db_real_escape_string($_REQUEST['value']) . "');")){

  $msg = "test<font color='red'>You have updated $_REQUEST[constant] For language $_REQUEST[target_language]</font>";

  
  }else{

 echo db_error();
}
if(!empty($_REQUEST['oldid'])){
 ?>
   <script>
   
     document.getElementById('<?php echo strtolower($_REQUEST['constant']);?>:<?php echo $_REQUEST['oldid'];?>').innerHTML = '<?php echo strtolower($_REQUEST['value']);?>';
document.getElementById('lang_value').value = '<?php echo $_REQUEST['value'];?>';

    </script>
    <?php
}else{

 ?>
   <script>
       try{  
     $(document).html($(document).html().replace('<?php echo strtolower($_REQUEST['constant']);?>','<h25 id="<?php echo strtolower($_REQUEST['constant']);?>:<?php echo
db_insert_id();?>" onclick="edit_text(<?php echo strtolower($_REQUEST['constant']);?>:<?php echo db_insert_id();?>);"><?php echo strtolower($_REQUEST['value']);?></h25>'));
}catch(backend){}
    </script>
    <?php


}
}else{

$_REQUEST['value'] = str_replace(array("\n", "\r", "\t", "\s+"), "", $_REQUEST['value']);
echo "update languages set value = '". addslashes($_REQUEST['value']) . "' where constant = '$_REQUEST[constant]' and language = '$_REQUEST[target_language]'";
if(db_query("update languages set value = '". addslashes($_REQUEST['value']) . "' where constant = '$_REQUEST[constant]' and language = '$_REQUEST[target_language]'")){
 

 $msg = "<font color='red'>You have updated $_REQUEST[constant] For language $_REQUEST[target_language]</font>";

  $id = db_fetch_array(db_query("select * from languages where value = '". db_real_escape_string($_REQUEST['value']) . "' and constant = '$_REQUEST[constant]' and language =
'$_REQUEST[target_language]' order by id desc limit 1"));
   ?>
   <script>

     document.getElementById('<?php echo strtolower($_REQUEST['constant']);?>:<?php echo $_REQUEST['oldid'];?>').innerHTML = '<?php echo addslashes($_REQUEST['value']);?>';
     $('#lang_value').html('<?php echo $_REQUEST['value'];?>');

    </script>
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
    <script>
      alert('<?php echo $msg;?>');
    </script>

<?php
}
  ?>


  <form id="form" name="language_form" action="javascript: submit_test_ajax_form('lang_form'); ">


    <table align="center" style="max-height:300px;padding-top:10px;padding-bottom:10px;margin: 0 auto;width:min-width:800px;" width="1200px">

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
	<tr>
	    <td colspan="5"><?php echo $msg; ?></td>
	</tr>
	<tr>
	    <td colspan="2" valign="top" height="100%"  align="left">
		<table valign="top">
		      <tr>
			<td colspan="2" valign="top" height="100%">
			  
			 
			  Choose Constant(useful for JS that you can't see right away)<br />
			  <div id="constant_wrap">
			    <select name="choose_constant" id="choose_constant" onchange="change_constant();" style="font-size:12px;word-wrap:break-word;max-width:220px;">
			      
			      <option value="<?php echo $id[0];?>" style="font-size:12px;word-wrap:break-word;max-width:220px;"><?php echo $rowl['constant'];?></option>
			      
			      <?php
			      $sql1 = db_query("select distinct(constant) from languages where language = 'english' order by constant asc");
			     while($row1 = db_fetch_array($sql1)){
				    $sqlConstant = db_query("select constant, id from languages where language = 'english' and constant = '$row1[constant]' and constant != '' and value != '' and constant not like 'slider%' and constant not like '%define%' order by constant asc limit 1");
				    
					while($rowConstant = db_fetch_array($sqlConstant)){
					
					  ?>
					
					    <option style="font-size:12px;word-wrap:break-word;max-width:220px;" value="<?php echo $rowConstant['id'];?>"><?php echo $rowConstant['constant'];?></option>
					
					<?php
					}
					
				}
				?>
				
			    </select>
			    <?php echo db_error(); ?>
			    </div>
			</td>
		  </tr>
		  <tr>
			<td colspan="2" valign="top" height="100%">
			
			    <table>
			      <tr>
				<td>
		    <?php
		    if(!isset($_REQUEST['get'])){
		      ?>

					Add new or missing constant
					
					  <input type="checkbox" value="new" id="new" name="new" onclick="add_new_text();" />
				</td><td>  
		
				      <?php
			
				    if(!isset($_REQUEST['get']) | empty($_REQUEST['constant'])){
				      ?>
				      <div id="constant_wrap" style="margin-left:50px;">
					    <input type="hidden" value="<?php echo $rowl['constant'];?>" id="constant" name="constant" style="width:400px;" size="400">
				      </div>
				      <?php
				      }
					  ?>
				    </td>
				</tr>
			    </table>
			
		      <?php
		      }
		      else{
		 
			?>
				      <select id="constant2" name="constant" onchange="javascript:html_text();">
					    <option value="<?php echo $_REQUEST['constant'];?>"><?php echo $_REQUEST['constant'];?></option>
					    <option value="SLIDER1">SLIDER1</option>
					    <option value="SLIDER2">SLIDER2</option>
					    <option value="SLIDER3">SLIDER3</option>
					    <option value="SLIDER4">SLIDER4</option>
					    <option value="SLIDER5">SLIDER5</option>
				      </select>
				      <input type="hidden" name="editslider" value="yes" id="editslider" />
				      <input type="hidden" name="get" id="get" value="sliderform" />
			

			<?php
			}
			?>
			
			</td>
		      </tr>
		      <tr>
			<td colspan="2" valign="top" height="100%">
				<table>
				  <tr>
				     <td colspan="1" align="left" valign="top" height="100%">
					Auto Translate?
					<input type="checkbox" value="yes" id="translate" name="translate"/>
				    </td>
				    <td colspan="1" align="left" valign="top" height="100%">
				      
						    Convert From
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


						  Target Language 
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
				    </tr>
			    </table>
			</td>
		      </tr>
		
		      <tr>
			<td colspan="2" valign="top" height="100%">


			  <input type="submit" name="update_language_button" id="update_language_button">
			</td>
		    </tr>

		</table>	      
			
	    </td>   
	    <td colspan="2" valign="top" height="110px">
	      
 		
		    



				  <input type="hidden" id="dome" name="dome" value="yes">



			      <div  contenteditable="true" id="lang_value" id="lang_value" style="height:50px;width:400px;margin-bottom:-50px;background:#fff;border-radius:6px;border:1px inset gray;position:relative;left:-200px;" ><?php echo stripslashes($rowl['value']);?></div>
			      <input type="hidden" value="<?php echo $rowl['id'];?>" id="id" name="id">
			      <input type="hidden" value="<?php echo $id;?>" name="oldid" id="oldid">

		</td>


	      </td>
	  
	    

	  </tr>
<?php


 ?>
 </table>
 </form>
 
<?php
}
  ?>
