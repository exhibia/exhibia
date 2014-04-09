<?

	//////////////////////////////////
	// FORMAT DATE 
	////////
	function ConfigDateTime($date,$timestamp=FALSE)
	{	
		$qry="SELECT * from config_setting WHERE config_key='DATE_FORMAT'";	
		$result=db_query($qry) or die(db_error());
		$row = db_fetch_array($result);
		$datesetting=$row['config_value'];
		$DateTime=date($datesetting,strtotime($date));
		
		if($timestamp==TRUE)
		{
			$qry="SELECT * from config_setting WHERE config_key='TIME_FORMAT'";	
			$result=db_query($qry) or die(db_error());
			$row = db_fetch_array($result);
			$timesetting=$row['config_value'];
			$DateTime.="<BR>".date($timesetting,strtotime($date));
		}
		return $DateTime;
	}
	//////////////////////////////////
	// Change table data class alternately 
	////////
	function ConfigcellColor($i, $tdEven="tdEven", $tdOdd="tdOdd"){
		
		$cellColor = "";
		
		if(is_double($i/2)){
			$cellColor =$tdEven;
		} else {
			$cellColor = $tdOdd;
		} 
		
		return $cellColor;
	}
	
	//////////////////////////////////
	// Fetch the config info
	////////
	function ConfigfetchDb()
	{
		$qry="SELECT * from config_setting order by config_id";	
		$result=db_query($qry) or die(db_error());
		while($row = db_fetch_array($result))
		{
			$Config[$row['config_key']]=$row['config_value'];
		}
		return $Config;
	}
	
	//////////////////////////////////
	// update the config info
	////////
	function ConfigwriteDb($new = "", $prevArray, $output = TRUE) 
	{
		global $lang, $db, $glob;
		
		if (!is_array($new)){
			$msg = "<div class='warnText'>Error trying to edit. Input data was not an array.</div>";
		}
		
		if (count($new) < 1){
			return "";
			exit;
		}
		
		// add old config vars not in $new array
		/*if(is_array($prevArray))
		{
			foreach($prevArray as $key => $value) 
			{
				if($new[$key]!==$prevArray[$key])
				{
					$newConfig[$key] = $value;
				}
			
			}
			
		}*/
		
		
		// build new config vars from $new array
		if(is_array($new))
		{
			foreach($new as $key => $value) 
			{				
				$newConfig[$key] = $value;
			}
		}
		
		// if config_key update config value else insert config key and value
		$configkeys=array_keys($newConfig);
		$i=0;
		foreach($newConfig as $key => $value)
		{	
			//echo $configkeys[$i]." : ";
			//echo $newConfig[$key];
			//echo "<BR>";	
			$qry="SELECT * FROM config_setting WHERE config_key='".trim($configkeys[$i])."'";
			$result=db_query($qry) or die(db_error());
			$nums=db_num_rows($result);
			if($nums>0)
			{
				$qry="UPDATE config_setting SET config_value='".addslashes(trim($newConfig[$key]))."' where config_key='".trim($configkeys[$i])."'";
				
				db_query($qry) or die(db_error());
				$store=TRUE;
			}
			else
			{
				$qry="INSERT INTO config_setting (config_key,config_value) VALUES('".trim($configkeys[$i])."','".addslashes(trim($newConfig[$key]))."')";
				
				db_query($qry) or die(db_error());
				$store=TRUE;
			}
			$i++;
		}
		
		if($store == TRUE)
		{
			$msg = "<div class='infoText'>Configuration Updated.</div>";
			$returnVal = TRUE;
		}
		else 
		{	
			$msg = "<div class='warnText'>Updated Failed!</div>";
			$returnVal = FALSE;
		}
		
		if($output == TRUE)
		{
			return $msg;
		} 
		else 
		{	
			return $returnVal;
		}	
	}
	
	//////////////////////////////////
	// update the config file info
	////////
	function writeConf($new = "", $path, $prevArray,$arrayName="perpage", $output = TRUE)
	{
	global $lang;
		
		if (!is_array($new)){
			$msg = "<div class='warnText'>Error trying to edit. Input data was not an array.</div>";
		}
		
		if (count($new) < 1){
			return "";
			exit;
		}
		
		// add old config vars not in $new array
		if(is_array($prevArray)){
			
			foreach($prevArray as $key => $value) {
				
				if($new[$key]!==$prevArray[$key]){
				
					$value = preg_replace("/\r/", ""   , $value);
				
					$newConfig[$key] = $value;
					
				}
			
			}
			
		}
		
		// build new config vars from $new array
		foreach($new as $key => $value) {			

			$value = preg_replace("/\r/", ""   , $value);
			
			$newConfig[$key] = $value;
		}
		
		@chmod($path,0777);
		@rename($path, $path.".bak");
		@chmod($path.".bak", 0644);
		
		$content = "<?php\n";
		// sort keys
		ksort($newConfig);
		foreach($newConfig as $key => $value){
			// strip quotes if already in
			$value = str_replace(array("\'","'"),"&#39;",$value);
			
			if (!get_magic_quotes_gpc()) {
			   $value = addslashes($value);
			}
			
			$content .= "\$".$arrayName."['".$key."'] = '".$value."';\n";
		
		}
		
		$content .= "?>";   
		if($handle = @fopen($path, "w")){
		
			fwrite($handle, $content, strlen($content));
			fclose($handle);
			$msg = "<div class='infoText'>Configuration Updated.</div>";
			$returnVal = TRUE;
		
		} else {
			
			$msg = "<div class='warnText'>Updated Failed!</div>";
			$returnVal = FALSE;
		
		}
		
		@chmod($path,0644);
		
		if($output == TRUE){
			return $msg;
		} else {
			return $returnVal;
		}
		
	}


	//////////////////////////////////
	// Alert Informarion or Errors
	////////
	function ConfigAlert_Table($class,$msg)
	{
		if(isset($msg))
		{
		?>
		<table width="100%" cellspacing="0" cellpadding="0" align="center" border="0">
		<tr>
		  <td><div class="<?php if ($class==1) { echo 'infoText';} else { echo 'warnText'; }?>"><?=stripslashes($msg)?></div><br></td>
		</tr>					
		</table>
		<?php 
		}
	
	}
	
	//////////////////////////////////
	// Format Price
	////////
	function ConfigPriceFormat($price,$cCode,$dispNull = FALSE)
	{
		
		$query = "SELECT value, symbolLeft, symbolRight, decimalPlaces, name FROM currencies WHERE code='".$cCode."'";
		$result=db_query($query) or die(db_error());
		$currencyVars=db_fetch_array($result); 
		
		if($price == TRUE){
			
			$price = $price * $currencyVars['value'];
			
			return $currencyVars['symbolLeft'].sprintf("%.".$currencyVars['decimalPlaces']."f", $price).$currencyVars['symbolRight'];
		
		} elseif($dispNull == TRUE) {
			global $currencyVars;
			return $currencyVars['symbolLeft'].sprintf("%.".$currencyVars['decimalPlaces']."f", 0.00).$currencyVars['symbolRight'];
		
		} else {
		
			return FALSE;
			
		}
	
	}
?>