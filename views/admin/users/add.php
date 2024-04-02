<?php
require 'user_add_form.php';

function add_user_view(){
    echo '<section>';
        echo '<article>';
            admin_add_user_form();
        echo '</article>';
    echo '</section>';
}

add_user_view();