<?php

$id = db_insert_id();
db_query("update categories set vendor_reqired = '$_POST[vendor_required]' where categoryID = '$id'");
