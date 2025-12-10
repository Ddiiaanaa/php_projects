<?php

try {
    $pdo = new PDO('mysql:host=localhost;port=3307;dbname=cities;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
catch (PDOException $e) {
    echo 'A problem occured with the database connection...';
    die();
}
