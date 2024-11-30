<?php 
    $driver = 'mysql';
    $host = 'localhost';
    $dbname ='customers_info';
    $charset ='utf8';
    $username = 'root';
    $password = '';
    $dsn = "$driver:host=$host;dbname=$dbname;charset=$charset";
    
    $options = [
        PDO::ATTR_EMULATE_PREPARES => FALSE,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    try {
        $pdo = new PDO($dsn, $username, $password, $options);
        // Uncomment to check connection status
        // echo 'Connection successful';
    } catch (PDOException $e) {
        error_log($e->getMessage()); // Log error for debugging
        echo "Database connection error. Please try again later.";
    }
    
?>