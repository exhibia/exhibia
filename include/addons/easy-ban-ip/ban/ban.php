<?
include $banippath."functions_ban.php";

$ips		= array();
$content1 	= file($banippath.'data.txt');
$continut	= explode("$#",$content1[0]);
	foreach($continut as $val){
		$expl=explode('|',$val);
		list($ip,$timestamp,$type)=$expl;
			$ips[$ip]['timestamp']=$timestamp;
			$ips[$ip]['type']=$type;
		
	}
foreach($ips as $ip=>$val){
	$xpl=explode('.',$ip);
		if($xpl[3]=='*'){//wildcard
			$explode=explode('.',$_SERVER['REMOTE_ADDR']);
			unset($explode[3]);
			unset($xpl[3]);
				$ipfinal=implode('.',$explode);
				$ipfinal2=implode('.',$xpl);
				
			if($ipfinal==$ipfinal2){
					$banned='Your IP belongs to a class that has been banned from this site!';
				}			
		}else{
			if($ip==$_SERVER['REMOTE_ADDR']){
				$banned='Your IP address has been banned!';
			}
		}
		if($banned){
		if($_GET['check']=='javascript'){echo 1;die();}
			$tpl = new TPL($banippath."banned.html");
			if($val['timestamp']=='permanent')$expires='PERMANENT';else $expires=countdown($val['timestamp']);
			 $tpl->replace_tags(array(
				"REMAINING" 		=> $expires,
				"BANNED" 			=> $banned,
				"BANIP" 			=> $ip,
				"BANTYPE" 			=> time2type($val['type'])	
			  ));
			  $tpl->output();
			  die();
		}
}
?>