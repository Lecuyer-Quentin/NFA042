<?php
require_once 'api/products/get_product.php';
function get_image($productId){
    $product = get_product($productId);
    if(isset($product['image'])){
        $slash = strstr($product['image'], '/');
        $image_path = substr($slash, 1); // This will get everything after the first slash
        return $image_path;
    }else{
        return 'uploads/default.jpg';
    }
}