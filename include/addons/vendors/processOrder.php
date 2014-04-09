<?php

     
            
            if(db_num_rows(db_query("select * from products p left join auction a on a.productID=p.productID left join won_auctions w on w.auction_id = a.auctionID  left join registration r on w.userid=r.id where a.auctionID=$wonaucid and p.vendor != '' and p.vendor != 'NULL'")) >= 1){
            
         
            $info = array();
            $info['NAME'] = $rowauction['name'];
            $info['SHORT_DESC'] = $rowauction['short_desc'];
            $info['TRANSACTIONID'] = $orderid;
         
            
		$user_info = db_fetch_array(db_query("select email from registration where username = '$rowauction[username]' limit 1"));
		
		$info['USERNAME'] = $rowauction['username'];
		$info['EMAIL'] = $user_info['email'];
		
		
		$emailtemplate = db_fetch_array(db_query("select * from emailtemplate where id = 12"));
		$mailcontent = $emailtemplate['content'];
		
		foreach($info as $key2 => $value2){
		
		if($key2 != 'SHORT_DESC'){
		  $mailcontent = str_replace("[[$key2]]", ucfirst(strtolower($key2)) . ": " . "$value2", $mailcontent); 
		  
		  }else{
		  $mailcontent = str_replace("[[$key2]]", "Description: " . "$value2", $mailcontent);
		  }
		}
		 $from = Sitesetting::getEmailNoDb();
		 $mailcontent .= "If your ISP has disabled HTML Email Your Information is Below<br />\n";
		 $mailcontent .= $info['EMAIL'] . "<br />";
		 $mailcontent .= $info['TRANSACTIONID'] . "<br />";
		
		 
		
		SendHTMLMail($info['EMAIL'] , $emailtemplate['subject'], $mailcontent, $from);
            }
