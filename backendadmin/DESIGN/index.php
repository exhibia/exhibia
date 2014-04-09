<div id="edit_log"><?php if(!empty($msg)){ echo $msg; } ?></div>
<div id="css-editor">
  <fieldset style="border:0 none;min-height:1500px;">
            <!--[if !IE]>start forms<![endif]-->
             <div class="forms">                         
                                                       
<?php include($BASE_DIR . "/backendadmin/DESIGN/" . $_REQUEST['a_page']); ?>
 


<input type="hidden" value="<?php echo $_REQUEST['page'];?>" name="page" />
 
	      </div>
      </fieldset>
</div>