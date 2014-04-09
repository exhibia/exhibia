


<?php
include("../../../config/config.inc.php");

$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);


db_select_db($DATABASENAME, $db);
	$ids_sql1 = "select distinct(selector), type from style_sheets where ";

		    if(!empty($_COOKIE['template']) & $_COOKIE['template'] != 'undefined'){
			$ids_sql2 = " template = '$_COOKIE[template]'";

		    }else{
			$ids_sql2 = " template = '$template'";

		    }
		    $ids_sql3 = " selector != ''";
		    if(!empty($_REQUEST['selector'])){
		    
			$ids_sql3 = " selector like '" . urldecode($_REQUEST['selector']) . " %'";
		    }
		  $selectors = array();
		
		$sql_css1 = db_query($ids_sql1 . $ids_sql2 . " and " . $ids_sql3 . " and page='$template.css' and editable = '1' and " . $ids_sql2 . " order by selector, id asc");
		
		
$last_h50 = uniqid();
 
		    while($ids = db_fetch_array($sql_css1)){
		    $unique_class = uniqid();
		    
		    
		      if(!in_array($ids[0], $selectors)){
			
			$selectors[] = $ids[0];
			
			
			

		    switch($ids['type']){
			      
			      case('id'):
			    
				$edit_handle = 'h18';
				$img = 'move.png';
				$left = '-5px';
				$margin_r = '10px';
				$color = 'green';
			      break;
			      case('tag'):
				$edit_handle = 'h19';
				$ids['type'] = 'tag';
				$img = 'css.png';
				$margin_r = '10px';
				$left = '-15px';
				$color = 'gray';
			      break;
			      case('class'):
				$edit_handle = 'h20';
				$img = 'html.png';
				$ids['type'] = 'class';
				$left = '-20px';
				$margin_r = '10px';
				$color = 'red';
			      break;
			      case('psuedo'):
				$edit_handle = 'h19';
				$ids['type'] = 'psuedo';
				$img = 'css.png';
				$margin_r = '10px';
				$left = '-15px';
				$color = 'blue';
			      break;
				  
				
		      }

	     
	      
		    if(empty($_REQUEST['selector'])){
		    
		    ?>
		    <script>
		    
		   
		    
		    <?php 
		    if($ids['type'] == 'id'){
		    ?>
		     if($("<?php echo $ids['selector']; ?>").prop("tagName") != 'UL' & $("<?php echo $ids['selector']; ?>").prop("tagName") != 'OL' & '<?php echo $ids['selector']; ?>' != '#navigation'){
		    
				  $('<?php echo $ids['selector']; ?>').prepend('<h50 onclick="create_editor(\'<?php echo $ids['selector']; ?>\', \'<?php echo $ids['type']; ?>\');" class="preview_button <?php echo $unique_class;?> top_h50 editor_ids" style="display:inline;float:left;margin-bottom:-100%;position:relative;top:5px;left:20px;background-color:<?php echo $color;?>;visibility:' + getCookie('ids') + ';" title="<?php echo $ids['selector']; ?>" id="<?php echo $last_h50; ?>"><?php echo $ids['selector']; ?></h50>');
			}else{
			
				  $('<?php echo $ids['selector']; ?>').before('<h50 onclick="create_editor(\'<?php echo $ids['selector']; ?>\', \'<?php echo $ids['type']; ?>\');" class="preview_button <?php echo $unique_class;?> top_h50 editor_ids" style="display:inline;float:left;margin-bottom:-100%;position:relative;top:5px;left:20px;background-color:<?php echo $color;?>;" title="<?php echo $ids['selector']; ?>" id="<?php echo $last_h50; ?>"><?php echo $ids['selector']; ?></h50>');
			
			
			}
				  
		     <?php 
		   }else  if($ids['type'] == 'class'){
		    ?>
			
				    $('<?php echo $ids['selector']; ?>').before('<h60 onclick="create_editor(\'<?php echo $ids['selector']; ?>\', \'<?php echo $ids['type']; ?>\');" class="preview_button <?php echo $unique_class;?> top_h50 editor_ids" style="visibility:collapse;display:inline;float:left;margin-bottom:-100%;position:relative;top:5px;left:20px;background-color:<?php echo $color;?>;" title="<?php echo $ids['selector']; ?>" id="<?php echo $last_h50; ?>"><?php echo $ids['selector']; ?></h60>');
		<?php }
		
		else  if($ids['type'] != 'tag'){
		?>
		if($("<?php echo $ids['selector']; ?>").prop("tagName") != 'UL' & $("<?php echo $ids['selector']; ?>").prop("tagName") != 'OL' & '<?php echo $ids['selector']; ?>' != '#navigation'){
			
			 $('<?php echo $ids['selector']; ?>').before('<h70 onclick="create_editor(\'<?php echo $ids['selector']; ?>\', \'<?php echo $ids['type']; ?>\');" class="preview_button <?php echo $unique_class;?> top_h50 editor_ids" style="visibility:collapse;display:inline;float:left;margin-bottom:-100%;color:#fff;font-size:8px;position:relative;top:5px;left:20px;background-color:blue;" title="<?php echo $ids['selector']; ?>" id="<?php echo $last_h50; ?>"><?php echo $ids['selector']; ?></h70>');
		
		}
		<?php } ?>
			
			
				  try{
				  $(function(){
					    
				      });
				  }catch(oo){}
				  
				  
					$('<?php echo $ids['selector']; ?>').draggable({handle:'h50', stop:function(event,ui){   			create_editor($('<?php echo $ids['selector']; ?> h50').text(), '<?php echo $ids['type']; ?>'); } });
					
			
					
					      
					     
					      $('#my_css_editor_loading_bar').html('<font style="color:red;font-weight:bold;">Loading tabs for <?php echo $ids['selector']; ?></font>');
					      
					     
				 
					
		    </script>
		    <?php
			      }else{
			       if(!empty($_REQUEST['selector'])){
				      if($_REQUEST['type'] == 'id'){
			      ?>	
						<dt style="font-size:9px;cursor:pointer;color:blue;"  onclick="javascript: create_editor('<?php echo $ids['selector']; ?>', '<?php echo $ids['type']; ?>');"><?php echo $ids['selector']; ?></dt>
				      
			      <?php	
				      }else{
					    
			      ?>	
						<dt style="font-size:9px;cursor:pointer;olor:blue;"  onclick="javascript: create_editor('<?php echo $ids['selector']; ?>', '<?php echo $ids['type']; ?>');"><?php echo $ids['selector']; ?></dt>
				      
			      <?php			      
					    
					    
					    }
					    
					    }
			      
			      }
		   
		
		
			}
		
			}
			
		
			
		
	?>

	