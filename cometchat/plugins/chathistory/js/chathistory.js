<?php

include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR."en.php");

if (file_exists(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php")) {
    include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."lang".DIRECTORY_SEPARATOR.$lang.".php");
}
foreach ($chathistory_language as $i => $l) {
    $chathistory_language[$i] = str_replace("'", "\'", $l);
}
?>/*
 * CometChat 
 * Copyright (c) 2012 Inscripts - support@cometchat.com | http://www.cometchat.com | http://www.inscripts.com
*/

var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

function getTimeDisplay(ts) {
	var ap = "";
	var hour = ts.getHours();
	var minute = ts.getMinutes();
	var todaysDate = new Date();
	var todaysDay = todaysDate.getDate();
	var date = ts.getDate();
	var month = ts.getMonth();

	if (hour > 11) { ap = "pm"; } else { ap = "am"; }
	if (hour > 12) { hour = hour - 12; }
	if (hour == 0) { hour = 12; }

	if (minute < 10) { minute = "0" + minute; }

	var type = 'th';
	if (date == 1 || date == 21 || date == 31) { type = 'st'; }
	else if (date == 2 || date == 22) { type = 'nd'; }
	else if (date == 3 || date == 23) { type = 'rd'; }

	if (date != todaysDay) {
		return hour+":"+minute+ap+' '+date+type+' '+months[month];
	} else {
		return hour+":"+minute+ap;
	}
}

function getChatLog(id, chatroommode, basedata) {
    jqcc.ajax({
        url: "chathistory.php?action=logs",
        data: {history: id, chatroommode: chatroommode, basedata: basedata},
        type: 'post',
        dataType: 'json',
        async: false,
        timeout: 10000,
        success: function(data) {
            if(data != '0') {
                temp = '';
                jqcc.each(data, function(type, item) {
                    temp = '<div class="chat" id="'+item.id+'|'+item.previd+'" title="<?php echo $chathistory_language[8];?>"><div class="chatrequest"><b>'+item.from+'</b></div><div class="chatmessage chatmessage_short">'+item.message+'</div><div class="chattime" timestamp='+item.sent+'></div><div style="clear:both"></div></div>' + temp;                                                 });           
                jqcc('.container_body_chat').html('<div id ="logs">'+temp+'</div>');
                jqcc(".container_body_chat #logs").slimScroll({height: '460px'});
                jqcc(".container_body_chat #logs").css({height: '460px'});
                jqcc(".container_body_chat #logs").css({width: 'auto'});
                jqcc('.chattime').each(function(key,value) {
                    var ts = new Date(jqcc(this).attr('timestamp') * 1000);
                    var timest = getTimeDisplay(ts);
                    jqcc(this).html(timest);
                });

                jqcc('.chat').click(function() {				
                    var range = jqcc(this).attr('id');
                    getChatLogView(id, range, chatroommode, basedata);	
                });
            } else {
                jqcc('.container_body_chat').html(norecords);
            }
        }, error: function(data) {
        }
    });
}

function getChatLogView(id, range,chatroommode, basedata) {
    var temp = '<div class="chatbar"><div class="chatbar_1"></div><div class="chatbar_2"><a href="index.php?chatroommode='+chatroommode+'&logs=1&history='+id+'&basedata='+basedata+'&embed=web"><?php echo $chathistory_language[5];?></a></div><div style="clear:both"></div></div><div class="chatbar_body" id="chat_body"></div><div class="chathistory" title="<?php echo $chathistory_language[10];?>"><span><?php echo $chathistory_language[10];?></span><span class="arrowdown"></span></div>';
    jqcc('.container_body_chat').html(temp);	
    jqcc(".chatbar_body").slimScroll({height: '410px'});
    jqcc(".chatbar_body").css({height: '410px'});
    jqcc(".chatbar_body").css({width: 'auto'});
    getMessage(id, range,chatroommode, basedata);
}

function getMessage(id, range,chatroommode, basedata, lastmessageid) {
        var previousid = 0;
        var name = '';
        var time = '';
        var count = 0;
        var temp = '';
        if(typeof(lastmessageid) == 'undefined') {
            lastmessageid = 0;
        }
	jqcc.ajax({
            url: "chathistory.php?action=logview",
            data: {history: id, range: range, chatroommode: chatroommode, basedata:basedata, lastidfrom: lastmessageid},
            type: 'post',
            dataType: 'json',
            async: true,
            timeout: 10000,
            success: function(data) {
                var i = 0;
                jqcc.each(data, function(type, item){
                        temp += '<div class="chat chatnoline" id="'+item.id+'"><div class="chatrequest"><b>'+item.from+'</b></div><div class="chatmessage chatnowrap">'+item.message+'</div><div class="chattime" timestamp='+item.sent+'></div><div style="clear:both"></div></div>';
                        previousid = item.previd;
                        name = item.requester;
                        time = item.sent;
                        i++;
                        userid = item.userid;
                });
                jqcc('#chat_body').append(temp);
                count = jqcc('#messageCount').text();
                if(count == '') {
                        count = i;
                } else {
                        count = parseInt(count)+parseInt(i);
                }

                jqcc('.chatbar_1').html('<?php echo $chathistory_language[2];?> '+ name +' <?php echo $chathistory_language[4];?> <small class="chattimedate" timestamp="'+time+'"></small> (<span id="messageCount">'+count+'</span> <?php echo $chathistory_language[3];?>)');
                jqcc('.chattime').each(function(key,value) {
                var ts = new Date(jqcc(this).attr('timestamp') * 1000);
                var timest = getTimeDisplay(ts);
                jqcc(this).html(timest);
                });


                jqcc( ".chathistory" ).click(function() {
                var lastidfrom = parseInt(jqcc('.chatnoline:last').attr('id'))+1; 
                        getMessage(id,lastidfrom+'|'+previousid,chatroommode,basedata,userid);
                        jqcc( ".chathistory" ).unbind('click');
                });


                var cometchat_chathistory = jqcc('.chatbar_body');
                        cometchat_chathistory.scrollTop(
                        cometchat_chathistory[0].scrollHeight - cometchat_chathistory.height()
                );

                jqcc('.chattimedate').each(function(key,value){
                    var ts = new Date(jqcc(this).attr('timestamp') * 1000);
                    jqcc(this).html(months[ts.getMonth()]+' '+ts.getDate()+'th '+ts.getFullYear());
                });

                if(i < 13) {
                        jqcc( ".chathistory" ).unbind('click');
                        jqcc('.chathistory').html(norecords);
                        jqcc('.chathistory').attr('title', ' <?php echo $chathistory_language[9];?>');
                }
            }, error: function(data) {}
	});
}