<?php
// includes/db.php  –  Database connection (PDO)
define('DB_HOST', 'localhost');
define('DB_NAME', 'foodfusion');
define('DB_USER', 'root');      // Change to your MySQL username
define('DB_PASS', '');          // Change to your MySQL password
define('DB_CHARSET', 'utf8mb4');

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    // In production, never expose the raw error
    error_log($e->getMessage());
    die(json_encode(['error' => 'Database connection failed. Please check your configuration.']));
}
