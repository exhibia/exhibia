<?php
if(!empty($_REQUEST['ajax'])){

db_query("update testimonials set status = '$_REQUEST[status]' where id = '$_REQUEST[id]'");
db_query("update testimonials set text = '" . addslashes(urldecode($_REQUEST['testimonial'])) . "' where id = '$_REQUEST[id]'");
echo db_error();

}else{
    $query="select testimonials.id, status, text, user_id, picture, date, avatar, avatarid, username from testimonials left join registration as r on testimonials.user_id=r.id left join avatar as a on r.avatarid=a.id";
    
      if(!empty($_REQUEST['status'])){
      
      $query .= " and status = $_REQUEST[status]";
      
      }

      if(!empty($_REQUEST['date_from'])){
      
      $query .= " and date >= '$_REQUEST[date_from]'";
      
      }

      if(!empty($_REQUEST['date_to'])){
      
      $query .= " and date <= '$_REQUEST[date_to]'";
      
      }
    

$result=db_query($query);
    $totalrows=db_num_rows($result);
    echo db_error();
    $totalpages=ceil($totalrows/$PRODUCTSPERPAGE);

    $total = db_num_rows($result);

    $query .= " order by testimonials.id";
    $query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";

    $result =db_query($query);

  

    $result=db_query($query);
    $totalcat = db_num_rows($result);

    $totalrows=db_num_rows($result);
    $totalpages=ceil($totalrows/$PRODUCTSPERPAGE);
    //$query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
    $result =db_query($query);
echo db_error();

?>
<script>
	function change_test_status(select_id, index){
	
	var editor = document.getElementById('testimonials_' + index);
	
	    $.get('<?php echo $SITE_URL;?>backendadmin/getplugin.php?plugin=testimonials&id='+ index +'&ajax=go&status=' + document.getElementById(select_id).options[document.getElementById(select_id).selectedIndex].value + '&testimonial=' + encodeURIComponent(document.getElementById('testimonials_' + index).innerHTML), function(response){
	    
		  document.getElementById(select_id).options[document.getElementById(select_id).selectedIndex].value = response;
		  alert('Testimonial Status Has Been Changed');
	    
	    });
	
	
	
	}
	
	function show_more(div_id){
	
	    if(document.getElementById(div_id).style.display == 'block'){
		document.getElementById(div_id).style.display = 'none';
	    
	    }else{
	    
		document.getElementById(div_id).style.display = 'block';
	    
	    }
	
	
	}
	</script>
				  <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">
                                                  
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                <?php //if(($totalcat<=0 && !$total) or ($total<=0 && !totalcat)) { ?>
                                                                <!--<ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No product To Display</strong></li>
                                                                </ul>-->
                                                                    <?php //}else {?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                       
                                                                   

                                                                            <?php
                                                                            if($total>0) {
                                                                                ?>
                                                                        <tr class="th-a">
                                                                            <th style="width:6%;text-align:center;">No</th>
                                                                            <th style="width:19%;text-align:center;" class="photo">Image</th>
                                                                            <th style="width:11%;">Username</th>
                                                                            <th style="width:22%">Testimonial</th>
                                                                            <th style="width:15%">Date</th>
                                                                            <!--<TD  width="10%">InStock</TD>-->
                                                                            <th style="width:11%">Status</th>
                                                                            
                                                                        </tr>
                                                                                <?php
                                                                                
                                                                                $i = 0;
                                                                                
                                                                                while($row = db_fetch_array($result)){
                                                                                $i++;
                                                                         
                                                                                
                                                                                                         if($row['picture'] == ''){
													    $row['picture'] = $UploadImagePath . "avatars/$row[avatar]";
													
													}else{
													
													    $row['picture'] = $UploadImagePath . "testimonials/$row[picture]";
													
													}
                                                                              ?>
                                                                         <tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>" valign="center" style="">
                                                                          
									      <td>
									      
									      <?php echo $i; ?>
									      
									      </td>
                                                                                
                                                                               
 									      <td>
									     <img src="<?php echo $row['picture']; ?>" class="thumb" style="width:85px; height:auto;" />
									      
									      </td>
									      
 									      <td>
									       <?php echo $row['username'];?>
									      
									      </td>                                                                               
									      <td>
									      <div contenteditable="true" id="testimonials_<?php echo $row['id'];?>">
									       <?php echo $row['text'];?>
									      </div>
									     
									      </td>                                                                                
                                                                                
  									      <td>
									      
									       <?php echo $row['date'];?>
									      </td>                                                                              
                                                                                
									   
									      <td>
									      <?php switch($row['status']){
								      
									    case('0'):
									    $status = 'Waiting Approval';
									    break;
									    case('1'):
									    $status = 'Approve';
									    break;
									    case('2'):
									    $status = 'Disapprove';
									    break;
									    
									    }
									    
									    ?>
									    
									  <select name="status[<?php echo $row['id'];?>]" id="status[<?php echo $row['id'];?>]" onchange="javascript: change_test_status('status[<?php echo $row['id'];?>]', '<?php echo $row['id'];?>');">
									  
									      <option value="<?php echo $row['status']; ?>"><?php echo $status; ?></option>
									      
									      <option value="0">Waiting Approval</option>
									      <option value="1">Approve</option>
									      <option value="2">Disapprove</option>
									  </select>
									  
									  
									      
									      </td>
									   </tr>   
									      
									      <?php	      
                                                                                }
                                                                            }
                                                                            ?>

                                                                         
                                                                       
                                                                      
                                                                    </tbody>
                                                                </table>
                                                                    <?php // }?>
                                                            </div>
                                                            
                                                            
                                                            
                                                      
                                           
                                             
                                                      
                                                      
                                                <?php if($total) { ?>
                                                    <!--[if !IE]>start pagination<![endif]-->
                                                    <div class="pagination">
                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpages; ?></span>
                                                        <ul class="pag_list">
                                                                <?php
                                                                if($PageNo>1) {
                                                                    $PrevPageNo = $PageNo-1;
                                                                    ?>
                                                            <li><a href="getplugin.php?plugin=testimonials&order=<?php echo $iid ?>&pgno=<?php echo $PrevPageNo; ?>&catID=<?echo $cID; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                                    <?php } ?>

                                                                <?php
                                                                $pageFrom=$PageNo-3<1?1:$PageNo-3;
                                                                $pageTo=$PageNo+3>$totalpages?$totalpages:$PageNo+3;
                                                                for($i=$pageFrom;$i<=$pageTo;$i++) {
                                                                    ?>
                                                                    <?php if($i==$PageNo) { ?>
                                                            <li><a href="getplugin.php?plugin=testimonials&order=<?php echo $iid ?>&pgno=<?php echo $i;?>&catID=<?php echo $cID; ?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                                        <?php }else {?>
                                                            <li><a href="getplugin.php?plugin=testimonials&order=<?php echo $iid ?>&pgno=<?php echo $i;?>&catID=<?php echo $cID; ?>"><?php echo $i; ?></a></li>
                                                                        <?php }
                                                                }
                                                                ?>
                                                                <?php
                                                                if($PageNo<$totalpages) {
                                                                    $NextPageNo = 	$PageNo + 1;
                                                                    ?>
                                                            <li><a href="getplugin.php?plugin=testimonials&order=<?php echo $iid ?>&pgno=<?php echo $NextPageNo;?>&catID=<?php echo $cID; ?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                                    <?php } ?>
                                                        </ul>

                                                                     </div>
                                                                     
                                                                     <?php } ?>
           
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
         <?php } ?>              