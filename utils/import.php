<?php

function inc_file($directory, $file) {
    $files = glob($directory . "*.php");
    if(isset($files[$file])) {
        require_once $files[$file];
    } else {
        echo "File not found in the directory";
    }
}

// Use the function
inc_file('utils/', 0);