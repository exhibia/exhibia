    function setup_mce(text, content, inline) {
    
        CKEDITOR.disableAutoInline = true;
	
    
    
    
	  text = '<div id="inline_slider_editor" contenteditable="true" style="border-radius:8px;border:1px dotted red;width:' + $('#slider_box').css('width') + ';height:' + $('#slider_box').css('height') + ';">' + $('#lang_value').html() + '</div>';
    
 	  if(!content){
	  content = $('#constant2').val();
	  sliders = true;
	
	  }   
    
    
   
    
    	    if(sliders == true){
						$('.jshowoff-play').addClass('jshowoff-paused');
						
						slider_id = $('#constant2').val();
						
						target = '#slider_box';
						     
							}else{
							target = '#editor';
							}
     
						     
			    $(target).qtip({content: { 
					      title: { text : 'Edit ' + content, button: '<span class="qtip-destroy" onclick="$(\'#editor\').qtip(\'destroy\');">Close</span>' },
					      text: text
					     },
					      position:{ my : 'top left', at: 'top left', target: $(target) },
					      style:{ classes: 'ex-l-qtip',
					      width: parseInt($('#slider_box').width()) + 50 + 'px',
					     height: parseInt($('#slider_box').height()) + 100 + 'px'
					      
					      
					      },
					      
						hide: false,
					      onHide: function(){
						  $(this).qtip('destroy');
					    },
					  events: {
					  
					  hide: function(event,api){ 
						   
							
							$(this).qtip('destroy');
					      },
					   render: function(event, api) {
					      // Find the text area in the tooltip content
					    $(this).css('position', 'fixed');
					    $(this).resizable();
					    $(this).draggable();
						s_width = $('#slider_box').width();
						s_height = $('#slider_box').height();
						//
		
				$(api.elements.content).append('<div style="float:right;"><form id="language_form" name="language_form" action="javascript: submit_test_ajax_form(\'language_form\'); ">' + $('#language_form_inner').html() + '</div></div>');
						    $('#language_form_inner').remove();
					 CKEDITOR.inline( document.getElementById('inline_slider_editor') );	    
						    
						   
					    }
					
					 }, show: { ready:true, solo:true
					 
					  
					 }
		 
		                      });
  
	
  //CKEDITOR.inline( 'inline_slider_editor' );
	//editor.on('key', function(evt){ console.log('test'); });
	
	    
	   
			     

   

}