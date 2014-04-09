<div id="footer">
    <ul class="footer-links">
        <li><h5 onclick="document.location='/help.php'"><?php echo WELCOME_TO; ?><?php echo $SITE_NM; ?></h5></li>
        <li><a href="registration.php"><?php echo REGISTER_NOW; ?></a></li>
        <li><a href="help.php"><?php echo HELP; ?></a></li>
        <li><a href="aboutus.php"><?php echo ABOUT_US; ?></a></li>
    </ul>

    <ul class="footer-links">
        <li><h5><?php echo OTHER_INFORMATION;?></h5></li>
        <li><a href="terms.php"><?php echo TERMS_CONDITIONS; ?></a></li>
        <li><a href="contact.php"><?php echo CONTACT; ?></a></li>
        <li><a href="privacy.php"><?php echo PRIVACY; ?></a></li>
        <li><a href="jobs.php"><?php echo JOBS; ?></a></li>
    </ul>
    <div id="cards"></div>
    <div id="verisign" style="margin-right: 10px;">
        
    </div>
    <div id="copyright">
        <span title="0.034"><?php echo COPY_RIGHT; ?></span>
        <span>
            <label title="201">© <?php echo $SITE_NM; ?>.</label>
            <label title="40"><?php echo ALL_RIGHTS_RESERVED; ?>.</label>
        </span>
    </div>
</div>
<style>
    #timeout_dialog span,
   .ui-dialog-buttonset button,
   .ui-button, .ui-widget, .ui-state-default, .ui-corner-all, .ui-button-text-only
    .ui-button-text, .ui-dialog span {
    color:#000;
    }
 </style>
        
 <?php 
  foreach($addons as $key => $value){

  if(file_exists("include/addons/$value/footer.php")){
    ?><?php
//include_once("include/addons/$value/footer.php");

  }


  }
  ?>