<div id="footer">
    <ul class="footer-links">
        <li><h5 onclick="document.location='/help.php'"><?php echo OUR_SITE; ?></h5></li>
        <li><a href="registration.php"><?php echo REGISTER_FOOTER; ?></a></li>
        <li><a href="help.php"><?php echo HELP_FOOTER; ?></a></li>
        <li><a href="aboutus.php"><?php echo ABOUT_US_FOOTER; ?></a></li>
    </ul>

    <ul class="footer-links">
        <li><h5><?php echo OTHER_INFORMATION;?></h5></li>
        <li><a href="terms.php"><?php echo TERMS_CONDITIONS_FOOTER; ?></a></li>
        <li><a href="contact.php"><?php echo CONTACT_FOOTER; ?></a></li>
        <li><a href="privacy.php"><?php echo PRIVACY_FOOTER; ?></a></li>
        <li><a href="affiliate.php"><?php echo JOBS_FOOTER; ?></a></li>
    </ul>
    <div id="cards" style="height:84px;"></div>
    <div id="verisign" style="margin-left:20px;margin-top:-10px;">
        <script src="flash/getseal"></script>
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" id="s_s" width="100" align="" height="72">
            <param name="movie" value="https://seal.verisign.com/getseal?at=1&amp;&amp;sealid=2&amp;dn=WWW.QUIBIDS.COM&amp;aff=VeriSignCACenter&amp;lang=en"/>
            <param name="loop" value="false"/>
            <param name="menu" value="false"/>
            <param name="quality" value="best"/>
            <param name="wmode" value="transparent"/>
            <param name="allowScriptAccess" value="always"/>
            <embed src="flash/getseal_002" loop="false" menu="false" quality="best" wmode="transparent" swliveconnect="FALSE" name="s_s" type="application/x-shockwave-flash" pluginspage="https://www.macromedia.com/go/getflashplayer" allowscriptaccess="always" width="100" align="" height="72"/>
        </object>
    </div>
    
     <div id="copyright" style="color:black;position:relative;left:250px;" ><a href="<?php echo $SITE_URL;?>">
        <span title="0.034"><?php echo COPYRIGHT; ?></span>
        <span>
            <label title="201">© <?php echo $SITE_NM; ?>.</label>
            <label title="40"><?php echo ALL_RIGHTS_RESERVED; ?>.</label>
        </span>
  </a>  </div>
</div>

<div id="alert_message" title="Alert Message">
    <p id="alert_message_content">

    </p>
</div>

<div id="confirm_message" title="Confirm Message">
    <p id="confirm_message_content">

    </p>
</div>

<div id="timeout_dialog" title="<?php echo DIALOG_TIMEOUT_TITLE; ?>" style="display: none;">
    <p>
        <?php printf(DIALOG_TIMEOUT_CONTENT,  Sitesetting::getTimeout()); ?>
    </p>
</div>



  <?php
  foreach($addons as $key => $value){

  if(file_exists("include/addons/$value/footer.php")){
    ?><?php
include_once("include/addons/$value/footer.php");

  }


  }
  ?>

