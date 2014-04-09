  var add_new_custom = function(){
     box_location = $('#box_location').val();
     
     
	$.get('<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/add_custom_box.php?find_last=true', function(response){
	
	
	  $('#css-editor').css('display', 'none');
	  $('#css-editor').css('display', 'none');
	  $('#my_css_editor_loading_bar').css('display', 'block');
	  
	  $.get("<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/edit_sliders.php?get=sliderform&constant=" + $('#constant2').val() + "&get_custom=customform&constant_c=" + response,
	    function(data){
	      document.getElementById('css-editor').innerHTML = data;
	       $('#css-editor').css('display', 'block');
	      $('#my_css_editor_loading_bar').css('display', 'none');
		 if(!$('#constant2c').length){
		 
		    $('#custom_form').append('<input type="hidden" id="constant2c" name="constant2c" />');
		 }else{
		 $('#constant2c').append('<option value=\"' + response + '\">' + response + '</option>');
		 
		 }
		  $('#constant2c').val(response);
		    
		  $('#box_location').val(box_location);
		  
	  
	     
	     
		  $(box_location).prepend('<span><div class="my_custom_box" id="' + response + '"></div></span>');
		     setup_mce($('#text_editorc').html(), response);
		  $('span #' + response).draggable({stop:function(event,api){ 
		  
		  
						
						$('span #' + response).qtip({
		  
									 id: 'edit_tt', content: { 
										text : '<img src="<?php echo $SITE_URL;?>include/addons/design_suite/loading.gif" align="center" width="30px" height="30px" />',
						
										title: { text: 'Edit Position for ' + '<?php echo $_REQUEST['id'];?>', botton: 'Close' }, 
					    
					  
					    ajax : {
					    
						url: '<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/background.php',
						data: { switch: 'background', id: '#' + content, type: 'id' },
						type: 'get',
						success: function(data, status){
						
						    this.set('content.text', data);
						
						}
					    
					    
					    
					    }
					    
					  },
					      //prerender: true,
						    background: {
							my: 'left middle',
							at: 'right middle',
							viewport:$('body'),
							target: $(this)
							
							},
							show: {
							prerender:true,
							ready:true,
							solo: true
							
							},
							style:{
							height: 300,
							
							},
							
							
							hide : { event: 'unfocus' },
							   events: {
							      render: function() {
							      $(this).css('background', 'fixed');
							       $(this).draggable();
								
								}
								
								
							     
							   },
							   
							 api: {
							    onRender: function() {
							      
							    }
							}
									      });
		  
		  } });
		 $('span #' + response).resizable({stop:function(event,api){ 
		 
			    $('span #' + response).qtip({
		  
									 id: 'edit_tt', content: { 
										text : '<img src="<?php echo $SITE_URL;?>include/addons/design_suite/loading.gif" align="center" width="30px" height="30px" />',
						
										title: { text: 'Edit Position for ' + '<?php echo $_REQUEST['id'];?>', botton: 'Close' }, 
					    
					  
					    ajax : {
					    
						url: '<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/background.php',
						data: { switch: 'background', id: '#' + content, type: 'id' },
						type: 'get',
						success: function(data, status){
						
						    this.set('content.text', data);
						
						}
					    
					    
					    
					    }
					    
					  },
					      //prerender: true,
						    background: {
							my: 'left middle',
							at: 'right middle',
							viewport:$('body'),
							target: $(this)
							
							},
							show: {
							prerender:true,
							ready:true,
							solo: true
							
							},
							style:{
							height: 300,
							
							},
							
							
							hide : { event: 'unfocus' },
							   events: {
							      render: function() {
							      $(this).css('background', 'fixed');
							       $(this).draggable();
								
								}
								
								
							     
							   },
							   
							 api: {
							    onRender: function() {
							      
							    }
							}
									      });
									      
						
		 
		 
		 } });
		  
		 
		  
		  
		
		});
	    
	    });
	    
      }