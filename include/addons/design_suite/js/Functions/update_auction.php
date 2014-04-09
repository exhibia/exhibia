	function update_auction(contentPre, prId){
	
	    $.get('<?php echo $SITE_URL;?>/include/addons/design_suite/LIVE_CONTENT/index.php?update_record=' + prId + '&row=' + contentPre + '&value=' + encodeURIComponent($('#pr_' + contentPre + '_' + prId).html()), function(response){
	    
		$('#edit_log').html(response);
	    
	    });
 	
	
	}