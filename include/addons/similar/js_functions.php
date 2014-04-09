
function change_box( key, value, aucid){
    
    
		      var url_set =function(data, aucid){
		     
			   $('#auction_' + aucid + ' .prodtitle').find('a:nth-child(1)').attr('href', decodeURIComponent(data));
			  $('#auction_' + aucid + ' .prodtitle').find('a:nth-child(1)').attr('href', decodeURIComponent(data));

		      }

		      var saving_set = function(data, aucid){

			    $('#fprice').html(decodeURIComponent(data))

		      }

		      var  price_set = function(data, aucid){
			    $('#price').html(decodeURIComponent(data));


		      }
		      var  prodtitle_set = function(data, aucid){

			    $('#auction_' + aucid + ' .prodtitle').find('a:nth-child(1)').html(decodeURIComponent(data));

		      }

		      var  buynow_set = function(data, aucid){
		 
			    $('#btn-buy_' + aucid).attr('onclick', 'window.location.href = \'' + decodeURIComponent(data) + '\'');//wavee and sticky


		      }
		      var bidbutton_set = function(data, aucid){
		  
			    prompt(decodeURIComponent(data));


		      }
		      var description_set = function(data, aucid){
		     
			    prompt(decodeURIComponent(data));

		      }
		      var savingspercent_set = function(data, aucid){
		    
			    prompt(decodeURIComponent(data));
		      }
		      var bidsback_set = function(data, aucid){

		     
			    prompt(decodeURIComponent(data));

		      }
		      var img_set =function(data, aucid){
		     
			    $('#auction_' + aucid + ' .product-image-small').find('img:nth-child(1)').attr('src', decodeURIComponent(data)); //wavee and sticky main page

		      }
		      var aid_set = function(data, aucid){



		      }
    
	eval( key  + '_set("' + value + '",' +  aucid + ')' );

 

}
function change_auction(which, auction_id){
  
 if(which == 1 | which == -1){
   
   //prompt('<?php echo $SITE_URL; ?>/include/addons/similar/json_new.php?auction_id=' + auction_id + '&which=back');
   
    if(which == 1){
      $.ajax({
      
	url: '<?php echo $SITE_URL; ?>/include/addons/similar/json_new.php?auction_id=' + auction_id + '&which=back', 
	dataType: 'json',
        success: function(data) {
		  
                    $.each(data, function(i, item) {
                    
                    change_box(i, item, auction_id);
		    //initialize_bid_buttons();
	
		    });
	
	}
	
      });
    }else{
    //prompt('<?php echo $SITE_URL; ?>/include/addons/similar/json_new.php?auction_id=' + auction_id + '&which=forward');
     
     $.ajax({
      
	    url: '<?php echo $SITE_URL; ?>/include/addons/similar/json_new.php?auction_id=' + auction_id + '&which=forward', 
	    dataType: 'json',
            success: function(data) {
		  
                    $.each(data, function(i, item) {
                    
			change_box(i, item, auction_id);
			//initialize_bid_buttons();
	
		      });
	
	    }
	
      }); 
      
    }
 
 }else{
 //prompt('<?php echo $SITE_URL; ?>/include/addons/similar/json_new.php?auction_id=' + auction_id + '&which=' + which);
  
    $.ajax({
	  url: '<?php echo $SITE_URL; ?>/include/addons/similar/json_new.php?auction_id=' + auction_id + '&which=' + which, 
	/*if(document.getElementById('auction_' + auction_id)){
	  if(!document.getElementById('productID-hidden_' + auction_id)){
		$('#auction_' + auction_id).html(response);
	  
	      initialize_bid_buttons();
	  }
	}*/
	
	dataType: 'json',
        success: function(data) {
		  
                    $.each(data, function(i, item, auction_id) {
			  //initialize_bid_buttons();
	
		    });
	
	}
      });
 
   
 }
  
}


function add_buttons(auction_id, similar){
  if(!document.getElementById('next_similar_' + auction_id)){
      $('#counter_index_page_' + auction_id).before('<span id="next_similar_' + auction_id +'" class="left_similar" onclick="javascript:change_auction(1, ' + auction_id + ');">&nbsp;</span>');
  }
  if(!document.getElementById('previous_similar_' + auction_id)){
  $('#counter_index_page_' + auction_id).before('<span id="previous_similar_' + auction_id +'" class="right_similar" onclick="javascript:change_auction(-1, ' + auction_id + ');">&nbsp;</span>');
  }
} 
