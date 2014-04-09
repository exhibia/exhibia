<?php
@db_query("alter table categories add column featured int(1) default '0' null");

db_query("update categories set featured = '$_POST[featuredstatus]' where categoryID = '$cat_id'");

