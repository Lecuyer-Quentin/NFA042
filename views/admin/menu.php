<?php

function admin_menu(){
    $items = [
        'dashboard' => 'Dashboard',
        'users' => 'Users',
        'products' => 'Products',
        'orders'=> 'Commandes',
        'settings'=> 'Paramètres',
    ];
    echo '<nav>';
        echo '<ul>';
            foreach($items as $key => $value){
                echo '<li>';
                    echo '<form method="post">';
                        echo '<input type="submit" name="button" value="'.$value.'">';
                    echo '</form>';
                echo '</li>';
            }
        echo '</ul>';
    echo '</nav>';
}
admin_menu();