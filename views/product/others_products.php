<?php
    require_once 'components/card/card_small.php';
    require_once 'api/products/get_products.php';
    require_once 'utils/get_image.php';

    $others_products = get_products();
    $id_to_get_category = $_GET['id'];
function displayOthersProducts() {
   global $id_to_get_category;
   global $others_products;

   //!! CORRIGER CETTE PARTIE
   

   foreach ($others_products as $product) {
       if ($product['id_produit'] == $id_to_get_category) {
           $category = $product['id_categorie'];
           break;
       }
   }

   $same_category_products = array_filter($others_products, function($p) use ($category) {
       return $p['id_categorie'] === $category;
   });



    //$product = $others_products[$id_product];
    //$category = $product['id_categorie'];

    //$others_products = array_filter($others_products, function($p) use ($category) {
    //    return $p['id_categorie'] === $category;
    //});

    echo "<section class='other_products'>";
    echo "<h3>Autres produits de la catégorie</h3>";
    echo "<article>";
    foreach ($same_category_products as $p) {
        $image = get_image($p['id_produit']);
        card_small($p, $image);
    }
    echo "</article>";
    echo "</section>";
    echo "<a href='products.php'>Back to products</a>";
}

if (isset($_GET['id'])) {
    displayOthersProducts();
} else {
    echo "<p>Product not found</p>";
}