<main>
    <?php //require_once 'views/product/others_products.php';?>
    <?php require_once 'models/Products.php';
    require_once 'config/database.php';
    require_once 'components/card/card_small.php';
    require_once 'utils/get_JSON.php';
    require_once 'class/Form.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $add_data = get_JSON('data.json', 'forms', 'add_to_cart');
        $add_data['fields'][0]['value'] = $id;
        $add = new Form();
        $add->setData($add_data);
        $delete_data = get_JSON('data.json', 'forms', 'delete_from_cart');
        $delete_data['fields'][0]['value'] = $id;
        $delete = new Form();
        $delete->setData($delete_data);

        $product = new Products($pdo);
        $product = $product->read_single($id);
        echo card_small($product, 'images/' . $product['image']);
        echo $add->generateForm();
        echo $delete->generateForm();
        
    } else {
        echo '<h1>Produit no trouver</h1>';
    }

    
    ?>

</main>