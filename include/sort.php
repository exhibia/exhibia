<div id="display-sort">
				<ul>
				    <li class="display">
					<h4 class="light-grey"><p id="group-by-button" class="">Display By: <span id='group-by-title'>Auctions</span> <img src="http://s1.quibidscdn.com//site/images/home/filter-arrow.png" class="filter-arrow-dropdown"/></p></h4>
				    </li>
				    
				    <li class="spacer"><h4><span class="light light-grey">|</span></h4></li>

				
				    <li class="sort">
				      <h4 class="light-grey">
					<p id="sort-button" class="">Sort By: <span id='sort-title'>
					<?php
					switch($_REQUEST['sort']){
					  case('high'):
					  echo HIGHEST_VALUE;
					  break;
					  case('low'):
					  echo LOWEST_PRICE;
					  break;
					  case('date'):
					  echo ENDING_SOON;
					  break;
					  case('popular'):
					  echo MOST_POPULAR;
					  break;
					  default;
					  echo ENDING_SOON;
					  
					  }
					  ?>
					
					</span> <img src="http://s1.quibidscdn.com//site/images/home/filter-arrow.png" class="filter-arrow-dropdown"/></p>
				      </h4>
				    </li>
				
				</ul>
				<div id="group-by-panel">
					<ul>
						<li><h4 class="light-grey">Display By </h4></li>
						<li><label><input <?php if(empty($_REQUEST['group-by']) | $_REQUEST['group-by'] == 'a'){ ?>checked<?php } ?> value='a' type='radio' id="groupby-a" name='groupy-by' title='Auctions'><?php echo AUCTIONS;?></label></li>
						<li><label><input <?php if(!empty($_REQUEST['group-by']) & $_REQUEST['group-by'] != 'a'){ ?>checked<?php } ?>  value='p' type='radio' name='groupy-by' id="groupby-b" title='Products'><?php echo PRODUCTS;?></label></li>					
					</ul>
				</div>	
				<div id="sort-panel">

					<ul>
						<li><h4 class="light-grey">Sort By</h4></li>
						<li><label><input <?php if($_REQUEST['sort'] == 'date'){ ?> checked <?php } ?>   value='date' type='radio' name='sort' title='Ending Soon' id="sort-e" class="sort-radio"><?php echo ENDING_SOON;?></label></li>
						<li><label><input <?php if($_REQUEST['sort'] == 'high'){ ?> checked <?php } ?> value='high' type='radio' name='sort' title='Highest Value' id="sort-h" class="sort-radio"><?php echo HIGHEST_VALUE;?></label></li>
						<li><label><input <?php if($_REQUEST['sort'] == 'low'){ ?> checked <?php } ?> value='low' type='radio' name='sort' title='Lowest Value' id="sort-l" class="sort-radio"><?php echo LOWEST_PRICE;?></label></li><li><label><input <?php if($_REQUEST['sort'] == 'popular'){ ?> checked <?php } ?> value='popular' type='radio' name='sort' title='Most Popular' id="sort-p" class="sort-radio"><?php echo MOST_POPULAR;?></label></li>			
					</ul>
				</div>	
			</div>
			
				<!--	<div class="auction-type">

			
						<ul class="types"></ul>

		
						<div id="options">
						<div style="float:left">

                  				
								<a href="#" id="filtersbutton" class="buttons small white filter">Filter By  <img src="http://s1.quibidscdn.com//site/images/layout/down-arrow.gif" class="filters-icon"/></a>
								<div id="filter-panel">
									<div class="left-column">
										<h5 class="bold">Price:</h5>

										<ul>
												
										<li><label><input value="value_0-50" data-label='$0-50' name="$0-50" type='checkbox'/>$0-50</label></li><li><label><input value="value_50-100" data-label='$50-100' name="$50-100" type='checkbox'/>$50-100</label></li><li><label><input value="value_100-300" data-label='$100-300' name="$100-300" type='checkbox'/>$100-300</label></li><li><label><input value="value_300-500" data-label='$300-500' name="$300-500" type='checkbox'/>$300-500</label></li><li><label><input value="value_500+" data-label='$500+' name="$500+" type='checkbox'/>$500+</label></li>										</ul>
									</div>
									
									<div class="right-column">
										<h5 class="bold">Feature:</h5>

										<ul>
										<li><label><input value="feature_bidomatic" data-label='Bid-O-Matic' name="Bid-O-Matic" type='checkbox'/>Bid-O-Matic</label></li><li><label><input value="feature_nobidomatic" data-label='No Bid-O-Matic' name="No Bid-O-Matic" type='checkbox'/>No Bid-O-Matic</label></li><li><label><input value="feature_gameplays" data-label='Gameplay' name="Gameplay" type='checkbox'/>Gameplay</label></li><li><label><input value="feature_speed" data-label='Speed Auctions' name="Speed Auctions" type='checkbox'/>Speed Auctions</label></li>										</ul>
									</div>
									<div style='clear:both;'></div>
									<div><a style='display:none' id='filter-panel-apply' class='buttons blue small right'>Apply</a></div>
								</div>

								<a href="#" id="sortbutton" class="buttons small white filter">Sort By <img src="http://s1.quibidscdn.com//site/images/layout/down-arrow.gif" class="filters-icon"/></a>
								<div id="sort-panel">
									<ul>
									<li><label><input checked='checked'  value='sortby_endingsoon' type='radio' name='sort'>Ending Soon</label></li><li><label><input value='sortby_valuehigh' type='radio' name='sort'>Highest Value</label></li><li><label><input value='sortby_valuelow' type='radio' name='sort'>Lowest Value</label></li><li><label><input value='sortby_popular' type='radio' name='sort'>Most Popular</label></li>									</ul>
								</div>
							</div>  
							
							<ul id='filter-breadcrumb'>
							
							
							
							
							
							</ul>

							<div class="pagination" style="display:none"></div>
						</div><!--options-->


				<!--		<div id="no_results">
							<h4>No Results</h4>

							<a href="/en/">Show All Live Auctions?</a>
						</div>
					</div>
				-->
				<script>
				
				function get_conditionals(){
				
				var str = '';
				
				    if($('#groupby-a').attr('checked')){
				    
				      str +=  '&group-by=a';
				    
				    }
				    if($('#groupby-b').attr('checked')){
				    
				      str +=  '&group-by=p';
				    
				    }				
				    $('.sort-radio').each( function(ui, event){
				    if(this.checked == true){
				    str += '&sort=' + (this.checked ? $(this).val() : "");
				    }
				    
				    });
				    return str;
				}
				
				
				$('#group-by-button').click(function(){
				
				    $("#group-by-panel").show();
				
				});
				
				
				$('#groupby-a').click(function(event){
				
				window.location.href='<?php echo $SITE_URL;?>/<?php echo basename($_SERVER['PHP_SELF']);?>?' + get_conditionals();
				
				}
				);
				
				$('#groupby-b').click(function(event){
				
				window.location.href='<?php echo $SITE_URL;?>/<?php echo basename($_SERVER['PHP_SELF']);?>?' + get_conditionals();
				
				
				}
				);
				$("#group-by-panel").bind('unfocus', 
				function(){ $("#group-by-panel").hide(); }
				);
				
				
				$('.sort-radio').click(function(event){
				
				window.location.href='<?php echo $SITE_URL;?>/<?php echo basename($_SERVER['PHP_SELF']);?>?' + get_conditionals();
				
				});
				
				
				$('#sort-button').click(function(){
				
				$("#sort-panel").show();
				
				});
				
				$("#sort-panel").bind('unfocus', 
				function(){ $("#sort-panel").hide(); }
				);
				</script>
<h2 class="featured bold">

<?php
if(empty($_REQUEST['aid'])){
$_REQUEST['aid'] = '2';
}
switch($_REQUEST['aid']){

case '1':
echo FUTURE;
break;
case '2':
echo LIVE;
break;
case '3':
echo ENDED;
break;

}
?>
&nbsp;<?php echo AUCTIONS;?>
</h2>