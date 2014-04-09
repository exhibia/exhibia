function media_gallery(){

				$('h18').css('visibility', 'collapse');
				$('h19').css('visibility', 'collapse');
				$('h20').css('visibility', 'collapse');
				$('h50').css('visibility', 'collapse');
				$('.pencil').css('visibility', 'collapse');
				$('.menu_edit_icon').css('visibility', 'collapse');
				$('.edit_addons').css('visibility', 'collapse');
				$('.main').css('visibility', 'collapse');
				$('.qtip').qtip('close');
				$('#logo').css('visibility', 'collapse');
			     
    $('#alert_message_content').html('<iframe src="<?php echo $SITE_URL;?>backendadmin/js/ckeditor/kcfinder-2.51/browse.php" style="height:500px;width:1200px;"></iframe>');
  
    
  $('#alert_message').dialog({
      autoOpen: true,
      modal: true,
	 
	      width: 1250,
	      height:620,
	        buttons: {
                "<?php echo OK; ?>": function() {
                    $( this ).dialog( "close" );
                    
				$('h18').css('visibility', 'collapse');
				$('h19').css('visibility', 'collapse');
				$('h20').css('visibility', 'collapse');
				$('h50').css('visibility', 'visible');
				$('.pencil').css('visibility', 'visible');
				$('.menu_edit_icon').css('visibility', 'visible');
				$('.edit_addons').css('visibility', 'visible');
				$('.main').css('visibility', 'visible');
				$('#logo').css('visibility', 'visible');
				
                }
            }
      });
    
}