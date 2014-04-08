<?php
ini_set("max_execution_time", 300);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include("config/connect.php");
include_once 'common/sitesetting.php';
include("functions_s.php");
class Colors_CLI {
		private $foreground_colors = array();
		private $background_colors = array();
 
		public function __construct() {
			// Set up shell colors
			$this->foreground_colors['black'] = '0;30';
			$this->foreground_colors['dark_gray'] = '1;30';
			$this->foreground_colors['blue'] = '0;34';
			$this->foreground_colors['light_blue'] = '1;34';
			$this->foreground_colors['green'] = '0;32';
			$this->foreground_colors['light_green'] = '1;32';
			$this->foreground_colors['cyan'] = '0;36';
			$this->foreground_colors['light_cyan'] = '1;36';
			$this->foreground_colors['red'] = '0;31';
			$this->foreground_colors['light_red'] = '1;31';
			$this->foreground_colors['purple'] = '0;35';
			$this->foreground_colors['light_purple'] = '1;35';
			$this->foreground_colors['brown'] = '0;33';
			$this->foreground_colors['yellow'] = '1;33';
			$this->foreground_colors['light_gray'] = '0;37';
			$this->foreground_colors['white'] = '1;37';
 
			$this->background_colors['black'] = '40';
			$this->background_colors['red'] = '41';
			$this->background_colors['green'] = '42';
			$this->background_colors['yellow'] = '43';
			$this->background_colors['blue'] = '44';
			$this->background_colors['magenta'] = '45';
			$this->background_colors['cyan'] = '46';
			$this->background_colors['light_gray'] = '47';
		}
 
		// Returns colored string
		public function getColoredString($string, $foreground_color = null, $background_color = null) {
			$colored_string = "";
 
			// Check if given foreground color found
			if (isset($this->foreground_colors[$foreground_color])) {
				$colored_string .= "\033[" . $this->foreground_colors[$foreground_color] . "m";
			}
			// Check if given background color found
			if (isset($this->background_colors[$background_color])) {
				$colored_string .= "\033[" . $this->background_colors[$background_color] . "m";
			}
 
			// Add string and end coloring
			$colored_string .=  $string . "\033[0m";
 
			return $colored_string;
		}
 
		// Returns all foreground color names
		public function getForegroundColors() {
			return array_keys($this->foreground_colors);
		}
 
		// Returns all background color names
		public function getBackgroundColors() {
			return array_keys($this->background_colors);
		}
	}
	
	
$colors = new Colors_CLI();	
	
if ($_SERVER['REMOTE_ADDR'] != ''){
    exit;
 }
    
$thisloop = 0;
while($thisloop < 1){

 echo $colors->getColoredString("***********Alert Starting Auto Bidder************", "green") . "\n";
 
 
 

$adminautobidtype = Sitesetting::getAdminAutoBidderType() == '0' ? 'b' : 's';

$delay = 2;
//ini_set("max_execution_time",45000);

$qry = "select * from auction_pause_management where id=1";
$rs = db_query($qry);
$total = db_num_rows($rs);
$ob = db_fetch_object($rs);
$startpausetime = $ob->pause_start_time;
$endpausetime = $ob->pause_end_time;
$counter = 0;
$auctiontime = 0;
$scriptstarttime = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));

if ($scriptstarttime > mktime(12, 0, 0, date("m"), date("d"), date("Y"))) {
    $scriptendtime = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
} else {
    $scriptendtime = mktime(12, 0, 0, date("m"), date("d"), date("Y"));
}
$qryupdtime2 = "update auction_pause_management set referral_bids='1' where id='3'";
db_query($qryupdtime2);
$auction = FALSE;

while ($auction == FALSE) {    
    $loopstarttime = microtime(true);
    if (time() >= $scriptstarttime && time() <= $scriptendtime) {
    
    
 
    
    
        $qryupdtime = "update auction_pause_management set referral_bids=referral_bids+1 where id='3'";
        db_query($qryupdtime);
        $qrysel = "select * from auc_due_table adt inner join auction_running a on a.auctionID=adt.auction_id inner join auction_management am on a.time_duration=am.auc_manage where auc_due_time>0 and a.pause_status=0 and auc_status=2 order by auction_id";
        $ressel = db_query($qrysel);
        $total = db_num_rows($ressel);

        while ($obj = db_fetch_array($ressel)) {
        
           
           
            $time = $obj["auc_due_time"];
            $aid = $obj["auctionID"];
        
            //if ($autobidderseconds == 0) {]]]
            
            
            $make_my_time = $obj['max_plus_time'] + $delay;
            
            
                if ($time >= (0 - $delay) && $time < $make_my_time) {
                
           //  echo $colors->getColoredString("***********Updating Bids for Paused Auction************", "yellow") . "\n";
                
                
                   echo $colors->getColoredString("[[" . date("Y-m-d H:i:s") . "]] Adding Bid Butler For Auction Id => $aid", "white") . "\n";
                   
                    AddBidButler($aid, $time, $obj["use_free"]);
                } else if ($time > 0) {
                  //  AddBidButler($aid, $time, $obj["use_free"]);                    
                }
                 
//            } else {
//                if ($time > 0 && $time <= $autobidderseconds+2) {
//                    AddBidButler($aid, $time, $obj["use_free"], $lastaucseconds);
//                }
//            }
        }

        //echo $counter+'\r\n';

        $loopendtime = microtime(true);
        echo ($loopendtime - $loopstarttime) . "\r\n";
        $consumingtime = (3 - (($loopendtime - $loopstarttime)));
        if ($consumingtime > 0) {
            usleep($consumingtime * 1000000);
        }
        if ($counter >= 100) {
            $qry = "select * from auction_pause_management where id=1";
            $rs = db_query($qry);
            $total = db_num_rows($rs);
            $ob = db_fetch_object($rs);
            $startpausetime = $ob->pause_start_time;
            $endpausetime = $ob->pause_end_time;
            if ($ob->auction_end == 1) {
                //$auction = TRUE;
                exit;
            }
            $counter = 0;
        }
        $counter+=3;
        $auctiontime+=3;
        if ($auctiontime >= 303) {
            $auction = TRUE;
            echo "Success";
        }
//			sleep(1);
    } else {
        $auction = TRUE;
    }
}

}
?>
