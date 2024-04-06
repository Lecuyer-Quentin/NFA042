<?php

require_once 'class/Table.php';
require_once 'api/products/get_products.php';
require_once 'api/get_category.php';
require_once 'utils/get_JSON.php';
require_once 'models/Products.php';
$products = new Products($pdo);
$products = $products->read();

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

function products_table($products){
    $products = display_category($products);
    $nbr = count($products);
    $data = get_JSON('data.json','tables', 'products');
    $footer[] = ['type' => 'p', 'content' => 'Nombre de produits: ' . $nbr];
    $data['items'] = $products;
    $data['footer'] = $footer;
    $table = new Table();
    $table->setData($data);
    $table->generateTable();

    $products_table = '<article>';
    $products_table .= '<h2>Products</h2>';
    $products_table .= $table->generateTable();
    $products_table .= '</article>';

    return $products_table;
}

echo products_table($products);

