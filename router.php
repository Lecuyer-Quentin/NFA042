<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$user_role = isset($_SESSION['user']['id_role']) ? $_SESSION['user']['id_role'] : null;


switch ($page) {
    case 'home':
        require_once 'pages/home.php';
        break;
    case 'contact':
        require_once 'pages/contact.php';
        break;
    case 'products':
        require_once 'pages/products.php';
        break;
    case 'product':
        require_once 'pages/product.php';
        break;
    case 'cart':
        require_once 'pages/cart.php';
        break;
    case 'checkout':
        require_once 'pages/checkout.php';
        break;
    case 'login':
        require_once 'pages/login.php';
        break;
    case 'register':
        require_once 'pages/register.php';
        break;
    case 'profile':
        if($user) {
            require_once 'pages/profile.php';
        } else {
            require_once 'pages/denied.php';
        }
        break;
    case 'admin':
        if( ($user_role == 1) || ($user_role == 3) ) {
            require_once 'pages/admin.php';
        } else {
            require_once 'pages/denied.php';
        }
        break;

    case 'edit_user':
        if( ($user_role == 1) || ($user_role == 3) ) {
            require_once 'pages/edit_user.php';
        } else {
            require_once 'pages/denied.php';
        }
        break;







    case 'admin_products':
        if( ($user_role == 1) || ($user_role == 3) ) {
            require_once 'pages/admin_products.php';
        } else {
            require_once 'pages/denied.php';
        }
        break;
    case 'admin_product_edit':
        if( ($user_role == 1) || ($user_role == 3) ) {
            require_once 'pages/admin_product_edit.php';
        } else {
            require_once 'pages/denied.php';
        }
        break;
    case 'admin_users':
        if( ($user_role == 1) || ($user_role == 3) ) {
            require_once 'pages/admin_users.php';
        } else {
            require_once 'pages/denied.php';
        }
        break;

    case 'admin_orders':
        if( ($user_role == 1) || ($user_role == 3) ) {
            require_once 'pages/admin_orders.php';
        } else {
            require_once 'pages/denied.php';
        }
        break;
    case 'admin_order':
        if( ($user_role == 1) || ($user_role == 3) ) {
            require_once 'pages/admin_order.php';
        } else {
            require_once 'pages/denied.php';
        }
        break;
    
    default:
        require_once 'pages/404.php';
        break;
}