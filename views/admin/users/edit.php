<?php
require_once 'components/form/form.php';
require_once 'api/users/get_user.php';
require_once 'api/get_roles.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];
}else{
    $id = $_GET['id'];
}

$user = get_user($id);
$role = get_roles();


    echo '<section>';
        
        echo '<article>';
            generateForm([
                'class' => 'contact',
                'header' => ['Modifier un utilisateur', 'Veuillez remplir les champs suivants pour modifier un utilisateur'],
                'submit' => 'Modifier',
                'action' => 'actions/update_user.php',
                'fields' => [
                    ['type' => 'hidden', 'name' => 'id', 'value' => $user['id_utilisateur']],
                    ['type' => 'input', 'name' => 'nom', 'label' => 'Nom', 'value' => $user['nom'], 'required' => 'required'],
                    ['type' => 'input', 'name' => 'prenom', 'label' => 'Prénom', 'value' => $user['prenom'], 'required' => 'required'],
                    ['type' => 'input', 'name' => 'email', 'label' => 'Email', 'value' => $user['email'], 'required' => 'required'],
                    ['type' => 'select', 'name' => 'role', 'label' => 'Role', 'options' => $role, 'value' => $user['id_role'], 'required' => 'required'],
                ],
            ]);
        echo '</article>';
    echo '</section>';

