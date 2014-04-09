<?php

/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function IsValidUrl($url) {
    return preg_match("/^http\://[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(/\S*)?$", $url);
}
?>
