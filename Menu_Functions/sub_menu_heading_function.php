<?php

function sub_menu_heading_function($menu_id, $design_m_r, $m_settings, $admin_not, $l, $c, $m, $edit, $show_me, $edit_row, $row_links){
      ?>
      <ul title="<?php echo $design_m_r['id'];?>_<?php echo $edit_row['id'];?>" <?php if(empty($edit)){ ?> id="treemenu<?php echo $design_m_r['id'];?>_<?php echo $edit_row['id'];?>" class="treeview"<?php 
      
      }else{ 
      
      ?> id="sub_sub_menu_<?php echo $design_m_r['id'];?>_<?php echo $edit_row['id'];?>" class="sub_sub_menu" <?php 
    
    } ?><?php if(empty($edit)){ ?> style="text-indent:25px;margin:10px 0 10px 0;display:none;"<?php 
    
    
    } ?>> <!-- Second -->
											
	<li id="sub_id<?php echo uniqid();?>" <?php if(!empty($edit)){ ?> style="float:center;"<?php } ?>><?php if(empty($edit)){ 
	echo $row_links['name'];
	}
    
}

