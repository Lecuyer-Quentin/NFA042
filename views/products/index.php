<main>
    <h1>Tous les produits</h1>
    <section style="display: flex; flex-direction: row; flex-wrap: wrap; justify-content: center; align-items: center; gap: 1rem; background-color: #f5f5f5; border-radius: .5rem; box-shadow: 0 0 1rem #000; width: 90% ">
        <?php 
        require_once 'models/Products.php';
        require_once 'config/database.php';
        require_once 'components/card/card_small.php';
        $products = new Products($pdo);
        $products = $products->read();
        foreach ($products as $product) {
            echo card_small($product, 'images/' . $product['image']);
        }
        ?>
    </section>
</main>