// JavaScript Document

// part of functions.js
var GlobalVar = 0;
var GlobalStat = 0;

function changeimage(id) {
    var idnew = 1;
    for (idnew=1; idnew<=4; idnew++) {
        if ( idnew==id ) {
            document.getElementById('mainimage'+idnew).style.display='block';
        } else {
            document.getElementById('mainimage'+idnew).style.display='none';
        }
    }
}

function hidedisplayzoom(div_id) {
    document.getElementById(div_id).style.display = 'block';
    if ( document.getElementById('zoomimagename').innerHTML!="" && document.getElementById('zoomimagename').innerHTML!=div_id ) {
        document.getElementById(document.getElementById('zoomimagename').innerHTML).style.display	= 'none';
    }
    document.getElementById('zoomimagename').innerHTML = div_id;
}

function closezoomimage(div_id) {
    document.getElementById(div_id).style.display='none';
}

function calc_counter_from_time(diff) {
    if (diff > 0) {
        hours=Math.floor(diff / 3600)
        minutes=Math.floor((diff / 3600 - hours) * 60)
        seconds=Math.round((((diff / 3600 - hours) * 60) - minutes) * 60)
    } else {
        hours = 0;
        minutes = 0;
        seconds = 0;
    }

    if (seconds == 60) {
        seconds = 0;
    }

    if (minutes < 10) {
        if (minutes < 0) {
            minutes = 0;
        }
        minutes = '0' + minutes;
    }

    if (seconds < 10) {
        if (seconds < 0) {
            seconds = 0;
        }
        seconds = '0' + seconds;
    }

    if (hours < 10) {
        if (hours < 0) {
            hours = 0;
        }
        hours = '0' + hours;
    }
    return hours + ":" + minutes + ":" + seconds;
}

var xmlhttp = false;
//Check if we are using IE.
/*try {
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
    try {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    } catch (E) {
        xmlhttp = false;
    }
}*/

//If we are using a non-IE browser, create a JavaScript instance of the object.
if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
  try {
    xmlhttp = new XMLHttpRequest();
  }catch(p){}
}

var changeMessageTimer;
function changedatabutler(data, page, butlerpbids) {
    
    var blockst = 0;
    //alert(data.butlerslength.length);
    data1 = eval('(' + data.responseText + ')');
    for (j=0; j<data.butlerslength.length; j++) {
        if (data.butlerslength[j].bidbutler.startprice!="") {
            if (Number(j)<Number(data.butlerslength.length)) {
                butlerstartprice =  CurrencySymbol +  data.butlerslength[j].bidbutler.startprice;
                butlerendprice =  CurrencySymbol +  data.butlerslength[j].bidbutler.endprice;
                butlerbid = data.butlerslength[j].bidbutler.bids;
                but_id = data.butlerslength[j].bidbutler.id;
                blockst = 1;
            } else {
                butlerstartprice = "&nbsp;";
                butlerendprice = "&nbsp;";
                butlerbid ="&nbsp;";
                but_id = "";
                blockst = 0;
            }
        } else {
            butlerstartprice = "&nbsp;";
            butlerendprice = "&nbsp;";
            butlerbid ="&nbsp;";
            but_id = "";
            blockst = 0;
        }

        var k = j+1;

        $('#mainbutlerbody_' + k).css('display', 'table-row');
        $('#butlerstartprice_' + k).html(butlerstartprice);
        $('#butlerendprice_' + k).html(butlerendprice);
        $('#butlerbids_' + k).html(butlerbid);

        if (blockst==1) {
            $('#deletebidbutler_' + k).css('display', 'table-cell');
            $('#deletebidbutler_' + k).html("<img src='images/btn_closezoom.png' style='cursor: pointer;' onclick='DeleteBidButler(\""+but_id+"\",\"" + k + "\");' id='butler_image_" + k +"' />");


        } else {
            $('#deletebidbutler_' + k).css('display', 'none');
        }
    }


    for (p=data.butlerslength.length+1; p<=20; p++) {
        $('#mainbutlerbody_' + p).css('display','none');
//        if(document.getElementById('mainbutlerbody_' + p)!=null){
//            document.getElementById('mainbutlerbody_' + p).style.display = 'none';
//        }
    }

    //alert(data.butlerslength.length);
    if(data.butlerslength.length>0){
        //alert($('#live_no_bidbutler').css('display'));
        $('#live_no_bidbutler').css('display','none');
//        if(document.getElementById('live_no_bidbutler')!=null){
//            document.getElementById('live_no_bidbutler').style.display = 'none';
//        }
    }else{
        //alert($('#live_no_bidbutler').css('display'));
        $('#live_no_bidbutler').css('display','block');
//        if(document.getElementById('live_no_bidbutler')!=null){
//            document.getElementById('live_no_bidbutler').style.display = 'table-row';
//        }
    }
//alert('b');

    changeMessageTimer = setInterval("ChangeButlerImageSecond()",3000);
	
    if (page=="abut") {
        if (butlerpbids!="&nbsp;") {
            if (document.getElementById("useonlyfree").innerHTML == "1") {
                objbids = document.getElementById('free_bids_count');
                if(objbids!=null){
                    objbidsvalue = document.getElementById('free_bids_count').innerHTML;
                }
            } else {
                objbids = document.getElementById('bids_count');
                if(objbids!=null){
                    objbidsvalue = document.getElementById('bids_count').innerHTML;
                }
            }
	
            if (objbids!=null && objbids.innerHTML!='0') {
                objbids.innerHTML = Number(objbidsvalue) - Number(butlerpbids);
            }
        }
    }
    
}

function ChangeButlerImageSecond() {
    if(document.getElementById('butlermessage')!=null){
        document.getElementById('butlermessage').style.display='none';
    }
    if(changeMessageTimer){
        clearInterval(changeMessageTimer);
    }
}

function calc_counter_from_time_new(TimerID) {
    var tmp=TimerID;
    var days=Math.floor(tmp/(24*60*60));
    tmp=tmp-(24*60*60)*days;
    var hours=Math.floor(tmp/(60*60));
    tmp=tmp-(60*60)*hours;
    var minutes=Math.floor(tmp/(60));
    tmp=tmp-(60)*minutes;
    var secs=Math.floor(tmp);
	
    if (hours<=9 && hours>0) {
        hours = "0" + hours;
    }
    if (minutes<=9 && minutes>0) {
        minutes = "0" + minutes;
    }
    if (secs<=9) {
        secs = "0" + secs;
    }
    if (days>0) {
        return days + "d " + hours + "h " + minutes + "m " + secs + "s";
    } else {
        return hours + "h " + minutes + "m " + secs + "s";
    }
}
