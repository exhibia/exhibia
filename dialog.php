<div id="alert_message" title="<?php echo MESSAGE_TITLE; ?>">
    <p id="alert_message_content">

    </p>
</div>

<div id="confirm_message" title="<?php echo MESSAGE_CONFIRM; ?>">
    <p id="confirm_message_content">

    </p>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        
        $( "#alert_message" ).dialog({
            modal: true,
            autoOpen: false,
            buttons: {
                "<?php echo OK; ?>": function() {
                    $( this ).dialog( "close" );
                }
            }
        });

        $( "#confirm_message" ).dialog({
            autoOpen: false,
            modal:true,
            resizable:false,
            buttons: {
                "<?php echo OK; ?>": function() {
                    window.location.href=siteurl+'buybids.php';
                    $( this ).dialog( "close" );
                },
                "<?php echo CANCEL; ?>":function(){
                    $( this ).dialog( "close" );
                }
            }
        });



    });

    function showAlertBox(msg){
      try{
        $('#alert_message_content').html(msg);
        $('#alert_message').dialog('open');
        }catch(oops){ alert(msg); }
    }

    function showConfirmBox(msg){
      try {
        $('#confirm_message_content').html(msg);
        $('#confirm_message').dialog('open');
        }catch(oops){ alert(msg); }
    }

    function showAutoBidStart(){
        showAlertBox('<?php echo MESSAGE_ENTER_AUTOBIDDER_START_PRICEP; ?>');
    }

    function showAutoBidEnd(){
        showAlertBox('<?php echo MESSAGE_ENTER_AUTOBIDDER_END_PRICE; ?>');
    }

    function showAutoBids(){
        showAlertBox('<?php echo MESSAGE_ENTER_AUTOBIDDER_BIDS; ?>');
    }

    function showMoreThenOneBids(){
        showAlertBox('<?php echo MESSAGE_PLEASE_ENTER_MORE_THAN_ONE_BIDS; ?>');
    }

    function showEndGreaterStart(){
        showAlertBox('<?php echo MESSAGE_ENDPRICE_MUST_GREATER_THAN_STARTPRICE; ?>');
    }
    function showStartGreaterEnd(){
        showAlertBox('<?php echo MESSAGE_STARTPRICE_MUST_GREATER_THAN_ENDPRICE; ?>');
    }

function showInvalidPrice(){
    showAlertBox('<?php echo MESSAGE_INVALID_PRICE; ?>');
}


</script>
