<main>
    <h1>Cart</h1>
    <section>
    <?php 
    require_once 'api/products/get_product.php';
    require_once 'class/Cart.php';
    $new_cart = new Cart();
    $cart = $new_cart->getCart();
    $data = [];
    foreach($cart as $key => $item) {
        $product = get_product($key);
        $data[$key] = $product;
    }
    $new_cart->setData($data);
    echo $new_cart->displayCart();
     ?>
     </section>
</main>