<?php

try {
    $pdo = new PDO('mysql:host=localhost;port=3307;dbname=names;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
catch (PDOException $e) {
echo "Помилка підключення або SQL-запиту: " . $e->getMessage();    die();
}
