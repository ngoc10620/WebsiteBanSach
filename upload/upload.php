<?php
/* Getting file name */
$filename = $_FILES['img']['name'];

/* Location */
$location = "sach".DIRECTORY_SEPARATOR.$filename;
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

/* Valid Extensions */
$valid_extensions = array("jpg","jpeg","png");
/* Check file extension */
if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
   $uploadOk = 0;
}
if($uploadOk == 0){
   echo 0;
}else{
   /* Upload file */
   if(move_uploaded_file($_FILES['img']['tmp_name'], realpath('').DIRECTORY_SEPARATOR.$location)){
      echo $filename;
   }else{
      echo 0;
   }
}
?>