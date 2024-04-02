<?php 
session_start();
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$json = file_get_contents('assets/data/data.json');
$data = json_decode($json, true);
$images_meta = $data['images_meta'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php 
    foreach($images_meta as $image) {
        if($image['target'] == $page) {
            echo '<link rel="website icon" type="png" href="'.$image['href'].'">';
    }}

    echo '<title>'.ucfirst($page).'</title>';

    ?>
    
</head>          


    <body>
        <?php require_once 'layout/header.php';?>

        <?php require_once 'router.php';?>
            
        <?php require_once 'layout/footer.php';?>
    </body>
</html>
