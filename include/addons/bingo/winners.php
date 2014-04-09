<?php
include("../../../config/connect.php");
function ChangeDateFormat($date) {


    global $globalDateformat;
  
     if(preg_match("/-/", $date)){


	  $date_a  =  explode("-", $date);
	  
	
    
    }else{
    
	  $date_a  =  explode("/", $date);

    
    }
    
    	  
	  if($globalDateformat=='d/m/Y'){
	  
	      $day=$date_a[1];
	      $month=$date_a[0];
	      $year=$date_a[2];
	  }else{
	      $month=$date_a[0];
	      $day=$date_a[1];
	      $year=$date_a[2];
	  }
	
	  return $year.'-'.$month.'-'.$day;   
    
    
}
?>
			      <style>
			      .live-auction {
				background: url("css/snapbids/live-auction-body-bg.png") no-repeat scroll 0 0 / 1033px 155px rgba(0, 0, 0, 0);
				height: 160px;
				margin: 10px auto 6px;
				width: 1033px;
			      }
			        .circle {
			      background-size:20px 20px;
			      background-image: url(<?php echo $SITE_URL;?>/include/addons/bingo/images/circle.png);
			      background-repeat:no-repeat;
			      color:#fff!important;
			      }
			      .ball2 {
			      display:inline-block;
			      background-size:20px 20px;
			      background-image: url(<?php echo $SITE_URL;?>/include/addons/bingo/images/ball.png);
			      background-repeat:no-repeat;
			      color:#000!important;
			      font-weight:normal!important;
			      min-height:20px!important;
			      min-width:20px!important;
			      padding-top:5px;
			      margin:3px;
			      font-size:8px;
			      text-align:center;
			      }
			      .balls_holder_outer {
			      background-image: url(<?php echo $SITE_URL;?>/include/addons/bingo/images/machine2.gif);
			      background-repeat:no-repeat;
			      min-height:157px;
			      }
			      .balls_holder {
			      left: -70px;
			      max-width: 600px;
			      min-width: 600px;
			      position: relative;
			      word-wrap: break-word;
			      overflow-y:auto;
			      }
			      .winner {
			      background-image: url(<?php echo $SITE_URL;?>/include/addons/bingo/images/star.gif);
			      background-repeat:no-repeat;
			      min-height:157px;
			      }
			      .circle span {
			      color:#fff!important;
			      }
			      #user_list {
			      display:none;
			      }
			      #chat {
			
				background-color: #1F497D !important;
				border-radius: 0 0 8px 8px;
				color: #000000 !important;
				display: block;
				font-size: 22px;
				min-height: 35px;
				min-width: 260px;
				position: relative;
				top: -22px;
				z-index: 2147483647;
				max-width: 350px;

			      }
			      #chat p {
			      text-align:center;
			      color:#fff;
			      padding-top:5px;
			      }
			      #datefrom, #dateto {
			      width:80px;
			      }
			      .row label {
			      float:left;font-weight:bold;font-size:16px;padding-right:50px;width:150px;color:#000;
			      
			      }
			      #preview_winners {
			      background-color: #FFFFFF;
			      border-radius: 0 0 6px 6px;
			      box-shadow: 6px 6px 6px #666666;
			      display: none;
			      max-height: 200px;
			      position: absolute;
			      width: 235px;
			      z-index: 2147483647;
			      margin-top: 10px;
			      }
			      #pagination-container {
				clear: both;
				float: left;
				margin: 20px 0 !important;
				padding-right: 10px;
				padding-top: 10px;
				position: relative;
				top: -20px;
			      }
			      </style>
			       <form action="javascript:search_winners();" id="search_winner_form">
				<ul style="background-color: #CACACA;
border-radius: 8px;
height: 35px;
padding: 15px 30px 10px 25px;
width: 1050px;">
				  <li style="display:inline-block;width:250px;">
				    <p style="float:left;font-weight:bold;font-size:16px;padding-right:30px;width:80px;color:#000;position:relative;top:-10px;">Place</p>
				      <select id="place" name="place">
					  <option></option>
					  <option value="first">First</option>
					  <option value="second">Second</option>
					  <option value="third">Third</option>
				      </select>
				  </li>
				  <li class="clear" style="display:inline-block;"></li>
				  <li style="display:inline-block;width:400px;">
				    <p style="font-size: 16px;
font-weight: bold;
padding-right: 50px;
width: 80px;
margin-top: 0px;
color: #000;
float: left;">Username<span id="preview_winners"></span></p>
				    <input type="text" id="winners" name="username" style="display:inline;width:100px;" autocomplete="off" />
				  </li>
				
				  <li style="display: inline-block;
float: right;
position: relative;
top: -47px;
width: 550px;
left: 20px;">
				  <?php include($BASE_DIR . "/backendadmin/datepickers.php"); ?>
				  
				   <input type="submit" value="Find" style="float:right;position:relative;top:-28px;" />
				  </li>
				
				</ul>
			    </form>
			    <div class="clear"></div>
			    <?php
			    if(empty($_REQUEST['offset'])){
			      $offset = 0;
			    }else{
			      $offset = $_REQUEST['offset'];
			    
			    }
		    $items_per_page = 10;
		    $max = 20;
		    if(empty($_REQUEST['offset'])  | $_REQUEST['offset'] == 1){
		    $from = 0;
		    $offset = 1;
		    }else{
		    $from = ($_REQUEST['offset'] - 1)* $items_per_page;
		    $offset = $_GET['offset'];
			$offset = $offset > 0 ? $offset : 1;
		    }
		    $extra = '';
		    if(!empty($_REQUEST['place'])){
		    $extra .= " and bingo_winners.place = '$_REQUEST[place]'";
		    }
		   
		    if(!empty($_REQUEST['username'])){
		    $extra .= " and bingo_winners.winner = '$_REQUEST[username]'";
		    }
		    
		   
			  $startdate = ChangeDateFormat($_REQUEST["datefrom"]);
			  $enddate = ChangeDateFormat($_REQUEST["dateto"]);
			 
		  
			 
		    
		    if(!empty($_REQUEST['datefrom']) | !empty($_REQUEST['dateto'])){
		     $extra .=  "and DATE(bg.date) BETWEEN ";
		    }
		    
		    if(!empty($_REQUEST['datefrom'])){
		    $extra .= " '$startdate' ";
		    }else{
		    
		    $extra .= " '" . date("Y-m-d") . "' ";
		    }
		    
		    if(!empty($_REQUEST['dateto'])){
 		    $extra .= " and '$enddate'";
		    }else{
		    
		    $extra .= " '" . date("Y-m-d") . "' ";
		    }
		//    echo "select * from bingo_winners left join bingo_games bg on bg.id=bingo_winners.instance left join bingo_jackpots bj on bj.bingo_id=bingo_winners.instance and bj.place=bingo_winners.place where bingo_winners.id != '' $extra";
		   $totalauc = db_num_rows(db_query("select * from bingo_winners left join bingo_games bg on bg.id=bingo_winners.instance left join bingo_jackpots bj on bj.bingo_id=bingo_winners.instance and bj.place=bingo_winners.place where bingo_winners.id != '' $extra"));
		  
			    $bingo_sql = db_query("select * from bingo_winners left join bingo_games bg on bg.id=bingo_winners.instance left join bingo_jackpots bj on bj.bingo_id=bingo_winners.instance and bj.place=bingo_winners.place where bingo_winners.id != '' $extra order by bingo_winners.instance desc limit $from, 10");
			 
			    while($row_bingo = db_fetch_array($bingo_sql)){
				
				
			    ?>
			   
			    <ul>			    
				<li  class="live-auction" style="vertical-align:top;">
				    <?php 			     
			      $user = db_fetch_array(db_query("select registration.id, a.avatar from registration left join avatar a on a.id=registration.avatarid where username = '$row_bingo[winner]'"));
			      if(empty($user['avatar'])){
			        $user['avatar'] = 'default.png';
			      
			      }
			      $letters = array("B", "I", "N", "G", "O");
			      $card = '<ul style="float:left;">';
				$card .= '<li id="card_' .$row['card'] . '" style="float:left;background-color:#cacaca;color:#fff!important;font-size:16px;max-width:125px!important;height:145px;border-radius:6px;margin: 5px 17px 5px 18px;">';
					  
					  $card .= '<ul style="list-style:none;color:#fff!important;font-weight:bold;padding:5px 0 5px 0;">
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">B</li>
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">I</li>
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">N</li>
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">G</li>
						      <li style="display:inline;width:60px;padding: 0 5px 0 5px;">O</li>
						   </ul>';
					  
					  $card .= '<ol class="card_data" style="width:220px;margin-left:8px;background-color:#fff;">';
					  $p = 1;
						 foreach($letters as $letter){				
						$card .= '<li class="' . $letter. '" style="float:left;">
							    <dl style="background-color: #FFFFFF !important;word-wrap:break-word;border-left: 1px solid #cacaca;border-right: 1px solid #cacaca;font-size:10px;">'; 
			      
							  
			      
							      $sql_card = db_query("select * from bingo_user_data where card = '$row_bingo[user_data_id]' and userid='$user[id]' and instance='$row_bingo[instance]' and number like '$letter-%' limit 0,5" );
								  while($row_card = db_fetch_array($sql_card)){
				        
					 
					  
								    $card .= '<dd style="';
								    
								    
								    if($row_card['marked'] == 1){
								    
								    $card .= '';
								    
								    $card .= 'text-align:center;vertical-align:center;min-width:19px!important;min-height:20px;border-right:1px solid #000;border-bottom:1px solid #000;color:#fff;" class="circle ' . $row_card['number'] . '"><span style="position:relative;top:5px;color:#fff;">';
								    
									if($p != 13){
									    $card .= str_replace("$letter-", "", $row_card['number']);
									}else{
									    
									
									}
								    $card .= ' </span></dd>';
								    
								    }else{
								    
								    $card .= 'text-align:center;vertical-align:center;min-width:19px!important;min-height:20px;border-right:1px solid #000;border-bottom:1px solid #000;" class="' . $row_card['number'] . '"><span style="position:relative;top:5px;color:#000;">' .str_replace("$letter-", "", $row_card['number']) . '</span></dd>';
								    
								    }
							  $p++;
							}  
				
						      $card .= '</dl>';
						$card .= '</li>';
				   
				   
				   }
					
				   
				   
				   
					
					  $card .= '</ol>';
		          	  $card .= '</li>';
				
				$card .= '</ul>';
					  echo $card;				    
				
				
				//print_r($row_bingo); ?>
				      <ul style="float:right;width:850px;vertical-align:top;">
				      
					
					<li>
					<ul>
					<li style="display:inline-block;">
					  <h2 style="width:250px;"><img src="uploads/avatars/<?php echo $user['avatar'];?>" style="float:left;width:30px;height:30px;margin-right:5px;" /><?php echo $row_bingo['winner']; ?></h2>
					  <h3 style="width:200px;"><?php echo ucfirst($row_bingo['place']); ?> Place</h3>
					</li>
					<li style="display:inline-block;text-align:center;">
					    <h3 style="width:300px;position:relative;"><?php echo date("l F d Y", strtotime($row_bingo['date'])); ?></h3>
					    <h3 style="width:300px;"><?php echo $row_bingo['name']; ?> - <?php echo $row_bingo['instance']; ?></h3>
					</li>
					<li style="display:inline-block;text-align:right;">
					<?php
					if(!empty($row_bingo['productID'])){
					?>
					    <h3 style="width:250px;position:relative;top:-35px;font-size:26px;"></h3>
					<?php 
					}
					if(!empty($row_bingo['which_to_give'])){
					
					 $sql_u = db_query("select distinct(userid) from bingo_user_data where instance = $row_bingo[instance]");
							$total_cards = 0;
							
					while($row_u =db_fetch_array($sql_u)){
						
							    $count_cards = db_fetch_array(db_query("select count(distinct(card)) from bingo_user_data where instance = $row_bingo[instance] and userid=$row_u[userid]"));
							   
							    $total_cards = number_format($total_cards, 0, '', '') + number_format($count_cards[0], 0 , '', '');
							}
					$divisor_h = db_num_rows(db_query("select distinct(winner) from bingo_winners where instance = $row_bingo[instance] and place = '$row_bingo[place]'"));
					?>
					    <h3 style="width:250px;position:relative;top:-35px;font-size:26px;"> <?php echo round((($total_cards * $row_bingo['cost_per_card']) * $row_bingo['reward_points'] / 100) / $divisor_h); ?> <?php echo ucwords(str_replace("_", " ", $row_bingo['which_to_give'])); ?> </h3>
					<?php
					}
					?>
					</li>
					
					</ul>
					</li>
					<li>
					      <ol>
						  <?php
						  $sql_balls = db_query("select * from bingo_numbers where instance = '$row_bingo[instance]'");
						  while($row_balls = db_fetch_array($sql_balls)){
						  ?><li class="ball2" style="display:inline-block;"><?php echo $row_balls['number']; ?></li><?php
						  }
						  ?>
						  
					      
					      </ol>
					</li>
				      </ul>
				</li>
			    </ul>
			    
			    <?php
			    }
			  echo db_error();
		      $total_pages = ceil($totalauc / $items_per_page); // Figure out the total number of pages. Always round up using ceil()

                      db_free_result($ressel1);
                    $get_param = $searchdata != "" ? "st=" . htmlspecialchars(stripcslashes($searchdata), ENT_QUOTES) : ($aid == 2 ? "aid=2" : "id=$id");
        ?>
        </div>
				      <div id="pagination-container" style="width: 500px; left: 500px;">
				  <?php
					     // Figure out the total number of pages.
					  
										    
					    if ($offset > 1) {
						    $npage = $offset - 1;
					    ?>
						  
						    <span class="blue_link"><a class="darkblue-12-link pagination_entry" title="include/addons/bingo/winners.php?offset=<?php echo  $npage; ?>&<?php echo  $get_param; ?>" style="text-decoration: none;">&lt;</a></span>
					    <?php
						} else {
					    ?>
						   
					    <?php } ?>
						<span>
						<?php
						$start = 1;
						$total_pages = 20;
						for ($i = $start; $i <= $total_pages; $i++) {
						
						    if ($i == $offset) {
						?>
							<span><p class="darkblue-12-link pagination_entry" style="<?php if($offset == $i){?>background-color:#fff!important;color:#000!important;<?php } ?>"><?php echo  $i ?></p></span>
						<?php } else {
						?>
							<span><a class="darkblue-12-link  pagination_entry " title="include/addons/bingo/winners.php?offset=<?php echo  $i; ?>&<?php echo  $get_param; ?>" style="text-decoration: none;<?php if($offset == $i){?>background-color:#fff!important;color:#000!important;<?php } ?>"><?php echo  $i; ?></a></span>
						<?php
						    }
						    
						  
						}
						
						if ($offset < $total_pages) {
						    $npage = $offset + 1;
						?>
						    <span> <a class="darkblue-12-link pagination_entry" title="include/addons/bingo/winners.php?offset=<?php echo  $npage; ?>&<?php echo  $get_param; ?>" style="text-decoration: none;">&gt;</a></span>
						 
						<?php } else {
						?>
								    
						<?php }  
			    
			    
			    echo db_error();
			    
			    ?>
			     <script>
			     $('#winners').bind('keyup', function(event){
				event.preventDefault();
				search_users();
				});
			      $('#winners').bind('focus', function(event){
				event.preventDefault();
				});
				$('#winners').bind('click', function(event){
				event.preventDefault();
				});
			     function search_users(){
			     $('#preview_winners').css('display', 'none');
			     
				$.ajax({
				      url: '<?php echo $SITE_URL; ?>include/addons/bingo/winner_list.php',
				      type: 'get',
				      dataType: 'html',
				      data: { username: $('#winners').val() },
				      success: function(response){
				      
				      $('#preview_winners').html(response);
				      $('#preview_winners').css('display', 'block');
				      
					
				    
				      }
				})
			     
			     
			     }
			     
			     function search_winners(){
			      
				  data = $('#search_winner_form').serialize();
				  $.ajax({
				      url: '<?php echo $SITE_URL; ?>include/addons/bingo/winners.php',
				      type: 'get',
				      dataType: 'html',
				      data: data,
				      success: function(response){
				      
				      $('#live_ajax_auctions').html(response);
				     
				      
					
				    
				      }
				})
			     
			     
			     }
        $('a.pagination_entry').click(function(e){
	  $('a.pagination_entry').removeClass('active');
	    $(this).addClass('active');
	
	    e.preventDefault();
		 $.ajax({
				      url: $(this).attr('title'),
				      dataType: 'html',
				      success: function(response){
				      
				   
				      
					  $('#live_ajax_auctions').html(response);
					  remove_timer_break();
					 
					  
					 
				      }
			      });
	    
	 });
	 </script>