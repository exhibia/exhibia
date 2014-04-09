function change_preview(divId){

    $('.templates').css('display', 'none');
    $('#templ_' + divId).css('display', 'block');
    $('#templ_desc_' + divId).css('display', 'block');
}