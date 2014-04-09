<?php

db_query("CREATE TABLE if not exists `similar_products` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `auctionID` bigint(20) unsigned NOT NULL,
  `productID` text not null,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;");


db_query("CREATE TABLE if not exists `similar_products_bids` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `auctionID` bigint(20) unsigned NOT NULL,
  `productID` text not null,
  `userid` int  not null,
  `bid_price` varchar(20) not null,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;");

echo db_error();
?>

      <table>
	  <tr>
	    <td>
	    <label>Sync This</label>
	      <ul id="similar_product_list" style="height:300px;overflow-x:hidden;overflow-y:scroll;width:200px;border:1px solid #000;">

  
	      </ul>
	    </td>
	    <td style="margin-left:20px;">
	    <label>UnSync This</label>
	      <ul id="similar_final_list" style="height:300px;overflow-x:hidden;overflow-y:scroll;width:200px;border:1px solid #000;">

  
	      </ul>
	    </td>
	  </tr>
      </table>
<script>
	   $('#similar_product_list li').bind('click', function(){
	   
		var id = $(this).attr('id');
		
		     $('#similar_final_list').append( $('#' + id).clone() );
		     $('#similar_product_list #' + id).remove();
		     $('#' + id).removeClass('waitting');
		     $('#' + id + ' input[type="checkbox"]').prop('checked', true);
		
	    });
 $('#similar_final_list li').bind('click', function(){
	   prompt('test');
		var id = $(this).attr('id');
		
		
		    $('#similar_product_list').append( $('#' + id).clone() );
		     $('#similar_final_list #' + id).remove();
		     $('#' + id).addClass('waitting');
		    $('#' + id + ' input[type="checkbox"]').prop('checked', false);
		
	  });
</script>	    