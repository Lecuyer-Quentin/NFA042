<?php

function login_btn() {
    $url = "index.php?page=login";
    $btn = '<button class="connect_btn">';
        $btn .= "<a href='$url'>";
            $btn .= '<span class="transition"></span>';
            $btn .= '<span class="gradient"></span>';
            $btn .= '<span class="label">Login</span>';
        $btn .= "</a>";
    $btn .= '</button>';
    return $btn;
}

