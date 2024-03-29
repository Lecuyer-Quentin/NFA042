<?php
require_once 'components/table/table.php';
require_once 'components/form/form.php';
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

    generateTable([
        'data' => $products,
        'header' => ['Liste des produits', ""],
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
            'url' => 'index.php?page=admin_product_edit&id=',
            'name' => 'Edit',
            'class' => 'action_btn'
        ],
        'footer' => function() use ($nbr) {
            echo "<p>Il y a " . $nbr . " produits dans la base de données</p>";
        }
    ]);
}


function admin_add_project_form(){
    $categories = get_category();

    generateForm([
        'class' => 'contact',
        'header' => ['Ajouter un produit', 'Veuillez remplir les champs suivants pour ajouter un produit'],
        'submit' => 'Add product',
        'action' => 'actions/add_product.php',
        'enctype' => 'multipart/form-data',
        'fields' => [
            ['type' => 'input', 'name' => 'name', 'label' => 'Nom', 'required' => 'required'],
            ['type' => 'textarea', 'name' => 'description', 'label' => 'Description', 'required' => 'required'],
            ['type' => 'number', 'name' => 'price', 'label' => 'Prix', 'required' => 'required'],
            ['type' => 'select', 'name' => 'category', 'label' => 'Catégorie', 'options' => $categories, 'required' => 'required'],
            ['type' => 'file', 'name' => 'image', 'label' => 'Image', 'required' => 'required'],
        ]
    ]);
}

function admin_products_details(){
    echo '<section>';
    echo '<h3>Manage products</h3>';
        echo '<article>';
            admin_products_table();
        echo '</article>';
        echo '<article>';
            admin_add_project_form();
        echo '</article>';
    echo '</section>';
}
    

admin_products_details();



