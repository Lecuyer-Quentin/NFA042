<?php
    require_once 'api/db_connect.php';
function get_category() {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM Categories');
    $stmt->execute();
    $category = $stmt->fetchAll();
    return $category;
}