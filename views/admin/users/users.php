<?php
require 'users_table.php';

function admin_users_details() {
    echo '<section>';
    echo '<h3>Manage users</h3>';
        echo '<article>';
                admin_users_table();
        echo '</article>';
    echo '</section>';
}

admin_users_details();
