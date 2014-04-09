<?php
if(!file_exists($BASE_DIR . "/include/addons/slider/$template/img/")){
@mkdir($BASE_DIR . "/include/addons/slider/$template/");
@mkdir($BASE_DIR . "/include/addons/slider/$template/img");
@shell_exec("ln -s " . $BASE_DIR . "/uploads/banner " . $BASE_DIR . "/include/addons/slider/$template/img");


}
@shell_exec("rm $BASE_DIR/backendadmin/include/addons");
@shell_exec("ln -s " . $BASE_DIR . "/include/addons " . $BASE_DIR . "/backendadmin/include/addons");
?>
<style>
.browser {
  background: none repeat scroll 0 0 #FFFFFF;
  border-radius: 6px;
  height: auto;
  margin-top: 30px;
  min-height: 800px;
  overflow-y: auto;
  text-align: left;
  width: 630px;
}
.browser tr:first-child{
min-width:550px;
text-align:left;
list-type:none;

}
.browser tr:first-child td {
display: inline;
font-weight: bold;
min-width: 110px;
text-align: left;
padding: 0 25px 0 20px;
}
#dvContents table {
position:relative;
margin: 0;
}
#dvContents table td tr {
font-weight:normal!important;
font-size:12px;
min-width: 110px;
padding: 0 25px 0 20px;
padding: 0 25px 0 0;
display:inline;
}

.dvContents {
  height: auto;
  margin: 0;
  overflow-y: auto;
  padding: 0;
  width: 620px;
}
.item {
background-position: 3px 3px;
background-repeat: no-repeat;
cursor: pointer;
height: 40px !important;
padding: 0;
vertical-align: middle;
white-space: nowrap;
width: 620px;
}
</style>
<link href="<?php echo $SITE_URL;?>/include/addons/uploader/js/fileuploader.css" />
<script type="text/javascript" src="<?php echo $SITE_URL;?>/include/addons/uploader/js/fileuploader.js"></script>

<table class="browser">
	<tr>
	    <td>Name</td>
	    <td>Type</td>
	    <td>Dimensions</td>
	    <td>Date</td>
	    <td>Delete</td>
	</tr>
	<tr>
	    <td>
		<p id="pPathDisplay" class="pPathDisplay">Loading...</p>
	    </td>
	</tr>
	<tr>
	    <td>
		<div id="dvContents" class="dvContents">&nbsp;</div>
	    </td>
	</tr>
</table>
		<div id="show_image"></div>

<div id="upload-button-logo2"></div>
 <script>
 function deleteBanner(id, yesno){
 
      if(!yesno){
	  $('#alert_delete').html('<p>Confirm that you would like to delete' + id + '<br /><button value="No" onclick="javascript: $(\'#alert_delete\').dialog(\'destroy\');">No</button><button value="Yes" onclick="javascript: deleteBanner(\'' + id + '\', \'yes\'); $(\'#alert_delete\').dialog(\'destroy\');">Yes</button>');
	  $('#alert_delete').dialog();
      }else{
      
	    $.post('<?php echo $SITE_URL; ?>/backendadmin/DESIGN/search_dir.php?delete=' + id, function(){
	    
	    init();
	    
	    
	    });
      
      }
 
 
 }
     
function createUploader(divId){
  
    if(divId){
	element = divId;
    }else{
    
	element = 'upload-button-logo';
    }     
          

 var uploader = new qq.FileUploader({

    // pass the dom node (ex. $(selector)[0] for jQuery users)

    element: document.getElementById(element),
    // path to server-side upload script
      action: '<?php echo str_replace("backendadmin", "", $_SITE_URL);?>include/addons/uploader/uploadify.php',
    // validation
// ex. ['jpg', 'jpeg', 'png', 'gif'] or []
allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
// each file size limit in bytes
// this option isn't supported in all browsers
sizeLimit: 0, // max size
minSizeLimit: 0, // min size
// set to true to output server response to console
debug: true,

 
    params: { 
	      'type': 'banner', 
	      
	      <?php if(file_exists("$BASE_DIR/include/addons/slider/$template/img/")){ ?>
	      'path': '<?php echo $BASE_DIR;?>/include/addons/slider/<?php echo $template;?>/img/'},
	      <?php }else{ ?>
	      
	      'path': '<?php echo $BASE_DIR;?>/uploads/banner/'},
	      <?php } ?>

    onSubmit: function(id, fileName){


	},

    onProgress: function(id, fileName, loaded, total){
	var progress = (loaded / total) * 100;


// $("#progress-<?php echo $_GET['type'];?>").progressbar({value: progress})


    },
        onComplete: function(id, fileName, responseJSON){ 
	//if(responseJSON.responseText){
	
	//}
	$("#progress-<?php echo $_REQUEST['type'];?>").html(responseJSON);

 //complete_<?php echo $_GET['type'];?>( $("logo-width").val(), $("logo-height").val());
	    init();

	  },
        onCancel: function(id, fileName){},
        // messages
          messages: {
            typeError: "{file} has invalid extension. Only {extensions} are allowed.",
            sizeError: "{file} is too large, maximum file size is {sizeLimit}.",
            minSizeError: "{file} is too small, minimum file size is {minSizeLimit}.",
            emptyError: "{file} is empty, please select files again without it.",
            onLeave: "The files are being uploaded, if you leave now the upload will be cancelled."
        },
    showMessage: function(message, fileName, extensions, sizeLimit, minSizeLimit){
	    alert(message);
      },
      

});
      }

      createUploader('upload-button-logo2');
 </script>
<script>

init();
</script>
<div id="alert_delete" style="display:none;"></div>