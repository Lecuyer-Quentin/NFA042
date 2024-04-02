<?php

require_once 'views/admin/users/users_table.php';
require_once 'views/admin/products/products_table.php';


function admin_dashboard(){
    echo '<section>';

      echo '<article>';
        echo '<h2>Users</h2>';
        admin_users_table();
      echo '</article>';

      echo '<article>';
        echo '<h2>Products</h2>';
        admin_products_table();
      echo '</article>';

    echo '</section>';
};

admin_dashboard();