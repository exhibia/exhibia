<?php

function getAvatar($userid) {
    global $UploadImagePath, $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $sqlsel = "select a.avatar from avatar a left join registration r on r.avatarid=a.id where r.id='$userid'";

    $result = db_query($sqlsel);
    $avatar = $UploadImagePath . 'avatars/default.png';

    if (db_num_rows($result) > 0) {
        $obj = db_fetch_array($result);
        if ($obj['avatar'] != '') {
            $tempAvatar = $UploadImagePath . 'avatars/' . $obj['avatar'];
            if (file_exists($tempAvatar)) {
                $avatar = $tempAvatar;
            }
        }
        db_free_result($result);
    }

    return $avatar;
}
