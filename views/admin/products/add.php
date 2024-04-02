<?php
require_once 'product_add_form.php';

function add_product_view(){
    echo '<section>';
        echo '<article>';
            admin_add_project_form();
        echo '</article>';
    echo '</section>';
}

add_product_view();