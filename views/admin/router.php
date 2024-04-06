<?php

if(isset($_POST['button'])){
    $value = $_POST['button'];
    switch($value){
        case 'dashboard':
            require_once 'views/admin/dashboard.php';
            break;
        case 'users':
            require_once 'views/admin/users/index.php';
            break;
        case 'products':
            require_once 'views/admin/products/products.php';
            break;
        case 'orders':
            require_once 'views/admin/orders/orders.php';
            break;
        case 'settings':
            require_once 'views/admin/settings/settings.php';
            break;
        case 'add_user':
            require_once 'views/admin/users/add.php';
            break;
        case 'edit_user':
            require_once 'views/admin/users/edit.php';
            break;
        case 'add_product':
            require_once 'views/admin/products/add.php';
            break;
        case 'edit_product':
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