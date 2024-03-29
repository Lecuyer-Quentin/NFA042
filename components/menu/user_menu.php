<?php
    require_once 'utils/count_products.php';
    require_once 'components/button/login_btn.php';
    require_once 'components/button/logout_btn.php';


    function menu_user() {
        $count = countProduct();
        echo "<div class='menu_user'>";
            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
                $prenom = $user['prenom'];
                $url = 'index.php?page=profile';

                echo '<p>Bienvenue ';
                echo '<a href="'.$url.'">'.$prenom.'</a>';
                echo '</p>';

                echo "<a href='index.php?page=cart'>";
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" stroke-linejoin="round" stroke-linecap="round" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="black" class="icon">';
                        echo '<circle r="1" cy="21" cx="9"></circle>';
                        echo '<circle r="1" cy="21" cx="20"></circle>';
                        echo '<path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>';
                    echo '</svg>';
                    echo "<span>($count)</span>";
                echo "</a>";

                echo "<a href='index.php?page=profile'>";
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="0" fill="black" stroke="black" class="icon">';
                        echo '<path d="M12 2.5a5.5 5.5 0 0 1 3.096 10.047 9.005 9.005 0 0 1 5.9 8.181.75.75 0 1 1-1.499.044 7.5 7.5 0 0 0-14.993 0 .75.75 0 0 1-1.5-.045 9.005 9.005 0 0 1 5.9-8.18A5.5 5.5 0 0 1 12 2.5ZM8 8a4 4 0 1 0 8 0 4 4 0 0 0-8 0Z"></path>';
                    echo '</svg>';                    
                echo "</a>";

                log_out_btn();
            } else {
                echo "<a href='index.php?page=cart'>";
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" stroke-linejoin="round" stroke-linecap="round" viewBox="0 0 24 24" stroke-width="2" fill="none" stroke="black" class="icon">';
                        echo '<circle r="1" cy="21" cx="9"></circle>';
                        echo '<circle r="1" cy="21" cx="20"></circle>';
                        echo '<path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>';
                    echo '</svg>';                    
                    echo "<span>($count)</span>";
                echo "</a>";
                login_btn();
            }
        echo "</div>";
    }


 