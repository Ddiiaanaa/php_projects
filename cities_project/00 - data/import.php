<?php
die();
// Script that I used to import the data. Of course, the structure of the table
// worldcities has to be created before executing this script.

// Database configuration
$host = 'localhost';
$db   = 'test';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';


// PDO database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION
    ]);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


// Path to the CSV file
$csvFile = 'worldcities.csv';

// Open the file for reading
if (($handle = fopen($csvFile, "r")) !== FALSE) {
    // Skip the header row
    fgetcsv($handle, 1000, ",");

    // Prepared statement for inserting data
    $stmt = $pdo->prepare("INSERT INTO worldcities (city, city_ascii, lat, lng, country, iso2, iso3, admin_name, capital, population, id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Read each line of the CSV
    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $stmt->execute($row);
    }

    fclose($handle);
}

echo "Data imported successfully!";
?>
