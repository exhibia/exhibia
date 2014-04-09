var CK_siteurl = 'http://' + window.location.host;
if(!template){
var template  = 'pas';
}

CKEDITOR.editorConfig = function(config) {
 
   CKEDITOR.config.filebrowserBrowseUrl = CK_siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/browse.php?type=files';
   CKEDITOR.config.filebrowserImageBrowseUrl = CK_siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/browse.php?type=images';
   CKEDITOR.config.filebrowserFlashBrowseUrl = CK_siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/browse.php?type=flash';
   CKEDITOR.config.filebrowserUploadUrl = CK_siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/upload.php?type=files';
   CKEDITOR.config.filebrowserImageUploadUrl = CK_siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/upload.php?type=images';
   CKEDITOR.config.filebrowserFlashUploadUrl = CK_siteurl + '/backendadmin/js/ckeditor/kcfinder-2.51/upload.php?type=flash';
   CKEDITOR.config.baseFloatZIndex = '99999999999';
   CKEDITOR.config.skin = 'moono';
   
	    CKEDITOR.config.width = 800;
	    CKEDITOR.config.height = 222;
		
	    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;


};



   