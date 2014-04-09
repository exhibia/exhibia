 i = 0;
 var auctiondata = new Array();
 $('.auction-item').each(function() {
	
	var id = $(this).attr('id');
	ws_auction_list += auctionTitle + ',';
	
	
	var auctionTitle = $('#' + id).attr('title');
	$('#counter_index_page_' + auctionTitle).addClass('counter_index_page');
	$('#counter_index_page_' + auctionTitle).addClass(template);
	
	if(!$('#' + id).hasClass('sold') & !$('#' + id).hasClass('ended')){
	 auctiondata[i++] = auctionTitle;
	  
	}else{
	      
	
	}
	
 });
	$.ajax({
            url: siteurl+'/update_info.php',
            dataType: 'json',
            type: 'get',
            cache:true,
           
            data: {
                auctionlist:auctiondata, cornerImag: 'true'
            },
        
            success: function(response) {
             data=response.data;
	      
	      
            $.each(data, function(i, item) {
           
		   
                    $('#auction_' + item.id + ' .corner_imagev img, #auction_' + item.id + ' .corner_image1 img,  #auction_' + item.id + ' .corner_imagev1 img,  #auction_' + item.id + ' .corner_imagev_detail img').attr('src', '<?php echo $SITE_URL; ?>/include/addons/icons/<?php echo $template;?>/' + data.image);
   
		     if( !document.getElementById('image_tooltip_' + item.id) ){
		       
		        console.log(item.id);
			console.log(data.image);
			  //if(data.image_tooltip){

			  $('#auction_' + item.id + ' .corner_imagev, #auction_' + item.id + ' .corner_image1,  #auction_' + item.id + ' .corner_imagev1,  #auction_' + item.id + ' .corner_imagev_detail').qtip({ 
					  content: { 
						text: '<span id="image_tooltip_' + item.id + '">' + data.image_tooltip + '</span>'
						
						}, 
						show:{
						    ready:false, 
						    solo:true
					      },
					      position: {
						my : 'bottom left', at: 'top left'
					      },
					      style: { classes: 'qtip-<?php echo $template; ?>' }			
					  }); 
			  //}
		      }
               });
            }
        });
    
  
   