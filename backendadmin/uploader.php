<?php

   for ($i = 1; $i <= 4; $i++) {

        if (!empty($_FILES["image$i"]["name"])) {





            
            if (isset($_FILES["image" . $i]) && preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $_FILES["image" . $i]["name"]) && preg_match('/\.(php|asp|jsp)$/i', $_FILES["image" . $i]["name"]) ==
false) {
                if ($_FILES["image" . $i]["name"] != "") {

$target_path = "../uploads/test/" . basename( $_FILES['image' .$i]['name']);
if(move_uploaded_file($_FILES['image' .$i]['tmp_name'], $target_path)) {
   // echo "The file ".  basename( $_FILES['image' .$i]['name'])." has been uploaded";
} else{
    echo "There was an error uploading the file, please try again!";

}
                    deleteImage($tempobj['picture' . $i]);
$logo_temp = $target_path;

                    $time = time();
                    $logo = $i . "_" . $time . "_" . str_replace(" ", "_", $_FILES["image" . $i]["name"]);
		    $name = basename( $_FILES['image' .$i]['name']);



                    productimage($logo, $pid, $logo_temp);

                    db_query("update products set picture" . $i . "='" . $logo . "' where productID=$pid") or die(db_error());
                }
            }
        }
    }
   
?>
 