<?php

if(isset($_POST['button'])){
    $button = $_POST['button'];
    switch($button){
        case 'Dashboard':
            require_once 'views/admin/dashboard.php';
            break;
        case 'Users':
            require_once 'views/admin/users/users.php';
            break;
        case 'Products':
            require_once 'views/admin/products/products.php';
            break;
        case 'Orders':
            require_once 'views/admin/orders/orders.php';
            break;
        case 'Settings':
            require_once 'views/admin/settings/settings.php';
            break;
        case 'add_user':
            require_once 'views/admin/users/add.php';
            break;
        case 'update_user':
            require_once 'views/admin/users/edit.php';
            break;
        case 'add_product':
            require_once 'views/admin/products/add.php';
            break;
        case 'update_product':
            require_once 'views/admin/products/edit.php';
            break;
        case 'back':
            $_SERVER['HTTP_REFERER'];
            break;
            
        default:
            require_once 'views/admin/dashboard.php';
            break;
    }
}else{
    require_once 'views/admin/dashboard.php';
}