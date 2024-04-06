<main>
    <?php 
        require_once 'components/menu/admin_menu.php';
        require_once 'components/button/back_btn.php';    
        $back = $_SERVER['HTTP_REFERER'];
        $back_url = 'index.php?page=admin';
        back_button($back);
        require_once 'views/admin/router.php'; 
    ?>
</main>