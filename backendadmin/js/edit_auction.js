
function delconfirm(loc)
    {
        if(confirm("Are you sure do you want to delete this?"))
        {
            window.location.href=loc;
        }
        return false;
    }

    function Check(f1)
    {
        if($('#category').val()=="none")
        {
            alert("Please Select Category!!!");
            $('#category').focus();
            return false;
        }

        if($('#product').val()=="none")
        {
            alert("Please Select Product!!!");
            document.f1.product.focus();
            return false;
        }

        if($("#uniqueauction").attr('checked')==false){
            if(document.f1.aucstartprice.value=="")
            {
                alert("Please Enter Auction Start Price!!!");
                $('#uniqueauction').focus();
                return false;
            }
        }

        if($('#specialauction').attr('checked') == true ){
            if(document.f1.specialprice.value == "")
            {
                alert("Please Enter Special Auction Price!!!");
                $('#specialprice').focus();
                return false;
            }
        }

        if($('#uniqueauction').attr('checked')==true && $('#reverseauction').attr('checked')==true){
            alert("Can't check uniqueauctions and reverseauction at the same time!!!");
            return false;
        }

        if($('#uniqueauction').attr('checked')==true && $('#seatauction').attr('checked')==true){
            alert("Can't check uniqueauctions and seatauction at the same time!!!");
            return false;
        }

      
        if(document.f1.aucstartdate.value=="")
        {
            alert("Please Select Auction Start Date!!!");
            document.f1.aucstartdate.focus();
            return false;
        }

        if(document.f1.aucenddate.value=="")
        {
            alert("Please Select Auction End Date!!!");
            document.f1.aucenddate.focus();
            return false;
        }
        var aucsdate = condate(document.f1.aucstartdate.value);
        var curdate = condate(document.f1.curdate.value);
        var aucedate = condate(document.f1.aucenddate.value);
        var newaucsdate = new Date(aucsdate);
        var newcurdate = new Date(curdate);
        var newaucedate = new Date(aucedate);

        var newtime = document.f1.curtime.value;
        var temptime = newtime.split(":");

        var newtimehour = temptime[0];
        var newtimeminute = temptime[1];
        var newtimeseconds = temptime[2];

<?php if (($aucstatus == 2 && $_REQUEST["auction_edit"] == "") || $aucstatus == 1 || $aucstatus == "" || $_REQUEST["auction_clone"] != "") { ?>
    if(newcurdate>newaucsdate)
    {
        alert("Auction Start Date should not be past date.")
        document.f1.aucstartdate.focus();
        return false;
    }
    if(newcurdate>newaucedate)
    {
        alert("Auction End Date should not be past date.")
        document.f1.aucenddate.focus();
        return false;
    }
    if(newaucsdate>newaucedate)
    {
        alert("Auction End date should be greater than Auction Start date");
        document.f1.aucenddate.focus();
        return false;
    }
    if(newaucsdate>newcurdate)
    {
        document.f1.changestatusval.value = "1";
    }
    if(document.f1.startimmidiate.checked==false)
    {
        if(document.f1.changestatusval.value != "1")
        {
            if(Number(newtimehour)<Number(document.f1.aucstarthours.value))
            {
                document.f1.changestatusval.value = "1";
            }
            else
            {
                if(Number(newtimeminute)<Number(document.f1.aucstartminutes.value))
                {
                    document.f1.changestatusval.value = "1";
                }
            }
        }
        if(document.f1.changestatusval.value != "1")
        {
            if(document.f1.aucstarthours.value<newtimehour)
            {
                alert("Auction start time should not be past time");
                document.f1.aucstarthours.focus();
                return false;
            }
            else
            {
                if(document.f1.aucstarthours.value==newtimehour)
                {
                    if(document.f1.aucstartminutes.value<newtimeminute)
                    {
                        alert("Auction start time should not be past time");
                        document.f1.aucstartminutes.focus();
                        return false;
                    }
                }
            }

            if(document.f1.aucendhours.value<newtimehour)
            {
                alert("Auction end time should not be past time");
                document.f1.aucendhours.focus();
                return false;
            }
            else
            {
                if(document.f1.aucendminutes.value<newtimeminute)
                {
                    if(document.f1.aucendhours.value==newtimehour)
                    {
                        alert("Auction end time should not be past time");
                        document.f1.aucendminutes.focus();
                        return false;
                    }
                }
                else
                {
                    if(document.f1.aucendminutes.value==newtimeminute)
                    {
                        if(document.f1.aucendseconds.value<newtimeseconds)
                        {
                            alert("Auction end time should not be past time");
                            document.f1.aucendseconds.focus();
                            return false;
                        }
                    }
                }
            }
        }
    }
    else
    {
        if(aucsdate==aucedate)
        {
            if(document.f1.aucendhours.value<newtimehour)
            {
                alert("Auction end time should not be past time");
                document.f1.aucendhours.focus();
                return false;
            }
            else
            {
                if(document.f1.aucendminutes.value<newtimeminute)
                {
                    if(document.f1.aucendhours.value==newtimehour)
                    {
                        alert("Auction end time should not be past time");
                        document.f1.aucendminutes.focus();
                        return false;
                    }
                }
                else
                {
                    if(document.f1.aucendminutes.value==newtimeminute)
                    {
                        if(document.f1.aucendseconds.value<newtimeseconds)
                        {
                            alert("Auction end time should not be past time");
                            document.f1.aucendseconds.focus();
                            return false;
                        }
                    }
                }
            }
        }
    }
<?php } ?>
if(document.f1.aucstarthours.value=="")
{
    alert("Please Select Auction Start Time!!!");
    document.f1.aucstarthours.focus();
    return false;
}

if(document.f1.aucstartminutes.value=="")
{
    alert("Please Select Auction Start Time!!!");
    document.f1.aucstartminutes.focus();
    return false;
}

if(document.f1.aucstartseconds.value=="")
{
    alert("Please Select Auction Start Time!!!");
    document.f1.aucstartseconds.focus();
    return false;
}

if(document.f1.aucendhours.value=="")
{
    alert("Please Select Auction End Time!!!");
    document.f1.aucendhours.focus();
    return false;
}

if(document.f1.aucendminutes.value=="")
{
    alert("Please Select Auction End Time!!!");
    document.f1.aucendminutes.focus();
    return false;
}

if(document.f1.aucendseconds.value=="")
{
    alert("Please Select Auction End Time!!!");
    document.f1.aucendseconds.focus();
    return false;
}

if(document.f1.fpa.checked==true && document.f1.off.checked==true)
{
    alert("You can't select fixed price auction type with 100% off auction type!!!");
    return false;
}

if(document.f1.allowbuynow.checked==true && document.f1.buynowprice.value==""){
    alert("You should enter a buy now price");
    return false;
}

if(aucsdate==aucedate)
{
    if(Number(document.f1.aucendhours.value)<Number(document.f1.aucstarthours.value))
    {
        alert("Auction end time should be greater than auctin start time!!!");
        document.f1.aucendhours.focus();
        return false;
    }
    else
    {
        if(Number(document.f1.aucendhours.value)==Number(document.f1.aucstarthours.value))
        {
            if(Number(document.f1.aucendminutes.value)<Number(document.f1.aucstartminutes.value))
            {
                alert("Auction end time should be greater than auctin start time!!!");
                document.f1.aucendminutes.focus();
                return false;
            }
            else
            {
                if(Number(document.f1.aucendminutes.value)==Number(document.f1.aucstartminutes.value))
                {
                    if(Number(document.f1.aucendseconds.value)==Number(document.f1.	aucstartseconds.value))
                    {
                        alert("Auction end time should be greater than auctin start time!!!");
                        document.f1.aucendseconds.focus();
                        return false;
                    }

                }
            }
        }
    }
}

if(document.f1.fpa.checked==false && document.f1.pa.checked==false && document.f1.nba.checked==false && document.f1.off.checked==false && document.f1.na.checked==false && document.f1.oa.checked==false && document.f1.uniqueauction.checked==false && document.f1.reverseauction.checked==false && document.f1.halfback.checked==false && document.f1.seatauction.checked==false && document.f1.lockauction.checked==false)
{
    alert("Please select auction type");
    return false;
}
if(document.f1.shippingmethod.value=="none")
{
    alert("Please select shipping charge method");
    document.f1.shippingmethod.focus();
    return false;
}

if($('#seatauction').attr('checked')==true){
    if(Number($('#minseats').val())<=0){
        alert('Min Seats Must be greater  then 0');
        return false;
    }

    if(Number($('#maxseats').val())!=0 && Number($('#minseats').val()) > Number($('#maxseats').val())){
        alert('Max Seats Must greater or equal min seats');
        return false;
    }

    if(Number($('#seatbids').val())<=0){
        alert('SeatBids must greater then 0');
        return false;
    }
}

if($('#lockauction').attr('checked')==true){
    if($('#locktype').val()==1){
        var locktime=(Number($('#lockhour').val())*60+Number($('#lockminute').val()))*60+Number($('#locksecond').val());
        if(locktime<=0){
            alert('Please enter when to lock the auction');
            return false;
        }
    }else if($('#locktype').val()==2){
        if(Number($('#lockprice').val())<=0){
            alert('Please enter lock price');
            return false;
        }
    }
}
}

function condate(dt)
{
var ndate= new String(dt);
//alert(dt);
var fdt=ndate.split("/");
var nday=fdt[0];
var nmon=fdt[1];
var nyear=fdt[2];

var finaldate=nmon+"/"+nday+"/"+nyear;
//alert(finaldate);

return finaldate;
}

$(function() {
                $.datepicker.setDefaults({dateFormat:'dd/mm/yy'});
                $("#aucstartdate").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                $("#aucenddate").datepicker({showOn: 'button', buttonImage: 'images/pmscalendar.gif', buttonImageOnly: true});
                $("#allowbuynow").click(function(){
                    if($(this).attr('checked') == true){
                        $("#buynowprice").attr('disabled',false).val('');
                    }else{
                        $("#buynowprice").attr('disabled',true).val('');
                    }
                    
                });

                $("#specialauction").live('click',function(){
                    if($(this).attr('checked') == true){
                        $("#specialprice").attr('disabled',false).val('');
                    }else{
                        $("#specialprice").attr('disabled',true).val('');
                    }                    
                });

                $('#uniqueauction').change(function(){
                    if($(this).attr('checked')==true){
                        $('#normalauction').hide();
                    }else{
                        $('#normalauction').show();
                    }
                });

                $('#fpa').change(function(){
                    if($(this).attr('checked')==true){
                        $('#aucfixedprice').attr('disabled', false);
                    }else{
                        $('#aucfixedprice').attr('disabled', true);
                        $('#aucfixedprice').val('0.00');
                    }
                });

                $('#reverseauction').change(function(){
                    if($(this).attr('checked')==true){
                        $('#reserverInput').show();
                    }else{
                        $('#reserverInput').hide();
                    }
                });

                $('#seatauction').change(function(){
                    if($(this).attr('checked')==true){
                        $('#seatauction_panel').show();
                    }else{
                        $('#seatauction_panel').hide();
                    }
                });

                $('#lockauction').change(function(){
                    if($(this).attr('checked')==true){
                        $('#lockauction_panel').show();
                    }else{
                        $('#lockauction_panel').hide();
                    }
                });

                $('#locktype').change(function(){
                    if($(this).val()==1){
                        $('#locktime_row').show();
                        $('#lockprice_row').hide();
                    }else if($(this).val()==2){
                        $('#locktime_row').hide();
                        $('#lockprice_row').show();
                    }
                });

                $('#category').change(function(){
                    $.ajax({
                        url:'getproductlist.php',
                        data:{crid:$(this).val()},
                        dataType:'html',
                        type:'POST',
                        success:function(data){
                            $('#product').html(data);
                        }
                        
                    });
                });

                $('#product').change(function(){
                    var isbidpack=$('#category').val()=='1';
                    $.ajax({
                        url:'getprice.php',
                        data:{prid:$(this).val(),isbidpack:isbidpack},
                        type:'POST',
                        dataType:"json",
                        success:function(data){
                            var temp=data.price.split("|");
                            $("#getprice").html(temp[0]);
                            $("#buynowprice").val(temp[0]);

                            var imghtml="";
                            if(data.picture1!=''){
                                imghtml+="<img src=\"../uploads/products/thumbs_big/thumbbig_"+data.picture1+"\">";
                            }

                            if(data.picture2!=''){
                                imghtml+="<img src=\"../uploads/products/thumbs_big/thumbbig_"+data.picture2+"\">";
                            }

                            if(data.picture3!=''){
                                imghtml+="<img src=\"../uploads/products/thumbs_big/thumbbig_"+data.picture3+"\">";
                            }

                            if(data.picture4!=''){
                                imghtml+="<img src=\"../uploads/products/thumbs_big/thumbbig_"+data.picture4+"\">";
                            }

                            $("#product_picture").html(imghtml);
                        }
                    });
                });

                $('#startimmidiate').change(function(){
                    $('#aucstarthours').attr('disabled',$(this).attr('checked'));
                    $('#aucstartminutes').attr('disabled',$(this).attr('checked'));
                    $('#aucstartseconds').attr('disabled',$(this).attr('checked'));
                });
});