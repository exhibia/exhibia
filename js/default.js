var flipflop=1;
var storedata;
var auctionUpdateTime = 1000;
var counterUpdateTime = 1000;
var auctiondata = new Array();
var getStatusUrl;
var lastsendtime;
var GlobalVar = 0;
var reloadWhenEnd=false;
var shown;
var num_auctions;
var ajaxTimeOut;
var color;

  color = '#000000';

var sold_color;
if(sold_color == 'null' || sold_color == ''){
  sold_color = 'red';
}
shown = new Array();
var lastmovetime=new Date();

if (typeof console == "undefined") {
    this.console = { log: function() {}};
}


function initialize_bid_buttons(){
  
 $('.button, .bid-button-link').click(function() {
        //alert('a');
	var id = $(this).attr('id');
	
        var url=$(this).attr('name');
	
	var auc_id = $('#' + id).closest($('.auction-item'));
	   
	aid = auc_id.attr('title');
	
	if(document.getElementById('productID-hidden_' + aid)){
	  url += '&similar=' + $('#productID-hidden_' + aid).val();
	
	}
	 //prompt(url);
	// prompt('test');
        place_bid(url);
	  
	return;
    });	
     $('.ubid-button-link').click(function(){
        var aname=$(this).attr('name');

        if(aname==''){
            return;
        }

        var id=$(this).attr('rel');
        var price=$('#lowestprice_'+id).val();
        if(isNaN(price)==true || Number(price)<0.00){
            //alert('Invalid Price');
            showInvalidPrice();
            return;
        }

        $.ajax({
            url: siteurl+aname+"&bidprice="+price,
            dataType: 'json',
            success: function(data) {

                $.each(data, function(i, item) {
                    result = item.result;

                    //alert(result[0]);

                    if (result=="unsuccess") {
		      console.log(item.message);
                        showAlertBox(item.message);
                    }else if(result=='nobids'){
                        showConfirmBox(item.message);
                    }
                 
                    if (result=="success") {
                        $('#lowestprice_'+id).val('');
			
			
			
		
		 if(item.cashauction != 1){
                        if (item.freebids==1) {

                            //obj = document.getElementById('free_bids_count');
                            //objvalue = document.getElementById('free_bids_count').innerHTML;
                            if ($('#free_bids_count').html()!='0') {
                                $('#free_bids_count').html($('#free_bids_count').html()-1);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
			
                        } else {
			
                            //obj = document.getElementById('bids_count');
                            //objvalue = document.getElementById('bids_count').innerHTML;
                            if ($('#bids_count').html()!='0') {
                                $('#bids_count').html($('#bids_count').html()-1);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
                             
                             if (item.freebids!='0') {
                                $('#free_bids_count').html(item.freebids);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
                            
			  }
                        
                    }

		    }
                });
            },
            error: function(XMLHttpRequest,textStatus, errorThrown) { }
        });
        
    });

     $('.ubid-button-link').click(function(){
        var aname=$(this).attr('name');

        if(aname==''){
            return;
        }

        var id=$(this).attr('rel');
        var price=$('#lowestprice_'+id).val();
        if(isNaN(price)==true || Number(price)<0.00){
            //alert('Invalid Price');
            showInvalidPrice();
            return;
        }

        $.ajax({
            url: siteurl+aname+"&bidprice="+price,
            dataType: 'json',
            success: function(data) {

                $.each(data, function(i, item) {
                    result = item.result;

                    //alert(result[0]);

                    if (result=="unsuccess") {
		      console.log(item.message);
                        showAlertBox(item.message);
                    }else if(result=='nobids'){
                        showConfirmBox(item.message);
                    }
                 
                    if (result=="success") {
                        $('#lowestprice_'+id).val('');
			
			
			
		
		 if(item.cashauction != 1){
                        if (item.freebids==1) {

                            //obj = document.getElementById('free_bids_count');
                            //objvalue = document.getElementById('free_bids_count').innerHTML;
                            if ($('#free_bids_count').html()!='0') {
                                $('#free_bids_count').html($('#free_bids_count').html()-1);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
			
                        } else {
			
                            //obj = document.getElementById('bids_count');
                            //objvalue = document.getElementById('bids_count').innerHTML;
                            if ($('#bids_count').html()!='0') {
                                $('#bids_count').html($('#bids_count').html()-1);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
                             
                             if (item.freebids!='0') {
                                $('#free_bids_count').html(item.freebids);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
                            
			  }
                        
                    }

		    }
                });
            },
            error: function(XMLHttpRequest,textStatus, errorThrown) { }
        });
        
    });   


}

function doBlink() {
	var blink = document.all.tags("blink")
	for (var i=0; i<blink.length; i++)
		blink[i].style.visibility = blink[i].style.visibility == "" ? "hidden" : ""
}

function startBlink() {
	if (document.all)
		setInterval("doBlink()",1000)
}


  function is_null(input){
    return input==null;
  }

function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}


function flip_auction_type(auction_id, prid){

  
  if(userid != ''){
    
    
  //  $("#image_main_" + auction_id).attr("class", "bidonme_orange bid-button-link bid btn_bid_normal_view_normal");
    $("#image_main_" + auction_id).attr("name", "getbid.php?prid=" + prid + "&aid=" + auction_id + "&uid=" + userid);
    
    document.getElementById("image_main_" + auction_id).innerHTML = "Bid";
    
    
    $("#image_main_" + auction_id).click( function(){
        var url=$("#image_main_" + auction_id).attr('name');
        if(url=='')
            return;
        $.ajax({            
            url: siteurl+url,
            dataType: 'json',
            success: function(data) {
				
                $.each(data, function(i, item) {
                    result = item.result;
					
                    //alert(result[0]);
					
                  
                    if (result=="success") {
		   
		      if(item.cashauction != 1){
                        if (item.freebids==1) {

                            //obj = document.getElementById('free_bids_count');
                            //objvalue = document.getElementById('free_bids_count').innerHTML;
                            if ($('#free_bids_count').html()!='0') {
                                $('#free_bids_count').html(item.freebids);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
                        } else {
                            //obj = document.getElementById('bids_count');
                            //objvalue = document.getElementById('bids_count').innerHTML;
                            if ($('#bids_count').html()!='0') {
                                $('#bids_count').html($('#bids_count').html()-1);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
                            
                             if (item.freebids!='0') {
                                $('#free_bids_count').html(item.freebids);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
                        }
                    }
		    }
                });
            },
            error: function(XMLHttpRequest,textStatus, errorThrown) { }
        });

        return false;
    });
    

} 
  
}
function OnloadPage(){
  
												      
    auctionUpdateTime=reloadWhenEnd==true?refreshRate/2 : refreshRate;
    
        $.ajaxSetup({
            cache: false,
            timeout:ajaxTimeOut
        });	//Configuring ajax
   

    var firstauction=true;
    
    i=0
    $('.auction-item').each(function() {
	var id = $(this).attr('id');
	
	var auctionTitle = $('#' + id).attr('title');
	if(!$('#' + id).hasClass('sold')){
	 auctiondata[i++] = auctionTitle;
	}
         firstauction=false;
    });

    
    
    if(auctiondata.length>0){
	getStatusUrl = 'update_info.php?flp=' + flipflop;

     setTimeout('updateAuctionInfo();', auctionUpdateTime);
    }else{
	  my_house = $('#auctions_holder').html();
	  if(my_house){
	      $.get('get_new_auctions.php?number=' + $('#max_auctions').html(), function(response){
		$('#' + my_house).html(response);
		setTimeout('updateAuctionInfo();', auctionUpdateTime);
	      });
	  }
    }

}


function place_bid(url){
  if(url==''){
            return;
	    
	}else{

        $.ajax({            
            url: siteurl+url,
            dataType: 'json',
            success: function(data) {
				
                $.each(data, function(i, item) {
		    
                    result = item.result;
					
                    //alert(result[0]);
					
                    if (result=="unsuccess") {
		      console.log(item.message);
                        showAlertBox(item.message);
                    }else if(result=='nobids'){
                        showConfirmBox(item.message);
                    }else
                    if (result=="success") {
		   
		      if(item.cashauction != 1){
                        if (item.freebids==1) {

                            //obj = document.getElementById('free_bids_count');
                            //objvalue = document.getElementById('free_bids_count').innerHTML;
                            if ($('#free_bids_count').html()!='0') {
                                $('#free_bids_count').html($('#free_bids_count').html()-1);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
                        } else {
                            //obj = document.getElementById('bids_count');
                            //objvalue = document.getElementById('bids_count').innerHTML;
                            if ($('#bids_count').html()!='0') {
                                $('#bids_count').html($('#bids_count').html()-1);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
                             
                             if (item.freebids!='0') {
                                $('#free_bids_count').html(item.freebids);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
                        }
                    }
                    
		    }
		 //   prompt(item.username);
		 
		 if(item.username != ''){
                   // $('#product_bidder_' + item.id).html(item.username);
		    
		 }
                });
            },
            error: function(XMLHttpRequest,textStatus, errorThrown) { }
        });

        return false;
	}
}
	
	
	
function buy_seat(url){
  

        //alert('a');
        $.ajax({
            url: siteurl+url,
            dataType: 'json',
            success: function(data) {

                $.each(data, function(i, item) {
                    result = item.result;

                    //alert(result[0]);

                    if (result=="unsuccess") {
		      console.log(item.message);
                        showAlertBox(item.message);
                    }else if(result=='nobids'){
                        showConfirmBox(item.message);
                    }

                    if (result=="success") {
		      
		      if(item.cashauction != 1){
                        if (item.freebids==1) {

                            //obj = document.getElementById('free_bids_count');
                            //objvalue = document.getElementById('free_bids_count').innerHTML;
                            if ($('#free_bids_count').html()!='0') {
                                $('#free_bids_count').html($('#free_bids_count').html()-item.bids);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
                        } else {
                            //obj = document.getElementById('bids_count');
                            //objvalue = document.getElementById('bids_count').innerHTML;
                            if ($('#bids_count').html()!='0') {
                                $('#bids_count').html($('#bids_count').html()-item.bids);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
                             
                             if (item.freebids!='0') {
                                $('#free_bids_count').html(item.freebids);
                            //obj.innerHTML = Number(objvalue) - 1;
                            }
                        }
                       if(item.bids_back){
			 $('#bids_back_' + auction_id).html(item.bids_back);
			 
		       }
		       if(item.free_bids){
			 $('#free_bids_' + auction_id).html(item.free_bids);
			 
		       }
                    }
		    }
                });
            },
            error: function(XMLHttpRequest,textStatus, errorThrown) { }
        });

        return false;
  
      
}


function updateHistory(auctionhisid, data){
  var auctionhisid;
  var fontweight;
		
		
  var lastPos,lastName,currentName,currentPos;
  if(data==null || data.message=='failed') return;
  
  $('#tenbiders').html(data.biddercount);
 
  if(parseInt($('#auction_id_history').html()) == parseInt(data.id) & data.history){
  
  for (var i=0; i<data.history.hiss.length; i++) {
     
    
                    biddingprice = data.history.hiss[i].his.bp;
  
                    biddingusername = data.history.hiss[i].his.un;
                    biddingtype = data.history.hiss[i].his.bt;

                    if(i==0){
                        currentName=data.history.hiss[i].his.un;
                        currentPos=data.history.hiss[i].his.latlng;
                    }

                    if(i==1){
                        lastName=data.history.hiss[i].his.un;
                        lastPos=data.history.hiss[i].his.latlng;
                    }


                    if(i==0){
                        fontweight="bold";
                    }else{
                        fontweight="normal";
                    }

                    $("#bid_price_"+i).html(CurrencySymbol + biddingprice);
                    $("#bid_price_"+i).css("font-weight", fontweight);

                    $("#bid_user_name_"+i).html(biddingusername);
                    $("#bid_user_name_"+i).css("font-weight", fontweight);

                    if (biddingtype=='s') {
                        $("#bid_type_"+i).html("Single Bid");
                    //document.getElementById('bid_type_' + i).innerHTML = "Single Bid";
                    } else if (biddingtype=='b') {
                        //document.getElementById('bid_type_' + i).innerHTML = "AutoBidder";
                        $("#bid_type_"+i).html("AutoBidder");
                    } else if (bidding_type=='m') {
                        //document.getElementById('bid_type_' + i).innerHTML = "SMS Bid";
                        $("#bid_type_"+i).html("SMS Bid");
                    }
                    $("#bid_type_"+i).css("font-weight", fontweight);

                }
                if(typeof(updateMarker)=='function'){
                    updateMarker(currentPos,currentName,lastPos,lastName);
                }

                //alert(data.myhistories.length);

                if (data.history.mhiss.length>0) {
                    for (j=0; j<data.history.mhiss.length; j++) {
                        if(j==0){
                            fontweight="bold";
                        }else{
                            fontweight="normal";
                        }

                        biddingprice1 = data.history.mhiss[j].mhis.bp;
                        biddingusername1 = data.history.mhiss[j].mhis.t;
                        biddingtype1 = data.history.mhiss[j].mhis.bt;

                        //document.getElementById('my_bid_price_' + j).innerHTML = "$" +  biddingprice1;
                        $("#my_bid_price_"+j).html(CurrencySymbol +  biddingprice1);

                        $("#my_bid_price_"+j).css("font-weight", fontweight);

                        //document.getElementById('my_bid_time_' + j).innerHTML = biddingusername1;
                        $("#my_bid_time_"+j).html(biddingusername1);
                        $("#my_bid_time_"+j).css("font-weight", fontweight);

                        if (biddingtype1=='s') {
                            $("#my_bid_type_"+j).html("Single Bid");
                        //document.getElementById('my_bid_type_' + j).innerHTML = "Single Bid";
                        } else if (biddingtype1=='b') {
                            $("#my_bid_type_"+j).html("AutoBidder");
                        //document.getElementById('my_bid_type_' + j).innerHTML = "AutoBidder";
                        } else if (biddingtype1=='m') {
                            //document.getElementById('my_bid_type_' + j).innerHTML = "SMS Bid";
                            $("#my_bid_type_"+j).html("SMS Bid");
                        }
                        $("#my_bid_type_"+j).css("font-weight", fontweight);
                    }
                }
                
    }
}

function updateUniqueHistory(auctionhisid, data) {
  oldbids = $('#curproductbids').html();//document.getElementById('curproductprice').innerHTML;
  newbids = $('#ubid_index_page_' + auctionhisid).html();//document.getElementById('price_index_page_' + auctionhisid).innerHTML;
if(data){
 for (var i=0; i<data.history.hiss.length; i++) {
                    username = data.history.hiss[i].his.un;
                    adddate = data.history.hiss[i].his.ad;

                    if(i==0){
                        fontweight="bold";
                    }else{
                        fontweight="normal";
                    }

                    if(i==0){
                        currentName=data.history.hiss[i].his.un;
                        currentPos=data.history.hiss[i].his.latlng;
                    }

                    if(i==1){
                        lastName=data.history.hiss[i].his.un;
                        lastPos=data.history.hiss[i].his.latlng;
                    }

                    $("#bid_user_name_"+i).html(username);
                    $("#bid_user_name_"+i).css("font-weight", fontweight);

                    $("#bid_date_"+i).html(adddate);
                    $("#bid_date_"+i).css("font-weight", fontweight);
                }

                if(typeof(updateMarker)=='function'){
                    updateMarker(currentPos,currentName,lastPos,lastName);
                }

                //alert(data.myhistories.length);

                if (data.history.mhiss.length>0) {
                    for (j=0; j<data.history.mhiss.length; j++) {
                        if(j==0){
                            fontweight="bold";
                        }else{
                            fontweight="normal";
                        }

                        username1 = data.history.mhiss[j].mhis.un;
                        adddate1= data.mhiss[j].mhis.ad;
                        bidprice1= data.mhiss[j].mhis.bp;

                        //document.getElementById('my_bid_price_' + j).innerHTML = "$" +  biddingprice1;
                        $("#my_bid_username_"+j).html(username1);
                        $("#my_bid_username_"+j).css("font-weight", fontweight);

                        $("#my_bid_price_"+j).html(bidprice1);
                        $("#my_bid_price_"+j).css("font-weight", fontweight);

                        //document.getElementById('my_bid_time_' + j).innerHTML = biddingusername1;
                        $("#my_bid_date_"+j).html(adddate1);
                        $("#my_bid_date_"+j).css("font-weight", fontweight);
                    }
                }

	}
                $("#curproductbids").html(newbids);
  runUpdateTimer();

}


function change_auction_info(auction_id, data){
 	    
$("#placebidscount").html(data.totbid);		    
$('#my_new_auc_price').html(parseFloat($('#price_index_page_' + auction_id).html()));
$("#placebidsamount").html(data.totbidprice);
$("#placebidssavingdisp").html(data.saving);                   
$("#newbuynowprice").html(CurrencySymbol + data.buynowprice);
$("#placebidssaving").html(data.saving);
$("#your_savings_" + auction_id).html(data.saving);	
$('#price2').html(data.np);

  
      $('#price_index_page_'+ auction_id).html(data.totbidprice);
      $('#currencysymbol_' + auction_id).html(CurrencySymbol);
      $('#product_bidder_' + auction_id).html(data.hu);
      $('#savings_percent_' + auction_id).html(data.savingpercent + '%');
      
      $('#off_retail_percent_' + auction_id).html(data.savingpercent + '%');
      $('#uid_' + auction_id).html(data.uid);
      $('#savings_' + auction_id).html(data.saving);
      $('#saving_' + auction_id).html(data.saving);
      $('#price_' + auction_id).html(data.saving);
      $('#buynowprice_' + auction_id).html(data.buynowprice);
      $('#fprice_' + auction_id).html(data.fprice);
      $('#your_price_'+auction_id).html(data.your_price);
      
      
      $('#product_avatarimage_' + auction_id).attr('src', data.av);
      
      $('#price_index_page_'+auction_id).html(auction_price);
      
      
      
      $('#bid_bids[title="' + auction_id + '"]').val(data.my_bids);
      $('#bid_from[title="' + auction_id + '"]').val(data.sp);
      $('#bid_to[title="' + auction_id + '"]').val(data.ep);
                           
			
                                $('#seat_count_'+auction_id).html(data.sc);
                                var bpos=(data.sc / data.ms-1)*120;
				
                                $('#seat_bar_'+auction_id).css('background-position', bpos+'px 0px');
				$('#seat_bar_small_'+auction_id).css('background-position',Math.round(parseInt(bpos * .5))+'px 0px');
				
                                if (GlobalVar == 1) {
                                    try{ $('#seat_count_' + auction_id).effect('highlight',options,500); }catch(oo){}
                                }
      // $('#product_tax1_' + auction_id).val(data.tax1);
      //$('#product_tax2_' + auction_id).val(data.tax2);
      $('#product_taxamount_'+auction_id).html(CurrencySymbol + data.taxamount);
     
      var lastPos,lastName,currentName,currentPos;

      
	                       if($('#topbider_index_page_' + auction_id).length>0 ){
                                //PennyAuctionSoft add for top bidder
                               if(data.sa==true && parseInt(data.sc) < parseInt(data.ms)){
				    topbidder=data.seated_users;
				}else{
				  console.log(data.tb);
				  
				  topbidder=data.tb;
				}
                                acls=$('#topbider_index_page_' + auction_id).attr('class');
				
				
                                totalcount=0;
				
                                if(acls.indexOf('i4')>0){
                                    totalcount=4;
                                }else if(acls.indexOf('i3')>0){
                                    totalcount=3;
                                }
                                
                                
                                if(!data.seated_users){
				update_top_bidders(auction_id, data);
                                
				}else{
				  
				update_seat_info(auction_id, data);
                            }
 
  
	  }

}
function change_auction_info_slider(auction_id, data){
 	    
$("#slider-placebidscount").html(data.totbid);		    
$('#slider-my_new_auc_price').html(parseFloat($('#slider-price_index_page_' + auction_id).html()));
$("#slider-placebidsamount").html(data.totbidprice);
$("#slider-placebidssavingdisp").html(data.saving);                   
$("#slider-newbuynowprice").html(CurrencySymbol + data.buynowprice);
$("#slider-placebidssaving").html(data.saving);
$("#slider-your_savings_" + auction_id).html(data.saving);	
$('#slider-price2').html(data.np);

  
      $('#slider-price_index_page_'+ auction_id).html(data.totbidprice);
      $('#slider-currencysymbol_' + auction_id).html(CurrencySymbol);
      $('#slider-product_bidder_' + auction_id).html(data.hu);
      $('#slider-savings_percent_' + auction_id).html(data.savingpercent + '%');
      $('#slider-off_retail_percent_' + auction_id).html(data.savingpercent + '%');
      $('#slider-uid_' + auction_id).html(data.uid);
      $('#slider-savings_' + auction_id).html(data.saving);
      $('#slider-saving_' + auction_id).html(data.saving);
      $('#slider-price_' + auction_id).html(data.saving);
      $('#slider-buynowprice_' + auction_id).html(data.buynowprice);
      $('#slider-fprice_' + auction_id).html(data.fprice);
      $('#slider-your_price_'+auction_id).html(data.your_price);
      
      
      $('#slider-product_avatarimage_' + auction_id).attr('src', data.av);
      
      $('#slider-price_index_page_'+auction_id).html(auction_price);
      
      
      
      $('#slider-bid_bids[title="' + auction_id + '"]').val(data.my_bids);
      $('#slider-bid_from[title="' + auction_id + '"]').val(data.sp);
      $('#slider-bid_to[title="' + auction_id + '"]').val(data.ep);
                           
			
                                $('#slider-seat_count_'+auction_id).html(data.sc);
                                var bpos=(data.sc / data.ms-1)*120;
				
                                $('#slider-seat_bar_'+auction_id).css('background-position', bpos+'px 0px');
				$('#slider-seat_bar_small_'+auction_id).css('background-position',Math.round(parseInt(bpos * .5))+'px 0px');
				
                                if (GlobalVar == 1) {
                                   // try{ $('#slider-seat_count_' + auction_id).effect('highlight',options,500); }catch(oo){}
                                }
      // $('#slider-product_tax1_' + auction_id).val(data.tax1);
      //$('#slider-product_tax2_' + auction_id).val(data.tax2);
      $('#slider-product_taxamount_'+auction_id).html(CurrencySymbol + data.taxamount);
     
      var lastPos,lastName,currentName,currentPos;

      
	                       if($('#slider-topbider_index_page_' + auction_id).length>0 ){
                                //PennyAuctionSoft add for top bidder
                               if(data.sa==true && parseInt(data.sc) < parseInt(data.ms)){
				    topbidder=data.seated_users;
				}else{
				  console.log(data.tb);
				  
				  topbidder=data.tb;
				}
                                acls=$('#slider-topbider_index_page_' + auction_id).attr('class');
				
				
                                totalcount=0;
				
                                if(acls.indexOf('i4')>0){
                                    totalcount=4;
                                }else if(acls.indexOf('i3')>0){
                                    totalcount=3;
                                }
                                
                                
                                if(!data.seated_users){
				update_top_bidders(auction_id, data);
                                
				}else{
				  
				update_seat_info(auction_id, data);
                            }
	  
				 
	  }

}

function update_top_bidders(auction_id, item){
  var item;
  if(totalcount>0 && topbidder!=null){
                                    bidderhtml="";
                                    $.each(topbidder,function(i,bitem){
                                        bidderhtml+='<li><a>'+bitem+'</a></li>';
                                        totalcount--;
                                        if(totalcount==0) return false;
                                    });
                                    for(i=totalcount-1;i>=0;i--){
				      
				      if(is_null(item.seated_users)){
                                        bidderhtml+='<li><a>---</a></li>';
				      }else{
					
					var seats = parseInt(1);
					
					    while(seats<=parseInt(3)){
					  ////console.log(item.seated_users[seats]);
					    if(!is_null(item.seated_users[seats])){
					    bidderhtml+='<li>' + item.seated_users[seats] + '</li>';
					    
					    
					    }else{
					     bidderhtml+='<li><a>---</a></li>';
					      
					    }
					    seats = parseInt(seats) + parseInt(1);
					  }
					
					
					
				      }
                                    }
                                    $('#topbider_index_page_' + auction_id).html(bidderhtml);
                                }
}

function update_seat_info(auction_id, item){
  var item;
    
				  
			      if(totalcount>0 && topbidder!=null){
                                    bidderhtml="";
                                    $.each(topbidder,function(i,bitem){
                                        bidderhtml+='<li><a>'+bitem+'</a></li>';
                                        totalcount--;
                                        if(totalcount==0) return false;
                                    });
                                    for(i=totalcount-1;i>=0;i--){
				      
				      if(is_null(item.seated_users)){
                                        bidderhtml+='<li><a>---</a></li>';
				      }else{
					
					var seats = parseInt(1);
					
					    while(seats<=parseInt(3)){
					  ////console.log(item.seated_users[seats]);
					    if(!is_null(item.seated_users[seats])){
					    bidderhtml+='<li>' + item.seated_users[seats] + '</li>';
					    
					    
					    }else{
					     bidderhtml+='<li><a>---</a></li>';
					      
					    }
					    seats = parseInt(seats) + parseInt(1);
					  }
					
					
					
				      }
                                    }
                                    $('#topbider_index_page_' + auction_id).html(bidderhtml);
                                }
				  
				  
				  
	}


function runUpdateTimer(){
    if((new Date()-lastmovetime)/1000>timeoutvalue && timeoutvalue!=0){
        $( "#timeout_dialog" ).dialog('open');
        return;
    }

    var lefttime=(auctionUpdateTime-(new Date()-lastsendtime));
    
    if(lefttime<=0)
        lefttime=0;
    ////console.log(now+'  '+lastsendtime+'  '+runtime+'  '+lefttime);
    setTimeout('updateAuctionInfo();', lefttime);
}













function DeleteBidButler(id, div_id) {
    $.ajax({
        url: url = siteurl+"deletebutler.php?delid=" + id,
        dataType: 'json',
        success: function(data) {
            $.each(data, function(i, item) {
                result = item.result;
                if (result=="unsuccess") {
                    //alert("Your BidBuddy is running you can't delete it!");
		  console.log(item.message);
                    showAlertBox(item.message);
                } else {
                    placebids = document.getElementById('butlerbids_' + div_id).innerHTML;
                    if ($('.usefreebids').length && document.getElementById('useonlyfree').innerHTML == '1') {
                        objbids = document.getElementById('free_bids_count');
                        objbidsvalue = document.getElementById('free_bids_count').innerHTML;

                        if (objbids.innerHTML!='0') {
                            objbids.innerHTML = Number(objbidsvalue) + Number(placebids);
                        }
                    } else {
                        objbids = document.getElementById('bids_count');
                        objbidsvalue = document.getElementById('bids_count').innerHTML;
                        if (objbids.innerHTML!='0') {
                            objbids.innerHTML = Number(objbidsvalue) + Number(placebids);
                        }
                    }
                    changedatabutler(data,"dbut","");
                }
            });
        },
        error: function(XMLHttpRequest,textStatus, errorThrown) { }
    });
    return false;
}



function reserv_and_sa(item){
auction_id = item.id;


}

function timer(item){

auction_id = item.id;



}

function add_new_auctions(id, box){
          var auclist = '';
	
	  var box = $('#auction_' + id ).parent();
	  
	 
	  
         $('.auction-item, .auction-item-ended').each(function() {
	    auclist += $(this).attr('id') + ",";
	    
	 });

  
}



function remove_now(id, auclist){

     var box = $('#auction_' +  id ).parent().attr('id');
     
	
        
     add_new_auctions(id, box);
  
}



function remove_auction(auction_id){
        var auclist;
         $('.auction-item').each(function() {
	    auclist += $(this).attr('id') + ",";
	    
	 });
	 
	 
   $('#auction_' + auction_id).fadeOut(10000, function() { 
     
      remove_now(auction_id, auclist);
   
  });
}


function showhide_auctype(value,type){    
    if(type=='over'){
        $('#auction_type'+value).show();

    }else if(type=='out'){
        $('#auction_type'+value).hide();
    }
}







function number_format( number, decimals, dec_point, thousands_sep ) {

    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;

    var d = dec_point == undefined ? "." : dec_point;

    var t = thousands_sep == undefined ? "," : thousands_sep, s = n < 0 ? "-" : "";

    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;



    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");

}

//callback function to bring a hidden box back
function callback(){
    try{ setTimeout(function(){
      $("#effect:hidden").removeAttr('style').hide().fadeIn(); 
    }, 1000); }catch(oo){}
}

function blinks(hide) {
    if(hide==1) {
        $('.blink').css('visibility', 'collapse');
            hide = 0;
    }
else { 
    $('.blink').css('visibility', 'visible');
    hide = 1;
}
setTimeout("blinks("+hide+")",400);
}


function log(msg){
////console.log(msg);
}


function buildGlobalTooltip(width,height,content,element){
  
  $($(this).closest('*')).qtip({content: { text: content }, style: { width: width, height: height }, show: { ready:true } });
  
}







function DeleteBidButlerById(aid, uid){
  
  $.ajax({
    
    
		url: siteurl + 'deletebutler.php?aid='+aid+'&uid='+uid+'&all=true',
                dataType: 'json',
                success: function(data) {
		  $('.bid_status_on p').removeClass('show');
		    $('.bid_status_on p').addClass('hide');
		    
		    $('.bid_status_off p').removeClass('hide');
		    $('.bid_status_off p').addClass('show');
		    
                    
	
		    $("#bids_count").html(data.free_bids);
		    $("#free_bids_count").html(data.final_bids);
		    
		    
		  
		    
		}
		    
	});
  
}

function timer_update_ui(auction_id, item){
  
       if(item.similar_products){
	     
	      add_buttons(auction_id, item.similar_products.product_ids);
	      
	    }
   
	auction_effects(auction_id, item);
	change_auction_info(auction_id, item);
	if(document.getElementById('slider_box')){
	    auction_effects_slider(auction_id, item);
	    change_auction_info_slider(auction_id, item);
	}
	updateHistory(auction_id, item);
}
function change_auction(which, auction_id){
  
 if(which == 1 | which == -1){
   box = $('#auction_' + auction_id).parent().attr('id');
    if(which == 1){
      $.get('get_new_auction.php?box=' + box + '&auction_id=' + auction_id + '&which=back', function(response){
	$('#auction_' + auction_id).html(response);
	initialize_bid_buttons();
	
      });
    }else{
      $.get('get_new_auction.php?box=' + box + '&auction_id=' + auction_id + '&which=forward', function(response){
	$('#auction_' + auction_id).html(response);
	initialize_bid_buttons();
	
      }); 
      
    }
 
 }else{
  box = $('#auction_' + auction_id).parent().attr('id');
    $.get('get_new_auction.php?box=' + box + '&auction_id=' + auction_id + '&which=' + which, function(response){
	if(document.getElementById('auction_' + auction_id)){
	  if(!document.getElementById('productID-hidden_' + auction_id)){
		$('#auction_' + auction_id).html(response);
	  
	      initialize_bid_buttons();
	  }
	}
      });
 
   
 }
  
}


function add_buttons(auction_id, similar){
  if(!document.getElementById('next_similar_' + auction_id)){
      $('#counter_index_page_' + auction_id).before('<span id="next_similar_' + auction_id +'" class="left_similar" onclick="javascript:change_auction(1, ' + auction_id + ');">&nbsp;</span>');
  }
  if(!document.getElementById('previous_similar_' + auction_id)){
  $('#counter_index_page_' + auction_id).before('<span id="previous_similar_' + auction_id +'" class="right_similar" onclick="javascript:change_auction(-1, ' + auction_id + ');">&nbsp;</span>');
  }
}
function last_seconds(auction_id, auction_time, item){
  var item;
  var auction_id;
  var pausestatus;
  var auction_time;
  
	   
	    if(item.delay_text !== item.lt & item.tdelay == 1 ){
                   
                    $('#counter_index_page_' + auction_id).html(item.delay_text);
		    $('#counter_index_page_' + auction_id).css('color', 'red');
		    
		    if(auction_time == 1){
		    
		               if($('#seat_count_'+auction_id).length > 0){
				      $('#seat_count_'+auction_id).remove();
				    
				      $('#seat_bar_'+auction_id).remove();
			       }
		    }
			       
                }else{
		 // console.log('yes');
		  if(item.lt <= 0){
		    
		    $('#counter_index_page_' + auction_id).css('color', 'red');
		    $('#bidomatic_' +auction_id).css('visibility', 'collapse');
			  if(!userid | userid == 'undefined'){
			    if(item.uid > 0){
			      
				sold(auction_id, item);
			      }else{
							
				ended(auction_id, item);
							
			      }
			    }else{
		
				    if(item.uid == userid){
				      you_won(auction_id, item);
					
					
				    }else{
					if(item.uid > 0){
					  
						  sold(auction_id, item);
					  }else{
					    
					    ended(auction_id, item);
					    
					  }
				    
				 }
				 
			}
			
		}else if (pausestatus==1) {
                    $('#counter_index_page_' + auction_id).html('Pause');
                    $('#image_main_' + auction_id).attr('onclick', '');
                    $('#image_main_' + auction_id).attr('name','');
                    $('#image_main_' + auction_id).text('PAUSE');
		    $('#counter_index_page_' + auction_id).css('color', 'orange');
                }else
                
                if(auction_time <= 10){
		  $('#counter_index_page_' + auction_id).css('color', 'red');
		  if(item.tdelay == 1){
		      $('#counter_index_page_' + auction_id).html(calc_counter_from_time(parseInt(auction_time)));
		  }else{
		      $('#counter_index_page_' + auction_id).html(calc_counter_from_time(parseInt(auction_time)));
		    
		  }
		}else{
		  
		  $('#counter_index_page_' + auction_id).css('color', 'black');
		  if(item.tdelay == 1){
		      $('#counter_index_page_' + auction_id).html(calc_counter_from_time(parseInt(auction_time)));
		  }else{
		      $('#counter_index_page_' + auction_id).html(calc_counter_from_time(parseInt(auction_time)));
		    
		  }
		}
	}  
	
}
 
function last_seconds_slider(auction_id, auction_time, item){
  var item;
  var auction_id;
  var pausestatus;
  var auction_time;
  
  
	    if(item.delay_text !== item.lt & item.tdelay == 1){
                   
                    $('#slider-counter_index_page_' + auction_id).html(item.delay_text);
		    $('#slider-counter_index_page_' + auction_id).css('color', 'red');
		    
		    if(auction_time == 1){
		    
		               if($('#slider-seat_count_'+auction_id).length > 0){
				      $('#slider-seat_count_'+auction_id).remove();
				    
				      $('#slider-seat_bar_'+auction_id).remove();
			       }
		    }
			       
                }else {
		  
		  if(auction_time <= 0){
		    $('#slider-counter_index_page_' + auction_id).css('color', 'red');
		    $('#slider-bidomatic_' +auction_id).css('visibility', 'collapse');
			  if(!userid | userid == 'undefined'){
			    if(item.uid > 0){
			      
				sold(auction_id, item);
			      }else{
							
				ended(auction_id, item);
							
			      }
			    }else{
		
				    if(item.uid == userid){
				      you_won(auction_id, item);
					
					
				    }else{
					if(item.uid > 0){
					  
						  sold(auction_id, item);
					  }else{
					    
					    ended(auction_id, item);
					    
					  }
				    
				 }
				 
			}
			
		}else if (pausestatus==1) {
                    $('#slider-counter_index_page_' + auction_id).html('Pause');
                    $('#slider-image_main_' + auction_id).attr('onclick', '');
                    $('#slider-image_main_' + auction_id).attr('name','');
                    $('#slider-image_main_' + auction_id).text('PAUSE');
		    $('#slider-counter_index_page_' + auction_id).css('color', 'orange');
                }else
                
                if(auction_time <= 10){
		  $('#slider-counter_index_page_' + auction_id).css('color', 'red');
		  if(item.tdelay == 1){
		      $('#slider-counter_index_page_' + auction_id).html(calc_counter_from_time(parseInt(auction_time)));
		  }else{
		      $('#slider-counter_index_page_' + auction_id).html(calc_counter_from_time(parseInt(auction_time)));
		    
		  }
		}else{
		  
		  $('#slider-counter_index_page_' + auction_id).css('color', 'black');
		  if(item.tdelay == 1){
		      $('#slider-counter_index_page_' + auction_id).html(calc_counter_from_time(parseInt(auction_time)));
		  }else{
		      $('#slider-counter_index_page_' + auction_id).html(calc_counter_from_time(parseInt(auction_time)));
		    
		  }
		}
	}  
	
}
 
 
 
 
 
 
 
 
 
	      
		

			
			
	
	
	
	
	
	
	
	
	
			
$(document).ready(function(){
  
initialize_bid_buttons();

$(function(){
  
if(!getCookie('keep_me_logged_in')){
    $( "#timeout_dialog" ).dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            Ok: function() {
                $(this).dialog( "close" );
            }
        },
        close: function(event, ui) {
            setTimeout('updateAuctionInfo();', auctionUpdateTime);
        }
    });

    $('body').mousemove(function(){
        lastmovetime=new Date();
    });
}
});


 blinks(1);
        $('.butseat-button-link').click(function() {
	  
	  
	  buy_seat($(this).attr('name'));
	  
	});
  
 $(".bookbidbutlerbutton").click(function() {
   if(!userid | userid == 0){
     window.location.href = 'login.php';
     
     
   }else{
        //alert(document.getElementById('bookbidbutlerbutton').name);
        if ($('#bookbidbutlerbutton').attr('name')!="") {
			
            var bidbutstartprice = Number($('#bid_from').val());
            var bidbutendprice = Number($('#bid_to').val());
            var totalbids = $('#bid_bids').val();
		
            if (bidbutstartprice=="") {
                //alert("Please enter AutoBidder start price!");
                showAutoBidStart();
                return false;
            }
            if (bidbutendprice=="") {
                //alert("Please enter AutoBidder end price!");
                showAutoBidEnd();
                return false;
            }
            if (totalbids=="") {
                //alert("Please enter AutoBidder bids!");
                showAutoBids();
                return false;
            }
            if (totalbids<=1) {
                //alert("You palce AutoBidder for more than one bid!");
                showMoreThenOneBids();
                return false;
            }

            if($('#isreverseauction').val()=='0' | $('#isreverseauction').length == '0'){
	     
                if (bidbutstartprice >= bidbutendprice) {
                    //alert("AutoBidder start price must greater than end price!");
                    showEndGreaterStart();
                    return false;
                }
            }else{
	      
                if (bidbutstartprice <= bidbutendprice) {
                    //alert("AutoBidder start price must greater than end price for reverse auction!");
                    showStartGreaterEnd();
                    return false;
                }
            }
	  $.ajax({
                url: siteurl+"addbidbutler.php?aid="+$(this).attr('name')+"&bidsp="+bidbutstartprice+"&bidep="+bidbutendprice+"&totb="+totalbids,
                dataType: 'json',
                success: function(data) {
		  
                    $.each(data, function(i, item) {
		      
		       
                        
			if (item.result) {
                            result = item.result;
                            showAlertBox(item.message);
                        } else {
                           // $('#bid_form').val('');
                            //$('#bid_to').val('');
                            //$('#bid_bids').val('');                            
                            $('#butlermessage').show();
                            changeMessageTimer = setInterval("ChangeButlerImageSecond()",5000);
                            changedatabutler(data,"abut",totalbids);
                        }
                    });
		    $('.bid_status_off p').removeClass('show');
		    $('.bid_status_off p').addClass('hide');
		    
		    $('.bid_status_on p').removeClass('hide');
		    $('.bid_status_on p').addClass('show');
                },
                error: function(XMLHttpRequest,textStatus, errorThrown) { }
            });

            return false;
        }
        
      }
    });
  
  
  


        $('.butseat-button-link').click(function() {
	  
	  
	  buy_seat($(this).attr('name'));
	  
	});
      });













function updateAuctionInfo() {

    
 $.ajax({
            url: siteurl+getStatusUrl,
            dataType: 'json',
            type: 'get',
            cache:false,
            timeout: 3000,
            data: {
                auctionlist:auctiondata
            },
            global: false,
            success: function(response) {
                if(response.message!='ok') return;

                var data=response.data;
                storedata = response.data;

                ////console.log((new Date()-lastsendtime)/1000-response.time+' '+response.time);
                log((new Date()-lastsendtime)/1000-response.time+' '+response.time);

                //alert(data);

                $.each(data, function(i, item) {
                    //alert(item.auc_id);
		  
                    auction_id = item.id;
		    
		
                    auction_price = item.np;
                    auction_bidder_name = item.hu;
		   
                            if($("#product_bidder_"+auction_id).length>0){
			      
                                $("#product_bidder_"+auction_id).html(item.hu);
				
				if(document.getElementById('bookbidbutlerbutton') & inArray(userid, item.sbids) & item.sa == '1'){
				  
				  //$('#bookbidbutlerbutton').attr('name', 'http://pennyauctionsoftdemo.com/PAS-6.3/addbidbutler.php?aid=123706&bidsp=0.00&bidep=100&totb=1000
				  
				}
                            }
                     if(item.bids_back){
		   
			 $('#bids_back_' + auction_id).html(item.bids_back);
			 
		       }
		       if(item.free_bids){
			 $('#free_bids_' + auction_id).html(item.free_bids);
			 
		       }        
                            
                    auction_price = item.np;
                    if(reloadWhenEnd==true && item.lt==0){
                        ////console.log('reload');
                        window.location.reload();
                    }

                    if(typeof(updateAuction)=='function'){
                        updateAuction(auction_id,CurrencySymbol+auction_price,item.lt);
                    }
              
                    var options = {
                        color:'#f79909'
                    };

                    if(item.sa==true){
		       
			update_seat_info(auction_id, item);
			timer_update_ui(auction_id, item);
			updateHistory(auction_id, item);

                    }
		   
                    if(item.ua==false){

                       
			timer_update_ui(auction_id, item);
			updateHistory(auction_id, item);
                    }else{
                       
			update_ua_info(auction_id, item);
			timer_update_ui(auction_id, item);
			updateHistory(auction_id, item);
                    }
               if(getCookie('po[' + auction_id + ']')){
		 
		 change_auction(getCookie('po[' + auction_id + ']'), auction_id)
		  
		}
                });
                GlobalVar = 1;
            },
            error: function(XMLHttpRequest,textStatus, errorThrown) {
            //runUpdateTimer();
            },
            complete:function(){
                runUpdateTimer();
            },
            beforeSend:function(XMLHttpRequest){
                lastsendtime=new Date();
            }
        });
    
    if (flipflop==1) {
        flipflop = 1;
    //ChangeCountdownData(storedata);
    } else if (flipflop==2) {
        flipflop = 1;
    //alert(storedata);
   // ChangeCountdownData(storedata);
    }
   
   
}






















function you_won(auction_id, item){
  
			$('#gavel_' + auction_id).remove();
		       $('#slider-gavel_' + auction_id).remove();
			      $('#counter_index_page_' + auction_id).html("YOU WON!");
			     $('#normal_panel_' + auction_id).addClass('you_won');
			      $('#counter_index_page_' + auction_id).addClass('blink');
			      $('#image_main_' + auction_id).html('Checkout');
			      $('#image_main_' + auction_id).addClass('checkout');
			      $('#image_main_' + auction_id).removeAttr('name');
			      $('#image_main_' + auction_id).attr('href', siteurl + '/auction/you_won-' + auction_id + '.html');
			      $('#sold_banner_' + auction_id).css('visibility', 'visible');
			      $('#sold_banner_large_' + auction_id).css('visibility', 'visible');
			      $('#sold_banner_' + auction_id).removeClass('hide');
			       $('#sold_banner_large_' + auction_id).removeClass('hide');
			       
			       $('#bid_help_' + auction_id).css('display', 'none');
			       
			       
			       
			       $('#large_winner_banner_' + auction_id).css('display', 'block');
			       
			       $('#check_' + auction_id).removeClass('red');
			        $('#check_' + auction_id).removeClass('white');
			        $('#check_' + auction_id).addClass('green');
				
				
			       $('#check_' + auction_id).removeClass('hideme');
			        $('#check_' + auction_id).addClass('showme');
				$('#check_' + auction_id).css('display', 'inline-block');
				
				if(item.teardrops == 1){
				    var colors = ['pumpkin', 'blue', 'red', 'green', 'orange'];
				    var rand = colors[Math.floor(Math.random() * colors.length)];
				    
				  
				    
				    $('#product-information').parent().html('<div class="sold_product_info" style="display:block;margin-top:30px;"><div id="product-information"><div style="display:inline-block;" id="savings_percent_'+auction_id+'" class="teardrop  ' + rand + '_teardrop dynamic"></div><table width="550px"><tbody><tr><td width="120px"><span><div title="'+auction_id+'" id="auction_' + auction_id + '"> <div class="product-box"> <div class="product-content"><p style="float:none" class="pricebox-sold"> <span>Your bid: <br /><em>$</em><em id="your_price_'+ auction_id + '"></em></span></p><p style="float:none" class="pricebox-sold"> <span>You saved: <br /><em>$</em><em id="your_savings_'+auction_id+'"></em></span></p></div></div></div></span></td><td width="430px"><div class="checkout_info"> Please proceed to checkout within<b>two weeks</b>of winning the auction. Otherwise we will assume that you do not want this item. It only takes a couple of seconds!<a class="button" href="wonauctions.php">Checkout</a></div></td></tr></tbody></table></div></div>');
			  
				}
				if(item.fireworks == 1){
				    $('#counter_index_page_' + auction_id).removeClass('blink');
				    $('#counter_index_page_' + auction_id).parent().addClass('fireworks');				  
				}
	
				
}







function sold(auction_id, item){
			$('#gavel_' + auction_id).remove();
		       $('#slider-gavel_' + auction_id).remove();
			     
			      $('#counter_index_page_' + auction_id).html("SOLD");
				 // $('#counter_index_page_' + auction_id).addClass('sold');
				   $('#sold_banner_' + auction_id).css('visibility', 'visible');
				    $('#sold_banner_large_' + auction_id).css('visibility', 'visible');
				    $('#sold_banner_' + auction_id).removeClass('hide');
			       $('#sold_banner_large_' + auction_id).removeClass('hide');
			       
			       $('#normal_button_' + auction_id).css('visibility', 'collapse');
			       $('#image_main_' + auction_id).css('visibility', 'collapse');
			       
			       
			       $('#sold_bubble_' + auction_id).css('visibility', 'visible');
			       $('#sold_bubble_' + auction_id).removeClass('hideme');
			       $('#sold_bubble_' + auction_id).addClass('showme');
			       $('#check_' + auction_id).removeClass('hideme');
			        $('#check_' + auction_id).addClass('showme');
				
				
				
				$('#check_' + auction_id).css('display', 'inline-block');
				
				
				$('#bid_help_' + auction_id).css('display', 'none');
			     
        $.ajax({
            url: siteurl+'update_info.php?auctionlist=' + auction_id,
            dataType: 'json',
            type: 'get',
            cache:false,
            timeout: 3000,
            data: {
                auctionlist:auction_id
            },
            global: false,
            success: function(response) {
               
                var item2=response.data[0];
			  if(item2.hu){
			   $('#large_winner_banner_not_won_' + auction_id).html('<p>Won by! <i>' + item2.hu + '</i></p>');
			   
			  }
			  
			}
				
	});		 
				 $('#teardrop_' + auction_id).css('display', 'inline');
				 $('#savings_percent_' +  auction_id).css('display', 'inline-block');
				 
				  $('#large_winner_banner_not_won_' + auction_id).css('display', 'block');
				   updateHistory(auction_id, item);
				   updateUniqueHistory(auction_id, item);
}

function ended(auction_id, item){
   $('#gavel_' + auction_id).remove();
   $('#slider-gavel_' + auction_id).remove();
   $('#counter_index_page_' + auction_id).addClass('ended');
   $('#counter_index_page_' + auction_id).html("ENDED");
   $('#image_main_' + auction_id).css('visibility', 'collapse');
	$.ajax({
            url: siteurl+'update_info.php?auctionlist=' + auction_id,
            dataType: 'json',
            type: 'get',
            cache:false,
            timeout: 3000,
            data: {
                auctionlist:auction_id
            },
            global: false,
            success: function(response) {
               try{
                var item2=response.data[0];
		if(item2.hu){
				  $('#large_winner_banner_not_won_' + auction_id + 'i').html(item2.hu);
		}
	       }catch(o){}
				 
				  
	    }
	});
				  $('#large_winner_banner_not_won_' + auction_id).removeClass('hide');
				  
				  $('#normal_button_' + auction_id).css('visibility', 'collapse');
				  $('#bid_help_' + auction_id).css('display', 'none');
				  
				  
			$('#newsletter_form_' + auction_id).removeClass('active');
			$('#newsletter_form_' + auction_id).removeClass('sold');
			$('#newsletter_form_' + auction_id).addClass('ended');	  
				  
				  $('#large_winner_banner_not_won_' + auction_id).css('display', 'block');
}


function auction_effects(auction_id, item){
    
   auction_time = item.lt;
   var auction_id;
   var pausestatus = item.p;
   
   	    $('#counter_index_page_' + auction_id).css('display', 'block');
	    $('#reserve_text_' + auction_id).remove();
	    
	    

   
	     
	      
	      if((item.lt <= 0) || pausestatus ==true){
		
		      last_seconds(auction_id, auction_time, item);
		     
	      }else if(auction_time <= 10){
		    if(item.gavel == 1 && item.lt <= 5){
		
		    if(item.gavel == 1 & item.lt == 5){
		      
			$('#auction_' + auction_id).prepend('<span class="gavel" style="display:block;visibility:visible;" id="gavel_' + auction_id + '"></span>');
			
			
			
			$('#slider-auction_' + auction_id).prepend('<span style="display:block;visibility:visible;" class="gavel" id="slider-gavel_' + auction_id + '"></span>');
			
			}
		    }else{
		       $('#gavel_' + auction_id).remove();
		       $('#slider-gavel_' + auction_id).remove();
		    }
		      
		      $('#counter_index_page_' + auction_id).css('color', 'red');
		      $('#counter_index_page_' + auction_id).html(calc_counter_from_time(auction_time));
		      
		    
      
		  }else{
		      $('#counter_index_page_' + auction_id).css('color', 'black');
		       if(isNaN(item.reserve) & item.reserve != '' & item.reserve != 'undefined'){
		      if($('#counter_index_page_' + auction_id).length >= 1){
			
			  $('#gavel_' + auction_id).remove();
			  $('#counter_index_page_' + auction_id).before('<span class="blink reserve" id="reserve_text_' + auction_id + '">' + item.reserve + '</span>');
			}
		    
		    }
		      $('#counter_index_page_' + auction_id).html(calc_counter_from_time(auction_time));
		  }

		
  
}
function auction_effects_slider(auction_id, item){
      
   auction_time = item.lt;
   var auction_id;
   var pausestatus = item.p;
   
   	    $('#slider-counter_index_page_' + auction_id).css('display', 'block');
	    $('#slider-reserve_text_' + auction_id).remove();
	    
	    
		   
	      
	      		   
	 
	     
	      
	      if((item.lt <= 0) || pausestatus ==true){
		
		     
		      last_seconds_slider(auction_id, auction_time, item);
	      }else if(auction_time <= 10){
		    
		      $('.gavel').css('visibility', 'visible');
		      $('#slider-counter_index_page_' + auction_id).css('color', 'red');
		      $('#slider-counter_index_page_' + auction_id).html(calc_counter_from_time(auction_time));
		      
		    
      
		  }else{
		      $('#slider-counter_index_page_' + auction_id).css('color', 'black');
		       if(isNaN(item.reserve) & item.reserve != '' & item.reserve != 'undefined'){
		      if($('#slider-counter_index_page_' + auction_id).length >= 1){
			
			  $('#slider-gavel_' + auction_id).remove();
			  $('#slider-counter_index_page_' + auction_id).before('<span class="blink reserve" id="reserve_text_' + auction_id + '">' + item.reserve + '</span>');
			}
		    
		    }
		      $('#slider-counter_index_page_' + auction_id).html(calc_counter_from_time(auction_time));
		  }

		 

}

function getCookie(c_name)
{
var c_value = document.cookie;
var c_start = c_value.indexOf(" " + c_name + "=");
if (c_start == -1)
  {
  c_start = c_value.indexOf(c_name + "=");
  }
if (c_start == -1)
  {
  c_value = null;
  }
else
  {
  c_start = c_value.indexOf("=", c_start) + 1;
  var c_end = c_value.indexOf(";", c_start);
  if (c_end == -1)
  {
c_end = c_value.length;
}
c_value = unescape(c_value.substring(c_start,c_end));
}
return c_value;
}
