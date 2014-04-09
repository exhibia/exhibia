<div id="navigationBox" class="box">
    <h3><?php echo NAVIGATION; ?></h3>
    <div class="box-content">        
        <ul>
            <li>                
                <ul>
                    <li><?php if($staticvar!="about"){?><a href="aboutus.php"><?php echo ABOUT_US; ?></a><?php } else { ?><span class="red-text-12-b"><?php echo ABOUT_US; ?></span><?php } ?></li>
                    <li><?php if($staticvar!="contact"){?><a href="contact.php"><?php echo CONTACT; ?></a><?php } else { ?><span class="red-text-12-b"><?php echo CONTACT; ?></span><?php } ?></li>
                    <li><?php if($staticvar!="terms"){?><a href="terms.php"><?php echo TERMS_CONDITIONS; ?></a><?php } else { ?><span class="red-text-12-b"><?php echo TERMS_CONDITIONS; ?></span><?php } ?></li>
                    <li><?php if($staticvar!="privacy"){?><a href="privacy.php"><?php echo PRIVACY_POLICY; ?></a> <?php } else { ?><span class="red-text-12-b"><?php echo PRIVACY_POLICY; ?></span><?php } ?></li>
                    <li><a href="help.php"><?php echo HELP; ?></a></li>
                    <li><?php if($staticvar!="jobs"){?><a href="jobs.php"><?php echo JOBS; ?></a><?php } else { ?><span class="red-text-12-b"><?php echo JOBS; ?></span><?php } ?></li>
                    <li><?php if($changeimage!="community"){?><a href="community.php"><?php echo COMMUNITY; ?></a><?php } else { ?><span class="red-text-12-b"><?php echo COMMUNITY; ?></span><?php } ?></li>
                </ul>
            </li>            
        </ul>
    </div><!-- /box-content -->
</div><!-- /navigationBox -->
