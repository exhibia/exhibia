<?php if(!empty($msg)){ echo $msg; } ?>

 <form name="f1" action='designsuite.php' method='POST' enctype="multipart/form-data" onSubmit="return Check(this)" class="search_form general_form">
     <fieldset>
            <!--[if !IE]>start forms<![endif]-->
             <div class="forms">
                                                                
                                                       
<?php include("DESIGN/" . $_REQUEST['page']); ?>
 


<input type="hidden" value="<?php echo $_REQUEST['page'];?>" name="page" />
 <span class="button send_form_btn"><span><span>Submit</span></span><input type="submit" name="submit" value="Submit" /></span>

	      </div>
      </fieldset>
</form>