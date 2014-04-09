<?php

    $fund_data = db_fetch_array(db_query("select * from auction_escrow where transaction_id = '$row[orderid]'"));
    
    $escrow_data = db_fetch_array(db_query("select sum(bids_pledged) as bids from auction_escrow where auction_id = '$fund_data[auction_id]'"));
    $auction_qry = db_query("select * from auction where auctionID = '$fund_data[auction_id]' and escroe = '1'");
    if(db_num_rows($auction_qry) > 0){
    db_query("update auction_escrow set completed = '1' where transaction_id = '$row[orderid]'"); 
	$auction_escroe = db_fetch_array($auction_qry);
	
	if($escrow_data['bids'] >= $auction_escroe['escroe_bids']){
	
	    if(db_num_rows(db_query("select * from auction where escroe = '0'")) < 20){
	     // db_query("update auction set escroe = '0' where auctionID = '$fund_data[auction_id]' and escroe = '1'");
	    }
	}
    }
    
?>