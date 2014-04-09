
<style>
.content{
width: 250px;
padding: 0;
margin: 0 10px 0 0;
float: left;
}
.content h5{
padding: 0;
margin: 0 0 15px 0;
color: #fff;
line-height: normal;
}
.content ul{
padding: 0;
margin: 0;
float: left;
}
.content li{
padding: 0;
margin: 0;
float: left;
width:200px;
}
#footer-left{
width:820px;
float:left;
}
#footer-right{
width: 300px;
float: left;
margin: 0px 0px 0px 50px;
}
}
.content li a{
color:grey;
padding: 0;
margin: 0;
float: left;
}
#footer{
}
#copyright{
float:left !important;
width:500px;

}
</style>




<div id="footer" style="color:#fff;">

		<div id="footer-left">

			<div class="content">
				<h5 onclick="document.location='<?php echo $SITE_URL;?>myaccount.php'">Our Company</h5>
			  	<ul>
					<li><a href="<?php echo $SITE_URL;?>aboutus.php"><?php echo ABOUT_US;?></a></li>
					<li><a href="<?php echo $SITE_URL;?>help.php">FAQ'S</a></li>
					<li><a href="<?php echo $SITE_URL;?>contact.php">Contact Us</a></li>
					<li><a href="<?php echo $SITE_URL;?>privacy.php"><?php echo PRVICAY_POLICY;?></a></li>
				</ul>
			</div><!--content-->


			<div class="content">
				<h5>Customer Service</h5>

				<ul>
					<li><a href="<?php echo $SITE_URL;?>howitworks.php">How It Works</a></li>
					<li><a href="<?php echo $SITE_URL;?>help.php">Bidding</a></li>
					<li><a href="<?php echo $SITE_URL;?>help.php">Shipping And Delivery</a></li>
					<li><a href="<?php echo $SITE_URL;?>help.php">Return Policy</a></li>
				</ul>
			</div><!--content-->

			<div class="content">
				<h5>Online Operations</h5>
				<ul>
					
					<li><a href="<?php echo $SITE_URL;?>howitworks.php">Payment Methods and Security</a></li>

					<li><a href="<?php echo $SITE_URL;?>support.php"><?php echo SUPPORT;?></a></li>

					<li><a href="<?php echo $SITE_URL;?>terms.php"><?php echo TERMS_AND_CONDITIONS;?></a></li>
				</ul>
			</div><!--content-->

		</div><!--footer-left-->

		<div id="footer-right">
			<div class="content connect">
				<div class="left"><h5><?php echo STAY_CONNECTED;?></h5>
				<?php include($BASE_DIR . '/include/addons/right_social/footer.php'); ?>
				</div>
				<div class="clear"></div>
			<br />				
				<h5><?php echo BID_SAFELY_ON . ' ' . $SITE_NM;?></h5>
				<ul class="footer-icons">
					<li class="bbb">
						<img src="http://s1.quibidscdn.com//site/images/icons/bbb.png" />

					</li>
									</ul>
			</div><!--content-->

		</div><!--footer-right-->
		
		<script type="text/javascript">
			 $(document).ready(function(){
				$('#siteMap').toggle();
			 });
		</script>
		<div id="siteMap">
		

			
			<div id="copyright" style="min-height:100px">

			<p><span title="2">&copy;</span>
				<span title="0.055"><?php echo $SITE_NM; ?> <?php echo COPYRIGHT;?></span>
				<span title="120"><?php echo ALL_RIGHTS_RESERVED;?></span>
			</p>
			</div><!--copyright-->
		</div>
	</footer><!--footer-->

 <span id="copyright" style="float:right;">Copyright &copy;<?php echo date("Y");?>
<?php echo $SITE_NM;?>.com. <?php echo ALL_RIGHTS_RESERVED; ?>.</span>

</div><!-- /footer --> 





