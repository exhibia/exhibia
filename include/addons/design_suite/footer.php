
<?php
$hide_ds = 'true';
if(empty($hide_ds)){
if(db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and admin_user_flag != 0")) >= 1){

 //if(db_num_rows(db_query("select * from user_levels, registration where user_levels.addons like '%design_suite%' and registration.userid = $_SESSION[userid] and admin_user_flag = user_levels.id")) >= 1){
 ?>


 <script>

function post_config(){

$.ajax({

    url: '<?php echo $SITE_URL; ?>backendadmin/configuration.php?ajax=true',
    data: $('#form1').serialize(),
    type: 'POST',
    dataType:'html',
    success: function(response, status){
    
    $('#css-editor').html(response);
    
    }


});
}
$('#editor li').click(function(event){
  if($('#my_css_editor_loading_bar').css('visibility') == 'collapse'){
    $('#my_css_editor_loading_bar').css('visibility', 'visible');
  }else{
  
   $('#my_css_editor_loading_bar').css('visibility', 'collapse');
  }
    
});

	


</script>
 
<div style="min-height:600px;margin-top:20px;text-align:center;z-index:100;position:absolute;"></div>
<div class="clear"></div>
<div id="design_suite">
<div id="editor"  class="opacity">

	  <div style="margin-left:25px;">
	  
		<?php 
		      echo get_menu('design_menu'); 
		 ?>
	  </div>
     <div id="my_css_editor_loading_bar" style="display:none;"><img src="<?php echo $SITE_URL;?>backendadmin/images/icons/loading-bar.gif" /></div>
			
     <center>
	    
	      <div style="text-align:center;margin-top:20px;">
	   
		  <div id="edit_log" style="text-align:center;margin-top:20px;"></div>
		            <div id="edit_inner" style="text-align:center;margin-top:20px;">
				  <div id="css-editor" style="text-align:center;margin-top:20px;">

				  </div>

			      </div>

	      </div>
	</center>

<br />
<h2 style="float:right;"><label id="design_legend">Legend</label></h2>
<ul style="list-style-type:none;display:none;" id="design_legend_content">
<li style="margin-bottom:10px;border-bottom:1px dotted blue;text-shadow:none;padding-bottom:5px;font-size:10px;color:#000;">
<img src="img/Traffic_light_green.png" style="height:15px;width:auto;margin-right:20px;" />
<img src="img/Traffic_light_red.png" style="height:15px;width:auto;margin-right:20px;" />
<img src="img/Traffic_light_yellow.png" style="height:15px;width:auto;margin-right:20px;" />
Edit Addon(color indicates conditional status...ie...user status, page status etc can be used to hide or visibility menu elements and modules)
<p class="toggle_switch" id="addons_switch" title="addons"></p>
</li>
<li style="margin-bottom:10px;border-bottom:1px dotted blue;text-shadow:none;padding-bottom:5px;font-size:10px;color:#000;"><img src="img/pencil.png" style="height:15px;width:auto;margin-right:20px;" />Edit Menu Item(shown)
<p class="toggle_switch" id="pencil_switch" title="pencil"></p>
</li>
<li style="margin-bottom:10px;border-bottom:1px dotted blue;text-shadow:none;padding-bottom:5px;font-size:10px;color:#000;"><img src="img/red_pencil.png" style="height:15px;width:auto;margin-right:20px;" />Edit Menu Item(hidden)
<p class="toggle_switch" id="red_pencil_switch" title="red_pencil"></p>
</li>
<li style="margin-bottom:10px;border-bottom:1px dotted blue;text-shadow:none;padding-bottom:5px;font-size:10px;color:#000;"><img src="img/add.png" style="height:15px;width:auto;margin-right:20px;" />Add Menu Item
<p class="toggle_switch" id="add_switch" title="add"></p>
</li>
<li style="margin-bottom:10px;border-bottom:1px dotted blue;text-shadow:none;padding-bottom:5px;font-size:10px;color:#000;"><img src="img/custom.png" style="height:15px;width:auto;margin-right:20px;" />Custom Content
<p class="toggle_switch" id="idea_switch" title="idea"></p>
</li>
<li style="margin-bottom:10px;border-bottom:1px dotted blue;text-shadow:none;padding-bottom:5px;font-size:10px;color:#000;"><img src="<?php echo $SITE_URL;?>include/addons/design_suite/move.png" style="height:15px;width:auto;margin-right:20px;" />Move Element
<p class="toggle_switch" id="sort_switch" title="sort"></p>
</li>

<li style="margin-bottom:10px;border-bottom:1px dotted blue;text-shadow:none;padding-bottom:5px;font-size:10px;color:#000;"><h26 style="border:1px dotted red" class="preview_button" style="padding:5px 5px 5px 5px;border:1px solid black;background-color:green;color:white;visibility:visible;font-size:4px;font-weight:normal;font-style:oblique;max-width:20px;max-height:20px;cursor:pointer;margin-right:20px;">
Custom</h26>Edit Custom Content

</li>
<li style="margin-bottom:10px;border-bottom:1px dotted blue;text-shadow:none;padding-bottom:5px;font-size:10px;color:#000;"><h51 class="preview_button" style="padding:5px 5px 5px 5px;border:1px solid black;background-color:green;color:white;visibility:visible;font-size:4px;font-weight:normal;font-style:oblique;max-width:20px;max-height:20px;cursor:pointer;margin-right:20px;">
#example</h51>Block Level Elements(click to edit, drag to move, pull corners and sides to resize etc)

<p class="toggle_switch" id="ids_switch" title="ids"></p>
</li>
<li style="margin-bottom:10px;border-bottom:1px dotted blue;text-shadow:none;padding-bottom:5px;font-size:10px;color:#000;"><h52 class="preview_button" style="padding:5px 5px 5px 5px;border:1px solid black;background-color:red;color:white;visibility:visible;font-size:4px;font-weight:normal;font-style:oblique;max-width:20px;max-height:20px;cursor:pointer;margin-right:20px;">
.example</h52>Class Elements(click to edit)
<p class="toggle_switch" id="class_switch" title="class"></p>

</li>

<li style="margin-bottom:10px;border-bottom:1px dotted blue;text-shadow:none;padding-bottom:5px;font-size:10px;color:#000;"><h52 class="preview_button" style="padding:5px 5px 5px 5px;border:1px solid black;background-color:orange;color:white;visibility:visible;font-size:4px;display:inline;font-weight:normal;font-style:oblique;max-width:20px;max-height:20px;cursor:pointer;margin-right:20px;">
#example #example</h52><h52 class="preview_button" style="padding:5px 5px 5px 5px;border:1px solid black;background-color:blue;color:white;visibility:visible;font-size:4px;font-weight:normal;font-style:oblique;max-width:20px;max-height:20px;cursor:pointer;margin-right:20px;display:inline;"></h52>Child Elements Elements(click to edit)
<p class="toggle_switch" id="psuedos_switch" title="psuedos"></p>

</li>
</ul>


</div>

  <script>
  if(checkCookie('idea', '')){
	setCookie('idea','visible','365');
	
	
	}	    
	if(checkCookie('pencil', '')){
	
	  setCookie('pencil','visible','365');
	
	
	}	    
	if(checkCookie('sort', '')){
	
	  setCookie('sort','visible','365');
	
	
	}	    
	if(checkCookie('addons', '')){
	
	  setCookie('addons','visible','365');
	
	
	}	    
	if(checkCookie('psuedos', '')){
	
	  setCookie('psuedos','visible','365');
	
	
	}	    
	if(checkCookie('ids', '')){
	
	  setCookie('ids','visible','365');
	
	
	}
	    
	if(checkCookie('class', '')){
	
	  setCookie('class','visible','365');
	
	
	}
	
	    

	    
  function  add_toggle_switch(divId){

		  var title = $('#' + divId).attr('title');
		  var cookie = getCookie($('#' + divId).attr('title'));
		  
		  if(cookie == 'visible' | cookie == ''){
			value = 'on';
		    
		   }else{
		      value = 'off';
		   }
		 $('#' + divId).toggleSwitch({
		      value: value,
		          onChange: function( on ){
			      if ( on ){
			
				  setCookie(title, 'visible', 365);
			      }
			      else{
			     
				  setCookie(title, 'collapse', 365);
			      }
			  }
		      });
		      
    }
  $('#design_legend').qtip({
      content: { text: $('#design_legend_content').clone() },
      position: { my : 'bottom right', at: 'top left' },
      show: { ready: true, solo:true },
      hide: 'unfocus',
      events: {
	render: function(event, api) {
	$('#design_legend_content').remove();
	      $('#design_legend ul').mCustomScrollbar();
	      },
	      
	      show: function(event, api) {
	      $('.toggle_switch').each(function(){
		    var id = $(this).attr('id');
		    add_toggle_switch(id);
		      
		  });
		  
	    }
	
	}
      });
     
   
  
  
  </script>

  <div id="dialog_css" style="visibility:colapse;"></div>
  
</div>
<?php
 
      ?>
       
        <script>
	

	//a  onclick="javascript: replace_colors();"
	/*$('#content_editor').qtip({ id: 'content_editor_links', content: {
					text: $('#content_links').html()
					
					},
					style: {
					    width:220,
					    
					
					},
					position: {
					    my: 'bottom middle',
					    at: 'top middle'
					},
					hide : 'unfocus click'
			      
					
				      });
				     
		
		*/
		
	function send_custom(id, instance){
	$('#' + id).resizable('destroy');
	data = encodeURIComponent($('#' + id).html());
	    $.get('<?php echo $SITE_URL;?>/include/addons/custom_content/get_content.php?send_to_server=true&id=' + instance + '&text=' + data, function(response){
	    
	    
		$('#' + id).next('p').text(response);
	    
	    });
	}
	var initialize_custom_boxes = function(id){
	
			
			
			if($('#'+ id).html() == ''){
			  $('#'+ id).html('Add Custom Content');
			  }
			  $('#'+ id).css('width', $('#'+ id).parent().css('width'));
			  $('#'+ id).css('margin', $('#'+ id).prev('div').css('margin'));
			  
			  $('#'+ id).css('marginBottom', '10px');
			  $('#'+ id).css('padding', $('#'+ id).prev('div').css('padding'));
			  $('#'+ id).css('float', 'left');
			  $('h18, h19, h20, h50, h60').css('visibility', 'none');
			  $('h18, h19, h20, h50, h60').off('mouseover');
			  $('h18, h19, h20, h50, h60').unbind('mouseover');
			  $('#'+ id).resizable({});
			  $('#'+ id).before('<input style="visibility:visible;position:relative;left:-50px;top:-10px;" type="submit" id="' + id + '_submit" onclick="send_custom(\'' + id + '\', \'' + $(this).attr('title') + '\');" value="submit" />');
			
	}
	 $(document).ready(function(){
			
				
			
		 

		      
     
       <?php 
       $qry = db_query("select distinct(menu_name) from navigation");
       while($row = db_fetch_array($qry)){
       $m_settings = get_menu_settings($row[0]);
       
       if(count($m_settings['menu_class']) >= 1 & !empty($m_settings['menu_class'][0])){ ?>
		
		  
		    
			$('.<?php echo $m_settings['menu_class'][0];?>').sortable({  
					  start: function(event,api){ $('.menu_edit_icon').qtip('destroy'); $('.menu_edit_icon').unbind('onmouseover'); },
					  stop:function(event,api){ update_menu_order(  $('.<?php echo $m_settings['menu_class'][0];?>').parent().attr('id'), '<?php echo $menu_id;?>'  );
					  
					  } 
					  
					  });
			
		 
		  <?php }
		}  
	?>
function update_container_order(position){

    var ids = JSON.stringify($('#' + position).sortable("toArray"));
      $.get('<?php echo $SITE_URL; ?>/include/addons/design_suite/ADDONS/sort_addons.php?is_page=true&page=<?php echo basename($_SERVER['PHP_SELF']);?>&position=' + position + '&sortables=' + ids, function(response){

	      $('#alert_message_content').html(response);

	      $('#alert_message').dialog('open');


      });

}

	//$('#column-right').before('<img src="img/move.png" style="margin-bottom:-15px;height:15px;width:auto;position:relative;left:5;top:5px;z-index:999999999;" class="page_sort_link" />');
			
	//$('#column-left').before('<img src="img/move.png" style="margin-bottom:-15px;height:15px;width:auto;position:relative;left:5px;top:5px;z-index:999999999;" class="page_sort_link" />');
	$('#container .column').addClass('left');
	
	var lc_position = $('#column-left').css('position');
	var lc_coords = $('#column-left').position();
	
	
	
	var rc_position = $('#column-right').css('position');
	var rc_coords = $('#column-right').position();
	
	
	$('#column-left, #column-right').sortable({ 
			containment: $('#container'),
			handle: $('.page_sort_link, h3'),  
			stop:function(event, ui){ 
			    $(this).removeClass('left');
			    $('#column-right').css({'paddingLeft' : '0px', 'marginLeft' : '0px', 'marginRight' : '0px' });
			    $('#column-left').css({'marginRight' : '3px', 'marginLeft' : '0px' });
			    update_container_order('container');
			   
			},
			start:function(event, ui){  }
			
			});
		  
		});
	
		$('.sort_icon').each(function(){
		   
		
		    $(this).qtip({ content: { text: 'Drag Me To Change Order of ' + $(this).attr('title') }});
		});
			 $('#design_suite, .ui-tooltip, .ui-qtip, .qtip, .ui-dialog, .ui-widget, .ui-content, .treeview, .expandable, .hitarea, #design_suite #editor ul.menu li.master a').mouseover( function(){
				    toggle_editor_buttons('collapse');
			  });
			 $('#design_suite, .ui-tooltip, .ui-qtip, .qtip, .ui-dialog, .ui-widget, .ui-content, .treeview, .hitarea, #design_suite #editor ul.menu li.master a').bind('mouseleave', function(){
				      toggle_editor_buttons('visible');
				
			 });
			      
					
			      

			
		 </script>
  <?php

//}
}
}
  ?>