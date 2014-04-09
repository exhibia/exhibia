<?php
require_once("../../../../config/config.inc.php");
db_connect($DBSERVER, $USERNAME, $PASSWORD);

include("../js/ckeditor/ckeditor_php5.php");

db_select_db($DATABASENAME);


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
   <script>
   
     document.getElementById('<?php echo strtolower($_REQUEST['constant']);?>:<?php echo $_REQUEST['oldid'];?>').innerHTML = '<?php echo strtolower($_REQUEST['value']);?>';
document.getElementById('lang_value').value = '<?php echo $_REQUEST['value'];?>';

    </script>
    <?php
}else{

 ?>
   <script>
          
     $(document).html($(document).html().replace('<?php echo strtolower($_REQUEST['constant']);?>','<h25 id="<?php echo strtolower($_REQUEST['constant']);?>:<?php echo
db_insert_id();?>" onclick="edit_text(<?php echo strtolower($_REQUEST['constant']);?>:<?php echo db_insert_id();?>);"><?php echo strtolower($_REQUEST['value']);?></h25>'));
    </script>
    <?php


}
}else{

$_REQUEST['value'] = str_replace(array("\n", "\r", "\t", "\s+"), "", $_REQUEST['value']);
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


  <form id="language_form" name="language_form" action="javascript: submit_test_ajax_form('language_form'); ">


    <table align="center" style="max-height:300px;padding-top:10px;padding-bottom:10px;margin: 0 auto;width:min-width:1000px;" width="1200px">

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
			



		</td>

	  </tr>

 </table>
 </form>
<?php
}
  ?>
