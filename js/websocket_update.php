


   
    //Connected to server
   // websocket.onopen = function(ev) {
	
  //  }
   
   
   
    //Message Receved
   // websocket.onmessage = function(ev) {
    //   websocket.send('received');
           //   console.log(ev);
            
              response = $.parseJSON(data);
                if(response.message!='ok') return;

                var data=response.data;
                storedata = response.data;

               // log((new Date()-lastsendtime)/1000-response.time+' '+response.time);


                $.each(data, function(i, item) {
               
		   
		   
                    auction_id = item.id;
                    
                    if(item.reserve_icon == "true"){
	  
			  reserve_icon(item.id);
	  
	  
			  }
		    if(item.bids_to_take > 1){
		    
			bids_to_take(item.id, item.bids_to_take);
		    
		    }
		    <?php
                      foreach($addons as $key => $value){

			if(file_exists($BASE_DIR . "/include/addons/$value/data.php")){

			      include($BASE_DIR . "/include/addons/$value/data.php");

			}


			}
		    ?>
	 if(!empty(item.backers)){
	    $('#funders_count_' + auction_id).html(item.backers);
	 }
	 if(!empty(item.percent_funded)){
	    if(item.percent_funded < 100){
	      $('#funders_bar_' + auction_id + ' span').css('border-radius', '0px 0px 0px 10px');
	    }
	    if(item.percent_funded <= 100){
		$('#funders_bar_' + auction_id + ' span').css('backgroundWidth', item.percent_funded + '%');
		$('#funders_bar_' + auction_id + ' span').css('width',  item.percent_funded + '%');
	    }else{
		$('#funders_bar_' + auction_id + ' span').css('backgroundWidth', '100%');
		$('#funders_bar_' + auction_id + ' span').css('width',  '100%');
	    }
	    $('#funders_percent_' + auction_id).html(item.percent_funded + '%');
	 }		
	 $('#auc_time_' + auction_id).html("timer: " + data.at + " sec");
                    auction_price = item.np;
                    try {
                    auction_bidder_name = item.hu;
                    if($('#price_index_page_' + auction_id).html() == '---'){
                    
			    $("#product_bidder_"+auction_id).html(item.hu);
                    
                    }else
                    
			if($("#product_bidder_"+auction_id).length>0 & !empty(item.hu) & item.hu != '---'){
			   
			
			    if(parseFloat(item.np) > parseFloat($('#price_index_page_' + auction_id).html())){
			    $("#product_bidder_"+auction_id).html(item.hu);
				if(document.getElementById('bookbidbutlerbutton') & inArray(userid, item.sbids) & item.sa == '1'){
				  
				}
			}
			      
		   }
                    
                    
		    $('#bids_count').html(item.my_total_bids);
		    $('#bids_count_tb').html(item.my_total_bids);
		    $('#free_bids_count').html(item.my_total_free_bids);
		    $('#free_bids_count').html(item.my_total_free_bids);

		
		    
                      }catch(o){}
                     if(item.bids_back){
		   
			 $('#bids_back_' + auction_id).html(item.bids_back);
			 
		       }
		       if(item.free_bids){
			 $('#free_bids_' + auction_id).html(item.free_bids);
			 
		       }        
                            
                    auction_price = item.np;
                    if(reloadWhenEnd==true && item.lt==0){
			if(!item.newreserve){
			  //  $('#counter_index_page_' + auction_id).qtip('destroy');//testing
			}
                        window.location.reload();
                    }

                    if(typeof(updateAuction)=='function'){
                        updateAuction(auction_id,'<?php echo $Currency; ?>'+auction_price,item.lt);
                    }
              
                  

                    if(item.sa==true){
		   
			update_seat_info(auction_id, item);
			timer_update_ui(auction_id, item);
			updateHistory(auction_id, item);

                    }
		   
                    if(item.ua==false){
		      
                       
			timer_update_ui(auction_id, item);
			updateHistory(auction_id, item);
                    }else{
                      
			timer_update_ui(auction_id, item);
			updateHistory(auction_id, item);
                    }
                    
                    
               if(getCookie('po[' + auction_id + ']')){
		 
		 change_auction(getCookie('po[' + auction_id + ']'), auction_id)
		  
		}
                });
                try{
               
                }catch(oo){}
                GlobalVar = 1;
		  
                
           //     }
       


   
   
    //Error
  //  websocket.onerror = function(ev) {
  //     use_ajax();
  //  };
   
   
