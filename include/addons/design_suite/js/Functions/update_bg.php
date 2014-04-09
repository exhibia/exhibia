function update_bg(){
var element = document.getElementById('background-element').value;
image_no_image();
    

    color = document.getElementById('background-color').value;
    repeat = $("#background-repeat").val();
    attachment = $("#background-attachment").val();
    
    
    
      $(element).css('background-repeat', repeat);
      
      $(element).css('background-attachment', attachment);
      
      $(element).css('background-color', color );




}

function fade_in(id){
	
	}