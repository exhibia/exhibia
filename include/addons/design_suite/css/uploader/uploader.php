<div id="upload-button-logo">
		<noscript>
			<p>Please enable JavaScript to use file uploader.</p>
			<!-- or put a simple form for upload here -->
		</noscript>
	</div>

    <script type="text/javascript">
        function createUploader(){
            var uploader = new qq.FileUploader({

    // pass the dom node (ex. $(selector)[0] for jQuery users)
    element: document.getElementById('upload-button-logo'),
    // path to server-side upload script
      action: '<?php echo $_SITE_URL;?>addons/uploader/uploadify.php',
    // validation
// ex. ['jpg', 'jpeg', 'png', 'gif'] or []
allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
// each file size limit in bytes
// this option isn't supported in all browsers
sizeLimit: 0, // max size
minSizeLimit: 0, // min size
// set to true to output server response to console
debug: true,
multiple: false,
  params: {'type': '<?php echo $_GET['type'];?>'},
    onSubmit: function(id, fileName){


	},

    onProgress: function(id, fileName, loaded, total){
	var progress = (loaded / total) * 100;


 $("#progress-<?php echo $_GET['type'];?>").progressbar({value: progress})


    },
        onComplete: function(id, fileName, responseJSON){ $("#progress-<?php echo $_GET['type'];?>").html('file has been uploaded');

 complete_<?php echo $_GET['type'];?>( $("logo-width").val(), $("logo-height").val());





   

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
}

});
      }

        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load
       createUploader();
    </script>