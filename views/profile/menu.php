<?php 

function profile_menu(){
    $items = [
        'profile' => 'Profil',
        'orders' => 'Commandes',
        'settings'=> 'Paramètres',
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
            if(($_SESSION['user']['id_role'] == 1) || ($_SESSION['user']['id_role'] == 3)){
                echo '<li>';
                    echo '<a href="index.php?page=admin">';
                    echo '<button type="submit" name="button" value="Admin">Admin</button>';
                    echo '</a>';
                echo '</li>';
            }
             
        echo '</ul>';
    echo '</nav>';
}

profile_menu();

