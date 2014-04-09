function ajax_PAS_return(url,senddata,method){
$('#css-editor').css('display', 'none');
$('#my_css_editor_loading_bar').css('display', 'block');
        $.ajax({

		method: method,
	      url: url,
	      data: senddata,
	      success: function (response) {
                return response;
            }

	    }
        );
setup_mce();


	}