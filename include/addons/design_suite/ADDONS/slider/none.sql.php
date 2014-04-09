<?php

db_query("update style_sheets set value = 'none' where property = 'display' and selector = 'p.jshowoff-slidelinks a' and template = '$template");
