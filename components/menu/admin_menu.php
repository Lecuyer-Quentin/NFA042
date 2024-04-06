<?php
require_once 'utils/get_JSON.php';

function admin_menu(){
    $data = get_JSON('data.json', 'menu', 'admin');
    $items = $data['items'];

    $menu = '<nav>';
        $menu .= '<ul>';
            foreach($items as $item){
                $label = $item['label'];
                $value = $item['value'];
                $menu .= '<li>';
                    $menu .= '<form method="post">';
                        $menu .= '<button type="submit" name="button" value="'.$value.'">'.$label.'</button>';
                    $menu .= '</form>';
                $menu .= '</li>';
            }
        $menu .= '</ul>';
    $menu .= '</nav>';

    return $menu;
}

echo admin_menu();