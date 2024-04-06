<?php
    require_once 'api/users/get_user.php';
    require_once 'api/orders/get_order.php';
    require_once 'api/products/get_product.php';

    $id = $_SESSION['user']['id_utilisateur'];
    $user = get_user($id);

    $orders = get_orders_by_user($id);

    function display_user(){
        global $user;
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

    function last_order(){
        global $orders;
        $last_order = $orders[count($orders) - 1];
        $total = 0;
        echo "<h1>Dernière Commande : Order n°" . $last_order['id_commande'] . "</h1>";

        echo "<h2>Products</h2>";
        echo "<ul>";
        foreach ($last_order['products'] as $product) {
            $p = get_product($product['id_produit']);
            $product_name = $p['nom'];
            $product_price = $p['prix'];
            $product_quantite = $product['quantite'];
            $total += $product_price * $product_quantite;
            echo "<li>" . $product_name . " - " . $product_price . "€ x"  . $product_quantite . "  Total: " . $product_price * $product_quantite . "€</li>";
        }
        echo "</ul>";
        echo "<h2>Total: " . $total . "€</h2>";
    }

    function display_profile(){
        display_user();
        last_order();
    }

    display_profile();
