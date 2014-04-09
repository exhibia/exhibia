<?php

$_SESSION['admin'] = 2;
$active="Design";
include_once("admin.config.inc.php");
include("connect.php");

$default=$_REQUEST['default'];
$backend = 'true';

if(!empty($_REQUEST['submit']) & empty($_REQUEST['submit_page'])){

include("DESIGN/process_$_REQUEST[page]");
}
$ds_enabled = 'true';
$backend = 'true';
$_REQUEST['page'] = $template . ".css";
$_REQUEST['template'] = $template;



session_start();

$_REQUEST['template'] = $template;
@shell_exec("ln -s $BASE_DIR/include/addons $BASE_DIR/backendadmin/include/addons");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Welcome to <?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="<?php echo $SITE_URL;?>/backendadmin/js/behaviour.js"></script>
	<script>
	function changefield(){

	str = "<input type=\"hidden\" id=\"new_constant\" name=\"new_constant\" value=\"yes\" />";

	str += "<input id=\"constant\" type=\"text\" value=\"\" name=\"constant\" />";
	  document.getElementById("constant_wrap").innerHTML = str;
	  CKEDITOR.instances['lang_value'].destroy();
	  var editor = CKEDITOR.inline('lang_value');

	}
	function add_new_text(){
	if($('#new').prop('checked') == true){
	  $('#value').text('Add your text here');
	  changefield();
	  $('#constant').attr('value', 'Add the name of the PHP constant that is missing');
	  $('#constant').css('width', '400px');
	  $('#id').attr('value', '');
	  $('#oldid').attr('value', '');
	  $('#choose_constant').css('display', 'none');
	  $('#oldlanguage').val('<?php echo $defaultlanguage;?>');
	  $('#target_language').val('<?php echo $defaultlanguage;?>');
	}else{
	    $('#css-editor').html();
	    $.get('<?php echo $SITE_URL;?>backendadmin/DESIGN/edit_text.php', function(response){
		$('#css-editor').html(response);
		CKEDITOR.instances['lang_value'].destroy();
		var editor = CKEDITOR.inline('lang_value');
	    });
	
	}

	}
	var submit_test_ajax_form = function(formId, url, container, method){

	    
 
 
	      if(!url){
	      try{
		if(CKEDITOR.instances['lang_value'].getData()){
		
		  data = 'value=' + encodeURIComponent(CKEDITOR.instances['lang_value'].getData()) + '&' + $('#' + formId).serialize();
		  $('#' + $('#constant').val()).html(CKEDITOR.instances['lang_value'].getData());
		 
		}else{
		  $('#' + $('#constant').val()).html(CKEDITOR.instances['lang_value'].getData());
		
		
		}
	      }catch(oo){
	      
	      data = $('#' + formId).serialize() + '&value=' + encodeURIComponent($('#lang_value').html()); 
	      
	      }
		  url = '<?php echo $SITE_URL;?>backendadmin/DESIGN/edit_text.php?' + data;
	      }else{
	      
	      data = $('#' + formId).serialize();
	      
		  try{ 
		  data = data + '&description=' + encodeURIComponent(CKEDITOR.instances['description'].getData()); 
		  }catch(oo){}
	      }
	      
	      
	      if(!data){
	      
		  data = $('#lang_value').html();
	      }
	      if(document.getElementById('choose_constant')){
	      idx = $('#choose_constant').val().split(' ');
	    
		  data += '&constant=' + $('#choose_constant option:selected').text();
	      }else{
	      
		  data += '&constant=' + $('#constant').val() + '&new_constant=' + $('#new_constant').val();
	      }
	      
	      data += '&target_language=' + $('#target_language').val();
	      data += '&oldlanguage=' + $('#oldlanguage').val();
	     
		$.get(url + '&' + data + '&dome=yes' , function(response){
		  if(!container){
			$('#dialog').html(response);
			$('#dialog').dialog();
			$('#editor').qtip('close');
			constant = $('#constant').val();
			if(constant.match(/SLIDER/)){
		      
			    edit_sliders($('#constant2').val());
			}else{
			
			    $('#css-editor').html(response);
			    CKEDITOR.instances['lang_value'].destroy();
			    var editor = CKEDITOR.inline('lang_value');
		      }
		      
		    }else{
		    
			$('#css-editor').html(response);
			CKEDITOR.instances['lang_value'].destroy();
			var editor = CKEDITOR.inline('lang_value');
		    
		    
		    }
		
		
		});
	    }
	  function change_constant(){
			    id = $("#choose_constant").val();
			    constant = $("#choose_constant option[value='" + id + "']").text();
	
			    id = constant + ":" + id;
			    
			      $.get("<?php echo $SITE_URL;?>backendadmin/DESIGN/edit_text.php?id=" + id, function(data){

				document.getElementById('css-editor').innerHTML = data;
					
					CKEDITOR.instances['lang_value'].destroy();
					var editor = CKEDITOR.inline('lang_value');	    
						      
				  });
			    
			    }
	</script>
 	

<?php

include("$BASE_DIR/page_headers.php");
?>
      <link media="screen" rel="stylesheet" type="text/css" href="<?php echo $SITE_URL;?>/backendadmin/css/admin.css"  />
      

<?php

include("$BASE_DIR/include/addons/design_suite/design_suite_headers.php");
//include("$BASE_DIR/include/addons/uploader/uploader.php");
?>
<link rel="stylesheet" type="text/css" href="<?php echo $SITE_URL;?>backendadmin/DESIGN/styles.css" />
<script type="text/javascript" src="<?php echo $SITE_URL;?>backendadmin/DESIGN/ajax.js"></script>
<?php
if($_REQUEST['a_page'] != 'special.php'){
?>
<script type="text/javascript" src="<?php echo $SITE_URL;?>backendadmin/DESIGN/browser.js"></script>
<?php
}else{
?>
<script type="text/javascript" src="<?php echo $SITE_URL;?>backendadmin/DESIGN/browser_special.js"></script>
<?php

}
?>
<script type="text/javascript">
function init(){
browser({
	contentsDisplay:document.getElementById("dvContents"),
	refreshButton:document.getElementById("btnrefresh"),
	pathDisplay:document.getElementById("pPathDisplay"),
	filter:document.getElementById("txtFilter"),
	openFolderOnSelect:true,
	onSelect:function(item,params){
	
		if(item.type=="folder"){
			return confirm("Do you want to open this Folder : "+item.path);
		}else{}
			
	},
	currentPath:"images"
	});
}

</script>
<base href="<?php echo $SITE_URL;?>backendadmin/" />
    </head>

    <body onload="<?php
if(!empty($_REQUEST['lang_pack'])){
?>
window.open('<?php echo $SITE_URL . "/backendadmin/my-archive.zip"; ?>','name','height=200,width=150');

<?php
}
?>">
        <!--[if !IE]>start wrapper<![endif]-->
        <div id="wrapper">
            <!--[if !IE]>start head<![endif]-->
            <div id="head">
                <?php include('include/header.php'); ?>
            </div>
            <!--[if !IE]>end head<![endif]-->

            <!--[if !IE]>start content<![endif]-->
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">
                    <div class="inner">
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Design Suite</h2>
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>
                            <!--[if !IE]>end title wrapper<![endif]-->
                            <!--[if !IE]>start section content<![endif]-->
                            <div class="section_content">
                                <!--[if !IE]>start section content top<![endif]-->
                                <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">
                                                    <!--[if !IE]>start dashboard menu<![endif]-->
                                                    <div class="dashboard_menu_wrapper" id="edit_area">
<?php
if(file_exists("DESIGN/index.php") & in_array('design_suite', $addons)){

if(empty($_REQUEST['a_page'])){
?>
                                                        <ul class="dashboard_menu">
                                                            <?php

                                                            include_once 'design.txt.php';

                                                            $ChildLinksSize = sizeof($ChildLinksArray);
                                                            for ( $j=0; $j<$ChildLinksSize; $j++ ) {
                                                                $subTitle=$ChildLinksArray[$j][0];
                                                                $subHref=$ChildLinksArray[$j][1];
                                                                $subclass=$ChildLinksArray[$j][3];
                                                                ?>
                                                            <li><a href="<?php echo $subHref; ?>" class="<?php echo $subclass; ?>"><span><?php echo $subTitle; ?></span></a></li>
                                                                <?php } /*end sub for*/?>
                                                        </ul>

<?php

}else{
include_once 'design.txt.php';

include($BASE_DIR . "/backendadmin/DESIGN/index.php");


}
}else{


echo "<h2>Please Contact Penny Auction Soft For This Feature</h2>";


}
?>
                                                    </div>
                                                    <!--[if !IE]>end dashboard menu<![endif]-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
                        <!--[if !IE]>end section<![endif]-->

                    </div>
                </div>
                <!--[if !IE]>end page<![endif]-->
                <!--[if !IE]>start sidebar<![endif]-->
                <div id="sidebar">
                    <div class="inner">
                        <?php include 'DESIGN/leftside.php' ?>
                    </div>
                </div>
                <!--[if !IE]>end sidebar<![endif]-->

            </div>
            <!--[if !IE]>end content<![endif]-->

        </div>
        <!--[if !IE]>end wrapper<![endif]-->

        <!--[if !IE]>start footer<![endif]-->
        <div id="footer">
            <div id="footer_inner">
                <?php include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

    </body>
</html>