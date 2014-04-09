
<div id="sales_bar" style="display:none;">
<select name="change_template" id="change_template" onchange="window.location.href = 'index.php?change_template=' + $(this).val();" style="margin-bottom:3px;">
  <?php
  foreach($templates as $template_c){
  ?>
  <option alt="not completed" class="<?php echo str_replace(".", "", str_replace("-", "", $template_c)); ?>_gradient" value="<?php echo $template_c; ?>" <?php if($template == $template_c){ echo 'selected'; } ?>><?php echo $template_c; ?></option>
  <?php
  }
  ?>
</select>
<script>

//$('.pas_gradient, .snapbids_gradient').attr('alt', 'Ed has completed his work on these');
//$('.dealdash_gradient').attr('alt', $('.dealdash_gradient').attr() + ' Joel the viewproduct page needs some work, sold page looks like shit, top description needs margins and font styles set, positioning on the savings amount, the avatar is out of position,the bid button too is screwy and we may need to work on buy it now here');
//$('.quibids20_gradient').attr('alt', $('.dealdash_gradient').attr() + ' Joel the viewproduct page needs some work');
</script>
<span style="min-height:30px;"></span>
<div style="font-size:11px!important;display:none;">
Supports Nearly Every Language Imaginable<br style="margin-bottom:10px!important;" />
Supports User Badges<br style="margin-bottom:10px!important;" />
14 Different Auction filters<br  style="margin-bottom:10px!important;" />
Dozens of Ugrades Available<br style="margin-bottom:10px!important;" />
Customisable Events<br style="margin-bottom:10px!important;" />
Games<br style="margin-bottom:10px!important;" />
Easy To Customise<br />
</div>
<br />
<div style="position:relative;float:right;color:gray;margin-bottom:2px!important;">
To Login Use
<br style="margin-bottom:1px!important;" />
username: demo123
password: demo123
</div>
<br style="margin-bottom:1px!important;" />
<span style="min-height:3px;margin-bottom:2px;"></span>
<a style="display:none;" href="http://pennyauctionsoft.com/contact/">Contact Us</a>

</div>

<script>
$('#sales_bar').qtip({content:{ title: 'Change Template', text: $('#sales_bar').clone },
  position: {
      target: $('body'),
      at: 'top left',
      my: 'top left'
  
  
  }, 
  show: {
  ready:true,
  solo:false
  },
  style : {
  width:'180',
  classes: 'qtip-<?php echo $template; ?>, fixed'
  },
  hide: false
});
</script>