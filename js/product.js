function toggleRelatedAuctions() {
    if ($('#expand-auctions').hasClass('open')){
        $('#open-auctions').hide();
        $('#expand-auctions').removeClass('open');
    }
    else{
        $('#open-auctions').show();//.toggle('slide', { direction: 'down'},300,function(){
        $('#expand-auctions').addClass('open');
    //});
    }
}

function toggleProductDescription() {
    if ($('#expand-description').hasClass('open')){
        $('#open-description').hide();
        $('#expand-description').removeClass('open');
    }
    else{
        $('#open-description').show();//.toggle('slide', { direction: 'down'},300,function(){
        $('#expand-description').addClass('open');
    //});
    }
}


$(document).ready(function(){

    $('.tt-auction-type').each(function() {
        $(this).easyTooltip({
            content: $(this).attr("ref"),
            useElement: "",
            xOffset: -70,
            yOffset: -35,
            fixed: false,
            wavee: true,
            keepHover: false,
            clickRemove: true,
            width: 150
        })
    });

});

$(document).ready(function(){
    $('#history-selector').hover(
        function(){
            showOption($('#'+$(this).attr('ref')));
        },
        function(){
            hideOption($('#'+$(this).attr('ref')));
        }
        );

    $('#history-selector-options').hover(
        function(){
            showOption($(this));
        },
        function(){
            hideOption($(this));
        }
        );

    $('#history-selector-options .tools-selector-option').click(function(){
        $('#history-selector-options').hide();
        $('#history-selector').html($(this).html());
        $('.history-table').hide(500);
        $('#'+$(this).attr('ref')).show(500);
    });



     $('#tools-selector').hover(
        function(){
            showOption($('#'+$(this).attr('ref')));
        },
        function(){
            hideOption($('#'+$(this).attr('ref')));
        }
        );

    $('#tools-selector-options').hover(
        function(){
            showOption($(this));
        },
        function(){
            hideOption($(this));
        }
        );

    $('#tools-selector-options .tools-selector-option').click(function(){
        $('#tools-selector-options').hide();
        $('#tools-selector').html($(this).html());
        $('.autobidder-content-panel').hide(500);
        $('#'+$(this).attr('ref')).show(500);
    });

});

var toolOptionTimeout;

function showOption(obj){
    clearTimeout(toolOptionTimeout);
    $(obj).show();
}
function hideOption(obj){
    clearTimeout(toolOptionTimeout);
    var id=$(obj).attr('id');
    toolOptionTimeout=setTimeout(function(){
        _hideOption(obj);
    },300);
}

function _hideOption(obj){
    $(obj).hide();
}