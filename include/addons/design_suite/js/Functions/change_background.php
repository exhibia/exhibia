function change_background(element, color, attachment, repeat, fileName){
      $(element).css('background-repeat', repeat);
      
      $(element).css('background-attachment', attachment);
      
      $(element).css('background-color', color );

      document.getElementById('hiddenImg').value = 'url("<?php echo $SITE_URL;?>img/backgrounds/' + fileName + '")';
    
	$(element).css('background-image', 'url("<?php echo $SITE_URL;?>img/backgrounds/' + fileName + '")');

    
}