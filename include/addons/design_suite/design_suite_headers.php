<?php
$hide_me = 'true';
if(empty($hide_me)){
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $SITE_URL;?>js/jquery.treeview.css" />
 <script type="text/javascript" src="<?php echo $SITE_URL;?>js/jquery.treeview.js"> </script>
 
 <?php


if(db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and admin_user_flag >= '1'")) >= 1){
@db_query("alter tables user_levels add column addons varchar(200)");
   // if(db_num_rows(db_query("select * from user_levels, registration where user_levels.addons like '%design_suite%' and registration.userid = $_SESSION[userid] and admin_user_flag = user_levels.id")) >= 1){
 
 //include("include/addons/design_suite/js/ckeditor/ckeditor.php");
 $admin = 1;
$ds_enabled = 'true';
 ?>
 <script>
 //console.log('Design Suite Enabled');
 </script>
 
<style>
.pencil, .add{
display:inline-block;
visibility:visible;
}
#small_div {
display:none;
}
</style>


      
       <link rel="stylesheet" type="text/css" href="<?php echo $SITE_URL;?>include/addons/design_suite/css/editor.css" />
       <link rel="stylesheet" href="<?php echo $SITE_URL;?>include/addons/design_suite/js/spectrum.css" type="text/css">
       <link rel="stylesheet" href="<?php echo $SITE_URL;?>include/addons/design_suite/css/anythingzoomer.css" type="text/css">
       <link rel="stylesheet" href="<?php echo $SITE_URL;?>include/addons/design_suite/css/toggleSwitch.css" type="text/css">
	
	<link rel="stylesheet" href="<?php echo $SITE_URL;?>include/addons/design_suite/js/cssHooks/qunit/qunit.css" type="text/css" media="screen">
	<script src="<?php echo $SITE_URL;?>include/addons/design_suite/js/cssHooks/qunit/qunit.js"></script>
	
	
	
	
	<script src="<?php echo $SITE_URL;?>include/addons/design_suite/js/cssHooks/borderradius.js"></script>
	<script src="<?php echo $SITE_URL;?>include/addons/design_suite/js/cssHooks/boxshadow.js"></script>
	<script src="<?php echo $SITE_URL;?>include/addons/design_suite/js/cssHooks/textshadow.js"></script>
	<script src="<?php echo $SITE_URL;?>include/addons/design_suite/js/cssHooks/transform.js"></script>
	<script src="<?php echo $SITE_URL;?>include/addons/design_suite/js/cssHooks/transition.js"></script>
	<script src="<?php echo $SITE_URL;?>include/addons/design_suite/js/cssHooks/skeleton.js"></script>
	<script src="<?php echo $SITE_URL;?>include/addons/design_suite/js/cssHooks/boxreflect.js"></script>
	<script src="<?php echo $SITE_URL;?>include/addons/design_suite/js/cssHooks/userinterface.js"></script>
	
       <script src="<?php echo $SITE_URL;?>include/addons/design_suite/js/fn.toggleSwitch.js"></script>
       
       
       

      
      <script type="text/javascript" src="<?php echo $SITE_URL;?>include/addons/design_suite/js/jpicker-1.1.6.js"></script>
      <script type="text/javascript" src="<?php echo $SITE_URL;?>include/addons/design_suite/js/jquery.anythingzoomer.js"></script>
      <script type="text/javascript" src="<?php echo $SITE_URL;?>include/addons/design_suite/js/jquery.dropper.js"></script>
   
      <script src="<?php echo $SITE_URL;?>js/lib/jquery.cookie.js" type="text/javascript"></script>
    
        
  <script>
	    
	    
$('body').css('maxWidth', $(window).width());
var left = '90px';
var top = '40px';      
      $(document).ready(function(){
    
      
      $('#css-editor').bind('contentchanged', function() {

	  


      });
      window.dhx_globalImgPath="<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/codebase/imgs/";
      
      $('.qtip-destroy').each(function(event){

	  $('.qtip :visible').destroy();

      });
      
(function($){
    $.fn.getStyleObject = function(){
        var dom = this.get(0);
        var style;
        var returns = {};
        if(window.getComputedStyle){
            var camelize = function(a,b){
                return b.toUpperCase();
            };
            style = window.getComputedStyle(dom, null);
            for(var i = 0, l = style.length; i < l; i++){
                var prop = style[i];
                var camel = prop.replace(/\-([a-z])/g, camelize);
                var val = style.getPropertyValue(prop);
                returns[camel] = val;
            };
            return returns;
        };
        if(style = dom.currentStyle){
            for(var prop in style){
                returns[prop] = style[prop];
            };
            return returns;
        };
        return this.css();
    }
})(jQuery);
	
$.fn.textWidth = function(){
      var html_calc = $('<span>' + $(this).html() + '</span>');
      html_calc.css('font-size',$(this).css('font-size')).hide();
      html_calc.prependTo('body');
      var width = html_calc.width();
      html_calc.remove();
      return width;
    }


	    
	    
	  $('.edit_css_interfaces .advanced').css('visibility', 'collapse');
	//$('.' + getCookie('edit_mode')).css('visibility', 'visible');
      

      
    
     
	
	    $('body').before('<div id="edit_icons_layer" style="position:absolute;z-index:0;top:0px;left:0px;width:0px;height:0px;"></div>');

		    
			$.get('<?php echo $SITE_URL; ?>include/addons/design_suite/tabs.php', function(response){
			
			     $('#edit_icons_layer').html(response);
			     
			     
			     	    $('h50, h60, h70').each(function(){
				      var id = $(this).attr('title');
				   $(this).bind('mouseover', function(){
				     
					  $(this).qtip({
					  content: {
						  text: '<ul style="max-height:120px;overflow-y:auto;">Loading...</ul>', // The text to use whilst the AJAX request is loading
						  ajax: {
							  url: '<?php echo $SITE_URL; ?>include/addons/design_suite/tabs.php?unique_class=<?php echo $unique_class;?>&type=<?php if($ids['type'] == 'class') { echo 'class'; }else{ echo 'id'; } ?>&selector=' + encodeURIComponent($(this).attr('title')), // URL to the local file
							  type: 'GET', // POST or GET
							  data: {}, // Data to pass along with your request
							  once: false,
							  success: function(data, status) {
								// Process the data
				
								// Set the content manually (required!)
								this.set('content.text', '<dl style="max-height:120px;overflow-y:auto;">' +  data + '</dl>');
							  }
						  }
					  },
					  
					  
					  hide: 'unfocus', show: { ready:true, solo: true }, 
					  
					  position: {target : $(this).closest('h50'), my : 'top left', at: 'top right',
					  
					  container: $('body'),  
					  viewport: $(window),
					  adjust: {
						      target: $(document),
						      resize: true // Can be ommited (e.g. default behaviour)
					      }
					  
					  }
					  
				  });
				  
				  
				  });
				});
				
			  });
			
		
	      	/*	$('#slider_box').draggable({stop:function(event,ui){  create_editor('#slider_box', 'id'); } });
			$('#menu_holder').draggable({stop:function(event,ui){  create_editor('#menu_holder', 'id'); } });
			$('#login-area p').draggable({stop:function(event,ui){  create_editor('#login-area', 'id'); } }); 
			*/
		$('form').submit(function(){

		
			$('input[type=submit]', this).attr('disabled', 'disabled');
			$('input[type=button]', this).attr('disabled', 'disabled');
			$('button', this).attr('disabled', 'disabled');
			$('button', this).attr('onClick', '');
		});
		
		  $('script').removeAttr('id');
		  
		  
		  

			$('a').click( function(event){ // <-- switch this to live and you will see different behavior
			      var url = this.href;

			      if($(this).hasClass('prevented')){

			      }else{
				event.preventDefault();
				$('#edit_log').html('<br /><p style="color:red;font--weight:bold;">You are working in design mode<a href="' + url + '" class="prevented"> click here</a> to follow this link</p>');

			    }
		      
		      }); 
                $("#submit_settings").click(function(){
                 submit_test_ajax_form('form1', '<?php echo $SITE_URL;?>backendadmin/sitesetting.php?ajax=true', 'css-editor', 'post');
           
		  });
		  
		  
		  document.createElement('edit');
		   
		    
		    
		    jQuery('body').dropper({
			clickCallback: function(color) {
			alert("You clicked on color: #"+ color.rgbhex);
		      }
		    });
		    
	/*	    
	      $('.button, .bid-button-link').each(function(){
		  $(this).parent().before('<p style="position:relative;top:-35px;left:-20px;" id="uploader_' + $(this).attr('id') + '"></p>');

		    console.log(extractFilename($(this).css('backgroundImage')));

		      if(!$(this).attr('src')){
			createUploader_Full('uploader_' + $(this).attr('id'), 'buttons', '<?php echo $BASE_DIR;?>/css/<?php echo $template;?>/buttons/', extractFilename($(this).css('backgroundImage')));
			
			}else{
			createUploader_Full('uploader_' + $(this).attr('id'), 'buttons', '<?php echo $BASE_DIR;?>/css/<?php echo $template;?>/buttons/', extractFilename($(this).attr('src')));
			
			
		      }

	      }); 
	      
	      
	      $('#logo a').each(function(){
		$(this).parent().before('<p style="position:relative;top:-35px;left:-20px;" id="uploader_' + $(this).attr('id') + '"></p>');

		//console.log(extractFilename($(this).css('backgroundImage')));

		  if(!$(this).attr('src')){
		    createUploader_Full('uploader_' + $(this).attr('id'), 'buttons', '<?php echo $BASE_DIR;?>/css/<?php echo $template;?>/buttons/', extractFilename($(this).css('backgroundImage')));
		    
		    }else{
		    createUploader_Full('uploader_' + $(this).attr('id'), 'buttons', '<?php echo $BASE_DIR;?>/css/<?php echo $template;?>/buttons/', extractFilename($(this).attr('src')));
		    
		    
		    }

		});
		
		
*/



	
      });

   </script>
   <script>

         <?php
      
	  $js_functions = dirToArray('include/addons/design_suite/js/Functions/'); 

	      foreach($js_functions as $key => $function){
		      
		 
		      echo "\n\n/* $function */ \n\n";
		     
		    include_once("include/addons/design_suite/js/Functions/" . $function);
		      echo "\n\n/* $function */ \n\n";
		  
	      }

      ?>
      
 
	    
	    listenCookieChange('class', function() {
	    
		    $('h60').css('visibility',  getCookie('class'));
		
		
	    });
	    
	    
	    
	    listenCookieChange('ids', function() {
	    
		    $('h50').css('visibility',  getCookie('ids'));
		
		
	    });
	    
	    listenCookieChange('add', function() {
	    
		    $('.add').css('visibility', getCookie('add'));
		
		
	    });	    
	    	    
	    listenCookieChange('pencil', function() {
	    
		    $('.pencil').css('visibility', getCookie('pencil'));
		
		
	    });
	    	    
	    listenCookieChange('idea', function() {
	    
		    $('.idea').css('visibility',  getCookie('idea'));
		
		
	    });
	    
	    
	    	    
	    listenCookieChange('psuedos', function() {
	    
		    $('h70').css('visibility',  getCookie('psuedos'));
		
		
	    });
	    
	    	    
	    listenCookieChange('addons', function() {
	    
		    $('.edit_addons').css('visibility',  getCookie('addons'));
		
		
	    });
	    	    
	    listenCookieChange('sort', function() {
	    
		    $('.sort_icon').css('visibility',  getCookie('sort'));
		
		
	    });
      </script>
   <?php } 
   
   }
   ?>