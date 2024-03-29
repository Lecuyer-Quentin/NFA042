<main>
<?php require_once 'components/button/back_btn.php';?>
    <h1>Admin Dashboard</h1>
    <?php require_once 'views/admin/menu.php'; ?>
        <?php
            if (isset($_POST['button'])) {
            $button = $_POST['button'];
            switch ($button) {
                case 'Users':
                    require_once 'views/admin/users.php';
                    break;
                case 'Products':
                    require_once 'views/admin/products.php';
                    break;
                default:
                    require_once 'views/admin/default.php';
                    break;
            }
        }
        ?>
</main>