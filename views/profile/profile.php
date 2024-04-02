<?php
    require_once 'api/users/get_user.php';

    $user = get_user($_SESSION['user']['id_utilisateur']);


    function display_user($user){
        echo '<div class="profile">';
        echo '<h1>Profile</h1>';
        echo '<div class="profile_info">';
        echo '<p><strong>Nom:</strong> '.$user['nom'].'</p>';
        echo '<p><strong>Prénom:</strong> '.$user['prenom'].'</p>';
        echo '<p><strong>Email:</strong> '.$user['email'].'</p>';
        echo '<p><strong>Role:</strong> '.$user['id_role'].'</p>';
        echo '<p><strong>Date de création:</strong> '.$user['date_creation'].'</p>';
        echo '</div>';
        echo '</div>';
    }

    display_user($user);

