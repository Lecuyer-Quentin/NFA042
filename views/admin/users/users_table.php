<?php

require_once 'api/users/get_users.php';
require_once 'api/get_roles.php';
require_once 'components/table/table.php';
require_once 'utils/nbr_of_days.php';


//? Ajoute un champ 'Membre depuis' dans le tableau des utilisateurs
function add_column_times($users) {
    foreach ($users as $key => $user) {
        $users[$key]['Membre depuis'] = nbr_of_days($user['date_creation']);
    }
    return $users;
}

//? Affiche le nom du role de l'utilisateur
function display_role($users) {
    $roles = get_roles();
    foreach ($users as $key => $user) {
        foreach ($roles as $role) {
            if ($user['id_role'] == $role['id_role']) {
                $users[$key]['id_role'] = ucfirst($role['nom']);
            }
        }
    }
    return $users;
}





function admin_users_table() {
    $users = get_users_from_db();
    $users = add_column_times($users);
    $users = display_role($users);
    $nbr = count($users);
    $add_user_btn = function() {
        echo '<form method="post" class="action_btn">';
            echo '<button type="submit" name="button" value="add_user">Ajouter un utilisateur</button>';
        echo '</form>';
    };


    generateTable([
        'data' => $users,
        'header' => ['Liste des utilisateurs', $add_user_btn],
        'columns' => [
            'Id' => 'id_utilisateur',
            'Nom' => 'nom',
            'Prénom' => 'prenom',
            'Email' => 'email',
            'Role' => 'id_role',
            'Membre depuis' => 'Membre depuis',
        ],
        'actions' => [
            'delete' => [
                'class' => 'action_btn', 'submit' => 'Effacer', 'action' => 'actions/delete_user.php',
                'fields' => [
                    ['type' => 'hidden', 'name' => 'id', 
                    'value' => function($users) {
                        return $users['id_utilisateur'];
                    }],
                ],
            ],
        ],

        'link'=> [
            'value' => 'update_user',
            'name' => 'Modifier',
            'class' => 'action_btn'
        ],

        'footer' => function() use ($nbr) {
            echo '<p>Il y a ' . $nbr . ' utilisateurs dans la base de données</p>';
        } 
    ]);
}
