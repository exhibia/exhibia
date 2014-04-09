<?
$content2 	= @file('ban/data.txt');
$continut3	= explode("$#",$content2[0]);

foreach ($continut3 as $val){
		$expl=explode('|',$val);
			list($ip,$timestamp,$type)=$expl;
		if($timestamp>time()){
			$continut4[]=$val;		
		}
}
$fp		=@fopen('ban/data.txt','w');
$string=@implode("$#",$continut4);
		@fwrite($fp, $string);
		@fclose($fp);



class TPL{
    var $tpl;
    function TPL($template){
      if (file_exists($template)){
        $this->tpl = join("", file($template));
      }else if (file_exists($pathway."".$template)){
        $this->tpl = join("", file($pathway."".$template));
      }else{
        echo "Template file ".$template." not found.";
      }
    }
    function parse($tplfile) {
      extract($GLOBALS);
      ob_start();
      include($tplfile);
      $buffer = ob_get_contents();
      ob_end_clean();
      return $buffer;
    }
    function replace_tags($tags = array()) {
      if (sizeof($tags) > 0){
        foreach ($tags as $tag => $data) {
          $data = (strstr($data, "data") || strstr($data, "template") || strstr($data, "panels") || strstr($data, "pages")) ? $this->parse($data) : $data;
          $this->tpl = str_replace("{" . $tag . "}", $data, $this->tpl);
          }
      }else{
        echo "Nothing to replace.";
      }
    }
    function output() {
      echo $this->tpl;
    }   

	function outret() {
      return $this->tpl;
    }
  }
 
 
class ipology
{
    var $_ip = "255.255.255.255";
    var $_whois = "whois.ripe.net";
    var $_port = 43;
    var $_timeout = 10;
    var $_buffer = "";
    var $out = array();
    var $array_return_mode;
    var $_total = 0;

    function ipology($ip_array, $array_return_mode = "array")
    {
        $this->array_return_mode = $array_return_mode;
        $ip_array = (array) $ip_array;
        $this->_total = count($ip_array);
        $i = 0;
        foreach($ip_array as $ip)
        {
            if($this->isValidIP($ip))
            {
                $this->_ip = $ip;
                if($this->_fetch())
                {
                    $this->out[$ip] = $this->_extract();
                    if($this->out[$ip]["inetnum"] == "0.0.0.0 - 255.255.255.255")
                        $this->out[$ip] = 102;
                }
                else
                {
                    $this->out[$ip] = 101; //could not connect
                }
            }
            else
                $this->out[$ip] = 100; //incorrect IP format
        }
    }

    function _fetch()
    {

    }

    function _extract()
    {
        $ret = array();
        $w = array("inetnum","org","netname","descr","country","tech-c","status","mnt-by","mnt-lower","mnt-routes","organisation","org-name","org-type","address","phone","fax-no","e-mail","mnt-ref","person","nic-hdl","route","origin","remarks");
        foreach($w as $get)
        {
            if(preg_match_all("/$get:\s*(.*+)/i", $this->_buffer, $matches))
            {
                if(count($matches[1]) > 1)
                {
                    if($this->array_return_mode == "array")
                        $ret[$get] = $matches[1];
                    else
                        foreach($matches[1] as $ras)
                            $ret[$get] .= $ras . "\n";
                }
                else
                    $ret[$get] = $matches[1][0];
            }
        }
        return $ret;
    }

    function isValidIp($ip)
    {
        return preg_match("/(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/", $ip) ? true : false;
    }

    function out($w=0)
    {
        return $this->out;
    }
}

function countdown($timestamp)
{
  // make a unix timestamp for the given date
  $the_countdown_date = $timestamp;

  // get current unix timestamp
  $today = time();

  $difference = $the_countdown_date - $today;
  if ($difference < 0) $difference = 0;

  $days_left = floor($difference/60/60/24);
  $hours_left = floor(($difference - $days_left*60*60*24)/60/60);
  $minutes_left = floor(($difference - $days_left*60*60*24 - $hours_left*60*60)/60);
  
  if($days_left>1)$s1='s';
  if($hours_left>1)$s2='s';
  if($minutes_left>1)$s3='s';
  
  // OUTPUT
 return $days_left." day".$s1." ".$hours_left." hour".$s2." ".$minutes_left." min".$s3.".";
}


function time2type($id){
	if($id=='12') return "12 Hours";
	if($id=='24') return "One Day";
	if($id=='48') return "Two Days";
	if($id=='72') return "Three Days";
	if($id=='168') return "One Week";
	if($id=='336') return "Two Weeks";
	if($id=='744') return "A Month";
	if($id=='8760') return "A Year";
	if($id=='permanent') return "Permanent";
}

function is_ip($str) // Returns True if the given string is a IP address
{
if ((substr_count($str, ".") != 3) or (empty($str))) { return false; }

$ip_array = explode(".", $str);

for ($i = 0; $i < count($ip_array); $i++)
{
   if (($ip_array[$i] > 256) or (!is_numeric($ip_array[$i])))
   {
     return false;
   }
}

return true;
}

?>