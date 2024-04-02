<?php

if(isset($_POST['button'])){
    $button = $_POST['button'];
    switch($button){
        case 'Profil':
            require_once 'views/profile/profile.php';
            break;
        case 'Commandes':
            require_once 'views/profile/orders/orders.php';
            break;
        case 'Paramètres':
            require_once 'views/profile/settings/settings.php';
            break;
        case 'Admin':
            require_once 'pages/admin.php';

        default:
            require_once 'views/profile/profile.php';
            break;
    }
}else{
    require_once 'views/profile/profile.php';
}