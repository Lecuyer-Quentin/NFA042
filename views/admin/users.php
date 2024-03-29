<?php
require_once 'api/users/get_users.php';
require_once 'api/get_roles.php';
require_once 'components/table/table.php';
require_once 'components/form/form.php';


function nbr_of_days($date) {
    $date = new DateTime($date);
    $now = new DateTime();
    $interval = $now->diff($date);
    return $interval->format('%a jours');
}

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


    generateTable([
        'data' => $users,
        'header' => ['Liste des utilisateurs', ""],
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
            'url' =>'index.php?page=edit_user&id=',
            'name' => 'Modifier',
            'class' => 'action_btn'
        ],
        'footer' => function() use ($nbr) {
            echo '<p>Il y a ' . $nbr . ' utilisateurs dans la base de données</p>';
        } 
    ]);
}

function admin_add_user_form() {
    $roles = get_roles();

    generateForm([
        'class' => 'contact',
        'header' => ['Ajouter un utilisateur', 'Veuillez remplir les champs suivants pour ajouter un utilisateur'],
        'submit' => 'Add user',
        'action' => 'actions/register.php',
        'fields' => [
            ['type' => 'input', 'name' => 'nom', 'label' => 'Nom', 'required' => 'required'],
            ['type' => 'input', 'name' => 'prenom', 'label' => 'Prénom', 'required' => 'required'],
            ['type' => 'input', 'name' => 'email', 'label' => 'Email', 'required' => 'required'],
            ['type' => 'password', 'name' => 'password', 'label' => 'Password', 'required' => 'required'],
            ['type'=> 'password', 'name'=> 'password_confirm', 'label'=> 'Confirm Password', 'required'=> 'required'],
            ['type' => 'select', 'name' => 'role', 'label' => 'Role', 'options' => $roles, 'required' => 'required'],
        ]
    ]);
}

function admin_users_details() {
    echo '<section>';
    echo '<h3>Manage users</h3>';
        echo '<article>';
                admin_users_table();
        echo '</article>';
        echo '</br>';
        echo '<article>';
                admin_add_user_form();
        echo '</article>';
    echo '</section>';
}

admin_users_details();
