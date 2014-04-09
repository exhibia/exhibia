
       <script type="text/javascript" src="<?php echo $SITE_URL;?>/js/ui/jquery.ui.datepicker.js"></script>
       <script type="text/javascript" src="<?php echo $SITE_URL;?>/backendadmin/js/behaviour.js"></script>
        <script type="text/javascript" src="<?php echo $SITE_URL;?>/backendadmin/validation.js"></script>
        <script type="text/javascript" src="<?php echo $SITE_URL;?>/backendadmin/popupimage.js"></script>
        
        <script> 
	
	    <?php 

		switch($globalDateformat){

		      case 'm/d/Y':
		   
		      $jsdateFormat = 'mm/dd/yy';
		      break;
		      case 'd/m/Y':
		
		      $jsdateFormat = 'dd/mm/yy';
		      break;
		      
		}

	    ?>
	      $.datepicker.setDefaults({dateFormat:'<?php echo $jsdateFormat;?>'});
	      
	       
                $("#aucstartdate").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                $("#aucenddate").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                
                
      function fire_editor(ev){
      // Get the element which fired the event. This is not necessarily the
			// element to which the event has been attached.
			
				replaceDiv( ev );
	}
	
      var write_page_to_filesystem = function(){
      //loading_image('container');
      data_str = '';
	data_str = data_str + '&page_name=' + document.getElementById('page_name').value + '&edit_page=true';
	data_str = data_str + '&menu=' + $('#menu_add_selector').val();
	data_str = data_str + '&add_new_page=true';
	
		$.ajax( {
		  type: "POST",
		  url: '<?php echo $SITE_URL; ?>include/addons/blank_page/index.php',
		  data: data_str + '&page_text=' + encodeURIComponent($('#container-new').html()),
		  success: function( response ) {
		    $('#container').html(response);
		   // $('#timeout_dialog_content').html(response);
		   // $('#timeout_dialog').dialog('open');
		  }
		} );
	 
  


      
      
      }
       var add_category = function(ev){
       //loading_image('container');
     for(name in CKEDITOR.instances)

	  {

	  CKEDITOR.instances[name].destroy();

	  }
      CKEDITOR.disableAutoInline = true;
      
      $('body').removeClass('homepage');
      $('body').addClass('single');
      $("#container").off('click');
     
      try{
      $('#container').draggable('destroy');
      }catch(pp){}
      
      $.get('<?php echo $SITE_URL;?>/include/addons/blank_page/index.php?edit_page=true&add_new_page=addcategory', function(response){
      
	  $("#container").html(response);
	     // CKEDITOR.inlineAll();
      });
      
      
			
      }       
      var add_helptopic = function(ev){
      //loading_image('container');
     for(name in CKEDITOR.instances)

	  {

	  CKEDITOR.instances[name].destroy();

	  }
      CKEDITOR.disableAutoInline = true;
      
      $('body').removeClass('homepage');
      $('body').addClass('single');
      $("#container").off('click');
       try{
      $('#container').draggable('destroy');
      }catch(pp){}

      $.get('<?php echo $SITE_URL;?>/include/addons/blank_page/index.php?edit_page=true&add_new_page=addhelptopic', function(response){
      
	  $("#container").html(response);
	     // CKEDITOR.inlineAll();
      });
      }
      
			
       
      var add_help = function(ev){
      
      //loading_image('container');
     for(name in CKEDITOR.instances)

	  {

	  CKEDITOR.instances[name].destroy();

	  }
      CKEDITOR.disableAutoInline = true;
      
      $('body').removeClass('homepage');
      $('body').addClass('single');
      $("#container").off('click');
       try{
      $('#container').draggable('destroy');
      }catch(pp){}
      if(isNaN(ev)){
      $.get('<?php echo $SITE_URL;?>/include/addons/blank_page/index.php?edit_page=true&add_new_page=addFAQ', function(response){
      
	  $("#container").html(response);
	     // CKEDITOR.inlineAll();
      });
      }else{
       $.get('<?php echo $SITE_URL;?>/include/addons/blank_page/index.php?edit_page=true&add_new_page=addFAQ&faq_edit=' + ev, function(response){
      
	  $("#container").html(response);
	     // CKEDITOR.inlineAll();
      });     
      
      }
      
			
      }      
      var add_auction = function(ev){
      //loading_image('container');
     for(name in CKEDITOR.instances)

	  {

	  CKEDITOR.instances[name].destroy();

	  }
      CKEDITOR.disableAutoInline = true;
      
      $('body').removeClass('homepage');
      $('body').addClass('single');
      $("#container").off('click');
       try{
      $('#container').draggable('destroy');
      }catch(pp){}
      $.get('<?php echo $SITE_URL;?>/include/addons/blank_page/index.php?edit_page=true&add_new_page=addauction', function(response){
      
	  $("#container").html(response);
	     // CKEDITOR.inlineAll();
      });
      
      
			
      }
      var add_blank_page = function(ev){
      //loading_image('container');
      if(ev != 'true'){
	page=ev;
      
      }else{
	page = '/include/addons/blank_page/<?php echo $template;?>/index.txt';
      }
      for(name in CKEDITOR.instances)

	  {

	  CKEDITOR.instances[name].destroy();

	  }
      CKEDITOR.disableAutoInline = true;
      
      $('body').removeClass('homepage');
      $('body').addClass('single');
      $("#container").off('click');
       try{
      $('#container').draggable('destroy');
      }catch(pp){}
      $.get('<?php echo $SITE_URL;?>/include/addons/blank_page/index.php?edit_page=true&add_new_page=true&page_name=' + page, function(response){
      
	  $("#container").html(response);
	     // CKEDITOR.inlineAll();
      });
      
      
			
      }

      
      
      var add_product = function(ev){
      //loading_image('container');
      for(name in CKEDITOR.instances)

	  {

	  CKEDITOR.instances[name].destroy();

	  }
      CKEDITOR.disableAutoInline = true;
      
      $('body').removeClass('homepage');
      $('body').addClass('single');
      $("#container").off('click');
       try{
      $('#container').draggable('destroy');
      }catch(pp){}
      
      $("#container div, #container form, #container fieldset, #container .inner").css('text-align', 'left');
      $('#container').html('Loading Editor');
      $.get('<?php echo $SITE_URL;?>/include/addons/blank_page/index.php?edit_page=true&add_new_page=addproduct', function(response){
      
	  $("#container").html(response);
	     // CKEDITOR.inlineAll();
      });
      
      
			
      }
  function loading_image(container){
    $(container).html('<img src="<?php echo $SITE_URL;?>/include/addons/design_suite/loading.gif" style="float:center;width:75px height:75px;" />');
    
  }

		var editor;

		function replaceDiv( div ) {
			if ( editor )
				editor.destroy();

			editor = CKEDITOR.replace( div );
		}
</script>
