<?php

function begin() {
    db_query("BEGIN");
}

function commit() {
    db_query("COMMIT");
}

function rollback() {
    db_query("ROLLBACK");
}
function dbase(){
//Place holder function in case these file needs to be staticly loaded

}