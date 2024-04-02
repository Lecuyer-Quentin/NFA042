<?php
require_once 'components/form/form.php';
require_once 'api/products/get_product.php';
require_once 'api/get_category.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];
}else{
    $id = $_GET['id'];
}


$product = get_product($id);
$category = get_category();

echo '<section>';
    echo '<article>';
        generateForm([
            'class' => 'contact',
            'header' => ['Modifier un produit', 'Veuillez remplir les champs suivants pour modifier un produit'],
            'submit' => 'Modifier',
            'action' => 'actions/update_product.php',
            'fields' => [
                ['type' => 'hidden', 'name' => 'id', 'value' => $product['id_produit']],
                ['type' => 'input', 'name' => 'nom', 'label' => 'Nom', 'value' => $product['nom'], 'required' => 'required'],
                ['type' => 'input', 'name' => 'description', 'label' => 'Description', 'value' => $product['description'], 'required' => 'required'],
                ['type' => 'input', 'name' => 'prix', 'label' => 'Prix', 'value' => $product['prix'], 'required' => 'required'],
                ['type' => 'select', 'name' => 'id_categorie', 'label' => 'Catégorie', 'options' => $category, 'value' => $product['id_categorie'], 'required' => 'required'],
            ],
        ]);
    echo '</article>';

echo '</section>';


