<?php
include($_SERVER['DOCUMENT_ROOT'] . "/config/config.inc.php");

$db = db_connect($DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
if (!$db) {
    die('Could not connect: ' . db_error());
}

db_select_db($DATABASENAME, $db);


$template_exists = db_fetch_array(db_query("select value from sitesetting where name = 'master_settings' and value like 'template:%' order by id desc limit 1"));

    if(empty($template_exists[0]) & empty($template) & empty($_COOKIE['template'])){
	$template = 'default';
	
    }else{
      if(!empty($_REQUEST['template'])){
      
	    $template = $_REQUEST['template'];
    
      }else if(!empty($_COOKIE['template'])){
	  $template = $_COOKIE['template'];
      }else
      {
	  $template = explode(":", $template_exists[0]);
	  $template = $template[1];

      }
}
setcookie('template', $template, time()-4000000000000, '/');
setcookie('template', $template, time()+4000000000000, '/');
setcookie('new_selector', $_REQUEST['selector'], time()-4000000000000, '/');
setcookie('new_selector', $_REQUEST['selector'], time()+4000000000000, '/');
if(empty($_REQUEST['id'])){
$_REQUEST['id'] = 'html';
$_REQUEST['type'] = 'tag';
}
?>
<?php

$sides = array('top', 'right', 'bottom', 'left');
$outline_types = array('border', 'outline');
$sides2 = array('top-left', 'top-right', 'bottom-right', 'bottom-left');


?>
    <script src="<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/codebase/dhtmlxcommon.js"></script>
    <script src="<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/codebase/dhtmlxcombo.js"></script>
    <link rel="STYLESHEET" type="text/css" href="<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/codebase/dhtmlxcombo.css">
<script>
window.dhx_globalImgPath="<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/codebase/imgs/";


var values = new Array();




  
           
           
     var is_null = function(input){

	return input==null;
      }
			    function styleInPageColor(css, verbose){
				var c = new Array();
				var css;
				    
				    if(css==='color' || css==='backgroundColor' || css==='borderColor'){
				    
					
					c.push('rgba(0,0,0,0);');
					c.push('rgb(255,0,0);');
					c.push('rgb(0,255,0);');
					c.push('rgb(0,0,255);');
					c.push('rgb(255,255,0);');
					c.push('rgb(0,255,255);');
					c.push('rgb(255,0,255);');
					c.push('rgb(192,192,192);');
					c.push('rgb(255,255,255);');
				    
				    }
				    
				    v=0;
				    
				    
				   $('div, span, label, ul, ul li, p, h1, h2, h3, font, body, ifrace, fieldset, pazoogle, input, select, textarea').each(function(e){
				    try{
					if($(this).attr('id')){
				   
					    id = "#" + $(this).attr('id');
					   // procpt(id);
					
					    var value = $(id).css(css);
					    if(value != '' & value != 'undefined' & !is_null(value)){
					  
					      if(!inArray(value, c)){
						  c.push(value);
					      v++;
					      }
					    }
					}else{
					
					   
					}
				    }catch(oops){}
					
				    });
				    
				    values[css] = c;
				    return values;
				}
				
				
				function styleInPageFont(css, verbose){
				var m = new Array();
				var css;
				    
				  
					m.push('academy engraved let');
					m.push('algerian');
					m.push('amaze');
					m.push('arial');
					m.push('arial black');
					m.push('balthazar');
					m.push('bankgothic lt bt');
					m.push('bart');
					m.push('bimini');
					m.push('comic sans ms');
					m.push('book antiqua');
					m.push('bookman old style');
					m.push('braggadocio');
					m.push('britannic bold');
					m.push('brush script mt');
					m.push('century gothic');
					m.push('century schoolbook');
					m.push('chasm');
					m.push('chicago');
					m.push('colonna mt');
					m.push('comic sans ms');
					m.push('commercialscript bt');
					m.push('coolsville');
					m.push('courier');
					m.push('courier new');
					m.push('cursive');
					m.push('dayton');
					m.push('desdemona');
					m.push('fantasy');
					m.push('flat brush');
					m.push('footlight mt light');
					m.push('futurablack bt');
					m.push('futuralight bt');
					m.push('garamond');
					m.push('gaze');
					m.push('geneva');
					m.push('georgia');
					m.push('geotype tt');
					m.push('(*above: Geotype TT)');
					m.push('helterskelter');
					m.push('helvetica');
					m.push('herman');
					m.push('highlight let');
					m.push('impact');
					m.push('jester');
					m.push('joan');
					m.push('john handy let');
					m.push('jokerman let');
					m.push('kelt');
					m.push('kids');
					m.push('kino mt');
					m.push('la bamba let');
					m.push('lithograph');
					m.push('lucida console');
					m.push('map symbols');
					m.push('marlett');
					m.push('(*above: Marlett)');
					m.push('matteroffact');
					m.push('matisse itc');
					m.push('matura mt script capitals');
					m.push('mekanik let');
					m.push('(*above: mekanik let)');
					m.push('monaco');
					m.push('monospace');
					m.push('monotype sorts');
					m.push('ms linedraw');
					m.push('new york');
					m.push('olddreadfulno7 bt');
					m.push('(*above: OldDreadfulNo7 BT)');
					m.push('orange let');
					m.push('palatino');
					m.push('playbill');
					m.push('pump demi bold let');
					m.push('puppylike');
					m.push('roland');
					m.push('sans-serif');
					m.push('scripts');
					m.push('scruff let');
					m.push('serif');
					m.push('short hand');
					m.push('signs normal');
					m.push('(*above: Signs Normal)');
					m.push('simplex');
					m.push('simpson');
					m.push('stylus bt');
					m.push('superfrench');
					m.push('surfer');
					m.push('swis721 bt');
					m.push('swis721 blkoul bt');
					m.push('symap');
					m.push('(*above: Symap)');
					m.push('symbol');
					m.push('(*above: symbol)');
					m.push('tahoma');
					m.push('technic');
					m.push('tempus sans itc');
					m.push('terk');
					m.push('times');
					m.push('times new roman');
					m.push('trebuchet ms');
					m.push('trendy');
					m.push('txt');
					m.push('verdana');
					m.push('victorian let');
					m.push('vineta bt');
					m.push('vivian');
					m.push('webdings');
					m.push('(*above: Webdings)');
					m.push('wingdings');
					m.push('(*above: Wingdings)');
					m.push('western');
					m.push('westminster');
					m.push('westwood let');
					m.push('(*above: Westwood LET)');
					m.push('wide latin');
					m.push('zapfellipt bt');
					m.push('ACADEMY ENGRAVED LET');
					m.push('ALGERIAN');
					m.push('AMAZE');
					m.push('ARIAL');
					m.push('ARIAL BLACK');
					m.push('BALTHAZAR');
					m.push('BANKGOTHIC LT BT');
					m.push('BART');
					m.push('BIMINI');
					m.push('COMIC SANS MS');
					m.push('BOOK ANTIQUA');
					m.push('BOOKMAN OLD STYLE');
					m.push('BRAGGADOCIO');
					m.push('BRITANNIC BOLD');
					m.push('BRUSH SCRIPT MT');
					m.push('CENTURY GOTHIC');
					m.push('CENTURY SCHOOLBOOK');
					m.push('CHASM');
					m.push('CHICAGO');
					m.push('COLONNA MT');
					m.push('COMIC SANS MS');
					m.push('COMMERCIALSCRIPT BT');
					m.push('COOLSVILLE');
					m.push('COURIER');
					m.push('COURIER NEW');
					m.push('CURSIVE');
					m.push('DAYTON');
					m.push('DESDEMONA');
					m.push('FANTASY');
					m.push('FLAT BRUSH');
					m.push('FOOTLIGHT MT LIGHT');
					m.push('FUTURABLACK BT');
					m.push('FUTURALIGHT BT');
					m.push('GARAMOND');
					m.push('GAZE');
					m.push('GENEVA');
					m.push('GEORGIA');
					m.push('GEOTYPE TT');
					m.push('(*above: Geotype TT)');
					m.push('HELTERSKELTER');
					m.push('HELVETICA');
					m.push('HERMAN');
					m.push('HIGHLIGHT LET');
					m.push('IMPACT');
					m.push('JESTER');
					m.push('JOAN');
					m.push('JOHN HANDY LET');
					m.push('JOKERMAN LET');
					m.push('KELT');
					m.push('KIDS');
					m.push('KINO MT');
					m.push('LA BAMBA LET');
					m.push('LITHOGRAPH');
					m.push('LUCIDA CONSOLE');
					m.push('MAP SYMBOLS');
					m.push('MARLETT');
					m.push('(*above: Marlett)');
					m.push('MATTEROFFACT');
					m.push('MATISSE ITC');
					m.push('MATURA MT');
					m.push('MEKANIK LET');
					m.push('(*above: mekanik let)');
					m.push('MONACO');
					m.push('MONOSPACE');
					m.push('MONOTYPE SORTS');
					m.push('MS LINEDRAW');
					m.push('NEW YORK');
					m.push('OLDDREADFULNO7 BT');
					m.push('(*above: OldDreadfulNo7 BT)');
					m.push('ORANGE LET');
					m.push('PALATINO');
					m.push('PLAYBILL');
					m.push('PUMP DEMI BOLD LET');
					m.push('PUPPYLIKE');
					m.push('ROLAND');
					m.push('SANS-SERIF');
					m.push('SCRIPTS');
					m.push('SCRUFF LET');
					m.push('SERIF');
					m.push('SHORT HAND');
					m.push('SIGNS NORMAL');
					m.push('(*above: Signs Normal)');
					m.push('SIMPLEX');
					m.push('SIMPSON');
					m.push('STYLUS BT');
					m.push('SUPERFRENCH');
					m.push('SURFER');
					m.push('SWIS721 BT');
					m.push('SWIS721 BLKOUL BT');
					m.push('SYMAP');
					m.push('(*above: Symap)');
					m.push('SYMBOL');
					m.push('(*above: symbol)');
					m.push('TAHOMA');
					m.push('TECHNIC');
					m.push('TEMPUS SANS ITC');
					m.push('TERK');
					m.push('TIMES');
					m.push('TIMES NEW ROMAN');
					m.push('TREBUCHET MS');
					m.push('TRENDY');
					m.push('TXT');
					m.push('VERDANA');
					m.push('VICTORIAN LET');
					m.push('VINETA BT');
					m.push('VIVIAN');
					m.push('WEBDINGS');
					m.push('(*above: Webdings)');
					m.push('WINGDINGS');
					m.push('(*above: Wingdings)');
					m.push('WESTERN');
					m.push('WESTMINSTER');
					m.push('WESTWOOD LET');
					m.push('(*above: Westwood LET)');
					m.push('WIDE LATIN');
					m.push('ZAPFELLIPT BT');


				    
				    v=0;
				    
				    
				   $('div, span, label, ul, ul li, font, body, iframe, fieldset, pazoogle, input, select, textarea').each(function(e){
				    try{
					if($(this).attr('id')){
				   
					    id = "#" + $(this).attr('id');
					   // prompt(id);
					
					    var value = $(id).css(css);
					    
					   
					    if(value != '' & value != 'undefined' & !is_null(value)){
					  
					      if(!inArray(value, m)){
						  m.push(value);
					      v++;
					      }
					    }
					    
					  
					}else{
					
					   
					}
				    }catch(oops){}
					
				    });
				    values[css] = m;
				    return values;
				}
				
				
				styleInPageColor('color', true);
				styleInPageFont('fontFace', true);
				styleInPageColor('backgroundColor', true);
				styleInPageColor('borderColor', true);
				
				fonts_used = values.fontFace;
				colors_used = values.color;
				bg_colors_used = values.backgroundColor;
				margin_colors_used = values.borderColor;
				
				
				
				
				
				
				
				
				
				
				
			palette_in = '';
				
				for(c = 0; c < colors_used.length; c++){
				  color = colors_used[c];
				  
				  if(color != 'undefined' & color != '' & ! palette_in.match(color)){
					 
					  palette_in += "'" + color + "',";
				    }
				
				}
				for(c = 0; c < bg_colors_used.length; c++){
				  color = bg_colors_used[c];
				  
				  if(color != 'undefined' & color != '' & ! palette_in.match(color)){
					  
					  palette_in += "'" + color + "',";
				    }
				
				}
				
				for(c = 0; c < margin_colors_used.length; c++){
				  color = margin_colors_used[c];
				  
				  if(color != 'undefined' & color != '' & ! palette_in.match(color)){
				
					 palette_in += "'" + color + "',";
				    }
				
				}
				
		
			//prompt($('<?php echo $_REQUEST['id'];?>').css('linear-gradient'));



					  

function update_reflect(divId, lVal){
  
    $( divId).css('box-reflect', lVal);
  


}
function update_transition(divId, lVal){
  
    $( divId).css('box-reflect', lVal);
  


}
function update_text_shadow(divId, lVal){
  
    $( divId).css('text-shadow', lVal);
  


}


function popup_css_help(page){
window.open("http://www.w3schools.com/" + page )


}




function update_display(divId, lVal){
  $( divId).css('display', lVal );
  


}
function update_left(divId, lVal){
    
    $( divId).css('left', lVal + 'px');
  


}
function update_radius(divId, bVal){
   
     $(divId).css('borderRadius', bVal);
}
function update_shadow(divId, bVal){
    
     $( divId).css('box-shadow', bVal);
}

function update_top(divId, tVal){
    
    $( divId).css('top', tVal + 'px');

}
function update_background(divId, bVal){
     //$('.homepage').css('background', bVal);
     $( divId).css('background', bVal);
}
function update_width(divId, bVal){
    if(isNaN($('#width').val()) & $('#widthUnit').val() != 'auto'){
	alert("Width must be numeric");
    }else{
    
	  if($('#widthUnit').val() != 'auto'){
	      $('#width').css('display', 'block');
	      $( divId).css('width', $('#width').val() + $('#widthUnit').val());
	  }else{
	      $('#width').css('display', 'none');
	      $( divId).css('width', 'auto');
	  
	  }
     
     }
}

function update_min_width(divId, bVal){
    if(isNaN($('#min-width').val()) & $('#min-widthUnit').val() != 'auto'){
	alert("Width must be numeric");
    }else{
    
	  if($('#min-widthUnit').val() != 'auto'){
	      $('#min-width').css('display', 'block');
	      $( divId).css('min-width', $('#min-width').val() + $('#min-widthUnit').val());
	  }else{
	      $('#min-width').css('display', 'none');
	      $( divId).css('min-width', 'auto');
	  
	  }
     
     }
}
function update_max_width(divId, bVal){
    if(isNaN($('#max-width').val()) & $('#max-widthUnit').val() != 'auto'){
	alert("Width must be numeric");
    }else{
    
	  if($('#max-widthUnit').val() != 'auto'){
	      $('#max-width').css('display', 'block');
	      $( divId).css('max-width', $('#max-width').val() + $('#max-widthUnit').val());
	  }else{
	      $('#max-width').css('display', 'none');
	      $( divId).css('max-width', 'auto');
	  
	  }
     
     }
}


function update_min_height(divId, bVal){
    if(isNaN($('#min-height').val()) & $('#min-heightUnit').val() != 'auto'){
	alert("Height must be numeric");
    }else{
    
	  if($('#min-heightUnit').val() != 'auto'){
	      $('#min-height').css('display', 'block');
	      $( divId).css('min-height', $('#min-height').val() + $('#min-heightUnit').val());
	  }else{
	      $('#min-height').css('display', 'none');
	      $( divId).css('min-height', 'auto');
	  
	  }
     
     }
}

function update_max_height(divId, bVal){
    if(isNaN($('#max-height').val()) & $('#max-heightUnit').val() != 'auto'){
	alert("Height must be numeric");
    }else{
    
	  if($('#max-heightUnit').val() != 'auto'){
	      $('#max-height').css('display', 'block');
	      $( divId).css('max-height', $('#max-height').val() + $('#max-heightUnit').val());
	  }else{
	      $('#max-height').css('display', 'none');
	      $( divId).css('max-height', 'auto');
	  
	  }
     
     }
}
function update_height(divId, bVal){
    if(isNaN($('#height').val()) & $('#heightUnit').val() != 'auto'){
	alert("Height must be numeric");
    }else{
    
	  if($('#heightUnit').val() != 'auto'){
	      $('#height').css('display', 'block');
	      $( divId).css('height', $('#height').val() + $('#heightUnit').val());
	  }else{
	      $('#height').css('display', 'none');
	      $( divId).css('height', 'auto');
	  
	  }
     
     }
}
 function update_float(divId){
	$(divId).css('float', $('#float').val());
						  
 }
				
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}


			    function extract_number_from_string(str){
			   
			    try{
				return Math.round(str.replace( /[^0-9\']/g, ''));//remove alpha
				}catch(o){  }
				
				
			    }
			     function extract_neg_number_from_string(str){
			    try{
				return Math.round(str.replace( /[a-z]/g, ''));//remove alpha
				}catch(o){  }
				
			    }
			    function extract_text_from_string(str){
			    try{
				return str.replace( /[0-9]/g, '');//remve numerals
				}catch(o){  }
				
			    }
			    
			    
			    
			    var borders;
			      borders = new Array();
			
			
			
			
			
			
			
			
			  function create_editor_action(tag, action, divId, state){
			
			      if(state){
			      
				  if(state == 'a'){
				      $('#with_tag').val(tag + ':' + state);
				      
				      create_editor_action(tag+':'+ state, action, divId);
				      tag = tag+':'+ state;
			      
			      
				  }else if(state == 'input'){
				  
				      $('#with_tag').val(tag + '[type="' + state + '"]');
				      
				      create_editor_action(tag + '[type="' + state + '"]', action, divId);
				      tag = tag + '[type="' + state + '"]';
				  
				  }
			      
			      }
			      if(tag != ''){
			      
			      
				    switch(tag){
				      case 'a':
				      
					  $('#tag_action').qtip({ 
					      content:{
						  text: '<a href="javascript:;" onclick="create_editor_action(\'' + tag + '\', \'' + action + '\', \'' + divId + '\', \'active\');">active</a><br /><a href="javascript:;" onclick="create_editor_action(\'' + tag + '\', \'' + action + '\', \'' + divId + '\', \'hover\');">hover</a><br /><a href="javascript:;" onclick="create_editor_action(\'' + tag + '\', \'' + action + '\', \'' + divId + '\', \'visited\');">visited</a><br />',
						    title:{
							text: 'Please Choose a Browser State',
							button: 'close'
						    
						    }
						  
						},
					    show: { event: 'click', ready: true, solo: true, delay:90 },
					    hide: { event: 'unfocus' },
					    style:{
						classes:'tooltip_css_editor'
					    },
									    position:{
						target:$('#tag_action'),
						my: 'top left',
						at: 'bottom left'
					    
					    }
					  
					  
					  });
				      
				      break;
				      
				      
				      case 'input':
					  $('#tag_action').qtip({
					  
					  
					  });
				      
				      break;
				  
				      default:
					 switch(action){
					
					
					    case 'append':
					      create_editor(divId + ' ' + tag, 'psuedo');
					    break;
					    case 'prepend':
					      create_editor(tag + ' ' + divId, 'psuedo');
					    break;
					    case 'global':
						create_editor(tag, 'tag');
					    break;
					
					}
				      
				      }
				  }
			  
			  }

				
				 
				
				
				
			
				  
				$('.borders').each(function(){
				
				    var id = $(this).attr('id');
				    var property = $(this).attr('title');
				    var type = $(this).attr('type');
				    var value = $(document.getElementById('<?php echo $_REQUEST['id'];?>')).css($(this).attr('title'));
				     
				     newProperty = get_property(property);
				      
				    
				    
				    switch(newProperty){
				    
					  <?php
					foreach($sides as $side){
				      ?>
					  case 'border<?php echo ucfirst($side); ?>':
					      
						
					  break;
				
					<?php } ?>
				      
				    
				    }
				    
				    
				});
				
				  
				$('.other').each(function(){
				
				    var id = $(this).attr('id');
				    
				    var property = $(this).attr('title');
				    var type = $(this).attr('type');
				 
				    switch(property){
					case 'opacity':
					    var opacity = $('<?php echo $_REQUEST['id'];?>').css('opacity');
					    $('#hidden-opacity').val(opacity);
					break;
					case 'z-index':
					    str = ' ' + $('<?php echo $_REQUEST['id'];?>').css('zIndex');
					    if(!str.match(/undefined/)){
					      document.getElementById(id).value = str;
					      }else{
					      str = '';
					      }
					break;
					case 'margin':
					
					/*    str = $('<?php echo $_REQUEST['id'];?>').css('margin-top');
					    
					    str += ' ' + $('<?php echo $_REQUEST['id'];?>').css('margin-right');
					    
					    str += ' ' + $('<?php echo $_REQUEST['id'];?>').css('margin-bottom');
					    
					    str += ' ' + $('<?php echo $_REQUEST['id'];?>').css('margin-left');
					    if(!str.match(/undefined/)){
					      document.getElementById(id).value = str;
					      }else{
					      str = '';
					      }
					  */
					  
					break;
					case 'display':
					    str = $('<?php echo $_REQUEST['id'];?>').css('display');
					    $('#display option:selected').val(str);
					
					
					break;
					/*case 'paddding':
					    str = $('<?php echo $_REQUEST['id'];?>').css('padding-top');
					 
					    str += ' ' + $('<?php echo $_REQUEST['id'];?>').css('padding-right');
					 
					    str += ' ' + $('<?php echo $_REQUEST['id'];?>').css('padding-bottom');
					 
					    str += ' ' + $('<?php echo $_REQUEST['id'];?>').css('padding-left');
					 
					   if(!str.match(/undefined/)){
					  document.getElementById(id).value = str;
					  }else{ str = ''; }
					
					break;*/
					
					
					case 'border-radius':
					
					    str = $('<?php echo $_REQUEST['id'];?>').css('borderRadius');
					 
					  
					 
					// if(!str.match(/undefined/)){
					  document.getElementById(id).value = str;
					//  }else{ str = ''; }				  					
					    
					break;
					
					
					
					
					
					
					
					
					
					
					case 'box-shadow':
					var values_d;
					values_d = new Array();
					
					    str = $('<?php echo $_REQUEST['id'];?>').css('box-shadow');
			
					    values = str.split(") ");
					    color = hexToRgb( values[0] + ")");
					   
					    
					   try{ 
					    values_c = values[0].split(" "); 
					    values_d = values[1].split(" "); 
					    
					    
					    
					    console.log(values[0]);
					    
					   }catch(oops){ if(values_d){ values_d[0] = ''; values_d[1] = ''; values_d[2] = ''; color = ''; } }
					    
					    
					  if(!str.match(/undefined/)){
					      try{  if(values_d){ document.getElementById(id).value = values_d[0] + ' ' + values_d[1] + ' ' + values_d[2] + ' ' + color; } }catch(oops){ document.getElementById(id).value =''  }
					  }else{
					  str = '';
					  }
					break;
					
					case 'color':
					
					break;
					case 'font-style':
					
					
					break;
					case 'background':
					    get_background('<?php echo $_REQUEST['id'];?>');
					break;
					case 'font-variant':
					    str = $('<?php echo $_REQUEST['id'];?>').css('font-variant');
					 
					    
					 
					  if(!str.match(/undefined/)){
					      document.getElementById(id).value = str;
					  }else{
					  str = '';
					  }
					break;
					case 'text-indent':
					    str = $('<?php echo $_REQUEST['id'];?>').css('text-indent');
					 
					    
					 
					   if(!str.match(/undefined/)){
					  document.getElementById(id).value = str;
					  }else{
					  str = '';
					  }
					break;					
				
								
					case 'font-weight':
					   
					break;
					case 'text-shadow':
					  str = $('<?php echo $_REQUEST['id'];?>').css('text-shadow');
					 
					    
					 
					  if(!str.match(/undefined/)){
					  document.getElementById(id).value = str;
					  }else{
					  str = '';
					  }
					
					break;
					case 'font-family':
					    str = $('<?php echo $_REQUEST['id'];?>').css('font-family');
					 
					    
					 
					  if(!str.match(/undefined/)){
					  document.getElementById(id).value = str;
					  }else{
					  str = '';
					  }
					break;
					
				    }
				    
				      
				});
			function choose_action(divId, picker, color){
			
			
			    switch(picker){
			    
				case 'color':
				  color = $('<?php echo $_REQUEST['id'];?>').css('color');
				  $('#color').val(hexToRgb(color));
				  
				 break;
				 case 'transition':
				  transition = $('<?php echo $_REQUEST['id'];?>').css('transition');
				  $('#transition').val(transition);
				  
				 break;
				 case 'box-reflect':
				    str = $('<?php echo $_REQUEST['id'];?>').css('box-reflect');
				    
				    $('#box-reflect').val(str);
				 break;
				
				 
				  }
			}
			
			
			

		
				/*$('#my_css_editor input').each(function(){
				    var id = $(this).attr('id');
				    if(id){
				    var exist_value = $(id).val();
				    if(exist_value.match(/undefined/)){
				    
					$(id).val('');
				    }
				   } 
				  });*/
				  
				
				//	$( "#amount" ).val( $( "#slider-vertical" ).slider( "value" ) );
				    
				
				  
				  
				     $.extend($.expr[':'], {
					AvantGardel: function(elem){
					    var $e = $(elem);
					    return( typeof $e.css('font-family') !== 'undefined' && $e.css('font-family') === 'AvantGardeITCbyBT-Bold' );
					},
					SansSerif: function(elem){
					  var $e = $(elem);
					    return( typeof $e.css('font-family') !== 'undefined' && $e.css('font-family') === 'sans-serif' );
					}
				    });
				//    $('#my_css_editor_loading_bar').css('display', 'none');
				//    $('#my_css_editor').css('display', 'block');
				    
				    $(document).ready(function(){
				    
				     $('#my_css_editor_loading_bar').css('display', 'block');
				    
					    $.get('<?php echo $SITE_URL; ?>include/addons/design_suite/DESIGN/editor/transform.php?id=' + encodeURIComponent($('#selector').val()) , function(response){
			  
					      $('#transform_me').html(response);
					  
					      });
					  
					  
					  
					  
					      $.get('<?php echo $SITE_URL; ?>include/addons/design_suite/DESIGN/editor/transition.php?id=' + encodeURIComponent($('#selector').val()), function(response){
					      
					      $('#transition_me').html(response);
					  
					      });
					      
					      
					      
					      
					      $.get('<?php echo $SITE_URL; ?>include/addons/design_suite/DESIGN/editor/construction.php?id=' + encodeURIComponent($('#selector').val()), function(response){
					      
					      $('#offset_me').html(response);
					  
					      });
					      
					        $.get('<?php echo $SITE_URL; ?>include/addons/design_suite/DESIGN/editor/construction.php?id=' + encodeURIComponent($('#selector').val()), function(response){
					      
					      $('#boxsize_me').html(response);
					  
					      });
					      
					        $.get('<?php echo $SITE_URL; ?>include/addons/design_suite/DESIGN/editor/construction.php?id=' + encodeURIComponent($('#selector').val()), function(response){
					      
						  $('#interface_me').html(response);
						      if(!$('<?php echo $_REQUEST['id'];?>')){
							  $('#my_css_editor').css('display', 'none');
							  $('#my_css_editor_message').css('display', 'block');
						      }
					      });
					});
					
				
				
			
			      try{
				  var zi=dhtmlXComboFromSelect("template");
				  var zd=dhtmlXComboFromSelect("human_name");
				  var ze=dhtmlXComboFromSelect("human_description");
			      }catch(no){}
			      
			   
var loaded_boxes = 1;


     $('#css_form h2').each( function(id){
      
		 var id = $(this).attr('title');
		 
		 var item = $(this).attr('title');
		
	
		if(item != 'undefined'){
		    $(this).qtip( { id: 'edit_tt', content: { 
					    text : '<img src="<?php echo $SITE_URL;?>include/addons/design_suite/loading.gif" align="center" width="30px" height="30px" />',
						
					    title: { text: '<h37>Edit ' + $(this).html() + ' for ' + '<?php echo $_REQUEST['id'];?></h37>', botton: 'Close' }, 
					    
					  
					    ajax : {
					    
						url: '<?php echo $SITE_URL;?>include/addons/design_suite/DESIGN/editor/' + item + '.php',
						data: { switch: item, id: '<?php echo $_REQUEST['id']; ?>', type: '<?php echo $_REQUEST['type'];?>' },
						type: 'get',
						success: function(data, status){
						
						    this.set('content.text', data);
						
						}
					    
					    
					    
					    }
					    
					  },
					      //prerender: true,
						    position: {
							my: 'bottom middle',
							at: 'top middle',
							container: $('body'),
							viewport:$(document.body),
							resize: true,
							target: $(this),
							
							adjust : {
										method : 'flip'
										}
							
							},
							show: {
							prerender:true,
							ready:true,
							solo: true
							
							},
							style:{
							height: 350,
							
							},
							
							
							hide : { event: 'unfocus' },
							   events: {
							      render: function(event) {
							      $(this).draggable({ handle: 'h37' });
							      $(this).css('position', 'fixed');
							       
								
								}
								
								
							     
							   },
							   
							 api: {
							    onRender: function(event) {
								$(window).resize(function(){
								   $('.qtip').qtip('reposition');
								});
							     
							    },
							    onContentUpdate: function(event){
								
							    
							    }
							    
							}
						
						      });
						    //  $('#my_css_editor_loading_bar').css('display', 'none');
						   //   $('#css-editor').css('display', 'block');
						
						
						
							      
							    
						}
loaded_boxes = loaded_boxes + 1;
						  if(loaded_boxes == 7){
						    
									$('#my_css_editor_loading_bar').css('display', 'none');  
									$('#my_css_editor').css('display', 'block');
								  }else{
								  
								      $('#my_css_editor_loading_bar').css('display', 'block');
								      
								      $('#my_css_editor_loading_bar').html('Loading Interface ' + loaded_boxes);
								  }
								  
 
				    });
 
 
 
/*
		$(document).ready(function(){
		*/
  
                
     /*             
     $('.accordion h3').bind('click', function(event){
        
        create_editor_tooltip();
        $('#this_tooltip_needs_to_work').html($(event).next('.panel'));
		
           });
           */
		

       	  
       
 /* (function( $ ) {
    $.widget( "ui.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "ui-combobox" )
          .insertAfter( this.element );
 
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "ui-state-default ui-combobox-input ui-widget ui-widget-content ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "ui-corner-right ui-combobox-toggle" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.data( "ui-autocomplete" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
 
  $(function() {
    $( "#with_class" ).combobox();
   
  });
  */
 

  function add_new_selector(divId, type){
  
	  if($(divId).length){
      
	    create_editor(divId, $('#type').val());
	    
	   }else{
	   
	      $('#dialog').html('<div id="confirm_new_selector"></div>');
	      
	      
	   
	   }
      
      }
      
      function add_new_selector(){
      
      
       $($('#selector').val()).effect("pulsate", { times:3 }, 2000);
      
      
      }
	$('#selector').keypress(function (e) {
	  var se = document.getElementById("type_sel");
	  var strUser = se.options[se.selectedIndex].value;
	  var new_selector = $('#selector').val();

	      if (e.which == 13) {
	   
		 if($(new_selector).length){
			    do_it_now($('#selector').val(), strUser);
			//create_editor($('#selector').val(), $('#type').val());
	    
		      }else{
		       do_it_now($('#selector').val(), strUser, 'yes');
		      
		     // create_editor($('#selector').val(), $('#type').val(), 'yes');
		      
	   
		    }
		
		
	      }
	});
  </script>				
				


					    <script type="text/javascript">
						<?php //include("editor/java.php"); ?>
						
						 </script>
<?php

?>


<div id="my_css_editor_message" style="display:none;">Please Choose a known Selector</div>

	  <div id="my_css_editor" style="display:none;position:relative;padding-right:10px;">
		<form id="css_form">
 
 
		    <table style="vertical-align:top;min-width:100%;float:center;margin:0 0 5px 5px;padding:2px 0 0 0;">
			  <tr>
			      <td colspan="10">
				  <?php include("editor/top.php"); ?>
			      </td>
			  </tr>
			     <?php if(!empty($_REQUEST['id'])){ ?>
			  <tr>
			      <td colspan="10"  style="position:relative;top:-10px;">
				  <?php include("editor/sql_editor.php"); ?>
			      </td>
			  </tr>
			  
			      <?php } ?>
			  <tr>
			      <td colspan="10">
			      
			       <?php if(!empty($_REQUEST['id'])){ ?>
				    <table>
				   

				
					
					<tr>
					<td colspan="10">
				      
					<table>
					<tr> 
					
					  <td valign="top" height="100%" style="vertical-align:top;text-align:center;border-radius:15px;"" align="center" colspan="1" title="position">
					    <h2 title="position">Position</h2>
					    
					    
					    
						    <?php //include('editor/position.php'); ?>	    
						    
					  
					  </td>
					  
					  <td valign="top" height="100%" style="vertical-align:top;text-align:center;border-radius:15px;"" align="center" colspan="1" title="borders">
					      <h2 title="borders">Borders</h2>
						
						

						    <?php //include('editor/borders.php'); ?>
						    
					  </td>
					    
					  <td valign="top" height="100%" style="vertical-align:top;text-align:center;border-radius:15px;"" align="center" colspan="1" title="padding">
					      <h2 title="padding">Margins & Padding</h2>
						
						
					      
						
						
						    <?php //include("editor/padding.php"); ?>  
						
						</td>
					      
						

						<td valign="top" height="100%" style="vertical-align:top;text-align:center;border-radius:15px;"" align="center" colspan="1" title="fonts">
						<h2 title="fonts">Fonts</h2>
						
						
						
						    <?php //include("editor/fonts.php"); ?>
						</td>
					      
					      <td valign="top" height="100%" style="vertical-align:top;text-align:center;border-radius:15px;"" align="center" colspan="1" title="background">
					      
						<h2 title="background">Background</h2>
						
						    <?php //include("editor/background.php"); ?>
						    
						  
						      
					      </td>
						
						
						<td valign="top" height="100%" style="vertical-align:top;text-align:center;border-radius:15px;width:50px;""" align="center" colspan="1">
						  
					      
						
						
						
						
							<?php //include("editor/other.php"); ?>
							<h2 title="dimensions">Dimensions</h2>
						
						
						    
						    <?php //include("editor/dimensions.php"); ?> 
						  
						
						</td>
						
						<td valign="top" height="100%" style="vertical-align:top;text-align:center;border-radius:15px;width:50px;""" align="center" colspan="1">
						  
					      
						
						<h2 title="other">Other</h2>
						
						
						
						</td>
						
						<td valign="top" height="100%" style="vertical-align:top;text-align:center;border-radius:15px;width:100px;"" align="center" colspan="1" title="css3">
						
						
						<h2 title="css3">CSS3</h2>
						    
							<?php  //include("editor/css3.php"); ?>
						</td>
					    

				      
				      
				      
				      
				      
				      
					      
					</tr>
				    

				   
				    </table>
				     <?php } ?>
			      </td>
			  </tr>
		    </table>
		</form>
	  </div>
	

<div id="css_live" style="display:block;"></div>


