<?php

$items_out = array();
$items_out[$master_item] = array();

	 while($obj = db_fetch_array($ressel)) {
	
		
		
		if(!array_key_exists($obj['auctionID'], $items_out[$master_item])){
			    $items_out[$master_item][$obj['auctionID']] = array();
			}
		
		foreach($obj as $key => $value){
		    if($key != 'auctionID' & $key != 'auction_id'){
			
			
			if((!in_array($key, $data_excluded) & is_numeric($value))){
			    $items_out[$master_item][$obj['auctionID']][$key] = $value;
			}
		    }
		}
    }
  
    ?>
  <?php
	  $str = '';
	  foreach($items_out[$master_item] as $key => $value){
		      $str .= "\"$key\" : {\n";
		
		    foreach($items_out[$master_item][$key] as $key2 => $value2){
		      if(!is_numeric($key2)){
			$str .= "\"$key2\" : \"$value2\", \n";
			}
		    }
		    $str .= "},";
		}
		echo $str;
	  ?> 
<script>
	
	$(document).ready(function(){
$('form[name="f1"] fieldset').append('<div id="category_graph_holder" style="float:right;"><div id="myChartDiv" style="position:relative;top:-50px;width: 400px; height: 250px; display: inline-block;">    </div><div id="tipChartInfo" class="tooltipPop" style="display:none;"><div id="detailsChart" style="width:390px;height:240px; display:inline-block"></div></div></div>');

//onLoadDoc();



	  });
	
	
    
</script>
<?php
foreach($addons as $key => $value){


if(file_exists("../include/addons/$value/admin_footer.php")){



include("../include/addons/$value/admin_footer.php");



}






}
?><dl class="copy">
    <dt><strong>Penny Auction Soft</strong> <em>build 48122010</em></dt>
    <dd>&copy; 2010 Pennyauctionsoft.com  All rights reserved.</dd>
</dl>

<dl class="quick_links">
    <dt><strong>Quick Links :</strong></dt>
    <dd>
        <ul>
            <li><a href="innerhome.php">Dashboard </a></li>
            <li><a href="inneraccount.php">My Account</a></li>
            <li><a href="innerstatic.php">CMS</a></li>
            <li><a href="manage_members.php">Users</a></li>
            <li><a href="manageproducts.php">Products</a></li>
            <li class="last"><a href="logout.php">Log out</a></li>
        </ul>
    </dd>
</dl>


<dl class="help_links">
    <dt><strong>Need Help ?</strong></dt>
    <dd>
        <ul>
            <li><a href="http://www.pennyauctionsoft.com/support/">Live Help</a></li>
            <li><a href="http://www.pennyauctionsoft.com/support/knowledgebase.php">FAQ</a></li>
            <li class="last"><a href="http://www.pennyauctionsoft.com/support/knowledgebase.php">Knowledgebase</a></li>
        </ul>
    </dd>
</dl>
<div id="alerts" style="width:350px;height:100px;border-radius:8px;background-color:#fff;float:right;margin: 0 30px 10px 0;">
<h3 style="text-align:center;">Alerts / Tasks</h3>
<?php
if(!class_exists('PaymentOrder')){
include_once '../data/paymentorder.php';
}

$orderdb = new PaymentOrder(null);
$auction = '';

$result = $orderdb->select($StartRow, $PRODUCTSPERPAGE, 'paid', $_REQUEST);
$total = db_num_rows($result);


$alert_result = $orderdb->select($StartRow, '', 'paid', '');

$alerts = array();
while($alert_row = db_fetch_array($alert_result)){
    switch ($alert_row['payfor']){
	case 'buyitnow':
	    
	    if(db_num_rows(db_query("select user_product.id, user_product.status as pstatus, ss.id as ssid,tracknumber,ss.status as shippingstatus, st.url as sturl,st.logoimage as stlogoimage from user_product left join shippingstatus ss on ss.orderid=user_product.id and ss.ordertype=2 left join shippingtype st on st.id=ss.shippingtypeid where userid = '$alert_row[uid]' and productid = '$alert_row[pid]' and price = '$alert_row[amount]' and (buydate = '$alert_row[datetime]' or productid = '$alert_row[aid]') and ss.ordertype=2 and ss.status >= 1")) == 0){
		$alerts['shipping']['buyitnow'][] = $alert_row['invoiceid'];
		
	    }
	break;
	case 'wonauction':
	$query_w = "select a.auctionID,a.productID as productID,a.categoryID as categoryID,  use_free,allowbuynow,userid,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,w.id as wid,ss.id as ssid,order_status from won_auctions w left join auction a on w.auction_id=a.auctionID left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join registration r on r.id=w.userid left join shippingstatus ss on ss.orderid=w.id and ss.ordertype=2 where w.auction_id='$alert_row[auction_id]' and w.userid='$alert_row[userid]'";
	  $w_data = db_fetch_array(db_query($query_w));
	
	    if(db_num_rows(db_query("select * from shippingstatus where orderid = " . $w_data['wid'] . " and ordertype = 1 and status >= 1")) == 0){
		$alerts['shipping']['wonauction'][] = $alert_row['invoiceid'];
	    }
	break;
	case 'redemption':
	   if(db_num_rows(db_query("select * from shippingstatus where ordertype = '6' and orderid = '$alert_row[oid]' and status >= 1")) == 0){
		$alerts['shipping']['redemption'][] = $alert_row['invoiceid'];
	    }
	break;
	case 'Won Bingo':
	    if(db_num_rows(db_query("select * from shippingstatus where ordertype = '7' and orderid = '$alert_row[oid]' and status >= 1")) == 0){
		$alerts['shipping']['Won Bingo'][] = $alert_row['invoiceid'];
	    }
	break;
    }

}
?>

<ul>
<h4>Shipping</h4>
<?php
foreach($alerts['shipping'] as $alert_type => $array){

  ?><li style="font-weight:bold;"><a href="paidorders.php?o_payfor_filter_with=equals&o_payfor=<?php echo $alert_type; ?>&order=desc&limit="><?php echo $alert_type; ?> / <?php echo count($alerts['shipping'][$alert_type]); ?> Items</a>
	<ul>
	  <?php
	    foreach($alerts['shipping'][$alert_type] as $key => $invoiceid){
		?>
	    
		<?php
	    }
	  ?>
	</ul>
  </li><?php
}
?>
</ul>
</div>
<?php
if(! preg_match('/message.php/' , $_SERVER['PHP_SELF'])){

?>

	<script type="text/javascript" src="<?php echo $SITE_URL;?>/backendadmin/js/jquery.qtip.js"></script>
	
	
	<script type="text/javascript" src="<?php echo $SITE_URL;?>/backendadmin/js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo $SITE_URL;?>/backendadmin/js/ckeditor/adapters/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $SITE_URL;?>/backendadmin/js/ckeditor/config.js"></script>
	
	<style>
	  video {
	  border-left: 1px inset black;
	  border-right: 2px inset black;
	  border-top: 1px inset black;
	  border-bottom: 2px inset black;
	  border-radius:2px;
	  }
	</style>
	
	
	<script type="text/javascript">
	  
	  


$(document).ready(function(){

    $( '.text' ).ckeditor();
    $( 'textarea[name=description]' ).ckeditor();
<?php
  if(db_num_rows(db_query("select * from sitesetting where name ='addons' and value = 'tutorials'"))>=1){
    if($tutorials != 'false'){
 ?>

	
	
		 var tooltip = function(content){ 
		 

		    
			  jQuery(document.getElementById('logo')).qtip({content: content, 	position: {
				  my: 'top left',  // Position my top left...
				  at: 'bottom right', // at the bottom right of...
				  target: jQuery('#logo') // my target
			  } } );
				
			
		  }

jQuery("select").each(function(){
    if(!$(this).attr('id')){
    
	jQuery(this).attr('id', jQuery(this).attr('name')  + 'missing' );
	//  $.get('curl.php?email=yes&page=<?php echo $_SERVER['PHP_SELF'];?>&id=' + jQuery(this).attr('name'), function(){});
    }

      
      

});

jQuery("input[type='text']").each(function(){
    if(!$(this).attr('id')){
    
	jQuery(this).attr('id', jQuery(this).attr('name')  + 'missing' );
	//  $.get('curl.php?email=yes&page=<?php echo $_SERVER['PHP_SELF'];?>&id=' + jQuery(this).attr('name'), function(){});
    }

      
      

});

jQuery("textarea").each(function(){
    if(!$(this).attr('id')){
    
	jQuery(this).attr('id', jQuery(this).attr('name')  + 'missing' );
	//  $.get('curl.php?email=yes&page=<?php echo $_SERVER['PHP_SELF'];?>&id=' + jQuery(this).attr('name'), function(){});
    }

      
      

});


function get_id(type_of_input){

var id = $(this).closest(type_of_input).attr('id');
console.log(id);
return id;

}
	      jQuery('textarea').each( function(){
	      
		  $(this).qtip({
	      
			content: {
			  text: 'Loading...', // Loading text...
			  ajax: {
				  url: 'curl.php?element=' + $(this).attr('name'), // URL to the JSON script
				  type: 'GET', // POST or GET
				  data: { 'page': '<?php echo basename($_SERVER['SCRIPT_FILENAME']);?>' }, // Data to pass along with your request
				  dataType: 'json', // Tell it we're retrieving JSON
				  success: function(data, status) {
					  /* Process the retrieved JSON object
					  *    Retrieve a specific attribute from our parsed
					  *    JSON string and set the tooltip content.
					  */
					  var content = data.text;
	  
					  // Now we set the content manually (required!)
					  this.set('content.text', content);
				  }
			  }
		  }, 	
			position: {
				      my: 'top left',  // Position my top left...
				      at: 'bottom right', // at the bottom right of...
				      target: 'event'// my target
			      }
	  
	
      
		});
		
		
		});





jQuery('.tooltip').each( function(){
	      
		  $(this).qtip({
	      
			content: {
			  title: {
			  
			      text: 'Video Help',
			      button: 'Close'
			  
			  },
			  text: '<video width="400px" height="250px" controls="controls">  <source src="http://www.pennyauctionsoftdemo.com/TUTORIALS/video/' + $(this).attr('title') + '.webm" type="video/mp4" type=\'video/webm; codecs="vp8.0, vorbis"\' width="400px" height="250px">   <source src="http://www.pennyauctionsoftdemo.com/TUTORIALS/video/' + $(this).attr('title') + '.ogv" type="video/ogg" type=\'video/ogg; codecs="theora, vorbis"\' width="400px" height="250px"> </video>'
		  }, 	
		  
		  
		  hide: {
		event: false
	},
			position: {
				      my: 'top left',  // Position my top left...
				      at: 'bottom left', // at the bottom right of...
				      
				      		adjust: {
						  x: -10
					  },
				      target: 'event'// my target
			      },
			      
			style: {
			
			height:300,
			width:420
			
			
			},
			
			show: { solo: true, event: 'click' }
		
			    
	  
	
      
		});
		
		
		});



	      jQuery('input').each( function(){
	      
		  $(this).qtip({
	      
			content: {
			  text: 'Loading...', // Loading text...
			  ajax: {
				  url: 'curl.php?element=' + $(this).attr('name'), // URL to the JSON script
				  type: 'GET', // POST or GET
				    data: { 'page': '<?php echo basename($_SERVER['SCRIPT_FILENAME']);?>' }, // Data to pass along with your request
				  dataType: 'json', // Tell it we're retrieving JSON
				  success: function(data, status) {
					  /* Process the retrieved JSON object
					  *    Retrieve a specific attribute from our parsed
					  *    JSON string and set the tooltip content.
					  */
					  var content = data.text;
	  
					  // Now we set the content manually (required!)
					  this.set('content.text', content);
				  }
			  }
		  }, 	
			position: {
				      my: 'top left',  // Position my top left...
				      at: 'bottom right', // at the bottom right of...
				      target: 'event'// my target
			      }
	  
	
      
		});
		
		});
	      jQuery('select').each( function(){
	      
		  $(this).qtip({
	      
			content: {
			  text: 'Loading...', // Loading text...
			  ajax: {
				  url: 'curl.php?element=' + $(this).attr('name'), // URL to the JSON script
				  type: 'GET', // POST or GET
				  data: { 'page': '<?php echo basename($_SERVER['SCRIPT_FILENAME']);?>'}, // Data to pass along with your request
				  dataType: 'json', // Tell it we're retrieving JSON
				  success: function(data, status) {
					  /* Process the retrieved JSON object
					  *    Retrieve a specific attribute from our parsed
					  *    JSON string and set the tooltip content.
					  */
					  var content = data.text;
	  
					  // Now we set the content manually (required!)
					  this.set('content.text', content);
				  }
			  }
		  }, 	
			position: {
				      my: 'top left',  // Position my top left...
				      at: 'bottom right', // at the bottom right of...
				      target: 'event'// my target
			      }
	  
	
      
		});

	    });
 
	$("select").bind('click',

      
	  function(){
	    
		   $( this ).css('border', '2px solid red');
		   $( this ).bind('focusout', function(){     $(this).css('border', '');     });

	     }
	);
		
			
			
       $("textarea").bind('click',

	  function(){
		   $( this ).css('border', '2px solid red');
		   $( this ).bind('focusout', function(){     $(this).css('border', '');     });
	      }


	);
      $("input[type=text]").bind('click',

	  	  function(){
		   $( this ).css('border', '2px solid red');
		   $( this ).bind('focusout', function(){     $(this).css('border', '');     });
		  }
	  );
      <?php 
      } 

      }

      ?>

      });
	</script>
	
<?php } ?>