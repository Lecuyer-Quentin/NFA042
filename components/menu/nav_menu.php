<?php
require_once 'utils/get_JSON.php';

function item_btn($value, $label) {
    $btn = '<div class="button">';
        $btn .= "<a href='$value'>";
            $btn .= '<span class="hoverBtn"></span>';
            $btn .= '<span class="hoverBtn-bottom"></span>';
            $btn .= "<p>$label</p>";
        $btn .= '</a>';
   $btn .= ' </div>';        
return $btn;
}

function menu_item() {
    $data = get_JSON('data.json', 'menu', 'nav');
    $items = $data['items'];
    $item_list = '';
        foreach($items as $item){
            $label = $item['label'];
            $value = $item['value'];
            $item_list .= '<li>';
                $item_list .= item_btn($value, $label);
            $item_list .= '</li>';
        }
    return $item_list;
}

function nav_menu() {
    $menu = "<nav>";
        $menu .= "<ul>";
        $menu .= menu_item();
        $menu .= "</ul>";
    $menu .= "</nav>";
    return $menu;
}