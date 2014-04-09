 <style>
p.highlight {
height:80px;
border-radius:8px 8px 8px 8px!important;
outline-width:1px!important;
padding:5px;
}
</style>
          <div class="wrapper">
            <!-- ============= Header =============  -->
            <?php include 'include/' . $template . '/header.php'; ?>
            <!-- ============= End Header =============  -->
          <div id="container">

	 <div class="tab-area">
                <div id="column-right">
			    <div id="title-category-content">
		
				
				<p class="bid-title"><em><?php echo BUY_BIDS; ?></em></p>

			    </div><!-- /title-category-content -->

			    <div id="buybids-box" class="content">
			      <?php require("$BASE_DIR/modules/gateways/idealing/content.php"); ?>


			    </div><!--end content-->
			
                   	</div>
			 
		    </div>
		  
		    <div id="column-left">
			    <?php   include($BASE_DIR . "/include/leftside.php"); ?>
		    </div>
               </div>
               <div class="clear"></div>
	    
        <?php 
      
        require($BASE_DIR . '/include/' . $template . '/footer.php'); ?>
	</div>
			<script>
			$('#payment p input').click(function(){
			
			    $('#payment p').removeClass('highlight');
			    $('#payment p input').prop('checked', false);
			    $(this).prop('checked', true);
			    $(this).parent().addClass('highlight');
			    
			});
			$('#payment p input').last().prop('checked', true);
			$('#payment p').removeClass('highlight');
			$('#payment p input').last().parent().addClass('highlight');
			OpenDetails($('#payment p input').last().val());
			</script>
