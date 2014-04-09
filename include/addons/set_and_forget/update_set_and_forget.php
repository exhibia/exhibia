<?php
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);
require("../../../config/config.inc.php");
@db_query("alter table autolister add column beginner_auction int(1) null default '0'");

     db_connect($DBSERVER, $USERNAME, $PASSWORD);


    db_select_db($DATABASENAME);
    
 if(!class_exists('Colors')){
	class Colors {
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
    }
 
 
 
 $i = 0;
 $colors= new Colors();
  
 echo $colors->getColoredString("Starting Set And Forget Plugin", "blue")."\n";
 
 
 //while($i < 1){
 
 
 

$timestamp = time();

 echo $colors->getColoredString("[" . date("Y-m-d H:i:s") . "]", "white") . "\n";
 
 $loop = 0;

      
      $settings = array();
      $settings_sql = db_query("select * from autolister_settings");
      
      while($row_settings = db_fetch_array($settings_sql)){
      
	  $auto_settings[$row_settings['setting']] = $row_settings['value'];
      
      }

     echo db_error();
    $qry = db_query("select * from auction where auction.auc_status=2");
      if(db_num_rows($qry) >= $auto_settings['max_auctions']){
		
      
      }else{
      

$num_running = db_num_rows(db_query("select * from auction where auction.auc_status=2"));


 $odd_even = 0;
 $auction_counter = 0;
 
 $auto_exists = db_num_rows(db_query("select * from autolister where auction_id = 'waitting' or auction_id = ''"));
 
 $runs = $auto_settings['max_auctions'] - $auto_exists;
 print_r($auto_settings);

echo "$auction_counter <= $runs";
     
     while($auction_counter <= $runs ){
    
     $sql = db_query("select productID, c.categoryID, c.name as catname, products.name as name, price,  default_tx1, default_tx2, default_shippingmethod from products left join categories c on c.categoryID=products.categoryID order by productID asc limit 0, $runs");
    // db_query("insert into autolister values(null, '$sort', '$timestamp', '$row[productID]', '0.01', '$row[default_tx1]', '$row[default_tx2]', '$row[default_shippingmethod]', '$row[price]', '$auto_settings[delay]', '$auto_settings[runtime]', '1', '1', '1', '$nailbiter', '$offauction', '', '$openauction', '$pa', '$fixedpriceauction', '$reverseauction', 'waitting', '', '$halfback',  '1', '', '', '$beginner');"); 
     
	while($row = db_fetch_array($sql)){
	
	$timestamp = strtotime('+3 minutes', time());
	
	
	   //if(db_num_rows(db_query("select * from autolister where productID = '$row[productID]' and auction_id NOT REGEXP '[[:digit:]]'")) == 0){
	    
	    //	if(db_num_rows(db_query("select set_and_forget from products where productID = '$row[productID]'")) >= 1){
		      $loop++;
	    
		      $sort = db_fetch_array(db_query("select sort, timestamp from autolister where timestamp = '$timestamp' order by id desc limit 1"));
			
			
			  if(empty($sort[0])){
				$sort = 1;
			  }else{
			  $sort = $sort[0];
			  }
		
		$sort = $sort[0] + 1;
		
		echo $colors->getColoredString("Adding new Auction for $row[name] $auction_counter", "red") . "\n";
		$auction_type = rand(1,4);
		
		
		if($auto_settings['pa'] == 'alternate'){
		    if($auction_counter % 2 == 0){
			$pa = 1;
		    }else{
		      $pa = '';
		    }
		
		}else{
		
		   $pa = $auto_settings['pa'];
		
		}
		
		
		if($auto_settings['fixedpriceauction'] == 'alternate'){
		
		    if($auction_counter % 8 == 0 ){
			$fixedpriceauction = 1;
		    }else{
			$fixedpriceauction =  '';
		    }
		
		}
		if($auto_settings['halfback'] == 'alternate'){ //  & $fixedpriceauction != 1){
		    if($auction_counter % 4 == 0){
			$halfback = 1;
		    }else{
		    
			$halfback = '';
		    
		    }
		
		}
		if($auto_settings['openauction'] == 'alternate'){ // & $fixedpriceauction != 1 & $halfback != 1){
		    if($auction_counter % 5 == 0){
			$openauction = 1;
		    }else{
			$openauction =  '';
		    
		    
		    }
		
		}
		if($auto_settings['beginner'] == 'alternate'){
		    if($auction_counter % 3 == 0){
			$beginner = 1;
		    }else{
			$beginner =  '';
		    
		    
		    }
		
		}
		if($auto_settings['offauction'] == 'alternate'){ //  & $fixedpriceauction != 1 & $halfback != 1 & $openauction != 1){
		    if($auction_counter % 6 == 0){
			$offauction = 1;
		    }else{
			$offauction =  '';
		    
		    
		    }
		
		}
		if($auto_settings['nailbiter'] == 'alternate'){ //  & $fixedpriceauction != 1 & $halfback != 1 & $openauction != 1 & $offauction != 1){
		    if($auction_counter % 7 == 0){
			$nailbiter = 1;
		    }else{
			$nailbiter =  '';
		    
		    
		    }
		
		}
		$auction_counter++;
		if($auction_counter > $runs){
		    break;
		
		}
		//db_query("insert into autolister values(null, '$sort', '$timestamp', '$row[productID]', '0.01', '$row[default_tx1]', '$row[default_tx2]', '$row[default_shippingmethod]', '$row[price]', '$auto_settings[delay]', '$auto_settings[runtime]', '', '1', '1', '', '', '', '$auto_settings[openauction]', '$auto_settings[pa]', '$auto_settings[fixedpriceauction]', '$auto_settings[reverseauction]', '', '', '$auto_settings[halfback]',  '1', '', '');");
		db_query("insert into autolister values(null, '$sort', '$timestamp', '$row[productID]', '0.00', '$row[default_tx1]', '$row[default_tx2]', '$row[default_shippingmethod]', '$row[price]', '$auto_settings[delay]', '$auto_settings[runtime]', '1', '1', '1', '$nailbiter', '$offauction', '', '$openauction', '$pa', '$fixedpriceauction', '$reverseauction', 'waitting', '', '$halfback',  '1', '', '', '$beginner');"); 
		
		$last = db_insert_id($db);
		if($row['enable_reserve'] == 1){
		
		    if($row['reserve'] >= '0.01'){
		      db_query("update autolister set reserve = '1' where id = '$last'");
		    }
		
		}
		if($auto_settings['allowbuynow'] >= '1'){
		
		
		    db_query("update autolister set allow_buy_now = '1' where id = '$last'");
		   db_query("update autolister set buynowprice = '$row[price]' where id = '$last'");
		
		}
		
		  
	    echo db_error();
	    //}
		  
	   // }
	   
	
	$odd_even++;
	}
	echo db_error();
    
// db_free_result($row);

//usleep(2000);
	    
	}
 
    }
 echo db_error();
 $i = 3;
 
// }

shell_exec("cd $BASE_DIR/include/addons/autolister/");
include("$BASE_DIR/include/addons/autolister/update_autolister.php");
