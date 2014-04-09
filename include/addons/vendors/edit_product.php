<?php

db_query("update products set vendor = '$_POST[vendor]' where productID = '$pid'");
