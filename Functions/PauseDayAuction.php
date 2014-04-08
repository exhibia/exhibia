<?php

function PauseDayAuction() {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    db_query("update auction set pause_status=1 where auc_status='2' and nightauction=0") or die(db_error());
}

function RunDayAuction() {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    db_query("update auction set pause_status=0 where auc_status='2' and pause_status=1") or die(db_error());
}