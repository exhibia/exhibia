function image_no_image(){

    
var element = document.getElementById('background-element').value;
var backgroundImg;
backgroundImg = $('#hiddenImg').val();

    
    if($("#no-image").attr('checked') == true){
	$("#bg-submit").css('display', 'none');
	$(element).css('background-image', backgroundImg);
	$('#upload-box').css('display', 'block');
    
    }else{
	$("#bg-submit").css('display', 'block');
	$(element).css('background-image', 'url()');
	$('#upload-box').css('display', 'none');
    
    }



}