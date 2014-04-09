
   function choose_slider_type(){
   
   
	$.get('<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/logo.php?slider_type=' + $('#choose-banner').val(), function(response){
	window.location.href = '<?php echo $SITE_URL; ?>';
	
      });
   
   }
   