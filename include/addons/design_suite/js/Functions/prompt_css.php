 var prompt_css = function(){
				    
				   
				
				css = getElementChildrenAndStyles('*');
				
					    $.ajax({
						type:'post',
						url:'include/addons/design_suite/DESIGN/editor/parse_css.php',
						data:'file=' + encodeURIComponent('<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/css/<?php echo $template;?>.css') + '&css=' + encodeURIComponent($('#css-d-preview').html()), 
						dataType:'text',
						success:function(response){
		
		   
		
				
					    
					    $('#dialog_css').html('<form name="css_form" id="css_form" action="javascript: submit_css(this.id);"><textarea id="css-d-preview" style="margin-left:50px;height:400px;width:800px;">' + response + '</textarea><input type="hidden" name="save" value="save" id="save" /><input type="hidden" name="css_file" id="css_file" value="<?php echo $_SERVER['DOCUMENT_ROOT']; ?>/css/<?php echo $template;?>.css"><input type="submit" name="submit_css" id="submit_css" value="Submit CSS" /></form>');
					    
					    
					    $('#dialog_css').dialog( {width:900, height:500, modal:true });   
				    }
				});
      
				  
				
				}