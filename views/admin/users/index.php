<?php
require 'table.php';

function users_details() {
    $details = '<section>';
    $details .= '<h3>Manage users</h3>';
        $details .= users_table();
    $details .= '</section>';

    return $details;
}

echo users_details();
