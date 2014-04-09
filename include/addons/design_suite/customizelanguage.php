<?php
if(!empty($_REQUEST['submit_page'])){
$file_put = "<?php\n";


    foreach($_REQUEST['pointer'] as $key => $value){



	   $file_put = $file_put . "define(\"$value\", \"" . $_REQUEST['constant'][$value] . "\");\n"; 

      }

//echo "<pre><code>" . $file_put . "</code></pre>";
$fp = fopen("../" . str_replace("../", "", $_REQUEST['lang_page']), "w");

if(!fwrite($fp, $file_put)){
echo "Your language folder or $_REQUEST[lang_page] needs to have write permissions enabled<br>";
}else{
echo "Successfully changed $_REQUEST[lang_page]<br>";

}

@fclose($fp);
?>

					<!--[if !IE]>start row<![endif]-->
                                                         
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">


                                                             
                                                                    <div class="inputs" style="width:400px;">
                                                                         <label id="pdcode-label">Choose a Language To Customise</label><br />
									   
									
                                                                        
                                                                    </div>
                                                                </div>
							    </div>
		  
							 
<script>
function ajaxpages() { jQuery.get("DESIGN/pages.php?lang=" + encodeURIComponent($("#countrycustom").val()), function(data){ $("#pages").html(data);} ); }
</script>



                                                        <div class="forms" id="customform">     
                                                
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    
                                                                    <div class="inputs">
                                                                        <select name="countrycustom" id="countrycustom"  onchange="ajaxpages();">
<?php
$sql = db_query("SELECT * FROM language_choices where lang_text != '' order by country asc");

while($row = db_fetch_array($sql)){
if(file_exists("../../languages/" . str_replace(" ", "_", strtolower($row['country'])) ) || file_exists("../../languages/" . $row['lang_text'])  ){
?>
<option value="<?php echo $row['lang_text'];?>"><?php echo $row['country'];?></option>
<?php
}
}
?>
									</select>
<br>


<div id="pages"></div>
<input type="hidden" name="page" value="customizelanguage.php" />

<input type="radio" value="yes" name="lang_pack"> <label id="lang_pack">Download as language pack</label><br />
                                                                        
                                                                    </div>
                                                                </div>
							    </div>
		  

<?php

}else{



$line_of_text = array();
$file_handle = fopen("$_REQUEST[lang_page]", "rb");

 while (!feof($file_handle)) {

$line = fgets($file_handle);
if(strstr( $line, "define")){
            $line_of_text[] = $line;
}
        }

fclose($file_handle);
?>
<!--<form action="designsuite.php" method="post" enctype="multipart/form-data">-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">


                                                             
                                                                    <div class="inputs" style="width:400px;">
<?php
$m = 0;
foreach($line_of_text as $line){
if(strstr( $line, "define")){

?>
<input type="hidden" name="line[<?php echo $m;?>]" value="<?php echo str_replace("\"", "\\\"", $line);?>" /><br />
<?php

			$line = str_replace("\"", "", str_replace("'", "", str_replace(");", "", str_replace("define(", "", $line))));
			


$constant = explode(",", $line);

      



?>
<?php echo $constant[0];?><br />
<input type="hidden" name="pointer[<?php echo $m;?>]" value="<?php echo $constant[0];?>" /><br />
<input type="text" name="constant[<?php echo $constant[0];?>]" value="<?php echo $constant[1];?>" /><br />
<?php


//echo $matches[1][2] ."<br>";


$m++;
}


}

?>
<input type="hidden" name="submit_page" value="<?php echo $_REQUEST['lang_page'];?>">
<input type="hidden" name="lang_page" value="<?php echo $_REQUEST['lang_page'];?>">
<input type="hidden" name="page" value="addlanguage.php">
<!--</form>-->
</div></div></div>

<br />

<?php
}
?>