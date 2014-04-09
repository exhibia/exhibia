
<div id="newsBox" class="box">
	<h3><?php echo LATEST_NEWS; ?></h3>
        <script type="text/javascript">
            $(document).ready(function(){
              $(".newsEntry").click(function(){
                  //alert('a');
                    $(".entry").each(function(){
                        $(this).removeClass('show');
                        $(this).addClass('hide');
                    });
                  var entry=$(this).attr('rel');
                  $("#"+entry).removeClass('hide');
                  return false;
              });
            });
        </script>
    <?php 
	$rsnews = db_query("select id, news_title, news_date, news_short_content from news order by news_date desc");
	$totalnews = db_num_rows($rsnews);
	?>
    
	<div class="box-content">
    	<?php
		if ( $totalnews > 0 ) {
		$i = 1;
		
		while ( ( $objnews = db_fetch_array($rsnews) ) ) {
		?>
        <div id="<?='newsentry'.$i; ?>" class="entry <?=$i==1?'show':'hide'?>">
            <p><strong><a href="news.php?nid=<?=$objnews["id"];?>" class="newstitle"><?=choose_short_desc(stripslashes($objnews["news_title"]),15);?>	</a></strong></p>
            <p><?=choose_short_desc(stripslashes($objnews["news_short_content"]),120);?></p>
            <p><a href="news.php?nid=<?=$objnews["id"];?>" class="more"><?php echo READ_MORE; ?></a></p>
        </div><!-- /entry -->
        
		<?php $i++;
			} //end while
		} 
		db_free_result($rsnews);//end if
		?>
        
        <ul>
        	<?php for($index=1;$index<=$totalnews;$index++){ ?>
            <li><a href="" class="newsEntry" rel="<?='newsentry'.$index; ?>"><?=$index; ?></a></li>
            <?php } ?>
            <li><a href="allnews.php">...</a></li>
        </ul>
		
    </div><!-- /box-content -->
   
</div><!-- /newsBox --> 
