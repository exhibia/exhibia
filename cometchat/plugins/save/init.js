<?php

		include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR."en.php");

		if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php")) {
			include_once(dirname(__FILE__).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php");
		}

		foreach ($save_language as $i => $l) {
			$save_language[$i] = str_replace("'", "\'", $l);
		}
?>

/*
 * CometChat
 * Copyright (c) 2012 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

(function($){   
  
	$.ccsave = (function () {

		var title = '<?php echo $save_language[0];?>';
		var chatroommode = 0;

        return {

			getTitle: function() {
				return title;	
			},

			init: function (id, mode) {	
				if(typeof(mode) !== "undefined") {
					chatroommode = mode;
				}

				if ($("#cometchat_user_"+id+"_popup .cometchat_tabcontenttext").html() != '') {

					var currentTime = new Date();
					var monthNames = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun",
					"July", "Aug", "Sep", "Oct", "Nov", "Dec" ];
					var month = currentTime.getMonth();
					var day = currentTime.getDate();
					var year = currentTime.getFullYear();
					var today = monthNames[month] + " " + day + "th " + year;
					var username = $.cometchat.getName(id);
					var filename = 'Conversation with '+username+' on '+today;
					baseUrl = $.cometchat.getBaseUrl();
					baseData = $.cometchat.getBaseData();
                                        var settings = jqcc.cometchat.getSettings();
                                        if (settings.theme == 'hangout') {
                                            var other = $("#cometchat_user_"+id+"_popup .cometchat_name").text();
                                            $("#cometchat_user_"+id+"_popup .cometchat_other").before('<div class="cc_newline"  style="display:none">\n'+other+': <\div>');
                                            $("#cometchat_user_"+id+"_popup .cometchat_self").before('<div class="cc_newline"  style="display:none">\nMe: <\div>');
                                            $('.cometchat_other .cometchat_smiley').each(function(key,value){
                                                            $(this).before('<div class="cc_newline_smile"  style="display:none">('+$(this).attr('title')+')<\div>');
                                            });
                                            $('.cometchat_self .cometchat_smiley').each(function(key,value){
                                                            $(this).before('<div class="cc_newline_smile"  style="display:none">('+$(this).attr('title')+')<\div>');
                                            });
                                            var content = $("#cometchat_user_"+id+"_popup .cometchat_tabcontenttext").text();
                                            $('.cc_newline').remove();
                                            $('.cc_newline_smile').remove();
                                            $('.cc_saveconvoframe').remove();
                                        } else {
                                            $("#cometchat_user_"+id+"_popup .cometchat_chatboxmessage").before('<div class="cc_newline"  style="display:none">\n<\div>');
                                            $('.cometchat_chatboxmessage .cometchat_smiley').each(function(key,value){
                                                            $(this).before('<div class="cc_newline_smile"  style="display:none">('+$(this).attr('title')+')<\div>');
                                            });
                                            var content = $("#cometchat_user_"+id+"_popup .cometchat_tabcontenttext").text();
                                            $('.cc_newline').remove();
                                            $('.cc_newline_smile').remove();
                                            $('.cc_saveconvoframe').remove();
                                        }
					var iframe = $('<iframe id="cc_saveconvoframe'+id+'" class="cc_saveconvoframe" frameborder="0" style="width: 1px; height: 1px; display: none;"></iframe>').appendTo('body');
			
					setTimeout(function(){						 
						var formHTML = '<form action="" method="post">'+
						'<input type="hidden" name="username" />'+
						'<input type="hidden" name="content" />'+
						'<input type="hidden" name="filename" />'+
						'</form>';
						var body = (iframe.prop('contentDocument') !== undefined) ?
									iframe.prop('contentDocument').body :
									iframe.prop('document').body;
						body = $(body);
						body.html(formHTML);
						var form = body.find('form');
						form.attr('action',baseUrl+'plugins/save/index.php?id='+id+'&basedata='+baseData);
						form.find('input[name=username]').val(username);
						form.find('input[name=content]').val(content);
						form.find('input[name=filename]').val(filename);
						form.submit();
					},50);
				} else {
					alert('<?php echo $save_language[1];?>');
				}
				
			}

        };
    })();
 
})(jqcc);