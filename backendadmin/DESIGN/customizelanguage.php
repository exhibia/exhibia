<script>
function add_constants(){
 var d = new Date().getMilliseconds();

$('#add_constants').append('<table style="border:1px solidd blue;"><tr><td><div style="display:inline;" id="constant_box_' + d + '">Loading</div></td><td><div style="display:inline;" id="value_box_' + d + '"></div></td></tr></table><br />');
    $.get("<?php echo $SITE_URL; ?>backendadmin/DESIGN/add_constants.php?idx=" + d, function(response){
	$('#constant_box_' + d).html(response);
    
    });



}
function add_value(constant, idx){
$('#value_box_' + idx).html('Loading');
    $.get("<?php echo $SITE_URL; ?>backendadmin/DESIGN/add_constants.php?lang=<?php echo $_REQUEST['countrycustom'];?>&constant=" + $('#constant_' + idx).val(), function(response){
    
      
	$('#value_box_' + idx).html(response);
    
    });



}
function export_excel(){
    $.get('<?php echo $SITE_URL; ?>backendadmin/DESIGN/excel.php?lang=<?php echo $_REQUEST['countrycustom'];?>', function(response){
    prompt('<?php echo $SITE_URL; ?>backendadmin/DESIGN/excel.php?lang=<?php echo $_REQUEST['countrycustom'];?>');
    if(response == 'success'){
    
	//window.location.href = '<?php echo $SITE_URL; ?>backendadmin/DESIGN/<?php echo $_REQUEST['countrycustom'];?>.xls';
    
    }
    });


}
</script>
<form action="designsuite.php" method="post">
<?php
if(!empty($_POST['country'])){
    foreach($_POST['country'] as $key => $value){
    
	db_query("update language_choices set abbrev='" . $_POST['abbrev'][$key] . "', lang_text='" . $_POST['lang_text'][$key] . "', country='" . $_POST['country'][$key] . "' where id = '$key'");
    
    
    }




}
function curl($url,$params = array(),$is_coockie_set = false)
{

if(!$is_coockie_set){
/* STEP 1. let’s create a cookie file */
$ckfile = tempnam ("/tmp", "CURLCOOKIE");

/* STEP 2. visit the homepage to set the cookie properly */
$ch = curl_init ($url);
curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec ($ch);
}

$str = ''; $str_arr= array();
foreach($params as $key => $value)
{
$str_arr[] = urlencode($key)."=".urlencode($value);
}
if(!empty($str_arr))
$str = '?'.implode('&',$str_arr);

/* STEP 3. visit cookiepage.php */

$Url = $url.$str;

$ch = curl_init ($Url);
curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);

return $output;
}

function translate( $translate_from, $conversion, $word )
{
$word = urlencode($word);
// dutch to english

// english to hindi

$url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=' . $translate_from . '&sl=' . $translate_from . '&tl=' . $conversion . '&ie=UTF-8&oe=UTF-8&multires=1&otf=1&ssel=3&tsel=3&sc=1';


//$url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=nl&tl=en&multires=1&otf=2&pc=1&ssel=0&tsel=0&sc=1';

$name_en = curl($url);

$name_en = explode('"',$name_en);

if($name_en[1] == '\\' | $name_en[1] == ''){
$name_en[1] = $word;

}
$name_en[1] = str_replace("\\", "", $name_en[1]);
  
return  $name_en[1];
}



if(!empty($_POST['submit_changes_now'])){
      foreach($_POST['value'] as $key => $value){
	 if(!empty($key)){
	   if(empty($_POST['do_translate'])){
		  if(db_num_rows(db_query("select * from languages where constant = '$key' and language = '$_REQUEST[countrycustom]'")) == 0){

		      db_query("insert into languages values(null, '$_REQUEST[countrycustom]', '$key', '$value');");
		  
		  }else{
		  
		      db_query("update languages set value = '$value' where constant = '$key' and language = '$_REQUEST[countrycustom]'");
		  
		  
		  }
	  }
	   if($_POST['countrycustom'] != $_POST['translate_to']){
	   $_REQUEST['translate_to'] = strtolower($_REQUEST['translate_to']);
	    if(!empty($_POST['do_translate'])){
	 $to = db_fetch_object(db_query("select * from language_choices where abbrev='" . strtoupper($_REQUEST['translate_to']) . "' and lang_text != '' order by id desc limit 1"));
	      $value = translate($_REQUEST['countrycustom'], strtolower($to->abbrev), $value);
	    }
		if(db_num_rows(db_query("select * from languages where constant = '$key' and language = '" . $to->lang_text . "'")) == 0){
		  if(empty($value)){
		  $value = $key;
		  
		  }
		 
		    db_query("insert into languages values(null, '" .$to->lang_text . "', '$key', '" . addslashes($value) . "');");
		
		}else{
		 if(empty($value)){
		  $value = $key;
		  
		  }
		    db_query("update languages set value = '" . addslashes($value) . "' where constant = '$key' and language = '" . $to->lang_text . "'");
		
		
		}
     
	  }
	 } 
      }

    foreach($_POST['delete'] as $key => $value){
   
	db_query("delete from languages where id=$key");
    
    }

    if(db_num_rows(db_query("select * from language where language='$_POST[translate_to]'")) == 0){
    include_once("imgsize.php");
    
    $lang = db_fetch_array(db_query("select * from language_choices where lang_text = '$_POST[translate_to]' limit 1"));
      
    db_query("insert into language values(null, '". $_POST['translate_to'] . "', '" . ucfirst($_POST['translate_to']) . "', '1', '" . strtolower($lang['abbrev']) . ".gif');");

      
	  
	  
	
	
	  $flag = file_get_contents("http://www.geonames.org/flags/x/" . urlencode(strtolower($lang['abbrev'])) . ".gif");
	 
	  
	    ImageResize("http://www.geonames.org/flags/x/" . urlencode(strtolower($lang['abbrev'])) . ".gif", $BASE_DIR . '/img/icons', strtolower($lang['abbrev']) . ".gif", 16, 10);
    }
    if($_POST['countrycustom'] != $_POST['translate_to']){
      
	      $_REQUEST['countrycustom'] = $to->lang_text;
	      $_POST['countrycustom'] = $to->lang_text;
	  }


}

?>
<style>
p {
font-size:10px;

font-weight:bold;
}
</style>
<script>
function add_new_value(idx){
   	      
}
</script>
<table>
<tr>
  <td colspan="2" width="500px;">
  
  </td>
  <td>
    <a href="javascript:;" onclick="export_excel();">Export as Excel</a>
  </td>
</tr>
<tr>
 <td valign="top" height="100%" style="border:1px solid blue;margin-right:10px;">
<?php
$qry = db_query("select constant, value, id from languages where language = '$_REQUEST[countrycustom]' and constant!='' and constant >= 'A' and constant <= 'J' order by constant,id asc");

    $divisor = number_format(db_num_rows($qry) / 2, 0);
    $p=0;
      while($row = db_fetch_array($qry)){
	    ?>
	     
			
			      <p onclick="$('.textp').css('display', 'none');$('#textp_<?php echo $p;?>').css('display', 'block');" style="margin-right:20px;max-width:300px;word-wrap:break-word;"><?php echo $row['constant'];?>
			      <label style="float:right;">Delete?</label><input type="checkbox" name="delete[<?php echo $row['id'];?>]" value="yes" style="float:right;" />
			      </p>
			      <textarea name="value[<?php echo $row['constant'];?>]" class="textp" id="textp_<?php echo $p;?>" style="display:none;"><?php echo $row['value'];?></textarea>
			      
			    <?php
			
      $p++;
      }

?>
    </td>
 <td valign="top" height="100%" style="border:1px solid blue;margin-right:10px;">
<?php
$qry = db_query("select constant, value, id from languages where language = '$_REQUEST[countrycustom]' and constant!='' and constant >= 'K' and constant <= 'Q' order by constant, id asc");

    $divisor = number_format(db_num_rows($qry) / 2, 0);
    
      while($row = db_fetch_array($qry)){
	    ?>
	     
			 
			  
			      <p onclick="$('.textp').css('display', 'none');$('#textp_<?php echo $p;?>').css('display', 'block');"  style="margin-right:20px;max-width:300px;word-wrap:break-word;"><?php echo $row['constant'];?>
			      <label  style="float:right;">Delete?</label><input type="checkbox" name="delete[<?php echo $row['id'];?>]" value="yes" style="float:right;" />
			      </p>
			      <textarea  name="value[<?php echo $row['constant'];?>]" class="textp" id="textp_<?php echo $p;?>" style="display:none;"><?php echo $row['value'];?></textarea>
			      
			    <?php
			
      $p++;
      }

?>
    </td>
 <td valign="top" height="100%" style="border:1px solid blue;">
<?php
$qry = db_query("select constant, value, id from languages where language = '$_REQUEST[countrycustom]' and constant!='' and constant >= 'R' and constant <= 'Z' order by constant, id asc");

    $divisor = number_format(db_num_rows($qry) / 2, 0);

      while($row = db_fetch_array($qry)){
	    ?>
	     
			 
			  
			      <p onclick="$('.textp').css('display', 'none');$('#textp_<?php echo $p;?>').css('display', 'block');"  style="max-width:300px;word-wrap:break-word;">
			      <?php echo $row['constant'];?>
			      <label style="float:right;">Delete?</label><input type="checkbox" name="delete[<?php echo $row['id'];?>]" value="yes" style="float:right;" />
			      </p>
			      <textarea  name="value[<?php echo $row['constant'];?>]" class="textp" id="textp_<?php echo $p;?>" style="display:none;"><?php echo $row['value'];?></textarea>
			      
			    <?php
			
      $p++;
      }

?>
    </td>
</tr>
<tr>
    <td  colspan="3">
	  <div id="add_constants">
	  
	  </div>
	  <label><a href="javascript:;" onclick="add_constants();">Add Constants</a></label>
    </td>
</tr>
<tr>
      <td colspan="3">
	  <h3>Translate To (your custom values will be used despite the language you chose to reach this page)</h3>
	 
	   <select name="translate_to" id="translate_to">
	   
	      <?php
	      
	      $sql = db_query("SELECT country, lang_text, abbrev FROM language_choices where abbrev != '' order by country asc");

	      while($row = db_fetch_array($sql)){

	      ?>
	      <option value="<?php echo $row['abbrev'];?>" <?php if($row['lang_text'] == $_REQUEST['countrycustom']){ echo 'selected'; }?>><?php echo $row['country'];?></option>
	      <?php
	      }
	      ?>
									
	</select>
	<?php
	echo db_error();
	?>
	</td>
	</tr>
	<tr>
	 <td colspan="3">
	<h3>Select this to do automatic translations from one language to the language selected above(customize later)</h3>
	<input type="checkbox" name="do_translate" value="yes" />
<input type="hidden" name="countrycustom" value="<?php echo  $_REQUEST['countrycustom'];?>" />
<input type="hidden" name="a_page" value="customizelanguage.php" />
	</td>
	</tr>
	<tr>
	 <td colspan="3">
<input type="submit" name="submit_changes_now" />

<br>
      </td>
</tr>
</table>