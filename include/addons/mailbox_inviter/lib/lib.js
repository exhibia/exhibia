function show_contacts(){   
    var mail = $("#invite_mail").val(); 
    var pass = $("#invite_pass").val();      
      
        $.ajax({
            type: 'GET',
            url: 'mailbox_inviter/ajx.php',
            data: 'mod=contacts&mail='+mail+'&pass='+pass,                  
            success: function(message) {       
                $("#TB_ajaxContent").html(message);
            }              
        });
        
}

function check_all(evt){

 var checked_status = evt.checked;

 $("input[id=mails]").each(function()
 {
 this.checked = checked_status;
 });  

}

function send_invites(){

    var mail_data = new Array();
    var tit = $("#title").val();
    var sbj = $("#subject").val();
    var msg = $("#send_msg").val();
    var frm = $("#from").val();  
        
    var i = 0;    
    
    $("input[id=mails]").each(function()
    {    
       if( this.checked  ){
           mail_data[i++] = this.value;
       }
    });  
    
    if( i > 0 ){
        $("#TB_window").css("height", 150);       
        $("#result").html('<br><br><center><img src="images/loading.gif"></center>');   
        $.ajax({
            type: 'POST',
            url: 'mailbox_inviter/ajx.php',
            data: 'mod=send_invite&mails=' + mail_data+'&message='+msg+'&title='+tit+'&subject='+sbj+'&from='+frm,
            success: function(message) {        
                $("#result").html('<center><br><br><h2>Your invitations is sent to your firends. !</h2></center>');                   
            }
        });
    }
    else{
       alert("Please select contacts."); 
    }            
    
}