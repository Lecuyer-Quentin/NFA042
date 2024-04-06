<?php
require_once '../api/products/add_product.php';
require_once '../utils/upload_image.php';
require_once '../utils/error_message.php';

function check_image($image) {
    $image_info = getimagesize($image['tmp_name']);
    if($image_info === false) {
        return false;
    }else{
        $image_mime = $image_info['mime'];
        if (!in_array($image_mime, ['image/jpeg', 'image/png', 'image/gif'])) {
            return false;
        }
    }
    return true;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $error_products = [];

    if(!isset($_POST['name']) || strlen($_POST['name']) < 3) {
        $error_products[] = translateErrorMessage('Error[NAME]');
    }
    $name = $_POST['name'];

    if(!isset($_POST['description']) || strlen($_POST['description']) < 3) {
        $error_products[] = translateErrorMessage('Error[DESCRIPTION]');
    }
    $description = $_POST['description'];

    if(!isset($_POST['price']) || !is_numeric($_POST['price']) || $_POST['price'] < 0) {
        $error_products[] = translateErrorMessage('Error[PRICE]');
    }
    $price = $_POST['price'];

    if(!isset($_POST['category']) || !is_numeric($_POST['category'])) {
        $error_products[] = translateErrorMessage('Error[CATEGORY]');
    }
    $category = $_POST['category'];

    if(!isset($_FILES['image'])) {
        $error_products[] = translateErrorMessage('Error[IMAGE]');
    }
    $image = $_FILES['image'];

    // Check if the image is in the correct format
    if(!check_image($image)) {
        $error_products[] = translateErrorMessage('Error[INVALID_IMAGE_TYPE]');
        echo implode('<br>', $error_products);
    } else {

        try {
            $target_file = upload_image($image, '../uploads/products/');
            add_product_to_db($name, $description, $price, $category, $target_file);
            echo 'success';
            exit();
    
        } catch (Exception $e) {
            $technical_error_message = $e->getMessage();
            $error_products[] = translateErrorMessage($technical_error_message);
            echo implode('<br>', $error_products);
        }
    }


}




    