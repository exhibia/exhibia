<?php


?>
   <script src="<?php echo $SITE_URL;?>js/jquery.jshowoff.min.js" type="text/javascript"></script>     

<!-- PROM BANNERS -->
    
            <div id="slider_box_games" class="jshowoff2" >
        
         
            
            
            <?php
          /*  if(db_num_rows(db_query($slider_sql)) == 0){
            
                $slider_qry = db_query($slider_sql);
                while($row_banner = db_fetch_array($slider_qry)){
               
                    echo '<div class="images" onclick="javascript: window.location.href = \'games.php?gcat=' . $row_banner[0] . '\';"><img src="' . $SITE_URL . 'uploads/games-client/banner/' . $row_banner['picture1'] . '" /></div>';
                    
                }
            }else{*/
		$images = server_images($_REQUEST, $games_server);
		
		foreach($images as $key => $value){
		if(!empty($images[$key]['img']) & !empty($images[$key]['link'])){
		     echo '<div class="images" onclick="javascript: window.location.href = \'games.php?gcat=' . $images[$key]['link'] . '\';"><img src="' . $games_server . '/uploads/games/banner/' . $images[$key]['img'] . '" /></div>';
                  }
		
		}
            
            
            //}
          ?>
      
      </div>
   <script type="text/javascript">
        
        
    $(document).ready(function() {
      <?php
        if(in_array('design_suite', $addons)){
        $a = 1;
        
		          $res_sliders = db_query("select distinct(constant) from languages where constant like 'SLIDER%' AND value != '' order by id desc");
 
	    while ($auc = db_fetch_array($res_sliders)) {
	    ?>
	   
						   
	    
        <?php
        $a++;
        }
        }
        
        ?>
       $('.jshowoff2').jshowoff({
        cssClass: 'thumbFeatures',
        pause:true
         <?php
         $sl_qry = db_query("select * from sitesetting where name = 'slider_settings' and value not like 'slider%' and value not like 'color:%' and value not like 'buttonset%'");
         
         while($sl_row = db_fetch_array($sl_qry)){
	    $effect = explode(":", $sl_row['value']);
	    if($effect[0] != 'links' & $effect[0] != 'controls'){
		echo ",\n" . $effect[0] . ": " . $effect[1];
	    }else{
	    
		if($effect[1] != 'false'){
		    echo ",\n" . $effect[0] . ": true";
		}else{
		    echo ",\n" . $effect[0] . ": false";
		}
	    }
	  
         }
        if(in_array('design_suite', $addons)){
        ?>
      
        <?php
        }
        ?>
        
        });
        <?php if($slider_settings['links'] == 'bullets' | $slider_settings['links'] == 'buttons'){
        ?>
        $('p.jshowoff-slidelinks a').text() = '';
        <?php } ?>
      
    });

    </script>
   
