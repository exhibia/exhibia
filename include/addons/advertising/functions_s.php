<?php

/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'data/advertposition.php';
include_once 'data/advertgroup.php';
include_once 'data/advertslide.php';
if(!function_exists('showAdvertise')){
function showAdvertise($position) {
    $addb = new AdvertPosition(null);

    if ($addb->isActive($position)) {
        $adgroupdb = new AdvertGroup(null);
        $adslidedb = new AdvertSlide(null);
        $adgroupresult = $adgroupdb->selectByPosition($position);
        if (db_num_rows($adgroupresult) > 0) {
            echo '<div style="margin-bottom:5px;">';
            while ($adgroup = db_fetch_object($adgroupresult)) {
                echo '<script type="text/javascript">';
                echo '$(document).ready(function(){';
                echo "$('#adgroup_{$adgroup->id}').coinslider({navigation: false,width:{$adgroup->width},height:{$adgroup->height},delay:{$adgroup->delay},effect:'{$adgroup->effect}'});";
                echo '});';
                echo '</script>';
                echo '<div id="adgroup_'.$adgroup->id.'" style="margin-top:5px;">';
                $adslideresult = $adslidedb->selectByGroup($adgroup->id);
                while ($adslide = db_fetch_object($adslideresult)) {
                    echo '<a href="'.$adslide->url.'" target="_blank">';
                    echo '<img alt="" src="uploads/advertise/'.$adslide->image.'" width="'.$adgroup->width.'" height="'.$adgroup->height.'" /> ';
                    echo '</a>';
                }
                echo '</div>';
                db_free_result($adslideresult);
            }
            echo '</div>';

        }
        db_free_result($adgroupresult);
    }
}
}
