<?php
function log_out_btn(){
    $action = 'actions/log_out.php';

        echo "<form action='$action' method='post' class='connect_btn'>";
            echo '<span class="transition"></span>';
            echo '<span class="gradient"></span>';
            echo '<span class="label">Déconnexion</span>';
            echo "<button type='submit' name='log_out'>Log out</button>";
        echo "</form>";
}