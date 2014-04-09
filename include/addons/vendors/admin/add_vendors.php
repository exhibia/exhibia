<?php
@db_query("alter table vendors add column address1 varchar(100)");
@db_query("alter table vendors add column address1 varchar(100)");
@db_query("alter table vendors add column city varchar(100)");
@db_query("alter table vendors add column state varchar(100)");
@db_query("alter table vendors add column country varchar(100)");
@db_query("alter table vendors add column zipcode varchar(100)");
@db_query("alter table vendors add column email varchar(100)");
@db_query("alter table vendors add column phone varchar(100)");
if(!empty($_POST['add'])){

if(db_num_rows(db_query("select * from vendors where company_name = '" . addslashes($_POST['company_name']) . "'")) == 0){

      db_query("insert into vendors(id, company_name) values(null, '$_POST[company_name]');");
      
      
      $where = "company_name = '" . addslashes($_POST['company_name']) . "'";

}else{
      $where = "company_name = '" . addslashes($_POST['company_name']) . "'";

}
    foreach($_POST as $key => $value){
    
	if($key != 'add'){
	
	  db_query("update vendors set $key = '". addslashes($value) . "' where $where");
	
	}
$_REQUEST['vendor'] = $_POST['company_name'];


}

?>
<script>

window.location.href = 'message.php?msg_set=<?php echo urlencode("Successfully updated vendor information for $_POST[company_name]");?>';

</script>

<?php

}


if(!empty($_REQUEST['vendor'])){
    $vendor = db_fetch_object(db_query("select * from vendors where company_name = '" .urldecode($_REQUEST['vendor']) . "' limit 1"));



}
?>
    <div class="section_content">
      
       <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->

                            <div class="title_wrapper">
                                <h2>Add a Vendor</h2>
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>
                                <!--[if !IE]>start section content top<![endif]-->
                                <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">
                                                    <!--[if !IE]>start system messages<![endif]-->

                                                    <ul class="system_messages">
                                                        <?php if ($msg != "") {
                                                        ?>
                                                            <li class="red"><span class="ico"></span><strong class="system_title"><?= $msg; ?></strong></li>
                                                        <?php } ?>
                                                        <li class="blue"><span class="ico"></span><strong class="system_title"><span class="required">*</span> Required Information</strong></li>
                                                    </ul>

                                                    <!--[if !IE]>end system messages<![endif]-->

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form action="addvendors.php" method="post" onsubmit="return validation(this);" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Company Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="company_name" id="company_name" value="<?php echo $vendor->company_name;?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                           
                                                            

                                                              
								<!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Phone Number:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="phone" id="phone" value="<?php echo $vendor->phone;?>"/>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Address Line 1:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="address1" id="address1" value="<?php echo $vendor->address1;?>" />
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Address Line 2:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="address2" id="address2" value="<?php echo $vendor->address2;?>" />
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>City:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="city" id="city" value="<?php echo $vendor->city;?>" />
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>State:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="state" id="state" value="<?php echo $vendor->state;?>"/>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Country:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper blank">
                                                                            <select name="country" id="country" value="<?php echo $vendor->country;?>">
                                                                                <option value="none">please select one</option>
                                                                                <?
                                                                                $qrycou = "select * from countries";
                                                                                $rescou = db_query($qrycou);
                                                                                while ($cou = db_fetch_array($rescou)) {
                                                                                ?>
                                                                                    <option value="<?= $cou["countryId"]; ?>"><?= $cou["printable_name"]; ?></option>
                                                                                <?
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Zipcode:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="zipcode" id="zipcode" value="<?php echo $vendor->zipcode;?>" />
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->


                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Email:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="email" id="email" value="<?php echo $vendor->email;?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Confirm Email:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper">
                                                                            <input class="text" type="text" name="cnfemail" id="cnfemail" value="<?php echo $vendor->email;?>" />
                                                                        </span>
                                                                        <span class="system required">*</span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                                                                        

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <div class="buttons">
                                                                        <ul>
                                                                            <li>                                                                               
                                                                                <span class="button send_form_btn"><span><span>Add</span></span><input name="add" type="submit"/></span>


                                                                            </li>

                                                                        </ul>

                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->
                                                            </div>
                                                            <!--[if !IE]>end forms<![endif]-->

                                                        </fieldset>
                                                        <!--[if !IE]>end fieldset<![endif]-->
                                                    </form>
                                                    <!--[if !IE]>end forms<![endif]-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
