<?php
// config/db.php

$host = 'localhost';
$db   = 'lms_practice';
$user = 'root';
$pass = '1234';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Test connection by fetching tables
    $stmt = $pdo->query("SHOW TABLES LIKE 'classes'");
    if ($stmt->rowCount() === 0) {
        die("Error: 'classes' table doesn't exist in database '$db'");
    }
    
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}