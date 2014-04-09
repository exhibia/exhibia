<?php


db_query("update categories set vendor_reqired = '$_POST[vendor_required]' where categoryID = '$edit'");
echo db_error();