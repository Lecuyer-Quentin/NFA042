<?php
function logout_btn(){
    $action = 'actions/log_out.php';
    $btn = "<form action='$action' method='post' class='connect_btn'>";
        $btn .= '<span class="transition"></span>';
        $btn .= '<span class="gradient"></span>';
        $btn .= '<span class="label">Déconnexion</span>';
        $btn .= "<button type='submit' name='log_out'>Log out</button>";
    $btn .= "</form>";
    return $btn;
}