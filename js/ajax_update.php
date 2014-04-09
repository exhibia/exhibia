	var ajaxTime= new Date().getTime() / 1000;
	$.ajax({
            url: siteurl+getStatusUrl,
            dataType: 'json',
            type: 'get',
            cache:false,
            timeout: ajaxTimeOut,
            data: {
                auctionlist:auctiondata
            },
            success: function(response) {
                if(response.message!='ok') return;
                var data=response.data;
                storedata = response.data;
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
                    auction_price = item.np;
                    try {
		      if(item.hu != '0'){
			  auction_bidder_name = item.hu;
		      }else{
			  auction_bidder_name = 'be the first bidder';
		      }
		     
		      if(!empty(item.backers)){
			    $('#funders_count_' + auction_id).html(item.backers);
			}
			if(!empty(item.percent_funded)){
			
			  if(item.percent_funded < 100){
			    $('#funders_bar_' + auction_id + ' span').css('borderRadius', '0px 0px 0px 10px');
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
		      $('#bids_count').html(item.my_total_bids);
		      $('#bids_count_tb').html(item.my_total_bids);
		      $('#free_bids_count').html(item.my_total_free_bids);
		      $('#free_bids_count').html(item.my_total_free_bids);
			  if($("#product_bidder_"+auction_id).length>0){
			      if(item.hu != '0'){
                                $("#product_bidder_"+auction_id).html(item.hu);
			      }else{
				$("#product_bidder_"+auction_id).html('Be the first bidder');
			      
			      }
				if(document.getElementById('bookbidbutlerbutton') & inArray(userid, item.sbids) & item.sa == '1'){
				  
				}
                            }
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
                  $('#connection_quality').qtip('destroy');
                }catch(oo){}
                GlobalVar = 1;
           },
            ajaxError: function(event, jqxhr, settings, exception) {
	      if(browser_seconds - ajaxTime >= 1){
	      }
	},
      error: function(XMLHttpRequest,textStatus, errorThrown) {
      },
       complete:function(){
           runUpdateTimer();
       },
       beforeSend:function(XMLHttpRequest){
           lastsendtime=new Date();
       }
 });
	  if (flipflop==1) {
	      flipflop = 1;
	  } else if (flipflop==2) {
	      flipflop = 1;
	  }
   