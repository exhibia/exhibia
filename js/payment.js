/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function OpenDetails(value){
 
  $('form[name="payment"] p').removeClass('highlight')
    $('.payment_form').css('display', 'none');
    $('#'+value).css('display', 'block');
    $('#' + value + '_select').addClass('highlight');

}



function setname(name)
            {
	     
                var temp = document.getElementById('bidpackname'+name).value;
                document.getElementById('bidpackname').innerHTML = temp;
            }
	    function set_bidpack(id){
	   
		  $('#bidpackid').val(id);
	     }