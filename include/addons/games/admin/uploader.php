<?php
$i = 1;
  while( $i <= 3) {

        if (!empty($_FILES["image$i"]["name"])) {





            
            if (isset($_FILES["image" . $i]) && preg_match('/\.(jpg|jpeg|gif|jpe|png|bmp)$/i', $_FILES["image" . $i]["name"]) && preg_match('/\.(php|asp|jsp)$/i', $_FILES["image" . $i]["name"]) ==
false) {
                if ($_FILES["image" . $i]["name"] != "") {

$target_path = "$BASE_DIR/uploads/test/" . basename( $_FILES['image' .$i]['name']);
if(move_uploaded_file($_FILES['image' .$i]['tmp_name'], $target_path)) {
   // echo "The file ".  basename( $_FILES['image' .$i]['name'])." has been uploaded";
} else{
    echo "There was an error uploading the file, please try again!";

}
		if($i == 1){
                    deleteSliderImage($tempobj['picture' . $i]);
                }else if($i == 2){
		    deletePageImage($tempobj['picture' . $i]);
                
                }else if($i == 3){
		    deleteIconImage($tempobj['picture' . $i]);
                
                }
		    $logo_temp = $target_path;

                    $time = time();
                    $logo = $i . "_" . $time . "_" . str_replace(" ", "_", $_FILES["image" . $i]["name"]);
		    $name = basename( $_FILES['image' .$i]['name']);



                    
		if($i == 1){
                    games_banner_image($logo, $cat_id, $logo_temp, $BASE_DIR);
                }else if($i == 2){
		    games_page_image($logo, $cat_id, $logo_temp, $BASE_DIR);
                
                }else if($i == 3){
		    games_icon_image($logo, $cat_id, $logo_temp, $BASE_DIR);
                
                }
                    db_query("update $table set picture" . $i . "='" . $logo . "' where $pointer" . "ID=$cat_id");
                    
                    unlink($target_path);
                }
            }
        }
       $i++;
    }
   
?>
 