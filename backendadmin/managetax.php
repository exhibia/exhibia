<?php

session_start();
$active="Payment";
include("connect.php");
include_once("admin.config.inc.php");
include("security.php");
include("config_setting.php");	
 
@db_query("CREATE TABLE `taxclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `percent` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
"); 
@db_query("alter table taxclass add column `percent2` varchar(5) NOT NULL");
 @db_query("alter table taxclass add column enable tinyint(1);");
@db_query("alter table taxclass add column f_tax  varchar(5) not null default'0'");
if(!empty($_POST['edit'])){



    foreach($_POST['id'] as $key => $value){
   
      $country = $_POST['country'][$key];
      $state = $_POST['state'][$key];
      $percent = $_POST['tax'][$key];
      $percent2 = $_POST['tax2'][$key];
      $enable = $_POST['enable'][$key];
      $f_tax = $_POST['f_tax'][$key];
      
	  if(db_num_rows(db_query("select * from taxclass where id = $key")) >= 1){
	  
	      db_query("update taxclass set f_tax = '$f_tax' where id = '$key' limit 1");
	      db_query("update taxclass set percent = '$percent' where id = '$key' limit 1");
	      db_query("update taxclass set percent = '$percent' where id = '$key' limit 1");
	      db_query("update taxclass set percent2 = '$percent2' where id = '$key' limit 1");
	      db_query("update taxclass set enable = '$enable' where id = '$key' limit 1");
	      db_query("update taxclass set country = '$country' where id = '$key' limit 1");
	      db_query("update taxclass set state = '$state' where id = '$key' limit 1");
	  }else{
	     // echo "insert into taxclass values(null, '$country', '$state', '$percent', '$enable');";
	  
		db_query("insert into taxclass values(null, '$country', '$state', '$percent', '$enable', '$f_tax');");
	      echo db_error();
	  
	  }
    
    
    
    }








}

  if(!$_GET['order'])
    $order = "";
  else
    $order = $_GET['order'];
if(!$_GET['pgno'])
{
	$PageNo = 1;
}
else
{
	$PageNo = $_GET['pgno'];
}
//$PRODUCTSPERPAGE = 2;
/********************************************************************
     Get how many products  are to be displayed according to the  Events
********************************************************************/

	$StartRow =   $PRODUCTSPERPAGE * ($PageNo-1);
/***********************************************
display search results
***********************************************/
 /*********************************************

  Display all  products

  *********************************************/

	$query="select * from taxclass order by country, state";
  $result=db_query($query,$db);
  
  $total = db_num_rows($result);
  
  
  $totalrows= db_affected_rows();
  $totalpages = (int) ($totalrows / $PRODUCTSPERPAGE);
  if(($totalrows % $PRODUCTSPERPAGE)!=0)
    $totalpages++;
    $query .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
    $result=db_query($query,$db);
   

	if(!$total)
      $Error = 1;
if(!empty($_GET['add_more'])){

?>
		   <table>
		      <tr>
		
		      <td style="width:20px;text-align: center;">
			    <input type="hidden" name="id[]" id="id[]" value="" />
		      
		      </td>
		      <td width="120px" align="center">
		      <?php
		      $unique = uniqid();
		      ?>
			    <select name="country[]" id="country[<?php echo $unique; ?>]" onchange="change_state($(this).val(), '<?php echo $unique; ?>');" >
			    <?php
			      $csql = "select * from countries";
			      $qry = db_query($csql);
			      
			      while($row = db_fetch_array($qry)){
			      ?>
				<option value="<?php echo $row['iso'];?>"><?php echo $row['printable_name'];?></option>
			      <?php } ?>
			    </select>
			    
		      </td>
		   
		      <td width="120px" align="center"> 
			  <select name="state[]" id="state[<?php echo $unique; ?>]" alt="<?php echo $unique; ?>">
				 <?php
					$sqlS = db_query("select * from usstates order by stname asc");
					while($rowS = db_fetch_array($sqlS)){
				?>
					<option value="<?php echo $rowS['stname'];?>" ><?php echo $rowS['stname'];?></option>
				<?php } ?>
												  
			 </select>
		      </td>
		      <td width="120px" align="center"><input type="text" name="tax[]" id="tax[<?php echo $unique; ?>]" value="" size="6" />%</td>
		      <td width="120px" align="center"><input type="text" name="tax2[]" id="tax2[<?php echo $unique; ?>]" value="" size="6" />%</td>
		      <td width="120px" align="center"><input type="checkbox" name="enable[]" id="enable[<?php echo $unique; ?>]" value="1" />Y/N</td>
		    </tr>
		  </table>
		    
		 
<?php
}else{
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        
           <title>Manage Taxes <?php echo $ADMIN_MAIN_SITE_NAME ?></title>
       <?php include("page_headers.php"); ?>
<script type="text/javascript">
	function change_state(country, id){
	
	
	
	
	}
	function delconfirm(loc)
	{
            alert(loc);
		if(confirm("Are you sure do you want to delete this?"))
		{
			window.location.href=loc;
		}
		return false;
	}
	function movechild(loc)
	{
		window.location.href=loc;
	}
	
	function add_more(){
	  $.get('managetax.php?add_more=yes', function(response){
	  
	  
	      $('#add_more').append(response);
	  
	  });
	
	}
</script>
<style>
p {

width:600px;
word-wrap:break-word;
}
</style>
    </head>

    <body>
        <!--[if !IE]>start wrapper<![endif]-->
        <div id="wrapper">
            <!--[if !IE]>start head<![endif]-->
            <div id="head">
<?php include('include/header.php'); ?>
            </div>
            <!--[if !IE]>end head<![endif]-->

            <!--[if !IE]>start content<![endif]-->
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">
                    <div class="inner">
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Manage Taxes
                                </h2>
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>
                            <!--[if !IE]>end title wrapper<![endif]-->
                            <!--[if !IE]>start section content<![endif]-->
                            <div class="section_content">
 
                                <!--[if !IE]>end section content top<![endif]-->
                                                    
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper" style="margin:20px 0 20px 20px;">
                                                            <div class="table_wrapper_inner">
                                                            
                                                            <div id="tax_help" style="display:none;">
                                                           <h3> Collecting Sales Tax Online</h3>
							    <p>
							    If you run a business with a physical storefront, collecting sales tax is straightforward. You charge your customers the sales tax required by the jurisdiction where your business is located. For example, if you operate a retail store in Nashville, Tenn., you collect both state and local sales taxes from customers buying merchandise at your store.

							    But suppose you start selling your products online. Does that mean you charge customers the same sales taxes that you do to those who are coming into your store? It depends.
							    </p>
							    <br />
							    <h4> to Collect Sales Tax Online</h4>
							    <br />
							    <p>
							    If your business has a physical psence in a state, such as a store, office or warehouse, you must collect applicable state and local sales tax from your customers. If you do not have a psence in a particular state, you are not required to collect sales taxes.

							    In legal terms, this physical psence is known as a "nexus." Each state defines nexus differently, but all agree that if you have a store or office of some sort, a nexus exists. If you are uncertain whether or not your business qualifies as a physical psence, contact your state's revenue agency. If you do not have a physical psence in a state, you are not required to collect sales taxes from customers in that state.

							    This rule is based on a 1992 Supme Court ruling in which the justices ruled that states cannot require mail-order businesses, and by extension, online retailers to collect sales tax unless they have a physical psence in the state.
							    </p>
							    <br />
							    <h4>State Exemptions</h4>
							    <br />
							    <p>
							    Keep in mind that not every state and locality has a sales tax. Alaska, Delaware, Hawaii, Montana, New Hampshire and Oregon do not have a sales tax. In addition, most states have tax exemptions on certain items, such as food or clothing. If you are charging sales tax, you need be familiar with applicable rates.

							    Determining which sales tax to charge can be a challenge. Many online retailers use online shopping-cart software services to handle their sales transactions. Several of these services are programmed to calculate sales tax rates for you.
							    </p>
							  </div>
							  <a href="javascript:;" onclick="if($('#tax_help').css('display') == 'none'){ $('#tax_help').css('display', 'block'); }else{ $('#tax_help').css('display', 'none'); }">Show Help</a>
                                                            <form action="managetax.php" method="post">
                                                                 
							


										<table cellpadding="0" cellspacing="0" width="100%">
										    <tbody>
											<tr>
											  <th style="width:20px;text-align: center;" width="20px">No</th>
											  <th style="width:210px;text-align: center;">Country</th>
											  <th style="width:210px;text-align:center;">State</th>
											  
											  <th style="width:210px;text-align: center;">Fed. tax</th>
											  
											  <th style="width:210px;text-align:center;">State Tax</th>
											  <th style="width:240px;text-align:center;">Enable</th>
											</tr>
											<?php
											if($total >= 1){
											      ?>
											    
											      <?php
											      
											      while($row = db_fetch_array($result)){
											      
											      
											      ?>
												<tr class="<?php echo ($i % 2!=0)?'first':'second'; ?>">
												  <td style="width:20px;text-align: center;"><input type="hidden" name="id[<?php echo $row['id'];?>]" id="id[<?php echo $row['id'];?>]" value="<?php echo $row['id'];?>" /><?php echo $row['id'];?></td>
												  <td width="120px" align="center">
												   <select name="country[<?php echo $row['id'];?>]" id="country[<?php echo $row['id'];?>]" onchange="change_state($(this).val(), ?php echo $row['id'];?>);">
													<?php
													  $csql = "select * from countries";
													  $qryC = db_query($csql);
													  
													  while($rowC = db_fetch_array($qryC)){
													  ?>
													    <option value="<?php echo $rowC['iso'];?>" <?php if($row['country'] == $rowC['iso']){ echo 'selected'; }?> ><?php echo $rowC['printable_name'];?>
													    </option>
													  <?php } ?>
												    </select>
												  
												  
												  
												  
												  
												  </td>
												  
												  
												  <td width="100px" align="center">
												  
												     <select name="state[<?php echo $row['id'];?>]" id="state[<?php echo $row['id'];?>]">
												     <?php
													$sqlS = db_query("select * from usstates order by stname asc");
													while($rowS = db_fetch_array($sqlS)){
													?>
													  <option value="<?php echo $rowS['stname'];?>" <?php if($row['state'] == $rowS['stname']){ echo 'selected'; }?>><?php echo $rowS['stname'];?></option>
													<?php } ?>
												  
												      </select>
												  
												  </td>
												  <td width="100px" align="center">
													<input type="text" name="tax[<?php echo $row['id'];?>]" id="tax[<?php echo $row['id'];?>]" value="<?php echo $row['percent'];?>" size="6" />%
												  </td>
												  <td width="100px" align="center">
													<input type="text" name="tax2[<?php echo $row['id'];?>]" id="tax2[<?php echo $row['id'];?>]" value="<?php echo $row['percent2'];?>" size="6" />%
												  </td>
												  
											
												  
												  
												  <td width="100px" align="center">
												  
												  <input type="checkbox" name="enable[<?php echo $row['id'];?>]" id="enable[<?php echo $row['id'];?>]" value="1" <?php if($row['enable'] == '1'){ echo 'checked'; } ?> />Y/N</td>
												</tr>
											      <?php    
											      
											      }
											
											      ?>


											
											
											<?php
											}
											
											?>
												  
									  <tr>
									  <td colspan="6">
										<div id="add_more" colspan="6">	
										</div>	
									   </td>
									  </tr>
									  </tr>
									  <tr>
									      <td width="100%" align="right" width="100%" align="left" colspan="6">
										  <a href="javascript: add_more();">Add Tax Record</a>
										  
									      </td>
									</tr>
										  
									<tr>
									      <td colspan="6" align="right">
										      
																													<span class="button send_form_btn">
											  <span><span>Edit</span></span>
											    <input name="edit" type="submit"  />
											</span>
																			

										</td>
									 </tr>	      
									
									
									    </table>
									    </form>
											
     
								</div>
							      </div>
							       
								    
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
                        <!--[if !IE]>end section<![endif]-->

                    </div>
                </div>
                <!--[if !IE]>end page<![endif]-->
                <!--[if !IE]>start sidebar<![endif]-->
                <div id="sidebar">
                    <div class="inner">
<?php include 'include/leftside.php' ?>
                    </div>
                </div>
                <!--[if !IE]>end sidebar<![endif]-->

            </div>
            <!--[if !IE]>end content<![endif]-->

        </div>
        <!--[if !IE]>end wrapper<![endif]-->

        <!--[if !IE]>start footer<![endif]-->
        <div id="footer">
            <div id="footer_inner">
<?php include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

    </body>
</html>

<?php } ?>