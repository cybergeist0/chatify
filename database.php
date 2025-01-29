<?php
// database.php

$host = 'localhost';
$dbname = 'chatify';
$username = 'root'; // Change this if your database user is different
$password = ''; // Change this if your database has a password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
