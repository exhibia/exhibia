<?php
include("../../../config/config.inc.php");

$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);


db_select_db($DATABASENAME, $db);
if(empty($_REQUEST['edit_page'])){











      }else{
      
      
      
	    switch($_REQUEST['add_new_page']){


		  case('true'):
		  if(!empty($_REQUEST['page_text'])){
			  if(!empty($_REQUEST['page_name']) & preg_match('/([a-zA-Z])/i', $_REQUEST['page_name']) ){
			  
			      $template = file_get_contents($BASE_DIR . "/include/addons/blank_page/$template/index.txt");
			      
			      $template = str_replace("<!--custom_page--><!--custom_page-->", "<!--custom_page-->$_REQUEST[page_text]<!--custom_page-->", $template);
			      
			      $fp = fopen($BASE_DIR . "/$_REQUEST[page_name].php", "w+");
			      
			      fwrite($fp, $template);
			      
			      fclose($fp);
			  
			      if(db_num_rows(db_query("select * from navigation where link_text like '%$_REQUEST[page_name]%'")) == 0){
			      
				  db_query("insert into navigation values(null, '$_REQUEST[menu]', '<a href=\"$_REQUEST[page_name]\">', '$_REQUEST[title]', '$_REQUEST[enabled]', '$_SESSION[username]', '');");
			      
			      }
			     echo "Your New Page has been saved as <a href=\"$_REQUEST[page_name].php\" target=\"_blank\">$_REQUEST[page_name].php</a>";
			     
			     $_REQUEST['page_name'] = $_REQUEST['page_name'] . '.php';
			  }else{
			  echo "You must supply an alphabetical Page Name without punctuation";
			  
			  }
		  
		  }
		  if(!empty($_REQUEST['page_name'])){
			$file = file_get_contents($BASE_DIR . "/$_REQUEST[page_name]");
			$content = explode("<!--custom_page-->", $file);
			
		  
		  } 
		 
			    ?>

                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>Add Page
                                </h2>
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
                                                    <!--[if !IE]>start system messages<![endif]-->

                                                    <ul class="system_messages">                                                     
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>

                                                    <br/>
                                                    
                                <div id="container-new" onclick="CKEDITOR.inline(document.getElementById('container-new'));" contenteditable="true" style="border-radius:10px;min-height:500px;border:2px dashed red;"><?php echo $content[1]; ?></div>                     
			    <form id="new_page" action="javascript: write_page_to_filesystem();" style="background:#fff;border-radius:8px;">
				<table align="center">
				      <tr>
					  <td colspan="2" align="center">
					   
					     <!-- <textarea class="ckeditor" onclick="CKEDITOR.replace(this.id);" id="page_text">
					      <?php echo @$content[1]; ?>
					      </textarea>-->
					  </td>
				      </tr>
				      <tr>
					  <td style="width:300px;">
					      <h2>Page Name</h2>
					      <input type="text" id="page_name" name="page_name" value="<?php echo str_replace(".php", "", $_REQUEST['page_name']); ?>" />
					  </td>
					  <td style="width:300px;">
					      <h2>Menu</h2>
					      <select id="menu_add_selector" name="menu_add_selector">
					      <?php
					      $qry = db_query("select distinct(menu_name) from navigation");
						  while($row = db_fetch_array($qry)){
						  ?>
						  <option value="<?php echo $row['menu_name']; ?>"><?php echo ucwords(str_replace("_", " ", $row['menu_name'])); ?></option>
						  <?php
						  }
						  
					      ?>
					      <input type="hidden" id="add_new_page" value="Submit <?php echo $_REQUEST['add_new_page'];?>" />
					  </td>
				      </tr>
				</table>
				  <span class="button send_form_btn"><input name="add_new_page" type="submit" /></span>
                                                                        
			    </form>
			   
			    <script>
			   //CKEDITOR.inline(document.getElementById("container-new"));
			    </script>
			    <?php
		  break;
		  case('addproduct'):
		      include($BASE_DIR . "/include/addons/blank_page/addproducts.php");
		  break;
		  case('addcategory'):
			include($BASE_DIR . "/include/addons/blank_page/addcategory.php");
		  break;
		  case('addauction'):
		
			include($BASE_DIR . "/include/addons/blank_page/addauction.php");
		  break;
		  case('addFAQ'):
			include($BASE_DIR . "/include/addons/blank_page/addFAQ.php");
		  break;
		  case('addhelptopic'):
			include($BASE_DIR . "/include/addons/blank_page/addhelptopic.php");
		  break;
		 
		      

	    }
      
      
      
      
      
      
      
      
      
}
?>

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
<div style="display:none;" id="page_name_submit"><?php echo $_REQUEST['add_new_page']; ?></div>
<div style="margin-bottom:300px;"></div>