<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=carrent; charset=utf8', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Could not connect to the database: " . $e->getMessage();
}
?>
