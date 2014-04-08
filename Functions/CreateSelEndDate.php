<?php
function CreateSelEndDate() {
    return date("Y-m-d H:i:s", mktime("0", "0", "0", date("m"), date("d") - 30, date("Y")));
}