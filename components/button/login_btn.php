<?php

function login_btn() {
    $url = "index.php?page=login";
    echo '<button class="connect_btn">';
        echo "<a href='$url'>";
            echo '<span class="transition"></span>';
            echo '<span class="gradient"></span>';
            echo '<span class="label">Login</span>';
        echo "</a>";
    echo '</button>';
}

