<?php

require_once 'components/table/table.php';
require_once 'api/products/get_products.php';
require_once 'api/get_category.php';

function display_category($products){
    $category = get_category();
    foreach ($products as $key => $product) {
        foreach ($category as $cat) {
            if ($product['id_categorie'] == $cat['id_categorie']) {
                $products[$key]['id_categorie'] = ucfirst($cat['nom']);
            }
        }
    }
    return $products;
}


function admin_products_table(){
    $products = get_products();
    $products = display_category($products);
    $nbr = count($products);
    $add_product_btn = function() {
        echo '<form method="post" class="action_btn" id="add_product">';
        echo '<button type="submit" name="button" value="add_product">Ajouter un produit</button>';
        echo '</form>';
    };

    generateTable([
        'data' => $products,
        'header' => ['Liste des produits', $add_product_btn],
        'columns' => [
            'Id' => 'id_produit',
            'Nom' => 'nom',
            'Description' => 'description',
            'Prix' => 'prix',
            'Catégorie' => 'id_categorie',
            'Date' => 'date_creation',
        ],
        'actions' => [
            'delete' => [
                'class' => 'action_btn',
                'submit' => 'Delete',
                'action' => 'actions/delete_product.php',
                'fields' => [
                    ['type' => 'hidden', 'name' => 'id', 
                    'value' => function($products) {
                        return $products['id_produit'];
                    }
                    ]
                ],
            ],
        ],
        'link' => [
            'value' => 'update_product',
            'name' => 'Edit',
            'class' => 'action_btn',
        ],
        'footer' => function() use ($nbr) {
            echo "<p>Il y a " . $nbr . " produits dans la base de données</p>";
        }
    ]);
}

