<?php

		include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR."en.php");

		if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php")) {
			include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php");
		} 

		foreach ($chathistory_language as $i => $l) {
			$chathistory_language[$i] = str_replace("'", "\'", $l);
		}
?>

/*
 * CometChat
 * Copyright (c) 2012 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function($){   
  
	$.ccchathistory = (function () {

		var title = '<?php echo $chathistory_language[0];?>';
		var chatroommode = 0;

        return {

			getTitle: function() {
				return title;	
			},

			init: function (id, mode) {
				if(typeof(mode) !== "undefined") {
					chatroommode = mode;
				}

				if (chatroommode != 0) {
					baseUrl = $.cometchat.getBaseUrl();
					basedata = $.cometchat.getBaseData();			
					$[$.cometchat.getChatroomVars('calleeAPI')].loadCCPopup(baseUrl+'plugins/chathistory/index.php?embed=web&chatroommode=1&logs=1&history='+id+'&basedata='+basedata, 'chathistory',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=0,width=650,height=480",650,480,'<?php echo $chathistory_language[6];?>');				
				} else {
					baseUrl = $.cometchat.getBaseUrl();
					baseData = $.cometchat.getBaseData();
					loadCCPopup(baseUrl+'plugins/chathistory/index.php?embed=web&history='+id+'&logs=1&basedata='+baseData, 'chathistory',"status=0,toolbar=0,menubar=0,directories=0,resizable=0,location=0,status=0,scrollbars=1, width=650,height=480",650,480,'<?php echo $chathistory_language[6];?>'); 
				}
			}

        };
    })();
 
})(jqcc);