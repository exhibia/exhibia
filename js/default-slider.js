var flipflop=1;
var storedata;
var auctionUpdateTime = 1000;
var counterUpdateTime = 1000;
var auctiondata = '';
var getStatusUrl;
var lastsendtime;
var GlobalVar = 0;
var reloadWhenEnd=true;
var shown;
var num_auctions;
var ajaxTimeOut;
var color;
if(color == 'null' || color == ''){
  color = '#002356';
}
var sold_color;
if(sold_color == 'null' || sold_color == ''){
  sold_color = '#ffffff';
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

function OnloadPageSlider() {

    auctionUpdateTime=reloadWhenEnd==true?refreshRate/2 : refreshRate;
    
        $.ajaxSetup({
            cache: false
        });	//Configuring ajax
   
    
    var firstauction=true;
    $('.auction-item-slider').each(function() {

    
     
        //var auctionId    = $(this).attr('id');
        var auctionTitle = $(this).attr('title');
     if(!auctiondata.match('/auctionTitle/')){
       if(auctiondata != ''){
            auctiondata += ',' + auctionTitle;
       }else{
	    auctiondata = auctionTitle;
	 
       }
     }
            firstauction=false;
      
            
        
        
    });

    getStatusUrl = 'update_info.php?flp=' + flipflop;

 
    

    setTimeout('updateAuctionInfoSlider();', auctionUpdateTime);


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
	    timeout: ajaxTimeOut,
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
    
    

    $('.bid-button-link').click(function() {
        //alert('a');
        var url=$(this).attr('name');
        if(url=='')
            return;
        $.ajax({            
            url: siteurl+url,
            dataType: 'json',
	    timeout: ajaxTimeOut,
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

        return false;
    });

    $('.butseat-button-link').click(function() {
        //alert('a');
        $.ajax({
            url: siteurl+$(this).attr('name'),
            dataType: 'json',
	    timeout: ajaxTimeOut,
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
    });
   

		    
     
}
$(function(){
   setInterval('updateHistory();', 6000);
   //setInterval('updateSavingPrice();', 6000);
   
   
    $(".bookbidbutlerbutton").click(function() {
        //alert(document.getElementById('bookbidbutlerbutton').name);
        if ($('#bookbidbutlerbutton').attr('name')!="") {
			
            var bidbutstartprice = Number($('#bid_form').val());
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
                            $('#bid_form').val('');
                            $('#bid_to').val('');
                            $('#bid_bids').val('');                            
                            $('#butlermessage').show();
                            changeMessageTimer = setInterval("ChangeButlerImageSecond()",5000);
                            changedatabutler(data,"abut",totalbids);
                        }
                    });
                },
                error: function(XMLHttpRequest,textStatus, errorThrown) { }
            });

            return false;
        }
    });
});
function updateUniqueHistorySlider(){
    if($('.productUniqueAuction').length<=0){
        return;
    }

    auctionhisid = $('#history_auctionid').html();//document.getElementById('history_auctionid').innerHTML;

    oldbids = $('#curproductbids').html();//document.getElementById('curproductprice').innerHTML;
    newbids = $('#ubid_index_page_' + auctionhisid).html();//document.getElementById('slider-price_index_page_' + auctionhisid).innerHTML;

    if (true) {
        //alert('a');
        getStatusUrl4 = siteurl+'updatehistory_unique.php?aucid_new='+auctionhisid;

        $.ajax({
            url: getStatusUrl4,
            dataType: 'json',
	    timeout: ajaxTimeOut,
            success: function(data) {
                var lastPos,lastName,currentName,currentPos;

                if(data==null || data.message=='failed') return;
                //data1 = eval('(' + data.responseText + ')');
                var fontweight;
                //alert(data);

                for (var i=0; i<data.hiss.length; i++) {
                    username = data.hiss[i].his.un;
                    adddate = data.hiss[i].his.ad;

                    if(i==0){
                        fontweight="bold";
                    }else{
                        fontweight="normal";
                    }

                    if(i==0){
                        currentName=data.hiss[i].his.un;
                        currentPos=data.hiss[i].his.latlng;
                    }

                    if(i==1){
                        lastName=data.hiss[i].his.un;
                        lastPos=data.hiss[i].his.latlng;
                    }

                    $("#slider-bid_user_name_"+i).html(username);
                    $("#slider-bid_user_name_"+i).css("font-weight", fontweight);

                    $("#slider-bid_date_"+i).html(adddate);
                    $("#slider-bid_date_"+i).css("font-weight", fontweight);
                }

                if(typeof(updateMarker)=='function'){
                    updateMarker(currentPos,currentName,lastPos,lastName);
                }

                //alert(data.myhistories.length);

                if (data.mhiss.length>0) {
                    for (j=0; j<data.mhiss.length; j++) {
                        if(j==0){
                            fontweight="bold";
                        }else{
                            fontweight="normal";
                        }

                        username1 = data.mhiss[j].mhis.un;
                        adddate1= data.mhiss[j].mhis.ad;
                        bidprice1= data.mhiss[j].mhis.bp;

                        //document.getElementById('my_bid_price_' + j).innerHTML = "$" +  biddingprice1;
                        $("#slider-my_bid_username_"+j).html(username1);
                        $("#slider-my_bid_username_"+j).css("font-weight", fontweight);

                        $("#slider-my_bid_price_"+j).html(bidprice1);
                        $("#slider-my_bid_price_"+j).css("font-weight", fontweight);

                        //document.getElementById('my_bid_time_' + j).innerHTML = biddingusername1;
                        $("#slider-my_bid_date_"+j).html(adddate1);
                        $("#slider-my_bid_date_"+j).css("font-weight", fontweight);
                    }
                }

                $("#slider-curproductbids").html(newbids);
            //changedatabutler(data,"abut",data.butlerslength.length);
            //document.getElementById('curproductprice').innerHTML = data.histories[0].history.bprice;
            },
            error: function(XMLHttpRequest,textStatus, errorThrown) { }
        });

        //update saving
        var onlineperbidvalue=$("#slider-onlineperbidvalue_text").val();
        var price=$("#slider-price_text").val();
        var fprice=$("#slider-fprice_text").val();
        var aucid=$("#slider-aucid_text").val();

        //alert(price+"_"+fprice+"_"+aucid+"_"+onlineperbidvalue);


    }
}

function updateAuctionInfoSlider() {
    if (auctiondata.length>0) {
        
        $.ajax({
            url: siteurl+getStatusUrl,
            dataType: 'json',
            type: 'get',
            cache:false,
            timeout: ajaxTimeOut,
            data: {
                auctionlist:auctiondata
            },
            global: false,
            success: function(response) {
                if(response.message!='ok') return;

                var data=response.data;
                storedata = response.data;

                ////console.log((new Date()-lastsendtime)/1000-response.time+' '+response.time);
               // log((new Date()-lastsendtime)/1000-response.time+' '+response.time);

                //alert(data);

                $.each(data, function(i, item) {
                    //alert(item.auc_id);
                    auction_id = item.id;
                    auction_price = item.np;
                    auction_bidder_name = item.hu;
		    
                            if($("#slider-product_bidder_"+auction_id).length>0){
                                $("#slider-product_bidder_"+auction_id).html(auction_bidder_name);
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
                    if(reloadWhenEnd && item.lt==0){
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
		     	//console.log('#slider-price_index_page_'+auction_id);	   
		      $('#slider-price_index_page_'+auction_id).html(auction_price);
		      
		      
                            $('#slider-currencysymbol_' + auction_id).html(CurrencySymbol);
	if(document.getElementById('slider-topbider_index_page_' + auction_id)){
		acls=$('#slider-topbider_index_page_' + auction_id).attr('class');

	}else{
	  
	  acls= '';
	  
	}
	try{
			      if(acls.indexOf('i4')>0){
                                    totalcount=4;
                                }else if(acls.indexOf('i3')>0){
                                    totalcount=3;
                                }else{
				  totalcount = 5;
				}
	}   
                                catch(o){
				      totalcount = 5;
				    }
		

                               
                                    bidderhtml="";
                                    $.each(item.tb,function(i,bitem){
				     
                                        bidderhtml+='<li><a>'+bitem+'</a></li>';
                                        totalcount--;
                                        if(totalcount==0) return false;
                                    });
		$('#slider-topbider_index_page_' + auction_id).html(bidderhtml); 
				    
                        if(item.sa==true){
                            if($('#slider-seat_count_'+auction_id).html()!=item.sc){
                                $('#slider-seat_count_'+auction_id).html(item.sc);
                                var bpos=(item.sc / item.ms-1)*120;
				//if(bpos != 0){
                                $('#slider-seat_bar_'+auction_id).css('background-position',bpos+'px 0px');
				$('#slider-seat_bar_small_'+auction_id).css('background-position',Math.round(parseInt(bpos * .5))+'px 0px');
				//}
				
                                if (GlobalVar == 1) {
				  
				  try{
                                    $('#slider-seat_count_' + auction_id).effect('highlight',options,500);
				  }catch(oo){}
                                }
				if(item.sc == item.ms){
				  
				    if(inArray(userid, item.sbids)){
				      
				      
				      flip_auction_type(auction_id, item.prid);
				      
				    }
				
				
				} 

                     
                            }
                                   

                            return;
                        }else{


                            if($('#seat_panel_'+ auction_id).length>0 && $('#seat_panel_'+ auction_id).css('display')=='block'){
                                $('#seat_panel_'+ auction_id).css('display', 'none');
                                $('#normal_panel_'+ auction_id).css('display', 'block');
                                // the button
                                $('#slider-seat_button_'+ auction_id).css('display', 'none');
                                $('#normal_button_'+ auction_id).css('display', 'block');
     
                            }
                        }
				if(item.san | (!is_null(userid) & userid != '' && !is_null(item.seated_users))){

					if(item.sc >= item.ms){
					   flip_auction_type(auction_id, item.prid);
					  }else{
					    if(inArray(userid, item.sbids)){

						$('#slider-seat_button_' + auction_id).html('<a name="" class="button bid-button-link" id="slider-image_main_' + auction_id + '">Seated</a>');

						      if(item.sc == item.ms){
							  
							    if(inArray(userid, item.sbids)){
							      
							      
							      flip_auction_type(auction_id, item.prid);
							      
							    }
							
							
						} 
					    }
					  }

					}  
 

                    }
		   
                    if(item.ua==false){

                        if ($("#slider-price_index_page_"+auction_id).length & auction_price != $("#slider-price_index_page_"+auction_id).html()) {
                            
                            
                            if (GlobalVar == 1) {
                                if ($('#history_auctionid').length>0) {

                                    if (auction_id==$('#history_auctionid').html()){
                                     try{   $('#slider-price_index_page_' + auction_id).effect('highlight',options,500); }catch(oo){}
                                    

                                    } else {
                                       try { $('#slider-price_index_page_' + auction_id).effect('highlight',options,500); }catch(oo){}
                                    

                                    }
                                } else {
                                    try { $('#slider-price_index_page_' + auction_id).effect('highlight',options,500); }catch(oo){}
                                

                                }
console.log(auction_price + ' ' + auction_id + 'auction price');
      $("#slider-price_index_page_"+auction_id).html(auction_price); 

                            }
                     


                            if($('#slider-product_avatarimage_'+auction_id).length && item.av!=""){
			    
                                $('#slider-product_avatarimage_'+auction_id).attr('src',item.av);
                            }


                            $('#slider-price_index_page_'+auction_id).html(auction_price);
                            $('#slider-currencysymbol_' + auction_id).html(CurrencySymbol);

                            //set the tax amount

                            if($('#product_taxamount_'+auction_id).length>0){
                                var tax1=$('#product_tax1_'+auction_id).val();
                                var tax2=$('#product_tax2_'+auction_id).val();
                                var taxamount=0;
                                if(tax1!=0){
                                    taxamount+=auction_price*tax1/100;
                                }
                                if(tax2!=0){
                                    taxamount+=auction_price*tax2/100;
                                }
                                $('#product_taxamount_'+auction_id).html(CurrencySymbol + Math.round(taxamount*100)/100);
                            }


                            if($("#slider-product_bidder_"+auction_id).length>0){
                                $("#slider-product_bidder_"+auction_id).html(auction_bidder_name);
                            }

                            //alert($('#slider-topbider_index_page_' + auction_id).length);

                            if($('#slider-topbider_index_page_' + auction_id).length>0 ){
                                //PennyAuctionSoft add for top bidder
                               if(item.sa==true && parseInt(item.sc) < parseInt(item.ms)){
				    topbidder=item.seated_users;
				}else{
				  console.log(item.tb);
				  
				  topbidder=item.tb;
				}
                                acls=$('#slider-topbider_index_page_' + auction_id).attr('class');
				
				
                                totalcount=0;
				
                                if(acls.indexOf('i4')>0){
                                    totalcount=4;
                                }else if(acls.indexOf('i3')>0){
                                    totalcount=3;
                                }
                                
                                
                                if(!item.seated_users){
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
                                    $('#slider-topbider_index_page_' + auction_id).html(bidderhtml);
                                }
                                
				}else{
				  
				  
				  
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
                                    $('#slider-topbider_index_page_' + auction_id).html(bidderhtml);
                                }
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				}
                            }
                        //PennyAuctionSoft add for top bidder
                            

                        }
                    
                    }else{
                        if ($("#slider-ubid_index_page_"+auction_id).length>0 && $("#slider-ubid_index_page_"+auction_id).html() != item.lbc) {
                            updateUniqueHistorySlider();

                            if (GlobalVar == 1) {
                                if ($('#history_auctionid').length>0) {

                                    if (auction_id==$('#history_auctionid').html()){
				      
				      try{ $('#ubid_index_page_' + auction_id).effect('highlight',options,500); }catch(oo){}
                                  

                                    } else {
                                        try{ $('#ubid_index_page_' + auction_id).effect('highlight',options,500); }catch(oo){}

                                    }
                                }else {
                                   try{ $('#ubid_index_page_' + auction_id).effect('highlight',options,500); }catch(oo){}
                                }

                            }


                            if($('#slider-product_avatarimage_'+auction_id).length && item.av!=""){
                                $('#slider-product_avatarimage_'+auction_id).attr('src', item.av);
                            }


                            $('#ubid_index_page_'+auction_id).html(item.lbc);

                            if($("#slider-product_bidder_"+auction_id).length>0){
                                $("#slider-product_bidder_"+auction_id).html(auction_bidder_name);
                            }
                            
                        }
                    }
                });
                GlobalVar = 1;
            },
            error: function(XMLHttpRequest,textStatus, errorThrown) {
            //runUpdateTimerSlider();
            },
            complete:function(){
                runUpdateTimerSlider();
            },
            beforeSend:function(XMLHttpRequest){
                lastsendtime=new Date();
            }
        });
    }
    if (flipflop==1) {
        flipflop = 1;
    //ChangeCountdownData(storedata);
    } else if (flipflop==2) {
        flipflop = 1;
    //alert(storedata);
   // ChangeCountdownData(storedata);
    }
   
    ChangeCountdownDataSlider(storedata);

}

function runUpdateTimerSlider(){
    if((new Date()-lastmovetime)/1000>timeoutvalue && timeoutvalue!=0){
        $( "#timeout_dialog" ).dialog('open');
        return;
    }

    var lefttime=(auctionUpdateTime-(new Date()-lastsendtime));
    if(lefttime<=0)
        lefttime=0;
    ////console.log(now+'  '+lastsendtime+'  '+runtime+'  '+lefttime);
    setTimeout('updateAuctionInfoSlider();', lefttime);
    
}
function ChangeCountdownDataSlider(resdata) {
	
    if (resdata && resdata!="") {
        data = resdata;

        $.each(data, function(i, item) {
            auction_id = item.id;
            auction_time = item.lt;
            pausestatus = item.p;
                    auction_price = item.np;

            
	      if(item.sa>=1 & parseInt(item.sc)<parseInt(item.ms)) {


		
  		  $("#slider-normal_panel_"+ auction_id).css("display", "none");

		  $("#slider-seat_panel_"+ auction_id).css("display", "block");

                        $('#slider-counter_index_page_' + auction_id).css('color', color);
                        $('#slider-counter_index_page_' + auction_id).html(calc_counter_from_time(auction_time));
                            $('#slider-price_index_page_'+auction_id).html(auction_price);
                            $('#slider-currencysymbol_' + auction_id).html(CurrencySymbol);
			
                                $('#slider-seat_count_'+auction_id).html(item.sc);
                                var bpos=(item.sc / item.ms-1)*120;
				
                                $('#slider-seat_bar_'+auction_id).css('background-position', bpos+'px 0px');
				$('#slider-seat_bar_small_'+auction_id).css('background-position',Math.round(parseInt(bpos * .5))+'px 0px');
				
                                if (GlobalVar == 1) {
                                    try{ $('#slider-seat_count_' + auction_id).effect('highlight',options,500); }catch(oo){}
                                }
				if(isNaN(item.reserve)){


				  if(!document.getElementById('slider-reserve_text' + auction_id)){
					$("#slider-seat_panel_"+ auction_id).append('<div id="slider-reserve_text' + auction_id + '" style="color:red;"></div>');


					    
				  text = '<div style="position:relative;top:-15px;z-index:0;"></div>';
				  text += '<div style="text-align:center;position:relative;z-index:5;color:red;width:auto;height:auto;top:-70px;margin-bottom:-25px;min-height:25px;"><blink>';
				  text += item.reserve + '</blink></div>';
				      }

                        $('#slider-reserve_text' + auction_id).html(text);
				  if(item.san | (!is_null(userid) & userid != '' && !is_null(item.seated_users))){

					if(item.sc >= item.ms){
					    flip_auction_type(auction_id, item.prid);
					    
					    
					  }else{
					    if(inArray(userid, item.sbids)){

						flip_auction_type(auction_id, item.prid)

					    }
					  }

					}  

			    
				  
		}
		
		
	if(item.san | (!is_null(userid) & userid != '' && !is_null(item.seated_users))){
	 if(item.sc >= item.ms){
	    
	    flip_auction_type(auction_id, item.prid);
	    
	    
	  }else{
	    if(inArray(userid, item.sbids)){

		$('#slider-seat_button_' + auction_id).html('<a name="" class="button bid-button-link" id="slider-image_main_' + auction_id + '">Seated</a>');

			      if(item.sc == item.ms){
				  
				    if(inArray(userid, item.sbids)){
				      
				      
				      flip_auction_type(auction_id, item.prid);
				      
				    }
				
				
				} 
	    }
	  }
	}                 //  }
	
	if(document.getElementById('slider-topbider_index_page_' + auction_id)){
            acls=$('#slider-topbider_index_page_' + auction_id).attr('class');
	}else{
	  acls = '';
	  
	}
	try {
                                totalcount=0;
                                if(acls.indexOf('i4')>0){
                                    totalcount=4;
                                }else if(acls.indexOf('i3')>0){
                                    totalcount=3;
                                }else{
				  totalcoun=5;
				}
                                
	      }                 catch(o){
				      totalcount = 5;
				    }
		
                                if(!item.seated_users){
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
                                    $('#slider-topbider_index_page_' + auction_id).html(bidderhtml);
                                }
                                
				}
	//}


	      }else{



 $('#slider-counter_index_page_' + auction_id).css('display', 'block');
                //alert(auction_time);
                if(auction_time==2 && enableTimerDelayer==true){
                    $('#slider-counter_index_page_' + auction_id).css('color', '#E80000');
                    $('#slider-counter_index_page_' + auction_id).html('GOING ONCE');
                }else if(auction_time==1 && enableTimerDelayer==true){
                    $('#slider-counter_index_page_' + auction_id).css('color', '#E80000');
                    $('#slider-counter_index_page_' + auction_id).html('GOING TWICE');
		    
		               if($('#slider-seat_count_'+auction_id).length > 0){
                                $('#slider-seat_count_'+auction_id).remove();
                               
                                $('#slider-seat_bar_'+auction_id).remove();
			       }
                                
		   //
		    
                }else if (auction_time<=0) {
                    $('#slider-counter_index_page_' + auction_id).css('color', sold_color);
                    $('#slider-counter_index_page_' + auction_id).html('SOLD');
                    $('#slider-image_main_' + auction_id).attr('onclick', '');
                    $('#slider-image_main_' + auction_id).attr('name','');
                    $('#slider-image_main_' + auction_id).text('SOLD');
		   
		//     remove_auction(auction_id);
		    
		    
                } else if (pausestatus==1) {
                    $('#slider-counter_index_page_' + auction_id).html('Pause');
                    $('#slider-image_main_' + auction_id).attr('onclick', '');
                    $('#slider-image_main_' + auction_id).attr('name','');
                    $('#slider-image_main_' + auction_id).text('PAUSE');
                } else {
                    if(enableTimerDelayer==true){
                        auction_time-=2;
                    }

                    if (auction_time<10) {



			$('#slider-counter_index_page_' + auction_id).css('color', '#E80000');
                        $('#slider-counter_index_page_' + auction_id).html(calc_counter_from_time(auction_time));



                    } else {

                        $('#slider-counter_index_page_' + auction_id).css('color', color);
                        $('#slider-counter_index_page_' + auction_id).html(calc_counter_from_time(auction_time));


		    }
		     if(isNaN(item.reserve) ){

			  if(item.san | (!is_null(userid) & userid != '' && !is_null(item.seated_users))){

					if(item.sc >= item.ms){
					   flip_auction_type(auction_id, item.prid);
					   
					   
					  }else{
					    if(inArray(userid, item.sbids)){

						$('#slider-seat_button_' + auction_id).html('<a name="" class="button bid-button-link" id="slider-image_main_' + auction_id + '">Seated</a>');
						    if(item.sc == item.ms){
							
							  if(inArray(userid, item.sbids)){
							    
							    
							    flip_auction_type(auction_id, item.prid);
							    
							  }
						      
						      
						      } 
					    }
					  }

					}  		  

text = '<div style="position:relative;top:-15px;z-index:0;"></div>';
text += '<div style="text-align:center;position:relative;z-index:5;color:red;width:auto;height:auto;top:-55px;margin-bottom:-25px;min-height:25px;"><blink>';
text += item.reserve + '</blink></div>';

                        $('#slider-counter_index_page_' + auction_id).append(text);

			     if($('#topbidder_index_page_' + auction_id).length>0){
                                //PennyAuctionSoft add for top bidder
                                
                              if(item.sa==true && parseInt(item.sc) < parseInt(item.ms)){
				    topbidder=item.seated_users;
				}else{
				  
				  
				  topbidder=item.tb;
				}
				if(document.getElementById('slider-topbider_index_page_' + auction_id)){
                                acls=$('#slider-topbider_index_page_' + auction_id).attr('class');
                                totalcount=0;

				
                                if(acls.indexOf('i4')>0){
                                    totalcount=4;
                                }else if(acls.indexOf('i3')>0){
                                    totalcount=3;
                                }
                              
                                if(totalcount>0 && topbidder!=null){
                                    bidderhtml="";
                                    $.each(topbidder,function(i,bitem){
                                        bidderhtml+='<li><a>'+bitem+'</a></li>';
                                        totalcount--;
                                        if(totalcount==0) return false;
                                    });
                                    for(i=totalcount-1;i>=0;i--){
				if(isNaN(item.reserve)){
				  bidderhtml+='<li><a>---</a></li>';
			       }else{
                                        bidderhtml+='<li><a>---</a></li>';
					
			       }
				 
                                    }
                                    $('#slider-topbider_index_page_' + auction_id).html(bidderhtml);
                                }
				}
			       //}
			       
			       if(document.getElementById('slider-topbider_index_page_' + auction_id)){
			       acls=$('#slider-topbider_index_page_' + auction_id).attr('class');
                                totalcount=0;
                                if(acls.indexOf('i4')>0){
                                    totalcount=4;
                                }else if(acls.indexOf('i3')>0){
                                    totalcount=3;
                                }
                                if(!item.seated_users){
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
                                    $('#slider-topbider_index_page_' + auction_id).html(bidderhtml);
                                }
                                
				}
			       }
			}




			
		     }
		     



                    $('#slider-image_main_' + auction_id).show();
                }

                if($('#blink_img_'+auction_id).length){
                    if(auction_time>0 && auction_time<=15){
                        $('#blink_img_'+auction_id).css('display', 'block');
                    }else{
                        $('#blink_img_'+auction_id).css('display', 'none');
                    }
                }



	    }
            
	    
	 //     }

	      	
		    
        });
    }
   
}
