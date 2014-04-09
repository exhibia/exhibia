<?php
		include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."config.php");
		include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR."en.php");

		if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php")) {
			include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php");
		}

		foreach ($smilies_language as $i => $l) {
			$smilies_language[$i] = str_replace("'", "\'", $l);
		}
?>

/*
 * CometChat
 * Copyright (c) 2012 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function($){   
  
	$.ccsmilies = (function () {
	
		var title = '<?php echo $smilies_language[0];?>';
		var height = <?php echo $smlHeight;?>;
		var width = <?php echo $smlWidth;?>;
		var chatroommode = 0;

        return {

			getTitle: function() {
				return title;	
			},

			init: function (id,mode) {
				if(typeof(mode) !== "undefined") {
					chatroommode = mode;
				}

				if (chatroommode != 0) {
					baseUrl = $.cometchat.getBaseUrl();
					basedata = $.cometchat.getBaseData();
					$[$.cometchat.getChatroomVars('calleeAPI')].loadCCPopup(baseUrl+'plugins/smilies/index.php?chatroommode=1&id='+id+'&basedata='+basedata, 'smilies',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=0, width=<?php echo $smlWidth;?>,height=<?php echo $smlHeight;?>",width,height-50,'<?php echo $smilies_language[1];?>');  

				} else {
					baseUrl = $.cometchat.getBaseUrl();
					baseData = $.cometchat.getBaseData();
					loadCCPopup(baseUrl+'plugins/smilies/index.php?id='+id+'&basedata='+baseData, 'smilies',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=0, width="+width+",height="+height,width,height-50,'<?php echo $smilies_language[1];?>'); 
				}
			},

			addtext: function (id,text,mode) {
				if(typeof(mode) !== "undefined") {
					chatroommode = mode;
				}
				var string = '';

				if (chatroommode != 0) {

					string = $('#currentroom .cometchat_textarea').val();
					if (string.charAt(string.length-1) == ' ') {
						$('#currentroom .cometchat_textarea').val($('#currentroom .cometchat_textarea').val()+text);
					} else {
						if (string.length == 0) {
							$('#currentroom .cometchat_textarea').val(text);
						} else {
							$('#currentroom .cometchat_textarea').val($('#currentroom .cometchat_textarea').val()+' '+text);
						}
					}
					
					$('#currentroom .cometchat_textarea').focus();
				
				} else {
			
					jqcc.cometchat.chatWith(id);
					var activeId = $.cometchat.getActiveId();
					if (parseInt(activeId) > 0) {
						id = activeId;
					}
									
					string = $('#cometchat_user_'+id+'_popup .cometchat_textarea').val();
					
					if (string.charAt(string.length-1) == ' ') {
						$('#cometchat_user_'+id+'_popup .cometchat_textarea').val(string+text);
					} else {
						if (string.length == 0) {
							$('#cometchat_user_'+id+'_popup .cometchat_textarea').val(text);
						} else {
							$('#cometchat_user_'+id+'_popup .cometchat_textarea').val(string+' '+text);
						}
					}
					
					$('#cometchat_user_'+id+'_popup .cometchat_textarea').focus();

				}
				
			}

        };
    })();
 
})(jqcc);
