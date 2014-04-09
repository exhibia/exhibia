<?php
########################################
#									   #
#   (C) 2007 by CTXtra				   #
#	http://www.ctxtra.de			   #
#									   #
#	Version: V1.5					   #
#									   #
########################################

if (!defined('CTXTRA'))
	die ("Hacking attempt...");

// Whiteliste Speichern
$info_speichern = "";
if (isset($_POST['submit_worm_whitelist'])) {
	
	$fp_whitelists = @fopen($ct_whitelistes, "w+");

	@fwrite($fp_whitelists, "<?php\n");
	@fwrite($fp_whitelists, "########################################\n");
	@fwrite($fp_whitelists, "#									   #\n");
	@fwrite($fp_whitelists, "#   (C) 2007 by CTXtra				   #\n");
	@fwrite($fp_whitelists, "#	http://www.ctxtra.de			   #\n");
	@fwrite($fp_whitelists, "#									   #\n");
	@fwrite($fp_whitelists, "#	Version: V1.5					   #\n");
	@fwrite($fp_whitelists, "#									   #\n");
	@fwrite($fp_whitelists, "#--------------------------------------#\n");
	@fwrite($fp_whitelists, "#									   #\n");
	@fwrite($fp_whitelists, "#	Wormprotector by schlumpfi		   #\n");
	@fwrite($fp_whitelists, "#									   #\n");
	@fwrite($fp_whitelists, "########################################\n\n");
	
	$explode = explode(",", $_POST['worm_whitelist']);
	$i=0;
	while ($i<count($explode)) {
		if (!empty($explode[$i])) {
			$signature = rawurlencode($explode[$i]);
			@fwrite($fp_whitelists, "\$whitelist_wormprotector[".$i."]	= '".$signature."';\n");
		}
		$i++;				
	}

	@fwrite($fp_whitelists, "\n?>");

	@fclose($fp_log); 
	$info_speichern = '<span style="color:#008000; font-weight:bold">'.$txt_wormprotector[24].'</span>';

	unset($whitelist_wormprotector);

	if(!$fp_whitelists) {
		ct_whitelists();
	}
} elseif (isset($_GET['add_white_signatur'])) {
	$signature_get = $_SESSION['explode_signatur_'.$_GET['add_white_signatur']];
	
	if(!isset($whitelist_wormprotector)) {$whitelist_wormprotector = array();}
	if (!@in_array ($signature_get, $whitelist_wormprotector)) {
		$fp_whitelists = @fopen($ct_whitelistes, "w+");
	
		@fwrite($fp_whitelists, "<?php\n");
		@fwrite($fp_whitelists, "########################################\n");
		@fwrite($fp_whitelists, "#									   #\n");
		@fwrite($fp_whitelists, "#   (C) 2007 by CTXtra				   #\n");
		@fwrite($fp_whitelists, "#	http://www.ctxtra.de			   #\n");
		@fwrite($fp_whitelists, "#									   #\n");
		@fwrite($fp_whitelists, "#	Version: V1.5					   #\n");
		@fwrite($fp_whitelists, "#									   #\n");
		@fwrite($fp_whitelists, "#--------------------------------------#\n");
		@fwrite($fp_whitelists, "#									   #\n");
		@fwrite($fp_whitelists, "#	Wormprotector by schlumpfi		   #\n");
		@fwrite($fp_whitelists, "#									   #\n");
		@fwrite($fp_whitelists, "########################################\n\n");
		
		$i=0;
		while ($i<count($whitelist_wormprotector)) {
			if (!empty($whitelist_wormprotector)) {
				$signature = $whitelist_wormprotector[$i];
				@fwrite($fp_whitelists, "\$whitelist_wormprotector[".$i."]	= '".$signature."';\n");
			}
			$i++;				
		}
		
		@fwrite($fp_whitelists, "\$whitelist_wormprotector[".$i++."]	= '".$signature_get."';\n");
		unset($signature_get);
		
		@fwrite($fp_whitelists, "\n?>");
	
		@fclose($fp_log); 
		$info_speichern = '<span style="color:#008000; font-weight:bold">'.$txt_wormprotector[24].'</span>';
	
		unset($whitelist_wormprotector);
	
		if(!$fp_whitelists) {
			ct_whitelists();
		}
	}
}


include($ct_whitelistes);
// wenn signaturen in der whitelist
if (isset($whitelist_wormprotector)) {
	$i=0; $signaturen = "";
	while ($i<count($whitelist_wormprotector)) {
		if (!empty($whitelist_wormprotector[$i])) {
			$signaturen[] .= urldecode($whitelist_wormprotector[$i]);
		} else {$signaturen[] = "";}
		$i++;				
	}
	
	$count_signaturen	= count($signaturen);
	$signaturen			= implode(",", $signaturen);
} else {
	$count_signaturen	= "0";
	$signaturen			= "";
}

// IP zum filter hinzufügen (IP sperren)
if (isset($_GET['ip_add'])) {
	$fp_ips = @fopen($ct_log_ips, "a+");
	
	// Lese text datei in Array und lösche leere zeilen
	$ip_zeilen[]="";
	if (file_exists($ct_log_ips)) {
		while (!feof($fp_ips)) {
			$zeile = trim(fgets($fp_ips,4096));
			if (!empty($zeile)) {
				$ip_zeilen[] = $zeile;
			}
		}
	}
	// Überprüfe ob neue IP schon vorhanden
	if (!in_array($_GET['ip_add'], $ip_zeilen)) {
		@fwrite($fp_ips, $_GET['ip_add']."\n");
	}

	@fclose($fp_ips); 
	double_entry();
}

// IP aus filer entfernen (IP nicht mehr sperren)
if (isset($_GET['ip_del'])) {
	$fp_ips = @fopen($ct_log_ips, "a+");
	
	// Lese text datei in Array und lösche leere zeilen und IP
	$ip_zeilen[]="";
	if (file_exists($ct_log_ips)) {
		while (!feof($fp_ips)) {
			$zeile = trim(fgets($fp_ips,4096));
			if (!empty($zeile) AND $zeile != $_GET['ip_del']) {
				$ip_zeilen[] = $zeile;
			}
		}
	}
	@fclose($fp_ips); 
		
	// schreibe neue IP Liste
	$fp_ips = @fopen($ct_log_ips, "w");
	$i=0; 
	while($i<count($ip_zeilen)) {
		@fwrite($fp_ips, $ip_zeilen[$i]."\n");
		$i++;
	}
	@fclose($fp_ips); 

	double_entry();
}


angriff_loeschen();


if (count_attacks() != 0){
	$hack_download 		= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[ <a href="index.php?hack=true&download='.basename($ct_log_file).'">'.$txt_wormprotector[26].'</a> ]';
} else {$hack_download	= '';}


$temp_count_attacks = count_attacks();


$zeilen = @array_reverse(@file($ct_log_file));
if (count($zeilen) <= 2) {
	$div_height = "50px";
} elseif (count($zeilen) <= 4) {
	$div_height = "90px";
} elseif (count($zeilen) <= 6) {
	$div_height = "130px";
} elseif (count($zeilen) <= 8) {
	$div_height = "170px";
} elseif (count($zeilen) >= 9) {
	$div_height = "200px";
}


if (count_attacks() == 0){$border="";} else {$border="border:1px solid #999999;";}

$temp_count_attacks_list[0] = '';
$i=0;
while ($i < count($zeilen)) {
	$ct_log = trim($zeilen[$i]);
	$ct_log = str_replace( "\n", "<br />", $ct_log );
	$explode = explode("!!", $ct_log); 
	if (count($explode) > 3 && count($zeilen) > 0) {

		if ($explode[2] == 1) {$angriffe_einzahl = $txt_wormprotector[11];} else {$angriffe_einzahl = $txt_wormprotector[12];}
		if (!isset($explode[12])) {$explode[12] = $txt_wormprotector[36]; $no_signature=true;}
											
		$_SESSION['explode_time_'.$i]		= $explode[1];
		$_SESSION['explode_angriffe_'.$i]	= $explode[2];
		$_SESSION['explode_angriff_'.$i]	= $explode[3];
		$_SESSION['explode_remoteadr_'.$i]	= $explode[4];
		$_SESSION['explode_useragent_'.$i]	= $explode[5];
		$_SESSION['explode_refferer_'.$i]	= $explode[6];
		$_SESSION['explode_type_'.$i]		= $explode[7];
		$_SESSION['explode_cookie_'.$i]		= $explode[8];
		$_SESSION['explode_protocol_'.$i]	= $explode[9];
		$_SESSION['explode_method_'.$i]		= $explode[10];
		$_SESSION['explode_uri_'.$i]		= $explode[11];
		$_SESSION['explode_signatur_'.$i]	= $explode[12];
		
		$pruefzahl = $i % 2;
		$restwert = $pruefzahl % 2;
		if ($restwert == 1) {$tr_bg = 'style="background-color:#E7E7E7"';} else {$tr_bg = 'style="background-color:#F9F9F9"';}
		if ($explode[3] == "ctxtra_dummy&chr(" AND $explode[11] == $ct_filedir."/index.php?ctxtra_dummy&chr(") {
			$negativ_hack = ' <img src="'.$ct_imagedir.'info.gif" border="0" title="'.$txt_wormprotector[10].'" alt="'.$txt_wormprotector[10].'"/>';
			$tr_bg = 'style="background-color:#CCFFCC"';
		} elseif ($explode[4] == $_SERVER['REMOTE_ADDR']) {
			$negativ_hack = ' <img src="'.$ct_imagedir.'info.gif" border="0" title="'.$txt_wormprotector[20].'" alt="'.$txt_wormprotector[20].'"/>';
			$tr_bg = 'style="background-color:#FFFFD2"';
		} else {
			$negativ_hack="&nbsp;";
		}
		
		if (isset($no_signature)) {
			$signatur = '<img src="'.$ct_imagedir.'bug.gif" border="0" title="'.$explode[12].'" alt="'.$explode[12].'"/>';
		} else {
			$signatur_get = rawurlencode($explode[12]);
			$signatur = '<a href="index.php?hack=true&add_white_signatur='.$i.'"><img src="'.$ct_imagedir.'bug.gif" border="0" title="'.$explode[12].' - '.$txt_wormprotector[37].'" alt="'.$explode[12].' - '.$txt_wormprotector[37].'"/></a>';
		}
		
		$temp_count_attacks_list[0] .= '
        <tr '.$tr_bg.'> 
		    <td style="width:5px">&nbsp;</td>
          	<td style="text-align:middel; vertical-align:middle; width:570px">
				<span style="font-size:10px; color:#000000; font-family:verdana,arial">
					<input type="checkbox" name="zeile['.$i.']"  value="'.$i.'" /> '.$explode[2].' '.$angriffe_einzahl.' '.$txt_wormprotector[13].' '.$explode[4].' <b>'.$txt_wormprotector[14].' '.date("d.m.Y", $explode[1]).'</b> '.$txt_wormprotector[15].' '.date("H", $explode[1]).', <b>'.$txt_wormprotector[16].' '.date("H:i:s", $explode[1]).'</b>
					<input type="hidden" name="ip['.$i.']" value="'.$explode[4].'" />
	        	</span>
		  	</td>';
			
			// Lese Textdatei in ein Array und 					  	
			$is_ip_ary = file($ct_log_ips);
		  	
		  	// Prüfe ob IP im Array (Filter) existiert
		  	$key = in_array($explode[4], $is_ip_ary); 
  	
		  	if($key) {
			  	$is_ip_img1		= "green1.gif";
				$is_ip_img2		= "red2.gif";
				$is_ip_title1	= $txt_wormprotector[27];
				$is_ip_title2	= $txt_wormprotector[28];
			} else {
				$is_ip_img1		= "green2.gif";
				$is_ip_img2		= "red1.gif";
				$is_ip_title1	= $txt_wormprotector[29];
				$is_ip_title2	= $txt_wormprotector[30];
			}
		  	$temp_count_attacks_list[0] .= '
		  	<td style="width:80px">'.$signatur."&nbsp;".$negativ_hack.'</td>
		  	<td style="width:50px">
				<a href=""><a href="index.php?hack=true&ip_add='.$explode[4].'"><img src="'.$ct_imagedir.$is_ip_img1.'" alt="'.$is_ip_title1.'" title="'.$is_ip_title1.'" border="0" /></a>&nbsp;
				<a href="index.php?hack=true&ip_del='.$explode[4].'"><img src="'.$ct_imagedir.$is_ip_img2.'" alt="'.$is_ip_title2.'" title="'.$is_ip_title2.'" border="0" /></a>
			</td>
		  	<td style="width:50px">[ <a href="includes/more.php?moreworm=true&id='.$i.'">'.$txt_wormprotector[17].'</a> ]</td>
		  	<td style="width:5px">&nbsp;</td>
        </tr>';
		$schleife = true;
	}
    $i++;
}


if (count_attacks() == 0){
	$temp_count_attacks_button = '
    <tr>          
      <td style="text-align:middel; vertical-align:middle;">
		<span style="font-size:10px; color:#000000; font-family:verdana,arial">'.$txt_wormprotector[18].'</span>
	  </td>
    </tr>';
} elseif (count_attacks() != 0){
	$temp_count_attacks_button = '
	<br />
	<input type="radio" name="submit_del" value="del_log" /> '.$txt_wormprotector[31].'<br />
	<input type="radio" name="submit_del" value="del_log_ip" /> '.$txt_wormprotector[32].'<br />
	<br />
	<input type="radio" name="submit_del" value="del_all" id="all" onclick="mark(this.checked,\'zeile\')" /> '.$txt_wormprotector[33].'<br />
	<input type="radio" name="submit_del" value="del_all_ip" id="all" onclick="mark(this.checked,\'zeile\');" /> '.$txt_wormprotector[34].'<br />
	<br />
	<input type="radio" name="submit_del" id="all" onclick="unmark(this.checked,\'zeile\')" /> '.$txt_wormprotector[35].'<br />
	<br /><input type="submit" name="submit_del_log" value="'.$txt_wormprotector[19].'" />';
}


$temp = file("templates/wormprotector.html");
for($i=0;$i<count($temp);$i++){
	$temp[$i] = ereg_replace("!--txt_wormprotector1--", $txt_wormprotector[1], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_wormprotector2--", $txt_wormprotector[2], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_wormprotector3--", $txt_wormprotector[3], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_wormprotector4--", $txt_wormprotector[4], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_wormprotector5--", $txt_wormprotector[5], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_wormprotector6--", $txt_wormprotector[6], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_wormprotector7--", $txt_wormprotector[7], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_wormprotector8--", $txt_wormprotector[8], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_wormprotector9--", $txt_wormprotector[9], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_wormprotector21--", $txt_wormprotector[21], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_wormprotector22--", $txt_wormprotector[22], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_wormprotector23--", $txt_wormprotector[23], $temp[$i]);
	$temp[$i] = ereg_replace("!--txt_wormprotector25--", $txt_wormprotector[25], $temp[$i]);
	

	$temp[$i] = ereg_replace("!--server_remote_addr--", $_SERVER['REMOTE_ADDR'], $temp[$i]);
	$temp[$i] = ereg_replace("!--count_signaturen--", "$count_signaturen", $temp[$i]);
	$temp[$i] = ereg_replace("!--signaturen--", "$signaturen", $temp[$i]);
	$temp[$i] = ereg_replace("!--info_speichern--", "$info_speichern", $temp[$i]);
	$temp[$i] = ereg_replace("!--hack_download--", "$hack_download", $temp[$i]);
	$temp[$i] = ereg_replace("!--count_attacks--", "$temp_count_attacks", $temp[$i]);
	$temp[$i] = ereg_replace("!--div_height--", "$div_height", $temp[$i]);
	$temp[$i] = ereg_replace("!--count_attacks_list--", $temp_count_attacks_list[0], $temp[$i]);
	$temp[$i] = ereg_replace("!--count_attacks_button--", $temp_count_attacks_button, $temp[$i]);

	$site .= $temp[$i];
}


?>
