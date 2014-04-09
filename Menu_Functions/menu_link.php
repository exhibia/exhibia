<?php


function menu_link($row_links2, $edit, $menu_id, $admin){

	$unique = uniqid();
	
	if(preg_match('/javascript/', $row_links2['link'])){
	$link = explode(":", $row_links2['link']);
	?> 
	      <a  class="prevented" href="javascript:;" onclick="<?php echo $link[1]; ?>" class="prevented"><?php echo $row_links2['link_text']; ?></a>
	    		
	<?php
	}else{
	?>
		<a class="prevented" href="<?php echo $row_links2['link']; ?>"><?php echo $row_links2['link_text'];?></a>
		
		
     
      <?php
    }
	
	
}

