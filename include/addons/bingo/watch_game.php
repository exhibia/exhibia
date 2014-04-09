<style>
			 
			    
</style>
<ul id="game_area_<?php echo $_GET['userid']; ?>" style="border-left:2px solid #cacaca;border-right:2px solid #cacaca;border-bottom:2px solid #cacaca;border-radius:0 0 8px 8px;height:auto;   min-height: 150px;   max-height: 300px;overflow:auto;">
<?php
include("../../../config/config.inc.php");
$uid = $_REQUEST['userid'];

 		    $sql = db_query("select distinct(card) from bingo_user_data where instance = '$_REQUEST[game]' and userid = '$uid'" );
 while($row = db_fetch_array($sql)){
			      $letters = array("B", "I", "N", "G", "O");
			      $card = '';
				$card .= '<li id="card_' .$row['card'] . '" style="float:left;background-color:#CACACA;color:#fff!important;font-size:21px;max-width:160px!important;height:142px;border-radius:6px;margin: 3px 8px 3px 9px;" class="bingo_card user_' . $_REQUEST['userid'] . '">';
					  
					  $card .= '<ul style="list-style:none;color:#fff!important;font-weight:bold;padding:3px 0 2px 0;text-align:center;" id="place_text_' . $uid . '_' . $row['card'] . '">
						      <li style="display:inline;width:30px;padding: 0 3px 0 2px;">B</li>
						      <li style="display:inline;width:30px;padding: 0 3px 0 2px;">I</li>
						      <li style="display:inline;width:30px;padding: 0 3px 0 2px;">N</li>
						      <li style="display:inline;width:30px;padding: 0 3px 0 2px;">G</li>
						      <li style="display:inline;width:30px;padding: 0 3px 0 2px;">O</li>
						   </ul>';
					  
					  $card .= '<ol class="card_data" style="width:110px;text-align:center;margin:0 4px 0 4px;">';
					  $p = 1;
				   foreach($letters as $letter){				
						$card .= '<li class="' . $letter. '" style="float:left;">
							    <dl style="background-color: #FFFFFF !important;word-wrap:break-word;border-left: 1px solid #CACACA;border-right: 1px solid #CACACA;font-size:9px;">'; 
			      
			   
			      
							      $sql_card = db_query("select * from bingo_user_data where instance = '$_REQUEST[game]' and userid = '$uid' and card = '$row[card]' and number like '$letter-%'" );
								  while($row_card = db_fetch_array($sql_card)){
				         
					 
					  
								    $card .= '<dd style="';
								    
								    
								    if($row_card['marked'] == 1){
								    
								    $card .= '';
								    
								    $card .= 'text-align:center;vertical-align:center;min-width:19px!important;min-height:20px;border-right:1px solid #000;border-bottom:1px solid #000;color:#fff;" class="circle ' . $row_card['number'] . ' user_' . $_REQUEST['userid'] . '"><span style="position:relative;top:5px;color:#fff;">';
								    
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
				
					  
					  echo $card;				    
				}
				?>
				</ul>