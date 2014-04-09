<?php if (Sitesetting::isEnableTax() == true) { 
	  if(!class_exists('PaymentHelper')){
	  
	  include_once($BASE_DIR . "/data/paymenthelper.php");
	  }
	      switch(basename($_SERVER['PHP_SELF'])){
		  case 'wonauctions.php':
		      $taxes = new taxClass();
		      $data = $obj;
		     
		      $data['price'] = $data['auc_final_price'];
		      $taxes = $taxes->getTaxes($data, $data);
		      $taxamount = $taxes[0] + $taxes[1];
		  ?>
			    <?php echo FEDERAL; ?>:<?php echo $Currency . number_format($taxes[0], 2); ?> <br />
			    <?php echo STATE; ?>:<?php echo $Currency . number_format($taxes[1], 2); ?> <br />
			    <?php echo TOTAL . ' ' .TAX_AMOUNT; ?>:<?php echo $Currency . number_format($taxamount, 2); ?> <br />
		  <?php    
		      
		  break;
		  case 'buyitnow.php':
		      $taxes[0] = $buynowprice['tax1'];
		      $taxes[1] = $buynowprice['tax2'];
		      $taxamount = $taxes[0] + $taxes[1];
		  ?>
			    <?php echo FEDERAL; ?>:<?php echo $Currency . number_format($taxes[0], 2); ?> <br />
			    <?php echo STATE; ?>:<?php echo $Currency . number_format($taxes[1], 2); ?> <br />
			 
		  <?php
		  break;
		  case 'paymentmethod.php':
		      $taxes = new taxClass();
		     
			$data = db_fetch_array(db_query("select * from auction a " .
                "left join won_auctions w on w.auction_id=a.auctionID left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join registration r on r.id=w.userid" .
                " where a.auctionID=$waucid"));
		     
		     
		      $data['price'] = $obj->auc_final_price;
		      
		      $taxes = $taxes->getTaxes($data, $data);
		      $taxamount = $taxes[0] + $taxes[1];
		  ?>
			    <td align="left" width="100"><?php echo FEDERAL; ?>:<?php echo $Currency . number_format($taxes[0], 2); ?> </td>
			    <td align="right" width="100"><?php echo STATE; ?>:<?php echo $Currency . number_format($taxes[1], 2); ?> </td>
			    <td align="right"><?php echo TOTAL . ' ' .TAX_AMOUNT; ?>:<?php echo $Currency . number_format($taxamount, 2); ?></td>
		  <?php
		  break;
	      }
	      
	      
	  ?>
	  
	  
<?php } ?>
