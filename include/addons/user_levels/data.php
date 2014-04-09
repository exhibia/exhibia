
//These functions are dynamically added for user level
if(!empty(item.user_levels)){
$.each(item.user_levels, function(a, level){
      if(!empty(level)){
      
      try{
	if(empty(level.maxed_out)){
		    $('#ui-tooltip-qtip_badge_' + level.row_to_match + '-title').html( 'Current Level: ' + level.rank_name);//<-works
		
			
	   
	   if(level.row_to_match && level.row_to_match != 'undefined'){
	   
		
		$('#ui-tooltip-qtip_badge_' + level.row_to_match + '-content' + ' .bids_awarded').html( level.bids_awarded);//<-works
		$('#ui-tooltip-qtip_badge_' + level.row_to_match + '-content' + ' .free_bids_awarded').html( level.free_bids_awarded);//<-works  
		
		$('#ui-tooltip-qtip_badge_' + level.row_to_match + '-content' + ' .next_bids_awarded').html( level.next.bids_awarded);//<-works  
		
		$('#ui-tooltip-qtip_badge_' + level.row_to_match + '-content' + ' .next_free_bids_awarded').html( level.next.free_bids_awarded);//<-works  
		
		
		
		if(level.next){
		
		if(level.next.row_to_match){
		  $('#ui-tooltip-qtip_badge_' + level.row_to_match + '-content' + ' .next_row_to_match').html( level.next.row_to_match)
		}
		  if(level.next.rank_name){
		    $('#ui-tooltip-qtip_badge_' + level.row_to_match + '-content' + ' .next_rank_name').html( level.next.rank_name);//<-works 
		   } 
		    if(level.row_to_match != 'time_as_high_bidder'){
		      if(level.row_to_match != 'dollars_spent'){
				  $('#ui-tooltip-qtip_badge_' + level.row_to_match + '-content' + ' .next_min_amount').html( parseFloat(level.next.needed, 0));//<-works 
			  }else{
			      level.next.needed = '<?php echo $Currency; ?>' + parseFloat(level.next.needed, 2, '.', ',');
			  
				  $('#ui-tooltip-qtip_badge_' + level.row_to_match + '-content' + ' .next_min_amount').html(level.next.needed);
			  
			  
			  }
		     }else{
		     
			  $('#ui-tooltip-qtip_badge_' + level.row_to_match + '-content' + ' .next_min_amount').html(level.next.needed);//<-works 
			  
		     }
		}
		
		if(level.row_to_match != 'time_as_high_bidder'){
		    if(level.row_to_match != 'dollars_spent'){
			level.min_amount = parseFloat(level.min_amount, 0);
		    }else{
			level.min_amount = '<?php echo $Currency; ?>' + level.min_amount;
		    }
			$('#ui-tooltip-qtip_badge_' + level.row_to_match + '-content' + ' .min_amount').html( level.min_amount);//<-works 
		
		}else{
		//console.log(level.current_time);
		//console.log(level.min_amount);
		      $('#ui-tooltip-qtip_badge_' + level.row_to_match + '-content' + ' .min_amount').html(level.min_amount);//<-works 
		
		
		}
		
		
	     
	  }  
      }
      }catch(pp){}
  }
  
  
});
}