<?php


if(isset($_REQUEST['text'])){


  if(!empty($_REQUEST['text'])){
     if(db_num_rows(db_query("select * from testimonials where user_id = '$uid' and date = '" .date("Y-m-d") . "'")) == 0){
	    if(!empty($_FILES['picture'])){
	    
		  $filename =  basename($_FILES['picture']['name']);
		  
		    move_uploaded_file($_FILES['picture']['tmp_name'], "uploads/testimonials/$filename");
		
		}
		else{
		$filename = '';
		}
		
	    mail('edward.goodnow@gmail.com', "New Testimonial", "A Testimonial Has Been Added To Your Site");
	    
	    db_query("insert into testimonials values(null, '$_SESSION[userid]', '" . $filename . "', NOW(), '" .  db_real_escape_string($_REQUEST['text']) . "', 0);");
      
      }
	  

?>

<script>
    $(document).ready( function(){
	ajax_testimonials('include/addons/testimonials/add_testimonials.php?thankyou=yes', 'add');

    });
</script>

<?php

    }
}

if($_SESSION['admin'] < 1){
?>
	<?php if(!empty($_SESSION['userid']) & empty($ckeditor)){ ?>	
	<script type="text/javascript" src="<?php echo $SITE_URL;?>backendadmin/js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="<?php echo $SITE_URL;?>backendadmin/js/ckeditor/adapters/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $SITE_URL;?>backendadmin/js/ckeditor/config.js"></script>
	<script>
	var siteurl = 'http://' + window.location.hostname + '/';
	var template  = '<?php echo $template;?>';
	CKEDITOR.editorConfig = function(config) {
	  var siteurl = 'http://' + window.location.hostname + '/';
	  CKEDITOR.config.filebrowserBrowseUrl = siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/browse.php?type=files';
	  CKEDITOR.config.filebrowserImageBrowseUrl = siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/browse.php?type=images';
	  CKEDITOR.config.filebrowserFlashBrowseUrl = siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/browse.php?type=flash';
	  CKEDITOR.config.filebrowserUploadUrl = siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/upload.php?type=files';
	  CKEDITOR.config.filebrowserImageUploadUrl = siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/upload.php?type=images';
	  CKEDITOR.config.filebrowserFlashUploadUrl = siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/upload.php?type=flash';
	  CKEDITOR.config.baseFloatZIndex = '99999999999';
	  CKEDITOR.config.skin = 'moono';
	  

	  CKEDITOR.config.contentsCss = siteurl + 'css/styles.php?template=' + template + '&page=' + template + '.css' ;
	  
		    CKEDITOR.config.width = 800;
		    CKEDITOR.config.height = 222;
			
		    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;


	};



	</script>
	<?php $ckeditor = 'true'; } ?>
	<?php if(!empty($_SESSION['userid']) & empty($uploader)){ ?>
	<link rel="stylesheet" href="<?php echo $SITE_URL;?>include/addons/uploader/js/fileuploader.css" type="text/css" />
	<script type="text/javascript" src="<?php echo $SITE_URL;?>include/addons/uploader/js/fileuploader.js"></script>
	<?php $uploader = 'true'; } ?>
<?php } ?>	



