<?php
    require_once 'utils/count_products.php';
    require_once 'components/button/login_btn.php';
    require_once 'components/button/logout_btn.php';
    require_once 'utils/get_JSON.php';

    function btn($value, $icon) {
            $btn = "<a href='$value'>";
                $btn .= "<img src='$icon' alt='icon'>";
            $btn .= '</a>';
    return $btn;
    }
    function user_is_connect($user, $count, $special, $items) {
        $menu = "<p>Bienvenue $user</p>";
        $menu .= "<li>";
            $menu .= btn($items[0]['value'], $items[0]['icon']);
        $menu .= "</li>";
        $menu .= "<li>";
            $menu .= btn($items[1]['value'], $items[1]['icon']);
            $menu .= "<span class='$special'>(".$count.")</span>";
        $menu .= "</li>";
        $menu .= "<li>";  
            $menu .= logout_btn();
        $menu .= "</li>";
    return $menu;
    }
    function user_not_connect($count, $special, $items) {
        $menu = "<p>Bienvenue</p>";
        $menu .= "<li>";
            $menu .= btn($items[1]['value'], $items[1]['icon']);
            $menu .= "<span class='$special'>(".$count.")</span>";
        $menu .= "</li>";
        $menu .= "<li>";
            $menu .= login_btn();
        $menu .= "</li>";
    return $menu;
    }

        

    function menu_user() {
        $count = countProducts();
        $special = $count > 0 ? 'special' : '';
        $data = get_JSON('data.json', 'menu', 'user');
        $items = $data['items'];
        $class = $data['class'];
        $user = '';

        $menu = "<div class='$class'>";
            $menu .= "<ul>";
                if(isset($_SESSION['user'])) {
                    $user = $_SESSION['user']['prenom'];
                    $menu .= user_is_connect($user, $count, $special, $items);        
                } else {
                    $menu .= user_not_connect($count, $special, $items);
                }
            $menu .= "</ul>";
        $menu .= "</div>";
    return $menu;
}
