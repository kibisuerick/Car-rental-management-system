<?php
$host = 'localhost';
$dbname = 'car_rental_management_system';
$username = 'root'; // Default XAMPP username
$password = '';     // Default XAMPP password is empty

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Optional: uncomment below line to confirm connection
    // echo "Connected successfully to the database!";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
