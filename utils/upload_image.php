<?php

function upload_image($image, $path){
    $target_dir = $path;
    $target_file = $target_dir . basename($image["name"]);
    if(!move_uploaded_file($image["tmp_name"], $target_file)) {
        die("Erreur lors de l'upload de l'image");
    }
    return $target_file;
}
    