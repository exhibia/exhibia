<?php


function menu_start($menu_id, $design_m_r, $m_settings, $admin_not, $l, $c, $m, $edit, $show_me){
	 if($show_me == 'true'){
	 //echo "select * from " . $m_settings['table'][1] . " where " . $m_settings['table']['select'][3] . " = '$design_m_r[id]' and menu = '$design_m_r[menu_name]'";
	?>
	 <li>
	
			
			<?php echo $design_m_r['link']; ?>
			
			<?php 
			$string = $design_m_r['link_text'];
			
			$pattern = '/\[\[(.*)]]/';
			$replacement = constant(strtoupper('${1}1'));
			$string = preg_replace($pattern, $replacement, $string);
			
			
			
			    
			    echo $string;
			   
			    
			    
			 echo db_error();
			    
			?>
				    
			  </a>
			    
			 
			
			<?php
			
			//}
		       ?>
		
	
		      
		   </li>
		 
		 <?php  
		    
		}
		

	  }
