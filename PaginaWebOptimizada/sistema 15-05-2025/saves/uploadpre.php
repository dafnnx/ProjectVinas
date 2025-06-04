<?php
include('../cn/connect2.php'); 
if (is_array($_FILES) && count($_FILES) > 0) {
    if (($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "image/gif")) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], "../prenda_imgs/".$_FILES['file']['name'])) {
            echo "./prenda_imgs/".$_FILES['file']['name'];
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}