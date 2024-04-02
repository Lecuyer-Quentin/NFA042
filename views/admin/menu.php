<?php

function admin_menu(){
    $items = [
        'dashboard' => 'Dashboard',
        'users' => 'Users',
        'products' => 'Products',
        'orders'=> 'Commandes',
        'settings'=> 'Paramètres',
        'back'=> 'Back',
    ];
    echo '<nav>';
        echo '<ul>';
            foreach($items as $key => $value){
                echo '<li>';
                    echo '<form method="post">';
                        echo '<button type="submit" name="button" value="'.$value.'">'.$value.'</button>';
                    echo '</form>';
                echo '</li>';
            }
        echo '</ul>';
    echo '</nav>';
}