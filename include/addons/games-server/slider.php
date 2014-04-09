<?php
if(empty($_REQUEST['output'])){

?>
   <script src="<?php echo $games_server;?>js/jquery.jshowoff.min.js" type="text/javascript"></script>     

<!-- PROM BANNERS -->
    
            <div id="slider_box" class="jshowoff" >
        
         
            
            
            <?php
                $slider_qry = db_query($slider_sql);
                while($row_banner = db_fetch_array($slider_qry)){
               
                    echo '<div class="images" onclick="javascript: window.location.href = \'games.php?gcat=' . $row_banner[0] . '\';"><img src="' . $SITE_URL . 'uploads/games/banner/' . $row_banner['picture1'] . '" /></div>';
                    
                }
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
       $('.jshowoff').jshowoff({
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
   <?php 
   }else{
   require("../../../config/config.inc.php");
    $images = array();
    if(!empty($_REQUEST['gcat']) & empty($_REQUEST['list'])){
	  $slider_sql = "select * from games where categoryID = $_REQUEST[gcat]";
	  }else{
	      if(!empty($_REQUEST['list'])){
	      
		  $slider_sql = "select * from games order by name asc";
	      }else if(empty($_REQUEST['game'])){
		$slider_sql = "select * from game_categories";
	      }else{
		  $slider_sql = "select * from games where pointer = '$_REQUEST[game]'";
	      }
    }
  
    $slider_qry = db_query($slider_sql);
                while($row_banner = db_fetch_array($slider_qry)){
		      if(!empty($_REQUEST['gcat']) & empty($_REQUEST['list'])){
			  if(!empty($row_banner['picture1'])){
			    $images[$row_banner['gameID']]['img'] = $row_banner['picture1'];
			    $images[$row_banner['gameID']]['icon'] = $row_banner['picture2'];
			    $images[$row_banner['gameID']]['link'] = $row_banner['pointer'];
			    $images[$row_banner['gameID']]['categoryID'] = $row_banner['categoryID'];
			    $images[$row_banner['gameID']]['text'] = $row_banner['name'];
			    
			  } 
		     }else{
			      if(empty($_REQUEST['game']) & empty($_REQUEST['list'])){
				      if(!empty($row_banner['picture1'])){
					  $images[$row_banner['categoryID']]['img'] = $row_banner['picture1'];
					  $images[$row_banner['categoryID']]['icon'] = $row_banner['picture2'];
					  $images[$row_banner['categoryID']]['link'] = $row_banner['categoryID'];
					  $images[$row_banner['categoryID']]['text'] = $row_banner['name'];
					  $images[$row_banner['categoryID']]['categoryID'] = $row_banner['categoryID'];		     
				  
				      }
				
			      }else{
				if(!empty($_REQUEST['list'])){
				    $images[$row_banner['gameID']]['link'] = $row_banner['pointer'];
				    $images[$row_banner['gameID']]['text']= $row_banner['name'];
				
				}else{
				    $images[0]['img'] = $row_banner['picture1'];
				    $images[0]['icon'] = $row_banner['picture2'];
				    $images[0]['link'] = $row_banner['categoryID'];
				    $images[0]['text'] = $row_banner['name'];
				    $images[0]['url'] = $row_banner['url'];
				    $images[0]['categoryID'] = $row_banner['categoryID'];		      
			      
				  $settings_sql = db_query("select * from sitesetting where name like '$_REQUEST[game]:%'");
				  while($settings_row = db_fetch_array($settings_sql)){
				  $setting  = explode(":", $settings_row['name']);
				      $images[0][$setting[1]] = $settings_row['value'];
				  
				  
				  }
				  
				}
			      }
		     }
                }
              
                echo json_encode($images);
    }
